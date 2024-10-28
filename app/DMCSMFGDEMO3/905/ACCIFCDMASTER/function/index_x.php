<?php
require_once('index_class.php');
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
$companyguide = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'];
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
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
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$javaFunc = new AccountIntMaster;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['ACCIFCD'])) {
        unsetSessionkey('ACCIFCD');
        unsetSessionkey('ACCIFNAME');
        $ACCIFCD = isset($_GET['ACCIFCD']) ? $_GET['ACCIFCD']: '';
        $query = $javaFunc->getACCIFCD($ACCIFCD);
        
        $data['ACCIFCD'] = $query['ACCIFCD'];
        $data['ACCIFNAME'] = $query['ACCIFNAME']; 
        //  print_r($query);
    } 

    // else if(isset($_GET['ACCIFCD_S'])) {
    //     $ACCIFCD_S = isset($_GET['ACCIFCD_S']) ? $_GET['ACCIFCD_S']: '';
    //     $query = $javaFunc->getACCIFCD($ACCIFCD_S);
    //     $data['ACCIFCD_S'] = $query['ACCIFCD'];
    //     $data['ACCIFNAMES'] = $query['ACCIFNAME']; 
    // }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data);
}

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if(isset($_POST['ACCIFCD_S'])) {
        $ACCIFCD_S = isset($_POST['ACCIFCD_S']) ? $_POST['ACCIFCD_S']: '';
        $ACCIFNAMES = isset($_POST['ACCIFNAMES']) ? $_POST['ACCIFNAMES']: '';
        $query = $javaFunc->search($ACCIFCD_S, $ACCIFNAMES);
        //print_r($query);
        $data['ITEM'] = $query;
        // print_r($_POST['STORAGECD_S']);
        if(!empty($query)) {
            setSessionArray($data); 
        }
    }

    if(checkSessionData()) { $data = getSessionData(); }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
}

$data['SYSPVL'] = $syspvl;
// print_r($data['SYSPVL']);
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
//  $data = getSessionData(); 
// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// 
// --------------------------------------------------------------------------//
function insert() {
    $javaInsrt = new AccountIntMaster;
    $Param = array( 'ACCIFCD' => $_POST['ACCIFCD'],
                    'ACCIFNAME' => $_POST['ACCIFNAME']);
    $insert = $javaInsrt->insAccifcd($Param);
    unsetSessionData();
    echo json_encode($insert);
}
// ACCIFCDID
function update() {
    $javaUpd = new AccountIntMaster;
    $Param = array( 'ACCIFCDID' => $_POST['ACCIFCD'],
                    'ACCIFCD' => $_POST['ACCIFCD'],
                    'ACCIFNAME' => $_POST['ACCIFNAME']);                  
    $update = $javaUpd->updAccifcd($Param);
    unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    $javaDel = new AccountIntMaster;    
    $Param = array('ACCIFCDID' => $_POST['ACCIFCD']);
    $deletes = $javaDel->delAccifcd($Param);   
    unsetSessionData();
    echo json_encode($deletes);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
    }
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array('ITEM', 'ACCIFCD', 'ACCIFNAME', 'ACCIFCD_S', 'ACCIFNAMES', 'SYSPVL', 'TXTLANG', 'DRPLANG');
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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}
?>