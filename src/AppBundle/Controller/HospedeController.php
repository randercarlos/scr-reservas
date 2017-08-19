<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HospedeController extends Controller
{

    /**
     * @Route("/hospedes", name="hospede.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $hospedes = [];
        $hospedes[] = ['id' => 1, 'titulo' => 'Sr', 'nome' => 'Agostinho Carrara', 'email' => 'acarraga@gmail.com'];
        $hospedes[] = ['id' => 2, 'titulo' => 'Sra', 'nome' => 'Júlia Santos', 'email' => 'jsantos@gmail.com'];
        $hospedes[] = ['id' => 3, 'titulo' => 'Sr', 'nome' => 'Pedro Cardoso', 'email' => 'pcardoso@gmail.com'];
        $hospedes[] = ['id' => 4, 'titulo' => 'Sra', 'nome' => 'Maria Silvia', 'email' => 'msilvia@gmail.com'];
        $hospedes[] = ['id' => 5, 'titulo' => 'Sr', 'nome' => 'Alan Pedro', 'email' => 'apedro@gmail.com'];


        return $this->render('hospede/index.html.twig', [
            'hospedes' => $hospedes
        ]);
    }

    /**
     * @Route("/hospede/novo", name="hospede.novo")
     * @Method("GET")
     */
    public function novoAction(Request $request)
    {

        return $this->render('hospede/form.html.twig', [
            'hospedes' => []
        ]);
    }

    /**
     * @Route("/hospede/editar/{id}", name="hospede.editar")
     * @Method("GET")
     */
    public function editarAction(Request $request, $id)
    {

        return $this->render('hospede/form.html.twig', [
            'hospedes' => []
        ]);
    }
}
