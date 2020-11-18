<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StageRepository;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 * @ORM\Table(name="stages")
 * @ORM\HasLifecycleCallbacks
 */
class Stage
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
    private $stagename;

    /**
     * @ORM\Column(type="integer")
     */
    private $stagenumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $FirearmId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CourseId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ScoringId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtTypeId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $IcsStageId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtPaper;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtPopper;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtPlates;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtVanish;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $TrgtPenlty;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $MinRounds;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ReportOn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $MaxPoints;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $StartPos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="StartOn", type="string", length=10, nullable=true, options={"default"="00"})
     */
    private $starton = '00';

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $StringCnt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Descriptn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bobber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $showall;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Location;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fileurl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filenameimg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fileurlimg;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $datastage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStagename(): ?string
    {
        return $this->stagename;
    }

    public function setStagename(string $stagename): self
    {
        $this->stagename = $stagename;

        return $this;
    }

    public function getStagenumber(): ?int
    {
        return $this->stagenumber;
    }

    public function setStagenumber(int $stagenumber): self
    {
        $this->stagenumber = $stagenumber;

        return $this;
    }

    public function getFirearmId(): ?int
    {
        return $this->FirearmId;
    }

    public function setFirearmId(?int $FirearmId): self
    {
        $this->FirearmId = $FirearmId;

        return $this;
    }

    public function getCourseId(): ?int
    {
        return $this->CourseId;
    }

    public function setCourseId(?int $CourseId): self
    {
        $this->CourseId = $CourseId;

        return $this;
    }

    public function getScoringId(): ?int
    {
        return $this->ScoringId;
    }

    public function setScoringId(?int $ScoringId): self
    {
        $this->ScoringId = $ScoringId;

        return $this;
    }

    public function getTrgtTypeId(): ?int
    {
        return $this->TrgtTypeId;
    }

    public function setTrgtTypeId(?int $TrgtTypeId): self
    {
        $this->TrgtTypeId = $TrgtTypeId;

        return $this;
    }

    public function getIcsStageId(): ?int
    {
        return $this->IcsStageId;
    }

    public function setIcsStageId(?int $IcsStageId): self
    {
        $this->IcsStageId = $IcsStageId;

        return $this;
    }

    public function getTrgtPaper(): ?int
    {
        return $this->TrgtPaper;
    }

    public function setTrgtPaper(?int $TrgtPaper): self
    {
        $this->TrgtPaper = $TrgtPaper;

        return $this;
    }

    public function getTrgtPopper(): ?int
    {
        return $this->TrgtPopper;
    }

    public function setTrgtPopper(?int $TrgtPopper): self
    {
        $this->TrgtPopper = $TrgtPopper;

        return $this;
    }

    public function getTrgtPlates(): ?int
    {
        return $this->TrgtPlates;
    }

    public function setTrgtPlates(?int $TrgtPlates): self
    {
        $this->TrgtPlates = $TrgtPlates;

        return $this;
    }

    public function getTrgtVanish(): ?int
    {
        return $this->TrgtVanish;
    }

    public function setTrgtVanish(?int $TrgtVanish): self
    {
        $this->TrgtVanish = $TrgtVanish;

        return $this;
    }

    public function getTrgtPenlty(): ?int
    {
        return $this->TrgtPenlty;
    }

    public function setTrgtPenlty(?int $TrgtPenlty): self
    {
        $this->TrgtPenlty = $TrgtPenlty;

        return $this;
    }

    public function getMinRounds(): ?int
    {
        return $this->MinRounds;
    }

    public function setMinRounds(?int $MinRounds): self
    {
        $this->MinRounds = $MinRounds;

        return $this;
    }

    public function getReportOn(): ?int
    {
        return $this->ReportOn;
    }

    public function setReportOn(?int $ReportOn): self
    {
        $this->ReportOn = $ReportOn;

        return $this;
    }

    public function getMaxPoints(): ?int
    {
        return $this->MaxPoints;
    }

    public function setMaxPoints(?int $MaxPoints): self
    {
        $this->MaxPoints = $MaxPoints;

        return $this;
    }

    public function getStartPos(): ?string
    {
        return $this->StartPos;
    }

    public function setStartPos(?string $StartPos): self
    {
        $this->StartPos = $StartPos;

        return $this;
    }

    public function getStartOn(): ?string
    {
        return $this->StartOn;
    }

    public function setStartOn(?string $StartOn): self
    {
        $this->StartOn = $StartOn;

        return $this;
    }

    public function getStringCnt(): ?int
    {
        return $this->StringCnt;
    }

    public function setStringCnt(?int $StringCnt): self
    {
        $this->StringCnt = $StringCnt;

        return $this;
    }

    public function getDescriptn(): ?string
    {
        return $this->Descriptn;
    }

    public function setDescriptn(?string $Descriptn): self
    {
        $this->Descriptn = $Descriptn;

        return $this;
    }

    public function getBobber(): ?int
    {
        return $this->bobber;
    }

    public function setBobber(?int $bobber): self
    {
        $this->bobber = $bobber;

        return $this;
    }

    public function getShowall(): ?int
    {
        return $this->showall;
    }

    public function setShowall(?int $showall): self
    {
        $this->showall = $showall;

        return $this;
    }

    public function getLocation(): ?int
    {
        return $this->Location;
    }

    public function setLocation(?int $Location): self
    {
        $this->Location = $Location;

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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFileurl(): ?string
    {
        return $this->fileurl;
    }

    public function setFileurl(?string $fileurl): self
    {
        $this->fileurl = $fileurl;

        return $this;
    }

    public function getFilenameimg(): ?string
    {
        return $this->filenameimg;
    }

    public function setFilenameimg(?string $filenameimg): self
    {
        $this->filenameimg = $filenameimg;

        return $this;
    }

    public function getFileurlimg(): ?string
    {
        return $this->fileurlimg;
    }

    public function setFileurlimg(?string $fileurlimg): self
    {
        $this->fileurlimg = $fileurlimg;

        return $this;
    }

    public function getDatastage(): ?string
    {
        return $this->datastage;
    }

    public function setDatastage(?string $datastage): self
    {
        $this->datastage = $datastage;

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
