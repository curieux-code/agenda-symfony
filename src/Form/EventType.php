<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\Rubric;
use App\Form\ImageType;
use App\Form\VideoType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class EventType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', 
                TextType::class, 
                $this->getConfiguration("Titre","Taper un titre")
            )
            /*
            ->add(
                'slug', 
                TextType::class, 
                $this->getConfiguration("Slug","Adresse Web", [
                    'required' => false
                ])
            )
            */
            ->add(
                'rubric', 
                EntityType::class,
                $this->getConfiguration("Rubrique","Choisir une rubrique", [
                    'class' => Rubric::class,
                    'choice_label' => 'name',
                    'placeholder' => 'Choisir une rubrique...'
                ])
            )
            ->add(
                'place', 
                EntityType::class,
                $this->getConfiguration("Lieu","Choisir un lieu", [
                    'class' => Place::class,
                    'choice_label' => 'name',
                    'placeholder' => 'Choisir un lieu...'
                ])
            )
            ->add(
                'dateStart', 
                DateType::class, 
                $this->getConfiguration('Date de début','JJ/MM/AAAA', [
                    'widget' => 'single_text'
                ])
            )
            ->add(
                'dateEnd', 
                DateType::class, 
                $this->getConfiguration('Date de fin',"JJ/MM/AAAA", [
                    'required' => false,
                    'widget' => 'single_text'
                ])
            )
            ->add(
                'timeStart', 
                TimeType::class, 
                $this->getConfiguration("Horaire de début","HH:MM", [
                    'required' => false,
                    'widget' => 'single_text'
                ])
            )
            ->add(
                'timeEnd', 
                TimeType::class, 
                $this->getConfiguration("Horaire de fin","HH:MM", [
                    'required' => false,
                    'widget' => 'single_text'
                ])
            )
            ->add(
                'description',
                TextareaType::class, 
                $this->getConfiguration("Description","Taper un description")
            )
            ->add(
                'price',
                ChoiceType::class, // IntegerType pour un entier
                $this->getConfiguration("Tarif","Prix", [
                    'choices'  => [
                        'Tarif non communiqué' => 22,
                        'Entrée libre' => 0,
                        'Prix libre' => 0.01,
                        '1 Euro' => 1,
                        '2 Euros' => 2,
                        '3 Euros' => 3,
                        '4 Euros' => 4,
                        '5 Euros' => 5,
                        '6 Euros' => 6,
                        '7 Euros' => 7,
                        '8 Euros' => 8,
                        '9 Euros' => 9,
                        '10 Euros' => 10,
                        '11 Euros' => 11,
                        '12 Euros' => 12,
                        '13 Euros' => 13,
                        '14 Euros' => 14,
                        '15 Euros' => 15,
                        '16 Euros' => 16,
                        '17 Euros' => 17,
                        '18 Euros' => 18,
                        '19 Euros' => 19,
                        '20 Euros' => 20,
                        'Plus de 20 Euros' => 21
                    ]
                ]) 
            )
            ->add(
                'coverImage',
                TextType::class,
                $this->getConfiguration("Image","Ajouter une image", [
                    'required' => false
                ])
            )
            ->add(
                'videos',
                CollectionType::class,
                [
                    'entry_type' => VideoType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
