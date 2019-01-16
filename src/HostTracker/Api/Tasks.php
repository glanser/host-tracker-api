<?php

namespace HostTracker\Api;


class Tasks extends AbstractApi
{
    /**
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function intervals()
    {
        return $this->get('/tasks/intervals');
    }

    /**
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function types()
    {
        return $this->get('/tasks/types');
    }

    /**
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTasks(array $params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->get('/tasks', $params);
    }

    /**
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTask($guid)
    {
        return $this->get('/tasks/' . $guid);
    }

    /**
     * @param $url
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createHttpTask($url, array $params = [])
    {
        return $this->post('/tasks/http', array_merge($params, ['url' => $url]));
    }

    /**
     * @param $host
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createPingTask($host, array $params = [])
    {
        return $this->post('/tasks/ping', array_merge($params, ['host' => $host]));
    }

    /**
     * @param $host
     * @param int $port
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createPortTask($host, $port, array $params = [])
    {
        return $this->post('/tasks/port', array_merge($params, ['host' => $host, 'port' => $port]));
    }

    /**
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateTasks($params = [])
    {
        return $this->put('/tasks', $params);
    }

    /**
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateHttpTask($guid, array $params = [])
    {
        return $this->put('/tasks/http/' . $guid, $params);
    }

    /**
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePingTask($guid, array $params = [])
    {
        return $this->put('/tasks/ping/' . $guid, $params);
    }

    /**
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePortTask($guid, array $params = [])
    {
        return $this->put('/tasks/port/' . $guid, $params);
    }

    /**
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTask($guid)
    {
        return $this->delete('/tasks/' . $guid);
    }

    /**
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTasks($params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->delete('/tasks', $params);
    }
}