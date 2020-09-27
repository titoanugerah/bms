<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// link == controller/function
$route['default_controller'] = 'general/dashboard';
$route['dashboard'] = 'general/dashboard';
$route['profile'] = 'general/profile';
$route['logout'] = 'general/logout';



#ROLE
$route['role'] = 'role';
$route['api/role/read'] = 'role/read';
$route['api/role/readDetail'] = 'role/readDetail';
$route['api/role/recover'] = 'role/recover';
$route['api/role/create'] = 'role/create';
$route['api/role/delete'] = 'role/delete';
$route['api/role/update'] = 'role/update';

#User
$route['user'] = 'user';
$route['api/user/read'] = 'user/read';
$route['api/user/readDetail'] = 'user/readDetail';
$route['api/user/recover'] = 'user/recover';
$route['api/user/create'] = 'user/create';
$route['api/user/delete'] = 'user/delete';
$route['api/user/update'] = 'user/update';

#Team
$route['team'] = 'team';
$route['api/team/read'] = 'team/read';
$route['api/team/readDetail'] = 'team/readDetail';
$route['api/team/recover'] = 'team/recover';
$route['api/team/create'] = 'team/create';
$route['api/team/delete'] = 'team/delete';
$route['api/team/update'] = 'team/update';

#Category
$route['category'] = 'category';
$route['api/category/read'] = 'category/read';
$route['api/category/readDetail'] = 'category/readDetail';
$route['api/category/recover'] = 'category/recover';
$route['api/category/create'] = 'category/create';
$route['api/category/delete'] = 'category/delete';
$route['api/category/update'] = 'category/update';


#Cartridge
$route['cartridge'] = 'cartridge';
$route['api/cartridge/read'] = 'cartridge/read';
$route['api/cartridge/readDetail'] = 'cartridge/readDetail';
$route['api/cartridge/recover'] = 'cartridge/recover';
$route['api/cartridge/create'] = 'cartridge/create';
$route['api/cartridge/delete'] = 'cartridge/delete';
$route['api/cartridge/update'] = 'cartridge/update';

#Job
$route['job'] = 'job';
$route['api/job/read'] = 'job/read';
$route['api/job/readDetail'] = 'job/readDetail';
$route['api/job/recover'] = 'job/recover';
$route['api/job/create'] = 'job/create';
$route['api/job/delete'] = 'job/delete';
$route['api/job/update'] = 'job/update';

#Dataset
$route['dataset'] = 'dataset';
$route['api/dataset/read'] = 'dataset/read';
$route['api/dataset/readDetail'] = 'dataset/readDetail';
$route['api/dataset/recover'] = 'dataset/recover';
$route['api/dataset/create'] = 'dataset/create';
$route['api/dataset/delete'] = 'dataset/delete';
$route['api/dataset/update'] = 'dataset/update';

#Backup
$route['backup'] = 'backup';
$route['api/backup/read'] = 'backup/read';
$route['api/backup/readDetail'] = 'backup/readDetail';
$route['api/backup/recover'] = 'backup/recover';
$route['api/backup/create'] = 'backup/create';
$route['api/backup/delete'] = 'backup/delete';
$route['api/backup/update'] = 'backup/update';
$route['api/backup/readHistoryDetail'] = 'backup/readHistoryDetail';
$route['api/backup/download/(:any)/(:any)'] = 'backup/download/$1/$2';

#Issue
$route['issue'] = 'issue';
$route['api/issue/read'] = 'issue/read';
$route['api/issue/readDetail'] = 'issue/readDetail';
$route['api/issue/recover'] = 'issue/recover';
$route['api/issue/create'] = 'issue/create';
$route['api/issue/delete'] = 'issue/delete';
$route['api/issue/update'] = 'issue/update';



#Others
$route['template'] = 'general/template';
$route['404_override'] = 'general/error';
$route['translate_uri_dashes'] = FALSE;
