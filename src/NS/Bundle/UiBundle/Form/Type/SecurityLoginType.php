<?php

namespace NS\Bundle\UiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SecurityLoginType
 */
class SecurityLoginType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', 'text', [
                'label' => 'ns.form.login.username',
            ])
            ->add('_password', 'password', [
                'label' => 'ns.form.login.password',
            ])
            ->add('_remember_me', 'checkbox', [
                'label' => 'ns.form.login.remember_me',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ns_security_login';
    }
}
