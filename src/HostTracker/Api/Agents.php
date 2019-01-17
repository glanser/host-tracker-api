<?php

namespace HostTracker\Api;

/**
 * Agents operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/agents/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Agents extends AbstractApi
{
    /**
     * Get array of HostTracker world monitoring points.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAgents()
    {
        return $this->get('/agents');
    }

    /**
     * Get array of agent regions (Asia, Europe, America) (used for configuring tasks).
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pools()
    {
        return $this->get('/agents/pools');
    }
}