<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('backup_model');
  }

  public function index(){
    $this->load->view('template', $this->backup_model->contentBackup());
  }


  #API
  public function read()
  {
    echo $this->backup_model->read();
  }

  public function readDetail()
  {
    echo $this->backup_model->readDetail();
  }

  public function readHistoryDetail()
  {
    echo $this->backup_model->readHistoryDetail();
  }

  public function recover()
  {
    echo $this->backup_model->recover();
  }

  public function create()
  {
    echo $this->backup_model->create();
  }

  public function update()
  {
    echo $this->backup_model->update();
  }

  public function delete()
  {
    echo $this->backup_model->delete();
  }

  public function download($id, $date)
  {
    $this->backup_model->download($id,$date);  
  }

}

 ?>
