<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Reserva;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classe Quarto
 *
 * @ORM\Entity()
 * @ORM\Table(name="tb_quarto")
 * @UniqueEntity("nome")
 */
class Quarto
{
    /**
     * @ORM\Column(type="integer", name="id_quarto")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="nm_quarto", length=20, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 20)
     *
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(type="string", name="de_andar", length=5)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 5)
     * @var string
     */
    private $andar;

    /**
     * @ORM\Column(type="string", name="de_quarto", length=200, nullable=true)
     *
     * @Assert\Length(max = 200)
     * @var string
     */
    private $descricao;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set andar
     *
     * @param integer $andar
     *
     */
    public function setAndar($andar)
    {
        $this->andar = $andar;
    }

    /**
     * Get andar
     *
     * @return int
     */
    public function getAndar()
    {
        return $this->andar;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
}
