<?php

namespace HostTracker\Api;

use HostTracker\Client;

/**
 * Abstract Api class for Host-Tracker.com API
 *
 * @see https://www.host-tracker.com/api/web/v1/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
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
     * @param string $type
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post($path, array $data = [], $type = 'json')
    {
        return $this->client->post($path, $data, $type);
    }

    /**
     * Perform the client get() method.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get($path, array $data = [], $type = 'query')
    {
        return $this->client->get($path, $data, $type);
    }

    /**
     * Perform the client put() method.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function put($path, array $data = [], $type = 'json')
    {
        return $this->client->put($path, $data, $type);
    }

    /**
     * Perform the client delete() method.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function delete($path, array $data = [], $type = 'query')
    {
        return $this->client->delete($path, $data, $type);
    }

    /**
     * Perform the client patch() method.
     *
     * @param string $path
     * @param array $data
     * @param string $type
     *
     * @return string|false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function patch($path, array $data = [],  $type = 'json')
    {
        return $this->client->patch($path, $data, $type);
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