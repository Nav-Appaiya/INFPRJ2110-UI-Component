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
        return $this->render('@App/Pages/reports.html.twig');
    }
}
