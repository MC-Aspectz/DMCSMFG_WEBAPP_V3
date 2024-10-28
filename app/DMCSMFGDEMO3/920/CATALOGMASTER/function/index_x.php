<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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

$javaFunc = new CatalogMaster;
$systemName = strtolower($appcode);
$data = array();
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$CATALOGCD_S = '';
if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $CATALOGCD_S = $_POST['CATALOGCD_S'];
        $query = $javaFunc->search($_POST['CATALOGCD_S']);
        $data['CATE'] = $query;
      
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['refresh'])) {
        $query = $javaFunc->search($CATALOGCD_S);
        $data['CATE'] = $query;
        setSessionArray($data); 
    }

    if(isset($_GET['CATALOGCD'])) {
        $excute = $javaFunc->getCatalog($_GET['CATALOGCD']);
        $data = $excute;
    }

    if(isset($_GET['ACCIFCD'])) {
        $excute = $javaFunc->getAccIfCd($_GET['ACCIFCD']);
        $data = $excute;
    }

    if(!empty($excute)) {
        setSessionArray($data); 
    }

    if(isset($_GET['accifcd']) || isset($_GET['accifname'])) {
        $data['ACCIFCD'] = isset($_GET['accifcd']) ? $_GET['accifcd']: '';
        $data['ACCIFNAME'] = isset($_GET['accifname']) ? $_GET['accifname']: '';
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data);
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
// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function insert() {
    $javaInsrt = new CatalogMaster;
    $Param = array( "CATALOGCD" => $_POST['CATALOGCD'],
                    "CATALOGNAME" => $_POST['CATALOGNAME'],
                    "CATALOGDESC" => $_POST['CATALOGDESC'],
                    "ACCIFCD" => $_POST['ACCIFCD'],
                    "ACCIFNAME" => $_POST['ACCIFNAME'],
                    "CATALOGSERIALFLG" => '',
                    "CATALOGGROUP" =>'',
                    "CATALOGCD_S" => $_POST['CATALOGCD_S']);
    $insert = $javaInsrt->insCatalog($Param);
    unsetSessionData();
    echo json_encode($insert);
}

function update() {
    $javaUpd = new CatalogMaster;
    $Param = array( "CATALOGCD" => $_POST['CATALOGCD'],
                    "CATALOGNAME" => $_POST['CATALOGNAME'],
                    "CATALOGDESC" => $_POST['CATALOGDESC'],
                    "ACCIFCD" => $_POST['ACCIFCD'],
                    "ACCIFNAME" => $_POST['ACCIFNAME'],
                    "CATALOGSERIALFLG" => '',
                    "CATALOGGROUP" =>'',
                    "CATALOGCD_S" => $_POST['CATALOGCD_S']);
    $update = $javaUpd->updCatalog($Param);
    unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    $javaDel = new CatalogMaster;
    $Param = array( "CATALOGCD" => $_POST['CATALOGCD']);
    $deletes = $javaDel->delCatalog($Param);
    unsetSessionData();
    echo json_encode($deletes);
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
}

function setSessionArray($arr){
    $keepField = array('CATE', 'CATALOGCD', 'CATALOGNAME', 'CATALOGDESC', 'ACCIFCD', 'ACCIFNAME', 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ROWNO');
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