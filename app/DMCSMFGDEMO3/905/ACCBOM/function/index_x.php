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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = '';
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
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
$javaFunc = new ACCBOM;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 12;
$data['ACCGROUPTYP'] = '';
$data['searchG'] = array();
$data['searchC'] = array();

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'checkGroup') { checkGroup(); }
        if ($_POST['action'] == 'getAccCCd') { getAccCCd(); }
        if ($_POST['action'] == 'searchC') { searchC(); }
        if ($_POST['action'] == 'INSERT') { insert(); }
        if ($_POST['action'] == 'UPDATE') { update(); }
        if ($_POST['action'] == 'DELETE') { delete(); }
    }
    if(isset($_POST['SEARCH'])) { searchG(); }
}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//  GETcheckGroup
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['ACCOUNTCD'])) {
        getAccCCd();
    } else if(isset($_GET['ACCGROUPTYP'])) {
        $data['ACCGROUPTYP'] = isset($_GET['ACCGROUPTYP']) ? $_GET['ACCGROUPTYP']: '';
        $checkGroup = $javaFunc->checkGroup($data['ACCGROUPTYP']);
        $query = $javaFunc->searchG($data['ACCGROUPTYP']);
        $data['searchC'] = $javaFunc->searchC($data['ACCGROUPTYP']);
        $data['searchG'] = $query;
        // echo '<pre>';
        // print_r($data['searchG']);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($data['searchC']);
        // echo '</pre>';
        setSessionArray($data); 
    }
    // if(!empty($query)) {
    //     setSessionArray($data); 
    // }

    // if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}
// ------------------------- CALL Langauge AND Privilege -------------------//
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
$accgrouptyp = $data['DRPLANG']['ACC_GROUP'];
$acc01 = $data['DRPLANG']['ACC01'];

// // $search = getSystemData($_SESSION['APPCODE'].'_SEARCH');
// // if(empty($search)) {
// //     $search = $javaFunc->search();
// //     setSystemData($_SESSION['APPCODE'].'_SEARCH', $search);
// // }
// $title = array();
// foreach ($search as $key => $value) {
//     if($value['PATH'] != '' && $value['DATA'] != '') {
//         $end = strrpos($value['PATH'], '/');
//         $app = substr($value['PATH'], 0, $end);
//         $divend = strrpos($value['TITLE'], '-');
//         $stfend = strrpos($value['TITLE'], '(');

//         $row = array();
//         $row['APPPACK'] = $app;
//         $row['TITLE'] = $value['TITLE'];
//         $row['PATH'] = str_replace('/', '-', $value['PATH']);
//         $row['STAFFCD'] = substr($value['PATH'], $end + 1, strlen($value['PATH']));
//         $row['STAFFNAME'] = substr($value['TITLE'], 0, $stfend);
//         $row['DIVISION'] = substr($value['TITLE'], $divend + 1, strlen($value['TITLE']));
//         $title[] = $row;
//     }
// }
// echo '<pre>';
// print_r($search);
// echo '</pre>';
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function insert() {
    global $data;
    $javafunc = new ACCBOM;
    $data['ACCOUNTCD'] = isset($_POST['ACCOUNTCD']) ? $_POST['ACCOUNTCD']: '';
    $data['DATA'] = isset($_POST['DATA']) ? $_POST['DATA']: '';
    // print_r($data['DATA']);
    $insert = $javafunc->insert($data['ACCOUNTCD'], $data['DATA']);
    // setSessionArray($data);
    echo json_encode($insert);
}

function update() {
    global $data;
    $javafunc = new ACCBOM;
    $data['ACCOUNTCDID'] = isset($_POST['ACCOUNTCDID']) ? $_POST['ACCOUNTCDID']: '';
    $data['ACCOUNTCD'] = isset($_POST['ACCOUNTCD']) ? $_POST['ACCOUNTCD']: '';
    $data['DATA'] = isset($_POST['DATA']) ? $_POST['DATA']: '';
    // print_r($data['DATA']);
    $update = $javafunc->update($data['ACCOUNTCDID'], $data['ACCOUNTCD'], $data['DATA']);
    // setSessionArray($data); 
    echo json_encode($update);
}

function delete() {
    global $data;
    $javafunc = new ACCBOM;
    $data['ACCOUNTCDID'] = isset($_POST['ACCOUNTCDID']) ? $_POST['ACCOUNTCDID']: '';
    $data['ACCOUNTCD'] = isset($_POST['ACCOUNTCD']) ? $_POST['ACCOUNTCD']: '';
    $data['DATA'] = isset($_POST['DATA']) ? $_POST['DATA']: '';
    // print_r($data['DATA']);
    $delete = $javafunc->delete($data['ACCOUNTCDID'], $data['ACCOUNTCD'], $data['DATA']);
    // setSessionArray($data); 
    echo json_encode($delete);
}

function searchG() {
    global $data;
    $data['searchC'] = array();
    $data['searchG'] = array();
    $searchfunc = new ACCBOM;
    $data['ACCGROUPTYP'] = isset($_POST['ACCGROUPTYP']) ? $_POST['ACCGROUPTYP']: '';
    $checkGroup = $searchfunc->checkGroup($data['ACCGROUPTYP']);
    $query = $searchfunc->searchG($data['ACCGROUPTYP']);
    $data['searchC'] = $searchfunc->searchC($data['ACCGROUPTYP']);
    $data['searchG'] = $query;
    setSessionArray($data); 
}

function searchC() {
    global $data;
    $data['ITEM'] = array();
    $searchfunc = new ACCBOM;
    $searchC = $searchfunc->searchC($_POST['DATA']);
    if(!empty($searchC)) {
        $data['ITEM'] = $searchC;
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($searchC);
}

function getAccCCd() {
    global $data;
    $data = getSessionData();
    $accfunc = new ACCBOM;

    if(!empty($_POST['ACCOUNTCD'])) {
        $data['DATA'] =  isset($_POST['DATA']) ? $_POST['DATA']: '';
        $data['ACCOUNTCD'] = isset($_POST['ACCOUNTCD']) ? $_POST['ACCOUNTCD']: '';   
        $data['ACCOUNTCDID'] = isset($_POST['ACCOUNTCDID']) ? $_POST['ACCOUNTCDID']: '';
        $query = $accfunc->getAccCCd($data['ACCOUNTCDID'], $data['ACCOUNTCD'], $data['DATA']);
        // print_r($query);
        // print_r(str_contains($query, 'ERRO'));
        if(!empty($query) && is_array($query)) {
            $data = $query;
            setSessionArray($data); 
        } else {
            if($query == 'ERRO:ERROR_NOSELECT_ACCPCD') {
                $data['SYSMSG'] = 'ERROR_NOSELECT_ACCPCD';
            }
        }
        echo json_encode($data);
    }
    // if(isset($_GET['ACCOUNTCD'])) {
    //     $searchC = array(); $searchG = array();
    //     $data['ACCGROUPTYP'] = isset($data['ACCGROUPTYP']) ? $data['ACCGROUPTYP']: '';
    //     $checkGroup = $accfunc->checkGroup($data['ACCGROUPTYP']);
    //     $query1 = $accfunc->searchG($data['ACCGROUPTYP']);
    //     $data['searchC'] = $accfunc->searchC($data['ACCGROUPTYP']);
    //     $data['searchG'] = $query1;
    //     setSessionArray($data); 
    //     return json_encode($searchG);
    // }

    // if(!empty($_GET['ACCOUNTCD'])) {
    //     $data['ACCOUNTCD'] = isset($_GET['ACCOUNTCD']) ? $_GET['ACCOUNTCD']: '';
    //     $data['ACCOUNTNAME'] = isset($_GET['ACCOUNTNAME']) ? $_GET['ACCOUNTNAME']: '';
    //     $data['ACCOUNTCDID'] = isset($_GET['ACCOUNTCD']) ? $_GET['ACCOUNTCD']: '';
    //     $data['DATA'] = isset($data['DATA']) ? $data['DATA']: '';
    //     $query = $accfunc->getAccCCd($data['ACCOUNTCDID'], $data['ACCOUNTCD'], $data['DATA']);
    //     $data = $query;
    //     if(!empty($query)) {
    //         setSessionArray($data); 
    //     }
    //     return json_encode($query);
    // } 
}

function setOldValue() {
    // print_r($_POST);
    setSessionArray($_POST); 
}

function setSessionArray($arr) {
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'DATA', 'ITEM', 'ACCGROUPTYP', 'ACCOUNTCD', 'ACCOUNTNAME', 'ACCOUNTCDID', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'searchC', 'searchG');
    foreach($arr as $k => $v) {
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

?>