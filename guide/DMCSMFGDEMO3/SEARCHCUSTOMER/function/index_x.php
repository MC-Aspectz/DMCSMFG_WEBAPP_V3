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

$javaFunc = new CustomerIndex;
$minrow = 0;
$maxrow = 10;
// $P1 = '';
// $P2 = '';
// $P3 = '';

$P1_CUSTCD = '';
$P2_CUSTCD = '';
$P3_CUSTNM = '';
$P4_SEARCHCHAR = '';
$P5_CUSTADDR = '';
$P6_CUSTADDR = '';

if(isset($_POST['search'])) {
	// $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	// $P2 = isset($_POST['P2']) ? $_POST['P2']: '';
	// $P3 = isset($_POST['P3']) ? $_POST['P3']: '';

    // $tdata = $javaFunc->searchCustomer($P1, $P2, $P3);

    $P1_CUSTCD = isset($_POST['P1_CUSTCD']) ? $_POST['P1_CUSTCD']: '';
    $P2_CUSTCD = isset($_POST['P2_CUSTCD']) ? $_POST['P2_CUSTCD']: '';
    $P3_CUSTNM = isset($_POST['P3_CUSTNM']) ? $_POST['P3_CUSTNM']: '';
    $P4_SEARCHCHAR = isset($_POST['P4_SEARCHCHAR']) ? $_POST['P4_SEARCHCHAR']: '';
    $P5_CUSTADDR = isset($_POST['P5_CUSTADDR']) ? $_POST['P5_CUSTADDR']: '';
    $P6_CUSTADDR = isset($_POST['P6_CUSTADDR']) ? $_POST['P6_CUSTADDR']: '';

    $excute = $javaFunc->getResult($P1_CUSTCD, $P2_CUSTCD, $P3_CUSTNM, $P4_SEARCHCHAR, $P5_CUSTADDR, $P6_CUSTADDR);
    // print_r($excute);
    if(!empty($excute)){
        $tdata = $excute;
    }
}
?>