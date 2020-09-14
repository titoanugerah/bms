<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('category_model');
  }

  public function index(){
    $this->load->view('template', $this->category_model->contentCategory());
  }


  #API
  public function read()
  {
    echo $this->category_model->read();
  }

  public function readDetail()
  {
    echo $this->category_model->readDetail();
  }

  public function recover()
  {
    echo $this->category_model->recover();
  }

  public function create()
  {
    echo $this->category_model->create();
  }

  public function update()
  {
    echo $this->category_model->update();
  }

  public function delete()
  {
    echo $this->category_model->delete();
  }

}

 ?>
