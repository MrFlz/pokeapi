<?php

namespace App\Pokemon\domain;

class PokemonEntity
{
    private ?int $id = null;
    private string $name;
    private string $weight;
    private string $height;
    private string $abilities;
    private string $stats;
    private string $type;
    
    public function __construct(string $name, float $weight, float $height, array $abilities, array $stats, array $type)
    {
        $this->name = $name;
        $this->type = $weight;
        $this->type = $height;
        $this->type = $abilities;
        $this->type = $stats;
        $this->type = $type;
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    public function getWeight(): float
    {
        return $this->type;
    }

    public function setWeight(float $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getHeight(): float
    {
        return $this->type;
    }

    public function setHeight(float $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getAbilities(): float
    {
        return $this->type;
    }

    public function setAbilities(float $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getStats(): float
    {
        return $this->type;
    }

    public function seStats(float $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}