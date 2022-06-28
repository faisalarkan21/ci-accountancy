<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pembelian;
use App\Models\M_dashboard;
use App\Models\M_produksi;
use App\Models\M_gudang;

class Pembelian extends Controller
{
    public $pemModel;
    public $dModel;
    public $proModel;
    public $guModel;
    
    public function __construct()
    {
        $this->pemModel = new M_pembelian();
        $this->proModel = new M_produksi();
        $this->dModel = new M_dashboard();
        $this->guModel = new M_gudang();
        
        helper(['form','array','tgl_indo']);
    }
    


    //MENU VENDOR
    public function Vendor ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['idvendor'] = $this->pemModel->get_id_vendor();
        $data['datavendor'] = $this->pemModel->getdataVendor();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_vendor' => [
                'rules' => 'required|is_unique[vendor.id_vendor]',
                'errors' => [
                'required' => 'Kode Vendor harus diisi',
                'is_unique' => 'Kode Vendor sudah digunakan',
                ]
            ],
            'nama_vendor' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama vendor harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'nomor telepon harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $vendordata = [
                    'id_vendor' => $this->request->getVar('id_vendor'),
                    'nama_vendor' => $this->request->getVar('nama_vendor'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                ];
                if ($this->pemModel->saveVendor($vendordata)) {
                    $session->setFlashdata('success', 'Data Vendor berhasil diupdate', 3);
                    return redirect()->to(base_url('pembelian/vendor'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('pembelian/vendor'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('pembelian/vendor_view', $data);
    }
   
    public function delete_vendor()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_vendor');
        $succes=$this->pemModel->deleteVendor($id);
        if($succes){
            $session->setFlashdata('success', 'Data Vendor Berhasil Dihapus', 3);
            return redirect()->to(base_url('pembelian/vendor'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('pembelian/vendor'));
        }
    }

    public function edit_vendor()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nomor telepon harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_vendor');
                $data = [
                    'alamat'        => $this->request->getVar('alamat'),
                    'no_telp'        => $this->request->getVar('no_telp'),
                ];
                if ($this->pemModel->updateVendor($data, $id)) {
                    $session->setFlashdata('success', 'Data Vendor berhasil diupdate', 3);
                    return redirect()->to(base_url('pembelian/vendor'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('pembelian/vendor'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datavendor'] = $this->pemModel->getdataVendor();
        }
        return view('pembelian/vendor_view', $data);
    }   
    
    //MENU PEMBELIAN BAHAN
    public function pembelian_bahan()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembelian'] = $this->pemModel->getdataPembelianBahan();
        $data['datahistorypembelian'] = $this->pemModel->getdataHistoryPembayaran();
        $data['idpembelian'] = $this->pemModel->get_id_pembelian();
        $data['ideoq'] = $this->pemModel->getdataEoq();
        $data['namavendor'] = $this->pemModel->selectdataVendor();
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_pembelian' => [
                'rules' => 'required|is_unique[pembelian_bahan.id_pembelian]',
                'errors' => [
                'required' => 'Kode Pembelian  harus diisi',
                'is_unique' => 'Kode Pembelian sudah digunakan',            
                ]
            ],
            'id_eoq' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode EOQ harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $ideoq= $this->request->getVar('id_eoq');
                $eoqdata = $this->pemModel->verifyEoq($ideoq);
                date_default_timezone_set('Asia/Jakarta');
                $pembeliandata = [
                    'id_pembelian' => $this->request->getVar('id_pembelian'),
                    'id_eoq' => $this->request->getVar('id_eoq'),
                    'nama_bahan' => $eoqdata['nama_bahan'],
                    'jmlh_pembelian' => $eoqdata['jmlh_pembelian'],
                    'harga_pembelian' => $eoqdata['biaya_optimal'],
                    'nama_vendor' => $this->request->getVar('nama_vendor'),
                    'frekuensi' => $eoqdata['rop'],
                    'lead_time' => $eoqdata['lead_time'],
                    'total_pembelian' => $eoqdata['jmlh_pembelian']*$eoqdata['biaya_bahan'],
                    'tgl_pembelian' => date('Y-m-d'),
                ];
                if ($this->pemModel->savePembelian($pembeliandata)) {
                    $session->setFlashdata('success', 'Data Pembelian Bahan berhasil diupdate', 3);
                    return redirect()->to(base_url('pembelian/pembelian_bahan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('pembelian/pembelian_bahan'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('pembelian/pembelian_bahan_view', $data);
    }

    public function delete_pembayaran()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_pembelian');
        $succes=$this->pemModel->deletePembayaran($id);
        if($succes){
            $session->setFlashdata('success', 'Data Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('pembelian/pembayaran_pembelian'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('pembelian/pembayaran_pembelian'));
        }
    }

    public function update_history_pembayaran()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historypembayarandata = [
            'id_pembelian' => $this->request->getVar('id_pembelian'),
            'id_eoq' => $this->request->getVar('id_eoq'),
            'nama_bahan' => $this->request->getVar('nama_bahan'),
            'nama_vendor' => $this->request->getVar('nama_vendor'),
            'jmlh_pembelian' => $this->request->getVar('jmlh_pembelian'),
            'harga_pembelian' => $this->request->getVar('harga_pembelian'),
            'frekuensi' => $this->request->getVar('frekuensi'),
            'lead_time' => $leadtime = $this->request->getVar('lead_time'),
            'tgl_pembelian' => $this->request->getVar('tgl_pembelian'),
            'total_pembelian' => $this->request->getVar('total_pembelian'),
            'tgl_pembayaran' => date('Y-m-d'),
        ];
        $insertdateclick=[
            'tgl_click'=> $tglclick= date('Y-m-d'),
            'tgl_clickafter'=>  date('Y-m-d', strtotime('+'.$leadtime.'days', strtotime($tglclick))),
            'jmlh_click' => $this->request->getVar('jmlh_click') + 1,
        ];
        $id = $this->request->getVar('id_pembelian');
        $this->pemModel->DateClick($insertdateclick,$id);

        //UPDATE STATUS PEMBELIAN BAHAN DI GUDANG
        $namabahan = $this->request->getVar('nama_bahan');
        $dataupdatestatus = [
            'status' => 'Selesai' 
        ];
        $this->pemModel->updateStatusPembelianGudang($dataupdatestatus, $namabahan);

        //INSERT GOOD RECEIPT AUTO
        $datagoodreceipt=[
            'id_receipt' => $this->guModel->get_id_receipt(),
            'id_pembelian' => $this->request->getVar('id_pembelian'),
            'nama_vendor' => $this->request->getVar('nama_vendor'),
            'tgl_penerimaan'=> $this->request->getVar('tgl_pembelian'),
            'nama_bahan' => $this->request->getVar('nama_bahan'),
            'quantity' => $this->request->getVar('jmlh_pembelian'),
            
        ];
        $this->guModel->saveGoodReceipt($datagoodreceipt);

        //UPDATE STOK SISA DI BAHAN BAKU GUDANG
        $namasisagudang = $this->request->getVar('nama_bahan');
        $stok = $this->request->getVar('nama_bahan');
        $datastokbahan = $this->guModel->VerifyStoksisa($stok);
        $updatesisabahan =[
            'stok_sisa'=> $datastokbahan['stok_sisa'] + $this->request->getVar('jmlh_pembelian')

        ];
        $this->guModel->updateSisaBahanBaku($updatesisabahan, $namasisagudang);

        $succes=$this->pemModel->historyPembayaran($historypembayarandata);
        if($succes){
            $session->setFlashdata('success', 'Data Pembayaran berhasil terupdate ke history', 3);
            return redirect()->to(base_url('pembelian/pembelian_bahan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('pembelian/pembelian_bahan'));
        }
    }

    public function delete_history_pembayaran()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes=$this->pemModel->deleteHistoryPembayaran($id);
        if($succes){
            $session->setFlashdata('success', 'Data History Berhasil Dihapus', 3);
            return redirect()->to(base_url('pembelian/pembayaran_pembelian'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('pembelian/pembayaran_pembelian'));
        }
    }
}