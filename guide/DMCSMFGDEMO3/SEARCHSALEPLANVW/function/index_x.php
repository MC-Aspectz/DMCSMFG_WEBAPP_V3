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

$data = array();
$javaFunc = new SearchSalePlan;
$minrow = 0;
$maxrow = 10;

// print_r($_POST);
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if(isset($_POST['ITEMCD'])) {
        $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
        $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
        $SALEDT =  isset($_POST['SALEPLANDTHD']) ? str_replace('-', '', $_POST['SALEPLANDTHD']): '';
        $ALLOWN = isset($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F';
        $query = $javaFunc->searchSalePlanVw($ITEMCD, $STAFFCD, $SALEDT, $ALLOWN);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)){
            $tdata = $query;
        }
    
    }
}
//--------------------------------------------------------------------------------
// ITEMCD ITEMNAME 
// STAFFCD STAFFNAME
// SALEDT ALLOWN
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$loadApp = getSystemData('SALEPLAN');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SALEPLAN');
    setSystemData('SALEPLAN', $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
//--------------------------------------------------------------------------------


//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    //
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

?>