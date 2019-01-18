<?php

namespace HostTracker;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\RequestOptions;

/**
 * Host-Tracker.com API client
 *
 * @see https://www.host-tracker.com/api/web/v1/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Client
{

    protected $host = 'https://www.host-tracker.com/api/web/v1';

    /**
     * Guzzle Http client
     *
     * @var Guzzle
     */
    private $guzzle;

    /**
     * Loaded APIs
     *
     * @var array APIs
     */
    private $apis = [];

    /**
     * Bearer token
     *
     * @var \stdClass
     */
    private $token;

    /**
     * Host-Tracker login
     *
     * @var string
     */
    private $login;

    /**
     * Host-Tracker password
     *
     * @var string
     */
    private $password;

    /**
     * API classes for getter autoload
     *
     * @var array
     */
    private $classes = [
        'users' => 'Users',
        'tasks' => 'Tasks',
        'agents' => 'Agents',
        'contacts' => 'Contacts',
        'subscriptions' => 'Subscriptions',
        'stats' => 'Stats',
        'outages' => 'Outages',
        ];

    /**
     * Client constructor.
     *
     * @param $login
     * @param $password
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;

        $this->guzzle = new Guzzle();
        $this->token = $this->users->token($login, $password);
    }

    /**
     * PHP getter magic method.
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return Api\AbstractApi
     */
    public function __get($name)
    {
        return $this->api($name);
    }

    /**
     * API loader
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return Api\AbstractApi
     */
    public function api($name)
    {
        if (!isset($this->classes[$name])) {
            throw new \InvalidArgumentException();
        }
        if (isset($this->apis[$name])) {
            return $this->apis[$name];
        }
        $class = 'HostTracker\Api\\' . $this->classes[$name];
        $this->apis[$name] = new $class($this);
        return $this->apis[$name];
    }

    /**
     * HTTP POSTs $params to $path.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, array $data, $type)
    {
        return $this->runRequest($path, 'POST', $data, $type);
    }

    /**
     * HTTP GETs $params to $path.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $data, $type)
    {
        return $this->runRequest($path, 'GET', $data, $type);
    }

    /**
     * HTTP PUTs $params to $path.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, array $data, $type)
    {
        return $this->runRequest($path, 'PUT', $data, $type);
    }

    /**
     * HTTP DELETE's $params to $path.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, array $data, $type)
    {
        return $this->runRequest($path, 'DELETE', $data, $type);
    }

    /**
     * HTTP PATCH's $params to $path.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch($path, array $data, $type)
    {
        return $this->runRequest($path, 'PATCH', $data, $type);
    }

    /**
     * Run request to REST API
     *
     * @param string $path
     * @param string $method
     * @param array $data
     * @param string $type
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function runRequest($path, $method = 'GET', array $data, $type)
    {
        $this->checkBearerToken();

        return json_decode(
            $this->guzzle->request(
                $method, 
                $this->host . $path, 
                $this->bringParams())
            ->getBody(), 
            false
        );
    }

    /**
     *
     */
    protected function checkBearerToken()
    {
        if (isset($this->token->expirationUnixTime) && $this->token->expirationUnixTime <= (time() + 10)) {
            $this->token = null;
            $this->users->token($this->login, $this->password);
        }
    }

    /**
     * @return array
     */
    protected function bringParams()
    {
        $headers = ['Accept' => 'application/json',];
        if (!empty($this->token)) {
            $headers['Authorization'] = 'Bearer ' . $this->token->ticket;
        }

        return [
            'headers' => $headers,
            $type => $data,
        ];
    }
}