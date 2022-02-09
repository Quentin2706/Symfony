<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Suppliers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProductName', TextType::class, [
                'label' => 'Nom du produit',
               
                'attr' => [
                    'placeholder' => 'Entrez le nom du produit',
                    'pattern' => '[A-Za-zéèàçâêûîôäëüïö\_\-\s]+',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/',
                        'message' => 'ntm'
                        ]),
                ],
            ])

            ->add('CategoryID')
            ->add('QuantityPerUnit')
            ->add('UnitPrice')
            ->add('UnitsInStock')
            ->add('UnitsOnOrder')
            ->add('ReorderLevel')
            ->add('Discontinued')
            ->add('supplier', EntityType::class, [
                'class' => Suppliers::class,
                'label' => 'fournisseur',
                'attr' => [
                    'class' => 'test'
                ],
                'placeholder' => 'test',
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
