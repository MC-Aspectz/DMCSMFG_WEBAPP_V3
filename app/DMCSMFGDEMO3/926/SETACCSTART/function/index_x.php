<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
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
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
    }
} else {
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
$javaFunc = new SetAccStart;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['divisioncd']) || isset($_GET['DIVISIONCD'])) {
        $data['DIVISIONCD'] = isset($_GET['DIVISIONCD']) ? $_GET['DIVISIONCD']: $_GET['divisioncd'];
        $query = $javaFunc->getDiv($data['DIVISIONCD']);
        $data = $query;
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "setAmount") { setAmount(); }
        if ($_POST['action'] == "commit") { commit(); } 
    }
    if (isset($_POST['SEARCH'])) { search(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
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
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
$accyearvalue = $data['DRPLANG']['ACCYEARVALUE'];
$data['RPTFORMTYP'] = 'FORM1';
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: '';
$data['YEAR'] = isset($load['YEAR']) ? $load['YEAR']: '';
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($load);
// echo "</pre>";
// --------------------------------------------------------------------------//
function commit() {
    global $data;
    $data = getSessionData();
    $javafunc = new SetAccStart;
    $param = array( 'ACCY' => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    'YEAR' => isset($_POST['YEAR']) ? $_POST['YEAR']: '',
                    'MONTH' => isset($_POST['MONTH']) ? $_POST['MONTH']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'DATA' => isset($data['DATA']) ? $data['DATA']: '');
    // print_r($param);
    $commit = $javafunc->commit($param);
    echo json_encode($commit);
}

function setAmount() {
    $ACCTYP = isset($_POST['ACCTYPA']) ? $_POST['ACCTYPA']: '';
    $AMT = isset($_POST['AMTA']) ? $_POST['AMTA']: '';
    $setfunc = new SetAccStart;
    $setAmount = $setfunc->setAmount($ACCTYP, $AMT);
    echo json_encode($setAmount);
}

function search() {
    global $data;
    $data = getSessionData();
    $searchfunc = new SetAccStart;
    $ACCY = isset($_POST['ACCY']) ? $_POST['ACCY']: '';
    $YEAR = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
    $MONTH = isset($_POST['MONTH']) ? $_POST['MONTH']: '';
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $search = $searchfunc->search($ACCY, $YEAR, $MONTH, $DIVISIONCD);
    $getSum = $searchfunc->getSum($ACCY, $YEAR, $MONTH, $DIVISIONCD);
    if(!empty($getSum)) {
        $data['TTL_ACCAMT1'] = $getSum['TTL_ACCAMT1'];
        $data['TTL_ACCAMT2'] = $getSum['TTL_ACCAMT2'];
    }
    if(!empty($search)) {
        for ($i = 1 ; $i <= count($search); $i++) {
            $data['ITEM'][$i] = $search[$i]; 
        }
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo "<pre>";
    // print_r($search);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($getSum);
    // echo "</pre>";
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
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}


function keepItemData() {
    global $data;
    $data = getSessionData();
    for ($i = 1 ; $i <= count($data['ITEM']); $i++) { 
        $data['DATA'][$i] = array(  'ROWNO' => $i,
                                    'ACCCD' => $data['ITEM'][$i]['ACCCD'],
                                    'ACCTYP' => $data['ITEM'][$i]['ACCTYP'],
                                    'AMT' => $_POST['AMT'][$i-1]
                                );
    }
    setSessionArray($data);
    // print_r($data['DATA']);
}


/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ACCY', 'YEAR', 'YEAR2', 'MONTH', 'DIVISIONCD', 'DIVISIONNAME', 'TTL_ACCAMT1', 'TTL_ACCAMT2', 'ITEM', 'DATA');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
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