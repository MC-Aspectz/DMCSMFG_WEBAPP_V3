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
$javaFunc = new SearchSale;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
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
        if ($_POST['action'] == 'keepdata') { setOldValue(); }  
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'getElement') { getElement(); }
    }
    if (isset($_POST['SEARCH'])) { getDataSale(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
// $syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
// if(empty($syspvl)) {
//     $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
//     setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
// }
// $data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getElement() {

    if(isset($_POST['CUSTOMERCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['CUSTOMERFR'] = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD'] : '';
        } else {
            $data['CUSTOMERTO'] = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD'] : '';
        }
    } else if(isset($_POST['SALETRANNO']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['VOUCEHRNOFR'] = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO'] : '';
        } else {
            $data['VOUCHERNOTO'] = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO'] : '';
        }
    } else if(isset($_POST['CATALOGCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['CATEGORYFR'] = isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD'] : '';
        } else {
            $data['CATEGORYTO'] = isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD'] : '';
        }
    } else if(isset($_POST['ITEMCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['ITEMFR'] = isset($_POST['ITEMCD']) ? $_POST['ITEMCD'] : '';
        } else {
            $data['ITEMTO'] = isset($_POST['ITEMCD']) ? $_POST['ITEMCD'] : '';
        }
    } else if(isset($_POST['DIVISIONCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['DEPARTMENTFR'] = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD'] : '';
        } else {
            $data['DEPARTMENTTO'] = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD'] : '';
        }
    } else if(isset($_POST['STAFFCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['STAFFFR'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD'] : '';
        } else {
            $data['STAFFTO'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD'] : '';
        }
    } else if(isset($_POST['CURRENCYCD'])) {
        $data['CURRENCY'] = isset($_POST['CURRENCYCD']) ? $_POST['CURRENCYCD'] : '';
    }

    setSessionArray($data); 

    // if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($data);
}  

function getDataSale() {
    global $data; $data['ITEM'] = array();
    $data = getSessionData();
    $searchfunc = new SearchSale;
    $param = array( 'VOUCHERDATEFR' => !empty($_POST['VOUCHERDATEFR']) ? str_replace('-', '', $_POST['VOUCHERDATEFR']): '',
                    'VOUCHERDATETO' => !empty($_POST['VOUCHERDATETO']) ? str_replace('-', '', $_POST['VOUCHERDATETO']): '',
                    'VOUCEHRNOFR' => isset($_POST['VOUCEHRNOFR']) ? $_POST['VOUCEHRNOFR']: '',
                    'VOUCHERNOTO' => isset($_POST['VOUCHERNOTO']) ? $_POST['VOUCHERNOTO']: '',
                    'CUSTOMERFR' => isset($_POST['CUSTOMERFR']) ? $_POST['CUSTOMERFR']: '',
                    'CUSTOMERTO' => isset($_POST['CUSTOMERTO']) ? $_POST['CUSTOMERTO']: '',
                    'CATEGORYFR' => isset($_POST['CATEGORYFR']) ? $_POST['CATEGORYFR']: '',
                    'CATEGORYTO' => isset($_POST['CATEGORYTO']) ? $_POST['CATEGORYTO']: '',
                    'ITEMFR' => isset($_POST['ITEMFR']) ? $_POST['ITEMFR']: '',
                    'ITEMTO' => isset($_POST['ITEMTO']) ? $_POST['ITEMTO']: '',
                    'DEPARTMENTFR' => isset($_POST['DEPARTMENTFR']) ? $_POST['DEPARTMENTFR']: '',
                    'DEPARTMENTTO' => isset($_POST['DEPARTMENTTO']) ? $_POST['DEPARTMENTTO']: '',
                    'STAFFFR' => isset($_POST['STAFFFR']) ? $_POST['STAFFFR']: '',
                    'STAFFTO' => isset($_POST['STAFFTO']) ? $_POST['STAFFTO']: '',
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '');
    $getDataSale = $searchfunc->getDataSale($param);
    // echo '<pre>';
    // print_r($getDataSale);
    // echo '</pre>';
    if(is_array($getDataSale)) {
        $data['ITEM'] = $getDataSale;
        $CalVAT = $searchfunc->CalVAT($getDataSale);
        $getDataTmp = $searchfunc->getDataTmp();
        if(is_array($getDataTmp)) {
            $data['ITEM'] = $getDataTmp;
        }
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data['ITEM']);
    // echo '</pre>';
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'VOUCHERDATEFR', 'VOUCHERDATETO', 'VOUCEHRNOFR', 'VOUCHERNOTO', 'CUSTOMERFR', 'CUSTOMERTO', 'CATEGORYFR', 'CATEGORYTO', 'CURRENCY', 'ITEMFR', 'ITEMTO', 'DEPARTMENTFR', 'DEPARTMENTTO', 'STAFFFR', 'STAFFTO');

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