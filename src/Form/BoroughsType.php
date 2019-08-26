<?php

namespace App\Form;

use App\Entity\Borough;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoroughsType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
            $builder
            ->add(
                'name', 
                EntityType::class,
                $this->getConfiguration("Arrondissement","Choisir un arrondissement", [
                    'class' => Borough::class,
                    'choice_label' => 'name'
                ])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borough::class,
        ]);
    }
}