<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Suppliers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $productNameRegex = '[A-Za-zéèàçâêûîôäëüïö\_\-\s]+';


        $builder


            ->add('ProductName', TextType::class, [
                'label' => 'Nom du produit',

                'attr' => [
                    'placeholder' => 'Entrez le nom du produit',
                    'pattern' => $productNameRegex,
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^' . $productNameRegex . '$/',
                        'message' => 'Uniquement les lettres sont acceptées.'
                    ]),
                ],
            ])

            ->add('CategoryID', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]*$/',
                        'message' => 'Uniquement des chiffres batards'
                    ]),
                ],
            ])
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

            ])
            ->add('Picture2', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Veuillez insérer une photo au format jpg, jpeg ou png'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
