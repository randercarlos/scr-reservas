<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Reserva;

class ReservaRepository extends EntityRepository
{
    public function findAllOrdenadoPorDataEntrada()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT r, q, h FROM AppBundle:Reserva r JOIN r.quarto q JOIN r.hospede h ORDER BY r.dataEntrada ASC'
            )->getResult();
    }

    public function findReservaJoinQuartoEHospede($id)
    {
        $em = $this->getEntityManager();
        $query = $this->getEntityManager()->createQuery(
            'SELECT r, q, h
                FROM AppBundle:Reserva r
                JOIN r.quarto q
                JOIN r.hospede h
                WHERE r.id = :id
                ORDER BY r.dataEntrada ASC');
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
