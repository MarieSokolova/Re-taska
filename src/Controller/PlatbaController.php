<?php

namespace App\Controller;

use App\Entity\Platba;
use App\Form\PlatbaType;
use App\Repository\PlatbaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/platba")
 */
class PlatbaController extends AbstractController
{
    /**
     * @Route("/", name="platba_index", methods="GET")
     */
    public function index(PlatbaRepository $platbaRepository): Response
    {
        return $this->render('platba/index.html.twig', ['platbas' => $platbaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="platba_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $platba = new Platba();
        $form = $this->createForm(PlatbaType::class, $platba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($platba);
            $em->flush();

            return $this->redirectToRoute('platba_index');
        }

        return $this->render('platba/new.html.twig', [
            'platba' => $platba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platba_show", methods="GET")
     */
    public function show(Platba $platba): Response
    {
        return $this->render('platba/show.html.twig', ['platba' => $platba]);
    }

    /**
     * @Route("/{id}/edit", name="platba_edit", methods="GET|POST")
     */
    public function edit(Request $request, Platba $platba): Response
    {
        $form = $this->createForm(PlatbaType::class, $platba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('platba_index', ['id' => $platba->getId()]);
        }

        return $this->render('platba/edit.html.twig', [
            'platba' => $platba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platba_delete", methods="DELETE")
     */
    public function delete(Request $request, Platba $platba): Response
    {
        if ($this->isCsrfTokenValid('delete'.$platba->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($platba);
            $em->flush();
        }

        return $this->redirectToRoute('platba_index');
    }
}
