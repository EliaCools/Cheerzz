<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
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
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAlcoholic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * Ingredient constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $isAlcoholic
     * @param $type
     */
    public function __construct($id, $name, $description, $isAlcoholic, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isAlcoholic = $isAlcoholic;
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsAlcoholic(): bool
    {
        return $this->isAlcoholic;
    }

    public function getType(): string
    {
        return $this->type;
    }

}
