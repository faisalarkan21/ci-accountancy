<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_laporan extends Model {

    
    //LAPORAN ROLE PRODUKSI
    public function jurnal_umum_produksi($bulan,$tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal_produksi as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE MONTHNAME(j.tanggal) = '$bulan' AND YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}

    public function tampil_bulan_jurnal_produksi(){
        $query = $this->db->query("SELECT MONTHNAME(tanggal) as bulan FROM jurnal_produksi GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_jurnal_produksi(){
        $query = $this->db->query("SELECT YEAR(tanggal) as tahun FROM jurnal_produksi GROUP BY tahun");
        return $query->getResult();
    
    }

    public function tampil_akhir_bulan_jurnal_produksi($gettgl){
        $query = $this->db->query("SELECT LAST_DAY(tanggal) as akhirbln FROM jurnal_produksi where MONTHNAME(tanggal) = '$gettgl' LIMIT 1");
        return $query->getResult();
    }

    public function insertjurnal_produksi($data)
    {
        $builder = $this->db->table('jurnal_produksi');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function buku_besar_produksi($data)
    {
        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $coa = $data['coa'];

        $query = $this->db->query("SELECT j.tanggal, MONTHNAME(j.tanggal) as bulan, YEAR(j.tanggal) as tahun, k.nama_akun as nama_akun, k.kode_akun as kode_akun, j.id as id, j.debet as debet, j.kredit as kredit
        FROM jurnal_produksi as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun
        WHERE MONTHNAME(j.tanggal) = ? AND YEAR(j.tanggal) = ? AND k.nama_akun = ?", array($bulan, $tahun, $coa));
        return $query->getResult();
	}

    public function show_listCoa(){
        $query = $this->db->query('SELECT * FROM coa');
        return $query->getResult();
    }

    


    public function perubahan_modal($tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}


    // LAPORAN ROLE MANKAS
    public function jurnal_umum_mankas($bulan,$tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal_mankas as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE MONTHNAME(j.tanggal) = '$bulan' AND YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}

    public function tampil_bulan_jurnal_mankas(){
        $query = $this->db->query("SELECT MONTHNAME(tanggal) as bulan FROM jurnal_mankas GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_jurnal_mankas(){
        $query = $this->db->query("SELECT YEAR(tanggal) as tahun FROM jurnal_mankas GROUP BY tahun");
        return $query->getResult();
    
    }

    public function tampil_akhir_bulan_jurnal_mankas($gettgl){
        $query = $this->db->query("SELECT LAST_DAY(tanggal) as akhirbln FROM jurnal_mankas where MONTHNAME(tanggal) = '$gettgl' LIMIT 1");
        return $query->getResult();
    }

    public function insertjurnal_mankas($data)
    {
        $builder = $this->db->table('jurnal_mankas');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function buku_besar_mankas($data)
    {
        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $coa = $data['coa'];

        $query = $this->db->query("SELECT j.tanggal, MONTHNAME(j.tanggal) as bulan, YEAR(j.tanggal) as tahun, k.nama_akun as nama_akun, k.kode_akun as kode_akun, j.id, j.debet as debet, j.kredit as kredit
        FROM jurnal_mankas as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun
        WHERE MONTHNAME(j.tanggal) = ? AND YEAR(j.tanggal) = ? AND k.nama_akun = ?", array($bulan, $tahun, $coa));
        return $query->getResult();
	}

    // LAPORAN ROLE PEMBELIAN
    public function insertjurnal_pembelian($data)
    {
        $builder = $this->db->table('jurnal_pembelian');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function jurnal_umum_pembelian($bulan,$tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal_pembelian as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE MONTHNAME(j.tanggal) = '$bulan' AND YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}

    public function tampil_bulan_jurnal_pembelian(){
        $query = $this->db->query("SELECT MONTHNAME(tanggal) as bulan FROM jurnal_pembelian GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_jurnal_pembelian(){
        $query = $this->db->query("SELECT YEAR(tanggal) as tahun FROM jurnal_pembelian GROUP BY tahun");
        return $query->getResult();
    
    }

    public function tampil_akhir_bulan_jurnal_pembelian($gettgl){
        $query = $this->db->query("SELECT LAST_DAY(tanggal) as akhirbln FROM jurnal_pembelian where MONTHNAME(tanggal) = '$gettgl' LIMIT 1");
        return $query->getResult();
    }

    public function tampil_tahun_pembelian(){
        $query = $this->db->query("SELECT YEAR(tgl_pembelian) as tahun FROM pembelian_gudang GROUP BY tahun");
        return $query->getResult();
    
    }

    public function tampil_bulan_pembelian(){
        $query = $this->db->query("SELECT MONTHNAME(tgl_pembelian) as bulan FROM pembelian_gudang GROUP BY bulan");
        return $query->getResult();
    
    }

    public function Selectpembelian($bulan,$tahun){
		$builder =$this->db->table('pembelian_gudang');
		$builder->select('*');
		$builder->where("DATE_FORMAT(tgl_pembelian,'%M')", $bulan);
		$builder->where("DATE_FORMAT(tgl_pembelian,'%Y')", $tahun);
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}

    public function buku_besar_pembelian($data)
    {
        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $coa = $data['coa'];

        $query = $this->db->query("SELECT j.tanggal, MONTHNAME(j.tanggal) as bulan, YEAR(j.tanggal) as tahun, k.nama_akun as nama_akun, k.kode_akun as kode_akun, j.id, j.debet as debet, j.kredit as kredit
        FROM jurnal_pembelian as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun
        WHERE MONTHNAME(j.tanggal) = ? AND YEAR(j.tanggal) = ? AND k.nama_akun = ?", array($bulan, $tahun, $coa));
        return $query->getResult();
	}

    //ROLE KEUANGAN
    public function insertjurnal_keuangan($data)
    {
        $builder = $this->db->table('jurnal_keuangan');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function jurnal_umum_keuangan($bulan,$tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal_keuangan as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE MONTHNAME(j.tanggal) = '$bulan' AND YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}

    public function tampil_bulan_jurnal_keuangan(){
        $query = $this->db->query("SELECT MONTHNAME(tanggal) as bulan FROM jurnal_keuangan GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_jurnal_keuangan(){
        $query = $this->db->query("SELECT YEAR(tanggal) as tahun FROM jurnal_keuangan GROUP BY tahun");
        return $query->getResult();
    
    }

    //ROLE ADMIN

    public function jurnal_penerimaan_kas($bulan,$tahun){
        $query = $this->db->query("SELECT j.tanggal, k.nama_akun, k.kode_akun, j.id, j.debet, j.kredit
        FROM jurnal_penerimaan as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun WHERE MONTHNAME(j.tanggal) = '$bulan' AND YEAR(J.tanggal)= '$tahun' ORDER BY id_jurnal ");
        return $query->getResult();
	}

    public function tampil_bulan_jurnal_penerimaan_kas(){
        $query = $this->db->query("SELECT MONTHNAME(tanggal) as bulan FROM jurnal_penerimaan GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_jurnal_penerimaan_kas(){
        $query = $this->db->query("SELECT YEAR(tanggal) as tahun FROM jurnal_penerimaan GROUP BY tahun");
        return $query->getResult();
    
    }

    public function insertjurnal_penerimaan($data)
    {
        $builder = $this->db->table('jurnal_penerimaan');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function lap_penjualan($bulan,$tahun){
        $query = $this->db->query("SELECT * FROM history_penjualan WHERE MONTHNAME(tgl_penjualan)= '$bulan' AND YEAR(tgl_penjualan)= '$tahun' OR MONTHNAME(tgl_retur)= '$bulan' AND YEAR(tgl_retur)= '$tahun' ORDER BY id ");
        return $query->getResult();
	}

    public function tampil_bulan_lap_penjualan(){
        $query = $this->db->query("SELECT MONTHNAME(tgl_penjualan) as bulan FROM history_penjualan GROUP BY bulan");
        return $query->getResult();
    }

    public function tampil_tahun_lap_penjualan(){
        $query = $this->db->query("SELECT YEAR(tgl_penjualan) as tahun FROM history_penjualan GROUP BY tahun");
        return $query->getResult();
    
    }

    public function buku_besar_keuangan($data)
    {
        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $coa = $data['coa'];

        $query = $this->db->query("SELECT j.tanggal, MONTHNAME(j.tanggal) as bulan, YEAR(j.tanggal) as tahun, k.nama_akun as nama_akun, k.kode_akun as kode_akun, j.id, j.debet as debet, j.kredit as kredit
        FROM jurnal_keuangan as j
        INNER JOIN coa as k ON j.kode_akun = k.kode_akun
        WHERE MONTHNAME(j.tanggal) = ? AND YEAR(j.tanggal) = ? AND k.nama_akun = ?", array($bulan, $tahun, $coa));
        return $query->getResult();
	}
    
}