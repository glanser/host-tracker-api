<?php

namespace HostTracker\Api;


class Outages extends AbstractApi
{
    /**
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOutages(array $params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->get('/outages', $params);
    }
}