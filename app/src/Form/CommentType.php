<?php
/**
 * Comment form type.
 */

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form used for creating comments.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the comment form.
     *
     * @param FormBuilderInterface $builder Form builder.
     * @param array<string, mixed> $options Form options.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nickname')
            ->add('content');
    }

    /**
     * Configures form options.
     *
     * @param OptionsResolver $resolver Options resolver.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
