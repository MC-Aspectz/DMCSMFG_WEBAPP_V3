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
$logicFunc = new OrderRoutingEntry;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 12;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['PROORDERNO'])) {
        unsetSessionData();
        $PROORDERNO = isset($_GET['PROORDERNO']) ? $_GET['PROORDERNO']: '';
        $query = $logicFunc->getProOdr($PROORDERNO);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        $excute = $logicFunc->searchDetail($PROORDERNO);
        if(!empty($excute)) {
            $data['ITEM'] = $excute;
            // echo '<pre>';
            // print_r($excute);
            // echo '</pre>';
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
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
        if ($_POST['action'] == 'SEARCH') { search(); }
        if ($_POST['action'] == 'REMAKE') { Remake(); }
        if ($_POST['action'] == 'ITEMPLACECD') { getPlace(); }
        if ($_POST['action'] == 'PROPSSJOBTYP') { getJobCode(); }
        if ($_POST['action'] == 'commit') { commitAll(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
	}
}

//--------------------------------------------------------------------------------
// ------------------------- CALL Langauge AND Privilege -------------------//
// if(checkSessionData()) { $data = getSessionData(); }
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
// $CLEAR = $data['DRPLANG']['CLEAR'];
$UNIT = $data['DRPLANG']['UNIT'];
$JOBTYPE = $data['DRPLANG']['JOBTYPE'];
$JOBUNIT = $data['DRPLANG']['JOBUNIT'];
$JOBLINKTYPE = $data['DRPLANG']['JOBLINKTYPE'];
$data['PROPSSTYP'] = 1;
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function search() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $searchfunc = new OrderRoutingEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $search = $searchfunc->searchDetail($PROORDERNO);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

function Remake() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $javaFunc = new OrderRoutingEntry;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $ITEMPROPTNCD = isset($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '';
    $query = $javaFunc->remake($PROORDERNO, $ITEMPROPTNCD);
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';
    if(!empty($query)) {
        $data['ITEM'] = $query; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

function getPlace() {
    $javafunc = new OrderRoutingEntry;
    $PROPSSTYP = isset($_POST['PROPSSTYP']) ? $_POST['PROPSSTYP']: '';
    $ITEMPLACECD = isset($_POST['ITEMPLACECD']) ? $_POST['ITEMPLACECD']: '';
    $query = $javafunc->getPlace($PROPSSTYP, $ITEMPLACECD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getJobCode() {
    $javafunc = new OrderRoutingEntry;
    $PROPSSJOBTYP = isset($_POST['PROPSSJOBTYP']) ? $_POST['PROPSSJOBTYP']: '';
    $query = $javafunc->getJobCode($PROPSSJOBTYP);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function commitAll() {
    $insfunc = new OrderRoutingEntry;
    $RowParam = [];
    if(!empty($_POST['ROWNOZ'])) {
        for ($i = 0 ; $i < count($_POST['PROPSSNOZ']); $i++) { 
            $RowParam[] = array('ROWNO' => isset($_POST['ROWNOZ'][$i]) ? $_POST['ROWNOZ'][$i]: '',
                                'PROPSSNO' => isset($_POST['PROPSSNOZ'][$i]) ? $_POST['PROPSSNOZ'][$i]: '',
                                'PROPSSTYPSTR' => isset($_POST['PROPSSTYPSTRZ'][$i]) ? $_POST['PROPSSTYPSTRZ'][$i]: '',
                                'ITEMPLACECD' => isset($_POST['ITEMPLACECDZ'][$i]) ? $_POST['ITEMPLACECDZ'][$i]: '',
                                'ITEMPLACENAME' => isset($_POST['ITEMPLACENAMEZ'][$i]) ? $_POST['ITEMPLACENAMEZ'][$i]: '',
                                'PROPSSQTY' => isset($_POST['PROPSSQTYZ'][$i]) ? implode(explode(',', $_POST['PROPSSQTYZ'][$i])): '',
                                'PROPSSPLANTIME' => isset($_POST['PROPSSPLANTIMEZ'][$i]) ? $_POST['PROPSSPLANTIMEZ'][$i]: '',
                                'PROPSSTYP' => isset($_POST['PROPSSTYPZ'][$i]) ? $_POST['PROPSSTYPZ'][$i]: '',
                                'PROPSSJOBTYP' => isset($_POST['PROPSSJOBTYPZ'][$i]) ? $_POST['PROPSSJOBTYPZ'][$i]: '',
                                'PROPSSJOBTYPSTR' => isset($_POST['PROPSSJOBTYPSTRZ'][$i]) ? $_POST['PROPSSJOBTYPSTRZ'][$i]: '',
                                'PROPSSUNITTYP' =>isset($_POST['PROPSSUNITTYPZ'][$i]) ?  $_POST['PROPSSUNITTYPZ'][$i]: '',
                                'PROPSSUNITTYPSTR' => isset($_POST['PROPSSUNITTYPSTRZ'][$i]) ? $_POST['PROPSSUNITTYPSTRZ'][$i]: '',
                                'PROPSSLINKTYP' => isset($_POST['PROPSSLINKTYPZ'][$i]) ? $_POST['PROPSSLINKTYPZ'][$i]: '',
                                'PROPSSLINKTYPSTR' => isset($_POST['PROPSSLINKTYPSTRZ'][$i]) ? $_POST['PROPSSLINKTYPSTRZ'][$i]: '',
                                'PROPSSFIXFLG' => isset($_POST['PROPSSFIXFLGZ'][$i]) ? $_POST['PROPSSFIXFLGZ'][$i]: 'F',
                                'PROPSSPLANSTARTDT' => isset($_POST['PROPSSPLANSTARTDTZ'][$i]) ? str_replace('/', '', $_POST['PROPSSPLANSTARTDTZ'][$i]): '',
                                'PROPSSPLANENDDT' => isset($_POST['PROPSSPLANENDDTZ'][$i]) ? str_replace('/', '', $_POST['PROPSSPLANENDDTZ'][$i]): '',
                                'PROPSSPLANSTARTTM' => isset($_POST['PROPSSPLANSTARTTMZ'][$i]) ? $_POST['PROPSSPLANSTARTTMZ'][$i]: '',
                                'PROPSSPLANENDTM' => isset($_POST['PROPSSPLANENDTMZ'][$i]) ? $_POST['PROPSSPLANENDTMZ'][$i]: '',
                                'PROPSSSTARTDT' => isset($_POST['PROPSSSTARTDTZ'][$i]) ? str_replace('/', '', $_POST['PROPSSSTARTDTZ'][$i]): '',
                                'PROPSSENDDT' => isset($_POST['PROPSSENDDTZ'][$i]) ? str_replace('/', '', $_POST['PROPSSENDDTZ'][$i]): '',
                                'PROPSSSTARTTM' => isset($_POST['PROPSSSTARTTMZ'][$i]) ? $_POST['PROPSSSTARTTMZ'][$i]: '',
                                'PROPSSENDTM' => isset($_POST['PROPSSENDTMZ'][$i]) ? $_POST['PROPSSENDTMZ'][$i]: '',
                                'PROPSSCOMPQTY' => isset($_POST['PROPSSCOMPQTYZ'][$i]) ? implode(explode(',', $_POST['PROPSSCOMPQTYZ'][$i])): '',
                                'PROPSSALLOWANCE' => isset($_POST['PROPSSALLOWANCEZ'][$i]) ? $_POST['PROPSSALLOWANCEZ'][$i]: '0',
                                'PROPSSPLANDT' => isset($_POST['PROPSSPLANDTZ'][$i]) ? str_replace('/', '', $_POST['PROPSSPLANDTZ'][$i]): '',
                                'PROPSSREM' => isset($_POST['PROPSSREMZ'][$i]) ? $_POST['PROPSSREMZ'][$i]: '',
                                'PROPSSDURATION' => isset($_POST['PROPSSDURATIONZ'][$i]) ? $_POST['PROPSSDURATIONZ'][$i]: '',
                                'PROPSSSTATUS' => isset($_POST['PROPSSSTATUSZ'][$i]) ? $_POST['PROPSSSTATUSZ'][$i]: '',
                                'PROPSSSTATUSSTR' => isset($_POST['PROPSSSTATUSSTRZ'][$i]) ? $_POST['PROPSSSTATUSSTRZ'][$i]: '',
                                'JOB_NAME' => isset($_POST['JOB_NAMEZ'][$i]) ? $_POST['JOB_NAMEZ'][$i]: '');
        }
    }

    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROPSSTYPSTR' => isset($_POST['PROPSSTYPSTR']) ? $_POST['PROPSSTYPSTR']: '',
                    'PROPSSJOBTYPSTR' => isset($_POST['PROPSSJOBTYPSTR']) ? $_POST['PROPSSJOBTYPSTR']: '',
                    'PROPSSUNITTYPSTR' => isset($_POST['PROPSSUNITTYPSTR']) ? $_POST['PROPSSUNITTYPSTR']: '',
                    'PROPSSLINKTYPSTR' => isset($_POST['PROPSSLINKTYPSTR']) ? $_POST['PROPSSLINKTYPSTR']: '',
                    'DATA' => $RowParam,
                );
    // print_r($param);
    $commitAll = $insfunc->commitAll($param);
    unsetSessionData();
    echo json_encode($commitAll);
}
                             
function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOZ']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOZ'][$i],
                                    'PROPSSNO' => $_POST['PROPSSNOZ'][$i],
                                    'PROPSSTYPSTR' => $_POST['PROPSSTYPSTRZ'][$i],
                                    'ITEMPLACECD' => $_POST['ITEMPLACECDZ'][$i],
                                    'ITEMPLACENAME' => $_POST['ITEMPLACENAMEZ'][$i],
                                    'PROPSSQTY' => $_POST['PROPSSQTYZ'][$i],
                                    'PROPSSPLANTIME' => $_POST['PROPSSPLANTIMEZ'][$i],
                                    'PROPSSTYP' => $_POST['PROPSSTYPZ'][$i],
                                    'PROPSSJOBTYP' => $_POST['PROPSSJOBTYPZ'][$i],
                                    'PROPSSJOBTYPSTR' => $_POST['PROPSSJOBTYPSTRZ'][$i],
                                    'PROPSSUNITTYP' => $_POST['PROPSSUNITTYPZ'][$i],
                                    'PROPSSUNITTYPSTR' => $_POST['PROPSSUNITTYPSTRZ'][$i],
                                    'PROPSSLINKTYP' => $_POST['PROPSSLINKTYPZ'][$i],
                                    'PROPSSLINKTYPSTR' => $_POST['PROPSSLINKTYPSTRZ'][$i],
                                    'PROPSSFIXFLG' => $_POST['PROPSSFIXFLGZ'][$i],
                                    'PROPSSPLANSTARTDT' => $_POST['PROPSSPLANSTARTDTZ'][$i],
                                    'PROPSSPLANENDDT' => $_POST['PROPSSPLANENDDTZ'][$i],
                                    'PROPSSPLANSTARTTM' => $_POST['PROPSSPLANSTARTTMZ'][$i],
                                    'PROPSSPLANENDTM' => $_POST['PROPSSPLANENDTMZ'][$i],
                                    'PROPSSSTARTDT' => $_POST['PROPSSSTARTDTZ'][$i],
                                    'PROPSSENDDT' => $_POST['PROPSSENDDTZ'][$i],
                                    'PROPSSSTARTTM' => $_POST['PROPSSSTARTTMZ'][$i],
                                    'PROPSSENDTM' => $_POST['PROPSSENDTMZ'][$i],
                                    'PROPSSCOMPQTY' => $_POST['PROPSSCOMPQTYZ'][$i],
                                    'PROPSSALLOWANCE' => $_POST['PROPSSALLOWANCEZ'][$i],
                                    'PROPSSPLANDT' => $_POST['PROPSSPLANDTZ'][$i],
                                    'PROPSSREM' => $_POST['PROPSSREMZ'][$i],
                                    'PROPSSDURATION' => $_POST['PROPSSDURATIONZ'][$i],
                                    'PROPSSSTATUS' => $_POST['PROPSSSTATUSZ'][$i],
                                    'PROPSSSTATUSSTR' => $_POST['PROPSSSTATUSSTRZ'][$i],
                                    'JOB_NAME' => $_POST['JOB_NAMEZ'][$i]);
    }
    setSessionArray($data);
}

// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG','DVWDETAIL','ITEM', 'ROWNO', 'PROORDERNO', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'ITEMDRAWNO', 'WCCD', 'WCNAME', 'PROQTY', 'ITEMUNITTYP', 'PROPLANSTARTDT', 'PROPLANENDDT'
    ,'ITEMPLACECD', 'ITEMPLACENAME', 'PROPSSJOBTYP', 'JOB_NAME', 'PROPSSNO', 'PROPSSTYP', 'PROPSSREM', 'PROPSSCOMPQTY', 'PROPSSPLANTIME', 'PROPSSUNITTYP', 'PROPSSPLANSTARTDT', 'PROPSSPLANSTARTTM', 'PROPSSLINKTYP', 'PROPSSPLANENDDT', 'PROPSSPLANENDTM', 'PROPSSSTARTDT', 'PROPSSENDDT', 'PROPSSSTARTTM', 'PROPSSENDTM', 'PROPSSPLANDT', 'PROPSSDURATION', 'PROPSSSTATUS', 'PROPSSSTATUSSTR', 'PROPSSJOBTYPSTR', 'PROPSSALLOWANCE','PROPSSQTY', 'PROPSSFIXFLG', 'PROPSSTYPSTR', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL','SYSVIS_PROPATTERNLBL','SYSVIS_PROPTNNAME', 'SYSVIS_ITEMPROPTNCD', 'SYSVIS_REMAKE');

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

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
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
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}
?>