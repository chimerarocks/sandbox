<?php

namespace TargetMkt\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TargetMkt\Domain\Service\BootstrapInterface;
use TargetMkt\Domain\Service\FlashMessageInterface;

class BootstrapMiddleware
{

	private $bootstrap;

	private $flash;

    public function __construct(BootstrapInterface $bootstrap, FlashMessageInterface $flash)
    {
        $this->bootstrap = $bootstrap;
        $this->flash = $flash;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->bootstrap->create();
        $request = $request->withAttribute('flash', $this->flash);
        return $next($request, $response);
    }
}
