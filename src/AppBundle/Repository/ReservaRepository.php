<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Reserva;

class ReservaRepository extends EntityRepository
{
    public function findAllOrdenadoPorDataEntrada()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT r FROM AppBundle:Reserva r ORDER BY r.dataEntrada ASC'
            )->getResult();
    }
}
