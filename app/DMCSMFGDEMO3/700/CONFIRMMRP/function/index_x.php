<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode('/', dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
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
}  // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
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
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$javaFunc = new ConfirmMRP;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 18;

if(!empty($_GET)) {
// 
}

if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'SEARCH') { searchs(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'getOffer') { getOffer(); }
        if ($_POST['action'] == 'RUN') { run(); } 
    }
}

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
$COSTTYPE = $data['DRPLANG']['COSTTYPE'];
$FACTORY = $data['DRPLANG']['FACTORY'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
$BRANCH_TYPE = $data['DRPLANG']['BRANCH_TYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function searchs() {
    $javaFunc = new ConfirmMRP;
    global $data; unsetSessionkey('ITEM');
    $data['radioGroup'] = isset($_POST['radioGroup']) ? $_POST['radioGroup']: '';
    $data['COSTTYPES'] = isset($_POST['COSTTYPES']) ? $_POST['COSTTYPES']: '';
    $data['DUEDATES'] = !empty($_POST['DUEDATES']) ? str_replace('-', '',$_POST['DUEDATES']): '';
    $data['OFFERCODE'] = isset($_POST['OFFERCODE']) ? $_POST['OFFERCODE']: '';
    $data['SD'] = isset($_POST['radioGroup'])  && $_POST['radioGroup'] == 'SD' ? 'T': 'F';
    $data['TD'] = isset($_POST['radioGroup'])  && $_POST['radioGroup'] == 'TD' ? 'T': 'F';
    $data['FACTORYCODE'] = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '';
    $data['STAFFCD'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javaFunc->search($data['COSTTYPES'], $data['DUEDATES'], $data['OFFERCODE'], $data['SD'], $data['TD'], $data['FACTORYCODE'], $data['STAFFCD']);
    if(!empty($query)) {
        $data['ITEM'] = $query; 
    }

    setSessionArray($data);

    if(checkSessionData()) { 
        $data = getSessionData(); 
    }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function getStaff() {
    $javafunc = new ConfirmMRP;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $getStaff = $javafunc->getStaff($STAFFCD);
    echo json_encode($getStaff);
}

function getOffer() {
    $javafunc = new ConfirmMRP;
    $OFFERCODE = isset($_POST['OFFERCODE']) ? $_POST['OFFERCODE']: '';
    $COSTTYPES = isset($_POST['COSTTYPES']) ? $_POST['COSTTYPES']: '';
    $getOffer = $javafunc->getOffer($OFFERCODE, $COSTTYPES);
    echo json_encode($getOffer);
}

function run() {
    $javafunc = new ConfirmMRP;
    $RowParam = [];
    if(isset($_POST['CHECKROW'])) {
        for ($i = 0 ; $i < count($_POST['DUEDATE']); $i++) { 
            $RowParam[] = array('CHECKROW' => isset($_POST['CHECKROW'][$i]) ? $_POST['CHECKROW'][$i]: 'F',
                                'MRPSTATUS' => isset($_POST['MRPSTATUS'][$i]) ? $_POST['MRPSTATUS'][$i]: '',
                                'DUEDATE' => isset($_POST['DUEDATE'][$i]) ? str_replace('-', '', $_POST['DUEDATE'][$i]): '',
                                'STARTDATE' => isset($_POST['STARTDATE'][$i]) ? str_replace('-', '', $_POST['STARTDATE'][$i]): '',
                                'ITEMCODE' => isset($_POST['ITEMCODE'][$i]) ? $_POST['ITEMCODE'][$i]: '',
                                'ITEMNAME' => isset($_POST['ITEMNAME'][$i]) ? $_POST['ITEMNAME'][$i]: '',
                                'QTY' => isset($_POST['QTY'][$i]) ? str_replace(',', '', $_POST['QTY'][$i]): '',
                                'ITEMUNIT' => isset($_POST['ITEMUNIT'][$i]) ? $_POST['ITEMUNIT'][$i]: '',
                                'ITEMUNITSTR' => isset($_POST['ITEMUNITSTR'][$i]) ? $_POST['ITEMUNITSTR'][$i]: '',
                                'COSTTYPE' => isset($_POST['COSTTYPE'][$i]) ? $_POST['COSTTYPE'][$i]: '',
                                'COSTTYPESTR' => isset($_POST['COSTTYPESTR'][$i]) ? $_POST['COSTTYPESTR'][$i]: '',
                                'SUPPLIERCODE' => isset($_POST['SUPPLIERCODE'][$i]) ? $_POST['SUPPLIERCODE'][$i]: '',
                                'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME'][$i]) ? $_POST['SUPPLIERNAME'][$i]: '',
                                'STORAGETYPE' => isset($_POST['STORAGETYPE'][$i]) ? $_POST['STORAGETYPE'][$i]: '',
                                'STORAGETYPESTR' => isset($_POST['STORAGETYPESTR'][$i]) ? $_POST['STORAGETYPESTR'][$i]: '',
                                'STORAGECODE' => isset($_POST['STORAGECODE'][$i]) ? $_POST['STORAGECODE'][$i]: '',
                                'STORAGENAME' => isset($_POST['STORAGENAME'][$i]) ? $_POST['STORAGENAME'][$i]: '',
                                'FACTYP' => isset($_POST['FACTYP'][$i]) ? $_POST['FACTYP'][$i]: '',
                                'DVWID' => isset($_POST['DVWID'][$i]) ? $_POST['DVWID'][$i]: '',
                                'ODRPLAN' => isset($_POST['ODRPLAN'][$i]) ? $_POST['ODRPLAN'][$i]: '',
                                'MRPSTATUSCD' => isset($_POST['MRPSTATUSCD'][$i]) ? $_POST['MRPSTATUSCD'][$i]: '',
                                'PROPLANORDERNO' => isset($_POST['PROPLANORDERNO'][$i]) ? $_POST['PROPLANORDERNO'][$i]: '',
                                'SEQ' => isset($_POST['SEQ'][$i]) ? $_POST['SEQ'][$i]: '',
                                'ITEMMASTERPLANFLG' => isset($_POST['ITEMMASTERPLANFLG'][$i]) ? $_POST['ITEMMASTERPLANFLG'][$i]: '');
        }
    }

    $param = array( 'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'OFFERCODE' => isset($_POST['OFFERCODE']) ? $_POST['OFFERCODE']: '',
                    'SD' => isset($_POST['radioGroup'])  && $_POST['radioGroup'] == 'SD' ? 'T': 'F',
                    'TD' => isset($_POST['radioGroup'])  && $_POST['radioGroup'] == 'TD' ? 'T': 'F',
                    'DUEDATES' => isset($_POST['DUEDATES']) ? str_replace('-', '', $_POST['DUEDATES']): '',
                    'MRPSUMFLG' => isset($_POST['MRPSUMFLG']) ? $_POST['MRPSUMFLG']: 'F',
                    'MRPSUMFLG2' => isset($_POST['MRPSUMFLG2']) ? $_POST['MRPSUMFLG2']: 'F',
                    'MRPSUMFLG3' => isset($_POST['MRPSUMFLG3']) ? $_POST['MRPSUMFLG3']: 'F',
                    'MRPSUMFLG4' => isset($_POST['MRPSUMFLG4']) ? $_POST['MRPSUMFLG4']: 'F',
                    'DATA' => $RowParam);
    // print_r($param);
    $confirm = $javafunc->confirm($param);
    unsetSessionData();
    echo json_encode($confirm);
}

function setSessionArray($arr){
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'STAFFCD', 'OFFERCODE', 'COSTTYPES', 'DUEDATES', 'SD', 'TD', 'FACTORYCODE', 'CHECKROW', 'MRPSTATUS', 'DUEDATE', 'ITEMCODE', 'ITEMNAME', 'QTY', 'ITEMUNIT', 'COSTTYPE', 'SUPPLIERCODE', 'SUPPLIERNAME', 'STORAGETYPE', 'STORAGECODE', 'STORAGENAME', 'FACTYP', 'DVWID', 'ODRPLAN', 'MRPSTATUSCD', 'PROPLANORDERNO', 'SEQ', 'MRPSUMFLG', 'MRPSUMFLG2', 'MRPSUMFLG3', 'MRPSUMFLG4', 'ITEMMASTERPLANFLG', 'CHKALL', 'STAFFNAME', 'OFFERNAME', 'radioGroup');
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

function getDropdownData($key = '') {
    return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
    return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
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

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}
?>