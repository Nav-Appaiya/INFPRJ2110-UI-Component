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
use AppBundle\Entity\Users;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {

        $needLogin = true;

        if (!empty($this->get('session')->get('userId'))) {

            if (!empty($this->get('session')->get('username')) && !empty($this->get('session')->get('password'))) {

                $em = $this->getDoctrine()->getEntityManager();
                $checkUser = $em->getRepository('AppBundle:Users')->findOneById($this->get('session')->get('userId'));

                if (md5($checkUser->getPassword()) == $this->get('session')->get('password')) {
                    $needLogin = false;
                }

                if ($checkUser->getUsername() != $this->get('session')->get('username')) {
                    $needLogin = false;
                }

            }
        }

        if ($needLogin === false) {
            return $this->redirect($this->generateUrl('dashboard'));
        }

        if ($request->getMethod() === "POST") {

            $em = $this->getDoctrine()->getEntityManager();

            $checkUser = $em->getRepository('AppBundle:Users')->findOneBy(
                    array('username' => $request->request->get('username'), 
                          'password' => $request->request->get('password')
                    )
                );

            if (!empty($checkUser) && !empty($checkUser->getUsername())) {

                // set user session
                $this->get('session')->set('userId', $checkUser->getId());
                $this->get('session')->set('username', $checkUser->getUsername());
                $this->get('session')->set('password', md5($checkUser->getPassword()));
                $this->get('session')->set('role', $checkUser->getRole());

                return $this->redirect($this->generateUrl('dashboard'));

            } else {
                $this->get('session')->getFlashBag()->set('error', "User doesn't exists");
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
