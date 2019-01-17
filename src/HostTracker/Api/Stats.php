<?php

namespace HostTracker\Api;

/**
 * Stats operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/stats/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Stats extends AbstractApi
{
    /**
     * Get uptime statistics for tasks by filter.
     * Here you can specify time interval for statistics and expected SLA.
     * Minimum interval is one day.
     *
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