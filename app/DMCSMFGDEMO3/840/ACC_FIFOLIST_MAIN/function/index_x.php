<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode("/", dirname(__FILE__));
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

$urlRoute = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/840/ACC_FIFOLIST_SUB/index.php';
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


$javaFunc = new AccFifolistMain;
$data = array();
$systemName = 'AccFifolistMain';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;
//DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMNAME
$DVPERIOD ='';
$YEAR ='';
$MONTH = '';
$YEAR2 ='';
$MONTH2 ='';
$ITEMCD = '';
$ITEMNAME ='';



if(!empty($_POST)) {
   if(isset($_POST['search'])) {

        $data['DVPERIOD'] = '';
        $data['YEAR'] = $_POST['YEAR'];
        $data['MONTH'] = $_POST['MONTH'];
        $data['YEAR2'] = $_POST['YEAR2'];
        $data['MONTH2'] = $_POST['MONTH2'];
        $data['ITEMCD'] = $_POST['ITEMCD'];
        //Syslogic(search)	DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD
        // $query = $javaFunc->search($_POST['YEAR'],
        //                             $_POST['MONTH'], $_POST['YEAR2'],
        //                             $_POST['MONTH2'], $_POST['ITEMCD'],);
        $query = $javaFunc->search('', $_POST['YEAR'],
                                    $_POST['MONTH'], $_POST['YEAR2'],
                                    $_POST['MONTH2'], $_POST['ITEMCD'],);
        $data['FIFO'] = $query;
        // print_r($data['FIFO']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($CODEKEY_S);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue();}
        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}
    // print_r($data);
if(!empty($_GET)) {



    if(isset($_GET['refresh'])) {
        $data = getSessionData();

        $DVPERIOD = isset($data['DVPERIOD']) ? $data['DVPERIOD']: '';
        $YEAR = isset($data['YEAR']) ? $data['YEAR']: '';
        $MONTH = isset($data['MONTH']) ? $data['MONTH']: '';
        $YEAR2 = isset($data['YEAR2']) ? $data['YEAR2']: '';
        $MONTH2 = isset($data['MONTH2']) ? $data['MONTH2']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        
        // $query = $javaFunc->search($YEAR,$MONTH,$YEAR2,$MONTH2,$ITEMCD);
        $query = $javaFunc->search($DVPERIOD,$YEAR,$MONTH,$YEAR2,$MONTH2,$ITEMCD);
        $data['FIFO'] = $query;
        setSessionArray($data); 
    }

    // onchange
    if(isset($_GET['ITEMCD'])) {
        unsetSessionkey('ITEMCD');
        unsetSessionkey('ITEMNAME');

        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->get($_GET['ITEMCD']);
        $data = $excute;

    }

    // itemcode   itemname  speciafication  drawingno   search  saleenddate
    if(isset($_GET['itemcd']))
    {
        $data['ITEMCD'] = isset($_GET['itemcd']) ? $_GET['itemcd']: '';
        $excute = $javaFunc->get($data['ITEMCD']);
        // $data['ITEMNAME'] = $excute['ITEMNAME'];
        $data = $excute;

        // print_r($_GET['itemcd']);
    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
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

$year = $data['DRPLANG']['YEARVALUE'];
$year2 = $data['DRPLANG']['YEARVALUE'];
$month = $data['DRPLANG']['MONTHVALUE'];
$month2 = $data['DRPLANG']['MONTHVALUE'];
$unit = $data['DRPLANG']['UNIT'];

// $javaFunc->get_com();


// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


// $opr = getDropdownData("TRXTYPE");
// if(empty($opr)) {
//     $opr = $syslogic->getPullDownData('TRXTYPE', $_SESSION['TRXTYPE']);
//     setDropdownData("TRXTYPE", $opr);
// }

// $str = getDropdownData("STORAGETYPE");
// if(empty($str)) {
//     $str = $syslogic->getPullDownData('STORAGETYPE', $_SESSION['STORAGETYPE']);
//     setDropdownData("STORAGETYPE", $str);
// }

//ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
function setSessionArray($arr){
    $keepField = array('FIFO', 'DVPERIOD', 'YEAR', 'MONTH', 'YEAR2', 'MONTH2', 'ITEMCD', 'ITEMNAME');
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

function setOldValue(){
    setSessionArray($_POST);
    // print_r($_POST);
}

?>