<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
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

$syslogic = new Syslogic;
$javaFunc = new DepartmentIndex;

$minrow = 0;
$maxrow = 10;
$P1 = '';
$tdata = array();

if(isset($_POST['search'])) {
	$tdata = $javaFunc->searchDepartment();
}

$branchtype = getDropdownData('BRANCH_TYPE');
if(empty($branchtype)) {
    $branchtype = $syslogic->getPullDownData('BRANCH_TYPE', $_SESSION['LANG']);
    setDropdownData('BRANCH_TYPE', $branchtype);
}
//print_r($branchtype);

function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

?>