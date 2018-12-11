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

            return $this->redirectToRoute('homepage');
        }

        return $this->render('objednavka/index.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }
}
