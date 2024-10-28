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

$javaFunc = new CountryIndex;

$P2 = '';
$tdata = array();

$minrow = 0;
$maxrow = 10;

if(isset($_POST['search'])) {
	$P2 = $_POST['P2'];
	if(!empty($P2)) {
	    $excute = $javaFunc->searchCountry($P2);
		if(!empty($excute)){
      	$tdata[] = array('COUNTRYCD' => isset($excute['COUNTRYCD'])?$excute['COUNTRYCD'] :'',
		  'COUNTRYNAME' => isset($excute['COUNTRYNAME'])?$excute['COUNTRYNAME'] :''
	);

		}
							
	} else {
		
		$tdata = $javaFunc->searchCountry($P2);
	}

	
}
?>