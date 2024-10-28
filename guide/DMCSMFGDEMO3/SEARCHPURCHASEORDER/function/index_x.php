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

$data = array();
$syslogic = new Syslogic;
$javaFunc = new PurchaseOrderIndex;
$systemName = strtolower('SEARCHPURCHASEORDER');
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

$data['P6'] = date('Y-m-d');
$data['P9'] = '0';

//---------------------------GET-----------------------------------//
if(!empty($_GET)) {
	 // print_r($_GET);
    if(isset($_GET['P2'])) {
        $query = $javaFunc->getSup($_GET['P2']);
        $data = fetch_data($query);
    } else if(isset($_GET['P3'])) {
        $query = $javaFunc->getItem2($_GET['P3']);
        $data = fetch_data($query);
    } else if(isset($_GET['DIVISIONCD'])) {
        $query = $javaFunc->getDiv($_GET['DIVISIONCD']);
        $data = fetch_data($query);
    }
    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

//---------------------------POST-----------------------------------//
if(!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "unsetsession") { unsetSessionData(); }
    if(isset($_POST['SEARCH'])) {
      	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
    	$P3 = isset($_POST['P3']) ? $_POST['P3']: '';
    	$P4 = isset($_POST['P4']) ? $_POST['P4']: '';
        $P5 = isset($_POST['P5']) ? str_replace("-", "", $_POST['P5']): '';
        $P6 = isset($_POST['P6']) ? str_replace("-", "", $_POST['P6']): '';
    	$P7 = isset($_POST['P7']) ? $_POST['P7']: '';
    	$P8 = isset($_POST['P8']) ? $_POST['P8']: '';
    	$P9 = isset($_POST['P9']) ? $_POST['P9']: '';
    	$DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5, 'P6' => $P6, 'P7' => $P7, 'P8' => $P8, 'P9' => $P9, 'DIVISIONCD' => $DIVISIONCD);
    	// print_r($Param);
    	$tdata = $javaFunc->searchPurOrder($Param);
    	// echo '<pre>';
      	// print_r($tdata);
    	// echo '</pre>';
    }
}
// ------------------------- CALL Langauge  -------------------//
$loadApp = getSystemData('SEARCHPURCHASEORDER');
if(empty($loadApp)) {
   	$loadApp = $syslogic->getLoadApp('SEARCHPURCHASEORDER');
 	$syslogic->ProgramRundelete('SEARCHPURCHASEORDER');
    setSystemData('SEARCHPURCHASEORDER', $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$statuspurchase = $data['DRPLANG']['STATUS_PURCHASE'];
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function setSessionArray($arr){
    $keepField = array('P1', 'P2', 'P2NAME', 'P3', 'P4', 'P5', 'P6', 'P7', 'P8', 'P9', 'DIVISIONCD', 'DIVISIONNAME', 'TXTLANG', 'DRPLANG');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>