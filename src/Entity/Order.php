<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePurshased;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="purshasedOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="purchaseOrder", orphanRemoval=true)
     */
    private $orderLines;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePurshased(): ?\DateTimeInterface
    {
        return $this->datePurshased;
    }

    public function setDatePurshased(?\DateTimeInterface $datePurshased): self
    {
        $this->datePurshased = $datePurshased;

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
     * @return Collection|OrderLine[]
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setPurchaseOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getPurchaseOrder() === $this) {
                $orderLine->setPurchaseOrder(null);
            }
        }

        return $this;
    }
}
