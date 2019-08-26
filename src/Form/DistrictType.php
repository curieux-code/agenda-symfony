<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\District;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DistrictType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Nom de la quartier","Taper le nom d'un quartier")
            )
            ->add(
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description", [
                    'required' => false
                ])
            )
            ->add(
                'city', 
                EntityType::class,
                $this->getConfiguration("Ville","Choisir un ville", [
                    'class' => City::class,
                    'choice_label' => 'name'
                ])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => District::class,
        ]);
    }
}