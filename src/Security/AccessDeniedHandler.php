<?php
/**
 * Created by PhpStorm.
 * User: X3900147
 * Date: 04/06/2018
 * Time: 15:37
 */

namespace App\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

/**
 * Class AccessDeniedHandler
 * @package App\Security
 */
class AccessDeniedHandler implements AccessDeniedHandlerInterface
{

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Session|SessionInterface
     */
    private $session;

    /**
     * AccessDeniedHandler constructor.
     * @param RouterInterface $router
     * @param SessionInterface $session
     */
    public function __construct(RouterInterface $router, SessionInterface $session)
    {
        $this->router = $router;
        $this->session = ($session) ?? new Session();
    }

    /**
     * Handles an access denied failure.
     *
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     * @return RedirectResponse
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse
    {
        $this->session->getFlashBag()->add('danger', $accessDeniedException->getMessage());
        return new RedirectResponse($this->router->generate('acme_index'));
    }
}