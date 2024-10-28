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
$javaFunc = new NewShipEntryMFG;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['SALEORDERNUMBER_S'])) {
        $SALEORDERNUMBER_S = isset($_GET['SALEORDERNUMBER_S']) ? $_GET['SALEORDERNUMBER_S']: '';
        $query = $javaFunc->getSale($SALEORDERNUMBER_S);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
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
        if ($_POST['action'] == 'commit') { commit(); } 
        if ($_POST['action'] == 'CUSTOMERCD_S') { getCustomer(); }
        if ($_POST['action'] == 'CATALOGCD') { getCatalog(); }
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
$FACTORY = $data['DRPLANG']['FACTORY'];
$TRANSPORT = $data['DRPLANG']['TRANSPORT'];
$SUSPEND_SEL = $data['DRPLANG']['SUSPEND_SEL'];
$STATUS_SALES = $data['DRPLANG']['STATUS_SALES'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getCustomer() {
    $javafunc = new NewShipEntryMFG;
    $CUSTOMERCD_S = isset($_POST['CUSTOMERCD_S']) ? $_POST['CUSTOMERCD_S']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD_S);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCatalog() {
    $javafunc = new NewShipEntryMFG;
    $CATALOGCD = isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '';
    $query = $javafunc->getCatalog($CATALOGCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function search() {
    global $data; 
    $data['ITEM'] = array(); $data = getSessionData();
    $searchfunc = new NewShipEntryMFG;
    $param = array( 'FACTYP' => isset($_POST['FACTYP']) ? $_POST['FACTYP']: '', 
                    'SALEORDERNUMBER_S' => isset($_POST['SALEORDERNUMBER_S']) ? $_POST['SALEORDERNUMBER_S']: '', 
                    'ISSUEDATE1' => isset($_POST['ISSUEDATE1']) ? str_replace('-', '', $_POST['ISSUEDATE1']): '', 
                    'ISSUEDATE2' => isset($_POST['ISSUEDATE2']) ? str_replace('-', '', $_POST['ISSUEDATE2']): '', 
                    'CUSTOMERCD_S' => isset($_POST['CUSTOMERCD_S']) ? $_POST['CUSTOMERCD_S']: '', 
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '', 
                    'TRANSPORT_S' => isset($_POST['TRANSPORT_S']) ? $_POST['TRANSPORT_S']: '');
    $search = $searchfunc->search($param);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function commit() {
    $RowParam = array();
    $javafunc = new NewShipEntryMFG;
    if(isset($_POST['CHECKROW'])) {
        for ($i = 0 ; $i < count($_POST['ODRNUMLINE']); $i++) { 
            $RowParam[] = array(    'CHECKROW' => !empty($_POST['CHECKROW'][$i]) ? $_POST['CHECKROW'][$i]: '',
                                    'ODRNUMLINE' => $_POST['ODRNUMLINE'][$i],
                                    'SHIPDT' => $_POST['SHIPDT'][$i],
                                    'SALECUSORDERNO' => $_POST['SALECUSORDERNO'][$i],
                                    'ITEMCODE' => $_POST['ITEMCODE'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'ITEMSPEC' => $_POST['ITEMSPEC'][$i],
                                    'SHIPQTY' => $_POST['SHIPQTY'][$i],
                                    'DELIVERYCODE' => $_POST['DELIVERYCODE'][$i],
                                    'DELIVERYNAME' => $_POST['DELIVERYNAME'][$i],
                                    'SHIPREQTRANSTYP' => $_POST['SHIPREQTRANSTYP'][$i],
                                    'SHIPREQSUSPENDTYP' => $_POST['SHIPREQSUSPENDTYP'][$i],
                                    'SHIPREQNO' => $_POST['SHIPREQNO'][$i],
                                    'SHIPREQLN' => $_POST['SHIPREQLN'][$i],
                                    'LOCTYP' => $_POST['LOCTYP'][$i],
                                    'LOCCD' => $_POST['LOCCD'][$i],
                                    'SALEODR' => $_POST['SALEODR'][$i],
                                    'SALELNE' => $_POST['SALELNE'][$i],
                                    'SALELNINSPTYP' => $_POST['SALELNINSPTYP'][$i],
                                    'CUSTOMERCD' =>  $_POST['CUSTOMERCD'][$i]);
        }

        $param = array( 'DELIDATE' => isset($_POST['DELIDATE']) ? str_replace('-', '', $_POST['DELIDATE']): '',
                        'DATA' => $RowParam);
        // print_r($param);
        $commit = $javafunc->commitAll($param);
        echo json_encode($commit);
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SALEORDERNUMBER_S', 'ISSUEDATE1', 'ISSUEDATE2', 'CUSTOMERCD_S', 'CUSTOMERNAME_S', 'CATALOGCD', 'CATALOGNAME', 'TRANSPORT_S', 'FACTYP', 'DELIDATE');
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