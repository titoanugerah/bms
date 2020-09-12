<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('master_model');
  }

  public function department()
  {
    $this->load->view('template', $this->master_model->contentDepartment());
  }

  #AJAX
  public function getDepartment()
  {
    echo $this->master_model->getDepartment();
  }

  public function getSelectedDepartment()
  {
    echo $this->master_model->getSelectedDepartment($this->input->post());
  }

  public function addDepartment()
  {
    echo $this->master_model->addDepartment($this->input->post());
  }

  public function deleteDepartment()
  {
    echo $this->master_model->deleteDepartment();
  }

  public function recoverDepartment()
  {
    echo $this->master_model->recoverDepartment();
  }

  public function updateDepartment()
  {
    echo $this->master_model->updateDepartment($this->input->post());
  }


}

 ?>
