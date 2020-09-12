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


  public function employee()
  {
    $this->load->view('template', $this->master_model->contentEmployee());
  }

  public function item()
  {
    $this->load->view('template', $this->master_model->contentItem());
  }


  public function model()
  {
    $this->load->view('template', $this->master_model->contentModel());
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

  public function getEmployee()
  {
    echo $this->master_model->getEmployee();
  }

  public function addEmployee()
  {
    echo $this->master_model->addEmployee();
  }

  public function recoverEmployee()
  {
    echo $this->master_model->recoverEmployee();
  }

  public function deleteEmployee()
  {
    echo $this->master_model->deleteEmployee();
  }

  public function getDetailEmployee()
  {
    echo $this->master_model->getDetailEmployee();
  }

  public function updateEmployee()
  {
    echo $this->master_model->updateEmployee();
  }

  public function getItem()
  {
    echo $this->master_model->getItem();
  }

  public function getDetailItem()
  {
    echo $this->master_model->getDetailItem();
  }

  public function addItem()
  {
    echo $this->master_model->addItem();
  }

  public function recoverItem()
  {
    echo $this->master_model->recoverItem();
  }

  public function deleteItem()
  {
    echo $this->master_model->deleteItem();
  }

  public function updateItem()
  {
    echo $this->master_model->updateItem();
  }

  public function getModel()
  {
    echo $this->master_model->getModel();
  }

  public function getDetailModel()
  {
    echo $this->master_model->getDetailModel();
  }

  public function addModel()
  {
    echo $this->master_model->addModel();
  }

  public function recoverModel()
  {
    echo $this->master_model->recoverModel();
  }

  public function deleteModel()
  {
    echo $this->master_model->deleteModel();
  }

  public function updateModel()
  {
    echo $this->master_model->updateModel();
  }

  public function getNewModel()
  {
    echo $this->master_model->getNewModel();
  }

  public function uploadFile($type, $id)
  {
    echo $this->core_model->uploadFile($type, $id);
  }

  public function getRole()
  {
    echo $this->master_model->getRole();
  }




}

 ?>
