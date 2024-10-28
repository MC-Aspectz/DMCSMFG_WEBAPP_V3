<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode('\\', dirname(__FILE__));  // for localhost
$arydirname = explode('/', dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
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
}  // if ($_SESSION['MENU'] != ' and is_array($_SESSION['MENU'])) {
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
}
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$javaFunc = new AccSaleTaxInfo;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 12;

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
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
    }
    if (isset($_POST['SEARCH'])) { getDataAccTran(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
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
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
if(empty($data['YEARVALUE'])) { $data['YEARVALUE'] = isset($load['YEAR']) ? $load['YEAR']: date('Y'); }
if(empty($data['MONTHVALUE'])) { $data['MONTHVALUE'] = isset($load['MONTH']) ? $load['MONTH']: date('m'); }
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
function getDataAccTran() {
    global $data;
    $data['ITEM'] = array(); 
    $searchfunc = new AccSaleTaxInfo;
    $data['YEARVALUE'] = isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '';
    $data['MONTHVALUE'] = isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '';
    $getDataAccTran = $searchfunc->getDataAccTran($data['YEARVALUE'], $data['MONTHVALUE']);
    // print_r($getDataAccTran);
    // if(!empty($getDataAccTran)) {
        $upTempSaleTaxInfo = $searchfunc->UpTempSaleTaxInfo($getDataAccTran);
        $clearAmt_Cancel = $searchfunc->ClearAmt_Cancel();
        $getTempSaleTaxInfo = $searchfunc->GetTempSaleTaxInfo();
        if(!empty($getTempSaleTaxInfo)) {
            $data['ITEM'] = $getTempSaleTaxInfo;
         
        }
    // }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($getTempSaleTaxInfo);
    // echo '</pre>';
}

function printed() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccSaleTaxInfo;
    $param = array(  'YEAR' => isset($data['YEARVALUE']) ? $data['YEARVALUE']: '',
                    'MONTH' => isset($data['MONTHVALUE']) ? $data['MONTHVALUE']: '',
                    'ROWNO' => isset($data['ROWNO']) ? $data['ROWNO']: '',
                    'ENTRYDT' => isset($data['ENTRYDT']) ? $data['ENTRYDT']: '',
                    'INVNO' => isset($data['INVNO']) ? $data['INVNO']: '',
                    'SYSDATETYPE' => '1',
                    'SYSLDATETYPE' => '1',
                    'TTLTAXABLE' => isset($data['TTLTAXABLE']) ? implode(explode(',', $data['TTLTAXABLE'])): '',
                    'TTLAMOUNT' => isset($data['TTLAMOUNT']) ? implode(explode(',', $data['TTLAMOUNT'])): '',
                    'TTLVATAMT' => isset($data['TTLVATAMT']) ? implode(explode(',', $data['TTLVATAMT'])): '',
    );
    $upTemp2 = $printfunc->UPTemp2($data['ITEM']);
    if(!empty($upTemp2)) {
        $printStatic = $printfunc->PrintStatic2($param);
        $printDynamic = $printfunc->PrintDynamic2($param);
        if(!empty($printStatic)) {
            $index = isset($printStatic) ? array_key_first($printStatic) : 1;
            $data['PRINTSTATIC'] = $printStatic[$index];
        }
        if(!empty($printDynamic)) {
            $data['PRINTDYNAMIC'] = $printDynamic;
            setSessionArray($data);
        }
    }
    // echo "<pre>";
    // print_r($data['PRINTSTATIC']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['PRINTDYNAMIC']);
    // echo "</pre>";
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

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'INVNO', 'SALEINVDT', 'CUSTOMERCD', 'CUSTOMERNAME', 'TAXID', 'BRANCH', 'SALEDIVCD', 'SALEDIVNAME', 'SVNO', 'SVDT', 'AMOUNT', 'VATAMOUNT', 'ITEM', 'AMOUNT2', 'STAFFCD', 'STAFFNAME', 'TTLTAXABLE', 'TTLAMOUNT', 'TTLAMOUNT2', 'TTLVATAMT', 'TTLTOTALAMT', 'YEARVALUE', 'MONTHVALUE');

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