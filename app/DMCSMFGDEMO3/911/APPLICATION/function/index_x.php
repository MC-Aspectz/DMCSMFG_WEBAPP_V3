<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
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
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2).'/lang/en.php');
}

$systemName = strtolower($appcode);
$javaFunc = new Application;

$data = array();
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 16;


//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$APPPACK_S = '';
if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $APPPACK_S = $_POST['APPPACK_S'];
        $query = $javaFunc->search($_POST['APPPACK_S']);
        // print_r($query);
        $data['APP'] = $query;
        // print_r($_POST['APPPACK_S']);
        $data['APPPACK_S'] = $_POST['APPPACK_S'];
        
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
        $query = $javaFunc->search($APPPACK_S);
        $data['APP'] = $query;     
       // print_r($APPPACK_S);
      // print_r($data['APPPACK_S']);
       // print_r($data['STORE']);  
        setSessionArray($data); 
        
    }

  



    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(isset($_GET['appcd'])) {
        unsetSessionkey('FORMTITLETYP');
        unsetSessionkey('APPNAME');
        $data['FORMTITLETYP']  = isset($_GET['appcd']) ? $_GET['appcd']: '';
        
        $excute = $javaFunc->getAppName($data['FORMTITLETYP']);
        $data = $excute;
        // $data['FORMTITLETYP'] = $excute['FORMTITLETYP'];
        // $data['APPNAME'] = $excute['APPNAME'];
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
// print_r($data['SYSPVL']);
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$apppackse = $data['DRPLANG']['APPPACK'];
//  $data = getSessionData(); 
//print_r($apppackse[100]);






// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//


function insert() {
    $javaInsrt = new Application;
    $Param = array("APPPACK_S" => $_POST['APPPACK_S'],
                    "FORMNO" => $_POST['FORMNO'],
                    "FORMTITLETYP" => $_POST['FORMTITLETYP'],
                    "FORMAPP" => $_POST['FORMAPP'],
                    "FORMPACKTYP" => $_POST['FORMPACKTYP'],
                    "FORMSEQ" => $_POST['FORMSEQ']);
    $insert = $javaInsrt->insApp($Param);
    unsetSessionData();
    echo json_encode($insert);
}



function update() {
    $javaUpd = new Application;
    $Param = array("APPPACK_S" => $_POST['APPPACK_S'],
                    "FORMNO" => $_POST['FORMNO'],
                    "FORMTITLETYP" => $_POST['FORMTITLETYP'],
                    "FORMAPP" => $_POST['FORMAPP'],
                    "FORMPACKTYP" => $_POST['FORMPACKTYP'],
                    "FORMSEQ" => $_POST['FORMSEQ']);
    $update = $javaUpd->updApp($Param);
    unsetSessionData();
    echo json_encode($update);
}

function deletes() {
   
    $javaDel = new Application;
   // print_r('test');
    $Param = array( "APPPACK_S" => $_POST['APPPACK_S'],
    "FORMNO" => $_POST['FORMNO']);
    $deletes = $javaDel->delApp($Param);   
    unsetSessionData();
    echo json_encode($deletes);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
    }
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array('APP', 'FORMSEQ', 'FORMNO', 'APPPACK_S', 'FORMTITLETYP', 'APPNAME', 'FORMAPP', 'FORMPACKTYP', 'SYSPVL', 'TXTLANG', 'DRPLANG');
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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}
?>