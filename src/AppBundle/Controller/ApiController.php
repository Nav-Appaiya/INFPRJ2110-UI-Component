<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 06-12-15
 * Time: 14:22
 */
namespace AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Tests\Compiler\C;

class ApiController extends Controller
{
    const API_USER = 'navarajh@gmail.com';
    const API_PASS = 'admin';
    const API_ROOT = 'http://149.210.236.249:8000';
    const API_AUTH = 'http://149.210.236.249:8000/auth-token/';
    const API_EVENTS = 'http://149.210.236.249:8000/events';
    const API_CONNECTIONS = 'http://149.210.236.249:8000/connections';
    const API_MONITORING = 'http://149.210.236.249:8000/monitoring';
    const API_POSITIONS = 'http://149.210.236.249:8000/positions';

    protected $authClient;

    public function __construct()
    {
        $this->authClient = $this->getClientWithToken();
    }


    public function indexAction()
    {
        die("API Controller voor Server 1 / 2 eventueel");
    }

    // Testen met guzzle en de API's
    public function rootAction()
    {
        header('Content-Type: text/plain');
        $client = $this->getClientWithToken();
        $connections = json_decode($client->get('/monitoring')->getBody());

        print_r($this->getUsers());exit;

    }


    /**
     * Nav - 6 December 2015
     * Geeft een GuzzleHttpClient terug
     * die is gevuld met de auth-token die
     * nodig is voor het authenticeren op de
     * webservice van server 1 (django)
     *
     * Met deze client kun je vervolgens verdere
     * endpoints opvragen met:
     * $connections = $this->getClientWithToken()->get('/connections')->getBody();
     *
     * @return Client
     */
    protected function getClientWithToken()
    {
        $client = new Client([
            'base_uri' => self::API_ROOT,
            'headers' => [
                'Authorization' => 'Token '. $this->getToken()
            ]
        ]);

        return $client;
    }


    /**
     * 6 December get auth token from
     * django server at 149.210.236.249:8000
     * Server from HRO in use, note the users/groups endpoints
     *
     * @return mixed
     */
    protected function getToken()
    {
        // First get token at /auth-token/ by posting with username + pass
        $client = new Client();
        $response = $client->request('POST', self::API_AUTH, [
            'form_params' => [
                'username' => self::API_USER,
                'password' => self::API_PASS
            ]
        ]);

        $response = json_decode($response->getBody());
        $token = $response->token;

        return $token;
    }

    protected function getUsers()
    {
        $client = $this->authClient;
        $users = json_decode($client->get('/users')->getBody());

        return $users;
    }

}
