<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentUser()
  {
    if ($this->session->userdata['roleId'] == 1)
    {
      $data['viewName'] = 'master/user';
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
      if($this->input->post('roleId')!=0){
        $data = $this->input->post();
        $data['adminId'] = $this->session->userdata('id');
        return json_encode($this->core_model->createData('user', $data));
      } else {
        return http_response_code(500, $result);
      }
    }
    
  }
  public function read()
  {
    $data['user'] = $this->core_model->readAllData('viewUser');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewUser', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('user',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('user', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('user', 'id', $this->input->post('id')));
    }
    
  }




}

?>
