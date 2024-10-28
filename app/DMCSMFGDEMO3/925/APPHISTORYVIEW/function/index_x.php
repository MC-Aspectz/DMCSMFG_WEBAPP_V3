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

$javaFunc = new AppHistory;
// $STARTDATE1 = '';
// $STARTDATE2 = '';
// $STAFFCDS = '';
// $PRGCDS = '';
$STARTDATE1 = str_replace("-", "",date('Y-m-d'));
$STARTDATE2 = str_replace("-", "",date('Y-m-d'));
$STAFFCDS = isset($_POST['STAFFCDS']) ? $_POST['STAFFCDS']: '';
//$STAFFCDS = '';
$PRGCDS = isset($_POST['PRGCDS']) ? $_POST['PRGCDS']: '';
$systemName = strtolower($appcode);
$data = array();
$minrow = 0;
$maxrow = 15;
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {


    
    if(isset($_POST['search'])) {
        
        $STARTDATE1 =  str_replace("-", "", $_POST['STARTDATE1']);
        $STARTDATE2 = str_replace("-", "", $_POST['STARTDATE2']);
        $STAFFCDS = $_POST['STAFFCDS'];
        $PRGCDS = $_POST['PRGCDS'];
        $query = $javaFunc->SearchappPrView($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS);
        $data['AHV'] = $query;
       // $data = $data['AHV'];
       //print_r($data['AHV']);
      
        if(!empty($query)) {
            setSessionArray($data);  
        }
        if(checkSessionData()) { $data = getSessionData(); }
    }
    //print_r($_POST['STARTDATE1']);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
    }
}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    
    $STAFFCDS = isset($_GET['staffcd']) ? $_GET['staffcd']: '';
    
    
  
    
    // if(isset($_GET['staffcd']))
    // {
    //     $STAFFCDS = ($_GET['staffcd']) ? $_GET['staffcd']: '';
    // print_r($_GET['staffcd']);
    // }
    // else{
    //     print_r('66');   
    // }

    if(!empty($excute)) {
        setSessionArray($data); 
    }
   // if(checkSessionData()) { $data = getSessionData(); }
}

// if(empty($_POST['STAFFCDS']))
//     {
//         $STAFFCDS ='';
//         print_r('5');
//     }



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
//print_r($data['TXTLANG']);

// $STARTDATE1 = str_replace("-", "",date('Y-m-d'));
// $STARTDATE2 = str_replace("-", "",date('Y-m-d'));
// $STAFFCDS = isset($_POST['STAFFCDS']) ? $_POST['STAFFCDS']: '';
// $PRGCDS = isset($_POST['PRGCDS']) ? $_POST['PRGCDS']: '';
$appView = $javaFunc->appPrView($STARTDATE1,$STARTDATE2,$STAFFCDS,$PRGCDS);
$data['AHV'] = $appView;
//print_r($STARTDATE1);
if(!empty($appView)) {
    setSessionArray($data);  
}
if(checkSessionData()) { $data = getSessionData(); }
// print_r($data['SYSPVL']);
// echo "<pre>";

// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


function setOldValue() {
    // print_r($_POST);
    setSessionArray($_POST); 
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);  
        $_SESSION['APPCODE'] = ''; 
    }
}

function setSessionArray($arr){
    $keepField = array("SYSPVL", "TXTLANG", 'DRPLANG', 'AHV');
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