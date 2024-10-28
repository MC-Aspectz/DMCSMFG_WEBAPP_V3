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
$javaFunc = new SalePlan;
$systemName = strtolower($appcode);
// Table Row
$minrow = 1;
$maxrow = 42;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['STAFFCD'])) {            
        unsessionSearch(2);
        $STAFFCD = isset($_GET['STAFFCD']) ? $_GET['STAFFCD']: '';
        $query = $javaFunc->getStaff($STAFFCD);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
    } else if(!empty($_GET['ITEMCD'])) {
        unsessionSearch(1);
        $ITEMCD = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $query = $javaFunc->getItem($ITEMCD);
        if(!empty($query)) { $data = $query; }
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
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    // print_r($_POST);
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); onClear(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'search') { search(); }
        if ($_POST['action'] == 'getDetailDT') { getDetailDT(); }
        if ($_POST['action'] == 'getSearch') { getSearch(); }
        if ($_POST['action'] == 'entry') { entry(); }
        if ($_POST['action'] == 'getAmt') { getAmt(); }
        if ($_POST['action'] == 'ctrlMemoOnClick') { ctrlMemoOnClick(); }
        if ($_POST['action'] == 'commitLn') { commitLn(); }
        if ($_POST['action'] == 'onClear') { onClear(); }
        if ($_POST['action'] == 'ctrlAllOwn') { ctrlAllOwn(); }
    }
}
//--------------------------------------------------------------------------------
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
$load = $javaFunc->load();
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$UNIT = $data['DRPLANG']['UNIT'];
$YEARVALUE = $data['DRPLANG']['YEARVALUE'];
$MONTHVALUE = $data['DRPLANG']['MONTHVALUE'];
$PURCHASE_ALLOW = $data['DRPLANG']['PURCHASE_ALLOW'];
$data['CURRENCYDISP'] = isset($load['CURRENCY']) ? $load['CURRENCY']: '';
$data['SYSTIMESTAMP'] = isset($load['SYSTIMESTAMP']) ? $load['SYSTIMESTAMP']: '';
$day = array('mon' => $lang['mon'], 'tue' => $lang['tue'], 'wed' => $lang['wed'], 'thu' => $lang['thu'], 'fri' => $lang['fri'], 'sat' => $lang['sat'], 'sun' => $lang['sun']);
$days = array(); for ($i = 0; $i <= 5; $i++) { array_push($days, $day); }
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

function commitLn() {
    $javaFunc = new SalePlan; $RowParam = array();
    for ($i = 0 ; $i < count($_POST['ROWNO_I']); $i++) { 
        if($_POST['ROWNO_I'][$i] != '') {
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNO_I'][$i]) ? $_POST['ROWNO_I'][$i]: '',
                                'CUSTOMERCD' => isset($_POST['CUSTOMERCD_I'][$i]) ? $_POST['CUSTOMERCD_I'][$i]: '',
                                'CUSTOMERNAME' => isset($_POST['CUSTOMERNAME_I'][$i]) ? $_POST['CUSTOMERNAME_I'][$i]: '',
                                'ENDUSERCD' => isset($_POST['ENDUSERCD_I'][$i]) ? $_POST['ENDUSERCD_I'][$i]: '',
                                'ENDUSERNAME' => isset($_POST['ENDUSERNAME_I'][$i]) ? $_POST['ENDUSERNAME_I'][$i]: '',
                                'MARKETCD' => isset($_POST['MARKETCD_I'][$i]) ? $_POST['MARKETCD_I'][$i]: '',
                                'MARKETNAME' => isset($_POST['MARKETNAME_I'][$i]) ? $_POST['MARKETNAME_I'][$i]: '',
                                'SALEPLANPOS' => isset($_POST['SALEPLANPOS_I'][$i]) ? $_POST['SALEPLANPOS_I'][$i]: '0',
                                'SALEPLANQTY' => isset($_POST['SALEPLANQTY_I'][$i]) ? implode(explode(',', $_POST['SALEPLANQTY_I'][$i])): '0.00',
                                'SALEPLANREQTYP' => isset($_POST['SALEPLANREQTYP_I'][$i]) ? $_POST['SALEPLANREQTYP_I'][$i]: '',
                                'SALEPLANTODO1FLG' => isset($_POST['SALEPLANTODO1FLG_I'][$i]) ? $_POST['SALEPLANTODO1FLG_I'][$i]: '',
                                'SALEPLANTODO2FLG' => isset($_POST['SALEPLANTODO2FLG_I'][$i]) ? $_POST['SALEPLANTODO2FLG_I'][$i]: '',
                                'SALEPLANTODO3FLG' => isset($_POST['SALEPLANTODO3FLG_I'][$i]) ? $_POST['SALEPLANTODO3FLG_I'][$i]: '',
                                'SALEPLANTODO4FLG' => isset($_POST['SALEPLANTODO4FLG_I'][$i]) ? $_POST['SALEPLANTODO4FLG_I'][$i]: '',
                                'SALEPLANTODO5FLG' => isset($_POST['SALEPLANTODO5FLG_I'][$i]) ? $_POST['SALEPLANTODO5FLG_I'][$i]: '',
                                'SALEPLANTODO6FLG' => isset($_POST['SALEPLANTODO6FLG_I'][$i]) ? $_POST['SALEPLANTODO6FLG_I'][$i]: '',
                                'SALEPLANTODO7FLG' => isset($_POST['SALEPLANTODO7FLG_I'][$i]) ? $_POST['SALEPLANTODO7FLG_I'][$i]: '',
                                'SALEPLANTODO8FLG' => isset($_POST['SALEPLANTODO8FLG_I'][$i]) ? $_POST['SALEPLANTODO8FLG_I'][$i]: '',
                                'SALEPLANTODO9FLG' => isset($_POST['SALEPLANTODO9FLG_I'][$i]) ? $_POST['SALEPLANTODO9FLG_I'][$i]: '',
                                'SALEPLANPRC' => isset($_POST['SALEPLANPRC_I'][$i]) ? implode(explode(',', $_POST['SALEPLANPRC_I'][$i])): '0.00',
                                'SALETOTALPRC' => isset($_POST['SALETOTALPRC_I'][$i]) ? implode(explode(',', $_POST['SALETOTALPRC_I'][$i])): '0.00',
                                'MEMO' => isset($_POST['MEMO_I'][$i]) ? $_POST['MEMO_I'][$i]: '');
        }
    }

    $param = array( 'ENTRYDT' => isset($_POST['ENTRYDT']) ? str_replace('-', '', $_POST['ENTRYDT']): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'SALEPLANDTHD' => isset($_POST['SALEPLANDTHD']) ? str_replace('-', '', $_POST['SALEPLANDTHD']): '',
                    'DATA' => $RowParam);
    // print_r($param);
    $commitLn = $javaFunc->commitLn($param);
    $parameter = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                        'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                        'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                        'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                        'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                        'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                        'ALLOWN' => isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F',
                        'START1' => isset($_POST['START1']) ? $_POST['START1']: '',
                        'START2' => isset($_POST['START2']) ? $_POST['START2']: '',
                        'START3' => isset($_POST['START3']) ? $_POST['START3']: '',
                        'START4' => isset($_POST['START4']) ? $_POST['START4']: '',
                        'SALEPLANDTHD' => isset($_POST['SALEPLANDTHD']) ? str_replace('-', '', $_POST['SALEPLANDTHD']): '',
                        'DATEIDX' => isset($_POST['DATEIDX']) ? $_POST['DATEIDX']: '',
                        'COMPRICETYPE' => isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '',
                        'COMAMOUNTTYPE' => isset($_POST['COMAMOUNTTYPE']) ? $_POST['COMAMOUNTTYPE']: '');
    // print_r($parameter);
    $searchAfterCommit = $javaFunc->searchAfterCommit($parameter);
    // print_r($searchAfterCommit);
    $searchLnDetailDt = $javaFunc->searchLnDetailDt($parameter);
    // print_r($searchLnDetailDt);
    $data = array('commitLn' => $commitLn, 'searchAfterCommit' => $searchAfterCommit, 'searchLnDetailDt' => $searchLnDetailDt);
    entry();
    echo json_encode($data);
}

function search() {
    $javaFunc = new SalePlan;
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                    'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                    'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'ALLOWN' => isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F',
                    'START1' => isset($_POST['START1']) ? $_POST['START1']: '',
                    'START2' => isset($_POST['START2']) ? $_POST['START2']: '',
                    'START3' => isset($_POST['START3']) ? $_POST['START3']: '',
                    'START4' => isset($_POST['START4']) ? $_POST['START4']: '',
                    'COMPRICETYPE' => isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '',
                    'COMAMOUNTTYPE' => isset($_POST['COMAMOUNTTYPE']) ? $_POST['COMAMOUNTTYPE']: '');
    $dateSetHD = $javaFunc->DateSetHD($param);
    // print_r($dateSetHD);
    $param = array_merge($param, array('STARTDT' => $dateSetHD['STARTDT']));
    for ($i = 1; $i <= 4; $i++) {
        $param = array_merge($param, array('START'.$i => $dateSetHD['START'.$i])); 
    }
    // print_r($param);
    $search = $javaFunc->search($param);
    // print_r($search);
    $searchLnDetailDt = $javaFunc->searchLnDetailDt($param);
    // print_r($searchLnDetailDt);
    $data = array('dateSetHD' => $dateSetHD, 'search' => $search);
    entry();
    echo json_encode($data);
}

function getDetailDT() {
    $javaFunc = new SalePlan;
    $param = array( 'LBLDATECD'.$_POST['NUM'] => isset($_POST['LBLDATECD'.$_POST['NUM']]) ? $_POST['LBLDATECD'.$_POST['NUM']]: '',
                    'LBLDATEFLG'.$_POST['NUM'] => isset($_POST['LBLDATEFLG'.$_POST['NUM']]) ? $_POST['LBLDATEFLG'.$_POST['NUM']]: '');
    $parameter = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                        'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                        'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                        'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                        'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                        'ALLOWN' => isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F',
                        'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                        'START1' => isset($_POST['START1']) ? $_POST['START1']: '',
                        'START2' => isset($_POST['START2']) ? $_POST['START2']: '',
                        'START3' => isset($_POST['START3']) ? $_POST['START3']: '',
                        'START4' => isset($_POST['START4']) ? $_POST['START4']: '',
                        'COMPRICETYPE' => isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '',
                        'COMAMOUNTTYPE' => isset($_POST['COMAMOUNTTYPE']) ? $_POST['COMAMOUNTTYPE']: '');
    $getDetailDT = $javaFunc->getDetailDT($param);
    // print_r($param);
    $parameter = array_merge($parameter, $getDetailDT);
    // print_r($parameter);
    // $searchAfterCommit = $javaFunc->searchAfterCommit($parameter);
    // print_r($searchAfterCommit);
    $searchLnDetailDt = $javaFunc->searchLnDetailDt($parameter);
    // print_r($searchLnDetailDt);
    $data = array('getDetailDT' => $getDetailDT, 'searchLnDetailDt' => $searchLnDetailDt);
    echo json_encode($data);
}

function getSearch() {
    // print_r($_POST);
    $javaFunc = new SalePlan;
    if(isset($_POST['CUSTOMERCD'])) {
        $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
        $data = $javaFunc->getCustomer($CUSTOMERCD);
    } else if(isset($_POST['ENDUSERCD'])) {
        $ENDUSERCD = isset($_POST['ENDUSERCD']) ? $_POST['ENDUSERCD']: '';
        $data = $javaFunc->getEu($ENDUSERCD);
    } else if(isset($_POST['MARKETCD'])) {
        $MARKETCD = isset($_POST['MARKETCD']) ? $_POST['MARKETCD']: '';
        $data = $javaFunc->getMarket($MARKETCD);
    }
    // print_r($data);
    echo json_encode($data);
}

function ctrlAllOwn() {
    $javaFunc = new SalePlan;
    $ALLOWN = isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F';
    $data = $javaFunc->ctrlAllOwn($ALLOWN);
    setSessionData('ALLOWN', $ALLOWN);
    echo json_encode($data);
}

function getAmt() {
    $javaFunc = new SalePlan;
    $param = array( 'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'SALEPLANDTHD' => isset($_POST['SALEPLANDTHD']) ? str_replace('-', '', $_POST['SALEPLANDTHD']): '',
                    'SALEPLANQTY' => isset($_POST['SALEPLANQTY']) ? str_replace(',', '', $_POST['SALEPLANQTY']): '0.00');
    $data = $javaFunc->getAmt($param);
    echo json_encode($data);
}

function onClear() {
    $javaFunc = new SalePlan;
    $SYSTIMESTAMP = isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '';
    $data = $javaFunc->onClear($SYSTIMESTAMP);
    echo json_encode($data);
}

function ctrlMemoOnClick() {
    $javaFunc = new SalePlan;
    $MEMO = isset($_POST['MEMO']) ? $_POST['MEMO']: '';
    $SALEPLANTODO4FLG = isset($_POST['SALEPLANTODO4FLG']) ? $_POST['SALEPLANTODO4FLG']: 'F';
    $data = $javaFunc->ctrlMemoOnClick($SALEPLANTODO4FLG, $MEMO);
    echo json_encode($data);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEMCD', 'ITEMNAME', 'ITEMLEADTIME', 'ENTRYDT', 'YEARVALUE', 'MONTHVALUE', 'ALLOWN', 'ITEMTYP', 'ITEMSTDSALEPRICE', 'CATALOGCD', 'CATALOGNAME', 'STAFFCD', 'STAFFNAME', 'DIVISIONCD', 'DIVISIONNAME', 'SALEDIVCD', 'SALEDIVNAME', 'ITEMUNITTYP','CUSTOMERCD', 'CUSTOMERNAME', 'ENDUSERCD', 'ENDUSERNAME', 'MARKETNAME', 'SALEPLANPOS', 'SALEPLANREQTYP', 'SALEPLANQTY', 'SALEPLANPRC', 'CURRENCYDISP', 'COMPRICETYPE', 'COMAMOUNTTYPE', 'SALEPLANTODO1FLG', 'SALEPLANTODO2FLG', 'SALEPLANTODO3FLG', 'SALEPLANTODO4FLG', 'SALEPLANTODO5FLG', 'MEMO', 'SALEPLANDTHD', 'SYSMSG', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

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
    return unset_sys_key($systemName, $key);
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

function entry() {

    unsetSessionkey('ROWNO');
    unsetSessionkey('CUSTOMERCD');
    unsetSessionkey('CUSTOMERNAME');
    unsetSessionkey('ENDUSERCD');
    unsetSessionkey('ENDUSERNAME');
    unsetSessionkey('MARKETCD');
    unsetSessionkey('MARKETNAME');
    unsetSessionkey('SALEPLANPOS');
    unsetSessionkey('SALEPLANREQTYP');
    unsetSessionkey('SALEPLANPRC');
    unsetSessionkey('SALEPLANQTY');
    unsetSessionkey('COMPRICETYPE');
    unsetSessionkey('COMAMOUNTTYPE');
    unsetSessionkey('SALETOTALPRC');
    unsetSessionkey('SALEPLANTODO1FLG');
    unsetSessionkey('SALEPLANTODO2FLG');
    unsetSessionkey('SALEPLANTODO3FLG');
    unsetSessionkey('SALEPLANTODO4FLG');
    unsetSessionkey('SALEPLANTODO5FLG');

    $javaFunc = new SalePlan;
    $ctrlMemoOnEntry = $javaFunc->ctrlMemoOnEntry();

}

function unsessionSearch($type) {

    if($type == 1) {
 
        unsetSessionkey('ITEMCD');
        unsetSessionkey('ITEMNAME');
        unsetSessionkey('ITEMUNITTYP');
        unsetSessionkey('ITEMTYP');
        unsetSessionkey('ITEMLEADTIME');
        unsetSessionkey('ITEMSTDSALEPRICE');
        unsetSessionkey('CATALOGCD');
        unsetSessionkey('CATALOGNAME');
        unsetSessionkey('SYSMSG');

    } else if($type == 2) {

        unsetSessionkey('STAFFCD');
        unsetSessionkey('STAFFNAME');
        unsetSessionkey('SALEDIVCD');
        unsetSessionkey('SALEDIVNAME');
        unsetSessionkey('DIVISIONCD');
        unsetSessionkey('DIVISIONNAME');
    }
}
?>