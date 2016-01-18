<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Monitoring;
use AppBundle\Form\MonitoringType;

/**
 * Monitoring controller.
 *
 * @Route("/monitoring")
 */
class MonitoringController extends Controller
{
    /**
     * Lists all Monitoring entities.
     *
     * @Route("/", name="monitoring_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $monitorings = $em->getRepository('AppBundle:Monitoring')->findAll();

        return $this->render('monitoring/index.html.twig', array(
            'monitorings' => $monitorings,
        ));
    }

    /**
     * Creates a new Monitoring entity.
     *
     * @Route("/new", name="monitoring_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $monitoring = new Monitoring();
        $form = $this->createForm('AppBundle\Form\MonitoringType', $monitoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute('monitoring_show', array('id' => $monitoring->getId()));
        }

        return $this->render('monitoring/new.html.twig', array(
            'monitoring' => $monitoring,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Monitoring entity.
     *
     * @Route("/{id}", name="monitoring_show")
     * @Method("GET")
     */
    public function showAction(Monitoring $monitoring)
    {
        $deleteForm = $this->createDeleteForm($monitoring);

        return $this->render('monitoring/show.html.twig', array(
            'monitoring' => $monitoring,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Monitoring entity.
     *
     * @Route("/{id}/edit", name="monitoring_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Monitoring $monitoring)
    {
        $deleteForm = $this->createDeleteForm($monitoring);
        $editForm = $this->createForm('AppBundle\Form\MonitoringType', $monitoring);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute('monitoring_edit', array('id' => $monitoring->getId()));
        }

        return $this->render('monitoring/edit.html.twig', array(
            'monitoring' => $monitoring,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Monitoring entity.
     *
     * @Route("/{id}", name="monitoring_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Monitoring $monitoring)
    {
        $form = $this->createDeleteForm($monitoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($monitoring);
            $em->flush();
        }

        return $this->redirectToRoute('monitoring_index');
    }

    /**
     * Creates a form to delete a Monitoring entity.
     *
     * @param Monitoring $monitoring The Monitoring entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Monitoring $monitoring)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('monitoring_delete', array('id' => $monitoring->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
