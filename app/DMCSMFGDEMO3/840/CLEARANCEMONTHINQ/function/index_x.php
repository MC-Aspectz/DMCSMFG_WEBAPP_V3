<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = "";
//--------------------------------------------------------------------------------
//  LANGUAGE
// if (isset($_SESSION['LANG'])) {
//     require_once('./lang/' . strtolower($_SESSION['LANG']) . '.php');
// } else {  
//     require_once('./lang/en.php');
// }
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}


$javaFunc = new ClearanceMonthInq;
$data = array();
$systemName = 'ClearanceMonthInq';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;
//YEAR,MONTH,CLEARANCE,ITEMTYPE,DIVISIONCD,ITEMCD,ADJUSTFLG,ALLITEM,DISPFLOATSCALE
//DIVISIONNAME,ITEMNAME,ITEMSPEC,CLEARANCE_ARRANGE_DATE,LASTBATCHMONTH
$YEAR ='';
$MONTH ='';
$CLEARANCE = '';
$ITEMTYPE ='';
$DIVISIONCD ='';
$ITEMCD = '';
$ADJUSTFLG ='';
$ALLITEM ='';
$DISPFLOATSCALE ='';
$DIVISIONNAME ='';
$ITEMNAME = '';
$ITEMSPEC ='';
$CLEARANCE_ARRANGE_DATE ='';
$LASTBATCHMONTH ='';


if(!empty($_POST)) {
   if(isset($_POST['search'])) {
        $data['YEAR'] = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
        $data['MONTH'] = isset($_POST['MONTH']) ? $_POST['MONTH']: '';
        $data['CLEARANCE'] = isset($_POST['CLEARANCE']) ? $_POST['CLEARANCE']: '';
        $data['ITEMTYPE'] = isset($_POST['ITEMTYPE']) ? $_POST['ITEMTYPE']: '';
        $data['DIVISIONCD'] = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
        $data['ITEMCD'] = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
        $data['ADJUSTFLG'] =isset($_POST['ADJUSTFLG']) ? $_POST['ADJUSTFLG']: '';
        $data['ALLITEM'] = isset($_POST['ALLITEM']) ? $_POST['ALLITEM']: '';
        $data['DISPFLOATSCALE'] = isset($_POST['DISPFLOATSCALE']) ? $_POST['DISPFLOATSCALE']: '';

        //isset($_POST['YEAR']) ? $_POST['YEAR']: '';
        //inv.ClearanceMonthInq.search	YEAR,MONTH,CLEARANCE,ITEMTYPE,DIVISIONCD,ITEMCD,ADJUSTFLG,ALLITEM,DISPFLOATSCALE
        $query = $javaFunc->search($data['YEAR'],$data['MONTH'],$data['CLEARANCE'],
                                    $data['ITEMTYPE'],$data['DIVISIONCD'],$data['ITEMCD'],
                                    $data['ADJUSTFLG'],$data['ALLITEM'],$data['DISPFLOATSCALE']);
        $data['CMI'] = $query;
        // print_r($data['CMI']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($data);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }

        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    
    //inv.ClearanceMonthInq.search	YEAR,MONTH,CLEARANCE,ITEMTYPE,DIVISIONCD,ITEMCD,ADJUSTFLG,ALLITEM,DISPFLOATSCALE
    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $YEAR = isset($data['YEAR']) ? $data['YEAR']: '';
        $MONTH = isset($data['MONTH']) ? $data['MONTH']: '';
        $CLEARANCE = isset($data['CLEARANCE']) ? $data['CLEARANCE']: '';
        $ITEMTYPE = isset($data['ITEMTYPE']) ? $data['ITEMTYPE']: '';
        $DIVISIONCD = isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        $ADJUSTFLG = isset($data['ADJUSTFLG']) ? $data['ADJUSTFLG']: '';
        $ALLITEM = isset($data['ALLITEM']) ? $data['ALLITEM']: '';
        $DISPFLOATSCALE = isset($data['DISPFLOATSCALE']) ? $data['DISPFLOATSCALE']: '';
        
        $query = $javaFunc->search($YEAR,$MONTH,$CLEARANCE,$ITEMTYPE,$DIVISIONCD,$ITEMCD,$ADJUSTFLG,$ALLITEM,$DISPFLOATSCALE);
        $data['CMI'] = $query;
        setSessionArray($data); 
        // print_r($data);
    }
// onchange DIVISIONCD    ITEMCD
    else if(isset($_GET['DIVISIONCD'])) {
        unsetSessionkey('DIVISIONCD');
        unsetSessionkey('DIVISIONNAME');

        $data['DIVISIONCD'] = isset($_GET['DIVISIONCD']) ? $_GET['DIVISIONCD']: '';
        $excute = $javaFunc->getDiv($data['DIVISIONCD']);
        $data = $excute;

    }

    else if(isset($_GET['ITEMCD'])) {
        unsetSessionkey('ITEMCD');
        unsetSessionkey('ITEMNAME');
        unsetSessionkey('ITEMSPEC');

        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->getIm($_GET['ITEMCD']);
        $data = $excute;
    }

    //from search
    
    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['DIVISIONCD'] = $_GET['divisioncd'];
        $excute = $javaFunc->getDiv($data['DIVISIONCD']);
        $data = $excute;
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        $data['ITEMCD'] = $_GET['itemcd'];
        $excute = $javaFunc->getIm($data['ITEMCD']);
        // $data = $excute;
        setSessionArray($data); 

    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }


    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('3');
    }
    // print_r($data);
}

//load
$test = getSystemData($_SESSION['APPCODE']."test");
if(empty($test)) {
    $test = $javaFunc->load();
    setSystemData($_SESSION['APPCODE']."test", $test);
}
$data['CADATE'] = $test;

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$year = $data['DRPLANG']['YEAR'];
$month = $data['DRPLANG']['MONTHVALUE'];
$clear = $data['DRPLANG']['CLEARANCE'];
$ityp = $data['DRPLANG']['ITEM_TYPE'];

// $javaFunc->get_com();


// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


// $opr = getDropdownData("TRXTYPE");
// if(empty($opr)) {
//     $opr = $syslogic->getPullDownData('TRXTYPE', $_SESSION['TRXTYPE']);
//     setDropdownData("TRXTYPE", $opr);
// }

// $str = getDropdownData("STORAGETYPE");
// if(empty($str)) {
//     $str = $syslogic->getPullDownData('STORAGETYPE', $_SESSION['STORAGETYPE']);
//     setDropdownData("STORAGETYPE", $str);
// }

// function printed() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new ClearanceMonthInq;
//     $printStatic = $printfunc->printStatic($data['ITEMCODE'],$data['ITEMNAME'],$data['ITEMSPEC'],$data['ONHAND'],
//                                         $data['BACKLOG'],$data['FROMDATE'],$data['TODATE'],'',);
//     $printDynamic = $printfunc->printDynamic($data['ITEMCODE'],$data['ITEMNAME'],$data['ITEMSPEC'],$data['ONHAND'],
//                                        $data['BACKLOG'],$data['FROMDATE'],$data['TODATE'],'',);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         if(empty($printDynamic['ROWCOUNTER'])) {
//             for ($i = 1 ; $i < count($printDynamic)+1; $i++) {
//                 $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//             }
//         } else {
//             $data['PRINTDYNAMIC'][$printDynamic['ROWCOUNTER']] = $printDynamic; 
//         }
//     }


//     setSessionArray($data);
//     // echo "<pre>";
//     // print_r($data);
//     // echo "</pre>";
// }

//YEAR,MONTH,CLEARANCE,ITEMTYPE,DIVISIONCD,ITEMCD,ADJUSTFLG,ALLITEM,DISPFLOATSCALE
//DIVISIONNAME,ITEMNAME,ITEMSPEC,CLEARANCE_ARRANGE_DATE,LASTBATCHMONTH
function setSessionArray($arr){
    $keepField = array('CMI', 'YEAR', 'MONTH', 'CLEARANCE', 'ITEMTYPE', 'DIVISIONCD', 'ITEMCD', 'ADJUSTFLG', 'ALLITEM',
                        'DISPFLOATSCALE','DIVISIONNAME','ITEMNAME','ITEMSPEC','CLEARANCE_ARRANGE_DATE','LASTBATCHMONTH');
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

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getDropdownData($key = "") {
    return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
    return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = "") {
    return get_sys_data(SESSION_NAME_SYSTEM, $key);
}
  
function setSystemData($key, $val) {
return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

?>