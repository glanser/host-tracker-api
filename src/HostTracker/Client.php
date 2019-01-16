<?php

namespace HostTracker;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\RequestOptions;

/**
 * Host-Tracker.com API client
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 *
 */
class Client
{

    protected $host = 'https://www.host-tracker.com/api/web/v1';

    /**
     * @var Guzzle
     */
    private $guzzle;

    /**
     * @var array APIs
     */
    private $apis = [];

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

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
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, array $data)
    {
        return $this->runRequest($path, 'POST', $data);
    }

    /**
     * HTTP GETs $params to $path.
     *
     * @param string $path
     * @param array $data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $data)
    {
        return $this->runRequest($path, 'GET', $data);
    }

    /**
     * HTTP PUTs $params to $path.
     *
     * @param string $path
     * @param array $data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, array $data)
    {
        return $this->runRequest($path, 'PUT', $data);
    }

    /**
     * HTTP DELETE's $params to $path.
     *
     * @param string $path
     * @param array $data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, array $data)
    {
        return $this->runRequest($path, 'DELETE', $data);
    }

    /**
     *
     * @param string $path
     * @param string $method
     * @param array $data
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function runRequest($path, $method = 'GET', array $data = [])
    {
        // check bearer token
        if (isset($this->token->expirationUnixTime) && $this->token->expirationUnixTime <= (time() + 10)) {
            $this->token = null;
            $this->users->token($this->login, $this->password);
        }

        $headers = [
            'Accept' => 'application/json',
        ];

        if (!empty($this->token)) {
            $headers['Authorization'] = 'Bearer ' . $this->token->ticket;
        }

        $params = [
            'headers' => $headers
        ];

        if (in_array($method, ['GET', 'DELETE'])) {
            $params['query'] = $data;
        } else {
            $params[RequestOptions::JSON] = $data;
        }

        $response = $this->guzzle->request($method, $this->host . $path, $params);

        return json_decode($response->getBody());
    }
}