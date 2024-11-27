<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function list(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $entityManager->getRepository(Product::class)->createQueryBuilder('p');
        
        $pagination = $paginator->paginate(
            $queryBuilder,        
            $request->query->getInt('page', 1), 
            10                       
        );

        return $this->render('product/index.html.twig', [
            'pagination' => $pagination, 
        ]);
    }

    #[Route('/products/search', name: 'product_search', methods: ['GET'])]
    public function search(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $searchQuery = $request->query->get('q', '');

        $queryBuilder = $entityManager->getRepository(Product::class)->createQueryBuilder('p');

        if ($searchQuery) {
            $queryBuilder
                ->where('p.name LIKE :searchQuery')
                ->setParameter('searchQuery', '%' . $searchQuery . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder,        
            $request->query->getInt('page', 1), 
            10                       
        );

        if ($request->isXmlHttpRequest()) {
            return $this->render('product/_product_list.html.twig', [
                'pagination' => $pagination, 
            ]);
        }

        return $this->render('product/index.html.twig', [
            'pagination' => $pagination, 
        ]);
    }

    #[Route('/products/{id}', name: 'product_detail')]
    public function detail(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }
}
