<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
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

// if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
//
// 
// 
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 

$javaFunc = new TaxDetailEntry;
$data = array();
$systemName = 'TaxDetailEntry';
// -- Table Max Row ----//
$rowno = 0;
$minrow = 0;
$maxrow = 9;
//PROCESSTYPE,COUNTRYCD,STATECD,CITYCD,TAXTYPECD,TDSTARTDATE,ITDSTARTDATE,TDENDDATE,ITDENDDATE
// PROCESSTYPE,
// COUNTRYCD,STATECD,CITYCD,COUNTRYNAME,STATENAME,CITYNAME,
// TAXTYPECD,TAXTYPENAME,TAXKBN,VATRATE,TAXTTL,TDSTARTDATE,TDENDDATE,
// ITDSTARTDATE,ITDENDDATE
$PROCESSTYPE ='';
$COUNTRYCD ='';
$STATECD = '';
$CITYCD ='';
$COUNTRYNAME ='';
$STATENAME = '';
$CITYNAME ='';
$TAXTYPECD ='';
$TAXTYPENAME ='';
$TAXKBN ='';
$VATRATE ='';
$TAXTTL ='';
$TDSTARTDATE ='';
$TDENDDATE ='';
$ITDSTARTDATE ='';
$ITDENDDATE ='';
$readonly ='';

if(!empty($_POST)) {
    if(isset($_POST['search'])) {

        unsetSessionData();
        //gen.TaxDetailEntry.search PROCESSTYPE,COUNTRYCD,STATECD,CITYCD
        $data['PROCESSTYPE'] = isset($_POST['PROCESSTYPE']) ? $_POST['PROCESSTYPE']: '';
        $data['COUNTRYCD'] = isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']: '';
        $data['STATECD'] = isset($_POST['STATECD']) ? $_POST['STATECD']: '';
        $data['CITYCD'] = isset($_POST['CITYCD']) ? $_POST['CITYCD']: '';

        $query = $javaFunc->search($data['PROCESSTYPE'],$data['COUNTRYCD'],$data['STATECD'],$data['CITYCD']);
      
        // print_r($query);/////////////////

        if(!empty($query)) {

            $data['TAX'] = array();

            $data['TAX'] = $query;
        }
        setSessionArray($data); 

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "commit") { commit();}
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) {
    $data = getSessionData();
}

if(!empty($_GET)) {

    //onchange COUNTRYCD
    //gen.TaxDetailEntry.getCity COUNTRYCD,STATECD,CITYCD ->ทำjavascriptหน้าบ้านด้วย
    if(isset($_GET['COUNTRYCD']) && !isset($_GET['STATECD']) && !isset($_GET['CITYCD'])  ) {

        unsetSessionkey('COUNTRYCD');

        $data['COUNTRYCD'] = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']: '';
        // $data['STATECD'] = isset($_GET['STATECD']) ? $_GET['STATECD']: '';
        // $data['CITYCD'] = isset($_GET['CITYCD']) ? $_GET['CITYCD']: '';

        $excute = $javaFunc->getCity($_GET['COUNTRYCD'],'','');
        // print_r($excute);
        $data =$excute;
        setSessionArray($data); 

    }    

    //onchange STATECD
    //gen.TaxDetailEntry.getCity COUNTRYCD,STATECD,CITYCD ->ทำjavascriptหน้าบ้านด้วย
    else if(isset($_GET['COUNTRYCD']) && isset($_GET['STATECD'])  && !isset($_GET['CITYCD']) ) {

        // $data['COUNTRYCD'] = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']: '';
        $data['STATECD'] = isset($_GET['STATECD']) ? $_GET['STATECD']: '';
        // $data['CITYCD'] = isset($_GET['CITYCD']) ? $_GET['CITYCD']: '';

        $excute = $javaFunc->getCity($_GET['COUNTRYCD'],$_GET['STATECD'],'');

        $data =$excute;
        setSessionArray($data); 

    }

    //onchange CITYCD
    //gen.TaxDetailEntry.getCity COUNTRYCD,STATECD,CITYCD ->ทำjavascriptหน้าบ้านด้วย
    else if(isset($_GET['COUNTRYCD']) && isset($_GET['STATECD'])  && isset($_GET['CITYCD']) ) {

        // $data['COUNTRYCD'] = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']: '';
        // $data['STATECD'] = isset($_GET['STATECD']) ? $_GET['STATECD']: '';
        $data['CITYCD'] = isset($_GET['CITYCD']) ? $_GET['CITYCD']: '';

        $excute = $javaFunc->getCity($_GET['COUNTRYCD'],$_GET['STATECD'],$_GET['CITYCD']);

        // print_r($excute);////////////
        
        $data =$excute;
        setSessionArray($data); 

    }
    //onchange taxtype
    //gen.TaxDetailEntry.getTaxType TAXTYPECD,TDSTARTDATE,ITDSTARTDATE,TDENDDATE,ITDENDDATE
    else if(isset($_GET['TAXTYPECD'])) {
        // print_r("onchange tax");
        // $data['TAXTYPECD'] = isset($_GET['TAXTYPECD']) ? $_GET['TAXTYPECD']: '';
        // $data['TDSTARTDATE'] = isset($_GET['TDSTARTDATE']) ? $_GET['TDSTARTDATE']: '';
        // $data['ITDSTARTDATE'] = isset($_GET['ITDSTARTDATE']) ? $_GET['ITDSTARTDATE']: '';
        // $data['TDENDDATE'] = isset($_GET['TDENDDATE']) ? $_GET['TDENDDATE']: '';
        // $data['ITDENDDATE'] = isset($_GET['ITDENDDATE']) ? $_GET['ITDENDDATE']: '';

        // $excute = $javaFunc->getTaxType($_GET['TAXTYPECD'],$_GET['TDSTARTDATE'],$_GET['ITDSTARTDATE'],$_GET['TDENDDATE'],$_GET['ITDENDDATE']);
        $excute = $javaFunc->getTaxType($_GET['TAXTYPECD'],'','','','');
        // print_r($excute);
        $data = $excute;
        // setSessionArray($data); 


    }

    //gen.TaxDetailEntry.getEndDate TDENDDATE,ITDENDDATE
    else if(isset($_GET['TDENDDATE'])) {

        $data['TDENDDATE'] = isset($_GET['TDENDDATE']) ? $_GET['TDENDDATE']: '';
        $data['ITDENDDATE'] = isset($_GET['ITDENDDATE']) ? $_GET['ITDENDDATE']: '';

        $excute = $javaFunc->getEndDate($_GET['TDENDDATE'],$_GET['ITDENDDATE']);
        $data = $excute;
        // $data['VATRATE'] = $excute['VATRATE'];
        // setSessionArray($data); 

    }

    //form search
    // countrycd   countryname
    else if(isset($_GET['countrycd'])||isset($_GET['countryname']))
    {
        $data['COUNTRYCD'] = isset($_GET['countrycd']) ? $_GET['countrycd']: '';
        // $data['COUNTRYNAME'] = isset($_GET['countryname']) ? $_GET['countryname']: '';
        setSessionArray($data); 


    }

    // statecode   statename
    else if(isset($_GET['statecd'])||isset($_GET['statename']))
    {
        $data['STATECD'] = isset($_GET['statecd']) ? $_GET['statecd']: '';
        // $data['STATENAME'] = isset($_GET['statename']) ? $_GET['statename']: '';
        setSessionArray($data); 


    }

    // citycode cityname
    else if(isset($_GET['citycd'])||isset($_GET['cityname']))
    {
        $data['CITYCD'] = isset($_GET['citycd']) ? $_GET['citycd']: '';
        // $data['STATENAME'] = isset($_GET['statename']) ? $_GET['statename']: '';
        setSessionArray($data); 

        if($data['CITYCD']!='')
        {

            $excute = $javaFunc->getCity($data['COUNTRYCD'],$data['STATECD'],$data['CITYCD']);

            // print_r($excute);////////////////

            $data =$excute;
            setSessionArray($data); 

        }

        
    }

    // taxtypecode taxtypename
    else if(isset($_GET['taxtypecode'])||isset($_GET['taxtypename']))
    {
        $data['TAXTYPECD'] = isset($_GET['taxtypecode']) ? $_GET['taxtypecode']: '';
        $data['TAXTYPENAME'] = isset($_GET['taxtypename']) ? $_GET['taxtypename']: '';
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
} else {
    $setLoadApp = $syslogic->setLoadApp($_SESSION['APPCODE']);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);

$type1 = $data['DRPLANG']['TAXPROCESSTYPE'];
$type2 = $data['DRPLANG']['TAX02'];
$type3 = $data['DRPLANG']['TAXTTL'];

// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function commit() {

    $javaFunc = new TaxDetailEntry;
    $Param = array();
    if(!empty($_POST['ROWNOA'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $RowParam[] = array('TAXTYPECD' => isset($_POST['TAXTYPECDA'][$i]) ? $_POST['TAXTYPECDA'][$i]: '',
                            'TDSTARTDATE' => isset($_POST['TDSTARTDATEA'][$i]) ? str_replace('-', '',$_POST['TDSTARTDATEA'][$i]): '',
                            'TDENDDATE' => isset($_POST['TDENDDATEA'][$i]) ? str_replace('-', '', $_POST['TDENDDATEA'][$i]): '',
                        );
        }
    }
    $Param = array( 'PROCESSTYPE' => isset($_POST['PROCESSTYPE']) ? $_POST['PROCESSTYPE']: '',
                    'COUNTRYCD' => isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']: '',
                    'STATECD' => isset($_POST['STATECD']) ? $_POST['STATECD']: '',
                    'CITYCD' => isset($_POST['CITYCD']) ? $_POST['CITYCD']: '',
                    'DATA' => $RowParam);
    print_r($Param);
    $commitAll = $javaFunc->commit($Param);
    // unsetSessionData();
    echo json_encode($commitAll);
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['TAX'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'TAXTYPECD' => $_POST['TAXTYPECDA'][$i],
                                    'TAXTYPENAME' => $_POST['TAXTYPENAMEA'][$i],
                                    'TAXKBN' => $_POST['TAXKBNA'][$i],
                                    'VATRATE' => $_POST['VATRATEA'][$i],
                                    'TAXTTL' => $_POST['TAXTTLA'][$i],
                                    'TDSTARTDATE' => $_POST['TDSTARTDATEA'][$i],
                                    'TDENDDATE' => $_POST['TDENDDATEA'][$i],
                                );
    }
    setSessionArray($data);
    print_r($data['TAX']);
}

// TAX,
// PROCESSTYPE,
// COUNTRYCD,STATECD,CITYCD,COUNTRYNAME,STATENAME,CITYNAME,
// TAXTYPECD,TAXTYPENAME,TAXKBN,VATRATE,TAXTTL,TDSTARTDATE,TDENDDATE,
// ITDSTARTDATE,ITDENDDATE
function setSessionArray($arr){
    $keepField = array('TAX', 'PROCESSTYPE', 'COUNTRYCD', 'COUNTRYNAME', 'STATECD', 'STATENAME',
                       'CITYCD', 'CITYNAME', 'TAXTYPECD', 'TAXTYPENAME', 'TAXKBN', 'VATRATE',
                        'TAXTTL', 'TDSTARTDATE', 'TDENDDATE', 'ITDSTARTDATE', 'ITDENDDATE','ROWNO','DVWTAXDETAIL');
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

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'TAX', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['TAX']));
    $data['TAX'] = array_combine(range(1, count($data['TAX'])), array_values($data['TAX']));
    setSessionArray($data);
    // print_r($data['TAX']);
}

?>