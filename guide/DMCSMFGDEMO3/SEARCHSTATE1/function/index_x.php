<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php?statecd=';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new CustomerState;

$P1 = '';
$COUNTRYCD = '';

$STATENAME = '';
$tdata = array();
$minrow = 0;
$maxrow = 10;


if(!empty($_POST)){
   // print_r($excute);

	
	$COUNTRYCD = isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']:'';
    $STATENAME = isset($_POST['STATENAME']) ? $_POST['STATENAME']:'';
    //searchState($STATENAME,$COUNTRYCD)
        $excute = $javaFunc->searchState($STATENAME,$COUNTRYCD);
       if(!empty($excute)){
        // $tdata[] = array('STATECD' => $excute['STATECD'],
        // 'STATENAME' => $excute['STATENAME']);
        $tdata = $excute;
       }


      	// print_r($excute);
	} 

    if(!empty($_GET)) {

        $COUNTRYCD = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']:'';



    }





?>