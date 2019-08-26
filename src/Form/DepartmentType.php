<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Region;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DepartmentType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Nom du département","Taper le nom d'un département")
            )
            ->add(
                'code', 
                TextType::class, 
                $this->getConfiguration("Code du département","Taper le code à 2 lettres")
            )
            ->add(
                'region', 
                EntityType::class,
                $this->getConfiguration("Région","Associer à une région", [
                    'class' => Region::class,
                    'choice_label' => 'name'
                ])
            )        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Department::class,
        ]);
    }
}