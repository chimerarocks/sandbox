<?php

namespace TargetMkt\Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TargetMkt\Application\Form\LoginForm;
use TargetMkt\Domain\Service\AuthInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class LoginPageAction
{
    private $router;
    private $template;
    private $form;
    private $auth;

    public function __construct(
        Router\RouterInterface $router, 
        Template\TemplateRendererInterface $template,
        LoginForm $form,
        AuthInterface $auth)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->form = $form;
        $this->auth = $auth;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $this->form->setData($data);
            if ($this->form->isValid()) {
                $user = $this->form->getData();
                if ($this->auth->authenticate($user['email'], $user['password'])) {
                    return new RedirectResponse(
                        $this->router->generateUri('customer.list')
                    );
                }
            }
        }

        return new HtmlResponse($this->template->render('app::login-page', ['form' => $this->form]));
    }
}
