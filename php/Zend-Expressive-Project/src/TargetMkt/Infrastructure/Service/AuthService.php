<?php

namespace TargetMkt\Infrastructure\Service;

use TargetMkt\Domain\Service\AuthInterface;
use Zend\Authentication\AuthenticationService;

class AuthService implements AuthInterface {

	private $auth;

	public function __construct(AuthenticationService $auth)
	{
		$this->auth = $auth;
	}

	public function authenticate($email, $password)
	{
		/**
		 * @var ValidatorAdapterInterface $adapter
		 */
		$adapter = $this->auth->getAdapter();
		$adapter->setIdentity($email);
		$adapter->setCredential($password);
		$result = $this->auth->authenticate();
		return $result->isValid();
	}

	public function isAuth()
	{
		throw new \Exception('Method not implemented');
	}

	public function getUser()
	{
		throw new \Exception('Method not implemented');
	}

	public function destroy()
	{
		throw new \Exception('Method not implemented');
	}

}