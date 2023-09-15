<?php

namespace App\Entity;

use App\Repository\QuartoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: QuartoRepository::class)]
#[ORM\Table(name: "tb_quarto")]
#[UniqueEntity('nome', message: "quarto.email.not_unique")]
class Quarto
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: "integer", name: "id_quarto")]
    private ?int $id = null;

	#[ORM\Column(type: "string", name: "nm_quarto", length: 20, unique: true)]
	#[Assert\NotBlank(message: "quarto.nome.not_blank")]
	#[Assert\Length(max: 20)]
    private $nome;

	#[ORM\Column(type: "string", name: "de_andar", length: 15)]
	#[Assert\NotBlank(message: "quarto.andar.not_blank")]
	#[Assert\Length(max: 15)]
    private $andar;

	#[ORM\Column(type: "string", name: "de_quarto", length: 200, nullable: true)]
	#[Assert\Length(max: 200)]
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
