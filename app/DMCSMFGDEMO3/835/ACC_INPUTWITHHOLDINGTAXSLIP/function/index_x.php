<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode('\\', dirname(__FILE__));  // for localhost
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
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
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
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$javaFunc = new AccWithholdingTaxSlip;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 12;
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
        if ($_POST['action'] == 'update') { update(); }
        if ($_POST['action'] == 'export') { export(); }
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
$data['SYSVIS_UPD'] = isset($load['SYSVIS_UPD']) ? $load['SYSVIS_UPD']: '';
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$taxtype = $data['DRPLANG']['TAXTYPE'];
$tax_type = $data['DRPLANG']['TAX_TYPE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
$taxcondition = $data['DRPLANG']['TAXCONDITION'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function search() {
    global $data; 
    $data['ITEM'] = array();
    $searchfunc = new AccWithholdingTaxSlip;
    $data['D1'] = isset($_POST['D1']) ? $_POST['D1']: '';
    $data['D2'] = isset($_POST['D2']) ? $_POST['D2']: '';
    $D1 = isset($_POST['D1']) ? str_replace('-', '', $_POST['D1']): '';
    $D2 = isset($_POST['D2']) ? str_replace('-', '', $_POST['D2']): '';
    $search = $searchfunc->search($D1, $D2);
    if(!empty($search)) {
        $data['ITEM'] = $search;
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function update() {
    $updfunc = new AccWithholdingTaxSlip;
    $param = array( 'PAYMENTNO' => isset($_POST['PAYMENTNO']) ? $_POST['PAYMENTNO']: '',
                    'PAYMENTNOLN' => isset($_POST['PAYMENTNOLN']) ? $_POST['PAYMENTNOLN']: '',
                    'PAYMENTADD07' => isset($_POST['PAYMENTADD07']) ? $_POST['PAYMENTADD07']: '',
                    'PAYMENTADD08' => isset($_POST['PAYMENTADD08']) ? str_replace("-", "", $_POST['PAYMENTADD08']): '',
                    'PAYMENTADD09' => isset($_POST['PAYMENTADD09']) ? $_POST['PAYMENTADD09']: '',
                    'PAYMENTADD10' => isset($_POST['PAYMENTADD10']) ? $_POST['PAYMENTADD10']: '',
                    'PAYMENTADD11' => isset($_POST['PAYMENTADD11']) ? $_POST['PAYMENTADD11']: '',
    );
    // print_r($param);
    $update2 = $updfunc->update($param);

    echo json_encode($update2);
}

function export() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccWithholdingTaxSlip;
    $RowParam = array();
    $D5 = isset($_POST['D5']) ? $_POST['D5']: '';
    if(isset($data['CHKROW'])) {
        foreach ($data['CHKROW'] as $key => $val) {
            $RowParam[] = array(    'DATA' => $key+1,
                                    'CHKROW' => $data['CHKROW'][$key],
                                    'TRANYEAR' => $data['ITEM'][$key+1]['TRANYEAR'],
                                    'PURRECPAYORDERNO' => $data['ITEM'][$key+1]['PURRECPAYORDERNO'],
                                    'PURRECPAYORDERLN' => $data['ITEM'][$key+1]['PURRECPAYORDERLN']);
        }   
    }
    // print_r($RowParam);
    $searchExpPND = $printfunc->searchExpPND($D5, $RowParam);
    echo json_encode($searchExpPND);
    // echo "<pre>";
    // print_r($searchExpPND);
    // echo "</pre>";
}

function printWHT() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccWithholdingTaxSlip;
    $RowParam = array();
    if(isset($data['CHKROW'])) {
        foreach ($data['CHKROW'] as $key => $val) {
            $RowParam[] = array(    'DATA' => $key+1,
                                    'CHKROW' => $data['CHKROW'][$key],
                                    'TRANYEAR' => $data['ITEM'][$key+1]['TRANYEAR'],
                                    'PURRECPAYORDERNO' => $data['ITEM'][$key+1]['PURRECPAYORDERNO'],
                                    'PURRECPAYORDERLN' => $data['ITEM'][$key+1]['PURRECPAYORDERLN']);
        }   
    }
    // print_r($RowParam);
    $printStaticWHT = $printfunc->printStaticWHT($RowParam);
    // print_r($printStaticWHT);
    $printDynamicWHT = $printfunc->printDynamicWHT($RowParam);
    // print_r($printDynamicWHT);
    if(!empty($printStaticWHT)) {
        $data['PRINTSTATIC'] = $printStaticWHT;
    }
    if(!empty($printDynamicWHT)) {
        $data['PRINTDYNAMIC'] = $printDynamicWHT;
    }
    // echo "<pre>";
    // print_r($data['PRINTSTATIC']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['PRINTDYNAMIC']);
    // echo "</pre>";
}

function printPND53() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccWithholdingTaxSlip;
    $RowParam = array();
    $D3 = isset($data['D3']) ? $data['D3']: '';
    $D4 = isset($data['D4']) ? $data['D4']: '';
    if(isset($data['CHKROW'])) {
        foreach ($data['CHKROW'] as $key => $val) {
            $RowParam[] = array(    'DATA' => $key+1,
                                    'CHKROW' => $data['CHKROW'][$key],
                                    'TRANYEAR' => $data['ITEM'][$key+1]['TRANYEAR'],
                                    'PURRECPAYORDERNO' => $data['ITEM'][$key+1]['PURRECPAYORDERNO'],
                                    'PURRECPAYORDERLN' => $data['ITEM'][$key+1]['PURRECPAYORDERLN']);
        }   
    }
    // print_r($RowParam);
    $printStaticPND53 = $printfunc->printStaticPND53($D3, $D4, $RowParam);
    // print_r($printStaticPND53);
    $printDynamicPND53 = $printfunc->printDynamicPND53($D3, $D4, $RowParam);
    // print_r($printDynamicPND53);
    if(!empty($printStaticPND53)) {
        $index = !empty($printStaticPND53) ? array_key_first($printStaticPND53) : 1;
        $data['PRINTSTATIC'] = $printStaticPND53[$index];
    }
    if(!empty($printDynamicPND53)) {
        $data['PRINTDYNAMIC'] = $printDynamicPND53;
    }
    // echo "<pre>";
    // print_r($data['PRINTSTATIC']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['PRINTDYNAMIC']);
    // echo "</pre>";
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'D1', 'D2', 'TPAY', 'TTAXM', 'CHKROW', 'SYSVIS_UPD', 
        // 'PAYMENTSUPCD', 'PAYMENTSUPNAME', 'SUPTAXID', 'PAYMENTDIVCD', 'PAYMENTDIVNAME', 'PAYMENTADD07', 'PAYMENTADD08', 'PAYMENTADD15', 'PAYMENTNO', 'PAYMENTDT', 'PAYMENTTYP2', 'PAYMENTADD12', 'PAYMENTADD13', 'PAYMENTADD14', 'PAYMENTADD03', 'PMNOTE05', 'PAYMENTAMT', 'PAYMENTADD09', 'PAYMENTADD10', 'PAYMENTADD16', 'PAYMENTADD11', 'TRANYEAR'
    );

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
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

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>