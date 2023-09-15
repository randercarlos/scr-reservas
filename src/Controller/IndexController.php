<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
	#[Route('/', methods: ['GET'], name: "index.homepage")]
    public function indexAction(Request $request)
    {
        return $this->render('index/index.html.twig');
    }
}
