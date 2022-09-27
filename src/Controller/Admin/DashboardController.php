<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Entity\User;
use App\Entity\Articles;
use App\Entity\Comments;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted(["ROLE_ADMIN"])]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
       
        $userview = $adminUrlGenerator->setController(UserCrudController::class)->generateUrl();

        // $adminUrlGenerator1 = $this->container->get(AdminUrlGenerator::class);
        // $articleview = $adminUrlGenerator1->setController(ArticlesCrudController::class)->generateUrl();

        return $this->redirect($userview)/*($articleview)*/;

    
        $articleview = $adminUrlGenerator->setController(ArticlesCrudController::class)->generateUrl();
        return $this->redirect($articleview);

        $commentview = $adminUrlGenerator->setController(CommentsCrudController::class)->generateUrl();
        return $this->redirect($commentview);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Blog');
    }

    public function configureMenuItems(): iterable
    {
<<<<<<< HEAD
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToCrud('Utilisateurs', "fas fa-users", User::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-pager', Articles::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-pager', Comments::class);
=======
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Accueil', 'fas fa-redo', 'app_home');
        yield MenuItem::linkToRoute('Articles', 'fas fa-undo', 'app_articles_index');

       

        // yield MenuItem::linkToRoute( $articleview, 'fas fa-list', Articles::class);

>>>>>>> b12cba42dd232577b4d22083e3d43b9865c9fb02
    }
}
