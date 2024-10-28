<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2). '/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$data = array();
$syslogic = new Syslogic;
$javaFunc = new ShipReqSaleOrderGuide;
$systemName = strtolower('SEARCHSALENOSHIP');
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

//---------------------------GET-----------------------------------//
if(!empty($_GET)) {
     // print_r($_GET);
    if(isset($_GET['STAFFCD'])) {
        $query = $javaFunc->getStaff($_GET['STAFFCD']);
        $data = $query;
    } else if(isset($_GET['CUSTOMERCD'])) {
        $query = $javaFunc->getCus($_GET['CUSTOMERCD']);
        $data = $query;
    } else if(isset($_GET['ITEMCODE'])) {
        $query = $javaFunc->getItem($_GET['ITEMCODE']);
        $data = $query;
    }
    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

//---------------------------POST-----------------------------------//
if(!empty($_POST)) {

    if(isset($_POST['action'])) {
        if($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if($_POST['action'] == 'STAFFCD') { getStaff(); }
        if($_POST['action'] == 'CUSTOMERCD') { getCus(); }
        if($_POST['action'] == 'ITEMCODE') { getItem(); }
    }

    // STAFFCD,CUSTOMERCD,ITEMCODE,DUEDATE
    if(isset($_POST['SEARCH'])) {
        $data['STAFFCD'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
        $data['CUSTOMERCD'] = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
        $data['ITEMCODE'] = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
        $data['DUEDATE'] = isset($_POST['DUEDATE']) ? $_POST['DUEDATE']: '';        
        $DUEDATE = !empty($_POST['DUEDATE']) ? str_replace('-', '', $_POST['DUEDATE']): '';
        $Param = array( 'STAFFCD' => $data['STAFFCD'], 'CUSTOMERCD' => $data['CUSTOMERCD'], 'ITEMCODE' => $data['ITEMCODE'], 'DUEDATE' => $DUEDATE);
        // print_r($Param);
        $tdata = $javaFunc->Search_Order($Param);
        // echo '<pre>';
        // print_r($tdata);
        // echo '</pre>';
        setSessionArray($data);
    }
}
// ------------------------- CALL Langauge  -------------------//
$loadApp = getSystemData('SEARCHSALENOSHIP');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHSALENOSHIP');
    $syslogic->ProgramRundelete('SEARCHSALENOSHIP');
    setSystemData('SEARCHSALENOSHIP', $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getStaff() {
    $javafunc = new ShipReqSaleOrderGuide;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCus() {
    $javafunc = new ShipReqSaleOrderGuide;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCus($CUSTOMERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getItem() {
    $javafunc = new ShipReqSaleOrderGuide;
    $ITEMCODE = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
    $query = $javafunc->getItem($ITEMCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function setSessionArray($arr){
    $keepField = array('STAFFCD', 'STAFFNAME', 'CUSTOMERCD', 'CUSTOMERNAME', 'ITEMCODE', 'ITEMNAME', 'ITEMSPEC', 'DUEDATE', 'TXTLANG', 'DRPLANG');
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

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>