<?php
namespace AppBundle\Utils;

use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthUser
{
    protected $_em;

    public function setEm($em) {
        $this->_em = $em;
    }


    protected function getEm()
    {
        return $this->_em;
    }


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

        $em = $this->getEm();
        $checkUser = $em->getRepository('AppBundle:Users')->findOneById($userId);

        if (!isset($checkUser)) {
            return false;
        }

        if (md5($checkUser->getPassword()) != $session->get('password')) {
            return false;
        }

        if ($checkUser->getUsername() != $session->get('username')) {
            return false;
        }

        return true;
    }

}