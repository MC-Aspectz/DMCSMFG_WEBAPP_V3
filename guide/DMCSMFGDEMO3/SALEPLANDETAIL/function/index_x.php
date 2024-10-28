<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';

// print_r($routeUrl);
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
$javaFunc = new SalePlanDetail;
$systemName = strtolower($appcode);
// Table Row
$minrow = 1;
$maxrow = 42;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'search') { search(); }
        if ($_POST['action'] == 'getDetailDT') { getDetailDT(); }
        if ($_POST['action'] == 'ctrlMemoOnClick') { ctrlMemoOnClick(); }
    }
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$loadApp = getSystemData('SALEPLAN');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SALEPLAN');
    setSystemData('SALEPLAN', $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$UNIT = $data['DRPLANG']['UNIT'];
$PURCHASE_ALLOW = $data['DRPLANG']['PURCHASE_ALLOW'];
$data['CURRENCYDISP'] = isset($_POST['CURRENCYDISP']) ? $_POST['CURRENCYDISP']: '';
$data['SYSTIMESTAMP'] = isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '';
$day = array('mon' => $lang['mon'], 'tue' => $lang['tue'], 'wed' => $lang['wed'], 'thu' => $lang['thu'], 'fri' => $lang['fri'], 'sat' => $lang['sat'], 'sun' => $lang['sun']);
$days = array(); for ($i = 0; $i <= 5; $i++) { array_push($days, $day); }
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($load);
// echo "</pre>";
// --------------------------------------------------------------------------//
function search() {
    $javaFunc = new SalePlanDetail;
    $param = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                    'YEAR' => isset($_POST['MONTHD']) ? date('Y', strtotime($_POST['MONTHD'])): '',
                    'MONTH' => isset($_POST['MONTHD']) ? date('m', strtotime($_POST['MONTHD'])): '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'ALLOWN' => isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F',
                    'START1' => isset($_POST['START1']) ? $_POST['START1']: '',
                    'START2' => isset($_POST['START2']) ? $_POST['START2']: '',
                    'START3' => isset($_POST['START3']) ? $_POST['START3']: '',
                    'START4' => isset($_POST['START4']) ? $_POST['START4']: '',
                    'COMPRICETYPE' => isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '',
                    'COMAMOUNTTYPE' => isset($_POST['COMAMOUNTTYPE']) ? $_POST['COMAMOUNTTYPE']: '');
    // print_r($param);
    $dateSetHD = $javaFunc->DateSetHD($param);
    // print_r($dateSetHD);
    $param = array_merge($param, array('STARTDT' => $dateSetHD['STARTDT']));
    for ($i = 1; $i <= 4; $i++) {
        $param = array_merge($param, array('START'.$i => $dateSetHD['START'.$i])); 
    }
    // print_r($param);
    $search = $javaFunc->search($param);
    // print_r($search);
    $searchLnDetailDt = $javaFunc->searchLnDetailDt($param);
    // print_r($searchLnDetailDt);
    $data = array('dateSetHD' => $dateSetHD, 'search' => $search);

    echo json_encode($data);
}

function getDetailDT() {
    $javaFunc = new SalePlanDetail;
    $param = array( 'LBLDATECD'.$_POST['NUM'] => isset($_POST['LBLDATECD'.$_POST['NUM']]) ? $_POST['LBLDATECD'.$_POST['NUM']]: '',
                    'LBLDATEFLG'.$_POST['NUM'] => isset($_POST['LBLDATEFLG'.$_POST['NUM']]) ? $_POST['LBLDATEFLG'.$_POST['NUM']]: '');
    $parameter = array( 'SYSTIMESTAMP' => isset($_POST['SYSTIMESTAMP']) ? $_POST['SYSTIMESTAMP']: '',
                        'YEAR' => isset($_POST['YEARVALUE']) ? $_POST['YEARVALUE']: '',
                        'MONTH' => isset($_POST['MONTHVALUE']) ? $_POST['MONTHVALUE']: '',
                        'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                        'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                        'ALLOWN' => isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F',
                        'STARTDT' => isset($_POST['STARTDT']) ? $_POST['STARTDT']: '',
                        'START1' => isset($_POST['START1']) ? $_POST['START1']: '',
                        'START2' => isset($_POST['START2']) ? $_POST['START2']: '',
                        'START3' => isset($_POST['START3']) ? $_POST['START3']: '',
                        'START4' => isset($_POST['START4']) ? $_POST['START4']: '',
                        'COMPRICETYPE' => isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '',
                        'COMAMOUNTTYPE' => isset($_POST['COMAMOUNTTYPE']) ? $_POST['COMAMOUNTTYPE']: '');
    $getDetailDT = $javaFunc->getDetailDT($param);
    // print_r($param);
    $parameter = array_merge($parameter, $getDetailDT);
    // print_r($parameter);
    // $searchAfterCommit = $javaFunc->searchAfterCommit($parameter);
    // print_r($searchAfterCommit);
    $searchLnDetailDt = $javaFunc->searchLnDetailDt($parameter);
    // print_r($searchLnDetailDt);
    $data = array('getDetailDT' => $getDetailDT, 'searchLnDetailDt' => $searchLnDetailDt);
    echo json_encode($data);
}

function ctrlMemoOnClick() {
    $javaFunc = new SalePlanDetail;
    $MEMO = isset($_POST['MEMO']) ? $_POST['MEMO']: '';
    $SALEPLANTODO4FLG = isset($_POST['SALEPLANTODO4FLG']) ? $_POST['SALEPLANTODO4FLG']: 'F';
    $data = $javaFunc->ctrlMemoOnClick($SALEPLANTODO4FLG, $MEMO);
    echo json_encode($data);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>