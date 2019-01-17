<?php

namespace HostTracker\Api;

/**
 * Users operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/stats/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Users extends AbstractApi
{
    /**
     * Get authorization token for requests to other API.
     *
     * @param string $login
     * @param string $password
     * @return false|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function token($login, $password)
    {
        $tmpFile = sys_get_temp_dir() . '/host-tracker-' . $login . '.json';

        if (file_exists($tmpFile)) {
            $result = json_decode(file_get_contents($tmpFile));
            if ($result->expirationUnixTime <= time() + 10) {
                unlink($tmpFile);
            } else {
                return $result;
            }
        }

        $result = $this->post('/users/token', ['login' => $login, 'password' => $password,]);
        file_put_contents($tmpFile, json_encode($result));

        return $result;
    }
}