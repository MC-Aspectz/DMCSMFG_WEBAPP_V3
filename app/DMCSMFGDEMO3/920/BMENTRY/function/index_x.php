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


$javaFunc = new BMEntry;
$data = array();
$systemName = 'BMEntry';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 5;
$rowno = 0;
//ตัวแปรในindex_class
// BMPITEMCD STAFFCD ITEMCLONE BMCOMB BMCITEMCD PITEM SYSLANG 
// BMVERSION SYSAPPNAME CURRENCY BMEXPDT 
// DVWDETAIL BMENTRYDT 
$BMPITEMCD ='';
$STAFFCD ='';
$ITEMCLONE ='';
$BMCOMB ='';
$BMCITEMCD ='';
$PITEM ='';
$SYSLANG ='';
$BMVERSION ='';
$SYSAPPNAME ='';
$CURRENCY ='';
$BMEXPDT ='';
$DVWDETAIL ='';
$BMENTRYDT ='';

//['LOAD']['CURRENCYDISP']
$LOAD ='';
$CURRENCYDISP ='';

$data['searchDvw'] = array();
$data['searchTvw'] = array();


if(!empty($_POST)) {
   if(isset($_POST['search'])) {
        global $data;
        $data = getSessionData(); 

        // print_r("search click");
        $data['BMPITEMCD'] = isset($_POST['BMPITEMCD']) ? $_POST['BMPITEMCD']: '';
        $data['SYSLANG'] = isset($_POST['SYSLANG']) ? $_POST['SYSLANG']: '';
        $data['BMVERSION'] = isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
        $data['SYSAPPNAME'] = isset($_POST['SYSAPPNAME']) ? $_POST['SYSAPPNAME']: '';
        $data['PITEM'] = isset($_POST['PITEM']) ? $_POST['PITEM']: '';
        $data['BMVERSION'] = isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
        $data['CURRENCY'] = isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '';

        //mas.ItemBOM.searchDvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY
        $query = $javaFunc->searchDvw($data['BMPITEMCD'],$data['SYSLANG'],$data['BMVERSION'],$data['SYSAPPNAME'],
                                    $data['PITEM'],$data['BMVERSION'],$data['CURRENCY']);
        $query2 = $javaFunc->searchTvw($data['BMPITEMCD'],$data['SYSLANG'],$data['BMVERSION'],$data['SYSAPPNAME'],
                                    $data['PITEM'],$data['BMVERSION'],$data['CURRENCY']);

        //mas.ItemBOM.searchTvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY 
        // $data['BM'] = $query;
        // print_r($query);

        if(!empty($query)) {
            // $data['BM'] = array();
            // for ($i = 1 ; $i < count($query)+1; $i++) {
                $data['BM'] = $query; 
                $data['searchDvw'] = $query; 
                // $data['BM'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }

        if(!empty($query2)) {
            // $data['BM'] = array();
            // for ($i = 1 ; $i < count($query)+1; $i++) {
                $data['searchTvw'] = $query2; 

                foreach($query2 as &$val) {
                    $val['FILE'] = '0';
                }
                // $data['BM'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }

        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($data);
    }

    if(isset($_POST['copy'])) {
        // mas.ItemBOM.searchClone ITEMCLONE,BMVERSION,CURRENCY
        $data['ITEMCLONE'] = isset($_POST['ITEMCLONE']) ? $_POST['ITEMCLONE']: '';
        $data['BMVERSION'] = isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
        $data['CURRENCY'] = isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '';
        $query = $javaFunc->searchClone($data['ITEMCLONE'],$data['BMVERSION'],$data['CURRENCY']);

        print_r($query);
        if(!empty($query)) {
            // $data['BM'] = array();
            // for ($i = 1 ; $i < count($query)+1; $i++) {
                $data['BM'] = $query; 
                // $data['BM'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }


        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

    }


    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "keepBomData") { keepBomData(); }
        if ($_POST['action'] == "commit") { commit(); }
        if ($_POST['action'] == "searchDvw") { searchDvw();}
        if ($_POST['action'] == "unsetBomItemData") {  unsetBomItemData($_POST['lineIndex']); }
        // if ($_POST['action'] == "insert") { insertWc(); }
        if ($_POST['action'] == "dd2") { dd2(); }
        if ($_POST['action'] == "dd3") { dd3(); }
        // if ($_POST['action'] == "delete") { deleteWc(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    
        if(isset($_GET['refresh'])) {
            // print_r('refresh');

        $data = getSessionData();
        $BMPITEMCD = isset($data['BMPITEMCD']) ? $data['BMPITEMCD']: '';
        $SYSLANG = isset($data['SYSLANG']) ? $data['SYSLANG']: '';
        $BMVERSION = isset($data['BMVERSION']) ? $data['BMVERSION']: '';
        $SYSAPPNAME = isset($data['SYSAPPNAME']) ? $data['SYSAPPNAME']: '';
        $PITEM = isset($data['PITEM']) ? $data['PITEM']: '';
        $BMVERSION = isset($data['BMVERSION']) ? $data['BMVERSION']: '';
        $CURRENCY = isset($data['CURRENCY']) ? $data['CURRENCY']: '';
        //mas.ItemBOM.searchDvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY

        //mas.ItemBOM.searchTvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY 

        $excute = $javaFunc->searchDvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$BMVERSION,$CURRENCY);
        $excute2 = $javaFunc->searchTvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$BMVERSION,$CURRENCY);

        // print_r($excute);

        if(!empty($excute)) {
            unsetSessionkey('BM');

            // $data['BM'] = array();
            // for ($i = 1 ; $i < count($excute)+1; $i++) {
                $data['BM'] = $excute; 
                $data['searchDvw'] = $excute; 
                // $data['BM'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }
        if(!empty($excute2)) {
            unsetSessionkey('BM');

            // $data['BM'] = array();
            // for ($i = 1 ; $i < count($excute2)+1; $i++) {
                $data['searchTvw'] = $excute2; 
                // $data['BM'][$i] = $query[$i]; 
            // }

            setSessionArray($data);
        }

    }

    // onchange BMPITEMCD mas.ItemBOM.getPItem
    else if(isset($_GET['BMPITEMCD'])) {
        // print_r('XXX onchange BMPITEMCD XXX');

        unsetSessionkey('BMPITEMCD');
        unsetSessionkey('PITEMNAME');

        //mas.ItemBOM.getPItem BMPITEMCD RUN(SEARCH)
        $data['BMPITEMCD'] = isset($_GET['BMPITEMCD']) ? $_GET['BMPITEMCD']: '';
        $excute = $javaFunc->getPItem($_GET['BMPITEMCD']);
        $data = $excute;
        setSessionArray($data); 

        // print_r($data);

        // if(!empty($data['BMPITEMCD'])&&!empty($data['SYSLANG'])&&!empty($data['BMVERSION'])&&!empty($data['SYSAPPNAME'])
        //  &&!empty($data['PITEM'])&&!empty($data['BMVERSION'])&&!empty($data['CURRENCY']))
         if(!empty($data['BMPITEMCD']))
        {        
            // print_r('XXX if onchange BMPITEMCD XXX');
            global $data;
            $data = getSessionData(); 

    // searchTvw
            $query = $javaFunc->searchDvw($data['BMPITEMCD'],'',$data['BMVERSION'],
                                        '',$data['PITEM'],$data['BMVERSION'],'');
            $query2 = $javaFunc->searchTvw($data['BMPITEMCD'],'',$data['BMVERSION'],
                                        '',$data['PITEM'],$data['BMVERSION'],'');

            $data['BM'] = $query;
            $data['searchDvw'] = $query;
           
            // print_r('searchDvw');
            // echo '<pre>';
            // print_r($data['searchDvw']);
            // echo '</pre>';
            // print_r('searchTvw');

            foreach($query2 as &$val) {
                $val['FILE'] = '0';
            }

            $data['searchTvw'] = $query2;
            // echo '<pre>';
            // print_r($data['searchTvw']);
            // echo '</pre>';


            // print_r($query);

            if(!empty($query)) {
                setSessionArray($data); 
    
            }
            if(!empty($query2)) {
                setSessionArray($data); 
    
            }
    
        }
    }

// onchange   mas.ItemBOM.getStaff STAFFCD 
    else if(isset($_GET['STAFFCD'])) {
        // print_r('onchange division');

        unsetSessionkey('STAFFCD');
        unsetSessionkey('STAFFNAME');
        //mas.DivisionMaster.getDiv	STAFFCD
        $data['STAFFCD'] = isset($_GET['STAFFCD']) ? $_GET['STAFFCD']: '';
        $excute = $javaFunc->getStaff($_GET['STAFFCD']);
        $data = $excute;
        // print_r($data);
    }

// onchange   mas.ItemBOM.getClone ITEMCLONE,BMCOMB
    else if(isset($_GET['ITEMCLONE'])) {
        // print_r('onchange staff');

        unsetSessionkey('ITEMCLONE');

        $data['ITEMCLONE'] = isset($_GET['ITEMCLONE']) ? $_GET['ITEMCLONE']: '';
        $data['BMCOMB'] = isset($_GET['BMCOMB']) ? $_GET['BMCOMB']: '';
        $excute = $javaFunc->getClone($_GET['ITEMCLONE'],$_GET['BMCOMB']);
        $data = $excute;
        // print_r($data);
    }
    
    // onchange   mas.ItemBOM.getCItem BMCITEMCD,PITEM
    else if(isset($_GET['BMCITEMCD'])) {
        // print_r('onchange staff');
           
        unsetSessionkey('BMCITEMCD');
        unsetSessionkey('CITEMNAME');
        unsetSessionkey('CITEMSPEC');
        unsetSessionkey('CITEMDRAWNO');

        $data['BMCITEMCD'] = isset($_GET['BMCITEMCD']) ? $_GET['BMCITEMCD']: '';
        $data['PITEM'] = isset($_GET['PITEM']) ? $_GET['PITEM']: '';
        $excute = $javaFunc->getCItem($_GET['BMCITEMCD'],$_GET['PITEM']);
        $data = $excute;
        print_r($data);
    }

    
    // onchange   mas.ItemBOM.chkBmExpDt BMEXPDT
    else if(isset($_GET['BMEXPDT'])) {
        // print_r('onchange staff');
           
        unsetSessionkey('BMEXPDT');

        $data['BMEXPDT'] = isset($_GET['BMEXPDT']) ? $_GET['BMEXPDT']: '';
        $excute = $javaFunc->chkBmExpDt($_GET['BMEXPDT']);
        $data = $excute;
        // print_r($data);
    }

//from search ***
    //SEARCHITEM SEARCHSTAFF SEARCHITEM SEARCHITEM

    //mas.ItemBOM.getPItem BMPITEMCD RUN(SEARCH)
    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        // print_r('search wc');
        // print_r($_GET['divisioncd']);
        $data['BMPITEMCD'] = $_GET['itemcd'];
        $excute = $javaFunc->getPItem($data['BMPITEMCD']);
        $data = $excute;
        setSessionArray($data); 
        // print_r($data);

        // if(!empty($data['BMPITEMCD'])&&!empty($data['SYSLANG'])&&!empty($data['BMVERSION'])&&!empty($data['SYSAPPNAME'])
        //  &&!empty($data['PITEM'])&&!empty($data['BMVERSION'])&&!empty($data['CURRENCY']))
        // {
        //     $query = $javaFunc->searchDvw($data['BMPITEMCD'],$data['SYSLANG'],$data['BMVERSION'],
        //             $data['SYSAPPNAME'],$data['PITEM'],$data['BMVERSION'],$data['CURRENCY']);
        //     $data['BM'] = $query;
        //     print_r($data['BM']);
        //     if(!empty($query)) {
        //         setSessionArray($data); 
    
        //     }
    
        // }

        if(!empty($data['BMPITEMCD']))
        {        
            // print_r('XXX if onchange BMPITEMCD XXX');
            global $data;
            $data = getSessionData(); 
            $BMPITEMCD = isset($data['BMPITEMCD']) ? $data['BMPITEMCD']: '';
            $SYSLANG = isset($data['SYSLANG']) ? $data['SYSLANG']: '';
            $BMVERSION = isset($data['BMVERSION']) ? $data['BMVERSION']: '';
            $SYSAPPNAME = isset($data['SYSAPPNAME']) ? $data['SYSAPPNAME']: '';
            $PITEM = isset($data['PITEM']) ? $data['PITEM']: '';
            $BMVERSION = isset($data['BMVERSION']) ? $data['BMVERSION']: '';
            $CURRENCY = isset($data['CURRENCY']) ? $data['CURRENCY']: '';
            //mas.ItemBOM.searchDvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY
    
            //mas.ItemBOM.searchTvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY 
    
            $excute = $javaFunc->searchDvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$BMVERSION,$CURRENCY);
            $excute2 = $javaFunc->searchTvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$BMVERSION,$CURRENCY);
    
            // print_r($excute);
    
            if(!empty($excute)) {
                unsetSessionkey('BM');
    
                // $data['BM'] = array();
                // for ($i = 1 ; $i < count($excute)+1; $i++) {
                    $data['BM'] = $excute; 
                    $data['searchDvw'] = $excute; 
                    // $data['BM'][$i] = $query[$i]; 
                // }
    
                setSessionArray($data);
            }
            if(!empty($excute2)) {
                unsetSessionkey('BM');
    
                // $data['BM'] = array();
                // for ($i = 1 ; $i < count($excute2)+1; $i++) {
                    $data['searchTvw'] = $excute2; 
                    // $data['BM'][$i] = $query[$i]; 
                // }
    
                setSessionArray($data);
            }
    
        }

    }

    //mas.ItemBOM.getStaff STAFFCD
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        // print_r('search division');

        // $data['LOCTYP'] = $_GET['loctype'];
        $data['STAFFCD'] = $_GET['staffcode'];
        $excute = $javaFunc->getStaff($data['STAFFCD']);
        // print_r($excute);
        $data = $excute;
        setSessionArray($data); 

    }

    //mas.ItemBOM.getClone ITEMCLONE,BMCOMB
    else if(!empty($_GET['index'])&&$_GET['index']==3)
    {        
        // print_r('search staff');

        $data['ITEMCLONE'] = $_GET['itemcd'];
        $excute = $javaFunc->getClone($data['ITEMCLONE'],$data['BMCOMB']);
        // print_r($excute);
        $data = $excute;
        setSessionArray($data); 

    }
    
    //mas.ItemBOM.getCItem BMCITEMCD,PITEM
    else if(!empty($_GET['index'])&&$_GET['index']==4)
    {        
        // print_r('search staff');

        $data['BMCITEMCD'] = $_GET['itemcd'];
        $excute = $javaFunc->getCItem($data['BMCITEMCD'],$data['PITEM']);
        // print_r($excute);
        $data = $excute;
        setSessionArray($data); 

    }



    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    if(!empty($excute2)) {
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


$dd1 = $data['DRPLANG']['BMVERSION'];
$dd2 = $data['DRPLANG']['UNIT'];
$dd3 = $data['DRPLANG']['PROCUREMENT'];

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
function dd2() {
    // print_r('dd2 : ');
    global $data;

    $loadApp = getSystemData($_SESSION['APPCODE']);
    $data['DRPLANG'] = get_sys_dropdown($loadApp);
    $data['DD2'] = $data['DRPLANG']['UNIT'];

    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($data['DD2']);

}

function dd3() {
    // print_r('dd3 : ');
    global $data;

    $loadApp = getSystemData($_SESSION['APPCODE']);
    $data['DRPLANG'] = get_sys_dropdown($loadApp);
    $data['DD3'] = $data['DRPLANG']['PROCUREMENT'];

    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($data['DD3']);

}

function commit() {
    global $data;
    
    // mas.ItemBOM.commitAll BMVERSION,PITEM,BMENTRYDT,STAFFCD,BMCITEMCD,CITEMNAME,CITEMSPEC,
    // BMBASETYP,BMQTY,ITEMUNITTYPSTR,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYPSTR,BMREM,BMPHANTOMFLG,
    // ITEMUNITTYP,BMSUPPLYTYP,CITEMDRAWNO,BMID,BMADDSTDUNITPRC,CURRENCYDISP,BMADDSRPG,BMADDSRPUNITPRC,RUNNER_WGT,REUSE_RATE
    // mas.ItemBOM.commitAll DVWDETAIL,BMVERSION,PITEM,BMENTRYDT,STAFFCD RUN(END)

    // DVWDETAIL|BMVERSION|PITEM|testbomproduct|BMENTRYDT|20231215|STAFFCD|dev07|ITEMUNITTYPSTR|BMSUPPLYTYPSTR|DATA|BMCITEMCD

    $javaInsrt = new BMEntry;
    $Param = array( "DVWDETAIL" => isset($data['BM']) ? $data['BM']: '',
                    "BMVERSION" => isset($_POST['BMVERSION']) ? $_POST['BMVERSION']: '',
                    "PITEM" => isset($_POST['PITEM']) ? $_POST['PITEM']: '',
                    "BMENTRYDT" => isset($_POST['BMENTRYDT']) ? $_POST['BMENTRYDT']: '',
                    "STAFFCD" => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    "ITEMUNITTYPSTR" => isset($_POST['ITEMUNITTYPSTR']) ? $_POST['ITEMUNITTYPSTR']: '',
                    "BMSUPPLYTYPSTR" => isset($_POST['BMSUPPLYTYPSTR']) ? $_POST['BMSUPPLYTYPSTR']: '',
                    "DATA" => isset($_POST['DATA']) ? $_POST['DATA']: '',
                    "BMCITEMCD" => isset($_POST['BMCITEMCD']) ? $_POST['BMCITEMCD']: '',
                );
                    print_r($data['BM']);
    $commit = $javaInsrt->commitAll($Param);

    // unset 2 ตัวนี้เพราะค่าอื่นยังต้องใช้
    // unsetSessionkey('STATECD');
    // unsetSessionkey('STATENAME');
    
    // unsetSessionData();
    echo json_encode($commit);
}

function searchTvw() {
    global $data;
    $searchfunc = new BMEntry;
    // $data['ACCGROUPTYP'] = isset($_POST['ACCGROUPTYP']) ? $_POST['ACCGROUPTYP']: '';
    // $checkGroup = $searchfunc->checkGroup($data['ACCGROUPTYP']);
    $query = $searchfunc->searchTvw($data['BMPITEMCD'],'',$data['BMVERSION'],
                                '',$data['PITEM'],$data['BMVERSION'],'');
    $data['searchDvw'] = $searchfunc->searchDvw($data['BMPITEMCD'],'',$data['BMVERSION'],
                                '',$data['PITEM'],$data['BMVERSION'],'');
    $data['searchTvw'] = $query;
    setSessionArray($data); 
}

function searchDvw() {
    global $data;
    $data = getSessionData();
    $searchfunc = new BMEntry;
    $searchDvw = $searchfunc->searchDvw($data['BMPITEMCD'],'',$data['BMVERSION'],
                                '',$_POST['PITEM'],$data['BMVERSION'],'');
    if(!empty($searchDvw)) {
        for ($i = 1 ; $i <= count($searchDvw); $i++) {
            $data['BM'][$i] = $searchDvw[$i]; 
        }
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    echo json_encode($searchDvw);
}

//tableกับตัวแปรที่ใช้ทุกตัว
// BMPITEMCD STAFFCD ITEMCLONE BMCOMB BMCITEMCD PITEM SYSLANG 
// BMVERSION SYSAPPNAME CURRENCY BMEXPDT 
// DVWDETAIL BMENTRYDT 
//['LOAD']['CURRENCYDISP']
// PITEMNAME  STAFFNAME   CITEMNAME CITEMSPEC CITEMDRAWNO 
//SYSLANG SYSAPPNAME CURRENCY
//searchDvw searchTvw
//ROWNO,BMBASETYP,BMQTY,BMADDSTDUNITPRC,RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMSUPPLYTYP,BMREM,BMPHANTOMFLG,BMID,ITEMIMGLOC
    // <!-- ITEMUNITTYPSTR, BMSUPPLYTYPSTR, BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP -->

function setSessionArray($arr){
    $keepField = array('BM', 'DD2','DD3', 'KEEPSTATUS', 'BMPITEMCD', 'STAFFCD', 'ITEMCLONE', 'BMCOMB', 'BMCITEMCD', 'PITEM', 'SYSLANG', 'BMVERSION', 'SYSAPPNAME', 'CURRENCY'
                        , 'BMEXPDT', 'DVWDETAIL', 'BMENTRYDT', 'LOAD', 'CURRENCYDISP', 'PITEMNAME', 'STAFFNAME', 'CITEMNAME', 'CITEMSPEC', 'CITEMDRAWNO'
                        ,'searchDvw' ,'searchTvw', 'ITEMUNITTYP','ITEMUNITTYPSTR', 'ROWNO', 'BMBASETYP', 'BMQTY', 'BMADDSTDUNITPRC', 'RUNNER_WGT', 'REUSE_RATE' 
                        , 'BMADDSRPG', 'BMADDSRPUNITPRC', 'BMSCRAPRATE', 'BMISSUEDT', 'BMSUPPLYTYP','BMSUPPLYTYPSTR', 'BMREM', 'BMPHANTOMFLG', 'BMID', 'ITEMIMGLOC'
                        , 'BMQTY2', 'WCCD', 'WCNAME', 'DIVISIONTYP');
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

function keepBomData() {
    global $data;
    print_r('keepBomData : ');
    if(isset($_POST['ROWNOA'])) {
        for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
            // <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,
            // RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->
            // <!-- type="hidden" -->
            // <!-- (HIDDEN)BMPHANTOMFLG,CITEMDRAWNO,BMID,ITEMIMGLOC -->
            $data['BM'][$i+1] = array(
                                        // 'ROWNO' => $_POST['ROWNOA'][$i],
                                        'BMCITEMCD' => $_POST['BMCITEMCDA'][$i],
                                        'BMID' => $_POST['BMCITEMCDA'][$i],
                                        'CITEMNAME' => $_POST['CITEMNAMEA'][$i],
                                        'CITEMSPEC' => $_POST['CITEMSPECA'][$i],
                                        'CITEMDRAWNO' => $_POST['CITEMDRAWNOA'][$i],
                                        'ITEMIMGLOC' => $_POST['ITEMIMGLOCA'][$i],
                                        'BMBASETYP' => $_POST['BMBASETYPA'][$i],
                                        'BMQTY' => $_POST['BMQTYA'][$i],
                                        // 'BMQTY2' => $_POST['BMQTY2A'][$i],
                                        'ITEMUNITTYP' => $_POST['ITEMUNITTYPSTRA'][$i],//
                                        'ITEMUNITTYPSTR' => $_POST['ITEMUNITTYPSTRA'][$i],//
                                        'BMSCRAPRATE' => $_POST['BMSCRAPRATEA'][$i],
                                        'BMISSUEDT' => str_replace("-", "/", $_POST['BMISSUEDTA'][$i]),
                                        'BMEXPDT' => str_replace("-", "/", $_POST['BMEXPDTA'][$i]),
                                        'BMSUPPLYTYPSTR' => $_POST['BMSUPPLYTYPSTRA'][$i],//
                                        'BMSUPPLYTYP' => $_POST['BMSUPPLYTYPSTRA'][$i],//
                                        'BMREM' => $_POST['BMREMA'][$i],
                                        'BMPHANTOMFLG' => $_POST['BMPHANTOMFLGA'][$i],
                                        'RUNNER_WGT' => $_POST['RUNNER_WGTA'][$i],
                                        'REUSE_RATE' => $_POST['REUSE_RATEA'][$i],
                                        'BMADDSRPG' => $_POST['BMADDSRPGA'][$i],
                                        'BMADDSRPUNITPRC' => $_POST['BMADDSRPUNITPRCA'][$i],
                                        'BMADDSTDUNITPRC' => $_POST['BMADDSTDUNITPRCA'][$i],
                                        'CURRENCYDISP' => $_POST['CURRENCYDISPA'][$i],
                                        // 'BMCOMB' => $_POST['BMCOMBA'][$i],
                                        // 'WCCD' => $_POST['WCCDA'][$i],
                                        // 'WCNAME' => $_POST['WCNAMEA'][$i],
                                        // 'DIVISIONTYP' => $_POST['DIVISIONTYPA'][$i],
                
        );
        }
        print_r($data['BM']);
        setSessionArray($data);
    }
   
}

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'BM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['WORK']));
    $data['BM'] = array_combine(range(1, count($data['BM'])), array_values($data['BM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['WORK']);
}

function unsetBomItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'BM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['BM']));
    $data['BM'] = array_combine(range(1, count($data['BM'])), array_values($data['BM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['BM']);
}

?>