<?php

namespace App\Form;

use App\Entity\HomeBrew;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\BrewDataType;


class HomeBrewType extends AbstractType
{

    /**
     * @throws \JsonException
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name')
            ->add('glass', ChoiceType::class, [
                'choices' => $options['glass_options']
            ])
            ->add('instructions', TextareaType::class)
            ->add('ingredientsAndMeasurements', CollectionType::class, [
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_type' => BrewDataType::class,
                    'entry_options' => [
                        'label' => 'add to mix'
                    ],
                    'label' => 'Add ingredient',
                    'prototype'=>true,

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $glassOptions = [];
        $glasses = json_decode(file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/list.php?g=list'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($glasses['drinks'] as $glass) {
            $glassOptions[$glass['strGlass']] = $glass['strGlass'];
        }
        asort($glassOptions);

        $resolver->setDefaults([
            'data_class' => HomeBrew::class,
            'glass_options' => $glassOptions,
        ]);
    }
}
