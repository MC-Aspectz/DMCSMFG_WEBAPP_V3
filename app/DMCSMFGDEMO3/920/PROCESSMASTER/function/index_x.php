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

$javaFunc = new ProcessMaster;
$data = array();
$systemName = 'ProcessMaster'; //------------------------------ here
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 9;
$rowno = 0;

$ITEMCD = '';
$ITEMNAME = '';
$ITEMPSSNO = '';
$ITEMPSSNOID = '';
$ITEMPSSTYP = '';
$ITEMPSSTYPSTR = '';
$ITEMPSSPLACE = '';
$PLACENAME = '';
$ITEMPSSJOBTYP = '';
$ITEMPSSJOBTYPSTR = '';
$ITEMPSSDESC = '';
$ITEMPSSDESCVIEW = '';
$ITEMPSSPLANQTY = '';
$ITEMPSSPLANTIME = '';
$ITEMPSSPLANTIMETYP = '';
$ITEMPSSPLANTIMETYPSTR = '';
$ITEMPSSLINKTYP = '';
$ITEMPSSLINKTYPSTR = '';
$ITEMPSSALLOWANCE = '';
$ITEMPSSUNITPRC = '';
$ITEMIMGLOC = '';
$IMPSSADDBOARDQTY = '';
$IMPSSADDSPM = '';
$IMPSSADDUSAGE = '';
$IMPSSADDOPE = '';
$JOB_NAME = '';



// if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
//
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
// 
if(!empty($_POST)) {

   if(isset($_POST['search'])) {

        unsetSessionData();
        setSessionKey('ITEMCD' , $_POST['ITEMCD']);

        $Param = array("ITEMCD" => $_POST['ITEMCD'],
                       "BMVERSION" => $_POST['BMVERSION']);

        $query = $javaFunc->search($Param);

        if(empty($query)){
            unsetSessionData();
        }
        $data['RM'] = $query;
      
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) {
             $data = getSessionData(); 
        } 

        header("Location: index.php");
        exit;
        // print_r($data);
    }

    if (isset($_POST['action'])) {

        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepItemData") { keepItemData(); }
        if ($_POST['action'] == "commit") { commit();  }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "update") { update();}
        if ($_POST['action'] == "unsetItemData") {  unsetItemData($_POST['lineIndex']); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $Param = array("ITEMCD" => $_POST['ITEMCD'],
                       "BMVERSION" => $_POST['BMVERSION']);
        
        $query = $javaFunc->search($Param);
        $data['RM'] = $query;
        setSessionArray($data); 

    }

    //onchange ITEMCD
    else if(isset($_GET['ITEMCD']) ) {
        // print_r('onchange itemcd');
        
        unsetSessionkey('ITEMCD');
        unsetSessionkey('ITEMNAME');
        unsetSessionkey('ITEMUNITTYP');

        setOldValue();

        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->getItem($data['ITEMCD']);
        $data = $excute;
            
    }

    //onchange ITEMPSSPLACE 
    else if(isset($_GET['ITEMPSSPLACE']) ) {
        // print_r('onchange workcenter');
        
        unsetSessionkey('ITEMPSSPLACE');
        unsetSessionkey('PLACENAME');
        
        $Param = array("ITEMPSSPLACE" => isset($_GET['ITEMPSSPLACE']) ? $_GET['ITEMPSSPLACE']: '',
                        "ITEMPSSTYP" => isset($_GET['ITEMPSSTYP']) ? $_GET['ITEMPSSTYP'] : '');
        $excute = $javaFunc->getPlace($Param);
        $data = $excute;
            
    }

    //onchange ITEMPSSJOBTYP
    else if(isset($_GET['ITEMPSSJOBTYP']) ) {
        // print_r('onchange job code');
        
        unsetSessionkey('ITEMPSSJOBTYP');
        unsetSessionkey('JOB_NAME');
        
        $data['ITEMPSSJOBTYP'] = isset($_GET['ITEMPSSJOBTYP']) ? $_GET['ITEMPSSJOBTYP']: '';
        $excute = $javaFunc->getJobCode($data['ITEMPSSJOBTYP']);
        $data = $excute;
            
    }

    else if(isset($_GET['IMPSSADDBOARDQTY']) ) {
        // print_r('onchange IMPSSADDBOARDQTY');

        $Param = array("ITEMPSSPLANQTY" => isset($_GET['ITEMPSSPLANQTY']) ? $_GET['ITEMPSSPLANQTY']: '',
                        "ITEMPSSPLANTIMETYP" => isset($_GET['ITEMPSSPLANTIMETYP']) ? $_GET['ITEMPSSPLANTIMETYP'] : '',
                        "IMPSSADDBOARDQTY" => isset($_GET['IMPSSADDBOARDQTY']) ? $_GET['IMPSSADDBOARDQTY'] : '',
                        "IMPSSADDSPM" => isset($_GET['IMPSSADDSPM']) ? $_GET['IMPSSADDSPM'] : '',
                        "IMPSSADDUSAGE" => isset($_GET['IMPSSADDUSAGE']) ? $_GET['IMPSSADDUSAGE'] : '',
                        "IMPSSADDOPE" => isset($_GET['IMPSSADDOPE']) ? $_GET['IMPSSADDOPE'] : '',
                    );
        $excute = $javaFunc->getSubQty($Param);
        $data = $excute;
        // print_r($data);
    }

    else if(isset($_GET['IMPSSADDSPM']) ) {
        // print_r('onchange IMPSSADDSPM');
                      
        $Param = array("ITEMPSSPLANQTY" => isset($_GET['ITEMPSSPLANQTY']) ? $_GET['ITEMPSSPLANQTY']: '',
                        "ITEMPSSPLANTIMETYP" => isset($_GET['ITEMPSSPLANTIMETYP']) ? $_GET['ITEMPSSPLANTIMETYP'] : '',
                        "IMPSSADDBOARDQTY" => isset($_GET['IMPSSADDBOARDQTY']) ? $_GET['IMPSSADDBOARDQTY'] : '',
                        "IMPSSADDSPM" => isset($_GET['IMPSSADDSPM']) ? $_GET['IMPSSADDSPM'] : '',
                        "IMPSSADDUSAGE" => isset($_GET['IMPSSADDUSAGE']) ? $_GET['IMPSSADDUSAGE'] : '',
                        "IMPSSADDOPE" => isset($_GET['IMPSSADDOPE']) ? $_GET['IMPSSADDOPE'] : '',
                    );
        $excute = $javaFunc->getSubQty($Param);
        $data = $excute;
        // print_r($data);
    }

    else if(isset($_GET['IMPSSADDUSAGE']) ) {
        // print_r('onchange IMPSSADDUSAGE');
                      
        $Param = array("ITEMPSSPLANQTY" => isset($_GET['ITEMPSSPLANQTY']) ? $_GET['ITEMPSSPLANQTY']: '',
                        "ITEMPSSPLANTIMETYP" => isset($_GET['ITEMPSSPLANTIMETYP']) ? $_GET['ITEMPSSPLANTIMETYP'] : '',
                        "IMPSSADDBOARDQTY" => isset($_GET['IMPSSADDBOARDQTY']) ? $_GET['IMPSSADDBOARDQTY'] : '',
                        "IMPSSADDSPM" => isset($_GET['IMPSSADDSPM']) ? $_GET['IMPSSADDSPM'] : '',
                        "IMPSSADDUSAGE" => isset($_GET['IMPSSADDUSAGE']) ? $_GET['IMPSSADDUSAGE'] : '',
                        "IMPSSADDOPE" => isset($_GET['IMPSSADDOPE']) ? $_GET['IMPSSADDOPE'] : '',
                    );
        $excute = $javaFunc->getSubQty($Param);
        $data = $excute;
        // print_r($data);    
    }

    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['ITEMCD'] = $_GET['itemcd'];
        $excute = $javaFunc->getItem($data['ITEMCD']);
        $data = $excute;
        setSessionArray($data);
        
        //perform search after getting value from guide page
        if(!empty($data['ITEMCD']))
        {
            global $data;
            $data = getSessionData(); 
    
            $Param = array("ITEMCD" => $data['ITEMCD'],
                           "BMVERSION" => $data['BMVERSION']);

            $query = $javaFunc->search($Param);
            $data['RM'] = $query;
        }
    }

    // else if(!empty($_GET['index'])&&$_GET['index']==2)
    // {
    //     $data['ITEMPSSPLACE'] = $_GET['itemcd'];
    //     print_r($data['ITEMPSSPLACE']);
    //     $Param = array("ITEMPSSPLACE" => $data['ITEMPSSPLACE'],
    //                    "ITEMPSSTYP" => isset($_POST['ITEMPSSTYP']) ? $_POST['ITEMPSSTYP'] : '');
    //     print_r($Param);
    //     $excute = $javaFunc->getPlace($Param);
    //     print_r($excute);
    //     $data = $excute;
    //     setSessionArray($data); 
    // }

    else if(!empty($_GET['index'])&&$_GET['index']==3)
    {        
        $data['ITEMPSSJOBTYP'] = $_GET['jobcode'];
        $excute = $javaFunc->getJobCode($data['ITEMPSSJOBTYP']);
        $data = $excute;
        setSessionArray($data); 
    }

    else if(!empty($_GET['index'])&&$_GET['index']==4)
    {        
        $data['ITEMCLONE'] = $_GET['itemcd'];
        $excute = $javaFunc->searchClone($data['ITEMCLONE']);
        $data['RM'] = $excute;
        setSessionArray($data);
    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('7');
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

$mbversion = $data['DRPLANG']['BMVERSION'];
$jobcode = $data['DRPLANG']['JOBCODE'];
$jobtype = $data['DRPLANG']['JOBTYPE'];
$unit = $data['DRPLANG']['UNIT'];
$jobunit = $data['DRPLANG']['JOBUNIT'];
$joblinktype = $data['DRPLANG']['JOBLINKTYPE'];
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//

function commit() {
    echo("This is commit in index_x");
    $javaInsrt = new ProcessMaster;
    $Param = array();
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) {
        $RowParam[] = array(
                            'ITEMPSSNO' => $_POST['ITEMPSSNOA'][$i],
                            // 'ITEMPSSTYPSTR' => $_POST['ITEMPSSTYPSTRA'][$i],
                            'ITEMPSSPLACE' => $_POST['ITEMPSSPLACEA'][$i],
                            'PLACENAME' => $_POST['PLACENAMEA'][$i],
                            'ITEMPSSDESC' => $_POST['ITEMPSSDESCA'][$i],
                            // 'ITEMPSSJOBTYPSTR' => $_POST['ITEMPSSJOBTYPSTRA'][$i],
                            'ITEMPSSPLANQTY' => $_POST['ITEMPSSPLANQTYA'][$i],
                            'ITEMPSSPLANTIME' => $_POST['ITEMPSSPLANTIMEA'][$i],
                            // 'ITEMPSSPLANTIMETYPSTR' => $_POST['ITEMPSSPLANTIMETYPSTRA'][$i],
                            // 'ITEMPSSLINKTYPSTR' => $_POST['ITEMPSSLINKTYPSTRA'][$i],
                            'ITEMPSSALLOWANCE' => $_POST['ITEMPSSALLOWANCEA'][$i],
                            'ITEMPSSTYP' => $_POST['ITEMPSSTYPA'][$i],
                            'ITEMPSSJOBTYP' => $_POST['ITEMPSSJOBTYPA'][$i],
                            'ITEMPSSPLANTIMETYP' => $_POST['ITEMPSSPLANTIMETYPA'][$i],
                            'ITEMPSSLINKTYP' => $_POST['ITEMPSSLINKTYPA'][$i],
                            'ITEMPSSNOID' => $_POST['ITEMPSSNOIDA'][$i],
                            'ITEMPSSUNITPRC' => $_POST['ITEMPSSUNITPRCA'][$i],
                            'ITEMIMGLOC' => $_POST['ITEMIMGLOCA'][$i],
                            // 'ITEMCD' => $_POST['ITEMCD'],
                            'IMPSSADDBOARDQTY' => $_POST['IMPSSADDBOARDQTYA'][$i],
                            'IMPSSADDSPM' => $_POST['IMPSSADDSPMA'][$i],
                            'IMPSSADDUSAGE' => $_POST['IMPSSADDUSAGEA'][$i],
                            'IMPSSADDOPE' => $_POST['IMPSSADDOPEA'][$i],
                          );
    }

    // print_r($RowParam);
    $Param = array( 
        'DVWDETAIL' => '',
        'BMVERSION' => $_POST['BMVERSION'],
        'ITEMCD' => $_POST['ITEMCD'],
        'ITEMPSSTYPSTR' => '',
        'ITEMPSSJOBTYPSTR' =>  '',
        'ITEMPSSPLANTIMETYPSTR' => '',
        'ITEMPSSLINKTYPSTR' => '',
        'DATA' => $RowParam,
    );
                    
    echo json_encode($Param);
    print_r($Param);
    $commit = $javaInsrt->commitAll($Param);
 
    unsetSessionData();
    echo json_encode($commit);

}

//
function setSessionArray($arr){
    $keepField = array('RM', 'DVWDETAIL', 'ITEMPSSNO', 'ITEMPSSNOID', 'ITEMPSSTYP', 'ITEMPSSTYPSTR', 'ITEMPSSPLACE', 'PLACENAME', 'ITEMPSSJOBTYP', 'ITEMPSSJOBTYPSTR', 'ITEMPSSDESC',
                        'ITEMPSSDESCVIEW', 'ITEMPSSPLANQTY', 'ITEMPSSPLANTIME', 'ITEMPSSPLANTIMETYP', 'ITEMPSSPLANTIMETYPSTR', 'ITEMPSSLINKTYP', 'ITEMPSSLINKTYPSTR','ITEMPSSALLOWANCE',
                        'ITEMPSSUNITPRC', 'ITEMIMGLOC', 'IMPSSADDBOARDQTY', 'IMPSSADDSPM', 'IMPSSADDUSAGE', 'IMPSSADDOPE', 'JOB_NAME', 'ITEMCD', 'ITEMNAME','BMVERSION','ITEMUNITTYP');
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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function setSessionKey($key, $value) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    $_SESSION[$sysnm][$key] = $value;
}

function getSystemData($key = "") {
    return get_sys_data(SESSION_NAME_SYSTEM, $key);
}
  
function setSystemData($key, $val) {
return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
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
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['RM'][$i+1] = array('ITEMPSSNO' => $_POST['ITEMPSSNOA'][$i],
                                    'ITEMPSSTYPSTR' => $_POST['ITEMPSSTYPA'][$i],
                                    'ITEMPSSPLACE' => $_POST['ITEMPSSPLACEA'][$i],
                                    'PLACENAME' => $_POST['PLACENAMEA'][$i],
                                    'ITEMPSSDESC' => $_POST['ITEMPSSDESCA'][$i],
                                    'ITEMPSSPLANQTY' => $_POST['ITEMPSSPLANQTYA'][$i],
                                    'ITEMPSSPLANTIME' => $_POST['ITEMPSSPLANTIMEA'][$i],
                                    'ITEMPSSALLOWANCE' => $_POST['ITEMPSSALLOWANCEA'][$i],
                                    'ITEMPSSTYP' => $_POST['ITEMPSSTYPA'][$i],
                                    'ITEMPSSJOBTYP' => $_POST['ITEMPSSJOBTYPA'][$i],
                                    'ITEMPSSPLANTIMETYP' => $_POST['ITEMPSSPLANTIMETYPA'][$i],
                                    'ITEMPSSLINKTYP' => $_POST['ITEMPSSLINKTYPA'][$i],
                                    'ITEMPSSNOID' => $_POST['ITEMPSSNOA'][$i],
                                    'ITEMPSSUNITPRC' => $_POST['ITEMPSSUNITPRCA'][$i],
                                    'ITEMIMGLOC' => $_POST['ITEMIMGLOCA'][$i],
                                    'IMPSSADDBOARDQTY' => $_POST['IMPSSADDBOARDQTYA'][$i],
                                    'IMPSSADDSPM' => $_POST['IMPSSADDSPMA'][$i],
                                    'IMPSSADDUSAGE' => $_POST['IMPSSADDUSAGEA'][$i],
                                    'IMPSSADDOPE' => $_POST['IMPSSADDOPEA'][$i],

                                );
    }
    setSessionArray($data);
    // print_r($data['RM']);
}

function update() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['RM'][$i+1] = array( 
                                    // 'ROWNO' => $_POST['ROWNOA'][$i],
                                    // 'BMVERSION' => $_POST['BMVERSIONA'][$i],
                                    'ITEMPSSNO' => $_POST['ITEMPSSNOA'][$i],
                                    'ITEMPSSTYPSTR' => $_POST['ITEMPSSTYPA'][$i],
                                    'ITEMPSSPLACE' => $_POST['ITEMPSSPLACEA'][$i],
                                    'PLACENAME' => $_POST['PLACENAMEA'][$i],
                                    'ITEMPSSDESC' => $_POST['ITEMPSSDESCA'][$i],
                                    'ITEMPSSJOBTYPSTR' => $_POST['ITEMPSSJOBTYPA'][$i],
                                    'JOB_NAME' => $_POST['JOB_NAMEA'][$i],
                                    'ITEMPSSPLANQTY' => $_POST['ITEMPSSPLANQTYA'][$i],
                                    'ITEMPSSPLANTIME' => $_POST['ITEMPSSPLANTIMEA'][$i],
                                    // 'ITEMPSSPLANTIMETYPSTR' => $_POST['ITEMPSSPLANTIMETYPA'][$i],
                                    // 'ITEMPSSLINKTYPSTR' => $_POST['ITEMPSSLINKTYPA'][$i],
                                    'ITEMPSSALLOWANCE' => $_POST['ITEMPSSALLOWANCEA'][$i],
                                    'ITEMPSSTYP' => $_POST['ITEMPSSTYPA'][$i],
                                    'ITEMPSSJOBTYP' => $_POST['ITEMPSSJOBTYPA'][$i],
                                    'ITEMPSSPLANTIMETYP' => $_POST['ITEMPSSPLANTIMETYPA'][$i],
                                    'ITEMPSSLINKTYP' => $_POST['ITEMPSSLINKTYPA'][$i],
                                    'ITEMPSSNOID' => $_POST['ITEMPSSNOA'][$i],
                                    'ITEMPSSUNITPRC' => $_POST['ITEMPSSUNITPRCA'][$i],
                                    'ITEMIMGLOC' => $_POST['ITEMIMGLOCA'][$i],
                                    // 'ITEMCD' => $_POST['ITEMCDA'][$i],
                                    'IMPSSADDBOARDQTY' => $_POST['IMPSSADDBOARDQTYA'][$i],
                                    'IMPSSADDSPM' => $_POST['IMPSSADDSPMA'][$i],
                                    'IMPSSADDUSAGE' => $_POST['IMPSSADDUSAGEA'][$i],
                                    'IMPSSADDOPE' => $_POST['IMPSSADDOPEA'][$i],
                                );
    }
    echo json_encode($data);
    // print_r($data);
    setSessionArray($data);

    // print_r($data['RM']);
}

function unsetItemData($lineIndex = "") { 
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'RM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['RM']));
    $data['RM'] = array_combine(range(1, count($data['RM'])), array_values($data['RM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['RM']);
}


?>