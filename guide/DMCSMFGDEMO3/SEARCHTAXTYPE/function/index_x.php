<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode("/", dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
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
// エラーメッセージの初期化
$errorMessage = "";

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php?statecd=';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new TaxCodeIndex;

$TAXTYPESEARCH ='';
$TAXTYPECD ='';
$TAXTYPENAME = '';
$TAXKBN ='';
$VATRATE ='';
$TAXTTL = '';
$minrow = 0;
$maxrow = 10;


if(!empty($_POST)){
   // print_r($excute);

        $data['TAXTYPESEARCH'] = isset($_POST['TAXTYPESEARCH']) ? $_POST['TAXTYPESEARCH']: '';
        $query = $javaFunc->search($data['TAXTYPESEARCH']);
        $data['TAX'] = $query;
        
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

      	print_r($excute);
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

$type = $data['DRPLANG']['TAX02'];
$cate = $data['DRPLANG']['TAXTTL'];

print_r($data['SYSPVL']);
echo "<pre>";
print_r($data['TXTLANG']);
echo "</pre>";
echo "<pre>";
print_r($data['DRPLANG']);
echo "</pre>";

//TAXTYPESEARCH,TAXTYPECD,TAXTYPENAME,TAXKBN,VATRATE,TAXTTL	
function setSessionArray($arr){
    $keepField = array('TAX', 'TAXTYPESEARCH', 'TAXTYPECD', 'TAXTYPENAME', 'TAXKBN', 'VATRATE', 'TAXTTL', 'SYSEN_TAXTYPECD');
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