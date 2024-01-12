<?php

namespace App\Form;

use App\Entity\MailEdu; 
use App\Entity\Educateur; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class MailEduType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Educateurs', EntityType::class, [
            'class' => Educateur::class,
            'choice_label' => 'Email', // or any property you want to display in the dropdown
            // other options...
        ])  
            ->add('DateEnvoi')
            ->add('objet') 
            ->add('message')
            ->add('Ajouter', SubmitType::class)
            ->add('Annuler', ButtonType::class, [
                'attr' => ['class' => 'btn btn-light'],
                'label' => 'Annuler',
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailEdu::class,
        ]);
    }
}
