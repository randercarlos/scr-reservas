<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Classe QuartoController
 */
class SegurancaController extends Controller
{
    /**
     * Exibe o formulário de login
     *
     * @param Request $request Objeto Request
     *
     * @return Response $response Objeto Response
     *
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
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
     * Essa rota é usada para logout
     *
     * Essa rota nunca será executada. Symfony interceptará a rota e executará o logout automaticamente
     * Ver em app/config/security.yml
     *
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}
