<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('user_model');
  }

  public function index(){
    $this->load->view('template', $this->user_model->contentUser());
  }


  #API
  public function read()
  {
    echo $this->user_model->read();
  }

  public function readDetail()
  {
    echo $this->user_model->readDetail();
  }

  public function recover()
  {
    echo $this->user_model->recover();
  }

  public function create()
  {
    echo $this->user_model->create();
  }

  public function update()
  {
    echo $this->user_model->update();
  }

  public function delete()
  {
    echo $this->user_model->delete();
  }

}

 ?>
