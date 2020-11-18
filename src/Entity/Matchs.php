<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MatchsRepository;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=MatchsRepository::class)
 * @ORM\Table(name="matches")
 * @ORM\HasLifecycleCallbacks
 */
class Matchs
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firearmtype;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchlevel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MatchDirector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RangeMaster;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StatsDirector;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}))
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}))
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clubName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CountryId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $SquadCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchid;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="matchs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="MatchsId")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirearmtype(): ?string
    {
        return $this->firearmtype;
    }

    public function setFirearmtype(string $firearmtype): self
    {
        $this->firearmtype = $firearmtype;

        return $this;
    }

    public function getMatchlevel(): ?int
    {
        return $this->matchlevel;
    }

    public function setMatchlevel(int $matchlevel): self
    {
        $this->matchlevel = $matchlevel;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getMatchDirector(): ?string
    {
        return $this->MatchDirector;
    }

    public function setMatchDirector(string $MatchDirector): self
    {
        $this->MatchDirector = $MatchDirector;

        return $this;
    }

    public function getRangeMaster(): ?string
    {
        return $this->RangeMaster;
    }

    public function setRangeMaster(?string $RangeMaster): self
    {
        $this->RangeMaster = $RangeMaster;

        return $this;
    }

    public function getStatsDirector(): ?string
    {
        return $this->StatsDirector;
    }

    public function setStatsDirector(?string $StatsDirector): self
    {
        $this->StatsDirector = $StatsDirector;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getClubName(): ?string
    {
        return $this->clubName;
    }

    public function setClubName(?string $clubName): self
    {
        $this->clubName = $clubName;

        return $this;
    }

    public function getCountryId(): ?string
    {
        return $this->CountryId;
    }

    public function setCountryId(?string $CountryId): self
    {
        $this->CountryId = $CountryId;

        return $this;
    }

    public function getSquadCount(): ?int
    {
        return $this->SquadCount;
    }

    public function setSquadCount(?int $SquadCount): self
    {
        $this->SquadCount = $SquadCount;

        return $this;
    }

    public function getMatchid(): ?int
    {
        return $this->matchid;
    }

    public function setMatchid(?int $matchid): self
    {
        $this->matchid = $matchid;

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

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setMatchsId($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getMatchsId() === $this) {
                $stage->setMatchsId(null);
            }
        }

        return $this;
    }

      /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function updateTimestamps()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable);
         } 
        $this->setUpdatedAt(new \DateTimeImmutable);
    }
}
