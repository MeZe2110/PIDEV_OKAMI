<?php

namespace App\Form;

use App\Entity\Vehicules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
            ->add('imagesvh', FileType::class, ['label'=>'Image', 'mapped'=>false, 'required'=>false]);
            }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicules::class,
        ]);
    }
}
