<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_dashboard;

class Dashboard extends Controller
{
    public $dModel;
    public function __construct()
    {
        $this->dModel = new M_dashboard();
        helper('form');
    }
    public function dashboard_keuangan()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/keuangan/dashboard_keuangan_view', $data);
    }

    public function dashboard_produksi()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/produksi/dashboard_produksi_view', $data);
    }

    public function dashboard_admin()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/admin/dashboard_admin_view', $data);
    }

    public function dashboard_manajemenkas()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/manajemenkas/dashboard_manajemenkas_view', $data);
    }

    public function dashboard_gudang()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/gudang/dashboard_gudang_view', $data);
    }
    public function dashboard_pembelian()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('/pembelian/dashboard_pembelian_view', $data);
    }

    public function logout()
    {
        
        if (session()->has('logged_user')) {
            $la_id = session()->get('logged_user');
            date_default_timezone_set('Asia/Jakarta');
            $this->dModel->updateLogoutTime($la_id);
        }

        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to(base_url() . "/login");
    }
    public function login_activity()
    {
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $data['login_info'] = $this->dModel->getLoginUserInfo(session()->get('logged_user'));
        return view('login_activity_view', $data);
    }
}