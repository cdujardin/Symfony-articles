<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Auteur;
use AppBundle\Form\AuteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/auteur")
 */
class AuteurController extends Controller
{
    /**
     * @Route("/", name="auteur_list")
     */
    public function indexAction()
    {
        $auteurs = $this
            ->getDoctrine()
            ->getRepository(Auteur::class)
            ->findAll();

        return $this->render('auteur/index.html.twig', [
            'auteurs' => $auteurs,
        ]);
    }

    /**
     * @Route("/new", name="auteur_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(AuteurType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Auteur créé avec succès !');

            return $this->redirectToRoute('auteur_list');
        }

        return $this->render('auteur\new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="auteur_edit")
     */
    public function editAction(Request $request, Auteur $auteur)
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Auteur modifié avec succès !');

            return $this->redirectToRoute('auteur_list');
        }

        return $this->render('auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="auteur_delete")
     */
    public function deleteAction(Auteur $auteur)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($auteur);
        $entityManager->flush();

        $this->addFlash('success', 'Auteur supprimé !');

        return $this->redirectToRoute('auteur_list');
    }
}
