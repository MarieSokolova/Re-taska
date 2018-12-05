<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailProduktuController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="detail_produktu", methods="GET")
     */
    public function detail(Product $product): Response
    {
        return $this->render('detail_produktu/index.html.twig', ['product' => $product]);
    }
}

