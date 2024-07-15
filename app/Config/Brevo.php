<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Brevo extends BaseConfig
{
    public $apiKey;

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = env('BREVO_API_KEY');
    }
}
