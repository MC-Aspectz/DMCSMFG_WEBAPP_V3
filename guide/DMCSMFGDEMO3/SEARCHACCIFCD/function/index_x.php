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

$tdata = array();
$syslogic = new SearchAccifcd;
$minrow = 0;
$maxrow = 10;

$ACCIFCDS = '';
$ACCIFNAMES = '';

if(isset($_POST['search'])) {
	$ACCIFCDS = isset($_POST['ACCIFCDS']) ? $_POST['ACCIFCDS']: '';
	$ACCIFNAMES = isset($_POST['ACCIFNAMES']) ? $_POST['ACCIFNAMES']: '';
	if(!empty($ACCIFCDS) || !empty($ACCIFNAMES) ) {
	    $excute = $syslogic->getAccifcd($ACCIFCDS, $ACCIFNAMES);
      	$tdata[] = array('ACCIFCD' => $excute['ACCIFCD'],
						 'ACCIFNAME' => $excute['ACCIFNAME']);

	} else {
		$tdata = $syslogic->getAccifcd($ACCIFCDS, $ACCIFNAMES);
		// echo '<pre>';
		// print_r($tdata);
		// echo '</pre>';
	}
	// print_r($tdata);
}


?>