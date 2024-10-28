<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/PHPExcel.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode('/', dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$systemName = strtolower($appcode);
$javaFunc = new IssueSaleInvoiceByShip;
$minrow = 0;
$maxrow = 5;
$minrowA = 0;
$maxrowA = 5;

if(!empty($_GET)) {
    if(!empty($_GET['SALETRANNO'])) {
        unsetSessionData();
        $query = $javaFunc->getSaleTran($_GET['SALETRANNO']);
        // echo '<pre>';
        // print_r(array_shift($query));
        // echo '</pre>';
        if(!empty($query)) {
            $data = array_shift($query);
            $itemlist = $javaFunc->getSaleTranLn($data['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
            $shiplist = $javaFunc->getSaleTranShip($data['SALETRANNO']);
            // echo '<pre>';
            // print_r($shiplist);
            // echo '</pre>'; 
            if(!empty($shiplist)) {
                $data['ITEMSHIP'] = $shiplist;
            }
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(checkSessionData()) { $data = getSessionData(); }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); unlockForm(); }
    if ($_POST['action'] == 'keepdata') { setOldValue(); }
    if ($_POST['action'] == 'keepItemData') { setItemValue(); }
    if ($_POST['action'] == 'DIVISIONCD') { getDivision(); }
    if ($_POST['action'] == 'CUSTOMERCD') { getCustomer(); }
    if ($_POST['action'] == 'CUSCURCD') { getCurrency(); }
    if ($_POST['action'] == 'STAFFCD') { getStaff(); }
    if ($_POST['action'] == 'selectShip') { selectShip(); }
    if ($_POST['action'] == 'setSelectedShipping') { setSelectedShipping(); }
    if ($_POST['action'] == 'unlockShipping') { unlockShipping(); }
    if ($_POST['action'] == 'getAmt') { getAmt(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'SVPrint') { saleVoucher(); }
    if ($_POST['action'] == 'IVprint') { invoice(); }
    if ($_POST['action'] == 'TIVprint') { taxInvoice(); }
    if ($_POST['action'] == 'IVprintCheck') { IVprintCheck(); }
    if ($_POST['action'] == 'replacez') { replacez(); }
    if ($_POST['action'] == 'setSaleDivCon2') { setSaleDivCon2(); }
    if ($_POST['action'] == 'SEARCH') { search(); }
}

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$loadevent = getSystemData($_SESSION['APPCODE'].'_EVENT');
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_EVENT', $loadevent);
}
setloadEvent($loadevent);
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['GROUPRT'] = $loadevent['GROUPRT'];
$BRANCH_KBN = $data['DRPLANG']['BRANCH_KBN'];
$CANCELREASON = $data['DRPLANG']['CANCELREASON'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($loadevent);
// echo '</pre>';
// echo '<pre>';
// print_r($data);
// echo '</pre>';
// --------------------------------------------------------------------------//

function search() {
    global $data; $data = $_POST;
    $data['ITEMSHIP'] = array(); $RowParam = array();
    $searchfunc = new IssueSaleInvoiceByShip;
    if(!empty($_POST['SHIPTRANORDERNO'])) {
        for ($i = 0 ; $i < count($_POST['SHIPTRANORDERNO']); $i++) { 
            $RowParam[] = array('CHK' => isset( $_POST['CHK'][$i]) ?  $_POST['CHK'][$i]: 'F',
                                'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO'][$i]) ? $_POST['SHIPTRANORDERNO'][$i]: '',
                                'SHIPTRANORDERLN' => isset($_POST['SHIPTRANORDERLN'][$i]) ? $_POST['SHIPTRANORDERLN'][$i]: '',
                                'SHIPTRANDT' => isset($_POST['SHIPTRANDT'][$i]) ? $_POST['SHIPTRANDT'][$i]: '',
                                'SHIPTRANIMCD' => isset($_POST['SHIPTRANIMCD'][$i]) ? $_POST['SHIPTRANIMCD'][$i]: '',
                                'SHIPTRANIMNAME' => isset($_POST['SHIPTRANIMNAME'][$i]) ? $_POST['SHIPTRANIMNAME'][$i]: '',
                                'SHIPTRANSHIPQTY' => isset($_POST['SHIPTRANSHIPQTY'][$i]) ? $_POST['SHIPTRANSHIPQTY'][$i]: '',
                                'SHIPTRANSALENO' => isset($_POST['SHIPTRANSALENO'][$i]) ? $_POST['SHIPTRANSALENO'][$i]: '',
                                'SHIPTRANSALELN' => isset($_POST['SHIPTRANSALELN'][$i]) ? $_POST['SHIPTRANSALELN'][$i]: '');
        }
    }
    $param = array( 'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                    'SHIPDATE1' => isset($_POST['SHIPDATE1']) ? str_replace('-', '', $_POST['SHIPDATE1']): '',
                    'SHIPDATE2' => isset($_POST['SHIPDATE2']) ? str_replace('-', '', $_POST['SHIPDATE2']): '',
                    'DSSHIP' => isset($_POST['DSSHIP']) ? $_POST['DSSHIP']: '',
                    'DATA' => $RowParam);
    // print_r($param);
    $search = $searchfunc->Search($param);
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
    if(!empty($search)) {
        $data['ITEMSHIP'] = $search;
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}

function getCustomer() {
    $javafunc = new IssueSaleInvoiceByShip;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    echo json_encode($query);
}

function getDivision() {
    $javafunc = new IssueSaleInvoiceByShip;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDivision($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new IssueSaleInvoiceByShip;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new IssueSaleInvoiceByShip;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function selectShip() {
    $javafunc = new IssueSaleInvoiceByShip;
    $param = array( 'CHK' => isset($_POST['CHK']) ? $_POST['CHK']: 'F',
                    'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO']) ? $_POST['SHIPTRANORDERNO']: '',
                    'SHIPTRANORDERLN' => isset($_POST['SHIPTRANORDERLN']) ? $_POST['SHIPTRANORDERLN']: '');
    // print_r($param);
    $query = $javafunc->SelectShip($param);
    echo json_encode($query);
}  

function setSaleDivCon2() {
    $javafunc = new IssueSaleInvoiceByShip;
    $SALEDIVCON2CBO = isset($_POST['SALEDIVCON2CBO']) ? $_POST['SALEDIVCON2CBO']: '';
    $query = $javafunc->setSaleDivCon2($SALEDIVCON2CBO);
    // if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function setSelectedShipping() {
    global $data; $data = $_POST;
    $RowParam = array(); $data['ITEM'] = array(); $data['ITEMSHIP'] = array();
    $javafunc = new IssueSaleInvoiceByShip;
    if(!empty($_POST['SHIPTRANORDERNO'])) {
        for ($i = 0 ; $i < count($_POST['SHIPTRANORDERNO']); $i++) { 
            $RowParam[] = array('CHK' => isset( $_POST['CHK'][$i]) ?  $_POST['CHK'][$i]: 'F',
                                'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO'][$i]) ? $_POST['SHIPTRANORDERNO'][$i]: '',
                                'SHIPTRANORDERLN' => isset($_POST['SHIPTRANORDERLN'][$i]) ? $_POST['SHIPTRANORDERLN'][$i]: '',
                                'SHIPTRANDT' => isset($_POST['SHIPTRANDT'][$i]) ? $_POST['SHIPTRANDT'][$i]: '',
                                'SHIPTRANIMCD' => isset($_POST['SHIPTRANIMCD'][$i]) ? $_POST['SHIPTRANIMCD'][$i]: '',
                                'SHIPTRANIMNAME' => isset($_POST['SHIPTRANIMNAME'][$i]) ? $_POST['SHIPTRANIMNAME'][$i]: '',
                                'SHIPTRANSHIPQTY' => isset($_POST['SHIPTRANSHIPQTY'][$i]) ? $_POST['SHIPTRANSHIPQTY'][$i]: '',
                                'SHIPTRANSALENO' => isset($_POST['SHIPTRANSALENO'][$i]) ? $_POST['SHIPTRANSALENO'][$i]: '',
                                'SHIPTRANSALELN' => isset($_POST['SHIPTRANSALELN'][$i]) ? $_POST['SHIPTRANSALELN'][$i]: '');
        }
    }

    $param = array( 'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'VATRATE' => isset($_POST['VATRATE']) ? str_replace(',', '', $_POST['VATRATE']): '',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? str_replace(',', '', $_POST['DISCRATE']): '',
                    'SHIPDATE1' => isset($_POST['SHIPDATE1']) ? str_replace('-', '', $_POST['SHIPDATE1']): '',
                    'SHIPDATE2' => isset($_POST['SHIPDATE2']) ? str_replace('-', '', $_POST['SHIPDATE2']): '',
                    'DSSHIP' => isset($_POST['DSSHIP']) ? $_POST['DSSHIP']: '',
                    'DATA' => $RowParam);
    // echo '<pre>';
    // print_r($param);
    // echo '</pre>';
    // exit();
    $setSelectedShipping = $javafunc->setSelectedShipping($param);
    $setInvoiceItems = $javafunc->setInvoiceItems($param);
    $lockShipping = $javafunc->lockShipping();
    // echo '<pre>'; print_r($setSelectedShipping); print_r($setInvoiceItems); print_r($lockShipping); echo '</pre>';
    if(!empty($setSelectedShipping)) {
        $data['ITEMSHIP'] = $setSelectedShipping;
    }
    if(!empty($setInvoiceItems)) {
        $data['ITEM'] = $setInvoiceItems;
    }
    if(!empty($lockShipping)) {
        setlockShipping($lockShipping);
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
}  

function unlockShipping() {
    global $data;
    $javafunc = new IssueSaleInvoiceByShip;
    $unlockShipping = $javafunc->unlockShipping();
    if(!empty($unlockShipping)) {
        setlockShipping($unlockShipping);
    }
    if(checkSessionData()) { $data = getSessionData(); }
}  

function unlockForm() {
    global $data;
    $javafunc = new IssueSaleInvoiceByShip;
    $unlockForm = $javafunc->unlockForm();
    if(!empty($unlockForm)) {
        setlockShipping($unlockForm);
    }
    if(checkSessionData()) { $data = getSessionData(); }
}  

function commit() {

    $RowParam = array(); $ShipParam = array();
    $cmtfunc = new IssueSaleInvoiceByShip;
    if(!empty($_POST['SHIPTRANORDERNO'])) {
        for ($i = 0 ; $i < count($_POST['SHIPTRANORDERNO']); $i++) { 
            $ShipParam[] = array('CHK' => isset( $_POST['CHK'][$i]) ?  $_POST['CHK'][$i]: 'F',
                                'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO'][$i]) ? $_POST['SHIPTRANORDERNO'][$i]: '',
                                'SHIPTRANORDERLN' => isset($_POST['SHIPTRANORDERLN'][$i]) ? $_POST['SHIPTRANORDERLN'][$i]: '',
                                'SHIPTRANDT' => isset($_POST['SHIPTRANDT'][$i]) ? $_POST['SHIPTRANDT'][$i]: '',
                                'SHIPTRANIMCD' => isset($_POST['SHIPTRANIMCD'][$i]) ? $_POST['SHIPTRANIMCD'][$i]: '',
                                'SHIPTRANIMNAME' => isset($_POST['SHIPTRANIMNAME'][$i]) ? $_POST['SHIPTRANIMNAME'][$i]: '',
                                'SHIPTRANSHIPQTY' => isset($_POST['SHIPTRANSHIPQTY'][$i]) ? $_POST['SHIPTRANSHIPQTY'][$i]: '',
                                'SHIPTRANSALENO' => isset($_POST['SHIPTRANSALENO'][$i]) ? $_POST['SHIPTRANSALENO'][$i]: '',
                                'SHIPTRANSALELN' => isset($_POST['SHIPTRANSALELN'][$i]) ? $_POST['SHIPTRANSALELN'][$i]: '');
        }
    }
    // print_r($ShipParam);
    if(!empty($_POST['ITEMCD'])) {
        for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
            $RowParam[] = array('ROWNO' => $i+1,
                                'ITEMCD' => isset($_POST['ITEMCD'][$i]) ? $_POST['ITEMCD'][$i]: '',
                                'ITEMNAME' => isset($_POST['ITEMNAME'][$i]) ? $_POST['ITEMNAME'][$i]: '',
                                'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? str_replace(',', '', $_POST['SALEQTY'][$i]): '0.00',
                                'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP'][$i]) ? $_POST['ITEMUNITTYP'][$i]: '',
                                'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? str_replace(',', '', $_POST['SALEUNITPRC'][$i]): '0.00',
                                'SALEDISCOUNT' => isset($_POST['SALEDISCOUNT'][$i]) ? str_replace(',', '', $_POST['SALEDISCOUNT'][$i]): '0.00',
                                'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? str_replace(',', '', $_POST['SALEAMT'][$i]): '0.00',
                                'ITEMSPEC' => isset($_POST['ITEMSPEC'][$i]) ? $_POST['ITEMSPEC'][$i]: '',
                                'SALEDISCOUNT2' => isset($_POST['SALEDISCOUNT2'][$i]) ? str_replace(',', '', $_POST['SALEDISCOUNT2'][$i]): '0.00',
                                'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? str_replace(',', '', $_POST['SALETAXAMT'][$i]): '0.00');
        }
    }
    // print_r($RowParam);
    $param = array( 'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                    'SVNO' => isset($_POST['SVNO']) ? $_POST['SVNO']: '',
                    'SALETRANSALEDT' => !empty($_POST['SALETRANSALEDT']) ?  str_replace('-', '', $_POST['SALETRANSALEDT']): '',
                    'SALETRANINSPDT' => !empty($_POST['SALETRANINSPDT']) ?  str_replace('-', '', $_POST['SALETRANINSPDT']): '',
                    'SALEORDERNO' => isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'DIVISIONNAME' => isset($_POST['DIVISIONNAME']) ? $_POST['DIVISIONNAME']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'ESTCUSTEL' => isset($_POST['ESTCUSTEL']) ? $_POST['ESTCUSTEL']: '',
                    'ESTCUSFAX' => isset($_POST['ESTCUSFAX']) ? $_POST['ESTCUSFAX']: '',
                    'ESTCUSSTAFF' => isset($_POST['ESTCUSSTAFF']) ? $_POST['ESTCUSSTAFF']: '',
                    'SALEDIVCON1' => isset($_POST['SALEDIVCON1']) ? $_POST['SALEDIVCON1']: '',
                    'SALEDIVCON2' => isset($_POST['SALEDIVCON2']) ? $_POST['SALEDIVCON2']: '',
                    'SALEDIVCON3' => isset($_POST['SALEDIVCON3']) ? $_POST['SALEDIVCON3']: '',
                    'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                    'DESCRIPTION' => isset($_POST['DESCRIPTION']) ? $_POST['DESCRIPTION']: '',
                    'SALETERM' => isset($_POST['SALETERM']) ? $_POST['SALETERM']: '0',
                    'SALECUSMEMO' => isset($_POST['SALECUSMEMO']) ? $_POST['SALECUSMEMO']: '',
                    'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'SALELNDUEDT' => isset($_POST['SALELNDUEDT']) ? str_replace('-', '', $_POST['SALELNDUEDT']) :'',
                    'S_TTL' => isset($_POST['S_TTL']) ? str_replace(',', '', $_POST['S_TTL']): '0.00',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0',
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? str_replace(',', '', $_POST['DISCOUNTAMOUNT']): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? str_replace(',', '', $_POST['QUOTEAMOUNT']): '0.00',
                    'VATRATE' => isset($_POST['VATRATE']) ? str_replace(',', '', $_POST['VATRATE']): '0.00',
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? str_replace(',', '', $_POST['VATAMOUNT']): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? str_replace(',', '', $_POST['VATAMOUNT1']): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? str_replace(',', '', $_POST['T_AMOUNT']): '0.00',
                    'DSSHIP' => isset($_POST['DSSHIP']) ? $_POST['DSSHIP']: '',
                    'REPLACEMODE' => isset($_POST['REPLACEMODE']) ? $_POST['REPLACEMODE']: '0',
                    'CANCELSALETRANNO' => isset($_POST['CANCELSALETRANNO']) ? $_POST['CANCELSALETRANNO']: '',
                    'SALEDIVCON2CBO' => isset($_POST['SALEDIVCON2CBO']) ? $_POST['SALEDIVCON2CBO']: '',
                    'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                    'SHIPDATE1' => isset($_POST['SHIPDATE1']) ? str_replace('-', '', $_POST['SHIPDATE1']): '',
                    'SHIPDATE2' => isset($_POST['SHIPDATE2']) ? str_replace('-', '', $_POST['SHIPDATE2']): '',
                    'DVW' => $RowParam,
                    'DATA' => $ShipParam);
    // print_r($param); exit();
    $commit = $cmtfunc->commit($param);
    if(is_array($commit)) { unsetSessionData(); }
    echo json_encode($commit);
}

function replacez() {
    $replace = array();
    $javafunc = new IssueSaleInvoiceByShip;
    $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
    $query = $javafunc->replace($SALETRANNO);
    if(!empty($query)) { $replace = array_shift($query); }
    echo json_encode($replace);
}

function IVprintCheck() {
    $javafunc = new IssueSaleInvoiceByShip;
    $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
    $REPRINTREASON = isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '';
    $printCheck = $javafunc->IVprintCheck($SALETRANNO, $REPRINTREASON);
    echo json_encode($printCheck);
}  

function invoice() {

    try {
        $printfunc = new IssueSaleInvoiceByShip;
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $printInv = $printfunc->printInv($SALETRANNO);        
        // print_r($printInv);
        // exit();
        if(!empty($printInv)) {
            $checkPrintFlg = $printfunc->checkPrintFlg($SALETRANNO);  
            // ----------------------------------------------------------------------------------------------------
            // sudo chmod -R 777 /var/www/html/DMCSMFG_WEBAPP_V2
            // --------------------------------------------------
            // Generate EXCEL Report File
            $outputPath = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'];
            // --------------------------------------------------
            // delete all file
            $files = glob($outputPath.'/*'); // get all file names
            foreach($files as $file) { // iterate files
                if(is_file($file)) {
                    unlink($file); // delete file
                }
            }
            // Save the Path
            if (!file_exists($outputPath)) {
                $old = umask(0);
                $mk = mkdir($outputPath, 0755, true);
                umask($old);
                if (!$mk) {
                    // echo 'directory created';
                    chmod($outputPath, 0755);
                }
            }
            // --------------------------------------------------
            // Excel Sheet Index 0 for Report Layout
            // Excel Sheet Index 1 for keep Report Data
            // --------------------------------------------------
            $sheetRpt = 0; // Layout
            $sheetData = 1; // Data
            // --------------------------------------------------
            $response = array();
            $LISTFLG = 'INVOICE';
            $itempage = 5; // per page
            foreach ($printInv as $key => $value) {
                $LISTFLG = $value['LISTFLG'];
                $page = ceil($key/$itempage);
                $printInv[$key]['PAGE'] = $page;
            }
            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/'.$LISTFLG.'.xlsx';

            for ($x = 1; $x <= $page; $x++) {
                $sheetExcel[$x] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$x]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$x]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------

                // Write Report Data to Sheet [DATA]
                $row = 1; // row excel new 1 start row 2 when header line 1
                foreach ($printInv as $key => $value) {
                    $col = 0;
                    if($value['PAGE'] == $x) { // separate page
                        if ($row > $itempage) { $row = 1; }  
                        foreach ($value as $filed => $item) {
                            if($filed != 'PAGE') {
                                $sheetExcel[$x]->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $item);
                                $col++;          
                            }
                        }
                        $row++;
                    }
                }
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $SALETRANNO.'_'.$LISTFLG.'_'.$x.'_'.date('Ymd_Hi').'.xlsx';
                $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
                $report_path = $outputPath.'/'.$report_file;
                $writer->save($report_path);
                // print_r($download_path);
                // Response Excel Report File URL
                // array_push($response, array('url' => $download_path,
                //                             'filename' => $report_file));
                // echo json_encode($response);
                // exit();
                // --------------------------------------------------
                // ----------------------------------------------------------------------------------------------------
                // --------------------------------------------------
                // Generate PDF Report File
                // --------------------------------------------------
                // --------------------------------------------------
                $pdf_name = $SALETRANNO.'_'.$LISTFLG.'_'.$x.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
                // $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
                // $sheetExcel[$x]->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$x]->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$x]->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
            
                // --------------------------------------------------
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.1);
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'PDF');
                $pdf_writer->save($pdf_path);
                // --------------------------------------------------
                // --------------------------------------------------
                // Response PDF Report File URL
                array_push($response, array('url' => $pdf_download_path,
                                            'filename' => $pdf_name));
                // --------------------------------------------------
            }
            // --------------------------------------------------       
            array_push($response, array('printFlg' => $checkPrintFlg));

            echo json_encode($response);
            // --------------------------------------------------
        }
        // ----------------------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function taxInvoice() {

    try {
        $printfunc = new IssueSaleInvoiceByShip;
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $REPRINTREASON = isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '';
        $printTaxInv = $printfunc->printTaxInv($SALETRANNO, $REPRINTREASON);
        // print_r($printTaxInv);
        // exit();
        if(!empty($printTaxInv) && is_array($printTaxInv)) {
            $checkPrintFlg = $printfunc->checkPrintFlg($SALETRANNO);  
            // ----------------------------------------------------------------------------------------------------
            // sudo chmod -R 777 /var/www/html/DMCSMFG_WEBAPP_V2
            // --------------------------------------------------
            // Generate EXCEL Report File
            $outputPath = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'];
            // --------------------------------------------------
            // delete all file
            $files = glob($outputPath.'/*'); // get all file names
            foreach($files as $file) { // iterate files
                if(is_file($file)) {
                    unlink($file); // delete file
                }
            }
            // Save the Path
            if (!file_exists($outputPath)) {
                $old = umask(0);
                $mk = mkdir($outputPath, 0755, true);
                umask($old);
                if (!$mk) {
                    // echo 'directory created';
                    chmod($outputPath, 0755);
                }
            }
            // --------------------------------------------------
            // Excel Sheet Index 0 for Report Layout
            // Excel Sheet Index 1 for keep Report Data
            // --------------------------------------------------
            $sheetRpt = 0; // Layout
            $sheetData = 1; // Data
            // --------------------------------------------------
            $response = array();
            $LISTFLG = 'TAXINVOICE';
            $itempage = 5; // per page
            foreach ($printTaxInv as $key => $value) {
                $LISTFLG = $value['LISTFLG'];
                $page = ceil($key/$itempage);
                $printTaxInv[$key]['PAGE'] = $page;
            }
            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/'.$LISTFLG.'.xlsx';

            for ($x = 1; $x <= $page; $x++) {
                $sheetExcel[$x] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$x]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$x]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------

                // Write Report Data to Sheet [DATA]
                $row = 1; // row excel new 1 start row 2 when header line 1
                foreach ($printTaxInv as $key => $value) {
                    $col = 0;
                    if($value['PAGE'] == $x) { // separate page
                        if ($row > $itempage) { $row = 1; }  
                        foreach ($value as $filed => $item) {
                            if($filed != 'PAGE') {
                                $sheetExcel[$x]->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $item);
                                $col++;          
                            }
                        }
                        $row++;
                    }
                }
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $SALETRANNO.'_'.$LISTFLG.'_'.$x.'_'.date('Ymd_Hi').'.xlsx';
                $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
                $report_path = $outputPath.'/'.$report_file;
                $writer->save($report_path);
                // print_r($download_path);
                // Response Excel Report File URL
                // array_push($response, array('url' => $download_path,
                //                             'filename' => $report_file));
                // echo json_encode($response);
                // exit();
                // --------------------------------------------------
                // ----------------------------------------------------------------------------------------------------
                // --------------------------------------------------
                // Generate PDF Report File
                // --------------------------------------------------
                // --------------------------------------------------
                $pdf_name = $SALETRANNO.'_'.$LISTFLG.'_'.$x.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
                // $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
                // $sheetExcel[$x]->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$x]->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$x]->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
            
                // --------------------------------------------------
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.1);
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'PDF');
                $pdf_writer->save($pdf_path);
                // --------------------------------------------------
                // --------------------------------------------------
                // Response PDF Report File URL
                array_push($response, array('url' => $pdf_download_path,
                                            'filename' => $pdf_name));
                // --------------------------------------------------
            }
            // --------------------------------------------------
            array_push($response, array('printFlg' => $checkPrintFlg));       

            echo json_encode($response);
            // --------------------------------------------------
        } else {
            echo json_encode($printTaxInv);
        }
        // ----------------------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function saleVoucher() {

    try {
        $printfunc = new IssueSaleInvoiceByShip;
        $SVNO = isset($_POST['SVNO']) ? $_POST['SVNO']: '';
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $printVoucher = $printfunc->printVoucher($SALETRANNO, $SVNO);
        // print_r($printVoucher);
        // exit();
        if(!empty($printVoucher)) {
            // ----------------------------------------------------------------------------------------------------
            // sudo chmod -R 777 /var/www/html/DMCSMFG_WEBAPP_V2
            // --------------------------------------------------
            // Generate EXCEL Report File
            $outputPath = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'];
            // --------------------------------------------------
            // delete all file
            $files = glob($outputPath.'/*'); // get all file names
            foreach($files as $file) { // iterate files
                if(is_file($file)) {
                    unlink($file); // delete file
                }
            }
            // Save the Path
            if (!file_exists($outputPath)) {
                $old = umask(0);
                $mk = mkdir($outputPath, 0755, true);
                umask($old);
                if (!$mk) {
                    // echo 'directory created';
                    chmod($outputPath, 0755);
                }
                // chown($outputPath, 'root');
            }
            // --------------------------------------------------
            // Excel Sheet Index 0 for Report Layout
            // Excel Sheet Index 1 for keep Report Data
            // --------------------------------------------------
            $sheetRpt = 0; // Layout
            $sheetData = 1; // Data
            // --------------------------------------------------
            // --------------------------------------------------
            $response = array();
            $LISTFLG = 'SALE_VOUCHER';
            $itempage = 25; // per page
            foreach ($printVoucher as $key => $value) {
                $LISTFLG = $value['LISTFLG'];
                $page = ceil($key/$itempage);
                $printVoucher[$key]['PAGE'] = $page;
            }

            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/'.$LISTFLG.'.xlsx';

            for ($x = 1; $x <= $page; $x++) {
              
                $sheetExcel[$x] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$x]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$x]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------
                // Write Report Data to Sheet [DATA]
                $row = 1; // row excel new 1 start row 2 when header line 1
                foreach ($printVoucher as $key => $value) {
                    $col = 0;
                    if($value['PAGE'] == $x) { // separate page
                        if ($row > $itempage) { $row = 1; }  
                        foreach ($value as $filed => $item) {
                            if($filed != 'PAGE') {
                                $sheetExcel[$x]->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $item);
                                $col++;          
                            }
                        }
                        $row++;
                    }
                }
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $SVNO.'_'.$LISTFLG.'_'.date('Ymd_Hi').'.xlsx';
                $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
                $report_path = $outputPath.'/'.$report_file;
                $writer->save($report_path);
                // print_r($download_path);
                // Response Excel Report File URL
                // array_push($response, array('url' => $download_path,
                //                             'filename' => $report_file));
                // echo json_encode($response);
                // exit();
                // --------------------------------------------------
                // ----------------------------------------------------------------------------------------------------
                // --------------------------------------------------
                // Generate PDF Report File
                // --------------------------------------------------
                // --------------------------------------------------
                $pdf_name = $SVNO.'_'.$LISTFLG.'_'.$x.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
                $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetPDF[$x]->getActiveSheet()->setShowGridLines(false);

                $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setTop(0.5);
                $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF[$x], 'PDF');
                $pdf_writer->save($pdf_path);
                // --------------------------------------------------
                // --------------------------------------------------
                // Response PDF Report File URL
                array_push($response, array('url' => $pdf_download_path,
                                            'filename' => $pdf_name));
                // --------------------------------------------------
            }
            // --------------------------------------------------       
            echo json_encode($response);
            // --------------------------------------------------
        }
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function getAmt() {
    global $data;
    $amtfunc = new IssueSaleInvoiceByShip;
    $data = getSessionData();
    $Param = array( 'ESTLNQTY' => $_POST['ESTLNQTY'],
                    'ESTLNUNITPRC' =>  $_POST['ESTLNUNITPRC'],
                    'ESTDISCOUNT' =>  $_POST['ESTDISCOUNT'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'DISCRATE' => $_POST['DISCRATE'],
                    'VATRATE' => $_POST['VATRATE'],
                    'CUSTOMERCD' => $_POST['CUSTOMERCD']);
    $amt = $amtfunc->getAmt($Param);
    // print_r($amt);
    // print_r($amt['SALEAMT']);
    // print_r($amt['SALEDISCOUNT2']);
    // print_r($amt['SALETAXAMT']);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $data['ITEM'][$i+1] = array('ITEMCD' => isset( $_POST['ITEMCD'][$i]) ?  $_POST['ITEMCD'][$i]: '',
                                    'ITEMNAME' => isset($_POST['ITEMNAME'][$i]) ? $_POST['ITEMNAME'][$i]: '',
                                    'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? $_POST['SALEQTY'][$i]: '',
                                    'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP'][$i]) ? $_POST['ITEMUNITTYP'][$i]: '',
                                    'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? $_POST['SALEUNITPRC'][$i]: '',
                                    'SALEDISCOUNT' => isset($_POST['SALEDISCOUNT'][$i]) ? $_POST['SALEDISCOUNT'][$i]: '',
                                    'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? $_POST['SALEAMT'][$i]: '',
                                    'ITEMSPEC' => isset($_POST['ITEMSPEC'][$i]) ? $_POST['ITEMSPEC'][$i]: '',
                                    'SALEDISCOUNT2' => isset($_POST['SALEDISCOUNT2'][$i]) ? $_POST['SALEDISCOUNT2'][$i]: '',
                                    'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? $_POST['SALETAXAMT'][$i]: '');
    }
    setSessionArray($data);
}

function setItemShipValue() {
    global $data;
    for ($i = 0 ; $i < count($_POST['SHIPTRANORDERNO']); $i++) { 
        $data['ITEMSHIP'][$i+1] = array('CHK' => isset( $_POST['CHK'][$i]) ?  $_POST['CHK'][$i]: 'F',
                                    'SHIPTRANORDERNO' => isset($_POST['SHIPTRANORDERNO'][$i]) ? $_POST['SHIPTRANORDERNO'][$i]: '',
                                    'SHIPTRANORDERLN' => isset($_POST['SHIPTRANORDERLN'][$i]) ? $_POST['SHIPTRANORDERLN'][$i]: '',
                                    'SHIPTRANDT' => isset($_POST['SHIPTRANDT'][$i]) ? $_POST['SHIPTRANDT'][$i]: '',
                                    'SHIPTRANIMCD' => isset($_POST['SHIPTRANIMCD'][$i]) ? $_POST['SHIPTRANIMCD'][$i]: '',
                                    'SHIPTRANIMNAME' => isset($_POST['SHIPTRANIMNAME'][$i]) ? $_POST['SHIPTRANIMNAME'][$i]: '',
                                    'SHIPTRANSHIPQTY' => isset($_POST['SHIPTRANSHIPQTY'][$i]) ? $_POST['SHIPTRANSHIPQTY'][$i]: '',
                                    'SHIPTRANSALENO' => isset($_POST['SHIPTRANSALENO'][$i]) ? $_POST['SHIPTRANSALENO'][$i]: '',
                                    'SHIPTRANSALELN' => isset($_POST['SHIPTRANSALELN'][$i]) ? $_POST['SHIPTRANSALELN'][$i]: '');
    }
    setSessionArray($data);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SALETRANNO', 'SALEORDERNO', 'SHIPDATE1', 'SHIPDATE2', 'DIVISIONCD', 'DIVISIONNAME', 'SALEISSUEDT', 'CUSTOMERCD', 'BRANCHKBN', 'TAXID', 'CUSCURCD', 'CUSTOMERNAME', 'SALEORDERNO', 'DESCRIPTION',
                        'SALECUSMEMO', 'SALEDIVCON4', 'SALELNDUEDT', 'CUSTADDR1', 'CUSTADDR2', 'ESTCUSSTAFF', 'ESTCUSTEL', 'ESTCUSFAX', 'STAFFCD', 'STAFFNAME', 'SALETERM', 'SVNO', 'WHTTYP', 'ITEM', 'ITEMSHIP', 'CUSCURDISP', 'S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'REPRINTREASON', 'SYSVIS_LOADAPPREPLACE', 'SYSVIS_DUMMYPRT1', 'T_AMOUNT1', 'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'SYSMSG', 'SYSVIS_CANCELLBL', 'SUB', 'LDIS', 'AFDIS', 'TOT', 'TVAT', 'ROWCOUNTER', 'COMPNTH', 'COMPNEN', 'ADDR1', 'ADDR2', 'ADDREN1', 'ADDREN2', 'TELO', 'FAXO', 'ATNAME', 'PONUM', 'SHDATE', 'SLMAN', 'GROUPRT', 'DIVISIONNAME', 'CUSN', 'ADDR10', 'ADDR20', 'CTEL', 'CFAX', 'QONUM', 'TDATE', 'PAYTERM', 'PRVALID', 'QOBY', 'REM1', 'REM2', 'REM3', 'CUR', 'ITEMINV', 'CADDR1', 'CADDR2', 'SONUM', 'SYSPVL', 'TXTLANG', 'DRPLANG', 'SALEDIVCON1', 'SALEDIVCON2', 'SALEDIVCON3', 'DEPT', 'DES', 'CDEPT', 'ANUM', 'CTAXID', 'REF', 'SHV', 'SALETRANINSPDT', 'SALETRANADD31', 'SALETRANADD32', 'SALETRANADD33', 'SALETRANADD34', 'SALETRANADD35', 'SYSVIS_REPRINTREASON',  'SYSEN_COMMIT', 'SYSEN_SALEORDERNO' , 'SYSEN_CUSCURCD', 'SYSEN_STAFFCD', 'SYSEN_ESTCUSSTAFF', 'SYSEN_SALEDIVCON1', 'SYSEN_SALEDIVCON2', 'SYSEN_SALEDIVCON3', 'SYSEN_SALETERM', 'SYSEN_SALECUSMEMO', 'SYSEN_SALEDIVCON4', 'REPLACEMODE', 'CANCELSALETRANNO', 'SALEDIVCON2CBO', 'SYSEN_DVW', 'SYSEN_SALETRANPLANRECMONEYDT', 'SYSVIS_REPRINTLBL', 'SYSEN_DESCRIPTION', 'SYSEN_REPRINTREASON', 'SYSVIS_DUMMYPRT2', 'SYSEN_DIVISIONCD', 'SYSEN_CUSTOMERCD', 'ADDRTH', 'ADDREN', 'TELO', 'FAXO', 'TAXNO', 'LOADPRINT', 'TAXINV', 'SVSTATIC', 'SVDYNAMIC', 'CMCURCD', 'CMCURDISP', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'GROUPRT', 'SYSVIS_VATAMOUNT', 'SYSVIS_VATAMOUNT1', 'SYSMSG', 'SYSEN_SHIPDATE1', 'SYSEN_SHIPDATE2', 'SYSEN_SEARCH', 'SYSEN_DSSHIP', 'SYSEN_MAKEINVITEM', 'SYSEN_EDITSHIP', 'SYSEN_SALETRANINSPDT', 'SYSEN_DISCRATE', 'SYSEN_VATRATE', 'SYSVIS_PRINTINV', 'SYSEN_PRINTINV', 'SYSVIS_PRINTTAXINV', 'SYSEN_PRINTTAXINV', 'SYSVIS_PRINTVOU', 'SYSEN_PRINTVOU', 'SYSVIS_REPLACE', 'SYSEN_REPLACE', 'SYSVIS_SALEDIVCON2CBO', 'SYSVIS_SALEDIVCON2', 'SYSVIS_CANCELSALETRANNO');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
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

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function unsetSesstionItem($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function setloadEvent($loadevent) {
    global $data;
    $data['SYSMSG'] = $loadevent['SYSMSG'];
    $data['GROUPRT'] = $loadevent['GROUPRT'];
    $data['CMCURCD'] = $loadevent['CMCURCD'];
    $data['CMCURDISP'] = $loadevent['CMCURDISP'];
    $data['SYSVIS_COMMIT'] = $loadevent['SYSVIS_COMMIT'];
    $data['SYSVIS_CANCEL'] = $loadevent['SYSVIS_CANCEL'];
    $data['SYSVIS_VATAMOUNT'] = $loadevent['SYSVIS_VATAMOUNT'];
    $data['SYSVIS_VATAMOUNT1'] = $loadevent['SYSVIS_VATAMOUNT1'];
    setSessionArray($data);
}

function setlockShipping($lock) {
    global $data;
    $data['SYSEN_SEARCH'] = $lock['SYSEN_SEARCH'];
    $data['SYSEN_DSSHIP'] = $lock['SYSEN_DSSHIP'];
    $data['SYSEN_EDITSHIP'] = $lock['SYSEN_EDITSHIP'];
    $data['SYSEN_SHIPDATE1'] = $lock['SYSEN_SHIPDATE1'];
    $data['SYSEN_SHIPDATE2'] = $lock['SYSEN_SHIPDATE2'];
    $data['SYSEN_CUSTOMERCD'] = $lock['SYSEN_CUSTOMERCD'];
    $data['SYSEN_MAKEINVITEM'] = $lock['SYSEN_MAKEINVITEM'];

    setSessionArray($data);
}
?>