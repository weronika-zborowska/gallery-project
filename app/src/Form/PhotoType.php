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

/**
 * Form used for managing photos.
 */
class PhotoType extends AbstractType
{
    /**
     * Builds the photo form.
     *
     * @param FormBuilderInterface $builder Form builder.
     * @param array<string, mixed> $options Form options.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('imageFile', FileType::class, [
                'label' => 'Zdjęcie',
                'mapped' => false,
                'required' => false,
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
     * @param OptionsResolver $resolver Options resolver.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
