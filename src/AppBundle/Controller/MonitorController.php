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

class MonitorController extends Controller
{
    /**
     * indexAction function.
     * 
     * @access public
     * @return void
     */
    public function indexAction(Request $request) {
        return $this->render('AppBundle:Pages:monitor.html.twig');
    }


    public function registerAction(Request $request)
    {

        return $this->render('AppBundle:Master:register.html.twig');
    }
}
