<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class CommentController extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Comment_model');
  }

  public function post()
  {
    $post_comment = $this->Comment_model->save();
    redirect(site_url('post/' . $post_comment));
  }

}
