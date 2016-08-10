<?php

namespace TargetMkt\Application\Action\Customer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;
use TargetMkt\Domain\Entity\Customer;

class CustomerCreatePageAction
{
    private $template;
    private $repository;
    private $router;

    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template, RouterInterface $router)
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if (strtoupper($request->getMethod()) == 'POST') {
            $data = $request->getParsedBody();
            $entity = new Customer();
            $entity
                ->setName($data['name'])
                ->setEmail($data['email'])
            ;
            $this->repository->create($entity);
            $flash = $request->getAttribute('flash');
            $flash->setMessage('success', 'Contato cadastrado com sucesso');
            
            return new RedirectResponse(
                $this->router->generateUri('customer.list')
            );
        }
        return new HtmlResponse($this->template->render('app::customer/create'));
    }
}
