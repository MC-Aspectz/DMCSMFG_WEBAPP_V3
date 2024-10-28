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
$javaFunc = new JobResultEntry2;
$systemName = strtolower($appcode);
$minrowA = 0;
$minrowB = 0;
$maxrowA = 6;
$maxrow = 5;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
if(!empty($_GET)) {
    // 231200005
    // 231200013
    // 240100002
    if(!empty($_GET['PROORDERNO'])) {
        unsetSessionData();
        $PROORDERNO = isset($_GET['PROORDERNO']) ? $_GET['PROORDERNO']: '';
        $TIMESTAMP = date('YmdHis').substr(microtime(false), 2, 3);
        $query = $javaFunc->getProduction($PROORDERNO, $TIMESTAMP);
        // print_r(array_key_first($query));
        if(!empty($query)) {
            $data = $query[array_key_first($query)];
            $data['TIMESTAMP'] = $TIMESTAMP;
        }
        $searchJob = $javaFunc->searchJob($PROORDERNO);
        if(!empty($searchJob)) {
            $data['DVWJOBPRODUCTION'] = $searchJob;
        }
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($searchJob);
        // echo '</pre>';
    } else if(!empty($_GET['PROPSSNO'])) {
        if(checkSessionData()) { $data = getSessionData(); }
        $PROORDERNO = isset($_GET['P1']) ? $_GET['P1']: '';
        $PROPSSNO = isset($_GET['PROPSSNO']) ? $_GET['PROPSSNO']: '';
        $TIMESTAMP = $data['TIMESTAMP'];
        if($TIMESTAMP != '') {
            $query = $javaFunc->getProduction($PROORDERNO, $TIMESTAMP);
            if(!empty($query)) {
                $data = $query[array_key_first($query)];  
                $data['TIMESTAMP'] = $TIMESTAMP;   
            }
            $job = $javaFunc->getJobDetail($PROORDERNO, $PROPSSNO);
            if(!empty($job)) {
                $data['PROPSSNO'] = $job['PROPSSNO'];
                $data['JOBPROPSSTYP'] = $job['JOBPROPSSTYP'];
                $data['LOCCD'] = $job['LOCCD'];
                $data['LOCNAME'] = $job['LOCNAME'];
                $data['JOBPROJOBTYP'] = $job['JOBPROJOBTYP'];
                $data['JOBPROREM'] = $job['JOBPROREM'];
                $data['JOBPROCOMQTY'] = $job['JOBPROCOMQTY'];
                $data['PROCOMPQTY'] = $job['PROCOMPQTY'];
                $data['IMAGEFILE'] = $job['IMAGEFILE'];
                $data['PROPSSLASTFLG'] = $job['PROPSSLASTFLG'];
            }
            // print_r($query);
            // print_r($job);
        }
    } else if(!empty($_GET['JOBPROCOMQTY'])) {
        if(checkSessionData()) { $data = getSessionData(); }
        $JOBPROCOMQTY = isset($_GET['JOBPROCOMQTY']) ? str_replace(',', '', $_GET['JOBPROCOMQTY']): '';
        $PROCOMPQTY = isset($data['PROCOMPQTY']) ? $data['PROCOMPQTY']: '';
        $PROQTY = isset($data['PROQTY']) ? $data['PROQTY']: '';
        $query = $javaFunc->chkStatus($JOBPROCOMQTY, $PROCOMPQTY, $PROQTY);
        $data = $query;
        // print_r($query);
    } else if(!empty($_GET['JOBPROSTARTTM']) || !empty($_GET['JOBPROENDTM'])) {
        if(checkSessionData()) { $data = getSessionData(); }
        $WORKTIMECD = isset($data['WORKTIMECD']) ? $data['WORKTIMECD']: '';
        $JOBPROSTARTTM = isset($_GET['JOBPROSTARTTM']) ? str_replace(":", "", $_GET['JOBPROSTARTTM']).'00': '000000';
        $JOBPROENDTM = isset($_GET['JOBPROENDTM']) ? str_replace(":", "", $_GET['JOBPROENDTM']).'00': '000000';
        $JOBPROMEMBER = isset($data['JOBPROMEMBER']) ? $data['JOBPROMEMBER']: '';
        $param = array('JOBPROSTARTTM' => $JOBPROSTARTTM, 'JOBPROENDTM' => $JOBPROENDTM, 'JOBPROMEMBER' => $JOBPROMEMBER, 'WORKTIMECD' => $WORKTIMECD);
        // print_r($param);
        $query = $javaFunc->getPlanHour($param);
        $data = $query;
        // print_r($query);
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {
    // print_r($_POST);
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionAllData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'searchJob') { searchJob(); }
        if ($_POST['action'] == 'commitAll') { commitAll(); }
        if ($_POST['action'] == 'entry') { entry(); }
        if ($_POST['action'] == 'keepJobItemData') { keepJobItemData(); }
        if ($_POST['action'] == 'keepScrapItemData') { keepScrapItemData(); }
        if ($_POST['action'] == 'getJobDetail') { getJobDetail(); }
        if ($_POST['action'] == 'searchScrap') { searchScrap(); }
        if ($_POST['action'] == 'getPlanHour') { getPlanHour(); }
        if ($_POST['action'] == 'chkStatus') { chkStatus(); }
        if ($_POST['action'] == 'updateTmpScrap') { updateTmpScrap(); }
        if ($_POST['action'] == 'deleteTmpScrap') { deleteTmpScrap(); }
        if ($_POST['action'] == 'unsetJobItemData') {  unsetJobItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'unsetScrapItemData') {  unsetScrapItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'clearTmp') { clearTmp(); }
        if ($_POST['action'] == 'programDelete') { programDelete(); }
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
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['JOBPROMEMBER'] = 1;
$jobcode = $data['DRPLANG']['JOBCODE'];
$jobtype = $data['DRPLANG']['JOBTYPE'];
$statusrout = $data['DRPLANG']['STATUS_ROUT'];
$storagetype = $data['DRPLANG']['STORAGETYPE'];
$unit = $data['DRPLANG']['UNIT'];
$workitemcd = $data['DRPLANG']['WORKTIMECD'];
$badcode = $data['DRPLANG']['BAD_CODE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getJobDetail() {
    $javaFunc = new JobResultEntry2;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $PROPSSNO = isset($_POST['PROPSSNO']) ? $_POST['PROPSSNO']: '';
    $query = $javaFunc->getJobDetail($PROORDERNO, $PROPSSNO);

    echo json_encode($query);
}

function searchJob() {
    // unsetSessionData();
    $javaFunc = new JobResultEntry2;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $TIMESTAMP = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '';
    if($TIMESTAMP != '') {
        $query = $javaFunc->getProduction($PROORDERNO, $TIMESTAMP);
        $data = $query;
        $searchJob = $javaFunc->searchJob($PROORDERNO);

        if(!empty($searchJob)) {
            $data['DVWJOBPRODUCTION'] = $searchJob;
        }

        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    }
}

function searchScrap() {
    $javaFunc = new JobResultEntry2;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $PROPSSNO = isset($_POST['PROPSSNO']) ? $_POST['PROPSSNO']: '';
    $TIMESTAMP = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '';
    $JOBPROORDERNO = isset($_POST['JOBPROORDERNO']) ? $_POST['JOBPROORDERNO']: '';
    $param = array('PROORDERNO' => $PROORDERNO, 'PROPSSNO' => $PROPSSNO, 'TIMESTAMP' => $TIMESTAMP, 'JOBPROORDERNO' => $JOBPROORDERNO);
    // print_r($param);
    $sumScrap = $javaFunc->getSumScrap($param);
    $query = $javaFunc->searchScrap($param);

    $result = array('Scrap' => $query,
                    'SumScrap' => $sumScrap);

    echo json_encode($result);
}

function commitAll() {
    $insfunc = new JobResultEntry2;
    $RowParam = [];
    if(!empty($_POST['JOBPROLNA'])) {
        for ($i = 0 ; $i < count($_POST['JOBPROLNA']); $i++) { 
            $RowParam[] = array('JOBPROORDERNO' => isset($_POST['JOBPROORDERNOA'][$i]) ? $_POST['JOBPROORDERNOA'][$i]: '',
                                'ROWNO' => $i+1,
                                'JOBPROSTARTDT' => isset($_POST['JOBPROSTARTDTA'][$i]) ? $_POST['JOBPROSTARTDTA'][$i]: '',
                                'JOBPROSTARTTM' => isset($_POST['JOBPROSTARTTMA'][$i]) ? $_POST['JOBPROSTARTTMA'][$i]: '',
                                'JOBPROENDTM' => isset($_POST['JOBPROENDTMA'][$i]) ? $_POST['JOBPROENDTMA'][$i]: '',
                                'JOBPROCOMQTY' => isset($_POST['JOBPROCOMQTYA'][$i]) ? $_POST['JOBPROCOMQTYA'][$i]: '',
                                'JOBPROJOBTYP' => isset($_POST['JOBPROJOBTYPA'][$i]) ? $_POST['JOBPROJOBTYPA'][$i]: '',
                                'JOBPROENTRYDT' => isset($_POST['JOBPROENTRYDTA'][$i]) ? $_POST['JOBPROENTRYDTA'][$i]: '',
                                'LOCCD' => isset($_POST['LOCCDA'][$i]) ? $_POST['LOCCDA'][$i]: '',
                                'LOCNAME' => isset($_POST['LOCNAMEA'][$i]) ? $_POST['LOCNAMEA'][$i]: '',
                                'JOBPROREM' => isset($_POST['JOBPROREMA'][$i]) ? $_POST['JOBPROREMA'][$i]: '',
                                'JOBPROHOUR' => isset($_POST['JOBPROHOURA'][$i]) ? $_POST['JOBPROHOURA'][$i]: '',
                                'JOBPROSTATUS' => isset($_POST['JOBPROSTATUSA'][$i]) ? $_POST['JOBPROSTATUSA'][$i]: '',
                                'JOBPROPSSTYP' => isset($_POST['JOBPROPSSTYPA'][$i]) ? $_POST['JOBPROPSSTYPA'][$i]: '',
                                'WCCOST' => !empty($_POST['WCCOSTA'][$i]) ? $_POST['WCCOSTA'][$i]: '',
                                'WCSTDCOST' => !empty($_POST['WCSTDCOSTA'][$i]) ? $_POST['WCSTDCOSTA'][$i]: '',
                                'IMAGEFILE' => isset($_POST['IMAGEFILEA'][$i]) ? $_POST['IMAGEFILEA'][$i]: '',
                                'JOBPROTIMETYPE' => isset($_POST['JOBPROTIMETYPEA'][$i]) ? $_POST['JOBPROTIMETYPEA'][$i]: '',
                                'JOBPROMEMBER'=> isset($_POST['JOBPROMEMBER']) ? $_POST['JOBPROMEMBER']: '',
                                'PROPSSNO' => isset($_POST['PROPSSNOA'][$i]) ? $_POST['PROPSSNOA'][$i]: '',
                                'STAFFCD' => isset($_POST['STAFFCDA'][$i]) ? $_POST['STAFFCDA'][$i]: '',
                                'PROPSSLASTFLG' => isset($_POST['PROPSSLASTFLGA'][$i]) ? $_POST['PROPSSLASTFLGA'][$i]: '',
                                'WORKTIMECD' => isset($_POST['WORKTIMECDA'][$i]) ? $_POST['WORKTIMECDA'][$i]: '');
        }
    }

    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'NEWNUM' => isset($_POST['NEWNUM']) ? $_POST['NEWNUM']: '',
                    'PROWCCD' => isset($_POST['PROWCCD']) ? $_POST['PROWCCD']: '',
                    'PROQTY' => isset($_POST['PROQTY']) ? implode(explode(',', $_POST['PROQTY'])): '0.00',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROSTAFFCD' => isset($_POST['PROSTAFFCD']) ? $_POST['PROSTAFFCD']: '',
                    'PROLOCTYP' => isset($_POST['PROLOCTYP']) ? $_POST['PROLOCTYP']: '',
                    'PROLOCCD' => isset($_POST['PROLOCCD']) ? $_POST['PROLOCCD']: '',
                    'PROSTARTDT' => isset($_POST['PROSTARTDT']) ? str_replace('-', '', $_POST['PROSTARTDT']): '',
                    'PROENDDT' => isset($_POST['PROENDDT']) ? str_replace('-', '', $_POST['PROENDDT']): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ITEMNAME' => isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP']) ? $_POST['ITEMUNITTYP']: '',
                    'STAFFNAME' => isset($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: '',
                    'TIMESTAMP' => isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '',
                    'PROMESS' => isset($_POST['PROMESS']) ? $_POST['PROMESS']: '',
                    'DATA' => $RowParam,
                );
    // print_r($param);
    $commitAll = $insfunc->commitAll($param);
    clearTmp();
    unsetSessionkey('DVWSCRAP');
    unsetSessionkey('DVWJOBPRODUCTION');
    unsetSessionData();
    echo json_encode($commitAll);
}

function updateTmpScrap() {
    $javaFunc = new JobResultEntry2;
    $RowParam = [];
    $TIMESTAMP = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '';
    $JOBPROORDERNO = isset($_POST['JOBPROORDERNO']) ? $_POST['JOBPROORDERNO']: '';
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $PROPSSNO = isset($_POST['PROPSSNO']) ? $_POST['PROPSSNO']: '';
    if(!empty($_POST['PROSCRAPTYP'])) {
        for ($i = 0 ; $i < count($_POST['PROSCRAPTYP']); $i++) { 
            if($_POST['PROSCRAPTYP'][$i]) {
                $RowParam[] = array('PROSCRAPTYP' => isset($_POST['PROSCRAPTYP'][$i]) ? $_POST['PROSCRAPTYP'][$i]: '',
                                    'PROSCRAPQTY' => isset($_POST['PROSCRAPQTY'][$i]) ? str_replace(',','', $_POST['PROSCRAPQTY'][$i]): '');                
            }
        }   
    }
    $param = array('TIMESTAMP' => $TIMESTAMP, 'JOBPROORDERNO' => $JOBPROORDERNO, 'PROORDERNO' => $PROORDERNO, 'PROPSSNO' => $PROPSSNO, 'DATA' => $RowParam);
    // print_r($param);
    $updateTmpScrap = $javaFunc->updateTmpScrap($param);
    echo json_encode($updateTmpScrap);
}

function deleteTmpScrap() {
    $javaFunc = new JobResultEntry2;
    $JOBPROORDERNO = isset($_POST['JOBPROORDERNO']) ? $_POST['JOBPROORDERNO']: '';
    $PROPSSNO = isset($_POST['PROPSSNO']) ? $_POST['PROPSSNO']: '';
    $TIMESTAMP = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '';
    $deleteTmpScrap = $javaFunc->deleteTmpScrap($JOBPROORDERNO, $PROPSSNO, $TIMESTAMP);
    echo json_encode($deleteTmpScrap);
}

function delete() {
    $delfunc = new JobResultEntry2;
    $checkStatus = $delfunc->checkStatus($_POST['PROSTATUS']);
    // echo json_encode($checkStatus);
    if(!empty($checkStatus)) {
        $delete = $delfunc->delete($_POST['ACTION'], $_POST['PROORDERNO']);
        echo json_encode($delete);
        unsetSessionData();
    }
}

function chkStatus() {
    $javaFunc = new JobResultEntry2;
    $JOBPROCOMQTY = isset($_POST['JOBPROCOMQTY']) ? str_replace(",", "", $_POST['JOBPROCOMQTY']): '';
    $PROCOMPQTY = isset($_POST['PROCOMPQTY']) ? $_POST['PROCOMPQTY']: '';
    $PROQTY = isset($_POST['PROQTY']) ? $_POST['PROQTY']: '';
    $query = $javaFunc->chkStatus($JOBPROCOMQTY, $PROCOMPQTY, $PROQTY);
    // print_r($query);
    echo json_encode($query);
}

function getPlanHour() {
    $javaFunc = new JobResultEntry2;
    $WORKTIMECD = isset($_POST['WORKTIMECD']) ? $_POST['WORKTIMECD']: '';
    $JOBPROSTARTTM = isset($_POST['JOBPROSTARTTM']) ? str_replace(":", "", $_POST['JOBPROSTARTTM']).'00': '000000';
    $JOBPROENDTM = isset($_POST['JOBPROENDTM']) ? str_replace(":", "", $_POST['JOBPROENDTM']).'00': '000000';
    $JOBPROMEMBER = isset($_POST['JOBPROMEMBER']) ? $_POST['JOBPROMEMBER']: '';
    $param = array('JOBPROSTARTTM' => $JOBPROSTARTTM, 'JOBPROENDTM' => $JOBPROENDTM, 'JOBPROMEMBER' => $JOBPROMEMBER, 'WORKTIMECD' => $WORKTIMECD);
    // print_r($param);
    $query = $javaFunc->getPlanHour($param);
    // print_r($query);
    echo json_encode($query);
}

function clearTmp() {
    $javaFunc = new JobResultEntry2;
    $TIMESTAMP = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP']: '';
    $clearTmp = $javaFunc->clearTmp($TIMESTAMP);
    // print_r($query);
    echo json_encode($clearTmp);
}

function entry() {
    unsetSessionkey('PROPSSNO');
    unsetSessionkey('JOBPROORDERNO');
    unsetSessionkey('JOBPROENTRYDT');
    unsetSessionkey('PROPSSLASTFLG');
    unsetSessionkey('LOCCD');
    unsetSessionkey('LOCNAME');  
    unsetSessionkey('JOBPROREM');
    unsetSessionkey('JOBPROCOMQTY');
    unsetSessionkey('PROCOMPQTY');
    unsetSessionkey('JOBPROSTARTDT');
    unsetSessionkey('JOBPROSTARTTM');
    unsetSessionkey('JOBPROENDTM');
    unsetSessionkey('JOBPROHOUR');
    unsetSessionkey('IMAGEFILE');
    unsetSessionkey('JOBPROPSSTYP');
    unsetSessionkey('JOBPROJOBTYP');
    unsetSessionkey('WORKTIMECD');
    unsetSessionkey('JOBPROSTATUS');
    unsetSessionkey('SUMSCRAP');
    unsetSessionkey('PROMESS');
    unsetSessionkey('DVWSCRAP');
}

function unsetSessionAllData() {
    unsetSessionkey('DVWSCRAP');
    unsetSessionkey('DVWJOBPRODUCTION');
    unsetSessionData();
}

function keepJobItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['JOBPROLNA']); $i++) { 
        $data['DVWJOBPRODUCTION'][$i+1] = array('JOBPROORDERNO' => isset($_POST['JOBPROORDERNOA'][$i]) ? $_POST['JOBPROORDERNOA'][$i]: '',
                                                'JOBPROLN' => isset($_POST['JOBPROLNA'][$i]) ? $_POST['JOBPROLNA'][$i]: '',
                                                'PROPSSNO' => isset($_POST['PROPSSNOA'][$i]) ? $_POST['PROPSSNOA'][$i]: '',
                                                'JOBPROJOBTYPSTR' => isset($_POST['JOBPROJOBTYPSTRA'][$i]) ? $_POST['JOBPROJOBTYPSTRA'][$i]: '',
                                                'JOBPROSTARTDT' => isset($_POST['JOBPROSTARTDTA'][$i]) ? $_POST['JOBPROSTARTDTA'][$i]: '',
                                                'JOBPROSTARTTM' => isset($_POST['JOBPROSTARTTMA'][$i]) ? $_POST['JOBPROSTARTTMA'][$i]: '',
                                                'JOBPROENDTM' => isset($_POST['JOBPROENDTMA'][$i]) ? $_POST['JOBPROENDTMA'][$i]: '',
                                                'JOBPROCOMQTY' => isset($_POST['JOBPROCOMQTYA'][$i]) ? $_POST['JOBPROCOMQTYA'][$i]: '',
                                                'JOBPROJOBTYP' => isset($_POST['JOBPROJOBTYPA'][$i]) ? $_POST['JOBPROJOBTYPA'][$i]: '',
                                                'JOBPROENTRYDT' => isset($_POST['JOBPROENTRYDTA'][$i]) ? $_POST['JOBPROENTRYDTA'][$i]: '',
                                                'JOBPROPSSTYP' => isset($_POST['JOBPROPSSTYPA'][$i]) ? $_POST['JOBPROPSSTYPA'][$i]: '',
                                                'JOBPROPSSTYPSTR' => isset($_POST['JOBPROPSSTYPSTRA'][$i]) ? $_POST['JOBPROPSSTYPSTRA'][$i]: '',
                                                'LOCCD' => isset($_POST['LOCCDA'][$i]) ? $_POST['LOCCDA'][$i]: '',
                                                'LOCNAME' => isset($_POST['LOCNAMEA'][$i]) ? $_POST['LOCNAMEA'][$i]: '',
                                                'JOBPROREM' => isset($_POST['JOBPROREMA'][$i]) ? $_POST['JOBPROREMA'][$i]: '',
                                                'JOBPROHOUR' => isset($_POST['JOBPROHOURA'][$i]) ? $_POST['JOBPROHOURA'][$i]: '',
                                                'JOBPROTIMETYP' => !empty($_POST['JOBPROTIMETYPA'][$i]) ? $_POST['JOBPROTIMETYPA'][$i]: '',
                                                'JOBPROSTATUS' => isset($_POST['JOBPROSTATUSA'][$i]) ? $_POST['JOBPROSTATUSA'][$i]: '',
                                                'WCCOST' => !empty($_POST['WCCOSTA'][$i]) ? $_POST['WCCOSTA'][$i]: '',
                                                'WCSTDCOST' => !empty($_POST['WCSTDCOSTA'][$i]) ? $_POST['WCSTDCOSTA'][$i]: '',
                                                'IMAGEFILE' => isset($_POST['IMAGEFILEA'][$i]) ? $_POST['IMAGEFILEA'][$i]: '',
                                                'STAFFCD' => isset($_POST['STAFFCDA'][$i]) ? $_POST['STAFFCDA'][$i]: '',
                                                'STAFFNAME' => isset($_POST['STAFFNAMEA'][$i]) ? $_POST['STAFFNAMEA'][$i]: '',
                                                'INSSTAFFCD' => isset($_POST['INSSTAFFCDA'][$i]) ? $_POST['INSSTAFFCDA'][$i]: '',
                                                'INSTIMESTAMP' => isset($_POST['INSTIMESTAMPA'][$i]) ? $_POST['INSTIMESTAMPA'][$i]: '',
                                                'OLDCOMPQTY' => !empty($_POST['OLDCOMPQTYA'][$i]) ? $_POST['OLDCOMPQTYA'][$i]: '',
                                                'PROPSSLASTFLG' => isset($_POST['PROPSSLASTFLGA'][$i]) ? $_POST['PROPSSLASTFLGA'][$i]: '',
                                                'OLDLINE' => !empty($_POST['OLDLINEA'][$i]) ? $_POST['OLDLINEA'][$i]: '',
                                                'JOBPROTRANNO' => !empty($_POST['JOBPROTRANNOA'][$i]) ? $_POST['JOBPROTRANNOA'][$i]: '',
                                                'PROCOMPQTY' => isset($_POST['PROCOMPQTYA'][$i]) ? $_POST['PROCOMPQTYA'][$i]: '',
                                                'WORKTIMECD' => isset($_POST['WORKTIMECDA'][$i]) ? $_POST['WORKTIMECDA'][$i]: '');
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data['DVWJOBPRODUCTION']);
}

function keepScrapItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['PROSCRAPQTY']); $i++) { 
        $data['DVWSCRAP'][$i+1] = array('PROSCRAPQTY' => isset($_POST['PROSCRAPQTY'][$i]) ? $_POST['PROSCRAPQTY'][$i]: '',
                                        'PROSCRAPTYP' => isset($_POST['PROSCRAPTYP'][$i]) ? $_POST['PROSCRAPTYP'][$i]: '');
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data['DVWSCRAP']);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        unsetSessionkey('DVWSCRAP');
        unsetSessionkey('DVWJOBPRODUCTION');
        unsetSessionData();
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'PROORDERNO', 'ITEMCD', 'ITEMNAME', 'ITEMSPEC', 'WCSTDCOST', 'WCCOST', 'PROWCCD', 'PROWCNAME', 'PROQTY', 'ITEMUNITTYP', 'PROPLANSTARTDT', 'PROPLANENDDT', 'PROSTAFFCD', 'PROSTAFFNAME', 'PROLOCTYP', 'PROLOCCD', 'PROLOCNAME', 'PROSTARTDT', 'PROENDDT', 'STAFFCD', 'STAFFNAME', 'JOBPROMEMBER', 'PROPSSNO', 'JOBPROORDERNO', 'PROPSSLASTFLG', 'JOBPROENTRYDT', 'JOBPROPSSTYP', 'LOCCD', 'LOCNAME', 'ROWNO', 'JOBPROJOBTYP', 'JOBPROREM', 'JOBPROCOMQTY', 'ITEMUNITTYP2', 'PROCOMPQTY', 'WORKTIMECD', 'JOBPROSTARTDT', 'JOBPROSTARTTM', 'JOBPROENDTM', 'JOBPROHOUR', 'JOBPROSTATUS', 'SUMSCRAP', 'IMAGEFILE', 'PROMESS', 'TIMESTAMP', 'ITEMIMGLOC', 'DVWJOBPRODUCTION', 'DVWSCRAP', 'SYSVIS_COMMIT', 'SYSVIS_INSERT', 'SYSVIS_INS', 'SYSVIS_UPDATE', 'SYSVIS_UPD', 'SYSVIS_DELETE', 'SYSVIS_DEL', 'SYSVIS_CANCEL');

    foreach($arr as $k => $v) {
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

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}

function unsetJobItemData($lineIndex = "") {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'DVWJOBPRODUCTION', $lineIndex);
    $data = getSessionData();
    $data['DVWJOBPRODUCTION'] = array_combine(range(1, count($data['DVWJOBPRODUCTION'])), array_values($data['DVWJOBPRODUCTION']));
    setSessionArray($data);
}

function unsetScrapItemData($lineIndex = "") {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'DVWSCRAP', $lineIndex);
    $data = getSessionData();
    $data['DVWSCRAP'] = array_combine(range(1, count($data['DVWSCRAP'])), array_values($data['DVWSCRAP']));
    setSessionArray($data);
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