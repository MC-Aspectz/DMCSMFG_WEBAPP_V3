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

$javaFunc = new DirectMaster;

$P1 = '';
$tdata = array();
$minrow = 0;
$maxrow = 10;



if(isset($_POST['search'])) {
	$P1 = $_POST['P1'];
	if(!empty($P1)) {
	    $excute = $javaFunc->searchDirect($P1);
      	$tdata[] = array(	'DIRECTCD' => $excute['DIRECTCD'],
							'DIRECTNAME' => $excute['DIRECTNAME']);
	} else {
		$tdata = $javaFunc->searchDirect($P1);
	}
}
?>