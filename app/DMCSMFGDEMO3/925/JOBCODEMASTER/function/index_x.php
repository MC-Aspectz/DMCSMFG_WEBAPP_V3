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
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = "";
//--------------------------------------------------------------------------------
//  LANGUAGE
// if (isset($_SESSION['LANG'])) {
//     require_once('./lang/' . strtolower($_SESSION['LANG']) . '.php');
// } else {  
//     require_once('./lang/en.php');
// }
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

// if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
//
// 
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 

$javaFunc = new JobCodeMaster;
$data = array();
$systemName = 'JobCodeMaster';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 5;
$rowno = 0;

$DVWJOBCODE = '';
$JOBCDS ='';
$JOBTYPES = '';
$JOBCD = '';
$JOBNAME = '';
$JOBTYPE = '';
$JOBGROUP = '';
$readonly ='';

if(!empty($_POST)) {

   if(isset($_POST['search'])) {

        $data['JOBCDS'] = isset($_POST['JOBCDS']) ? $_POST['JOBCDS']: '';
        $data['JOBTYPES'] = isset($_POST['JOBTYPES']) ? $_POST['JOBTYPES']: '';


        $query = $javaFunc->search($_POST['JOBCDS'],$_POST['JOBTYPES']);
        $data['JC'] = $query;
      
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) {
             $data = getSessionData(); 
        }

        // print_r($data);
    }

    if (isset($_POST['action'])) {

        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "commit") { commit();  }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "modify") { modify(); print_r("kkkkk");}
        if ($_POST['action'] == "unsetItemData") {  unsetItemData($_POST['lineIndex']); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $JOBCDS = isset($data['JOBCDS']) ? $data['JOBCDS']: '';
        $JOBTYPES = isset($data['JOBTYPES']) ? $data['JOBTYPES']: '';
        
        $query = $javaFunc->search($JOBCDS,$JOBTYPES);
        $data['JC'] = $query;
        setSessionArray($data); 

    }

    //onchange JOBCD
    else if(isset($_GET['JOBCD']) ) {

        unsetSessionkey('JOBCD');
        unsetSessionkey('JOBNAME');
        
        $data['JOBCD'] = isset($_GET['JOBCD']) ? $_GET['JOBCD']: '';
        $excute = $javaFunc->get($_GET['JOBCD']);//<< don't have getCT

        $data = $excute;
            

    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('7');
    }
    // print_r($data);
}

// ------------------------- CALL Langauge AND Privilege -------------------//
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

$type1 = $data['DRPLANG']['JOBTYPE_1'];
$type2 = $data['DRPLANG']['JOB_KBN'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


//JOBCDS,JOBCD,JOBNAME
function commit() {
    echo("This is commit in index_x");
    $javaInsrt = new JobCodeMaster;
    $Param = array();
    // JOBCD#TBCOL#JOBNAME#TBCOL#JOBTYPE#TBCOL#JOBGROUP
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) {
        $RowParam[] = array(
                            // 'ROWNO' => $i+1,
                            'JOBCD' => $_POST['JOBCDA'][$i],
                            'JOBNAME' => $_POST['JOBNAMEA'][$i],
                            'JOBTYPE' => $_POST['JOBTYPEA'][$i],
                            'JOBGROUP' => $_POST['JOBGROUPA'][$i],
                          );
    }

    print_r($RowParam);

    $Param = array( 'JOBCDS' => $_POST['JOBCDS'],
                    'JOBTYPES' => $_POST['JOBTYPES'],
                    'DATA' => $RowParam);
        echo json_encode($Param);
        // print_r($Param);
    $commit = $javaInsrt->commit($Param);
 
    unsetSessionData();
    echo json_encode($commit);

}

//JOBCDS,JOBTYOES
function setSessionArray($arr){
    $keepField = array('JC', 'JOBCD', 'JOBNAME','JOBTYPE','JOBGROUP');
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

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function modify() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['JC'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'JOBCD' => $_POST['JOBCDA'][$i],
                                    'JOBNAME' => $_POST['JOBNAMEA'][$i],
                                    'JOBTYPE' => $_POST['JOBTYPEA'][$i],
                                    'JOBGROUP' => $_POST['JOBGROUPA'][$i],
                                );
    }
    print_r($data);
    setSessionArray($data);
    // print_r($data['JC']);
}

function unsetItemData($lineIndex = "") { 
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'JC', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['JC']));
    $data['JC'] = array_combine(range(1, count($data['JC'])), array_values($data['JC']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['JC']);
}


?>