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
$javaFunc = new ExchangeRateM;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 13;
$minrowB = 0;
$maxrowB = 5;

$EXDATE = isset($_POST['EXDATE']) ? str_replace("-", "", $_POST['EXDATE']):'';
 //$EXRATETO = '';
// $EXDATE = '12';
 //print_r($EXDATE);
 $EXRATETO = isset($_POST['EXRATETODISPH']) ? $_POST['EXRATETODISPH'] :'';

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $query = $javaFunc->SearchExc($EXDATE,$EXRATETO);
        $data['DET'] = $query;  
        setSessionArray($data); 
    }  // if(isset($_GET['refresh'])) {



        if(isset($_GET['currencycd'])) 
        {
    
            getCurFm();
        
        }






    if(checkSessionData()) { $data = getSessionData(); }

}  // if(!empty($_GET)) {

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
// print_r($syspvl);
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}
$data['SYSPVL'] = $syspvl;

$loadApp = getSystemData($_SESSION['APPCODE']);
// print_r($loadApp);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$Excrate = $javaFunc->Load();
$data['LD'] = $Excrate;
$data['EXRATETODISPH'] = $Excrate['EXRATETODISPH'];
$data['EXRATETO'] = $Excrate['EXRATETO'];
// print_r($Excrate);
if(!empty($Excrate)) {
    setSessionArray($data);  
}

$SearchCurrent = $javaFunc->SearchCurrent();
// print_r($SearchCurrent);
$data['CUR'] = $SearchCurrent;
//print_r($data['CUR']);
if(!empty($SearchCurrent)) {
    setSessionArray($data);  
}

if(checkSessionData()) { $data = getSessionData(); }
// --------------------------------------------------------------------------//

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {




    if(isset($_POST['SEARCH'])) {
        
        $EXDATE =  str_replace("-", "", $_POST['EXDATE']);
       $EXRATETO =  $_POST['EXRATETO'];
      


        $query = $javaFunc->SearchExc($EXDATE,$EXRATETO);
        $data['DET'] = $query;

        $data['EXDATE'] = str_replace("-", "", $_POST['EXDATE']);
        $data['EXRATETO'] = $_POST['EXRATETO'];
    
            setSessionArray($data);  
         
        if(checkSessionData()) { $data = getSessionData(); }
    }






    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }  
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "search") { search(); }
        if ($_POST['action'] == "getCurFm") { getCurFm(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
    }
}
//--------------------------------------------------------------------------------

function search() {


}

function getCurFm() {
    global $data;
    $data = getSessionData();
    $excfunc = new ExchangeRateM;
    if(isset($_GET['currencycd'])) {
        $data['EXRATEFR'] = isset($_GET['currencycd']) ? $_GET['currencycd']: '';
    }
     else {
        $data['EXRATEFR'] = isset($_POST['EXRATEFR']) ? $_POST['EXRATEFR']: '';   
    }
    $EXRATETO = isset($data['EXRATETO']) ? $data['EXRATETO']:'';
    $EXDATE = isset($data['EXDATE']) ? str_replace("-", "", $data['EXDATE']):'';
    // print_r($EXRATETO);
    // print_r($EXDATE);
    // print_r($data['EXRATEFR']);
    //print_r($EXDATE);
    $query = $excfunc->getCurFm($data['EXRATEFR'],$EXRATETO,$EXDATE);
    $data = $query;
    // $data['EXRATEFR']= $query['EXRATEFR'];
    // $data['EXRATEFRDISP']= $query['EXRATEFRDISP'];
    // $data['EXRATE']= $query['EXRATE'];
    //$data['SYSVIS_INS']= $query['SYSVIS_INS'];
    // print_r($query);
    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(isset($_GET['currencycd'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function insert() {
    $javaInsrt = new ExchangeRateM;
    $EXDATES = str_replace("-", "", $_POST['EXDATE']);
    $Param = array("EXDATE" => $EXDATES,"EXRATEFR" => $_POST['EXRATEFR'],"EXRATETO" => $_POST['EXRATETO'],
    "EXRATE" => $_POST['EXRATE']);
    $insert = $javaInsrt->insExc($Param);
    unsetSessionData();
    echo json_encode($insert);
}

function update() {
    $javaUpd = new ExchangeRateM;
    $EXDATES = str_replace("-", "", $_POST['EXDATE']);
    $Param = array("EXDATE" => $EXDATES,"EXRATEFR" => $_POST['EXRATEFR'],"EXRATETO" => $_POST['EXRATETO'],
    "EXRATE" => $_POST['EXRATE']);
    $update = $javaUpd->updExc($Param);
   // unsetSessionData();
    echo json_encode($update);
}

function deletes() {
    
    $javaDel = new ExchangeRateM;
 
   // EXDATE,EXRATEFR,EXRATETO,EXRATE
   $EXDATES = str_replace("-", "", $_POST['EXDATE']);
    $Param = array("EXDATE" => $EXDATES,"EXRATEFR" => $_POST['EXRATEFR'],"EXRATETO" => $_POST['EXRATETO'],
    "EXRATE" => $_POST['EXRATE']);
    $Delete = $javaDel->delExc($Param);   
   // unsetSessionData();
    echo json_encode($Delete);
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



/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG','LD', 'CUR', 'DET','EXDATE','EXRATETO','EXRATETODISPH', 'EXRATEFR', 'EXRATEFRDISP', 'EXRATE','SYSVIS_INS');

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


?>