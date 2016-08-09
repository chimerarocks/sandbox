<?php

namespace TargetMkt\Application\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Doctrine\ORM\EntityManager;
use TargetMkt\Domain\Entity\Address;
use TargetMkt\Domain\Entity\Client;

class TestPageAction
{
    private $template;
    private $em;

    public function __construct(EntityManager $em, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
    	$address1 = new Address();

    	$address1->setCep('9999991');
    	$address1->setStreet('Rua 1');
    	$address1->setCity('City 1');
    	$address1->setState('State 1');

    	$address2 = new Address();

    	$address2->setCep('9999992');
    	$address2->setStreet('Rua 2');
    	$address2->setCity('City 2');
    	$address2->setState('State 2');

    	$address3 = new Address();

    	$address3->setCep('9999993');
    	$address3->setStreet('Rua 3');
    	$address3->setCity('City 3');
    	$address3->setState('State 3');

    	$client1 = new Client();
    	$client1->setName('Client 1');
    	$client1->setEmail('client1@user.com');
    	$client1->setCpf('99999991');
    	$client1->addAddress($address1);
    	$client1->addAddress($address2);

    	$client2 = new Client();
    	$client2->setName('Client 2');
    	$client2->setEmail('client2@user.com');
    	$client2->setCpf('99999992');
    	$client2->addAddress($address3);

    	$this->em->persist($client1);
    	$this->em->persist($client2);
    	$this->em->flush();

    	$clients = $this->em->getRepository(Client::class)->findAll();

        return new HtmlResponse($this->template->render('app::test-page', ['clients' => $clients]));
    }
}
