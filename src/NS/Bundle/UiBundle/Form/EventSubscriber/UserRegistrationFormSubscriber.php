<?php

namespace NS\Bundle\UiBundle\Form\EventSubscriber;

use NS\Bundle\CoreBundle\Entity\Customer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class UserRegistrationFormSubscriber
 */
class UserRegistrationFormSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'submit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function submit(FormEvent $event)
    {
        $customer = $event->getData();
        if (!$customer instanceof Customer) {
            throw new UnexpectedTypeException($customer, Customer::class);
        }

        if (null !== $user = $customer->getUser()) {
            $user->setEnabled(true);
        }
    }
}
