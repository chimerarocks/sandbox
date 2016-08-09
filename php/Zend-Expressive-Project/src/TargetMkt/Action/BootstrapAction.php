<?php

namespace TargetMkt\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TargetMkt\Service\BootstrapInterface;

class BootstrapAction
{
    public function __construct(BootstrapInterface $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->bootstrap->create();
        return $next($request, $response);
    }
}
