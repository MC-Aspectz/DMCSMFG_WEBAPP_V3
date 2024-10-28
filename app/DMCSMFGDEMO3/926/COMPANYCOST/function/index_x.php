<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}  // if ($appname == "") {
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new COMPANYCOST;
$systemName = strtolower($appcode);
$data = array();
// Table Row
$minrow = 0;
$maxrow = 15;
$rowno = 0;


//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {


    if(!empty($query)) {
        setSessionArray($data);
    } 

    if(checkSessionData()) { $data = getSessionData(); }

}
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
	if (isset($_POST['action'])) {
	    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
	    if ($_POST['action'] == 'keepdata') { setOldValue();}
	    if ($_POST['action'] == 'programDelete') { programDelete(); }
        // if ($_POST['action'] == "insert") { insert();print_r('insert');}
        if ($_POST['action'] == "update") { update();}
        // if ($_POST['action'] == "delete") { delete();print_r('delete');}
	}

}
// 
//--------------------------------------------------------------------------------
$test = getSystemData($_SESSION['APPCODE']."test");
if(empty($test)) {
    // print_r('if');
    $test = $javaFunc->load();
    setSystemData($_SESSION['APPCODE']."test", $test);
    // print_r($test);
}
else{
    // print_r('else');
    $test = $javaFunc->load();
    setSystemData($_SESSION['APPCODE']."test", $test);
    // print_r($test);
}
$data['load'] = $test;
// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// $statusorder = $data['DRPLANG']['STATUS_ORDER'];
$dd1 = $data['DRPLANG']['COST_TYPE'];
$dd2 = $data['DRPLANG']['COST_NAME'];
// $dd3 = $data['DRPLANG']['CODEKEY'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//



function update() {

    $javaFunc = new COMPANYCOST;
    // gen.CompanyCost.upd COST_VALUE_01,COST_VALUE_02,COST_VALUE_03,COST_VALUE_04,COST_VALUE_05,
    // COST_VALUE_06,COST_VALUE_07,COST_VALUE_08,COST_VALUE_09,COST_VALUE_10,
    // COST_VALUE_11,COST_VALUE_12,COST_VALUE_13,COST_VALUE_14,COST_VALUE_15,
    // COST_VALUE_16,COST_VALUE_17,COST_VALUE_18,COST_VALUE_19,COST_VALUE_20,
    // COST_METHOD,SUBCONTRACT_COST
    $Param = array( "COST_VALUE_01" => $_POST['COST_VALUE_01'],
                    "COST_VALUE_02" => $_POST['COST_VALUE_02'],
                    "COST_VALUE_03" => $_POST['COST_VALUE_03'],
                    "COST_VALUE_04" => $_POST['COST_VALUE_04'],
                    "COST_VALUE_05" => $_POST['COST_VALUE_05'],
                    "COST_VALUE_06" => $_POST['COST_VALUE_06'],
                    "COST_VALUE_07" => $_POST['COST_VALUE_07'],
                    "COST_VALUE_08" => $_POST['COST_VALUE_08'],
                    "COST_VALUE_09" => $_POST['COST_VALUE_09'],
                    "COST_VALUE_10" => $_POST['COST_VALUE_10'],
                    "COST_VALUE_11" => $_POST['COST_VALUE_11'],
                    "COST_VALUE_12" => $_POST['COST_VALUE_12'],
                    "COST_VALUE_13" => $_POST['COST_VALUE_13'],
                    "COST_VALUE_14" => $_POST['COST_VALUE_14'],
                    "COST_VALUE_15" => $_POST['COST_VALUE_15'],
                    "COST_VALUE_16" => $_POST['COST_VALUE_16'],
                    "COST_VALUE_17" => $_POST['COST_VALUE_17'],
                    "COST_VALUE_18" => $_POST['COST_VALUE_18'],
                    "COST_VALUE_19" => $_POST['COST_VALUE_19'],
                    "COST_VALUE_20" => $_POST['COST_VALUE_20'],
                    "COST_METHOD" => '',
                    "SUBCONTRACT_COST" => $_POST['SUBCONTRACT_COST'],);

    $query = $javaFunc->upd($Param);

    unsetSessionData();
    echo json_encode($query);
}




function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

// COST_VALUE_01,COST_VALUE_02,COST_VALUE_03,COST_VALUE_04,COST_VALUE_05,
// COST_VALUE_06,COST_VALUE_07,COST_VALUE_08,COST_VALUE_09,COST_VALUE_10,
// COST_VALUE_11,COST_VALUE_12,COST_VALUE_13,COST_VALUE_14,COST_VALUE_15,
// COST_VALUE_16,COST_VALUE_17,COST_VALUE_18,COST_VALUE_19,COST_VALUE_20,
// COST_METHOD,SUBCONTRACT_COST
/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'DVWDELIERY',
                        'COST_VALUE_01','COST_VALUE_02','COST_VALUE_03','COST_VALUE_04','COST_VALUE_05',
                        'COST_VALUE_06','COST_VALUE_07','COST_VALUE_08','COST_VALUE_09','COST_VALUE_10',
                        'COST_VALUE_11','COST_VALUE_12','COST_VALUE_13','COST_VALUE_14','COST_VALUE_15',
                        'COST_VALUE_16','COST_VALUE_17','COST_VALUE_18','COST_VALUE_19','COST_VALUE_20',
                        'COST_METHOD','SUBCONTRACT_COST','load',
                        'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

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

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}

function setSessionKey($key, $value) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    $_SESSION[$sysnm][$key] = $value;
}

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>