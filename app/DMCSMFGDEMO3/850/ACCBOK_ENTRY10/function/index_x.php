<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}  // if ($appname == "") {
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new AccBOKEntry10;
$data = array();
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 10;
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
// $data = $load;
$data['INP_STFCD'] = $load['INP_STFCD'];
$data['INP_STFNM'] = $load['INP_STFNM'];
$data['ASSETTYP'] = isset($data['ASSETTYP']) ? $data['ASSETTYP']: 0;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['BOOKORDERNO']) || !empty($_GET['VONO']) ) {
        unsetSessionData();
        $BOOKORDERNO = isset($_GET['BOOKORDERNO']) ? $_GET['BOOKORDERNO']: $_GET['VONO'];
        $query = $javaFunc->get_header(trim($BOOKORDERNO));
        $data = $query;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        if(!empty($query)) {
            $data['BOOKORDERNO'] = isset($_GET['BOOKORDERNO']) ? $_GET['BOOKORDERNO']: $_GET['VONO'];
            $get_assetn = $javaFunc->get_assetn($query['ASSETACC']);
            // print_r($get_assetn);
            if(!empty($get_assetn)) { $data['ASSETNA'] = $get_assetn['ASSETNA']; }
            $chkPrt = $javaFunc->chkPrt($load['ACCY'], $data['BOOKORDERNO'], $load['CURRENCY1'], $query['I_CURRENCY'], $query['EXRATE']);
            if(!empty($chkPrt)) { $data['SYSEN_PRINT'] = $chkPrt['SYSEN_PRINT']; }
            $get_detail = $javaFunc->get_detail($load['ACCY'], $data['BOOKORDERNO'], $load['CURRENCY1'], $query['I_CURRENCY'], $query['EXRATE']);
            if(!empty($get_detail)) { $data['ITEM'] = $get_detail; }
            // echo '<pre>';
            // print_r($get_detail);
            // echo '</pre>';
            setSessionArray($data);
        }
    } else if(isset($_GET['DIVISIONCD'])) {
        getDiv();
    } else if(isset($_GET['SUPPLIERCD'])) {
        get_supllier();
    } else if(isset($_GET['ASSETACC'])) {
        get_assetn();
    } else if(isset($_GET['ACCCD'])) {
        get_acc();
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}
// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
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
$data['CSS_TYPE'] = isset($data['CSS_TYPE']) ? $data['CSS_TYPE']: 2;
$data['DC_TYPE'] = isset($data['DC_TYPE']) ? $data['DC_TYPE']: 0;
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: date('Y');
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$assettype = $data['DRPLANG']['ASSETTYPE'];
$csstyp = $data['DRPLANG']['CSS_TYP'];
$currencytyp = $data['DRPLANG']['CURRENCYTYP'];
$dctyp = $data['DRPLANG']['DC_TYP'];
$invoiceno = $data['DRPLANG']['INVOICENO'];
$year = $data['DRPLANG']['YEAR'];
$yearvalue = $data['DRPLANG']['YEAR'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($load);
// echo "</pre>";
// --------------------------------------------------------------------------//

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "unsetItemData") {  unsetItemData($_POST['lineIndex']); }
        if ($_POST['action'] == "entryUnset") { entryUnset(); }
        if ($_POST['action'] == "getDiv") { getDiv(); }
        if ($_POST['action'] == "get_supllier") { get_supllier(); }
        if ($_POST['action'] == "get_exrate") { get_exrate(); }
        if ($_POST['action'] == "get_assetn") { get_assetn(); }
        if ($_POST['action'] == "dc_type") { dc_type(); }
        if ($_POST['action'] == "get_acc") { get_acc(); }
        if ($_POST['action'] == "dc_type1") { dc_type1(); }
        if ($_POST['action'] == "commit") { commit(); }
        if ($_POST['action'] == "inp_AccTran") { inp_AccTran(); }

    }
}
//--------------------------------------------------------------------------------
function getDiv() {
    $getfunc = new AccBOKEntry10;
    if(isset($_GET['DIVISIONCD'])) {
        $DIVISIONCD = isset($_GET['DIVISIONCD']) ? $_GET['DIVISIONCD']: '';
    } else {
        $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';   
    }
    $query = $getfunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    if(isset($_GET['divisioncd'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function get_supllier() {
    $getfunc = new AccBOKEntry10;
    if(isset($_GET['SUPPLIERCD'])) {
        $SUPPLIERCD = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
    } else {
        $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';   
    }
    $query = $getfunc->get_supllier($SUPPLIERCD);
    if(!empty($query)) { $query['SUPPLIERCD'] = $SUPPLIERCD; setSessionArray($query); }
    if(isset($_GET['suppliercd'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function get_exrate() {
    $getfunc = new AccBOKEntry10;
    $I_CURRENCY = isset($_POST['I_CURRENCY']) ? $_POST['I_CURRENCY']: '';  
    $CURRENCY1 = isset($_POST['CURRENCY1']) ? $_POST['CURRENCY1']: '';   
    $query = $getfunc->get_exrate($I_CURRENCY, $CURRENCY1);
    echo json_encode($query);
}

function get_assetn() {
    $getfunc = new AccBOKEntry10;
    if(isset($_GET['ASSETACC'])) {
        $ASSETACC = isset($_GET['ASSETACC']) ? $_GET['ASSETACC']: '';
    } else {
        $ASSETACC = isset($_POST['ASSETACC']) ? $_POST['ASSETACC']: '';  
    }
    $query = $getfunc->get_assetn($ASSETACC);
    if(!empty($query)) { $query['ASSETACC'] = $ASSETACC; setSessionArray($query); }
    if(isset($_GET['ASSETACC'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function dc_type() {
    $getfunc = new AccBOKEntry10;
    $DC_TYPE = isset($_POST['DC_TYPE']) ? $_POST['DC_TYPE']: '';  
    $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';   
    $query = $getfunc->dc_type($DC_TYPE, $ACC_CD);
    echo json_encode($query);
}

function get_acc() {
    $data = getSessionData();
    $accfunc = new AccBOKEntry10;
    if(isset($_GET['ACCCD'])) {
        $ACC_CD = isset($_GET['ACCCD']) ? $_GET['ACCCD']: '';
    } else {
        $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';   
    }
    $DC_TYPE = isset($_POST['DC_TYPE']) ? $_POST['DC_TYPE']: '';
    $query = $accfunc->get_acc($ACC_CD, $DC_TYPE);
    if(!empty($query)) {
        if(isset($_GET['ACCCD'])) {
            if (!is_array($query) && str_contains($query, 'ERRO:')) {
                return json_encode($query);
            } else {
                setSessionArray($query);
                return json_encode($query);
            }
        } else {
            echo json_encode($query);
        }
    }
}

function dc_type1() {
    $getfunc = new AccBOKEntry10;
    $AMT = isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '';  
    $DC_TYPE = isset($_POST['DC_TYPE']) ? $_POST['DC_TYPE']: '';   
    $EXRATE = isset($_POST['EXRATEx']) ? $_POST['EXRATEx']: '';   
    $query = $getfunc->dc_type1($AMT, $DC_TYPE, $EXRATE);
    echo json_encode($query);
}

function commit() {
    $cmtfunc = new AccBOKEntry10;
    $param = array( "BOOKORDERNO" => isset($_POST['BOOKORDERNO']) ? $_POST['BOOKORDERNO']: '',
                    "TDATE" => isset($_POST['TDATE']) ? str_replace("-", "", $_POST['TDATE']): '',
                    "ISSUEDATE" => isset($_POST['ISSUEDATE']) ? str_replace("-", "", $_POST['ISSUEDATE']): '',
                    "INP_STFCD" => isset($_POST['INP_STFCD']) ? $_POST['INP_STFCD']: '',
                    "DIVISIONCD" => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    "SUPPLIERCD" => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    "ASSETTYP" => isset($_POST['ASSETTYP']) ? $_POST['ASSETTYP']: '',
                    "INVOICE_NO" => isset($_POST['INVOICE_NO']) ? $_POST['INVOICE_NO']: '',
                    "ASSETCD" => isset($_POST['ASSETCD']) ? $_POST['ASSETCD']: '',
                    "QTY" => isset($_POST['QTY']) ? $_POST['QTY']: '',
                    "UPRICE" => isset($_POST['UPRICE']) ? implode(explode(',', $_POST['UPRICE'])): '',
                    "I_CURRENCY" => isset($_POST['I_CURRENCY']) ? $_POST['I_CURRENCY']: '',
                    "EXRATE" => isset($_POST['EXRATE']) ? $_POST['EXRATE']: '',
                    "ASUNITPRC" => isset($_POST['ASUNITPRC']) ? implode(explode(',', $_POST['ASUNITPRC'])): '',
                    "AS_AMT" => isset($_POST['AS_AMT']) ? implode(explode(',', $_POST['AS_AMT'])): '',
                    "DEPREC_A" => isset($_POST['DEPREC_A']) ? $_POST['DEPREC_A']: '',
                    "ASSETNM" => isset($_POST['ASSETNM']) ? $_POST['ASSETNM']: '',
                    "ASSETNM_E" => isset($_POST['ASSETNM_E']) ? $_POST['ASSETNM_E']: '',
                    "ASSETACC" => isset($_POST['ASSETACC']) ? $_POST['ASSETACC']: '',
                    "SERIAL_NO" => isset($_POST['SERIAL_NO']) ? $_POST['SERIAL_NO']: '',
                    "STDATE" => isset($_POST['STDATE']) ? str_replace("-", "", $_POST['STDATE']): '',
                    "LIFEY" => isset($_POST['LIFEY']) ? $_POST['LIFEY']: '',
                    "DRATE" => isset($_POST['DRATE']) ? $_POST['DRATE']: '',
                    "SOLVAGEVL" => isset($_POST['SOLVAGEVL']) ? $_POST['SOLVAGEVL']: '',
                    "PROJECTNO" => isset($_POST['PROJECTNO']) ? $_POST['PROJECTNO']: '',
                    "SECTION1" => isset($_POST['SECTION1']) ? $_POST['SECTION1']: '',
                    "ACCTRANREMARK" => isset($_POST['ACCTRANREMARK']) ? $_POST['ACCTRANREMARK']: '',
                    "ACCY" => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    "VOUCHERNO" => isset($_POST['VOUCHERNO']) ? $_POST['VOUCHERNO']: '',
                    "TTL_AMT1" => isset($_POST['TTL_AMT1']) ? implode(explode(',', $_POST['TTL_AMT1'])): '',
                    "TTL_AMT2" => isset($_POST['TTL_AMT2']) ? implode(explode(',', $_POST['TTL_AMT2'])): '',
                );
    // print_r($param);
    $inp_asset = $cmtfunc->inp_asset($param);
    if(!empty($inp_asset)) {
        // print_r($inp_asset);
        echo json_encode($inp_asset);
    }
}

function inp_AccTran() {
    $RowParam = array();
    if(!empty($_POST['ROWNOA'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
            $RowParam[] = array('ROWNO' => $i+1,
                                'ACC_CD' => $_POST['ACC_CDA'][$i],
                                'ACC_NM' => $_POST['ACC_NMA'][$i],
                                'ACCAMT1' => isset($_POST['ACCAMT1A'][$i]) ? implode(explode(',', $_POST['ACCAMT1A'][$i])): '0.00',
                                'ACCAMT2' => isset($_POST['ACCAMT2A'][$i]) ? implode(explode(',', $_POST['ACCAMT2A'][$i])): '0.00',
                                'CURRENCY1' => $_POST['CURRENCY1A'][$i],
                                'I_CURRENCY' => $_POST['I_CURRENCYA'][$i],
                                'PROJECTNO' => $_POST['PROJECTNOA'][$i],
                                'SECTION1' => $_POST['SECTION1A'][$i],
                                'ACCTRANREMARK' => $_POST['ACCTRANREMARKA'][$i],   
                                'EXRATE' => isset($_POST['EXRATEA'][$i]) ? implode(explode(',', $_POST['EXRATEA'][$i])): '1.000000',
                                'DC_TYPE' => $_POST['DC_TYPEA'][$i],   
                                'AMT' => isset($_POST['AMTA'][$i]) ? implode(explode(',', $_POST['AMTA'][$i])): '0.00',
                                'SECTION2' => '',
                                'SECTION3' => '',
                                'SECTION4' => '',
                                'SECTION5' => '');
        };
    }
    $cmtfunc = new AccBOKEntry10;
    $param = array( "BOOKORDERNO" => isset($_POST['BOOKORDERNO']) ? $_POST['BOOKORDERNO']: '',
                    "TDATE" => isset($_POST['TDATE']) ? str_replace("-", "", $_POST['TDATE']): '',
                    "INPDATE" => isset($_POST['INPDATE']) ? str_replace("-", "", $_POST['INPDATE']): '',
                    "ISSUEDATE" => isset($_POST['ISSUEDATE']) ? str_replace("-", "", $_POST['ISSUEDATE']): '',
                    "INP_STFCD" => isset($_POST['INP_STFCD']) ? $_POST['INP_STFCD']: '',
                    "DIVISIONCD" => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    "SUPPLIERCD" => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    "ACCY" => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    "CSS_TYPE" => isset($_POST['CSS_TYPE']) ? $_POST['CSS_TYPE']: '',
                    "TTL_AMT1" => isset($_POST['TTL_AMT1']) ? implode(explode(',', $_POST['TTL_AMT1'])): '',
                    "TTL_AMT2" => isset($_POST['TTL_AMT2']) ? implode(explode(',', $_POST['TTL_AMT2'])): '',
                    "CUSTOMERCODE" => "",
                    "STAFFCODE" => "",
                    "SUPCD" => "",
                    "DATA" => $RowParam,
                );
    // print_r($param);
    $inp_AccTran = $cmtfunc->inp_AccTran($param);
    if(!empty($inp_AccTran)) {
        // print_r($inp_AccTran);
        if (!is_array($inp_AccTran) && str_contains($inp_AccTran, 'ERRO:')) {
            echo json_encode($inp_AccTran);
        } else {
            unsetSessionData();
            echo json_encode($inp_AccTran);
        }
    }
}

function ASVCprint() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccBOKEntry10;
    $Param = array( "BOOKORDERNO" => $data['BOOKORDERNO'],
                    "ISSUEDATE" => str_replace("-", "", $data['ISSUEDATE']),
                    "ASSETNM_E" => isset($data['ASSETNM_E']) ? $data['ASSETNM_E']: '',
                    "QTY" => isset($data['QTY']) ? $data['QTY']: '',
                    "I_CURRENCY" => isset($data['I_CURRENCY']) ? $data['I_CURRENCY']: '',
                    "UPRICE" => isset($data['UPRICE']) ? implode(explode(',', $data['UPRICE'])): '0.00');
    // print_r($Param);
    $printStatic = $printfunc->PrintStatic($Param);
    $printDynamic = $printfunc->PrintDynamic($Param);
    $data['PRINTSTATIC'] = $printStatic;
    if(!empty($printDynamic)) {
        $data['PRINTDYNAMIC'] = $printDynamic;
        setSessionArray($data);
    }
    // echo "<pre>";
    // print_r($data['PRINTSTATIC']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['PRINTDYNAMIC']);
    // echo "</pre>";
}

function commitRemark() {
    $commitRemarkfunc = new AccBOKEntry10;
    $accremark = isset($_POST['ACCTRANREMARK']) ? implode(explode(',', $_POST['ACCTRANREMARK'])): '';
    $commitRemark = $commitRemarkfunc->commitRemark($accremark);
    echo json_encode($commitRemark);
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

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'VOUCHERNO' => $_POST['VOUCHERNOA'][$i],
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
    unsetSessionkey('ROWNO');
    unsetSessionkey('VOUCHERNO');
    unsetSessionkey('ACC_CD');
    unsetSessionkey('ACC_NM');
    unsetSessionkey('ACCTRANREMARK');
    unsetSessionkey('ACCAMT1');
    unsetSessionkey('ACCAMT2');
    unsetSessionkey('SECTION1');
    unsetSessionkey('PROJECTNO');
    unsetSessionkey('DC_TYPE');
    unsetSessionkey('EXRATE');
    unsetSessionkey('AMT');
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'BOOKORDERNO', 'INPDATE', 'ISSUEDATE', 'ACCY', 'INP_STFCD', 'INP_STFNM', 'DIVISIONCD', 'DIVISIONNAME', 'CSS_TYPE', 'SUPPLIERCD', 'SUPPLIERNAME', 'ASSETTYP', 'INVOICE_NO', 'ASSETCD', 'QTY', 'UPRICE', 'I_CURRENCY', 'EXRATE', 'COMCURRENCY', 'TDATE', 'ASUNITPRC', 'CURRENCY1', 'AS_AMT', 'DEPREC_A', 'ASSETNM', 'SERIAL_NO', 'ASSETNM_E', 'ASSETACC', 'ASSETNA', 'STDATE', 'LIFEY', 'DRATE', 'SOLVAGEVL', 'ROWNO', 'VOUCHERNO', 'TTL_AMT1', 'TTL_AMT2', 'DC_TYPE', 'ACC_CD', 'ACC_NM', 'ACCAMT1', 'ACCAMT2', 'AMT', 'PROJECTNO', 'SECTION1', 'ACCTRANREMARK', 'SYSEN_PRINT'
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

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>