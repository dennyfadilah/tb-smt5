<?php

namespace App\Controllers;

class HomeController extends BaseController
{   
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data["title"] = "Dashboard";
        $data["list_lokasi"] = $this->surveyorModel->getLokasiCount(true);
        
        $data["list_specific"] = $this->surveyorModel->getSpecificCount();
        $data["list_lokasi"] = $this->surveyorModel->getLokasiCount();
        $data["list_komoditas"] = $this->surveyorModel->getKomoditasCount();

        return view('pages/home/index', $data);
    }
}