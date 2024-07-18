<?php

namespace App\Libraries;

use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use Config\Brevo;
use Exception;

class BrevoLibrary
{
    private $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', (new Brevo())->apiKey);
        $this->apiInstance = new TransactionalEmailsApi(new Client(), $config);
    }

    public function sendVerificationEmail($to, $subject, $content)
    {
        $sendSmtpEmail = new \Brevo\Client\Model\SendSmtpEmail([
            'to' => [['email' => $to]],
            'sender' => ['email' => 'tes.mail@mail.com'],
            'subject' => $subject,
            'htmlContent' => $content
        ]);

        try {
            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Exception when sending email: ' . $e->getMessage());
            return false;
        }
    }
}