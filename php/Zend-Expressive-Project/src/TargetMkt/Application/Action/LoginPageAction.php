<?php

namespace TargetMkt\Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TargetMkt\Application\Form\LoginForm;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class LoginPageAction
{
    private $router;
    private $template;
    private $form;

    public function __construct(
        Router\RouterInterface $router, 
        Template\TemplateRendererInterface $template,
        LoginForm $form)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        return new HtmlResponse($this->template->render('app::login-page', ['form' => $this->form]));
    }
}
