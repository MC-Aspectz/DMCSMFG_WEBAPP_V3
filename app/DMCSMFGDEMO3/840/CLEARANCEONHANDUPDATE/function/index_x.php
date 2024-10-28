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
$javaFunc = new ClearanceOnhandUpdate;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 23;
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
        if ($_POST['action'] == 'SEARCH') { searchs(); } 
        if ($_POST['action'] == 'getLoc') { getLoc(); } 
        if ($_POST['action'] == 'commit') { commitAll(); }
    }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'_LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'_LOAD', $load);
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
$CLEARANCE = $data['DRPLANG']['CLEARANCE'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
$data['YEAR'] = isset($load['YEAR']) ?  $load['YEAR']: '';
$data['MONTH'] = isset($load['MONTH']) ?  $load['MONTH']: '';
$data['LASTBATCHMONTH'] = isset($load['LASTBATCHMONTH']) ?  $load['LASTBATCHMONTH']: '';
if(empty($data['LOCTYP'])) { $data['LOCTYP'] = 0; }
if(empty($data['ITEM'])) { searchs(); }
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
function searchs() {
    global $data; unsetSessionkey('ITEM');
    $searchfunc = new ClearanceOnhandUpdate;
    $data['LOCCD'] = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $data['LOCTYP'] = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '0';
    $getDate = $searchfunc->getDate($data['LOCTYP'], $data['LOCCD']);
    $search = $searchfunc->search($data['LOCTYP'], $data['LOCCD']);
    if(!empty($search) && !empty($getDate)) {
        $data['CLEARANCEDT'] = $getDate['CLEARANCEDT'];
        $data['ITEM'] = $search; 
    }

    setSessionArray($data);

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($getDate);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function getLoc() {
    $javafunc = new ClearanceOnhandUpdate;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $getLoc = $javafunc->getLoc($LOCTYP, $LOCCD);
    echo json_encode($getLoc);
}

function commitAll() {
    $javafunc = new ClearanceOnhandUpdate;
    $RowParam = [];
    if(isset($_POST['CHECKROW'])) {
        for ($i = 0 ; $i < count($_POST['CLEARANCELOCTYP']); $i++) { 
            $RowParam[] = array('CHKROW' => isset($_POST['CHECKROW'][$i]) ? $_POST['CHECKROW'][$i]: 'F',
                                'CLEARANCELOCTYP' => isset($_POST['CLEARANCELOCTYP'][$i]) ? $_POST['CLEARANCELOCTYP'][$i]: '',
                                'CLEARANCELOCCD' => isset($_POST['CLEARANCELOCCD'][$i]) ? $_POST['CLEARANCELOCCD'][$i]: '',
                                'CLEARANCELOCNAME' => isset($_POST['CLEARANCELOCNAME'][$i]) ? $_POST['CLEARANCELOCNAME'][$i]: '');
        }
    }

    $param = array( 'CLEARANCEDT' => isset($_POST['CLEARANCEDT']) ? str_replace('-', '', $_POST['CLEARANCEDT']): '',
                    'CLEARANCE' => isset($_POST['CLEARANCE']) ? $_POST['CLEARANCE']: '',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $javafunc->commit($param);
    unsetSessionData();
    echo json_encode($commit);
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
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'LOCTYP', 'LOCCD', 'LOCNAME', 'CLEARANCEDT', 'CLEARANCE', 'YEAR', 'MONTH', 'LASTBATCHMONTH');
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