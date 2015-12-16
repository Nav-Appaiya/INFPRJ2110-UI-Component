<?php
/**
 * Created by PhpStorm.
 * User: Xander
 * Date: 06-12-15
 * Time: 17:12
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * indexAction function.
     * 
     * @access public
     * @return void
     */
    public function indexAction(Request $request) {
        return $this->render('AppBundle:Admin:master.html.twig');
    }


    public function registerAction(Request $request)
    {

        return $this->render('AppBundle:Master:register.html.twig');
    }
}
