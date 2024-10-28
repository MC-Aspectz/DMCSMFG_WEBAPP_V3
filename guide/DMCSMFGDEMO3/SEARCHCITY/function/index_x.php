<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php?citycd=';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new CustomerCity;

$COUNTRYCD = '';
$STATECD = '';
$S_CITYNAME = '';
$tdata = array();

$minrow = 0;
$maxrow = 10;

if(!empty($_POST)){
	$COUNTRYCD = isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']:'';
    $STATECD = isset($_POST['STATECD']) ? $_POST['STATECD']:'';
	$S_CITYNAME = isset($_POST['S_CITYNAME']) ? $_POST['S_CITYNAME']:'';
           //Syslogic(SearchCity1) COUNTRYCD,STATECD,S_CITYNAME

       $excute = $javaFunc->searchCity($COUNTRYCD,$STATECD,$S_CITYNAME);

       if(!empty($excute)){
        $tdata =  $excute;

       }

}

if(!empty($_GET)) {

    $COUNTRYCD = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']:'';
    $STATECD = isset($_GET['STATECD']) ? $_GET['STATECD']:'';

}




?>