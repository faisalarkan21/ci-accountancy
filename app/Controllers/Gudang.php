<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_gudang;
use App\Models\M_produksi;
use App\Models\M_dashboard;
use App\Models\M_laporan;

class Gudang extends Controller
{
    public $guModel;
    public $proModel;
    public $dModel;
    public $lapModel;
    public function __construct()
    {
        $this->guModel = new M_gudang();
        $this->proModel = new M_produksi();
        $this->dModel = new M_dashboard();
        $this->lapModel = new M_laporan();
        helper(['form', 'array', 'tgl_indo']);
    }


    // MENU EOQ
    public function Eoq()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataeoq'] = $this->guModel->getdataEoq();
        $data['ideoq'] = $this->guModel->get_id_eoq();
        $data['idpembelian'] = $this->guModel->getdataPembelianproses();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_eoq' => [
                    'rules' => 'required|is_unique[eoq.id_eoq]',
                    'errors' => [
                        'required' => 'Kode EOQ harus diisi',
                        'is_unique' => 'Kode EOQ sudah digunakan',
                    ]
                ],
                'id_pembelian' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Pembelian harus diisi',
                    ]
                ],
                'jmlh_hari' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Hari harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idpembelian = $this->request->getVar('id_pembelian');
                $pembeliandata = $this->guModel->verifyPembelianBahan($idpembelian);
                $eoq = round(sqrt((2 * $pembeliandata['jmlh_pembelian'] * $pembeliandata['biaya_pemesanan']) / $pembeliandata['biaya_penyimpanan']));
                $rop = round($pembeliandata['jmlh_pembelian'] / $eoq);
                $hari = $this->request->getVar('jmlh_hari');
                $lead = round($hari / $rop);
                $eoqdata = [
                    'id_eoq' => $this->request->getVar('id_eoq'),
                    'id_pembelian' => $this->request->getVar('id_pembelian'),
                    'jmlh_hari' => $this->request->getVar('jmlh_hari'),
                    'nama_bahan' => $pembeliandata['nama_bahan'],
                    'biaya_pemesanan' => $pembeliandata['biaya_pemesanan'],
                    'biaya_penyimpanan' => $pembeliandata['biaya_penyimpanan'],
                    'jmlh_pembelian' => $pembeliandata['jmlh_pembelian'],
                    'safety_stok' => $pembeliandata['safety_stok'],
                    'eoq' => $eoq,
                    'rop' => $rop,
                    'lead_time' => $lead,
                    'biaya_optimal' => $pembeliandata['biaya_bahan'] * $eoq,
                    'biaya_bahan' => $pembeliandata['biaya_bahan'],
                    'status' => 'Diproses',
                    'satuan_safety' => $this->request->getVar('satuan_safety'),
                ];
                if ($this->guModel->saveEoq($eoqdata)) {
                    $session->setFlashdata('success', 'Data EOQ berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/eoq'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/eoq'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('gudang/eoq_view', $data);
    }



    //MENU GOOD ISSUE
    public function good_issue()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datagood'] = $this->guModel->getdataGoodIssue();
        $data['idgood'] = $this->guModel->get_id_good();
        $data['idpermintaan'] = $this->guModel->PermintaanSudahDiterima();
        $data['datapermintaan'] = $this->guModel->getdataPermintaanGudang();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_good' => [
                    'rules' => 'required|is_unique[good_issue.id_good]',
                    'errors' => [
                        'required' => 'Kode Good Issue  harus diisi',
                        'is_unique' => 'Kode Good Issue digunakan',
                    ]
                ],
                'id_permintaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Permintaan harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $idpermintaan = $this->request->getVar('id_permintaan');
                $permintaandata = $this->guModel->verifyPermintaan($idpermintaan);
                date_default_timezone_set('Asia/Jakarta');
                $total = $permintaandata['jmlh_permintaan'] * $permintaandata['biaya_bahan'];
                $gooddata = [
                    'id_good' => $this->request->getVar('id_good'),
                    'id_permintaan' => $this->request->getVar('id_permintaan'),
                    'nama_bahan' => $permintaandata['nama_bahan'],
                    'quantity' => $permintaandata['jmlh_permintaan'],
                    'harga' => $permintaandata['biaya_bahan'],
                    'total' => $total,
                    'tgl_penerimaan' => date('Y-m-d'),
                ];
                if ($this->guModel->saveGoodIssue($gooddata)) {
                    $session->setFlashdata('success', 'Data Good Issue berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/good_issue'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/good_issue'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('gudang/good_issue_view', $data);
    }


    //MENU GOOD RECEIPT
    public function good_receipt()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datareceipt'] = $this->guModel->getdataGoodReceipt();
        $data['idreceipt'] = $this->guModel->get_id_receipt();
        $data['idpembelian'] = $this->guModel->SelectIDPembelian();
        $data['datatotalreceipt'] = $this->guModel->TotalReceipt();
        $session = session();
        return view('gudang/good_receipt_view', $data);
    }


    //MENU BAHAN BAKU
    public function Bahan_baku()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['databahanbaku'] = $this->guModel->getdataBahanBaku();
        $data['databahansisa'] = $this->guModel->getdataBahanSisa();
        $data['getidbahan'] = $this->guModel->get_id_bahan_baku();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_bahan' => [
                    'rules' => 'required|is_unique[bahan_baku_gudang.id_bahan]',
                    'errors' => [
                        'required' => 'Kode bahan harus diisi',
                        'is_unique' => 'Kode bahan sudah digunakan',
                    ]
                ],
                'nama_bahan' => [
                    'rules' => 'required|is_unique[bahan_baku_gudang.nama_bahan]',
                    'errors' => [
                        'required' => 'Nama bahan harus diisi',
                        'is_unique' => 'Nama bahan sudah ada / tidak boleh sama',

                    ]
                ],
                'satuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Header akun harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $bahandata = [
                    'id_bahan' => $this->request->getVar('id_bahan'),
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'satuan' => $this->request->getVar('satuan'),
                    'harga' => $this->request->getVar('harga'),
                    'safety_stok' => $this->request->getVar('safety_stok'),
                ];
                if ($this->guModel->saveBahanBaku($bahandata)) {
                    $session->setFlashdata('success', 'Data Bahan berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('gudang/bahan_baku_view', $data);
    }

    public function delete_bahan_baku()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bahan');
        $succes = $this->guModel->deleteBahanBaku($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Bahan Baku Berhasil Dihapus', 3);
            return redirect()->to(base_url('gudang/bahan_baku'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('gudang/bahan_baku'));
        }
    }

    public function edit_bahan_baku()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'satuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Header akun harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_bahan');
                $data = [
                    'satuan' => $this->request->getVar('satuan'),
                    'harga' => $this->request->getVar('harga'),

                ];
                if ($this->guModel->updateBahanBaku($data, $id)) {
                    $session->setFlashdata('success', 'Data Bahan Baku berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['databahanbaku'] = $this->guModel->getdataBahanBaku();
                $data['databahansisa'] = $this->guModel->getdataBahanSisa();
                $data['getidbahan'] = $this->guModel->get_id_bahan_baku();
            }
        }
        return view('gudang/bahan_baku_view', $data);
    }

    public function beli_bahan_baku()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'beli_bahan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Stock harus diisi',
                        'numeric' => 'Stock Harus berupa angka'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_sisa');
                $data = [
                    'stok_sisa' => $this->request->getVar('stok_sisa') + $this->request->getVar('beli_bahan'),
                ];
                if ($this->guModel->updateBeliBahan($data, $id)) {
                    $session->setFlashdata('success', 'Data Bahan Baku berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/bahan_baku'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['databahanbaku'] = $this->guModel->getdataBahanBaku();
                $data['databahansisa'] = $this->guModel->getdataBahanSisa();
                $data['getidbahan'] = $this->guModel->get_id_bahan_baku();
            }
        }
        return view('gudang/bahan_baku_view', $data);
    }

    public function delete_sisa_bahan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_sisa');
        $succes = $this->guModel->deleteSisaBahan($id);
        if ($succes) {
            $session->setFlashdata('success', 'Data Sisa Bahan Baku Berhasil Dihapus', 3);
            return redirect()->to(base_url('gudang/bahan_baku'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('gudang/bahan_baku'));
        }
    }



    //MENU PERMINTAAN BAHAN
    public function permintaan_bahan_gudang()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapermintaan'] = $this->guModel->getdataPermintaanGudang();
        $data['databahansisa'] = $this->guModel->getdataBahanSisa();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_permintaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID tidak boleh kosong',
                    ]
                ],
                'biaya_pemesanan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Biaya Pemesanan harus diisi',
                        'numeric' => 'Biaya Pemesanan Harus berupa angka'
                    ]
                ],
                'biaya_penyimpanan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Biaya Penyimpanan harus diisi',
                        'numeric' => 'Biaya Penyimpanan Harus berupa angka'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $safety = $this->request->getVar('nama_bahan');
                $datasafety = $this->guModel->VerifySafetyStok($safety);
                $bahandata = [
                    'id_permintaan' => $this->request->getVar('id_permintaan'),
                    'jmlh_permintaan' => $this->request->getVar('jmlh_permintaan'),
                    'biaya_bahan' => $datasafety['harga'],
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'satuan' => $datasafety['satuan'],
                    'safety_stok' => $datasafety['safety_stok'],
                    'biaya_pemesanan' => $this->request->getVar('biaya_pemesanan'),
                    'biaya_penyimpanan' => $this->request->getVar('biaya_penyimpanan'),
                    'tgl_permintaan' => date('Y-m-d')
                ];

                $nama = $this->request->getVar('nama_bahan');
                $datastoksisa = $this->guModel->VerifySisaStok($nama);
                $namabahan = $this->request->getVar('nama_bahan');
                $sisabahandata = [
                    'jmlh_permintaan' => $this->request->getVar('jmlh_permintaan'),
                    'tgl_permintaan' => date('Y-m-d'),
                    'stok_sisa' => $datastoksisa['stok_sisa'] - $this->request->getVar('jmlh_permintaan'),
                ];
                $this->guModel->updateBahanSisaBahan($sisabahandata, $namabahan);
                if ($this->guModel->savePermintaanGudang($bahandata)) {
                    $session->setFlashdata('success', 'Data Permintaan Bahan berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('gudang/permintaan_bahan_view', $data);
    }


    public function Terima_tolak()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status harus diisi',

                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $stok = $this->request->getVar('nama_bahan');
                $datastokbahan = $this->guModel->VerifyStoksisa($stok);
                $harga = $this->request->getVar('nama_bahan');
                $datahargabahan = $this->guModel->VerifyHargabahan($harga);
                $id = $this->request->getVar('id_permintaan');
                $data = [
                    'status' => $this->request->getVar('status'),
                    'biaya_bahan' => $datahargabahan['harga'],

                ];

                $stokpermintaan = $this->request->getVar('jmlh_permintaan');
                $nama = $this->request->getVar('nama_bahan');
                $datanamabahan = $this->guModel->VerifyNamabahan($nama);
                if ($datanamabahan['nama_bahan'] != $nama) {
                    $session->setFlashdata('error', 'Maaf daftar nama barang tidak ada silahkan lakukan pendataan di daftar bahan baku terlebih dahulu', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                } elseif ($stokpermintaan > $datastokbahan['stok_sisa']) {
                    $session->setFlashdata('error', 'Maaf persediaan barang tidak cukup silahkan lakukan pembelian terlebih dahulu', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                } elseif ($this->guModel->proses_permintaan($data, $id)) {
                    date_default_timezone_set('Asia/Jakarta');
                    $idpermintaan = $this->request->getVar('id_permintaan');
                    $datapermintaanproduksi = [
                        'status' => 'Diterima',

                    ];
                    $this->guModel->UpdateStatus($datapermintaanproduksi, $idpermintaan);

                    //update ke data sisa bahan
                    $namasisagudang = $this->request->getVar('nama_bahan');
                    $stok = $this->request->getVar('nama_bahan');
                    $datastokbahan = $this->guModel->VerifyStoksisa($stok);
                    $updatesisabahan = [
                        'stok_sisa' => $datastokbahan['stok_sisa'] - $this->request->getVar('jmlh_permintaan'),
                        'tgl_permintaan' => date('Y-m-d'),
                        'jmlh_permintaan' =>  $this->request->getVar('jmlh_permintaan'),

                    ];
                    $this->guModel->updateSisaBahanBaku($updatesisabahan, $namasisagudang);

                    //insert ke data good issue
                    $insertdatagoodissue = [
                        'id_good' => $this->guModel->get_id_good(),
                        'id_permintaan' => $this->request->getVar('id_permintaan'),
                        'nama_bahan' => $this->request->getVar('nama_bahan'),
                        'quantity' => $this->request->getVar('jmlh_permintaan'),
                        'harga' => $datahargabahan['harga'],
                        'total' => $datahargabahan['harga'] * $this->request->getVar('jmlh_permintaan'),
                        'tgl_penerimaan' => date('Y-m-d'),
                    ];
                    $this->guModel->saveGoodIssue($insertdatagoodissue);

                    //update di data bahan baku (role produksi)
                    $namabahanproduksi = $this->request->getVar('nama_bahan');
                    $nama = $this->request->getVar('nama_bahan');
                    $datanamabahanproduksi = $this->guModel->VerifyNamabahanproduksi($namabahanproduksi);
                    if ($nama !== $datanamabahanproduksi['nama_bahan']) {
                        $insertdatabahan = [
                            'id_bahan' => $this->proModel->get_id_bahan_baku(),
                            'nama_bahan' => $this->request->getVar('nama_bahan'),
                            'quantity' => $this->request->getVar('jmlh_permintaan'),
                            'satuan' => $this->request->getVar('satuan'),
                            'harga_bahan' => $datahargabahan['harga'],
                        ];
                        $this->proModel->saveBahan($insertdatabahan);

                        // $historybahandata = [
                        //     'id_history_bahan' => $this->guModel->get_id_history_bahan(),
                        //     'nama_bahan' => $this->request->getVar('nama_bahan'),
                        //     'quantity' => $this->request->getVar('jmlh_permintaan'),
                        //     'sisa_stock' => $this->request->getVar('jmlh_permintaan'),

                        // ];

                        // $this->proModel->saveHistoryBahan($historybahandata);
                    } elseif ($nama == $datanamabahanproduksi['nama_bahan']) {
                        $namebahanproduksi = $this->request->getVar('nama_bahan');
                        $namabahan = $this->request->getVar('nama_bahan');
                        $bahandata = $this->proModel->verifyBahan($namabahan);
                        $updatedatabahan = [
                            'quantity' => $bahandata['quantity'] + $this->request->getVar('jmlh_permintaan'),
                            'harga_bahan' => $datahargabahan['harga'],
                        ];
                        $this->guModel->UpdateBahanproduksi($updatedatabahan, $namebahanproduksi);
                    }
                    $session->setFlashdata('success', 'Data Permintaan berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/permintaan_bahan_gudang'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['datapermintaan'] = $this->guModel->getdataPermintaanGudang();
                $data['dataID'] = $this->guModel->SelectIDpermintaan();
                $data['getidbahanbaku'] = $this->proModel->get_id_bahan_baku();
                $data['idgood'] = $this->guModel->get_id_good();
            }
        }
        return view('gudang/permintaan_bahan_view', $data);
    }

    //MENU PEMBELIAN BAHAN
    public function pembelian_bahan_gudang()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembelian'] = $this->guModel->getdataPembelianGudang();
        $data['idpembelian'] = $this->guModel->get_id_pembelian();
        $data['databahansisa'] = $this->guModel->getdataBahanSisa();
        $data['tahunhistory'] = $this->guModel->tampil_tahun_pembelian();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'id_pembelian' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID tidak boleh kosong',
                    ]
                ],
                'biaya_pemesanan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Biaya Pemesanan harus diisi',
                        'numeric' => 'Biaya Pemesanan Harus berupa angka'
                    ]
                ],
                'biaya_penyimpanan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Biaya Penyimpanan harus diisi',
                        'numeric' => 'Biaya Penyimpanan Harus berupa angka'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $safety = $this->request->getVar('nama_bahan');
                $datasafety = $this->guModel->VerifySafetyStok($safety);
                $bahandata = [
                    'id_pembelian' => $this->request->getVar('id_pembelian'),
                    'jmlh_pembelian' => $this->request->getVar('jmlh_pembelian'),
                    'biaya_bahan' => $datasafety['harga'],
                    'nama_bahan' => $this->request->getVar('nama_bahan'),
                    'satuan' => $datasafety['satuan'],
                    'safety_stok' => $datasafety['safety_stok'],
                    'biaya_pemesanan' => $this->request->getVar('biaya_pemesanan'),
                    'biaya_penyimpanan' => $this->request->getVar('biaya_penyimpanan'),
                    'tgl_pembelian' => date('Y-m-d'),
                    'status' => 'Sedang Proses'
                ];

                // $nama = $this->request->getVar('nama_bahan');
                // $datastoksisa = $this->guModel->VerifySisaStok($nama);
                // $namabahan = $this->request->getVar('nama_bahan');
                // $sisabahandata = [
                //     'jmlh_permintaan' => $this->request->getVar('jmlh_pembelian'),
                //     'tgl_permintaan' => date('Y-m-d'),
                //     'stok_sisa' => $datastoksisa['stok_sisa'] - $this->request->getVar('jmlh_pembelian'),
                // ];
                // $this->guModel->updateBahanSisaBahan($sisabahandata, $namabahan);


                
                if ($this->guModel->savePembelianGudang($bahandata)) {
                    $session->setFlashdata('success', 'Data Pembelian Bahan berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/pembelian_bahan_gudang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/pembelian_bahan_gudang'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('gudang/pembelian_bahan_view', $data);
    }

    public function jurnal_pembelian()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $bln= $this->request->getVar('bln_jurnal');
        $thn= $this->request->getVar('thn_history');
        $totalpembelian=$this->guModel->SumPembelian($bln,$thn);
        $totalpemesanan=$this->guModel->SumPemesanan($bln,$thn);
        $totalpenyimpanan=$this->guModel->SumPenyimpanan($bln,$thn);
        
        // JURNAL PEMBELIAN
        // Persediaan Bahan
        $jurnaldata1=[
            'id'   => 'PBB1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '116-1',
            'debet'   => $totalpembelian['harga_bahan'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_pembelian($jurnaldata1);
        
        $jurnaldata2=[
            'id'   => 'PBB1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '210',
            'debet'   => '0',
            'kredit' => $totalpembelian['harga_bahan']
           ]; 
            
        $this->lapModel->insertjurnal_pembelian($jurnaldata2);
        
        // biaya pemesanan
        $jurnaldata3=[
            'id'   => 'BPEM1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '512-5',
            'debet'   => $totalpemesanan['harga_pemesanan'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_pembelian($jurnaldata3);
        
        $jurnaldata4=[
            'id'   => 'BPEM1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $totalpemesanan['harga_pemesanan']
           ]; 
            
        $succes= $this->lapModel->insertjurnal_pembelian($jurnaldata4);

        //biaya penyimpanan
        $jurnaldata5=[
            'id'   => 'BPNY1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '512-6',
            'debet'   => $totalpenyimpanan['harga_penyimpanan'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_pembelian($jurnaldata5);
        
        $jurnaldata6=[
            'id'   => 'BPNY1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $totalpenyimpanan['harga_penyimpanan']
           ]; 
            
        $succes= $this->lapModel->insertjurnal_pembelian($jurnaldata6);

        
            
        
        if($succes){
            $session->setFlashdata('success', 'Data Jurnal berhasil terupdate', 3);
            return redirect()->to(base_url('gudang/pembelian_bahan_gudang'));
        } else {
            $session->setFlashdata('error', 'Maaf Data Bulan dan Tahun tidak ada di history silahkan cek lagi', 3);
            return redirect()->to(base_url('gudang/pembelian_bahan_gudang'));
        }
    }

}