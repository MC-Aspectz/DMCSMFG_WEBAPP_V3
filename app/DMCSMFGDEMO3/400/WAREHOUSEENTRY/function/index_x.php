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
$javaFunc = new WarehouseEntry;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 5;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 240700006
    if(!empty($_GET['PROORDERNO'])) {
        unsetSessionData();
        $PROORDERNO = isset($_GET['PROORDERNO']) ? $_GET['PROORDERNO']: '';
        $query = $javaFunc->getPro($PROORDERNO);
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
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'PROTRANORDERNO') { getProTran(); }
        if ($_POST['action'] == 'PROTRANQTY') { getStatus(); }
        if ($_POST['action'] == 'INSERT') { commit(); }
        if ($_POST['action'] == 'UPDATE') { commit(); }
        if ($_POST['action'] == 'DELETE') { delete(); }
        if ($_POST['action'] == 'unsetScrapItemData') {  unsetScrapItemData($_POST['lineIndex']); }
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
$FACTORY = $data['DRPLANG']['FACTORY'];
$BAD_CODE = $data['DRPLANG']['BAD_CODE'];
$INSPECTION = $data['DRPLANG']['INSPECTION'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
$STATUS_ORDER = $data['DRPLANG']['STATUS_ORDER'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getProTran() {
    $javafunc = new WarehouseEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $PROTRANORDERNO = isset($_POST['PROTRANORDERNO']) ? $_POST['PROTRANORDERNO']: '';
    $getProTran = $javafunc->getProTran($PROORDERNO, $PROTRANORDERNO);
    $searchBad = $javafunc->searchBad($PROORDERNO, $PROTRANORDERNO);
    $result = array('getProTran' => $getProTran,
                    'searchBad' => $searchBad);
    echo json_encode($result);
}  

function getStatus() {
    $javafunc = new WarehouseEntry;
    $PROQTY = isset($_POST['PROQTY']) ? str_replace(',', '', $_POST['PROQTY']): '';
    $PROCOMPQTY = isset($_POST['PROCOMPQTY']) ? str_replace(',', '', $_POST['PROCOMPQTY']): '';
    $PROTRANQTY = isset($_POST['PROTRANQTY']) ? str_replace(',', '', $_POST['PROTRANQTY']): '';
    $BFPROTRANQTY = isset($_POST['BFPROTRANQTY']) ? str_replace(',', '', $_POST['BFPROTRANQTY']): '';
    $query = $javafunc->getStatus($PROQTY, $PROCOMPQTY, $PROTRANQTY, $BFPROTRANQTY);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function commit() {
    $insfunc = new WarehouseEntry;
    $Param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROSALENOLN' => isset($_POST['PROSALENOLN']) ? $_POST['PROSALENOLN']: '',
                    'PROREM' => isset($_POST['PROREM']) ? $_POST['PROREM']: '',
                    'PROQTY' => isset($_POST['PROQTY']) ? str_replace(',', '', $_POST['PROQTY']): '',
                    'PROCOMPQTY' => isset($_POST['PROCOMPQTY']) ? str_replace(',', '', $_POST['PROCOMPQTY']): '',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROINSPTYP' => isset($_POST['PROINSPTYP']) ? $_POST['PROINSPTYP']: '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'LOCTYP' => isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '',
                    'LOCCD' => isset($_POST['LOCCD']) ? $_POST['LOCCD']: '',
                    'WCCD' => isset($_POST['WCCD']) ? $_POST['WCCD']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'MATERIALCD' => isset($_POST['MATERIALCD']) ? $_POST['MATERIALCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ITEMNAME' => isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMSPEC' => isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                    'ITEMDRAWNO' => isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    'ITEMACCCD' => isset($_POST['ITEMACCCD']) ? $_POST['ITEMACCCD']: '',
                    'ITEMSTDSUPPLYPRICE' => isset($_POST['ITEMSTDSUPPLYPRICE']) ? str_replace(',', '', $_POST['ITEMSTDSUPPLYPRICE']): '',
                    'PROTRANORDERNO' => isset($_POST['PROTRANORDERNO']) ? $_POST['PROTRANORDERNO']: '',
                    'PROTRANDT' => isset($_POST['PROTRANDT']) ? str_replace('-', '', $_POST['PROTRANDT']): '',
                    'PROTRANQTY' => isset($_POST['PROTRANQTY']) ? str_replace(',', '', $_POST['PROTRANQTY']): '',
                    'PROTRANWAITQTY' => isset($_POST['PROTRANWAITQTY']) ? str_replace(',', '', $_POST['PROTRANWAITQTY']): '',
                    'PROTRANBADQTY' => isset($_POST['PROTRANBADQTY']) ? str_replace(',', '', $_POST['PROTRANBADQTY']): '',
                    'PROTRANINSPTYP' => isset($_POST['PROTRANINSPTYP']) ? $_POST['PROTRANINSPTYP']: '',
                    'PROTRANSTATUS' => isset($_POST['PROTRANSTATUS']) ? $_POST['PROTRANSTATUS']: '',
                    'PROTRANREM' => isset($_POST['PROTRANREM']) ? $_POST['PROTRANREM']: '',
                    'SUMBADQTY' => isset($_POST['SUMBADQTY']) ? str_replace(',', '', $_POST['SUMBADQTY']): '',
                    'DEL_RECORD' => isset($_POST['DEL_RECORD']) ? $_POST['DEL_RECORD']: '');
    // print_r($Param);
    $commit = $insfunc->commit($Param);
    $RowParam = [];
    if(!empty($_POST['BADREASON'])) {
        for ($i = 0 ; $i < count($_POST['BADREASON']); $i++) { 
            $RowParam[] = array('BADREASON' => isset($_POST['BADREASON'][$i]) ? $_POST['BADREASON'][$i]: '',
                                'BADQTY' => isset($_POST['BADQTY'][$i]) ? str_replace(',', '', $_POST['BADQTY'][$i]): '');
        }   
    }
    $Param2 = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                     'PROTRANORDERNO' => isset($_POST['PROTRANORDERNO']) ? $_POST['PROTRANORDERNO']: '',
                     'DATA' => $RowParam,
    );
    $commitBad = $insfunc->commitBad($Param2);

    $result = $commit;
    if(strpos($commitBad,'ERRO:Data') !== false) {
        $result = $commitBad;
    } 
    // print_r($commitBad);
    // print_r($commit);
    unsetSessionkey('DVWSCRAP');
    unsetSessionData();
    echo json_encode($result);
}

function delete() {
    $delfunc = new WarehouseEntry;
    $Param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROSALENOLN' => isset($_POST['PROSALENOLN']) ? $_POST['PROSALENOLN']: '',
                    'PROREM' => isset($_POST['PROREM']) ? $_POST['PROREM']: '',
                    'PROQTY' => isset($_POST['PROQTY']) ? str_replace(',', '', $_POST['PROQTY']): '',
                    'PROCOMPQTY' => isset($_POST['PROCOMPQTY']) ? str_replace(',', '', $_POST['PROCOMPQTY']): '',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROINSPTYP' => isset($_POST['PROINSPTYP']) ? $_POST['PROINSPTYP']: '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'LOCTYP' => isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '',
                    'LOCCD' => isset($_POST['LOCCD']) ? $_POST['LOCCD']: '',
                    'WCCD' => isset($_POST['WCCD']) ? $_POST['WCCD']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'MATERIALCD' => isset($_POST['MATERIALCD']) ? $_POST['MATERIALCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ITEMNAME' => isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMSPEC' => isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                    'ITEMDRAWNO' => isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    'ITEMACCCD' => isset($_POST['ITEMACCCD']) ? $_POST['ITEMACCCD']: '',
                    'ITEMSTDSUPPLYPRICE' => isset($_POST['ITEMSTDSUPPLYPRICE']) ? str_replace(',', '', $_POST['ITEMSTDSUPPLYPRICE']): '',
                    'PROTRANORDERNO' => isset($_POST['PROTRANORDERNO']) ? $_POST['PROTRANORDERNO']: '',
                    'PROTRANDT' => isset($_POST['PROTRANDT']) ? str_replace('-', '', $_POST['PROTRANDT']): '',
                    'PROTRANQTY' => isset($_POST['PROTRANQTY']) ? str_replace(',', '', $_POST['PROTRANQTY']): '',
                    'PROTRANWAITQTY' => isset($_POST['PROTRANWAITQTY']) ? str_replace(',', '', $_POST['PROTRANWAITQTY']): '',
                    'PROTRANBADQTY' => isset($_POST['PROTRANBADQTY']) ? str_replace(',', '', $_POST['PROTRANBADQTY']): '',
                    'PROTRANINSPTYP' => isset($_POST['PROTRANINSPTYP']) ? $_POST['PROTRANINSPTYP']: '',
                    'PROTRANSTATUS' => isset($_POST['PROTRANSTATUS']) ? $_POST['PROTRANSTATUS']: '',
                    'PROTRANREM' => isset($_POST['PROTRANREM']) ? $_POST['PROTRANREM']: '',
                    'SUMBADQTY' => isset($_POST['SUMBADQTY']) ? str_replace(',', '', $_POST['SUMBADQTY']): '',
                    'DEL_RECORD' => isset($_POST['DEL_RECORD']) ? $_POST['DEL_RECORD']: '');
    // print_r($Param);
    $delete = $delfunc->delete($Param);
    unsetSessionData();
    echo json_encode($delete);
}

function setSessionArray($arr){
    $keepField = array(  'SYSPVL', 'TXTLANG', 'DRPLANG', 'PROORDERNO', 'WCCD', 'WCNAME', 'PROSALENOLN', 'PROFACTYP', 'STAFFCD', 'STAFFNAME', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'ITEMDRAWNO', 'MATERIALCD', 'MATERIALNAME', 'PROREM', 'LOCTYP', 'LOCCD', 'LOCNAME', 'PROSTATUS', 'PROQTY', 'ITEMUNITTYP', 'PROPLANSTARTDT', 'PROTRANWAITQTY', 'PROPLANENDDT', 'PROCOMPQTY', 'PROINSPTYP', 'PROTRANDT', 'PROTRANORDERNO', 'TRANID', 'PROTRANBADQTY', 'BFPROTRANQTY', 'PROTRANQTY', 'PROTRANREM', 'SUMBADQTY', 'PROTRANINSPTYP', 'PROTRANSTATUS', 'PROTRANREM', 'PROSCRAPPROORDERNO', 'DVWSCRAP');

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

function unsetScrapItemData($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'DVWSCRAP', $lineIndex);
    $data = getSessionData();
    $data['DVWSCRAP'] = array_combine(range(1, count($data['DVWSCRAP'])), array_values($data['DVWSCRAP']));
    setSessionArray($data);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}
?>