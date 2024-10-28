<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// $guideUrl = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'].'/ASSETACCGUIDE/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new AssetGuide;
$minrow = 0;
$maxrow = 10;

$data['VONO']  = '';
$data['ASSETACC'] = '';
$data['ASSETACCNM'] = '';

if(!empty($_GET)) {
	if(isset($_GET['ASSETACC'])) {
		$data['ASSETACC'] = isset($_GET['ASSETACC']) ? $_GET['ASSETACC']: '';
		$query = $javaFunc->get_assetacc($data['ASSETACC']);
		if(!empty($query)) {
			$data['ASSETACCNM'] = $query['ASSETACCNM'];		
		}
		// echo '<pre>';
		// print_r($query);
		// echo '</pre>';
	}
}

if(isset($_POST['SEARCH'])) {
	$data['VONO'] = isset($_POST['VONO']) ? $_POST['VONO']: '';
	$data['ASSETACC'] = isset($_POST['ASSETACC']) ? $_POST['ASSETACC']: '';
  	$tdata = $javaFunc->get_Assetguide($data['ASSETACC'], $data['VONO']);
	// echo '<pre>';
	// print_r($tdata);
	// echo '</pre>';
}

// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('ASSETGUIDE');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('ASSETGUIDE');
    $syslogic->ProgramRundelete('ASSETGUIDE');
    setSystemData('ASSETGUIDE', $loadApp);
} 
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>