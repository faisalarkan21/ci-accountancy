<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;
use App\Models\M_laporan;
use App\Models\M_produksi;

class Laporan extends Controller
{
    public $session;
    public $dModel;
    public $lapModel;
    public $proModel;

    public function __construct()
    {
        helper(['form','array','tgl_indo']);
        $this->dModel = new M_dashboard();
        $this->lapModel = new M_laporan();
        $this->proModel = new M_produksi();
        
    }

    //LAPORAN ROLE PRODUKSI
    public function jurnal_umum_produksi ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_produksi($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_produksi();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_produksi();
        $gettgl = $this->request->getVar('akhirbulan');
        $data['akhirbln'] = $this->lapModel->tampil_akhir_bulan_jurnal_produksi($gettgl);
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/jurnal_umum_produksi_view',$data);
    }

    
    public function buku_besar_produksi()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $coa = $_POST['coa'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'coa' => $coa
            ];
            $data['buku_besar'] = $this->lapModel->buku_besar_produksi($data);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_produksi();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_produksi();
        $data['coa'] = $this->lapModel->show_listCoa();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/buku_besar_produksi_view',$data);
    }

    public function laporan_hpp_produksi ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_produksi($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_produksi();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_produksi();
        $gettgl = $this->request->getVar('akhirbulan');
        $data['akhirbln'] = $this->lapModel->tampil_akhir_bulan_jurnal_produksi($gettgl);
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/laporan_hpp_produksi_view',$data);
    }

    public function laporan_laba_rugi ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_produksi($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_produksi();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_produksi();
        $gettgl = $this->request->getVar('akhirbulan');
        $data['akhirbln'] = $this->lapModel->tampil_akhir_bulan_jurnal_produksi($gettgl);
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/lap_laba_rugi_view',$data);
    }


    //LAPORAN ROLE ADMIN

    public function jurnal_penerimaan_kas ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_penerimaan_kas($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_penerimaan_kas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_penerimaan_kas();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/penerimaan_kas_view',$data);
    }

    public function laporan_penjualan ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['laporanpenjualan'] = $this->lapModel->lap_penjualan($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_lap_penjualan();
        $data['tahun'] = $this->lapModel->tampil_tahun_lap_penjualan();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/laporan_penjualan_view',$data);
    }

    

    //LAPORAN ROLE MANKAS
    
    public function jurnal_umum_mankas ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_mankas($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_mankas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_mankas();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/jurnal_umum_mankas_view',$data);
    }

    public function laporan_perubahan_modal ()
    {
        if(isset($_POST['submit'])){
            
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_mankas($bulan,$tahun);
            $data['jurnal2'] = $this->lapModel->jurnal_umum_produksi($bulan,$tahun);
            $data['jurnal3'] = $this->lapModel->jurnal_umum_keuangan($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_mankas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_mankas();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/perubahan_modal_view',$data);
    }

    public function laporan_neraca ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_mankas($bulan,$tahun);
            $data['jurnal2'] = $this->lapModel->jurnal_umum_pembelian($bulan,$tahun);
            $data['jurnal3'] = $this->lapModel->jurnal_umum_produksi($bulan,$tahun);
            $data['jurnal4'] = $this->lapModel->jurnal_umum_keuangan($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_mankas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_mankas();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/neraca_view',$data);
    }

    public function buku_besar_mankas()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $coa = $_POST['coa'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'coa' => $coa
            ];
            $data['buku_besar'] = $this->lapModel->buku_besar_mankas($data);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_mankas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_mankas();
        $data['coa'] = $this->lapModel->show_listCoa();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/buku_besar_mankas_view',$data);
    }

    public function laporan_pengeluaran_kas ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_mankas($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_mankas();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_mankas();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/pengeluaran_kas_view',$data);
    }

    //LAPORAN ROLE PEMBELIAN
    
    public function jurnal_umum_pembelian ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_pembelian($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_pembelian();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_pembelian();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/jurnal_umum_pemb_view',$data);
    }

    public function laporan_pembelian ()
    {
        if(isset($_POST['submit'])){
            
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->Selectpembelian($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_pembelian();
        $data['tahun'] = $this->lapModel->tampil_tahun_pembelian();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/laporan_pembelian_view',$data);
    }

    public function buku_besar_pembelian()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $coa = $_POST['coa'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'coa' => $coa
            ];
            $data['buku_besar'] = $this->lapModel->buku_besar_pembelian($data);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_pembelian();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_pembelian();
        $data['coa'] = $this->lapModel->show_listCoa();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/buku_besar_pembelian_view',$data);
    }

    //LAPORAN ROLE KEUANGAN
    public function jurnal_umum_keuangan ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_keuangan($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_keuangan();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_keuangan();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/jurnal_umum_keuangan_view',$data);
    }

    public function buku_besar_keuangan()
    {
        if(isset($_POST['submit'])){
            
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $coa = $_POST['coa'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'coa' => $coa
            ];
            $data['buku_besar'] = $this->lapModel->buku_besar_keuangan($data);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_keuangan();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_keuangan();
        $data['coa'] = $this->lapModel->show_listCoa();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/buku_besar_keuangan_view',$data);
    }

    public function laporan_arus_kas ()
    {
        if(isset($_POST['submit'])){
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $data['jurnal'] = $this->lapModel->jurnal_umum_keuangan($bulan,$tahun);
        }
        $data['bulan'] = $this->lapModel->tampil_bulan_jurnal_keuangan();
        $data['tahun'] = $this->lapModel->tampil_tahun_jurnal_keuangan();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        return view('laporan/arus_kas_view',$data);
    }
    

}