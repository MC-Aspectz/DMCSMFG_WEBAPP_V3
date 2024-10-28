<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new LocationIndex;
$systemName = strtolower('SEARCHPURORPRO');

$minrow = 0;
$maxrow = 10;

if(!empty($_POST)) {

  if(isset($_POST['action']) && $_POST['action'] == 'unsetsession') { unsetSessionData(); }
  if(isset($_POST['SEARCH'])) {

    $data['P1'] = isset($_POST['P1']) ? $_POST['P1']: '';
  	$data['P2'] = isset($_POST['P2']) ? $_POST['P2']: '';
  	$data['P3'] = isset($_POST['P3']) ? $_POST['P3']: '';
  	$data['ODRTYP'] = isset($_POST['ODRTYP']) ? $_POST['ODRTYP']: '';
    $P2 = isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '';
    $P3 = isset($_POST['P3']) ? str_replace('-', '', $_POST['P3']): '';

    $tdata = $javaFunc->searchPurOrPro($data['ODRTYP'], $data['P1'], $P2, $P3);

    setSessionArray($data); 
  }

}

if(!empty($_GET)) {

    if(isset($_GET['P1'])) {

        $P1 = isset($_GET['P1']) ? $_GET['P1']: '';

        $query = $javaFunc->getItem($P1);

        $data = $query;

    } else if(isset($_GET['ALLOCORDERTYP'])) {

        $query = array('ODRTYP' => isset($_GET['ALLOCORDERTYP']) ? $_GET['ALLOCORDERTYP']: '');

        $data = $query;

    }

    if(!empty($query)) {
      setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }

}

$typeItem = getDropdownData('ODRTYPFORSEARCH');
if(empty($typeItem)) {
    $typeItem = $syslogic->getPullDownData('ODRTYPFORSEARCH', $_SESSION['LANG']);
    setDropdownData('ODRTYPFORSEARCH', $typeItem);
}


function setSessionArray($arr){
    $keepField = array('ODRTYP', 'P1', 'P2', 'P1NAME', 'P3');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}
?>