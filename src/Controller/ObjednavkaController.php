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
     * @Route("/objednavka_odeslana", name="objednavka_odeslana", methods="GET|POST")
     */
    public function edit(Request $request): Response
    {
           return $this->render('objednavka/sent.html.twig');
    }
    /**
     * @Route("/objednavka/{id}", name="objednavka", methods="GET|POST")
     */
    public function index(Product $product, Request $request)
    {
        
        $objednavka = new Objednavka();
        $objednavka->setNazev($product->getnazev());
        $objednavka->setCena($product->getcena());
        $objednavka->setPocetKusu($product->getpocetKusu());

        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objednavka);
            $em->flush();

            return $this->redirectToRoute('objednavka_odeslana');
        }

        return $this->render('objednavka/index.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }
}
