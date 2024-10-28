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
$javaFunc = new SaleAnalyze;
$systemName = strtolower($appcode);
// Table Row
$minrow = 1;
$maxrow = 31;

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
    // print_r($_POST);
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); rollbackTs(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'search') { search(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'getPreMonth') { getPreMonth(); }
        if ($_POST['action'] == 'getNextMonth') { getNextMonth(); }
        if ($_POST['action'] == 'refreshfData') { refreshfData(); }
        if ($_POST['action'] == 'commitAll') { commitAll(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); rollbackTs(); }
    }
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

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
$load = $javaFunc->load();
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$unitvalue = $data['DRPLANG']['UNIT'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
$data['PLANDT'] = isset($load['PLANDT']) ? $load['PLANDT']: '';
$data['YEARVALUE'] = isset($load['YEAR']) ? $load['YEAR']: '';
$data['MONTHVALUE'] = isset($load['MONTH']) ? $load['MONTH']: '';
$data['SYSTIMESTAMP'] = isset($load['SYSTIMESTAMP']) ? $load['SYSTIMESTAMP']: '';
$data['KAKUTEITORIKOM'] = isset($load['KAKUTEITORIKOM']) ? $load['KAKUTEITORIKOM']: '';
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
function getStaff() {
    $javafunc = new SaleAnalyze;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getItem() {
    $javafunc = new SaleAnalyze;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $YEAR = isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '';
    $MONTH = isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '';
    $query = $javafunc->getItem($YEAR, $MONTH, $ITEMCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function search() {
    $javaFunc = new SaleAnalyze;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $YEAR = isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '';
    $MONTH = isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '';
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                    'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                    'ONHAND' => isset($_POST['ONHAND']) ? str_replace(',', '', $_POST['ONHAND']): '0.00',
                    'PREBALANCEQTY' => isset($_POST['PREBALANCEQTY']) ? str_replace(',', '', $_POST['PREBALANCEQTY']): '0.00',
                    'PREORDERQTY' => isset($_POST['PREORDERQTY']) ? str_replace(',', '', $_POST['PREORDERQTY']): '0.00',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ENTRYDT' => isset($_POST['ENTRYDT']) ? str_replace('-', '', $_POST['ENTRYDT']): '',
                    'FORCASTDT' => isset($_POST['FORCASTDT']) ? str_replace('-', '', $_POST['FORCASTDT']): '',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'ITEMMINSTOCK' => isset($_POST['ITEMMINSTOCK']) ? str_replace(',', '', $_POST['ITEMMINSTOCK']): '0.00',
                    'ITEMFIXORDER' => isset($_POST['ITEMFIXORDER']) ? str_replace(',', '', $_POST['ITEMFIXORDER']): '0.00',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? str_replace(',', '', $_POST['ITEMBADRATE']): '0.00',
                    'FIRST_PREBALANCEQTY' => isset($_POST['FIRST_PREBALANCEQTY']) ? str_replace(',', '', $_POST['FIRST_PREBALANCEQTY']): '0.00',
                    'FIRST_PREORDERQTY' => isset($_POST['FIRST_PREORDERQTY']) ? str_replace(',', '', $_POST['FIRST_PREORDERQTY']): '0.00');
    // print_r($param);
    $data;
    $dateSet = $javaFunc->DateSet($param);
    if(!empty($dateSet)) {
        $param = array_merge($param, $dateSet);
        // print_r($param);
        $search = $javaFunc->search($param);
        $data = array_merge($search, $dateSet);
        // $getItem = $javaFunc->getItem($YEAR, $MONTH, $ITEMCD);
    }
    // print_r($getItem);
    echo json_encode($data);
}
  
function getNextMonth() {
    $javaFunc = new SaleAnalyze;
    $data;
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'CNT' => isset($_POST['CNT']) ? $_POST['CNT']: '',
                    'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'ENTRYDT' => isset($_POST['ENTRYDT']) ? str_replace('-', '', $_POST['ENTRYDT']): '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '',
                    'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? str_replace(',', '', $_POST['ITEMBADRATE']): '0.00',
                    'FORWARD' => isset($_POST['FORWARD']) ? $_POST['FORWARD']: 'F',
                    'PREBALANCEQTY' => isset($_POST['PREBALANCEQTY']) ? str_replace(',', '', $_POST['PREBALANCEQTY']): '0.00',
                    'PREORDERQTY' => isset($_POST['PREORDERQTY']) ? str_replace(',', '', $_POST['PREORDERQTY']): '0.00',
                    'FIRST_PREBALANCEQTY' => isset($_POST['FIRST_PREBALANCEQTY']) ? str_replace(',', '', $_POST['FIRST_PREBALANCEQTY']): '0.00',
                    'FIRST_PREORDERQTY' => isset($_POST['FIRST_PREORDERQTY']) ? str_replace(',', '', $_POST['FIRST_PREORDERQTY']): '0.00');
    for ($i = 1; $i <= 31; $i++) { 
        $param = array_merge($param, array('DATECD'.$i => $_POST['DATECD'.$i]));
        $param = array_merge($param, array('FORCAST'.$i => $_POST['FORCAST'.$i]));
        $param = array_merge($param, array('SALEORDER'.$i => $_POST['SALEORDER'.$i]));
        $param = array_merge($param, array('ORDER'.$i => $_POST['ORDER'.$i]));
        $param = array_merge($param, array('BALANCE'.$i => $_POST['BALANCE'.$i]));
        $param = array_merge($param, array('DISPPLAN'.$i => isset($_POST['DISPPLAN'.$i]) ? $_POST['DISPPLAN'.$i]: ''));
        $param = array_merge($param, array('PLAN'.$i => $_POST['PLAN'.$i]));
        $param = array_merge($param, array('HOLIDAY'.$i => $_POST['HOLIDAY'.$i]));
    }
    // print_r($param);
    $getNextMonth = $javaFunc->getNextMonth($param);
    if(!empty($getNextMonth)) {
        $param = array_merge($param, $getNextMonth);
        $getScrAfterPreNxt = $javaFunc->getScrAfterPreNxt($param);
        $getHdOnPreNxt = $javaFunc->getHdOnPreNxt($param);
        // print_r($param);
        $data = array_merge($getScrAfterPreNxt, $getHdOnPreNxt);
        $data = array_merge($data, $getNextMonth);
    }
    // print_r($data);
    echo json_encode($data);
}

function getPreMonth() {
    $javaFunc = new SaleAnalyze;
    $data;
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'CNT' => isset($_POST['CNT']) ? $_POST['CNT']: '',
                    'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'ENTRYDT' => isset($_POST['ENTRYDT']) ? str_replace('-', '', $_POST['ENTRYDT']): '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '',
                    'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? str_replace(',', '', $_POST['ITEMBADRATE']): '0.00',
                    'FORWARD' => isset($_POST['FORWARD']) ? $_POST['FORWARD']: 'F',
                    'PREBALANCEQTY' => isset($_POST['PREBALANCEQTY']) ? str_replace(',', '', $_POST['PREBALANCEQTY']): '0.00',
                    'PREORDERQTY' => isset($_POST['PREORDERQTY']) ? str_replace(',', '', $_POST['PREORDERQTY']): '0.00',
                    'FIRST_PREBALANCEQTY' => isset($_POST['FIRST_PREBALANCEQTY']) ? str_replace(',', '', $_POST['FIRST_PREBALANCEQTY']): '0.00',
                    'FIRST_PREORDERQTY' => isset($_POST['FIRST_PREORDERQTY']) ? str_replace(',', '', $_POST['FIRST_PREORDERQTY']): '0.00');
    for ($i = 1; $i <= 31; $i++) {
        $param = array_merge($param, array('DATECD'.$i => $_POST['DATECD'.$i]));
        $param = array_merge($param, array('FORCAST'.$i => $_POST['FORCAST'.$i]));
        $param = array_merge($param, array('SALEORDER'.$i => $_POST['SALEORDER'.$i]));
        $param = array_merge($param, array('ORDER'.$i => $_POST['ORDER'.$i]));
        $param = array_merge($param, array('BALANCE'.$i => $_POST['BALANCE'.$i]));
        $param = array_merge($param, array('DISPPLAN'.$i => isset($_POST['DISPPLAN'.$i]) ? $_POST['DISPPLAN'.$i]: ''));
        $param = array_merge($param, array('PLAN'.$i => $_POST['PLAN'.$i]));
        $param = array_merge($param, array('HOLIDAY'.$i => $_POST['HOLIDAY'.$i]));
    }
    // print_r($param);
    $getPreMonth = $javaFunc->getPreMonth($param);
    if(!empty($getPreMonth)) {
        $param = array_merge($param, $getPreMonth);
        $getScrAfterPreNxt = $javaFunc->getScrAfterPreNxt($param);
        $getHdOnPreNxt = $javaFunc->getHdOnPreNxt($param);
        // print_r($param);
        $data = array_merge($getScrAfterPreNxt, $getHdOnPreNxt);
        $data = array_merge($data, $getPreMonth);
    }
    // print_r($data);
    echo json_encode($data);
}

function refreshfData() {
    $javaFunc = new SaleAnalyze;
    // print_r($_POST);
    $paramrefresh = array(  'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                            'DATECD'.$_POST['NUM'] => isset($_POST['DATECD'.$_POST['NUM']]) ? $_POST['DATECD'.$_POST['NUM']]: '',
                            'PLAN'.$_POST['NUM'] => isset($_POST['PLAN'.$_POST['NUM']]) ? $_POST['PLAN'.$_POST['NUM']]: '',
                            'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '');
    // print_r($paramrefresh);
    $paramScrAfter = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                            'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? $_POST['ITEMBADRATE']: '', 
                            'DATECD1' => isset($_POST['DATECD1']) ? $_POST['DATECD1']: '', 
                            'FIRST_PREBALANCEQTY' => isset($_POST['FIRST_PREBALANCEQTY']) ? $_POST['FIRST_PREBALANCEQTY']: '', 
                            'FIRST_PREORDERQTY' => isset($_POST['FIRST_PREORDERQTY']) ? $_POST['FIRST_PREORDERQTY']: '',                     
                            'CNT' => isset($_POST['CNT']) ? $_POST['CNT']: '');
    // print_r($paramScrAfter);
    $refreshfData = $javaFunc->refreshfData($paramrefresh);
    // // print_r($refreshfData);
    $getScrAfterRefresh = $javaFunc->getScrAfterRefresh($paramScrAfter);
    // // print_r($getScrAfterRefresh);
    echo json_encode($getScrAfterRefresh);
}

function commitAll() {
    $javaFunc = new SaleAnalyze;
    // print_r($_POST);
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '', 
                    'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                    'KAKUTEITORIKOM' => isset($_POST['KAKUTEITORIKOM']) ? $_POST['KAKUTEITORIKOM']: 'F',
                    'ENTRYDT' => isset($_POST['ENTRYDT']) ? str_replace('-', '', $_POST['ENTRYDT']): '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'PLANDT' => isset($_POST['PLANDT']) ? str_replace('-', '', $_POST['PLANDT']): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '',
                    'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? str_replace(',', '', $_POST['ITEMBADRATE']): '0.00',
                    'FORWARD' => isset($_POST['FORWARD']) ? $_POST['FORWARD']: 'F');
    for ($i = 1; $i <= 31; $i++) { 
        $param = array_merge($param, array('DATECD'.$i => $_POST['DATECD'.$i]));
        $param = array_merge($param, array('FORCAST'.$i => $_POST['FORCAST'.$i]));
        $param = array_merge($param, array('SALEORDER'.$i => $_POST['SALEORDER'.$i]));
        $param = array_merge($param, array('ORDER'.$i => $_POST['ORDER'.$i]));
        $param = array_merge($param, array('BALANCE'.$i => $_POST['BALANCE'.$i]));
        $param = array_merge($param, array('DISPPLAN'.$i => isset($_POST['DISPPLAN'.$i]) ? $_POST['DISPPLAN'.$i]: ''));
        $param = array_merge($param, array('PLAN'.$i => $_POST['PLAN'.$i]));
        $param = array_merge($param, array('HOLIDAY'.$i => $_POST['HOLIDAY'.$i]));
    }
    // print_r($param);
    $commitAll = $javaFunc->commitAll($param);
    // print_r($commitAll);
    rollbackTs();
    unsetSessionData($_SESSION['APPCODE']);
    echo json_encode($commitAll);
}

function rollbackTs() {
    $javaFunc = new SaleAnalyze;
    $SYSTIMESTAMP = isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '';
    // // print_r($SYSTIMESTAMP);
    $rollbackTs = $javaFunc->rollbackTs($SYSTIMESTAMP);
    // // print_r($rollbackTs);
    echo json_encode($rollbackTs);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        unsetSessionData($_SESSION['APPCODE']);
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'SYSTIMESTAMP', 'YEARVALUE', 'MONTHVALUE', 'KAKUTEITORIKOM', 'PLANDT', 'ENTRYDT', 'STAFFCD', 'STAFFNAME', 'ITEMCD', 'ITEMNAME', 'ITEMLEADTIME', 'ITEMDRAWNO', 'ITEMSPEC', 'ITEMUNITTYP', 'ITEMBADRATE', 'CATALOGCD', 'CATALOGNAME', 'ITEMFIXORDER', 'ITEMMINSTOCK', 'ONHAND', 'PROPLANQTY', 'SHIPPLANQTY', 'CARRYQTY', 'FIRST_PREBALANCEQTY', 'FIRST_PREORDERQTY', 'PROPLAN1STQTY', 'PROPLAN2STQTY', 'PROPLAN3STQTY', 'PREBALANCEQTY', 'SHIPPLAN1STQTY', 'SHIPPLAN2STQTY', 'SHIPPLAN3STQTY', 'PREORDERQTY', 'SYSEN_SEARCHP', 'SYSEN_SEARCHN', 'SYSEN_YEAR', 'SYSEN_MONTH', 'FORWARD', 'STARTDT', 'TODATE', 'CNT', 'PLAN', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

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