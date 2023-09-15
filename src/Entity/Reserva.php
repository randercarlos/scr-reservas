<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
#[ORM\Table(name: "tb_reserva")]
class Reserva
{
    /**
     * @ORM\Column(type="integer", name="id_reserva")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: "integer", name: "id_reserva")]
    private $id;

	#[ORM\Column(type: "date", name: "dt_entrada")]
	#[Assert\NotBlank]
	#[Assert\DateTime]
    private $dataEntrada;

	#[ORM\Column(type: "date", name: "dt_saida")]
	#[Assert\NotBlank]
	#[Assert\DateTime]
    private $dataSaida;

    /**
     * Uma reserva possui um e somente um único quarto
     */
	#[ORM\ManyToOne(targetEntity: Quarto::class)]
	#[ORM\JoinColumn(name: "fk_quarto", referencedColumnName: "id_quarto")]
	#[Assert\NotNull]
	#[Assert\Type(type: Quarto::class)]
    private $quarto;

    /**
     * Uma reserva possui um único hóspede, mas um hóspede pode possuir várias reservas
     */
	#[ORM\ManyToOne(targetEntity: Hospede::class, inversedBy: "reservas")]
	#[ORM\JoinColumn(name: "fk_hospede", referencedColumnName: "id_hospede")]
	#[Assert\NotNull]
	#[Assert\Type(type: Hospede::class)]
    private $hospede;

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
     * Set dataEntrada
     *
     * @param \DateTime $dataEntrada
     *
     */
    public function setDataEntrada(\DateTime $dataEntrada = null)
    {
        $this->dataEntrada = $dataEntrada;

    }

    /**
     * Get dataEntrada
     *
     * @return \DateTime
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * Set dataSaida
     *
     * @param \DateTime $dataSaida
     */
    public function setDataSaida(\DateTime $dataSaida = null)
    {
        $this->dataSaida = $dataSaida;
    }

    /**
     * Get dataSaida
     *
     * @return \DateTime
     */
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * Seta o Hóspede
     *
     * @param \AppBundle\Entity\Hospede $hospede
     *
     */
    public function setHospede(Hospede $hospede = null)
    {
        $this->hospede = $hospede;
    }

    /**
     * Recupera o Hóspede
     *
     * @return \AppBundle\Entity\hospede
     */
    public function getHospede()
    {
        return $this->hospede;
    }

    /**
     * Seta o Quarto
     *
     * @param \AppBundle\Entity\quarto $quarto
     *
     */
    public function setQuarto(Quarto $quarto = null)
    {
        $this->quarto = $quarto;
    }

    /**
     * Recupera o Quarto
     *
     * @return \AppBundle\Entity\quarto
     */
    public function getQuarto()
    {
        return $this->quarto;
    }


    /**
     * Determina o status da reserva comparando a data atual com a data de entrada e saída da reserva
     *
     * @return string status('reservado', 'ativo', 'expirado') or null
     */
    public function getStatus()
    {
        $agora = (new \DateTime('now'))->setTime(0, 0, 0);
		$dataEntrada = $this->dataEntrada?->setTime(0, 0, 0);
		$dataSaida = $this->dataSaida?->setTime(0, 0, 0);
        if (is_null($dataEntrada) || is_null($dataSaida)) {
            return null;
        }

        if ($agora >= $dataEntrada && $agora <= $dataSaida) {
            return 'Ativo';
        }

        if ($dataEntrada < $agora) {
            return 'Expirado';
        }

        if ($dataEntrada > $agora) {
            return 'Reservado';
        }
    }
}
