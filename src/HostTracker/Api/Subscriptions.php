<?php

namespace HostTracker\Api;

/**
 * Subscriptions operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/subscriptions/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Subscriptions extends AbstractApi
{
    /**
     * Get array of accepted alert types.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function alertTypes()
    {
        return $this->get('/subscriptions/alertTypes');
    }

    /**
     * Get array of accepted report types.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reportTypes()
    {
        return $this->get('/subscriptions/reportTypes');
    }

    /**
     * Get all subscriptions, possible filtered by contactId, taskId or subscriptionType.
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSubscriptions($params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->get('/subscriptions', $params);
    }

    /**
     * Create new subscriptions.
     *
     * @param string $taskGuid
     * @param string $contactGuid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createSubscriptions($taskGuid, $contactGuid, array $params = [])
    {
        return $this->post('/subscriptions', [array_merge($params, [
            'taskId' => $taskGuid,
            'contactId' => $contactGuid
        ])]);
    }

    /**
     * Delete new subscriptions.
     *
     * @param string $taskGuid
     * @param string $contactGuid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteSubscriptions($taskGuid, $contactGuid, array $params = [])
    {
        return $this->delete('/subscriptions', [array_merge($params, [
            'taskId' => $taskGuid,
            'contactId' => $contactGuid,
        ])], 'json');
    }
}