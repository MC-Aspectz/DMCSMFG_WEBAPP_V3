<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
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

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
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
}

$data = array();
$javaFunc = new AccRPTFormSetting;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 10;
$minrowB = 0;
$maxrowB = 10;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['acccode'])) {
        getACCCD();
    }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }  
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "getRptFormDtl") { getRptFormDtl(); }  
        if ($_POST['action'] == "getACCCD") { getACCCD(); }
        if ($_POST['action'] == "insRptFormDtl") { insRptFormDtl(); }
        if ($_POST['action'] == "updRptFormDtl") { updRptFormDtl(); }
        if ($_POST['action'] == "delRptFormDtl") { delRptFormDtl(); }
        if ($_POST['action'] == "insRptForm") { insRptForm(); }
        if ($_POST['action'] == "updRptForm") { updRptForm(); }
        if ($_POST['action'] == "delRptForm") { delRptForm(); }
    }
    if (isset($_POST['SEARCH'])) { searchCheck(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
// $load = getSystemData($_SESSION['APPCODE'].'LOAD');
// if(empty($load)) {
//     $load = $javaFunc->load();
//     setSystemData($_SESSION['APPCODE'].'LOAD', $load);
// }
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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['CALC_TYP'] = 1;
$rptform = $data['DRPLANG']['RPTFORM'];
$calctyp = $data['DRPLANG']['CALC_TYP'];
$textaligne = $data['DRPLANG']['TEXTALIGNE'];
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
// echo "<pre>";
// print_r($data);
// echo "</pre>";
// --------------------------------------------------------------------------//
function searchCheck() {
    global $data;
    $data = getSessionData();
    unsetSessionkey('ITEMACC');
    $searchfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $getRptForm = $searchfunc->getRptForm($RPTFORMTYP);
    if(!empty($getRptForm) && !empty($getRptForm[1])) {
        for ($i = 1 ; $i <= count($getRptForm); $i++) {
            $data['ITEM'][$i] = $getRptForm[$i]; 
        }
        setSessionArray($data);
    }
    // echo "<pre>";
    // print_r($getRptForm);
    // echo "</pre>";
}

function getRptFormDtl() {
    global $data;
    $data = getSessionData();
    $rptfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $getRptFormDtl = $rptfunc->getRptFormDtl($RPTFORMTYP, $FORMROWNUM);
    if(!empty($getRptFormDtl)) {
        for ($i = 1 ; $i <= count($getRptFormDtl); $i++) {
            $data['ITEMACC'][$i] = $getRptFormDtl[$i]; 
        }
        setSessionArray($data);
    }
    echo json_encode($getRptFormDtl);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
}

function insRptFormDtl() {
    $rptfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';
    $CALC_TYP = isset($_POST['CALC_TYP']) ? $_POST['CALC_TYP']: '';
    $insRptFormDtl = $rptfunc->insRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP);
    unsetAcc();
    echo json_encode($insRptFormDtl);
    // echo "<pre>";
    // print_r($insRptFormDtl);
    // echo "</pre>";
}

function updRptFormDtl() {
    $rptfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';
    $CALC_TYP = isset($_POST['CALC_TYP']) ? $_POST['CALC_TYP']: '';
    $ACCSEQ = isset($_POST['ACCSEQ']) ? $_POST['ACCSEQ']: '';
    $updRptFormDtl = $rptfunc->updRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP, $ACCSEQ);
    unsetAcc();
    echo json_encode($updRptFormDtl);
    // echo "<pre>";
    // print_r($updRptFormDtl);
    // echo "</pre>";
}

function delRptFormDtl() {
    $rptfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $ACC_CD = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';
    $CALC_TYP = isset($_POST['CALC_TYP']) ? $_POST['CALC_TYP']: '';
    $ACCSEQ = isset($_POST['ACCSEQ']) ? $_POST['ACCSEQ']: '';
    $delRptFormDtl = $rptfunc->delRptFormDtl($RPTFORMTYP, $FORMROWNUM, $ACC_CD, $CALC_TYP, $ACCSEQ);
    unsetAcc();
    echo json_encode($delRptFormDtl);
    // echo "<pre>";
    // print_r($delRptFormDtl);
    // echo "</pre>";
}

function insRptForm() {
    $rptfunc = new AccRPTFormSetting;
    $param = array( 'RPTFORMTYP' => isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '',
                    'FORMROWNUM' => isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '',
                    'FORMLEVEL' => isset($_POST['FORMLEVEL']) ? $_POST['FORMLEVEL']: '',
                    'FORMLINEFLG' => isset($_POST['FORMLINEFLG']) ? $_POST['FORMLINEFLG']: '',
                    'FORMZEROFLG' => isset($_POST['FORMZEROFLG']) ? $_POST['FORMZEROFLG']: '',
                    'FORMTEXT1' => isset($_POST['FORMTEXT1']) ? $_POST['FORMTEXT1']: '',
                    'FORMTEXT2' => isset($_POST['FORMTEXT2']) ? $_POST['FORMTEXT2']: '',
                    'FORMTEXTAL' => isset($_POST['FORMTEXTAL']) ? $_POST['FORMTEXTAL']: '');
    $insRptForm = $rptfunc->insRptForm($param);
    unsetForm();
    echo json_encode($insRptForm);
    // echo "<pre>";
    // print_r($insRptForm);
    // echo "</pre>";
}

function updRptForm() {
    $rptfunc = new AccRPTFormSetting;
    $param = array( 'RPTFORMTYP' => isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '',
                    'FORMROWNUM' => isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '',
                    'FORMLEVEL' => isset($_POST['FORMLEVEL']) ? $_POST['FORMLEVEL']: '',
                    'FORMLINEFLG' => isset($_POST['FORMLINEFLG']) ? $_POST['FORMLINEFLG']: '',
                    'FORMZEROFLG' => isset($_POST['FORMZEROFLG']) ? $_POST['FORMZEROFLG']: '',
                    'FORMTEXT1' => isset($_POST['FORMTEXT1']) ? $_POST['FORMTEXT1']: '',
                    'FORMTEXT2' => isset($_POST['FORMTEXT2']) ? $_POST['FORMTEXT2']: '',
                    'FORMTEXTAL' => isset($_POST['FORMTEXTAL']) ? $_POST['FORMTEXTAL']: '');
    $updRptForm = $rptfunc->updRptForm($param);
    unsetForm();
    echo json_encode($updRptForm);
    // echo "<pre>";
    // print_r($param);
    // echo "</pre>";
}

function delRptForm() {
    $rptfunc = new AccRPTFormSetting;
    $RPTFORMTYP = isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '';
    $FORMROWNUM = isset($_POST['FORMROWNUM']) ? $_POST['FORMROWNUM']: '';
    $delRptForm = $rptfunc->delRptForm($RPTFORMTYP, $FORMROWNUM);
    $getRptForm = $rptfunc->getRptForm($RPTFORMTYP);
    if(!empty($getRptForm)) {
        for ($i = 1 ; $i <= count($getRptForm); $i++) {
            $data['ITEM'][$i] = $getRptForm[$i]; 
        }
        setSessionArray($data);
    }
    unsetForm();
    // searchCheck();
    echo json_encode($delRptForm);
    // echo "<pre>";
    // print_r($delRptForm);
    // echo "</pre>";
}

function getACCCD() {
    global $data;
    $data = getSessionData();
    $accfunc = new AccRPTFormSetting;
    if(isset($_GET['acccode'])) {
        $data['ACC_CD'] = isset($_GET['acccode']) ? $_GET['acccode']: '';
    } else {
        $data['ACC_CD'] = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';   
    }
    $query = $accfunc->getAccount($data['ACC_CD']);
    if(!empty($query)) {
        $data['ACC_CD'] = $query['ACC_CD'];
        $data['ACC_NM'] = $query['ACC_NM'];
        // setSessionArray($data); 
    }
    if(isset($_GET['acccode'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
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
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

function keepItemData() {
    global $data;
    for ($i = 1 ; $i <= count($_POST['FORMROWNUM']); $i++) { 
        $data['ITEM'][$i] = array(  'FORMROWNUM' => $_POST['FORMROWNUMA'][$i],
                                    'FORMLEVEL' => $_POST['FORMLEVELA'][$i],
                                    'FORMLINEFLG' => $_POST['FORMLINEFLGA'][$i],
                                    'FORMZEROFLG' => $_POST['FORMZEROFLGA'][$i],
                                    'FORMTEXT1' => $_POST['FORMTEXT1A'][$i],
                                    'FORMTEXT2' => $_POST['FORMTEXT2A'][$i],
                                    'FORMTEXTAL' => $_POST['FORMTEXTALA'][$i]);
    }
    for ($i = 1 ; $i <= count($_POST['ACC_CD']); $i++) { 
        $data['ITEMACC'][$i] = array(   'CALC_TYP' => $_POST['CALC_TYPA'][$i],
                                        'ACC_CD' => $_POST['ACC_CDA'][$i],
                                        'ACC_NM' => $_POST['ACC_NMA'][$i],
                                        'ACCSEQ' => $_POST['ACCSEQA'][$i],
                                        'ACC_NM2' => $_POST['ACC_NM2A'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ITEMACC', 'RPTFORMTYP', 'FORMROWNUM', 'RPTFORM', 'FORMLINEFLG', 'FORMLEVEL', 'FORMZEROFLG', 'FORMTEXT1', 'FORMTEXT2', 'FORMTEXTAL', 'CALC_TYP', 'ACC_CD', 'ACC_NM', 'ACCSEQ');

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

function unsetForm() {
    unsetSessionkey('FORMROWNUM');
    unsetSessionkey('FORMLEVEL');
    unsetSessionkey('FORMLINEFLG');
    unsetSessionkey('FORMZEROFLG');
    unsetSessionkey('FORMTEXT1');
    unsetSessionkey('FORMTEXT2');
    unsetSessionkey('FORMTEXTAL');
}

function unsetAcc() {
    unsetSessionkey('ACC_CD');
    unsetSessionkey('ACC_NM');
    unsetSessionkey('CALC_TYP');
    unsetSessionkey('ACCSEQ');
}
?>