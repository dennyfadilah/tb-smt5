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
            'title' => 'Create Transaction',
            'komoditas' => $this->komoditasModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'marketing_nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Marketing name must be filled'
                    ]
                ],
                'waktu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Waktu must be filled'
                    ]
                ],
                'komoditas_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Commodity must be filled'
                    ]
                ],
                'lokasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Location must be filled'
                    ]
                ],
                'repeat_order' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Repeat order must be filled'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $input = [
                    'marketing_nama' => $this->request->getPost('marketing_nama'),
                    'waktu' => $this->request->getPost('waktu'),
                    'komoditas_id' => $this->request->getPost('komoditas_id'),
                    'lokasi_id' => $this->request->getPost('lokasi_id'),
                    'repeat_order' => $this->request->getPost('repeat_order'),
                    'hasil_survey' => $this->request->getPost('hasil_survey')
                ];

                if ($this->surveyorModel->insert($input)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'message' => 'Transaction data was successfully added',
                        'redirect' => base_url('transaksi')
                    ]);
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Transaction data failed to be added'
                    ]);
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }

        return view('pages/transaksi/create', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => 'Update Transaction',
            'komoditas' => $this->komoditasModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll(),
            'surveyor' => $this->surveyorModel->find($id)
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'marketing_nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Marketing name must be filled'
                    ]
                ],
                'waktu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Waktu must be filled'
                    ]
                ],
                'komoditas_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Commodity must be filled'
                    ]
                ],
                'lokasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Location must be filled'
                    ]
                ],
                'repeat_order' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Repeat order must be filled'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $input = [
                    'marketing_nama' => $this->request->getPost('marketing_nama'),
                    'waktu' => $this->request->getPost('waktu'),
                    'komoditas_id' => $this->request->getPost('komoditas_id'),
                    'lokasi_id' => $this->request->getPost('lokasi_id'),
                    'repeat_order' => $this->request->getPost('repeat_order'),
                    'hasil_survey' => $this->request->getPost('hasil_survey')
                ];

                if ($this->surveyorModel->update($id, $input)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'message' => 'Transaction data was successfully updated',
                        'redirect' => base_url('transaksi')
                    ]);
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Transaction data failed to be updated',
                    ]);
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
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