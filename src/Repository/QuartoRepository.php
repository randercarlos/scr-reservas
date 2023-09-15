<?php

namespace App\Repository;

use App\Entity\Quarto;
use App\Entity\Reserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuartoRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Quarto::class);
	}

    public function findAllOrdenadoPorNomeEAndar()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT q FROM ' . Quarto::class .  ' q ORDER BY q.nome, q.andar ASC'
            )->getResult();
    }

    public function getQuartosDisponiveis($dataEntrada, $dataSaida)
    {
        $em = $this->getEntityManager();

        /* SELECT q FROM AppBundle:Quarto q WHERE q.id IN
                (SELECT r.quarto.id FROM AppBundle:Reserva r
                    WHERE r.dataSaida < '$dataEntrada' OR r.dataEntrada > '$dataSaida') */

        try {
            $query = $em->createQuery("SELECT q FROM " . Quarto::class . " q WHERE q.id NOT IN
                    (SELECT IDENTITY(r.quarto) FROM " . Reserva::class . " r
                        WHERE :data_saida > r.dataEntrada AND :data_entrada < r.dataSaida)");

            $query->setParameter('data_entrada', \DateTime::createFromFormat('Y-m-d', $dataEntrada));
            $query->setParameter('data_saida', \DateTime::createFromFormat('Y-m-d', $dataSaida));

            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
