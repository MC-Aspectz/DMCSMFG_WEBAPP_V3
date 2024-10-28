<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
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
$javaFunc = new AccWHTMethod;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 8;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    ///
}

// ------------------------- CALL Langauge AND Privilege -------------------//
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
$taxtype = $data['DRPLANG']['TAXTYPE'];
$tax_type = $data['DRPLANG']['TAX_TYPE'];
$taxcondition = $data['DRPLANG']['TAXCONDITION'];
$typeofincome = $data['DRPLANG']['TYPEOFINCOME'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "delete") { delete(); }
    }
    if (isset($_POST['SEARCH'])) { search(); }
}
//--------------------------------------------------------------------------------
function search() {
    global $data; 
    $data['ITEM'] = array();
    $searchfunc = new AccWHTMethod;
    $query = $searchfunc->search();
    if(!empty($query)) {
        $data['ITEM'] = $query;
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo "<pre>";
    // print_r($data['ITEM']);
    // echo "</pre>";
}

function insert() {
    $insfunc = new AccWHTMethod;
    $param = array( 'ROWNO' => isset($_POST['ROWNO']) ? $_POST['ROWNO']: '',
                    'METHODCD' => isset($_POST['METHODCD']) ? $_POST['METHODCD']: '',
                    'METHODNAME' => isset($_POST['METHODNAME']) ? $_POST['METHODNAME']: '',
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME']: '',
                    'BRANCHNAME' => isset($_POST['BRANCHNAME']) ? $_POST['BRANCHNAME']: '',
                    'MEMO' => isset($_POST['MEMO']) ? $_POST['MEMO']: '',
                    'METHODCDID' => isset($_POST['METHODCDID']) ? $_POST['METHODCDID']: '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD']: '',
                    'BRANCHCD' => isset($_POST['BRANCHCD']) ? $_POST['BRANCHCD']: '',
                    'PMNOTE01' => isset($_POST['PMNOTE01']) ? $_POST['PMNOTE01']: 'T',
                    'PMNOTE02' => isset($_POST['PMNOTE02']) ? $_POST['PMNOTE02']: '',
                    'PMNOTE03' => isset($_POST['PMNOTE03']) ? $_POST['PMNOTE03']: '',
                    'PMNOTE04' => isset($_POST['PMNOTE04']) ? $_POST['PMNOTE04']: '',
                    'PMNOTE05' => isset($_POST['PMNOTE05']) ? $_POST['PMNOTE05']: '',
                    'PMNOTE06' => isset($_POST['PMNOTE06']) ? $_POST['PMNOTE06']: '',
                    'PMNOTE07' => isset($_POST['PMNOTE07']) ? $_POST['PMNOTE07']: '',
                    'PMNOTE08' => isset($_POST['PMNOTE08']) ? $_POST['PMNOTE08']: '',
                    'PMNOTE09' => isset($_POST['PMNOTE09']) ? $_POST['PMNOTE09']: '',
                    'PMNOTE10' => isset($_POST['PMNOTE10']) ? $_POST['PMNOTE10']: '');
    // print_r($param);
    $insert = $insfunc->insert($param);
    echo json_encode($insert);
}

function update() {
    $updfunc = new AccWHTMethod;
    $param = array( 'ROWNO' => isset($_POST['ROWNO']) ? $_POST['ROWNO']: '',
                    'METHODCD' => isset($_POST['METHODCD']) ? $_POST['METHODCD']: '',
                    'METHODNAME' => isset($_POST['METHODNAME']) ? $_POST['METHODNAME']: '',
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME']: '',
                    'BRANCHNAME' => isset($_POST['BRANCHNAME']) ? $_POST['BRANCHNAME']: '',
                    'MEMO' => isset($_POST['MEMO']) ? $_POST['MEMO']: '',
                    'METHODCDID' => isset($_POST['METHODCDID']) ? $_POST['METHODCDID']: '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD']: '',
                    'BRANCHCD' => isset($_POST['BRANCHCD']) ? $_POST['BRANCHCD']: '',
                    'PMNOTE01' => isset($_POST['PMNOTE01']) ? $_POST['PMNOTE01']: 'T',
                    'PMNOTE02' => isset($_POST['PMNOTE02']) ? $_POST['PMNOTE02']: '',
                    'PMNOTE03' => isset($_POST['PMNOTE03']) ? $_POST['PMNOTE03']: '',
                    'PMNOTE04' => isset($_POST['PMNOTE04']) ? $_POST['PMNOTE04']: '',
                    'PMNOTE05' => isset($_POST['PMNOTE05']) ? $_POST['PMNOTE05']: '',
                    'PMNOTE06' => isset($_POST['PMNOTE06']) ? $_POST['PMNOTE06']: '',
                    'PMNOTE07' => isset($_POST['PMNOTE07']) ? $_POST['PMNOTE07']: '',
                    'PMNOTE08' => isset($_POST['PMNOTE08']) ? $_POST['PMNOTE08']: '',
                    'PMNOTE09' => isset($_POST['PMNOTE09']) ? $_POST['PMNOTE09']: '',
                    'PMNOTE10' => isset($_POST['PMNOTE10']) ? $_POST['PMNOTE10']: '');
    // print_r($param);
    $update  = $updfunc->update($param);
    echo json_encode($update);
}

function delete() {
    $delfunc = new AccWHTMethod;
    $param = array( 'ROWNO' => isset($_POST['ROWNO']) ? $_POST['ROWNO']: '',
                    'METHODCD' => isset($_POST['METHODCD']) ? $_POST['METHODCD']: '',
                    'METHODNAME' => isset($_POST['METHODNAME']) ? $_POST['METHODNAME']: '',
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME']: '',
                    'BRANCHNAME' => isset($_POST['BRANCHNAME']) ? $_POST['BRANCHNAME']: '',
                    'MEMO' => isset($_POST['MEMO']) ? $_POST['MEMO']: '',
                    'METHODCDID' => isset($_POST['METHODCDID']) ? $_POST['METHODCDID']: '',
                    'BANKCD' => isset($_POST['BANKCD']) ? $_POST['BANKCD']: '',
                    'BRANCHCD' => isset($_POST['BRANCHCD']) ? $_POST['BRANCHCD']: '');
    // print_r($param);
    $delete = $delfunc->delete($param);
    echo json_encode($delete);
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
    // print_r($_POST);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ROWNO', 'METHODCD', 'METHODCDID', 'METHODNAME', 'MEMO', 'PMNOTE06', 'PMNOTE02', 'PMNOTE03', 'PMNOTE04', 'PMNOTE05', 'PMNOTE01');

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

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>