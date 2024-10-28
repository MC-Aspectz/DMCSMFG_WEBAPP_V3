<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/PHPExcel.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode('/', dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {

//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$javaFunc = new AccINCVO;
$systemName = strtolower('ACC_INCVO');
$accINCVOURL = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/ACC_INCVO';
// Table Row
$minrow = 0;
$maxrow = 15;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // unsetSessionData();
    unsetSessionkey('DVWITEM');
    $data['BOOKORDERNO'] = isset($_GET['VOUCHERNO']) ? $_GET['VOUCHERNO'] : '';
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }  
    }
    if (isset($_POST['SEARCH'])) { get_header(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData('ACC_INCVO'.'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData('ACC_INCVO'.'LOAD', $load);
}
$syspvl = getSystemData('ACC_INCVO'."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege('ACC_INCVO');
    setSystemData('ACC_INCVO'."_PVL", $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData('ACC_INCVO');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('ACC_INCVO');
    setSystemData('ACC_INCVO', $loadApp);
    $syslogic->ProgramRundelete('ACC_INCVO');
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$csstyp = $data['DRPLANG']['CSS_TYP'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$currencytyp = $data['DRPLANG']['CURRENCYTYP'];
$data['CURRENCY1'] = isset($load['CURRENCY1']) ? $load['CURRENCY1']: '';
$data['I_CURRENCY'] = isset($load['I_CURRENCY']) ? $load['I_CURRENCY']: '';
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: '';
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($load);
// echo '</pre>';
// --------------------------------------------------------------------------//
function get_header() {
    global $data; $data['DVWITEM'] = array();
    $data = getSessionData();
    $searchfunc = new AccINCVO;
    $ACCY = isset($_POST['ACCY']) ? $_POST['ACCY']: '';
    $BOOKORDERNO = isset($_POST['BOOKORDERNO']) ? $_POST['BOOKORDERNO']: '';
    $get_header = $searchfunc->get_header($BOOKORDERNO, $ACCY);
    // print_r($get_header);
    if(!empty($get_header)) {
        $data = $get_header;
        $get_detail = $searchfunc->get_detail($BOOKORDERNO, $ACCY);
        if(!empty($get_detail)) {
            $data['DVWITEM'] = $get_detail;
        }
        setSessionArray($data);
        if(checkSessionData()) { $data = getSessionData(); }
    }
    // echo "<pre>";
    // print_r($get_detail);
    // echo "</pre>";
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'DVWITEM', 'BOOKORDERNO', 'COMCURRENCY', 'TDATE', 'INPDATE', 'INPUTDT', 'ACCY', 'INP_STFCD', 'INP_STFNM', 'DIVISIONCD', 'DIVISIONNAME', 'CSS_TYPE', 'STAFFCODE', 'STAFFNAME', 'SUPPLIERCD', 'SUPPLIERNAME', 'CUSTOMERCODE', 'CUSTOMERNAME', 'I_CURRENCY', 'TTL_AMT1', 'TTL_AMT2', 'SYSVIS_CUSTOMERCODE', 'SYSVIS_CUSTOMERNAME', 'SYSVIS_STAFFCODE', 'SYSVIS_STAFFNAME', 'SYSVIS_SUPPLIERCD', 'SYSVIS_SUPPLIERNAME');
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
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>