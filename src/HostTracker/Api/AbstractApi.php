<?php

namespace HostTracker\Api;

use HostTracker\Client;


abstract class AbstractApi
{
    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Perform the client post() method.
     *
     * @param string $path
     * @param array $data
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post($path, array $data = [])
    {
        return $this->client->post($path, $data);
    }

    /**
     * Perform the client get() method.
     *
     * @param string $path
     * @param array $data
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get($path, array $data = [])
    {
        return $this->client->get($path, $data);
    }

    /**
     * Perform the client put() method.
     *
     * @param string $path
     * @param array $data
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function put($path, array $data = [])
    {
        return $this->client->put($path, $data);
    }

    /**
     * Perform the client delete() method.
     *
     * @param string $path
     * @param array $data
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function delete($path, array $data = [])
    {
        return $this->client->delete($path, $data);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    protected function sanitizeParams(array $params)
    {
        // change bool to string
        $params = array_map(function ($value) {
            $value = $value === true ? 'true' : $value;
            $value = $value === false ? 'false' : $value;
            return $value;
        }, $params);
        return $params;
    }

}