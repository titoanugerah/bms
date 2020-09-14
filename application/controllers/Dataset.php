<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataset extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('dataset_model');
  }

  public function index(){
    $this->load->view('template', $this->dataset_model->contentDataset());
  }


  #API
  public function read()
  {
    echo $this->dataset_model->read();
  }

  public function readDetail()
  {
    echo $this->dataset_model->readDetail();
  }

  public function recover()
  {
    echo $this->dataset_model->recover();
  }

  public function create()
  {
    echo $this->dataset_model->create();
  }

  public function update()
  {
    echo $this->dataset_model->update();
  }

  public function delete()
  {
    echo $this->dataset_model->delete();
  }

}

 ?>
