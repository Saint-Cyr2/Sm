<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Item;
use App\Entity\ItemType;

class ItemController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sm');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to home', 'fa fa-home', 'admin');
        yield MenuItem::linkToCrud('Items', 'fa fa-list', Item::class);
        yield MenuItem::linkToCrud('Item Type', 'fa fa-list', ItemType::class);
        
    }
}
