<?php

namespace App\Form;
use App\Entity\Categorie;
use App\Entity\Ville;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Annonce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            
            ->add('prix')
            
            ->add('categorieId', EntityType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'placeholder'=>'Sélectionner une catégorie ',
            ])
            ->add('villeId', EntityType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'class' => Ville::class,
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'placeholder'=>'Sélectionner une ville ',
            ])
            ->add('description')
            ->add('couverture', FileType::class)
            ->add('submit' , SubmitType::class,
            ['attr' => ['class' => 'btn btn-primary btn-block waves-effect waves-light' ],
             'label' => 'ajouter annonce']
            ) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
