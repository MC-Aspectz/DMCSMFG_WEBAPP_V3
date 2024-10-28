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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = '';
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
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
$javaFunc = new AccRecurSetup;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 5;
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
// $data = $load;
$data['INP_STFCD'] = $load['INP_STFCD'];
$data['INP_STFNM'] = $load['INP_STFNM'];
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['RECURCD'])) {
        unsetSessionkey('ITEM');
        $data['RECURCD'] = isset($_GET['RECURCD']) ? $_GET['RECURCD']: '';
        $chk_voucher = $javaFunc->chk_voucher($_GET['RECURCD']);
        $query = $javaFunc->getRecur($_GET['RECURCD']);
        $getRecur2 = $javaFunc->getRecur2($_GET['RECURCD']);
        if(!empty($chk_voucher)) {
            $data['SYSEN_SAVEREC'] = $chk_voucher['SYSEN_SAVEREC'];
        }
        if(!empty($query)) {
            $data['ITEM'] = $query;
        }
        if(!empty($getRecur2)) {
            $data['SYSEN_SAVEREC'] = $getRecur2['SYSEN_SAVEREC'];
        }
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
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
$data['CURRENCY1'] = $load['CURRENCY1'];
$data['I_CURRENCY'] = $load['I_CURRENCY'];
$data['PREFIXJV'] = $load['PREFIXJV'];
$data['DC_TYP'] = isset($data['DC_TYP']) ? $data['DC_TYP']: 0;
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: date('Y');
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$dctyp = $data['DRPLANG']['DC_TYP'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$currencytyp = $data['DRPLANG']['CURRENCYTYP'];
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
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'entryUnset') { entryUnset(); }
        if ($_POST['action'] == 'dc_type') { dc_type(); }
        if ($_POST['action'] == 'dc_type1') { dc_type1(); }
        if ($_POST['action'] == 'ACC_CD') { get_acc(); }
        if ($_POST['action'] == 'get_exrate') { get_exrate(); }
        if ($_POST['action'] == 'commit') { commit(); }
    }
    if (isset($_POST['SEARCH'])) { getRecur(); }
}
//--------------------------------------------------------------------------------
function getRecur() {
    global $data; 
    $data['ITEM'] = array();
    $searchfunc = new AccRecurSetup;
    $data['RECURCD'] = isset($_POST['RECURCD']) ? $_POST['RECURCD']: '';
    $chk_voucher = $searchfunc->chk_voucher($_POST['RECURCD']);
    $query = $searchfunc->getRecur($_POST['RECURCD']);
    $getRecur2 = $searchfunc->getRecur2($_POST['RECURCD']);
    if(!empty($chk_voucher)) {
        $data['SYSEN_SAVEREC'] = $chk_voucher['SYSEN_SAVEREC'];
    }
    if(!empty($query)) {
        $data['ITEM'] = $query;
    }
    if(!empty($getRecur2)) {
        $data['SYSEN_SAVEREC'] = $getRecur2['SYSEN_SAVEREC'];
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}

function commit() {
    global $data;
    if(!empty($_POST['ROWNOA'])) { $data = getSessionData(); }
    $cmtfunc = new AccRecurSetup;
    // print_r($data['ITEM']);
    $RECURCD = isset($_POST['RECURCD']) ? $_POST['RECURCD']: '';
    $commitRecurring = $cmtfunc->commitRecurring($data['ITEM']);
    if(!empty($commitRecurring)) {
        $getRecurNo = $cmtfunc->getRecurNo($RECURCD);
        echo json_encode($getRecurNo);
    }
}

function get_acc() {
    global $data;
    $accfunc = new AccRecurSetup;
    $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';   
    $DC_TYPE = isset($_POST['DC_TYPE']) ? $_POST['DC_TYPE']: '';
    $query = $accfunc->get_acc($ACC_CD, $DC_TYPE);
    if(!empty($query) && is_array($query)) {
        $data = $query;
        setSessionArray($data); 
    }

    echo json_encode($query);
}

function dc_type() {
    $dcfunc = new AccRecurSetup;
    $acccd = isset($_POST['ACC_CD']) ? implode(explode(',', $_POST['ACC_CD'])): '';
    $dctyp = isset($_POST['DC_TYP']) ? implode(explode(',', $_POST['DC_TYP'])): '';
    $dc_type = $dcfunc->dc_type($dctyp, $acccd);
    // print_r($dc_type);
    echo json_encode($dc_type);
}

function dc_type1() {
    $amtfunc = new AccRecurSetup;
    $amt = isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00';
    $dctyp = isset($_POST['DC_TYP']) ? implode(explode(',', $_POST['DC_TYP'])): '';
    $exrate = isset($_POST['EXRATE']) ? implode(explode(',', $_POST['EXRATE'])): '1.000000';
    $dc_type1 = $amtfunc->dc_type1($amt, $dctyp, $exrate);
    // print_r($dc_type1);
    echo json_encode($dc_type1);
}

function get_exrate() {
    $exratefunc = new AccRecurSetup;
    $currency = isset($_POST['I_CURRENCY']) ? implode(explode(',', $_POST['I_CURRENCY'])): 'THB'; 
    $currency1 = isset($_POST['CURRENCY1']) ? implode(explode(',', $_POST['CURRENCY1'])): 'THB'; 
    $dctyp = isset($_POST['DC_TYP']) ? implode(explode(',', $_POST['DC_TYP'])): '';
    $exrate = isset($_POST['EXRATE']) ? implode(explode(',', $_POST['EXRATE'])): '1.000000';
    $get_exrate = $exratefunc->get_exrate($currency, $currency1, $dctyp, $exrate);
    // print_r($get_exrate);
    echo json_encode($get_exrate);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'ACC_CD' => $_POST['ACC_CDA'][$i],
                                    'ACC_NM' => $_POST['ACC_NMA'][$i],
                                    'ACCTRANREMARK' => $_POST['ACCTRANREMARKA'][$i],
                                    'ACCAMT1' => $_POST['ACCAMT1A'][$i],
                                    'ACCAMT2' => $_POST['ACCAMT2A'][$i],
                                    'SECTION1' => $_POST['SECTION1A'][$i],
                                    'PROJECTNO' => $_POST['PROJECTNOA'][$i],
                                    'DC_TYPE' => $_POST['DC_TYPEA'][$i],
                                    'CURRENCY1' => $_POST['CURRENCY1A'][$i],
                                    'I_CURRENCY' => $_POST['I_CURRENCYA'][$i],
                                    'EXRATE' => $_POST['EXRATEA'][$i],
                                    'AMT' => $_POST['AMTA'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function entryUnset() {
    unsetSessionkey('ACC_CD');
    unsetSessionkey('ACC_NM');
    unsetSessionkey('ACCTRANREMARK');
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'RECURCD', 'PREFIXJV', 'COMCURRENCY', 'INPDATE', 'ISSUEDATE', 'ACCY', 'TTL_AMT1', 'TTL_AMT2', 'DC_TYP', 'ROWNO', 'ACC_CD', 'ACC_NM', 'ITEM', 'ACCAMT1', 'ACCAMT2', 'CURRENCY1', 'AMT', 'I_CURRENCY', 'EXRATE', 'PROJECTNO', 'SECTION1', 'ACCTRANREMARK', 'SYSEN_SAVEREC');

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

function unsetItemData($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>