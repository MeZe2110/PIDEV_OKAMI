<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\Extension\Core\Type as Type;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
        ->add('email')
        ->add('password')
        ->add('nom')
        ->add('prenom')
        ->add('role')
        ->add('phone_number')     
        ->add('password')
        ->add('Save', Type\SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn'],
        ]);
        // ->add('captcha', Recaptcha3Type::class, [
        //     'constraints' => new Recaptcha3(),
        //     'action_name' => 'user',
            
        // ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
