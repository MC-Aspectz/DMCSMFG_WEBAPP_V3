<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname)- 1];
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
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}  // if ($appname == "") {
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
//  LANGUAGE
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}



$javaFunc = new AccAssetMaster;
$data = array();
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 8;
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['ASSETCD'])) {
        // cheak_if();
        unsetSessionData();
        $data = getSessionData();
        $assetfunc = new AccAssetMaster;
        $ASSETCD = isset($_GET['ASSETCD']) ? $_GET['ASSETCD']: '';
        $query = $assetfunc->cheak_if(trim($ASSETCD));
        // print_r( $query);
        if(!empty($query)) {
            $query['ASSETCD'] = $ASSETCD;
            $PURCHAMT = !empty($query['PURCHAMT']) ? implode(explode(',', $query['PURCHAMT'])) : '';
            $get_info = $assetfunc->get_info(trim($ASSETCD));
            $boka = $assetfunc->boka(trim($ASSETCD), $PURCHAMT);
            // print_r($get_info);
            // print_r($boka);
            if(!empty($get_info)) {  $query['ITEM'] = $get_info; }
            if(!empty($boka)) { $query['BOOKVALUE'] = $boka['BOOKVALUE']; }
            setSessionArray($query);
        }
    } else if(isset($_GET['ASSETACC'])) {
        get_assetacc();
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}
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
$data['I_CURRENCY'] = $load['I_CURRENCY'];
$data['COMCURRENCY'] = $load['COMCURRENCY'];
$data['COMCURRENCYNM'] = $load['COMCURRENCYNM'];
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$year = $data['DRPLANG']['YEAR'];
$deprtype = $data['DRPLANG']['DEPRTYPE'];
$assettype = $data['DRPLANG']['ASSETTYPE'];
$currencytyp = $data['DRPLANG']['CURRENCYTYP'];
$data['DEPRTYP'] = !empty($data['DEPRTYP']) ? $data['DEPRTYP']: 0;
$data['ASSETTYP'] = !empty($data['ASSETTYP']) ? $data['ASSETTYP']: 0;
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($load);
// echo "</pre>";
// --------------------------------------------------------------------------//

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        // if ($_POST['action'] == "cheak_if") { cheak_if(); }
        if ($_POST['action'] == "disp_photo") { disp_photo(); }
        if ($_POST['action'] == "get_assetacc") { get_assetacc(); }
        if ($_POST['action'] == "assetUnset") { assetUnset(); }
        if ($_POST['action'] == "get_exrate") { get_exrate(); }
        if ($_POST['action'] == "calc_Drate") { calc_Drate(); }
        if ($_POST['action'] == "docal") { docal(); }
        if ($_POST['action'] == "getThai") { getThai(); }
        if ($_POST['action'] == "commit") { commit(); }
    }
}
//--------------------------------------------------------------------------------
function commit() {
    $RowParam = array();
    $cmtfunc = new AccAssetMaster;
    $ASSETCD = isset($_POST['ASSETCD']) ? $_POST['ASSETCD']: '';
    if(!empty($_POST['ROWNO'])) {
        for ($i = 0 ; $i < count($_POST['ROWNO']); $i++) { 
            $RowParam[] = array('ROWNO' => $_POST['ROWNO'][$i],
                                'YYMM' => $_POST['YYMM'][$i],
                                'D_VALUE' => $_POST['D_VALUE'][$i],
                                'DEPARFLG' => isset($_POST['DEPARFLG'][$i]) ? $_POST['DEPARFLG'][$i] : 'F');
        };
    }
    // print_r($_POST['DEPARFLG']);
    $param = array( "ASSETCD" => isset($_POST['ASSETCD']) ? $_POST['ASSETCD']: '',
                    "ASSETTYP" => isset($_POST['ASSETTYP']) ? $_POST['ASSETTYP']: '',
                    "ASSETNM" => isset($_POST['ASSETNM']) ? $_POST['ASSETNM']: '',
                    "ASSETNM_E" => isset($_POST['ASSETNM_E']) ? $_POST['ASSETNM_E']: '',
                    "DEPREC_A" => isset($_POST['DEPREC_A']) ? $_POST['DEPREC_A']: '',
                    "SERIAL_NO" => isset($_POST['SERIAL_NO']) ? $_POST['SERIAL_NO']: '',
                    "PURCH_DT" => isset($_POST['PURCH_DT']) ? str_replace("-", "", $_POST['PURCH_DT']): '',
                    "TDATE" => isset($_POST['TDATE']) ? str_replace("-", "", $_POST['TDATE']): '',
                    "PURCHPRC" => isset($_POST['PURCHPRC']) ? implode(explode(',', $_POST['PURCHPRC'])): '',
                    "I_CURRENCY" => isset($_POST['I_CURRENCY']) ? $_POST['I_CURRENCY']: '',
                    "EXRATE" => isset($_POST['EXRATE']) ? $_POST['EXRATE']: '',
                    "PURCHAMT" => isset($_POST['PURCHAMT']) ? implode(explode(',', $_POST['PURCHAMT'])): '',
                    "SUPPLIERNM" => isset($_POST['SUPPLIERNM']) ? $_POST['SUPPLIERNM']: '',
                    "ASSETACC" => isset($_POST['ASSETACC']) ? $_POST['ASSETACC']: '',
                    "STDATE" => isset($_POST['STDATE']) ? str_replace("-", "", $_POST['STDATE']): '',
                    "DEPRTYP" => isset($_POST['DEPRTYP']) ? $_POST['DEPRTYP']: '',
                    "LIFEY" => isset($_POST['LIFEY']) ? $_POST['LIFEY']: '',
                    "DRATE" => isset($_POST['DRATE']) ? $_POST['DRATE']: '',                       
                    "SOLVAGEVL" => isset($_POST['SOLVAGEVL']) ? implode(explode(',', $_POST['SOLVAGEVL'])): '',
                    "BOOKVALUE" => isset($_POST['BOOKVALUE']) ? implode(explode(',', $_POST['BOOKVALUE'])): '',
                    "LOSTVL" => isset($_POST['LOSTVL']) ? $_POST['LOSTVL']: '',
                    "SOLDVL" => isset($_POST['SOLDVL']) ? $_POST['SOLDVL']: '',
                    "EDDATE" => isset($_POST['EDDATE']) ? str_replace("-", "", $_POST['EDDATE']): '',
                    "PICTURECD" => isset($_POST['PICTURECD']) ? $_POST['PICTURECD']: '',
                    "INVOICE_NO" => isset($_POST['INVOICE_NO']) ? $_POST['INVOICE_NO']: '',
                    "ROWNO" => '',
                    "YYMM" => '',
                    "VALUE" => '',
                    "DEPARFLG" => '',
                    "SYSDATETYPE" => '1',
                    "SYSLDATETYPE" => '1',
                );
    // print_r($param);
    // print_r($RowParam);
    $commit_header = $cmtfunc->commit_header($param);
    // print_r($commit_header);
    if(!empty($commit_header)) {
        $commit_all = $cmtfunc->commit_all($ASSETCD, $RowParam);
        // print_r($commit_all);
        if(!empty($commit_all)) { 
            unsetSessionData();
            echo json_encode($commit_header);
        }
    }
}

function disp_photo() {
    $dispfunc = new AccAssetMaster;
    $PICTURECD = isset($_POST['PICTURECD']) ? $_POST['PICTURECD']: '';   
    $query = $dispfunc->disp_photo($PICTURECD);
    echo json_encode($query);
}

// function cheak_if() {
//     unsetSessionData();
//     $data = getSessionData();
//     $assetfunc = new AccAssetMaster;
//     if(isset($_GET['ASSETCD'])) {
//         $ASSETCD = isset($_GET['ASSETCD']) ? $_GET['ASSETCD']: '';
//     } else {
//         $ASSETCD = isset($_POST['ASSETCD']) ? $_POST['ASSETCD']: '';   
//     }
//     $query = $assetfunc->cheak_if(trim($ASSETCD));
//     // print_r( $query);
//     // get_info
//     if(!empty($query)) {
//         $PURCHAMT = !empty($query['PURCHAMT']) ? implode(explode(',', $query['PURCHAMT'])) : '';
//         $get_info = $assetfunc->get_info(trim($ASSETCD));
//         $boka = $assetfunc->boka(trim($ASSETCD), $PURCHAMT);
//         // print_r($get_info);
//         // print_r($boka);
//         if(!empty($get_info)) {  $query['ITEM'] = $get_info; }
//         if(!empty($boka)) { $query['BOOKVALUE'] = $boka['BOOKVALUE']; }
//         if(isset($_GET['ASSETCD'])) {
//             if (!is_array($query) && str_contains($query, 'ERRO:')) {
//                 return json_encode($query);
//             } else {
//                 $query['ASSETCD'] = $ASSETCD;
//                 setSessionArray($query);
//                 return json_encode($query);
//             }
//         } else {
//             $query['ASSETCD'] = $ASSETCD;
//             setSessionArray($query);
//             echo json_encode($query);
//         }
//     }
// }

function get_assetacc() {
    $getfunc = new AccAssetMaster;
    if(isset($_GET['ASSETACC'])) {
        $ASSETACC = isset($_GET['ASSETACC']) ? $_GET['ASSETACC']: '';
    } else {
        $ASSETACC = isset($_POST['ASSETACC']) ? $_POST['ASSETACC']: '';  
    }
    $query = $getfunc->get_assetacc($ASSETACC);
    if(!empty($query)) { $query['ASSETACC'] = $ASSETACC; setSessionArray($query); } else { assetUnset(); }
    if(isset($_GET['ASSETACC'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function get_exrate() {
    $getfunc = new AccAssetMaster;
    $I_CURRENCY = isset($_POST['I_CURRENCY']) ? $_POST['I_CURRENCY']: '';  
    $COMCURRENCY = isset($_POST['COMCURRENCY']) ? $_POST['COMCURRENCY']: '';   
    $query = $getfunc->get_exrate($I_CURRENCY, $COMCURRENCY);
    echo json_encode($query);
}

function calc_Drate() {
    $calcfunc = new AccAssetMaster;
    $ASSETTYP = isset($_POST['ASSETTYP']) ? $_POST['ASSETTYP']: '';   
    $LIFEY = isset($_POST['LIFEY']) ? $_POST['LIFEY']: '';   
    $query = $calcfunc->calc_Drate($ASSETTYP, $LIFEY);
    echo json_encode($query);
}

function docal() {
    $docalfunc = new AccAssetMaster;
    $data['DOCAL'] = isset($_POST['DOCAL']) ? $_POST['DOCAL']: 'F';   
    $query = $docalfunc->docal($data['DOCAL']);
    setSessionData($data);
    echo json_encode($query);
}

function getThai() {
    $getfunc = new AccAssetMaster;
    $param = array( "ASSETTYP" => isset($_POST['ASSETTYP']) ? $_POST['ASSETTYP']: '',
                    "PURCH_DT" => isset($_POST['PURCH_DT']) ? str_replace("-", "", $_POST['PURCH_DT']): '',
                    "STDATE" => isset($_POST['STDATE']) ? str_replace("-", "", $_POST['STDATE']): '',
                    "PURCHAMT" => isset($_POST['PURCHAMT']) ? implode(explode(',', $_POST['PURCHAMT'])): '0.00',
                    "LIFEY" => isset($_POST['LIFEY']) ? $_POST['LIFEY']: '',
                    "DRATE" => isset($_POST['DRATE']) ? $_POST['DRATE']: '',
                    "SOLVAGEVL" => isset($_POST['SOLVAGEVL']) ? $_POST['SOLVAGEVL']: '',
                    "DEPREC_A" => isset($_POST['DEPREC_A']) ? $_POST['DEPREC_A']: 'F');
    $query = $getfunc->getThai($param);
    if(!empty($query)) { $data['ITEM'] = $query; setSessionArray($data); }
    echo json_encode($query);
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

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNO']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNO'][$i],
                                    'YYMM' => $_POST['YYMM'][$i],
                                    'D_VALUE' => $_POST['D_VALUE'][$i],
                                    'DEPARFLG' => isset($_POST['DEPARFLG'][$i]) ? $_POST['DEPARFLG'][$i] : 'F',
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function assetUnset() {
    unsetSessionkey('ACCCD1');
    unsetSessionkey('ACCCD2');
    unsetSessionkey('ACCCD3');
    unsetSessionkey('ACCNM1');
    unsetSessionkey('ACCNM2');
    unsetSessionkey('ACCNM3');
    unsetSessionkey('ASSETACC');
    unsetSessionkey('ASSETACCNM');
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ASSETCD', 'ASSETTYP', 'TDATE', 'ASSETNM', 'ASSETNM_E', 'DEPREC_A', 'SERIAL_NO', 'PURCH_DT', 'PURCHPRC', 'I_CURRENCY', 'EXRATE', 'PURCHAMT', 'COMCURRENCYNM', 'COMCURRENCY', 'SUPPLIERNM', 'INVOICE_NO', 'ASSETACC', 'ASSETACCNM', 'ACCCD1', 'ACCNM1', 'ACCCD2', 'ACCNM2', 'ACCCD3', 'ACCNM3', 'STDATE', 'DEPRTYP', 'LIFEY', 'DRATE', 'SOLVAGEVL', 'BOOKVALUE', 'LOSTVL', 'SOLDVL', 'EDDATE', 'ITEMIMGLOCVIEW', 'PICTURECD', 'SYSEN_CALCLIST', 'DOCAL'
    );
    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>