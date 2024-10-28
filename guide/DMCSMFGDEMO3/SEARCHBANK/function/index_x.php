<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new SearchBank;

$P1 = '';
$tdata = array();

if(isset($_POST['search'])) {
	$P1 = $_POST['P1'];
	if(!empty($P1) || !empty($P2) ) {
	    $excute = $syslogic->searchBank($P1);
      	$tdata[] = array('BANKCD' => $excute['BANKCD'],
						 'BANKNAME' => $excute['BANKNAME']);

	} else {
		$tdata = $syslogic->searchBank($P1);
		// echo '<pre>';
		// print_r($tdata);
		// echo '</pre>';
	}
	// print_r($tdata);
}
?>