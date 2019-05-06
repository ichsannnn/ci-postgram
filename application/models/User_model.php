<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'users';

    public $id;
    public $nama;
    public $username;
    public $password;
    public $email;
    public $foto = 'avatar.png';

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '%s harus diisi!'
                ]
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|min_length[6]|is_unique[users.username]',
                'errors' => [
                    'required' => '%s harus diisi!',
                    'min_length' => '%s minimal 6 karakter!',
                    'is_unique' => '%s tersebut sudah digunakan!'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '%s harus diisi!',
                    'min_length' => '%s minimal 6 karakter!'
                ]
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'is_unique[users.email]',
                'errors' => [
                    'min_length' => '%s tersebut sudah digunakan!'
                ]
                ]
                ];
            }

            public function register()
            {
                $user = $this->input->post();
                $this->id = uniqid();
                $this->nama = $user['nama'];
                $this->username = $user['username'];
                $this->password = md5($user['password']);

                $this->db->insert($this->table, $this);
            }

            public function find($username)
            {
                return $this->db->get_where($this->table, ['username' => $username])->row();
            }

            public function authenticate()
            {
                $post = $this->input->post();
                $username = $post['username'];
                $password = $post['password'];

                $this->db->select('id, nama, username');
                $this->db->where([
                'username' => $username,
                'password' => md5($password)
                ]);
                return $this->db->get($this->table)->row();
            }

            public function update()
            {
                $user = $this->input->post();
                $this->id = $user['id'];
                $this->nama = $user['nama'];
                $this->username = $user['username'];
                $this->password = md5($user['password']);
                $this->email = $user['email'];

                $this->db->update($this->table, $this, ['id' => $user['id']]);
            }
        }
