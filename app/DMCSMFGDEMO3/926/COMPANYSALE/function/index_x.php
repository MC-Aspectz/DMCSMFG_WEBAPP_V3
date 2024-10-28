<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode("/", dirname(__FILE__));
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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = "";
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
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$logicFunc = new COMPANYSALE;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 15;
$rowno = 0;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------

if(!empty($_GET)) {


    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }

}

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
	if (isset($_POST['action'])) {

	    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
	    if ($_POST['action'] == 'keepdata') { setOldValue();}
        if ($_POST['action'] == "keepItemData") { keepItemData();print_r('keepItemData');}
        if ($_POST['action'] == "unsetItemData") {  unsetItemData($_POST['lineIndex']); }
        if ($_POST['action'] == "update") { update();}

	}

}
// 
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
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
$loadevent = getSystemData($_SESSION['APPCODE']."_EVENT");
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_EVENT", $loadevent);
}

$javaloadapp = new COMPANYSALE;
$loadapptest = getSystemData($_SESSION['APPCODE']."comp");
if(empty($loadapptest)) {
    $loadapptest = $javaloadapp->load();
} 
$data['cos']=$loadapptest ;

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// $statusorder = $data['DRPLANG']['STATUS_ORDER'];
$set_order = $data['DRPLANG']['SET_ORDERNO'];
$set_purchrule = $data['DRPLANG']['SET_PURCHRULE'];
$set_bomlength = $data['DRPLANG']['BOMLENGTH'];
$withdraw_produ = $data['DRPLANG']['WITHDRAW_PRODU'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function update() {

    $logicFunc = new COMPANYSALE;
    $Param = array(
        'FORECAST' => '',
        'SALES_ORDER_METHOD' => '',
        'SALES_ORDER_NO' => '',
        'KEY_SALES' => '',
        'COMP_SALE_CONFIRM' => '',
        'PRODUCTION_ORDER_NO' => $_POST['PRODUCTION_ORDER_NO'],
        'KEY_PRODUCTION' => $_POST['KEY_PRODUCTION'],
        'PURCHASE_ORDER_NO' => '',
        'KEY_PURCHASE' => '',
        'WORKFLOW' => '',
        'L_INSPECT_SHIP' => '',
        'L_INSPECT_PROD' => '',
        'L_INSPECT_PURCH' => '',
        'L_RETURN_ITEM' => '',
        'L_BAD_ITEM' => '',
        'TRACE' => '',
        'SUPPLY_ACC' => '',
        'AUTOWD_PRODUCT' => $_POST['AUTOWD_PRODUCT'],
        'AUTOWD_PURCHASE' => '',
        'INSPECT_SHIP' => '',
        'INSPECT_PURCHASE' => '',
        'UNIT_PRICE_INV' => '',
        'AUTO_INSPECTION_DO' => '',
        'ACC001' => '',
        'ACC002' => '',
        'ACC003' => '',
        'ACC004' => '',
        'CULC_PRODUCT_COST' => '',
        'PROFIT_RATE' => '',
        'SALE_RATE' => '',
        'BMVERSION' => '',
        'REFRESH_TIME' => '',
        'SERVER_TYPE' => '',
        'SALESTAFFSTOCK' => '',
        'SUPTAXCALCTYP' => '',
        'PROFOLDER' => '',
        'DUEDATE_MINUS' => 'F',
        'MODIFY_DUE_DATE' => 'F',
        'CANCEL_ORDER' => 'F',
        'MXROW' => '',
        'DATE_TYP' => '',
        'LOGINCOMPCHECK' => isset($_POST['LOGINCOMPCHECK']) ? $_POST['LOGINCOMPCHECK']: 'F',
        'ITEMCD' => '',
        'ITEMCD1' => '',
        'ITEMCD2' => '',
        'ITEMCD3' => '',
        'BOMLENGTH' => isset($_POST['BOMLENGTH']) ? $_POST['BOMLENGTH']: '',
        'WORKSTARTTIME' => '000000',
    );

    $query = $logicFunc->upd($Param);

}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG','PRODUCTION_ORDER_NO' ,'KEY_PRODUCTION', 'cos', 'BOMLENGTH','AUTOWD_PRODUCT');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}

function setSessionKey($key, $value) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    $_SESSION[$sysnm][$key] = $value;
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

function unsetItemData($lineIndex = "") { 
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}
?>