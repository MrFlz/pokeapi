<?php

namespace App\Pokemon\application;

use App\Pokemon\domain\Pokemon;
use App\Pokemon\domain\PokemonRepository;

class PokemonService
{
    public function __construct(private PokemonRepository $pokemonRepository, private PokemonApiService $pokemonApiService)
    {}

    // Crear un nuevo Pokemon
    public function createPokemon(string $name, string $type): Pokemon
    {
        $pokemon = new Pokemon($name, $type);
        $this->pokemonRepository->save($pokemon);
        return $pokemon;
    }

    // Listar todos los Pokemones (abilities, stats, types) limitado a 10 
    public function findAllPokemones(): array
    {
        return $this->pokemonRepository->findAll();
    }

    // Nuevo método para crear un Pokémon desde la API externa
    /*public function crearPokemonDesdeApi(string $pokemonName): ?Pokemon
    {
        $apiData = $this->pokemonApiService->fetchPokemonData(strtolower($pokemonName));

        if (empty($apiData)) {
            return null; // El Pokémon no se encontró en la API
        }

        // Aquí extraes los datos que te interesan de la respuesta de la API
        $nombre = $apiData['name'];
        $tipo = $apiData['types'][0]['type']['name'];

        // Creas tu entidad de dominio con los datos obtenidos
        $pokemon = new Pokemon($nombre, $tipo);
        $this->pokemonRepository->save($pokemon);

        return $pokemon;
    }*/

    // Obtener un Pokemon específico
    public function findPokemon(string $name): ?Pokemon
    {
        $apiData = $this->pokemonApiService->fetchPokemonData(strtolower($pokemonName));

        if (empty($apiData)) {
            return null; // El Pokémon no se encontró en la API
        }

        // Limpieza datos (con opción a crear un DTO para validaciones pertinentes)
        $pokemon = [
            'id' => $apiData['id'],
            'name' => $apiData['name'],
            'weight' => $apiData['weight'],
            'height' => $apiData['height'],
            'abilities' => $apiData['abilities'],
            'stats' => $apiData['stats'],
            'type' => $apiData['types'][0]['type']['name'],
        ];

        //return $this->pokemonRepository->findById($id);
        return $pokemon;
    }

    // Actualizar un Pokemon
    public function updatePokemon(int $id, string $name, string $type): ?Pokemon
    {
        $pokemon = $this->pokemonRepository->findById($id);

        if (!$pokemon) {
            return null;
        }

        $pokemon->setNombre($name);
        $pokemon->setTipo($type);
        $this->pokemonRepository->save($pokemon);

        return $pokemon;
    }

    // Eliminar un Pokémon por ID
    public function removePokemon(int $id): void
    {
        $pokemon = $this->pokemonRepository->findById($id);

        if ($pokemon) {
            $this->pokemonRepository->remove($pokemon);
        }
    }

}