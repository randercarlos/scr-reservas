<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Quarto;

class QuartoRepository extends EntityRepository
{
    public function findAllOrdenadoPorNomeEAndar()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT q FROM AppBundle:Quarto q ORDER BY q.nome, q.andar ASC'
            )->getResult();
    }
}
