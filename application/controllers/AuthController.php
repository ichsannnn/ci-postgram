<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class AuthController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->library('form_validation');
  }

  public function login()
  {
    if ($this->session->authenticated) redirect(site_url('/'));

    $rules = [
      [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required',
        'errors' => [
          'required' => '%s harus diisi!'
        ]
      ],
      [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required',
        'errors' => [
          'required' => '%s harus diisi!'
        ]
      ]
    ];
    $user = $this->User_model;
    $validation = $this->form_validation;
    $validation->set_rules($rules);

    if ($validation->run()) {
      $user = $this->User_model->authenticate();
      if ($user) {
        $login_data = [
          'authenticated' => 1,
          'user_id' => $user->id,
          'user_name' => $user->nama,
          'user_username' => $user->username
        ];
        $this->session->set_userdata($login_data);
        redirect(site_url('/'));
      } else {
        $this->session->set_flashdata('error', 'Username atau Password salah!');
      }
    }
    $this->load->view('auth/login');
  }

  public function register()
  {
    if ($this->session->authenticated) redirect(site_url('/'));

    $user = $this->User_model;
    $validation = $this->form_validation;
    $validation->set_rules($user->rules());

    if ($validation->run()) {
      $this->User_model->register();

      $user = $this->User_model->authenticate();
      if ($user) {
        $login_data = [
          'authenticated' => 1,
          'user_id' => $user->id,
          'user_name' => $user->nama,
          'user_username' => $user->username
        ];
        $this->session->set_userdata($login_data);

        // buat folder foto user
        $username = $this->session->user_username;
        $upload_path = './assets/images/' . $username;

        if (!is_dir($upload_path)) {
          mkdir($upload_path);
          mkdir($upload_path . '/posts');
        }

        redirect(site_url('/'));
      }
    }

    $this->load->view('auth/register');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(site_url('/'));
  }
}
