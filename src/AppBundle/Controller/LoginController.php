<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function indexAction(Request $request)
    {
        if($request->getMethod() === "POST"){
            $collector = $this->get('collector.api');
            print_r($collector);exit;
        }
        return $this->render('AppBundle:Master:login.html.twig');
    }

    public function registerAction(Request $request)
    {

        return $this->render('AppBundle:Master:register.html.twig');
    }
}
