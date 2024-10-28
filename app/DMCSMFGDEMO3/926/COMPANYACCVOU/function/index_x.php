<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
$syslogic = new Syslogic;

if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $syslogic->setLoadApp($appcode);     
}



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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
    //--------------------------------------------------------------------------------
    //  LANGUAGE
    if (isset($_SESSION['LANG'])) {
        // require_once(dirname(__FILE__, 2). '/lang/jp.php');
        require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
    } else {  
        require_once(dirname(__FILE__, 2).'/lang/en.php');
    }
    $systemName = strtolower($appcode);
    $data = array();

    if(!empty($_GET)) {
        // unsetSessionData();
         $javaFunc = new CompanyAcoountVou;
        
                      
           //print_r($data);

        if(!empty($query)) {
            setSessionArray($data); 
            // if(checkSessionData()) { $data = getSessionData(); } 
        }
    
        if(checkSessionData()) { $data = getSessionData(); } 
    }


    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        
        //if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { Updatecompaccvou(); }
      //  if ($_POST['action'] == "delete") { delete(); }
    }



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
$loadevent = getSystemData($_SESSION['APPCODE']."_EVENT");
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_EVENT", $loadevent);
}

$javaloadapp = new CompanyAcoountVou;
$loadapptest = getSystemData($_SESSION['APPCODE']."comp");
if(empty($loadapptest)) {
    $loadapptest = $javaloadapp->load();
    //setSystemData($_SESSION['APPCODE']."comp", $loadapptest);
   
} 

    // $javaloadapp = new CompanyAcoountSet;
    // $loadapptest = $javaloadapp->load();
    // $data =$loadapptest;

$data['cpnaccvou']=$loadapptest[1];
// print_r($data['cpnaccvou']);

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$vformatm = $data['DRPLANG']['VFORMATYM'];
// $vatcaltype = $data['DRPLANG']['VATCALCTYP'];
// $invcalctype = $data['DRPLANG']['INVCALC_TYPE'];




//print_r($data['cpnacc']['VATCALCTYP']);



    // setSessionArray($data);
    // if(checkSessionData()) { $data = getSessionData(); } 
//print_r($data['company']);



function Updatecompaccvou() {
    $javaUpd = new CompanyAcoountVou;
    $param = array("PREFIXQU" => $_POST['PREFIXQU'],
                    "PREFIX2QU" => $_POST['PREFIX2QU'],
                    "DIGITQU" => $_POST['DIGITQU'],
                    "PREFIXSOD" => $_POST['PREFIXSOD'],
                    "PREFIX2SOD" => $_POST['PREFIX2SOD'],
                    "PREFIX2SOO" => $_POST['PREFIX2SOO'],
                    "DIGITSOO" => $_POST['DIGITSOO'],
                    "PREFIXSTD" => $_POST['PREFIXSTD'],
                    "PREFIX2STD" => $_POST['PREFIX2STD'], 
                    "PREFIX2STO" => $_POST['PREFIX2STO'],
                    "DIGITSTO" => $_POST['DIGITSTO'],
                    "PREFIXBN" => $_POST['PREFIXBN'],
                    "PREFIX2BN" => $_POST['PREFIX2BN'], 
                    
                    "PREFIXPR" => $_POST['PREFIXPR'],
                    "DIGITRVO" => $_POST['DIGITRVO'],
                    "DIGITSTD" => $_POST['DIGITSTD'], 
                    "DIGITSOD" => $_POST['DIGITSOD'], 
                    "PREFIXSOO" => $_POST['PREFIXSOO'],
                    "PREFIXSTO" => $_POST['PREFIXSTO'],
                    "DIGITBN" => $_POST['DIGITBN'],
                    "PREFIXRVD" => $_POST['PREFIXRVD'],
                    "PREFIX2RVD" => $_POST['PREFIX2RVD'],
                    "DIGITRVD" => $_POST['DIGITRVD'],  
                    "PREFIXRVO" => $_POST['PREFIXRVO'],                        
                    "PREFIX2RVO" => $_POST['PREFIX2RVO'],
                    "PREFIX2PR" => $_POST['PREFIX2PR'],
                    "DIGITPR" => $_POST['DIGITPR'], 
                    "PREFIXPOD" => $_POST['PREFIXPOD'],
                    "PREFIX2POD" => $_POST['PREFIX2POD'],
                    "DIGITPOD" => $_POST['DIGITPOD'],
                    "PREFIXPOO" => $_POST['PREFIXPOO'], 
                    "PREFIX2POO" => $_POST['PREFIX2POO'],
                    "DIGITPOO" => $_POST['DIGITPOO'],
                    "PREFIXPVD" => $_POST['PREFIXPVD'],
                    "PREFIX2PVD" => $_POST['PREFIX2PVD'],  
                    "DIGITPVD" => $_POST['DIGITPVD'], 
                    "PREFIXPVO" => $_POST['PREFIXPVO'],  
                    "PREFIX2PVO" => $_POST['PREFIX2PVO'],                        
                    "DIGITPVO" => $_POST['DIGITPVO'],
                    "PREFIXJV" => $_POST['PREFIXJV'],
                    "PREFIX2JV" => $_POST['PREFIX2JV'], 
                    "DIGITJV" => $_POST['DIGITJV'],
                    "PREFIXJVD" => $_POST['PREFIXJVD'],
                    "PREFIX2JVD" => $_POST['PREFIX2JVD'],
                    "DIGITJVD" => $_POST['DIGITJVD'], 
                    "PREFIXJVC" => $_POST['PREFIXJVC'],
                    "PREFIX2JVC" => $_POST['PREFIX2JVC'],
                    "DIGITJVC" => $_POST['DIGITJVC'],
                    "PREFIXPB" => $_POST['PREFIXPB'],  
                    "PREFIX2PB" => $_POST['PREFIX2PB'], 
                    "DIGITPB" => $_POST['DIGITPB'],  
                    "PREFIXPMD" => $_POST['PREFIXPMD'],                        
                    "PREFIX2PMD" => $_POST['PREFIX2PMD'],
                    "DIGITPMD" => $_POST['DIGITPMD'],
                    "PREFIXPMO" => $_POST['PREFIXPMO'], 
                    "PREFIX2PMO" => $_POST['PREFIX2PMO'],
                    "DIGITPMO" => $_POST['DIGITPMO'],
                    "PREFIXFA" => $_POST['PREFIXFA'],
                    "PREFIX2FA" => $_POST['PREFIX2FA'], 
                    "DIGITFA" => $_POST['DIGITFA'],
                    "PREFIXPC" => $_POST['PREFIXPC'],
                    "PREFIX2PC" => $_POST['PREFIX2PC'],
                    "DIGITPC" => $_POST['DIGITPC'],  
                    "PREFIXWG" => $_POST['PREFIXWG'], 
                    "PREFIX2WG" => $_POST['PREFIX2WG'],  
                    "DIGITWG" => $_POST['DIGITWG'],                        
                    "PREFIXTXI" => $_POST['PREFIXTXI'],
                    "PREFIX2TXI" => $_POST['PREFIX2TXI'],
                    "DIGITTXI" => $_POST['DIGITTXI'], 
                    "PREFIXGV" => $_POST['PREFIXGV'],
                    "PREFIX2GV" => $_POST['PREFIX2GV'],
                    "DIGITGV" => $_POST['DIGITGV'],
                    
                                                   
                );
                
               //print_r($_POST['VATCALCTYP']);
    $Updatecompaccvou = $javaUpd->Updatecompaccvou($param);
//    echo json_encode($update);
     //unsetSessionData();
}
function setOldValue() {
    setSessionArray($_POST); 
   // print_r($_POST);
}


function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}
function setSessionArray($arr){
    $keepField = array( "TXTLANG","DRPLANG","ACCYEAR", "VATCALCTYP", "PREFIX2PR", "PREFIXPR", "DIGITRVO", "PREFIXSOO", "DIGITSOD", "ACCCD5", "ACCNAME5", "ACCCD1", "ACCNAME1", "ACCCD3", "ACCNAME3", "ACCCD2", "ACCNAME2",
                        "ACCCD4", "ACCNAME4", "ACCCDP1","ACCNAMEP1", "ACCCDP2", "ACCNAMEP2", "INVCALCTYP","WHTCD1","WHTNAME1", "WHTCD2", "WHTNAME2", "STDPAYMENTCD1", "STDPAYMENTNAME1",
                        "STDPAYMENTCD2", "STDPAYMENTNAME2", "STDRECEIVECD1", "STDRECEIVENAME1", "STDRECEIVECD2", "STDRECEIVENAME2", "ACCCHECKINV", "cpnacc",
                       
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

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
function getSystemData($key = "") {
    return get_sys_data(SESSION_NAME_SYSTEM, $key);
  }
  
  function setSystemData($key, $val) {
    return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
  }
?>
