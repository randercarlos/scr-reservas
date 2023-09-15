<?php

namespace App\Repository;

use App\Entity\Hospede;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class HospedeRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Hospede::class);
	}
    public function findAllOrdenadoPorNome()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT h FROM ' . Hospede::class . ' h ORDER BY h.nome ASC'
            )->getResult();
    }
}
