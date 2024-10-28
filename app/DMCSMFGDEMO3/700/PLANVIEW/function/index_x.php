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
$logicFunc = new PLANVIEW;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 19;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    if(!empty($_GET['ITEMCODE'])) {
        
        unsetSessionData();
        $Param = array('ITEMCODE' => $_GET['ITEMCODE'],
                       'FACTORYCODE' => isset($data['FACTORYCODE']) ? $data['FACTORYCODE']: '');
        $query = $logicFunc->getItem($Param);
  
        // print_r($query);
        if(!empty($query)) {
            $data = $query;
            $excute = $logicFunc->view($Param);
            if(!empty($excute)) {
                $data['ITEM'] = $excute;
            }
            // print_r($excute);
        }
        // print_r($query);

    }
    if(!empty($query)) {
        setSessionArray($data);
    } 

    if(checkSessionData()) { $data = getSessionData(); }

}
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
	if (isset($_POST['action'])) {
	    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
	    if ($_POST['action'] == 'keepdata') { setOldValue();}
        if ($_POST['action'] == 'ITEMCODE') { getItem(); }
        if ($_POST['action'] == 'PRODUCTIONPLAN') { actionReport(); }
	}
	if(isset($_POST['SEARCH'])) { actionReport(); }
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
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// $statusorder = $data['DRPLANG']['STATUS_ORDER'];
$clear = $data['DRPLANG']['CLEAR'];
$factory = $data['DRPLANG']['FACTORY'];
$unit = $data['DRPLANG']['UNIT'];
$itemorder = $data['DRPLANG']['ITEM_ORDER'];
$PRODUCTIONPLANTYPE = $data['DRPLANG']['PRODUCTIONPLANTYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getItem() {
    $javafunc = new PLANVIEW;
    $Param = array('ITEMCODE' => isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '',
                   'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '');
    $query = $javafunc->getItem($Param);
    if(is_array($query)) {
        $data = $query;
    } else {
        $data = array(  'ITEMCODE' => '',
                        'ITEMNAME' => '',
                        'ITEMSPEC' => '',
                        'ITEMDRAWNUMBER' => '',
                        'ITEMUNIT' => '',
                        'ITEMLEADTIME' => '',
                        'ITEMORDERROT' => '',
                        'ITEMMINIMUMQUANTITY' => '',
                        'ITEMORDERMINIMUMQUANTITY' => '',
                        'ITEMORDERTRIGGER' => '',
                        'ONHAND' => '',
                        'AWAIT_TEST' => '',
                        'INV_OF_ORDER' => '',
                        'BACKLOG' => '',
                        'ALLOCATE' => '');
    }

    setSessionArray($data);
    // print_r($data);
    echo json_encode($data);
}

function actionReport() {
    $javaFunc = new PLANVIEW;
    global $data; unsetSessionkey('ITEM');
    $Param = array('ITEMCODE' => isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '',
                   'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '');
    $query = $javaFunc->getItem($Param);
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';
    if(!empty($query)) {
        $data = $query;
        $excute = $javaFunc->view($Param);
        $data['ITEM'] = $excute; 
    }

    setSessionArray($data);

    if(checkSessionData()) { 
        $data = getSessionData(); 
    }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'FACTORYCODE', 'ITEMCODE', 'ITEMNAME', 'ITEMSPEC', 'ITEMDRAWNUMBER',
                        'ONHAND','AWAIT_TEST','INV_OF_ORDER','BACKLOG', 'ALLOCATE','ITEMORDERROT','ITEMORDERMINIMUMQUANTITY','ITEMMINIMUMQUANTITY',
                        'ITEMLEADTIME', 'ITEMORDERTRIGGER', 'ITEMUNIT', 'ITEM', 'DVWDETAIL',
                        'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

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
?>