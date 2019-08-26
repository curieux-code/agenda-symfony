<?php

namespace App\Form;

use App\Entity\Reduction;
use App\Form\BoroughType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ReductionType extends ApplicationType
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
                'boroughs',
                CollectionType::class,
                [
                    'entry_type' => BoroughsType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reduction::class,
        ]);
    }
}
