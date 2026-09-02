<?php

/**
 * Gallery form type.
 */

namespace App\Form;

use App\Entity\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form used for managing galleries.
 */
class GalleryType extends AbstractType
{
    /**
     * Builds the gallery form.
     *
     * @param FormBuilderInterface $builder form builder
     * @param array<string, mixed> $options form options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '',
            ])
            ->add('description')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ]);
    }

    /**
     * Configures form options.
     *
     * @param OptionsResolver $resolver options resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class,
        ]);
    }
}
