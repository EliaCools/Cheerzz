<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Ingredient;

class Quantity
{
    private float $amount; //in ml?
    private string $name;

    public function __construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getIngredient() : string
    {
        return $this->name;
    }
}