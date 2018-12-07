<?php

namespace App\Controller;

use App\Entity\Doprava;
use App\Form\DopravaType;
use App\Repository\DopravaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doprava")
 */
class DopravaController extends AbstractController
{
    /**
     * @Route("/", name="doprava_index", methods="GET")
     */
    public function index(DopravaRepository $dopravaRepository): Response
    {
        return $this->render('doprava/index.html.twig', ['dopravas' => $dopravaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="doprava_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $doprava = new Doprava();
        $form = $this->createForm(DopravaType::class, $doprava);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doprava);
            $em->flush();

            return $this->redirectToRoute('doprava_index');
        }

        return $this->render('doprava/new.html.twig', [
            'doprava' => $doprava,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doprava_show", methods="GET")
     */
    public function show(Doprava $doprava): Response
    {
        return $this->render('doprava/show.html.twig', ['doprava' => $doprava]);
    }

    /**
     * @Route("/{id}/edit", name="doprava_edit", methods="GET|POST")
     */
    public function edit(Request $request, Doprava $doprava): Response
    {
        $form = $this->createForm(DopravaType::class, $doprava);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doprava_index', ['id' => $doprava->getId()]);
        }

        return $this->render('doprava/edit.html.twig', [
            'doprava' => $doprava,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doprava_delete", methods="DELETE")
     */
    public function delete(Request $request, Doprava $doprava): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doprava->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($doprava);
            $em->flush();
        }

        return $this->redirectToRoute('doprava_index');
    }
}
