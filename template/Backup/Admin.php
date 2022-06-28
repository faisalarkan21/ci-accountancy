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
        $data['datatotalbarang'] = $this->admModel->TotalBarang();
        $data['datatotalbarangterjual'] = $this->admModel->TotalBarangTerjual();
        $data['getidbarang'] = $this->admModel->get_id_barang();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_barang' => [
                'rules' => 'required|is_unique[barang.id_barang]',
                'errors' => [
                'required' => 'Kode barang harus diisi',
                'is_unique' => 'Kode barang sudah digunakan',
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama aset harus diisi',
                ]
            ],
            'jmlh_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                'required' => 'Jumlah aset harus diisi',
                'numeric'=>'Harus berupa angka'
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $productdata = [
                    'id_barang' => $this->request->getVar('id_barang'),
                    'nama_barang' => $this->request->getVar('nama_barang'),
                    'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                    'harga_barang' => $this->request->getVar('harga_barang'),
                ];
                if ($this->admModel->saveProduct($productdata)) {
                    $session->setFlashdata('success', 'Data Barang berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/product'));
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
            'jmlh_barang' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jumlah barang harus diisi',
                ]
            ],
            ];
            if ($this->validate($rules)) {
                $namabarang= $this->request->getVar('nama_barang');
                $barangdata = $this->admModel->verifyBarang($namabarang);
                $id = $this->request->getVar('id_barang');
                $data = [
                    'jmlh_barang'  => $barangdata['jmlh_barang']+ $this->request->getVar('jmlh_barang'),
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
        $data['dataproduct'] = $this->admModel->getdataProduct();
        $data['datamerchant'] = $this->admModel->getdataMerchant();
        $data['dataekspedisi'] = $this->admModel->getdataEkspedisi();
        $data['datacustomer'] = $this->admModel->getdataCustomer();
        $data['datahistorypenjualan'] = $this->admModel->getdataHistoryPenjualan();
        $data['datatotalproduk'] = $this->admModel->TotalProduk();
        $data['getidpenjualan'] = $this->admModel->get_id_penjualan();
        
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
            'id_penjualan' => [
                'rules' => 'required|is_unique[penjualan.id_penjualan]',
                'errors' => [
                'required' => 'Kode Penjualan harus diisi',
                'is_unique' => 'Kode Penjualan sudah digunakan',
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
                $penjualandata = [
                    'id_penjualan' => $this->request->getVar('id_penjualan'),
                    'nama_customer' => $this->request->getVar('nama_customer'),
                    'alamat' => $customerdata['alamat'],
                    'no_telp' => $customerdata['no_telp'],
                    'nama_barang' => $this->request->getVar('nama_barang'),
                    'jmlh_barang' => $this->request->getVar('jmlh_barang'),
                    'nama_merchant' => $this->request->getVar('nama_merchant'),
                    'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
                    'tgl_retur' => date('Y-m-d'),
                    'total_harga' => $this->request->getVar('jmlh_barang')*$barangdata['harga_barang'],
                ];
                if ($this->request->getVar('jmlh_barang')>$barangdata['jmlh_barang']){
                    $session->setFlashdata('error', 'jumlah barang tidak boleh lebih dari stok', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                } else {
                if ($this->admModel->savePenjualan($penjualandata)) {
                    $session->setFlashdata('success', 'Data Penjualan berhasil diupdate', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(base_url('admin/penjualan'));
                }
            } 
        }else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/penjualan_view', $data);
        
    }

    public function insert_resi()
    {
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
        $historypenjualandata = [
            'id_penjualan' => $this->request->getVar('id_penjualan'),
            'nama_customer' => $this->request->getVar('nama_customer'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jmlh_barang' => $this->request->getVar('jmlh_barang'),
            'nama_merchant' => $this->request->getVar('nama_merchant'),
            'nama_ekspedisi' => $this->request->getVar('nama_ekspedisi'),
            'no_resi' => $this->request->getVar('no_resi'),
            'tgl_retur' => $this->request->getVar('tgl_retur'),
            'tgl_penjualan' => date('Y-m-d'),
            'total_harga' => $this->request->getVar('total_harga'),
        ];
        $namabarang= $this->request->getVar('nama_barang');
        $barangdata = $this->admModel->verifyBarang($namabarang);
        $databarangterjual = [
            
            'id_penjualan' => $this->request->getVar('id_penjualan'),
            'tgl_penjualan' => date('Y-m-d'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jmlh_barang' => $this->request->getVar('jmlh_barang'),
            'stock_barang' => $barangdata['jmlh_barang'],
            'sisa_stock' => $barangdata['jmlh_barang']-$this->request->getVar('jmlh_barang'),
        ];
        $this->admModel->BarangTerjual($databarangterjual);
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
}