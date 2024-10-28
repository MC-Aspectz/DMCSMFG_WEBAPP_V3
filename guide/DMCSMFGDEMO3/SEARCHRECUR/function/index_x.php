<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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
$javaFunc = new SearchReCur;
$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';

if(isset($_POST['search'])) {
	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
	$P3 = isset($_POST['P3']) ? $_POST['P3']: '';
	$P4 = isset($_POST['P4']) ? $_POST['P4']: '';
	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4);
	// print_r($Param);
  	$tdata = $javaFunc->getRecur($Param);
	// echo '<pre>';
	// print_r($tdata);
	// echo '</pre>';
}

// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHRECUR');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHRECUR');
    $syslogic->ProgramRundelete('SEARCHRECUR');
    setSystemData('SEARCHRECUR', $loadApp);
}
//  else {
//     $setLoadApp = $syslogic->setLoadApp('SEARCHRECUR');
// }
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>