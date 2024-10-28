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
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
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


$systemName = 'CustomerMaster';
$data = array();
$COUNTRYCD = '';
$STATECD = '';
$CITYCD = '';

if(!empty($_GET)) {
    $javaFunc = new CustomerMaster;
   // if(checkSessionData()) { $data = getSessionData(); } 
    if(!empty($_GET['customercd'])) {
        $query = $javaFunc->getCustomer($_GET['customercd']);
        $data = $query;
      //  print_r($query);
        if(!empty($query)) { setSessionData('isInsert', 'off'); } else { setSessionData('isInsert', 'on'); }
        // if(!empty($data)) { setSessionArray($data); } // else { unsetSessionData(); }
    } else if(!empty($_GET['countrycd'])) {
        $STATECD = isset($data['STATECD'])?$data['STATECD']:'';
        $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
        $query = $javaFunc->getCountrycd($_GET['countrycd'], $STATECD, $CITYCD);
        $data['COUNTRYCD'] = $query['COUNTRYCD'];
     
       
    } else if(!empty($_GET['statecd'])) {
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
        $query = $javaFunc->getState($CITYCD,$_GET['statecd'],$CITYCD);
        $data['STATECD'] = $query['STATECD'];
       
    } else if(!empty($_GET['citycd'])) {
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $STATECD = isset($data['STATECD'])? $data['STATECD']:'';
        $query = $javaFunc->getCity($COUNTRYCD,$STATECD,$_GET['citycd']);
        $data['CITYCD'] = $query['CITYCD'];
        $data['CITYNAME'] = $query['CITYNAME'];
      
    } else if(!empty($_GET['currencycd'])) {
        $query = $javaFunc->getCurrency($_GET['currencycd']);
        $data['CURRENCYCD'] = $query['CURRENCYCD'];
      
    } 

    if(!empty($query)) {
        setSessionArray($data); 
        // if(checkSessionData()) { $data = getSessionData(); } 
    }

    if(checkSessionData()) { $data = getSessionData(); } 
    //print_r($data);
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
    if ($_POST['action'] == "keepdata") { setOldValue(); }
    if ($_POST['action'] == "insert") { insert(); }
    if ($_POST['action'] == "update") { update(); }
    if ($_POST['action'] == "delete") { delete(); }
}
// if (isset($_POST['insert'])) { insert(); }
// if (isset($_POST['update'])) { update(); }
// if (isset($_POST['delete'])) { delete(); }



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
} else {
    $setLoadApp = $syslogic->setLoadApp($_SESSION['APPCODE']);
}

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$kbnbranch = $data['DRPLANG']['BRANCH_KBN'];
$roun_d = $data['DRPLANG']['ROUND'];
$roun_d1 = $data['DRPLANG']['ROUND'];
$roun_d2 = $data['DRPLANG']['ROUND'];
// print_r($roun_d1);
// print_r($data['SYSPVL']);







// $kbnbranch = getDropdownData("BRANCH_KBN");
// if(empty($typeItem)) {
//     $typeItem = $syslogic->getPullDownData('BRANCH_KBN', $_SESSION['LANG']);
//     setDropdownData("BRANCH_KBN", $typeItem);
// }

// $roun_d = getDropdownData("ROUND");
// if(empty($typeboi)) {
//     $typeboi = $syslogic->getPullDownData('ROUND', $_SESSION['LANG']);
//     setDropdownData("ROUND", $typeboi);
// }

// $whtaxtyp = getDropdownData("WHTAXTYP");
// if(empty($whtaxtyp)) {
//     $whtaxtyp = $syslogic->getPullDownData('WHTAXTYP', $_SESSION['LANG']);
//     setDropdownData("WHTAXTYP", $whtaxtyp);
// }

// $unit = getDropdownData("UNIT");
// if(empty($unit)) {
//     $unit = $syslogic->getPullDownData('UNIT', $_SESSION['LANG']);
//     setDropdownData("UNIT", $unit);
// }

// $itemOrder = getDropdownData("ITEM_ORDER");
// if(empty($itemOrder)) {
//     $itemOrder = $syslogic->getPullDownData('ITEM_ORDER', $_SESSION['LANG']);
//     setDropdownData("ITEM_ORDER", $itemOrder);
// }

// $invcalc = getDropdownData("INVCALC_TYPE");
// if(empty($invcalc)) {
//     $invcalc = $syslogic->getPullDownData('INVCALC_TYPE', $_SESSION['LANG']);
//     setDropdownData("INVCALC_TYPE", $invcalc);
// }

function insert() {
    $javaInsrt = new CustomerMaster;
 
    $param = array("CUSTOMERCD" => $_POST['CUSTOMERCD'],
                    "CUSTOMERNAME" => $_POST['CUSTOMERNAME'],
                    "CUSTOMERSHORTNAME" => '',
                    "CUSTOMERSEARCH" => $_POST['CUSTOMERSEARCH'],
                    "CUSTOMERZIPCODE" => '',
                    "CUSTOMERADDR2" => '',
                    "DIRECTCD" => '',
                    "CUSTOMERPWD" => '',
                    "CUSTOMERTRANSPORTTYP" => '',
                    "CUSTOMERCREDITLIMIT" => '',
                    "CUSTOMERTAXTYP" => '',
                    "CUSTOMERTAXRATE" => 0,
                    "STAFFCD" => '',
                    "CMBILLCD" => '',
                    "CUSTOMERSALERULEFLG" => '',
                    "CUSTOMERSETOFFFLG" => $_POST['CUSTOMERSETOFFFLG'],
                    "CUSTOMERBILLTYP" => '',
                    "CUSTOMEREDIFAXTYP" => '',
                    "CUSTOMERRECDAY" => '',
                    "CUSTOMERCOLLECTFLG" => '',
                    "CUSTOMERTRANSFERFLG" => '',
                    "BANKBRANCHCD" => '',
                    "CUSTOMERBILLTERM" => '',
                    "CUSTOMERUNITTYP" => '',
                    "CUSTOMERAMTTYP" => '',
                    "CUSTOMERAMTTAXTYP" => '',
                    "MARKETCD" => '',
                    "FIXSALEPLANDAY" => '',
                    "CUSTOMERTAXCALCTYP" => '',
                    "CUSTOMERADDR3" => '',
                    "CUSTOMERADD01" => '',
                    "CUSTOMERREGDT" =>  str_replace("-", "", $_POST['CUSTOMERREGDT']),
                    "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "CITYCD" => $_POST['CITYCD'],
                    "CITYNAME" => $_POST['CITYNAME'],
                    "CUSTOMERADDR1" => $_POST['CUSTOMERADDR1'],
                    "CUSTOMERTEL" => $_POST['CUSTOMERTEL'],
                    "CUSTOMERFAX" => $_POST['CUSTOMERFAX'],
                    "CUSTOMEREMAIL" => $_POST['CUSTOMEREMAIL'],
                    "CUSTOMERCONTACT" => $_POST['CUSTOMERCONTACT'],
                    "CUSTOMERBKACCNO" => $_POST['CUSTOMERBKACCNO'],
                    "CUSTOMERBKACCTYP" => $_POST['CUSTOMERBKACCTYP'],
                    "CUSTOMERBKACCNAME" => $_POST['CUSTOMERBKACCNAME'],
                    "CUSTOMERUNITROUNDTYP" => $_POST['CUSTOMERUNITROUNDTYP'],
                    "CUSTOMERAMTROUNDTYP" => $_POST['CUSTOMERAMTROUNDTYP'],
                    "CUSTOMERTAXROUNDTYP" => $_POST['CUSTOMERTAXROUNDTYP'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                   
                    "CUSTOMERAFFILIATEFLG" => $_POST['CUSTOMERAFFILIATEFLG'],
                    "CUSTOMERCLOSEDAY" => $_POST['CUSTOMERCLOSEDAY'],
                    "CUSTOMERRECDAY" => $_POST['CUSTOMERRECDAY'],
                    "CUSTOMERREMARK" => $_POST['CUSTOMERREMARK'],                   
                );
 


                
      
       //print_r($param);
      $insert = $javaInsrt->insCustomer($param);
      // echo json_encode($insert);
      unsetSessionData();
}

function update() {
    $javaUpd = new CustomerMaster;
    $param = array("CUSTOMERCD" => $_POST['CUSTOMERCD'],
                    "CUSTOMERNAME" => $_POST['CUSTOMERNAME'],
                    "CUSTOMERSHORTNAME" => '',
                    "CUSTOMERSEARCH" => $_POST['CUSTOMERSEARCH'],
                    "CUSTOMERZIPCODE" => '',
                    "CUSTOMERADDR2" => '',
                    "DIRECTCD" => '',
                    "CUSTOMERPWD" => '',
                    "CUSTOMERTRANSPORTTYP" => '',
                    "CUSTOMERCREDITLIMIT" => '',
                    "CUSTOMERTAXTYP" => '',
                    "CUSTOMERTAXRATE" => 0,
                    "STAFFCD" => '',
                    "CUSTOMERSETOFFFLG" => $_POST['CUSTOMERSETOFFFLG'],
                    "CMBILLCD" => '',
                    "CUSTOMERSALERULEFLG" => '',
                    "CUSTOMERBILLTYP" => '',
                    "CUSTOMEREDIFAXTYP" => '',
                    "CUSTOMERREGDT" =>  str_replace("-", "", $_POST['CUSTOMERREGDT']),
                    "CUSTOMERRECDAY" => '',
                    "CUSTOMERCOLLECTFLG" => '',
                    "CUSTOMERTRANSFERFLG" => '',
                    "BANKBRANCHCD" => '',
                    "CUSTOMERBILLTERM" => '',
                    "CUSTOMERUNITTYP" => '',
                    "CUSTOMERAMTTYP" => '',
                    "CUSTOMERAMTTAXTYP" => '',
                    "MARKETCD" => '',
                    "FIXSALEPLANDAY" => '',
                    "CUSTOMERTAXCALCTYP" => '',
                    "CUSTOMERADDR3" => '',
                    "CUSTOMERADD01" => '',
                    "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "CITYCD" => $_POST['CITYCD'],
                    "CITYNAME" => $_POST['CITYNAME'],
                    "CUSTOMERADDR1" => $_POST['CUSTOMERADDR1'],
                    "CUSTOMERTEL" => $_POST['CUSTOMERTEL'],
                    "CUSTOMERFAX" => $_POST['CUSTOMERFAX'],
                    "CUSTOMEREMAIL" => $_POST['CUSTOMEREMAIL'],
                    "CUSTOMERCONTACT" => $_POST['CUSTOMERCONTACT'],
                    "CUSTOMERBKACCNO" => $_POST['CUSTOMERBKACCNO'],
                    "CUSTOMERBKACCTYP" => $_POST['CUSTOMERBKACCTYP'],
                    "CUSTOMERBKACCNAME" => $_POST['CUSTOMERBKACCNAME'],
                    "CUSTOMERUNITROUNDTYP" => $_POST['CUSTOMERUNITROUNDTYP'],
                    "CUSTOMERAMTROUNDTYP" => $_POST['CUSTOMERAMTROUNDTYP'],
                    "CUSTOMERTAXROUNDTYP" => $_POST['CUSTOMERTAXROUNDTYP'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                   
                    "CUSTOMERAFFILIATEFLG" => $_POST['CUSTOMERAFFILIATEFLG'],
                    "CUSTOMERCLOSEDAY" => $_POST['CUSTOMERCLOSEDAY'],
                    "CUSTOMERRECDAY" => $_POST['CUSTOMERRECDAY'],
                    "CUSTOMERREMARK" => $_POST['CUSTOMERREMARK'],                   
                );
                
             //   print_r($_POST['CUSTOMERREGDT']);
    $update = $javaUpd->updCustomer($param);
//    echo json_encode($update);
     unsetSessionData();
}

function delete() {
    $delfunc = new CustomerMaster;
    $delete = $delfunc->delCustomer($_POST['CUSTOMERCD']);
    // echo json_encode($delete);
    unsetSessionData();
}

function setOldValue() {
    setSessionArray($_POST); 
   // print_r($_POST);
}

function setSessionArray($arr){
    $keepField = array( "CUSTOMERCD", "CUSTOMERNAME", "CUSTOMERSEARCH", "COUNTRYCD", "STATECD", "CITYCD", "CITYNAME", "CUSTOMERADDR1", "CUSTOMERTEL", "CUSTOMERREGDT",
                        "CUSTOMERFAX", "CUSTOMEREMAIL", "CUSTOMERCONTACT", "CUSTOMERBKACCTYP", "CUSTOMERBKACCNO", "CUSTOMERUNITROUNDTYP", "CUSTOMERAMTROUNDTYP", "CUSTOMERTAXROUNDTYP","CUSTOMERBKACCNAME",
                        "CURRENCYCD", "CUSTOMERADD01","CUSTOMERSETOFFFLG", "CUSTOMERAFFILIATEFLG", "CUSTOMERTRANSFERFLG","CUSTOMERCLOSEDAY", "CUSTOMERRECDAY", "CUSTOMERREMARK",
                        
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