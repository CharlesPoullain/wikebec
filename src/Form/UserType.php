<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
                array(
                    'attr' => array(
                        'placeholder' => 'Email',
                    ))
            )
            ->add('username', null,
                array(
                    'attr' => array(
                        'placeholder' => 'Nom d\'utilisateur',
                    )),
                ["label" => "Nom d'utilisateur"]
            )
            ->add('password', PasswordType::class, array(
                    'attr' => array(
                        'placeholder' => '******',
                    ))
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
