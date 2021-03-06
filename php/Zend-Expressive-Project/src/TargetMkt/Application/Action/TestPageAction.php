<?php

namespace TargetMkt\Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template;
use TargetMkt\Domain\Entity\Address;
use TargetMkt\Domain\Entity\Client;
use TargetMkt\Domain\Entity\Customer;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;

class TestPageAction
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
        $customer = new Customer();
        $customer->setName('joao');
        $customer->setEmail('joao@user.com');
        $customers = $this->repository->findAll();

        return new HtmlResponse($this->template->render('app::test-page', ['customers' => $customers]));
    }
}
