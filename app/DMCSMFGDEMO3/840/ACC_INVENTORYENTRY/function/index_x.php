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


$javaFunc = new AccInventoryEntry;
$data = array();
$systemName = 'AccInventoryEntry';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 5;
$rowno = 0;
//DVWDETAIL,INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM
//ITEMCD,INVPSS_TYPE,STORAGETYPE,ROWNO,ITEMNAME,ITEMSPEC,QTY,ITEMUNITTYP
//
$DVWDETAIL ='';
$INVTRANNO ='';
$INVTRANTYPE = '';
$INVTRANISSUEDT ='';
$LOCTYP ='';
$LOCCD = '';
$LOCNAME ='';
$WDPURPOSE ='';
$INVTRANREM ='';
$ITEMCD ='';
$INVPSS_TYPE = '';
$STORAGETYPE ='';
$ROWNO ='';
$ITEMNAME ='';
$ITEMSPEC ='';
$QTY ='';
$ITEMUNITTYP ='';
$PROORDERNO ='';

if(!empty($_POST)) {
   if(isset($_POST['search'])) {
        global $data;
        $data = getSessionData(); 

        // print_r("search");
        $data['INVTRANNO'] = isset($_POST['INVTRANNO']) ? $_POST['INVTRANNO']: '';
        $data['INVTRANTYPE'] = isset($_POST['INVTRANTYPE']) ? $_POST['INVTRANTYPE']: '';

        //isset($_POST['INVTRANNO']) ? $_POST['INVTRANNO']: '';
        //acc.AccInvTranEntry.search	INVTRANNO,INVTRANTYPE
        $query = $javaFunc->search($data['INVTRANNO'],$data['INVTRANTYPE']);
        // $data['ACC'] = $query;
        print_r($query);
        if(!empty($query)) {
            $data['ACC'] = array();
            // for ($i = 1 ; $i < count($query)+1; $i++) {
                $data['ACC'][1] = $query; 
                // $data['ACC'][$i] = $query[$i]; 
            // }
            setSessionArray($data);
        }


        // if(checkSessionData()) { 
        //     $data = getSessionData(); 
        // }

        // print_r($query);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepAccData") { keepAccData(); }
        // if ($_POST['action'] == "insert") { insert(); }
        if ($_POST['action'] == "commit") { commit(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    
    //acc.AccInvTranEntry.search	INVTRANNO,INVTRANTYPE
    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $INVTRANNO = isset($data['INVTRANNO']) ? $data['INVTRANNO']: '';
        $INVTRANTYPE = isset($data['INVTRANTYPE']) ? $data['INVTRANTYPE']: '';
        
        $query = $javaFunc->search($INVTRANNO,$INVTRANTYPE);
        $data['ACC'] = $query;
        setSessionArray($data); 
        // print_r($data);
    }
// onchange INVTRANNO
    else if(isset($_GET['INVTRANNO'])) {
        unsetSessionkey('INVTRANNO');

        //acc.AccInvTranEntry.getInvTran	INVTRANNO
        $data['INVTRANNO'] = isset($_GET['INVTRANNO']) ? $_GET['INVTRANNO']: '';
        $excute = $javaFunc->getInvTran($data['INVTRANNO']);
        $data = $excute;
        // print_r($data);

        if(!empty($data['INVTRANNO'])&&!empty($data['INVTRANTYPE']))
        {
            $query = $javaFunc->search($data['INVTRANNO'],$data['INVTRANTYPE']);
            $data['ACC'] = $query;
            print_r($data['ACC']);
            if(!empty($query)) {
                setSessionArray($data); 
    
            }
    
        }
    }

// onchange   LOCCD
    else if(isset($_GET['LOCTYP']) && isset($_GET['LOCCD'])) {
        unsetSessionkey('LOCCD');
        unsetSessionkey('LOCNAME');
    //acc.AccInvTranEntry.getLoc	LOCTYP,LOCCD
        $data['LOCTYP'] = isset($_GET['LOCTYP']) ? $_GET['LOCTYP']: '';
        $data['LOCCD'] = isset($_GET['LOCCD']) ? $_GET['LOCCD']: '';
        $excute = $javaFunc->getLoc($_GET['LOCTYP'],$_GET['LOCCD']);
        $data = $excute;
        // print_r($data);
    }

// onchange   ITEMCD
    else if(isset($_GET['ITEMCD'])) {
        unsetSessionkey('ITEMCD');
        unsetSessionkey('ITEMNAME');
        unsetSessionkey('ITEMSPEC');
    //acc.AccInvTranEntry.getItem	ITEMCD
        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->getItem($_GET['ITEMCD']);
        $data = $excute;
        // print_r($data);
    }

    //from search ***
    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['INVTRANNO'] = $_GET['voucherno'];
        $excute = $javaFunc->getInvTran($data['INVTRANNO']);
        $data = $excute;
        setSessionArray($data); 
        
        if(!empty($data['INVTRANNO'])&&!empty($data['INVTRANTYPE']))
        {
            global $data;
            $data = getSessionData(); 
    
            $query = $javaFunc->search($data['INVTRANNO'],$data['INVTRANTYPE']);
            print_r($query);
            if(!empty($query)) {
                $data['ACC'] = array();
                // for ($i = 1 ; $i < count($query)+1; $i++) {
                    $data['ACC'][1] = $query; 
                    // $data['ACC'][$i] = $query[$i]; 
                // }
                setSessionArray($data);
        
            }
    
        }

    }
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        // $data['LOCTYP'] = $_GET['loctype'];
        $data['LOCCD'] = $_GET['loccd'];
        $excute = $javaFunc->getLoc($data['LOCTYP'],$data['LOCCD']);
        // print_r($excute);
        $data = $excute;
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==3)
    {
        $data['ITEMCD'] = $_GET['itemcd'];
        $excute = $javaFunc->getItem($data['ITEMCD']);
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
$data['CADATE'] = $test;
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


$dd1 = $data['DRPLANG']['INVPSS_TYPE'];
$dd2 = $data['DRPLANG']['STORAGETYPE'];
$dd3 = $data['DRPLANG']['WITHDRAW_PURPOSE'];
$dd4 = $data['DRPLANG']['UNIT'];
$data['INVTRANTYPE']='10';
$data['LOCTYP']='0';
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

function commit() {
    global $data;
    //acc.AccInvTranEntry.commitAll	DVWDETAIL,INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM
    $javaInsrt = new AccInventoryEntry;
    $Param = array( "DVWDETAIL" => isset($data['ACC']) ? $data['ACC']: '',
                    "INVTRANNO" => $_POST['INVTRANNO'],
                    "INVTRANTYPE" => $_POST['INVTRANTYPE'],
                    "INVTRANISSUEDT" => $_POST['INVTRANISSUEDT'],
                    "LOCTYP" => $_POST['LOCTYP'],
                    "LOCCD" => $_POST['LOCCD'],
                    "LOCNAME" => $_POST['LOCNAME'],
                    "WDPURPOSE" => $_POST['WDPURPOSE'],
                    "INVTRANREM" => $_POST['INVTRANREM'],);
                    // print_r($Param);
    $commit = $javaInsrt->commitAll($Param);

    // unset 2 ตัวนี้เพราะค่าอื่นยังต้องใช้
    // unsetSessionkey('STATECD');
    // unsetSessionkey('STATENAME');
    
    // unsetSessionData();
    echo json_encode($commit);
}

// function update() {
//     //
//     $javaUpd = new AccInventoryEntry;
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
//     $javaDel = new AccInventoryEntry;
//     $Param = array( "COUNTRYCD" => $_POST['COUNTRYCD'],
//                     "STATECD" => $_POST['STATECD'],
//                     "STATENAME" => $_POST['STATENAME']);
//     $deletes = $javaDel->delete($Param);
//     unsetSessionkey('STATECD');
//     unsetSessionkey('STATENAME');
//     // unsetSessionData();
//     echo json_encode($deletes);
// }


//DVWDETAIL,INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM
//ITEMCD,INVPSS_TYPE,STORAGETYPE,ROWNO,ITEMNAME,ITEMSPEC,QTY,ITEMUNITTYP
function setSessionArray($arr){
    $keepField = array('ACC', 'DVWDETAIL', 'INVTRANNO', 'INVTRANTYPE', 'INVTRANISSUEDT', 'LOCTYP', 'LOCCD', 'LOCNAME', 'WDPURPOSE', 'INVTRANREM',
                        'ITEMCD','INVPSS_TYPE','STORAGETYPE','ROWNO','ITEMNAME','ITEMSPEC','QTY','ITEMUNITTYP', 'PROORDERNO');
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

function keepAccData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ACC'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'INVTRANNO' => $_POST['INVTRANNOA'][$i],
                                    'INVTRANTYPE' => $_POST['INVTRANTYPEA'][$i],
                                    'INVTRANISSUEDT' => $_POST['INVTRANISSUEDTA'][$i],
                                    'LOCTYP' => $_POST['LOCTYPA'][$i],
                                    'LOCCD' => $_POST['LOCCDA'][$i],
                                    'LOCNAME' => $_POST['LOCNAMEA'][$i],
                                    'WDPURPOSE' => $_POST['WDPURPOSEA'][$i],
                                    'INVTRANREM' => $_POST['INVTRANREMA'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ACC']);
}

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ACC', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ACC']));
    $data['ACC'] = array_combine(range(1, count($data['ACC'])), array_values($data['ACC']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ACC']);
}

?>