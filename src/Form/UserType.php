<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('firstName',TextType::class,[
                'required'=> false,
            ])
            ->add('lastName',TextType::class,[
                'required'=> false,
            ])
            ->add('email', TextType::class,[
                'required'=> false,
            ])
            ->add('telephone',TextType::class,[
                'required'=> false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required'=> false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            
            /*->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'required' => false,
                
                
            ])*/
           
            ;
         
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
