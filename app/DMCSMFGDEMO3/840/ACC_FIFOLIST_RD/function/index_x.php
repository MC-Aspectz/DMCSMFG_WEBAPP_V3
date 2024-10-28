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


$javaFunc = new AccFifolistRd;
$data = array();
$systemName = 'AccFifolistRd';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;
//DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMCD2,RPTDOCEN,RPTDOCTH,ITEMTYP
$DVPERIOD ='';
$YEAR ='';
$MONTH = '';
$YEAR2 ='';
$MONTH2 ='';
$ITEMCD = '';
$ITEMCD2 ='';
$RPTDOCEN = '';
$RPTDOCTH ='';
$ITEMTYP = '';

$itemtype_default = '1';

if(!empty($_POST)) {
   if(isset($_POST['search'])) {

        $data['DVPERIOD'] = '';
        $data['YEAR'] = $_POST['YEAR'];
        $data['MONTH'] = $_POST['MONTH'];
        $data['YEAR2'] = $_POST['YEAR2'];
        $data['MONTH2'] = $_POST['MONTH2'];
        $data['ITEMCD'] = $_POST['ITEMCD'];
        $data['ITEMCD2'] = $_POST['ITEMCD2'];
        $data['ITEMTYP'] = $_POST['ITEMTYP'];
        
        //acc.THA.ACC_FIFOLIST_RD.getInvTrans	DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMCD2,ITEMTYP
        // $query = $javaFunc->search($_POST['YEAR'],
        //                             $_POST['MONTH'], $_POST['YEAR2'],
        //                             $_POST['MONTH2'], $_POST['ITEMCD'],);
        $query = $javaFunc->getInvTrans('', $_POST['YEAR'],$_POST['MONTH'],
                                        $_POST['YEAR2'],$_POST['MONTH2'],
                                        $_POST['ITEMCD'],$_POST['ITEMCD2'],
                                        $_POST['ITEMTYP']);
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
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();

        $DVPERIOD = isset($data['DVPERIOD']) ? $data['DVPERIOD']: '';
        $YEAR = isset($data['YEAR']) ? $data['YEAR']: '';
        $MONTH = isset($data['MONTH']) ? $data['MONTH']: '';
        $YEAR2 = isset($data['YEAR2']) ? $data['YEAR2']: '';
        $MONTH2 = isset($data['MONTH2']) ? $data['MONTH2']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        $ITEMCD2 = isset($data['ITEMCD2']) ? $data['ITEMCD2']: '';
        $ITEMTYP = isset($data['ITEMTYP']) ? $data['ITEMTYP']: '';
        
        // $query = $javaFunc->search($YEAR,$MONTH,$YEAR2,$MONTH2,$ITEMCD,$ITEMTYP);
        $query = $javaFunc->getInvTrans($DVPERIOD,$YEAR,$MONTH,$YEAR2,$MONTH2,$ITEMCD,$ITEMCD2,$ITEMTYP);
        $data['FIFO'] = $query;
        setSessionArray($data); 
    }

    // onchange

    else if(!empty($_GET['ITEMCD'])) {
        // $query = $javaFunc->get($_GET['ITEMCD']);
        // $data['ITEMCD'] = $query['ITEMCD'];

        unsetSessionkey('ITEMCD');

        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->get($_GET['ITEMCD']);

        // print_r($excute);
        $data = $excute;


    } else if(!empty($_GET['ITEMCD2'])) {
        // $query = $javaFunc->get($_GET['ITEMCD2']);
        // $data['ITEMCD2'] = $query['ITEMCD'];

        unsetSessionkey('ITEMCD2');

        $data['ITEMCD2'] = isset($_GET['ITEMCD2']) ? $_GET['ITEMCD2']: '';
        $excute = $javaFunc->get($_GET['ITEMCD2']);
        if(!empty($excute))
        {
            // print_r('***not empty***');
            $excute['ITEMCD2'] = isset($excute['ITEMCD']) ? $excute['ITEMCD']: '';
            $data['ITEMCD2'] = $excute['ITEMCD2'];
            $excute['ITEMCD'] = isset($data['ITEMCD']) ? $data['ITEMCD']: '';

        }

        // print_r($excute);
        $data = $excute;


    }

    // get from search page

    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['ITEMCD'] = $_GET['itemcd'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        $data['ITEMCD2'] = $_GET['itemcd'];
        setSessionArray($data); 

    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    // if(!empty($query)) {
    //     setSessionArray($data); 
    //     // print_r('1');
    // }


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
$itemtyp = $data['DRPLANG']['ITEM_TYPE'];

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

//ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE,ITEMTYP
function setSessionArray($arr){
    $keepField = array('FIFO', 'DVPERIOD', 'YEAR', 'MONTH', 'YEAR2', 'MONTH2', 'ITEMCD', 'ITEMCD2', 'RPTDOCEN', 'RPTDOCTH', 'ITEMTYP');
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