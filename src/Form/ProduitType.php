<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_produit')
            ->add('prix_produit')
            ->add('date_expo')
            ->add('date_fin')
            ->add('disponibilite')
            ->add('disponibilite', ChoiceType::class,[
                'choices' => [
                    'Disponible' => 'Disponible',
                    'non disponible' => 'non disponible',

                ],
                'expanded' => true
            ])
            ->add('type_action', ChoiceType::class,[
                'choices' => [
                    'location' => 'location',
                    'vente' => 'vente',

                ],
                'expanded' => true
            ])


            ->add('imgproduit',FileType::class, array('data_class' => null))        ;
    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
