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
$javaFunc = new ShipingRequestEntry;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 12;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if (isset($_GET['SALEORDERNO'])) {
        $SALEORDERNO = isset($_GET['SALEORDERNO']) ? $_GET['SALEORDERNO']: '';
        $query = $javaFunc->getOrder($SALEORDERNO);
        $search = $javaFunc->search($SALEORDERNO);
        $data = $query;
        $data['ITEM'] = $search; 
    } else if(isset($_GET['LOCCD'])) {
        // $LOCCD = isset($_GET['LOCCD']) ? $_GET['LOCCD']: '';
        // $LOCTYP = isset($_GET['LOCTYP']) ? $_GET['LOCTYP']: '1';
        // $query = $javaFunc->getLoc($LOCCD, $LOCTYP);
        // $data = $query;  
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
        if ($_POST['action'] == 'chkQty') { chkQty(); } 
        if ($_POST['action'] == 'getLoc') { getLoc(); } 
        if ($_POST['action'] == 'commit') { commitAll(); } 
        if ($_POST['action'] == 'SEARCH') { search(); }
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
$UNIT = $data['DRPLANG']['UNIT'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function search() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $searchfunc = new ShipingRequestEntry;
    $SALEORDERNO = isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '';
    $search = $searchfunc->search($SALEORDERNO);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function commitAll() {
    // SD230700002
    global $data; $RowParam = array();
    $data = getSessionData();
    $javafunc = new ShipingRequestEntry;
    for ($i = 0 ; $i < count($_POST['ROWNOZ']); $i++) { 
        $RowParam[] = array('ROWNO' => isset($_POST['ROWNOZ'][$i]) ? $_POST['ROWNOZ'][$i]: '',
                            'SHIPREQUESTSHIPPEDDATE' => isset($_POST['SHIPREQUESTSHIPPEDDATEZ'][$i]) ? str_replace('-', '/', $_POST['SHIPREQUESTSHIPPEDDATEZ'][$i]): '',
                            'ITEMCODE' => isset($_POST['ITEMCODEZ'][$i]) ? $_POST['ITEMCODEZ'][$i]: '', 
                            'ITEMNAME' => isset($_POST['ITEMNAMEZ'][$i]) ? $_POST['ITEMNAMEZ'][$i]: '',
                            'ITEMSPEC' => isset($_POST['ITEMSPECZ'][$i]) ? $_POST['ITEMSPECZ'][$i]: '',
                            'ORDERQTY' => isset($_POST['ORDERQTYZ'][$i]) ? $_POST['ORDERQTYZ'][$i]: '',
                            'ORDERBALANCE' => isset($_POST['ORDERBALANCEZ'][$i]) ? $_POST['ORDERBALANCEZ'][$i]: '',
                            'THISSHIPQTY' => isset($_POST['THISSHIPQTYZ'][$i]) ? $_POST['THISSHIPQTYZ'][$i]: '',
                            'ITEMUNIT' => isset($_POST['ITEMUNITZ'][$i]) ? $_POST['ITEMUNITZ'][$i]: '',
                            'LOCTYP' => isset($_POST['LOCTYPZ'][$i]) ? $_POST['LOCTYPZ'][$i]: '',
                            'LOCCD' => isset($_POST['LOCCDZ'][$i]) ? $_POST['LOCCDZ'][$i]: '',
                            'LOCNAME' => isset($_POST['LOCNAMEZ'][$i]) ? $_POST['LOCNAMEZ'][$i]: '');
    }

    $param = array( 'SALEORDERNO' => isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '',
                    'SHIPREQUESTSALEDATE' => isset($_POST['SHIPREQUESTSALEDATE']) ? str_replace('-', '', $_POST['SHIPREQUESTSALEDATE']): '',
                    'DATA' => $RowParam);
    // print_r($param);
    $commitAll = $javafunc->commitAll($param);
    echo json_encode($commitAll);
}

function chkQty() {
    $javafunc = new ShipingRequestEntry;
    $THISSHIPQTY = isset($_POST['THISSHIPQTY']) ? $_POST['THISSHIPQTY']: '';
    $ORDERBALANCE = isset($_POST['ORDERBALANCE']) ? $_POST['ORDERBALANCE']: '';
    $chkQty = $javafunc->chkQty($THISSHIPQTY, $ORDERBALANCE);
    echo json_encode($chkQty);
}

function getLoc() {
    $javafunc = new ShipingRequestEntry;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: $_POST['STORAGETYPE'];
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
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SALEORDERNO', 'SHIPREQUESTSALEDATE', 'SALEORDERCUSTOMERCODE', 'SALEORDERCUSTOMERSTAFF', 'CUSTOMERADDRESS1', 'CUSTOMERADDRESS2', 'SALEORDERDELIVERYCODE', 'DELIVERYNAME', 'SALEORDERDELIVERYSTAFF', 'DELIVERYADDRESS1', 'DELIVERYADDRESS2');

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
    $key = !empty($key) ? $key : $systemName;
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