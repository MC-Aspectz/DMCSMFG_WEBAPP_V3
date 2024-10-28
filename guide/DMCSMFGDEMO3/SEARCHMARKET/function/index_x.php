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

$javaFunc = new MarKet;
$syslogic = new Syslogic;

$minrow = 0;
$maxrow = 10;

$P1 = '';
$tdata = array();

if(isset($_POST['SEARCH'])) {
  	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    $query = $javaFunc->searchMarket($P1);
  	$tdata = $query;
	// echo "<pre>";
	// print_r($tdata);
	// echo "</pre>";
}
// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHMARKET');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHMARKET');
    $syslogic->ProgramRundelete('SEARCHMARKET');
    setSystemData('SEARCHMARKET', $loadApp);
} 
$data['TXTLANG'] = get_sys_lang($loadApp);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>