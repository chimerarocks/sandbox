<?php

namespace TargetMkt\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $cep;

    /**
     * @ORM\Column(type="string")
     */
    protected $street;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setStreet($street)
    {
    	$this->street = $street;
    }

    public function getStreet()
    {
    	return $this->street;
    }

    public function setCity($city)
    {
    	$this->city = $city;
    }

    public function getCity()
    {
    	return $this->city;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}
