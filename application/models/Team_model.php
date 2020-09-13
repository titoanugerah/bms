<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentTeam()
  {
    if ($this->session->teamdata['roleId'] == 1)
    {
      $data['viewName'] = 'master/team';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function create()
  {
    if ($this->session->teamdata('role')=="admin") {
      return json_encode($this->core_model->createData('team',  $this->input->post()));
    }
    
  }
  public function read()
  {
    $data['team'] = $this->core_model->readAllData('viewTeam');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewTeam', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->teamdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('team',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->teamdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('team', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->teamdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('team', 'id', $this->input->post('id')));
    }
    
  }




}

?>
