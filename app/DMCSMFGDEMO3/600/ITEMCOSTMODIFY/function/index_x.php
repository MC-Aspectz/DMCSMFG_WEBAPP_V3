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
$javaFunc = new ItemCostModify;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 16;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 
}

if (!empty($_POST)) {
    if(isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'getItem') { getItem(); }        
        if ($_POST['action'] == 'SEARCH') { searchCost(); }
        if ($_POST['action'] == 'ChkCodeTb') { ChkCodeTb(); }
        if ($_POST['action'] == 'update') { update(); }
    }
}

// ------------------------- CALL Langauge AND Privilege -------------------//
if(isset($_SESSION['APPCODE'])) {
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
    $COSTSC = $data['DRPLANG']['COSTSC'];
    $COST_NAME = $data['DRPLANG']['COST_NAME'];
    // print_r($data['SYSPVL']);
    // echo '<pre>';
    // print_r($data['TXTLANG']);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($data['DRPLANG']);
    // echo '</pre>';
}
// --------------------------------------------------------------------------//

function update() {
    $javaFunc = new ItemCostModify;
    setSessionData('BMVERSION', isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '');
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'COSTSC' => isset($_POST['COSTSC']) ? $_POST['COSTSC']: '',
                    'BMVERSION' => isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '');
    for ($i = 0 ; $i < count($_POST['COSTNEW']); $i++) { 
        // print_r($_POST['COSTNEW'][$i]);
        $param['COSTNEW'.$i+1] = isset($_POST['COSTNEW'][$i]) ? implode(explode(',', $_POST['COSTNEW'][$i])): '';
        $param['UPDFLG'.$i+1] = isset($_POST['UPDFLG'][$i]) ? $_POST['UPDFLG'][$i] : '0';

    }
    // print_r($param);
    $update = $javaFunc->update($param);
    echo json_encode($update);
}

function getItem() {
    $javaFunc = new ItemCostModify;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'COSTSC' => isset($_POST['COSTSC']) ? $_POST['COSTSC']: '',
                    'BMVERSION' => isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '');
    $query = $javaFunc->getItem($param);
    $data = $query;
    echo json_encode($data);
}

function ChkCodeTb() {
    $javaFunc = new ItemCostModify;
    $chkCodeTb = $javaFunc->ChkCodeTb();
    echo json_encode($chkCodeTb);
}

function setOldValue() {
    setSessionArray($_POST); 
   // print_r($_POST);
}

function setSessionArray($arr){
    $keepField = array( 'TXTLANG','DRPLANG', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'BMVERSION', 'COSTSC', 'CURRENCYDISP', 'COMVAL', 'ROWCOUNTER');
    foreach($arr as $k => $v){
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