<?php

namespace HostTracker\Api;


class Stats extends AbstractApi
{
    /**
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStats(array $params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->get('/stats', $params);
    }
}