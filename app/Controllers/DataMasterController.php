<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DataMasterController extends BaseController
{
    /* -------------------------------------------------- */
    /*                  SUBMENU MARKETING                 */
    /* -------------------------------------------------- */
    public function index_marketing()
    {
        $data = [
            'title' => 'Data Master - Marketing',
            'user' => $this->userModel->findAll(),
        ];

        return view('pages/data-master/marketing/index', $data);
    }

    /* ---------------- CREATE MARKETING ---------------- */
    public function create_marketing()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],

                'no_telp' => [
                    'rules' => 'required|is_unique[user.no_telp]',
                    'errors' => [
                        'required' => 'No. Telp harus diisi',
                        'is_unique' => 'No. Telp sudah terdaftar'
                    ]
                ],

                'email' => [
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email tidak valid',
                        'is_unique' => 'Email sudah terdaftar'
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $nama = $this->request->getVar('nama');
                $no_telp = $this->request->getVar('no_telp');
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                // Mengubah email menjadi lowercase
                $toLowerEmail = strtolower($email);

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password

                $data = [
                    'email' => $toLowerEmail,
                    'password' => $hashedPassword,
                    'nama' => $nama,
                    'no_telp' => $no_telp,
                ];

                if ($this->userModel->insert($data)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'message' => 'Marketing data was successfully added',
                        'redirect' => base_url('data-master/marketing')
                    ]);
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Marketing data failed to be added'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => $this->validator->getErrors()
                ]);
            }
        }

        return view('pages/data-master/marketing/create', ['title' => 'Data Master - Marketing - Create Marketing']);
    }

    /* ---------------- UPDATE MARKETING ---------------- */
    public function update_marketing($id)
    {
        $data = [
            'title' => 'Data Master - Marketing - Update Marketing',
            'user' => $this->userModel->find($id),
        ];

        if ($this->request->getMethod() == 'POST') {
            $rules1 = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],

                'no_telp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No. Telp harus diisi',
                    ]
                ],

                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email tidak valid',
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];

            $rules2 = [
                'no_telp' => 'is_unique[user.no_telp,id,{id}]',
                'email' => 'is_unique[user.email,id,{id}]'
            ];

            $input = [
                'nama' => $this->request->getVar('nama'),
                'password' => $this->request->getVar('password'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
            ];

            if ($this->validate($rules1)) {
                $update = [
                    'nama' => $input['nama'],
                    'email' => $input['email'],
                    'no_telp' => $input['no_telp']
                ];

                // Cek apakah email atau no_telp diubah, jika ya, lakukan validasi tambahan
                if ($input['email'] != $data['user']['email'] || $input['no_telp'] != $data['user']['no_telp']) {
                    if (!$this->validate($rules2)) {
                        return $this->response->setJSON(
                            ['error' => true, 'message' => 'Email or No. Handphone already registered']
                        );
                    }
                }

                // Hash password hanya jika ada perubahan
                if ($input['password'] != $data['user']['password']) {
                    $update['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
                }

                if ($this->userModel->update($id, $update)) {
                    return $this->response->setJSON(
                        [
                            'error' => false,
                            'message' => 'Marketing data was successfully updated',
                            'redirect' => base_url('data-master/marketing'),
                        ]
                    );
                } else {
                    return $this->response->setJSON(
                        ['error' => true, 'message' => 'Marketing data failed to be updated']
                    );
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }
        return view('pages/data-master/marketing/update', $data);
    }

    /* ---------------- DELETE MARKETING ---------------- */
    public function delete_marketing($id)
    {
        if ($this->userModel->delete($id)) {
            return $this->response->setJSON(
                [
                    'error' => false,
                    'message' => 'Marketing data was successfully deleted',
                    'redirect' => base_url('data-master/marketing'),
                ]
            );
        } else {
            return $this->response->setJSON(
                ['error' => true, 'message' => $this->validator->getErrors()]
            );
        }
    }


    /* -------------------------------------------------- */
    /*                  SUBMENU COMMODITY                 */
    /* -------------------------------------------------- */
    public function index_commodity()
    {
        $data = [
            'title' => 'Data Master - Commodity',
            'comodity' => $this->komoditasModel->findAll(),
        ];

        return view('pages/data-master/commodity/index', $data);
    }

    /* ---------------- CREATE COMMODITY ---------------- */
    public function create_commodity()
    {
        if ($this->request->getMethod() == 'POST') {

            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga harus diisi.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'harga' => $this->request->getPost('harga'),
                ];

                if ($this->komoditasModel->insert($data)) {
                    return $this->response->setJSON( 
                        [
                            'error' => false,
                            'message' => 'Commodity data successfully added',
                            'redirect' => base_url('data-master/commodity'),
                        ]
                    );
                } else {
                    return $this->response->setJSON(
                        ['error' => true, 'message' => 'Commodity data failed to be added']
                    );
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }
        return view('pages/data-master/commodity/create', ['title' => 'Data Master - Commodity - Create Commodity']);
    }

    /* ---------------- UPDATE COMMODITY ---------------- */
    public function update_commodity($id)
    {
        $data = [
            'title' => 'Data Master - Commodity - Update Commodity',
            'comodity' => $this->komoditasModel->find($id),
        ];

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga harus diisi.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {

                $update = [
                    'nama' => $this->request->getPost('nama'),
                    'harga' => $this->request->getPost('harga'),
                ];

                if ($this->komoditasModel->update($id, $update)) {
                    return $this->response->setJSON(
                        [
                            'error' => false,
                            'message' => 'Commodity data successfully updated',
                            'redirect' => base_url('data-master/commodity'),
                        ]
                    );
                } else {
                    return $this->response->setJSON(
                        ['error' => true, 'message' => 'Commodity data failed to be updated']
                    );
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }

        return view('pages/data-master/commodity/update', $data);
    }

    /* ---------------- DELETE COMMODITY ---------------- */
    public function delete_commodity($id)
    {
        if ($this->komoditasModel->delete($id)) {
            return $this->response->setJSON(
                [
                    'error' => false,
                    'message' => 'Commodity data successfully deleted',
                    'redirect' => base_url('data-master/commodity'),
                ]
            );
        } else {
            return $this->response->setJSON(
                ['error' => true, 'message' => 'Commodity data failed to be deleted']
            );
        }
    }


    /* -------------------------------------------------- */
    /*                  SUBMENU LOCATION                  */
    /* -------------------------------------------------- */
    public function index_lokasi()
    {
        $data = [
            'title' => 'Data Master - Location',
            'lokasi' => $this->lokasiModel->findAll(),
        ];
        return view('pages/data-master/location/index', $data);
    }

    /* ---------------- CREATE LOCATION ---------------- */
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
                            'message' => 'Location data successfully added',
                            'redirect' => base_url('data-master/location'),
                        ]
                    );
                } else {
                    return $this->response->setJSON(
                        ['error' => true, 'message' => 'Location data failed to be added']
                    );
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }

        return view('pages/data-master/location/create', ['title' => 'Data Master - Location - Add Location']);
    }

    /* ---------------- UPDATE LOCATION ---------------- */
    public function update_lokasi($id)
    {
        $data = [
            'title' => 'Data Master - Location - Update Location',
            'lokasi' => $this->lokasiModel->find($id),
        ];

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
                $update = [
                    'nama' => $this->request->getPost('nama'),
                    'kode_zip' => $this->request->getPost('kode_zip'),
                ];

                if ($this->lokasiModel->update($id, $update)) {
                    return $this->response->setJSON(
                        [
                            'error' => false,
                            'message' => 'Location data successfully updated',
                            'redirect' => base_url('data-master/location'),
                        ]
                    );
                } else {
                    return $this->response->setJSON(
                        ['error' => true, 'message' => 'Location data failed to update']
                    );
                }
            } else {
                return $this->response->setJSON(
                    ['error' => true, 'message' => $this->validator->getErrors()]
                );
            }
        }

        return view('pages/data-master/location/update', $data);
    }

    /* ---------------- DELETE LOCATION ---------------- */
    public function delete_lokasi($id)
    {
        if ($this->lokasiModel->delete($id)) {
            return $this->response->setJSON(
                [
                    'error' => false,
                    'message' => 'Location data successfully deleted',
                    'redirect' => base_url('data-master/location'),
                ]
            );
        } else {
            return $this->response->setJSON(
                ['error' => true, 'message' => 'Location data failed to be deleted']
            );
        }
    }
}
