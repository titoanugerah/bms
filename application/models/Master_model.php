<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentDepartment()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    if ($this->session->userdata['RoleId'] == 1)
    {
      $data['viewName'] = 'master/department';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }


  public function getDepartment()
  {
    $data['department'] = $this->core_model->getAllData('Department');
    return json_encode($data);
  }

  public function getSelectedDepartment($input)
  {
    $data['member'] = $this->core_model->getSomeData('ViewMember', 'DepartmentId', $input['Id']);
    $data['employee'] = $this->core_model->getAllData('ViewMember');
    $data['detail'] = $this->core_model->getSingleData('Department', 'Id', $input['Id']);
    $data['generalmanager'] = $this->core_model->getSomeData('User', 'RoleId', 6);
    return json_encode($data);
  }

  public function updateDepartment($input)
  {
    if ($this->session->userdata['RoleId'] == 1)
    {
      $where = array('Id' => $input['Id'] );
      $data = array(
      'Name' => $input['Name'],
      'Description' => $input['Description']
      );
      $this->db->where($where);
      $this->db->update('Department', $data);
      $data['title'] = "Berhasil";
      $data['content'] = "Update departemen berhasil dilakukan";
      $data['status'] = "success";
    }
    else
    {
      $data['title'] = "Gagal";
      $data['content'] = "Update departemen gagal dilakukan, anda tidak memiliki hak akses untuk melakukan proses ini";
      $data['status'] = "danger";
    }
    return json_encode($data);
  }

  public function addDepartment($input)
  {
    if ($this->session->userdata['RoleId'] == 1)
    {
      $data = array(
      'Name' => $input['Name'],
      'Description' => $input['Description'],
      );
      $this->db->insert('Department', $data);
      $data['title'] = "Berhasil";
      $data['content'] = "Update departemen berhasil dilakukan";
      $data['status'] = "success";
    }
    else
    {
      $data['title'] = "Gagal";
      $data['content'] = "Update departemen gagal dilakukan, anda tidak memiliki hak akses untuk melakukan proses ini";
      $data['status'] = "danger";
    }
    return json_encode($data);
  }

  public function deleteDepartment()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Department', $data = array('IsExist' => 0 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penghapusan data berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    }
  }

  public function recoverDepartment()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Department', $data = array('IsExist' => 1 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Pemulihan data berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    }
  }

}

?>
