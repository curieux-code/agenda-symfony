<?php

namespace App\Form;

use App\Entity\Festival;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FestivalType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            ->add(
                'coverImage',
                TextType::class,
                $this->getConfiguration("Image","Ajouter une image", [
                    'required' => false
                ])
            )
            ->add(
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}
