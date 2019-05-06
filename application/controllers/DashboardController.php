<?php defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model');
    }

    public function index()
    {
        $data['posts'] = $this->Post_model->all();
        $this->load->view('dashboard/index', $data);
    }
}
