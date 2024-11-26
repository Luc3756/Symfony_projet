<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\OrderItem;
use App\Repository\ProductRepository;
use App\Form\OrderType;
use App\Enum\Order1; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
        $panier = $session->get('panier', []);
        
        $data = [];
        $total = 0;
        
        foreach ($panier as $id => $quantity) {
            $product = $productRepository->find($id);
            $data[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
            $total += $product->getPrice() * $quantity;
        }

        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'total' => $total,
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Product $product, SessionInterface $session)
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);
        
        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }
        
        $session->set('panier', $panier);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        
        if (isset($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        
        $this->addFlash('success', 'Produit supprimé du panier');
        
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(Request $request, SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $panier = $session->get('panier', []);
        
        if (empty($panier)) {
            $this->addFlash('error', 'Votre panier est vide.');
            return $this->redirectToRoute('cart_index');
        }
    
        // Créer une nouvelle commande
        $order = new Order();
        $order->setReference(uniqid('ORD'));
        $order->setCreateAT((new \DateTime())->format('Y-m-d'));
        $order->setStatus(Order1::preparation); // Statut de la commande
        $order->setUser($this->getUser());
    
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Parcourir le panier et créer les éléments de commande
            foreach ($panier as $productId => $quantity) {
                $product = $productRepository->find($productId);
                if ($product) {
                    if ($product->getStock() < $quantity) {
                        $this->addFlash('error', 'Stock insuffisant pour ' . $product->getName());
                        return $this->redirectToRoute('cart_index');
                    }
    
                    $orderItem = new OrderItem();
                    $orderItem->setProduct($product);
                    $orderItem->setQuantity($quantity);
                    $orderItem->setProductPrice($product->getPrice());
                    $orderItem->setOrder1($order);
    
                    // Mettre à jour le stock
                    $product->setStock($product->getStock() - $quantity);
    
                    $entityManager->persist($orderItem);
                    $entityManager->persist($product);
                }
            }
    
            $entityManager->persist($order);
            $entityManager->flush();
    
            $session->remove('panier');
    
            $this->addFlash('success', 'Votre commande a été validée avec succès !');
            return $this->redirectToRoute('cart_index');
        }
    
        // Passer la chaîne de caractères de l'état de la commande à la vue
        $orderStatus = $order->getStatus()->toString();
    
        return $this->render('cart/checkout.html.twig', [
            'form' => $form->createView(),
            'orderStatus' => $orderStatus,  // Ajouter la variable ici
        ]);
    }
    

    #[Route('/clear', name: 'clear')]
    public function clear(SessionInterface $session)
    {
        $session->remove('panier');
        
        $this->addFlash('success', 'Votre panier a été vidé.');

        return $this->redirectToRoute('cart_index');
    }

    
}
