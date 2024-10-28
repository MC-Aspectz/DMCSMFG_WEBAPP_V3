<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode('\\', dirname(__FILE__));  // for localhost
$arydirname = explode('/', dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
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
}
 // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}  // if ($appname == '') {
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
// if(isset($_SESSION['APPCODE']) { else {
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
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->

$data = array();
$javaFunc = new ItemMasterInquiry;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 19;

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$ITEMCD1 = '';
$ITEMCD2 = '';
$ITEMNAME = '';
$ITEMSEARCH = '';
$ITEMTYP = '';
$ITEMBOI = '';
$CATALOGCD = '';
$ITEMUNIT = '';
$SUPPLIERCD = '';
$STORAGECD = '';

if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
   
       // $SUPPLIERCD = $_POST['SUPPLIERCD'];

        setSessionArray($data);
        $data['ITEMCD1'] = $_POST['ITEMCD1'];
        $data['ITEMCD2'] = $_POST['ITEMCD2'];
        $data['ITEMNAME'] = $_POST['ITEMNAME'];
        $data['ITEMSEARCH'] = $_POST['ITEMSEARCH'];
        $data['ITEMTYP'] = $_POST['ITEMTYP'];
        $data['ITEMBOI'] = $_POST['ITEMBOI'];
        $data['CATALOGCD'] = $_POST['CATALOGCD'];
        $data['ITEMUNIT'] = $_POST['ITEMUNIT'];
        $data['SUPPLIERCD'] = $_POST['SUPPLIERCD'];
        $data['STORAGECD'] = $_POST['STORAGECD'];
        
        $query = $javaFunc->search($_POST['ITEMCD1'],$_POST['ITEMCD2'],$_POST['ITEMNAME'],$_POST['ITEMSEARCH']
         ,$_POST['ITEMTYP'],$_POST['ITEMBOI'],$_POST['CATALOGCD'],$_POST['ITEMUNIT'],$_POST['SUPPLIERCD']
        ,$_POST['STORAGECD']);
        // print_r($query);
        $data['ITQ'] = $query;

        // $data['SUPPLIERCD'] = $_POST['SUPPLIERCD'];
        // $data['SUPPLIERNAME'] = $_POST['SUPPLIERNAME']; 
        // print_r($_POST['STORAGECD_S']);
         //print_r($data['ACCF']);
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { Commits(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
// ITEMCD1,ITEMCD2,ITEMNAME,ITEMSEARCH,ITEMTYP,ITEMBOI,CATALOGCD,ITEMUNIT,SUPPLIERCD,STORAGECD
if(!empty($_GET)) {

    if(isset($_GET['ITEMCD']) && isset($_GET['index'])) {
        // print_r("ITEMCD");
        if($_GET['index'] == 1) {
            $data['ITEMCD1'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD'] : '';
            setSessionArray($data); 
        } else {
            $data['ITEMCD2'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD'] : '';
            setSessionArray($data); 
        }
    } else if(isset($_GET['CATALOGCD'])) {
        $data['CATALOGCD'] = isset($_GET['CATALOGCD']) ? $_GET['CATALOGCD']: '';
        $query = $javaFunc->getCat($data['CATALOGCD']);
        // print_r($query);
        $data = $query;
    } else if(isset($_GET['SUPPLIERCD'])) {
        $data['SUPPLIERCD'] = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
        $query = $javaFunc->getSup($data['SUPPLIERCD']);
        // print_r($query);
        $data = $query;
    } else if(isset($_GET['STORAGECD'])) {
        $data['STORAGECD'] = isset($_GET['STORAGECD']) ? $_GET['STORAGECD']: '';
        $query = $javaFunc->getStg($data['STORAGECD']);
        // print_r($query);
        $data = $query;
    }


    if(!empty($query)) {
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
$itemtype = $data['DRPLANG']['ITEM_TYPE'];
$itemboitype = $data['DRPLANG']['ITEMBOITYP'];
$unit = $data['DRPLANG']['UNIT'];
//  $data = getSessionData(); 







// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//






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
    $keepField = array('ITQ','ITEMCD1','ITEMCD2', 'ITEMTYP', 'ITEMBOI','ITEMNAME','CATALOGCD','CATALOGNAME','ITEMSEARCH','ITEMUNIT',
    'SUPPLIERCD','SUPPLIERNAME','STORAGECD','STORAGENAME', 'SYSPVL', 'TXTLANG', 'DRPLANG');
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