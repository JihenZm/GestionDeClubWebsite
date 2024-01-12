<?php

namespace App\Form;

use App\Entity\Licencie;
use App\Entity\Categorie; 
use App\Entity\Contact; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class LicencieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('numLicence')
        ->add('Nom')
        ->add('Prenom')
        ->add('contact', EntityType::class, [
            'class' => Contact::class,
            'choice_label' => 'nomComplet', // ou 'prenomNom' selon vos besoins
            // ... d'autres options
        ])
        ->add('categorie', EntityType::class, [
        'class' => Categorie::class,
        'choice_label' => 'Nom', // or any property you want to display in the dropdown
        // other options...
    ])
        ->add('contact', ContactType::class, [
            'data_class' => Contact::class,
        ])
        ->add('Ajouter', SubmitType::class)
  ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Licencie::class,
        ]);
    }
}
