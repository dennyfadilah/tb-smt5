<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Brevo extends BaseConfig
{
    public $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('BREVO_API_KEY');
    }
}