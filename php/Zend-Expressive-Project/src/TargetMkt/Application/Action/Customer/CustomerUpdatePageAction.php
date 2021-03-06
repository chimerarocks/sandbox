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

class CustomerUpdatePageAction
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

    	$this->form->add(new HttpMethodElement('PUT'));
    	$this->form->bind($entity);

        if (strtoupper($request->getMethod()) == 'PUT') {
        	$dataRow = $request->getParsedBody();
        	$this->form->setData($dataRow);
        	if ($this->form->isValid()) {
	            $entity = $this->form->getData();
	            $this->repository->update($entity);
	            $flash = $request->getAttribute('flash');
	            $flash->setMessage('success', 'Contato atualizado com sucesso');
	            
	            return new RedirectResponse(
	                $this->router->generateUri('customer.list')
	            );
        	}
        }

        return new HtmlResponse($this->template->render('app::customer/update', ['form' => $this->form]));
    }
}
