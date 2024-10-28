<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new OfferIndex;

$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';


if(isset($_POST['search'])) {
  $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';

    // search.SearchGeneral.searchOffer P1,P2
  $tdata = $javaFunc->searchOffer($P1, $P2);

}

if(!empty($_GET)) {

// search.SearchGeneral.getItem P1 
  $P1 = isset($_GET['COSTTYPE']) ? $_GET['COSTTYPE']: '';

}

$typeItem = getDropdownData("COSTTYPE");
if(empty($typeItem)) {
    $typeItem = $syslogic->getPullDownData('COSTTYPE', $_SESSION['LANG']);
    setDropdownData("COSTTYPE", $typeItem);
}

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>