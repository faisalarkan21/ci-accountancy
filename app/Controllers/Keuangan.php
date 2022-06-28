<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;
use App\Models\M_keuangan;
use App\Models\M_produksi;
use App\Models\M_laporan;
use App\Models\M_manajemen;

class Keuangan extends Controller
{
    public $session;
    public $dModel;
    public $keuModel;
    public $proModel;
    public $lapModel;
    public $manModel;

    public function __construct()
    {
        helper(['form','array','tgl_indo']);
        $this->dModel = new M_dashboard();
        $this->keuModel = new M_keuangan();
        $this->proModel = new M_produksi();
        $this->lapModel = new M_laporan();
        $this->manModel = new M_manajemen();
        
    }

    //MENU JENIS PENERIMAAN
    public function Jenis_penerimaan ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datajenis'] = $this->keuModel->getdataJenisPenerimaan();
        $data['getidjenis'] = $this->keuModel->get_id_jenis_penerimaan();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_jenis_penerimaan' => [
                'rules' => 'required|is_unique[jenis_penerimaan.id_jenis_penerimaan]',
                'errors' => [
                'required' => 'Kode Jenis Penerimaan harus diisi',
                'is_unique' => 'Kode Jenis Penerimaan sudah digunakan',
                ]
            ],
            'jenis_penerimaan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jenis Penerimaan harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $jenispenerimaandata = [
                    'id_jenis_penerimaan' => $this->request->getVar('id_jenis_penerimaan'),
                    'jenis_penerimaan' => $this->request->getVar('jenis_penerimaan'),
                ];
                if ($this->keuModel->saveJenisPenerimaan($jenispenerimaandata)) {
                    $session->setFlashdata('success', 'Data Jenis Penerimaan berhasil diupdate', 3);
                    return redirect()->to(base_url('keuangan/jenis_penerimaan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('keuangan/jenis_penerimaan'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('keuangan/jenis_penerimaan_view', $data);
    }

    public function delete_jenis_penerimaan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_jenis_penerimaan');
        $succes=$this->keuModel->deleteJenisPenerimaan($id);
        if($succes){
            $session->setFlashdata('success', 'Data Jenis Penerimaan Berhasil Dihapus', 3);
            return redirect()->to(base_url('keuangan/jenis_penerimaan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('keuangan/jenis_penerimaan'));
        }
    }
        
    //MENU PENERIMAAN KAS
    public function Penerimaan_kas ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapenerimaankas'] = $this->keuModel->getdataPenerimaankas();
        $data['datajenis'] = $this->keuModel->getdataJenisPenerimaan();
        $data['totalpenerimaan'] = $this->keuModel->TotalPenerimaan();
        $data['getidpenerimaan'] = $this->keuModel->get_id_penerimaan();
        $data['datacoa'] = $this->proModel->getdataCoa();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_penerimaan' => [
                'rules' => 'required|is_unique[penerimaan_kas.id_penerimaan]',
                'errors' => [
                'required' => 'Kode Penerimaan Kas harus diisi',
                'is_unique' => 'Kode Penerimaan Kas sudah digunakan',
                ]
            ],
            'jenis_penerimaan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jenis Penerimaan harus diisi',
                ]
            ],
            'total' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Total Penerimaan harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $penerimaandata = [
                    'id_penerimaan' => $this->request->getVar('id_penerimaan'),
                    'jenis_penerimaan' => $this->request->getVar('jenis_penerimaan'),
                    'total' => $this->request->getVar('total'),
                    'kategori' => $this->request->getVar('kategori'),
                    'tgl_penerimaan' => date('Y-m-d'),
                ];

                $nmakun = $this->request->getVar('kategori');
                $kdakun=$this->manModel->verifykdakun($nmakun);
                if ($kdakun['kode_akun']=='311-1') {
                    $kdjr='MA1';
                }
                // elseif ($kdakun['kode_akun']=='121-2') {
                //     $kdjr='BA1';
                // }
                // elseif ($kdakun['kode_akun']=='121-3') {
                //     $kdjr='PK1';
                // }
                // elseif ($kdakun['kode_akun']=='121-4') {
                //     $kdjr='KEN1';
                // }
                //JURNAL MANKAS
                $jurnaldata1=[
                    'id'   =>  $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => $kdakun['kode_akun'],
                    'debet'   => $this->request->getVar('total'),
                    'kredit' => '0'
                ]; 
                $jurnaldata2=[
                    'id'   =>  $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => '111',
                    'debet'   => '0',
                    'kredit' => $this->request->getVar('total'),
                ]; 
                $this->lapModel->insertjurnal_keuangan($jurnaldata1);
                $this->lapModel->insertjurnal_keuangan($jurnaldata2);
                if ($this->keuModel->savePenerimaan($penerimaandata)) {
                    $session->setFlashdata('success', 'Data Penerimaan berhasil diupdate', 3);
                    return redirect()->to(base_url('keuangan/penerimaan_kas'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('keuangan/penerimaan_kas'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('keuangan/penerimaan_kas_view', $data);
    }

    public function delete_penerimaan_kas()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_penerimaan');
        $succes=$this->keuModel->deletePenerimaan($id);
        if($succes){
            $session->setFlashdata('success', 'Data Penerimaan Kas Berhasil Dihapus', 3);
            return redirect()->to(base_url('keuangan/penerimaan_kas'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('keuangan/penerimaan_kas'));
        }
    }

    public function edit_penerimaan()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
           'file_upload' => [
                'rules' => 'mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_penerimaan');
                $gambar = $this->request->getVar('uploads');
                if ($this->request->getFile('file_upload') == '') {
                $data = [
                    
            
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-penerimaan-kas');
                
                $data = [
                    'bukti_bayar' => $upload->getName(),
            
                ];
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-penerimaan-kas/'.$gambar);
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                        
                    }
                }
                
                
                if ($this->keuModel->updatePenerimaan($data, $id)) {
                    $session->setFlashdata('success', 'Data Penerimaan berhasil diupdate', 3);
                    return redirect()->to(base_url('keuangan/penerimaan_kas'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('keuangan/penerimaan_kas'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datapenerimaankas'] = $this->keuModel->getdataPenerimaankas();
            $data['datajenis'] = $this->keuModel->getdataJenisPenerimaan();
            $data['totalpenerimaan'] = $this->keuModel->TotalPenerimaan();
            $data['getidpenerimaan'] = $this->keuModel->get_id_penerimaan();
            $data['datacoa'] = $this->proModel->getdataCoa();
        }
        return view('keuangan/penerimaan_kas_view', $data);
    }      
}