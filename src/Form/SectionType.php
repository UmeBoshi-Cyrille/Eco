<?php

namespace App\Form;

use App\Entity\Section;
use App\entity\Lesson;
use App\Form\LessonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Section title'
            ])
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('lessons', CollectionType::class, [
                'label' => false,
                'entry_type' => LessonType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => '_les_'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
