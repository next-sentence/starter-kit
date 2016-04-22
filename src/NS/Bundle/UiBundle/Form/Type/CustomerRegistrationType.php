<?php

namespace NS\Bundle\UiBundle\Form\Type;

use NS\Bundle\UiBundle\Form\EventSubscriber\CustomerRegistrationFormSubscriber;
use NS\Bundle\UiBundle\Form\EventSubscriber\UserRegistrationFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CustomerRegistrationType
 */
class CustomerRegistrationType extends AbstractResourceType
{
    /**
     * @var RepositoryInterface
     */
    private $customerRepository;

    /**
     * @param string              $dataClass
     * @param array               $validationGroups
     * @param RepositoryInterface $customerRepository
     */
    public function __construct($dataClass, array $validationGroups, RepositoryInterface $customerRepository)
    {
        parent::__construct($dataClass, $validationGroups);

        $this->customerRepository = $customerRepository;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('email', 'email', [
                'label' => 'ns.form.customer.email',
            ])
            ->add('user', 'ns_user_registration', [
                'label' => false,
            ])
            ->add('firstName', 'text', [
                'label' => 'ns.form.customer.first_name',
            ])
            ->add('lastName', 'text', [
                'label' => 'ns.form.customer.last_name',
            ])
            ->add('phoneNumber', 'text', [
                'label' => 'ns.form.customer.phone_number',
            ])
            ->addEventSubscriber(new CustomerRegistrationFormSubscriber($this->customerRepository))
            ->addEventSubscriber(new UserRegistrationFormSubscriber())
            ->setDataLocked(false)
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
        return 'ns_customer_registration';
    }
}
