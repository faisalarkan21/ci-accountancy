<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_pembelian extends Model {

  

    //MENU VENDOR
    public function getdataVendor()
    {
        return $this->db->table('vendor')->get()->getResultArray();
    }

    public function saveVendor($data)
    {
        $builder = $this->db->table('vendor');
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

    public function updateVendor($data, $id)
    {
        $query = $this->db->table('vendor')->update($data, array('id_vendor' => $id));
        return $query;
    }

    public function deleteVendor($id)
    {
        $query = $this->db->table('vendor')->delete(array('id_vendor' => $id));
        return $query;
    }

    public function get_id_vendor()
    {
        $kode= $this->db->table('vendor')
        ->select('RIGHT(id_vendor,3)as max_id', false)
        ->orderby('id_vendor','DESC')
        ->limit(1)->get()->getRowArray();
        
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
            $no= intval($kode['max_id']) + 1;
        }

        $kd = "VD";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //MENU PEMBAYARAN PEMBELIAN
    public function getdataPembelianBahan()
    {
        return $this->db->table('pembelian_bahan')->get()->getResultArray();
    }

    public function savePembelian($data)
    {
        $builder = $this->db->table('pembelian_bahan');
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

    public function verifyEoq($ideoq)
    {
		$builder =$this->db->table('eoq');
		$builder->select('*');
		$builder->where('id_eoq',$ideoq);
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

    public function get_id_pembelian()
    {
        $kode= $this->db->table('pembelian_bahan')
        ->select('RIGHT(id_pembelian,3)as max_id', false)
        ->orderby('id_pembelian','DESC')
        ->limit(1)->get()->getRowArray();
        
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
            $no= intval($kode['max_id']) + 1;
        }

        $kd = "PMB";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function getdataEoq(){
		$builder =$this->db->table('eoq');
		$builder->select('id_eoq');
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}

    public function selectdataVendor(){
		$builder =$this->db->table('vendor');
		$builder->select('nama_vendor');
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}

    public function deletePembayaran($id)
    {
        $query = $this->db->table('pembayaran_pembelian')->delete(array('id_pembelian' => $id));
        return $query;
    }

    public function getdataHistoryPembayaran()
    {
        return $this->db->table('history_pembelian_bahan')->get()->getResultArray();
    }

    public function historyPembayaran($data)
    {
        $builder = $this->db->table('history_pembelian_bahan');
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

    public function deleteHistoryPembayaran($id)
    {
        $query = $this->db->table('history_pembayaran_pembelian')->delete(array('id' => $id));
        return $query;
    }

    public function DateClick($insertdateclick, $id)
    {
        $query = $this->db->table('pembelian_bahan')->update($insertdateclick, array('id_pembelian' => $id));
        return $query;
    }

    public function updateStatusPembelianGudang($dataupdatestatus, $namabahan)
    {
        $query = $this->db->table('pembelian_gudang')->update($dataupdatestatus, array('nama_bahan' => $namabahan));
        return $query;
    }

}