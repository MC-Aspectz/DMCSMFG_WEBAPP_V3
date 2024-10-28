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
$javaFunc = new ClearanceMonthEntry;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'SEARCH') { searchs(); }
        if ($_POST['action'] == 'checkDate') { chkDate(); }
        if ($_POST['action'] == 'ITEMCODE') { getItem(); }
        if ($_POST['action'] == 'LOCCD') { getLoc(); } 
        if ($_POST['action'] == 'LOCTYP') { getLocSysLogic(); } 
        if ($_POST['action'] == 'commit') { commitAll(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
    }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'_LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'_LOAD', $load);
}
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
$YEAR = $data['DRPLANG']['YEARVALUE'];
$MONTH = $data['DRPLANG']['MONTHVALUE'];
$CLEARANCE = $data['DRPLANG']['CLEARANCE'];
$STORAGETYPE = $data['DRPLANG']['STORAGETYPE'];
if(empty($data['YEARVALUE'])) { $data['YEARVALUE'] = $load['YEAR']; }
if(empty($data['MONTHVALUE'])) { $data['MONTHVALUE'] = $load['MONTH']; }
if(empty($data['LOCTYP'])) { $data['LOCTYP'] = 0; }
if(empty($data['CLEARANCE'])) { $data['CLEARANCE'] = 0; }
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($load);
// echo '</pre>';
// --------------------------------------------------------------------------//
function searchs() {
    global $data; unsetSessionkey('ITEM');
    $searchfunc = new ClearanceMonthEntry;
    $data['YEARVALUE'] = isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '';
    $data['MONTHVALUE'] = isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '';
    $data['CLEARANCE'] = isset($_POST['CLEARANCE']) ? $_POST['CLEARANCE']: '';
    $search = $searchfunc->search($data['YEARVALUE'], $data['MONTHVALUE'], $data['CLEARANCE']);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
    }

    setSessionArray($data);

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function chkDate() {
    $javafunc = new ClearanceMonthEntry;
    $YEARVALUE = isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '';
    $MONTHVALUE = isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '';
    $CLEARANCEDATE = isset($_POST['CLEARANCEDATE']) ? str_replace('-', '',$_POST['CLEARANCEDATE']): '';
    $checkDate = $javafunc->checkDate($YEARVALUE, $MONTHVALUE, $CLEARANCEDATE);
    echo json_encode($checkDate);
}

function getItem() {
    $javafunc = new ClearanceMonthEntry;
    $ITEMCODE = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
    $CLEARANCE = isset($_POST['CLEARANCE']) ? $_POST['CLEARANCE']: '';
    $getItem = $javafunc->getItem($ITEMCODE, $CLEARANCE);
    echo json_encode($getItem);
}

function getLoc() {
    $javafunc = new ClearanceMonthEntry;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $getLoc = $javafunc->getLoc($LOCTYP, $LOCCD);
    echo json_encode($getLoc);
}

function getLocSysLogic() {
    $javafunc = new ClearanceMonthEntry;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $getLoc = $javafunc->getLocSysLogic($LOCTYP, $LOCCD);
    echo json_encode($getLoc);
}

function commitAll() {
    $javafunc = new ClearanceMonthEntry;
    $RowParam = [];
    if(isset($_POST['ROWNOZ'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOZ']); $i++) { 
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNOZ'][$i]) ? $_POST['ROWNOZ'][$i]: '',
                                'ITEMCODE' => isset($_POST['ITEMCODEZ'][$i]) ? $_POST['ITEMCODEZ'][$i]: '',
                                'LOCTYP' => isset($_POST['LOCTYPZ'][$i]) ? $_POST['LOCTYPZ'][$i]: '',
                                'LOCCD' => isset($_POST['LOCCDZ'][$i]) ? $_POST['LOCCDZ'][$i]: '',
                                'CLEARANCEQUANTITY' => isset($_POST['CLEARANCEQUANTITYZ'][$i]) ? str_replace(',', '', $_POST['CLEARANCEQUANTITYZ'][$i]): '',
                                'CLEARANCEDATE' => isset($_POST['CLEARANCEDATEZ'][$i]) ? str_replace('-', '', $_POST['CLEARANCEDATEZ'][$i]): '');
        }

        $param = array( 'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                        'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                        'CLEARANCE' => isset($_POST['CLEARANCE']) ? $_POST['CLEARANCE']: '',
                        'DATA' => $RowParam);
        // print_r($param);
        $commit = $javafunc->commit($param);
        unsetSessionData();
        echo json_encode($commit);
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOZ']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOZ'][$i],
                                    'ITEMCD' => $_POST['ITEMCDZ'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAMEZ'][$i],
                                    'LOCTYP' => $_POST['LOCTYPZ'][$i],
                                    'LOCCD' => $_POST['LOCCDZ'][$i],
                                    'LOCNAME' => $_POST['LOCNAMEZ'][$i],
                                    'CLEARANCEDATE' => $_POST['CLEARANCEDATEZ'][$i],
                                    'CLEARANCEQUANTITY' => $_POST['CLEARANCEQUANTITYZ'][$i],
                                    'ITEMUNIT' => $_POST['ITEMUNITZ'][$i],    
                                    'ITEMUNITSTR' => $_POST['ITEMUNITSTRZ'][$i],
                                    'ITEMSPEC' => $_POST['ITEMSPECZ'][$i],
                                    'ITEMDRAWNUMBER' => $_POST['ITEMDRAWNUMBERZ'][$i]);
    }
    // print_r($data['ITEM']);
    setSessionArray($data);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'YEARVALUE', 'MONTHVALUE', 'CLEARANCE');
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