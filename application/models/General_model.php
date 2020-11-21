<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class General_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    error_reporting(0);
  }

  public function contentWelcome()
  {
    $data['viewName'] = 'welcome';
    $this->account();
    return $data;
  }

  public function contentTemplate()
  {
    $data['viewName'] = 'blank';
    return $data;
  }

  public function contentDashboard()
  {
    $data['viewName'] = 'dashboard';
    if($this->session->userdata('isLogin')){
      if($this->session->userdata('roleId')==2){
        $data['performance'] = ($this->db->query('SELECT * FROM viewBackup where spvId = '.$this->session->userdata['id']))->result();
      }
    }
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

    if (!$this->session->userdata('isLogin'))
    {
      if (isset($_GET['code']))
      {
        $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
        $client->setAccessToken($token['access_token']);
        $validUser = (new Google_Service_Oauth2($client))->userinfo->get();
        $isRegisteredUser = $this->core_model->getNumRows('user', 'email', $validUser->email);
        if ($isRegisteredUser)
        {
          $data = array(
            'name' =>  $validUser->name,
            'image' => $validUser->picture,
          );
          $this->core_model->updateSomeData('user', 'email', $validUser->email, $data);
          $user = $this->core_model->readSingleData('viewUser', 'email', $validUser->email);
          if ($user->isExist)
          {
            $userdata = array(
              'isLogin' => true,
              'id' => $user->id,
              'email' => $user->email,
              'name' => $user->name,
              'image' => $user->image,
              'roleId' => $user->roleId,
              'role' => $user->role,
              'teamId' => $user->teamId,
              'spvId' => $user->spvId,              
              'supervisor' => $user->supervisor,
              'adminId' => $user->adminId,
              'isExist' => $user->isExist
            );
            $this->session->set_userdata($userdata);
            notify('Berhasil', 'Login berhasil, Selamat datang '.$this->session->userdata['name'], 'success', 'fa fa-user','');
          }
          else
          {
            notify('Gagal', 'Akun anda sudah tidak aktif, silahkan hubungi Admin', 'danger', 'fa fa-user', '');
          }
        }
        else
        {
          notify('Gagal', 'Akun anda tidak terdaftar di sistem kami, silahkan hubungi Admin', 'danger', 'fa fa-user', '');
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
    $data['viewName'] = 'profile';
    return $data;
  }

}

 ?>
