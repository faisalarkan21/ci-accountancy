<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;
use App\Models\M_produksi;
use App\Models\M_laporan;
use App\Models\M_gudang;
use App\Models\M_admin;
use CodeIgniter\I18n\TimeDifference;
use CodeIgniter\I18n\Time;

class Produksi extends Controller
{
    public $session;
    public $dModel;
    public $proModel;
    public $lapModel;
    public $guModel;
    public $admModel;

    public function __construct()
    {
        helper(['form', 'array', 'tgl_indo']);
        $this->dModel = new M_dashboard();
        $this->proModel = new M_produksi();
        $this->lapModel = new M_laporan();
        $this->guModel = new M_gudang();
        $this->admModel = new M_admin();
    }

    //MENU COA
    public function COA()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datacoa'] = $this->proModel->getdataCoa();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'kode_akun' => [
                    'rules' => 'required|is_unique[coa.kode_akun]',
                    'errors' => [
                        'required' => 'Kode akun harus diisi',
                        'is_unique' => 'Kode akun sudah digunakan',
                    ]
                ],
                // 'nama_akun' => [
                //     'rules' => 'required|is_unique[coa.nama_akun]',
                //     'errors' => [
                //     'required' => 'Nama akun harus diisi',
                //     'is_unique' => 'Nama akun sudah digunakan',

                //     ]
                // ],
                'header_akun' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Header akun harus diisi',
                        'numeric' => 'Header akun Harus berupa angka'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $coadata = [
                    'kode_akun' => $this->request->getVar('kode_akun', FILTER_SANITIZE_NUMBER_INT),
                    'nama_akun' => $this->request->getVar('nama_akun'),
                    'header_akun' => $this->request->getVar('header_akun', FILTER_SANITIZE_NUMBER_INT),
                ];
                if ($this->proModel->saveCoa($coadata)) {
                    $session->setFlashdata('success', 'Data COA berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/coa'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/coa'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/coa_view', $data);
    }

    public function edit_coa()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_akun' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama akun harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('kode_akun');
                $data = [
                    'nama_akun'        => $this->request->getVar('nama_akun'),
                    'header_akun'        => $this->request->getVar('header_akun'),

                ];
                if ($this->proModel->updateCoa($data, $id)) {
                    $session->setFlashdata('success', 'Data COA berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/coa'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/coa'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['datacoa'] = $this->proModel->getdataCoa();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            }
        }
        return view('produksi/coa_view', $data);
    }

    public function delete_coa()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('kode_akun');
        $succes = $this->proModel->deleteCoa($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data COA Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/coa'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/coa'));
        }
    }

    //MENU TENAGA KERJA
    public function tenaga_kerja()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerjaList();
        $data['datagaji'] = $this->proModel->getdataGaji();
        $data['getidtenagakerja'] = $this->proModel->get_id_tenaga_kerja();
        $data['getidgaji'] = $this->proModel->get_id_gaji();
        $data['dataoperationlist'] = $this->proModel->getdataOperationList();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_tenaga_kerja' => [
                    'rules' => 'required|is_unique[tenaga_kerja.id_tenaga_kerja]',
                    'errors' => [
                        'required' => 'Kode Tenaga Kerja harus diisi',
                        'is_unique' => 'Kode Tenaga Kerja sudah digunakan',

                    ]
                ],
                'tarif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tarif harus diisi',
                        'numeric' => 'Tarif harus berupa angka',
                    ]
                ],
                'jenis_tenaga_kerja' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis tenaga kerja harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $tenagakerjadata = [
                    'id_tenaga_kerja' => $this->request->getVar('id_tenaga_kerja'),
                    'tarif' => $this->request->getVar('tarif'),
                    'jenis_tenaga_kerja' => $this->request->getVar('jenis_tenaga_kerja'),
                ];
                if ($this->proModel->saveTenagaKerja($tenagakerjadata)) {
                    $session->setFlashdata('success', 'Data Tenaga Kerja berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/tenaga_kerja_view', $data);
    }

    public function edit_tenaga_kerja()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'tarif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tarif Harus Diisi',
                        'numeric' => 'Tarif harus berupa angka',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_tenaga_kerja');
                $data = [
                    'tarif' => $this->request->getVar('tarif'),

                ];
                if ($this->proModel->updateTenagaKerja($data, $id)) {
                    $session->setFlashdata('success', 'Data Tenaga berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['getidtenagakerja'] = $this->proModel->get_id_tenaga_kerja();
            }
        }
        return view('produksi/tenaga_kerja_view', $data);
    }

    public function delete_tenaga_kerja()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_tenaga_kerja');
        $succes = $this->proModel->deleteTenagaKerja($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data tenaga kerja Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/tenaga_kerja'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/tenaga_kerja'));
        }
    }

    public function daftar_gaji()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
        $data['datagaji'] = $this->proModel->getdataGaji();
        $data['getidgaji'] = $this->proModel->get_id_gaji();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_gaji' => [
                    'rules' => 'required|is_unique[gaji_tenaga_kerja.id_gaji]',
                    'errors' => [
                        'required' => 'Kode Gaji Tenaga Kerja harus diisi',
                        'is_unique' => 'Kode Gaji Tenaga Kerja sudah digunakan',

                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idoperation = $this->request->getVar('id_operation');
                $gajidata =  $this->proModel->verifyOperation($idoperation);
                $gajitenagadata = [
                    'id_gaji' => $this->request->getVar('id_gaji'),
                    'jenis_tenaga_kerja' => $gajidata['jenis_tenaga_kerja'],
                    'total_gaji' => $gajidata['total_gaji'],
                    'tgl_bayar' => $this->request->getVar('tgl_bayar'),
                ];
                if ($this->proModel->saveGaji($gajitenagadata)) {
                    $session->setFlashdata('success', 'Data Gaji berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/tenaga_kerja'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/tenaga_kerja_view', $data);
    }

    public function delete_gaji()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_gaji');
        $succes = $this->proModel->deleteGaji($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Gaji tenaga kerja Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/tenaga_kerja'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/tenaga_kerja'));
        }
    }


    //MENU RENCANA PRODUKSI
    public function rencana_produksi()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datarencana'] = $this->proModel->getdataRencana();
        $data['getidrencana'] = $this->proModel->get_id_rencana_produksi();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_rencana' => [
                    'rules' => 'required|is_unique[rencana_produksi.id_rencana]',
                    'errors' => [
                        'required' => 'Kode Rencana harus diisi',
                        'is_unique' => 'Kode Rencana sudah digunakan',

                    ]
                ],
                'nama_produk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama produk harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $rencanadata = [
                    'id_rencana' => $this->request->getVar('id_rencana'),
                    'nama_produk' => $this->request->getVar('nama_produk'),
                ];
                if ($this->proModel->saveRencana($rencanadata)) {
                    $session->setFlashdata('success', 'Data Rencana Produksi berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/rencana_produksi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/rencana_produksi'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/rencana_produksi_view', $data);
    }

    public function delete_rencana_produksi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_rencana');
        $succes = $this->proModel->deleteRencana($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Rencana Produksi Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/rencana_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/rencana_produksi'));
        }
    }



    //MENU BAHAN BAKU
    public function bahan_baku()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['datahistorybahan'] = $this->proModel->getdataHistoryBahan();
        $data['getidbahanbaku'] = $this->proModel->get_id_bahan_baku();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_bahan' => [
                    'rules' => 'required|is_unique[bahan_baku.id_bahan]',
                    'errors' => [
                        'required' => 'Kode Bahan  harus diisi',
                        'is_unique' => 'Kode Bahan sudah digunakan',

                    ]
                ],
                'nama_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama bahan harus diisi',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis tenaga kerja harus diisi',
                    ]
                ],
                'harga_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga bahan harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $bahandata = [
                    'id_bahan' => $this->request->getVar('id_bahan'),
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'quantity' => $this->request->getVar('quantity'),
                    'satuan' => $this->request->getVar('satuan'),
                    'harga_bahan' => $this->request->getVar('harga_bahan'),
                ];
                if ($this->proModel->saveBahan($bahandata)) {
                    $session->setFlashdata('success', 'Data Bahan baku berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/bahan_baku_view', $data);
    }

    public function edit_bahan_baku()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quantity harus diisi',
                    ]
                ],
                'harga_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga bahan harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_bahan');
                $namabahan = $this->request->getVar('nama_bahan');
                $bahandata = $this->proModel->verifyBahan($namabahan);
                $data = [
                    'quantity' => $bahandata['quantity'] + $this->request->getVar('quantity'),
                    'satuan' => $this->request->getVar('satuan'),
                    'harga_bahan' => $this->request->getVar('harga_bahan'),

                ];
                if ($this->proModel->updateBahan($data, $id)) {
                    $session->setFlashdata('success', 'Data Bahan Baku berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['datahistorybahan'] = $this->proModel->getdataHistoryBahan();
                $data['getidbahanbaku'] = $this->proModel->get_id_bahan_baku();
            }
        }
        return view('produksi/bahan_baku_view', $data);
    }

    public function delete_bahan_baku()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bahan');
        $succes = $this->proModel->deleteBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Bahan Baku Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/bahan_baku'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/bahan_baku'));
        }
    }

    public function history_bahan_baku()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['datahistorybahan'] = $this->proModel->getdataHistoryBahan();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama bahan harus diisi',
                    ]
                ],
                'bahan_pakai' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Bahan pakai harus diisi',
                        'numeric' => 'Bahan pakai harus berupa angka',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $namabahan = $this->request->getVar('nama_bahan');
                $bahandata = $this->proModel->verifyBahan($namabahan);
                $bahanpakai = $this->request->getVar('bahan_pakai');
                $historybahandata = [
                    'id_history_bahan' => $bahandata['id_bahan'],
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'quantity' => $bahandata['quantity'],
                    'bahan_pakai' => $this->request->getVar('bahan_pakai'),
                    'sisa_stock' => ($bahandata['quantity'] - $bahanpakai),
                    'tgl_ambil_stock' => date('Y-m-d'),
                ];
                if ($this->proModel->saveHistoryBahan($historybahandata)) {
                    $session->setFlashdata('success', 'Data Bahan baku berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/bahan_baku_view', $data);
    }

    public function delete_history_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes = $this->proModel->deleteHistoryBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Bahan Baku Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/bahan_baku'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/bahan_baku'));
        }
    }

    //MENU BOM
    public function Bom()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databom'] = $this->proModel->getdataBom();
        $data['databomall'] = $this->proModel->getdataBomall();
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['getidbom'] = $this->proModel->get_id_bom();
        $data['selectidbom'] = $this->proModel->union_idbom();
        $data['datarencana'] = $this->proModel->getdataRencana();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_bom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Bom  harus diisi',
                    ]
                ],
                'id_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama bahan harus diisi',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quantity harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $namabahan = $this->request->getVar('nama_bahan');
                $bomdata = [
                    'id_bom' => $this->request->getVar('id_bom'),
                    'id_bahan' => $this->request->getVar('id_bahan'),
                    'quantity' => $this->request->getVar('quantity'),
                    'nama_product' => $this->request->getVar('nama_product')
                ];
                if ($this->proModel->saveAddBom($bomdata)) {
                    $session->setFlashdata('success', 'Data Bom berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bom'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bom'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/bom_view', $data);
    }

    public function bahan_bom()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databom'] = $this->proModel->getdataBom();
        $data['databomall'] = $this->proModel->getdataBomall();
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['getidbom'] = $this->proModel->get_id_bom();
        $data['selectidbom'] = $this->proModel->union_idbom();
        $data['datarencana'] = $this->proModel->getdataRencana();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_bom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Bom  harus diisi',
                    ]
                ],
                'id_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama bahan harus diisi',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quantity harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idbom = $this->request->getVar('id_bom');
                $bomdata = $this->proModel->verifyBahanBom($idbom);
                $namabahan = $this->request->getVar('nama_bahan');
                $bahandata = $this->proModel->verifyBahan($namabahan);
                $tambahdata = [
                    'id_bom' => $this->request->getVar('id_bom'),
                    'nama_product' => $bomdata['nama_product'],
                    'id_bahan' => $this->request->getVar('id_bahan'),
                    'quantity' => $this->request->getVar('quantity'),
                    'target_produksi' => $bomdata['target_produksi'],
                ];

                if ($this->proModel->saveBomBahan($tambahdata)) {
                    $session->setFlashdata('success', 'Data Bom berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bom'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bom'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/bom_view', $data);
    }

    public function edit_bom()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'target_produksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Target produksi harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_bom');
                $data = [
                    'target_produksi' => $this->request->getVar('target_produksi'),

                ];
                if ($this->proModel->updateBom($data, $id)) {
                    $session->setFlashdata('success', 'Data BOM berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bom'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bom'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['databom'] = $this->proModel->getdataBom();
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['getidbom'] = $this->proModel->get_id_bom();
                $data['databomall'] = $this->proModel->getdataBomall();
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['selectidbom'] = $this->proModel->union_idbom();
                $data['datarencana'] = $this->proModel->getdataRencana();
            }
        }
        return view('produksi/bom_view', $data);
    }

    public function delete_bom()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bom');
        $succes = $this->proModel->deleteBom($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data BOM Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/bom'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/bom'));
        }
    }

    //MENU PRODUKSI DETAIL   
    // public function detail_produksi()
    // {
    //     $data = [];
    //     $data['validation'] = null;
    //     $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //     $data['databom'] = $this->proModel->getdataBom();
    //     $data['production_details'] = $this->proModel->getDataProductionDetails();
    //     $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
    //     $data['databahan'] = $this->proModel->getdataBahan();
    //     $data['getidbom'] = $this->proModel->get_id_bom();
    //     $data['selectidbom'] = $this->proModel->union_idbom();
    //     $data['datarencana'] = $this->proModel->getdataRencana();

    //     $session = session();
    //     if ($this->request->getMethod() == 'post') {
    //         $rules = [
    //             'id_operation' => [
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => 'Jenis Pekerjaan harus diisi',
    //                 ]
    //             ],
    //         ];

    //         if ($this->validate($rules)) {
    //             $idbom = $this->request->getVar('id_bom');
    //             $bomdata = $this->proModel->verifyBahanBom($this->request->getVar('id_operation'));
    //             $idBahanTemp = $this->proModel->getIDBahan($idbom);
    //             $bahandata = $this->proModel->verifyIDBahan($idBahanTemp['id_bahan']);
    //             print_r($idBahanTemp['id_bahan']);
    //             $bomdata = [
    //                 'id_bom' => $this->request->getVar('id_bom'),
    //                 'id_operation' => $this->request->getVar('id_operation'),
    //                 'id_bahan' => $idBahanTemp['id_bahan'],
    //             ];
    //             if ($this->proModel->saveProductionDetails($bomdata)) {
    //                 $session->setFlashdata('success', 'Data Bom berhasil diupdate', 3);
    //                 return redirect()->to(base_url('produksi/detail_produksi'));
    //             } else {
    //                 $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
    //                 return redirect()->to(base_url('produksi/detail_produksi'));
    //             }
    //         } else {
    //             $data['validation'] = $this->validator;
    //         }
    //     }
    //     return view('produksi/detail_produksi_view', $data);
    // }

    // public function detail_produksi()
    // {
    //     $data = [];
    //     $data['validation'] = null;
    //     $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //     $data['datadetailproduksi'] = $this->proModel->getdataDetailProduksi();
    //     // print_r($data['datadetailproduksi']);die();

    //     // $session = session();
    //     // if ($this->request->getMethod() == 'post') {
    //     //     $rules = [
    //     //     'jenis_tenaga_kerja' => [
    //     //         'rules' => 'required',
    //     //         'errors' => [
    //     //         'required' => 'Jenis Pekerjaan harus diisi',
    //     //         ]
    //     //     ],
    //     //     ];
    //     //     if ($this->validate($rules)) {
    //     //         $idtarif= $this->request->getVar('jenis_tenaga_kerja');
    //     //         $datatarif = $this->proModel->verifyTarif($idtarif);
    //     //         $idbom= $this->request->getVar('id_bom');
    //     //         $bomdata = $this->proModel->verifyBahanBom($idbom);
    //     //         $bomdata = [
    //     //             'id_bom' => $this->request->getVar('id_bom'),
    //     //             'jenis_tenaga_kerja' => $this->request->getVar('jenis_tenaga_kerja'),
    //     //             'tarif'=> $datatarif['tarif'],
    //     //             'target_produksi' =>  $bomdata['target_produksi']
    //     //         ];
    //     //         if ($this->proModel->saveBom($bomdata)) {
    //     //             $session->setFlashdata('success', 'Data Bom berhasil diupdate', 3);
    //     //             return redirect()->to(base_url('produksi/detail_produksi'));
    //     //         } else {
    //     //             $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
    //     //             return redirect()->to(base_url('produksi/detail_produksi'));
    //     //         }
    //     //     } else {
    //     //         $data['validation'] = $this->validator;
    //     //     }
    //     // }
    //     return view('produksi/detail_produksi_view', $data);
    // }


    public function detail_produksi()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['production_details'] = $this->proModel->getDataProductionDetails();
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerjaList();
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['getidbom'] = $this->proModel->get_id_bom();
        $data['selectidbom'] = $this->proModel->union_idbom();
        $data['datarencana'] = $this->proModel->getdataRencana();

        $session = session();
        //if ($this->request->getmethod() == 'post') {
           $rules = [
                'id_operation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan harus diisi',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $bomdata = [
                    'id_bom' => $this->request->getVar('id_bom'),
                    'id_operation' => $this->request->getVar('id_operation'),
                ];

                $checkBom = $this->proModel->verifyProductionDetails($this->request->getVar('id_bom'));

                if ($checkBom === false){
                    if ($this->proModel->saveProductionDetails($bomdata)) {
                        $session->setFlashdata('success', 'Data Bom berhasil diupdate', 3);
                        return redirect()->to(base_url('produksi/detail_produksi'));
                    } else {
                        $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                        return redirect()->to(base_url('produksi/detail_produksi'));
                    }
                } else {
                    $session->setFlashdata('error', 'ID BOM sudah tersimpan', 3);
                    return redirect()->to(base_url('produksi/detail_produksi'));
                }

               
            } else {
                $data['validation'] = $this->validator;
            }
//        }
        return view('produksi/detail_produksi_view', $data);
    }


    // public function detail_produksi()
    // {
    //     $data = [];
    //     $data['validation'] = null;
    //     $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //     $data['production_details'] = $this->proModel->getDataProductionDetails();
    //     $data['production_details'] = $this->proModel->getDataProductionDetails();
    //     $data['production_details'] = $this->proModel->getDataProductionDetails();
    //     $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
    //     $data['databahan'] = $this->proModel->getdataBahan();
    //     $data['getidbom'] = $this->proModel->get_id_bom();
    //     $data['selectidbom'] = $this->proModel->union_idbom();
    //     $data['datarencana'] = $this->proModel->getdataRencana();

    //     return view('produksi/detail_produksi_view', $data);
    // }


    public function edit_detail_produksi()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'target_produksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Target produksi harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_bom');
                $data = [
                    'target_produksi' => $this->request->getVar('target_produksi'),

                ];
                if ($this->proModel->updateBom($data, $id)) {
                    $session->setFlashdata('success', 'Data BOM berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/bom'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/bom'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['databom'] = $this->proModel->getdataBom();
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['getidbom'] = $this->proModel->get_id_bom();
                $data['databomall'] = $this->proModel->getdataBomall();
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['selectidbom'] = $this->proModel->union_idbom();
                $data['datarencana'] = $this->proModel->getdataRencana();
            }
        }
        return view('produksi/detail_produksi_view', $data);
    }

    public function delete_detail_produksi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bom');
        $succes = $this->proModel->deleteBom($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data BOM Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/bom'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/bom'));
        }
    }

    //MENU JADWAL PRODUKSI
    public function Jadwal_produksi()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datajadwal'] = $this->proModel->getdataJadwal();
        $data['databahan'] = $this->proModel->getdataBahan();
        $data['databom'] = $this->proModel->getdataBom();
        $data['datahistoryjadwal'] = $this->proModel->getdataHistoryJadwal();
        $data['getidjadwal'] = $this->proModel->get_id_jadwal();
        $data['datarencana'] = $this->proModel->getdataRencana();
        $data['dataoperationlist'] = $this->proModel->getdataOperationList();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_jadwal' => [
                    'rules' => 'required|is_unique[jadwal_produksi.id_jadwal]',
                    'errors' => [
                        'required' => 'Kode Jadwal  harus diisi',
                        'is_unique' => 'Kode Jadwal sudah digunakan',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idbom = $this->request->getVar('id_bom');
                $bomdata = $this->proModel->verifyBahanBom($idbom);
                // $idoperation= $this->request->getVar('id_operation');
                // $oplistdata = $this->proModel->verifyOperationList($idoperation);
                $jadwaldata = [
                    'id_jadwal' => $this->request->getVar('id_jadwal'),
                    'nama_produk' => $bomdata['nama_product'],
                    'id_operation' => $this->request->getVar('id_operation'),
                    'rencana_produksi' => $this->request->getVar('quantity'),
                    'keterangan' => 'Mulai Produksi',
                ];
                if ($this->proModel->saveJadwal($jadwaldata)) {
                    $session->setFlashdata('success', 'Data Jadwal berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/jadwal_produksi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/jadwal_produksi'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/jadwal_view', $data);
    }

    public function edit_keterangan_mulai()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_jadwal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID Jadwal harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_jadwal');
                $data = [
                    'keterangan' => "Sedang Proses",
                    'tgl_mulai' => date('Y-m-d'),

                ];
                if ($this->proModel->updateJadwal($data, $id)) {
                    $session->setFlashdata('success', 'Data Jadwal berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/jadwal_produksi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/jadwal_produksi'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['databahan'] = $this->proModel->getdataBahan();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['datajadwal'] = $this->proModel->getdataJadwal();
                $data['datahistoryjadwal'] = $this->proModel->getdataHistoryJadwal();
                $data['getidjadwal'] = $this->proModel->get_id_jadwal();
                $data['databom'] = $this->proModel->getdataBom();
            }
        }
        return view('produksi/jadwal_view', $data);
    }

    public function edit_keterangan_selesai()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_jadwal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID Jadwal harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $id = $this->request->getVar('id_jadwal');
                $data = [
                    'keterangan' => "Selesai",
                    'tgl_selesai' => date('Y-m-d'),

                ];

                $idjadwal = $this->request->getVar('id_jadwal');
                $waktuawal = $this->proModel->verifyWaktupengerjaan($idjadwal);
                $waktumulai = $waktuawal['tgl_mulai'];
                $waktuselesai = date('Y-m-d');
                $datetime1 = Time::parse($waktumulai); //start time
                $datetime2 = Time::parse($waktuselesai); //end time
                $durasi = $datetime1->difference($datetime2);
                $historyjadwaldata = [
                    'id_jadwal' => $this->request->getVar('id_jadwal'),
                    'nama_produk' => $waktuawal['nama_produk'],
                    'rencana_produksi' => $waktuawal['rencana_produksi'],
                    'tgl_selesai' => date('Y-m-d'),
                    'waktu_pengerjaan' => $durasi->days
                ];
                $this->proModel->historyJadwal($historyjadwaldata);

                $idjadwal = $this->request->getVar('id_jadwal');
                $waktuawal = $this->proModel->verifyWaktupengerjaan($idjadwal);
                $waktumulai = $waktuawal['tgl_mulai'];
                $waktuselesai = date('Y-m-d');
                $datetime1 = Time::parse($waktumulai); //start time
                $datetime2 = Time::parse($waktuselesai); //end time
                $durasi = $datetime1->difference($datetime2);
                $dataprodukjadi = [
                    'id_produk' => $this->proModel->get_id_produk_jadi(),
                    'nama_produk' => $waktuawal['nama_produk'],
                    'stock' => $waktuawal['rencana_produksi'],
                    'tgl_mulai' => $waktuawal['tgl_mulai'],
                    'tgl_selesai' => date('Y-m-d'),
                    'waktu_pengerjaan' => $durasi->days
                ];
                $this->proModel->saveProdukJadi($dataprodukjadi);



                if ($this->proModel->updateJadwal($data, $id)) {
                    $idjadwal = $this->request->getVar('id_jadwal');
                    $produkjadiproduksi = $this->proModel->verifyWaktupengerjaan($idjadwal);
                    $produkjadi = $produkjadiproduksi['nama_produk'];
                    $idprodukadmin = $produkjadi;
                    $dataprodukadmin = $this->proModel->VerifyProdukadmin($idprodukadmin);
                    if ($dataprodukadmin['nama_barang'] !== $produkjadi) {
                        $databarang = [
                            'id_barang' => $this->admModel->get_id_barang(),
                            'nama_barang' => $produkjadiproduksi['nama_produk'],
                            'jmlh_barang' => $produkjadiproduksi['rencana_produksi'],

                        ];
                        $this->admModel->saveProduct($databarang);
                        $session->setFlashdata('success', 'Data Jadwal berhasil diupdate', 3);
                        return redirect()->to(base_url('produksi/jadwal_produksi'));
                    } elseif ($dataprodukadmin['nama_barang'] == $produkjadi) {

                        $id = $dataprodukadmin['id_barang'];
                        $data = [
                            'jmlh_barang' => $produkjadiproduksi['rencana_produksi'] + $dataprodukadmin['jmlh_barang'],

                        ];
                        $this->admModel->updateProduct($data, $id);
                        $session->setFlashdata('success', 'Data Jadwal berhasil diupdate', 3);
                        return redirect()->to(base_url('produksi/jadwal_produksi'));;
                    }
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/jadwal_produksi'));
                }
                // } else {
                //     $data['validation'] = $this->validator;
                //     $data['databahan'] = $this->proModel->getdataBahan();
                //     $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                //     $data['datajadwal'] = $this->proModel->getdataJadwal();
                //     $data['datahistoryjadwal'] = $this->proModel->getdataHistoryJadwal();
                //     $data['getidjadwal'] = $this->proModel->get_id_jadwal();
                //     $data['databom'] = $this->proModel->getdataBom();
                // }
            }

            return view('produksi/jadwal_view', $data);
        }
    }

    public function update_history_jadwal()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historyjadwaldata = [
            'id_jadwal' => $this->request->getVar('id_jadwal'),
            'nama_bahan' => $this->request->getVar('nama_bahan'),
            'quantity' => $this->request->getVar('quantity'),
            'rencana_produksi' => $this->request->getVar('rencana_produksi'),
            'tgl_produksi' => date('Y-m-d'),
        ];
        $succes = $this->proModel->historyJadwal($historyjadwaldata);
        if ($succes) {
            $session->setFlashdata('success', 'Data Jadwal berhasil terupdate ke history', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        }
    }

    public function delete_history_jadwal()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_jadwal');
        $succes = $this->proModel->deleteHistoryJadwal($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Jadwal Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        }
    }

    public function delete_daftar_jadwal()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_daftar_jadwal');
        $succes = $this->proModel->deleteDaftarJadwal($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Jadwal Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/jadwal_produksi'));
        }
    }

    //MENU OVERHEAD
    public function Overhead()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataoverhead'] = $this->proModel->getdataOverhead();
        $data['getidoverhead'] = $this->proModel->get_id_overhead();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_overhead' => [
                    'rules' => 'required|is_unique[overhead.id_overhead]',
                    'errors' => [
                        'required' => 'Kode Overhead harus diisi',
                        'is_unique' => 'Kode Overhead sudah digunakan',
                    ]
                ],
                'nama_overhead' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama overhead harus diisi',
                    ]
                ],

            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $overheaddata = [
                    'id_overhead' => $this->request->getVar('id_overhead'),
                    'nama_overhead' => $this->request->getVar('nama_overhead'),
                    'tgl_overhead' => date('Y-m-d'),
                ];
                if ($this->proModel->saveOverhead($overheaddata)) {
                    $session->setFlashdata('success', 'Data Overhead berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/overhead'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/overhead'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/overhead_view', $data);
    }

    // public function edit_overhead()
    // {
    //     $session = session();
    //     if ($this->request->getMethod() == 'post') {
    //         $rules = [
    //         'biaya_overhead' => [
    //             'rules' => 'required',
    //             'errors' => [
    //             'required' => 'Biaya Overhead harus diisi',
    //             ]
    //         ],
    //         ];
    //         if ($this->validate($rules)) {
    //             $id = $this->request->getVar('id_overhead');
    //             $data = [
    //                 'biaya_overhead' => $this->request->getVar('biaya_overhead'),

    //             ];
    //             if ($this->proModel->updateOverhead($data, $id)) {
    //                 $session->setFlashdata('success', 'Data Overhead berhasil diupdate', 3);
    //                 return redirect()->to(base_url('produksi/overhead'));
    //             } else {
    //                 $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
    //                 return redirect()->to(base_url('produksi/overhead'));
    //             }
    //         } else {
    //             $data['validation'] = $this->validator;
    //             $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //             $data['dataoverhead'] = $this->proModel->getdataOverhead();
    //             $data['getidoverhead'] = $this->proModel->get_id_overhead();
    //         }
    //     } 
    //     return view('produksi/bom_view', $data);
    // }

    public function delete_overhead()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_overhead');
        $succes = $this->proModel->deleteOverhead($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Overhead Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/overhead'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/overhead'));
        }
    }

    //MENU PRODUK JADI
    public function Produk_jadi()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataprodukjadi'] = $this->proModel->getdataProdukJadi();
        $data['getidprodukjadi'] = $this->proModel->get_id_produk_jadi();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_produk' => [
                    'rules' => 'required|is_unique[produk_jadi.id_produk]',
                    'errors' => [
                        'required' => 'Kode produk harus diisi',
                        'is_unique' => 'Kode produk sudah digunakan',
                    ]
                ],
                'nama_produk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama produk harus diisi',
                    ]
                ],
                'stock' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Stock produk harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $produkdata = [
                    'id_produk' => $this->request->getVar('id_produk'),
                    'nama_produk' => $this->request->getVar('nama_produk'),
                    'stock' => $this->request->getVar('stock'),
                ];
                if ($this->proModel->saveProdukJadi($produkdata)) {
                    $session->setFlashdata('success', 'Data Produk Jadi berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/produk_jadi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/produk_jadi'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/produk_jadi_view', $data);
    }

    public function edit_produk_jadi()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'stock' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Stock harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_produk');
                $data = [
                    'stock' => $this->request->getVar('stock'),

                ];
                if ($this->proModel->updateProdukJadi($data, $id)) {
                    $session->setFlashdata('success', 'Data Produk Jadi berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/produk_jadi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/produk_jadi'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['dataprodukjadi'] = $this->proModel->getdataProdukJadi();
                $data['getidprodukjadi'] = $this->proModel->get_id_produk_jadi();
            }
        }
        return view('produksi/produk_jadi_view', $data);
    }

    public function delete_produk_jadi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_produk');
        $succes = $this->proModel->deleteProdukJadi($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Produk Jadi Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/produk_jadi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/produk_jadi'));
        }
    }

    //MENU BIAYA BAHAN
    public function Biaya_bahan()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databiayabahan'] = $this->proModel->getdataBiayaBahan();
        $data['databom'] = $this->proModel->getdataBom();
        // $data['datajadwal'] = $this->proModel->getdataJadwal();
        $data['datahistorybiayabahan'] = $this->proModel->getdataHistoryBiayaBahan();
        $data['getidbiayabahan'] = $this->proModel->get_id_biaya_bahan();
        $data['selectidbom'] = $this->proModel->union_idbom();
        $data['selectidjadwal'] = $this->proModel->populatedJadwal();
        $data['datacoa'] = $this->proModel->getdataCoa();


        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_biaya_bahan' => [
                    'rules' => 'required|is_unique[biaya_bahan.id_biaya_bahan]',
                    'errors' => [
                        'required' => 'Kode Biaya Bahan harus diisi',
                        'is_unique' => 'Kode Biaya Bahan digunakan',
                    ]
                ],
                'id_bom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode BOM harus diisi',
                    ]
                ],
                'id_jadwal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Jadwal harus diisi',
                    ]
                ],
                'file_upload' => [
                    'rules' => 'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                    'errors' => [
                        'mime_in' => 'Format File salah',
                        'max_size' => 'Maximal size 4 mb',
                        'uploaded' => 'File tidak terupload',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idbom = $this->request->getVar('id_bom');
                $rencanaproduksi = $this->request->getVar('rencana_produksi');
                $namabahanbomdata = $this->proModel->verifyNamaBahanBom($idbom);
                $idbomquantity = $this->request->getVar('id_bom');
                $quantitybahanbomdata = $this->proModel->verifyQuantity($idbomquantity);
                $idbombiaya = $this->request->getVar('id_bom');
                $biayabahanbomdata = $this->proModel->verifyBiaya($idbombiaya);
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH . 'template/assets/img/bukti-bayar-biaya-bahan');
                $biayabahandata = [
                    'id_biaya_bahan' => $this->request->getVar('id_biaya_bahan'),
                    'id_bom' => $this->request->getVar('id_bom'),
                    'nama_bahan' => $namabahanbomdata['nama_bahan'],
                    'quantity' => $quantitybahanbomdata['quantity'],
                    'total_biaya' => $biayabahanbomdata['total_biaya'],
                    'kategori' => $this->request->getVar('kategori'),
                    'file_upload' => $upload->getName(),
                ];
                if ($this->proModel->saveBiayaBahan($biayabahandata)) {
                    $session->setFlashdata('success', 'Data Biaya Bahan berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/biaya_bahan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/biaya_bahan'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/biaya_bahan_view', $data);
    }

    public function delete_biaya_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_biaya_bahan');
        $succes = $this->proModel->deleteBiayaBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Bahan Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        }
    }

    public function update_history_biaya_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historybiayabahandata = [
            'id_biaya_bahan' => $this->request->getVar('id_biaya_bahan'),
            'id_bom' => $this->request->getVar('id_bom'),
            'nama_bahan' => $this->request->getVar('nama_bahan'),
            'quantity' => $this->request->getVar('quantity'),
            'total_biaya' => $this->request->getVar('total_biaya'),
            'kategori' => $this->request->getVar('kategori'),
            'file_upload' => $this->request->getVar('file_upload'),
            'tgl_pembayaran' => date('Y-m-d'),
        ];

        $succes = $this->proModel->historyBiayaBahan($historybiayabahandata);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Bahan berhasil terupdate ke history', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        }
    }

    public function delete_history_biaya_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes = $this->proModel->deleteHistoryBiayaBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        }
    }


    //MENU BIAYA OVERHEAD
    public function Biaya_overhead()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databiayaoverhead'] = $this->proModel->getdataBiayaOverhead();
        $data['datahistorybiayoverhead'] = $this->proModel->getdataHistoryBiayaOverhead();
        $data['getidbiayaoverhead'] = $this->proModel->get_id_biaya_overhead();
        $data['dataoverhead'] = $this->proModel->getdataOverhead();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_biaya_overhead' => [
                    'rules' => 'required|is_unique[biaya_overhead.id_biaya_overhead]',
                    'errors' => [
                        'required' => 'Kode Biaya Overhead harus diisi',
                        'is_unique' => 'Kode Biaya Overhead sudah digunakan',
                    ]
                ],
                'total_overhead' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Total overhead harus diisi',
                    ]
                ],

                'file_upload' => [
                    'rules' =>
                    'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                    'errors' => [
                        'mime_in' => 'Format File salah',
                        'max_size' => 'Maximal size 4 mb',
                        'uploaded' => 'File tidak terupload',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH . 'template/assets/img/bukti-bayar-overhead');
                $biayaoverheaddata = [
                    'id_biaya_overhead' => $this->request->getVar('id_biaya_overhead'),
                    'nama_overhead' => $this->request->getVar('nama_overhead'),
                    'total_overhead' => $this->request->getVar('total_overhead'),
                    'kategori' => $this->request->getVar('kategori'),
                    'upload_pembayaran' => $upload->getName(),
                ];
                if ($this->proModel->saveBiayaOverhead($biayaoverheaddata)) {
                    $session->setFlashdata('success', 'Data Biaya Overhead berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/biaya_overhead'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/biaya_overhead'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/biaya_overhead_view', $data);
    }

    public function delete_biaya_overhead()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_biaya_overhead');
        $succes = $this->proModel->deleteBiayaOverhead($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Overhead Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        }
    }

    public function update_history_biaya_overhead()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historybiayaoverheaddata = [
            'id_biaya_overhead' => $this->request->getVar('id_biaya_overhead'),
            'nama_overhead' => $this->request->getVar('nama_overhead'),
            'total_overhead' => $this->request->getVar('total_overhead'),
            'kategori' => $this->request->getVar('kategori'),
            'upload_pembayaran' => $this->request->getVar('upload_file'),
            'tgl_pembayaran' => date('Y-m-d'),
        ];

        $succes = $this->proModel->historyBiayaOverhead($historybiayaoverheaddata);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Overhead berhasil terupdate ke history', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        }
    }

    public function delete_history_biaya_overhead()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes = $this->proModel->deleteHistoryBiayaOverhead($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_overhead'));
        }
    }



    //MENU BIAYA TENAGA KERJA
    public function Biaya_tenaga_kerja()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databiayatenagakerja'] = $this->proModel->getdataBiayaTenagaKerja();
        $data['datahistorytenagakerja'] = $this->proModel->getdataHistoryTenagaKerja();
        $data['dataoperationlist'] = $this->proModel->getdataOperationList();
        $data['getidbiayatenaga'] = $this->proModel->get_id_biaya_tenaga_kerja();
        $data['datagaji'] = $this->proModel->getdataGaji();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_biaya_tenaga' => [
                    'rules' => 'required|is_unique[biaya_tenaga_kerja.id_biaya_tenaga]',
                    'errors' => [
                        'required' => 'Kode Biaya Tenaga Kerja harus diisi',
                        'is_unique' => 'Kode Biaya Tenaga Kerja digunakan',
                    ]
                ],
                'file_upload' => [
                    'rules' => 'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                    'errors' => [
                        'mime_in' => 'Format File salah',
                        'max_size' => 'Maximal size 4 mb',
                        'uploaded' => 'File tidak terupload',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idgaji = $this->request->getVar('id_gaji');
                $datagajitk = $this->proModel->verifyGaji($idgaji);
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH . 'template/assets/img/bukti-bayar-biaya-tk');
                $biayatenagadata = [
                    'id_biaya_tenaga' => $this->request->getVar('id_biaya_tenaga'),
                    'jenis_tenaga_kerja' => $datagajitk['jenis_tenaga_kerja'],
                    'gaji' => $datagajitk['total_gaji'],
                    'kategori' => $this->request->getVar('kategori'),
                    'upload_pembayaran' => $upload->getName(),
                ];
                if ($this->proModel->saveBiayaTenagaKerja($biayatenagadata)) {
                    $session->setFlashdata('success', 'Data Biaya Tenaga Kerja berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/biaya_tenaga_kerja_view', $data);
    }

    public function delete_biaya_tenaga()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_biaya_tenaga');
        $succes = $this->proModel->deleteBiayaTenagaKerja($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Tenaga Kerja Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        }
    }

    public function update_history_biaya_tenaga()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historybiayatenagadata = [
            'id_biaya_tenaga' => $this->request->getVar('id_biaya_tenaga'),
            'jenis_kerja' => $this->request->getVar('jenis_kerja'),
            'gaji' => $this->request->getVar('gaji'),
            'kategori' => $this->request->getVar('kategori'),
            'tgl_bayar' => date('Y-m-d'),
            'upload_pembayaran' => $this->request->getVar('upload_file'),
        ];
        $succes = $this->proModel->historyBiayaTenagaKerja($historybiayatenagadata);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Tenaga Kerja berhasil terupdate ke history', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        }
    }

    public function delete_history_biaya_tenaga()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes = $this->proModel->deleteHistoryBiayaTenaga($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_tenaga_kerja'));
        }
    }



    //MENU BIAYA PRODUKSI
    public function Biaya_produksi()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databiayaproduksi'] = $this->proModel->getdataBiayaProduksi();
        $data['datahistorybiayaproduksi'] = $this->proModel->getdataHistoryBiayaProduksi();
        $data['getidbiayaproduksi'] = $this->proModel->get_id_biaya_produksi();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['databiayabahan'] = $this->proModel->getdataBiayaBahan();
        $data['datahistorybiayoverhead'] = $this->proModel->getdataHistoryBiayaOverhead();
        $data['datahistorytenagakerja'] = $this->proModel->getdataHistoryTenagaKerja();
        $data['datahistorybiayabahan'] = $this->proModel->getdataHistoryBiayaBahan();
        $data['tahunhistory'] = $this->proModel->tampil_tahun_biaya_bahan();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_biaya_produksi' => [
                    'rules' => 'required|is_unique[biaya_produksi.id_biaya_produksi]',
                    'errors' => [
                        'required' => 'Kode Biaya Produksi harus diisi',
                        'is_unique' => 'Kode Biaya Produksi sudah digunakan',
                    ]
                ],
                'file_upload' => [
                    'rules' => 'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                    'errors' => [
                        'mime_in' => 'Format File salah',
                        'max_size' => 'Maximal size 4 mb',
                        'uploaded' => 'File tidak terupload',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $idbahan = $this->request->getVar('id_biaya_bahan');
                $bahandata = $this->proModel->verifyIDBahan($idbahan);
                $idoverhead = $this->request->getVar('id_biaya_overhead');
                $overheaddata = $this->proModel->verifyIDOverhead($idoverhead);
                $idtenaga = $this->request->getVar('id_biaya_tenaga');
                $tenagadata = $this->proModel->verifyIDTenaga($idtenaga);
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH . 'template/assets/img/bukti-bayar-biaya-produksi');
                $biayaproduksidata = [
                    'id_biaya_produksi' => $this->request->getVar('id_biaya_produksi'),
                    'tgl_pembayaran' => date('Y-m-d'),
                    'kategori' => $this->request->getVar('kategori'),
                    'biaya_bahan' => $bahandata['total_biaya'],
                    'biaya_tenaga' => $tenagadata['gaji'],
                    'biaya_overhead' => $overheaddata['total_overhead'],
                    'total_produksi' => $bahandata['total_biaya'] + $overheaddata['total_overhead'] + $tenagadata['gaji'],
                    'upload_pembayaran' => $upload->getName(),

                ];
                if ($this->proModel->saveBiayaProduksi($biayaproduksidata)) {
                    $session->setFlashdata('success', 'Data Biaya Produksi berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/biaya_produksi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/biaya_produksi'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/biaya_produksi_view', $data);
    }

    public function delete_biaya_produksi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_biaya_produksi');
        $succes = $this->proModel->deleteBiayaProduksi($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Produksi Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        }
    }

    public function update_history_biaya_produksi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historybiayaproduksidata = [
            'id_biaya_produksi' => $this->request->getVar('id_biaya_produksi'),
            'biaya_bahan' => $this->request->getVar('biaya_bahan'),
            'biaya_tenaga' => $this->request->getVar('biaya_tenaga'),
            'biaya_overhead' => $this->request->getVar('biaya_overhead'),
            'total_produksi' => $this->request->getVar('total_produksi'),
            'kategori' => $this->request->getVar('kategori_produksi'),
            'tgl_pembayaran_produksi' => date('Y-m-d'),
            'upload_pembayaran' => $this->request->getVar('upload_pembayaran'),
        ];
        $succes = $this->proModel->historyBiayaProduksi($historybiayaproduksidata);
        if ($succes) {
            $session->setFlashdata('success', 'Data Biaya Produksi berhasil terupdate ke history', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate  silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        }
    }

    public function delete_history_biaya_produksi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes = $this->proModel->deleteHistoryBiayaProduksi($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data History Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/biaya_produksi'));
        }
    }

    public function jurnal_persediaan_barang_jadi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $bln = $this->request->getVar('bln_jurnal');
        $thn = $this->request->getVar('thn_history');
        $totalbiayabhn = $this->proModel->SumBiayaBahan($bln, $thn);
        $totalbiayatenaga = $this->proModel->SumBiayaTenaga($bln, $thn);
        $totalbiayaoverhead = $this->proModel->SumBiayaOver($bln, $thn);

        $jurnaldata1 = [
            'id'   => 'BDP1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '115-1',
            'debet'   => $totalbiayabhn['total_biaya'] + $totalbiayatenaga['gaji'] + $totalbiayaoverhead['total_overhead'],
            'kredit' => '0'
        ];

        $this->lapModel->insertjurnal_produksi($jurnaldata1);

        $jurnaldata2 = [
            'id'   => 'BDP1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '114-1',
            'debet'   => '0',
            'kredit' => $totalbiayabhn['total_biaya']
        ];

        $this->lapModel->insertjurnal_produksi($jurnaldata2);

        $jurnaldata3 = [
            'id'   => 'BDP1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '114-2',
            'debet'   => '0',
            'kredit' => $totalbiayatenaga['gaji']
        ];

        $this->lapModel->insertjurnal_produksi($jurnaldata3);

        $jurnaldata4 = [
            'id'   => 'BDP1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '114-3',
            'debet'   => '0',
            'kredit' => $totalbiayaoverhead['total_overhead']
        ];

        $this->lapModel->insertjurnal_produksi($jurnaldata4);

        $jurnaldata5 = [
            'id'   => 'HPP-PEN',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411-4',
            'debet'   => $totalbiayabhn['total_biaya'] + $totalbiayatenaga['gaji'] + $totalbiayaoverhead['total_overhead'],
            'kredit' => '0'
        ];

        $this->lapModel->insertjurnal_produksi($jurnaldata5);

        $jurnaldata6 = [
            'id'   => 'HPP-PEN',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '115-1',
            'debet'   => '0',
            'kredit' => $totalbiayabhn['total_biaya'] + $totalbiayatenaga['gaji'] + $totalbiayaoverhead['total_overhead'],
        ];
        $this->lapModel->insertjurnal_produksi($jurnaldata6);

        //JURNAL KEUANGAN
        $jurnaldata7 = [
            'id'   => 'HPP-PEN',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '115-1',
            'debet'   => $totalbiayabhn['total_biaya'] + $totalbiayatenaga['gaji'] + $totalbiayaoverhead['total_overhead'],
            'kredit' => '0'
        ];

        $this->lapModel->insertjurnal_keuangan($jurnaldata7);

        $jurnaldata8 = [
            'id'   => 'HPP-PEN',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411-4',
            'debet'   => '0',
            'kredit' => $totalbiayabhn['total_biaya'] + $totalbiayatenaga['gaji'] + $totalbiayaoverhead['total_overhead'],
        ];

        $succes = $this->lapModel->insertjurnal_keuangan($jurnaldata8);
        if ($succes) {
            $session->setFlashdata('success', 'Data Jurnal berhasil terupdate', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf Data Bulan dan Tahun tidak ada di history silahkan cek lagi', 3);
            return redirect()->to(base_url('produksi/biaya_bahan'));
        }
    }



    //MENU OPERATION LIST
    public function operation_list()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataoperationlist'] = $this->proModel->getdataOperationList();
        // $data['databom'] = $this->proModel->union_idbom();
        // $data['dataprodukjadi'] = $this->proModel->getdataProdukJadi();
        $data['getidoperationlist'] = $this->proModel->get_id_operation_list();
        $data['dataoperationall'] = $this->proModel->getdataOperationList();
        $data['selectidoperation'] = $this->proModel->union_idoperation();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['datarencana'] = $this->proModel->getdataRencana();
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_operation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode opertaion harus diisi',
                        'is_unique' => 'Kode opertaion sudah digunakan',
                    ]
                ],
                'id_tenaga_kerja' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Tenaga Kerja harus diisi',
                    ]
                ],
                'nama_produk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Produk harus diisi',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Quantity harus diisi',
                    ]
                ],
                // 'file_upload' => [
                //     'rules' => 'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                //     'errors' => [
                //     'mime_in' => 'Format File salah',
                //     'max_size' => 'Maximal size 4 mb',
                //     'uploaded' => 'File tidak terupload',
                //     ]
                // ],
            ];
            if ($this->validate($rules)) {
                // $idbom= $this->request->getVar('id_bom');
                // $pekerjaandata = $this->proModel->verifypekerjaan($idbom);
                $idtenagakerja = $this->request->getVar('id_tenaga_kerja');
                $tenagakerjadata = $this->proModel->verifyTenagaKerja($idtenagakerja);
                // $idprodukjadi= $this->request->getVar('id_produk');
                // $produkjadidata = $this->proModel->verifyProdukJadi($idprodukjadi);
                // $waktumulai = $produkjadidata['tgl_mulai'];
                // $waktuselesai=$produkjadidata['tgl_selesai'];
                // $datetime1 = Time::parse($waktumulai);//start time
                // $datetime2 = Time::parse($waktuselesai);//end time
                // $durasi = $datetime1->difference($datetime2);
                // $upload = $this->request->getFile('file_upload');
                // $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-operation-list');
                $operationdata = [
                    'id_operation' => $this->request->getVar('id_operation'),
                    'id_tenaga_kerja' => $this->request->getVar('id_tenaga_kerja'),
                    // 'produk_jadi' => $produkjadidata['nama_produk'],
                    'nama_produk' => $this->request->getVar('nama_produk'),
                    'quantity' => $this->request->getVar('quantity'),
                    // 'tarif' => $tenagakerjadata['tarif'],
                    // 'waktu_pengerjaan' => $durasi->days,
                    // 'total_gaji' => $pekerjaandata['tarif']*$pekerjaandata['target_produksi'],
                    // 'kategori' => $this->request->getVar('kategori'),
                    // 'upload_pembayaran' => $upload->getName(),
                ];
                // print_r($operationdata);die();
                if ($this->proModel->saveOperationList($operationdata)) {
                    $session->setFlashdata('success', 'Data Operation List berhasil diupdate', 3);
                //     return redirect()->to(base_url('produksi/operation_list'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    // return redirect()->to(base_url('produksi/operation_list'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/operation_list_view', $data);
    }

    public function operation_jenis_pekerjaan()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataoperationlist'] = $this->proModel->getdataOperationList();
        $data['getidoperationlist'] = $this->proModel->get_id_operation_list();
        $data['dataoperationall'] = $this->proModel->getdataOperationAll();
        $data['selectidoperation'] = $this->proModel->union_idoperation();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['datarencana'] = $this->proModel->getdataRencana();
        $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_operation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Operation  harus diisi',
                    ]
                ],
                'id_tenaga_kerja' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Tenaga Kerja harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idoperation = $this->request->getVar('id_operation');
                $operationdata = $this->proModel->verifyOperationList($idoperation);
                $idtenagakerja = $this->request->getVar('id_tenaga_kerja');
                $tenagakerjadata = $this->proModel->verifyTenagaKerja($idtenagakerja);
                $tambahdata = [
                    'id_operation' => $this->request->getVar('id_operation'),
                    'id_tenaga_kerja' => $tenagakerjadata['id_tenaga_kerja'],
                    'nama_produk' => $operationdata['nama_produk'],
                    'quantity' => $operationdata['quantity'],
                    'tarif' => $tenagakerjadata['tarif'],
                ];

                // date_default_timezone_set('Asia/Jakarta');
                // $namabahan = $this->request->getVar('nama_bahan');
                // $bahandata2 = $this->proModel->verifyBahan($namabahan);
                // $bahanpakai= $this->request->getVar('quantity');
                // $historybahandata = [
                //     'id_history_bahan' => $bahandata['id_bahan'],
                //     'nama_bahan' => $this->request->getVar('nama_bahan'),
                //     'quantity' => $bahandata2['quantity'],
                //     'bahan_pakai' => $this->request->getVar('quantity'),
                //     'sisa_stock' => ($bahandata2['quantity'] - $bahanpakai ),
                //     'tgl_ambil_stock' => date('Y-m-d'),
                // ];
                // $this->proModel->saveHistoryBahan($historybahandata);
                if ($this->proModel->saveOperationList($tambahdata)) {
                    $session->setFlashdata('success', 'Data Operation List berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/operation_list'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/operation_list'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/operation_list_view', $data);
    }

    public function delete_operation_list()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_operation');
        $succes = $this->proModel->deleteOperationList($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Operation List Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/operation_list'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/operation_list'));
        }
    }

    public function edit_operation_list()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'waktu_pengerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Waktu pengerjaan harus diisi',
                    ]
                ],
                'total_biaya' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Total Biaya Gaji harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_operation');
                $data = [
                    'waktu_pengerjaan' => $this->request->getVar('waktu_pengerjaan'),
                    'total_biaya' => $this->request->getVar('total_biaya'),

                ];
                if ($this->proModel->updateOperationList($data, $id)) {
                    $session->setFlashdata('success', 'Data Operation List berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/operation_list'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/operation_list'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['dataoperationlist'] = $this->proModel->getdataOperationList();
                $data['datatenagakerja'] = $this->proModel->getdataTenagaKerja();
                $data['dataprodukjadi'] = $this->proModel->getdataProdukJadi();
                $data['getidoperationlist'] = $this->proModel->get_id_operation_list();
            }
        }
        return view('produksi/operation_list_view', $data);
    }





    //MENU PERMINTAAN BAHAN
    public function Permintaan_bahan()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapermintaanbahan'] = $this->proModel->getdataPermintaanBahan();
        $data['kodepermintaan'] = $this->proModel->get_id_permintaan_bahan();
        $data['databahanbaku'] = $this->guModel->getdataBahanBaku();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_permintaan' => [
                    'rules' => 'required|is_unique[permintaan_bahan.id_permintaan]',
                    'errors' => [
                        'required' => 'Kode Permintaan harus diisi',
                        'is_unique' => 'Kode Permintaan sudah digunakan',
                    ]
                ],
                'nama_bahan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama bahan harus diisi',
                    ]
                ],
                'jmlh_permintaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Permintaan harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $permintaandata = [
                    'id_permintaan' => $this->request->getVar('id_permintaan'),
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'jmlh_permintaan' => $this->request->getVar('jmlh_permintaan'),
                    'status' => 'Menunggu Diterima',
                    'satuan' => $this->request->getVar('satuan_bahan'),
                    'tgl_permintaan' => date('Y-m-d'),
                ];
                if ($this->proModel->savePermintaanBahan($permintaandata)) {
                    $session->setFlashdata('success', 'Data Produk Jadi berhasil diupdate', 3);
                    return redirect()->to(base_url('produksi/permintaan_bahan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('produksi/permintaan_bahan'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('produksi/permintaan_bahan_view', $data);
    }

    public function delete_permintaan_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_permintaan');
        $succes = $this->proModel->deletePermintaanBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Permintaan Bahan Berhasil Dihapus', 3);
            return redirect()->to(base_url('produksi/permintaan_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('produksi/permintaan_bahan'));
        }
    }
}
