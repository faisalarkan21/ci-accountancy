<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_gudang;
use App\Models\M_dashboard;

class Gudang extends Controller
{
    public $guModel;
    public $dModel;
    public function __construct()
    {
        $this->guModel = new M_gudang();
        $this->dModel = new M_dashboard();
        helper(['form','array','tgl_indo']);
    }
    

    // MENU EOQ
    public function Eoq()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataeoq'] = $this->guModel->getdataEoq();
        $data['ideoq'] = $this->guModel->get_id_eoq();
        $data['idpermintaan'] = $this->guModel->PermintaanSudahDiterima();
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
            'id_permintaan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode Permintaan harus diisi',
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
                $idpermintaan= $this->request->getVar('id_permintaan');
                $permintaandata = $this->guModel->verifyPermintaan($idpermintaan);
                $eoq= round(sqrt((2*$permintaandata['jmlh_permintaan']*$permintaandata['biaya_pemesanan'])/$permintaandata['biaya_penyimpanan']));
                $rop= round($permintaandata['jmlh_permintaan']/$eoq);
                $hari= $this->request->getVar('jmlh_hari');
                $lead= round($hari/$rop);
                $eoqdata = [
                    'id_eoq' => $this->request->getVar('id_eoq'),
                    'id_permintaan' => $this->request->getVar('id_permintaan'),
                    'jmlh_hari' => $this->request->getVar('jmlh_hari'),
                    'nama_bahan' => $permintaandata['nama_bahan'],
                    'biaya_pemesanan' => $permintaandata['biaya_pemesanan'],
                    'biaya_penyimpanan' => $permintaandata['biaya_penyimpanan'],
                    'jmlh_permintaan' => $permintaandata['jmlh_permintaan'],
                    'safety_stok' => $permintaandata['safety_stok'],
                    'eoq' => $eoq,
                    'rop' => $rop,
                    'lead_time' => $lead,
                    'biaya_optimal' => $permintaandata['biaya_bahan']*$eoq,
                    'biaya_bahan' => $permintaandata['biaya_bahan'],
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
                $idpermintaan= $this->request->getVar('id_permintaan');
                $permintaandata = $this->guModel->verifyPermintaan($idpermintaan);
                date_default_timezone_set('Asia/Jakarta');
                $total = $permintaandata['jmlh_permintaan']*$permintaandata['biaya_bahan'];
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
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_receipt' => [
                'rules' => 'required|is_unique[good_receipt.id_receipt]',
                'errors' => [
                'required' => 'Kode Good Receipt  harus diisi',
                'is_unique' => 'Kode Good Receipt digunakan',            
                ]
            ],
            'id_pembelian' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode Pembelian harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $idpembelian= $this->request->getVar('id_pembelian');
                $pembeliandata = $this->guModel->verifyPembelian($idpembelian);
                date_default_timezone_set('Asia/Jakarta');
                $gooddata = [
                    'id_receipt' => $this->request->getVar('id_receipt'),
                    'id_pembelian' => $this->request->getVar('id_pembelian'),
                    'nama_vendor' => $pembeliandata['nama_vendor'],
                    'tgl_penerimaan' => date('Y-m-d'),
                ];
                if ($this->guModel->saveGoodReceipt($gooddata)) {
                    $session->setFlashdata('success', 'Data Good Receipt berhasil diupdate', 3);
                    return redirect()->to(base_url('gudang/good_receipt'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('gudang/good_receipt'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
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
                 'rules' => 'required',
                 'errors' => [
                 'required' => 'Nama bahan harus diisi',
                 
                 ]
             ],
             'stock' => [
                 'rules' => 'required|numeric',
                 'errors' => [
                 'required' => 'Stock harus diisi',
                 'numeric'=>'Stock Harus berupa angka'
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
                     'stock' => $this->request->getVar('stock'),
                     'satuan' => $this->request->getVar('satuan'),
                     'harga' => $this->request->getVar('harga'),
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
         $succes=$this->guModel->deleteBahanBaku($id);
         if($succes){
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
                'stock' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                    'required' => 'Stock harus diisi',
                    'numeric'=>'Stock Harus berupa angka'
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
                 $id = $this->request->getVar('id_bahan');
                 $data = [
                    'stock' => $this->request->getVar('stock'),
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

    public function delete_sisa_bahan()
    {
         $data = [];
         $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
         $session = session();
         $id = $this->request->getVar('id_sisa');
         $succes=$this->guModel->deleteSisaBahan($id);
         if($succes){
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
         $data['dataID'] = $this->guModel->SelectIDpermintaan();
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
                 'numeric'=>'Biaya Pemesanan Harus berupa angka'
                 ]
             ],
             'biaya_penyimpanan' => [
                 'rules' => 'required|numeric',
                 'errors' => [
                 'required' => 'Biaya Penyimpanan harus diisi',
                 'numeric'=>'Biaya Penyimpanan Harus berupa angka'
                 ]
             ],
             'safety_stok' => [
                 'rules' => 'required|numeric',
                 'errors' => [
                 'required' => 'Safety Stok harus diisi',
                 'numeric'=>'Safety Stok Harus berupa angka'
                 ]
             ],
             ];
             if ($this->validate($rules)) {
                $id = $this->request->getVar('id_permintaan');
                date_default_timezone_set('Asia/Jakarta');
                 $bahandata = [
                     'biaya_pemesanan' => $this->request->getVar('biaya_pemesanan'),
                     'biaya_penyimpanan' => $this->request->getVar('biaya_penyimpanan'),
                     'safety_stok' => $this->request->getVar('safety_stok'),
                     'tgl_permintaan' => date('Y-m-d')
                    ];
                 if ($this->guModel->updatePermintaanBahan($bahandata, $id)) {
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
                 $id = $this->request->getVar('id_permintaan');
                 $data = [
                    'status' => $this->request->getVar('status'),
 
                 ];
                 if ($this->guModel->terima_tolak_data($data, $id)) {
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
              } 
         }
         return view('gudang/permintaan_bahan_view', $data);
    }
}