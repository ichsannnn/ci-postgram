<?php defined('BASEPATH') or exit('No direct script access allowed');

class PostController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model');
        $this->load->model('Comment_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        if (!$this->session->authenticated) show_404();
        $rules = [
            [
                'field' => 'caption',
                'label' => 'Caption',
                'rules' => 'required'
            ]
        ];

        $data['error'] = '';
        $post = $this->Post_model;
        $validation = $this->form_validation;
        $validation->set_rules($rules);

        if ($validation->run()) {
            $upload = $this->do_upload();
            if ($upload['success']) {
                $this->Post_model->save($upload['file_name']);
                redirect(site_url('profile'));
            } else {
                $data['error'] = $upload['message'];
            }
        }

        $this->load->view('post/create', $data);
    }

    public function view($id)
    {
        $data['post'] = $this->Post_model->find($id);
        $data['comments'] = $this->Comment_model->findByPost($id);
        $this->load->view('post/view', $data);
    }

    public function edit($id)
    {
        if (!$this->session->authenticated) show_404();
        $rules = [
        [
        'field' => 'caption',
        'label' => 'Caption',
        'rules' => 'required'
        ]
        ];

        $data['error'] = '';
        $post = $this->Post_model;
        $validation = $this->form_validation;
        $validation->set_rules($rules);

        if ($validation->run()) {
            // $upload = $this->do_upload();
            // if ($upload['success']) {
            $this->Post_model->update($id);
            // echo "string";
            // die();
            redirect(site_url('profile'));
            // } else {
            //   $data['error'] = $upload['message'];
            // }
        }

        $data['post'] = $this->Post_model->find($id);

        $this->load->view('post/edit', $data);
    }

    public function delete($id)
    {
        if (!$this->session->authenticated) show_404();

        if ($this->Post_model->delete($id)) {
            redirect('profile');
        }
    }

    public function do_upload()
    {
        $username = $this->session->user_username;
        $upload_path = './assets/images/' . $username . '/posts';

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
        $config['file_name'] = time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $data['success'] = 0;
            $data['message'] = $this->upload->display_errors();
            return $data;
        } else {
            $data['success'] = 1;
            $data['message'] = 'Berhasil';
            $data['file_name'] = $this->upload->data('file_name');
            return $data;
        }
    }
}
