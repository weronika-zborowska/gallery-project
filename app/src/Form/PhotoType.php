<?php

/**
 * Photo form type.
 */

namespace App\Form;

use App\Entity\Gallery;
use App\Entity\Photo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

/**
 * Form used for managing photos.
 */
class PhotoType extends AbstractType
{
    /**
     * Builds the photo form.
     *
     * @param FormBuilderInterface $builder form builder
     * @param array<string, mixed> $options form options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('imageFile', FileType::class, [
                'label' => 'Zdjęcie',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        mimeTypesMessage: 'Możesz przesłać tylko plik graficzny JPG, PNG lub WEBP.',
                        maxSizeMessage: 'Plik jest zbyt duży. Maksymalny rozmiar to 5 MB.'
                    ),
                ],
            ])
            ->add('title')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('gallery', EntityType::class, [
                'class' => Gallery::class,
                'choice_label' => 'title',
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
            'data_class' => Photo::class,
        ]);
    }
}
