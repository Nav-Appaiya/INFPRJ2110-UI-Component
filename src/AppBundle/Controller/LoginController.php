<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 06-12-15
 * Time: 17:12
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function indexAction(Request $request) {

        if($request->getMethod() === "POST"){
            $collector = $this->get('collector.api');

            $check = $collector->checkUser(
                $request->request->get('username'),
                $request->request->get('password')
            );

            if($check == true){
                return $this->redirect($this->generateUrl('dashboard'));
            }else{
                $this->get('session')->getFlashBag()->set('error', 'User Not Exist');
                return $this->redirect($this->generateUrl('login'));
            }
        }

        return $this->render('AppBundle:Master:login.html.twig');
    }

    public function registerAction(Request $request)
    {

        return $this->render('AppBundle:Master:register.html.twig');
    }
}
