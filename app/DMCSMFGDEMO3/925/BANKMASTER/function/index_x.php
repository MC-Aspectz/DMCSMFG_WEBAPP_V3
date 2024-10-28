<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
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

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
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
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$data = array();
$javaFunc = new BankMaster;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 14;
$BANKCD = '';

if(!empty($_GET)) {
    // 
}

if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'SEARCH') { searchs(); }
        if ($_POST['action'] == 'BANKCD') { getBank(); }
        if ($_POST['action'] == 'INSERT') { insert(); }
        if ($_POST['action'] == 'UPDATE') { update(); }
        if ($_POST['action'] == 'DELETE') { deletes(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); }
    }

}

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
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function searchs() {
    global $data; unsetSessionkey('ITEM');
    $searchfunc = new BankMaster;
    $data['BANKCD_S'] = isset($_POST['BANKCD_S']) ? $_POST['BANKCD_S']: '';
    $search = $searchfunc->searchBank($data['BANKCD_S']);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
    }

    setSessionArray($data);

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function getBank() {
    $javafunc = new BankMaster;
    $BANKCD = isset($_POST['BANKCD']) ? $_POST['BANKCD']: '';
    $getBank = $javafunc->getBank($BANKCD);
    echo json_encode($getBank);
}

function insert() {
    $javaInsrt = new BankMaster;
    $Param = array( 'BANKCD_S' => isset($_POST['BANKCD_S']) ? $_POST['BANKCD_S'] : '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD'] : '',
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME'] : '');
                    // print_r($Param);
    $insert = $javaInsrt->insBank($Param);
    unsetSessionData();
    echo json_encode($insert);
}

function update() {
    $javaUpd = new BankMaster;
    $Param = array( 'BANKCD_S' => isset($_POST['BANKCD_S']) ? $_POST['BANKCD_S'] : '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD'] : '',
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME'] : '');
    $update = $javaUpd->updBank($Param);
    unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    $javaDel = new BankMaster;
    $Param = array( 'BANKCD_S' => isset($_POST['BANKCD_S']) ? $_POST['BANKCD_S'] : '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD'] : '');
    $deletes = $javaDel->delBank($Param);
    unsetSessionData();
    echo json_encode($deletes);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'BANKCD_S');
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

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
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

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}
?>