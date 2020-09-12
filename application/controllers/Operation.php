<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('master_model');
    $this->load->model('operation_model');
  }

  public function asset()
  {
    $this->load->view('template', $this->operation_model->contentAsset());
  }

  public function assetApproval()
  {
    $this->load->view('template', $this->operation_model->contentAssetApproval());
  }

  public function myAsset()
  {
    $this->load->view('template', $this->operation_model->contentMyAsset());
  }

  public function assetRequest()
  {
    $this->load->view('template', $this->operation_model->contentAssetRequest());
  }

  public function dispossalRequest()
  {
    $this->load->view('template', $this->operation_model->contentDispossalRequest());
  }

  #AJAX
  public function getAsset()
  {
    echo $this->operation_model->getAsset();
  }

  public function addAssetRequest()
  {
    echo $this->operation_model->addAssetRequest();
  }

  public function getDetailAsset()
  {
    echo $this->operation_model->getDetailAsset();
  }

  public function updateAsset()
  {
    echo $this->operation_model->updateAsset();
  }

  public function deleteAsset()
  {
    echo $this->operation_model->deleteAsset();
  }

  public function recoverAsset()
  {
    echo $this->operation_model->recoverAsset();
  }

  public function getAssetApproval()
  {
    echo $this->operation_model->getAssetApproval();
  }

  public function approveRequest()
  {
    echo $this->operation_model->approveRequest($this->input->post('Id'));
  }

  public function approveAllRequest()
  {
    echo $this->operation_model->approveAllRequest();
  }

  public function getApprovedAsset()
  {
    echo $this->operation_model->getApprovedAsset();
  }

  public function registerAsset()
  {
    echo $this->operation_model->registerAsset();
  }

  public function getMyAsset()
  {
    echo $this->operation_model->getMyAsset();
  }

  public function addRequest()
  {
    echo $this->operation_model->addRequest();
  }

  public function getDetailRequest()
  {
    echo $this->operation_model->getDetailRequest();
  }

  public function getAssetRequest()
  {
    echo $this->operation_model->getAssetRequest();
  }

  public function getDetailAssetRequest()
  {
    echo $this->operation_model->getDetailAssetRequest();
  }


  public function approveAssetRequest()
  {
    echo $this->operation_model->approveAssetRequest();
  }

  public function rejectAssetRequest()
  {
    echo $this->operation_model->rejectAssetRequest();
  }

  public function getAvailableAsset()
  {
   echo $this->operation_model->getAvailableAsset();
  }

  public function getAvailableModel()
  {
    echo $this->operation_model->getAvailableModel();
  }

  public function selectAssetRequest()
  {
    echo $this->operation_model->selectAssetRequest();
  }

  public function addRequestTransferToISP()
  {
    echo $this->operation_model->addRequestTransferToISP();
  }

  public function requestDispossal()
  {
    echo $this->operation_model->requestDispossal();
  }

  public function getDispossalRequest()
  {
    echo $this->operation_model->getDispossalRequest();
  }

  public function approveDispossalRequest()
  {
    echo $this->operation_model->approveDispossalRequest();
  }

  public function rejectDispossalRequest()
  {
    echo $this->operation_model->rejectDispossalRequest();
  }

}
 ?>
