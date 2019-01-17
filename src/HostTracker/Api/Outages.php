<?php

namespace HostTracker\Api;

/**
 * Outages operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/outages/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Outages extends AbstractApi
{
    /**
     * Get outages for tasks by filter.
     *
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