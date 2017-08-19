<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ReservaController extends Controller
{
    /**
     * @Route("/reservas", name="reserva.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $reservas = [];
        $reservas[] = ['id' => 1, 'quarto' => ['nome' => '101'], 'hospede' => ['titulo' => 'Sr', 'nome' => 'Leonel'],
        'dataEntrada' => '2017-08-20', 'dataSaida' => '2017-08-22'];
        $reservas[] = ['id' => 2, 'quarto' => ['nome' => '402'], 'hospede' => ['titulo' => 'Dr', 'nome' => 'Augusto'],
        'dataEntrada' => '2017-08-21', 'dataSaida' => '2017-08-24'];
        $reservas[] = ['id' => 3, 'quarto' => ['nome' => '203'], 'hospede' => ['titulo' => 'PhD', 'nome' => 'Marcos'],
        'dataEntrada' => '2017-08-19', 'dataSaida' => '2017-08-21'];

        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas
        ]);
    }

    /**
     * @Route("/reservar/{id_hospede}", name="reserva.reservar")
     * @Method("GET")
     */
    public function reservarAction(Request $request, $id_hospede)
    {
        $quartos = [];
        $quartos[] = ['id' => 1, 'nome' => '101'];
        $quartos[] = ['id' => 2, 'nome' => '604'];
        $quartos[] = ['id' => 3, 'nome' => '403'];
        $quartos[] = ['id' => 4, 'nome' => '204'];

        return $this->render('reserva/reservar.html.twig', [
            'id_hospede' => $id_hospede,
            'quartos' => $quartos
        ]);
    }

    /**
     * @Route("/reserva/cancelar/{id_reserva}", name="reserva.cancelar")
     * @Method("GET")
     */
    public function cancelarAction(Request $request, $id_hospede)
    {
        return $this->render('reserva/reservar.html.twig', [
            'id_hospede' => $id_hospede
        ]);
    }
}
