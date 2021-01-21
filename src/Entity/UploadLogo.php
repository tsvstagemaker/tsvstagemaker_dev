<?php

namespace App\Entity;

use App\Repository\UploadLogoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UploadLogoRepository::class)
 */
class UploadLogo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;  
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

       /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="uploadLogos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logopath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    } 


     public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLogopath(): ?string
    {
        return $this->logopath;
    }

    public function setLogopath(?string $logopath): self
    {
        $this->logopath = $logopath;

        return $this;
    } 
}
