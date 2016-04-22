<?php

namespace NS\Bundle\UiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Frontend homepage controller.
 */
class HomepageController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @param EngineInterface $templatingEngine
     */
    public function __construct(EngineInterface $templatingEngine)
    {
        $this->templatingEngine = $templatingEngine;
    }

    /**
     * Store front page.
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->templatingEngine->renderResponse('NSUiBundle:Homepage:index.html.twig');
    }
}
