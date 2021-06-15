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

    /**
     * Cocktail constructor.
     * @param $id
     * @param $name
     * @param $image
     * @param $category
     * @param $glass
     * @param array $ingredientsAndMeasurements
     * @param $instructions
     * @param $isAlcoholic
     */
    public function __construct($id, $name, $image, $category, $glass, array $ingredientsAndMeasurements, $instructions, $isAlcoholic)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->category = $category;
        $this->glass = $glass;
        $this->ingredientsAndMeasurements = $ingredientsAndMeasurements;
        $this->instructions = $instructions;
        $this->isAlcoholic = $isAlcoholic;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getGlass(): string
    {
        return $this->glass;
    }

    public function getIngredientsAndMeasurements(): array
    {
        return $this->ingredientsAndMeasurements;
    }


    public function getInstructions(): string
    {
        return $this->instructions;
    }

   public function getIsAlcoholic(): bool
    {
        return $this->isAlcoholic;
    }



}
