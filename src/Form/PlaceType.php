<?php

namespace App\Form;

use App\Entity\Place;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlaceType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add(
                'title', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            ->add(
                'coverImage',
                TextType::class,
                $this->getConfiguration("Image","Ajouter une image", [
                    'required' => false
                ])
            )
            ->add(
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description")
            )
        ;

        /*
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
        */
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
