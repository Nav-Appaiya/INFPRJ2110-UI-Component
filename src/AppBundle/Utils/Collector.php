<?php
namespace AppBundle\Utils;

use GuzzleHttp\Client;


/**
 * Created by PhpStorm.
 * User: nav
 * Date: 06-12-15
 * Time: 19:20
 */
class Collector
{
    const API_USER = 'navarajh@gmail.com';
    const API_PASS = 'admin';
    const API_ROOT = 'http://149.210.236.249:8000';
    const API_AUTH = 'http://149.210.236.249:8000/auth-token/';
    const API_EVENTS = 'http://149.210.236.249:8000/events';
    const API_CONNECTIONS = 'http://149.210.236.249:8000/connections';
    const API_MONITORING = 'http://149.210.236.249:8000/monitoring';
    const API_POSITIONS = 'http://149.210.236.249:8000/positions';

    protected $client;
    protected $token; //90f44a24a6bd93a8ca9c21d0b9e0d81d5ab20da2

    /**
     * Working with my HRO server setup
     * with django on 149.210.236.249:8000
     *
     * Api requires token-based auth and expects authorization
     * token to be sent in each request header.
     *
     * First get token at /auth-token/ and then use that token
     * to auth against endpoints:
     * Authorization: Token $theToken
     *
     * Collector constructor.
     */
    public function __construct()
    {
        $this->token = $this->getToken();
        $this->client = new Client([
            'base_uri' => self::API_ROOT,
            'headers' => [
                'Authorization' => 'Token '. $this->token
            ]
        ]);
    }

    /**
     * 6 December Nav - Get auth token from
     * django server at 149.210.236.249:8000
     * Server from HRO in use, note the users/groups endpoints
     *
     * @return mixed
     */
    public function getToken()
    {
        // We cant rely on working with defined class parameter client
        // as it is not created and loaded with right params yet.
        // So lets just create a new client just to retrieve tokens.
        $client = new Client();

        // First get token at /auth-token/ by posting with username + pass
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

    public function checkUser($username, $password)
    {
        header('Content-Type: text/plain');
        $users = json_decode($this->client->get('/users')->getBody());
        $valid = false;

        foreach ($users as $user) {
            if(strtolower($user->email) == strtolower($username)){
                $valid = $user->auth_token;
            }
        }

        return $valid;
    }

    public function getUsers() {
        $users = json_decode($this->client->get('/users')->getBody());

        return $users;
    }
}