<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_gudang extends Model {

    //MENU EOQ
    public function getdataEoq()
    {
        return $this->db->table('eoq')->get()->getResultArray();
    }

    public function verifyPembelianBahan($idpembelian)
    {
		$builder =$this->db->table('pembelian_gudang');
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

    public function getdataPembelianproses()
    {
		$builder =$this->db->table('pembelian_gudang');
		$builder->select('*');
		$builder->where('status','Sedang Proses');
		$result = $builder->get();
        return $result->getResultArray();

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

    public function TotalReceipt()
    {
		$builder =$this->db->table('good_receipt');
		$builder->selectSum('quantity');
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

    public function VerifySisaStok($nama){
		$builder =$this->db->table('sisa_bahan_gudang');
		$builder->select('*');
		$builder->where('nama_bahan', $nama);
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

    public function updateBeliBahan($data, $id)
    {
        $query = $this->db->table('sisa_bahan_gudang')->update($data, array('id' => $id));
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

    public function UpdateStatus($datapermintaanproduksi, $idpermintaan)
    {
        $query = $this->db->table('permintaan_bahan')->update($datapermintaanproduksi, array('id_permintaan' => $idpermintaan));
        return $query;
    }

    public function UpdateBahanproduksi($updatedatabahan, $namebahanproduksi)
    {
        $query = $this->db->table('bahan_baku')->update($updatedatabahan, array('nama_bahan' => $namebahanproduksi));
        return $query;
    }


    // public function SelectIDpermintaan(){
	// 	$builder =$this->db->table('pembelian_gudang');
	// 	$builder->select('id_permintaan');
	// 	$builder->where('biaya_pemesanan', 0);
	// 	$result = $builder->get();
	
	// 	return $result->getResultArray();
		
	// }

    public function proses_permintaan($data, $id)
      {
          $query = $this->db->table('permintaan_gudang')->update($data, array('id_permintaan' => $id));
          return $query;
      }

    public function get_id_permintaan()
    {
          $kode= $this->db->table('permintaan_gudang')
          ->select('RIGHT(id_permintaan,3)as max_id', false)
          ->orderby('id_permintaan','DESC')
          ->limit(1)->get()->getRowArray();
          
          if ($kode['max_id'] == null){
              $no= 1;
          }else{
              $no= intval($kode['max_id']) + 1;
          }
  
          $kd = "PB-";
          $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
          $kode_final=$kd . $batas;
          return $kode_final;
    } 

    public function get_id_history_bahan()
    {
          $kode= $this->db->table('bahan_baku')
          ->select('RIGHT(id_bahan,3)as max_id', false)
          ->orderby('id_bahan','DESC')
          ->limit(1)->get()->getRowArray();
          
          if ($kode['max_id'] == null){
              $no= 1;
          }else{
              $no= intval($kode['max_id']);
          }
  
          $kd = "BB-";
          $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
          $kode_final=$kd . $batas;
          return $kode_final;
    } 

    public function updateBahanSisaBahan($sisabahandata, $namabahan)
      {
          $query = $this->db->table('sisa_bahan_gudang')->update($sisabahandata, array('nama_bahan' => $namabahan));
          return $query;
      }

    public function VerifySafetyStok($safety)
    {
		$builder =$this->db->table('bahan_baku_gudang');
		$builder->select('*');
		$builder->where('nama_bahan', $safety);
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

    public function VerifyStoksisa($stok)
    {
		$builder =$this->db->table('sisa_bahan_gudang');
		$builder->select('*');
		$builder->where('nama_bahan', $stok);
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

    public function VerifyHargabahan($harga)
    {
		$builder =$this->db->table('bahan_baku_gudang');
		$builder->select('*');
		$builder->where('nama_bahan', $harga);
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

    public function VerifyNamabahan($nama)
    {
		$builder =$this->db->table('bahan_baku_gudang');
		$builder->select('nama_bahan','id_bahan');
		$builder->like('nama_bahan', $nama);
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

    public function VerifyNamabahanproduksi($namabahanproduksi)
    {
		$builder =$this->db->table('bahan_baku');
		$builder->select('nama_bahan');
		$builder->like('nama_bahan', $namabahanproduksi);
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


    public function updateSisaBahanBaku($updatesisabahan, $namasisagudang)
    {
        $query = $this->db->table('sisa_bahan_gudang')->update($updatesisabahan, array('nama_bahan' => $namasisagudang));
        return $query;
    }


    //MENU PEMBELIAN BAHAN
    public function getdataPembelianGudang()
      {
          return $this->db->table('pembelian_gudang')->get()->getResultArray();
      }
  
    public function savePembelianGudang($data)
      {
          $builder = $this->db->table('pembelian_gudang');
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
  

    public function updatePembelianBahan($data, $id)
    {
        $query = $this->db->table('pembelian_gudang')->update($data, array('id_pembelian' => $id));
        return $query;
    }


    public function SelectIDbahansisa(){
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

    public function get_id_pembelian()
    {
          $kode= $this->db->table('pembelian_gudang')
          ->select('RIGHT(id_pembelian,3)as max_id', false)
          ->orderby('id_pembelian','DESC')
          ->limit(1)->get()->getRowArray();
          
          if ($kode['max_id'] == null){
              $no= 1;
          }else{
              $no= intval($kode['max_id']) + 1;
          }
  
          $kd = "PBG-";
          $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
          $kode_final=$kd . $batas;
          return $kode_final;
    } 

    public function tampil_tahun_pembelian(){
        $query = $this->db->query("SELECT YEAR(tgl_pembelian) as tahun FROM pembelian_gudang GROUP BY tahun");
        return $query->getResultArray();
    
    }

    public function tampil_bulan_pembelian(){
        $query = $this->db->query("SELECT MONTHNAME(tgl_pembelian) as bulan FROM pembelian_gudang GROUP BY bulan");
        return $query->getResultArray();
    
    }

    public function SumPembelian($bulan,$tahun)
    {
		$builder =$this->db->table('pembelian_gudang');
		$builder->selectSUM('(jmlh_pembelian * biaya_bahan)','harga_bahan');
		$builder->where("DATE_FORMAT(tgl_pembelian,'%c')", $bulan);
		$builder->where("DATE_FORMAT(tgl_pembelian,'%Y')", $tahun);
		$builder->where('status','Selesai');
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

    public function SumPemesanan($bulan,$tahun)
    {
		$builder =$this->db->table('pembelian_gudang');
		$builder->selectSUM('(jmlh_pembelian * biaya_pemesanan)','harga_pemesanan');
		$builder->where("DATE_FORMAT(tgl_pembelian,'%c')", $bulan);
		$builder->where("DATE_FORMAT(tgl_pembelian,'%Y')", $tahun);
		$builder->where('status','Selesai');
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
    public function SumPenyimpanan($bulan,$tahun)
    {
		$builder =$this->db->table('pembelian_gudang');
		$builder->selectSUM('(jmlh_pembelian * biaya_penyimpanan)','harga_penyimpanan');
		$builder->where("DATE_FORMAT(tgl_pembelian,'%c')", $bulan);
		$builder->where("DATE_FORMAT(tgl_pembelian,'%Y')", $tahun);
		$builder->where('status','Selesai');
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

    // public function updateBahanSisaBahan($sisabahandata, $namabahan)
    //   {
    //       $query = $this->db->table('sisa_bahan_gudang')->update($sisabahandata, array('nama_bahan' => $namabahan));
    //       return $query;
    //   }

    // public function VerifySafetyStok($safety)
    // {
	// 	$builder =$this->db->table('bahan_baku_gudang');
	// 	$builder->select('*');
	// 	$builder->where('nama_bahan', $safety);
	// 	$result = $builder->get();
    //     if(count($result->getResultArray())==1)
	// 	{
	// 		return $result->getRowArray();
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }
}