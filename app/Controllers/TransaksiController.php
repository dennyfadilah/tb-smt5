<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Transaction',
            'surveyor' => $this->surveyorModel->getAllData(),
        ];

        return view('pages/transaksi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Transaction - Create Transaction',
            'komoditas' => $this->komoditasModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll()
        ];

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'marketing_nama' => $this->request->getVar('marketing_nama'),
                'waktu' => $this->request->getVar('waktu'),
                'komoditas_id' => $this->request->getVar('komoditas_id'),
                'lokasi_id' => $this->request->getVar('lokasi_id'),
                'repeat_order' => $this->request->getVar('repeat_order'),
                'hasil_survey' => $this->request->getVar('hasil_survey'),
            ];

            if ($this->surveyorModel->insert($data)) {
                return $this->response->setJSON([
                    'error' => false,
                    'message' => 'Transaction data was successfully added',
                    'redirect' => base_url('transaksi')
                ]);
            } else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => 'Marketing data failed to be added'
                ]);
            }
        }

        return view('pages/transaksi/create', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => 'Transaction - Create Transaction',
            'komoditas' => $this->komoditasModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll(),
            'surveyor' => $this->surveyorModel->find($id)
        ];

        if ($this->request->getMethod() === 'post') {
        }

        return view('pages/transaksi/update', $data);
    }

    public function delete($id)
    {
        if ($this->surveyorModel->delete($id)) {
            return $this->response->setJSON(
                [
                    'error' => false,
                    'message' => 'Transaction data was successfully deleted',
                    'redirect' => base_url('transaksi'),
                ]
            );
        } else {
            return $this->response->setJSON(
                ['error' => true, 'message' => $this->validator->getErrors()]
            );
        }
    }
}