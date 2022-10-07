<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['bugForm'] = "Bugcontroller";
$route['viewBug'] = "Bugcontroller/viewBugUser";
$route['viewBugA'] = "Bugcontroller/viewBugA";
$route['viewBugE'] = "Bugcontroller/viewBugE";
$route['closeExp'] = "Bugcontroller/eClosed";
$route['closeAdm'] = "Bugcontroller/aClosed";
