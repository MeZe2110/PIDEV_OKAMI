<?php

namespace App\Form;

use App\Entity\Rendezvous;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\ResolvedFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('daterv')
            ->add('Utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => ['class' => 'rendezvous-checkbox'],
            ])
            ->add('Salle')
            ->add('Type')
            ->add('Save',SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }


}
