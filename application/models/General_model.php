<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class General_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
  }

  public function contentWelcome()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'welcome';
    $this->account();
    return $data;
  }

  public function contentTemplate()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'blank';
    return $data;
  }

  public function contentDashboard()
  {
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'dashboard';
    $this->account();
    return $data;
  }


  public function account()
  {
    require_once 'vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig('assets/client_credentials.json');
    $client->addScope("email");
    $client->addScope("profile");

    if (!$this->session->userdata('IsLogin'))
    {
      if (isset($_GET['code']))
      {
        $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
        $client->setAccessToken($token['access_token']);
        $validUser = (new Google_Service_Oauth2($client))->userinfo->get();
        $isRegisteredUser = $this->core_model->getNumRows('User', 'Email', $validUser->email);
        if ($isRegisteredUser)
        {
          $data = array(
            'Fullname' =>  $validUser->name,
            'Image' => $validUser->picture,
          );
          $this->core_model->updateSomeData('User', 'Email', $validUser->email, $data);
          $user = $this->core_model->getSingleData('ViewMember', 'Email', $validUser->email);
          if ($user->IsExist)
          {
            $userdata = array(
              'IsLogin' => true,
              'Id' => $user->Id,
              'Email' => $user->Email,
              'Fullname' => $user->Fullname,
              'Ext' => $user->Ext,
              'Image' => $user->Image,
              'RoleId' => $user->RoleId,
              'Role' => $user->Role,
              'DepartmentId' => $user->DepartmentId,
              'Department' => $user->Department,
              'IsExist' => $user->IsExist
            );
            $this->session->set_userdata($userdata);
            notify('Berhasil', 'Login berhasil, Selamat datang '.$this->session->userdata['Fullname'], 'success', 'fa fa-user','');
          }
          else
          {
            notify('Gagal', 'Akun anda sudah tidak aktif, silahkan hubungi Admin Department', 'danger', 'fa fa-user', '');
          }
        }
        else
        {
          notify('Gagal', 'Akun anda tidak terdaftar di sistem kami, silahkan hubungi Admin Department', 'danger', 'fa fa-user', '');
        }
      }
      else
      {
        try {
          $this->session->set_flashdata('link', $client->createAuthUrl());
        } catch (Exception $e) {
          return $e->getMessage();
        }
      }
    }
  }

  public function contentProfile()
  {
    //webconf = ambil setingan  website
    $data['webConf'] = $this->core_model->getSingleData('webConf', 'id', 1);
    $data['viewName'] = 'profile';
    return $data;
  }

}

 ?>
