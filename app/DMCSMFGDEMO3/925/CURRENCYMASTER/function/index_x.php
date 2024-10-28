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
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = "";
//--------------------------------------------------------------------------------
//  LANGUAGE
// if (isset($_SESSION['LANG'])) {
//     require_once('./lang/' . strtolower($_SESSION['LANG']) . '.php');
// } else {  
//     require_once('./lang/en.php');
// }
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

// if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
//
// 
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 

$javaFunc = new CurrencyMaster;
$data = array();
$systemName = 'CurrencyMaster';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 17;
$rowno = 0;
// CURRENCYCD_S CURRENCYCD CURRENCYUNITTYP CURRENCYAMTTYP CURRENCYDISP
$CURRENCYCD_S ='';
$CURRENCYCD ='';
$CURRENCYUNITTYP ='';
$CURRENCYAMTTYP ='';
$CURRENCYDISP = '';

if(!empty($_POST)) {
   if(isset($_POST['search'])) {
//         print_r("search click");
        $data['CURRENCYCD_S'] = isset($_POST['CURRENCYCD_S']) ? $_POST['CURRENCYCD_S']: '';

        $query = $javaFunc->searchCur($_POST['CURRENCYCD_S']);
        
        $data['CU'] = $query;
      
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($data);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        // $data = getSessionData();
        $CURRENCYCD_S = isset($data['CURRENCYCD_S']) ? $data['CURRENCYCD_S']: '';
        
        $query = $javaFunc->searchCur($CURRENCYCD_S);
        $data['CU'] = $query;
        setSessionArray($data); 
    }

    //onchange
    else if(isset($_GET['CURRENCYCD'])) {
        unsetSessionkey('CURRENCYUNITTYP');
        unsetSessionkey('CURRENCYAMTTYP');
        unsetSessionkey('CURRENCYDISP');

        $data['CURRENCYCD'] = isset($_GET['CURRENCYCD']) ? $_GET['CURRENCYCD']: '';
        $excute = $javaFunc->getCur($_GET['CURRENCYCD']);
        $data = $excute;


    }

    if(!empty($excute)) {
        setSessionArray($data);

    }

    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('3');
    }
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
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$total = $data['DRPLANG']['ACCURACY'];
$unit = $data['DRPLANG']['ACCURACY'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


$unit = getDropdownData("ACCURACY");
if(empty($unit)) {
    $unit = $syslogic->getPullDownData('ACCURACY', $_SESSION['LANG']);
    setDropdownData("ACCURACY", $unit);
}

$total = getDropdownData("ACCURACY");
if(empty($total)) {
    $total = $syslogic->getPullDownData('ACCURACY', $_SESSION['LANG']);
    setDropdownData("ACCURACY", $total);
}


// CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
function insert() {
    $javaInsrt = new CurrencyMaster;
    $Param = array( "CURRENCYCD_S" => $_POST['CURRENCYCD_S'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                    "CURRENCYDISP" => $_POST['CURRENCYDISP'],
                    "CURRENCYUNITTYP" => $_POST['CURRENCYUNITTYP'],
                    "CURRENCYAMTTYP" => $_POST['CURRENCYAMTTYP']);
                    // print_r($Param);
    $insert = $javaInsrt->insCur($Param);

    unsetSessionData();
    echo json_encode($insert);
}

// CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
function update() {
    $javaUpd = new CurrencyMaster;
    $Param = array( "CURRENCYCD_S" => $_POST['CURRENCYCD_S'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                    "CURRENCYDISP" => $_POST['CURRENCYDISP'],
                    "CURRENCYUNITTYP" => $_POST['CURRENCYUNITTYP'],
                    "CURRENCYAMTTYP" => $_POST['CURRENCYAMTTYP']);
    $update = $javaUpd->updCur($Param);
    unsetSessionData();
    echo json_encode($update);
}

// CURRENCYCD_S,CURRENCYCD,CURRENCYDISP,CURRENCYUNITTYP,CURRENCYAMTTYP
function deletes() {
    $javaDel = new CurrencyMaster;
    $Param = array( "CURRENCYCD_S" => $_POST['CURRENCYCD_S'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                    "CURRENCYDISP" => $_POST['CURRENCYDISP'],
                    "CURRENCYUNITTYP" => $_POST['CURRENCYUNITTYP'],
                    "CURRENCYAMTTYP" => $_POST['CURRENCYAMTTYP']);
    $deletes = $javaDel->delCur($Param);
    unsetSessionData();
    echo json_encode($deletes);
}


function setSessionArray($arr){
    $keepField = array('CU', 'CURRENCYCD_S', 'CURRENCYCD', 'CURRENCYDISP', 'CURRENCYUNITTYP', 'CURRENCYAMTTYP');
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

function getDropdownData($key = "") {
    return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
    return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
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

?>