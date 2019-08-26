<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Postcode;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostcodeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'code', 
                TextType::class, 
                $this->getConfiguration("Numéro du code postal","Taper le code postal")
            )
            ->add(
                'city', 
                EntityType::class,
                $this->getConfiguration("Associer à une ville","Choisir un ville", [
                    'class' => City::class,
                    'choice_label' => 'name'
                ])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Postcode::class,
        ]);
    }
}