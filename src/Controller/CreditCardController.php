<?php

namespace App\Controller;

use App\Entity\CreditCard;
use App\Form\CreditCardType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditCardController extends AbstractController
{
    #[Route('/credit-card', name: 'credit_card_index')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $creditCard = new CreditCard();

        $form = $this->createForm(CreditCardType::class, $creditCard);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $creditCard->setUser($this->getUser()); 
                $entityManager->persist($creditCard);
                $entityManager->flush();

                $this->addFlash('success', 'Votre carte de crédit a été ajoutée avec succès !');

                return $this->redirectToRoute('credit_card_index');
            } catch (\Exception $e) {
                
                $this->addFlash('error', 'Une erreur est survenue lors de l\'ajout de la carte.');
            }
        }

        $creditCards = $doctrine->getRepository(CreditCard::class)->findBy(['user' => $this->getUser()]);

        return $this->render('credit_card/index.html.twig', [
            'form' => $form->createView(),
            'creditCards' => $creditCards,
        ]);
    }
}

