<?php

namespace App\Form;
use App\Form\LicencieType;
use App\Entity\Licencie; 

use App\Form\MailContactType;
use App\Repository\LicencieRepository;
use App\Entity\MailContact; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MailContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('licencies', EntityType::class, [
                'class' => Licencie::class,
                'choice_label' => 'Nom', // Remplacez par le champ approprié
                'multiple' => true, // Permet la sélection multiple
                'expanded' => true, // Affiche les choix sous forme de cases à cocher
            ])
            
            ->add('Objet')
            ->add('Message')
            ->add('DateEnvoi')
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailContact::class,
            'licencies' => null,
        ]);
    }
}
