<?php

namespace App\Entity;

use App\Repository\ItemUseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemUseRepository::class)
 */
class ItemUse
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
    private $sr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $docuSignNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="itemUses")
     */
    private $site;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSr(): ?string
    {
        return $this->sr;
    }

    public function setSr(?string $sr): self
    {
        $this->sr = $sr;

        return $this;
    }

    public function getDocuSignNumber(): ?string
    {
        return $this->docuSignNumber;
    }

    public function setDocuSignNumber(?string $docuSignNumber): self
    {
        $this->docuSignNumber = $docuSignNumber;

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

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}
