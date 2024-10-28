<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode('/', dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$logicFunc = new MANUFACTURINGPLAN;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------

if(!empty($_GET)) {
    // 
}

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
	if (isset($_POST['action'])) {
	    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
	    if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'ITEMCODE') { getItem(); }
        if ($_POST['action'] == 'SEARCH') { search(); }
        if ($_POST['action'] == 'commit') { commitAll();}
	}
}
// 
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// $statusorder = $data['DRPLANG']['STATUS_ORDER'];
$FACTORY = $data['DRPLANG']['FACTORY'];
$UNIT = $data['DRPLANG']['UNIT'];
$BMVERSION = $data['DRPLANG']['BMVERSION'];
// $data['MANUPLANCOMB'] = 0;
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getItem() {
    $javafunc = new MANUFACTURINGPLAN;
    $ITEMCODE = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
    $query = $javafunc->getItem($ITEMCODE);
    setSessionArray($query);
    echo json_encode($query);
}

function search() {
    $data['ITEM'] = array();
    $javafunc = new MANUFACTURINGPLAN;
    $ITEMCODE = isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '';
    $query = $javafunc->search($ITEMCODE);
    if(!empty($query)) { $data['ITEM'] = $query; }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}  

function commitAll() {
    $logicFunc = new MANUFACTURINGPLAN;
    $RowParam = [];
    if(!empty($_POST['ROWNOA'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNOA'][$i]) ? $_POST['ROWNOA'][$i]: '',
                                'MANUFACTURINGPLANCODE' => isset($_POST['MANUFACTURINGPLANCODEA'][$i]) ? $_POST['MANUFACTURINGPLANCODEA'][$i]: '',
                                'MANUFACTURINGPLANQTY' => isset($_POST['MANUFACTURINGPLANQTYA'][$i]) ? implode(explode(',', $_POST['MANUFACTURINGPLANQTYA'][$i])): '',
                                'MANUFACTURINGPLANDUEDATE' => isset($_POST['MANUFACTURINGPLANDUEDATEA'][$i]) ? str_replace('/', '', $_POST['MANUFACTURINGPLANDUEDATEA'][$i]): '',
                                'MANUFACTURINGPLANNOTE' => isset($_POST['MANUFACTURINGPLANNOTEA'][$i]) ? $_POST['MANUFACTURINGPLANNOTEA'][$i]: '',
                                'DIVISIONTYP' => isset($_POST['DIVISIONTYPA'][$i]) ? $_POST['DIVISIONTYPA'][$i]: '',
                                'MANUPLANMAKETYP' => isset($_POST['MANUPLANMAKETYPA'][$i]) ? $_POST['MANUPLANMAKETYPA'][$i]: '',
                                'MANUPLANCOMB' => isset($_POST['MANUPLANCOMBA'][$i]) ? $_POST['MANUPLANCOMBA'][$i]: '' );
        }
    }
    // print_r($RowParam);
    $Param = array( 'ITEMCODE' => isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '',
                    'DATA' => $RowParam);
    // print_r($Param);
    $commit = $logicFunc->commitAll($Param);
    unsetSessionData();
    echo json_encode($commit);
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('MANUFACTURINGPLANCODE' => $_POST['MANUFACTURINGPLANCODEA'][$i],
                                    'MANUFACTURINGPLANQTY' => $_POST['MANUFACTURINGPLANQTYA'][$i],
                                    'MANUFACTURINGPLANDUEDATE' => $_POST['MANUFACTURINGPLANDUEDATEA'][$i],
                                    'MANUFACTURINGPLANNOTE' => $_POST['MANUFACTURINGPLANNOTEA'][$i],
                                    'DIVISIONTYP' => $_POST['DIVISIONTYPA'][$i],
                                    'MANUPLANMAKETYP' => $_POST['MANUPLANMAKETYPA'][$i],
                                    'MANUPLANCOMB' => $_POST['MANUPLANCOMBA'][$i],
        );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
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

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'DVWDETAIL', 'ITEM','ROWNO','ITEMCODE','ITEMNAME','ITEMUNIT',
    'MANUPLANMAKETYP','MANUFACTURINGPLANCODE','DIVISIONTYP','MANUFACTURINGPLANQTY','MANUFACTURINGPLANDUEDATE','MANUPLANCOMB','MANUFACTURINGPLANNOTE',
    'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL','SYSVIS_PROPATTERNLBL','SYSVIS_ITEMPROPTNCD','SYSVIS_PROPTNNAME','SYSVIS_REMAKE');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
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

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}

function setSessionKey($key, $value) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    $_SESSION[$sysnm][$key] = $value;
}


function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function unsetItemData($lineIndex = '') { 
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}
?>