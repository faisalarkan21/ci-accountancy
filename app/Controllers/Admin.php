<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;
use App\Models\M_admin;
use App\Models\M_laporan;

class Admin extends Controller
{
    public $session;
    public $dModel;
    public $admModel;
    public $lapModel;

    public function __construct()
    {
        helper(['form','array','tgl_indo']);
        $this->dModel = new M_dashboard();
        $this->admModel = new M_admin();
        $this->lapModel = new M_laporan();
        
    }

    //MENU PRODUCT
    public function Product ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataproduct'] = $this->admModel->getdataProduct();
        $data['dataproductTerjual'] = $this->admModel->getdataProductTerjual();
        $data['dataproductSiap'] = $this->admModel->getdataBarangSiapJual();
        $data['datatotalbarang'] = $this->admModel->TotalBarang();
        $data['datatotalbarangterjual'] = $this->admModel->TotalBarangTerjual();
        $data['getidbarang'] = $this->admModel->get_id_barang();
        $data['datamerchant'] = $this->admModel->getdataMerchant();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
           
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama Barang harus diisi',
                ]
            ],
            'jmlh_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Jumlah Barang harus diisi',
                'numeric'=>'Harus berupa angka'
                ]
            ],
            ];
            if ($this->validate($rules)) {

                $idbarang =$this->request->getVar('nama_barang');
                $idmerchant =$this->request->getVar('nama_merchant');
                $databarangsiap=$this->admModel->verifyBarangSiap($idmerchant,$idbarang);
                $namabarang =$this->request->getVar('nama_barang');
                $databarang=$this->admModel->verifyBarang($namabarang);
                $namabarang =$this->request->getVar('nama_barang');
                $namamerchant =$this->request->getVar('nama_merchant');
                
                if ($databarangsiap['nama_barang']==$namabarang && $databarangsiap['merchant']==$namamerchant) {
                    if ($databarang['jmlh_barang']<$this->request->getVar('jmlh_barang')) {
                        $session->setFlashdata('error', 'Stok barang kurang harap periksa kembali jumlah barang di daftar barang', 3);
                        return redirect()->to(base_url('admin/product'));
                    
                    } else {

                    $id= $databarangsiap['id_barang_siap'];
                    $updatesiap=[
                        'jmlh_barang' => $databarangsiap['jmlh_barang']+$this->request->getVar('jmlh_barang'),

                    ];
                    $this->admModel->updateBarangSiapJual($updatesiap, $id);
                    $id= $this->request->getVar('nama_barang');
                    $updatebarang=[
                        'jmlh_barang' => $databarang['jmlh_barang']-$this->request->getVar('jmlh_barang'),

                    ];
                    $this->admModel->updatedaftarbarang($updatebarang, $id);
                    $session->setFlashdata('success', 'Data Barang berhasil diupdate 1', 3);
                    return redirect()->to(base_url('admin/product'));
                    }
                }

                
                elseif($databarangsiap['nama_barang']!==$namabarang && $databarangsiap['merchant']!==$namamerchant) {
                    if ($databarang['jmlh_barang']<$this->request->getVar('jmlh_barang')) {
                        $session->setFlashdata('error', 'Stok barang kurang harap periksa kembali jumlah barang di daftar barang', 3);
                        return redirect()->to(base_url('admin/product'));
                    
                    } else {
                    $databarangsiapjual=[
                        'id_barang_siap'=>  $this->admModel->get_id_barang_siap(),
                        'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                        'merchant' => $this->request->getVar('nama_merchant'),
                        'nama_barang' => $this->request->getVar('nama_barang'),

                    ];
                    $this->admModel->saveBarangSiapJual($databarangsiapjual);
                    $id= $this->request->getVar('nama_barang');
                    $updatebarang=[
                        'jmlh_barang' => $databarang['jmlh_barang']-$this->request->getVar('jmlh_barang'),

                    ];
                    $this->admModel->updatedaftarbarang($updatebarang, $id);
                    $session->setFlashdata('success', 'Data Barang berhasil diupdate 2', 3);
                    return redirect()->to(base_url('admin/product')); 
                    }
                

                // elseif($databarangsiap['nama_barang']==$namabarang && $databarangsiap['merchant']!==$namamerchant) {
                //     if ($databarang['jmlh_barang']<$this->request->getVar('jmlh_barang')) {
                //         $session->setFlashdata('error', 'Stok barang kurang harap periksa kembali jumlah barang di daftar barang', 3);
                //         return redirect()->to(base_url('admin/product'));
                    
                //     } else {
                //     $databarangsiapjual=[
                //         'id_barang_siap'=>  $this->admModel->get_id_barang_siap(),
                //         'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                //         'merchant' => $this->request->getVar('nama_merchant'),
                //         'nama_barang' => $this->request->getVar('nama_barang'),

                //     ];
                //     $this->admModel->saveBarangSiapJual($databarangsiapjual);
                //     $id= $databarangsiap['nama_barang'];
                //     $updatebarang=[
                //         'jmlh_barang' => $databarang['jmlh_barang']-$this->request->getVar('jmlh_barang'),

                //     ];
                //     $this->admModel->updatedaftarbarang($updatebarang, $id);
                //     $session->setFlashdata('success', 'Data Barang berhasil diupdate 3', 3);
                //     return redirect()->to(base_url('admin/product')); 
                //     }
                
                // $productdata = [
                //     'id_barang' => $this->request->getVar('id_barang'),
                //     'nama_barang' => $this->request->getVar('nama_barang'),
                //     'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                //     'harga_barang' => $this->request->getVar('harga_barang'),
                // ];
                // if ($this->admModel->saveProduct($productdata)) {
                //     // $session->setFlashdata('success', 'Data Barang berhasil diupdate', 3);
                //     // return redirect()->to(base_url('admin/product'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/product'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/product_view', $data);
        
    }

    public function edit_product()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'harga_barang' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Harga Barang harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $namabarang= $this->request->getVar('nama_barang');
                $barangdata = $this->admModel->verifyBarang($namabarang);
                $id = $this->request->getVar('id_barang');
                $data = [
                    'harga_barang'  => $this->request->getVar('harga_barang'),
            
                ];
                if ($this->admModel->updateProduct($data, $id)) {
                    $session->setFlashdata('success', 'Data Barang berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/product'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/product'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['dataproduct'] = $this->admModel->getdataProduct();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['getidbarang'] = $this->admModel->get_id_barang();
                $data['dataproductTerjual'] = $this->admModel->getdataProductTerjual();
                $data['dataproductSiap'] = $this->admModel->getdataBarangSiapJual();
            }
        } 
        return view('admin/product_view', $data);
    }

    public function edit_barang_siap()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'harga_barang_siap' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Harga Barang harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_barang_siap');
                $data = [
                    'harga_barang'  => $this->request->getVar('harga_barang_siap'),
            
                ];
                if ($this->admModel->updateBarangSiapJual($data, $id)) {
                    $session->setFlashdata('success', 'Data Barang Siap Jual berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/product'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/product'));
                }
            } else {
                $data['validation'] = $this->validator;
                $data['dataproduct'] = $this->admModel->getdataProduct();
                $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                $data['getidbarang'] = $this->admModel->get_id_barang();
                $data['dataproductTerjual'] = $this->admModel->getdataProductTerjual();
                $data['dataproductSiap'] = $this->admModel->getdataBarangSiapJual();
                $data['datamerchant'] = $this->admModel->getdataMerchant();

            }
        } 
        return view('admin/product_view', $data);
    }
    
    public function delete_product()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_barang');
        $succes=$this->admModel->deleteProduct($id);
        if($succes){
            $session->setFlashdata('success', 'Data Barang Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/product'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/product'));
        }
    }

    public function delete_siap()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_barang_siap');
        $succes=$this->admModel->deleteBarangSiapJual($id);
        if($succes){
            $session->setFlashdata('success', 'Data Barang Siap Jual Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/product'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/product'));
        }
    }

    //MENU CUSTOMER
    public function Customer ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datacustomer'] = $this->admModel->getdataCustomer();
        $data['getidcustomer'] = $this->admModel->get_id_customer();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_customer' => [
                'rules' => 'required|is_unique[customer.id_customer]',
                'errors' => [
                'required' => 'Kode Customer harus diisi',
                'is_unique' => 'Kode Customer sudah digunakan',
                ]
            ],
            'nama_customer' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama customer harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nomer telpon harus diisi',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $customerdata = [
                    'id_customer' => $this->request->getVar('id_customer'),
                    'nama_customer' => $this->request->getVar('nama_customer'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),

                ];
                if ($this->admModel->saveCustomer($customerdata)) {
                    $session->setFlashdata('success', 'Data Pelanggan berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/customer'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/customer'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/customer_view', $data);
        
    }

    public function edit_customer()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_customer' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nama customer harus diisi',
                    ]
                ],
                'no_telp' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nomer telpon harus diisi',
                    
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_customer');
                $data = [
                    'nama_customer' => $this->request->getVar('nama_customer'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
            
                ];
                if ($this->admModel->updateCustomer($data, $id)) {
                    $session->setFlashdata('success', 'Data Pelanggan berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/customer'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/customer'));
                     }
                } else {
                    $data['validation'] = $this->validator;
                    $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                    $data['datacustomer'] = $this->admModel->getdataCustomer();
                    $data['getidcustomer'] = $this->admModel->get_id_customer();
                }
            } 
            return view('admin/customer_view', $data);
        }
    
    public function delete_customer()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_customer');
        $succes=$this->admModel->deleteCustomer($id);
        if($succes){
            $session->setFlashdata('success', 'Data Pelanggan Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/customer'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/customer'));
        }
    }


    //MENU EKSPEDISI
    public function Ekspedisi ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
        $data['getidekspedisi'] = $this->admModel->get_id_ekspedisi();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_ekspedisi' => [
                'rules' => 'required|is_unique[ekspedisi.id_ekspedisi]',
                'errors' => [
                'required' => 'Kode Ekspedisi harus diisi',
                'is_unique' => 'Kode Ekspedisi sudah digunakan',
                ]
            ],
            'nama_ekspedisi' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama Ekspedisi harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nomer telpon harus diisi',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $ekspedisidata = [
                    'id_ekspedisi' => $this->request->getVar('id_ekspedisi'),
                    'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
                    'no_telp' => $this->request->getVar('no_telp'),
                ];
                if ($this->admModel->saveEkspedisi($ekspedisidata)) {
                    $session->setFlashdata('success', 'Data Ekspedisi berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/ekspedisi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/ekspedisi'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/ekspedisi_view', $data);
        
    }

    public function edit_ekspedisi()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_ekspedisi' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nama Ekspedisi harus diisi',
                    ]
                ],
                'no_telp' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nomer telpon harus diisi',
                    
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_ekspedisi');
                $data = [
                    'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
                    'no_telp' => $this->request->getVar('no_telp'),
            
                ];
                if ($this->admModel->updateEkspedisi($data, $id)) {
                    $session->setFlashdata('success', 'Data Ekspedisi berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/ekspedisi'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/ekspedisi'));
                     }
                } else {
                    $data['validation'] = $this->validator;
                    $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                    $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
                    $data['getidekspedisi'] = $this->admModel->get_id_ekspedisi();
                }
            } 
            return view('admin/ekspedisi_view', $data);
        }
    
    public function delete_ekspedisi()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_ekspedisi');
        $succes=$this->admModel->deleteEkspedisi($id);
        if($succes){
            $session->setFlashdata('success', 'Data Ekspedisi Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/ekspedisi'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/ekspedisi'));
        }
    }


    //MENU MERCHANT
    public function Merchant ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datamerchant'] = $this->admModel->getdataMerchant();
        $data['getidmerchant'] = $this->admModel->get_id_merchant();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_merchant' => [
                'rules' => 'required|is_unique[merchant.id_merchant]',
                'errors' => [
                'required' => 'Kode Merchant harus diisi',
                'is_unique' => 'Kode Merchant sudah digunakan',
                ]
            ],
            'nama_merchant' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama merchant harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nomer telpon harus diisi',
                
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $merchantdata = [
                    'id_merchant' => $this->request->getVar('id_merchant'),
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'no_telp' => $this->request->getVar('no_telp'),
                ];
                if ($this->admModel->saveMerchant($merchantdata)) {
                    $session->setFlashdata('success', 'Data Merchant berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/merchant'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/merchant'));
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/merchant_view', $data);
        
    }

    public function edit_merchant()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_merchant' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nama Merchant harus diisi',
                    ]
                ],
                'no_telp' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nomer telpon harus diisi',
                    
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_merchant');
                $data = [
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'no_telp' => $this->request->getVar('no_telp'),
            
                ];
                if ($this->admModel->updateMerchant($data, $id)) {
                    $session->setFlashdata('success', 'Data Merchant berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/merchant'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/merchant'));
                     }
                } else {
                    $data['validation'] = $this->validator;
                    $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                    $data['datamerchant'] = $this->admModel->getdataMerchant();
                    $data['getidmerchant'] = $this->admModel->get_id_merchant();
                }
            } 
            return view('admin/merchant_view', $data);
        }
    
    public function delete_merchant()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_merchant');
        $succes=$this->admModel->deleteMerchant($id);
        if($succes){
            $session->setFlashdata('success', 'Data Merchant Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/merchant'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/merchant'));
        }
    }


    //MENU PENJUALAN
    public function Penjualan ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapenjualan'] = $this->admModel->getdataPenjualan();
        $data['datapenjualanall'] = $this->admModel->getdataPenjualanall();
        $data['dataproduct'] = $this->admModel->getdataProduct();
        $data['datamerchant'] = $this->admModel->getdataMerchant();
        $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
        $data['datacustomer'] = $this->admModel->getdataCustomer();
        $data['datahistorypenjualan'] = $this->admModel->getdataHistoryPenjualan();
        $data['datatotalproduk'] = $this->admModel->TotalProduk();
        $data['getidpenjualan'] = $this->admModel->get_id_penjualan();
        $data['selectidpenjualan'] = $this->admModel->union_idpenjualan(); 
        $data['tahunhistory'] = $this->admModel->tampil_tahun_penjualan();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_penjualan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode Penjualan harus diisi',
               
                ]
            ],
            'nama_customer' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama customer harus diisi',
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama barang harus diisi',
                
                ]
            ],
            
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $namacustomer = $this->request->getVar('nama_customer');
                $customerdata = $this->admModel->verifyCustomer($namacustomer);
                $namabarang = $this->request->getVar('nama_barang');
                $barangdata = $this->admModel->verifyBarang($namabarang);
                $namamerchant=$this->request->getVar('nama_merchant');
                $idbarang =$this->request->getVar('nama_barang');
                $idmerchant =$this->request->getVar('nama_merchant');
                $databarangsiap=$this->admModel->verifyBarangSiap($idmerchant,$idbarang);
                $penjualandata = [
                    'id_penjualan' => $this->request->getVar('id_penjualan'),
                    'nama_customer' => $this->request->getVar('nama_customer'),
                    'alamat' => $customerdata['alamat'],
                    'no_telp' => $customerdata['no_telp'],
                    'nama_barang' => $this->request->getVar('nama_barang'),
                    'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
                    'harga_ongkir' => $this->request->getVar('harga_ongkir'),
                    'total_harga' => $this->request->getVar('jmlh_barang')*$databarangsiap['harga_barang'],
                ];
                if ($databarangsiap['nama_barang']==$namabarang && $databarangsiap['merchant']==$namamerchant) {
                    
                
                if ($this->request->getVar('jmlh_barang')>$databarangsiap['jmlh_barang']){
                    $session->setFlashdata('error', 'jumlah barang tidak boleh lebih dari stok barang siap jual', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                } else {
                $this->admModel->savePenjualan($penjualandata);
                    $session->setFlashdata('success', 'Data Penjualan berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                }
                    
                }else{
                    $session->setFlashdata('error', 'Barang yang di cari tidak ada di stok barang siap jual', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                    }
                }
                else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                }
            
            }else {
                $data['validation'] = $this->validator;
            }
        
        return view('admin/penjualan_view', $data);
        
    }

    public function tambah_barang ()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['datapenjualan'] = $this->admModel->getdataPenjualan();
        $data['datapenjualanall'] = $this->admModel->getdataPenjualanall();
        $data['dataproduct'] = $this->admModel->getdataProduct();
        $data['datamerchant'] = $this->admModel->getdataMerchant();
        $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
        $data['datacustomer'] = $this->admModel->getdataCustomer();
        $data['datahistorypenjualan'] = $this->admModel->getdataHistoryPenjualan();
        $data['datatotalproduk'] = $this->admModel->TotalProduk();
        $data['getidpenjualan'] = $this->admModel->get_id_penjualan();
        $data['selectidpenjualan'] = $this->admModel->union_idpenjualan(); 
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_penjualan' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode Penjualan harus diisi',
               
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama barang harus diisi',
                
                ]
            ],
            
            ];
            if ($this->validate($rules)) {
                date_default_timezone_set('Asia/Jakarta');
                $namabarang = $this->request->getVar('nama_barang');
                $barangdata = $this->admModel->verifyBarang($namabarang);
                $idbarang =$this->request->getVar('nama_barang');
                $idmerchant =$this->request->getVar('nama_merchant');
                $databarangsiap=$this->admModel->verifyBarangSiap($idmerchant,$idbarang);
                $namamerchant=$this->request->getVar('nama_merchant');
                $namabarang = $this->request->getVar('nama_barang');
                $idpenj = $this->request->getVar('id_penjualan');
                $dataresi = $this->admModel->verifyDataPenjualan($idpenj);
                $penjualandata = [
                    'id_penjualan' => $this->request->getVar('id_penjualan'),
                    'nama_barang' => $this->request->getVar('nama_barang'),
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                    'total_harga' => $this->request->getVar('jmlh_barang')*$databarangsiap['harga_barang'],
                ];
                if ($dataresi['no_resi'] !== '' ) {
                    $session->setFlashdata('error', 'Data resi sudah dimasukan tidak dapat menambah barang', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                    }
                    else{
                
                    if ($databarangsiap['nama_barang']==$namabarang && $databarangsiap['merchant']==$namamerchant) {

                
                        if ($this->request->getVar('jmlh_barang')>$databarangsiap['jmlh_barang']){
                        $session->setFlashdata('error', 'Jumlah barang tidak boleh lebih dari stok barang siap jual', 3);
                        return redirect()->to(base_url('admin/penjualan'));
                        } else {
                        $this->admModel->savePenjualan($penjualandata); 
                        $session->setFlashdata('success', 'Data Penjualan berhasil diupdate', 3);
                        return redirect()->to(base_url('admin/penjualan'));
                        }
                        
                    }else{
                    $session->setFlashdata('error', 'Barang yang di cari tidak ada di stok barang siap jual', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                    }
                }
                    
                }else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                }
            
        }else {
                $data['validation'] = $this->validator;
            
        }
        return view('admin/penjualan_view', $data);
        
    }

    public function insert_resi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'no_resi' => [
                    'rules' => 'required',
                    'errors' => [
                    'required' => 'Nomor resi harus diisi',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $id = $this->request->getVar('id_penjualan');
                $data = [
                    'no_resi' => $this->request->getVar('no_resi'),
                    'tgl_kirim' => date('Y-m-d'),
                ];
                if ($this->admModel->updateResi($data, $id)) {
                    $session->setFlashdata('success', 'Nomor Resi berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                     }
                } else {
                    $data['validation'] = $this->validator;
                    $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
                    $data['datapenjualan'] = $this->admModel->getdataPenjualan();
                    $data['dataproduct'] = $this->admModel->getdataProduct();
                    $data['datamerchant'] = $this->admModel->getdataMerchant();
                    $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
                    $data['datacustomer'] = $this->admModel->getdataCustomer();
                    $data['datahistorypenjualan'] = $this->admModel->getdataHistoryPenjualan();
                }
            } 
            return view('admin/penjualan_view', $data);
        }

    public function update_history_penjualan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $idpenjualan= $this->request->getVar('id_penjualan');
        $namabarangdata = $this->admModel->verifyNamaBarang($idpenjualan);
        $idjmlhpenjualan= $this->request->getVar('id_penjualan');
        $jmlhpenjualandata = $this->admModel->verifyJumlah($idjmlhpenjualan);
        $idhargapenjualan= $this->request->getVar('id_penjualan');
        $hargapenjualandata = $this->admModel->verifyHarga($idhargapenjualan);
        $idmerchant= $this->request->getVar('id_penjualan');
        $merchantdata = $this->admModel->verifyNamaMerchant($idmerchant);
        $idongkir= $this->request->getVar('id_penjualan');
        $ongkirdata = $this->admModel->verifyOngkir($idongkir);
        $upload = $this->request->getFile('file_upload');
        $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-penjualan');
        $historypenjualandata = [
            'id_penjualan' => $this->request->getVar('id_penjualan'),
            'nama_customer' => $this->request->getVar('nama_customer'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'nama_barang' => $namabarangdata['nama_barang'],
            'jmlh_barang' => $jmlhpenjualandata['jmlh_barang'],
            'nama_merchant' => $merchantdata['nama_merchant'],
            'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
            'no_resi' => $this->request->getVar('no_resi'),
            'tgl_kirim' => $this->request->getVar('tgl_kirim'),
            'harga_ongkir' => $this->request->getVar('harga_ongkir'),
            'tgl_penjualan' => date('Y-m-d'),
            'sub_total'=> $hargapenjualandata['total_harga'],
            'total_harga' => $hargapenjualandata['total_harga']+$ongkirdata['harga_ongkir'],
            'bukti_bayar' => $upload->getName(),
            'status' => 'Terjual',
            
        ];
        // $idnama= $this->request->getVar('id_penjualan');
        $idnama=$this->request->getVar('id_penjualan');
        $namadata = $this->admModel->verifynama($idnama);
        
        foreach( $namadata as $row ) {
        $idmerchant= $row['nama_merchant'];
        $idbarang= $row['nama_barang'];
        $barangdata = $this->admModel->verifyBarangSiap($idmerchant,$idbarang);
      
        
        $databarangterjual[]= array(
            'id_penjualan' => $row['id_penjualan'],
            'tgl_penjualan' => date('Y-m-d'),
            'nama_barang' => $row['nama_barang'],
            'nama_merchant' =>$row['nama_merchant'],
            'jmlh_barang' => $row['jmlh_barang'],
            'stock_barang' => $barangdata['jmlh_barang'],
            'sisa_stock' => $barangdata['jmlh_barang']-$row['jmlh_barang'],
        ); }
    
        $this->admModel->BarangTerjual($databarangterjual);

        $id=$this->request->getVar('id_penjualan');
        $data = [
            'click' => '1'
        ];
        $this->admModel->updateClickPenjualan($data, $id);


        
        // $jurnaldata1=[
        //  'id'   => $this->request->getVar('id_penjualan'),
        //  'tanggal' => date('Y-m-d'),
        //  'kode_akun' => '111',
        //  'debet'   => $this->request->getVar('total_harga'),
        //  'kredit' => '0'
        // ]; 
        // $jurnaldata2=[
        //  'id'   => $this->request->getVar('id_penjualan'),
        //  'tanggal' => date('Y-m-d'),
        //  'kode_akun' => '411-1',
        //  'debet'   => '0',
        //  'kredit' => $this->request->getVar('total_harga'),
        // ]; 
        // $this->lapModel->insertjurnal($jurnaldata1);
        // $this->lapModel->insertjurnal($jurnaldata2);
        $succes = $this->admModel->historyPenjualan($historypenjualandata);
        if($succes){
            $session->setFlashdata('success', 'Data pembayaran berhasil terupdate ke history', 3);
            return redirect()->to(base_url('admin/penjualan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/penjualan'));
        }
    }

    public function update_retur()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $idpenjualan= $this->request->getVar('id_penjualan');
        $namabarangdata = $this->admModel->verifyNamaBarang($idpenjualan);
        $idjmlhpenjualan= $this->request->getVar('id_penjualan');
        $jmlhpenjualandata = $this->admModel->verifyJumlah($idjmlhpenjualan);
        $idhargapenjualan= $this->request->getVar('id_penjualan');
        $hargapenjualandata = $this->admModel->verifyHarga($idhargapenjualan);
        $idmerchant= $this->request->getVar('id_penjualan');
        $merchantdata = $this->admModel->verifyNamaMerchant($idmerchant);
        $idongkir= $this->request->getVar('id_penjualan');
        $ongkirdata = $this->admModel->verifyOngkir($idongkir);
        $upload = $this->request->getFile('file_upload');
        $upload->move(ROOTPATH.'template/assets/img/bukti-bayar-penjualan');
        $historypenjualandata = [
            'id_penjualan' => $this->request->getVar('id_penjualan'),
            'nama_customer' => $this->request->getVar('nama_customer'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'nama_barang' => $namabarangdata['nama_barang'],
            'jmlh_barang' => $jmlhpenjualandata['jmlh_barang'],
            'nama_merchant' => $merchantdata['nama_merchant'],
            'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
            'no_resi' => $this->request->getVar('no_resi'),
            'tgl_retur' => date('Y-m-d'),
            'harga_ongkir' => $this->request->getVar('harga_ongkir'),
            'tgl_kirim' => $this->request->getVar('tgl_kirim'),
            'sub_total'=> $hargapenjualandata['total_harga'],
            'total_harga' => $hargapenjualandata['total_harga']+$ongkirdata['harga_ongkir'],
            'bukti_bayar' => $upload->getName(),
            'status' => 'Retur'
            
        ];
        // $idnama= $this->request->getVar('id_penjualan');

        $id=$this->request->getVar('id_penjualan');
        $data = [
            'click' => '1'
        ];
        $this->admModel->updateClickPenjualan($data, $id);
        // $jurnaldata1=[
        //  'id'   => $this->request->getVar('id_penjualan'),
        //  'tanggal' => date('Y-m-d'),
        //  'kode_akun' => '111',
        //  'debet'   => $this->request->getVar('total_harga'),
        //  'kredit' => '0'
        // ]; 
        // $jurnaldata2=[
        //  'id'   => $this->request->getVar('id_penjualan'),
        //  'tanggal' => date('Y-m-d'),
        //  'kode_akun' => '411-1',
        //  'debet'   => '0',
        //  'kredit' => $this->request->getVar('total_harga'),
        // ]; 
        // $this->lapModel->insertjurnal($jurnaldata1);
        // $this->lapModel->insertjurnal($jurnaldata2);
        $succes = $this->admModel->historyPenjualan($historypenjualandata);
        if($succes){
            $session->setFlashdata('success', 'Data pembayaran berhasil terupdate ke history', 3);
            return redirect()->to(base_url('admin/penjualan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/penjualan'));
        }
    }

    public function delete_history_penjualan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        $id = $this->request->getVar('id_history');
        $succes=$this->admModel->deleteHistoryPenjualan($id);
        if($succes){
            $session->setFlashdata('success', 'Data History Pembayaran Berhasil Dihapus', 3);
            return redirect()->to(base_url('admin/penjualan'));
        } else {
            $session->setFlashdata('error', 'Maaf gagal menghapus silahkan coba lagi', 3);
            return redirect()->to(base_url('admin/penjualan'));
        }
    }

    public function jurnal_penjualan()
    {
        $data = [];
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $bln= $this->request->getVar('bln_jurnal');
        $thn= $this->request->getVar('thn_history');
        $totalpenjualan=$this->admModel->SumPenjualan($bln,$thn);
        $totalretur=$this->admModel->SumRetur($bln,$thn);

        $jurnaldata1=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => $totalpenjualan['total_harga'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_produksi($jurnaldata1);
        
        $jurnaldata2=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411',
            'debet'   => '0',
            'kredit' => $totalpenjualan['total_harga']
           ]; 
            
        $this->lapModel->insertjurnal_produksi($jurnaldata2);

        $jurnaldata3=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => $totalpenjualan['total_harga'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_penerimaan($jurnaldata3);
        
        $jurnaldata4=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411',
            'debet'   => '0',
            'kredit' => $totalpenjualan['total_harga']
           ]; 
            
        $this->lapModel->insertjurnal_penerimaan($jurnaldata4);

        $jurnaldata5=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '111',
            'debet'   => $totalpenjualan['total_harga'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_keuangan($jurnaldata5);
        
        $jurnaldata6=[
            'id'   => 'PENJ1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411',
            'debet'   => '0',
            'kredit' => $totalpenjualan['total_harga']
           ]; 
            
        $this->lapModel->insertjurnal_keuangan($jurnaldata6);
        
        $jurnaldata7=[
            'id'   => 'RET1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '411-2',
            'debet'   => $totalretur['total_harga'],
            'kredit' => '0'
           ]; 
            
        $this->lapModel->insertjurnal_keuangan($jurnaldata7);
        
        $jurnaldata8=[
            'id'   => 'RET1',
            'tanggal' => date('Y-m-d'),
            'kode_akun' => '113',
            'debet'   => '0',
            'kredit' => $totalretur['total_harga']
           ]; 
            
        $succes= $this->lapModel->insertjurnal_keuangan($jurnaldata8);

        
            
        
        if($succes){
            $session->setFlashdata('success', 'Data Jurnal berhasil terupdate', 3);
            return redirect()->to(base_url('admin/penjualan'));
        } else {
            $session->setFlashdata('error', 'Maaf Data Bulan dan Tahun tidak ada di history silahkan cek lagi', 3);
            return redirect()->to(base_url('admin/penjualan'));
        }
    }
}