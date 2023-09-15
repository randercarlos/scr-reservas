<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Quarto;
use App\Form\QuartoType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

/**
 * Classe QuartoController
 */
class QuartoController extends AbstractController
{
    /**
     * Lista todos os quartos
     */
	#[Route('/quartos', methods: ['GET'], name: "quarto.index")]
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $quartos = $entityManager->getRepository(Quarto::class)->findAllOrdenadoPorNomeEAndar();

        return $this->render('quarto/index.html.twig', [
            'quartos' => $quartos
        ]);
    }

    /**
     * Adiciona um novo quarto
     */
	#[Route('/quarto/novo', methods: ['GET', 'POST'], name: "quarto.novo")]
    public function novoAction(Request $request, EntityManagerInterface $entityManager)
    {
        $quarto = new Quarto();
        $form = $this->createForm(QuartoType::class, $quarto, array(
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($quarto);
			$entityManager->flush();

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
     */
	#[Route('/quarto/{id}', methods: ['GET', 'POST'], name: "quarto.editar")]
    public function editarAction(Request $request, EntityManagerInterface $entityManager, Quarto $quarto)
    {
        // O objeto Quarto é recuperado automaticamente através do parâmetro {id} da URL.
        // Usando ParamConverter, o Symfony faz uma consulta ao banco de dados e retorna o objeto.
        $form = $this->createForm(QuartoType::class, $quarto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($quarto);
			$entityManager->flush();

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
     */
	#[Route('/quarto/excluir/{id}', methods: ['GET'], name: "quarto.excluir")]
    public function excluirAction(EntityManagerInterface $entityManager, Quarto $quarto)
    {
		try {
			$entityManager->remove($quarto);
			$entityManager->flush();

			$this->addFlash('notice', 'quarto.deleted_successfully');
		} catch(ForeignKeyConstraintViolationException $ex) {
			$this->addFlash('errors', 'quarto.deleted_foreign_failed');
		} catch(\Exception $exception) {
			$this->addFlash('errors', 'quarto.deleted_failed');
		}

		$this->addFlash('quarto', $quarto->getNome());

        return $this->redirectToRoute('quarto.index');
    }
}
