<?php

namespace App\Entity;

use App\Repository\ShoppingcartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShoppingcartRepository::class)
 */
class ShoppingCart
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shoppingCarts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=ShoppingLine::class, mappedBy="shoppingCart", orphanRemoval=true)
     */
    private $shoppingLines;


    public function __construct()
    {
        $this->shoppingLines = new ArrayCollection();
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

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|ShoppingLine[]
     */
    public function getShoppingLines(): Collection
    {
        return $this->shoppingLines;
    }

    public function addShoppingLine(ShoppingLine $shoppingline): self
    {
        if (!$this->shoppingLines->contains($shoppingline)) {
            $this->shoppingLines[] = $shoppingline;
            $shoppingline->setShoppingCart($this);
        }

        return $this;
    }

    public function removeShoppingLine(ShoppingLine $shoppingline): self
    {
        if ($this->shoppingLines->removeElement($shoppingline)) {
            // set the owning side to null (unless already changed)
            if ($shoppingline->getShoppingCart() === $this) {
                $shoppingline->setShoppingCart(null);
            }
        }

        return $this;
    }
}
