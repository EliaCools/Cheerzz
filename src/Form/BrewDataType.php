<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrewDataType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('measurement', TextType::class, [
                'label' => 'amount',
                'required'=>false,
            ])->add('metric', ChoiceType::class, [
                'label' => 'metric',
                'required'=>false,
                'placeholder'=>'?',
                'choices' => [
                    'ml' => 'ml',
                    'cl' => 'cl',
                    'part' => 'part',
                    'oz' => 'oz',
                ],
            ])
            ->add('ingredient', TextType::class, [
                'label' => 'ingredient',
                'required'=>false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
