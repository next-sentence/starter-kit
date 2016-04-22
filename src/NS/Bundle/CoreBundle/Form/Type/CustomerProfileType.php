<?php

namespace NS\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CustomerProfileType
 */
class CustomerProfileType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('firstName', 'text', [
                'label' => 'ns.form.customer.first_name',
            ])
            ->add('lastName', 'text', [
                'label' => 'ns.form.customer.last_name',
            ])
            ->add('email', 'email', [
                'label' => 'ns.form.customer.email',
            ])
            ->add('birthday', 'birthday', [
                'label' => 'ns.form.customer.birthday',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('gender', 'ns_gender', [
                'label' => 'ns.form.customer.gender',
            ])
            ->add('phoneNumber', 'text', [
                'required' => false,
                'label' => 'ns.form.customer.phone_number',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ns_customer_profile';
    }
}
