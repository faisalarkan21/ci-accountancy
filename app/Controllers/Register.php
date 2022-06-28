<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\M_user;
 
class Register extends BaseController
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }
 
    public function save()
    {
        $session = session();
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'nama'     => [
            'rules'    => 'required|min_length[3]|max_length[50]',
            'errors'   => [
            'required'  => 'Nama Lengkap harus diisi',
            'min_length' => 'Nama minimal 3 Karakteter',
            'max_length' => 'Nama maksimal 50 karakter',
            ]
        ],
            'username'   => [
            'rules'    =>  'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[user.username]',
            'errors'   => [
            'required'  => 'Username harus diisi',
            'min_length' => 'Username minimal 3 Karakteter',
            'max_length' => 'Username maksimal 20 karakter',
            'is_unique' => 'Username sudah digunakan',
            'alpha_numeric_space' => 'Username harus merupakan huruf, angka dan tidak menggunakan spasi',
            ]
        ],
            'password'  => [
            'rules'=> 'required|min_length[6]|max_length[16]|alpha_numeric_space',
            'errors'   => [
            'required'  => 'Password harus diisi',
            'min_length' => 'Password minimal 6 Karakteter',
            'max_length' => 'Password maksimal 16 karakter',
            'alpha_numeric_space' => 'Password harus merupakan huruf, angka dan tidak menggunakan spasi',
            ]
        ],
            'confpassword'  => [
            'rules'=>   'matches[password]',
            'errors'   => [
            'matches' => 'Password tidak sesuai'
            ]
        ],
            'role'  =>[
            'rules'=>     'required',
            'errors'   => [
            'required'  => 'Role/Job Desk harus diisi',  
            ]
        ],
        ];
         
        if($this->validate($rules)){
            $model = new M_user();
            $data = [
                'nama'     => $this->request->getVar('nama'),
                'username'    => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
            ];
            $model->save($data);
            $session->setFlashdata('Succes', 'Akun Berhasil Dibuat Silahkan Login');
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
         
    }
 
}