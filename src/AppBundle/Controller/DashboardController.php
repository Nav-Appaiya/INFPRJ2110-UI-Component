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
use Symfony\Component\Routing\Annotation\Route;

// Deze gaat de verschillende pagina's in admin panel afhandelen
class DashboardController extends Controller
{

    /**
     * indexAction function.
     * 
     * @access public
     * @return void
     */
    public function indexAction(Request $request) {

        $authUser = new AuthUser();
        $authUser->setEm($this->getDoctrine()->getManager());
        if (!$authUser->checkUserLogin()) {
            return $this->redirect($this->generateUrl('login'));
        }

        $em = $this->getDoctrine()->getEntityManager();
        $connections = $em->getRepository('AppBundle:Connections');
        $positions = $em->getRepository('AppBundle:Positions');
        $events = $em->getRepository('AppBundle:Events');
        $monitoring = $em->getRepository('AppBundle:Monitoring');

        return $this->render('AppBundle:Admin:dashboard.html.twig', array(
            'connections'         => $connections->findAll(),
            'positions'         => $positions->findAll(),
            'events'            => $events->findAll(),
            'monitorings'         => $monitoring->findAll()
        ));
    }

    /**
     * @Route("/maps", name="maps")
     */
    public function mapsAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $positionsRepo = $em->getRepository('AppBundle:Positions');

        print_r($positionsRepo);exit;

        return $this->render('AppBundle:Admin:maps.html.twig');
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
