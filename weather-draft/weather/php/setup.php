<?php

#error reporting
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

header('Content-Type: text/html; charset=utf-8');

# Database Connection
include ('connection.php');

# Constants
$v = '';
$docroot = 'https://wetter.klausgraber.com/';
$rootpath = $_SERVER['DOCUMENT_ROOT'].'/';
define("SALTNPEPPER", 'TBD');


# Functions
include('functions/sandbox.php');
include('functions/queries.php');

# AD Server/Domain

$domObj = pdo_query($mydbc, "select settingname, value from _settings WHERE settingname like '%dom%'");

foreach($domObj as $val) {
   if($val['settingname'] == 'domSrv')
      $a = $val['value'];
   if($val['settingname'] == 'domShort')
      $b = $val['value'];
   if($val['settingname'] == 'domAD')
      $c = $val['value'];
}

#Clean URL Setup
$path = get_path();
$page = $path['call_parts'][0];

// Formqueries
include('functions/formqueries.php');
?>