<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ItemUse::class, mappedBy="site")
     */
    private $itemUses;

    public function __construct()
    {
        $this->itemUses = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ItemUse>
     */
    public function getItemUses(): Collection
    {
        return $this->itemUses;
    }

    public function addItemUse(ItemUse $itemUse): self
    {
        if (!$this->itemUses->contains($itemUse)) {
            $this->itemUses[] = $itemUse;
            $itemUse->setSite($this);
        }

        return $this;
    }

    public function removeItemUse(ItemUse $itemUse): self
    {
        if ($this->itemUses->removeElement($itemUse)) {
            // set the owning side to null (unless already changed)
            if ($itemUse->getSite() === $this) {
                $itemUse->setSite(null);
            }
        }

        return $this;
    }
}
