<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Comment_model extends CI_Model
{
  private $table = 'comments';

  public $id;
  public $user_id;
  public $post_id;
  public $comment;
  public $timestamp;

  public function save()
  {
    $comment = $this->input->post();
    $this->id = uniqid();
    $this->user_id = $this->session->user_id;
    $this->post_id = $comment['post_id'];
    $this->comment = $comment['comment'];
    $this->timestamp = time();
    $this->db->insert($this->table, $this);

    return $comment['post_id'];
  }

  public function findByPost($post_id)
  {
    $this->db->select('username, comment');
    $this->db->join('users', 'users.id = comments.user_id');
    $this->db->join('posts', 'posts.id = comments.post_id');
    $this->db->where('posts.id', $post_id);
    return $this->db->get($this->table)->result();
  }
}
