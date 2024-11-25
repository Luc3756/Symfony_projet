<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $orderRepository;
    private $productRepository;  

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;  
    }

    #[Route('/admin/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        $orders = $this->orderRepository->findBy([], ['id' => 'DESC'], 5);

        $productCounts = $this->productRepository->getTotalProductsByCategory();

        return $this->render('dashboard/index.html.twig', [
            'orders' => $orders,  
            'productCounts' => $productCounts,  
        ]);
    }
}