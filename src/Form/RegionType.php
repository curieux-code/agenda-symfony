<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Country;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegionType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Nom de la région","Taper le nom d'une région")
            )
            ->add(
                'country', 
                EntityType::class,
                $this->getConfiguration("Pays","Associer à un pays", [
                    'class' => Country::class,
                    'choice_label' => 'name'
                ])
            )        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}