<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AlertsController extends Controller
{
    /**
     * @Route("/alerts", name="alerts_index")
     *
     * TODO: Reports genereren en in pdf opvragen
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@App/Pages/alerts.html.twig');
    }
}
