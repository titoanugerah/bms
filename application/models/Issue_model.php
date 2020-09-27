<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentIssue()
  {
    $data['viewName'] = 'operation/issue';
    return $data;
  }

  public function create()
  {
    $input = $this->input->post();
    $input['userId'] = $this->session->userdata('id');
    $result = $this->core_model->createData('issue',  $input);
    $data['issueId'] = $this->db->insert_id();
    $data['status'] = 1;
    $data['log'] = $this->session->userdata('name').' menambahkan laporan masalah baru ';
    $result = $this->core_model->createData('issueLog',  $data);
    $this->core_model->updateData('issue', 'id', $data['issueId'],'lastLogId', $this->db->insert_id());
    return json_encode($result);    
  }
  public function read()
  {
    $data['issue'] = $this->core_model->readAllData('viewIssue');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewIssue', 'id', $this->input->post('id'));
    $data['log'] = $this->core_model->readSomeData('issueLog','issueId', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
      $data['issueId'] = $this->input->post('issueId');
      $data['status'] = $this->input->post('status');
      
      $status = $data['status'];
      $data['userId'] = $this->session->userdata('id');
      if($status == 1){
        $data['log'] = $this->session->userdata('name').' menambahkan laporan masalah baru ';
        $this->core_model->updateData('issue', 'id', $data['issueId'],'detail', $this->input->post('remark'));
      } else if($status == 2){
        $data['log'] = $this->session->userdata('name').' selesai melakukan analisa masalah yaitu '.$this->input->post('remark');
        $this->core_model->updateData('issue', 'id', $data['issueId'],'rootcause', $this->input->post('remark'));
      } else if($status == 3){
        $data['log'] = $this->session->userdata('name').' selesai melakukan analisa tindakan yaitu '.$this->input->post('remark');
        $this->core_model->updateData('issue', 'id', $data['issueId'],'countermeasure', $this->input->post('remark'));
      } else if($status == 4){
        $data['log'] = $this->session->userdata('name').' melakukan pemecahan masalah secara sementara yaitu '.$this->input->post('remark');
        $this->core_model->updateData('issue', 'id', $data['issueId'],'countermeasure', $this->input->post('remark'));
      } else if($status == 4){
        $data['log'] = $this->session->userdata('name').' melakukan pemecahan masalah secara permanen yaitu '.$this->input->post('remark');
        $this->core_model->updateData('issue', 'id', $data['issueId'],'countermeasure', $this->input->post('remark'));
      }
      $result =  json_encode($this->core_model->createData('issueLog', $data));    
      $this->core_model->updateData('issue', 'id', $data['issueId'],'lastLogId', $this->db->insert_id());
      return $result;
    }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('issue', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    $issue = $this->core_model->readSingleData('viewIssue', 'id', $this->input->post('id'));
    if ($this->session->userdata('id')==$issue->userId && ($issue->status == 1 || $issue->status == null)) {
      $this->core_model->forceDeleteData('issueLog', 'issueId', $this->input->post('id'));
      return json_encode($this->core_model->forceDeleteData('issue', 'id', $this->input->post('id')));
    } else {
      return http_response_code(403);
    }
    
  }




}

?>
