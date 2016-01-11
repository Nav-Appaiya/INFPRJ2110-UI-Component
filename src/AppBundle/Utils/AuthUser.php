<?php
namespace AppBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthUser
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

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $checkUser = $em->getRepository('AppBundle:Users')->findOneById($userId);
print_r($checkUser); die();


        $this->get('session')->set('userId', $checkUser->getId());
        $this->get('session')->set('username', $checkUser->getUsername());
        $this->get('session')->set('password', md5($checkUser->getPassword()));
    }

}