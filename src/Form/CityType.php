<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Borough;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CityType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Nom de la ville","Taper le nom d'une ville")
            )
            ->add(
                'borough', 
                EntityType::class,
                $this->getConfiguration("Arrondissement","Associer à un arrondissement", [
                    'class' => Borough::class,
                    'choice_label' => 'name'
                ])
            )
            ->add(
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description", [
                    'required' => false
                ])
            )
            ->add(
                'coatOfArms', 
                TextType::class, 
                $this->getConfiguration("Image du blason","URL du blason", [
                    'required' => false
                ])
            )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}