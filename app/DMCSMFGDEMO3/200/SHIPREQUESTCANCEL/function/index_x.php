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
$javaFunc = new ShipRequestCancel;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 12;
$minrowB = 0;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['SALEORDERNUMBER_S'])) {
        // print_r(substr(trim($_GET['SALEORDERNUMBER_S']), -1));
        $SALEORDERNUMBER_S = isset($_GET['SALEORDERNUMBER_S']) ? $_GET['SALEORDERNUMBER_S']: '';
        $SALEORDERLINE_S = isset($_GET['SALEORDERLINE_S']) ? $_GET['SALEORDERLINE_S']: substr(trim($_GET['SALEORDERNUMBER_S']), -1);
        $query = $javaFunc->getSaleOrder($SALEORDERNUMBER_S, $SALEORDERLINE_S);
        $data = $query;
    } else if(isset($_GET['CUSTOMERCD'])) {
        $CUSTOMERCD = isset($_GET['CUSTOMERCD']) ? $_GET['CUSTOMERCD']: '';
        $query = $javaFunc->getCustomer($CUSTOMERCD);
        $data = $query;
    } else if(isset($_GET['STORAGECD'])) {
        $STORAGECD = isset($_GET['STORAGECD']) ? $_GET['STORAGECD']: '';
        $query = $javaFunc->getDiv($_GET['STORAGECD']);
        $data = $query;
    } else if(isset($_GET['CATALOGCD'])) {
        $CATALOGCD = isset($_GET['CATALOGCD']) ? $_GET['CATALOGCD']: '';
        $query = $javaFunc->getCatalog($CATALOGCD);
        $data = $query;        
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
        if ($_POST['action'] == 'searchImOh') { searchImOh(); } 
        if ($_POST['action'] == 'getLoc') { getLoc(); } 
        if ($_POST['action'] == 'commit') { cancelAll(); } 
    }
    if (isset($_POST['SEARCH'])) { search(); }
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
$TRANSPORT = $data['DRPLANG']['TRANSPORT'];
$SUSPEND_SEL = $data['DRPLANG']['SUSPEND_SEL'];
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
    $searchfunc = new ShipRequestCancel;
    $param = array( 'LC_CODE' => isset($_POST['LC_CODE']) ? $_POST['LC_CODE']: '', 
                    'SALEORDERNUMBER_S' => isset($_POST['SALEORDERNUMBER_S']) ? $_POST['SALEORDERNUMBER_S']: '', 
                    'SALEORDERLINE_S' => isset($_POST['SALEORDERLINE_S']) ? $_POST['SALEORDERLINE_S']: '', 
                    'ISSUEDATE1' => isset($_POST['ISSUEDATE1']) ? str_replace('-', '', $_POST['ISSUEDATE1']): '', 
                    'ISSUEDATE2' => isset($_POST['ISSUEDATE2']) ? str_replace('-', '', $_POST['ISSUEDATE2']): '', 
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '', 
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '', 
                    'TRANSPORT_S' => isset($_POST['TRANSPORT_S']) ? $_POST['TRANSPORT_S']: '');
    $search = $searchfunc->searchCancel($param);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function searchImOh() {
    $searchfunc = new ShipRequestCancel;
    $ITEMCODE = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $searchImOh = $searchfunc->searchImOh($ITEMCODE);
    echo json_encode($searchImOh);
}

function cancelAll() {
    // SD230700002
    global $data; $RowParam = array();
    $data = getSessionData();
    $javafunc = new ShipRequestCancel;
    for ($i = 0 ; $i < count($_POST['ODRNUMLINEZ']); $i++) { 
        $RowParam[] = array('ODRNUMLINE' => isset($_POST['ODRNUMLINEZ'][$i]) ? $_POST['ODRNUMLINEZ'][$i]: '',
                            'SHIPDT' => isset($_POST['SHIPDTZ'][$i]) ? str_replace('-', '/', $_POST['SHIPDTZ'][$i]): '',
                            'SALEORDERCUSTOMERCODE' => isset($_POST['SALEORDERCUSTOMERCODEZ'][$i]) ? $_POST['SALEORDERCUSTOMERCODEZ'][$i]: '',
                            'SALEORDERCUSTOMERNAME' => isset($_POST['SALEORDERCUSTOMERNAMEZ'][$i]) ? $_POST['SALEORDERCUSTOMERNAMEZ'][$i]: '',
                            'SALEORDERCUSTOMERSTAFF' => isset($_POST['SALEORDERCUSTOMERSTAFFZ'][$i]) ? $_POST['SALEORDERCUSTOMERSTAFFZ'][$i]: '',
                            'ORDERDETAILCUSTOMERORDERNUMBER' => isset($_POST['ORDERDETAILCUSTOMERORDERNUMBERZ'][$i]) ? $_POST['ORDERDETAILCUSTOMERORDERNUMBERZ'][$i]: '',
                            'ITEMCODE' => isset($_POST['ITEMCODEZ'][$i]) ? $_POST['ITEMCODEZ'][$i]: '', 
                            'ITEMNAME' => isset($_POST['ITEMNAMEZ'][$i]) ? $_POST['ITEMNAMEZ'][$i]: '',
                            'ITEMSPEC' => isset($_POST['ITEMSPECZ'][$i]) ? $_POST['ITEMSPECZ'][$i]: '',
                            'SHIPQTY' => isset($_POST['SHIPQTYZ'][$i]) ? $_POST['SHIPQTYZ'][$i]: '',
                            'SALEORDERDELIVERYNAME' => isset($_POST['SALEORDERDELIVERYNAMEZ'][$i]) ? $_POST['SALEORDERDELIVERYNAMEZ'][$i]: '',
                            // 'SALEORDERDELIVERYSTAFF' => isset($_POST['SALEORDERDELIVERYSTAFFZ'][$i]) ? $_POST['SALEORDERDELIVERYSTAFFZ'][$i]: '',
                            'SALEORDERNUMBER' => isset($_POST['SALEORDERNUMBERZ'][$i]) ? $_POST['SALEORDERNUMBERZ'][$i]: '',
                            'ORDERDETAILNUMBERLINE' => isset($_POST['ORDERDETAILNUMBERLINEZ'][$i]) ? $_POST['ORDERDETAILNUMBERLINEZ'][$i]: '',
                            'SHIPREQTRANSTYP' => isset($_POST['SHIPREQTRANSTYPZ'][$i]) ? $_POST['SHIPREQTRANSTYPZ'][$i]: '',
                            'SHIPREQSUSPENDTYP' => isset($_POST['SHIPREQSUSPENDTYPZ'][$i]) ? $_POST['SHIPREQSUSPENDTYPZ'][$i]: '',
                            'SHIPREQNO' => isset($_POST['SHIPREQNOZ'][$i]) ? $_POST['SHIPREQNOZ'][$i]: '',
                            'SHIPREQLN' => isset($_POST['SHIPREQLNZ'][$i]) ? $_POST['SHIPREQLNZ'][$i]: '',
                            'LOCTYP' => isset($_POST['LOCTYPZ'][$i]) ? $_POST['LOCTYPZ'][$i]: '',
                            'LOCCD' => isset($_POST['LOCCDZ'][$i]) ? $_POST['LOCCDZ'][$i]: '',
                            'LOCNAME' => isset($_POST['LOCNAMEZ'][$i]) ? $_POST['LOCNAMEZ'][$i]: '',
                            'ITEMUNITTYP' => isset($_POST['ITEMUNITTYPZ'][$i]) ? $_POST['ITEMUNITTYPZ'][$i]: '');
    }

    $param = array( 'SALEORDERDELIVERYSTAFF' => isset($_POST['SALEORDERDELIVERYSTAFF']) ? $_POST['SALEORDERDELIVERYSTAFF']: '',
                    'ORDERDETAILNUMBERLINE' => isset($_POST['ORDERDETAILNUMBERLINE']) ? $_POST['ORDERDETAILNUMBERLINE']: '',
                    'DATA' => $RowParam);
    // print_r($param);
    $cancelAll = $javafunc->cancelAll($param);
    echo json_encode($cancelAll);
}

function getLoc() {
    $javafunc = new ShipRequestCancel;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: $_POST['STORAGETYPE'];
    $getLoc = $javafunc->getLoc($LOCCD, $LOCTYP);
    echo json_encode($getLoc);
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
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SALEORDERNUMBER_S', 'SALEORDERLINE_S', 'ISSUEDATE1', 'ISSUEDATE2', 'LC_CODE', 'STORAGECD', 'STORAGENAME', 'CATALOGCD', 'CATALOGNAME', 'CUSTOMERCD', 'CUSTOMERNAME', 'TRANSPORT', 'TRANSPORT_S', 'LOCCD', 'LOCNAME');

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