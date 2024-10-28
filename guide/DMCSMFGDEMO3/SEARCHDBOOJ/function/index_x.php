<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php?statecd=';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$javaFunc = new TableIndex;

$P1 = '';

$tdata = array();
$minrow = 0;
$maxrow = 10;


if(!empty($_POST)){
   // print_r($excute);

	
	$P1 = isset($_POST['P1']) ? $_POST['P1']:'';
    

    $tdata = $javaFunc->Searchtable($P1);
       // $STATENAME = $_POST['STATENAME'];
    //    $excute = $javaFunc->searchState($COUNTRYCD,$STATENAME);
    //    if(!empty($excute)){
    //     $tdata[] = array('STATECD' => $excute['STATECD'],
    //     'STATENAME' => $excute['STATENAME']);

    //    }


      	//print_r($excute);
	} 







?>