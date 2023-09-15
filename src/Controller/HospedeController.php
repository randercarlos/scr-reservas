<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hospede;
use App\Form\HospedeType;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

class HospedeController extends AbstractController
{
    /**
     * Lista todos os hóspedes cadastrados
     */
	#[Route('/hospedes', methods: ['GET'], name: "hospede.index")]
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $hospedes = $entityManager->getRepository(Hospede::class)->findAllOrdenadoPorNome();

        return $this->render('hospede/index.html.twig', [
            'hospedes' => $hospedes
        ]);
    }

    /**
     * Adiciona um novo quarto
     */
	#[Route('/hospedes/novo',  methods: ['GET', 'POST'], name: "hospede.novo")]
    public function novoAction(Request $request, EntityManagerInterface $entityManager)
    {
        $hospede = new Hospede();
        $form = $this->createForm(HospedeType::class, $hospede, array(
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($hospede);
			$entityManager->flush();

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
     */
	#[Route('/hospedes/editar/{id}', methods: ['GET', 'POST'], name: "hospede.editar")]
    public function editarAction(Request $request, EntityManagerInterface $entityManager, Hospede $hospede)
    {
        // O objeto Hospede é recuperado automaticamente através do parâmetro {id} da URL.
        // Usando ParamConverter, o Symfony faz uma consulta ao banco de dados e retorna o objeto.
//		$hospede = $entityManager->getRepository(Hospede::class)->find($id);
        $form = $this->createForm(HospedeType::class, $hospede);

//		dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($hospede);
			$entityManager->flush();

            $this->addFlash('notice', 'hospede.update_successfully');
            $this->addFlash('hospede', $hospede->getNome());

            return $this->redirectToRoute('hospede.index');
        }

        return $this->render('hospede/form.html.twig', [
            'hospede' => $hospede,
            'form' => $form->createView()
        ]);
    }
}
