<?php

namespace Code\System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Code\System\Entity\ClientRepository")
 * @ORM\Table(name="clients")
 */
class Client
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

	/**
	 * @ORM\OneToOne(targetEntity="Code\System\Entity\ClientProfile")
	 * @ORM\JoinColumn(name="client_profile", referencedColumnName="id")
	 */
	private $profile;

	/**
	 * @ORM\ManyToOne(targetEntity="Code\System\Entity\Coupon")
	 * @ORM\JoinColumn(name="client_coupon", referencedColumnName="id")
	 */
	private $coupon;

	/**
	 * @ORM\ManyToMany(targetEntity="Code\System\Entity\Interest")
	 * @ORM\JoinTable(
	 	name="clients_interests", 
		joinColumns={@ORM\JoinColumn(name="client_id", referencedColumnName="id")},
		inverseJoinColumns={@ORM\JoinColumn(name="interest_id", referencedColumnName="id")}
		)
	 */
	private $interests;

	public function __construct()
	{
		$this->interests = new Doctrine\ORM\ArrayCollection;
	}	

	public function getId()
	{
		return $this->id;
	}

	public function setName($name) 
	{
		$this->name = $name;
	}

	public function getName() 
	{
		return $this->name;
	}

	public function setEmail($email) 
	{
		$this->email = $email;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function setProfile($profile)
	{
		$this->profile = $profile;
	}

	public function getProfile()
	{
		return $this->profile;
	}

	public function setCoupon($coupon)
	{
		$this->coupon = $coupon;
	}

	public function getCoupon()
	{
		return $this->coupon;
	}

	public function addInterest($interest)
	{
		$this->interests->add($interest);
	}

	public function getInterests()
	{
		return $this->interests;
	}

}