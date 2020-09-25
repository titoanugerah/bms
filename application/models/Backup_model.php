<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentBackup()
  {
      $data['viewName'] = 'operation/backup';
      return $data;
  }

  // public function create()
  // {
  //   if ($this->session->userdata('role')=="admin") {
  //     // return json_encode($this->core_model->createData('backup',  $this->input->post()));
  //     $input = $this->input->post();
  //     $input['adminId'] = $this->session->userdata('id');
  //     $result = $this->core_model->createData('backup',  $input);
  //     return json_encode($result);
  //   }
    
  // }

  public function read()
  {
//    $data['backup'] = $this->core_model->readAllData('viewBackupCheck');
    $query = 'select a.id, a.name as job, a.categoryId, c.name as category, a.adminId, d.name as admin, ifnull(count(b.id),0) as totalBackup, ifnull(g.currentBackup,0) as currentBackup, if(g.currentBackup = count(b.id), 1, 0) as hasFinishedBackup, a.isExist from 
              job	as a left join dataset as b on (a.id = b.jobId) inner join category as c on (a.categoryId = c.id) inner join user as d on (a.adminId = d.id) left join (SELECT b.id, count(a.id) as currentBackup FROM backup as a left join job as b
              on (a.jobId = b.id and if(b.categoryId <=2, date(a.date) = date(now()), week(a.date) = week(now())))group by b.id) as g on (a.id = g.id) group by a.id';
    $data['backup'] = ($this->db->query($query))->result();
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewJob', 'id', $this->input->post('id'));
    $query = 'select a.id, a.name as job, date(c.date) as date, c.cartridge,  time(c.startTime) as startTime,time(c.endTime) as endTime, count(b.id) as totalBackup, c.currentBackup from job as a left join dataset as b on (a.id = b.jobId) left join ( select a.id, b.date,
              min(b.date) as startTime, c.name as cartridge, max(b.date) as endTime, count(b.id) currentBackup from job as a left join backup as b on (a.id = b.jobId) left join cartridge as c on (b.cartridgeId = c.id) group by a.id, b.date) as c on (a.id = c.id) where a.id='.$this->input->post('id').' group by a.id, c.date';
    $data['history'] = ($this->db->query($query))->result();
    return json_encode($data);
  }

  public function readHistoryDetail()
  {
    $convertedDate = date_parse_from_format('Ymd', $this->input->post('date'));
    $date = $convertedDate['year'].'-'.$convertedDate['month'].'-'.$convertedDate['day'];
    $query = 'select * from viewBackup where date(date) = "'.$date.'" and jobId = '.$this->input->post('id');
    $data = ($this->db->query($query))->result();
    return json_encode($data);
  }

  public function update()
  {
    $status;
    if ($this->session->userdata('role')=="supervisor") {
      foreach ($this->input->post('listBackupJob') as $item) {
        $where = array(
          'jobId' => $item['jobId'],
          'datasetId' => $item['datasetId'],
          'date' => date("Y-m-d")          
        );
        $data = array(
          'jobId' => $item['jobId'],
          'datasetId' => $item['datasetId'],
          'cartridgeId' => $item['cartridgeId'],
          'userId' => $this->session->userdata('id'),          
          'date' => date("Y-m-d H:i:s"),          
          'remark' => $item['remark']
        );
        $this->db->delete('backup', $where);
        $status = $this->core_model->createData('backup', $data);
      }
    }    
    return json_encode($status);
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('backup', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('backup', 'id', $this->input->post('id')));
    }
    
  }




}

?>
