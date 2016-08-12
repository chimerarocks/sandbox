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
use TargetMkt\Application\Form\CustomerForm;
use TargetMkt\Application\Form\HttpMethodElement;

class CustomerDeletePageAction
{
    private $template;
    private $repository;
    private $router;
    private $form;

    public function __construct(
        CustomerRepositoryInterface $repository, 
        Template\TemplateRendererInterface $template, 
        RouterInterface $router,
        CustomerForm $form)
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
    	$id = $request->getAttribute('id');
    	$entity = $this->repository->find($id);

        $this->form->add(new HttpMethodElement('DELETE'));
        $this->form->bind($entity);

        if (strtoupper($request->getMethod()) == 'DELETE') {
            $flash = $request->getAttribute('flash');
            $this->repository->remove($entity);
            $flash->setMessage('success', 'Contato removido com sucesso');
            
            return new RedirectResponse(
                $this->router->generateUri('customer.list')
            );
        }

        return new HtmlResponse($this->template->render('app::customer/delete', ['form' => $this->form]));
    }
}
