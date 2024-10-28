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
$javaFunc = new AccounntMasterAc;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
//$AFFILIATEFLG ='';
$ACC_GPS = '';

if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $ACC_GPS = $_POST['ACC_GPS'];
        
        $query = $javaFunc->search($_POST['ACC_GPS']);
        //print_r($query);
        //print_r($query['DEBITACCCD2']);
        
        $data['ACCMAS'] = $query;
        
        $data['ACC_GPS'] = $_POST['ACC_GPS'];
        
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
    $javaFunc = new AccounntMasterAc;
    if(isset($_GET['refresh'])) {
        $query = $javaFunc->search($ACC_GPS);
        $data['ACCMAS'] = $query;
        // print_r($data['ACCSET']);
       // print_r($data['AFFILIATEFLG']);
        setSessionArray($data); 
    }

    if(isset($_GET['ACCOUNTCD'])) {
        
      unsetSessionkey('ACCOUNTCD');
        unsetSessionkey('ACCOUNTNAME');
        unsetSessionkey('ACCOUNTNAME2');
        unsetSessionkey('ACC_TYP');
       // unsetSessionkey('ACC_GRP');
        unsetSessionkey('ACCSUM_TYP');
        unsetSessionkey('INPACCEPT_TYP');
               

        $data['ACCOUNTCD'] = isset($_GET['ACCOUNTCD']) ? $_GET['ACCOUNTCD']: '';
        // print_r($data['ACCOUNTCD']);
        $query = $javaFunc->getAcc($data['ACCOUNTCD']);
        $data = $query;             
        setSessionArray($data); 
       //print_r($data);      
            
    }
    
    if(isset($_GET['ACC_GRP'])) {
        $data['ACC_GRP'] = isset($_GET['ACC_GRP']) ? $_GET['ACC_GRP']: '';
        $query = $javaFunc->getCarryOverF($data['ACC_GRP']);
       // $data['ACCOUNTCD'] = $_POST['ACCOUNTCD'];
        $data['CARRYOVERFLG'] = $query['CARRYOVERFLG'];
       // print_r($data['CARRYOVERFLG']);
    
    }

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
$acc01 = $data['DRPLANG']['ACC01'];
$taisyakul = $data['DRPLANG']['TAISYAKU'];
$ACC01S = $data['DRPLANG']['ACC01'];
if(empty($data['INPACCEPT_TYP'])) { $data['INPACCEPT_TYP'] = 'T' ;}
//  $data = getSessionData(); 

function insert() {
    $javaInsrt = new AccounntMasterAc;
    
    $CHECKINPACCEPT_TYP = isset($_POST['INPACCEPT_TYP']) ? 'T': 'F' ;
    $CHECKACCSUM_TYP = isset($_POST['ACCSUM_TYP']) ? 'T': 'F' ;
    $Param = array( 'ACCOUNTCD' => $_POST['ACCOUNTCD'],
                    'ACCOUNTNAME' => $_POST['ACCOUNTNAME'],
                    'ACCOUNTNAME2' => $_POST['ACCOUNTNAME2'],
                    'ACC_TYP' => $_POST['ACC_TYPS'],
                    'TAX_TYP' => $_POST['TAX_TYP'],
                    'ACC_GRP' => $_POST['ACC_GRPS'],
                    'ACCOUNTPURTYP' => '',
                    'ACCOUNTSALETYP' => '',
                    'INPACCEPT_TYP' => $CHECKINPACCEPT_TYP,
                    'ACCLIST_TYP' => isset($_POST['ACCLIST_TYP']) ? $_POST['ACCLIST_TYP']: 'T',
                    'ACCSUM_TYP' => $CHECKACCSUM_TYP,
                    'VARIABLE_TYP' => '',
                    'CARRYOVERFLG' => $_POST['CARRYOVERFLG']);
    $insert = $javaInsrt->insMasterAC($Param);
    print_r($insert);
    unsetSessionData();
    echo json_encode($insert);
}
// ACCIFCDID
function update() {
    $javaUpd = new AccounntMasterAc;
    $CHECKINPACCEPT_TYP = isset($_POST['INPACCEPT_TYP']) ? 'T': 'F' ;
    $CHECKACCSUM_TYP = isset($_POST['ACCSUM_TYP']) ? 'T': 'F' ;
  //  $keydata
    $Param = array( 'ACCOUNTCD' => $_POST['ACCOUNTCD'],
                    'ACCOUNTNAME' => $_POST['ACCOUNTNAME'],
                    'ACCOUNTNAME2' => $_POST['ACCOUNTNAME2'],
                    'ACC_TYP' => $_POST['ACC_TYPS'],
                    'TAX_TYP' => $_POST['TAX_TYP'],
                    'ACC_GRP' => $_POST['ACC_GRPS'],
                    'ACCOUNTPURTYP' => '',
                    'ACCOUNTSALETYP' => '',
                    'INPACCEPT_TYP' => $CHECKINPACCEPT_TYP,
                    'ACCLIST_TYP' => isset($_POST['ACCLIST_TYP']) ? $_POST['ACCLIST_TYP']: 'T',
                    'ACCSUM_TYP' => $CHECKACCSUM_TYP,
                    'VARIABLE_TYP' => '',
                    'CARRYOVERFLG' => $_POST['CARRYOVERFLG']);                 
    $update = $javaUpd->updMasterAC($Param);
    unsetSessionData();
    //print_r($_POST['AFFILIATEFLG']);
    echo json_encode($update);
}

function deletes() {
    $javaDel = new AccounntMasterAc;    
    $Param = array("ACCOUNTCD" => $_POST['ACCOUNTCD'], 'ACC_GRP' => $_POST['ACC_GRPS']);
    $deletes = $javaDel->delMasterAC($Param);   
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
    $keepField = array('ACCMAS', 'ACC_GPS', 'ACCOUNTCD', 'ACCOUNTNAME', 'ACCOUNTNAME2', 'ACCSUM_TYP', 'INPACCEPT_TYP', 'CARRYOVERFLG',
    'ACC_TYP','ACC_TYPS','ACC_GRP', 'ACC_GRPS','SYSPVL', 'TXTLANG', 'DRPLANG');
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