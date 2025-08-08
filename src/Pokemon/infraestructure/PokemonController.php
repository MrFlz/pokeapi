<?php

namespace App\Pokemon\infrastructure;

use App\Pokemon\application\PokemonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    private PokemonService $pokemonService;

    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    // Crear un nuevo Pokemon
    ##[Route('/pokemones', methods: ['POST'])]
    public function createPokemon(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $pokemon = $this->pokemonService->createPokemon($data['name'], $data['type']);

        return $this->json([
            'status' => 'OK',
            'message' => 'El Pokemon' + $pokemon->getName() + 'fue almacenado correctamente',
            //'message' => `El Pokemon `.$pokemon->geName().` fue almacenado correctamente`,
            'pokemon_id' => $pokemon->getId(),
        ]);
    }

    // Listar todos los Pokemones (abilities, stats, types) limitado a 10
    ##[Route('/pokemones', methods: ['GET'])]
    public function listPokemones(): JsonResponse
    {
        $pokemones = $this->pokemonService->findAllPokemones();
        
        return $this->json($pokemones);
    }

    // Obtener un Pokemon específico
    ##[Route('/pokemones/{name}', methods: ['GET'])]
    public function findPokemon(string $name): JsonResponse
    {
        $pokemones = $this->pokemonService->findPokemon();

        if (!$pokemon) {
            return $this->json(['message' => 'Pokemon no encontrado.'], 404);
        }
        
        return $this->json($pokemones);
    }

    // Actualizar un Pokemon
    ##[Route('/pokemones/{id}', methods: ['PUT'])]
    public function updatePokemon(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $pokemon = $this->pokemonService->updatePokemon($data['name'], $data['type']);

        if (!$pokemon) {
            return $this->json(['message' => 'Pokemon no encontrado.'], 404);
        }

        return $this->json([
            'status' => 'OK',
            'message' => 'El Pokemon' + $pokemon->getName() + 'fue modificado correctamente',
            //'message' => `El Pokemon `.$pokemon->geName().` fue modificado correctamente`,
            'pokemon_id' => $pokemon->getId(),
        ]);
    }

    // Eliminar un Pokémon por ID
    ##[Route('/pokemones/{id}', methods: ['DELETE'])]
    public function removePokemon(int $id): JsonResponse
    {
        $this->pokemonService->removePokemon($id);
        
        return $this->json([
            'status' => 'OK',
            'message' => 'El Pokemon' + $pokemon->getName() + 'fue eliminado correctamente',
            //'message' => `El Pokemon `.$pokemon->geName().` fue eliminado correctamente`,
        ], 204);
    }
}