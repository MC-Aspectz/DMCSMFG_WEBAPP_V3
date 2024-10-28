<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new SearchPropss;

$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';

if(!empty($_GET)) {
  if(!empty($_GET['P1'])) {
    $P1 = isset($_GET['P1']) ? $_GET['P1']: '';
  }
}

if(!empty($_POST)) {
  if(isset($_POST['search'])) {
    $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
  	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
    $tdata = $javaFunc->searchProOrder2($P1, $P2);
    // print_r($tdata);
  }
}

?>