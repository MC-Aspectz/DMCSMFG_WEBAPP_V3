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
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
}
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['APPCODE'] = $appcode;
$routeUrl = $_SESSION['APPURL'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
# print_r($oldRouteUrl).'<br>';  
# print_r($routeUrl);
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$systemName = strtolower($appcode);
$data = array();
$minrow = 0;
$maxrow = 4;

if(!empty($_GET)) {
    // print_r($_GET);
    $javaFunc = new ReSaleEntryTHA;
    if(isset($_GET['SALETRANNO'])) {
        unsetSessionData();
        $query = $javaFunc->getST($_GET['SALETRANNO']);
        $query2 = $javaFunc->getST2($_GET['SALETRANNO']);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        if(!empty($query)) { 
            $data = $query;
            if(!empty($query2)) {
                // print_r($query2);
                $data['CUSCURCD'] = $query2['CUSCURCD'];
                $data['CUSCURDISP'] = $query2['CUSCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['T_AMOUNT1'] = $query2['T_AMOUNT']; 
                $data['SALEDIVCON2CBO'] = '';          
            }
            // print_r($query);
            $itemlist = $javaFunc->getSTLn($_GET['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist; 
            }
            setSessionArray($data); 
        }
    }
    if(isset($_GET['DIVISIONCD'])) {
        $query = $javaFunc->getDivision($_GET['DIVISIONCD']);
        $data['DIVISIONCD'] = $query['DIVISIONCD'];
        $data['DIVISIONNAME'] = $query['DIVISIONNAME'];
        if(!empty($query)) {
            setSessionArray($data); 
        }
    }
    if(isset($_GET['CUSTOMERCD'])) {
        $query = $javaFunc->getCustomer($_GET['CUSTOMERCD']);
        $data = $query;
        $data['QUOTEAMOUNT'] = '0.00';
        $data['VATAMOUNT'] = '0.00';
        $data['VATAMOUNT1'] = '0.00';
        $data['T_AMOUNT'] = '0.00';
        $data['T_AMOUNT1'] = '0.00';
        if(!empty($query)) {
            setSessionArray($data); 
        }
    }
    if(isset($_GET['STAFFCD'])) {
        $query = $javaFunc->getStaff($_GET['STAFFCD']);
        $data['STAFFCD'] = $query['STAFFCD'];
        $data['STAFFNAME'] = $query['STAFFNAME'];
        if(!empty($query)) {
            setSessionArray($data); 
        }
    } 
    if(isset($_GET['CUSCURCD'])) {
        $query = $javaFunc->getCurrency($_GET['CUSCURCD']);
        $data['CUSCURCD'] = $query['CUSCURCD'];
        $data['CUSCURDISP'] = $query['CUSCURCD'];
        if(!empty($query)) {
            setSessionArray($data); 
        }
    }

    if(isset($_GET['SALEDIVCON2CBO'])) {
        $query = $javaFunc->setSaleDivCon2($_GET['SALEDIVCON2CBO']);
        $data = $query;
        $data['SALEDIVCON2CBO'] = isset($_GET['SALEDIVCON2CBO']) ? $_GET['SALEDIVCON2CBO']: '';
        setSessionArray($data); 
        // print_r($query);
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data);
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'keepdata') { setOldValue(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'programDelete') { programDelete(); }
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
} else {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    // $setLoadApp = $syslogic->setLoadApp($_SESSION['APPCODE']);
}
$loadevent = getSystemData($_SESSION['APPCODE'].'_EVENT');
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_EVENT', $loadevent);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['GROUPRT'] = $loadevent['GROUPRT'];
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$cancelreason = $data['DRPLANG']['CANCELREASON'];
setSessionArray($data);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($loadevent);
// echo '</pre>';
// --------------------------------------------------------------------------//

function commit() {
    // ROWNO,ITEMCD,ITEMNAME,SALEQTY,ITEMUNITTYP,SALEUNITPRC,SALEDISCOUNT,SALEAMT,SALEDISCOUNT2,SALETAXAMT,SALELN,SALEORDERQTY
    $cmtfunc = new ReSaleEntryTHA;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $RowParam[] = array('ROWNO' => $i+1,
                            'ITEMCD' => $_POST['ITEMCD'][$i],
                            'ITEMNAME' => $_POST['ITEMNAME'][$i],
                            'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? implode(explode(',', $_POST['SALEQTY'][$i])): '0.00',
                            'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                            'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? implode(explode(',', $_POST['SALEUNITPRC'][$i])): '0.00',
                            'SALEDISCOUNT' => isset($_POST['SALEDISCOUNT'][$i]) ? implode(explode(',', $_POST['SALEDISCOUNT'][$i])): '0.00',
                            'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? implode(explode(',', $_POST['SALEAMT'][$i])): '0.00',
                            'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                            'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? implode(explode(',', $_POST['SALETAXAMT'][$i])): '0.00',
                            'SALELN' => isset($_POST['SALELN'][$i]) ? implode(explode(',', $_POST['SALELN'][$i])): '0.00',
                            'SALEORDERQTY' => isset($_POST['SALEORDERQTY'][$i]) ? implode(explode(',', $_POST['SALEORDERQTY'][$i])): '0.00');
    }
    $param = array( "SALETRANNO" => $_POST['SALETRANNO'],
                    "SVNO" => $_POST['SVNO'],
                    "CANCELTRANNO" => $_POST['CANCELTRANNO'],
                    "CANCELSVNO" => $_POST['CANCELSVNO'],
                    "SALETRANSALEDT" => str_replace("-", "", $_POST['SALETRANSALEDT']),
                    "SALETRANINSPDT" => str_replace("-", "", $_POST['SALETRANINSPDT']),
                    "SALEORDERNO" => $_POST['SALEORDERNO'],
                    "DIVISIONCD" => $_POST['DIVISIONCD'],
                    "DIVISIONNAME" => $_POST['DIVISIONNAME'],
                    "CUSTOMERCD" => $_POST['CUSTOMERCD'],
                    "ESTCUSTEL" => $_POST['ESTCUSTEL'],
                    "ESTCUSFAX" => $_POST['ESTCUSFAX'],
                    "STAFFCD" => $_POST['STAFFCD'],
                    "ESTCUSSTAFF" => $_POST['ESTCUSSTAFF'],
                    "DESCRIPTION" => $_POST['DESCRIPTION'],
                    "SALECUSMEMO" => $_POST['SALECUSMEMO'],
                    "SALEDIVCON1" => $_POST['SALEDIVCON1'],
                    "SALEDIVCON2" => $_POST['SALEDIVCON2'],
                    "SALEDIVCON3" => $_POST['SALEDIVCON3'],
                    "SALEDIVCON4" => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                    "SALETERM" => $_POST['SALETERM'],
                    "CUSCURCD" => $_POST['CUSCURCD'],
                    "SALEDIVCON2CBO" => $_POST['SALEDIVCON2CBO'],
                    "SALELNDUEDT" => isset($_POST['SALELNDUEDT']) ? str_replace("-", "", $_POST['SALELNDUEDT']) :'',
                    "S_TTL" => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    "DISCRATE" => $_POST['DISCRATE'],
                    "DISCOUNTAMOUNT" => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    "QUOTEAMOUNT" => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    "VATRATE" => $_POST['VATRATE'],
                    "VATAMOUNT" => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    "VATAMOUNT1" => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    "T_AMOUNT" => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    // unsetSessionData();
    echo json_encode($commit);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {

    global $data;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'SALEQTY' => $_POST['SALEQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SALEUNITPRC' => $_POST['SALEUNITPRC'][$i],
                                    'SALEDISCOUNT' => $_POST['SALEDISCOUNT'][$i],
                                    'SALEAMT' => $_POST['SALEAMT'][$i],
                                    'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                                    'SALETAXAMT' => $_POST['SALETAXAMT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( "SALETRANNO", "DIVISIONCD", "DIVISIONNAME", "SALEISSUEDT", "CUSTOMERCD", "BRANCHKBN", "TAXID", "CUSCURCD", "CUSTOMERNAME", "SALEORDERNO", "DESCRIPTION",
                        "SALECUSMEMO", "SALEDIVCON4", "SALELNDUEDT", "CUSTADDR1", "CUSTADDR2", "ESTCUSSTAFF", "ESTCUSTEL", "ESTCUSFAX", "STAFFCD", "STAFFNAME", "SALETERM", "SVNO",
                        "ESTDLVCON1", "ESTDLVCON2", "ITEM", "CUSCURDISP", "S_TTL", "DISCRATE", "DISCOUNTAMOUNT", "REPRINTREASON", "T_AMOUNT1",
                        "QUOTEAMOUNT", "VATRATE", "VATAMOUNT", "VATAMOUNT1", "T_AMOUNT", "SYSMSG", "SYSVIS_CANCELLBL", "SUB", "LDIS", "AFDIS", "TOT", "TVAT", "SYSVIS_PRINTINV",
                        "ROWCOUNTER", "COMPNTH", "COMPNEN", "ADDR1", "ADDR2", "ADDREN1", "ADDREN2", "TELO", "FAXO", "ATNAME", "PONUM", "SHDATE", "SLMAN", "GROUPRT",
                        "CUSN", "ADDR10", "ADDR20", "CTEL", "CFAX", "QONUM", "TDATE", "PAYTERM", "PRVALID", "QOBY", "REM1", "REM2", "REM3", "CUR", "ITEMINV", "CADDR1", "CADDR2", "SONUM",
                        "SYSPVL", "TXTLANG", "DRPLANG", "SALEDIVCON1", "SALEDIVCON2", "SALEDIVCON3", "DEPT", "DES", "CDEPT", "ANUM", "CTAXID", "REF", "SHV", "CANCELTRANNO", "SALEDIVCON2CBO",
                        "ADDRTH", "ADDREN", "TELO", "FAXO", "TAXNO", "ITEMPAGE", "ITEMTAXINV", "LOADPRINT", "TAXINV", "CANCELSVNO",
                    );

    foreach($arr as $k => $v){
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

function unsetSesstionItem($lineIndex = "") {
    global $systemName;
    global $data;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>