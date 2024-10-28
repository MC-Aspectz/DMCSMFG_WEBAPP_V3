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


$javaFunc = new WorkCenterMaster;
$data = array();
$systemName = 'WorkCenterMaster';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 5;
$rowno = 0;
//ตัวแปรในindex_class
// WCCD_S,COMPRICETYPE
//,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,

$WCCD_S ='';
$COMPRICETYPE ='';
$WCCD = '';
$WCNAME ='';
$DIVISIONCD ='';
$STAFFNAME = '';
$WCSTDHOURRATE ='';
$WCSTDCOST ='';
$WCHOURRATE ='';
$WCCOST ='';
$WCDISPLAYFLG = '';
$STAFFCD ='';
$WCTYP ='';
//['LOAD']['CURRENCYDISP']
$LOAD ='';
$CURRENCYDISP ='';


if(!empty($_POST)) {
   if(isset($_POST['search'])) {
        global $data;
        $data = getSessionData(); 

        // print_r("search click");
        // print_r($_POST['WCCD_S']);
        //mas.WorkcenterMaster.search	WCCD_S,COMPRICETYPE 
        $data['WCCD_S'] = isset($_POST['WCCD_S']) ? $_POST['WCCD_S']: '';
        $data['COMPRICETYPE'] = isset($_POST['COMPRICETYPE']) ? $_POST['COMPRICETYPE']: '';

        $query = $javaFunc->search($data['WCCD_S'],$data['COMPRICETYPE']);
        // $data['WORK'] = $query;
        // print_r($query);
        if(!empty($query)) {
            $data['WORK'] = array();
            // for ($i = 1 ; $i < count($query)+1; $i++) {
                $data['WORK'] = $query; 
                // $data['WORK'][$i] = $query[$i]; 
            // }

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
        // if ($_POST['action'] == "keepWcData") { keepWcData(); }
        // if ($_POST['action'] == "commit") { commit(); }
        if ($_POST['action'] == "insert") { insertWc(); }
        if ($_POST['action'] == "update") { updateWc(); }
        if ($_POST['action'] == "delete") { deleteWc(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    
    //mas.WorkcenterMaster.search	WCCD_S,COMPRICETYPE
        if(isset($_GET['refresh'])) {
            // print_r('refresh');

        $data = getSessionData();
        $WCCD_S = isset($data['WCCD_S']) ? $data['WCCD_S']: '';
        $COMPRICETYPE = isset($data['COMPRICETYPE']) ? $data['COMPRICETYPE']: '';
        
        $excute = $javaFunc->search($WCCD_S,$COMPRICETYPE);
        // print_r($excute);
        if(!empty($excute)) {
            unsetSessionkey('WORK');

            // $data['WORK'] = array();
            // for ($i = 1 ; $i < count($excute)+1; $i++) {
                $data['WORK'] = $excute; 
                // $data['WORK'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }

    }

    // onchange WCCD
    else if(isset($_GET['WCCD'])) {
        // print_r('onchange wc');

        unsetSessionkey('WCCD');
        unsetSessionkey('WCNAME');

        //mas.WorkcenterMaster.getWc	WCCD
        $data['WCCD'] = isset($_GET['WCCD']) ? $_GET['WCCD']: '';
        $excute = $javaFunc->getWc($data['WCCD']);
        $data = $excute;
        // print_r($data);

        // if(!empty($data['WCCD'])&&!empty($data['INVTRANTYPE']))
        // {
        //     $query = $javaFunc->search($data['WCCD'],$data['INVTRANTYPE']);
        //     $data['WORK'] = $query;
        //     print_r($data['WORK']);
        //     if(!empty($query)) {
        //         setSessionArray($data); 
    
        //     }
    
        // }
    }

// onchange   DIVISIONCD
    else if(isset($_GET['DIVISIONCD'])) {
        // print_r('onchange division');

        unsetSessionkey('DIVISIONCD');
        unsetSessionkey('DIVISIONNAME');
        //mas.DivisionMaster.getDiv	DIVISIONCD
        $data['DIVISIONCD'] = isset($_GET['DIVISIONCD']) ? $_GET['DIVISIONCD']: '';
        $excute = $javaFunc->getDiv($_GET['DIVISIONCD']);
        $data = $excute;
        // print_r($data);
    }

// onchange   STAFFCD
    else if(isset($_GET['STAFFCD'])) {
        // print_r('onchange staff');

        unsetSessionkey('STAFFCD');
        unsetSessionkey('STAFFNAME');
        //mas.StaffMaster.getStaff	STAFFCD
        $data['STAFFCD'] = isset($_GET['STAFFCD']) ? $_GET['STAFFCD']: '';
        $excute = $javaFunc->getStaff($_GET['STAFFCD']);
        $data = $excute;
        // print_r($data);
    }

    //from search ***
    //mas.WorkcenterMaster.getWc	WCCD department
    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        // print_r('search wc');
        // print_r($_GET['divisioncd']);
        $data['WCCD_S'] = $_GET['divisioncd'];
        // $excute = $javaFunc->getWc($data['WCCD_S']);
        // $data = $excute;
        setSessionArray($data); 
        // print_r($data);

        // if(!empty($data['INVTRANNO'])&&!empty($data['INVTRANTYPE']))
        // {
        //     global $data;
        //     $data = getSessionData(); 
    
        //     $query = $javaFunc->search($data['INVTRANNO'],$data['INVTRANTYPE']);
        //     print_r($query);
        //     if(!empty($query)) {
        //         $data['WORK'] = array();
        //         // for ($i = 1 ; $i < count($query)+1; $i++) {
        //             $data['WORK'][1] = $query; 
        //             // $data['WORK'][$i] = $query[$i]; 
        //         // }
        //         setSessionArray($data);
        
        //     }
    
        // }

    }

    //mas.DivisionMaster.getDiv	DIVISIONCD  
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        // print_r('search division');

        // $data['LOCTYP'] = $_GET['loctype'];
        $data['DIVISIONCD'] = $_GET['divisioncd'];
        $excute = $javaFunc->getDiv($data['DIVISIONCD']);
        // print_r($excute);
        $data = $excute;
        setSessionArray($data); 

    }

    //mas.StaffMaster.getStaff	STAFFCD staffcode
    else if(!empty($_GET['index'])&&$_GET['index']==3)
    {        
        // print_r('search staff');

        $data['STAFFCD'] = $_GET['staffcd'];
        $excute = $javaFunc->getStaff($data['STAFFCD']);
        // print_r($excute);
        $data = $excute;
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
$data['LOAD'] = $test;
    // print_r($test);

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


$dd1 = $data['DRPLANG']['JOBCODE'];
// $dd2 = $data['DRPLANG']['STORAGETYPE'];
// $dd3 = $data['DRPLANG']['WITHDRAW_PURPOSE'];
// $dd4 = $data['DRPLANG']['UNIT'];
// $data['INVTRANTYPE']='10';
// $data['LOCTYP']='0';
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

// function commit() {
//     global $data;
    
//     //acc.AccInvTranEntry.commitAll	DVWDETAIL,INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM
//     $javaInsrt = new WorkCenterMaster;
//     $Param = array( "DVWDETAIL" => isset($data['WORK']) ? $data['WORK']: '',
//                     "INVTRANNO" => $_POST['INVTRANNO'],
//                     "INVTRANTYPE" => $_POST['INVTRANTYPE'],
//                     "INVTRANISSUEDT" => $_POST['INVTRANISSUEDT'],
//                     "LOCTYP" => $_POST['LOCTYP'],
//                     "LOCCD" => $_POST['LOCCD'],
//                     "LOCNAME" => $_POST['LOCNAME'],
//                     "WDPURPOSE" => $_POST['WDPURPOSE'],
//                     "INVTRANREM" => $_POST['INVTRANREM'],);
//                     // print_r($Param);
//     $commit = $javaInsrt->commitAll($Param);

//     // unset 2 ตัวนี้เพราะค่าอื่นยังต้องใช้
//     // unsetSessionkey('STATECD');
//     // unsetSessionkey('STATENAME');
    
//     // unsetSessionData();
//     echo json_encode($commit);
// }

// function update() {
//     //
//     $javaUpd = new WorkCenterMaster;
//     $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
//                     "STATECD" => $_POST['STATECD'],
//                     "STATENAME" => $_POST['STATENAME']);
//     $update = $javaUpd->update($Param);
//     unsetSessionkey('STATECD');
//     unsetSessionkey('STATENAME');
//     // unsetSessionData();
//     echo json_encode($update);
// }

// function deletes() {
//     $javaDel = new WorkCenterMaster;
//     $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
//                     "STATECD" => $_POST['STATECD'],
//                     "STATENAME" => $_POST['STATENAME']);
//     $deletes = $javaDel->delete($Param);
//     unsetSessionkey('STATECD');
//     unsetSessionkey('STATENAME');
//     // unsetSessionData();
//     echo json_encode($deletes);
// }


    //mas.WorkcenterMaster.insWc	WCCD_S,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,COMPRICETYPE
    function insertWc() {
        // print_r('insertWc');
        $javaInsrt = new WorkCenterMaster;
        $CHECKWCDISPLAYFLG = isset($_POST['WCDISPLAYFLG']) ? 'T': 'F' ;

        $Param = array( "WCCD_S" => $_POST['WCCD_S'],
                        "WCCD" => $_POST['WCCD'],
                        "WCNAME" => $_POST['WCNAME'],
                        "DIVISIONCD" => $_POST['DIVISIONCD'],
                        "STAFFNAME" => $_POST['STAFFNAME'],
                        "WCSTDHOURRATE" => $_POST['WCSTDHOURRATE'],
                        "WCSTDCOST" => $_POST['WCSTDCOST'],
                        "WCHOURRATE" => $_POST['WCHOURRATE'],
                        "WCCOST" => $_POST['WCCOST'],
                        // "WCDISPLAYFLG" => $_POST['WCDISPLAYFLG'],
                        "WCDISPLAYFLG" => $CHECKWCDISPLAYFLG,
                        "STAFFCD" => $_POST['STAFFCD'],
                        "WCTYP" => $_POST['WCTYP'],
                        "COMPRICETYPE" => $_POST['COMPRICETYPE']);
                        // print_r($Param);
        $insertWc = $javaInsrt->insWc($Param);

        unsetSessionData();
        echo json_encode($insertWc);
    }

    //mas.WorkcenterMaster.updWc	WCCD_S,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,COMPRICETYPE
    function updateWc() {
        $javaUpd = new WorkCenterMaster;
        $CHECKWCDISPLAYFLG = isset($_POST['WCDISPLAYFLG']) ? 'T': 'F' ;

        $Param = array( "WCCD_S" => $_POST['WCCD_S'],
                        "WCCD" => $_POST['WCCD'],
                        "WCNAME" => $_POST['WCNAME'],
                        "DIVISIONCD" => $_POST['DIVISIONCD'],
                        "STAFFNAME" => $_POST['STAFFNAME'],
                        "WCSTDHOURRATE" => $_POST['WCSTDHOURRATE'],
                        "WCSTDCOST" => $_POST['WCSTDCOST'],
                        "WCHOURRATE" => $_POST['WCHOURRATE'],
                        "WCCOST" => $_POST['WCCOST'],
                        // "WCDISPLAYFLG" => $_POST['WCDISPLAYFLG'],
                        "WCDISPLAYFLG" => $CHECKWCDISPLAYFLG,
                        "STAFFCD" => $_POST['STAFFCD'],
                        "WCTYP" => $_POST['WCTYP'],
                        "COMPRICETYPE" => $_POST['COMPRICETYPE']);
        $updateWc = $javaUpd->updWc($Param);
        unsetSessionData();
        echo json_encode($updateWc);
    }

    //mas.WorkcenterMaster.delWc	WCCD_S,WCCD,COMPRICETYPE
    function deleteWc() {
        $javaDel = new WorkCenterMaster;
        $Param = array( "WCCD_S" => $_POST['WCCD_S'],
                        "WCCD" => $_POST['WCCD'],
                        "COMPRICETYPE" => $_POST['COMPRICETYPE']);
        $deleteWc = $javaDel->delWc($Param);
        unsetSessionData();
        echo json_encode($deleteWc);
    }
    
//tableกับตัวแปรที่ใช้ทุกตัว
// WCCD_S,COMPRICETYPE
//,WCCD,WCNAME,DIVISIONCD,STAFFNAME,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,WCDISPLAYFLG,STAFFCD,WCTYP,
function setSessionArray($arr){
    $keepField = array('WORK', 'WCCD_S', 'COMPRICETYPE', 'WCCD', 'WCNAME', 'DIVISIONCD', 'DIVISIONNAME', 'STAFFNAME', 'STAFFCD', 'WCSTDHOURRATE', 'WCSTDCOST', 'WCHOURRATE',
                        'WCCOST','WCDISPLAYFLG','STAFFCD','WCTYP','LOAD','KEEPSTATUS');
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

// function keepWcData() {
//     global $data;
//     for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
//         $data['WORK'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
//                                     'INVTRANNO' => $_POST['INVTRANNOA'][$i],
//                                     'INVTRANTYPE' => $_POST['INVTRANTYPEA'][$i],
//                                     'INVTRANISSUEDT' => $_POST['INVTRANISSUEDTA'][$i],
//                                     'LOCTYP' => $_POST['LOCTYPA'][$i],
//                                     'LOCCD' => $_POST['LOCCDA'][$i],
//                                     'LOCNAME' => $_POST['LOCNAMEA'][$i],
//                                     'WDPURPOSE' => $_POST['WDPURPOSEA'][$i],
//                                     'INVTRANREM' => $_POST['INVTRANREMA'][$i],
//                                 );
//     }
//     setSessionArray($data);
//     // print_r($data['WORK']);
// }

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ACC', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['WORK']));
    $data['WORK'] = array_combine(range(1, count($data['WORK'])), array_values($data['WORK']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['WORK']);
}

?>