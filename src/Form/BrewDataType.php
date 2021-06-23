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
                'label'=>false,
                'required'=>false,
                'attr'=>['placeholder'=>'enter an amount','pattern'=>'[0-9]|[1-9][0-9]|[1-9][0-9][0-9]','class' => 'col-5'],
            ])->add('metric', ChoiceType::class, [
                'empty_data'=>null,
                'placeholder'=>'set a metric',
                'label'=>false,
                'required'=>false,
                'choices' => $options['metrics'],
                'attr'=>['class' => 'col-5'],
            ])
            ->add('ingredient', TextType::class, [
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'autocomplete'=>'off',
                    'class'=>'find_ingredient col-5',
                    'list'=>'ingredient_suggestion',
                    'placeholder'=>'search for ingredient',
                    'required'=>true,
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'metrics' => [
                'ml' => 'ml',
                'cl' => 'cl',
                'part' => 'part',
                'oz' => 'oz',
            ]
        ]);
    }
}
