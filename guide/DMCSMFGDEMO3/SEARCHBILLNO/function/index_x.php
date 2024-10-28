<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
$guideUrl = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'].'/SEARCHBILLNO/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new SearchBillNO;
$minrow = 0;
$maxrow = 9;
$tdata = array();
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
	if(isset($_GET['CD'])) {
		
		$data['CD'] = isset($_GET['CD']) ? $_GET['CD']: '';
		$query = $javaFunc->getName($data['CD']);
	    if(!empty($query)) {
    		$data['CN'] = $query['CN'];
    	} else { $data['CD'] = ''; $data['CN'] = ''; }
		setSessionArray($data); 
	}

    if(checkSessionData()) { $data = getSessionData(); }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action']) && $_POST['action'] == "unsetsession") { unsetSessionData(); }
	if (isset($_POST['SEARCH'])) {
        $searchFunc = new SearchBillNO;
        $BN = isset($_POST['BN']) ? $_POST['BN']: '';
        $CD = isset($_POST['CD']) ? $_POST['CD']: '';
        $D1 = isset($_POST['D1']) ? str_replace("-", "", $_POST['D1']): '';
        $D2 = isset($_POST['D2']) ? str_replace("-", "", $_POST['D2']): '';
        $C1 = isset($_POST['C1']) ? $_POST['C1']: '';
        // print_r($_POST);
        $query = $searchFunc->getBill($BN, $CD, $D1, $D2, $C1);
        $tdata = $query;
        // echo '<pre>';
        // print_r($tdata);
        // echo '</pre>';
    }
}       
//--------------------------------------------------------------------------------
// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHBILLNO');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHBILLNO');
    $syslogic->ProgramRundelete('SEARCHBILLNO');
    setSystemData('SEARCHBILLNO', $loadApp);
} 
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$bnstatus = $data['DRPLANG']['BN_STATUS'];
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
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'BN', 'CD', 'CN', 'D1', 'D2', 'BN_STATUS');

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