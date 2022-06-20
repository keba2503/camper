<?php

namespace App\Controller;

use App\Entity\Capitulos;
use App\Entity\Fases;
use App\SpamChecker;
use App\Form\CapitulosFormType;
use App\Repository\FasesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CapitulosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FasesController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'homepage')]
    public function index(FasesRepository $fasesRepository): Response
    {
        $response = new Response($this->twig->render('fases/index.html.twig', [
            'fases' => $fasesRepository->findAll(),
        ]));
        $response->setSharedMaxAge(3600);
        return $response;
    }


    #[Route('/fases/{slug}', name: 'fases')]
    public function show(Request $request, Fases $fases, CapitulosRepository $capitulosRepository, SpamChecker $spamChecker): Response
    {
        $capitulos = new Capitulos();
        $form = $this->createForm(CapitulosFormType::class, $capitulos);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $capitulos->setFases($fases);

            $this->entityManager->persist($capitulos);

            $context = [
                'user_ip' => $request->getClientIp(),
                'user_agent' => $request->headers->get('user-agent'),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];
            if (2 === $spamChecker->getSpamScore($capitulos, $context)) {
                throw new \RuntimeException('Blatant spam, go away!');
            }



            $this->entityManager->flush();

            return $this->redirectToRoute('fases', ['slug' => $fases->getSlug()]);
        }

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $capitulosRepository->getCapitulosPaginator($fases, $offset);

        return new Response($this->twig->render('fases/show.html.twig', [
            'fases' => $fases,
            'capitulos' => $paginator,
            'previous' => $offset - CapitulosRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CapitulosRepository::PAGINATOR_PER_PAGE),
            'capitulos_form' => $form->createView(),
        ]));
    }
}
