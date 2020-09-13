<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('team_model');
  }

  public function index(){
    $this->load->view('template', $this->team_model->contentTeam());
  }


  #API
  public function read()
  {
    echo $this->team_model->read();
  }

  public function readDetail()
  {
    echo $this->team_model->readDetail();
  }

  public function recover()
  {
    echo $this->team_model->recover();
  }

  public function create()
  {
    echo $this->team_model->create();
  }

  public function update()
  {
    echo $this->team_model->update();
  }

  public function delete()
  {
    echo $this->team_model->delete();
  }

}

 ?>
