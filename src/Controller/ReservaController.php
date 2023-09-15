<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Hospede;
use App\Entity\Quarto;
use App\Entity\Reserva;
use Symfony\Component\Routing\Annotation\Route;


class ReservaController extends AbstractController
{
    /**
     * Lista todos as reservas feitas
     */
	#[Route('/reservas', methods: ['GET'], name: "reserva.index")]
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $reservas = $entityManager->getRepository(Reserva::class)->findAllOrdenadoPorDataEntrada();

        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas
        ]);
    }

    /**
     * Pesquisa todos os quartos disponíveis de acordo com a data de entrada
     * e data de saída do hóspede
     */
	#[Route('/reserva/pesquisar/{id}', methods: ['GET', 'POST'], name: "reserva.pesquisaData")]
    public function pesquisaDataAction(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, Hospede $hospede)
    {
        // O objeto Hospede é recuperado automaticamente do banco dados através do parâmetro {id} da URL.
        $quartosDisponiveis = [];
        
        // Se o botão pesquisar foi clicado, ou seja, o form foi submetido
        if (!is_null($request->request->get('btn_pesquisar')))
        {
            // recebe as datas de entrada e saída(formato BR: dd/mm/yyyy) via método POST e as converte
            // para o objeto DateTime do PHP
            $dataEntrada = \DateTime::createFromFormat('d/m/Y', $request->request->get('dataEntrada'));
            $dataSaida = \DateTime::createFromFormat('d/m/Y', $request->request->get('dataSaida'));

            // converte as datas de entrada e saída em formato BR(dd/mm/yyyy) para o formato
            // do MySQL/Symfony(yyyy-mm-dd)
            $dataEntrada = $dataEntrada->format('Y-m-d');
            $dataSaida = $dataSaida->format('Y-m-d');

            /* Salva dados na session para posterior recuperação, evitando passar todos esses parâmetros pela URL
                via método GET */
            $session->set('dataEntrada', $dataEntrada);
            $session->set('dataSaida', $dataSaida);

            // recupera os quartos disponíveis de acordo com a data de entrada e de saída
            $quartosDisponiveis = $entityManager->getRepository(Quarto::class)->getQuartosDisponiveis($dataEntrada, $dataSaida);
        }

        return $this->render('reserva/reservar.html.twig', [
            'hospede' => $hospede,
            'quartos' => $quartosDisponiveis
        ]);
    }

    /**
     * Efetua a reserva de um quarto para um hóspede de acordo com a data de entrada e a data de saída
     */
	#[Route('/reserva/reservar/{idQuarto}/{idHospede}', methods: ['GET'], name: "reserva.reservar")]
    public function reservarAction(SessionInterface $session, EntityManagerInterface $entityManager, int $idQuarto, int $idHospede)
    {
        // Obtém os dados da sessão, e depois os apaga
        $dataEntrada = $session->get('dataEntrada');
        $dataSaida = $session->get('dataSaida');
        $session->clear();

        // recupera o quarto pelo parâmetro id_quarto
        $quarto = $entityManager->getRepository(Quarto::class)->find($idQuarto);
        $hospede = $entityManager->getRepository(Hospede::class)->find($idHospede);

        $reserva = new Reserva();
        $reserva->setHospede($hospede);
        $reserva->setQuarto($quarto);
        $reserva->setDataEntrada(new \DateTime($dataEntrada));
        $reserva->setDataSaida(new \DateTime($dataSaida));

        // mensagens flash
        $this->addFlash('notice', 'reserva.saved_successfully');
        $this->addFlash('quarto', $quarto->getNome());
        $this->addFlash('hospede', $hospede->getNome());
        $this->addFlash('dataEntrada', $dataEntrada);
        $this->addFlash('dataSaida', $dataSaida);

		$entityManager->persist($reserva);
		$entityManager->flush();

        return $this->redirectToRoute('reserva.index');
    }

    /**
     * Cancela(exclui) uma reserva feita
     */
	#[Route('reserva/cancelar/{id}', methods: ['GET'], name: "reserva.cancelar")]
    public function cancelarAction(EntityManagerInterface $entityManager, int $id)
    {
        $reserva = $entityManager->getRepository(Reserva::class)->findReservaJoinQuartoEHospede($id);

        $this->addFlash('notice', 'reserva.deleted_successfully');
        $this->addFlash('quarto', $reserva->getQuarto()->getNome());
        $this->addFlash('hospede', $reserva->getHospede()->getNome());
        $this->addFlash('dataEntrada', $reserva->getDataEntrada());
        $this->addFlash('dataSaida', $reserva->getDataSaida());

		$entityManager->remove($reserva);
		$entityManager->flush();

        return $this->redirectToRoute('reserva.index');
    }
}
