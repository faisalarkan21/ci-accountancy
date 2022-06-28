<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_keuangan extends Model {
    
    
    //MENU JENIS PENERIMAAN
    public function getdataJenisPenerimaan()
    {
        return $this->db->table('jenis_penerimaan')->get()->getResultArray();
    }

    public function saveJenisPenerimaan($data)
    {
        $builder = $this->db->table('jenis_penerimaan');
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

    public function deleteJenisPenerimaan($id)
    {
        $query = $this->db->table('jenis_penerimaan')->delete(array('id_jenis_penerimaan' => $id));
        return $query;
    }

    public function get_id_jenis_penerimaan()
    {
        $kode= $this->db->table('jenis_penerimaan')
        ->select('RIGHT(id_jenis_penerimaan,3)as max_id', false)
        ->orderby('id_jenis_penerimaan','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "JPK";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }

    //MENU PENERIMAAN KAS
    public function getdataPenerimaankas()
    {
        return $this->db->table('penerimaan_kas')->get()->getResultArray();
    }

    public function savePenerimaan($data)
    {
        $builder = $this->db->table('penerimaan_kas');
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

    public function deletePenerimaan($id)
    {
        $query = $this->db->table('penerimaan_kas')->delete(array('id_penerimaan' => $id));
        return $query;
    } 

    public function updatePenerimaan($data, $id)
    {
        $query = $this->db->table('penerimaan_kas')->update($data, array('id_penerimaan' => $id));
        return $query;
    }

    public function TotalPenerimaan()
    {
		$builder =$this->db->table('penerimaan_kas');
		$builder->selectSum('total');
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

    public function get_id_penerimaan()
    {
        $kode= $this->db->table('penerimaan_kas')
        ->select('RIGHT(id_penerimaan,3)as max_id', false)
        ->orderby('id_penerimaan','DESC')
        ->limit(1)->get()->getRowArray();
          
        if ($kode['max_id'] == null){
            $no= 1;
        }else{
          $no= intval($kode['max_id']) + 1;
        }
      
        $kd = "PMK";
        $batas = str_pad($no,3, "0" , STR_PAD_LEFT);
        $kode_final=$kd . $batas;
        return $kode_final;
    }
}