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
$javaFunc = new CustomerHoldWithTax;
$systemName = strtolower($appcode);
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 8;

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$CUSTOMERCD = '';

if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
        $CUSTOMERCD = $_POST['CUSTOMERCD'];
        
        $query = $javaFunc->search($_POST['CUSTOMERCD']);
        //print_r($query);
        $data['CWH'] = $query;
        // print_r($_POST['STORAGECD_S']);
         //print_r($data['ACCF']);
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { Commits(); }
       // if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    $CUSTOMERCD = isset($_GET['CUSTOMERCD']) ? $_GET['CUSTOMERCD']: '';
            
    if(isset($_GET['refresh'])) {
        $query = $javaFunc->search($CUSTOMERCD);
        $data['CWH'] = $query;     
      // print_r($data['ACCF']);  
        setSessionArray($data); 
        
    }

    if(isset($_GET['CUSTOMERCD'])) {
        $query = $javaFunc->getCus($_GET['CUSTOMERCD']);
        // print_r($query);
        if(!empty($query)){
            $data = $query;
        }      
    }

    if(isset($_GET['ACC_CD'])) {
        if(isset($_GET['index']) && $_GET['index'] == 1)
        {
        $query = $javaFunc->getAcc1($_GET['ACC_CD']);
        if(isset($query['ACCNAME1']) && $query['ACCNAME1'] != '')
        {
       $data['ACC_CD1'] = $_GET['ACC_CD'];
       $data['ACCNAME1'] = $query['ACCNAME1'];
         
        } 
        else{
            $data['ACC_CD1'] = '';  
            $data['ACCNAME1'] = '';  
        }
      // $data['ACCNAME1'] = $query['ACCNAME1'];   
        //print_r($query);      
        }
       if(isset($_GET['index']) && $_GET['index']==2)
        {
        $query = $javaFunc->getAcc2($_GET['ACC_CD']);
        if(isset($query['ACCNAME2']) && $query['ACCNAME2'] != '')
        {
       $data['ACC_CD2'] = $_GET['ACC_CD'];
       $data['ACCNAME2'] = $query['ACCNAME2'];
         
        } 
        else{
            $data['ACC_CD2'] = '';  
            $data['ACCNAME2'] = '';  
        }
                
        }
          if(isset($_GET['index']) && $_GET['index']==3)
        {
        $query = $javaFunc->getAcc3($_GET['ACC_CD']);

        if(isset($query['ACCNAME3']) && $query['ACCNAME3'] != '')
        {
       $data['ACC_CD3'] = $_GET['ACC_CD'];
       $data['ACCNAME3'] = $query['ACCNAME3'];
         
        } 
        else{
            $data['ACC_CD2'] = '';  
            $data['ACCNAME3'] = '';  
        }          
        }
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
$whtaxtype = $data['DRPLANG']['WHTAXTYP'];
//  $data = getSessionData(); 

// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//

function Commits() {
    $javaInsrt = new CustomerHoldWithTax;
    $Param = array("CUSTOMERCD" => $_POST['CUSTOMERCD'],
                    "WHTAXTYPE" => $_POST['WHTAXTYPE'],
                    "ACC_CD1" => $_POST['ACC_CD1'],
                    "ACC_CD2" => $_POST['ACC_CD2'],
                    "ACC_CD3" => $_POST['ACC_CD3'],
                   );
    $insert = $javaInsrt->Commits($Param);
    unsetSessionData();
    echo json_encode($insert);
}
// ACCIFCDID


function deletes() {
    
    $javaDel = new CustomerHoldWithTax;    
    $Param = array("CUSTOMERCD" => $_POST['CUSTOMERCD'],"WHTAXTYPE" => $_POST['WHTAXTYPE'],"ACCCD1" => $_POST['ACCCD1'],"ACCCD2" => $_POST['ACCCD2']
    ,"ACCCD3" => $_POST['ACCCD3']);
    $deletes = $javaDel->delWhtmethod($Param);   
    unsetSessionData();
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
    $keepField = array('CWH','CUSTOMERCD','CUSTOMERNAME', 'ACC_CD1', 'ACC_CD2','ACC_CD3','ACCNAME1','ACCNAME2','ACCNAME3','WHTAXTYPE', 'SYSPVL', 'TXTLANG', 'DRPLANG');
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