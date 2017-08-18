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
        $hospedes[] = ['titulo' => 'Sr.', 'nome' => 'Agostinho Carrara', 'email' => 'acarraga@gmail.com'];
        $hospedes[] = ['titulo' => 'Sra.', 'nome' => 'Júlia Santos', 'email' => 'jsantos@gmail.com'];
        $hospedes[] = ['titulo' => 'Sr.', 'nome' => 'Pedro Cardoso', 'email' => 'pcardoso@gmail.com'];
        $hospedes[] = ['titulo' => 'Sra.', 'nome' => 'Maria Silvia', 'email' => 'msilvia@gmail.com'];
        $hospedes[] = ['titulo' => 'Sr.', 'nome' => 'Alan Pedro', 'email' => 'apedro@gmail.com'];

        // replace this example code with whatever you need
        return $this->render('hospede/index.html.twig', [
            'hospedes' => $hospedes
        ]);
    }
}
