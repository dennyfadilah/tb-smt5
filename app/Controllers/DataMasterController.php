<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DataMasterController extends BaseController
{


    //SUBMENU MARKETING
    public function index_marketing()
    {
        $data = [
            'title' => 'Data Master - Marketing',
            'user' => $this->userModel->findAll(),
        ];

        return view('pages/data-master/marketing/index', $data);
    }

    public function create_marketing()
    {
        if ($this->request->getMethod() == 'POST') {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'password' => $this->request->getPost('password'),
                'email' => $this->request->getPost('email'),
                'no_telp' => $this->request->getPost('no_telp'),
            ];

            if ($this->userModel->insert($data)) return redirect()->to('data-master/marketing');
        }

        return view('pages/data-master/marketing/create', ['title' => 'Data Master - Marketing - Create Marketing']);
    }

    public function update_marketing($id)
    {
        $data = [
            'title' => 'Data Master - Marketing - Update Marketing',
            'user' => $this->userModel->find($id),
        ];

        if ($this->request->getMethod() == 'POST') {
            $update = [
                'nama' => $this->request->getPost('nama'),
                'password' => $this->request->getPost('password'),
                'email' => $this->request->getPost('email'),
                'no_telp' => $this->request->getPost('no_telp'),
            ];

            if ($this->userModel->update($id, $update)) return redirect()->to('data-master/marketing');
        }
        return view('pages/data-master/marketing/update', $data);
    }

    public function delete_marketing($id)
    {
        $this->userModel->delete($id);
        return redirect('data-master/marketing');
    }


    //SUBMENU Commodity
    public function index_commodity()
    {
        $data = [
            'title' => 'Data Master - Commodity',
            'comodity' => $this->komoditasModel->findAll(),
        ];

        return view('pages/data-master/commodity/index', $data);
    }

    public function create_commodity()
    {
        if ($this->request->getMethod() == 'POST') {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
            ];

            if ($this->komoditasModel->insert($data)) return redirect()->to('data-master/commodity');
        }
        return view('pages/data-master/commodity/create', ['title' => 'Data Master - Commodity - Create Commodity']);
    }
    public function update_commodity($id)
    {
        $data = [
            'title' => 'Data Master - Commodity - Update Commodity',
            'comodity' => $this->komoditasModel->find($id),
        ];

        if ($this->request->getMethod() == 'POST') {
            $update = [
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
            ];

            if ($this->komoditasModel->update($id, $update)) return redirect()->to('data-master/commodity');
        }

        return view('pages/data-master/commodity/update', $data);
    }

    public function delete_commodity($id)
    {
        $this->komoditasModel->delete($id);
        return redirect('data-master/commodity');
    }

    //SUBMENU LOKASI
    public function index_lokasi()
    {
        $data = [
            'title' => 'Data Master - Location',
            'lokasi' => $this->lokasiModel->findAll(),
        ];
        return view('pages/data-master/location/index', $data);
    }

    public function create_lokasi()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.'
                    ]
                ],

                'kode_zip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Zip harus diisi.'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'kode_zip' => $this->request->getPost('kode_zip'),
                ];

                if ($this->lokasiModel->insert($data)) {
                    return $this->response->setJSON(
                        [
                            'error' => false,
                            'message' => 'Data lokasi berhasil ditambahkan',
                            'redirect' => base_url('data-master/location'),
                        ]
                    );
                };
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }

        return view('pages/data-master/location/create', ['title' => 'Data Master - Location - Add Location']);
    }
    public function update_lokasi($id)
    {
        $data = [
            'title' => 'Data Master - Location - Update Location',
            'lokasi' => $this->lokasiModel->find($id),
        ];

        if ($this->request->getMethod() == 'POST') {
            $update = [
                'nama' => $this->request->getPost('nama'),
                'kode_zip' => $this->request->getPost('kode_zip'),
            ];

            if ($this->lokasiModel->update($id, $update)) return redirect()->to('data-master/location');
        }

        return view('pages/data-master/location/update', $data);
    }

    public function delete_lokasi($id)
    {
        $this->lokasiModel->delete($id);
        return redirect('data-master/location');
    }
}
