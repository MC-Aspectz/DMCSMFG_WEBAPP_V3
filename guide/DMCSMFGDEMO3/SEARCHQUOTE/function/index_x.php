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

$javaFunc = new QuoteIndex;
$minrow = 0;
$maxrow = 10;
$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';
$P5 = '';
$P1NAME = '';
$tdata = array();

if(!empty($_GET)) {
	$P1 = isset($_GET['P1CODE']) ? $_GET['P1CODE']: '';
	$P1NAME = isset($_GET['P1NAME']) ? $_GET['P1NAME']: '';
}

if (isset($_POST['action'])) {
 	if ($_POST['action'] == 'P1') { getCus(); }
	if ($_POST['action'] == 'SEARCH') { searchQuote(); }
}

function getCus() {
    $javafunc = new QuoteIndex;
    $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    $query = $javafunc->getCus($P1);
    echo json_encode($query);
}  

function searchQuote() {
	global $tdata, $P1, $P2, $P3, $P4, $P5; 
    $javaFunc = new QuoteIndex;
	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
	$P3 = isset($_POST['P3']) ? str_replace('-', '', $_POST['P3']): '';
	$P4 = isset($_POST['P4']) ? str_replace('-', '', $_POST['P4']): '';
	$P5 = isset($_POST['P5']) ? $_POST['P5']: '';
  	$tdata = $javaFunc->searchQuote($P1, $P2, $P3, $P4, $P5);
    // echo '<pre>';
    // print_r($tdata);
    // echo '</pre>';
}
?>