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
use Symfony\Component\Form\Extension\Core\Type\TextType;    
use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price', TextType::class, [
                'constraints' => [
                    new Assert\GreaterThan([
                        'value' => 0,
                        'message' => 'Le prix doit être supérieur à zéro.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^\d+(\.\d{1,2})?$/',  
                        'message' => 'Veuillez entrer un nombre valide pour le prix.',
                    ]),
                ],
                'attr' => [
                    'pattern' => '\d+(\.\d{1,2})?',
                    'min' => 0,
                ],
            ])
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
