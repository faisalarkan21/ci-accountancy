<?php
namespace App\Models;

use \CodeIgniter\Model;
class M_dashboard extends Model {
    public function getLoggedInUserData($id)
    {
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $result = $builder->get();
        if(count($result->getResultArray())==1)
        {
            return $result->getRow();
        }
        else
        {
            return false;
        }
    }
   public function updateLogoutTime($id){
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $builder->update(['last_logout'=>date('Y-m-d H:i:s')]);
        if($this->db->affectedRows()>0){
            return true;
        }
    }
    public function getLoginUserInfo($id)
    {
        $builder = $this->db->table('login_activity');
        $builder->where('id_user',$id);
        $builder->orderBy('id_login', 'DESC');
        $builder->limit(10);
        $result = $builder->get();
        if(count($result->getResultArray())>0){
            return $result->getResult();
        }
        else{
            return false;
        }
    }
    public function updateAvatar($path,$id){
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $builder->update(['profil_pic'=>$path]);
        if($this->db->affectedRows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    public function updatePassword($npwd,$id){
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $builder->update(['password'=>$npwd]);
        if($this->db->affectedRows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    public function updateUserInfo($data,$id){
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $builder->update($data);
        if($this->db->affectedRows()>0){
            return true;
        }
        else{
            return false;
        }
    }
}