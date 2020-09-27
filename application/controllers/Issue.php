<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('issue_model');
  }

  public function index(){
    $this->load->view('template', $this->issue_model->contentIssue());
  }


  #API
  public function read()
  {
    echo $this->issue_model->read();
  }

  public function readDetail()
  {
    echo $this->issue_model->readDetail();
  }

  public function recover()
  {
    echo $this->issue_model->recover();
  }

  public function create()
  {
    echo $this->issue_model->create();
  }

  public function update()
  {
    echo $this->issue_model->update();
  }

  public function delete()
  {
    echo $this->issue_model->delete();
  }

}

 ?>
