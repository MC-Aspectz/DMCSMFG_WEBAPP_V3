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
}
 // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}  // if ($appname == '') {
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
// if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2).'/lang/en.php');
}
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$javaFunc = new PartnerUnitMaster;
$systemName = strtolower($_SESSION['APPCODE']);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 9;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    // 
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
        if ($_POST['action'] == 'SEARCH') { searchPUP(); }
        if ($_POST['action'] == 'PARTNERTYP') { getPartner(); }
        if ($_POST['action'] == 'PARTNERCD') { getPartner(); }
        if ($_POST['action'] == 'ITEMCD') { getIM(); }
        if ($_POST['action'] == 'PARTNERPRICEDT') { getDT(); }
        if ($_POST['action'] == 'currenttQty') { currenttQty(); }       
        if ($_POST['action'] == 'preDate') { preDate(); }
        if ($_POST['action'] == 'nextDate') { nextDate(); }
        if ($_POST['action'] == 'entry') { entry(); }
        if ($_POST['action'] == 'INSERT') { insert(); }
        if ($_POST['action'] == 'UPDATE') { update(); }
        if ($_POST['action'] == 'DELETE') { delete(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); }
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
$CURRENCY = $data['DRPLANG']['CURRENCY'];
$PARTNERTYP = $data['DRPLANG']['PARTNER_TYPE'];
if(empty($data['PARTNERTYP'])) { $data['PARTNERTYP'] = 0;}
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function searchPUP() {
    global $data;
    $data['ITEM'] = array();
    $javafunc = new PartnerUnitMaster;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'NEXTQTY' => isset($_POST['NEXTQTY']) ? $_POST['NEXTQTY']: '',
                    'PARTNERCD' => isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '',
                    'PARTNERTYP' => isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '',
                    'PARTNERPRICEDT' => isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '',
                    'P2' => isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '',
                    'P3' => isset($_POST['P3']) ? str_replace('-', '', $_POST['P3']): '',
                    'P4' => isset($_POST['P4']) ? str_replace('-', '', $_POST['P4']): '',
                    'P5' => isset($_POST['P5']) ? str_replace('-', '', $_POST['P5']): '');
    // print_r($param);
    $searchPUP = $javafunc->searchPUP($param);
    $nextQty = $javafunc->nextQty($param);
    // echo '<pre>';
    // print_r($searchPUP);
    // echo '</pre>';
    // print_r($nextQty);
    if(!empty($searchPUP)) { $data['ITEM'] = $searchPUP; }
    if(!empty($nextQty)) { $data['PARTNERPRICEQTY1'] = $nextQty['PARTNERPRICEQTY1']; }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    $result = array('searchPUP' => $searchPUP, 'nextQty' => $nextQty);
    echo json_encode($result);
}

function getPartner() {
    $javafunc = new PartnerUnitMaster;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $PARTNERCD = isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '';
    $PARTNERTYP = isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '';
    $PARTNERPRICEDT = isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '';
    $query = $javafunc->getPartner($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getIM() {
    $javafunc = new PartnerUnitMaster;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $PARTNERCD = isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '';
    $PARTNERTYP = isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '';
    $query = $javafunc->getIM($ITEMCD, $PARTNERTYP, $PARTNERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getDT() {
    $javafunc = new PartnerUnitMaster;
    $PARTNERPRICEDT = isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '';
    $query = $javafunc->getDate($PARTNERPRICEDT);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function nextQty($param) {
    $javafunc = new PartnerUnitMaster;
    $query = $javafunc->nextQty($param);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
} 

function preDate() {
    $javafunc = new PartnerUnitMaster;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $PARTNERCD = isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '';
    $PARTNERTYP = isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '';
    $PARTNERPRICEDT = isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '';
    $query = $javafunc->preDate($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function nextDate() {
    $javafunc = new PartnerUnitMaster;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $PARTNERCD = isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '';
    $PARTNERTYP = isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '';
    $PARTNERPRICEDT = isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '';
    $query = $javafunc->nextDate($PARTNERTYP, $PARTNERCD, $ITEMCD, $PARTNERPRICEDT) ;
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function currenttQty() {
    $javafunc = new PartnerUnitMaster;
    $PARTNERPRICEQTY1 = isset($_POST['PARTNERPRICEQTY1']) ? str_replace(',', '', $_POST['PARTNERPRICEQTY1']): '';
    $PARTNERPRICEQTY2 = isset($_POST['PARTNERPRICEQTY2']) ? str_replace(',', '', $_POST['PARTNERPRICEQTY2']): '';
    $query = $javafunc->currenttQty($PARTNERPRICEQTY1, $PARTNERPRICEQTY2) ;
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function entry() {
     $param = array('ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'NEXTQTY' => isset($_POST['NEXTQTY']) ? $_POST['NEXTQTY']: '',
                    'PARTNERCD' => isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '',
                    'PARTNERTYP' => isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '',
                    'PARTNERPRICEDT' => isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '');
    return nextQty($param);
} 

function insert() {
    $javafunc = new PartnerUnitMaster;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'NEXTQTY' => isset($_POST['NEXTQTY']) ? $_POST['NEXTQTY']: '',
                    'PARTNERCD' => isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '',
                    'PARTNERTYP' => isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '',
                    'PARTNERPRICE' => isset($_POST['PARTNERPRICE']) ? str_replace(',', '', $_POST['PARTNERPRICE']): '',
                    'PARTNERPRICEDT' => isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '',
                    'PARTNERPRICEQTY1' => isset($_POST['PARTNERPRICEQTY1']) ? str_replace(',', '', $_POST['PARTNERPRICEQTY1']): '',
                    'PARTNERPRICEQTY2' => isset($_POST['PARTNERPRICEQTY2']) ? str_replace(',', '', $_POST['PARTNERPRICEQTY2']): '');
    $insert = $javafunc->insert($param);
    if(!empty($insert)) { $data['ITEM'] = $insert; setSessionArray($data); }
    echo json_encode($insert);
}

function update() {
    $javafunc = new PartnerUnitMaster;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'NEXTQTY' => isset($_POST['NEXTQTY']) ? $_POST['NEXTQTY']: '',
                    'PARTNERCD' => isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '',
                    'PARTNERTYP' => isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '',
                    'PARTNERPRICELN' => isset($_POST['PARTNERPRICELN']) ? $_POST['PARTNERPRICELN']: '',
                    'PARTNERPRICE' => isset($_POST['PARTNERPRICE']) ? str_replace(',', '', $_POST['PARTNERPRICE']): '',
                    'PARTNERPRICEDT' => isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '');
    $update = $javafunc->update($param);
    if(!empty($update)) { $data['ITEM'] = $update; setSessionArray($data); }
    echo json_encode($update);
}

function delete() {
    $javafunc = new PartnerUnitMaster;
    $param = array( 'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'NEXTQTY' => isset($_POST['NEXTQTY']) ? $_POST['NEXTQTY']: '',
                    'PARTNERCD' => isset($_POST['PARTNERCD']) ? $_POST['PARTNERCD']: '',
                    'PARTNERTYP' => isset($_POST['PARTNERTYP']) ? $_POST['PARTNERTYP']: '',
                    'PARTNERPRICELN' => isset($_POST['PARTNERPRICELN']) ? $_POST['PARTNERPRICELN']: '',
                    'PARTNERPRICEDT' => isset($_POST['PARTNERPRICEDT']) ? str_replace('-', '', $_POST['PARTNERPRICEDT']): '',
                    'PARTNERPRICEQTY1' => isset($_POST['PARTNERPRICEQTY1']) ? str_replace(',', '', $_POST['PARTNERPRICEQTY1']): '');
    $delete = $javafunc->delete($param);
    if(!empty($delete)) { $data['ITEM'] = $delete; setSessionArray($data); }
    echo json_encode($delete);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'PARTNERTYP', 'ITEMCD', 'ITEMNAME', 'PARTNERCD', 'PARTNERNAME', 'ITEMSPEC', 'ITEMDRAWNO', 'PARTNERPRICEDT', 'CMPRICETYP', 'CMCURDISP', 'PARTNERPRICEQTY1', 'SYSEN_PRE', 'SYSEN_NEXT', 'SYSEN_PARTNERPRICEQTY2');

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

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}