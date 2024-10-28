<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
$guideUrl = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'].'/ACCBOKGUIDE9/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new AccbokGuide9;
$minrow = 0;
$maxrow = 14;


if(!empty($_GET)) {
	if(isset($_GET['STAFFCD'])) {
		$STAFFCD = isset($_GET['STAFFCD']) ? $_GET['STAFFCD']: '';
		$query = $javaFunc->get_staff($STAFFCD);
		$STAFFCD = $query['STAFFCD'];
		$STAFFNAME = $query['STAFFNAME'];
		// echo '<pre>';
		// print_r($query);
		// echo '</pre>';
	}
}

if(isset($_POST['SEARCH'])) {
	$STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
	$STAFFCODE = isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '';
	$S_DT = isset($_POST['S_DT']) ? str_replace('-', '', $_POST['S_DT']): '';
	$E_DT = isset($_POST['E_DT']) ? str_replace('-', '', $_POST['E_DT']): '';
	$SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
	$Param = array(	'STAFFCD' => $STAFFCD, 'STAFFCODE' => $STAFFCODE, 'S_DT' => $S_DT, 'E_DT' => $E_DT, 'SUPPLIERCD' => $SUPPLIERCD);
	// print_r($Param);
  	$tdata = $javaFunc->get_data($Param);
	// echo '<pre>';
	// print_r($tdata);
	// echo '</pre>';
}

// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('ACCBOKGUIDE9');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('ACCBOKGUIDE9');
    $syslogic->ProgramRundelete('ACCBOKGUIDE9');
    setSystemData('ACCBOKGUIDE9', $loadApp);
} 
// else {
//    $setLoadApp = $syslogic->setLoadApp('ACCBOKGUIDE9');
//}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$csstyp = $data['DRPLANG']['CSS_TYP'];
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>