<?php

namespace App\Form;

use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomst')
            ->add('quantites')
            ->add('dateexpirationst', DateType::class, [
                'required' => true,
                'data' => new \DateTimeImmutable(),
                'widget' => 'single_text',
                
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        
                    ]),
                ],
                'attr' => [
                    'min' => (new \DateTimeImmutable())->format('Y-m-d'),
                    'class' => 'form-control',
                ],
            ])
            
            
            ->add('description')
            ->add('stockcat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
