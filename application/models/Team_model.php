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
    if ($this->session->userdata['roleId'] == 1)
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
    if ($this->session->userdata('role')=="admin") {
      $input = $this->input->post();
      $input['adminId'] = $this->session->userdata('id');
      $result = $this->core_model->createData('team',  $input);
      $this->core_model->updateData('user', 'id', $input['spvId'], 'teamId', $this->db->insert_id());
      return json_encode($result);
      // return json_encode($this->input->post());
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
    $data['member'] = $this->core_model->readSomeData('viewUser', 'teamId', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      $input = $this->input->post();
      $oldSpv = $this->core_model->readSingleData('team', 'id', $input['id']);
      $this->core_model->updateData('team', 'id', $input['id'], 'spvId', $input['spvId'] );
      $this->core_model->updateData('user', 'id', $oldSpv->id, 'roleId', 4 );
      $this->core_model->updateData('user', 'id', $input['id'], 'roleId', 2 );
      $result['content'] = "Data berhasil dirubah";
      return json_encode($result);
    }    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('team', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('team', 'id', $this->input->post('id')));
    }
    
  }




}

?>
