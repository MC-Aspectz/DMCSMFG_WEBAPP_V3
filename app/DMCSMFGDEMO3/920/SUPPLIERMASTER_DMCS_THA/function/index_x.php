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
// $syslogic = new Syslogic;
// if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
//     $syslogic->ProgramRundelete($_SESSION['APPCODE']);
// }
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
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2).'/lang/en.php');
}


$systemName = 'SupplierMaster';
$javaFunc = new SupplierMaster;
$data = array();
$COUNTRYCD = '';
$STATECD = '';
$CITYCD = '';
$CHECKCLEAR = '';
$SUPPLIERADDR2 = '';
$SUPPLIERZIPCODE = '';
$SUPPLIERADDR1 = '';

if(!empty($_GET)) { 
    // SUPPLIERCD 1 2
    if(isset($_GET['SUPPLIERCD']) && isset($_GET['index'])) {
        // print_r("SUPPLIERCD-INDEX");
        if($_GET['index'] == 1) {
            //SUPPLIERCD 
            $data['SUPPLIERCD'] = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
            $query = $javaFunc->getSupplier($data['SUPPLIERCD']);
            $data = $query;
            if(isset($query)) {
                setSessionKey('CHECKCLEAR' , 'F');
            }
            if(empty($query)){
                setSessionKey('CHECKCLEAR' , 'T');
            }
        } else {
            //SUPBILLCD
            $data['SUPBILLCD'] = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
            $query = $javaFunc->getBillSupplier($data['SUPBILLCD']);
            $data = $query;
        }
    }
    else if(!empty($_GET['SUPPLIERCD'])) {
        setSessionKey('SUPPLIERCD' , $_GET['SUPPLIERCD']);

        $data['SUPPLIERCD'] = $_GET['SUPPLIERCD'];
        $query = $javaFunc->getSupplier($data['SUPPLIERCD']);
        if(!empty($query)){
            setSessionKey('CHECKCLEAR' , 'F');
            setSessionArray($query);
        }

    } 
    //SUPPLIERCD
    // else if(isset($_GET['SUPPLIERCD'])) {
    //     print_r("SUPPLIERCD");
    //     $data['SUPPLIERCD'] = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
    //     $query = $javaFunc->getSupplier($data['SUPPLIERCD']);
    //     if(isset($query)) {
    //         $CHECKCLEAR = 'F';
    //         $data = $query;
    //     }
    //     if(empty($query)){
    //         unsetSessionData();
    //         $CHECKCLEAR = 'T';
    //     }
    //     print_r($CHECKCLEAR);
    // }    
    //COUNTRYCD
    else if(isset($_GET['COUNTRYCD'])) {
      if(checkSessionData()) { $data = getSessionData(); }
      $data['COUNTRYCD'] = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']: '';
      $STATECD = isset($data['STATECD'])?$data['STATECD']:'';
      $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
      $query = $javaFunc->getCountrycd($data['COUNTRYCD'], $STATECD, $CITYCD);
      $data['COUNTRYCD'] = isset($query['COUNTRYCD']) ? $query['COUNTRYCD'] : '';
      // print_r($query);
    }
    //STATECD
      else if(isset($_GET['STATECD'])) {
        if(checkSessionData()) { $data = getSessionData(); } 
        $data['STATECD'] = isset($_GET['STATECD']) ? $_GET['STATECD']: '';
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
        $query = $javaFunc->getState($COUNTRYCD,$data['STATECD'],$CITYCD);
        $data = $query;
    }
    //CITYCD
      else if(isset($_GET['CITYCD'])) {
        if(checkSessionData()) { $data = getSessionData(); } 
        $data['CITYCD'] = isset($_GET['CITYCD']) ? $_GET['CITYCD']: '';
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $STATECD = isset($data['STATECD'])? $data['STATECD']:'';
        $query = $javaFunc->getCity($COUNTRYCD,$STATECD,$data['CITYCD']);
        $data = $query;
    }
    //CURRENCYCD
    else if(isset($_GET['CURRENCYCD'])) {
        $data['CURRENCYCD'] = isset($_GET['CURRENCYCD']) ? $_GET['CURRENCYCD']: '';
        $query = $javaFunc->getCurrency($data['CURRENCYCD']);
        $data = $query;
    }
    //SUPPLIERSHORTNAME
    else if(isset($_GET['SUPPLIERSHORTNAME'])) {
        $data['SUPPLIERSHORTNAME'] = isset($_GET['SUPPLIERSHORTNAME']) ? $_GET['SUPPLIERSHORTNAME']: '';
        $query = $javaFunc->chack_l($data['SUPPLIERSHORTNAME']);
        if(isset($query['NUML'])){
            if ((int)$query['NUML'] === 13) {
                setSessionKey('SUPPLIERSHORTNAME' , $_GET['SUPPLIERSHORTNAME']);
            }
        }
        // print_r($query);
        $data = $query;
    }
    //SUPPLIERZIPCODE
    else if(isset($_GET['SUPPLIERZIPCODE'])) {
        setSessionKey('SUPPLIERZIPCODE' , $_GET['SUPPLIERZIPCODE']);

        $data['SUPPLIERZIPCODE'] = isset($_GET['SUPPLIERZIPCODE']) ? $_GET['SUPPLIERZIPCODE']: '';
        $query = $javaFunc->getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$data['SUPPLIERZIPCODE']);
        $data = $query;
    }
    //SUPPLIERADDR1
    else if(isset($_GET['SUPPLIERADDR1'])) {
        setSessionKey('SUPPLIERADDR1' , $_GET['SUPPLIERADDR1']);

        $data['SUPPLIERADDR1'] = isset($_GET['SUPPLIERADDR1']) ? $_GET['SUPPLIERADDR1']: '';
        $query = $javaFunc->getGMap($data['SUPPLIERADDR1'],$SUPPLIERADDR2,$SUPPLIERZIPCODE);
        $data = $query;
    }
    //SUPPLIERADDR2
    else if(isset($_GET['SUPPLIERADDR2'])) {
        setSessionKey('SUPPLIERADDR2' , $_GET['SUPPLIERADDR2']);

        $data['SUPPLIERADDR2'] = isset($_GET['SUPPLIERADDR2']) ? $_GET['SUPPLIERADDR2']: '';
        $query = $javaFunc->getGMap($SUPPLIERADDR1,$data['SUPPLIERADDR2'],$SUPPLIERZIPCODE);
        // print_r($query);
        $data = $query;
    }
    else if(isset($_GET['FACTORYCODE']) && isset($_GET['SUPPLIERADD01'])) {

        $data['SUPPLIERADD01'] = isset($_GET['SUPPLIERADD01']) ? $_GET['SUPPLIERADD01']: '';
        $data['FACTORYCODE'] = isset($_GET['FACTORYCODE']) ? $_GET['FACTORYCODE']: '';
        $query = $javaFunc->ChkBranch($data['FACTORYCODE'],$data['SUPPLIERADD01']);
        // print_r($query);
        $data = $query;
    }


    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); } 
}

if(!empty($_POST)){ //ส่ง
    // print_r($excute);
    //SUPPLIERSHORTNAME

        // $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']:'';     
        // $excute = $javaFunc->SetBranch($FACTORYCODE);
        // if(!empty($excute)){
        //  $tdata[] = array('FACTORYCODE' => $excute['FACTORYCODE']); 
        // }
 
        // $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']:'';
        // $SUPPLIERADD01 = isset($_POST['SUPPLIERADD01']) ? $_POST['SUPPLIERADD01']:'';
        // $excute = $javaFunc->ChkBranch($FACTORYCODE,$SUPPLIERADD01);
        // if(!empty($excute)){
        //  $tdata[] = array('FACTORYCODE' => $excute['FACTORYCODE'],
        //  'SUPPLIERADD01' => $excute['SUPPLIERADD01']); 
        // }       
        
     } 

if (isset($_POST['action'])) {
    if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
    if ($_POST['action'] == "keepdata") { setOldValue(); }
    if ($_POST['action'] == "insert") { insert(); }
    if ($_POST['action'] == "update") { update(); }
    if ($_POST['action'] == "delete") { delete(); }
   // if ($_POST['action'] == "getGMap") { getGMaps(); }
   // if ($_POST['action'] == "chacki") { chacki(); }
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

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$kbnbranch = $data['DRPLANG']['BRANCH_KBN'];
$bkacctype= $data['DRPLANG']['BK_ACC_TYPE'];
$roun_d1 = $data['DRPLANG']['ROUND'];
$roun_d2 = $data['DRPLANG']['ROUND'];
$roun_d3 = $data['DRPLANG']['ROUND'];
// print_r($roun_d1);
// print_r($data['SYSPVL']);

function insert() {
    $javaInsrt = new SupplierMaster;
 
    $param = array("SUPPLIERCD" => $_POST['SUPPLIERCD'],
                    "SUPPLIERNAME" => $_POST['SUPPLIERNAME'],
                    "SUPPLIERSHORTNAME" => $_POST['SUPPLIERSHORTNAME'],
                    "SUPPLIERSEARCH" => $_POST['SUPPLIERSEARCH'],
                    "SUPPLIERZIPCODE" => $_POST['SUPPLIERZIPCODE'],
                    "SUPPLIERADDR1" => $_POST['SUPPLIERADDR1'],
                    "SUPPLIERADDR2" => $_POST['SUPPLIERADDR2'],
                    "SUPPLIERTEL" => $_POST['SUPPLIERTEL'],
                    "SUPPLIERFAX" => $_POST['SUPPLIERFAX'],
                    "SUPPLIEREMAIL" => $_POST['SUPPLIEREMAIL'],
                    "SUPPLIERCONTACT" => $_POST['SUPPLIERCONTACT'],
                    "BANKNAME" => $_POST['BANKNAME'],
                    "BRANCHNAME" => $_POST['BRANCHNAME'],
                    "DIRECTCD" => '',
                    "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "CITYCD" => $_POST['CITYCD'],
                    "SUPPLIERPWD" => '',
                    "SUPPLIERTRANSPORTTYP" => '',
                    "SUPPLIERAFFILIATEFLG" => $_POST['SUPPLIERAFFILIATEFLG'],
                    "SUPPLIERCREDITLIMIT" => '',
                    "SUPPLIERCLOSEDAY" => $_POST['SUPPLIERCLOSEDAY'],
                    "SUPPLIERTAXROUNDTYP" => $_POST['SUPPLIERTAXROUNDTYP'],
                    "SUPPLIERTAXTYP" => $_POST['SUPPLIERTAXTYP'],
                    "SUPPLIERTAXRATE" => $_POST['SUPPLIERTAXRATE'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                    "STAFFCD" => '',
                    "SUPBILLCD" => $_POST['SUPBILLCD'],
                    "SUPPLIEREDITYP" => '',
                    "SUPPLIERREGDT" => str_replace("-", "", $_POST['SUPPLIERREGDT']),                   
                    "SUPPLIERADD01" => $_POST['SUPPLIERADD01'],                    
                    "SUPPLIERRECDAY" => $_POST['SUPPLIERRECDAY'],
                    "SUPPLIEROFFFLG" => $_POST['SUPPLIEROFFFLG'],
                    "SUPPLIERTRANSFERFLG" => '',
                    "BANKCD" => '',
                    "BRANCHCD" => '',
                    "SUPPLIERBKACCTYP" => $_POST['SUPPLIERBKACCTYP'],
                    "SUPPLIERBKACCNO" => $_POST['SUPPLIERBKACCNO'],
                    "SUPPLIERBKACCNAME" => $_POST['SUPPLIERBKACCNAME'],
                    "SUPPLIERREMARK" => $_POST['SUPPLIERREMARK'],
                    "SUPPLIERUNITROUNDTYP" => $_POST['SUPPLIERUNITROUNDTYP'],
                    "SUPPLIERAMTROUNDTYP" => $_POST['SUPPLIERAMTROUNDTYP'],
                    "FACTORYCODE" => $_POST['FACTORYCODE']
                                 
                );
       
       //print_r($param);
      $insert = $javaInsrt->insSupplier($param);
      // echo json_encode($insert);
      unsetSessionData();
}

function update() {
    $javaUpd = new SupplierMaster;
    $param = array("SUPPLIERCD" => $_POST['SUPPLIERCD'],
    "SUPPLIERNAME" => $_POST['SUPPLIERNAME'],
    "SUPPLIERSHORTNAME" => $_POST['SUPPLIERSHORTNAME'],
    "SUPPLIERSEARCH" => $_POST['SUPPLIERSEARCH'],
    "SUPPLIERZIPCODE" => $_POST['SUPPLIERZIPCODE'],
    "SUPPLIERADDR1" => $_POST['SUPPLIERADDR1'],
    "SUPPLIERADDR2" => $_POST['SUPPLIERADDR2'],
    "SUPPLIERTEL" => $_POST['SUPPLIERTEL'],
    "SUPPLIERFAX" => $_POST['SUPPLIERFAX'],
    "SUPPLIEREMAIL" => $_POST['SUPPLIEREMAIL'],
    "SUPPLIERCONTACT" => $_POST['SUPPLIERCONTACT'],
    "BANKNAME" => $_POST['BANKNAME'],
    "BRANCHNAME" => $_POST['BRANCHNAME'],
    "DIRECTCD" => '',
    "COUNTRYCD" => $_POST['COUNTRYCD'],
    "STATECD" => $_POST['STATECD'],
    "CITYCD" => $_POST['CITYCD'],
    "SUPPLIERPWD" => '',
    "SUPPLIERTRANSPORTTYP" => '',
    "SUPPLIERAFFILIATEFLG" => $_POST['SUPPLIERAFFILIATEFLG'],
    "SUPPLIERCREDITLIMIT" => '',
    "SUPPLIERCLOSEDAY" => $_POST['SUPPLIERCLOSEDAY'],
    "SUPPLIERTAXROUNDTYP" => $_POST['SUPPLIERTAXROUNDTYP'],
    "SUPPLIERTAXTYP" => $_POST['SUPPLIERTAXTYP'],
    "SUPPLIERTAXRATE" => $_POST['SUPPLIERTAXRATE'],
    "CURRENCYCD" => $_POST['CURRENCYCD'],
    "STAFFCD" => '',
    "SUPBILLCD" => $_POST['SUPBILLCD'],
    "SUPPLIEREDITYP" => '',
    "SUPPLIERREGDT" => str_replace("-", "", $_POST['SUPPLIERREGDT']),
    "SUPPLIERADD01" => $_POST['SUPPLIERADD01'],                    
    "SUPPLIERRECDAY" => $_POST['SUPPLIERRECDAY'],
    "SUPPLIEROFFFLG" => $_POST['SUPPLIEROFFFLG'],
    "SUPPLIERTRANSFERFLG" => '',
    "BANKCD" => '',
    "BRANCHCD" => '',
    "SUPPLIERBKACCTYP" => $_POST['SUPPLIERBKACCTYP'],
    "SUPPLIERBKACCNO" => $_POST['SUPPLIERBKACCNO'],
    "SUPPLIERBKACCNAME" => $_POST['SUPPLIERBKACCNAME'],
    "SUPPLIERREMARK" => $_POST['SUPPLIERREMARK'],
    "SUPPLIERUNITROUNDTYP" => $_POST['SUPPLIERUNITROUNDTYP'],
    "SUPPLIERAMTROUNDTYP" => $_POST['SUPPLIERAMTROUNDTYP'],
    "FACTORYCODE" => $_POST['FACTORYCODE']);              
                
                
             //   print_r($_POST['SupplierREGDT']);
    $update = $javaUpd->updSupplier($param);
//    echo json_encode($update);
     unsetSessionData();
}

function delete() {
    $delfunc = new SupplierMaster;
    $delete = $delfunc->delSupplier($_POST['SUPPLIERCD']);
    // echo json_encode($delete);
    unsetSessionData();
}

// function chacki() {
    
//     $javaFunc = new SupplierMaster;
//     $SUPPLIERSHORTNAME = isset($_POST['SUPPLIERSHORTNAME']) ? $_POST['SUPPLIERSHORTNAME']:'';     
//     $excute = $javaFunc->chack_l($SUPPLIERSHORTNAME);
//     if(!empty($excute)){
//      $tdata[] = array('SUPPLIERSHORTNAME' => $excute['SUPPLIERSHORTNAME']); 
//     }
// print_r($excute);
  
// }

function getGMaps() {
    
    $javaFunc = new SupplierMaster;
    $SUPPLIERADDR1 = isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']:'';
    $SUPPLIERADDR2 = isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']:'';
    $SUPPLIERZIPCODE = isset($_POST['SUPPLIERZIPCODE']) ? $_POST['SUPPLIERZIPCODE']:'';     
    $excute = $javaFunc->getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$SUPPLIERZIPCODE);
    if(!empty($excute)){
     $tdata[] = array('SUPPLIERADDR1' => $excute['SUPPLIERADDR1'],
     'SUPPLIERADDR2' => $excute['SUPPLIERADDR2'],
     'SUPPLIERZIPCODE' => $excute['SUPPLIERZIPCODE'],); 
    } 
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
    $keepField = array( "SUPPLIERCD", "SUPPLIERREGDT", "SUPPLIERNAME", "SUPPLIERSEARCH", "SUPPLIERSHORTNAME", "FACTORYCODE", "SUPPLIERADD01", "COUNTRYCD", "STATECD", "CITYCD", "CITYNAME",
                        "SUPPLIERZIPCODE", "SUPPLIERADDR1", "SUPPLIERADDR2", "SUPPLIERTEL", "SUPPLIERFAX", "SUPPLIEREMAIL", "SUPPLIERCONTACT", "BANKNAME","BRANCHNAME",
                        "CURRENCYCD", "SUPPLIERBKACCTYP","SUPPLIERBKACCNO", "SUPPLIERBKACCNAME", "SUPPLIERUNITROUNDTYP","SUPPLIERAMTROUNDTYP", "SUPPLIERTAXROUNDTYP", "SUPBILLCD",
                        "SUPBILLNAME","SUPPLIERRECDAY","SUPPLIERCLOSEDAY","SUPPLIERREMARK","SUPPLIEROFFFLG","SUPPLIERAFFILIATEFLG", "CHECKCLEAR"
                        
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

function setSessionKey($key, $value) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    $_SESSION[$sysnm][$key] = $value;
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