<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('age', NumberType::class)
            ->add('url', UrlType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('locale', LocaleType::class)
            ->add('country', CountryType::class)
            ->add('married', CheckboxType::class)
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datepicker',
                ],
            ])
            ->add('hobby', TextareaType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Complete the questionnaire',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
