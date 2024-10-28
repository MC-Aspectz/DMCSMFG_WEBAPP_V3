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
$javaFunc = new AccMonthReportAll;
$systemName = strtolower($appcode);
$accINCVOURL = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/ACC_INCVO';
// Table Row
$minrow = 0;
$maxrow = 21;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['ACCCD1'])) {
        $data['ACCCD1'] = isset($_GET['ACCCD1']) ? $_GET['ACCCD1'] : '';
    } else if(isset($_GET['ACCCD2'])) {
        $data['ACCCD2'] = isset($_GET['ACCCD2']) ? $_GET['ACCCD2'] : '';
    }
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
    if (isset($_POST['SEARCH'])) { getInfo(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
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
$accyearvalue = $data['DRPLANG']['ACCYEARVALUE'];
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: '';
if(empty($data['P2'])) { $data['P2'] = date('Y-m-d'); }
// print_r($data['ITEM']);
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
function getInfo() {
    global $data; $data['ITEM'] = array();
    $data = getSessionData();
    $searchfunc = new AccMonthReportAll;
    $ACCY = isset($_POST['ACCY']) ? $_POST['ACCY']: '';
    $ACCCD = isset($_POST['ACCCD']) ? $_POST['ACCCD']: '';
    $P1 = isset($_POST['P1']) ? str_replace("-", "", $_POST['P1']): '';
    $P2 = isset($_POST['P2']) ? str_replace("-", "", $_POST['P2']): '';
    $ACCCD1 = isset($_POST['ACCCD1']) ? $_POST['ACCCD1']: '';
    $ACCCD2 = isset($_POST['ACCCD2']) ? $_POST['ACCCD2']: '';
    $getInfo = $searchfunc->getInfo($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2);
    // print_r($getInfo);
    if(!empty($getInfo)) {
        $getGLInquiry = $searchfunc->GetGLInquiry($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2);
        $upTmpGLInquiry = $searchfunc->UpTmpGLInquiry($getGLInquiry);
        $getGLBegining = $searchfunc->GetGLBegining($ACCY, $ACCCD, $P1, $P2, $ACCCD1, $ACCCD2);
        $upTmpGLBegining = $searchfunc->UpTmpGLBegining($getGLBegining);
        $getTmpGLInquiry1 = $searchfunc->GetTmpGLInquiry();
        $calBalGLInquiry = $searchfunc->CalBalGLInquiry($getTmpGLInquiry1);
        $getTmpGLInquiry = $searchfunc->GetTmpGLInquiry();
        if(!empty($getTmpGLInquiry)) {
            $data['ITEM'] = $getTmpGLInquiry;
        }
        setSessionArray($data);
        if(checkSessionData()) { $data = getSessionData(); }
    }
    // echo "<pre>";
    // print_r($getTmpGLInquiry);
    // echo "</pre>";
}

function setOldValue() {
    setSessionArray($_POST);
    if(checkSessionData()) {
        global $data; 
        $data = getSessionData(); 
        // print_r($data);
        setSessionArray($data);
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

/// add session data of item 
function setSessionArray($arr) {

    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'P1', 'P2', 'ACCCD1', 'ACCCD2', 'ACCY', 'STARTAMT', 'STARTDB', 'STARTCR', 'ACCCD', 'ACCNAME', 'VOUCHERNO', 'BALAMT', 'TTL_MY_CURR_AMT0', 'TTL_MY_CURR_AMT1');
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