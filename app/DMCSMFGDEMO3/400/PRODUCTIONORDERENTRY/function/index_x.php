<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
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
$javaFunc = new ProductionOrderEntry;
$systemName = strtolower($appcode);
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    if(!empty($_GET['PROORDERNO'])) {
        $PROORDERNO = isset($_GET['PROORDERNO']) ? $_GET['PROORDERNO']: '';
        $query = $javaFunc->getProduct($PROORDERNO);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(empty($query)) { unsetSessionData(); echo '<script language="javascript"> alert("' . lang('warning1') . '"); window.location.href = "index.php";</script>'; }
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
        if ($_POST['action'] == 'LOCCD') { getLoc(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'WCCD') { getWc(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'SALEORDERNOLN') { getSaleOrderNoLn(); }
        if ($_POST['action'] == 'PROPLANENDDT') { getPlanDate(); }
        if ($_POST['action'] == 'insert') { insert(); }
        if ($_POST['action'] == 'update') { update(); }
        if ($_POST['action'] == 'delete') { delete(); }
        if ($_POST['action'] == 'insertBak') { insertBak(); }
    }
    if(isset($_POST['ALLOCORDERFLG']) == '1') { setOrderBOMEntry(); }
}
// 
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
$data['BMVERSION'] = 0;
$bmversion = $data['DRPLANG']['BMVERSION'];
$branchtype = $data['DRPLANG']['BRANCH_TYPE'];
$inspection = $data['DRPLANG']['INSPECTION'];
$statusorder = $data['DRPLANG']['STATUS_ORDER'];
$storagetype = $data['DRPLANG']['STORAGETYPE'];
$unit = $data['DRPLANG']['UNIT'];
$clear = $data['DRPLANG']['CLEAR'];
$factory = $data['DRPLANG']['FACTORY'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function insert() {
    $insfunc = new ProductionOrderEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $BMVERSION = !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROISSUEDT' => isset($_POST['PROISSUEDT']) ? str_replace('-', '', $_POST['PROISSUEDT']): '',
                    'PROQTY' => isset($_POST['PROQTY']) ? implode(explode(',', $_POST['PROQTY'])): '0.00',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROINSPTYP' => $_POST['PROINSPTYP'],
                    'PROREM' => $_POST['PROREM'],
                    'PROSAMPLEINSP' => isset($_POST['PROSAMPLEINSP']) ? $_POST['PROSAMPLEINSP']: '',
                    'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN']) ? $_POST['SALEORDERNOLN']: '',
                    'ITEMCD' => $_POST['ITEMCD'],
                    'ITEMNAME' => $_POST['ITEMNAME'],
                    'ITEMSPEC' => $_POST['ITEMSPEC'],
                    'ITEMDRAWNO' => $_POST['ITEMDRAWNO'],
                    'MATERIALCD' => $_POST['MATERIALCD'],
                    'ITEMTAXTYP' => $_POST['ITEMTAXTYP'],
                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'],
                    'LOCTYP' => $_POST['LOCTYP'],
                    'LOCCD' => $_POST['LOCCD'],
                    'PROFACTYP' => $_POST['PROFACTYP'],
                    'WCCD' => $_POST['WCCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'PROSTATUS' => $_POST['PROSTATUS'],
                    'BMVERSION' => !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '',
                    'ITEMPROPTNCD' => !empty($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '',
                );
    // print_r($param);
    $checkBmVersion = $insfunc->checkBmVersion($PROORDERNO, $ITEMCD, $BMVERSION);
    // echo json_encode($checkBmVersion);
    if(!empty($checkBmVersion['SYSMSG']) && $checkBmVersion['SYSMSG'] == 'WARN_BOM_COUNT_ZERO') {
        echo json_encode($checkBmVersion);
        return exit();
    }
    $insert = $insfunc->insert($param);
    echo json_encode($insert);
    unsetSessionData();
}

function update() {
    $updfunc = new ProductionOrderEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $BMVERSION = !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROISSUEDT' => isset($_POST['PROISSUEDT']) ? str_replace('-', '', $_POST['PROISSUEDT']): '',
                    'PROQTY' => isset($_POST['PROQTY']) ? implode(explode(',', $_POST['PROQTY'])): '0.00',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROINSPTYP' => $_POST['PROINSPTYP'],
                    'PROREM' => $_POST['PROREM'],
                    'PROSAMPLEINSP' => isset($_POST['PROSAMPLEINSP']) ? $_POST['PROSAMPLEINSP']: '',
                    'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN']) ? $_POST['SALEORDERNOLN']: '',
                    'ITEMCD' => $_POST['ITEMCD'],
                    'ITEMNAME' => $_POST['ITEMNAME'],
                    'ITEMSPEC' => $_POST['ITEMSPEC'],
                    'ITEMDRAWNO' => $_POST['ITEMDRAWNO'],
                    'MATERIALCD' => $_POST['MATERIALCD'],
                    'ITEMTAXTYP' => $_POST['ITEMTAXTYP'],
                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'],
                    'LOCTYP' => $_POST['LOCTYP'],
                    'LOCCD' => $_POST['LOCCD'],
                    'PROFACTYP' => $_POST['PROFACTYP'],
                    'WCCD' => $_POST['WCCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'PROSTATUS' => $_POST['PROSTATUS'],
                    'BMVERSION' => !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '',
                    'ITEMPROPTNCD' => !empty($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '',
                );
    $checkBmVersion = $insfunc->checkBmVersion($PROORDERNO, $ITEMCD, $BMVERSION);
    // echo json_encode($checkBmVersion);
    if(!empty($checkBmVersion['SYSMSG']) && $checkBmVersion['SYSMSG'] == 'WARN_BOM_COUNT_ZERO') {
        echo json_encode($checkBmVersion);
        return exit();
    }
    $update = $updfunc->update($param);
    echo json_encode($update);
    unsetSessionData();
}

function delete() {
    $delfunc = new ProductionOrderEntry;
    $checkStatus = $delfunc->checkStatus($_POST['PROSTATUS']);
    // echo json_encode($checkStatus);
    if(!empty($checkStatus)) {
        $delete = $delfunc->delete($_POST['ACTION'], $_POST['PROORDERNO']);
        echo json_encode($delete);
        unsetSessionData();
    }
}

function insertBak() {
    $insfunc = new ProductionOrderEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $BMVERSION = !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROISSUEDT' => isset($_POST['PROISSUEDT']) ? str_replace('-', '', $_POST['PROISSUEDT']): '',
                    'PROQTY' => isset($_POST['PROQTY']) ? implode(explode(',', $_POST['PROQTY'])): '0.00',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROINSPTYP' => $_POST['PROINSPTYP'],
                    'PROREM' => $_POST['PROREM'],
                    'PROSAMPLEINSP' => isset($_POST['PROSAMPLEINSP']) ? $_POST['PROSAMPLEINSP']: '',
                    'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN']) ? $_POST['SALEORDERNOLN']: '',
                    'ITEMCD' => $_POST['ITEMCD'],
                    'ITEMNAME' => $_POST['ITEMNAME'],
                    'ITEMSPEC' => $_POST['ITEMSPEC'],
                    'MATERIALCD' => $_POST['MATERIALCD'],
                    'ITEMTAXTYP' => $_POST['ITEMTAXTYP'],
                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'],
                    'LOCTYP' => $_POST['LOCTYP'],
                    'LOCCD' => $_POST['LOCCD'],
                    'PROFACTYP' => $_POST['PROFACTYP'],
                    'WCCD' => $_POST['WCCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'PROSTATUS' => $_POST['PROSTATUS'],
                    'BMVERSION' => !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '',
                    'ITEMPROPTNCD' => !empty($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '',
                );
    // print_r($param);
    $insert = $insfunc->insert($param);
    echo json_encode($insert);
    unsetSessionData();
}

function setOrderBOMEntry() {
    $javafunc = new ProductionOrderEntry;
    // print_r($_POST);
    $param = array( 'PFAPPCD' => 'ORDERBMENTRY',
                    'ALLOCORDERFLG' => isset($_POST['ALLOCORDERFLG']) ? $_POST['ALLOCORDERFLG']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ODRQTY' => isset($_POST['ODRQTY']) ? $_POST['ODRQTY']: '',
                    'ALLOCQTY' => isset($_POST['ALLOCQTY']) ? $_POST['ALLOCQTY']: '',
                    'ALLOCPURORDERNOLN' => isset($_POST['ALLOCPURORDERNOLN']) ? $_POST['ALLOCPURORDERNOLN']: '',
                    'ALLOCORDERTYP' => !empty($_POST['ALLOCORDERTYP']) ? $_POST['ALLOCORDERTYP']: '',
                    'ALLOCORDERNO' => !empty($_POST['ALLOCORDERNO']) ? $_POST['ALLOCORDERNO']: '');
    $query = $javafunc->loadForm($param);
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';
    if(!empty($query)) {
        $data = $query;
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}

function getItem() {
    $javafunc = new ProductionOrderEntry;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $query = $javafunc->getItem($ITEMCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}        

function getLoc() {
    $javafunc = new ProductionOrderEntry;
    $LOCCD = isset($_POST['LOCCD']) ? $_POST['LOCCD']: '';
    $LOCTYP = isset($_POST['LOCTYP']) ? $_POST['LOCTYP']: '';
    $query = $javafunc->getLoc($LOCTYP, $LOCCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getWc() {
    $javafunc = new ProductionOrderEntry;
    $WCCD = isset($_POST['WCCD']) ? $_POST['WCCD']: '';
    $query = $javafunc->getWc($WCCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getStaff() {
    $javafunc = new ProductionOrderEntry;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getSaleOrderNoLn() {
    unsetSessionkey('SALEORDERNOLN'); unsetSessionkey('SALELNITEMNAME');
    $javafunc = new ProductionOrderEntry;
    $SALEORDERNOLN = isset($_POST['SALEORDERNOLN']) ? $_POST['SALEORDERNOLN']: '';
    $query = $javafunc->getSaleOrderNoLn($SALEORDERNOLN);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getPlanDate() {
    $javafunc = new ProductionOrderEntry;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROFACTYP' => isset($_POST['PROFACTYP']) ? $_POST['PROFACTYP']: '');
    // print_r($param);
    $query = $javafunc->getPlanDate($param);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getProPtn() {
    $javafunc = new ProductionOrderEntry;
    $ITEMPROPTNCD = isset($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '';
    $query = $javafunc->getProPtn($ITEMPROPTNCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function setOldValue() {
    // print_r($_POST);
    setSessionArray($_POST); 
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'PROORDERNO', 'AUTOMANUAL', 'PROISSUEDT', 'PROFACTYP', 'ITEMCD', 'ITEMNAME', 'PROORDERNOID', 'ITEMTAXTYP', 'OLDITEMCD', 'ITEMSPEC', 'ITEMDRAWNO', 'MATERIALCD', 'MATERIALNAME', 'LOCTYP', 'LOCCD', 'LOCNAME', 'WCCD', 'WCNAME', 'STAFFCD', 'STAFFNAME', 'PROQTY', 'ITEMUNITTYP', 'PROPLANENDDT', 'PROPLANSTARTDT', 'PROINSPTYP', 'PROSAMPLEINSP', 'SALEORDERNOLN', 'SALELNITEMNAME', 'PROREM', 'PROSTATUS', 'BMVERSION', 'ITEMPROPTNCD', 'PROPTNNAME', 'ONHAND', 'AWAIT_TEST', 'INV_OF_ORDER', 'BACKLOG', 'ALLOCATE', 'ACTION', 'ITEM', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CLEAR', 'SYSVIS_END', 'SYSVIS_BACK', 'SYSVIS_CANCEL', 'SYSVIS_HIDENINS', 'SYSEN_PROORDERNO', 'SYSMSG', 'ALLOCORDERFLG');

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

function alertMsg($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>