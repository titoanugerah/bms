<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentRole()
  {
    if ($this->session->userdata['roleId'] == 1)
    {
      $data['viewName'] = 'master/role';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function create()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->createData('role',  $this->input->post()));
    }
    
  }

  public function read()
  {
    $data['role'] = $this->core_model->getAllData('role');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->getSingleData('role', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('role',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('role', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('role', 'id', $this->input->post('id')));
    }
    
  }




}

?>
