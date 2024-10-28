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
$appcode = $arydirname[array_key_last($arydirname)- 1];
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
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}  // if ($appname == "") {
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
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new SearchItemByCate;
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
        $FM0931CATESTART = $_POST['FM0931CATESTART'];
        $FM0931CATEEND = $_POST['FM0931CATEEND'];
        if(!empty($FM0931CATESTART) && !empty($FM0931CATEEND)) {
            $excute = $javaFunc->getItembyCategory($FM0931CATESTART, $FM0931CATEEND);
            $data['CATE'] = $excute;
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

        $data['FM0931CATESTART'] = $_GET['categorycd'];

    } else if(!empty($_GET['index'] ) && $_GET['index'] == 2) {

        $data['FM0931CATEEND'] = $_GET['categorycd'];

    }

    if(!empty($_GET['FM0931CATESTART'])) {
        $query = $javaFunc->getCat($_GET['FM0931CATESTART']);
        $data['FM0931CATESTART'] = $query['CATALOGCD'];
    } else if(!empty($_GET['FM0931CATEEND'])) {
        $query = $javaFunc->getCat($_GET['FM0931CATEEND']);
        $data['FM0931CATEEND'] = $query['CATALOGCD'];
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
    $keepField = array("FM0931CATESTART", "FM0931CATEEND", 'CATE');
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