<?php

namespace App\Models;

use \CodeIgniter\Model;

class M_produksi extends Model
{

    //MENU COA
    public function getdataCoa()
    {
        return $this->db->table('coa')->get()->getResultArray();
    }

    public function saveCoa($data)
    {
        $builder = $this->db->table('coa');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCoa($data, $id)
    {
        $query = $this->db->table('coa')->update($data, array('kode_akun' => $id));
        return $query;
    }

    public function deleteCoa($id)
    {
        $query = $this->db->table('coa')->delete(array('kode_akun' => $id));
        return $query;
    }

    //MENU TENAGA KERJA
    public function getdataTenagaKerja()
    {
        $query = $this->db->query("SELECT DISTINCT id_operation, tenaga_kerja.id_tenaga_kerja,tenaga_kerja.jenis_tenaga_kerja FROM operation_list INNER JOIN tenaga_kerja ON tenaga_kerja.id_tenaga_kerja = operation_list.id_tenaga_kerja");
        return $query->getResultArray();
    }

    

    //MENU TENAGA KERJA
    public function getdataTenagaKerjaList()
    {
        return $this->db->table('tenaga_kerja')->get()->getResultArray();
    }

    public function getdataGaji()
    {
        return $this->db->table('gaji_tenaga_kerja')->get()->getResultArray();
    }

    public function saveTenagaKerja($data)
    {
        $builder = $this->db->table('tenaga_kerja');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function saveGaji($data)
    {
        $builder = $this->db->table('gaji_tenaga_kerja');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTenagaKerja($data, $id)
    {
        $query = $this->db->table('tenaga_kerja')->update($data, array('id_tenaga_kerja' => $id));
        return $query;
    }

    public function deleteTenagaKerja($id)
    {
        $query = $this->db->table('tenaga_kerja')->delete(array('id_tenaga_kerja' => $id));
        return $query;
    }

    public function deleteGaji($id)
    {
        $query = $this->db->table('gaji_tenaga_kerja')->delete(array('id_gaji' => $id));
        return $query;
    }

    public function get_id_tenaga_kerja()
    {
        $kode = $this->db->table('tenaga_kerja')
            ->select('RIGHT(id_tenaga_kerja,3)as max_id', false)
            ->orderby('id_tenaga_kerja', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "TK-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function get_id_gaji()
    {
        $kode = $this->db->table('gaji_tenaga_kerja')
            ->select('RIGHT(id_gaji,3)as max_id', false)
            ->orderby('id_gaji', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "GTK-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function verifyOperation($idoperation)
    {
        $builder = $this->db->table('operation_list');
        $builder->select('*');
        $builder->where('id_operation', $idoperation);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }


    //MENU RENCANA PRODUKSI
    public function getdataRencana()
    {
        return $this->db->table('rencana_produksi')->get()->getResultArray();
    }

    public function saveRencana($data)
    {
        $builder = $this->db->table('rencana_produksi');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteRencana($id)
    {
        $query = $this->db->table('rencana_produksi')->delete(array('id_rencana' => $id));
        return $query;
    }

    public function get_id_rencana_produksi()
    {
        $kode = $this->db->table('rencana_produksi')
            ->select('RIGHT(id_rencana,3)as max_id', false)
            ->orderby('id_rencana', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "RP-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }


    //MENU BAHAN BAKU
    public function getdataBahan()
    {
        return $this->db->table('bahan_baku')->get()->getResultArray();
    }

    public function saveBahan($data)
    {
        $builder = $this->db->table('bahan_baku');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBahan($data, $id)
    {
        $query = $this->db->table('bahan_baku')->update($data, array('id_bahan' => $id));
        return $query;
    }

    public function deleteBahan($id)
    {
        $query = $this->db->table('bahan_baku')->delete(array('id_bahan' => $id));
        return $query;
    }

    public function getdataHistoryBahan()
    {
        return $this->db->table('history_bahan_baku')->orderBy('nama_bahan')->get()->getResultArray();
    }

    public function saveHistoryBahan($data)
    {
        $builder = $this->db->table('history_bahan_baku');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHistoryBahan($id)
    {
        $query = $this->db->table('history_bahan_baku')->delete(array('id' => $id));
        return $query;
    }

    public function verifyBahan($namabahan)
    {
        $builder = $this->db->table('bahan_baku');
        $builder->select('*');
        $builder->where('nama_bahan', $namabahan);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function get_id_bahan_baku()
    {
        $kode = $this->db->table('bahan_baku')
            ->select('RIGHT(id_bahan,3)as max_id', false)
            ->orderby('id_bahan', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BB-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    //MENU BOM


    public function getdataBomall()
    {
        $query = $this->db->query("SELECT DISTINCT bom_baru.id_bom, bom_baru.nama_product, bom_baru.quantity, bahan_baku.nama_bahan from bom_baru INNER JOIN bahan_baku ON bahan_baku.id_bahan = bom_baru.id_bahan");
        $productionDetails = $query->getResultArray();
        return $productionDetails;
    }


    public function getDataProductionDetails()
    {

        $query = $this->db->query("SELECT DISTINCT production_details.id_bom, bom_baru.id_bahan, bom_baru.nama_product, bom_baru.quantity, bahan_baku.nama_bahan, tenaga_kerja.jenis_tenaga_kerja, bahan_baku.harga_bahan, tenaga_kerja.tarif, jadwal_produksi.tgl_mulai, jadwal_produksi.rencana_produksi from production_details INNER JOIN bom_baru ON bom_baru.id_bom = production_details.id_bom INNER JOIN operation_list ON operation_list.id_operation = production_details.id_operation INNER JOIN bahan_baku ON bahan_baku.id_bahan = bom_baru.id_bahan INNER JOIN tenaga_kerja ON tenaga_kerja.id_tenaga_kerja = operation_list.id_tenaga_kerja INNER JOIN jadwal_produksi on jadwal_produksi.id_operation = operation_list.id_operation");

        
        $productionDetails = $query->getResultArray();
        return $productionDetails;
    }

    public function getdataBom()
    {
        $builder = $this->db->table('bom_baru');
        $builder->selectMin('id_bom', 'id_bom');
        $builder->select('id_bom, nama_product');
        $builder->groupBy('id_bom');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getdataBomallTEST()
    {
        return $this->db->table('bom')->get()->getResultArray();
    }

    // function tampil_data(){
    //     $query ='SELECT distinct id_bom from bom';
    //     return $this->db->query($query);
    //     }

    // function datasama($id){
    //     $builder =$this->db->table('bom_baru');
    // 	$builder->select('*');
    // 	$builder->where('id_bom',$id);
    // 	$result = $builder->get();
    // 	return $result->getResultArray();
    //     // $query ="SELECT * from bom where id_bom = '$id'";
    //     // return $this->db->query($query);
    //     }



    public function saveProductionDetails($data)
    {
        $builder = $this->db->table('production_details');
        $builder->insert($data);

        $error = $this->db->error();
        print_r($error);


        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function saveBomBahan($data)
    {
        $builder = $this->db->table('bom_baru');
        $builder->insert($data);

        $error = $this->db->error();
        print_r($error);


        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyProductionDetails($idbom)
    {
        $builder = $this->db->table('production_details');
        $builder->get();
        $builder->where('id_bom', $idbom);
        $result = $builder->get();

        if (empty($result->getResultArray())){
            return false;
        }
        else{
            return true;
        }
      
    }

    // public function getIDBahan($idbom)
    // {
    //     $builder = $this->db->table('bom_baru');
    //     $builder->get();
    //     $builder->where('id_bom', $idbom);
    //     $result = $builder->get();
    //     return $result->getRowArray();
    // }


    public function saveAddBom($data)
    {
        $builder = $this->db->table('bom_baru');
        $builder->insert($data);
        
        $error = $this->db->error();
        print_r($error);


        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // public function updateBom($id, $data){
    // 	$builder =$this->db->table('bom_baru');
    // 	$builder->set('target_produksi',$data);
    // 	$builder->where('id_bom',$id);
    // 	$builder->update();

    // }

    public function updateBom($data, $id)
    {
        $query = $this->db->table('bom_baru')->update($data, ['id_bom' => $id]);
        return $query;
    }

    public function deleteBom($id)
    {
        $query = $this->db->table('bom_baru')->delete(['id_bom' => $id]);
        return $query;
    }

    public function get_id_bom()
    {
        $kode = $this->db->table('bom_baru')
            ->select('RIGHT(id_bom,3)as max_id', false)
            ->orderby('id_bom', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BOM-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function union_idbom()
    {
        $query = $this->db->query("SELECT * FROM bom_baru inner join bahan_baku on bahan_baku.id_bahan = bom_baru.id_bahan GROUP BY id_bom");
        return $query->getResultArray();
    }

    public function getIDBahan($idbom)
    {
        $builder = $this->db->table('bom_baru');
        $builder->get();
        $builder->where('id_bom', $idbom);
        $result = $builder->get();
        return $result->getRowArray();
    }


    public function verifyBahanBom($idbom){
		$builder =$this->db->table('bom_baru');
		$builder->selectMin('id_bom','id_bom');
		$builder->select('target_produksi, nama_product');
		$builder->where('id_bom',$idbom);
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

    public function verifyTarif($idtarif)
    {
        $builder = $this->db->table('tenaga_kerja');
        $builder->select('*');
        $builder->where('jenis_tenaga_kerja', $idtarif);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }


    //MENU JADWAL PRODUKSI
    public function getdataJadwal()
    {
        return $this->db->table('jadwal_produksi')->get()->getResultArray();
    }

    public function saveJadwal($data)
    {
        $builder = $this->db->table('jadwal_produksi');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateJadwal($data, $id)
    {
        $query = $this->db->table('jadwal_produksi')->update($data, array('id_jadwal' => $id));
        return $query;
    }

    public function getdataHistoryJadwal()
    {
        return $this->db->table('history_jadwal')->get()->getResultArray();
    }

    public function historyJadwal($data)
    {
        $builder = $this->db->table('history_jadwal');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDaftarJadwal($id)
    {
        $query = $this->db->table('jadwal_produksi')->delete(array('id_jadwal' => $id));
        return $query;
    }
    public function deleteHistoryJadwal($id)
    {
        $query = $this->db->table('history_jadwal')->delete(array('id' => $id));
        return $query;
    }
    public function get_id_jadwal()
    {
        $kode = $this->db->table('jadwal_produksi')
            ->select('RIGHT(id_jadwal,3)as max_id', false)
            ->orderby('id_jadwal', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "JP-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function verifyWaktupengerjaan($idjadwal)
    {
        $builder = $this->db->table('jadwal_produksi');
        $builder->select('*');
        $builder->where('id_jadwal', $idjadwal);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function VerifyProdukadmin($idprodukadmin)
    {
        $builder = $this->db->table('barang');
        $builder->select('nama_barang,id_barang,jmlh_barang');
        $builder->like('nama_barang', $idprodukadmin);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    //MENU OVERHEAD 
    public function getdataOverhead()
    {
        return $this->db->table('overhead')->get()->getResultArray();
    }

    public function saveOverhead($data)
    {
        $builder = $this->db->table('overhead');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOverhead($data, $id)
    {
        $query = $this->db->table('overhead')->update($data, array('id_overhead' => $id));
        return $query;
    }

    public function deleteOverhead($id)
    {
        $query = $this->db->table('overhead')->delete(array('id_overhead' => $id));
        return $query;
    }

    public function get_id_overhead()
    {
        $kode = $this->db->table('overhead')
            ->select('RIGHT(id_overhead,3)as max_id', false)
            ->orderby('id_overhead', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "OP-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    //MENU PRODUK JADI
    public function getdataProdukJadi()
    {
        return $this->db->table('produk_jadi')->get()->getResultArray();
    }

    public function saveProdukJadi($data)
    {
        $builder = $this->db->table('produk_jadi');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProdukJadi($data, $id)
    {
        $query = $this->db->table('produk_jadi')->update($data, array('id_produk' => $id));
        return $query;
    }

    public function deleteProdukJadi($id)
    {
        $query = $this->db->table('produk_jadi')->delete(array('id_produk' => $id));
        return $query;
    }

    public function get_id_produk_jadi()
    {
        $kode = $this->db->table('produk_jadi')
            ->select('RIGHT(id_produk,3)as max_id', false)
            ->orderby('id_produk', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "PJ-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    //MENU BIAYA BAHAN
    public function getdataBiayaBahan()
    {
        return $this->db->table('biaya_bahan')->get()->getResultArray();
       
    }

    public function saveBiayaBahan($data)
    {
        $builder = $this->db->table('biaya_bahan');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }



    public function deleteBiayaBahan($id)
    {
        $query = $this->db->table('biaya_bahan')->delete(array('id_biaya_bahan' => $id));
        return $query;
    }

    public function getdataHistoryBiayaBahan()
    {
        return $this->db->table('history_biaya_bahan')->get()->getResultArray();
    }

    public function historyBiayaBahan($data)
    {
        $builder = $this->db->table('history_biaya_bahan');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHistoryBiayaBahan($id)
    {
        $query = $this->db->table('history_biaya_bahan')->delete(array('id' => $id));
        return $query;
    }

    public function get_id_biaya_bahan()
    {
        $kode = $this->db->table('history_biaya_bahan')
            ->select('RIGHT(id_biaya_bahan,3)as max_id', false)
            ->orderby('id_biaya_bahan', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BBB-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function verifyBom($idbom)
    {
        $builder = $this->db->table('bom_baru');
        $builder->select('*');
        $builder->where('id_bom', $idbom);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function populatedJadwal()
    {

        return $this->db->table('jadwal_produksi')->get()->getResultArray();
    }

    public function verifyNamaBahanBom($idbom)
    {
        $builder = $this->db->table('bom_baru');
        $builder->select('GROUP_CONCAT(DISTINCT nama_bahan SEPARATOR ",") as nama_bahan');
        $builder->where('id_bom', $idbom);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifypekerjaan($idbom)
    {
        $builder = $this->db->table('bom_baru');
        $builder->select('GROUP_CONCAT(DISTINCT jenis_tenaga_kerja SEPARATOR ",") as pekerjaan');
        $builder->selectSum('tarif');
        $builder->select('target_produksi');
        $builder->where('id_bom', $idbom);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifyBiaya($idbombiaya)
    {
        $builder = $this->db->table('bom_baru');
        $builder->selectSum('total_biaya');
        $builder->where('id_bom', $idbombiaya);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
    public function verifyQuantity($idbomquantity)
    {
        $builder = $this->db->table('bom_baru');
        $builder->selectSum('quantity');
        $builder->where('id_bom', $idbomquantity);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function tampil_tahun_biaya_bahan()
    {
        $query = $this->db->query("SELECT YEAR(tgl_pembayaran) as tahun FROM history_biaya_bahan GROUP BY tahun");
        return $query->getResultArray();
    }

    public function SumBiayaBahan($bulan, $tahun)
    {
        $builder = $this->db->table('history_biaya_bahan');
        $builder->selectSUM('total_biaya');
        $builder->where("DATE_FORMAT(tgl_pembayaran,'%c')", $bulan);
        $builder->where("DATE_FORMAT(tgl_pembayaran,'%Y')", $tahun);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }



    //MENU BIAYA OVERHEAD
    public function getdataBiayaOverhead()
    {
        return $this->db->table('biaya_overhead')->get()->getResultArray();
    }

    public function saveBiayaOverhead($data)
    {
        $builder = $this->db->table('biaya_overhead');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBiayaOverhead($id)
    {
        $query = $this->db->table('biaya_overhead')->delete(array('id_biaya_overhead' => $id));
        return $query;
    }

    public function getdataHistoryBiayaOverhead()
    {
        return $this->db->table('history_biaya_overhead')->get()->getResultArray();
    }

    public function historyBiayaOverhead($data)
    {
        $builder = $this->db->table('history_biaya_overhead');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHistoryBiayaOverhead($id)
    {
        $query = $this->db->table('history_biaya_overhead')->delete(array('id' => $id));
        return $query;
    }

    public function get_id_biaya_overhead()
    {
        $kode = $this->db->table('history_biaya_overhead')
            ->select('RIGHT(id_biaya_overhead,3)as max_id', false)
            ->orderby('id_biaya_overhead', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BOP-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function SumBiayaOver($bulan, $tahun)
    {
        $builder = $this->db->table('history_biaya_overhead');
        $builder->selectSUM('total_overhead');
        $builder->where("DATE_FORMAT(tgl_pembayaran,'%c')", $bulan);
        $builder->where("DATE_FORMAT(tgl_pembayaran,'%Y')", $tahun);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }



    //MENU BIAYA TENAGA KERJA
    public function getdataBiayaTenagaKerja()
    {
        return $this->db->table('biaya_tenaga_kerja')->get()->getResultArray();
    }

    public function saveBiayaTenagaKerja($data)
    {
        $builder = $this->db->table('biaya_tenaga_kerja');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyPegawai($nama)
    {
        $builder = $this->db->table('operation_list');
        $builder->select('jenis_tenaga,total_biaya');
        $builder->where('nama_pegawai', $nama);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function deleteBiayaTenagaKerja($id)
    {
        $query = $this->db->table('biaya_tenaga_kerja')->delete(array('id_biaya_tenaga' => $id));
        return $query;
    }

    public function getdataHistoryTenagaKerja()
    {
        return $this->db->table('history_biaya_tenaga')->get()->getResultArray();
    }

    public function historyBiayaTenagaKerja($data)
    {
        $builder = $this->db->table('history_biaya_tenaga');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteHistoryBiayaTenaga($id)
    {
        $query = $this->db->table('history_biaya_tenaga')->delete(array('id' => $id));
        return $query;
    }

    public function get_id_biaya_tenaga_kerja()
    {
        $kode = $this->db->table('history_biaya_tenaga')
            ->select('RIGHT(id_biaya_tenaga,3)as max_id', false)
            ->orderby('id_biaya_tenaga', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BTK-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function verifyTgl($tgl)
    {
        $builder = $this->db->table('jurnal');
        $builder->selectSUM('debet');
        $builder->where('id', 'BDP1');
        $builder->orWhere('id', 'BDP2');
        $builder->where('tanggal', $tgl);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifyGaji($idgaji)
    {
        $builder = $this->db->table('gaji_tenaga_kerja');
        $builder->select('*');
        $builder->where('id_gaji', $idgaji);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function SumBiayaTenaga($bulan, $tahun)
    {
        $builder = $this->db->table('history_biaya_tenaga');
        $builder->selectSUM('gaji');
        $builder->where("DATE_FORMAT(tgl_bayar,'%c')", $bulan);
        $builder->where("DATE_FORMAT(tgl_bayar,'%Y')", $tahun);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }


    //MENU BIAYA PRODUKSI
    public function getdataBiayaProduksi()
    {
        return $this->db->table('biaya_produksi')->get()->getResultArray();
    }

    public function saveBiayaProduksi($data)
    {
        $builder = $this->db->table('biaya_produksi');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyIDBahan($idbahan)
    {
        $builder = $this->db->table('history_biaya_bahan');
        $builder->selectSum('total_biaya');
        $builder->where('id_biaya_bahan', $idbahan);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifyIDOverhead($idoverhead)
    {
        $builder = $this->db->table('history_biaya_overhead');
        $builder->selectSum('total_overhead');
        $builder->where('id_biaya_overhead', $idoverhead);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifyIDTenaga($idtenaga)
    {
        $builder = $this->db->table('history_biaya_tenaga');
        $builder->selectSum('gaji');
        $builder->where('id_biaya_tenaga', $idtenaga);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function deleteBiayaProduksi($id)
    {
        $query = $this->db->table('biaya_produksi')->delete(array('id_biaya_produksi' => $id));
        return $query;
    }

    public function getdataHistoryBiayaProduksi()
    {
        return $this->db->table('history_biaya_produksi')->get()->getResultArray();
    }

    public function historyBiayaProduksi($data)
    {
        $builder = $this->db->table('history_biaya_produksi');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHistoryBiayaProduksi($id)
    {
        $query = $this->db->table('history_biaya_produksi')->delete(array('id' => $id));
        return $query;
    }

    public function get_id_biaya_produksi()
    {
        $kode = $this->db->table('history_biaya_produksi')
            ->select('RIGHT(id_biaya_produksi,3)as max_id', false)
            ->orderby('id_biaya_produksi', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "BP-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function verifyTenagaKerja($idtenagakerja)
    {
        $builder = $this->db->table('tenaga_kerja');
        $builder->selectMin('id_tenaga_kerja', 'id_tenaga_kerja');
        $builder->select('id_tenaga_kerja, tarif, jenis_tenaga_kerja');
        $builder->where('id_tenaga_kerja', $idtenagakerja);
        $result = $builder->get();
        // print_r($result);die();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    // MENU DETAIL PRODUKSI
    public function getdataDetailProduksi()
    {

        $builder = $this->db->table('jadwal_produksi');
        $builder->selectMin('jadwal_produksi.id_jadwal', 'jadwal_produksi.id_jadwal');
        $builder->select('jadwal_produksi.id_jadwal, jadwal_produksi.nama_produk, jadwal_produksi.rencana_produksi, operation_list.jenis_tenaga_kerja');
        // $builder->join('bom_baru', 'bom.id_bom = jadwal_produksi.id_bom', 'left');
        $builder->join('operation_list', 'operation_list.id_operation = jadwal_produksi.id_operation', 'left');
        // $builder->groupBy('id_jadwal');
        $result = $builder->get();
        print_r($result);
        die();
        return $result;
    }

    //MENU OPERATION LIST
    public function getdataOperationAll()
    {
        return $this->db->table('operation_list')->get()->getResultArray();
    }

    public function getdataOperationList()
    {
        $query = $this->db->query("SELECT DISTINCT nama_produk, id_operation, quantity, tenaga_kerja.jenis_tenaga_kerja FROM operation_list INNER JOIN tenaga_kerja ON tenaga_kerja.id_tenaga_kerja = operation_list.id_tenaga_kerja");
        return $query->getResultArray();
    }

    public function union_idoperation()
    {
        $query = $this->db->query("SELECT DISTINCT id_operation FROM operation_list");
        return $query->getResultArray();
    }

    public function verifyOperationList($idoperation)
    {
        $builder = $this->db->table('operation_list');
        $builder->selectMin('id_operation', 'id_operation');
        $builder->select('id_operation, nama_produk, quantity');
        $builder->where('id_operation', $idoperation);
        $result = $builder->get();
        // print_r($result);die();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function saveOperationList($data)
    {
        $builder = $this->db->table('operation_list');
        $builder->insert($data);
        $error = $this->db->error();
        print_r($error);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteOperationList($id)
    {
        $query = $this->db->table('operation_list')->delete(array('id_operation' => $id));
        return $query;
    }

    public function verifyProdukJadi($idprodukjadi)
    {
        $builder = $this->db->table('produk_jadi');
        $builder->select('*');
        $builder->where('id_produk', $idprodukjadi);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function get_id_operation_list()
    {
        $kode = $this->db->table('operation_list')
            ->select('RIGHT(id_operation,3)as max_id', false)
            ->orderby('id_operation', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "OPL-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }

    public function updateOperationList($data, $id)
    {
        $query = $this->db->table('operation_list')->update($data, array('id_operation' => $id));
        return $query;
    }

    //MENU PERMINTAAN BAHAN
    public function getdataPermintaanBahan()
    {
        return $this->db->table('permintaan_bahan')->get()->getResultArray();
    }

    public function savePermintaanBahan($data)
    {
        $builder = $this->db->table('permintaan_bahan');
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePermintaanBahan($id)
    {
        $query = $this->db->table('permintaan_bahan')->delete(array('id_permintaan' => $id));
        return $query;
    }

    public function get_id_permintaan_bahan()
    {
        $kode = $this->db->table('permintaan_bahan')
            ->select('RIGHT(id_permintaan,3)as max_id', false)
            ->orderby('id_permintaan', 'DESC')
            ->limit(1)->get()->getRowArray();

        if ($kode['max_id'] == null) {
            $no = 1;
        } else {
            $no = intval($kode['max_id']) + 1;
        }

        $kd = "PB-";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $kode_final = $kd . $batas;
        return $kode_final;
    }
}
