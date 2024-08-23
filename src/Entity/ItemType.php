<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemTypeRepository::class)
 */
#[ApiResource]
class ItemType
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $serialNumber;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="itemType")
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity=AssetCategory::class, inversedBy="itemTypes")
     */
    private $assetCategory;

    /**
     * @ORM\OneToMany(targetEntity=ItemTypeQuantity::class, mappedBy="itemType")
     */
    private $itemTypeQuantities;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->itemTypeQuantities = new ArrayCollection();
    }

    public function __toString(){
        return $this->getName();
    }

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

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setItemType($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getItemType() === $this) {
                $item->setItemType(null);
            }
        }

        return $this;
    }

    public function getAssetCategory(): ?AssetCategory
    {
        return $this->assetCategory;
    }

    public function setAssetCategory(?AssetCategory $assetCategory): self
    {
        $this->assetCategory = $assetCategory;

        return $this;
    }

    /**
     * @return Collection<int, ItemTypeQuantity>
     */
    public function getItemTypeQuantities(): Collection
    {
        return $this->itemTypeQuantities;
    }

    public function addItemTypeQuantity(ItemTypeQuantity $itemTypeQuantity): self
    {
        if (!$this->itemTypeQuantities->contains($itemTypeQuantity)) {
            $this->itemTypeQuantities[] = $itemTypeQuantity;
            $itemTypeQuantity->setItemType($this);
        }

        return $this;
    }

    public function removeItemTypeQuantity(ItemTypeQuantity $itemTypeQuantity): self
    {
        if ($this->itemTypeQuantities->removeElement($itemTypeQuantity)) {
            // set the owning side to null (unless already changed)
            if ($itemTypeQuantity->getItemType() === $this) {
                $itemTypeQuantity->setItemType(null);
            }
        }

        return $this;
    }
}
