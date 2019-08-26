<?php

namespace App\Form;

use App\Entity\Videostore;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VideostoreType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            ->add(
                'website', 
                TextType::class, 
                $this->getConfiguration("Site web","Adresse URL")
            )
            ->add(
                'embed', 
                TextType::class, 
                $this->getConfiguration("Intégration","Début de l'URL d'intégration")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Videostore::class,
        ]);
    }
}