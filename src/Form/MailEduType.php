<?php

namespace App\Form;

use App\Entity\MailEdu; 
use App\Entity\Educateur; 

use App\Entity\MailContact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MailEduType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      
        $builder
        ->add('educateurs', EntityType::class, [
            'class' => Educateur::class,
            'choice_label' => 'email', // Remplacez par le champ approprié
            'multiple' => true, // Permet la sélection multiple
            'expanded' => true, // Affiche les choix sous forme de cases à cocher
        ])
        
        ->add('objet')
        ->add('DateEnvoi')
        ->add('message')
        // Ajoutez d'autres champs au besoin
 
   
        ->add('Envoyer', SubmitType::class)
            // ->add('Annuler', ButtonType::class, [
            //     'attr' => ['class' => 'btn btn-light'],
            //     'label' => 'Annuler',
            // ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailEdu::class,
            'educateurs' => null,
        ]);
    }
}
