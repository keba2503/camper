<?php

namespace App\Controller;
use App\Entity\Fases;
use App\Repository\FasesRepository;
use App\Repository\CapitulosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FasesController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, FasesRepository $fasesRepository): Response
     {
        return new Response($twig->render('fases/index.html.twig', [
                        'fases' => $fasesRepository->findAll(),
                    ]));
    }


    #[Route('/fases/{id}', name: 'fases')]
    public function show(Request $request, Environment $twig, Fases $fases, CapitulosRepository $capitulosRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $capitulosRepository->getCapitulosPaginator($fases, $offset);
       
        return new Response($twig->render('fases/show.html.twig', [
            'fases' => $fases,
            'capitulos' => $paginator,
            'previous' => $offset - CapitulosRepository::PAGINATOR_PER_PAGE,
           'next' => min(count($paginator), $offset + CapitulosRepository::PAGINATOR_PER_PAGE),
        ]));
        }


}
