<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

/**
 * Class MenuBuilder
 * @package AppBundle\Menu
 */
class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        $menu->addChild('Acme', array('route' => 'acme_index'));
        $menu->addChild('Acme parent', array('route' => 'acme_parent_index'));

        foreach ($menu as $child) {
            $child->setAttribute('class', 'nav-item')->setLinkAttribute('class', 'nav-link');
        }

        return $menu;
    }
}