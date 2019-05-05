<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Post_model');
    $this->load->model('User_model');
    if (!$this->session->authenticated) show_404();
  }

  public function index()
  {
    $user_id = $this->session->user_id;
    $data['user'] = $this->User_model->find($this->session->user_username);
    $data['posts'] = $this->Post_model->findByUser($user_id);

    $this->load->view('profile/index', $data);
  }
}
