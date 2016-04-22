<?php

namespace NS\Bundle\CoreBundle\Form\Type;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CustomerType
 */
class CustomerType extends CustomerProfileType
{
    /**
     * @var EventSubscriberInterface
     */
    private $addUserFormSubscriber;

    /**
     * @param string $dataClass
     * @param string[] $validationGroups
     * @param EventSubscriberInterface $addUserFormSubscriber
     */
    public function __construct($dataClass, array $validationGroups = [], EventSubscriberInterface $addUserFormSubscriber)
    {
        parent::__construct($dataClass, $validationGroups);
        $this->addUserFormSubscriber = $addUserFormSubscriber;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('groups', 'ns_group_choice', [
                'label' => 'sylius.form.customer.groups',
                'multiple' => true,
                'required' => false,
            ])
            ->addEventSubscriber($this->addUserFormSubscriber)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'validation_groups' => $this->validationGroups,
            'cascade_validation' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ns_customer';
    }
}
