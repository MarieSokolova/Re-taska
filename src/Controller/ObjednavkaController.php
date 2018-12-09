<?php

namespace App\Controller;

use App\Entity\Objednavka;
use App\Entity\Product;
use App\Form\ObjednavkaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjednavkaController extends AbstractController
{
    /**
     * @Route("/objednavka/{id}", name="objednavka")
     */
    public function index(Request $request)
    {
        
        $objednavka = new Objednavka();
        
        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('objednavka/index.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }
}
