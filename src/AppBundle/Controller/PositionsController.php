<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Positions;
use AppBundle\Form\PositionsType;

/**
 * Positions controller.
 *
 * @Route("/positions")
 */
class PositionsController extends Controller
{
    /**
     * Lists all Positions entities.
     *
     * @Route("/", name="positions_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $positions = $em->getRepository('AppBundle:Positions')->findAll();

        return $this->render('positions/index.html.twig', array(
            'positions' => $positions,
        ));
    }

    /**
     * Creates a new Positions entity.
     *
     * @Route("/new", name="positions_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $position = new Positions();
        $form = $this->createForm('AppBundle\Form\PositionsType', $position);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($position);
            $em->flush();

            return $this->redirectToRoute('positions_show', array('id' => $positions->getId()));
        }

        return $this->render('positions/new.html.twig', array(
            'position' => $position,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Positions entity.
     *
     * @Route("/{id}", name="positions_show")
     * @Method("GET")
     */
    public function showAction(Positions $position)
    {
        $deleteForm = $this->createDeleteForm($position);

        return $this->render('positions/show.html.twig', array(
            'position' => $position,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Positions entity.
     *
     * @Route("/{id}/edit", name="positions_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Positions $position)
    {
        $deleteForm = $this->createDeleteForm($position);
        $editForm = $this->createForm('AppBundle\Form\PositionsType', $position);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($position);
            $em->flush();

            return $this->redirectToRoute('positions_edit', array('id' => $position->getId()));
        }

        return $this->render('positions/edit.html.twig', array(
            'position' => $position,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Positions entity.
     *
     * @Route("/{id}", name="positions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Positions $position)
    {
        $form = $this->createDeleteForm($position);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($position);
            $em->flush();
        }

        return $this->redirectToRoute('positions_index');
    }

    /**
     * Creates a form to delete a Positions entity.
     *
     * @param Positions $position The Positions entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Positions $position)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('positions_delete', array('id' => $position->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
