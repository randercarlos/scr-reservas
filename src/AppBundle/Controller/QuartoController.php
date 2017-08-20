<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class QuartoController extends Controller
{
    /**
     * @Route("/quartos", name="quarto.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $quartos = [];
        $quartos[] = ['id' => 1, 'nome' => '101', 'andar' => '1º', 'descricao' =>
            'Adaptado para deficiente físicos'];
        $quartos[] = ['id' => 2, 'nome' => '502', 'andar' => '5º', 'descricao' =>
            'Quarto com vista em frente para a balada é demais'];
        $quartos[] = ['id' => 3, 'nome' => '202', 'andar' => '2º', 'descricao' => 'Possui vista para o piscinão da Sé'];
        $quartos[] = ['id' => 4, 'nome' => '403', 'andar' => '4º', 'descricao' => ''];
        $quartos[] = ['id' => 5, 'nome' => '1AF', 'andar' => 'terraço',
            'descricao' => 'Suíte Presidencial com Frigobar, TV de Plasma 40\', luxo e vista para a baía de Angra'];

        return $this->render('quarto/index.html.twig', [
            'quartos' => $quartos
        ]);
    }

    /**
     * @Route("/quarto/novo", name="quarto.novo")
     * @Method("GET")
     */
    public function novoAction(Request $request)
    {
        return $this->render('quarto/form.html.twig', [
            
        ]);
    }
}
