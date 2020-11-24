<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact{

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2, max=100)
	 */
	private $firstname;

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2, max=100)
	 */
	private $Pseudo;

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $Email;

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=10)
	 */
	private $message;
}