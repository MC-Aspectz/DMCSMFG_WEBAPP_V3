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
$javaFunc = new OrderBMEntry;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    // 231200013
    if(isset($_GET['ALLOCORDERNO']) && isset($_GET['ALLOCORDERTYP'])) {
        unsetSearchData();
        $ALLOCORDERNO = isset($_GET['ALLOCORDERNO']) ? $_GET['ALLOCORDERNO']: '';
        $ALLOCORDERTYP = isset($_GET['ALLOCORDERTYP']) ? $_GET['ALLOCORDERTYP']: '';
        $query = $javaFunc->get($ALLOCORDERNO, $ALLOCORDERTYP);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $data['ALLOCORDERTYP'] = $ALLOCORDERTYP;
            $querySearch = $javaFunc->orderSearch($query['ORDERNO'], $query['ORDERLN'], $ALLOCORDERTYP, $query['ODRQTY']);
            // echo '<pre>';
            // print_r($querySearch);
            // echo '</pre>';
            if(!empty($querySearch)) {
                $data['ITEM'] = $querySearch; 
            }
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'SEARCH') { search(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'MATERIALCD') { getMat(); }
        if ($_POST['action'] == 'PITEMCODE') { getPItem(); }
        if ($_POST['action'] == 'REMAKE') { Remake(); }
        if ($_POST['action'] == 'commit') { commitAll(); }
        if ($_POST['action'] == 'proOrPur') { proOrPur(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
    }
    if(isset($_POST['PROORDERNO'])) { setALLOCPURORDERNOLN(); }
}

//--------------------------------------------------------------------------------
// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
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
// $statusorder = $data['DRPLANG']['STATUS_ORDER'];
$UNIT = $data['DRPLANG']['UNIT'];
$BMVERSION = $data['DRPLANG']['BMVERSION'];
$MAKEORDERTYPE = $data['DRPLANG']['MAKEORDERTYPE'];
$ALLOCORDERTYP = $data['DRPLANG']['ODRTYPFORSEARCH'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getItem() {
    $javafunc = new OrderBMEntry;
    $data['ITEMNAME'] = '';
    $data['ITEMCD'] = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $query = $javafunc->getItem($data['ITEMCD']);
    if(!empty($query)) { $data = $query; setSessionArray($query); } else { unsetInsertData(); }
    echo json_encode($data);
}        

function getMat() {
    unsetSessionkey('MATERIALNAME');
    $javafunc = new OrderBMEntry;
    $data['MATERIALNAME'] = '';
    $data['MATERIALCD'] = isset($_POST['MATERIALCD']) ? $_POST['MATERIALCD']: '';
    $query = $javafunc->getMat($data['MATERIALCD']);
    if(!empty($query)) { $data = $query; setSessionArray($query); }
    echo json_encode($data);
}

function getPItem() {
    unsetSessionkey('PITEMNAME');
    $javafunc = new OrderBMEntry;
    $data['PITEMNAME'] = '';
    $data['PITEMCODE'] = isset($_POST['PITEMCODE']) ? $_POST['PITEMCODE']: '';
    $query = $javafunc->getPItem($data['PITEMCODE']);
    if(!empty($query)) { $data = $query; setSessionArray($query); }
    echo json_encode($data);
}


function search() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $searchfunc = new OrderBMEntry;
    $ODRQTY = isset($_POST['ODRQTY']) ? $_POST['ODRQTY']: '';
    $ORDERNO = isset($_POST['ORDERNO']) ? $_POST['ORDERNO']: '';
    $ORDERLN = isset($_POST['ORDERLN']) ? $_POST['ORDERLN']: '';
    $ALLOCORDERTYP = isset($_POST['ALLOCORDERTYP']) ? $_POST['ALLOCORDERTYP']: '';
    $search = $searchfunc->orderSearch($ORDERNO, $ORDERLN, $ALLOCORDERTYP, $ODRQTY);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function Remake() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $javaFunc = new OrderBMEntry;
    $Param = array( 'ALLOCORDERTYP' => isset($_POST['ALLOCORDERTYP']) ? $_POST['ALLOCORDERTYP']: '',
                    'ORDERNO' => isset($_POST['ORDERNO']) ? $_POST['ORDERNO']: '',
                    'ORDERLN' => isset($_POST['ORDERLN']) ? $_POST['ORDERLN']: '',
                    'ODRITEMCD' => isset($_POST['ODRITEMCD']) ? $_POST['ODRITEMCD']: '',
                    'WITHDRAWDATE' => isset($_POST['WITHDRAWDATE']) ? $_POST['WITHDRAWDATE']: '',
                    'ORDERDUEDT' => isset($_POST['ORDERDUEDT']) ? str_replace('-', '',$_POST['ORDERDUEDT']): '',
                    'BMVERSION' => isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '');
    $query = $javaFunc->remake($Param);
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';
    if(!empty($query)) {
        $data['ITEM'] = $query; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

function proOrPur() {
    $javaFunc = new OrderBMEntry; unsetSessionkey('SYSEN_BOMLOADAPP');
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $ALLOCORDERFLG = isset($_POST['ALLOCORDERFLG']) ? $_POST['ALLOCORDERFLG']: '';
    $query = $javaFunc->proOrPur($ITEMCD, $ALLOCORDERFLG);
    setSessionData('ALLOCORDERFLG', $ALLOCORDERFLG);
    setSessionData('SYSEN_BOMLOADAPP', $query['SYSEN_BOMLOADAPP']);
    setSessionData('SYSLD_BOMLOADAPP', $query['SYSLD_BOMLOADAPP']);
    echo json_encode($query);
}

function commitAll() {
    $insfunc = new OrderBMEntry;
    $RowParam = [];
    if(!empty($_POST['ROWNOZ'])) {
        for ($i = 0 ; $i < count($_POST['ALLOCLNZ']); $i++) { 
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNOZ'][$i]) ? $_POST['ROWNOZ'][$i]: '',
                                'ALLOCBASETYP' => isset($_POST['ALLOCBASETYPZ'][$i]) ? $_POST['ALLOCBASETYPZ'][$i]: '',
                                'ITEMCD' => isset($_POST['ITEMCDZ'][$i]) ? $_POST['ITEMCDZ'][$i]: '',
                                'ITEMNAME' => isset($_POST['ITEMNAMEZ'][$i]) ? $_POST['ITEMNAMEZ'][$i]: '',
                                'ITEMSPEC' => isset($_POST['ITEMSPECZ'][$i]) ? $_POST['ITEMSPECZ'][$i]: '',
                                'ALLOCQTY' => isset($_POST['ALLOCQTYZ'][$i]) ? implode(explode(',', $_POST['ALLOCQTYZ'][$i])): '',
                                'ALLOCSPAREQTY' => isset($_POST['ALLOCSPAREQTYZ'][$i]) ? implode(explode(',', $_POST['ALLOCSPAREQTYZ'][$i])): '',
                                'AQTY' => isset($_POST['AQTYZ'][$i]) ? implode(explode(',', $_POST['AQTYZ'][$i])): '',
                                'ALLOCWDQTY' => isset($_POST['ALLOCWDQTYZ'][$i]) ? implode(explode(',', $_POST['ALLOCWDQTYZ'][$i])): '',
                                'ALLOCPLANWDDT' => isset($_POST['ALLOCPLANWDDTZ']) ? str_replace('/', '', $_POST['ALLOCPLANWDDTZ'][$i]): '',
                                'ALLOCDRAWDT' => isset($_POST['ALLOCDRAWDTZ']) ? str_replace('/', '', $_POST['ALLOCDRAWDTZ'][$i]): '',
                                'ALLOCDRAWNO' => isset($_POST['ALLOCDRAWNOZ'][$i]) ? $_POST['ALLOCDRAWNOZ'][$i]: '',
                                'ALLOCORDERFLG' => isset($_POST['ALLOCORDERFLGZ'][$i]) ? $_POST['ALLOCORDERFLGZ'][$i]: '',
                                'ALLOCPURORDERNOLN' => isset($_POST['ALLOCPURORDERNOLNZ'][$i]) ? $_POST['ALLOCPURORDERNOLNZ'][$i]: '',
                                'ALLOCREM' => isset($_POST['ALLOCREMZ'][$i]) ? $_POST['ALLOCREMZ'][$i]: '',
                                'ALLOCSPECIALFLG' => isset($_POST['ALLOCSPECIALFLGZ'][$i]) ? $_POST['ALLOCSPECIALFLGZ'][$i]: '',
                                'ITEMDRAWNO' => isset($_POST['ITEMDRAWNOZ'][$i]) ? $_POST['ITEMDRAWNOZ'][$i]: '',
                                'MATERIALCD' => !empty($_POST['MATERIALCDZ'][$i]) ? $_POST['MATERIALCDZ'][$i]: '',
                                'MATERIALNAME' => !empty($_POST['MATERIALNAMEZ'][$i]) ? $_POST['MATERIALNAMEZ'][$i]: '',
                                'PITEMCD' => isset($_POST['PITEMCDZ'][$i]) ? $_POST['PITEMCDZ'][$i]: '',
                                'PITEMNAME' => isset($_POST['PITEMNAMEZ'][$i]) ? $_POST['PITEMNAMEZ'][$i]: '',
                                'ITEMUNITTYP'=> isset($_POST['ITEMUNITTYPZ']) ? $_POST['ITEMUNITTYPZ'][$i]: '',
                                'ALLOCLASTWDDT' => isset($_POST['ALLOCLASTWDDTZ']) ? str_replace('/', '', $_POST['ALLOCLASTWDDTZ'][$i]): '',
                                'ITEMSERIALLFLG' => isset($_POST['ITEMSERIALLFLGZ'][$i]) ? $_POST['ITEMSERIALLFLGZ'][$i]: '');
        }
    }

    $param = array( 'ORDERNO' => isset($_POST['ORDERNO']) ? $_POST['ORDERNO']: '',
                    'ORDERLN' => isset($_POST['ORDERLN']) ? $_POST['ORDERLN']: '',
                    'ALLOCORDERTYP' => isset($_POST['ALLOCORDERTYP']) ? $_POST['ALLOCORDERTYP']: '',
                    'DATA' => $RowParam,
                );
    // print_r($param);
    $commitAll = $insfunc->commitAll($param);
    unsetSessionData();
    echo json_encode($commitAll);
}

function setALLOCPURORDERNOLN() {
    global $data; $data = getSessionData();
    // print_r($_POST['PROORDERNO']);
    $data['ALLOCPURORDERNOLN'] = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}

function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ALLOCORDERNO', 'ALLOCORDERTYP', 'ORDERNO', 'ORDERLN', 'ODRITEMCD', 'WITHDRAWDATE', 'ORDERDUEDT', 'BMVERSION', 'ODRQTY', 'ROWNO', 'ALLOCBASETYP', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'ALLOCQTY', 'ALLOCSPAREQTY', 'AQTY', 'ALLOCWDQTY', 'ALLOCPLANWDDT', 'ALLOCDRAWDT', 'ALLOCDRAWNO', 'ALLOCORDERFLG', 'ALLOCPURORDERNOLN', 'ALLOCREM', 'ALLOCSPECIALFLG', 'ITEMDRAWNO', 'MATERIALCD', 'MATERIALNAME', 'PITEMCODE', 'PITEMCD', 'PITEMNAME', 'ITEMUNITTYP', 'ITEMUNITTYPSTR', 'ALLOCLASTWDDT', 'ITEMSERIALLFLG', 'ALLOCORDERTYP', 'ODRITEMNAME', 'ODRITEMSPEC', 'ODRITEMDRAWNO', 'ODRPLACE', 'ODRPLACENAME', 'SYSVIS_BMVERSION' ,'SYSVIS_BMVERSIONLBL' ,'SYSVIS_REMAKE' ,'ORDITEMUNITTYP' , 'ALLOCBASETYPSTR', 'SYSVIS_ORDERLN', 'BOMLENGTH', 'ALLOCLN', 'SYSEN_BOMLOADAPP', 'SYSLD_BOMLOADAPP', 'SYSMSG');

    foreach($arr as $k => $v) {
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
    for ($i = 0 ; $i < count($_POST['ROWNOZ']); $i++) { 
        $data['ITEM'][$i+1] = array('ALLOCLN' => $_POST['ALLOCLNZ'][$i],
                                    'ROWNO' => $_POST['ROWNOZ'][$i],
                                    'ALLOCBASETYPSTR' => $_POST['ALLOCBASETYPZ'][$i],
                                    'ALLOCBASETYP' => $_POST['ALLOCBASETYPZ'][$i],
                                    'ITEMCD' => $_POST['ITEMCDZ'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAMEZ'][$i],
                                    'ITEMSPEC' => $_POST['ITEMSPECZ'][$i],
                                    'ITEMDRAWNO' => $_POST['ITEMDRAWNOZ'][$i],
                                    'ALLOCQTY' => $_POST['ALLOCQTYZ'][$i],
                                    'ALLOCDRAWNO' => $_POST['ALLOCDRAWNOZ'][$i],
                                    'ALLOCORDERFLG' => $_POST['ALLOCORDERFLGZ'][$i],
                                    'ALLOCPURORDERNOLN' => $_POST['ALLOCPURORDERNOLNZ'][$i],
                                    'ALLOCREM' => $_POST['ALLOCREMZ'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYPSTRZ'][$i],
                                    'ITEMUNITTYPSTR' => $_POST['ITEMUNITTYPSTRZ'][$i],
                                    'ALLOCSPAREQTY' => $_POST['ALLOCSPAREQTYZ'][$i],
                                    'ALLOCWDQTY' => $_POST['ALLOCWDQTYZ'][$i],
                                    'AQTY' => $_POST['AQTYZ'][$i],
                                    'ALLOCPLANWDDT' => $_POST['ALLOCPLANWDDTZ'][$i],
                                    'ALLOCDRAWDT' =>  $_POST['ALLOCDRAWDTZ'][$i],
                                    'ALLOCSPECIALFLG' => $_POST['ALLOCSPECIALFLGZ'][$i],
                                    'MATERIALCD' => $_POST['MATERIALCDZ'][$i],
                                    'MATERIALNAME' => $_POST['MATERIALNAMEZ'][$i],
                                    'PITEMCD' => $_POST['PITEMCDZ'][$i],
                                    'PITEMNAME' => $_POST['PITEMNAMEZ'][$i],
                                    'ALLOCLASTWDDT' => $_POST['ALLOCLASTWDDTZ'][$i],
                                    'ITEMSERIALLFLG' => $_POST['ITEMSERIALLFLGZ'][$i],
                                    'SYSEN_BOMLOADAPP' => $_POST['SYSEN_BOMLOADAPPZ'][$i],
                                    'SYSLD_BOMLOADAPP' => $_POST['SYSLD_BOMLOADAPPZ'][$i]);
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
    unsetInsertData();
    $data = getSessionData();
    // print_r($data['ITEM']);
}

function unsetSearchData() {
    unsetSessionkey('ITEM');
    unsetSessionkey('ALLOCORDERNO');
    unsetSessionkey('ALLOCORDERTYP');
    unsetSessionkey('SYSVIS_REMAKE');
    unsetSessionkey('SYSVIS_BMVERSION');
    unsetSessionkey('SYSVIS_BMVERSIONLBL');
}

function unsetInsertData() {
    unsetSessionkey('ITEMCD');
    unsetSessionkey('ITEMNAME');
    unsetSessionkey('ITEMSPEC');
    unsetSessionkey('ITEMDRAWNO');
    unsetSessionkey('ITEMUNITTYP');
    unsetSessionkey('ITEMUNITTYPSTR');
    unsetSessionkey('ITEMSERIALLFLG');
    unsetSessionkey('ALLOCQTY');
    unsetSessionkey('ALLOCSPAREQTY');
    unsetSessionkey('ALLOCORDERFLG');
    unsetSessionkey('SYSLD_BOMLOADAPP');
    unsetSessionkey('SYSEN_BOMLOADAPP');
}
?>