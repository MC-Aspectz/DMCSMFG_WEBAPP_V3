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
$javaFunc = new CalendarMaster;
$systemName = strtolower($appcode);

if(!empty($_GET)) {
    // 
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'create') { create(); }
    if ($_POST['action'] == 'FROMDATE') { getStartDay(); }
    if ($_POST['action'] == 'clearScreen') { clearScreen(); }
    if ($_POST['action'] == 'changeChkDay') { changeChkDay(); }
    if ($_POST['action'] == 'getCalScreen') { getCalScreen(); }
    if ($_POST['action'] == 'setHoliday') { setHoliday(); }
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
$load = $javaFunc->load();
$FACTORY = $data['DRPLANG']['FACTORY'];
$DAYOFWEEK = $data['DRPLANG']['DAYOFWEEK'];
$firstvalue = $DAYOFWEEK[array_key_first($DAYOFWEEK)];
unset($DAYOFWEEK[0]);
$DAYOFWEEK[0] = $firstvalue;
// echo '<pre>';
// print_r($DAYOFWEEK);
// echo '</pre>'; 
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
function getStartDay() {
    $javafunc = new CalendarMaster;
    $FROMDATE = isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '';
    $getRate = $javafunc->getStartDay($FROMDATE);
    echo json_encode($getRate);
}

function changeChkDay() {
    $javafunc = new CalendarMaster;
    $param = array( 'CHKDAY0' => isset($_POST['CHKDAY0']) ? $_POST['CHKDAY0']: 'F',
                    'CHKDAY1' => isset($_POST['CHKDAY1']) ? $_POST['CHKDAY1']: 'F',
                    'CHKDAY2' => isset($_POST['CHKDAY2']) ? $_POST['CHKDAY2']: 'F',
                    'FACTORYCODE' => isset($_POST['CHKDAY3']) ? $_POST['CHKDAY3']: 'F',
                    'CHKDAY4' => isset($_POST['CHKDAY4']) ? $_POST['CHKDAY4']: 'F',
                    'CHKDAY5' => isset($_POST['CHKDAY5']) ? $_POST['CHKDAY5']: 'F',
                    'CHKDAY5' => isset($_POST['CHKDAY5']) ? $_POST['CHKDAY5']: 'F',
                    'CHKDAY6' => isset($_POST['CHKDAY6']) ? $_POST['CHKDAY6']: 'F');
    // print_r($param);
    $changeChkDay = $javafunc->changeChkDay($param);
    echo json_encode($changeChkDay);
}

function getCalScreen() {
    $javafunc = new CalendarMaster;
    $param = array( 'STARTDAY' => isset($_POST['STARTDAY']) ? $_POST['STARTDAY']: '',
                    'ISHOLIDAY' => isset($_POST['ISHOLIDAY']) ? $_POST['ISHOLIDAY']: '',
                    'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'MONTH' => isset($_POST['MONTH']) ? str_replace('-', '', $_POST['MONTH']): '',
                    'FROMDATE' => isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '');
    // print_r($param);
    $getCalScreen = $javafunc->getCalScreen($param);
    echo json_encode($getCalScreen);
}

function create() {
    $javafunc = new CalendarMaster;
    $param = array( 'STARTDAY' => isset($_POST['STARTDAY']) ? $_POST['STARTDAY']: '',
                    'ISHOLIDAY' => isset($_POST['ISHOLIDAY']) ? $_POST['ISHOLIDAY']: '',
                    'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'FROMDATE' => isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '');
    // print_r($param);
    $create = $javafunc->create($param);
    echo json_encode($create);
}

function setHoliday() {
    $javafunc = new CalendarMaster;
    $param = $_POST;
    // print_r($param);
    $setHoliday = $javafunc->setHoliday($param);
    echo json_encode($setHoliday);
}


function clearScreen() {
    $javafunc = new CalendarMaster;
    $clearScreen = $javafunc->clearScreen();
    echo json_encode($clearScreen);
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
