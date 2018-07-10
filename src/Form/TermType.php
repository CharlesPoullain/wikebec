<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Term;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TermType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('term', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Nom du nouveau terme")
                )
            ->add('slug', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Identifiant du nouveau terme")
            )
            ->add('definition1', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Définition du terme"))
            ->add('definition2', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Autre définition"))
            ->add('example', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Exemple concret"))
            ->add('translation', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Traduction française"))
            ->add('variation', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Variation"))
            ->add('pronunciation', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Prononciation"))
            ->add('origin', null,
                array(
                    'attr' => array(
                        'placeholder' => '...',
                    ),
                    "label" => "Origin du terme"))
            ->add('category',  EntityType::class, array(
                'class' => Categorie::class,
                "label" => "Catégorie du terme"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Term::class,
        ]);
    }
}
