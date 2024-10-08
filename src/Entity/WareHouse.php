<?php

namespace App\Entity;

use App\Repository\WareHouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WareHouseRepository::class)
 */
class WareHouse
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
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ItemTypeQuantity::class, mappedBy="wareHouse")
     */
    private $itemTypeQuantities;

    public function __construct()
    {
        $this->itemTypeQuantities = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $itemTypeQuantity->setWareHouse($this);
        }

        return $this;
    }

    public function removeItemTypeQuantity(ItemTypeQuantity $itemTypeQuantity): self
    {
        if ($this->itemTypeQuantities->removeElement($itemTypeQuantity)) {
            // set the owning side to null (unless already changed)
            if ($itemTypeQuantity->getWareHouse() === $this) {
                $itemTypeQuantity->setWareHouse(null);
            }
        }

        return $this;
    }
}
