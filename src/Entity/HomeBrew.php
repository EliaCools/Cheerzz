<?php

namespace App\Entity;

use App\Repository\HomeBrewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeBrewRepository::class)
 */
class HomeBrew
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="homeBrews")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $madeBy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $glass;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $instructions;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredientsAndMeasurements = [];

    /**
     * HomeBrew constructor.
     * @param User|null $madeBy
     */
    public function __construct(?User $madeBy)
    {
        $this->madeBy = $madeBy;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMadeBy(): ?User
    {
        return $this->madeBy;
    }

    public function setMadeBy(?User $madeBy): self
    {
        $this->madeBy = $madeBy;

        return $this;
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

    public function getGlass(): ?string
    {
        return $this->glass;
    }

    public function setGlass(string $glass): self
    {
        $this->glass = $glass;

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

    public function getIngredientsAndMeasurements(): ?array
    {
        return $this->ingredientsAndMeasurements;
    }

    public function setIngredientsAndMeasurements(array $ingredientsAndMeasurements): self
    {
        $this->ingredientsAndMeasurements = $ingredientsAndMeasurements;

        return $this;
    }

    public function formatIngredientsAndMeasurements(): void
    {
        $rawArray = $this->ingredientsAndMeasurements;

        //check if correct format
        if(count($rawArray[0]) !== 3 )
        {
            return;
        }

        //replace each sub-array with correct format
        foreach ($rawArray as &$measuredIngredient)
        {
            $formatted = [];
            $formatted[0] = $measuredIngredient['ingredient'];
            $formatted[1] = $measuredIngredient['measurement'] . " " . $measuredIngredient['metric'];

            $measuredIngredient = $formatted;
        }
        unset($measuredIngredient);

        //bring ingredientMeasurement array up to correct length
        while (count($rawArray) < 15)
        {
            $rawArray[] = [0=>null , 1=>null];
        }
        while (count($rawArray) > 15)
        {
            array_pop($rawArray);
        }
        //update ingredientsAndMeasurements
        $this->ingredientsAndMeasurements = $rawArray ;
    }
}
