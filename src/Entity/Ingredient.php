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
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isAlcoholic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $type;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getIsAlcoholic(): bool
    {
        return $this->isAlcoholic;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

}
