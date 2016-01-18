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

        $qb = $em->createQueryBuilder();
        $qb->select('count(connections.id)');
        $qb->from('AppBundle:Connections', 'connections');
        $count_connection = $qb->getQuery()->getSingleScalarResult();

        $qb = $em->createQueryBuilder();
        $qb->select('count(event.id)');
        $qb->from('AppBundle:Events', 'event');
        $count_events = $qb->getQuery()->getSingleScalarResult();

        $qb = $em->createQueryBuilder();
        $qb->select('count(monitoring.id)');
        $qb->from('AppBundle:Monitoring', 'monitoring');
        $count_monitoring = $qb->getQuery()->getSingleScalarResult();

        $qb = $em->createQueryBuilder();
        $qb->select('count(positions.id)');
        $qb->from('AppBundle:Positions', 'positions');
        $count_positions = $qb->getQuery()->getSingleScalarResult();

        $positions = $query = $em->createQuery('SELECT p FROM AppBundle:Positions p WHERE p.speed > 3 ORDER BY p.id DESC');
        $positions = $positions->setMaxResults(500)->getResult();

        // convert positions from RD to wgs
        $wgsPositions = array();
        if (!empty($positions)) {
            foreach ($positions as $position) {
                $wgsPostions = $this->rd2wgs84($position->getrDx(), $position->getrDy());
                $position->setrDx($wgsPostions['latitude']);
                $position->setrDy($wgsPostions['longitude']);
            }
        }

        return $this->render('AppBundle:Admin:dashboard.html.twig', array(
            'count_connections'       => $count_connection,
            'count_positions'         => $count_positions,
            'count_events'            => $count_events,
            'count_monitorings'       => $count_monitoring,
            'limit_positions'         => $positions
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


    /**
     * rd2wgs84 function.
     *
     * @access public
     * @param int $x
     * @param int $y
     * @return array
     */
    public function rd2wgs84($x, $y)
    {
        $rd_x_base        = 155000; // = X0            1 Base RD coordinates Amersfoort
        $rd_y_base        = 463000; // = Y0            2
        $wgs84_lattitude_base = 52.15517440; // = φ0            1 Same base, but as wgs84 coordinates
        $wgs84_longitude_base =  5.38720621; // = λ0            2
        $rd_x_coordinate  = $x;
        $rd_y_coordinate  = $y;
        $calc_latt = 0;
        $calc_long = 0;
        $Kpq[0][1]                    =     3235.65389;
        $Kpq[2][0]                    =      -32.58297;
        $Kpq[0][2]                    =       -0.24750;
        $Kpq[2][1]                    =       -0.84978;
        $Kpq[0][3]                    =       -0.06550;
        $Kpq[2][2]                    =       -0.01709;
        $Kpq[1][0]                    =       -0.00738;
        $Kpq[4][0]                    =        0.00530;
        $Kpq[2][3]                    =       -0.00039;
        $Kpq[4][1]                    =        0.00033;
        $Kpq[1][1]                    =       -0.00012;
        $Lpq[1][0]                    = 5260.52916;
        $Lpq[1][1]                    =      105.94684;
        $Lpq[1][2]                    =        2.45656;
        $Lpq[3][0]                    =       -0.81885;
        $Lpq[1][3]                    =        0.05594;
        $Lpq[3][1]                    =       -0.05607;
        $Lpq[0][1]                    =        0.01199;
        $Lpq[3][2]                    =       -0.00256;
        $Lpq[1][4]                    =        0.00128;
        $Lpq[0][2]                    =        0.00022;
        $Lpq[2][0]                    =       -0.00022;
        $Lpq[5][0]                    =        0.00026;
        $d_lattitude                  = ($x - $rd_x_base) * 0.00001;         // dX = (X - X0) 10^5
        $d_longitude                  = ($y - $rd_y_base) * 0.00001;         // dY = (Y - Y0) 10^5
        $pmax = 5;
        $qmax = 4;
        for($p = 0; $p <= $pmax; $p++)
        {
            for($q = 0; $q <= $qmax; $q++)
            {
                if( isset($Kpq[$p][$q])) {
                    $calc_latt += $Kpq[$p][$q] * pow($d_lattitude, $p) * pow($d_longitude, $q);
                }
                if( isset($Lpq[$p][$q])) {
                    $calc_long += $Lpq[$p][$q] * pow($d_lattitude, $p) * pow($d_longitude, $q);
                }
            }
        }
        $wgs84_lattitude  = $wgs84_lattitude_base + ($calc_latt / 3600);
        $wgs84_longitude  = $wgs84_longitude_base + ($calc_long / 3600);

        return array("latitude" => $wgs84_lattitude, "longitude" => $wgs84_longitude);
    }

}
