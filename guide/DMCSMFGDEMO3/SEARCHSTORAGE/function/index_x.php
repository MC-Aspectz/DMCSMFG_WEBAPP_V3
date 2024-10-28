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
$javaFunc = new ItemLocation;
$minrow = 0;
$maxrow = 10;

$P1 = '';

if(isset($_POST['search'])) {
    $P1 = isset($_POST['P1']) ? $_POST['P1']: '';
    
    if(!empty($P1)) {
        $excute = $javaFunc->searchLocation($P1);
        $tdata[] = array('STORAGECD' => $excute['STORAGECD'],
                        'STORAGENAME' => $excute['STORAGENAME']);
    } else {
        $tdata = $javaFunc->searchLocation($P1);
    }
}
?>