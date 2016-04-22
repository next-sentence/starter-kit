<?php

namespace NS\Bundle\UiBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserRegistrationType
 */
class UserRegistrationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'first_options' => ['label' => 'ns.form.user.password.label'],
                'second_options' => ['label' => 'ns.form.user.password.confirmation'],
                'invalid_message' => 'ns.user.plainPassword.mismatch',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ns_user_registration';
    }
}
