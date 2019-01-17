<?php

namespace HostTracker\Api;

/**
 * Contacts operations.
 *
 * @see https://www.host-tracker.com/api/web/v1/contacts/help
 *
 * @author Sergey Ananskikh <sergey at ananskikh dot ru>
 */
class Contacts extends AbstractApi
{

    /**
     * Get array of accepted contact types.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function types()
    {
        return $this->get('/contacts/types');
    }

    /**
     * Get array of accepted contact alert delays in minutes.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delays()
    {
        return $this->get('/contacts/delays');
    }

    /**
     * Get array of accepted sms gateways.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function smsGateways()
    {
        return $this->get('/contacts/sms/gateways');
    }

    /**
     * Get array of accepted instant messaging gateways.
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function imGateways()
    {
        return $this->get('/contacts/im/gateways');
    }

    /**
     * Get all contacts, possible filtered by url query string.
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContacts($params = [])
    {
        $params = $this->sanitizeParams($params);
        return $this->get('/contacts', $params);
    }

    /**
     * Get contact by id (GUID).
     *
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContact($guid)
    {
        return $this->get('/contacts/' . $guid);
    }

    /**
     * Create email contact.
     *
     * @param string $address
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createEmailContact($address, array $params = [])
    {
        return $this->post('/contacts/email', array_merge($params, ['address' => $address]));
    }

    /**
     * Create sms contact. Address without plus "+".
     *
     * @param string $address
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createSmsContact($address, array $params = [])
    {
        return $this->post('/contacts/sms', array_merge($params, ['address' => $address]));
    }

    /**
     * Create instant messaging contact.
     *
     * @param string $address
     * @param string $gateway
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createImContact($address, $gateway, array $params = [])
    {
        return $this->post('/contacts/im', array_merge($params, ['address' => $address, 'gateway' => $gateway]));
    }

    /**
     * Create voice call contact. Address without plus "+".
     *
     * @param string $address
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createVoiceContact($address, array $params = [])
    {
        return $this->post('/contacts/voice', array_merge($params, ['address' => $address]));
    }

    /**
     * Update general contacts parameters (delay, name, activity period, etc.).
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateContacts(array $params)
    {
        return $this->put('/contacts', $params);
    }

    /**
     * Update email contact.
     *
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateEmailContact($guid, array $params)
    {
        return $this->put('/contacts/email/' . $guid, $params);
    }

    /**
     * Update sms contact.
     *
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateSmsContact($guid, array $params)
    {
        return $this->put('/contacts/sms/' . $guid, $params);
    }

    /**
     * Update instant messaging contact.
     *
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateImContact($guid, array $params)
    {
        return $this->put('/contacts/im/' . $guid, $params);
    }

    /**
     * Update voice call contact.
     *
     * @param string $guid
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateVoiceContact($guid, array $params)
    {
        return $this->put('/contacts/voice/' . $guid, $params);
    }

    /**
     * Delete contact specified by id (GUID).
     *
     * @param $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContact($guid)
    {
        return $this->delete('/contacts/' . $guid);
    }

    /**
     * Delete contacts specified by filter or all contacts
     *
     * @param array $params
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContacts(array $params = [])
    {
        return $this->delete('/contacts' , $params);
    }

    /**
     * Confirm contact by sending confirmation code.
     *
     * @param string $guid
     * @param string $code
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function codeContactConfirm($guid, $code)
    {
        return $this->post('/contacts/' . $guid . '/code', ['code' => $code]);
    }

    /**
     * Possible regenerate confirmation code and resend it to contact address
     *
     * @param string $guid
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function codeContactRegenerate($guid)
    {
        return $this->patch('/contacts/' . $guid . '/code');
    }

    // TODO create batched creation and/or update
}