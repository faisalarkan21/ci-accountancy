<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;
use App\Models\M_manajemen;
use App\Models\M_produksi;
use App\Models\M_laporan;
use App\Models\M_pembelian;
use App\Models\M_gudang;

class Manajemenkas extends Controller
{
    public $session;
    public $dModel;
    public $manModel;
    public $proModel;
    public $lapModel;
    public $pemModel;
    public $guModel;
    

    public function __construct()
    {
        helper(['form','array','tgl_indo']);
        $this->dModel = new M_dashboard();
        $this->manModel = new M_manajemen();
        $this->proModel = new M_produksi();
        $this->lapModel = new M_laporan();
        $this->pemModel = new M_pembelian();
        $this->guModel = new M_gudang();
        
        
    }

    //MENU ASET
    public function Aset ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataAset'] = $this->manModel->getdataAset();
        $data['getidaset'] = $this->manModel->get_id_aset();
        $data['datacoa'] = $this->proModel->getdataCoa();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_aset' => [
                'rules' => 'required|is_unique[aset.id_aset]',
                'errors' => [
                'required' => 'Kode aset harus diisi',
                'is_unique' => 'Kode aset sudah digunakan',
                ]
            ],
            'nama_aset' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama aset harus diisi',
                ]
            ],
            'tot_harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Harga harus diisi',
                'numeric'=>'Harus berupa angka'
                ]
            ],
            'upload_pembayaran' => [
                'rules' => 'mime_in[upload_pembayaran,image/JPG,image/jpeg,image/gif,image/png]|max_size[upload_pembayaran,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                if ($this->request->getFile('upload_pembayaran') == '') {
                $asetdata = [
                    'id_aset' => $this->request->getVar('id_aset'),
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_harga' => $this->request->getVar('tot_harga'),
                    'tgl_beli' => $this->request->getVar('tgl_beli'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    
                ];   
                }
                elseif ($this->request->getFile('upload_pembayaran') != '') {
                $upload = $this->request->getFile('upload_pembayaran');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-aset');
                $asetdata = [
                    'id_aset' => $this->request->getVar('id_aset'),
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_harga' => $this->request->getVar('tot_harga'),
                    'tgl_beli' => $this->request->getVar('tgl_beli'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'upload_pembayaran' => $upload->getName(),
                ];    
                }
               
                if ($this->manModel->saveAset($asetdata)) {
                    $session->setFlashdata('success', 'Data Aset berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/aset'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/aset'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/aset_view', $data);   
    }

    public function edit_aset()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'nama_aset' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama Aset harus diisi',
                ]
            ],
            'tot_harga' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nilai Aset harus diisi',
                ]
            ],
            'tgl_beli' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Tanggal harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $id = $this->request->getVar('id_aset');
                $gambar = $this->request->getVar('uploads');
                if ($this->request->getFile('upload_pembayaran') == '') {
                $data = [
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'tot_harga' => $this->request->getVar('tot_harga'),
                    'tgl_beli' => $this->request->getVar('tgl_beli'),
                    'keterangan' => $this->request->getVar('keterangan'),
            
                ];
                }
                elseif ($this->request->getFile('upload_pembayaran') != '') {
                $upload = $this->request->getFile('upload_pembayaran');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-aset');
                
                $data = [
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'tot_harga' => $this->request->getVar('tot_harga'),
                    'tgl_beli' => $this->request->getVar('tgl_beli'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'upload_pembayaran' => $upload->getName(),
            
                ];
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-aset/'.$gambar);
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                        
                    }
                }
                
                
                if ($this->manModel->updateAset($data, $id)) {
                    $session->setFlashdata('success', 'Data Aset berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/aset'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/aset'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['dataAset'] = $this->manModel->getdataAset();
            $data['getidaset'] = $this->manModel->get_id_aset();
        }
        return view('manajemenkas/aset_view', $data);
    }      

    public function delete_aset()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_aset');
        $succes=$this->manModel->deleteAset($id);
        if($succes){
            $session->setFlashdata('success', 'Data Aset Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/aset'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/aset'));
        }
    }


    //MENU BEBAN OPERASIONAL
    public function Beban_operasional ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataBebanop'] = $this->manModel->getdataBebanOP();
        $data['getidbebanop'] = $this->manModel->get_id_bebanop();
        $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
        $data['datacoa'] = $this->proModel->getdataCoa();

        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_bebanop' => [
                'rules' => 'required|is_unique[beban_op.id_bebanop]',
                'errors' => [
                'required' => 'Kode beban harus diisi',
                'is_unique' => 'Kode beban sudah digunakan',
                ]
            ],
            'tot_harga_beban' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Harga harus diisi',
                'numeric'=>'Harus berupa angka'
                ]
            ],
            'upload_pembayaran' => [
                'rules' => 'mime_in[upload_pembayaran,image/JPG,image/jpeg,image/gif,image/png]|max_size[upload_pembayaran,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                if ($this->request->getFile('upload_pembayaran') == '') {
                $bebanopdata = [
                    'id_bebanop' => $this->request->getVar('id_bebanop'),
                    'tot_harga_beban' => $this->request->getVar('tot_harga_beban'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    'tgl_bayar' => $this->request->getVar('tgl_bayar'),
                    
                ];    
                }
                elseif ($this->request->getFile('upload_pembayaran') != '') {
                $upload = $this->request->getFile('upload_pembayaran');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-op');
                $bebanopdata = [
                    'id_bebanop' => $this->request->getVar('id_bebanop'),
                    'tot_harga_beban' => $this->request->getVar('tot_harga_beban'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    'tgl_bayar' => $this->request->getVar('tgl_bayar'),
                    'upload_pembayaran' => $upload->getName(),
                ];    
                }
                if ($this->manModel->saveBebanop($bebanopdata)) {
                    $session->setFlashdata('success', 'Data Beban Operasional berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/beban_operasional'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/beban_operasional'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/bebanop_view', $data);
    }

    public function edit_beban_operasional()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
           'upload_pembayaran' => [
                'rules' => 'mime_in[upload_pembayaran,image/JPG,image/jpeg,image/gif,image/png]|max_size[upload_pembayaran,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_bebanop');
                $gambar = $this->request->getVar('uploads');
                if ($this->request->getFile('upload_pembayaran') == '') {
                $data = [
            
                ];
                }
                elseif ($this->request->getFile('upload_pembayaran') != '') {
                $upload = $this->request->getFile('upload_pembayaran');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-op');
                
                $data = [
                    'upload_pembayaran' => $upload->getName(),
            
                ];  
                
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-op/'.$gambar);   
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                        
                    }
                }
                
                
                if ($this->manModel->updateBebanop($data, $id)) {
                    $session->setFlashdata('success', 'Data Beban Operasional berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/beban_operasional'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/beban_operasional'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['dataBebanop'] = $this->manModel->getdataBebanOP();
            $data['getidbebanop'] = $this->manModel->get_id_bebanop();
            $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
            $data['datacoa'] = $this->proModel->getdataCoa();

        }
        return view('manajemenkas/bebanop_view', $data);
    }      

    public function delete_bebanop()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bebanop');
        $succes=$this->manModel->deleteBebanop($id);
        if($succes){
            $session->setFlashdata('success', 'Data Beban Operasional Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/beban_operasional'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/beban_operasional'));
        }
    }

    //MENU UTANG
    public function Utang()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataUtang'] = $this->manModel->getdataUtang();
        $data['getidutang'] = $this->manModel->get_id_utang();
        $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
        $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranUt();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_utang' => [
                'rules' => 'required|is_unique[utang.id_utang]',
                'errors' => [
                'required' => 'Kode utang harus diisi',
                'is_unique' => 'Kode utang sudah digunakan',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $idutang = $this->request->getVar('id_history');
                $datahistoryutang = $this->manModel->verifyhistoryut($idutang);
                $utangdata = [
                    'id_utang' => $this->request->getVar('id_utang'),
                    'tot_utang' => $datahistoryutang['tot_harga_utang'],
                    'ket_utang' => $datahistoryutang['keterangan'],
                    'jenis_utang' => $datahistoryutang['jenis_utang'],
                    'tgl_bayar' => $this->request->getVar('tgl_bayar'),
                    'tgl_lunas' => $this->request->getVar('tgl_lunas'),
                    'upload_pembayaran'=>$datahistoryutang['bukti_bayar'],
                    'id_pembayaranut'=>$datahistoryutang['id_pembayaranut'],
                ];
                if ($this->manModel->saveUtang($utangdata)) {
                    $session->setFlashdata('success', 'Data Utang berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/utang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/utang'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/utang_view', $data); 
    }   
     
    public function edit_utang()
    { 
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'keterangan',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_utang');
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-utang');
                $gambar = $this->request->getVar('uploads');
                $data = [
                    'upload_pembayaran' => $upload->getName(),
                    'ket_utang' =>$this->request->getVar('keterangan')
            
                ];
                unlink(ROOTPATH.'template/assets/img/bukti-bayar-utang/'.$gambar);
                if ($this->manModel->updateUtang($data, $id)) {
                    $session->setFlashdata('success', 'Data Utang berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/utang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/utang'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['dataUtang'] = $this->manModel->getdataUtang();
            $data['getidutang'] = $this->manModel->get_id_utang();
            $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
            $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranUt();
        }
    
        return view('manajemenkas/utang_view',$data);
    }      

    public function delete_utang()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_utang');
        $succes=$this->manModel->deleteUtang($id);
        if($succes){
            $session->setFlashdata('success', 'Data Utang Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/utang'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/utang'));
        }
    }

    //MENU JENIS BEBAN
    public function Jenis_beban()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
        $data['getidjenisbeban'] = $this->manModel->get_id_jenis_beban();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_jen_beban' => [
                'rules' => 'required|is_unique[jenis_beban.id_jen_beban]',
                'errors' => [
                'required' => 'Kode jenis beban harus diisi',
                'is_unique' => 'Kode jenis beban sudah digunakan',
                ]
            ],
            'jenis_beban' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jenis beban harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $jenisbebandata = [
                    'id_jen_beban' => $this->request->getVar('id_jen_beban'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                ];
                if ($this->manModel->saveJenisBeban($jenisbebandata)) {
                    $session->setFlashdata('success', 'Data Jenis Beban berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_beban'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_beban'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/jenis_beban_view', $data);    
    }

    public function edit_jenis_beban()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'jenis_beban' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Jenis beban harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_jen_beban');
                $data = [
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
            
                ];
                if ($this->manModel->updateJenBeban($data, $id)) {
                    $session->setFlashdata('success', 'Data Jenis Beban berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_beban'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_beban'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
            $data['getidjenisbeban'] = $this->manModel->get_id_jenis_beban();
        }
        return view('manajemenkas/jenis_beban_view', $data);
    }      

    public function delete_jenis_beban()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_jen_beban');
        $succes=$this->manModel->deleteJenisBeban($id);
        if($succes){
            $session->setFlashdata('success', 'Data Jenis Beban Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/jenis_beban'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/jenis_beban'));
        }
    }
 

    //MENU JENIS UTANG
    public function Jenis_utang()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
        $data['getidjenisutang'] = $this->manModel->get_id_jenis_utang();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_jen_utang' => [
                'rules' => 'required|is_unique[jenis_utang.id_jen_utang]',
                'errors' => [
                'required' => 'Kode jenis utang harus diisi',
                'is_unique' => 'Kode jenis utang sudah digunakan',
                ]
            ],
            'jenis_utang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jenis utang harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $jenisutangdata = [
                    'id_jen_utang' => $this->request->getVar('id_jen_utang'),
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
                ];
                if ($this->manModel->saveJenisUtang($jenisutangdata)) {
                    $session->setFlashdata('success', 'Data Jenis Utang berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_utang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_utang'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/jenis_utang_view', $data);
    }

    public function delete_jenis_utang()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_jen_utang');
        $succes=$this->manModel->deleteJenisUtang($id);
        if($succes){
            $session->setFlashdata('success', 'Data Jenis Utang Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/jenis_utang'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/jenis_utang'));
        }
    }

    public function edit_jenis_utang()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'jenis_utang' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Jenis Utang harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_jen_utang');
                $data = [
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
            
                ];
                if ($this->manModel->updateJenUtang($data, $id)) {
                    $session->setFlashdata('success', 'Data Jenis Utang berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_utang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/jenis_utang'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
            $data['getidjenisutang'] = $this->manModel->get_id_jenis_utang();
        }
        return view('manajemenkas/jenis_utang_view', $data);
    }      

   

    //MENU PEMBELIAN ASET
    public function pembelian_aset ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembelianaset'] = $this->manModel->getdataPembelianAset();
        $data['datahistorypembelian'] = $this->manModel->getdataHistoryPembelianAset();
        $data['dataAsetDimiliki'] = $this->manModel->getdataAsetDimiliki();
        $data['dataPenyusutan'] = $this->manModel->getdataPenyusutan();
        $data['getidhistoryaset'] = $this->manModel->get_id_history_aset();
        $data['getidpenyusutan'] = $this->manModel->get_id_penyusutan();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['datatotalaset'] = $this->manModel->TotalAset();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_pembelian_aset' => [
                'rules' => 'required|is_unique[pembelian_aset.id_pembelian_aset]',
                'errors' => [
                'required' => 'Kode Pembelian harus diisi',
                'is_unique' => 'Kode Pembelian sudah digunakan',
                ]
            ],
            'nama_aset' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama aset harus diisi',
                ]
            ],
            'tot_biaya_pembelian' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Total biaya harus diisi',
                'numeric' => 'Total biaya harus angka',
                ]
            ],
            'file_upload' => [
                'rules' => 'mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                if ($this->request->getFile('file_upload') == '') {
                $pembelianAsdata = [
                    'id_pembelian_aset' => $this->request->getVar('id_pembelian_aset'),
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_biaya_pembelian' => $this->request->getVar('tot_biaya_pembelian'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_pembelian' =>  $this->request->getVar('tgl_pembelian'),
                    
                ];   
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-pembelian-aset');
                $pembelianAsdata = [
                    'id_pembelian_aset' => $this->request->getVar('id_pembelian_aset'),
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_biaya_pembelian' => $this->request->getVar('tot_biaya_pembelian'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_pembelian' =>  $this->request->getVar('tgl_pembelian'),
                    'bukti_bayar' => $upload->getName(),
                ];    
                }
               
                if ($this->manModel->savePembelianAs($pembelianAsdata)) {
                    $session->setFlashdata('success', 'Data Pembelian Aset berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/pembelian_as_view', $data);
    }

    public function penyusutan ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembelianaset'] = $this->manModel->getdataPembelianAset();
        $data['datahistorypembelian'] = $this->manModel->getdataHistoryPembelianAset();
        $data['dataAsetDimiliki'] = $this->manModel->getdataAsetDimiliki();
        $data['dataPenyusutan'] = $this->manModel->getdataPenyusutan();
        $data['getidhistoryaset'] = $this->manModel->get_id_history_aset();
        $data['getidpenyusutan'] = $this->manModel->get_id_penyusutan();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['datatotalaset'] = $this->manModel->TotalAset();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_penyusutan' => [
                'rules' => 'required|is_unique[penyusutan_aset.id_penyusutan]',
                'errors' => [
                'required' => 'Kode Penyusutan harus diisi',
                'is_unique' => 'Kode Penyusutan sudah digunakan',
                ]
            ],
            'id_aset' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'ID aset harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $idaset= $this->request->getVar('id_aset');
                $datadimiliki = $this->manModel->verifyAsetdimiliki($idaset);
                $penyusutandata = [
                    'id_penyusutan' => $this->request->getVar('id_penyusutan'),
                    'id_aset' => $this->request->getVar('id_aset'),
                    'nama_aset' => $datadimiliki['nama_aset'],
                    'tot_harga' => $datadimiliki['tot_harga'],
                    'nilai_sisa' => $this->request->getVar('nilai_sisa'),
                    'umr_ekonomis' => $this->request->getVar('umur_ekonomis'),
                    'nilai_pen' => $nilaipen=($datadimiliki['tot_harga']-$this->request->getVar('nilai_sisa'))/$this->request->getVar('umur_ekonomis'),
                    'tgl_penyusutan' =>  $this->request->getVar('tgl_penyusutan'),
                    'keterangan' =>  $this->request->getVar('keterangan'),
                    
                ];

                $nmakun = $this->request->getVar('keterangan');
                $kdakun=$this->manModel->verifykdakun($nmakun);
                if ($kdakun['kode_akun']=='512-1') {
                    $kdjr='PNT';
                }
                elseif ($kdakun['kode_akun']=='512-2') {
                    $kdjr='PNB';
                }
                elseif ($kdakun['kode_akun']=='512-3') {
                    $kdjr='PNPK';
                }
                elseif ($kdakun['kode_akun']=='512-4') {
                    $kdjr='PNK';
                }
                //JURNAL MANKAS
                $jurnaldata1=[
                    'id'   => $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => $kdakun['kode_akun'],
                    'debet'   => $nilaipen,
                    'kredit' => '0'
                ]; 
                if ($kdakun['kode_akun']=='512-1') {
                $jurnaldata2=[
                    'id'   => $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => '131-1',
                    'debet'   => '0',
                    'kredit' => $nilaipen,
                ]; 
                }
                elseif ($kdakun['kode_akun']=='512-2') {
                    $jurnaldata2=[
                        'id'   => $kdjr,
                        'tanggal' => date('Y-m-d'),
                        'kode_akun' => '131-2',
                        'debet'   => '0',
                        'kredit' => $nilaipen,
                    ]; 
                }
                elseif ($kdakun['kode_akun']=='512-3') {
                    $jurnaldata2=[
                        'id'   => $kdjr,
                        'tanggal' => date('Y-m-d'),
                        'kode_akun' => '131-3',
                        'debet'   => '0',
                        'kredit' => $nilaipen,
                    ]; 
                }    
                elseif ($kdakun['kode_akun']=='512-4') {
                    $jurnaldata2=[
                        'id'   => $kdjr,
                        'tanggal' => date('Y-m-d'),
                        'kode_akun' => '131-4',
                        'debet'   => '0',
                        'kredit' => $nilaipen,
                    ]; 
                }   
                $this->lapModel->insertjurnal_mankas($jurnaldata1);
                $this->lapModel->insertjurnal_mankas($jurnaldata2);

                // $idaset= $this->request->getVar('id_aset');
                // $datadimiliki = $this->manModel->verifyAsetdimiliki($idaset);
                // $idaset2= $this->request->getVar('id_aset');
                // $updatedata=[
                //     'tot_harga' => ($datadimiliki['tot_harga']-$this->request->getVar('nilai_sisa'))/$this->request->getVar('umur_ekonomis')
                // ];
                // $this->manModel->Updateasetdimiliki($updatedata,$idaset2);
                if ($this->manModel->savePenyusutan($penyusutandata)) {
                    $session->setFlashdata('success', 'Data Penyusutan berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/pembelian_as_view', $data);
    }
    
    public function delete_pembelianaset()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_pembelian_aset');
        $succes=$this->manModel->deletePembelianAset($id);
        if($succes){
            $session->setFlashdata('success', 'Data Pembelian Aset Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        }
    }

    public function delete_historypembelian()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes=$this->manModel->deleteHistoryPembelian($id);
        if($succes){
            $session->setFlashdata('success', 'Data History Pembelian Aset Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        }
    }
    
    public function update_history_pembelianAs()    
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historypembeliandata = [
            'id_pembelian_aset' => $this->request->getVar('id_pembelian_aset'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'tgl_pembelian' => $this->request->getVar('tgl_pembelian'),
            'nama_toko' => $this->request->getVar('nama_toko'),
            'tot_biaya_pembelian' => $this->request->getVar('tot_biaya_pembelian'),
            'kategori' => $this->request->getVar('kategori'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tgl_pembayaran'=> date('Y-m-d'),
            'bukti_bayar' => $this->request->getVar('bukti_bayar'),
        ];
        $assetdimiliki=[
            'id_aset' => $this->request->getVar('id_pembelian_aset'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'tot_harga' => $this->request->getVar('tot_biaya_pembelian'),
            'nama_toko' => $this->request->getVar('nama_toko'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tgl_beli' => date('Y-m-d'),
            'upload_pembayaran' => $this->request->getVar('bukti_bayar'),
        ];
        $this->manModel->InsertAsetDimiliki($assetdimiliki);

        $nmakun = $this->request->getVar('keterangan');
        $kdakun=$this->manModel->verifykdakun($nmakun);
        if ($kdakun['kode_akun']=='121-1') {
            $kdjr='TN1';
        }
        elseif ($kdakun['kode_akun']=='121-2') {
            $kdjr='BA1';
        }
        elseif ($kdakun['kode_akun']=='121-3') {
            $kdjr='PK1';
        }
        elseif ($kdakun['kode_akun']=='121-4') {
            $kdjr='KEN1';
        }
        //JURNAL MANKAS
        $jurnaldata1=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('tot_biaya_pembelian'),
            'kredit' => '0'
           ]; 
        $jurnaldata2=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('tot_biaya_pembelian'),
           ]; 
        $this->lapModel->insertjurnal_mankas($jurnaldata1);
        $this->lapModel->insertjurnal_mankas($jurnaldata2);
        // JURNAL KEUANGAN
        $jurnaldata3=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('tot_biaya_pembelian'),
            'kredit' => '0'
           ]; 
        $jurnaldata4=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('tot_biaya_pembelian'),
           ]; 
        $this->lapModel->insertjurnal_keuangan($jurnaldata4);
        $this->lapModel->insertjurnal_keuangan($jurnaldata5);
        $succes=$this->manModel->historyPembelianAset($historypembeliandata);
        if($succes){
            $session->setFlashdata('success', 'Data pembelian berhasil terupdate ke history', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        }
    }

        public function delete_aset_dimiliki()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_dimiliki');
        $succes=$this->manModel->deleteAsetDimiliki($id);
        if($succes){
            $session->setFlashdata('success', 'Data Aset Dimiliki Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembelian_aset'));
        }
    }


    public function edit_pembelian_aset()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_aset' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nama aset harus diisi',
                    ]
                ],
                'tot_biaya_pembelian' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                    'required' => 'Total biaya harus diisi',
                    'numeric' => 'Total biaya harus angka',
                    ]
                ],
                ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_pembelian_aset');
                $gambar1 = $this->request->getVar('uploads');
                if ($this->request->getFile('file_upload') == '') {
                $data = [
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_biaya_pembelian' => $this->request->getVar('tot_biaya_pembelian'),
                    'kategori' => $this->request->getVar('kategori'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_pembelian' =>  $this->request->getVar('tgl_pembelian'),
            
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-pembelian-aset');
                
                $data = [
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'tot_biaya_pembelian' => $this->request->getVar('tot_biaya_pembelian'),
                    'kategori' => $this->request->getVar('kategori'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_pembelian' =>  $this->request->getVar('tgl_pembelian'),
                    'bukti_bayar' => $upload->getName()
            
                ];    
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-pembelian-aset/'.$gambar1);
                }
                elseif ($this->request->getVar('uploads') == '' ) {
                    
                }
                }
                
               
                
                if ($this->manModel->updatePembelianAset($data, $id)) {
                    $session->setFlashdata('success', 'Data Pembelian Aset berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembelian_aset'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembelianaset'] = $this->manModel->getdataPembelianAset();
        $data['datahistorypembelian'] = $this->manModel->getdataHistoryPembelianAset();
        $data['dataAsetDimiliki'] = $this->manModel->getdataAsetDimiliki();
        $data['getidhistoryaset'] = $this->manModel->get_id_history_aset();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['datatotalaset'] = $this->manModel->TotalAset();
        $data['dataPenyusutan'] = $this->manModel->getdataPenyusutan();
        }
        return view('manajemenkas/pembelian_as_view', $data);
    }      
    

    //MENU PEMBAYARAN OPERASIONAL
    public function Pembayaran_operasional ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembayaranop'] = $this->manModel->getdataPembayaranOp();
        $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
        $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranOp();
        $data['getidhistoryoperasional'] = $this->manModel->get_id_pembayaran_operasional();
        $data['datacoa'] = $this->proModel->getdataCoa();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_pembayaranop' => [
                'rules' => 'required|is_unique[pembayaran_op.id_pembayaranop]',
                'errors' => [
                'required' => 'Kode Pembayaran harus diisi',
                'is_unique' => 'Kode Pembayaran sudah digunakan',
                ]
            ],
            'tot_harga_beban' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Harga harus diisi',
                'numeric' => 'Harga harus berupa angka',
                ]
            ],
            'file_upload' => [
                'rules' => 'mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                if ($this->request->getFile('file_upload') == '') {
                $pembayaranopdata = [
                    'id_pembayaranop' => $this->request->getVar('id_pembayaranop'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_beban' => $this->request->getVar('tot_harga_beban'),
                    'tgl_beban' => $this->request->getVar('tgl_beban'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-op');
                $pembayaranopdata = [
                    'id_pembayaranop' => $this->request->getVar('id_pembayaranop'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_beban' => $this->request->getVar('tot_harga_beban'),
                    'tgl_beban' => $this->request->getVar('tgl_beban'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    'bukti_bayar' => $upload->getName()
                ];
                }
                
                if ($this->manModel->savePembayaranOp($pembayaranopdata)) {
                    $session->setFlashdata('success', 'Data Pembayaran Operasional berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/pembayaran_op_view', $data);
    }

    public function edit_pembayaran_operasional()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'total_operasional' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka',
                    ]
                ],
                ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_pembayaranop');
                $gambar1 = $this->request->getVar('bukti_bayar');
                if ($this->request->getFile('file_upload') == '') {
                $data = [
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_beban' => $this->request->getVar('total_operasional'),
                    'tgl_beban' => $this->request->getVar('tgl_beban'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    
            
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-op');
                
                $data = [
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_beban' => $this->request->getVar('total_operasional'),
                    'tgl_beban' => $this->request->getVar('tgl_beban'),
                    'jenis_beban' => $this->request->getVar('jenis_beban'),
                    'bukti_bayar' => $upload->getName()
            
                ]; 
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-op/'.$gambar1);
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                        
                    }   
                }
            
               
                if ($this->manModel->updatePembayaranBeban($data, $id)) {
                    $session->setFlashdata('success', 'Data Pembayaran Beban berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datapembayaranop'] = $this->manModel->getdataPembayaranOp();
            $data['datajenisbeban'] = $this->manModel->getdataJenisBeban();
            $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranOp();
            $data['getidhistoryoperasional'] = $this->manModel->get_id_pembayaran_operasional();
            $data['datacoa'] = $this->proModel->getdataCoa();
        }
        return view('manajemenkas/pembayaran_op_view', $data);
    }      

    public function delete_pembayaranop()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_bebanop');
        $succes=$this->manModel->deletePembayaranOp($id);
        if($succes){
            $session->setFlashdata('success', 'Data Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        }
    }

    public function delete_historyop()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes=$this->manModel->deleteHistoryOp($id);
        if($succes){
            $session->setFlashdata('success', 'Data History Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        }
    }

    public function update_history_pembayaranop()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historyopdata = [
            'id_pembayaranop' => $this->request->getVar('id_pembayaranop'),
            'keterangan' => $this->request->getVar('ket_pembayaran'),
            'tot_harga_beban' => $this->request->getVar('total_operasional'),
            'tgl_beban' => $this->request->getVar('tgl_beban'),
            'bukti_bayar' => $this->request->getVar('bukti_bayar'),
            'jenis_beban' => $this->request->getVar('jenis_beban'),
            'tgl_pembayaran'=> date('Y-m-d'),
        ];

        $nmakun = $this->request->getVar('ket_pembayaran');
        $kdakun=$this->manModel->verifykdakun($nmakun);
        if ($kdakun['kode_akun']=='511-1') {
            $kdjr='UA1';
        }
        elseif ($kdakun['kode_akun']=='511-2') {
            $kdjr='UL1';
        }
        elseif ($kdakun['kode_akun']=='511-4') {
            $kdjr='URM1';
        }
        // JURNAL MANKAS
        $jurnaldata1=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('total_operasional'),
            'kredit' => '0'
           ]; 
           $jurnaldata2=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('total_operasional'),
           ]; 
           $this->lapModel->insertjurnal_mankas($jurnaldata1);
           $this->lapModel->insertjurnal_mankas($jurnaldata2);
        // JURNAL PRODUKSI
        $jurnaldata3=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('total_operasional'),
            'kredit' => '0'
           ]; 
           $jurnaldata4=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '210',
            'debet'   => '0',
            'kredit' => $this->request->getVar('total_operasional'),
           ]; 
            $this->lapModel->insertjurnal_produksi($jurnaldata3);
            $this->lapModel->insertjurnal_produksi($jurnaldata4);

        // JURNAL KEUANGAN
        $jurnaldata5=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('total_operasional'),
            'kredit' => '0'
           ]; 
           $jurnaldata6=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('total_operasional'),
           ]; 
            $this->lapModel->insertjurnal_keuangan($jurnaldata5);
            $this->lapModel->insertjurnal_keuangan($jurnaldata6);
        $succes=$this->manModel->historyPembayaranOp($historyopdata);
        if($succes){
            $session->setFlashdata('success', 'Data pembayaran berhasil terupdate ke history', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_operasional'));
        }
    }

    //MENU PEMBAYARAN UTANG
    public function Pembayaran_utang ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapembayaranut'] = $this->manModel->getdataPembayaranUt();
        $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
        $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranUt();
        $data['getidhistoryutang'] = $this->manModel->get_id_pembayaran_utang();
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['getidproses'] = $this->manModel->getdataprosesperbln();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_pembayaranut' => [
                'rules' => 'required|is_unique[pembayaran_ut.id_pembayaranut]',
                'errors' => [
                'required' => 'Kode Pembayaran harus diisi',
                'is_unique' => 'Kode Pembayaran sudah digunakan',
                ]
            ],
            'file_upload' => [
                'rules' => 'mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $idproses = $this->request->getVar('id_proses');
                $dataproses=$this->manModel->verifyidproses($idproses);
                if ($this->request->getFile('file_upload') == '') {
                    if ($this->request->getVar('id_proses') != "") {
                    $pembayaranutdata = [
                        'id_pembayaranut' => $this->request->getVar('id_pembayaranut'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'tot_harga_utang' => $dataproses['jmlh_proses'],
                        'tgl_utang' => $this->request->getVar('tgl_utang'),
                        'jenis_utang' => $this->request->getVar('jenis_utang'),
                        
                        ];   
                    }
                    elseif ($this->request->getVar('id_proses') == "") {
                    $pembayaranutdata = [
                    'id_pembayaranut' => $this->request->getVar('id_pembayaranut'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_utang' => $this->request->getVar('tot_harga_utang'),
                    'tgl_utang' => $this->request->getVar('tgl_utang'),
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
                    
                        ];
                    }
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-utang');
                

                    if ($this->request->getVar('id_proses') != "") {
                    $pembayaranutdata = [
                        'id_pembayaranut' => $this->request->getVar('id_pembayaranut'),
                        'keterangan' => $this->request->getVar('keterangan'),
                        'tot_harga_utang' => $dataproses['jmlh_proses'],
                        'tgl_utang' => $this->request->getVar('tgl_utang'),
                        'jenis_utang' => $this->request->getVar('jenis_utang'),
                        'bukti_bayar' => $upload->getName(),
                        ];   
                    }
                    elseif ($this->request->getVar('id_proses') == "") {
                    $pembayaranutdata = [
                    'id_pembayaranut' => $this->request->getVar('id_pembayaranut'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tot_harga_utang' => $this->request->getVar('tot_harga_utang'),
                    'tgl_utang' => $this->request->getVar('tgl_utang'),
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
                    'bukti_bayar' => $upload->getName(),
                        ];
                    }   
                }
               
                if ($this->manModel->savePembayaranUt($pembayaranutdata)) {
                    $session->setFlashdata('success', 'Data Pembayaran Utang berhasil diupdate', 3);
                    return redirect()->to(current_url());
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/pembayaran_ut_view', $data);
    }

    public function edit_pembayaran_utang()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'total_utang' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka',
                    ]
                ],
                ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $id = $this->request->getVar('id_pembayaranut');
                $gambar = $this->request->getVar('uploads');
                if ($this->request->getFile('file_upload') == '') {
                $data = [
                    'tot_harga_utang' => $this->request->getVar('total_utang'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_utang' => $this->request->getVar('tgl_utang'),
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-utang');
                
                $data = [
                    'tot_harga_utang' => $this->request->getVar('total_utang'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_utang' => $this->request->getVar('tgl_utang'),
                    'jenis_utang' => $this->request->getVar('jenis_utang'),
                    'bukti_bayar' => $upload->getName(),
                ];
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-utang/'.$gambar);
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                    
                    }
                }
                
               
                if ($this->manModel->updatePembayaranUtang($data, $id)) {
                    $session->setFlashdata('success', 'Data Pembayaran Utang berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['datapembayaranut'] = $this->manModel->getdataPembayaranUt();
            $data['datajenisutang'] = $this->manModel->getdataJenisUtang();
            $data['datahistorypembayaran'] = $this->manModel->getdataHistoryPembayaranUt();
            $data['getidhistoryutang'] = $this->manModel->get_id_pembayaran_utang();
            $data['datacoa'] = $this->proModel->getdataCoa();
        }
        return view('manajemenkas/pembayaran_ut_view', $data);
    }     

    public function delete_pembayaranut()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_pembayaranut');
        $succes=$this->manModel->deletePembayaranUt($id);
        if($succes){
            $session->setFlashdata('success', 'Data Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        }
    }

    public function delete_historyut()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes=$this->manModel->deleteHistoryUt($id);
        if($succes){
            $session->setFlashdata('success', 'Data History Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        }
    }

    public function update_history_pembayaranut()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $historyutdata = [
            'id_pembayaranut' => $this->request->getVar('id_pembayaranut'),
            'keterangan' => $this->request->getVar('ket_pembayaran'),
            'tot_harga_utang' => $this->request->getVar('total_utang'),
            'tgl_utang' => $this->request->getVar('tgl_utang'),
            'bukti_bayar' => $this->request->getVar('bukti_bayar'),
            'jenis_utang' => $this->request->getVar('jenis_utang'),
            'tgl_pembayaran'=> date('Y-m-d'),
        ];
        $nmakun = $this->request->getVar('ket_pembayaran');
        $kdakun=$this->manModel->verifykdakun($nmakun);
        if ($kdakun['kode_akun']=='212-1') {
            $kdjr='UPB1';
        }
        elseif ($kdakun['kode_akun']=='212-2') {
            $kdjr='UG1';
        }
        //JURNAL MANKAS
        $jurnaldata1=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('total_utang'),
            'kredit' => '0'
           ]; 
           $jurnaldata2=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('total_utang'),
           ]; 
           $this->lapModel->insertjurnal_mankas($jurnaldata1);
           $this->lapModel->insertjurnal_mankas($jurnaldata2);

        //JURNAL KEUANGAN
        $jurnaldata3=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => $kdakun['kode_akun'],
            'debet'   => $this->request->getVar('total_utang'),
            'kredit' => '0'
           ]; 
           $jurnaldata4=[
            'id'   => $kdjr,
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => '0',
            'kredit' => $this->request->getVar('total_utang'),
           ]; 
           $this->lapModel->insertjurnal_keuangan($jurnaldata3);
           $this->lapModel->insertjurnal_keuangan($jurnaldata4);
        $succes=$this->manModel->historyPembayaranUt($historyutdata);
        if($succes){
            $session->setFlashdata('success', 'Data pembayaran berhasil terupdate ke history', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/pembayaran_utang'));
        }
    }

    //MENU PRIVE
    public function Prive ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataprive'] = $this->manModel->getdataPrive();
        $data['getidprive'] = $this->manModel->get_id_prive();
        $data['datacoa'] = $this->proModel->getdataCoa();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_prive' => [
                'rules' => 'required|is_unique[prive.id_prive]',
                'errors' => [
                'required' => 'Kode Prive harus diisi',
                'is_unique' => 'Kode Prive sudah digunakan',
                ]
            ],
            // 'jmlh_prive' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //     'required' => 'Jumlah prive harus diisi',
            //     'numeric' => 'Jumlah prive harus angka',
            //     ]
            // ],
            'file_upload' => [
                'rules' => 'mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
                'errors' => [
                'mime_in' => 'Format File salah',
                'max_size' => 'Maximal size 4 mb',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                if ($this->request->getFile('file_upload') == '') {
                $privedata = [
                    'id_prive' => $this->request->getVar('id_prive'),
                    'jmlh_prive' => $this->request->getVar('jmlh_prive'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_prive' => $this->request->getVar('tgl_prive'),
                    
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-prive');
                
                $privedata = [
                    'id_prive' => $this->request->getVar('id_prive'),
                    'jmlh_prive' => $this->request->getVar('jmlh_prive'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'tgl_prive' => $this->request->getVar('tgl_prive'),
                    'bukti_bayar' => $upload->getName(),
                ];    
                }
                
                $nmakun = $this->request->getVar('keterangan');
                $kdakun=$this->manModel->verifykdakun($nmakun);
                if ($kdakun['kode_akun']=='311-2') {
                    $kdjr='PRV1';
                }
                elseif ($kdakun['kode_akun']=='212-2') {
                    $kdjr='UG1';
                }
                //JURNAL MANKAS
                $jurnaldata2=[
                    'id'   =>  $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => $kdakun['kode_akun'],
                    'debet'   => $this->request->getVar('jmlh_prive'),
                    'kredit' => '0'
                   ]; 
                   $jurnaldata3=[
                    'id'   => $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => '111',
                    'debet'   => '0',
                    'kredit' => $this->request->getVar('jmlh_prive'),
                   ]; 
                   $this->lapModel->insertjurnal_mankas($jurnaldata2);
                   $this->lapModel->insertjurnal_mankas($jurnaldata3);

                //JURNAL KEUANGAN
                $jurnaldata4=[
                    'id'   =>  $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => $kdakun['kode_akun'],
                    'debet'   => $this->request->getVar('jmlh_prive'),
                    'kredit' => '0'
                   ]; 
                   $jurnaldata5=[
                    'id'   => $kdjr,
                    'tanggal' => date('Y-m-d'),
                    'kode_akun' => '111',
                    'debet'   => '0',
                    'kredit' => $this->request->getVar('jmlh_prive'),
                   ]; 
                   $this->lapModel->insertjurnal_keuangan($jurnaldata4);
                   $this->lapModel->insertjurnal_keuangan($jurnaldata5);
               
                if ($this->manModel->savePrive($privedata)) {

                   
                    $session->setFlashdata('success', 'Data Prive berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/prive'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/prive'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/prive_view', $data);
    }
   
    public function delete_prive()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_prive');
        $succes=$this->manModel->deletePrive($id);
        if($succes){
            $session->setFlashdata('success', 'Data Prive Berhasil Dihapus', 3);
            return redirect()->to(base_url('manajemenkas/prive'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('manajemenkas/prive'));
        }
    }

    public function edit_prive()
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
                $id = $this->request->getVar('id_prive');
                $gambar = $this->request->getVar('uploads');
                if ($this->request->getFile('file_upload') == '') {
                $data = [
                    
            
                ];
                }
                elseif ($this->request->getFile('file_upload') != '') {
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-prive');
                
                $data = [
                    'bukti_bayar' => $upload->getName(),
            
                ];
                if ($this->request->getVar('uploads') != '' ) {
                    unlink(ROOTPATH.'template/assets/img/bukti-bayar-prive/'.$gambar);
                    }
                    elseif ($this->request->getVar('uploads') == '' ) {
                        
                    }
                }
                
                
                if ($this->manModel->updatePrive($data, $id)) {
                    $session->setFlashdata('success', 'Data Prive berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/prive'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/prive'));
                }
            }
        } else {
            $data['validation'] = $this->validator;
            $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
            $data['dataprive'] = $this->manModel->getdataPrive();
            $data['getidprive'] = $this->manModel->get_id_prive();
            $data['datacoa'] = $this->proModel->getdataCoa();
        }
        return view('manajemenkas/prive_view', $data);
    }      

    //MENU PROSES PERBULAN
    public function proses_perbulan ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataproses'] = $this->manModel->getdataprosesperbln();
       
        $data['datacoa'] = $this->proModel->getdataCoa();
        $data['tahunhistory'] = $this->guModel->tampil_tahun_pembelian();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_proses' => [
                'rules' => 'is_unique[proses_perbulan.id_proses]',
                'errors' => [
                'is_unique' => 'Kode proses sudah digunakan',
                ]
            ],
            ];  
            date_default_timezone_set('Asia/Jakarta');
            $bln= $this->request->getVar('bln_jurnal');
            $thn= $this->request->getVar('thn_history');
            $totalpembelian=$this->guModel->SumPembelian($bln,$thn);
            if ($this->validate($rules)) {
                $data = [
                    'id_proses' =>  $this->manModel->get_id_proses_pemb(),
                    'jmlh_proses' => $totalpembelian['harga_bahan'],
                    'nama_proses' => "Proses Pembelian Per bln",
                    'tgl_proses' => date('Y-m-d'),
                ];
               
                if ($this->manModel->saveProses($data)) {

                    $session->setFlashdata('success', 'Data Proses Pembelian berhasil diupdate', 3);
                    return redirect()->to(base_url('manajemenkas/proses_perbulan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('manajemenkas/proses_perbulan'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('manajemenkas/proses_perbulan_view', $data);
    }
   
    // public function delete_prive()
    // {
    //     $data = [];
    //     $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //     $session = session();
    //     $id = $this->request->getVar('id_prive');
    //     $succes=$this->manModel->deletePrive($id);
    //     if($succes){
    //         $session->setFlashdata('success', 'Data Prive Berhasil Dihapus', 3);
    //         return redirect()->to(base_url('manajemenkas/prive'));
    //     } else {
    //         $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
    //         return redirect()->to(base_url('manajemenkas/prive'));
    //     }
    // }

    // public function edit_prive()
    // {
    //     $session = session();
    //     if ($this->request->getMethod() == 'post') {
    //         $rules = [
    //         'keterangan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //             'required' => 'Keterangan....',
    //             ]
    //         ],
    //         ];
    //         if ($this->validate($rules)) {
    //             $id = $this->request->getVar('id_prive');
    //             $upload = $this->request->getFile('file_upload');
    //             $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-prive');
    //             $gambar = $this->request->getVar('bukti_bayar');
    //             $data = [
    //                 'keterangan' => $this->request->getVar('keterangan'),
    //                 'bukti_bayar' => $upload->getName(),
            
    //             ];
    //             unlink(ROOTPATH.'template/assets/img/bukti-bayar-prive/'.$gambar);
    //             if ($this->manModel->updatePrive($data, $id)) {
    //                 $session->setFlashdata('success', 'Data Prive berhasil diupdate', 3);
    //                 return redirect()->to(base_url('manajemenkas/prive'));
    //             } else {
    //                 $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
    //                 return redirect()->to(base_url('manajemenkas/prive'));
    //             }
    //         }
    //     } else {
    //         $data['validation'] = $this->validator;
    //         $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
    //         $data['dataprive'] = $this->manModel->getdataPrive();
    //         $data['getidprive'] = $this->manModel->get_id_prive();
    //         $data['datacoa'] = $this->proModel->getdataCoa();
    //     }
    //     return view('manajemenkas/prive_view', $data);
    // }      
}
   