<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Connections;
use AppBundle\Form\ConnectionsType;

/**
 * Connections controller.
 *
 * @Route("/connections")
 */
class ConnectionsController extends Controller
{
    /**
     * Lists all Connections entities.
     *
     * @Route("/", name="connections_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $connections = $em->getRepository('AppBundle:Connections')->findAll();

        return $this->render('connections/index.html.twig', array(
            'connections' => $connections,
        ));
    }

    /**
     * Creates a new Connections entity.
     *
     * @Route("/new", name="connections_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $connection = new Connections();
        $form = $this->createForm('AppBundle\Form\ConnectionsType', $connection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($connection);
            $em->flush();

            return $this->redirectToRoute('connections_show', array('id' => $connections->getId()));
        }

        return $this->render('connections/new.html.twig', array(
            'connection' => $connection,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Connections entity.
     *
     * @Route("/{id}", name="connections_show")
     * @Method("GET")
     */
    public function showAction(Connections $connection)
    {
        $deleteForm = $this->createDeleteForm($connection);

        return $this->render('connections/show.html.twig', array(
            'connection' => $connection,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Connections entity.
     *
     * @Route("/{id}/edit", name="connections_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Connections $connection)
    {
        $deleteForm = $this->createDeleteForm($connection);
        $editForm = $this->createForm('AppBundle\Form\ConnectionsType', $connection);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($connection);
            $em->flush();

            return $this->redirectToRoute('connections_edit', array('id' => $connection->getId()));
        }

        return $this->render('connections/edit.html.twig', array(
            'connection' => $connection,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Connections entity.
     *
     * @Route("/{id}", name="connections_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Connections $connection)
    {
        $form = $this->createDeleteForm($connection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($connection);
            $em->flush();
        }

        return $this->redirectToRoute('connections_index');
    }

    /**
     * Creates a form to delete a Connections entity.
     *
     * @param Connections $connection The Connections entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Connections $connection)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('connections_delete', array('id' => $connection->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
