<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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

$systemName = strtolower($appcode);
$javaFunc = new AssetMaster;

$data = array();
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 15;




//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
//$AFFILIATEFLG ='';
//$ACC_GPS = '';

if(!empty($_POST)) {

    
    if(isset($_POST['search'])) {
        
        $query = $javaFunc->search();

        $data['ASSMAS'] = $query;

        if(!empty($query)) {;
            setSessionArray($data);
        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }
    }

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

if(checkSessionData()) { 
    $data = getSessionData(); 
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    $javaFunc = new AssetMaster;
    if(isset($_GET['refresh'])) {
        $query = $javaFunc->search();
        $data['ASSMAS'] = $query;
        print_r("search get");

        // print_r($data['ACCSET']);
       // print_r($data['AFFILIATEFLG']);
        
        setSessionArray($data); 
        
    }

   
    if(isset($_GET['checkasacc']))
    {
        //$data['ASSETACCOUNT']  = isset($_GET['acccode']) ? $_GET['acccode']: '';
    $query = $javaFunc->CheckAssetAcc($_GET['checkasacc']);
    $data = $query;
    //print_r($data);
    // $data['ASSETACCOUNT'] = $query['ASSETACCOUNT'];
    // $data['ASSETACCOUNTNM'] = $query['ASSETACCOUNTNM'];
    }

   
    if(isset($_GET['acccode'])) {
        //Syslogic(get_accd1)
        if(isset($_GET['index']) && $_GET['index']==1)
        {
           // $data['ASSETACCOUNT']  = isset($_GET['acccode']) ? $_GET['acccode']: '';
        $query = $javaFunc->get_accd1($_GET['acccode']);
        if(isset($query['ASSETACCOUNTNM']) && $query['ASSETACCOUNTNM'] != '')
        {
       $data['ASSETACCOUNT'] = $_GET['acccode'];
       $data['ASSETACCOUNTNM'] = $query['ASSETACCOUNTNM'];
         
        } 
        else{
            $data['ASSETACCOUNT'] = '';  
            $data['ASSETACCOUNTNM'] = '';  
        }



    //    $data = $query;
        // $data['ASSETACCOUNT'] = $query['ASSETACCOUNT'];
        // $data['ASSETACCOUNTNM'] = $query['ASSETACCOUNTNM'];
        }

  if (isset($_GET['index']) && $_GET['index']==2)
        {
            
           // $data['DEPLECIATION']  = isset($_GET['acccode']) ? $_GET['acccode']: '';
            $query = $javaFunc->get_accd2($_GET['acccode']);
            if(isset($query['DEPLECIATIONNM']) && $query['DEPLECIATIONNM'] != '')
            {
           $data['DEPLECIATION'] = $_GET['acccode'];
           $data['DEPLECIATIONNM'] = $query['DEPLECIATIONNM'];
             
            } 
            else{
                $data['DEPLECIATION'] = '';  
                $data['DEPLECIATIONNM'] = '';  
            }
        }

        if (isset($_GET['index']) && $_GET['index']==3)
        {
            //$data['ACCUMULATED']  = isset($_GET['acccode']) ? $_GET['acccode']: '';
            $query = $javaFunc->get_accd3($_GET['acccode']);
            if(isset($query['ACCUMULATEDNM']) && $query['ACCUMULATEDNM'] != '')
            {
           $data['ACCUMULATED'] = $_GET['acccode'];
           $data['ACCUMULATEDNM'] = $query['ACCUMULATEDNM'];
             
            } 
            else{
                $data['ACCUMULATED'] = '';  
                $data['ACCUMULATEDNM'] = '';  
            }
        }
        //setSessionArray($data); 
             
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
//print_r($data['TXTLANG']);
// $acc01 = $data['DRPLANG']['ACC01'];
// $taisyakul = $data['DRPLANG']['TAISYAKU'];
// $ACC01S = $data['DRPLANG']['ACC01'];







//  $data = getSessionData(); 



function insert() {
    $javaInsrt = new AssetMaster;
    $Param = array("ASSETACCCD" => $_POST['ASSETACCCD'],
                    "NAME_C" => $_POST['NAME_C'],"NAME_E" => $_POST['NAME_E'],
                    "ASSETACCOUNT" => $_POST['ASSETACCOUNT'],"DEPLECIATION" => $_POST['DEPLECIATION'],
                    "ACCUMULATED" => $_POST['ACCUMULATED']);
    $insert = $javaInsrt->insAssMaster($Param);
    print_r($insert);
    unsetSessionData();
    echo json_encode($insert);
}
// ACCIFCDID
function update() {
    $javaUpd = new AssetMaster;
  //  $keydata
        $Param = array("ASSETACCCD" => $_POST['ASSETACCCD'],
        "NAME_C" => $_POST['NAME_C'],"NAME_E" => $_POST['NAME_E'],
        "ASSETACCOUNT" => $_POST['ASSETACCOUNT'],"DEPLECIATION" => $_POST['DEPLECIATION'],
        "ACCUMULATED" => $_POST['ACCUMULATED']);                
    $update = $javaUpd->updAssMaster($Param);
    unsetSessionData();
    //print_r($_POST['AFFILIATEFLG']);
    echo json_encode($update);
}

function deletes() {
    
    $javaDel = new AssetMaster;    
    $Param = array("ASSETACCCD" => $_POST['ASSETACCCD']);
    $deletes = $javaDel->delAssMaster($Param);   
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
    $keepField = array('ASSMAS','ASSETACCCD','NAME_C','NAME_E','ASSETACCOUNT' ,'ASSETACCOUNTNM', 'DEPLECIATION','DEPLECIATIONNM','ACCUMULATED', 'ACCUMULATEDNM','SYSPVL', 'TXTLANG', 'DRPLANG');
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