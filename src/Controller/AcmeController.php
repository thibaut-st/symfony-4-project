<?php

namespace App\Controller;

use App\Entity\Acme;
use App\Form\AcmeType;
use App\Repository\AcmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acme")
 */
class AcmeController extends Controller
{
    /**
     * @Route("/", name="acme_index", methods="GET")
     */
    public function index(AcmeRepository $acmeRepository): Response
    {
        return $this->render('acme/index.html.twig', ['acmes' => $acmeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="acme_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $acme = new Acme();
        $form = $this->createForm(AcmeType::class, $acme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acme);
            $em->flush();

            return $this->redirectToRoute('acme_index');
        }

        return $this->render('acme/new.html.twig', [
            'acme' => $acme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acme_show", methods="GET")
     */
    public function show(Acme $acme): Response
    {
        return $this->render('acme/show.html.twig', ['acme' => $acme]);
    }

    /**
     * @Route("/{id}/edit", name="acme_edit", methods="GET|POST")
     */
    public function edit(Request $request, Acme $acme): Response
    {
        $form = $this->createForm(AcmeType::class, $acme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acme_edit', ['id' => $acme->getId()]);
        }

        return $this->render('acme/edit.html.twig', [
            'acme' => $acme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acme_delete", methods="DELETE")
     */
    public function delete(Request $request, Acme $acme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acme->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acme);
            $em->flush();
        }

        return $this->redirectToRoute('acme_index');
    }
}
