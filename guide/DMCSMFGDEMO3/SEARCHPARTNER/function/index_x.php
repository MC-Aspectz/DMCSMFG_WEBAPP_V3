<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new Partner;
$syslogic = new Syslogic;

$minrow = 0;
$maxrow = 14;

$P1 = '';
$P2 = '';
$tdata = array();
// -------------------------------------------------------//
if(!empty($_GET)) {
    $P1 = isset($_GET['PARTNERTYP']) ? $_GET['PARTNERTYP']:'';
}
// -------------------------------------------------------//
if(!empty($_POST)) {
    if(isset($_POST['SEARCH'])) {
        $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
        $P2 = isset($_POST['P2']) ? $_POST['P2']: '';
        $query = $javaFunc->searchPartner($P1, $P2);
        $tdata = $query;
        // echo "<pre>";
        // print_r($tdata);
        // echo "</pre>";
    }
}
// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHPARTNER');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHPARTNER');
    $syslogic->ProgramRundelete('SEARCHPARTNER');
    setSystemData('SEARCHPARTNER', $loadApp);
} 
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$PARTNERTYPE = $data['DRPLANG']['PARTNER_TYPE'];
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>