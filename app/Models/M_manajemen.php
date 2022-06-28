<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_manajemen extends Model {


    //MENU ASET
    public function getdataAset()
    {
        return $this->db->table('aset')->get()->getResultArray();
    }

    public function saveAset($data)
    {
        $builder = $this->db->table('aset');
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

    public function deleteAset($id)
    {
        $query = $this->db->table('aset')->delete(array('id_aset' => $id));
        return $query;
    
    } 

    public function get_id_aset()
    {
        $kode= $this->db->table('aset')
        ->select('RIGHT(id_aset,2)as max_id', false)
        ->orderby('id_aset','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "A-";
        $batas = str_pad($no,2, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function updateAset($data, $id)
    {
        $query = $this->db->table('aset')->update($data, array('id_aset' => $id));
        return $query;
    }   
    
    //MENU BEBAN OPERASIONAL
    public function getdataBebanOP()
    {
        return $this->db->table('beban_op')->get()->getResultArray();
    }

    public function saveBebanop($data)
    {
        $builder = $this->db->table('beban_op');
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

    public function deleteBebanop($id)
    {
        $query = $this->db->table('beban_op')->delete(array('id_bebanop' => $id));
        return $query;
    }

    public function get_id_bebanop()
    {
        $kode= $this->db->table('beban_op')
        ->select('RIGHT(id_bebanop,2)as max_id', false)
        ->orderby('id_bebanop','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "BO-";
        $batas = str_pad($no,2, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
    public function updateBebanop($data, $id)
    {
        $query = $this->db->table('beban_op')->update($data, array('id_bebanop' => $id));
        return $query;
    }   

    //MENU UTANG
    public function getdataUtang()
    {
        return $this->db->table('utang')->get()->getResultArray();
    }

    public function saveUtang($data)
    {
        $builder = $this->db->table('utang');
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

    public function deleteUtang($id)
    {
        $query = $this->db->table('utang')->delete(array('id_utang' => $id));
        return $query;
    } 

    public function get_id_utang()
    {
        $kode= $this->db->table('utang')
        ->select('RIGHT(id_utang,2)as max_id', false)
        ->orderby('id_utang','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "U-";
        $batas = str_pad($no,2, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function updateUtang($data, $id)
    {
        $query = $this->db->table('utang')->update($data, array('id_utang' => $id));
        return $query;
    } 

    public function verifyhistoryut($idutang){
		$builder =$this->db->table('history_ut');
		$builder->select('*');
		$builder->where('id_pembayaranut',$idutang);
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
    
    //MENU JENIS BEBAN
    public function getdataJenisBeban()
    {
        return $this->db->table('jenis_beban')->get()->getResultArray();
    }

    public function saveJenisBeban($data)
    {
        $builder = $this->db->table('jenis_beban');
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

    public function deleteJenisBeban($id)
    {
        $query = $this->db->table('jenis_beban')->delete(array('id_jen_beban' => $id));
        return $query;
    } 

    public function get_id_jenis_beban()
    {
        $kode= $this->db->table('jenis_beban')
        ->select('RIGHT(id_jen_beban,2)as max_id', false)
        ->orderby('id_jen_beban','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "JBO-";
        $batas = str_pad($no,2, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function updateJenBeban($data, $id)
    {
        $query = $this->db->table('jenis_beban')->update($data, array('id_jen_beban' => $id));
        return $query;
    } 


    //MENU JENIS UTANG
    public function getdataJenisUtang()
    {
        return $this->db->table('jenis_utang')->get()->getResultArray();
    }

    public function saveJenisUtang($data)
    {
        $builder = $this->db->table('jenis_utang');
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

    public function deleteJenisUtang($id)
    {
        $query = $this->db->table('jenis_utang')->delete(array('id_jen_utang' => $id));
        return $query;
    } 

    public function get_id_jenis_utang()
    {
        $kode= $this->db->table('jenis_utang')
        ->select('RIGHT(id_jen_utang,2)as max_id', false)
        ->orderby('id_jen_utang','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "JU-";
        $batas = str_pad($no,2, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function updateJenUtang($data, $id)
    {
        $query = $this->db->table('jenis_utang')->update($data, array('id_jen_utang' => $id));
        return $query;
    } 

    //MENU PEMBELIAN ASET
    public function getdataPembelianAset()
    {
        return $this->db->table('pembelian_aset')->get()->getResultArray();
    }

    public function savePembelianAs($data)
    {
        $builder = $this->db->table('pembelian_aset');
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

    public function savePenyusutan($data)
    {
        $builder = $this->db->table('penyusutan_aset');
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

    public function deletePembelianAset($id)
    {
        $query = $this->db->table('pembelian_aset')->delete(array('id_pembelian_aset' => $id));
        return $query;
    } 

    public function deletePenyusutan($id)
    {
        $query = $this->db->table('penyusutan_aset')->delete(array('id_penyusutan' => $id));
        return $query;
    } 

    public function getdataHistoryPembelianAset()
    {
        return $this->db->table('history_pembelian_aset')->get()->getResultArray();
    }

    public function getdataAsetDimiliki()
    {
        return $this->db->table('aset_dimiliki')->get()->getResultArray();
    }
    public function getdataPenyusutan()
    {
        return $this->db->table('penyusutan_aset')->get()->getResultArray();
    }
    
    public function historyPembelianAset($data)
    {
        $builder = $this->db->table('history_pembelian_aset');
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

    public function deleteHistoryPembelian($id)
    {
        $query = $this->db->table('history_pembelian_aset')->delete(array('id' => $id));
        return $query;
    } 

    public function get_id_history_aset()
    {
        $kode= $this->db->table('history_pembelian_aset')
        ->select('RIGHT(id_pembelian_aset,3)as max_id', false)
        ->orderby('id_pembelian_aset','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PA-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function get_id_penyusutan()
    {
        $kode= $this->db->table('penyusutan_aset')
        ->select('RIGHT(id_penyusutan,3)as max_id', false)
        ->orderby('id_penyusutan','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PNA-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function deleteAsetDimiliki($id)
    {
        $query = $this->db->table('aset_dimiliki')->delete(array('id' => $id));
        return $query;
    } 

    public function InsertAsetDimiliki($data)
    {
        $builder = $this->db->table('aset_dimiliki');
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

    public function TotalAset()
    {
		$builder =$this->db->table('aset_dimiliki');
		$builder->selectSum('tot_harga');
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

    public function updatePembelianAset($data, $id)
    {
        $query = $this->db->table('pembelian_aset')->update($data, array('id_pembelian_aset' => $id));
        return $query;
    }
     
    public function Updateasetdimiliki($data, $id)
    {
        $query = $this->db->table('aset_dimiliki')->update($data, array('id_aset' => $id));
        return $query;
    } 

    public function verifyAsetdimiliki($idaset){
		$builder =$this->db->table('aset_dimiliki');
		$builder->select('*');
		$builder->where('id_aset',$idaset);
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

    //MENU PEMBAYARAN OPERASIONAL
    public function getdataPembayaranOp()
    {
        return $this->db->table('pembayaran_op')->get()->getResultArray();
    }

    public function savePembayaranOp($data)
    {
        $builder = $this->db->table('pembayaran_op');
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

    public function deletePembayaranOp($id)
    {
        $query = $this->db->table('pembayaran_op')->delete(array('id_pembayaranop' => $id));
        return $query;
    } 

    public function getdataHistoryPembayaranOp()
    {
        return $this->db->table('history_op')->get()->getResultArray();
    }
    
    public function historyPembayaranOp($data)
    {
        $builder = $this->db->table('history_op');
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

    public function deleteHistoryOp($id)
    {
        $query = $this->db->table('history_op')->delete(array('id' => $id));
        return $query;
    } 

    public function get_id_pembayaran_operasional()
    {
        $kode= $this->db->table('history_op')
        ->select('RIGHT(id_pembayaranop,3)as max_id', false)
        ->orderby('id_pembayaranop','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PBO-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
    public function updatePembayaranBeban($data, $id)
    {
        $query = $this->db->table('pembayaran_op')->update($data, array('id_pembayaranop' => $id));
        return $query;
    } 

    public function verifykdakun($nmakun){
		$builder =$this->db->table('coa');
		$builder->select('*');
		$builder->where('nama_akun',$nmakun);
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
    
    //MENU PEMBAYARAN UTANG
    public function getdataPembayaranUt()
    {
        return $this->db->table('pembayaran_ut')->get()->getResultArray();
    }

    public function savePembayaranUt($data)
    {
        $builder = $this->db->table('pembayaran_ut');
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
    
    public function deletePembayaranUt($id)
    {
        $query = $this->db->table('pembayaran_ut')->delete(array('id_pembayaranut' => $id));
        return $query;
    } 

    public function getdataHistoryPembayaranUt()
    {
        return $this->db->table('history_ut')->get()->getResultArray();
    }
    
    public function historyPembayaranUt($data)
    {
        $builder = $this->db->table('history_ut');
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

    public function deleteHistoryUt($id)
    {
        $query = $this->db->table('history_ut')->delete(array('id' => $id));
        return $query;
    } 

    public function get_id_pembayaran_utang()
    {
        $kode= $this->db->table('history_ut')
        ->select('RIGHT(id_pembayaranut,3)as max_id', false)
        ->orderby('id_pembayaranut','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PU-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
    
    public function updatePembayaranUtang($data, $id)
    {
        $query = $this->db->table('pembayaran_ut')->update($data, array('id_pembayaranut' => $id));
        return $query;
    } 

    public function verifyidproses($idproses){
		$builder =$this->db->table('proses_perbulan');
		$builder->select('*');
		$builder->where('id_proses',$idproses);
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

    
    //MENU PRIVE
    public function getdataPrive()
    {
        return $this->db->table('prive')->get()->getResultArray();
    }

    public function savePrive($data)
    {
        $builder = $this->db->table('prive');
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

    public function deletePrive($id)
    {
        $query = $this->db->table('prive')->delete(array('id_prive' => $id));
        return $query;
    } 

    public function updatePrive($data, $id)
    {
        $query = $this->db->table('prive')->update($data, array('id_prive' => $id));
        return $query;
    }   

    public function get_id_prive()
    {
        $kode= $this->db->table('prive')
        ->select('RIGHT(id_prive,3)as max_id', false)
        ->orderby('id_prive','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PR-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //MENU Prises Perbulan
    public function getdataprosesperbln()
    {
        return $this->db->table('proses_perbulan')->get()->getResultArray();
    }

    public function saveProses($data)
    {
        $builder = $this->db->table('proses_perbulan');
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


    public function updateProses($data, $id)
    {
        $query = $this->db->table('proses_perbulan')->update($data, array('id_proses' => $id));
        return $query;
    }   

    public function get_id_proses_pemb()
    {
        $kode= $this->db->table('proses_perbulan')
        ->select('RIGHT(id_proses,3)as max_id', false)
        ->orderby('id_proses','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PSP-";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
}