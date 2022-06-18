<?php

namespace App\Controller\Admin;


use App\Entity\Fases;
use App\Entity\Capitulos;
use App\Entity\Lista;
use App\Entity\TipoLista;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
                $url = $routeBuilder->setController(FasesCrudController::class)->generateUrl();
        
                return $this->redirect($url);
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Camper');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Inicio', 'fas fa-home', 'admin');
        yield MenuItem::linkToCrud('Fases', 'fas fa-map', Fases::class);
        yield MenuItem::linkToCrud('Capitulos', 'fas fa-address-book', Capitulos::class);
        yield MenuItem::linkToCrud('Tipos de lista', ' fas fa-calendar-check', TipoLista::class);
        yield MenuItem::linkToCrud('Listas', 'fas fa-check-square', Lista::class);
    }
}
