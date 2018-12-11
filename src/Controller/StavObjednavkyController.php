<?php

namespace App\Controller;

use App\Entity\StavObjednavky;
use App\Form\StavObjednavkyType;
use App\Repository\StavObjednavkyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/stav_objednavky")
 */
class StavObjednavkyController extends AbstractController
{
    /**
     * @Route("/", name="stav_objednavky_index", methods="GET")
     */
    public function index(StavObjednavkyRepository $stavObjednavkyRepository): Response
    {
        return $this->render('stav_objednavky/index.html.twig', ['stav_objednavkies' => $stavObjednavkyRepository->findAll()]);
    }

    /**
     * @Route("/new", name="stav_objednavky_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $stavObjednavky = new StavObjednavky();
        $form = $this->createForm(StavObjednavkyType::class, $stavObjednavky);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stavObjednavky);
            $em->flush();

            return $this->redirectToRoute('stav_objednavky_index');
        }

        return $this->render('stav_objednavky/new.html.twig', [
            'stav_objednavky' => $stavObjednavky,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stav_objednavky_show", methods="GET")
     */
    public function show(StavObjednavky $stavObjednavky): Response
    {
        return $this->render('stav_objednavky/show.html.twig', ['stav_objednavky' => $stavObjednavky]);
    }

    /**
     * @Route("/{id}/edit", name="stav_objednavky_edit", methods="GET|POST")
     */
    public function edit(Request $request, StavObjednavky $stavObjednavky): Response
    {
        $form = $this->createForm(StavObjednavkyType::class, $stavObjednavky);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stav_objednavky_index', ['id' => $stavObjednavky->getId()]);
        }

        return $this->render('stav_objednavky/edit.html.twig', [
            'stav_objednavky' => $stavObjednavky,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stav_objednavky_delete", methods="DELETE")
     */
    public function delete(Request $request, StavObjednavky $stavObjednavky): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stavObjednavky->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stavObjednavky);
            $em->flush();
        }

        return $this->redirectToRoute('stav_objednavky_index');
    }
}
