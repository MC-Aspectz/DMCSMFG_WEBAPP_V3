<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
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
$javaFunc = new MasterPlan;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 25;

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
    // print_r($_POST);
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'changeCondition') { changeCondition(); }
        if ($_POST['action'] == 'search') { search(); }
        if ($_POST['action'] == 'commit') { commit(); }
    }
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
// if(checkSessionData()) { $data = getSessionData(); }
$load = $javaFunc->load();
// echo '<pre>';
// print_r($load);
// echo '</pre>';
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
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
$data['SYSTIMESTAMP'] = $load['SYSTIMESTAMP'];
$factory = $data['DRPLANG']['FACTORY'];
$plandisptyp = $data['DRPLANG']['PLAN_DISP_TYP'];
setSessionData('LANGTEXT', $data['TXTLANG']);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['SYSTIMESTAMP']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function commit() {
    $commitfunc = new MasterPlan;
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'DIVISIONTYP' => isset($_POST['DIVISIONTYP']) ? $_POST['DIVISIONTYP']: '',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'DISPOPT' => 0, // isset($_POST['DISPOPT']) ? $_POST['DISPOPT']: '0',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'FROMDATE' => isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '',
                    'ONEMONTH' => !empty($_POST['ONEMONTH']) ? $_POST['ONEMONTH']: 'F',
                    'TWOMONTH' => !empty($_POST['TWOMONTH']) ? $_POST['TWOMONTH']: 'F',
                    'THREEMONTH' => !empty($_POST['THREEMONTH']) ? $_POST['THREEMONTH']: 'F',
                    'FOURMONTH' => !empty($_POST['FOURMONTH']) ? $_POST['FOURMONTH']: 'F',
                    'FIVEMONTH' => !empty($_POST['FIVEMONTH']) ? $_POST['FIVEMONTH']: 'F',
                    'SIXMONTH' => !empty($_POST['SIXMONTH']) ? $_POST['SIXMONTH']: 'F');
    // print_r($param);
    $commit = $commitfunc->commit($param);
    echo json_encode($commit);
}

function search() {

    $javaFunc = new MasterPlan;
    global $data; $data = getSessionData();
    $langauge = isset($data['LANGTEXT']) ? $data['LANGTEXT']: '';
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'DIVISIONTYP' => isset($_POST['DIVISIONTYP']) ? $_POST['DIVISIONTYP']: '',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'DISPOPT' => 0, // isset($_POST['DISPOPT']) ? $_POST['DISPOPT']: '0',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'FROMDATE' => isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '',
                    'ONEMONTH' => !empty($_POST['ONEMONTH']) ? $_POST['ONEMONTH']: 'F',
                    'TWOMONTH' => !empty($_POST['TWOMONTH']) ? $_POST['TWOMONTH']: 'F',
                    'THREEMONTH' => !empty($_POST['THREEMONTH']) ? $_POST['THREEMONTH']: 'F',
                    'FOURMONTH' => !empty($_POST['FOURMONTH']) ? $_POST['FOURMONTH']: 'F',
                    'FIVEMONTH' => !empty($_POST['FIVEMONTH']) ? $_POST['FIVEMONTH']: 'F',
                    'SIXMONTH' => !empty($_POST['SIXMONTH']) ? $_POST['SIXMONTH']: 'F',
                    'MONTHCTR' => isset($_POST['MONTHCTR']) ? $_POST['MONTHCTR']: 1,
                );
    // echo '<pre>';
    // print_r($param);
    // echo '</pre>';
    $setVw = $javaFunc->setVw($param);
    $search = $javaFunc->searchPlan($param);
    $dvwdetail = []; $dvwcol = [];
    if(!empty($setVw['SYSCD_DVWDETAIL'])) {
        $replace = str_replace([':R'], '', $setVw['SYSCD_DVWDETAIL']);
        $dvwdetail = explode(',', $replace);
    }

    if(!empty($setVw['SYSCOL_DVWDETAIL'])) {
        $dvwcol = explode(',', $setVw['SYSCOL_DVWDETAIL']);
    }

    // print_r($search);
    // print_r($dvwdetail);
    $data = array('setVw' => $dvwdetail, 'setCol' => $dvwcol, 'search' => $search, 'langauge' => $langauge);
    // print_r($data);
    // if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($data);
}

function changeCondition() {

    $javaFunc = new MasterPlan;
    $SYSTIMESTAMP = isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '';
    // print_r($SYSTIMESTAMP);
    $query = $javaFunc->changeCondition($SYSTIMESTAMP);

    echo json_encode($query);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        // unsetSessionkey('DVWPRODUCTION');
        unsetSessionData();
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'KAKUTEITORIKOM', 'PLANDT', 'DIVISIONTYP', 'DISPOPT', 'FROMDATE', 'ONEMONTH', 'TWOMONTH', 'THREEMONTH', 'FOURMONTH', 'FIVEMONTH', 'SIXMONTH', 'MONTHCTR', 'DVWDETAIL', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL', 'LANGTEXT');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
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

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}

function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>