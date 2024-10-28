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
    //  LANGUAGE
    if (isset($_SESSION['LANG'])) {
        // require_once(dirname(__FILE__, 2). '/lang/jp.php');
        require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
    } else {  
        require_once(dirname(__FILE__, 2).'/lang/en.php');
    }
    $systemName = strtolower($appcode);
    $javaFunc = new ASSETDEPLISTPRINT;
    $data = array();
   
    if(!empty($_GET)) {
        // unsetSessionData();
         $javaFunc = new ASSETDEPLISTPRINT;
        

         if(isset($_GET['ASSETACC'])) {
            if(isset($_GET['index']) && $_GET['index']==1)
            {
            $query = $javaFunc->getAssetGName1($_GET['ASSETACC']);
            if(isset($query['GANAME1']) && $query['GANAME1'] != '')
            {
           $data['GA1'] = $_GET['ASSETACC'];
           $data['GANAME1'] = $query['GANAME1'];
          
            } 
            else{
                $data['GA1'] = '';  
                $data['GANAME1'] = '';  
            }
          // $data['ACCNAME1'] = $query['ACCNAME1'];   
            //print_r($query);      
            }
           if(isset($_GET['index']) && $_GET['index']==2)
            {
            $query = $javaFunc->getAssetGName2($_GET['ASSETACC']);
            if(isset($query['GANAME2']) && $query['GANAME2'] != '')
            {
           $data['GA2'] = $_GET['ASSETACC'];
           $data['GANAME2'] = $query['GANAME2'];
             
            } 
            else{
                $data['GA2'] = '';  
                $data['GANAME2'] = '';  
            }
                    
            }
          
        }

       
        

        if(!empty($query)) {
            setSessionArray($data); 
            // if(checkSessionData()) { $data = getSessionData(); } 
        }
    
        if(checkSessionData()) { $data = getSessionData(); } 
    }

    if(!empty($_POST)) {

        $data['YEAR'] = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
        print_r($data['YEAR']);

        //if(!empty($query)) {
            setSessionArray($data); 
        //}
        if(checkSessionData()) { $data = getSessionData(); }
        //if(checkSessionData()) { $data = getSessionData(); }

        //setSessionArray($data); 
        //print_r($data['YEAR']);

        
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
       
        //if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "print") { Print1(); }
      //  if ($_POST['action'] == "delete") { delete(); }
    }
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


//inv.ClearanceMonthUpdate.load

//print_r($data['CMU']);
//print_r($STARTDATE1);

if(checkSessionData()) { $data = getSessionData(); }



$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$yearvalue = $data['DRPLANG']['YEARVALUE'];

//$data['GROUPRT'] = $loadevent['GROUPRT'];

function Print1() {
    $javaRun = new ASSETDEPLISTPRINT;
    
    $data['YEAR'] = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
    $data['GA1'] = isset($_POST['GA1']) ? $_POST['GA1']: '';          
    $data['GA2'] = isset($_POST['GA2']) ? $_POST['GA2']: '';
   // $RunMonthlydeprec = $javaRun->RunMonthlydeprec($param);
  //  $data['DATA'] = $RunMonthlydeprec;
  setSessionArray($data);
    //Test();
    // $data  =$RunMonthlydeprec;
   // print_r($data['YEAR']);
    // setSessionArray($data); 
   // print_r($data['YEAR']);
//    echo json_encode($update);
     //unsetSessionData();
}






function PrintAssetDepreciationList() {
     global $data;
     $data = getSessionData();
    
   
    $printfunc = new ASSETDEPLISTPRINT;
  
    $Param = array("YEAR" => isset($_POST['YEAR']) ? $_POST['YEAR']: '',"GA1" => isset($_POST['GA1']) ? $_POST['GA1']: '',
                    "GA2" => isset($_POST['GA2']) ? $_POST['GA2']: ''); 
                    //print_r($data['YEAR']);
                    $printStatic = $printfunc->printStatic($Param);
                    $printDynamic = $printfunc->printDynamic($Param);
                   // print_r($printStatic);
                   print_r($printDynamic);
               //   print_r($data['YEAR']);
                    $data['PRINTSTATIC'] = isset($printStatic) ? $printStatic: '';
                  
                 //   $data['YEAR'] = $_POST['YEAR'];
                   // $data['GA1'] = $_POST['GA1'];
                  // setSessionArray($data);
                    if(!empty($printDynamic)) {
                        for ($i = 1 ; $i <= count($printDynamic); $i++) {
                            $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
                        }
                        setSessionArray($data);
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
    $keepField = array( "TXTLANG","DRPLANG",'YEAR','YEARS',"GA1", "GANAME1", "GA2",'GANAME2','PRINTSTATIC','PRINTDYNAMIC');
                       
                    
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
