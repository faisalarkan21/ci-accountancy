<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\M_dashboard;

class Profile extends Controller
{
    public $session;
    public $dModel;

    public function __construct()
    {
        helper("form");
        $this->dModel = new M_dashboard();
    }
    public function index()
    {
        $data = [];
        
        $uniid = session()->get('logged_user');
        
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        return view('profile_view', $data);
    }

    public function change_password()
    {
        $data = [];
        $session = session();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'opwd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Lama Harus diisi'
                    ]
                ],

                'npwd' => [
                    'rules' => 'required|min_length[6]|max_length[16]',
                    'errors' => [
                        'required' => 'Password Baru Harus diisi',
                        'min_length' => 'Password Minimal {param} Huruf',
                        'max_length' => 'Password Maksimal {param} Huruf'
                    ]
                ],

                'cnpwd' => [
                    'rules' => 'required|matches[npwd]',
                    'errors' => [
                        'required' => 'Ketik Ulang Password Harus diisi',
                        'min_length' => 'Password Minimal {param} Huruf',
                        'matches' => 'Password Tidak Sesuai'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $opwd = $this->request->getVar('opwd');
                $npwd = $this->request->getVar('npwd');
                if (password_verify($opwd, $data['userdata']->password)) {

                    $npwd = password_hash($this->request->getVar('npwd'), PASSWORD_DEFAULT);

                    if ($this->dModel->updatePassword($npwd, session()->get('logged_user'))) {
                        $session->setFlashdata('success', 'Password berhasil dirubah');
                        return redirect()->to(current_url());
                    } else {
                        $session->setFlashdata('error', 'Gagal mengganti password, silahkan coba lagi!', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    $session->setFlashdata('error', 'Password lama tidak cocok', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('profile_view', $data);
    }

    public function avatar()
    {
        $data = [];
        $session = session();
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'avatar' => [
                    'rules' => 'uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]',
                    'errors' => [
                        'uploaded' => 'Pilih foto profil terlebih dahulu',
                        'max_size' => 'Size foto terlalu besar',
                        'ext_in' => 'Format File tidak Sesuai',
                    ]
                ]
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('avatar');

                if ($file->move(FCPATH . 'public\profiles', $file->getRandomName())) {
                    $path = base_url() . '/public/profiles/' . $file->getName();
                    $status = $this->dModel->updateAvatar($path, session()->get('logged_user'));
                    if ($status == true) {
                        $session->setFlashdata('success', 'Profil Berhasil Diupload', 3);
                        return redirect()->to(current_url());
                    } else {
                        $session->setFlashdata('error', 'Gagal merubah profil', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    $session->setFlashdata('error', 'You have uploaded in valid file', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('profile_view', $data);
    }

    public function edit_profil()
    {
        $data = [];
        $data['validation'] = null;
        $data['userdata'] = $this->dModel->getLoggedInUserData(session()->get('logged_user'));
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi',
                    ]
                ],

                'nama_perusahaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama perusahaan harus diisi',
                    ]
                ],

                'no_telp' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Nomer telepon harus diisi',
                        'numeric' => 'Nomor telepon harus angka',
                    ]
                ],

                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Lama Harus diisi',

                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $userdata = [
                    'nama' => $this->request->getVar('nama', FILTER_SANITIZE_STRING),
                    'nama_perusahaan' => $this->request->getVar('nama_perusahaan', FILTER_SANITIZE_STRING),
                    'alamat' => $this->request->getVar('alamat', FILTER_SANITIZE_STRING),
                    'no_telp' => $this->request->getVar('no_telp', FILTER_SANITIZE_NUMBER_INT),
                ];
                if ($this->dModel->updateUserInfo($userdata, session()->get('logged_user'))) {
                    $session->setFlashdata('success', 'Profile berhasil diupdate', 3);
                    return redirect()->to(current_url());
                } else {
                    $session->setFlashdata('error', 'Maaf gagal mengupdate silahkan coba lagi', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('profile_view', $data);
    }

    public function logout()
    {
        $this->session->remove('userdata');
        $this->session->destroy();
        return redirect()->to(base_url() . '/login');
    }
}