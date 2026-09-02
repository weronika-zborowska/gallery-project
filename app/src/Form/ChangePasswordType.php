<?php

/**
 * Change password form type.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form used for changing user password.
 */
class ChangePasswordType extends AbstractType
{
    /**
     * Builds the change password form.
     *
     * @param FormBuilderInterface $builder form builder
     * @param array<string, mixed> $options form options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Aktualne hasło',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'Nowe hasło',
                ],
                'second_options' => [
                    'label' => 'Powtórz nowe hasło',
                ],
                'invalid_message' => 'Podane hasła muszą być takie same.',
            ]);
    }

    /**
     * Configures form options.
     *
     * @param OptionsResolver $resolver options resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
