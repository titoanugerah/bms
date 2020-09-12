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

  public function contentEmployee()
  {
    if ($this->session->userdata['RoleId'] == 1 || $this->session->userdata['RoleId'] == 4)
    {
      $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
      $data['viewName'] = 'master/employee';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function contentModel()
  {
    if ($this->session->userdata['RoleId'] == 1|| $this->session->userdata['RoleId'] == 4 )
    {
      $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
      $data['viewName'] = 'master/model';
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

  public function getEmployee()
  {
    if ($this->session->userdata['RoleId'] == 4)
    {
      $data['employee'] = $this->core_model->getSomeData('ViewMember',  'DepartmentId', $this->session->userdata('DepartmentId'));
    }
    else
    {
      $data['employee'] = $this->core_model->getAllData('ViewMember');
    }
    return json_encode($data);
  }

  public function addEmployee()
  {
    if ($this->session->userdata['RoleId'] == 1 || $this->session->userdata['RoleId'] == 4) {
      if ($this->core_model->getNumRows('User', 'Email', $this->input->post('Email'))>0) {
        $this->core_model->updateData('User','Email', $this->input->post('Email'), 'IsExist', 1);
        $result['icon'] = "fas fa-user";
        $result['title'] = "Peringatan";
        $result['content'] = "Pengguna sebelumnya sudah ada, berhasil memulihkan";
        $result['status'] = "info";

      } else {
        $data = array(
        'Email' => $this->input->post('Email'),
        'Ext' => $this->input->post('Ext'),
        'RoleId' => $this->input->post('RoleId'),
        'DepartmentId' => $this->input->post('DepartmentId'),
        'IsExist' => 1,
        );
        $this->db->insert('User', $data);
        $result['icon'] = "fas fa-user";
        $result['title'] = "Berhasil";
        $result['content'] = "Penambahan Pengguna berhasil dilakukan";
        $result['status'] = "success";
      }

    } else {
      $result['icon'] = "fas fa-user";
      $result['title'] = "Gagal";
      $result['content'] = "Penambahan Pengguna berhasil gagal dilakukan, anda tidak memiliki hak akses";
      $result['status'] = "danger";
      http_response_code(403);

    }
    return json_encode($result);
  }



  public function getDetailEmployee()
  {
    $result['detail'] = $this->core_model->getSingleData('ViewMember', 'Id', $this->input->post('Id'));
    $result['role'] = $this->core_model->getAllData('Role');
    $result['department'] = $this->core_model->getAllData('Department');
    return json_encode($result);
  }

  public function contentItem()
  {
    if ($this->session->userdata['RoleId'] == 1)
    {
      $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
      $data['viewName'] = 'master/item';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function getDetailItem()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $result['detail'] = $this->core_model->getSingleData('Item', 'Id', $this->input->post('Id'));
      return json_encode($result);
    } else {
      $result['status'] = http_response_code('401');
      return json_encode($result);
    }

  }

  public function recoverEmployee()
  {
    if ($this->session->userdata['RoleId']==1) {
      $this->core_model->updateData('User','Id', $this->input->post('Id'),'IsExist',1);
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Perubahan akun berhasil dilakukan";
      $result['status'] = "success";
    } else {
      $result['icon'] = "fas fa-times";
      $result['title'] = "Gagal";
      $result['content'] = "Perubahan akun gagal dilakukan";
      $result['status'] = "danger";
    }
    return json_encode($result);
  }

  public function deleteEmployee()
  {
    if ($this->session->userdata['RoleId']==1) {
      $this->core_model->updateData('User','Id', $this->input->post('Id'),'IsExist',0);
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Hapus akun berhasil dilakukan";
      $result['status'] = "success";
    } else {
      $result['icon'] = "fas fa-times";
      $result['title'] = "Gagal";
      $result['content'] = "Hapus akun gagal dilakukan";
      $result['status'] = "danger";
    }
    return json_encode($result);
  }

  public function updateEmployee()
  {
    $input = $this->input->post();
    $data = array(
      'DepartmentId' => $input['DepartmentId'],
      'RoleId' => $input['RoleId'],
      'Email' => $input['Email'],
      'Ext' => $input['Ext']
     );
     $this->core_model->updateSomeData('User', 'Id', $input['Id'], $data);
    $result['icon'] = "fas fa-check";
    $result['title'] = "Berhasil";
    $result['content'] = "Perubahan akun berhasil dilakukan";
    $result['status'] = "success";
    return json_encode($result);
  }

  public function getItem()
  {
    $data['item'] = $this->core_model->getAllData('Item');
    return json_encode($data);
  }

  public function addItem()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $data = array(
      'Name' => $this->input->post('Name'),
      'Remark' => $this->input->post('Remark'),
      );
      $this->db->insert('Item', $data);
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penambahan jenis perangkat berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function recoverItem()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Item', $data = array('IsExist' => 1 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Pemulihan jenis perangkat berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function deleteItem()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Item', $data = array('IsExist' => 0 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penghapusan jenis perangkat berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function updateItem()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $data = array(
      'Name' => $this->input->post('Name'),
      'Remark' => $this->input->post('Remark'),
      );
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Item', $data);
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Pembaruan jenis perangkat berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }

  }

  public function getModel()
  {
    $data['model'] = $this->core_model->getAllData('ViewModel');
    return json_encode($data);
  }

  public function addModel()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $data = array(
      'Name' => $this->input->post('Name'),
      'Remark' => $this->input->post('Remark'),
      'Description' => $this->input->post('Description'),
      'ItemId' => $this->input->post('ItemId'),
      'PICId' => $this->session->userdata('Id')
      );
      $this->db->insert('Model', $data);
      $result['id'] = $this->db->insert_id();
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penambahan model berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function recoverModel()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Model', $data = array('IsExist' => 1 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Pemulihan model berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function deleteModel()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Model', $data = array('IsExist' => 0 ));
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penghapusan model berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function getDetailModel()
  {
    $result['item'] = $this->core_model->getAllData('Item');
    if ($this->session->userdata['RoleId'] == 1|| $this->session->userdata['RoleId'] == 4 ) {
      $result['detail'] = $this->core_model->getSingleData('Model', 'Id', $this->input->post('Id'));
      return json_encode($result);
    } else {
      $result['status'] = http_response_code('401');
      return json_encode($result);
    }
  }

  public function updateModel()
  {
    if ($this->session->userdata['RoleId'] == 1) {
      $data = array(
      'Name' => $this->input->post('Name'),
      'Remark' => $this->input->post('Remark'),
      );
      $this->db->where($where = array('Id' => $this->input->post('Id')));
      $this->db->update('Model', $data);
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Perubahan model berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function getNewModel()
  {
    $data['item'] = $this->core_model->getAllData('Item');
    return json_encode($data);
  }

  public function getRole()
  {
    $result['role'] = $this->core_model->getAllData('Role');
    $result['session'] = $this->session->userdata();
    return json_encode($result);
  }

}

?>
