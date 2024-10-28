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

$urlRoute = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/840/ACC_FIFOLIST_MAIN/index.php';
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


$javaFunc = new AccFifolistSUB;
$data = array();
$systemName = 'AccFifolistSUB';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;

$YEAR ='';
$MONTH = '';
$YEAR2 ='';
$MONTH2 ='';
$ITEMCODES = '';
$ITEMNAMES ='';
$ITEMSPECS = '';
$WKITEMUNITTYPS ='';

if(!empty($_POST)) {
//    if(isset($_POST['search'])) {


        $data['ITEMCODES'] = $_POST['ITEMCODES'];
        $data['YEAR'] = $_POST['YEAR'];
        $data['MONTH'] = $_POST['MONTH'];
        $data['YEAR2'] = $_POST['YEAR2'];
        $data['MONTH2'] = $_POST['MONTH2'];

        // echo "<pre>";
        // print_r($data['ITEMCODES']);        
        // echo "</pre>";
        // echo "<pre>";
        // print_r($data['YEAR']);        
        // echo "</pre>";
        // echo "<pre>";
        // print_r($data['MONTH']);        
        // echo "</pre>";
        // echo "<pre>";
        // print_r($data['YEAR2']);        
        // echo "</pre>";
        // echo "<pre>";
        // print_r($data['MONTH2']);        
        // echo "</pre>";

        // $data['ITEMCODES'] = isset($_POST['ITEMCODES']) ? $_POST['ITEMCODES']: '';
        // $data['YEAR'] = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
        // $data['MONTH'] = isset($_POST['MONTH']) ? $_POST['MONTH']: '';
        // $data['YEAR2'] = isset($_POST['YEAR2']) ? $_POST['YEAR2']: '';
        // $data['MONTH2'] = isset($_POST['MONTH2']) ? $_POST['MONTH2']: '';

        //Syslogic(search)	ITEMCODES,YEAR,MONTH,YEAR2,MONTH2
        $query = $javaFunc->search( $_POST['ITEMCODES'], $_POST['YEAR'],
                                    $_POST['MONTH'], $_POST['YEAR2'],
                                    $_POST['MONTH2']);
        // $query = $javaFunc->search( $_POST['ITEMCODES'], $_POST['YEAR'],
        //                             'April', $_POST['YEAR2'],
        //                             'April');
        // print_r($query);
        $data['FIFO'] = $query;
        // print_r($data['FIFO']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($CODEKEY_S);
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        //Syslogic(search)	ITEMCODES,YEAR,MONTH,YEAR2,MONTH2
        $ITEMCODES = isset($data['ITEMCODES']) ? $data['ITEMCODES']: '';
        $YEAR = isset($data['YEAR']) ? $data['YEAR']: '';
        $MONTH = isset($data['MONTH']) ? $data['MONTH']: '';
        $YEAR2 = isset($data['YEAR2']) ? $data['YEAR2']: '';
        $MONTH2 = isset($data['MONTH2']) ? $data['MONTH2']: '';
        
        $query = $javaFunc->search($ITEMCDS,$YEAR,$MONTH,$YEAR2,$MONTH2);
        $data['FIFO'] = $query;
        setSessionArray($data);
    }

    // onchange
    // if(isset($_GET['ITEMCD'])) {
    //     // unsetSessionData();
    //     $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
    //     $excute = $javaFunc->get($_GET['ITEMCD']);
    //     $data['ITEMNAME'] = $excute['ITEMNAME'];
    //     $data = $excute;

    // }

    //YEAR	MONTH	YEAR2	MONTH2	WKITEMCD	WKITEMNAME	WKITEMSPEC	WKITEMUNITTYP
    if(isset($_GET['YEAR'])&&isset($_GET['MONTH'])&&isset($_GET['YEAR2'])&&isset($_GET['MONTH2'])
        // &&isset($_GET['WKITEMCD'])&&isset($_GET['WKITEMNAME'])&&isset($_GET['WKITEMSPEC'])&&isset($_GET['WKITEMUNITTYP'])
       )
    {
        $data['YEAR'] = isset($_GET['YEAR']) ? $_GET['YEAR']: '';
        $data['MONTH'] = isset($_GET['MONTH']) ? $_GET['MONTH']: '';
        $data['YEAR2'] = isset($_GET['YEAR2']) ? $_GET['YEAR2']: '';
        $data['MONTH2'] = isset($_GET['MONTH2']) ? $_GET['MONTH2']: '';
        $data['ITEMCODES'] = isset($_GET['WKITEMCD']) ? $_GET['WKITEMCD']: '';
        $data['ITEMNAMES'] = isset($_GET['WKITEMNAME']) ? $_GET['WKITEMNAME']: '';
        $data['ITEMSPECS'] = isset($_GET['WKITEMSPEC']) ? $_GET['WKITEMSPEC']: '';
        $data['WKITEMUNITTYPS'] = isset($_GET['WKITEMUNITTYP']) ? $_GET['WKITEMUNITTYP']: '';
        // $excute = $javaFunc->get($data['ITEMCD']);
        // $data['ITEMNAME'] = $excute['ITEMNAME'];
        // $data = $excute;
        $query = $javaFunc->search( $data['ITEMCODES'], $data['YEAR'],
                                    $data['MONTH'], $data['YEAR2'],
                                    $data['MONTH2']);
        // $query = $javaFunc->search( $_POST['ITEMCODES'], $_POST['YEAR'],
        //                             'April', $_POST['YEAR2'],
        //                             'April');
        // print_r($query);
        $data['FIFO'] = $query;
        // print_r($data['FIFO']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($_GET['itemcd']);
    }

    // if(!empty($excute)) {
    //     setSessionArray($data); 
    //     // print_r('1');
    // }


    // if(checkSessionData()) { 
    //     $data = getSessionData(); 
    //     // print_r('3');
    // }
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
// $unit = $data['DRPLANG']['UNIT'];

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


function setSessionArray($arr){
    $keepField = array('FIFO', 'YEAR', 'MONTH', 'YEAR2', 'MONTH2', 'ITEMCODES', 'ITEMNAMES', 'ITEMSPECS', 'WKITEMUNITTYPS');
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

?>