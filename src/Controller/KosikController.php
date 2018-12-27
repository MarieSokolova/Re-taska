<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class KosikController extends AbstractController
{
    /**
     * @Route("/kosik/{id}", name="vlozeni_produktu")
     */
    
public function insert(SessionInterface $session, Product $product): Response
    {
        // načtení počtu ze session (defaultní hodnota je 0)
        $kosik = $session->get('kosik', []);
        $kosik[] = ['name'=>$product->getNazev(), 'cena'=>$product->getCena(), 'pocet'=>1];
        
              
        // uložení nové hodnoty do session
        $session->set('kosik', $kosik);
        
        // vykreslení šablony
        $this->redirect('kosik');
    }
    /**
     * @Route("/kosik", name="kosik")
     */
    
public function view(SessionInterface $session): Response
{
     $kosik = $session->get('kosik', []);
     $this->render('kosik/index.html.twig',  ['kosik' => $kosik]);
}
  
}
