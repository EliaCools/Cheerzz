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
                'attr'=>['placeholder'=>'enter an amount','pattern'=>'[0-9]|[1-9][0-9]|[1-9][0-9][0-9]'],
            ])->add('metric', ChoiceType::class, [
                'label' => 'metric',
                'required'=>false,
                'choices' => [
                    'ml' => 'ml',
                    'cl' => 'cl',
                    'part' => 'part',
                    'oz' => 'oz',],
                'attr'=>['placeholder'=>'ml'],
                'attr'=>['placeholder'=>'ml'],
            ])
            ->add('ingredient', TextType::class, [
                'label' => 'ingredient',
                'required'=>false,
                'attr'=>[
                    'autocomplete'=>'off',
                    'class'=>'find_ingredient',
                    'list'=>'ingredient_suggestion',
                    'placeholder'=>'search for ingredient',
                    'required'=>true
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
