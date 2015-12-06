<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    protected $api;

    public function indexAction()
    {
        die("API Controller voor Server 1 / 2 eventueel");
    }

    public function rootAction()
    {
        // See app/config/parameters.yml for this configuration
        $api_url = $this->container->getParameter('api_url');
        


    }


}
