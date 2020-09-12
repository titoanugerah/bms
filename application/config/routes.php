<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// link == controller/function
$route['default_controller'] = 'general/dashboard';

#AJAX
$route['api/getDepartment'] = 'master/getDepartment';
$route['api/addDepartment'] = 'master/addDepartment';
$route['api/deleteDepartment'] = 'master/deleteDepartment';
$route['api/recoverDepartment'] = 'master/recoverDepartment';
$route['api/getDetailDepartment'] = 'master/getSelectedDepartment';
$route['api/getSelectedDepartment'] = 'master/getSelectedDepartment';


#Others
$route['template'] = 'general/template';
$route['404_override'] = 'general/error';
$route['translate_uri_dashes'] = FALSE;
