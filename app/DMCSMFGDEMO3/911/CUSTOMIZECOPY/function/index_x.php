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
        $langs = $_SESSION['LANG'];
    } else {  
        require_once(dirname(__FILE__, 2).'/lang/en.php');
    }
    $systemName = strtolower($appcode);
    $data = array();

    $APPID = '';
    $APPNM = '';
    $NEWAPPID = '';
    $NEWAPPNM = '';
    

    if(!empty($_GET)) {
        // unsetSessionData();
         $javaFunc = new CustomizeCopy;
        
       
         $APPID = isset($_GET['programcd']) ? $_GET['programcd']: '';

         if(isset($_GET['programcd'])) {      
            $query = $javaFunc->getApp($_GET['programcd']);
            $data['APPID'] = $query['APPID'];
            $data['APPNM'] = $query['APPNM'];
         
                        
            //print_r($_GET['programcd'] );
            }
           

        // if(!empty($query)) {
        //     setSessionArray($data); 
        //     // if(checkSessionData()) { $data = getSessionData(); } 
        // }
    
        if(checkSessionData()) { $data = getSessionData(); } 
    }


    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "copys") { CopyApp(); }
        //if ($_POST['action'] == "insert") { insert(); }
        //if ($_POST['action'] == "update") { Updateynp(); }
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






$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);


//$data['GROUPRT'] = $loadevent['GROUPRT'];




//print_r($loadapptest);


    // setSessionArray($data);
    // if(checkSessionData()) { $data = getSessionData(); } 
//print_r($data['company']);


//APPID,NEWAPPID,NEWAPPNM,SERLOGFLG,MANFLG
function CopyApp() {
    $javacopy = new CustomizeCopy;
    $param = array("APPID" => $_POST['APPID'],"NEWAPPID" => $_POST['NEWAPPID'],
    "NEWAPPNM" => $_POST['NEWAPPNM'],"SERLOGFLG" => $_POST['SERLOGFLG'],"MANFLG" => $_POST['MANFLG']);
  //  setSessionArray($_POST); 
  $setacc = $javacopy->COPY($param);
  //print_r($setacc);
       unsetSessionData();
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
    $keepField = array( "TXTLANG","DRPLANG","YEAR","ynp");               
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
