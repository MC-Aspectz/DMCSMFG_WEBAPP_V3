<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
$guideUrl = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'].'/SEARCHPBILLSLIP_ACC/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new SearchBillSlipAcc;
$minrow = 0;
$maxrow = 9;
$tdata = array();
$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';
$P5 = '';
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
//
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "unsetsession") { unsetSessionData(); }
	if (isset($_POST['SEARCH'])) {
        $searchFunc = new SearchBillSlipAcc;
        $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
        $P2 = isset($_POST['P2']) ? $_POST['P2']: '';
        $P3 = isset($_POST['P3']) ? str_replace("-", "", $_POST['P3']): '';
        $P4 = isset($_POST['P4']) ? str_replace("-", "", $_POST['P4']): '';
        $P5 = isset($_POST['P5']) ? $_POST['P5']: '';
        // print_r($_POST);
        $query = $searchFunc->searchBill($P1, $P1, $P3, $P4, $P5);
        $tdata = $query;
        // echo '<pre>';
        // print_r($tdata);
        // echo '</pre>';
    }
}       
//--------------------------------------------------------------------------------
// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHPBILLSLIP_ACC');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHPBILLSLIP_ACC');
    $syslogic->ProgramRundelete('SEARCHPBILLSLIP_ACC');
    setSystemData('SEARCHPBILLSLIP_ACC', $loadApp);
} 
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$accstatus = $data['DRPLANG']['ACCSTSTAUTS'];
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";

function setOldValue() {
    setSessionArray($_POST); 
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'P1', 'P1', 'CN', 'P3', 'P4', 'BN_STATUS');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}
// --------------------------------------------------------------------------//
function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>