<?php

namespace App\Form\Type;

use App\Form\Model\TranslationDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Used to capture/validates User data request for Translations
 */
class TranslationFormType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ) {
        $builder
            ->add('key_id', IntegerType::class, [ 'invalid_message' => 'You must pass a valid Key identifier'])
            ->add('language_id', IntegerType::class, [ 'invalid_message' => 'You must pass a valid language code'])
            ->add('translation', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TranslationDto::class
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function getName()
    {
        return '';
    }
}
