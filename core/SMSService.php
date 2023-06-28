<?php

declare(strict_types=1);

class SMSService
{
    public function __construct(
        private string $apiClient = 'mock',
        private string $messageApi = 'mock',
    )
    {
    }

    private function prepareRequestData(string $message, array $receives): array
    {
        if (empty($receives)) {
            $receives = explode(',', ENV['SMS_TO']);
        }

        $message = wordwrap($message, 500, "\r\n");

        return [
            'receives' => $receives,
            'message' => $message
        ];
    }

    private function sendMessageRequest(array $requestData)
    {
    }

    public function sendSMS(string $message, array $receives = []): void
    {
        $this->sendMessageRequest($this->prepareRequestData($message, $receives));
    }
}
