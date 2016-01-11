<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 06-12-15
 * Time: 16:24
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirect($this->generateUrl('login'));
    }

    public function loginAction(Request $request)
    {
        return $this->render('AppBundle:Master:login.html.twig');
    }
    
    public function databaseConnection(){
	    $em = $this->get('doctrine.entitymanager');
    }
}
