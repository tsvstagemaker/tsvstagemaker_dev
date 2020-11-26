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
	private $pseudo;

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @var string|null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=10)
	 */
	private $message;


	public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): Contact
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): Contact
    {
        $this->message = $message;

        return $this;
    }


}
