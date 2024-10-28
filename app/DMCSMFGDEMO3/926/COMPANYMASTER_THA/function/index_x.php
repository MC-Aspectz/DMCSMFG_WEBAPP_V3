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
         $javaFunc = new CompanyMaster;
        
        // $loadapptest = $javaFunc->load();
        // $data =$loadapptest;
       // if(checkSessionData()) { $data = getSessionData(); } 
        if(!empty($_GET['countrycd'])) {      
        $query = $javaFunc->getCountrycd($_GET['countrycd']);
        $data['COUNTRYCD'] = $query['COUNTRYCD'];
        $data['COUNTRY'] = $query['COUNTRY'];
     
                    
        print_r( $data['COUNTRYCD'] );
        }
       
    
        
        else if(!empty($_GET['currencycd'])) {
            $query = $javaFunc->getCurrency($_GET['currencycd']);
            $data['CURRENCY'] = $query['CURRENCY']; 
            $data['CURDISP'] = $query['CURDISP'];            
           // print_r($query);
        } 

        if(!empty($query)) {
            setSessionArray($data); 
            // if(checkSessionData()) { $data = getSessionData(); } 
        }
    
        if(checkSessionData()) { $data = getSessionData(); } 
    }


    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "setaccyear") { SETACCYEARVAL(); }
        //if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { Updatecomp(); }
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

$javaloadapp = new CompanyMaster;
$loadapptest = getSystemData($_SESSION['APPCODE']."comp");
if(empty($loadapptest)) {
    $loadapptest = $javaloadapp->load();
    //setSystemData($_SESSION['APPCODE']."comp", $loadapptest);
} 

    // $javaloadapp = new CompanyMaster;
    // $loadapptest = $javaloadapp->load();
    // $data =$loadapptest;

$data['cpn']=$loadapptest ;



$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
//$data['GROUPRT'] = $loadevent['GROUPRT'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];




//print_r($loadapptest);


    // setSessionArray($data);
    // if(checkSessionData()) { $data = getSessionData(); } 
//print_r($data['company']);

function SETACCYEARVAL() {
    $javasetaccyear = new CompanyMaster;
    $param = array("M_SET" => $_POST['M_SET'],);
  //  setSessionArray($_POST); 
  $setacc = $javasetaccyear->SETACCYEARVAL($param);
  //print_r($setacc);
    //   unsetSessionData();
}


function Updatecomp() {
    $javaUpd = new CompanyMaster;
    $param = array("NAME" => $_POST['NAME'],
                    "KANA" => $_POST['KANA'],
                    "POSTCODE" => $_POST['POSTCD'],
                    "ADDR1" => $_POST['ADDR1'],
                    "ADDR2" => $_POST['ADDR2'],
                    "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "COUNTRY" => $_POST['COUNTRY'],
                    "HPADDR" => $_POST['HPADDR'],
                    "TEL" => $_POST['TEL'], 
                    "FAX" => $_POST['FAX'],
                    "REPRESENTATIVE" => $_POST['REPRESENTATIVE'],
                    "REP_NAME" => $_POST['REP_NAME'],
                    "M_SET" => $_POST['M_SET'], 
                    "D_SET" => $_POST['D_SET'],
                    "CURRENCY" => $_POST['CURRENCYCD'],
                    "EMPLOYEE_NUM" => $_POST['EMPLOYEE_NUM'],
                    "CAPITAL" => $_POST['CAPITAL'],  
                    "ACCURACY" => $_POST['ACCURACY'],
                    "LOGIN_MG" => '', 
                    "FOB4" => $_POST['FOB4'],
                    "COMBRANCH" => $_POST['COMBRANCH'],
                                                   
                );
                
             //   print_r($_POST['CUSTOMERREGDT']);
    $Updatecomp = $javaUpd->Updatecomp($param);
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
    $keepField = array( "TXTLANG","DRPLANG","NAME", "KANA", "POSTCODE", "ADDR1", "ADDR2", "HPADDR", "TEL", "FAX", "REPRESENTATIVE", "REP_NAME",
                        "M_SET", "D_SET", "CURRENCY","CURDISP", "EMPLOYEE_NUM", "CAPITAL", "COUNTRYCD","FOB4","COUNTRY", "COUNTRYCODE", "ACC_FOB4","COMBRANCH","cpn",
                       
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
