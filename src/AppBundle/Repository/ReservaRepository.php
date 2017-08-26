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
}
