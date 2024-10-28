<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new ACCPLCalculate;
$systemName = strtolower($appcode);
$data = array();
$minrowA = 0;
$maxrowA = 14;
$minrowB = 0;
$maxrowB = 14;
$data['DVWA'] = '';
$data['DVWP'] = '';

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "addPLAccount") { addPLAccount(); }
        if ($_POST['action'] == "takePLAccount") { takePLAccount(); }
    }
}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['ACCGROUPS'])) {
        $data['ACCGROUPS'] = isset($_GET['ACCGROUPS']) ? $_GET['ACCGROUPS']: '';
        $query1 = $javaFunc->search($_GET['ACCGROUPS']);
        $query2 = $javaFunc->searchPL($_GET['ACCGROUPS']);
        $data['DVWA'] = $query1;
        $data['DVWP'] = $query2;

        setSessionArray($data); 

        if(checkSessionData()) { $data = getSessionData(); }
    }
    // echo "<pre>";
    // print_r($query1);
    // echo "</pre>";
}

// ------------------------- CALL Langauge AND Privilege -------------------//
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
$actyp = $data['DRPLANG']['DC_TYP'];
$acc01 = $data['DRPLANG']['ACC01'];
$load = getSystemData($_SESSION['APPCODE']."_LOAD");
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE']."_LOAD", $load);
}
$data['LOAD'] = $load;
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function addPLAccount() {
    $javaaddPLAccount = new ACCPLCalculate;
    $RowParam = array();
    foreach ($_POST['CHECKROW1'] as $index => $value) { 
        $RowParam[] = array('ACCOUNTCD' => $_POST['ACCOUNTCD1'][$index],
                            'ACCOUNTNAME' => $_POST['ACCOUNTNAME1'][$index],
                            'ACCOUNTGROUP' => $_POST['ACCOUNTGROUP1'][$index],
                            'ACCOUNTTYP' => $_POST['ACCOUNTTYP1'][$index],
                            'CHECKROW' => $_POST['CHECKROW1'][$index]);
    }
    // print_r($RowParam);
    $Param = array( "DVWA" => '',
                    "DATA" => $RowParam);
    // print_r($Param);
    $addPLAccount = $javaaddPLAccount->addPLAccount($Param);
    echo json_encode($addPLAccount);
}

function takePLAccount() {
    $javatakePLAccount = new ACCPLCalculate;
    $RowParam = array();
    foreach ($_POST['CHECKROW2'] as $index => $value) { 
        $RowParam[] = array('ACCOUNTCD' => $_POST['ACCOUNTCD2'][$index],
                            'ACCOUNTNAME' => $_POST['ACCOUNTNAME2'][$index],
                            'ACCOUNTGROUP' => $_POST['ACCOUNTGROUP2'][$index],
                            'ACCOUNTTYP' => $_POST['ACCOUNTTYP2'][$index],
                            'CHECKROW' => $_POST['CHECKROW2'][$index]);
    }
    // print_r($RowParam);
    $Param = array( "DVWP" => '',
                    "DATA" => $RowParam);
    // print_r($Param);
    $takePLAccount = $javatakePLAccount->takePLAccount($Param);
    echo json_encode($takePLAccount);
}

function setOldValue() {
    // print_r($_POST);
    setSessionArray($_POST); 
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
        $_SESSION['APPCODE'] = '';
    }
}


function setSessionArray($arr){
    $keepField = array("SYSPVL", "TXTLANG", 'DRPLANG', 'LOAD', 'PLACCCD', 'PLACCNAME', 'PLACCTYP', 'ACCGROUPS', 'DVWA', 'DVWP');
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