<?php

namespace NS\Bundle\CoreBundle\Form\Type;

use NS\Bundle\CoreBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GenderType
 */
class GenderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                Customer::UNKNOWN_GENDER => ' ',
                Customer::MALE_GENDER => 'ns.gender.male',
                Customer::FEMALE_GENDER => 'ns.gender.female',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ns_gender';
    }
}
