<?php

namespace App\Form;

use App\Enum\Status;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('stock')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Disponible' => Status::dispo,
                    'En rupture' => Status::rupture,
                    'Précommande' => Status::precommande,
                ],
                'choice_label' => fn (Status $status) => $status->toString(),
                'choice_value' => fn (?Status $status) => $status?->value,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
