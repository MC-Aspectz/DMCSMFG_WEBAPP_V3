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
$javaFunc = new SalesOrderIndex;
$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';
$P5 = '';
$P6 = '';
$P7 = '';
$P8 = '';
$P9 = '';
$P10 = '';

if(!empty($_GET)) {
	$P1 = isset($_GET['P1CODE']) ? $_GET['P1CODE']: '';
}

if(isset($_POST['search'])) {
  	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
	$P3 = isset($_POST['P3']) ? $_POST['P3']: '';
	$P4 = isset($_POST['P4']) ? $_POST['P4']: '';
    $P5 = isset($_POST['P5']) ? str_replace('-', '', $_POST['P5']): '';
    $P6 = isset($_POST['P6']) ? str_replace('-', '', $_POST['P6']): '';
	$P7 = isset($_POST['P7']) ? $_POST['P7']: '';
	$P8 = isset($_POST['P8']) ? $_POST['P8']: '';
	$P9 = isset($_POST['P9']) ? $_POST['P9']: '';
	$P10 = isset($_POST['P10']) ? $_POST['P10']: '';
	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5, 'P6' => $P6, 'P7' => $P7, 'P8' => $P8, 'P9' => $P9, 'P10' => $P10);
	// print_r($Param);
  	$tdata = $javaFunc->searchSaleOrder($Param);
	// echo '<pre>';
  	// print_r($tdata);
	// echo '</pre>';
}

$statusale = getDropdownData('STATUS_SALES');
if(empty($statussale)) {
    $statussale = $syslogic->getPullDownData('STATUS_SALES', $_SESSION['LANG']);
    setDropdownData('STATUS_SALES', $statussale);
}


$branchtype = getDropdownData('BRANCH_TYPE');
if(empty($branchtype)) {
    $branchtype = $syslogic->getPullDownData('BRANCH_TYPE', $_SESSION['LANG']);
    setDropdownData('BRANCH_TYPE', $branchtype);
}

function getDropdownData($key = '') {
	return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}
  
function setDropdownData($key, $val) {
return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>