<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeznamProduktuController extends AbstractController
{
    /**
     * @Route("/produkty", name="seznam_produktu", methods="GET")
     */
     public function index(ProductRepository $productRepository): Response
    {
        return $this->render('seznam_produktu/index.html.twig', ['products' => $productRepository->findAll()]);
    }

}
