<?php
/**
 * Created by PhpStorm.
 * User: Nav, Xander, Tim | HRO groep 4 Project Citygis
 * Date: 06-12-15
 * Time: 17:12
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\AuthUser;

// Deze gaat de verschillende pagina's in admin panel afhandelen
class DashboardController extends Controller
{
    
    public function __construct()
    {
        $authUser = new AuthUser();
        $authUser->checkUserLogin();
    }

    /**
     * indexAction function.
     * 
     * @access public
     * @return void
     */
    public function indexAction(Request $request) {
        return $this->render('AppBundle:Admin:dashboard.html.twig');
    }


    public function registerAction(Request $request)
    {
        return $this->render('AppBundle:Master:register.html.twig');
    }
    
    // Locations page (voorbeeld action om locations template te laden op het url: /locations)
    // Zie Resources/config/routing.yml
    public function locationAction(){
        return $this->render('AppBundle:Admin:location.html.twig');
    }
    
    public function eventAction(){
        return $this->render('AppBundle:Admin:event.html.twig');	    
    }
    
    public function positionAction(){
        return $this->render('AppBundle:Admin:position.html.twig');
    }
    
    public function monitoringAction() {
        return $this->render('AppBundle:Admin:monitoring.html.twig');
    }
    
}
