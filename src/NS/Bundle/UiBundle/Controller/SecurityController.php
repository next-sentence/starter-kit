<?php

namespace NS\Bundle\UiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 */
final class SecurityController
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param FormFactoryInterface $formFactory
     * @param EngineInterface $templatingEngine
     */
    public function __construct(AuthenticationUtils $authenticationUtils, FormFactoryInterface $formFactory, EngineInterface $templatingEngine)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->formFactory = $formFactory;
        $this->templatingEngine = $templatingEngine;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $lastError = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();

        $template = $request->attributes->get('_sylius[template]', 'NSUiBundle:Security:login.html.twig', true);
        $formType = $request->attributes->get('_sylius[form]', 'ns_security_login', true);
        $form = $this->formFactory->createNamed('', $formType);

        return $this->templatingEngine->renderResponse($template, [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'last_error' => $lastError,
        ]);
    }

    /**
     * @param Request $request
     */
    public function checkAction(Request $request)
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * @param Request $request
     */
    public function logoutAction(Request $request)
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall.');
    }
}
