<?php

namespace App\Controller;

use App\Entity\Zeme;
use App\Form\ZemeType;
use App\Repository\ZemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zeme")
 */
class ZemeController extends AbstractController
{
    /**
     * @Route("/", name="zeme_index", methods="GET")
     */
    public function index(ZemeRepository $zemeRepository): Response
    {
        return $this->render('zeme/index.html.twig', ['zemes' => $zemeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="zeme_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $zeme = new Zeme();
        $form = $this->createForm(ZemeType::class, $zeme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zeme);
            $em->flush();

            return $this->redirectToRoute('zeme_index');
        }

        return $this->render('zeme/new.html.twig', [
            'zeme' => $zeme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zeme_show", methods="GET")
     */
    public function show(Zeme $zeme): Response
    {
        return $this->render('zeme/show.html.twig', ['zeme' => $zeme]);
    }

    /**
     * @Route("/{id}/edit", name="zeme_edit", methods="GET|POST")
     */
    public function edit(Request $request, Zeme $zeme): Response
    {
        $form = $this->createForm(ZemeType::class, $zeme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zeme_index', ['id' => $zeme->getId()]);
        }

        return $this->render('zeme/edit.html.twig', [
            'zeme' => $zeme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zeme_delete", methods="DELETE")
     */
    public function delete(Request $request, Zeme $zeme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zeme->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($zeme);
            $em->flush();
        }

        return $this->redirectToRoute('zeme_index');
    }
}
