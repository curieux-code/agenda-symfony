<?php

namespace App\Form;

use App\Entity\Ticketing;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketingType extends ApplicationType
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
                $this->getConfiguration("Intégration","Début de l'URL d'intégration", [
                    'required' => false
                ])
            )
            ->add(
                'setting', 
                ChoiceType::class, 
                $this->getConfiguration("Configuration","Indiquer un paramètre ", [
                    'choices'  => [
                        'Lien direct' => 1,
                        'Intégration' => 2,
                        'Désactivation' => 0
                    ]
                ])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticketing::class,
        ]);
    }
}
