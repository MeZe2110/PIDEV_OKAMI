<?php

namespace App\Form;

use App\Entity\Salle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numsa')
            ->add('etagesa')
            ->add('typesa', ChoiceType::class, [
                'choices' => [
                    'Soin' => 'soin',
                    'Operation' => 'operation'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Type de salle',
                'constraints' => [
                    new NotBlank(['message' => 'Type de la salle requis !']),
                    new Choice(['choices' => ['soin', 'operation'], 'message' => 'Le type de salle doit être "soin" ou "operation".'])
                ],
                'attr' => ['class' => 'form-check-input'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salle::class,
        ]);
    }
}
