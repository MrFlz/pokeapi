<?php

namespace App\Pokemon\application;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonApiService
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchPokemonData(string $pokemonName): array
    {
        // API externa (PokeAPI)
        $response = $this->httpClient->request(
            'GET',
            "https://pokeapi.co/api/v2/pokemon/{$pokemonName}"
        );

        $statusCode = $response->getStatusCode();
        
        if ($statusCode !== 200) {
            // Manejar errores, por ejemplo, lanzar una excepción
            return [];
        }

        return $response->toArray();
    }

    /*public function findPokemonByName(string $pokemonName): array
    {
        // API externa (PokeAPI)
        $response = $this->httpClient->request(
            'GET',
            "https://pokeapi.co/api/v2/pokemon/{$pokemonName}"
        );

        $statusCode = $response->getStatusCode();
        
        if ($statusCode !== 200) {
            // Manejar errores, por ejemplo, lanzar una excepción
            return [];
        }

        return $response->toArray();
    }*/
}