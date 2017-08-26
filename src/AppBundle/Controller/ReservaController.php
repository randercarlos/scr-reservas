<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Entity\Hospede;
use AppBundle\Entity\Quarto;
use AppBundle\Entity\Reserva;


class ReservaController extends Controller
{
    /**
     * Lista todos as reservas feitas
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/reservas", name="reserva.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $reservas = [];

        $em = $this->getDoctrine()->getManager();
        $reservas = $em->getRepository(Reserva::class)->findAllOrdenadoPorDataEntrada();

        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas
        ]);
    }

    /**
     * Pesquisa todos os quartos disponíveis de acordo com a data de entrada
     * e data de saída do hóspede
     *
     * @param Request $request Objeto Request
     * @param Hospede $hospede Objeto Hospede (usa ParamConverter)
     *
     * @return Response $response Objeto Response
     *
     * @Route("/reserva/pesquisar/{id}", name="reserva.pesquisaData", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function pesquisaDataAction(Request $request, SessionInterface $session, Hospede $hospede)
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
            $em = $this->getDoctrine()->getManager();
            $quartosDisponiveis = $em->getRepository(Quarto::class)->getQuartosDisponiveis($dataEntrada, $dataSaida);
        }

        return $this->render('reserva/reservar.html.twig', [
            'hospede' => $hospede,
            'quartos' => $quartosDisponiveis
        ]);
    }

    /**
     * Efetua a reserva de um quarto para um hóspede de acordo com a data de entrada e a data de saída
     *
     * @param Request $request Objeto Request
     * @param SessionInterface $session Interface SessionInterface
     * @param integer $id_quarto Id do entidade Quarto
     * @param integer $id_hospede Id do entidade Hospede
     *
     * @return Response $response Objeto Response
     *
     * @Route("/reserva/reservar/{id_quarto}/{id_hospede}", requirements={"id_quarto": "\d+"},
     *    requirements={"id_hospede": "\d+"}, name="reserva.reservar")
     * @Method("GET")
     */
    public function reservarAction(Request $request, SessionInterface $session, $id_quarto, $id_hospede)
    {
        // Obtém os dados da sessão, e depois os apaga
        $dataEntrada = $session->get('dataEntrada');
        $dataSaida = $session->get('dataSaida');
        $session->clear();

        // recupera o quarto pelo parâmetro id_quarto
        $em = $this->getDoctrine()->getManager();
        $quarto = $em->getRepository(Quarto::class)->find($id_quarto);
        $hospede = $em->getRepository(Hospede::class)->find($id_hospede);

        /*echo 'Hóspede: ' . $hospede->getNome() . ', Data de Entrada: ' . $dataEntrada . ', Data de Saída: '
            . $dataSaida . ', Quarto: ' . $quarto->getNome(); */

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

        $em->persist($reserva);
        $em->flush();

        return $this->redirectToRoute('reserva.index');
    }

    /**
     * @Route("/reserva/cancelar/{id}", name="reserva.cancelar", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function cancelarAction(Request $request, $id_hospede)
    {
        return $this->render('reserva/reservar.html.twig', [
            'id_hospede' => $id_hospede
        ]);
    }
}
