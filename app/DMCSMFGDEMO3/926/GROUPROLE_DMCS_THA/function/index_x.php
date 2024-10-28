<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
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
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new GroupRole;
$systemName = strtolower($appcode);
$data = array();
$minrowA = 0;
$maxrowA = 15;
$minrowB = 0;
$maxrowB = 15;
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if(isset($_POST['SEARCH'])) {
        $data['GROUPCD'] = isset($_POST['GROUPCD']) ? $_POST['GROUPCD']: '';
        $data['APPPACK'] = isset($_POST['APPPACK']) ? $_POST['APPPACK']: '';
        $queryAvailable = $javaFunc->searchAvailable($data['GROUPCD'], $data['APPPACK']);
        $queryGrant = $javaFunc->searchGrant($data['GROUPCD'], $data['APPPACK']);

        $data['AVAILABLE'] = $queryAvailable;
        $data['GRANT'] = $queryGrant;
   
        setSessionArray($data); 
    
        if(checkSessionData()) { $data = getSessionData(); }
    }

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'grant') { grant(); }
        if ($_POST['action'] == 'revoke') { revoke(); }
        if ($_POST['action'] == 'grantAll') { grantAll(); }
        if ($_POST['action'] == 'revokeAll') { revokeAll(); }
        if ($_POST['action'] == 'reflect') { reflect(); }
    }
}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
// if(!empty($_GET)) {

// }
// ------------------------- CALL Langauge AND Privilege -------------------//
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
$apppack = $data['DRPLANG']['APPPACK'];
$groupcode = $data['DRPLANG']['GROUPCODE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function reflect() {
    $javaReflect = new GroupRole;
    $RowParam = array();
    foreach ($_POST['APPCOMMIT'] as $index => $value) { 
        $RowParam[] = array('APPCD2' => $_POST['APPCODE2'][$index],
                            'APPNAME2' => $_POST['APPNAME2'][$index],
                            'APPCOMMIT' => $_POST['APPCOMMIT'][$index],
                            'APPMODIFY' => $_POST['APPMODIFY'][$index],
                            'APPDELETE' => $_POST['APPDELETE'][$index]);
    }
    // print_r($RowParam);
    $Param = array( 'GROUPCD' => $_POST['GROUPCD'],
                    'APPPACK' => $_POST['APPPACK'],
                    'DATA' => $RowParam);
    // print_r($Param);
    $reflect = $javaReflect->reflect($Param);
    echo json_encode($reflect);
}

function grant() {
    $javaGrant = new GroupRole;
    $grant = $javaGrant->grant($_POST['GROUPCD'], $_POST['APPPACK'], $_POST['APPCD1']);
    unsetSessionkey('APPCD1');
    echo json_encode($grant);
}

function grantAll() {
    global $data;
    $data = getSessionData();
    $javaGrantAll = new GroupRole;
    // GROUPCD,APPPACK,DVW1,GROUPCD,APPPACK,SYSLANG,GROUPCD,APPPACK,SYSLANG
    foreach ($data['AVAILABLE'] as $key => $value) { 
        if(is_array($value)) {
            $RowParam[] = array('APPCD1' => $value['APPCD1'],
                                'APPNAME1' => $value['APPNAME1']);
        } else {
            $RowParam[] = array('APPCD1' => $data['AVAILABLE']['APPCD1'],
                                'APPNAME1' => $data['AVAILABLE']['APPNAME1']);
          break;
        }
    }
    $Param = array( 'GROUPCD' => $_POST['GROUPCD'],
                    'APPPACK' => $_POST['APPPACK'],
                    'DATA' => $RowParam);
    // print_r($Param);
    $grantAll = $javaGrantAll->grantAll($Param);
    // unsetSessionData();
    echo json_encode($grantAll);
}

function revoke() {
    $javaRevoke = new GroupRole;
    $revoke = $javaRevoke->revoke($_POST['GROUPCD'], $_POST['APPPACK'], $_POST['APPCD2']);
    unsetSessionkey('APPCD2');
    echo json_encode($revoke);
}

function revokeAll() {
    global $data;
    $data = getSessionData();
    $javaRevokeAll = new GroupRole;
    // GROUPCD,APPPACK,DVW2,GROUPCD,APPPACK,SYSLANG,GROUPCD,APPPACK,SYSLANG
    foreach ($data['GRANT'] as $key => $value) { 
        if(is_array($value)) {
            $RowParam[] = array('APPCD2' => $value['APPCD2'],
                                'APPNAME2' => $value['APPNAME2']);
        } else {
            $RowParam[] = array('APPCD2' => $data['GRANT']['APPCD2'],
                                'APPNAME2' => $data['GRANT']['APPNAME2']);
          break;
        }
    }
    $Param = array( 'GROUPCD' => $_POST['GROUPCD'],
                    'APPPACK' => $_POST['APPPACK'],
                    'DATA' => $RowParam,
                   );
    // print_r($Param);
    $revokeAll = $javaRevokeAll->revokeAll($Param);
    // unsetSessionData();
    echo json_encode($revokeAll);
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
    $keepField = array("SYSPVL", "TXTLANG", 'DRPLANG', 'GROUPCD', 'APPPACK', 'AVAILABLE', 'GRANT');
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