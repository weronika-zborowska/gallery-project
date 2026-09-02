<?php

/**
 * Account form type.
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form used for editing user account data.
 */
class AccountType extends AbstractType
{
    /**
     * Builds the account form.
     *
     * @param FormBuilderInterface $builder form builder
     * @param array<string, mixed> $options form options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email');
    }

    /**
     * Configures form options.
     *
     * @param OptionsResolver $resolver options resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
