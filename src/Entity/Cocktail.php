<?php

namespace App\Entity;

use App\Repository\CocktailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CocktailRepository::class)
 */
class Cocktail
{
    //@Todo for now I kept the orm routing in case we want to use a database later for orders.
    /**
     * @ORM\Id
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
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $glass;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredientsAndMeasurements = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $instructions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAlcoholic;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getGlass(): ?string
    {
        return $this->glass;
    }

    public function setGlass(string $glass): self
    {
        $this->glass = $glass;

        return $this;
    }

    public function getIngredientsAndMeasurements(): ?array
    {
        return $this->ingredientsAndMeasurements;
    }

    public function setIngredientsAndMeasurements(array $ingredientsAndMeasurements): self
    {
        $this->ingredientsAndMeasurements = $ingredientsAndMeasurements;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getIsAlcoholic(): ?bool
    {
        return $this->isAlcoholic;
    }

    public function setIsAlcoholic(bool $isAlcoholic): self
    {
        $this->isAlcoholic = $isAlcoholic;

        return $this;
    }


}
