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
$javaFunc = new InqSaleOrder;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 20;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    // 
}
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
	if (isset($_POST['action'])) {
	    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
	    if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'CUSTOMERCD') { getCm(); }
        if ($_POST['action'] == 'ITEMCD') { getIm(); }
        if ($_POST['action'] == 'CATALOGCD') { getCat(); }
        if ($_POST['action'] == 'STAFFCD') { getEm1(); }
        if ($_POST['action'] == 'SEARCH') { InqSalesOrder01(); }
	}
}
// 
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
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
$TAX_TYPE = $data['DRPLANG']['TAX_TYPE'];
$CURRENCY = $data['DRPLANG']['CURRENCY'];
$INSPECTION = $data['DRPLANG']['INSPECTION'];
$CONFIRM_TYPE = $data['DRPLANG']['CONFIRM_TYPE'];
$ORDERSEARCHTYPE = $data['DRPLANG']['ORDERSEARCHTYPE'];
if(empty($data['P5'])) { $data['P5'] = 2; }
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function InqSalesOrder01() {
    global $data; $data = $_POST;
    $data['ITEM'] = array();
    $searchfunc = new InqSaleOrder;
    $param = array( 'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'SALESCONFIRM' => isset($_POST['SALESCONFIRM']) ? $_POST['SALESCONFIRM']: '',
                    'FACTORYCONFIRM' => isset($_POST['FACTORYCONFIRM']) ? $_POST['FACTORYCONFIRM']: '',
                    'P1' => isset($_POST['P1']) ? str_replace('-', '', $_POST['P1']): '',
                    'P2' => isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '',
                    'P3' => isset($_POST['P3']) ? str_replace('-', '', $_POST['P3']): '',
                    'P4' => isset($_POST['P4']) ? str_replace('-', '', $_POST['P4']): '',
                    'P5' => isset($_POST['P5']) ? str_replace('-', '', $_POST['P5']): '');
    // print_r($param);
    $InqSalesOrder01 = $searchfunc->InqSalesOrder01($param);
    // echo '<pre>';
    // print_r($InqSalesOrder01);
    // echo '</pre>';
    if(!empty($InqSalesOrder01)) {
        $data['ITEM'] = $InqSalesOrder01;
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

function getCm() {
    $javafunc = new InqSaleOrder;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCm($CUSTOMERCD);
    if(!empty($query)) { setSessionArray($query); } else { $query = array('CUSTOMERCD' => '', 'CUSTOMERNAME_S' => '');  }
    echo json_encode($query);
}  

function getIm() {
    $javafunc = new InqSaleOrder;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $query = $javafunc->getIm($ITEMCD);
    if(!empty($query)) { setSessionArray($query); } else { $query = array('ITEMCD' => '', 'ITEMNAME' => '');  }
    echo json_encode($query);
}  

function getCat() {
    $javafunc = new InqSaleOrder;
    $CATALOGCD = isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '';
    $query = $javafunc->getCat($CATALOGCD);
    if(!empty($query)) { setSessionArray($query); } else { $query = array('CATALOGCD' => '', 'CATALOGNAME' => '');  }
    echo json_encode($query);
}  

function getEm1() {
    $javafunc = new InqSaleOrder;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getEm1($STAFFCD);
    if(!empty($query)) { setSessionArray($query); } else { $query = array('STAFFCD' => '', 'STAFFNAME' => '');  }
    echo json_encode($query);
}  

function setOldValue() {
    setSessionArray($_POST); 
    print_r($_POST);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'CUSTOMERCD', 'CUSTOMERNAME_S', 'ITEMCD', 'ITEMNAME', 'PURORDERNOID', 'ITEMQTYINCASE', 'ITEMTAXTYP', 'CATALOGCD', 'CATALOGNAME', 'STAFFCD', 'STAFFNAME', 'SALESCONFIRM', 'FACTORYCONFIRM', 'P1', 'P2', 'P3', 'P4', 'P5');

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