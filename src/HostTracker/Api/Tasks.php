<?php

namespace HostTracker\Api;

/**
 * Tasks operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/tasks/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Tasks extends AbstractApi
{
    /**
     * Get array of accepted task intervals.
     * Currently accepted [1,5,15,30,60].
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function intervals()
    {
        return $this->get('/tasks/intervals');
    }

    /**
     * Get array of accepted task types.
     * Currently ["Http","Ping","Port"] for all operations, ["Database","Snmp"] - read only, "Counter" - in development
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function types()
    {
        return $this->get('/tasks/types');
    }

    /**
     * Get all tasks or filtered via query string parameters.
     *
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
     * Get task by id (GUID).
     *
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTask($guid)
    {
        return $this->get('/tasks/' . $guid);
    }

    /**
     * Create http task.
     *
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
     * Create ping task.
     *
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
     * Create port task.
     *
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
     * Update general task parameters.
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateTasks($params = [])
    {
        return $this->put('/tasks', $params);
    }

    /**
     * Update http task.
     *
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
     * Update ping task.
     *
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
     * Update port task.
     *
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
     * Delete task specified by id (GUID).
     *
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTask($guid)
    {
        return $this->delete('/tasks/' . $guid);
    }

    /**
     * Delete tasks by filter specified in query string.
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTasks($params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->delete('/tasks', $params);
    }

    // TODO create batched creation and/or update
}