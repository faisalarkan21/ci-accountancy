<?php namespace App\Models;
use CodeIgniter\Model;

class M_user extends Model{
    protected $DBGroup              = 'default';
	protected $table                = 'user';
	protected $primaryKey           = 'id_user';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
    protected $allowedFields        = ['nama','username','password','created_at','role','profil_pic','last_login'];

	public function verifyUsername($username){
		$builder =$this->db->table('user');
		$builder->select('id_user, nama, password, role');
		$builder->where('username',$username);
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

	public function saveLoginInfo($id)
    {
        $builder = $this->db->table('user');
        $builder->where('id_user',$id);
        $builder->update(['last_login'=>date('Y-m-d H:i:s')]);
        if($this->db->affectedRows()>0){
            return true;
        }
    }

	public function updateAt($id){
		$builder=$this->db->table('user');
		$builder->where('id_user', $id);
		$builder->update(['update_at'=>date('Y-m-d H:i:s')]);
		if($this->db->affectedRows()==1)
		{
			return true;
		}
		else{
			return false;
		}
	}

	public function verifyToken($token){
        $builder = $this->db->table('user');
        $builder->select("id_user,nama,update_at");
        $builder->where('id_user',$token);
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

	public function updatePassword($id,$pwd){
        $builder = $this->db->table('user');
        $builder->where('id_user', $id);
        $builder->update(['password'=>$pwd]);
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