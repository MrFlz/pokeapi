<?php

namespace App\Pokemon\infrastructure;

use App\Pokemon\domain\Pokemon;
use App\Pokemon\domain\PokemonRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping as ORM;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
#[ORM\Entity(repositoryClass: DoctrinePokemonRepository::class)]
#[ORM\Table(name: 'pokemones')]
class DoctrinePokemonRepository extends ServiceEntityRepository implements PokemonRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function save(Pokemon $pokemon): void
    {
        $this->getEntityManager()->persist($pokemon);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?Pokemon
    {
        return $this->find($id);
    }

    public function findAll(): array
    {
        return $this->findAll();
    }

    public function remove(Pokemon $pokemon): void
    {
        $this->getEntityManager()->remove($pokemon);
        $this->getEntityManager()->flush();
    }
}