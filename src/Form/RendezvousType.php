<?php

namespace App\Form;

use App\Entity\Rendezvous;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('daterv', Type\DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'invalid_message' => 'La date est invalide.',
            ])
            ->add('endAt', Type\TimeType::class, [
                
            ])
            ->add('User', EntityType::class, [
                'class' => User::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => ['class' => 'rendezvous-checkbox'],
            ])
            ->add('Salle')
            ->add('Type')
            ->add('Save', Type\SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn'],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }

    public function onPostSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $daterv = $data->getDaterv();
        $endTo = $data->getEndAt();
        
        if ($endTo instanceof \DateTimeInterface && $daterv instanceof \DateTimeInterface) {
            $endToDatetime = (clone $daterv)->modify('+' . $endTo->format('H') . ' hours +'. $endTo->format('i') . ' minutes');
            $data->setEndAt($endToDatetime);
            $data->setRappel(true);
            $event->setData($data);
        }

    }

}
