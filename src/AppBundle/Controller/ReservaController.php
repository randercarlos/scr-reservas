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

        return $this->render('reserva/index.html.twig', [
            'reservas' => []
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
