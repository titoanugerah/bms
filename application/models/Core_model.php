<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Core_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function readSingleData($table, $whereVar, $whereVal )
  {
    $data = $this->db->get_where($table, $where = array($whereVar => $whereVal ));
    return $data->row();
  }

  public function readSomeData($table, $whereVar, $whereVal )
  {
    $list = $this->db->list_fields($table);
    $keyword = $this->input->post('keyword');
    $likeQuery = "";
    foreach ($list as $item)
    {
      if ($item=='id') {
        
      } else {
        #$this->db->or_like($item, $this->input->post('keyword'));
        $likeQuery = $likeQuery .' '.$item.' LIKE "%'.$keyword.'%" or ';
      }
    }
    $query = 'SELECT * FROM '.$table.' where '.$whereVar.' = '.$whereVal.' and ('.rtrim($likeQuery, 'or ').')';
    $data = $this->db->query($query);
    #$data = $this->db->get_where($table, $where = array($whereVar => $whereVal));
    return $data->result();
  }

  public function readAllData($table)
  {
    $list = $this->db->list_fields($table);
    foreach ($list as $item)
    {
      $this->db->or_like($item, $this->input->post('keyword'));
    }
    $data = $this->db->get($table);
    return $data->result();
  }

  public function recoverData($table, $whereVar, $whereVal)
  {
    $result['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $data = array('isExist' => 1 );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dipulihkan";
    return $result;
  }

  public function updateDataBatch($table, $whereVar, $whereVal, $data)
  {
    $result['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dirubah";
    return $result;
  }

  public function createData($table, $data)
  {
    $result['isSuccess'] = $this->db->insert($table, $data);
    $result['content'] = "Data berhasil ditambahkan";
    return $result;
  }

  public function getNumRows($table, $whereVar, $whereVal )
  {
    // $list = $this->db->list_fields($table);
    // foreach ($list as $item)
    // {
    //   $this->db->or_like($item, $this->input->post('keyword'));
    // }
    // $data = $this->db->get($table);
    $data = $this->db->get_where($table, $where = array($whereVar => $whereVal ));
    return $data->num_rows();
  }

  public function get2SelectedData($table1, $table2, $whereVarTable1, $whereValTable1, $joinVarTable1, $joinVarTable2 )
  {
    $query = 'select * FROM '.$table1.' , '.$table2.' where '.$table1.'.'.$whereVarTable1.' = '.$whereValTable1.' and '.$table1.'.'.$joinVarTable1.' = '.$table2.'.'.$joinVarTable2;
    $data = $this->db->query($query);
    return $data->row();
  }

  public function get2SomeData($table1, $table2, $whereVarTable1, $whereValTable1, $joinVarTable1, $joinVarTable2 )
  {
    $query = 'select * FROM '.$table1.' , '.$table2.' where '.$table1.'.'.$whereVarTable1.' = '.$whereValTable1.' and '.$table1.'.'.$joinVarTable1.' = '.$table2.'.'.$joinVarTable2;
    $data = $this->db->query($query);
    return $data->result();
  }

  public function updateData($table, $whereVar, $whereVal, $setVar, $setVal)
  {
    $where = array($whereVar => $whereVal );
    $data = array($setVar => $setVal );
    $this->db->where($where);
    $this->db->update($table, $data);
    $result['content'] = "Data berhasil dirubah";
    return $result;
  }

  public function updateSomeData($table, $whereVar, $whereVal, $setArray)
  {
    $where = array($whereVar => $whereVal );
    $this->db->where($where);
    $this->db->update($table, $setArray);
  }


  public function deleteData($table, $whereVar, $whereVal)
  {
    $data['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $data = array('isExist' => 0 );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dihapus";
    return $result;
  }

  public function forceDeleteData($table, $whereVar, $whereVal)
  {
    $data['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $result['isSuccess'] =     $this->db->delete($table, $where);
    $result['content'] = "Data berhasil dihapus";
    return $result;
  }



  public function uploadFile($type,$id)
  {

    $filename = $type.'_'.$id;
    $config['upload_path'] =  APPPATH.'../assets/picture/';
    $config['overwrite'] = TRUE;
    $config['file_name']     =  str_replace(' ','_',$filename);
    $config['allowed_types'] = 'jpg|png|jpeg';
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('file')) {
      $upload['status']= 'danger';
      $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
    } else {
      $upload['status']= 'success';
      $upload['message'] = "File berhasil di upload";
      $upload['ext'] = $this->upload->data('file_ext');
      $upload['filename'] = $filename;
      $this->updateData($type, 'Id', $id, 'Image', $filename.$upload['ext']);
    }
    return json_encode($upload);
  }


}
 ?>
