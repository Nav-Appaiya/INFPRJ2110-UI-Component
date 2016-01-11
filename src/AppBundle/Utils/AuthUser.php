<?php
namespace AppBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthUser extends Controller
{

    /**
     * checkUser function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $password
     * @return void
     */
    public function checkUserLogin()
    {
        $session = new Session();
        $userId = $session->get('userId');

        $em = $this->get('doctrine')->getEntityManager();
        $userRepo = $em->getRepository('AppBundle:Users');

        $nav = $userRepo->findOneBy(1);

        print_r($nav);exit;

        $checkUser = $em->getRepository('AppBundle:Users')->findOneById($userId);


        $this->get('session')->set('userId', $checkUser->getId());
        $this->get('session')->set('username', $checkUser->getUsername());
        $this->get('session')->set('password', md5($checkUser->getPassword()));
    }

}