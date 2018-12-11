<?php

namespace App\Controller;

use App\Entity\Objednavka;
use App\Form\ObjednavkaType;
use App\Repository\ObjednavkaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/objednavky")
 */
class SpravaObjednavekController extends AbstractController
{
    /**
     * @Route("/", name="sprava_objednavek", methods="GET")
     */
    public function index(ObjednavkaRepository $objednavkaRepository): Response
    {
        return $this->render('sprava_objednavek/index.html.twig', ['objednavky' => $objednavkaRepository->findAll()]);
    }
    /**
     * @Route("/{id}", name="objednavka_show", methods="GET")
     */
    public function show(Objednavka $objednavka): Response
    {
        return $this->render('sprava_objednavek/show.html.twig', ['objednavka' => $objednavka]);
    }
    
    /**
     * @Route("/{id}/edit", name="objednavka_edit", methods="GET|POST")
     */
    public function edit(Request $request, Objednavka $objednavka): Response
    {
        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sprava_objednavek', ['id' => $objednavka->getId()]);
        }

        return $this->render('sprava_objednavek/edit.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="objednavka_delete", methods="DELETE")
     */
    public function delete(Request $request, Objednavka $objednavka): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objednavka->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($objednavka);
            $em->flush();
        }

        return $this->redirectToRoute('sprava_objednavek');
    }
}
