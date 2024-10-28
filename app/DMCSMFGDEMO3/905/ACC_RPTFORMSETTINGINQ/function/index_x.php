<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
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

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}
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
    }
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
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

$data = array();
$javaFunc = new AccRPTFormSettingInq;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 15;
$minrowB = 0;
$maxrowB = 15;
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
        if ($_POST['action'] == 'programDelete') { programDelete(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }  
        if ($_POST['action'] == 'getRptFormDtl') { getRptFormDtl(); }  
    }
    if (isset($_POST['SEARCH'])) { searchCheck(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
// $load = getSystemData($_SESSION['APPCODE'].'LOAD');
// if(empty($load)) {
//     $load = $javaFunc->load();
//     setSystemData($_SESSION['APPCODE'].'LOAD', $load);
// }
if(checkSessionData()) { $data = getSessionData(); }
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
$rptform = $data['DRPLANG']['RPTFORM'];
$calctyp = $data['DRPLANG']['CALC_TYP'];
$textaligne = $data['DRPLANG']['TEXTALIGNE'];

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
function searchCheck() {
    global $data;
    $data = getSessionData();
    unsetSessionkey('ITEMACC');
    $searchfunc = new AccRPTFormSettingInq;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $getRptForm = $searchfunc->getRptForm($RPTFORMTYP);
    if(!empty($getRptForm) && !empty($getRptForm[1])) {
        for ($i = 1 ; $i <= count($getRptForm); $i++) {
            $data['ITEM'][$i] = $getRptForm[$i]; 
        }
        setSessionArray($data);
    }
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
}

function getRptFormDtl() {
    global $data;
    $data = getSessionData();
    $rptfunc = new AccRPTFormSettingInq;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $getRptFormDtl = $rptfunc->getRptFormDtl($RPTFORMTYP, $FORMROWNUM);
    if(!empty($getRptFormDtl)) {
        for ($i = 1 ; $i <= count($getRptFormDtl); $i++) {
            $data['ITEMACC'][$i] = $getRptFormDtl[$i]; 
        }
        setSessionArray($data);
    }
    echo json_encode($getRptFormDtl);
    // echo "<pre>";
    // print_r($data);
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
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'ACC_CD' => $_POST['ACC_CDA'][$i],
                                    'ACC_NM' => $_POST['ACC_NMA'][$i],
                                    'ACCTRANREMARK' => $_POST['ACCTRANREMARKA'][$i],
                                    'ACCAMT1' => $_POST['ACCAMT1A'][$i],
                                    'ACCAMT2' => $_POST['ACCAMT2A'][$i],
                                    'SECTION1' => $_POST['SECTION1A'][$i],
                                    'PROJECTNO' => $_POST['PROJECTNOA'][$i],
                                    'ADJFLAG' => $_POST['ADJFLAGA'][$i],
                                    'DC_TYPE' => $_POST['DC_TYPEA'][$i],
                                    'CURRENCY1' => $_POST['CURRENCY1A'][$i],
                                    'I_CURRENCY' => $_POST['I_CURRENCYA'][$i],
                                    'EXRATE' => $_POST['EXRATEA'][$i],
                                    'AMT' => $_POST['AMTA'][$i],
                                    'WHTAXTYP' => $_POST['WHTAXTYPA'][$i],
                                    'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ITEMACC', 'RPTFORMTYP', 'FORMROWNUM', 'RPTFORM');

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

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>