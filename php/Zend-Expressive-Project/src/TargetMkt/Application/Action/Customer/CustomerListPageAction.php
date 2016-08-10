<?php

namespace TargetMkt\Application\Action\Customer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;

class CustomerListPageAction
{
    private $template;
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customers = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        $message = $flash->getMessage('success');
        
        return new HtmlResponse($this->template->render('app::customer/list', [
            'customers' => $customers,
            'message' => $message
        ]));
    }
}
