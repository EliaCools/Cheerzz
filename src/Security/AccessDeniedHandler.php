<?php


namespace App\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private UrlGeneratorInterface $urlGenerator;

    /**
     * AccessDeniedHandler constructor.
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse|Response|null
    {
        $request->getSession()->getFlashBag()->add('note', 'Access Denied');

        return new RedirectResponse($this->urlGenerator->generate('home'));

    }
}
