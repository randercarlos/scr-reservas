<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Reserva;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tb_hospede")
 * @UniqueEntity("email")
 */
class Hospede
{
    /**
     * @ORM\Column(type="integer", name="id_hospede")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="nm_titulo", length=10)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 10)
     * @var string
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", name="nm_hospede", length=100)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 100)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(type="string", name="de_endereco", length=250)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 250)
     * @var string
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", name="de_cep", length=10)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 8, max = 10)
     * @var string
     */
    private $cep;

    /**
     * @ORM\Column(type="string", name="de_cidade", length=100)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 3, max = 100)
     * @var string
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", name="de_estado", length=2)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 2)
     * @var string
     */
    private $estado;

    /**
     * @ORM\Column(type="string", name="de_email", length=100, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 100)
     * @Assert\Email()
     * @var string
     */
    private $email;

    /**
     * Um hóspede pode possuir muitas reservas
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="hospede")

     * @Assert\All({
     *     @Assert\Type(type="AppBundle/Entity/Reserva")
     * })
     *
     * @var Doctrine\Common\Collections\Collection
     */
    private $reservas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

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
     * Set titulo
     *
     * @param string $titulo
     *
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
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
     * Set endereco
     *
     * @param string $endereco
     *
     * @return hospede
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getcep()
    {
        return $this->cep;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Adicionar Reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     */
    public function addReserva(Reserva $reserva)
    {
        $this->reservas[] = $reserva;
    }

    /**
     * Remover Reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     */
    public function removerReserva(Reserva $reserva)
    {
        $this->reservas->removeElement($reserva);
    }

    /**
     * Obter reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas()
    {
        return $this->reservas;
    }
}
