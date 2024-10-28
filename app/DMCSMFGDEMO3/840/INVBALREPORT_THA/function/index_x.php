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


$javaFunc = new InvBalRpt;
$data = array();
$systemName = 'InvBalRpt';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;
$rowno = 0;
//ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
$ACCCDF ='';
$ACCCDT ='';
$ITEMCDF = '';
$ITEMCDT ='';
$ITEMTYPF ='';
$ITEMTYPT = '';
$STORAGECDF ='';
$STORAGECDT ='';
$ASOFDT ='';

// print_r($_POST);

if(!empty($_POST)) {
   if(isset($_POST['search'])) {
    // print_r('2');
        unsetSessionkey('INV');
        $data['ACCCDF'] = $_POST['ACCCDF'];
        $data['ACCCDT'] = $_POST['ACCCDT'];
        $data['ITEMCDF'] = $_POST['ITEMCDF'];
        $data['ITEMCDT'] = $_POST['ITEMCDT'];
        $data['ITEMTYPF'] = $_POST['ITEMTYPF'];
        $data['ITEMTYPT'] = $_POST['ITEMTYPT'];
        $data['STORAGECDF'] = $_POST['STORAGECDF'];
        $data['STORAGECDT'] = $_POST['STORAGECDT'];
        $data['ASOFDT'] = $_POST['ASOFDT'];


//SysLogic(GetInvTranBalance)	ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
        $query = $javaFunc->GetInvTranBalance($_POST['ACCCDF'],$_POST['ACCCDT'],$_POST['ITEMCDF'],
                                                $_POST['ITEMCDT'],$_POST['ITEMTYPF'],$_POST['ITEMTYPT'],
                                                $_POST['STORAGECDF'],$_POST['STORAGECDT'],str_replace('-','',$_POST['ASOFDT']));
        // print_r($_POST['ASOFDT']);
        // $data['INV'] = $query;
        // $query['line'] = 1;
        if(!empty($query)){

        foreach($query as &$line)
        {
            $line['line'] = 1;
        }
        // echo "<pre>";
        // print_r($query);
        // echo "</pre>";
        
        $uptemp1 = $javaFunc->UpTmpInvTran1($query);

        if(!empty($query)){

        // echo "<pre>";
        $query1 = $javaFunc->GetAccLine();
        // print_r($query1);
        // echo "</pre>";
        foreach($query1 as &$line)
        {
            $line['line'] = 1;
        }

        $uptemp2 = $javaFunc->UpTmpInvTran2($query1);
        
        $sumarray1 = array_merge_recursive($query,$query1);

        // echo "<pre>";
        $query2 = $javaFunc->GetAccSumLine();
        // print_r($query2);
        // echo "</pre>";
        foreach($query2 as &$line)
        {
            $line['line'] = 2;
        }

        $uptemp3 = $javaFunc->UpTmpInvTran3($query2);


        $sumarray2 = array_merge_recursive($sumarray1,$query2);

        // echo "<pre>";
        $query3 = $javaFunc->GetGrandTotalLine();
        $grand[1] = $query3;
        // print_r($grand);
        // echo "</pre>";
        // echo "<pre>";

        $uptemp4 = $javaFunc->UpTmpInvTran4($query3);


        array_multisort(array_column($sumarray2,'ACCCD'),SORT_ASC,array_column($sumarray2,'line'),SORT_ASC,$sumarray2);

        $sumarray3 = array_merge_recursive($sumarray2,$query3);

        //print_r($sumarray3);
        // echo "</pre>";

        $data['INV'] = $sumarray3;
    }

        }

// print_r($data['INV']);
        if(!empty($query)) {
            setSessionArray($data); 

        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($CODEKEY_S);
    }
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }

        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(!empty($_GET)) {
//ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $ACCCDF = isset($data['ACCCDF']) ? $data['ACCCDF']: '';
        $ACCCDT = isset($data['ACCCDT']) ? $data['ACCCDT']: '';
        $ITEMCDF = isset($data['ITEMCDF']) ? $data['ITEMCDF']: '';
        $ITEMCDT = isset($data['ITEMCDT']) ? $data['ITEMCDT']: '';
        $ITEMTYPF = isset($data['ITEMTYPF']) ? $data['ITEMTYPF']: '';
        $ITEMTYPT = isset($data['ITEMTYPT']) ? $data['ITEMTYPT']: '';
        $STORAGECDF = isset($data['STORAGECDF']) ? $data['STORAGECDF']: '';
        $STORAGECDT = isset($data['STORAGECDT']) ? $data['STORAGECDT']: '';
        $ASOFDT = isset($data['ASOFDT']) ? $data['ASOFDT']: '';
        
        $query = $javaFunc->GetInvTranBalance($_POST['ACCCDF'],$_POST['ACCCDT'],$_POST['ITEMCDF'],
                                                $_POST['ITEMCDT'],$_POST['ITEMTYPF'],$_POST['ITEMTYPT'],
                                                $_POST['STORAGECDF'],$_POST['STORAGECDT'],$_POST['ASOFDT'],);
        $data['INV'] = $query;
        setSessionArray($data); 
    }

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    // onchange
    // if(isset($_GET['ITEMCODE'])) {
    //     // unsetSessionData();
    //     $data['ITEMCODE'] = isset($_GET['ITEMCODE']) ? $_GET['ITEMCODE']: '';
    //     $excute = $javaFunc->getItem($_GET['ITEMCODE']);
    //     $data['ITEMNAME'] = $excute['ITEMNAME'];
    //     $data = $excute;

    // }

    // get from search page
    // itemcode   itemname  speciafication  drawingno   search  saleenddate
    // if(isset($_GET['itemcd']))
    // {
    //     $data['ITEMCODE'] = isset($_GET['itemcd']) ? $_GET['itemcd']: '';
    //     $excute = $javaFunc->getItem($data['ITEMCODE']);
    //     // $data['ITEMNAME'] = $excute['ITEMNAME'];
    //     $data = $excute;

        // print_r($_GET['itemcd']);
    // }
    if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['ACCCDF'] = $_GET['acccode'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        $data['ACCCDT'] = $_GET['acccode'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==3)
    {
        $data['ITEMCDF'] = $_GET['itemcd'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==4)
    {
        $data['ITEMCDT'] = $_GET['itemcd'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==5)
    {
        $data['STORAGECDF'] = $_GET['locationcd'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==6)
    {
        $data['STORAGECDT'] = $_GET['locationcd'];
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


// $test = getSystemData($_SESSION['APPCODE']."test");
// if(empty($test)) {
//     $test = $javaFunc->FormLoad();
//     setSystemData($_SESSION['APPCODE']."test", $test);
// }
// print_r($test);
// $data['COMPANYNAME'] = $test;

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

$typf = $data['DRPLANG']['ITEM_TYPE'];
$typt = $data['DRPLANG']['ITEM_TYPE'];
// $loc = $data['DRPLANG']['TRXTYPE'];
// $unit = $data['DRPLANG']['UNIT'];

// $javaFunc->get_com();


// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

// $typf = getDropdownData("ITEM_TYPE");
// if(empty($typf)) {
//     $typf = $syslogic->getPullDownData('ITEM_TYPE', $_SESSION['ITEM_TYPE']);
//     setDropdownData("ITEM_TYPE", $typf);
// }

// $typt = getDropdownData("ITEM_TYPE");
// if(empty($typt)) {
//     $typt = $syslogic->getPullDownData('ITEM_TYPE', $_SESSION['ITEM_TYPE']);
//     setDropdownData("ITEM_TYPE", $typt);
// }

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

//ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
function printed() {
    global $data;
    $data = getSessionData();
    $printfunc = new InvBalRpt;
    // print_r($data['ASOFDT']);
    date("Ymd", strtotime($data['ASOFDT']));
    $printStatic = $printfunc->printStatic($data['ACCCDF'],$data['ACCCDT'],$data['ITEMCDF'],
                                            $data['ITEMCDT'],$data['ITEMTYPF'],$data['ITEMTYPT'],
                                            $data['STORAGECDF'],$data['STORAGECDT'],date("Ymd", strtotime($data['ASOFDT'])),);
    $printDynamic = $printfunc->printDynamic($data['ACCCDF'],$data['ACCCDT'],$data['ITEMCDF'],
                                            $data['ITEMCDT'],$data['ITEMTYPF'],$data['ITEMTYPT'],
                                            $data['STORAGECDF'],$data['STORAGECDT'],date("Ymd", strtotime($data['ASOFDT'])),);
    $data['PRINTSTATIC'] = $printStatic;
    if(!empty($printDynamic)) {
        if(empty($printDynamic['ROWCOUNTER'])) {
            for ($i = 1 ; $i < count($printDynamic)+1; $i++) {
                $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
            }
        } else {
            $data['PRINTDYNAMIC'][$printDynamic['ROWCOUNTER']] = $printDynamic; 
        }
    }


    setSessionArray($data);
    // echo "<pre>";
    // print_r($data['PRINTSTATIC']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['PRINTDYNAMIC']);
    // echo "</pre>";
}

//ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
function setSessionArray($arr){
    $keepField = array('INV', 'ACCCDF', 'ACCCDT', 'ITEMCDF', 'ITEMCDT', 'ITEMTYPF', 'ITEMTYPT', 'STORAGECDF', 'STORAGECDT','ASOFDT');
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