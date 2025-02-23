<?php

namespace Botble\InstantNotifier\Services;

use Botble\InstantNotifier\Models\InstantNotifier;
use PHPMaster\InstantNotifier\Notification;
use Exception;

class NotificationService
{
    private $api_key;
    private $client_id;
    private $notification;

    public function __construct()
    {
        // $this->api_key = env('INSTANTNOTIFIER_API_KEY');
        // $this->client_id = env('INSTANTNOTIFIER_CLIENT_ID');

        $this->api_key = setting('instantnotifier_api_key');
        $this->client_id = setting('instantnotifier_client_id');

        if (!$this->api_key || !$this->client_id) {
            throw new Exception("Missing API credentials: Set Instant Notifier API Key and Client Id in admin settings.");
        }

        $this->notification = new Notification($this->api_key, $this->client_id);
    }

    public function send(string $title, string $message)
    {
        if (empty($title)) {
            throw new Exception("Title cannot be empty.");
        }

        if (empty($message)) {
            throw new Exception("Message cannot be empty.");
        }

        $response = $this->notification->send($title, $message);
        $this->saveMessage($title, $message, 'custom', $response);

        return $response;
    }

    public function sendFormData(string $title, string $heading, array $params)
    {
        if (empty($title)) {
            throw new Exception("Title cannot be empty.");
        }

        if (empty($heading)) {
            throw new Exception("Heading cannot be empty.");
        }

        if (empty($params)) {
            throw new Exception("Params cannot be empty.");
        }

        $message = $this->notification->formMessage($heading, $params);
        $response = $this->notification->send($title, $message);

        $this->saveMessage($title, $message, 'form', $response);

        return $response;
    }

    private function saveMessage(string $title, $message, string $type, $response)
    {
        if (is_array($message)) {
            $message = json_encode($message, JSON_UNESCAPED_UNICODE);
        }

        if (is_array($response)) {
            $response = json_encode($response, JSON_UNESCAPED_UNICODE);
        }

        InstantNotifier::create([
            'name'           => $title,
            'message'        => $message,
            'message_status' => 'sent',
            'response'       => $response,
            'message_type'   => $type,
        ]);
    }
}
