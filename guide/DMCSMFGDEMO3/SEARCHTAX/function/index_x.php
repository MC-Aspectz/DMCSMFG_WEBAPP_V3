<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new TaxCodeIndex;

$TAXCODE = '';
$P2 = '';

if(isset($_POST['search'])) {
  $data['TAXCODE'] = isset($_POST['TAXCODE']) ? $_POST['TAXCODE']: '';
  $query = $javaFunc->search($data['TAXCODE']);
  $tdata = $query;



  // print_r($tdata);
}

if(!empty($_GET)) {

  $TAXCODE = isset($_GET['TAXCODE']) ? $_GET['TAXCODE']:'';

}

$typeItem1 = getDropdownData("TAXTTL");
if(empty($typeItem1)) {
    $typeItem1 = $syslogic->getPullDownData('TAXTTL', $_SESSION['LANG']);
    setDropdownData("TAXTTL", $typeItem1);
}

$typeItem2 = getDropdownData("TAX02");
if(empty($typeItem2)) {
    $typeItem2 = $syslogic->getPullDownData('TAX02', $_SESSION['LANG']);
    setDropdownData("TAX02", $typeItem2);
}

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>