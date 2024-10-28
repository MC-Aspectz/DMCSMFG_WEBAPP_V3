<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
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
$javaFunc = new StorageMaster;

$data = array();
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;


//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$STORAGECD_S = '';
if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $STORAGECD_S = $_POST['STORAGECD_S'];
        $query = $javaFunc->search($_POST['STORAGECD_S']);
        $data['STORE'] = $query;
        // print_r($_POST['STORAGECD_S']);
        
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
        $query = $javaFunc->search($STORAGECD_S);
        $data['STORE'] = $query;     
       // print_r($data['STORE']);  
        setSessionArray($data); 
        
    }

    $STORAGECD_S = isset($_GET['locationcd']) ? $_GET['locationcd']: '';
    
    

    if(isset($_GET['STORAGECDS'])) {
        unsetSessionkey('STORAGECD');
        unsetSessionkey('STORAGENAME');

        $data['STORAGECD'] = isset($_GET['STORAGECDS']) ? $_GET['STORAGECDS']: '' ;
        setSessionArray($data); 
        $excute = $javaFunc->getStorage( $data['STORAGECD']);
        $data = $excute;
        
       // print_r($excute);
    }

    // if(!empty($_GET['citycd'])) {
    //     $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
    //     $STATECD = isset($data['STATECD'])? $data['STATECD']:'';
    //     $query = $javaFunc->getCity($COUNTRYCD,$STATECD,$_GET['citycd']);
    //     $data['CITYCD'] = $query['CITYCD'];
    //     $data['CITYNAME'] = $query['CITYNAME'];


    // if(isset($_GET['DIVISIONCD'])) { 
    //     $excute = $javaFunc->getDivision($_GET['DIVISIONCD']);
    //     $data = $excute;
    //     //print_r($data);
    // }

    if(!empty($excute)) {
        setSessionArray($data); 
    }

    if(isset($_GET['divisioncd'])) {
        $data['DIVISIONCD']  = isset($_GET['divisioncd']) ? $_GET['divisioncd']: '';
        $excute = $javaFunc->getDivision($data['DIVISIONCD']);
        $data = $excute;
       
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

//  $data = getSessionData(); 







// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//

function insert() {
    $javaInsrt = new StorageMaster;
    $Param = array("STORAGECD" => $_POST['STORAGECD'],
                    "STORAGENAME" => $_POST['STORAGENAME'],
                    "DIVISIONCD" => $_POST['DIVISIONCD'],
                    "STORAGEMRPFLG" => 'F',
                    "STORAGECOCKFLG" => 'F',
                    "STORAGECAP" => 0,
                    "STORAGEWEIGHT" => 0,);
    $insert = $javaInsrt->insStorage($Param);
    unsetSessionData();
    echo json_encode($insert);
}

function update() {
    $javaUpd = new StorageMaster;
    $Param = array("STORAGECD" => $_POST['STORAGECD'],
                    "STORAGENAME" => $_POST['STORAGENAME'],
                    "DIVISIONCD" => $_POST['DIVISIONCD'],
                    "STORAGEMRPFLG" => 'F',
                    "STORAGECOCKFLG" => 'F',
                    "STORAGECAP" => 0,
                    "STORAGEWEIGHT" => 0,);
    $update = $javaUpd->updStorage($Param);
    unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    
    $javaDel = new StorageMaster;
    print_r('test');
    $Param = array( "STORAGECD" => $_POST['STORAGECD']);
    $deletes = $javaDel->delStorage($Param);   
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
    $keepField = array('STORE', 'STORAGECD', 'STORAGENAME', 'DIVISIONCD', 'DIVISIONNAME', 'StorageDivCd', 'SYSPVL', 'TXTLANG', 'DRPLANG');
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