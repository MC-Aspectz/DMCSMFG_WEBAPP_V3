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
         $javaFunc = new CompanyAcoountSet;
        
         if(!empty($_GET['acccode'])) {
            if(isset($_GET['index']) && $_GET['index']==1)
            {
            $query = $javaFunc->getAcc1($_GET['acccode']);
            
            $data['ACCCD1'] = $query['ACCCD1'];
            $data['ACCNAME1'] = $query['ACCNAME1'];   
            //print_r($data['ACCCD1']);      
            }
         else  if(isset($_GET['index']) && $_GET['index']==2)
            {
            $query = $javaFunc->getAcc2($_GET['acccode']);
            $data['ACCCD2'] = $query['ACCCD2'];
            $data['ACCNAME2'] = $query['ACCNAME2'];            
            }
            else    if(isset($_GET['index']) && $_GET['index']==3)
            {
            $query = $javaFunc->getAcc3($_GET['acccode']);
            $data['ACCCD3'] = $query['ACCCD3'];
            $data['ACCNAME3'] = $query['ACCNAME3'];            
            }
            else   if(isset($_GET['index']) && $_GET['index']==4)
            {
            $query = $javaFunc->getAcc4($_GET['acccode']);
            $data['ACCCD4'] = $query['ACCCD4'];
            $data['ACCNAME4'] = $query['ACCNAME4'];           
            }
            else   if(isset($_GET['index']) && $_GET['index']==5)
            {
            $query = $javaFunc->getAcc5($_GET['acccode']);
            $data['ACCCD5'] = $query['ACCCD5'];
            $data['ACCNAME5'] = $query['ACCNAME5'];            
            }
            else    if(isset($_GET['index']) && $_GET['index']=='p1')
            {
            $query = $javaFunc->getAccP1($_GET['acccode']);
            $data['ACCCDP1'] = $query['ACCCDP1'];
            $data['ACCNAMEP1'] = $query['ACCNAMEP1'];            
            }
            else    if(isset($_GET['index']) && $_GET['index']=='p2')
            {
            $query = $javaFunc->getAccP2($_GET['acccode']);
            $data['ACCCDP2'] = $query['ACCCDP2'];
            $data['ACCNAMEP2'] = $query['ACCNAMEP2'];           
            }
            else   if(isset($_GET['index']) && $_GET['index']=='wht1')
            {
            $query = $javaFunc->getAccWHT1($_GET['acccode']);
            $data['WHTCD1'] = $query['WHTCD1'];
            $data['WHTNAME1'] = $query['WHTNAME1'];            
            }
            else   if(isset($_GET['index']) && $_GET['index']=='wht2')
            {
            $query = $javaFunc->getAccWHT2($_GET['acccode']);
            $data['WHTCD2'] = $query['WHTCD2'];
            $data['WHTNAME2'] = $query['WHTNAME2'];            
            }
            else    if(isset($_GET['index']) && $_GET['index']=='stdpay1')
            {
            $query = $javaFunc->getAccStdPay1($_GET['acccode']);
            $data['STDPAYMENTCD1'] = $query['STDPAYMENTCD1'];
            $data['STDPAYMENTNAME1'] = $query['STDPAYMENTNAME1'];            
            }
            else  if(isset($_GET['index']) && $_GET['index']=='stdpay2')
            {
            $query = $javaFunc->getAccStdPay2($_GET['acccode']);
            $data['STDPAYMENTCD2'] = $query['STDPAYMENTCD2'];
            $data['STDPAYMENTNAME2'] = $query['STDPAYMENTNAME2'];            
            }
            else   if(isset($_GET['index']) && $_GET['index']=='stdrec1')
            {
            $query = $javaFunc->getAccStdRec1($_GET['acccode']);
            $data['STDRECEIVECD1'] = $query['STDRECEIVECD1'];
            $data['STDRECEIVENAME1'] = $query['STDRECEIVENAME1'];            
            }
            else    if(isset($_GET['index']) && $_GET['index']=='stdrec2')
            {
            $query = $javaFunc->getAccStdRec2($_GET['acccode']);
            $data['STDRECEIVECD2'] = $query['STDRECEIVECD2'];
            $data['STDRECEIVENAME2'] = $query['STDRECEIVENAME2'];            
            }
    }
               
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
        if ($_POST['action'] == "update") { Updatecompacc(); }
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

$javaloadapp = new CompanyAcoountSet;
$loadapptest = getSystemData($_SESSION['APPCODE']."comp");
if(empty($loadapptest)) {
    $loadapptest = $javaloadapp->load();
    //setSystemData($_SESSION['APPCODE']."comp", $loadapptest);
   
} 

    // $javaloadapp = new CompanyAcoountSet;
    // $loadapptest = $javaloadapp->load();
    // $data =$loadapptest;

$data['cpnacc']=$loadapptest[1];
 //print_r($data['cpnacc']);

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
//$codekey123 = $data['TXTLANG']['DC_TYP'];

//print_r($codekey123);
$accyearvalue = $data['DRPLANG']['ACCYEARVALUE'];
$vatcaltype = $data['DRPLANG']['VATCALCTYP'];
$invcalctype = $data['DRPLANG']['INVCALC_TYPE'];




//print_r($data['cpnacc']['VATCALCTYP']);
// echo "<pre>";
// echo "</pre>";


    // setSessionArray($data);
    // if(checkSessionData()) { $data = getSessionData(); } 
//print_r($data['company']);




function Updatecompacc() {
    $javaUpd = new CompanyAcoountSet;
    $param = array("ACCYEAR" => $_POST['ACCYEAR'],
                    "ACCCD1" => $_POST['ACCCD1'],
                    "ACCCD2" => $_POST['ACCCD2'],
                    "ACCCD3" => $_POST['ACCCD3'],
                    "ACCCD4" => $_POST['ACCCD4'],
                    "ACCCD5" => $_POST['ACCCD5'],
                    "ACCCDP1" => $_POST['ACCCDP1'],
                    "ACCCDP2" => $_POST['ACCCDP2'],
                    "INVCALCTYP" => $_POST['INVCALCTYP'], 
                    "DITEMCD" => '',
                    "VATCALCTYP" => $_POST['VATCALCTYP'],
                    "WHTCD1" => $_POST['WHTCD1'],
                    "WHTCD2" => $_POST['WHTCD2'], 
                    "STDPAYMENTCD1" => $_POST['STDPAYMENTCD1'],
                    "STDPAYMENTCD2" => $_POST['STDPAYMENTCD2'],
                    "STDRECEIVECD1" => $_POST['STDRECEIVECD1'],
                    "STDRECEIVECD2" => $_POST['STDRECEIVECD2'],  
                    "ACCCHECKINV" => $_POST['ACCCHECKINV'],                    
                                                   
                );
                
               //print_r($_POST['VATCALCTYP']);
    $Updatecompacc = $javaUpd->Updatecompacc($param);
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
    $keepField = array( "TXTLANG","DRPLANG", "ACCYEAR", "VATCALCTYP", "ACCCD5", "ACCNAME5", "ACCCD1", "ACCNAME1", "ACCCD3", "ACCNAME3", "ACCCD2", "ACCNAME2",
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
