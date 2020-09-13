<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('general_model');
  }

  public function dashboard()
  {
    $this->load->view('template', $this->general_model->contentDashboard());
  }

  public function Logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }

  public function profile()
  {
    $this->load->view('template', $this->general_model->contentProfile());
  }

  public function template()
  {
    $this->load->view('template', $this->general_model->contentTemplate());
  }


  public function error()
  {
    $this->load->view('errors/404');
  }

}


 ?>
