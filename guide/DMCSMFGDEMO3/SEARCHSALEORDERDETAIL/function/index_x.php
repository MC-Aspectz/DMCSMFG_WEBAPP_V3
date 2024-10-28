<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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
$javaFunc = new searchSaleOrderDetail;

$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';

if(!empty($_GET)) {
	// 
}

if(isset($_POST['search'])) {
	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    $P2 = isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '';
	$P3 = isset($_POST['P3']) ? str_replace('-', '', $_POST['P3']): '';
	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3);
	// print_r($Param);
  	$tdata = $javaFunc->searchSaleOrderDetail($Param);
	// echo '<pre>';
 	// print_r($tdata);
	// echo '</pre>';
}
?>