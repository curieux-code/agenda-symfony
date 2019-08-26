<?php

namespace App\Form;

use App\Entity\Borough;
use App\Entity\Department;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BoroughType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Nom de l'arrondissement","Taper le nom d'un arrondissement")
            )
            ->add(
                'resident', 
                TextType::class, 
                $this->getConfiguration("Nom des habitants","Taper le nom des habitants (au masculin singulier)")
            )
            ->add(
                'chiefTown', 
                TextType::class, 
                $this->getConfiguration("Nom du chef-lieu","Taper le nom du chef-lieu")
            )
            ->add(
                'department', 
                EntityType::class,
                $this->getConfiguration("Département","Associer à un département", [
                    'class' => Department::class,
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