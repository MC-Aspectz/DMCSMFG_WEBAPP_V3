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
$javaFunc = new SearchProductionOrder;

$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';
$P5 = '';

if(!empty($_GET)) {
    if(!empty($_GET['P3'])) {
		$P3 = isset($_GET['P3']) ? $_GET['P3']: '';
	 	$query = $javaFunc->getItem2($P3);
	    // print_r($query);
		if(!empty($query)) {
			$P3 = $query['P3'];
			$P4 = $query['P4'];
		}
	}
}

if(isset($_POST['search'])) {
    $P1 = isset($_POST['P1']) ? str_replace("-", "", $_POST['P1']): '';
    $P2 = isset($_POST['P2']) ? str_replace("-", "", $_POST['P2']): '';
	$P3 = isset($_POST['P3']) ? $_POST['P3']: '';
	$P4 = isset($_POST['P4']) ? $_POST['P4']: '';
	$P5 = isset($_POST['P5']) ? $_POST['P5']: '';
	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5);
	// print_r($Param);
  	$tdata = $javaFunc->searchProOrder($Param);
	// echo '<pre>';
 //  	print_r($tdata);
	// echo '</pre>';
}

$branchtype = getDropdownData("BRANCH_TYPE");
if(empty($branchtype)) {
    $branchtype = $syslogic->getPullDownData('BRANCH_TYPE', $_SESSION['LANG']);
    setDropdownData("BRANCH_TYPE", $branchtype);
}

function getDropdownData($key = "") {
	return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}
  
function setDropdownData($key, $val) {
return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>