<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $syslogic->setLoadApp($appcode);
}
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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new SearchStaffByDept;
$FM0931CATESTART = '';
$FM0931CATEEND = '';
$data = array();
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 14;
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if(isset($_POST['search'])) {
        $FM0932DEPTSTART = $_POST['FM0932DEPTSTART'];
        $FM0932DEPTEND = $_POST['FM0932DEPTEND'];
        if(!empty($FM0932DEPTSTART) && !empty($FM0932DEPTEND)) {
            $excute = $javaFunc->getStaffbyDept($FM0932DEPTSTART, $FM0932DEPTEND);
            $data['STDEP'] = $excute;
        } 
        // print_r($data['CATE']);
        if(!empty($excute)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['index']) && $_GET['index'] == 1) {

        $data['FM0932DEPTSTART'] = $_GET['divisioncd'];

    } else if(!empty($_GET['index'] ) && $_GET['index'] == 2) {

        $data['FM0932DEPTEND'] = $_GET['divisioncd'];

    }

    if(!empty($_GET['FM0932DEPTSTART'])) {
        $query = $javaFunc->getStaff($_GET['FM0932DEPTSTART']);
        //print_r($query['STAFFDIVCD']);
         $data['FM0932DEPTSTART']  = isset($query['STAFFDIVCD']) ? $query['STAFFDIVCD']: $_GET['FM0932DEPTSTART'];
        //$data['FM0932DEPTSTART'] = $query['STAFFDIVCD'];
    } else if(!empty($_GET['FM0932DEPTEND'])) {
        $query = $javaFunc->getStaff($_GET['FM0932DEPTEND']);
        //$data['FM0932DEPTEND'] = $query['STAFFDIVCD'];
        $data['FM0932DEPTEND']  = isset($query['STAFFDIVCD']) ? $query['STAFFDIVCD']: $_GET['FM0932DEPTEND'];
    }

    setSessionArray($data); 

    if(checkSessionData()) { $data = getSessionData(); }
}

// ------------------------- CALL Langauge AND Privilege -------------------//
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
// $data['DRPLANG'] = get_sys_dropdown($loadApp);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
        $_SESSION['APPCODE'] = '';
    }
}

function setSessionArray($arr){
    $keepField = array("FM0932DEPTSTART", "FM0932DEPTEND", 'STDEP','SYSPVL', 'TXTLANG', 'DRPLANG');
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

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

?>