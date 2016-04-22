<?php

namespace NS\Bundle\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use NS\Bundle\UiBundle\Menu\AbstractMenuBuilder;
use Sylius\Component\Rbac\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AbstractAdminMenuBuilder
 * @package Sylius\Bundle\AdminBundle\Menu
 */
abstract class AbstractAdminMenuBuilder extends AbstractMenuBuilder
{
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

//    /**
//     * @param FactoryInterface $factory
//     * @param EventDispatcherInterface $eventDispatcher
//     * @param AuthorizationCheckerInterface $authorizationChecker
//     */
//    public function __construct(
//        FactoryInterface $factory,
//        EventDispatcherInterface $eventDispatcher,
//        AuthorizationCheckerInterface $authorizationChecker
//    ) {
//        parent::__construct($factory, $eventDispatcher);
//
//        $this->authorizationChecker = $authorizationChecker;
//    }
}
