<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ReportsController extends Controller
{
    /**
     * @Route("/reports", name="reports_index")
     *
     * TODO: Reports genereren en in pdf opvragen
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('AppBundle:Positions');

        $positions = $repo->findAll();

        return $this->render('@App/Pages/reports.html.twig', [
            'positions' => $positions
        ]);
    }
}
