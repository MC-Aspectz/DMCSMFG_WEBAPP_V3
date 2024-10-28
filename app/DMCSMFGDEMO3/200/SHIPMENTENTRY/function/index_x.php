<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
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
}  // if ($_SESSION['MENU'] != ' and is_array($_SESSION['MENU'])) {

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$data = array();
$syslogic = new Syslogic;
$javaFunc = new ShipmentEntry;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 11;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['SHIPTRANORDERNO']) || isset($_GET['SHIPTRANORDERLN'])) {
        $SHIPTRANORDERNO = isset($_GET['SHIPTRANORDERNO']) ? $_GET['SHIPTRANORDERNO']: '';
        $SHIPTRANORDERLN = isset($_GET['SHIPTRANORDERLN']) ? $_GET['SHIPTRANORDERLN']: '';
        $query = $javaFunc->getShipTran($SHIPTRANORDERNO, $SHIPTRANORDERLN);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
    } else if(isset($_GET['STAFFCD'])) {
        $STAFFCD = isset($_GET['STAFFCD']) ? $_GET['STAFFCD']: '';
        $query = $javaFunc->getStaff($STAFFCD);
        $data = $query;
    }
    
    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'getLoc') { getLoc(); } 
        if ($_POST['action'] == 'update') { update(); } 
    }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
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
$MSG = $data['DRPLANG']['MSG'];
$UNIT = $data['DRPLANG']['UNIT'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
$STATUS_SALES = $data['DRPLANG']['STATUS_SALES'];
$SALES_INSPE_TIME = $data['DRPLANG']['SALES_INSPE_TIME'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function update() {

    $javafunc = new ShipmentEntry;

    $param = array( 'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO']) ? $_POST['SHIPTRANORDERNO']: '',
                    'SHIPTRANORDERLN' =>  isset($_POST['SHIPTRANORDERLN']) ? $_POST['SHIPTRANORDERLN']: '',
                    'SHIPTRANDT' =>  isset($_POST['SHIPTRANDT']) ? str_replace('-', '', $_POST['SHIPTRANDT']): '',
                    'SHIPTRANSHIPQTY' =>  isset($_POST['SHIPTRANSHIPQTY']) ? str_replace(',', '', $_POST['SHIPTRANSHIPQTY']): '',
                    'SHIPTRANREM' =>  isset($_POST['SHIPTRANREM']) ? $_POST['SHIPTRANREM']: '',
                    'SHIPTRANSTATUS' =>  isset($_POST['SHIPTRANSTATUS']) ? $_POST['SHIPTRANSTATUS']: '',
                    'SALELNNO' =>  isset($_POST['SALELNNO']) ? $_POST['SALELNNO']: '',
                    'SALELN' =>  isset($_POST['SALELN']) ? $_POST['SALELN']: '',
                    'SALELNQTY' =>  isset($_POST['SALELNQTY']) ? str_replace(',', '', $_POST['SALELNQTY']): '',
                    'SALELNUNITPRC' =>  isset($_POST['SALELNUNITPRC']) ? str_replace(',', '', $_POST['SALELNUNITPRC']): '',
                    'SALELNAMT' =>  isset($_POST['SALELNAMT']) ? str_replace(',', '', $_POST['SALELNAMT']): '',
                    'SALELNEXUNITPRC' =>  isset($_POST['SALELNEXUNITPRC']) ? str_replace(',', '', $_POST['SALELNEXUNITPRC']): '',
                    'SALELNEXAMT' =>  isset($_POST['SALELNEXAMT']) ? str_replace(',', '', $_POST['SALELNEXAMT']): '',
                    'SALELNTAXAMT' =>  isset($_POST['SALELNTAXAMT']) ? str_replace(',', '', $_POST['SALELNTAXAMT']): '',
                    'ITEMCD' =>  isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ITEMNAME' =>  isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMSPEC' =>  isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                    'ITEMDRAWNO' =>  isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    'ITEMUNITTYP' =>  isset($_POST['ITEMUNITTYP']) ? $_POST['ITEMUNITTYP']: '',
                    'CUSTOMERCD' =>  isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'CUSTOMERNAME' =>  isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                    'CUSTOMERSALERULEFLG' =>  isset($_POST['CUSTOMERSALERULEFLG']) ? $_POST['CUSTOMERSALERULEFLG']: '',
                    'LOCTYP' =>  isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '',
                    'LOCCD' =>  isset($_POST['LOCCD']) ? $_POST['LOCCD']: '',
                    'LOCNAME' =>  isset($_POST['LOCNAME']) ? $_POST['LOCNAME']: '',
                    'STAFFCD' =>  isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'STAFFNAME' =>  isset($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: '',
                    'CURRENCY' =>  isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'OLD_QTY' =>  isset($_POST['OLD_QTY']) ? $_POST['OLD_QTY']: '');
    // print_r($param);
    $update = $javafunc->update($param);
    echo json_encode($update);
}

function delShipOd() {

    $javafunc = new ShipmentEntry;

    $param = array( 'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO']) ? $_POST['SHIPTRANORDERNO']: '',
                    'SHIPTRANORDERLN' =>  isset($_POST['SHIPTRANORDERLN']) ? $_POST['SHIPTRANORDERLN']: '',
                    'SHIPTRANDT' =>  isset($_POST['SHIPTRANDT']) ? str_replace('-', '', $_POST['SHIPTRANDT']): '',
                    'SHIPTRANSHIPQTY' =>  isset($_POST['SHIPTRANSHIPQTY']) ? str_replace(',', '', $_POST['SHIPTRANSHIPQTY']): '',
                    'SHIPTRANREM' =>  isset($_POST['SHIPTRANREM']) ? $_POST['SHIPTRANREM']: '',
                    'SHIPTRANSTATUS' =>  isset($_POST['SHIPTRANSTATUS']) ? $_POST['SHIPTRANSTATUS']: '',
                    'SALELNNO' =>  isset($_POST['SALELNNO']) ? $_POST['SALELNNO']: '',
                    'SALELN' =>  isset($_POST['SALELN']) ? $_POST['SALELN']: '',
                    'SALELNQTY' =>  isset($_POST['SALELNQTY']) ? str_replace(',', '', $_POST['SALELNQTY']): '',
                    'SALELNUNITPRC' =>  isset($_POST['SALELNUNITPRC']) ? str_replace(',', '', $_POST['SALELNUNITPRC']): '',
                    'SALELNAMT' =>  isset($_POST['SALELNAMT']) ? str_replace(',', '', $_POST['SALELNAMT']): '',
                    'SALELNEXUNITPRC' =>  isset($_POST['SALELNEXUNITPRC']) ? str_replace(',', '', $_POST['SALELNEXUNITPRC']): '',
                    'SALELNEXAMT' =>  isset($_POST['SALELNEXAMT']) ? str_replace(',', '', $_POST['SALELNEXAMT']): '',
                    'SALELNTAXAMT' =>  isset($_POST['SALELNTAXAMT']) ? str_replace(',', '', $_POST['SALELNTAXAMT']): '',
                    'ITEMCD' =>  isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ITEMNAME' =>  isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMSPEC' =>  isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                    'ITEMDRAWNO' =>  isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    'ITEMUNITTYP' =>  isset($_POST['ITEMUNITTYP']) ? $_POST['ITEMUNITTYP']: '',
                    'CUSTOMERCD' =>  isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'CUSTOMERNAME' =>  isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                    'CUSTOMERSALERULEFLG' =>  isset($_POST['CUSTOMERSALERULEFLG']) ? $_POST['CUSTOMERSALERULEFLG']: '',
                    'LOCTYP' =>  isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '',
                    'LOCCD' =>  isset($_POST['LOCCD']) ? $_POST['LOCCD']: '',
                    'LOCNAME' =>  isset($_POST['LOCNAME']) ? $_POST['LOCNAME']: '',
                    'STAFFCD' =>  isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'STAFFNAME' =>  isset($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: '',
                    'CURRENCY' =>  isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'OLD_QTY' =>  isset($_POST['OLD_QTY']) ? $_POST['OLD_QTY']: '');
    // print_r($param);
    $delShipOd = $javafunc->delShipOd($param);
    echo json_encode($delShipOd);
}

function getLoc() {
    $javafunc = new ShipmentEntry;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $getLoc = $javafunc->getLoc($LOCCD, $LOCTYP);
    echo json_encode($getLoc);
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'SYSEN_UPDATE', 'SYSEN_DELETE', 'SHIPTRANORDERNO', 'SHIPTRANORDERLN', 'SHIPTRANDT', 'SALELNNO', 'SALELN', 'CUSTOMERCD', 'CUSTOMERNAME', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'ITEMDRAWNO', 'SALES_INSPE_TIME', 'SALELNUNITPRC', 'CMCURDISP', 'SALELNAMT', 'SALELNQTY', 'ITEMUNITTYP', 'BACKLOG', 'SALELNEXUNITPRC', 'CURRENCYDISP', 'SALELNEXAMT', 'SALELNTAXAMT', 'SHIPTRANSHIPQTY', 'SHIPTRANSTATUS', 'STAFFCD', 'STAFFNAME', 'LOCTYP', 'LOCCD', 'LOCNAME', 'SHIPTRANREM', 'OLD_QTY', 'CURRENCY', 'SYSVIS_MSG', 'CUSTOMERSALERULEFLG');
    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
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

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>