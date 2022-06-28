<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\M_user;
 
class Login extends Controller
{
    public $M_user;
    public function __construct() {
        helper('form','array');
        $this->M_user = new M_user();
        $this->session = session();
    }
    public function index()
    {
        $data = [];
        //site login
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'username' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Username harus diisi',
                ]
            ],
                'password' =>[
                'rules' => 'required|min_length[6]|max_length[16]',
                'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 6 karakter',
                'max_length' => 'Password maksimal 16 karakter',
                ]
            ],
            ];
            if($this->validate($rules))
            {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                
                
                $userdata = $this->M_user->verifyUsername($username);
                if($userdata)
                {
                    if(password_verify($password, $userdata['password']))
                    {       
                            date_default_timezone_set('Asia/Jakarta');
                            $loginInfo = $userdata['id_user'];
                            $la_id = $this->M_user->saveLoginInfo($loginInfo);
                            if($la_id){
                                $this->session->set('logged_info',$la_id);
                            }
                            $this->session->set('logged_user',$userdata['id_user']);
                            if($userdata['role'] == 'keuangan'){
                            return redirect()->to(base_url().'/dashboard/dashboard_keuangan');
                            }
                            elseif($userdata['role'] == 'produksi') {
                                return redirect()->to(base_url('/dashboard/dashboard_produksi'));
                            }
                            elseif($userdata['role'] == 'admin') {
                                return redirect()->to(base_url('/dashboard/dashboard_admin'));
                            }
                            elseif($userdata['role'] == 'manajemenkas') {
                                return redirect()->to(base_url('/dashboard/dashboard_manajemenkas'));
                            }
                            elseif($userdata['role'] == 'gudang') {
                                return redirect()->to(base_url('/dashboard/dashboard_gudang'));
                            }
                            else{
                                return redirect()->to(base_url('/dashboard/dashboard_pembelian'));
                            }
                    }
                    else
                    {
                        $data['error'] = 'Password Salah';
                        //$this->session->setTempdata('error','Sorry! Wrong password entered for that email',3);
                        //return redirect()->to(current_url());
                    }
                }
                else
                {
                    $data['error'] = 'Username Tidak Ditemukan';
                    //$this->session->setTempdata('error','Sorry! Email does not exists',3);
                    //return redirect()->to(current_url());
                }
                
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }
        return view("login",$data);
    }
 

    public function forgot_password()
    {
        $session = session();
        $data = [];
        if ($this->request->getMethod()=='post'){
            $rules = [
                'username'=>[
                    'label'=> 'username',
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=>'{field} field required',
                    ]
                ],
             ];
             if($this->validate($rules)){
                $username= $this->request->getvar('username');
                $userdata = $this->M_user->verifyUsername($username);
                if(!empty($userdata)){
                    date_default_timezone_set('Asia/Jakarta');
                    if($this->M_user->updateAt($userdata['id_user'])){
                        $token=$userdata['id_user'];
                        return redirect()->to(base_url('login/reset_password/'.$token));   
                    }
                    else{
                        $session->setFlashdata('Gagal', 'Gagal Update, Harap Ulangi Kembali');
                        return redirect()->to(current_url());  
                    }
                }
                else{
                    $session->setFlashdata('Gagal', 'Username Tidak Ditemukan');
                return redirect()->to(current_url());
                }
             }
             else{
                 $data['validation']=$this->validator;
                
             }
        }
    return view("forgot_password",$data);
    }

    public function reset_password($token=null){

        $session = session();
        $data = [];
        
        if(!empty($token)){
            $userdata = $this->M_user->verifyToken($token);
            if(!empty($userdata)){
                if($this->checkExpiryDate($userdata['update_at'])){
                   if($this->request->getMethod()=='post'){
                       $rules = [
                           'pwd' => [
                               'label' =>'Password',
                               'rules' => 'required|min_length[6]|max_length[16]|alpha_numeric_space',
                               'errors' => [
                               'required' => 'Password tidak boleh kosong',
                               'min_length' => 'Password minimal 6 karakter',
                               'max_length' => 'Password maksimal 16 karakter',
                               'alpha_numeric_space' => 'Password harus merupakan huruf, angka dan tidak menggunakan spasi'
                               ]
                           ],
                           'cpwd' => [
                               'label' => 'Confirm Password',
                               'rules' => 'required|matches[pwd]',
                               'errors' => [
                               'required' => 'Password tidak boleh kosong',
                               'matches' => 'Password tidak sama',
                               ]
                           ],
                       ];
                       if($this->validate($rules)){
                           $pwd = password_hash($this->request->getVar('pwd'),PASSWORD_DEFAULT);
                           if($this->M_user->updatePassword($token,$pwd)){
                            $session->setFlashdata('Succes', 'Password berhasil diubah');
                               return redirect()->to(base_url().'/login');
                           }
                           else{
                            $session->setFlashdata('Gagal', 'Password gagal diubah');
                               return redirect()->to(current_url());
                           }
                       }
                       else{
                           $data['validation'] = $this->validator;
                       }
                   }
                }
                else
                {
                    $data['error'] = 'Reset password link sudah expired.';
                }
            }
            else
            {
                $data['error'] = 'Gagal menemukan akun anda';
            }
        }
        else{
            $data['error'] = 'Sorry! Unauthourized access';
        }
        return view('reset_password',$data);
         
    }

    public function checkExpiryDate($time){
        $timeDiff = strtotime(date("Y-m-d h:i:s"))- strtotime($time);
        if($timeDiff < 900){
            return true;
        }
        else
        {
            return false;
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
} 