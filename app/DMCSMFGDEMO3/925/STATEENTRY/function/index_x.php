<?php
require_once('index_class.php');
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
$javaFunc = new StateEntry;
$data = array();
$systemName = 'StateEntry';
// -- Table Max Row ----//
$rowno = 0;
$minrow = 0;
$maxrow = 20;
$COUNTRYCD ='';
$COUNTRYNAME = '';
$STATECD ='';
$STATENAME ='';
$readonly ='';

if(!empty($_POST)) {
    // print_r($_POST);

   if(isset($_POST['search'])) {
        $COUNTRYCD = $_POST['COUNTRYCD'];

        $query = $javaFunc->search($COUNTRYCD);
        $data['STATE'] = $query;
      
        if(!empty($query)) {
            setSessionArray($data); 
            // print_r('1');
        }
        else{
            unsetSessionkey('STATE');

        }

        if(checkSessionData()) {
             $data = getSessionData(); 
            //  print_r('2');
        }

        // print_r($data);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        // print_r('3');

    }

}


if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {
    // print_r('GET');

    if(isset($_GET['refresh'])) {
        // $COUNTRYCD = $_GET['COUNTRYCD'];
        $data = getSessionData();
        $COUNTRYCD = isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: '';
        
        $query = $javaFunc->search($COUNTRYCD);
        $data['STATE'] = $query;
        setSessionArray($data); 
        // print_r('4');
    }
    //onchange บน
    else if(isset($_GET['COUNTRYCD']) && !isset($_GET['STATECD'])) {
        unsetSessionkey('COUNTRYCD');
        unsetSessionkey('COUNTRYNAME');

        $data['COUNTRYCD'] = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']: '';
        $excute = $javaFunc->getCT($_GET['COUNTRYCD']);

        $data = $excute;

    }
    //onchange ล่าง
    else if(isset($_GET['COUNTRYCD']) && isset($_GET['STATECD'])) {

        unsetSessionkey('STATENAME');
        
        $data['STATECD'] = isset($_GET['STATECD']) ? $_GET['STATECD']: '';
        $excute = $javaFunc->get($_GET['COUNTRYCD'],$_GET['STATECD'],'');

        $data = $excute;
            

    }
    // ชื่อตัวเล็กเพราะรับมาจากหน้าguide 
    if(isset($_GET['countrycd'])||isset($_GET['countryname']))
    {
        // $BANKCD = isset($_GET['bankcode']) ? $_GET['bankcode']: '';
        // $BANKNAME = isset($_GET['bankname']) ? $_GET['bankname']: '';
        $data['COUNTRYCD'] = isset($_GET['countrycd']) ? $_GET['countrycd']: '';
        $data['COUNTRYNAME'] = isset($_GET['countryname']) ? $_GET['countryname']: '';
        setSessionArray($data); 

        // print_r($_GET['countrycd']);

    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('7');
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
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


//COUNTRYCD,STATECD,STATENAME
function insert() {
    $javaInsrt = new StateEntry;
    $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "STATENAME" => $_POST['STATENAME']);
                    // print_r($Param);
    $insert = $javaInsrt->insert($Param);

    // unset 2 ตัวนี้เพราะค่าอื่นยังต้องใช้
    unsetSessionkey('STATECD');
    unsetSessionkey('STATENAME');
    
    // unsetSessionData();
    echo json_encode($insert);
}

function update() {
    $javaUpd = new StateEntry;
    $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "STATENAME" => $_POST['STATENAME']);
    $update = $javaUpd->update($Param);
    unsetSessionkey('STATECD');
    unsetSessionkey('STATENAME');
    // unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    $javaDel = new StateEntry;
    $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "STATENAME" => $_POST['STATENAME']);
    $deletes = $javaDel->delete($Param);
    unsetSessionkey('STATECD');
    unsetSessionkey('STATENAME');
    // unsetSessionData();
    echo json_encode($deletes);
}


function setSessionArray($arr){
    $keepField = array('STATE', 'COUNTRYCD', 'COUNTRYNAME', 'STATECD', 'STATENAME');
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