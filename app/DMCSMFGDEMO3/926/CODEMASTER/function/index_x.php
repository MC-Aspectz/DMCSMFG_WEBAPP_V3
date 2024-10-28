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
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $syslogic->setLoadApp($appcode);
}
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

$javaFunc = new CodeMaster;
$data = array();
$systemName = 'CodeMaster';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;
//CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
$CODEID ='';
$CODEKEY ='';
$CODE = '';
$LANG ='';
$TEXT ='';
$CODEKEY_S = '';
$CODE_S ='';
$LANG_S ='';
$TEXT_S = '';

if(!empty($_POST)) {
//    if(isset($_POST['search'])) {
        $data['CODEKEY_S'] = $_POST['CODEKEY_S'];
        $data['CODE_S'] = $_POST['CODE_S'];
        $data['LANG_S'] = $_POST['LANG_S'];
        $data['TEXT_S'] = $_POST['TEXT_S'];
        // searchCode($CURRENCYCD_S,$CODE_S,$LANG_S,$TEXT_S)
        $query = $javaFunc->searchCode($_POST['CODEKEY_S'],$_POST['CODE_S'],
                                       $_POST['LANG_S'],$_POST['TEXT_S']);
        $data['CM'] = $query;
        // print_r($data['CM']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($CODEKEY_S);
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $CODEKEY_S = isset($data['CODEKEY_S']) ? $data['CODEKEY_S']: '';
        $CODE_S = isset($data['CODE_S']) ? $data['CODE_S']: '';
        $LANG_S = isset($data['LANG_S']) ? $data['LANG_S']: '';
        $TEXT_S = isset($data['TEXT_S']) ? $data['TEXT_S']: '';
        
        $query = $javaFunc->searchCode($CODEKEY_S,$CODE_S,$LANG_S,$TEXT_S);
        $data['CM'] = $query;
        setSessionArray($data); 
    }



    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }


    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('3');
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
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$lang1 = $data['DRPLANG']['LANG'];
$lang2 = $data['DRPLANG']['LANG'];

// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


$lang1 = getDropdownData("LANG");
if(empty($lang1)) {
    $lang1 = $syslogic->getPullDownData('LANG', $_SESSION['LANG']);
    setDropdownData("LANG", $lang1);
}

$lang2 = getDropdownData("LANG");
if(empty($lang2)) {
    $lang2 = $syslogic->getPullDownData('LANG', $_SESSION['LANG']);
    setDropdownData("LANG", $lang2);
}


//CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
function insert() {
    $javaInsrt = new CodeMaster;
    $Param = array( "CODEID" => $_POST['CODEID'],
                    "CODEKEY" => $_POST['CODEKEY'],
                    "CODE" => $_POST['CODE'],
                    "LANG" => $_POST['LANG'],
                    "TEXT" => $_POST['TEXT'],
                    "CODEKEY_S" => $_POST['CODEKEY_S'],
                    "CODE_S" => $_POST['CODE_S'],
                    "LANG_S" => $_POST['LANG_S'],
                    "TEXT_S" => $_POST['TEXT_S']);
// print_r($Param);
    $insert = $javaInsrt->insCode($Param);
    // unsetSessionData();
    unsetSessionkey('CODEKEY');
    unsetSessionkey('CODE');
    unsetSessionkey('LANG');
    unsetSessionkey('TEXT');
    unsetSessionkey('CODEID');

    echo json_encode($insert);
}

//CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
function update() {
    $javaUpd = new CodeMaster;
    $Param = array( "CODEID" => $_POST['CODEID'],
                    "CODEKEY" => $_POST['CODEKEY'],
                    "CODE" => $_POST['CODE'],
                    "LANG" => $_POST['LANG'],
                    "TEXT" => $_POST['TEXT'],
                    "CODEKEY_S" => $_POST['CODEKEY_S'],
                    "CODE_S" => $_POST['CODE_S'],
                    "LANG_S" => $_POST['LANG_S'],
                    "TEXT_S" => $_POST['TEXT_S']);
                    print_r($Param);
    $update = $javaUpd->updCode($Param);
    // unsetSessionData();
    unsetSessionkey('CODEKEY');
    unsetSessionkey('CODE');
    unsetSessionkey('LANG');
    unsetSessionkey('TEXT');
    unsetSessionkey('CODEID');
    echo json_encode($update);

}

//CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
function deletes() {
    $javaDel = new CodeMaster;
    $Param = array( "CODEID" => $_POST['CODEID'],
                    "CODEKEY" => $_POST['CODEKEY'],
                    "CODE" => $_POST['CODE'],
                    "LANG" => $_POST['LANG'],
                    "TEXT" => $_POST['TEXT'],
                    "CODEKEY_S" => $_POST['CODEKEY_S'],
                    "CODE_S" => $_POST['CODE_S'],
                    "LANG_S" => $_POST['LANG_S'],
                    "TEXT_S" => $_POST['TEXT_S']);
    $deletes = $javaDel->delCode($Param);
    // unsetSessionData();
    unsetSessionkey('CODEKEY');
    unsetSessionkey('CODE');
    unsetSessionkey('LANG');
    unsetSessionkey('TEXT');
    unsetSessionkey('CODEID');
    echo json_encode($deletes);
}

//CM,CODEID,CODEKEY,CODE,LANG,TEXT,CODEKEY_S,CODE_S,LANG_S,TEXT_S
function setSessionArray($arr){
    $keepField = array('CM', 'CODEID', 'CODEKEY', 'CODE', 'LANG', 'TEXT', 'CODEKEY_S', 'CODE_S', 'LANG_S', 'TEXT_S');
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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

?>