<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe QuartoController
 */
class SegurancaController extends AbstractController
{
    /**
     * Exibe o formulário de login
     */
	#[Route('/login', methods: ['GET', 'POST', 'PUT'], name: "login")]
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // obtém os erros do form de login, se houver
        $erros = $authUtils->getLastAuthenticationError();

        // obtém o último nome informado pelo usuário
        $ultimoUsernameDigitado = $authUtils->getLastUsername();

        return $this->render('seguranca/login.html.twig', [
            'ultimo_username' => $ultimoUsernameDigitado,
            'erros'           => $erros
        ]);
    }

    /**
     * Essa rota é usada para logout. Essa rota nunca será executada. Symfony interceptará a rota e executará o logout automaticamente.
	 * Ver em app/config/security.yml
     */
	#[Route('/logout', methods: ['GET'], name: "logout")]
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}
