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
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description")
            )
            ->add(
                'coverImage',
                TextType::class,
                $this->getConfiguration("Image","Ajouter une image", [
                    'required' => false
                ])
            )
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            ->add(
                'number', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            ->add(
                'address', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
