<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data["title"] = "Dashboard";

        // Chart Donut
        $chartDonut = $this->chartDonut();
        $data['seriesDonut'] = $chartDonut['series'];
        $data['labels'] = $chartDonut['labels'];

        // Chart Column
        $chartColumn = $this->chartColumn();
        $data['seriesColumn'] = $chartColumn['series'];
        $data['categories'] = $chartColumn['categories'];

        return view('pages/home/index', $data);
    }

    public function chartDonut()
    {
        $jumlahLokasi = $this->surveyorModel->getLokasiCount(true);

        $series = [];
        $labels = [];
        foreach ($jumlahLokasi as $row) {
            $series[] = intval($row['kunjungan']);
            $labels[] = $row['lokasi'];
        }

        return [
            'series' => json_encode($series),
            'labels' => json_encode($labels)
        ];
    }

    public function chartColumn()
    {
        $series = [];
        $categories = [];
        $data = [];

        $survey = $this->surveyorModel->getSurvey(); // Get survey data

        // Grup survey berdasarkan komoditas dan lokasi
        foreach ($survey as $row) {
            $komoditas = $row['komoditas'];
            $lokasi = $row['lokasi'];
            $jumlah = $row['kunjungan'];

            if (!in_array($lokasi, $categories)) {
                $categories[] = $lokasi;
            }

            if (!isset($data[$komoditas])) {
                $data[$komoditas] = [];
            }

            $data[$komoditas][$lokasi] = $jumlah;
        }

        // Buat series berdasarkan data
        foreach ($data as $komoditas => $values) {
            $seriesData = [];
            foreach ($categories as $category) {
                $seriesData[] = $values[$category] ?? 0;
            }
            $series[] = [
                'name' => $komoditas,
                'data' => $seriesData
            ];
        }

        return [
            'categories' => json_encode($categories),
            'series' => json_encode($series)
        ];
    }
}