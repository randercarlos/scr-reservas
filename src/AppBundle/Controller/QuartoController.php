<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Quarto;
use AppBundle\Form\QuartoType;
use Psr\Log\LoggerInterface;

/**
 * Classe QuartoController
 */
class QuartoController extends Controller
{
    /**
     * Lista todos os quartos
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/quartos", name="quarto.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $quartos = $em->getRepository(Quarto::class)->findAllOrdenadoPorNomeEAndar();

        return $this->render('quarto/index.html.twig', [
            'quartos' => $quartos
        ]);
    }

    /**
     * Adiciona um novo quarto
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/quarto/novo", name="quarto.novo")
     * @Method({"GET", "PUT"})
     */
    public function novoAction(Request $request)
    {
        $quarto = new Quarto();
        $form = $this->createForm(QuartoType::class, $quarto, array(
            'method' => 'PUT'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quarto);
            $em->flush();

            $this->addFlash('notice', 'quarto.saved_successfully');
            $this->addFlash('quarto', $quarto->getNome());

            return $this->redirectToRoute('quarto.index');
        }

        return $this->render('quarto/form.html.twig', [
            'quarto' => $quarto,
            'form' => $form->createView()
        ]);
    }

    /**
     * Atualiza um quarto existente
     *
     * @param Request $request Objeto Request
     * @param Quarto $quarto Objeto Quarto para a atualização(usa ParamConverter)
     *
     * @return Response $response Objeto Response
     *
     * @Route("/quarto/{id}", name="quarto.editar", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Quarto $quarto)
    {
        // O objeto Quarto é recuperado automaticamente através do parâmetro {id} da URL.
        // Usando ParamConverter, o Symfony faz uma consulta ao banco de dados e retorna o objeto.
        $form = $this->createForm(QuartoType::class, $quarto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quarto);
            $em->flush();

            $this->addFlash('notice', 'quarto.update_successfully');
            $this->addFlash('quarto', $quarto->getNome());

            return $this->redirectToRoute('quarto.index');
        }

        return $this->render('quarto/form.html.twig', [
            'quarto' => $quarto,
            'form' => $form->createView()
        ]);
    }

    /**
     * Exclui um quarto existente
     *
     * @param Request $request Objeto Request
     * @param Quarto $quarto Objeto Quarto para a exclusão(usa ParamConverter)
     *
     * @return Response $response Objeto Response
     *
     * @Route("/quarto/excluir/{id}", name="quarto.excluir", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function excluirAction(Quarto $quarto, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quarto);
        $em->flush();

        $this->addFlash('notice', 'quarto.deleted_successfully');
        $this->addFlash('quarto', $quarto->getNome());

        return $this->redirectToRoute('quarto.index');
    }
}
