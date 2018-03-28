<?php

namespace App\Controller;

use App\Entity\AcmeParent;
use App\Form\AcmeParentType;
use App\Repository\AcmeParentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acme/parent")
 */
class AcmeParentController extends Controller
{
    /**
     * @Route("/", name="acme_parent_index", methods="GET")
     */
    public function index(AcmeParentRepository $acmeParentRepository): Response
    {
        return $this->render('acme_parent/index.html.twig', ['acme_parents' => $acmeParentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="acme_parent_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $acmeParent = new AcmeParent();
        $form = $this->createForm(AcmeParentType::class, $acmeParent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acmeParent);
            $em->flush();

            return $this->redirectToRoute('acme_parent_index');
        }

        return $this->render('acme_parent/new.html.twig', [
            'acme_parent' => $acmeParent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acme_parent_show", methods="GET")
     */
    public function show(AcmeParent $acmeParent): Response
    {
        return $this->render('acme_parent/show.html.twig', ['acme_parent' => $acmeParent]);
    }

    /**
     * @Route("/{id}/edit", name="acme_parent_edit", methods="GET|POST")
     */
    public function edit(Request $request, AcmeParent $acmeParent): Response
    {
        $form = $this->createForm(AcmeParentType::class, $acmeParent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acme_parent_edit', ['id' => $acmeParent->getId()]);
        }

        return $this->render('acme_parent/edit.html.twig', [
            'acme_parent' => $acmeParent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acme_parent_delete", methods="DELETE")
     */
    public function delete(Request $request, AcmeParent $acmeParent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acmeParent->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acmeParent);
            $em->flush();
        }

        return $this->redirectToRoute('acme_parent_index');
    }
}
