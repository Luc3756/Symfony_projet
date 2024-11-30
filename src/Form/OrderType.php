<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', null, [
                'label' => 'Référence',
                'disabled' => true, 
            ])
            ->add('status', TextType::class, [
                'label' => 'Statut',
                'disabled' => true, 
                'data' => $options['data']->getStatus()->toString(), 
            ])
            ->add('createAT', null, [
                'label' => 'Date de création',
                'disabled' => true, 
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider la commande',
                'attr' => ['class' => 'btn btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
