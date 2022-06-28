<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_admin extends Model {


    //MENU PRODUCT
    public function getdataProduct()
    {
        return $this->db->table('barang')->get()->getResultArray();
    }

    public function getdataBarangSiapJual()
    {
        return $this->db->table('barang_siap_jual')->get()->getResultArray();
    }

    public function getdataProductTerjual()
    {
        return $this->db->table('barang_terjual')->get()->getResultArray();
    }

    public function saveProduct($data)
    {
        $builder = $this->db->table('barang');
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
    public function updateProduct($data, $id)
    {
        $query = $this->db->table('barang')->update($data, array('id_barang' => $id));
        return $query;
    }

    public function updatedaftarbarang($data, $id)
    {
        $query = $this->db->table('barang')->update($data, array('nama_barang' => $id));
        return $query;
    }

    public function deleteProduct($id)
    {
        $query = $this->db->table('barang')->delete(array('id_barang' => $id));
        return $query;
    }

    public function saveBarangSiapJual($data)
    {
        $builder = $this->db->table('barang_siap_jual');
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
    public function updateBarangSiapJual($data, $id)
    {
        $query = $this->db->table('barang_siap_jual')->update($data, array('id_barang_siap' => $id));
        return $query;
    }

    public function deleteBarangSiapJual($id)
    {
        $query = $this->db->table('barang_siap_jual')->delete(array('id_barang_siap' => $id));
        return $query;
    }

    public function TotalBarang()
    {
		$builder =$this->db->table('barang');
		$builder->selectSum('jmlh_barang');
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }

    public function TotalBarangTerjual()
    {
		$builder =$this->db->table('barang_terjual');
		$builder->selectSum('jmlh_barang');
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }

    public function get_id_barang()
    {
        $kode= $this->db->table('barang')
        ->select('RIGHT(id_barang,3)as max_id', false)
        ->orderby('id_barang','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "BRG";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function get_id_barang_siap()
    {
        $kode= $this->db->table('barang_siap_jual')
        ->select('RIGHT(id_barang_siap,3)as max_id', false)
        ->orderby('id_barang_siap','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "BSJ";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function verifyBarangSiap($idmerchant,$idbarang){
		$builder =$this->db->table('barang_siap_jual');
		$builder->select('*');
        $builder->where('merchant',$idmerchant);
        $builder->where('nama_barang',$idbarang);
        $result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
		
	}

    public function verifyMerchant($idmerchant){
		$builder =$this->db->table('merchant');
		$builder->select('*');
		$builder->where('nama_merchant',$idmerchant);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}


    //MENU CUSTOMER 
    public function getdataCustomer()
    {
        return $this->db->table('customer')->get()->getResultArray();
    }

    public function saveCustomer($data)
    {
        $builder = $this->db->table('customer');
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
    public function updateCustomer($data, $id)
    {
        $query = $this->db->table('customer')->update($data, array('id_customer' => $id));
        return $query;
    }

    public function deleteCustomer($id)
    {
        $query = $this->db->table('customer')->delete(array('id_customer' => $id));
        return $query;
    }

    public function get_id_customer()
    {
        $kode= $this->db->table('customer')
        ->select('RIGHT(id_customer,3)as max_id', false)
        ->orderby('id_customer','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PLG";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
    
    //MENU Ekspedisi
    public function getdataEkspedisi()
    {
        return $this->db->table('ekspedisi')->get()->getResultArray();
    }

    public function saveEkspedisi($data)
    {
        $builder = $this->db->table('ekspedisi');
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
    public function updateEkspedisi($data, $id)
    {
        $query = $this->db->table('ekspedisi')->update($data, array('id_ekspedisi' => $id));
        return $query;
    }

    public function deleteEkspedisi($id)
    {
        $query = $this->db->table('ekspedisi')->delete(array('id_ekspedisi' => $id));
        return $query;
    }

    public function get_id_ekspedisi()
    {
        $kode= $this->db->table('ekspedisi')
        ->select('RIGHT(id_ekspedisi,3)as max_id', false)
        ->orderby('id_ekspedisi','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "EKS";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //MENU MERCHANT 
    public function getdataMerchant()
    {
        return $this->db->table('merchant')->get()->getResultArray();
    }

    public function saveMerchant($data)
    {
        $builder = $this->db->table('merchant');
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
    public function updateMerchant($data, $id)
    {
        $query = $this->db->table('merchant')->update($data, array('id_merchant' => $id));
        return $query;
    }

    public function deleteMerchant($id)
    {
        $query = $this->db->table('merchant')->delete(array('id_merchant' => $id));
        return $query;
    } 

    public function get_id_merchant()
    {
        $kode= $this->db->table('merchant')
        ->select('RIGHT(id_merchant,3)as max_id', false)
        ->orderby('id_merchant','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "MRC";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //MENU PENJUALAN
    public function getdataPenjualan()
    {
        $builder =$this->db->table('penjualan');
		$builder->selectMin('id_penjualan','id_penjualan');
		$builder->select('id_penjualan, nama_customer, alamat, no_telp, nama_barang, jmlh_barang, nama_merchant, 
        nama_ekspedisi, total_harga, tgl_retur, no_resi, harga_ongkir,click,tgl_kirim');
		$builder->groupBy('id_penjualan');
		$result = $builder->get();
		return $result->getResultArray();
    }

    public function getdataPenjualanall()
    {
        return $this->db->table('penjualan')->get()->getResultArray();
    }
    
    public function savePenjualan($data)
    {
        $builder = $this->db->table('penjualan');
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

    public function verifyCustomer($namacustomer){
		$builder =$this->db->table('customer');
		$builder->select('alamat,no_telp');
		$builder->where('nama_customer',$namacustomer);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function updateResi($data, $id)
    {
        $query = $this->db->table('penjualan')->update($data, array('id_penjualan' => $id));
        return $query;
    }

    public function getdataHistoryPenjualan()
    {
        return $this->db->table('history_penjualan')->get()->getResultArray();
    }
    
    public function historyPenjualan($data)
    {
        $builder = $this->db->table('history_penjualan');
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

    public function deleteHistoryPenjualan($id)
    {
        $query = $this->db->table('history_penjualan')->delete(array('id' => $id));
        return $query;
    
    } 

    public function TotalProduk()
    {
		$builder =$this->db->table('history_penjualan');
		$builder->selectSum('jmlh_barang');
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }

    public function get_id_penjualan()
    {
        $kode= $this->db->table('penjualan')
        ->select('RIGHT(id_penjualan,3)as max_id', false)
        ->orderby('id_penjualan','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PNJ";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //////
    public function verifyBarang($namabarang){
		$builder =$this->db->table('barang');
		$builder->select('*');
		$builder->where('nama_barang',$namabarang);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function BarangTerjual($data)
    {
        $builder = $this->db->table('barang_terjual');
        $builder->insertBatch($data);
        if($this->db->affectedRows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function insertjurnal($data)
    {
        $builder = $this->db->table('jurnal');
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

    public function union_idpenjualan(){
        $query = $this->db->query("SELECT MIN(id) AS id, id_penjualan
        FROM penjualan
        GROUP BY id_penjualan");
        return $query->getResultArray();
    }

    public function verifyNamaBarang($idpenjualan)
    {
		$builder =$this->db->table('penjualan');
		$builder->select('GROUP_CONCAT(DISTINCT nama_barang SEPARATOR ",") as nama_barang');
		$builder->where('id_penjualan',$idpenjualan);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function verifyNamaMerchant($idmerchant)
    {
		$builder =$this->db->table('penjualan');
		$builder->select('GROUP_CONCAT(DISTINCT nama_merchant SEPARATOR ",") as nama_merchant');
		$builder->where('id_penjualan',$idmerchant);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function verifyJumlah($idjmlhpenjualan)
    {
		$builder =$this->db->table('penjualan');
		$builder->selectSum('jmlh_barang');
		$builder->where('id_penjualan',$idjmlhpenjualan);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function verifynama($idnama)
    {
		$builder =$this->db->table('penjualan');
		$builder->select('*');
		$builder->where('id_penjualan',$idnama);
		$result = $builder->get();
		return $result->getResultArray();
	}

    public function verifyHarga($idhargapenjualan)
    {
		$builder =$this->db->table('penjualan');
		$builder->selectSum('total_harga');
		$builder->where('id_penjualan',$idhargapenjualan);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function verifyOngkir($idongkir)
    {
		$builder =$this->db->table('penjualan');
		$builder->selectSum('harga_ongkir');
		$builder->where('id_penjualan',$idongkir);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
	}

    public function updateClickPenjualan($data, $id)
    {
        $query = $this->db->table('penjualan')->update($data, array('id_penjualan' => $id));
        return $query;
    }
    
    public function verifyDataPenjualan($idpenj){
		$builder =$this->db->table('penjualan');
		$builder->selectMin('id_penjualan','id_penjualan');
		$builder->select('no_resi');
		$builder->where('id_penjualan',$idpenj);
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }

    public function tampil_tahun_penjualan(){
        $query = $this->db->query("SELECT YEAR(tgl_penjualan) as tahun FROM history_penjualan GROUP BY tahun");
        return $query->getResultArray();
    
    }

    public function SumPenjualan($bulan,$tahun)
    {
		$builder =$this->db->table('history_penjualan');
		$builder->selectSUM('total_harga');
		$builder->where("DATE_FORMAT(tgl_penjualan,'%c')", $bulan);
		$builder->where("DATE_FORMAT(tgl_penjualan,'%Y')", $tahun);
		$builder->where('status','Terjual');
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }

    public function SumRetur($bulan,$tahun)
    {
		$builder =$this->db->table('history_penjualan');
		$builder->selectSUM('total_harga');
		$builder->where("DATE_FORMAT(tgl_retur,'%c')", $bulan);
		$builder->where("DATE_FORMAT(tgl_retur,'%Y')", $tahun);
		$builder->where('status','Retur');
		$result = $builder->get();
		if(count($result->getResultArray())==1)
		{
			return $result->getRowArray();
		}
		else
		{
			return false;
		}
    }
    
}