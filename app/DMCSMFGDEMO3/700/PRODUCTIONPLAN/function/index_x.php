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
$javaFunc = new ProductionPlan;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 17;


if(!empty($_GET)) {
// 
}


if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'SEARCH') { searchs(); }
        if ($_POST['action'] == 'ITEMCODE') { getItem(); }
        if ($_POST['action'] == 'getSW') { getSW(); }
        if ($_POST['action'] == 'getLoc') { getLoc(); } 
        if ($_POST['action'] == 'commit') { commitAll(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
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
$load = getSystemData($_SESSION['APPCODE'].'load');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'load', $load);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['SYSTIMESTAMP'] = $load['SYSTIMESTAMP'];
$UNIT = $data['DRPLANG']['UNIT'];
$FACTORY = $data['DRPLANG']['FACTORY'];
$COSTTYPE = $data['DRPLANG']['COSTTYPE'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function searchs() {
    $javaFunc = new ProductionPlan;
    global $data; unsetSessionkey('ITEM');
    $data['COSTTYPES'] = isset($_POST['COSTTYPES']) ? $_POST['COSTTYPES']: '';
    $data['DUEDATES'] = !empty($_POST['DUEDATES']) ? str_replace('-', '',$_POST['DUEDATES']): '';
    $data['FACTORYCODE'] = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '';
    $query = $javaFunc->search($data['COSTTYPES'], $data['DUEDATES'], $data['FACTORYCODE']);

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

function getItem() {
    $javafunc = new ProductionPlan;
    $ITEMCODE = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
    $getItem = $javafunc->getItem($ITEMCODE);
    echo json_encode($getItem);
}

function getSW() {
    $javafunc = new ProductionPlan;
    $SUPPLIERCODE = isset($_POST['SUPPLIERCODE']) ? $_POST['SUPPLIERCODE']: '';
    $COSTTYPE = isset($_POST['COSTTYPE']) ? $_POST['COSTTYPE']: '';
    $getSW = $javafunc->getSW($SUPPLIERCODE, $COSTTYPE);
    echo json_encode($getSW);
}

function getLoc() {
    $javafunc = new ProductionPlan;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $getLoc = $javafunc->getLoc($LOCTYP, $LOCCD);
    echo json_encode($getLoc);
}

function commitAll() {
    $insfunc = new ProductionPlan;
    $RowParam = [];
    if(!empty($_POST['ROWNOA'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNOA'][$i]) ? $_POST['ROWNOA'][$i]: '',
                                'DUEDATE' => isset($_POST['DUEDATEA'][$i]) ? $_POST['DUEDATEA'][$i]: '',
                                'ITEMCODE' => isset($_POST['ITEMCODEA'][$i]) ? $_POST['ITEMCODEA'][$i]: '',
                                'ITEMNAME' => isset($_POST['ITEMNAMEA'][$i]) ? $_POST['ITEMNAMEA'][$i]: '',
                                'QTY' => isset($_POST['QTYA'][$i]) ? implode(explode(',', $_POST['QTYA'][$i])): '',
                                'SUPPLIERCODE' => isset($_POST['SUPPLIERCODEA'][$i]) ? $_POST['SUPPLIERCODEA'][$i]: '',
                                'SUPPLIERNAME' => isset($_POST['SUPPLIERNAMEA'][$i]) ? $_POST['SUPPLIERNAMEA'][$i]: '',
                                'LOCCD' => isset($_POST['LOCCDA'][$i]) ? $_POST['LOCCDA'][$i]: '',
                                'LOCNAME' => isset($_POST['LOCNAMEA'][$i]) ? $_POST['LOCNAMEA'][$i]: '',
                                'LOCTYP' => isset($_POST['LOCTYPA'][$i]) ? $_POST['LOCTYPA'][$i]: '',
                                'COSTTYPE' =>isset($_POST['COSTTYPEA'][$i]) ?  $_POST['COSTTYPEA'][$i]: '',
                                'ITEMUNIT' => isset($_POST['ITEMUNITA'][$i]) ? $_POST['ITEMUNITA'][$i]: '');
        }
    }

    $param = array( 'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'COSTTYPES' => isset($_POST['COSTTYPES']) ? $_POST['COSTTYPES']: '',
                    'DUEDATES' => isset($_POST['DUEDATES']) ? str_replace('-', '', $_POST['DUEDATES']): '',
                    'DVWID' => isset($_POST['DVWID']) ? $_POST['DVWID']: '',
                    'DATA' => $RowParam);
    // print_r($param);
    $commitAll = $insfunc->commitAll($param);
    unsetSessionData();
    echo json_encode($commitAll);
}

function setSessionArray($arr){
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SYSTIMESTAMP', 'COSTTYPES', 'DUEDATES', 'FACTORYCODE', 'DUEDATE', 'ITEMCODE', 'ITEMNAME', 'QTY', 'SUPPLIERCODE', 'SUPPLIERNAME', 'LOCCD'
    , 'LOCNAME', 'LOCTYP', 'COSTTYPE', 'ITEMUNIT', 'DVWID', 'ROWNO', 'SYSVIS_LOADAPP');
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

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'ALLOCBASETYPSTR' => $_POST['ALLOCBASETYPA'][$i],
                                    'ALLOCBASETYP' => $_POST['ALLOCBASETYPA'][$i],
                                    'ITEMCD' => $_POST['ITEMCDA'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAMEA'][$i],
                                    'ITEMSPEC' => $_POST['ITEMSPECA'][$i],
                                    'ITEMDRAWNO' => $_POST['ITEMDRAWNOA'][$i],
                                    'ALLOCQTY' => $_POST['ALLOCQTYA'][$i],
                                    'ALLOCDRAWNO' => $_POST['ALLOCDRAWNOA'][$i],
                                    'ALLOCORDERFLG' => $_POST['ALLOCORDERFLGA'][$i],
                                    'ALLOCPURORDERNOLN' => $_POST['ALLOCPURORDERNOLNA'][$i],
                                    'ALLOCREM' => $_POST['ALLOCREMA'][$i],
                                    'SYSEN_BOMLOADAPP' => $_POST['SYSEN_BOMLOADAPPA'][$i],
                                    'SYSLD_BOMLOADAPP' => $_POST['SYSLD_BOMLOADAPPA'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYPSTRA'][$i],
                                    'ITEMUNITTYPSTR' => $_POST['ITEMUNITTYPSTRA'][$i],
                                    'ALLOCSPAREQTY' => $_POST['ALLOCSPAREQTYA'][$i],
                                    'ALLOCWDQTY' => $_POST['ALLOCWDQTYA'][$i],
                                    'ALLOCPLANWDDT' => str_replace("-", "/", $_POST['ALLOCPLANWDDTA'][$i]),//date
                                    'ALLOCDRAWDT' => str_replace("-", "/", $_POST['ALLOCDRAWDTA'][$i]),//date
                                    'ALLOCSPECIALFLG' => $_POST['ALLOCSPECIALFLGA'][$i],
                                    'MATERIALCD' => $_POST['MATERIALCDA'][$i],
                                    'MATERIALNAME' => $_POST['MATERIALNAMEA'][$i],
                                    'PITEMCD' => $_POST['PITEMCDA'][$i],
                                    'PITEMNAME' => $_POST['PITEMNAMEA'][$i],
                                    'ALLOCLASTWDDT' => $_POST['ALLOCLASTWDDTA'][$i],
                                    'ITEMSERIALLFLG' => $_POST['ITEMSERIALLFLGA'][$i],
                                    'AQTY' => $_POST['AQTYA'][$i]);
    }
    // print_r($data['ITEM']);
    setSessionArray($data);
}


function unsetItemData($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // print_r($data['ITEM']);
}

?>