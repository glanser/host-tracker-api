<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.19
 * Time: 0:02
 */

namespace HostTracker\Api;


class Agents extends AbstractApi
{
    /**
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAgents()
    {
        return $this->get('/agents');
    }

    /**
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pools()
    {
        return $this->get('/agents/pools');
    }
}