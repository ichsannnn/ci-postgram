<?php defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{
    private $table = 'posts';

    public $id;
    public $user_id;
    public $foto;
    public $caption;
    public $timestamps;

    public function rules()
    {
        return [
            [
                'field' => 'caption',
                'label' => 'Caption',
                'rules' => 'required'
            ]
        ];
    }

    public function all()
    {
        $this->db->select('posts.id, nama, username, posts.foto, caption, posts.timestamps');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->order_by('posts.timestamps', 'desc');
        // return $this->db->get($this->table)->result();
        return $this->db->get()->result();
    }

    public function find($id)
    {
        $this->db->select('posts.id, nama, username, posts.foto, caption, posts.timestamps');
        $this->db->join('users', 'users.id = posts.user_id');
        return $this->db->get_where($this->table, ['posts.id' => $id])->row();
    }

    public function findByUser($user_id)
    {
        $this->db->select('nama, username, posts.id, posts.foto, caption, posts.timestamps');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('posts.timestamps', 'desc');
        // return $this->db->get_where($this->table, ['user_id' => $user])->result();
        return $this->db->get($this->table)->result();
    }

    public function save($file_name)
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->user_id = $this->session->user_id;
        $this->foto = $file_name;
        $this->caption = $post['caption'];
        $this->timestamps = time();

        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        // $this->foto = $post['foto'];
        // $this->caption = $post['caption'];

        $this->db->where('id', $id);
        $this->db->update($this->table, ['caption' => $post['caption']]);
        // $this->db->update($this->table, $this, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
