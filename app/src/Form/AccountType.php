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
     * @param FormBuilderInterface $builder Form builder.
     * @param array<string, mixed> $options Form options.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email');
    }

    /**
     * Configures form options.
     *
     * @param OptionsResolver $resolver Options resolver.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
