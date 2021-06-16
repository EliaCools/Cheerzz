<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alcohol;

    /**
     * @ORM\Column(type="integer")
     */
    private $abv;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $quantity
     * @param $alcohol
     * @param $abv
     */
    public function __construct($id, $name, $price, $quantity, $alcohol, $abv)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->alcohol = $alcohol;
        $this->abv = $abv;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAlcohol(): ?bool
    {
        return $this->alcohol;
    }

    public function setAlcohol(bool $alcohol): self
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    public function getAbv(): ?int
    {
        return $this->abv;
    }

    public function setAbv(int $abv): self
    {
        $this->abv = $abv;

        return $this;
    }
}
