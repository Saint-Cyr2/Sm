<?php

namespace App\Entity;

use App\Repository\AssetCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetCategoryRepository::class)
 */
class AssetCategory
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
     * @ORM\OneToMany(targetEntity=ItemType::class, mappedBy="assetCategory")
     */
    private $itemTypes;

    public function __construct()
    {
        $this->itemTypes = new ArrayCollection();
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
     * @return Collection<int, ItemType>
     */
    public function getItemTypes(): Collection
    {
        return $this->itemTypes;
    }

    public function addItemType(ItemType $itemType): self
    {
        if (!$this->itemTypes->contains($itemType)) {
            $this->itemTypes[] = $itemType;
            $itemType->setAssetCategory($this);
        }

        return $this;
    }

    public function removeItemType(ItemType $itemType): self
    {
        if ($this->itemTypes->removeElement($itemType)) {
            // set the owning side to null (unless already changed)
            if ($itemType->getAssetCategory() === $this) {
                $itemType->setAssetCategory(null);
            }
        }

        return $this;
    }
}
