<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Quarto;

class LoadQuarto implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // carrega três quartos
        for($i = 1; $i <= 3; $i++)
        {
            $quarto = new Quarto();
            $quarto->setNome("Quarto $i");
            $quarto->setAndar($i . 'º');
            $quarto->setDescricao("Descrição do quarto $i" . 'º');

            $manager->persist($quarto);
            $manager->flush();
        }
    }
}
