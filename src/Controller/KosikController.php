<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/kosik")
 */
class KosikController extends AbstractController
{
    /**
     * @Route("/", name="kosik", methods="GET|POST")
     */
    
    public function view(SessionInterface $session): Response
    {
     $kosik = $session->get('kosik', []);
     return $this->render('kosik/index.html.twig',  ['kosik' => $kosik]);
    }
    
    
    /**
     * @Route("/{id}", name="vlozeni_produktu", methods="GET|POST")
     */
    
    public function insert(SessionInterface $session, Product $product): Response
    {
        //$session->set('kosik', []);
        // načtení počtu ze session (defaultní hodnota je 0)
        $kosik = $session->get('kosik', []);
        $kosik[] = ['nazev'=>$product->getNazev(), 'cena'=>$product->getCena(), 'pocet'=>1];
        
              
        // uložení nové hodnoty do session
        $session->set('kosik', $kosik);
        
        // vykreslení šablony
        return $this->redirectToRoute('kosik');
    }
   
    /**
     * @Route("/{id}/edit", name="kosik_edit", methods="GET|POST")
     */
    public function edit(SessionInterface $session, Request $request, Product $product): Response
    {
        $form = $this->createForm(KosikType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kosik', ['id' => $product->getId()]);
        }

        return $this->render('kosik/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    } 
    
  
}
