<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Hospede;
use AppBundle\Form\HospedeType;

class HospedeController extends Controller
{

    /**
     * Lista todos os hóspedes cadastrados
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/hospedes", name="hospede.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $hospedes = $em->getRepository(Hospede::class)->findAllOrdenadoPorNome();

        return $this->render('hospede/index.html.twig', [
            'hospedes' => $hospedes
        ]);
    }

    /**
     * Adiciona um novo quarto
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/hospede/novo", name="hospede.novo")
     * @Method({"GET", "PUT"})
     */
    public function novoAction(Request $request)
    {
        $hospede = new Hospede();
        $form = $this->createForm(HospedeType::class, $hospede, array(
            'method' => 'PUT'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hospede);
            $em->flush();

            $this->addFlash('notice', 'hospede.saved_successfully');
            $this->addFlash('hospede', $hospede->getNome());

            return $this->redirectToRoute('hospede.index');
        }

        return $this->render('hospede/form.html.twig', [
            'hospede' => $hospede,
            'form' => $form->createView()
        ]);
    }

    /**
     * Atualiza um hóspede existente
     *
     * @param Request $request Objeto Request
     * @param Hospede $quarto Objeto Hospede para a atualização(usa ParamConverter)
     *
     * @return Response $response Objeto Response
     *
     * @Route("/hospede/editar/{id}", name="hospede.editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Hospede $hospede)
    {
        // O objeto Hospede é recuperado automaticamente através do parâmetro {id} da URL.
        // Usando ParamConverter, o Symfony faz uma consulta ao banco de dados e retorna o objeto.
        $form = $this->createForm(HospedeType::class, $hospede);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hospede);
            $em->flush();

            $this->addFlash('notice', 'quarto.update_successfully');
            $this->addFlash('hospede', $hospede->getNome());

            return $this->redirectToRoute('hospede.index');
        }

        return $this->render('hospede/form.html.twig', [
            'quarto' => $hospede,
            'form' => $form->createView()
        ]);
    }
}
