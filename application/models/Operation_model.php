<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operation_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
  }


  public function contentAsset()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'master/asset';
    return $data;
  }

  public function contentAssetApproval()
  {
    if ($this->session->userdata('Role')=="Manager" || $this->session->userdata('Role')=="GeneralManager")
    {
      $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
      $data['viewName'] = 'operation/assetApproval';
      return $data;
    }
    else
    {
      notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
    }
  }

  public function contentMyAsset()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'operation/myAsset';
    return $data;
  }

  public function contentAssetManagement()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'operation/assetManagement';
    return $data;
  }

  public function contentAssetRequest()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'operation/assetRequest';
    return $data;
  }

  public function contentDispossalRequest()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'operation/dispossalRequest';
    return $data;
  }

  #ajax
  public function getAsset()
  {
    // if($this->session->userdata('DepartmentId')==2){
    //   $data['asset'] = $this->core_model->getAllData('ViewAsset');
    // } else {
      $data['asset'] = $this->core_model->getSomeData('ViewAsset', 'DepartmentId', $this->session->userdata('DepartmentId'));
    // }
    return json_encode($data);
  }

  public function deleteAsset()
  {
    $lastLogId = $this->core_model->getSingleData('Asset', 'Id', $this->input->post('Id'))->LastLogId;
    $data = array(
    'AssetId' => $this->input->post('Id'),
    'Status' => $this->core_model->getSingleData('AssetLog', 'Id', $lastLogId)->Status,
    'Description' => $this->session->userdata['Fullname']." selaku ".$this->session->userdata['Role']." menghapus data asset ini ",
    'Remark' => "Update by ".$this->session->userdata('Id'),
    );
    $this->db->insert('AssetLog', $data);
    $where = array('Id' => $this->input->post('Id'));
    $data1 = array(
    'LastLogId' => $this->db->insert_id(),
    'IsExist' => 0
    );
    $this->db->where($where);
    $this->db->update('Asset', $data1);
    $result['title'] = "Berhasil";
    $result['content'] = "hapus asset berhasil dilakukan";
    $result['status'] = "success";
    return json_encode($result);

  }

  public function recoverAsset()
  {
    $lastLogId = $this->core_model->getSingleData('Asset', 'Id', $this->input->post('Id'))->LastLogId;
    $data = array(
    'AssetId' => $this->input->post('Id'),
    'Status' => $this->core_model->getSingleData('AssetLog', 'Id', $lastLogId)->Status,
    'Description' => $this->session->userdata['Fullname']." selaku ".$this->session->userdata['Role']." memulihkan data asset ini ",
    'Remark' => "Update by ".$this->session->userdata('Id'),
    );
    $this->db->insert('AssetLog', $data);
    $id = $this->db->insert_id();
    $where = array('Id' => $this->input->post('Id'));
    $data1 = array(
    'LastLogId' => $id,
    'IsExist' => 1
    );
    $this->db->where($where);
    $this->db->update('Asset', $data1);
    $result['title'] = "Berhasil";
    $result['content'] = "Pemulihan asset berhasil dilakukan";
    $result['status'] = "success";
    return json_encode($result);
  }

  public function addRequest()
  {
    if ($this->session->userdata('Role')=='PIC Asset') {
      for ($i=0; $i < $this->input->post('Qty') ; $i++) {
        $data = array(
        'UserId' => $this->session->userdata('Id'),
        'ItemId' => $this->input->post('ItemId'),
        'ModelExpectation' => $this->input->post('ModelExpectation'),
        'Purpose' => $this->input->post('Purpose'),
        'Remark' => $this->input->post('Remark'),
        'LastLogId' => 0,
        'IsExist' => 1,
        'UserName' => $this->input->post('UserName'),        
        );
        $this->db->insert('Request', $data);
        $id = $this->db->insert_id();
        $data = array(
          'RequestId' => $id,
          'Status' => 1,
          'Description' => $this->session->userdata('Fullname').' selaku '.$this->session->userdata('Role').' mengajukan permohonan asset',
          'Remark' => $this->session->userdata('Id'),
        );
        $this->db->insert('RequestLog', $data);
        $id = $this->db->insert_id();
        $this->core_model->updateData('Request', 'Id', $data['RequestId'], 'LastLogId', $id);
      }
      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penambahan data berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }

  public function addRequestTransferToISP()
  {
    if ($this->session->userdata('Role')=='PIC Asset') {

       $data = array(
         'RequestId' => $this->input->post('Id'),
         'Status' => 1,
         'Description' => $this->session->userdata('Fullname').' selaku '.$this->session->userdata('Role').' mengajukan permohonan pengembalian asset',
         'Remark' => $this->session->userdata('Id'),
       );
       $this->db->insert('RequestLog', $data);
       $id = $this->db->insert_id();

       $data = array(
         'Type' => 1,
         'LastLogId' => $id
        );

        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('Request', $data);

      $result['icon'] = "fas fa-check";
      $result['title'] = "Berhasil";
      $result['content'] = "Penambahan data berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);
    } else {
      return http_response_code(401);
    }
  }


  public function getDetailAsset()
  {
    $result['item'] = $this->core_model->getAllData('Item');
    $result['model'] = $this->core_model->getAllData('ViewModel');
    $result['detail'] = $this->core_model->getSingleData('ViewAsset', 'Id', $this->input->post('Id'));
    $result['log'] = $this->core_model->getSomeData('AssetLog', 'AssetId', $this->input->post('Id'));
    return json_encode($result);
  }

  public function updateAsset()
  {
    $lastLogId = $this->core_model->getSingleData('Asset', 'Id', $this->input->post('Id'))->LastLogId;
    $data = array(
    'AssetId' => $this->input->post('Id'),
    'Status' => $this->core_model->getSingleData('AssetLog', 'Id', $lastLogId)->Status,
    'Description' => $this->session->userdata['Fullname']." selaku ".$this->session->userdata['Role']." memperbarui data asset ini ",
    'Remark' => "Update by ".$this->session->userdata('Id'),
    );
    $this->db->insert('AssetLog', $data);
    $data1 = array(
    'SN' => $this->input->post('SN'),
    'ModelId' => $this->input->post('ModelId'),
    'Remark' => $this->input->post('Remark'),
    'LastLogId' => $this->db->insert_id()
    );
    $where = array('Id' => $this->input->post('Id'));
    $this->db->where($where);
    $this->db->update('Asset', $data1);
    $result['title'] = "Berhasil";
    $result['content'] = "Update asset berhasil dilakukan";
    $result['status'] = "success";
    // return $result;
    return json_encode($result);
  }

  public function getAssetApproval()
  {
    if ($this->session->userdata('Role')=='Manager') {
      $result['request'] = $this->core_model->getSomeData('ViewAsset', 'Status', 1);
    } else if ($this->session->userdata('Role')=='GeneralManager') {
      $result['request'] = $this->core_model->getSomeData('ViewAsset', 'Status', 3);
    }
    return json_encode($result);
  }


  public function requestDispossal()
  {
    $data1 = array(
      'AssetId' => $this->input->post('Id'),
      'Status' => 3,
      'Description' => $this->session->userdata('Fullname').' membuat permohonan untuk melakukan pemusnahan asset',
      'Remark' => 'Requested by '. $this->session->userdata('Id'),
     );
    $this->db->insert('AssetLog', $data1);
    $id = $this->db->insert_id();
    $this->core_model->updateData('Asset', 'Id', $this->input->post('Id'), 'LastLogId', $id);
    $this->core_model->updateData('Asset', 'Id', $this->input->post('Id'), 'Remark', $this->input->post('Remark'));
    return json_encode($data1);
  }

  public function registerAsset()
  {
    if ($this->session->userdata('Role')=='IT Asset') {
      $data1 = array(
        'LastLogId' => 0,
        'SN' => $this->input->post('SN'),
        'PO' => $this->input->post('PO'),
        'ModelId' => $this->input->post('ModelId'),
        'UserId' => $this->session->userdata('Id'),
        'PICId' => $this->session->userdata('Id')

      );
      $this->db->insert('Asset', $data1);
      $id =  $this->db->insert_id();
      $data = array(
      'AssetId' =>  $id,
      'Status' => 1,
      'Description' => $this->session->userdata('Fullname').' selaku '.$this->session->userdata('Role').' berhasil melakukan registrasi asset ini dengan Nomor Seri = '.$this->input->post('SN'),
      'Remark' => 'Registered by '.$this->session->userdata('Id')
      );
      $this->db->insert('AssetLog', $data);
      $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
      $result['title'] = "Berhasil";
      $result['content'] = "Registrasi asset berhasil dilakukan";
      $result['status'] = "success";
      return json_encode($result);

    } else {
      return http_response_code(403);
    }
  }

  public function getDetailRequest()
  {
    $result['detail'] = $this->core_model->getSingleData('ViewRequest', 'Id', $this->input->post('Id'));
    $result['item'] = $this->core_model->getAllData('Item');
    $result['model'] = $this->core_model->getAllData('ViewModel');
    $result['log'] = $this->core_model->getSomeData('RequestLog', 'RequestId', $this->input->post('Id'));
    return json_encode($result);
  }

  public function getAssetRequest()
  {
    if ($this->session->userdata['RoleId']<=3) {
      $result['request'] = $this->core_model->getAllData('ViewRequest');
    } else {
      $result['request'] = $this->core_model->getSomeData('ViewRequest', 'DepartmentId', $this->session->userdata('DepartmentId'));
    }
    $result['session'] = $this->session->userdata();
    return json_encode($result);
  }

  public function getDetailAssetRequest()
  {
    $result['detail'] = $this->core_model->getSingleData('ViewRequest', 'Id', $this->input->post('Id'));
    $result['item'] = $this->core_model->getAllData('Item');
    $result['model'] = $this->core_model->getAllData('ViewModel');
    $result['log'] = $this->core_model->getSomeData('RequestLog', 'RequestId', $this->input->post('Id'));
    return json_encode($result);
  }

  public function approveAssetRequest()
  {
    $id = $this->input->post('Id');
    $user = $this->session->userdata();
    $request = $this->core_model->getSingleData('ViewRequest', 'Id', $id);
    $result['title'] = "Berhasil";
    $result['content'] = "Permohonan asset berhasil disetujui";
    $result['status'] = "success";
      if ($request->Status==1 && $user['RoleId'] == 5) {
        $data = array(
        'RequestId' => $id,
        'Status' => 3,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==3 && $user['RoleId'] == 6) {
        $data = array(
        'RequestId' => $id,
        'Status' => 5,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      }  elseif ($request->Status==5 && $user['RoleId'] == 1  && $request->Type==1) {
        $data = array(
        'RequestId' => $id,
        'Status' => 7,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan pengembalian asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==7 && $user['RoleId'] == 2 ) {
        $data = array(
        'RequestId' => $id,
        'Status' => 9,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==9 && $user['RoleId'] == 3) {
        $data = array(
        'RequestId' => $id,
        'Status' => 11,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==11 && $request->Type==0 && $user['Id']==$request->UserId) {
        $data = array(
        'RequestId' => $id,
        'Status' => 12,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' telah menerima asset ',
        'Remark' => 'Received by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==11 && $request->Type==1 && $user['RoleId']== 1) {
        $data = array(
        'RequestId' => $id,
        'Status' => 12,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' telah menerima asset ',
        'Remark' => 'Received by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
        $data = array(
        'AssetId' => $request->AssetId,
        'Status' => 1,
        'Description' => 'Perangkat sudah dikembalikan ke ISP',
        'Remark' => 'Received by '.$user['Id']
        );
        $this->db->insert('AssetLog', $data);

        $this->core_model->updateData('Request', 'Id', $id, 'UserId', $this->session->userdata('Id'));
        $this->core_model->updateData('Asset', 'Id', $request->AssetId, 'UserId', $this->session->userdata('Id'));
      } else {
        $result['title'] = "Gagal";
        $result['content'] = "Permohonan asset gagal disetujui, anda tidak memiliki hak akses";
        $result['status'] = "danger";
      }
      return json_encode($result);

  }

  public function rejectAssetRequest()
  {
    $id = $this->input->post('Id');
    $user = $this->session->userdata();
    $request = $this->core_model->getSingleData('ViewRequest', 'Id', $id);
    $result['title'] = "Berhasil";
    $result['content'] = "Permohonan asset berhasil ditolak";
    $result['status'] = "success";
    try{
      if ($request->Status==1 && $user['Role'] == 'PIC Asset') {
        $data = array(
        'RequestId' => $id,
        'Status' => 2,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==3 && $user['Role'] == 'Manager') {
        $data = array(
        'RequestId' => $id,
        'Status' => 4,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==5 && $user['Role'] == 'GeneralManager') {
        $data = array(
        'RequestId' => $id,
        'Status' => 6,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==7 && $user['Role'] == 'IT Asset') {
        $data = array(
        'RequestId' => $id,
        'Status' => 8,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==9 && $user['Role'] == 'Manager' && $user['DepartmentId']==1) {
        $data = array(
        'RequestId' => $id,
        'Status' => 10,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==11 && $user['Role'] == 'GeneralManager' && $user['DepartmentId']==1) {
        $data = array(
        'RequestId' => $id,
        'Status' => 12,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' ,menolak permintaan asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==13 && $user['Id']==$request->UserId) {
        $data = array(
        'RequestId' => $id,
        'Status' => 14,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' telah menerima asset ',
        'Remark' => 'Rejected by '.$user['Id']
        );
        $this->db->insert('RequestLog', $data);
        $this->core_model->updateData('Request', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } else {
        $result['title'] = "Gagal";
        $result['content'] = "Permohonan asset gagal disetujui, anda tidak memiliki hak akses";
        $result['status'] = "danger";
      }
      return json_encode($result);
    } catch (exception $e) {
      $result['title'] = "Gagal";
      $result['content'] = "Permohonan asset gagal disetujui : ".$e->getMessage();
      $result['status'] = "danger";
      return json_encode($result);
    }
  }

  public function getAvailableAsset()
  {
//    $request = $this->core_model->getSingleData('ViewRequest', 'Id', $this->input->post('Id'));
    try {
     $result['asset'] = $this->core_model->getSomeData('ViewAsset', 'ModelId', $this->input->post('ModelId'));
    } catch (exception $e) {
      $result['title'] = "Gagal";
      $result['content'] = "Permohonan asset gagal disetujui : ".$e->getMessage();
      $result['status'] = "danger";
    }
    return json_encode($result);

  }

  public function getAvailableModel()
  {
    try {
     $detail = $this->core_model->getSingleData('ViewRequest', 'Id', $this->input->post('Id'));
     $result['model'] = ($this->db->query('SELECT ModelId, Description, Model, ModelImage, COUNT( Id ) AS Available FROM ViewAsset WHERE STATUS = 1 AND IsExist = 1 AND ItemId = '.$detail->ItemId.' GROUP BY ModelId'))->result();
     if ($detail->ModelExpectation==null) {
       $result['expectation'] = $detail->Description;
     } elseif ($detail->Remark==null) {
       $result['expectation'] = $detail->Model;
     } else {
       $result['expectation'] = $detail->Model.' atau produk lain yang memiliki spesifikasi '.$detail->Description;
     }
    } catch (exception $e) {
      $result['title'] = "Gagal";
      $result['content'] = "Permohonan asset gagal disetujui : ".$e->getMessage();
      $result['status'] = "danger";
    }
    return json_encode($result);
  }

  public function selectAssetRequest()
  {
    try {
      $user = $this->session->userdata();
      $asset = $this->core_model->getSingleData('ViewAsset', 'Id', $this->input->post('AssetId'));
      $request = $this->core_model->getSingleData('ViewRequest', 'Id', $this->input->post('RequestId'));
      $data = array(
        'RequestId' => $this->input->post('RequestId'),
        'Status' => 7,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' memilih perangkat '
        .$asset->Model.' dengan nomor seri '.$asset->SN,
        'Remark' => 'Selected by '.$user['Id']
      );
      $this->db->insert('RequestLog', $data);
      $lastLogId = $this->db->insert_id();
      $this->core_model->updateData('Request', 'Id', $this->input->post('RequestId'), 'LastLogId', $lastLogId);
      $this->core_model->updateData('Request', 'Id', $this->input->post('RequestId'), 'AssetId', $this->input->post('AssetId'));
      $this->core_model->updateData('Asset', 'Id', $this->input->post('AssetId'), 'UserId', $request->UserId);
      $this->core_model->updateData('Asset', 'Id', $this->input->post('AssetId'), 'PICId', $request->UserId);
      $data1 = array(
      'AssetId' => $this->input->post('AssetId'),
      'Status' => 2,
      'Description' => $user['Fullname'].' selaku '.$user['Role'].' memilih perangkat '.$asset->Model.' dengan nomor seri '.$asset->SN.' untuk transfer asset user '.$request->User,
      'Remark' => 'Selected by '.$user['Id']
      );
      $this->db->insert('AssetLog', $data1 );
      $this->core_model->updateData('Asset', 'Id', $this->input->post('AssetId'), 'LastLogId', $this->db->insert_id());
      $result['title'] = "Berhasil";
      $result['content'] = "Permohonan asset berhasil diproses";
      $result['status'] = "success";

    } catch (exception $e) {
      $result['title'] = "Gagal";
      $result['content'] = "Permohonan asset gagal disetujui : ".$e->getMessage();
      $result['status'] = "danger";
    }
    return json_encode($result);
  }

  public function getDispossalRequest()
  {
    $data = $this->db->query('select * from ViewAsset where Status >= 3');
    $result['request'] = $data->result();
    $result['session'] = $this->session->userdata();
    return json_encode($result);
  }

  public function approveDispossalRequest()
  {
    $id = $this->input->post('Id');
    $user = $this->session->userdata();
    $request = $this->core_model->getSingleData('ViewAsset', 'Id', $id);
    $result['title'] = "Berhasil";
    $result['content'] = "Permohonan asset berhasil disetujui";
    $result['status'] = "success";
      if ($request->Status==3 && $user['RoleId'] == 2) {
        $data = array(
        'AssetId' => $id,
        'Status' => 5,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan pemusnahan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('AssetLog', $data);
        $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==5 && $user['RoleId'] == 3) {
        $data = array(
          'AssetId' => $id,
          'Status' => 7,
          'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menyetujui permintaan pemusnahan asset ',
          'Remark' => 'Approved by '.$user['Id']
          );
          $this->db->insert('AssetLog', $data);
          $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
  
      } elseif ($request->Status==7 && $user['RoleId']== 1) {
        $data = array(
          'AssetId' => $id,
          'Status' => 8,
          'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' mengkonfirmasi  pemusnahan asset ',
          'Remark' => 'Approved by '.$user['Id']
          );
          $this->db->insert('AssetLog', $data);
          $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } else {
        $result['title'] = "Gagal";
        $result['content'] = "Permohonan asset gagal disetujui, anda tidak memiliki hak akses";
        $result['status'] = "danger";
      }
      return json_encode($result);
  }

  public function rejectDispossalRequest()
  {
    $id = $this->input->post('Id');
    $user = $this->session->userdata();
    $request = $this->core_model->getSingleData('ViewAsset', 'Id', $id);
    $result['title'] = "Berhasil";
    $result['content'] = "Pembatalan pemusnahan asset berhasil disetujui";
    $result['status'] = "success";
      if ($request->Status==3 && $user['RoleId'] == 2) {
        $data = array(
        'AssetId' => $id,
        'Status' => 4,
        'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan pemusnahan asset ',
        'Remark' => 'Approved by '.$user['Id']
        );
        $this->db->insert('AssetLog', $data);
        $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
      } elseif ($request->Status==5 && $user['RoleId'] == 3) {
        $data = array(
          'AssetId' => $id,
          'Status' => 6,
          'Description' => $user['Fullname'].' selaku '.$user['Role'].' dari departemen '.$user['Department'].' menolak permintaan pemusnahan asset ',
          'Remark' => 'Approved by '.$user['Id']
          );
          $this->db->insert('AssetLog', $data);
          $this->core_model->updateData('Asset', 'Id', $id, 'LastLogId', $this->db->insert_id());
  
      
      } else {
        $result['title'] = "Gagal";
        $result['content'] = "Permohonan asset gagal disetujui, anda tidak memiliki hak akses";
        $result['status'] = "danger";
      }
      return json_encode($result);
  }

}

?>
