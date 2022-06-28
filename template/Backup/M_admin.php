<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_admin extends Model {


    //MENU PRODUCT
    public function getdataProduct()
    {
        return $this->db->table('barang')->get()->getResultArray();
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

    public function deleteProduct($id)
    {
        $query = $this->db->table('barang')->delete(array('id_barang' => $id));
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
        $kode= $this->db->table('history_penjualan')
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

}