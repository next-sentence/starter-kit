<?php

namespace NS\Bundle\CoreBundle\Controller;

use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use NS\Bundle\CoreBundle\Entity\Customer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CustomerController
 */
class CustomerController extends ResourceController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function showProfileAction(Request $request)
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $customer = $this->getCustomer();

        return $this->container->get('templating')->renderResponse(
            $configuration->getTemplate('showProfile.html'),
            [$this->metadata->getName() => $customer]
        );
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function updateProfileAction(Request $request)
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $customer = $this->getCustomer();
        $form = $this->resourceFormFactory->create($configuration, $customer);

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH']) && $form->submit($request, !$request->isMethod('PATCH'))->isValid()) {
            $this->eventDispatcher->dispatchPreEvent(ResourceActions::UPDATE, $configuration, $customer);
            $this->manager->flush();
            $this->eventDispatcher->dispatchPostEvent(ResourceActions::UPDATE, $configuration, $customer);

            if (!$configuration->isHtmlRequest()) {
                return $this->viewHandler->handle(View::create($customer, 204));
            }

            $this->flashHelper->addSuccessFlash($configuration, ResourceActions::UPDATE, $customer);

            return $this->redirectHandler->redirectToResource($configuration, $customer);
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle(View::create($form, 400));
        }

        return $this->container->get('templating')->renderResponse(
            $configuration->getTemplate('updateProfile.html'),
            [
                $this->metadata->getName() => $customer,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @return Customer
     *
     * @throws AccessDeniedException - When user is not logged in.
     */
    protected function getCustomer()
    {
        $customer = $this->container->get('ns.context.customer')->getCustomer();

        if (null === $customer) {
            throw new AccessDeniedException('You have to be logged in user to access this section.');
        }

        return $customer;
    }
}
