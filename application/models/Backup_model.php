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

  public function download($id,$date)
  {
    //CREATE NEW EXCEL OBJECT
    $this->load->library('Excel');
    $objPHPExcel = new PHPExcel();

    //INFO AND DETAILS
    $objPHPExcel->getProperties()
    ->setCreator("Risman Maulidi Ahmad")
    ->setLastModifiedBy("Risman Maulidi Ahmad")
    ->setTitle("BMS Reporting")
    ->setSubject('Backup Monitoring System')
    ->setDescription("Backup Monitoring System")
    ->setKeywords("BMS")
    ->setCategory("private");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'Job' )
    ->setCellValue('C1', 'Cartridge' )
    ->setCellValue('D1', 'Remark' )
    ->setCellValue('E1', 'Dataset' )
    ->setCellValue('F1', 'Tanggal')
    ->setCellValue('G1', 'Record')
    ->setCellValue('H1', 'Operator')
    ;

    $row = 2;  $i=1; $job; $currentJob=""; $currentCartridge="";
    // $query = 'select * from view_request where date="'.$date.'" and location_id = '.$location_id;
    // $requests = ($this->db->query($query))->result();

    //GET DATA
    $query = 'select * from viewBackup where date(date) = "'.$date.'" and jobId = '.$id;
    $histories = ($this->db->query($query))->result();
    
    foreach ($histories as $history) : 
      $lastRow = $row-1;


      //SET VALUE
      $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A'.$row, $i)
      ->setCellValue('E'.$row, $history->dataset)
      ->setCellValue('F'.$row, $history->date)
      ->setCellValue('G'.$row, $history->remark)
      ->setCellValue('H'.$row, $history->user);


      if($history->job != $currentJob){
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$row, $history->job);  
        $currentJob = $history->job;
      } else {
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$lastRow.':B'.$row);
      }

      if($history->cartridge != $currentCartridge){
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C'.$row, $history->cartridge);  
        $currentCartridge = $history->cartridge;
      } else {
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$lastRow.':C'.$row);
      }


      $row++;
      $i++;
      $job=$history->job;
    endforeach;
    $objPHPExcel->getActiveSheet()->setTitle('Backup History');
    //FORMATING

    // $objPHPExcel->getActiveSheet()->getStyle("A1:I".$row)   
    //   ->getBorders()
    //   ->getLeft()
    //   ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    // $objPHPExcel->getActiveSheet()->getStyle("A1:I".$row)   
    //   ->getBorders()
    //   ->getRight()
    //   ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    // $objPHPExcel->getActiveSheet()->getStyle("A1:I".$row)   
    //   ->getBorders()
    //   ->getTop()
    //   ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    // $objPHPExcel->getActiveSheet()->getStyle("A1:I".$row)   
    //   ->getBorders()
    //   ->getBottom()
    //   ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $border_style= array('borders' => array(
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
    ));

    foreach($range = array('H','G','F','E','D','C','B','A') as $columnID) {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
        for ($j=0; $j < $row; $j++) { 
          $objPHPExcel->getActiveSheet()->getStyle($columnID.$j)->applyFromArray($border_style);
        }
    }


    $filename = "BMS_".$job;
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=".$filename.".xls");
    header('Cache-Control: max-age=0');
    header ('Expires: Mon, 20 Dec 2020 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    return true;

  }




}

?>
