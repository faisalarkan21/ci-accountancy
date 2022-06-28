<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_gudang extends Model {

    //MENU EOQ
    public function getdataEoq()
    {
        return $this->db->table('eoq')->get()->getResultArray();
    }

    public function verifyPermintaan($idpermintaan)
    {
		$builder =$this->db->table('permintaan_gudang');
		$builder->select('id_permintaan,nama_bahan,jmlh_permintaan,biaya_pemesanan,biaya_penyimpanan,safety_stok,biaya_bahan');
		$builder->where('id_permintaan',$idpermintaan);
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

    public function saveEoq($data)
    {
        $builder = $this->db->table('eoq');
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

    public function get_id_eoq()
    {
        $kode= $this->db->table('eoq')
        ->select('RIGHT(id_eoq,3)as max_id', false)
        ->orderby('id_eoq','DESC')
        ->limit(1)->get()->getRowArray();
        
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
            $no= intval($kode['max_id']) + 1;
        }

        $kd = "EOQ";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function PermintaanSudahDiterima(){
		$builder =$this->db->table('permintaan_gudang');
		$builder->select('id_permintaan');
		$builder->where('status', 'Diterima');
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}



    //MENU GOOD ISSUE
    public function getdataGoodIssue()
    {
        return $this->db->table('good_issue')->get()->getResultArray();
    }

    public function get_id_good()
    {
        $kode= $this->db->table('good_issue')
        ->select('RIGHT(id_good,3)as max_id', false)
        ->orderby('id_good','DESC')
        ->limit(1)->get()->getRowArray();
        
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
            $no= intval($kode['max_id']) + 1;
        }

        $kd = "GI";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function saveGoodIssue($data)
    {
        $builder = $this->db->table('good_issue');
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


    //MENU GOOD RECEIPT
    public function getdataGoodReceipt()
    {
        return $this->db->table('good_receipt')->get()->getResultArray();
    }

    public function get_id_receipt()
    {
        $kode= $this->db->table('good_receipt')
        ->select('RIGHT(id_receipt,3)as max_id', false)
        ->orderby('id_receipt','DESC')
        ->limit(1)->get()->getRowArray();
        
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
            $no= intval($kode['max_id']) + 1;
        }

        $kd = "GR";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    public function saveGoodReceipt($data)
    {
        $builder = $this->db->table('good_receipt');
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

    public function SelectIDPembelian(){
		$builder =$this->db->table('pembelian_bahan');
		$builder->select('id_pembelian');
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}

    public function verifyPembelian($idpembelian)
    {
		$builder =$this->db->table('pembelian_bahan');
		$builder->select('*');
		$builder->where('id_pembelian',$idpembelian);
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

    //MENU BAHAN BAKU
    public function getdataBahanBaku()
      {
          return $this->db->table('bahan_baku_gudang')->get()->getResultArray();
      }
  
    public function saveBahanBaku($data)
      {
          $builder = $this->db->table('bahan_baku_gudang');
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
  
      public function getdataBahanSisa()
      {
          return $this->db->table('sisa_bahan_gudang')->get()->getResultArray();
      }

      public function get_id_bahan_baku()
      {
          $kode= $this->db->table('bahan_baku_gudang')
          ->select('RIGHT(id_bahan,3)as max_id', false)
          ->orderby('id_bahan','DESC')
          ->limit(1)->get()->getRowArray();
          
          if ($kode['max_id'] == null){
              $no= 1;
          }else{
              $no= intval($kode['max_id']) + 1;
          }
  
          $kd = "BHN";
          $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
          $kode_final=$kd . $batas;
          return $kode_final;
      }

      public function updateBahanBaku($data, $id)
      {
          $query = $this->db->table('bahan_baku_gudang')->update($data, array('id_bahan' => $id));
          return $query;
      }

      public function deleteBahanBaku($id)
    {
        $query = $this->db->table('bahan_baku_gudang')->delete(array('id_bahan' => $id));
        return $query;
    }

      public function deleteSisaBahan($id)
    {
        $query = $this->db->table('sisa_bahan_gudang')->delete(array('id' => $id));
        return $query;
    }




    //MENU PERMINTAAN BAHAN
    public function getdataPermintaanGudang()
      {
          return $this->db->table('permintaan_gudang')->get()->getResultArray();
      }
  
    public function savePermintaanGudang($data)
      {
          $builder = $this->db->table('permintaan_gudang');
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
  

    public function updatePermintaanBahan($data, $id)
    {
        $query = $this->db->table('permintaan_gudang')->update($data, array('id_permintaan' => $id));
        return $query;
    }


    public function SelectIDpermintaan(){
		$builder =$this->db->table('permintaan_gudang');
		$builder->select('id_permintaan');
		$builder->where('biaya_pemesanan', 0);
		$result = $builder->get();
	
		return $result->getResultArray();
		
	}

    public function terima_tolak_data($data, $id)
      {
          $query = $this->db->table('permintaan_gudang')->update($data, array('id_permintaan' => $id));
          return $query;
      }
}