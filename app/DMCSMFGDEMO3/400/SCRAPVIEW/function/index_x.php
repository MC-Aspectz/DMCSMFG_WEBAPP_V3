<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
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
$javaFunc = new ScrapView;
$systemName = strtolower($appcode);
// Table Row
$minrowA = 0;
$minrowB = 0;
$minrowC = 0;
$maxrow = 5;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 240100002
    // 231200013
    if(!empty($_GET['PROORDERNO'])) {
        // unsetSessionData();
        unsetSessionData();
        $PROORDERNO = isset($_GET['PROORDERNO']) ? $_GET['PROORDERNO']: '';

        $query = $javaFunc->getOrder($PROORDERNO);
        // print_r(array_key_first($query));
        if(!empty($query)) {
            $data = $query;
            $Param = array( 'PROORDERNO' => $PROORDERNO, 
                            'ROUTNO' => !empty($query['ROUTNO']) ? $query['ROUTNO']: '',
                            'BADQTY' => !empty($query['BADQTY']) ? $query['BADQTY']: '',
                            'CMAMOUNTTYPE' => !empty($query['CMAMOUNTTYPE']) ? $query['CMAMOUNTTYPE']: '',
                            'CMPRICETYPE' => !empty($query['CMPRICETYPE']) ? $query['CMPRICETYPE']: '',
                            'COMAMOUNTTYPE' => !empty($query['COMAMOUNTTYPE']) ? $query['COMAMOUNTTYPE']: '',
                            'COMPRICETYPE' => !empty($query['COMPRICETYPE']) ? $query['COMPRICETYPE']: '');
            $searchPro = $javaFunc->searchPro($Param);
            if(!empty($searchPro)) {
                $data['DVWPRODUCTION'] = $searchPro;
            }
            $scrapReason = $javaFunc->scrapReason($Param);
            if(!empty($scrapReason)) {
                $data['DVWSCRAP'] = $scrapReason;
            }
            $searchPrice = $javaFunc->searchPrice($Param);
            if(!empty($searchPrice)) {
                $data['DVWPRICE'] = $searchPrice;
            }
        }
        // echo "<pre>";
        // print_r($query);
        // echo "</pre>";
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    // print_r($_POST);
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'searchPro') { searchPro(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); }
    }
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
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
$jobcode = $data['DRPLANG']['JOBCODE'];
$unit = $data['DRPLANG']['UNIT'];
$statusorder = $data['DRPLANG']['STATUS_ORDER'];
$badcode = $data['DRPLANG']['BAD_CODE'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function searchPro() {
    // unsetSessionData();
    $javaFunc = new ScrapView;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $query = $javaFunc->getOrder($PROORDERNO);
    if(!empty($query)) {
        $data = $query;
        $Param = array( 'PROORDERNO' => $PROORDERNO, 
                        'ROUTNO' => !empty($query['ROUTNO']) ? $query['ROUTNO']: '',
                        'BADQTY' => !empty($query['BADQTY']) ? $query['BADQTY']: '',
                        'CMAMOUNTTYPE' => !empty($query['CMAMOUNTTYPE']) ? $query['CMAMOUNTTYPE']: '',
                        'CMPRICETYPE' => !empty($query['CMPRICETYPE']) ? $query['CMPRICETYPE']: '',
                        'COMAMOUNTTYPE' => !empty($query['COMAMOUNTTYPE']) ? $query['COMAMOUNTTYPE']: '',
                        'COMPRICETYPE' => !empty($query['COMPRICETYPE']) ? $query['COMPRICETYPE']: '');
        $searchPro = $javaFunc->searchPro($Param);
        if(!empty($searchPro)) {
            $data['DVWPRODUCTION'] = $searchPro;
        }
        $scrapReason = $javaFunc->scrapReason($Param);
        if(!empty($scrapReason)) {
            $data['DVWSCRAP'] = $scrapReason;
        }
        $searchPrice = $javaFunc->searchPrice($Param);
        if(!empty($searchPrice)) {
            $data['DVWPRICE'] = $searchPrice;
        }
    }

    if(checkSessionData()) { $data = getSessionData(); }

}

function programDelete() {
    $syslogic = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        unsetSessionkey('DVWPRODUCTION');
        unsetSessionkey('DVWSCRAP');
        unsetSessionkey('DVWPRICE');
        unsetSessionData();
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'PROORDERNO', 'ITEMCD', 'ITEMNAME', 'WCCD', 'WCNAME', 'PROQTY', 'ITEMUNITTYP', 'CMPRICETYPE', 'CMAMOUNTTYPE', 'COMPRICETYPE', 'COMAMOUNTTYPE', 'CURRENCY', 'CUSTOMERCURRENCY', 'PROSTARTDT', 'PROENDDT', 'PROSALENOLN', 'PROSTATUS', 'CUSTOMERCD', 'CUSTOMERNAME', 'DELIVERYCD', 'DELIVERYNAME', 'DELIVERYDATE', 'DUEDATE', 'SALELNAMT', 'CMCURDISP', 'SALELNEXAMT', 'CURRENCYDISP', 'PLANCOST', 'ACTUALCOST', 'ACTUALCOSTDIFF', 'ACT_PARTS_AMT', 'TOTAL_A', 'TOTAL_B', 'TOTAL_C', 'TOTAL_D', 'TOTAL_E', 'TOTAL_F', 'DVWPRODUCTION', 'DVWSCRAP', 'DVWPRICE', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

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