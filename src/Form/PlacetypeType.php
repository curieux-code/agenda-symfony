<?php

namespace App\Form;

use App\Entity\Placetype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PlacetypeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Type de lieu","Taper un nouveau type")
            )
            ->add(
                'plural', 
                TextType::class, 
                $this->getConfiguration("Pluriel","Indiquer le pluriel")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Placetype::class,
        ]);
    }
}
