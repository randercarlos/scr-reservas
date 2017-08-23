<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Hospede;

class HospedeRepository extends EntityRepository
{
    public function findAllOrdenadoPorNome()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT h FROM AppBundle:Hospede h ORDER BY h.nome ASC'
            )->getResult();
    }
}
