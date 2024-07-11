<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SurveyorModel;
use CodeIgniter\HTTP\ResponseInterface;


class ChartController extends BaseController
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->webTitle = "Bagan";
    }

    public function donutChart()
    {
        $data["title"] = $this->webTitle;
        $data["list_lokasi"] = $this->surveyorModel->getLokasiCount(true);

        return view("pages/chart/donut", $data);
    }

    public function columnChart()
    {
        $data["title"] = $this->webTitle;
        $data["list_specific"] = $this->surveyorModel->getSpecificCount();
        $data["list_lokasi"] = $this->surveyorModel->getLokasiCount();
        $data["list_komoditas"] = $this->surveyorModel->getKomoditasCount();

        return view("pages/chart/column", $data);
    }

    public function randomin(){
        
    }
}
