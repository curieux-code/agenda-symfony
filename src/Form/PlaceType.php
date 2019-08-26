<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('coverImage')
            ->add('slug')
            ->add('latitude')
            ->add('longitude')
            ->add('pronoun')
            ->add('name')
            ->add('number')
            ->add('address')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('city')
            ->add('district')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
