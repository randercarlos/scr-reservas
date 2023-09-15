<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Reserva;
use Doctrine\Persistence\ManagerRegistry;

class ReservaRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Reserva::class);
	}

    public function findAllOrdenadoPorDataEntrada()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT r, q, h FROM ' . Reserva::class . ' r JOIN r.quarto q JOIN r.hospede h ORDER BY r.dataEntrada ASC'
            )->getResult();
    }

    public function findReservaJoinQuartoEHospede($id)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT r, q, h
                FROM ' . Reserva::class . ' r
                JOIN r.quarto q
                JOIN r.hospede h
                WHERE r.id = :id
                ORDER BY r.dataEntrada ASC');
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
