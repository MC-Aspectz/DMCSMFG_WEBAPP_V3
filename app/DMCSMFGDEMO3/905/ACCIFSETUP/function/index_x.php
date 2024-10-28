<?php
require_once('index_class.php');
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
$companyguide = $_SESSION['APPURL'].'/guide/'.$_SESSION['COMCD'];
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
$javaFunc = new InterfaceSettingAcc;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$AFFILIATEFLG ='';
$PROCESSTYPS = '';

if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $PROCESSTYPS = $_POST['PROCESSTYPS'];
        
        $query = $javaFunc->search($_POST['PROCESSTYPS']);
        //print_r($query);
        //print_r($query['DEBITACCCD2']);
        
        $data['ITEM'] = $query;
        
        $data['PROCESSTYPS'] = $_POST['PROCESSTYPS'];
        
        //print_r($data['ACCSET']);
        // $AFFILIATEFLG =$_POST['AFFILIATEFLG'];

        // print_r($AFFILIATEFLG);

        // print_r($_POST['KEYDATA']);
        //$test = isset($data['ACCSET']['KEYDATA']) ? $data['ACCSET']['KEYDATA']: '5';
       // print_r($data['ACCSET'][1]);
        // ['ROWCOUNTER']);
       //print_r($_POST['AFFILIATEFLGS']);
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "setaccenable") { SetaccEnable(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        
    }
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    $javaFunc = new InterfaceSettingAcc;
    // if(isset($_GET['refresh'])) {
    //     $query = $javaFunc->search($PROCESSTYPS);
    //     $data['ITEM'] = $query;
    //     // print_r($data['ITEM']);
    //    // print_r($data['AFFILIATEFLG']);
    //     setSessionArray($data); 
    // }
    
    if(isset($_GET['ITEMTYP'])) {
        unsetSessionkey('ITEMTYP');
        unsetSessionkey('ITEMTYPNM');
        $data['ITEMTYP'] = isset($_GET['ITEMTYP']) ? $_GET['ITEMTYP']: '';

        $query = $javaFunc->getAccIfCd($data['ITEMTYP']);
        $data = $query; 
        // $data['ITEMTYP'] = $query['ITEMTYP'];
        // $data['ITEMTYPNM'] = $query['ITEMTYPNM'];   
       // print_r($data);
    //print_r($data['ACCCD1']);      

    }
    // else {
    //     $data['ITEMTYP'] = $query['ITEMTYP'];
    // }
    if(isset($_GET['ACCCD'])) {
        if(isset($_GET['index']) && $_GET['index'] == '1') {
            $query = $javaFunc->getAccD1($_GET['ACCCD']);
            $data['DEBITACCCD1'] = $query['DEBITACCCD1'];
            $data['DEBITACCNM1'] = $query['DEBITACCNM1'];   
           // print_r($data['DEBITACCNM1']);      
        } else if(isset($_GET['index']) && $_GET['index'] == '2') {
            $query = $javaFunc->getAccD2($_GET['ACCCD']);
            $data['DEBITACCCD2'] = $query['DEBITACCCD2'];
            $data['DEBITACCNM2'] = $query['DEBITACCNM2']; 
            // print_r($query);  
        } else  if(isset($_GET['index']) && $_GET['index'] == '3') {
            $query = $javaFunc->getAccC1($_GET['ACCCD']);
            $data['CREDITACCCD1'] = $query['CREDITACCCD1'];
            $data['CREDITACCNM1'] = $query['CREDITACCNM1'];            
        } else  if(isset($_GET['index']) && $_GET['index'] == '4') {
            $query = $javaFunc->getAccC2($_GET['ACCCD']);
            $data['CREDITACCCD2'] = $query['CREDITACCCD2'];
            $data['CREDITACCNM2'] = $query['CREDITACCNM2'];            
        }
    }

    // if(!empty($_GET['citycd'])) {

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data);
}

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}

$data['SYSPVL'] = $syspvl;
// print_r($data['SYSPVL']);
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$processtype = $data['DRPLANG']['PROCESS_TYPE'];
$naigaitype = $data['DRPLANG']['NAIGAI_TYPE'];
$boitype = $data['DRPLANG']['BOI_TYPE'];
$invcalctype = $data['DRPLANG']['INVCALC_TYPE'];
$acctaxtype = $data['DRPLANG']['ACCTAXTYP'];

//  $data = getSessionData(); 

function SetaccEnable() {
    $javasetaccenable = new InterfaceSettingAcc;
    $param = array("PROCESSTYP" => $_POST['PROCESSTYPSS'],
    "INVCALCTYP" => $_POST['INVCALCTYPS'],"DEBITACCCD2" => $_POST['DEBITACCCD2'],
    "CREDITACCCD2" => $_POST['CREDITACCCD2']);
  //  setSessionArray($_POST); 
  $setaccenable = $javasetaccenable->setAccEnable($param);
  // print_r($setaccenable);
    //   unsetSessionData();
}

// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//
// INVCALCTYP,PROCESSTYP,NAIGAITYP,BOITYP,ITEMTYP,AFFILIATEFLG,TAXTYP,DEBITACCCD1,CREDITACCCD1,DEBITACCCD2,CREDITACCCD2,DEBITACCCD3,CREDITACCCD3,DEBITACCCD4,CREDITACCCD4,MEMO
function insert() {
    $javaInsrt = new InterfaceSettingAcc;
    $CHECKAFFILIATEFLGSINS = isset($_POST['AFFILIATEFLG']) ? 'T': 'F' ;
    $Param = array("INVCALCTYP" => $_POST['INVCALCTYPS'],
                    "PROCESSTYP" => $_POST['PROCESSTYPSS'],"NAIGAITYP" => $_POST['NAIGAITYPS'],
                    "BOITYP" => $_POST['BOITYPS'],"ITEMTYP" => $_POST['ITEMTYP'],
                    "AFFILIATEFLG" => $CHECKAFFILIATEFLGSINS,"TAXTYP" => $_POST['TAXTYPS'],
                    "DEBITACCCD1" => $_POST['DEBITACCCD1'],"CREDITACCCD1" => $_POST['CREDITACCCD1'],
                    "DEBITACCCD2" => $_POST['DEBITACCCD2'],"CREDITACCCD2" => $_POST['CREDITACCCD2'],"DEBITACCCD3" => $_POST['DEBITACCCD3'],
                    "CREDITACCCD3" => $_POST['CREDITACCCD3'],"DEBITACCCD4" => $_POST['DEBITACCCD4'],
                    "CREDITACCCD4" => $_POST['CREDITACCCD4'],
                    "MEMO" => $_POST['MEMO']);
    $insert = $javaInsrt->insInterfaceset($Param);
    // print_r($insert);
    unsetSessionData();
    echo json_encode($insert);
}
// ACCIFCDID
function update() {
    $javaUpd = new InterfaceSettingAcc;
    $CHECKAFFILIATEFLGSUPD = isset($_POST['AFFILIATEFLG']) ? 'T': 'F' ;
  //  $keydata
    $Param = array("INVCALCTYP" => $_POST['INVCALCTYPS'],
                    "PROCESSTYP" => $_POST['PROCESSTYPSS'],"NAIGAITYP" => $_POST['NAIGAITYPS'],
                    "BOITYP" => $_POST['BOITYPS'],"ITEMTYP" => $_POST['ITEMTYP'],"AFFILIATEFLG" => $CHECKAFFILIATEFLGSUPD
                    ,"TAXTYP" => $_POST['TAXTYPS'],
                    "DEBITACCCD1" => $_POST['DEBITACCCD1'],"CREDITACCCD1" => $_POST['CREDITACCCD1'],
                    "DEBITACCCD2" => $_POST['DEBITACCCD2'],"CREDITACCCD2" => $_POST['CREDITACCCD2'],"DEBITACCCD3" => $_POST['DEBITACCCD3'],
                    "CREDITACCCD3" => $_POST['CREDITACCCD3'],"DEBITACCCD4" => $_POST['DEBITACCCD4'],
                    "CREDITACCCD4" => $_POST['CREDITACCCD4'],
                    "MEMO" => $_POST['MEMO'],
                    "KEYDATA" => $_POST['KEYDATA']);                 
    $update = $javaUpd->updInterfaceset($Param);
    unsetSessionData();
    //print_r($_POST['AFFILIATEFLG']);
    echo json_encode($update);
}

function deletes() {
    
    $javaDel = new InterfaceSettingAcc;    
    $Param = array("KEYDATA" => $_POST['KEYDATA']);
    $deletes = $javaDel->delInterfaceset($Param);   
   // print_r($_POST['KEYDATA']);
    //unsetSessionData();
    echo json_encode($deletes);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
    }
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array('ITEM', 'PROCESSTYPS', 'ROWCOUNTER', 'INVCALCTYPS', 'PROCESSTYPSS','ITEMTYPNM','KEYDATA',
    'NAIGAITYPS', 'BOITYPS','ITEMTYP', 'AFFILIATEFLG','TAXTYPS', 'DEBITACCCD1', 'DEBITACCNM1', 'CREDITACCCD1','CREDITACCNM1',
    'CREDITACCNM2','DEBITACCCD2','DEBITACCNM2','CREDITACCCD2', 'DEBITACCCD3',
    'CREDITACCCD3','DEBITACCCD4', 'CREDITACCCD4', 'MEMO', 'SYSPVL', 'TXTLANG', 'DRPLANG');
    foreach($arr as $k => $v){
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

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = "") {
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
?>