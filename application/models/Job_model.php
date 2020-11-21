<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function contentJob()
  {
    if ($this->session->userdata['roleId'] == 1)
    {
      $data['viewName'] = 'master/job';
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
      // return json_encode($this->core_model->createData('job',  $this->input->post()));
      $input = $this->input->post();
      $input['adminId'] = $this->session->userdata('id');
      $result = $this->core_model->createData('job',  $input);
      return json_encode($result);
    }
    
  }
  public function read()
  {
    $data['job'] = $this->core_model->readAllData('viewJob');
    return json_encode($data);
  }

  public function readDetail()
  {
    $data['detail'] = $this->core_model->readSingleData('viewJob', 'id', $this->input->post('id'));
    return json_encode($data);
  }

  public function update()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->updateDataBatch('job',  'id', $this->input->post('id'), $this->input->post()));
    }
    
  }

  public function recover()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->recoverData('job', 'id', $this->input->post('id')));
    }
  }

  public function delete()
  {
    if ($this->session->userdata('role')=="admin") {
      return json_encode($this->core_model->deleteData('job', 'id', $this->input->post('id')));
    }
    
  }

  public function download()
  {
    //CREATE NEW EXCEL OBJECT
    $this->load->library('Excel');
    $objPHPExcel = new PHPExcel();

    //INFO AND DETAILS
    $objPHPExcel->getProperties()
    ->setCreator("Risman Maulidi Ahmad")
    ->setLastModifiedBy("Risman Maulidi Ahmad")
    ->setTitle("Job List")
    ->setSubject('Backup Monitoring System')
    ->setDescription("Backup Monitoring System")
    ->setKeywords("BMS")
    ->setCategory("private");

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'Job' )
    ->setCellValue('C1', 'Category' )
    ->setCellValue('D1', 'Create By' )
    ->setCellValue('E1', 'Status' )
    ;

    $jobs = $this->core_model->readAllData('viewJob');
    try{
      $row = 2; $i = $row-1;
      foreach ($jobs as $job) : 
        $lastRow = $row-1;
        $status = $job->isExist==1?"Active":"Inactive";

        //SET VALUE
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$row, $i)
        ->setCellValue('B'.$row, $job->name)
        ->setCellValue('C'.$row, $job->category)
        ->setCellValue('D'.$row, $job->admin)
        ->setCellValue('E'.$row, $status);

        $row++;
        $i++;
      endforeach;
    } catch (exception $error){
      echo "error";
    }

    $objPHPExcel->getActiveSheet()->setTitle('Job Recap');
    //FORMATING
    $border_style= array('borders' => array(
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '766f6e')),
    ));

    foreach($range = array('E','D','C','B','A') as $columnID) {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
        for ($j=0; $j < $row; $j++) { 
          $objPHPExcel->getActiveSheet()->getStyle($columnID.$j)->applyFromArray($border_style);
        }
    }

 

    $filename = "BMS_Job_recap";
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
