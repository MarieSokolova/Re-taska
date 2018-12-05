<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjednavkovyFormularController extends AbstractController
{
    /**
     * @Route("/objednavka", name="objednavkovy_formular")
     */
    public function index()
    {
        return $this->render('objednavkovy_formular/index.html.twig', [
            'controller_name' => 'ObjednavkovyFormularController',
        ]);
    }
}
