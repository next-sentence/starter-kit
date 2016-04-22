<?php

namespace NS\Bundle\AdminBundle\Menu;

use Knp\Menu\ItemInterface;
use NS\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

/**
 * Class MainMenuBuilder
 */
final class MainMenuBuilder extends AbstractAdminMenuBuilder
{
    const EVENT_NAME = 'ns.menu.admin.main';

    /**
     * @return ItemInterface
     */
    public function createMenu()
    {
        $menu = $this->factory->createItem('root');

        $this->addConfigurationMenu($menu);

        $this->eventDispatcher->dispatch(self::EVENT_NAME, new MenuBuilderEvent($this->factory, $menu));

        return $menu;
    }

    /**
     * @param ItemInterface $menu
     */
    private function addConfigurationMenu(ItemInterface $menu)
    {
        $this->configureConfigurationSubMenu($menu);
    }

    /**
     * @param ItemInterface $menu
     */
    private function configureConfigurationSubMenu(ItemInterface $menu)
    {
        $configurationSubMenu = $menu
            ->addChild('configuration')
            ->setLabel('ns.menu.admin.main.configuration.header')
        ;

        $configurationSubMenu
            ->addChild('users', ['route' => 'ns_admin_dashboard'])
            ->setLabel('ns.menu.admin.main.configuration.users')
            ->setLabelAttribute('icon', 'tags')
        ;
    }
}
