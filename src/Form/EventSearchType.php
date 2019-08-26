<?php

namespace App\Form;

use App\Entity\Rubric;
use App\Entity\EventSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EventSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Tarif maximal'
                ]
            ])
/*
            ->add('searchDate', DateType::class, [
                //'widget' => 'single_text',
                'required' => false,
                'label' => false,
                'attr' => [
                    
                    'placeholder' => 'Date'
                ]
            ])   

            
            ->add('searchRubric', EntityType::class, [
                'class' => Rubric::class,
                'required' => false,
                'label' => false,
                'attr' => [
                    'choice_label' => 'name',
                    'placeholder' => 'Tarif maximal'
                ]
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
