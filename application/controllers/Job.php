<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('job_model');
  }

  public function index(){
    $this->load->view('template', $this->job_model->contentJob());
  }


  #API
  public function read()
  {
    echo $this->job_model->read();
  }

  public function readDetail()
  {
    echo $this->job_model->readDetail();
  }

  public function recover()
  {
    echo $this->job_model->recover();
  }

  public function create()
  {
    echo $this->job_model->create();
  }

  public function update()
  {
    echo $this->job_model->update();
  }

  public function delete()
  {
    echo $this->job_model->delete();
  }

}

 ?>
