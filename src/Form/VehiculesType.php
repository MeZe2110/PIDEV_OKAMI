<?php

namespace App\Form;

use App\Entity\Vehicules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class VehiculesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomvh')
            ->add('dispovh')
            ->add('etatvh')
            ->add('descvh')
            ->add('catv')
            ->add('imagesvh', FileType::class, ['label'=>'Image', 'mapped'=>false, 'required'=>false])
            ->add('date', DateTimeType::class, [
                'label' => 'Choisissez votre date de début ',
                'required' => true ,
                'data' => new \DateTime(),
                'widget' => 'single_text',
                
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date et l\'heure doivent être supérieures ou égales à la date actuelle.',
                    ]),
                ],
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d\TH:i'),
                    'class' => 'form-control datetimepicker-input',
                ],
               
            ]);
         }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicules::class,
        ]);
    }
}
