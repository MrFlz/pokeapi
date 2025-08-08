<?php

namespace App\Pokemon\domain;

interface PokemonRepository
{
    public function save(Pokemon $pokemon): void;
    public function findById(int $id): ?Pokemon;
    public function findAll(): array;
    public function remove(Pokemon $pokemon): void;
}