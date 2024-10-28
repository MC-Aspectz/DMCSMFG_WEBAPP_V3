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


$systemName = 'StaffMaster';
$data = array();
$STAFFCD = '';
$DIVISIONCD = '';


if(!empty($_GET)) {
    $javaFunc = new StaffMaster;

   // if(checkSessionData()) { $data = getSessionData(); } 
   
        if(isset($_GET['staffcd'])) {
        $query = $javaFunc->getStaff($_GET['staffcd']);
        $data = $query;
      //  print_r($query);
      if(!empty($query)) { setSessionData('isInsert', 'off'); } else { setSessionData('isInsert', 'on'); }
        }
      


      if(isset($_GET['divisioncd'])) {
        $data['DIVISIONCD']  = isset($_GET['divisioncd']) ? $_GET['divisioncd']: '';
        $excute = $javaFunc->getDivison($data['DIVISIONCD']);
        $data = $excute;      
        setSessionArray($data);    
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
    if ($_POST['action'] == "photo") { setImage(); }
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
//$data['DRPLANG'] = get_sys_dropdown($loadApp);
// print_r($data['SYSPVL']);


function insert() {
    $javaInsrt = new StaffMaster;
 
    $param = array("STAFFCD" => $_POST['STAFFCD'],
                    "STAFFNAME" => $_POST['STAFFNAME'],
                    "STAFFSPELL" => $_POST['STAFFSPELL'],
                    "DIVISIONCD" => $_POST['DIVISIONCD'],
                    "STAFFSEX" => $_POST['STAFFSEX'],
                    "STAFFBLOODTYP" => '',
                    "STAFFBLOODRH" => '',
                    "STAFFADDR1" => $_POST['STAFFADDR1'],
                    "STAFFADDR2" => $_POST['STAFFADDR2'],
                    "STAFFZIPCODE" => '',
                    "STAFFSTARTDT" =>  str_replace("-", "", $_POST['STAFFSTARTDT']),
                    "STAFFRETIREDT" =>  str_replace("-", "", $_POST['STAFFRETIREDT']),
                    "STAFFTEL" => $_POST['STAFFTEL'],
                    "STAFFMOB" => $_POST['STAFFMOB'],
                    "STAFFFAX" => $_POST['STAFFFAX'],
                    "STAFFEMAIL" => $_POST['STAFFEMAIL'],
                    "STAFFTITLE" => $_POST['STAFFTITLE'],
                    "STAFFAUTHTYP" => '',
                    "STAFFPWD" => $_POST['STAFFPWD'],
                    "STAFFREM" => $_POST['STAFFREM'],
                    "SALEDIVCD" => '',
                    "STAFFDOB" => '',
                    "STAFFIMGLOC" => $_POST['STAFFIMGLOC'],
                    "STAFFDESIGNMODFLG" => $_POST['STAFFDESIGNMODFLG'],
                    "MAC1" => '',                  
                    "MAC2" => '',
                    "MAC3" => '',                               
                );
  
       //print_r($param);
      $insert = $javaInsrt->insStaff($param);
      // echo json_encode($insert);
      unsetSessionData();
}

            function update() {
                $javaUpd = new StaffMaster;
                $param = array("STAFFCD" => $_POST['STAFFCD'],
                "STAFFNAME" => $_POST['STAFFNAME'],
                "STAFFSPELL" => $_POST['STAFFSPELL'],
                "DIVISIONCD" => $_POST['DIVISIONCD'],
                "STAFFSEX" => $_POST['STAFFSEX'],
                "STAFFBLOODTYP" => '',
                "STAFFBLOODRH" => '',
                "STAFFADDR1" => $_POST['STAFFADDR1'],
                "STAFFADDR2" => $_POST['STAFFADDR2'],
                "STAFFZIPCODE" => '',
                "STAFFSTARTDT" =>  str_replace("-", "", $_POST['STAFFSTARTDT']),
                "STAFFRETIREDT" =>  str_replace("-", "", $_POST['STAFFRETIREDT']),
                "STAFFTEL" => $_POST['STAFFTEL'],
                "STAFFMOB" => $_POST['STAFFMOB'],
                "STAFFFAX" => $_POST['STAFFFAX'],
                "STAFFEMAIL" => $_POST['STAFFEMAIL'],
                "STAFFTITLE" => $_POST['STAFFTITLE'],
                "STAFFAUTHTYP" => '',
                "STAFFPWD" => $_POST['STAFFPWD'],
                "STAFFREM" => $_POST['STAFFREM'],
                "SALEDIVCD" => '',
                "STAFFDOB" => '',
                "STAFFIMGLOC" => $_POST['STAFFIMGLOC'],
                "STAFFDESIGNMODFLG" => $_POST['STAFFDESIGNMODFLG'],
                "MAC1" => '',                  
                "MAC2" => '',
                "MAC3" => '',);                            
                
                
             //   print_r($_POST['CUSTOMERREGDT']);
    $update = $javaUpd->updStaff($param);
//    echo json_encode($update);
     unsetSessionData();
    
}

function delete() {
    $delfunc = new StaffMaster;
    $delete = $delfunc->delStaff($_POST['STAFFCD']);
    // echo json_encode($delete);
    unsetSessionData();
}

function setOldValue() {
    setSessionArray($_POST); 
   // print_r($_POST);
}

function setImage() {
   // $_POST['STAFFIMGLOC'] ='test';
   print('ddd');
    
   // print_r($_POST);
}

function setSessionArray($arr){
    $keepField = array( "MYFILE","STAFFCD", "STAFFNAME","STAFFPWD","STAFFSPELL", "DIVISIONCD", "DIVISIONNAME", "STAFFDESIGNMODFLG", "STAFFADDR1", "STAFFADDR2", "STAFFTEL", "STAFFFAX", "STAFFMOB",
                        "STAFFEMAIL", "STAFFSTARTDT", "STAFFRETIREDT", "STAFFTITLE", "STAFFREM", "STAFFIMGLOC","SYSPVL", "TXTLANG", "DRPLANG",
                        
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