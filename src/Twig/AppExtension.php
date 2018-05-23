<?php
/**
 * Created by PhpStorm.
 * User: X3900147
 * Date: 19/04/2018
 * Time: 14:20
 */

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class AppExtension
 * @package App\Twig
 */
class AppExtension extends AbstractExtension
{
    /**
     * @var RequestStack
     */
    protected $request;

    /**
     * AppExtension constructor.
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('active', array($this, 'isActiveFunction')),
            new TwigFunction('locale', array($this, 'isLocaleFunction')),
        );
    }

    /**
     * Used in twig with {{ active('name_of_route') }}, it will return active if the link given match the current route
     * $Link can be string or array (useful for dropdown)
     *
     * @param string|array $link
     * @return string
     */
    public function isActiveFunction($link): string
    {
        $route = $this->request->getCurrentRequest()->get('_route');
        return (in_array($route, (array)$link)) ? 'active' : '';
    }

    /**
     * Used in twig with {{ locale('locale_language') }}, it will return active if the locale given match the current user locale
     *
     * @param string $locale
     * @return string
     */
    public function isLocaleFunction(string $locale): string
    {
        return ($locale === $this->request->getCurrentRequest()->getLocale()) ? 'active' : '';
    }
}