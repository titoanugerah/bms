<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartridge extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('cartridge_model');
  }

  public function index(){
    $this->load->view('template', $this->cartridge_model->contentCartridge());
  }


  #API
  public function read()
  {
    echo $this->cartridge_model->read();
  }

  public function readDetail()
  {
    echo $this->cartridge_model->readDetail();
  }

  public function recover()
  {
    echo $this->cartridge_model->recover();
  }

  public function create()
  {
    echo $this->cartridge_model->create();
  }

  public function update()
  {
    echo $this->cartridge_model->update();
  }

  public function delete()
  {
    echo $this->cartridge_model->delete();
  }

}

 ?>
