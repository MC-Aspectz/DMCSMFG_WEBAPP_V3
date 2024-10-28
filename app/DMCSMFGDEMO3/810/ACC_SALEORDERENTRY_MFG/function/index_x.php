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
$javaFunc = new SalesOrderEntryMFG;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 6;
$minsearchrow = 0;
$maxsearchrow = 16;

if(!empty($_GET)) {
    // 
}

if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'SERCUSTCD') { setSearchCustomer(); }
        if ($_POST['action'] == 'SERSTAFFCD') { getSearchStaff(); }
        if ($_POST['action'] == 'SEARCH') { searchSO(); }
        if ($_POST['action'] == 'ESTNO') { getEst(); }
        if ($_POST['action'] == 'SALEORDERNO') { getSO(); }
        if ($_POST['action'] == 'DIVISIONCD') { getDivision(); }
        if ($_POST['action'] == 'CUSTOMERCD') { getCustomer(); }
        if ($_POST['action'] == 'CUSCURCD') { getCurrency(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'DELIVERYCD') { getDelivery(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'getAmt') { getAmt(); }
        if ($_POST['action'] == 'COMMIT') { commit(); }
        if ($_POST['action'] == 'CANCEL') { cancel(); }
        if ($_POST['action'] == 'PRINT') { printed();}
    }
} else {
    $data['SEARCHITEM'] = array();
}
// ------------------------- CALL Langauge AND Privilege -------------------//
if(checkSessionData()) { $data = getSessionData(); }
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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$UNIT = $data['DRPLANG']['UNIT'];
$CURRENCY = $data['DRPLANG']['CURRENCY'];
$BRANCH_KBN = $data['DRPLANG']['BRANCH_KBN'];
setSessionData('UNIT', $UNIT);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function searchSO() {
    $data['SEARCHITEM'] = array();
    $javafunc = new SalesOrderEntryMFG;
    $data['SERSONO1'] = isset($_POST['SERSONO1']) ? $_POST['SERSONO1']: '';
    $data['SERSONO2'] = isset($_POST['SERSONO2']) ? $_POST['SERSONO2']: '';
    $data['SERINPDATE1'] = isset($_POST['SERINPDATE1']) ? $_POST['SERINPDATE1']: '';
    $data['SERINPDATE2'] = isset($_POST['SERINPDATE2']) ? $_POST['SERINPDATE2']: '';
    $data['SERCUSTCD'] = isset($_POST['SERCUSTCD']) ? $_POST['SERCUSTCD']: '';
    $data['SERSTAFFCD'] = isset($_POST['SERSTAFFCD']) ? $_POST['SERSTAFFCD']: '';
    $search = $javafunc->searchSO($data['SERSONO1'], $data['SERSONO2'], $data['SERINPDATE1'],  $data['SERINPDATE2'],  $data['SERCUSTCD'], $data['SERSTAFFCD']);
    if(!empty($search)) {
        $data['SEARCHITEM'] = $search; 
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data['SEARCHITEM']);
    // echo '</pre>';
}

function getSO() {
    $response = array();
    $UNIT = getSessionData('UNIT');
    $javafunc = new SalesOrderEntryMFG;
    $SALEORDERNO = isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '';
    $query = $javafunc->getSO($SALEORDERNO);
    if(!empty($query)) {
        $response = array_shift($query);
        $itemlist = $javafunc->getSOLn($SALEORDERNO);
        // print_r($itemlist);
        if(!empty($itemlist)) {
            $DisCTRL = $javafunc->DisCTRL();
            $response['ITEM'] = $itemlist;
            $response['UNIT'] = $UNIT;
        }
    }
    echo json_encode($response);
}

function getEst() {
    $response = array();
    $UNIT = getSessionData('UNIT');
    $javafunc = new SalesOrderEntryMFG;
    $ESTNO = isset($_POST['ESTNO']) ? $_POST['ESTNO']: '';
    $query = $javafunc->getEst($ESTNO);

    if(!empty($query)) { 
        $response = $query;
        $itemlist = $javafunc->getEstLn($query['ESTNO'], $query['SALEORDERNO']);
        if(!empty($itemlist)) {
            $response['ITEM'] = $itemlist;
            $response['UNIT'] = $UNIT;
        }
    }
    echo json_encode($response);
}  

function setSearchCustomer() {
    $javafunc = new SalesOrderEntryMFG;
    $SERCUSTCD = isset($_POST['SERCUSTCD']) ? $_POST['SERCUSTCD']: '';
    $query = $javafunc->setSearchCustomer($SERCUSTCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getSearchStaff() {
    $javafunc = new SalesOrderEntryMFG;
    $SERSTAFFCD = isset($_POST['SERSTAFFCD']) ? $_POST['SERSTAFFCD']: '';
    $query = $javafunc->getSearchStaff($SERSTAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}     

function getDivision() {
    $javafunc = new SalesOrderEntryMFG;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDivision($DIVISIONCD);
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new SalesOrderEntryMFG;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    if(!empty($query)) { $data = $query; }
    $data['QUOTEAMOUNT'] = '0.00';
    $data['VATAMOUNT'] = '0.00';
    $data['VATAMOUNT1'] = '0.00';
    $data['T_AMOUNT'] = '0.00';
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new SalesOrderEntryMFG;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new SalesOrderEntryMFG;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    echo json_encode($query);
}  

function getDelivery() {
    $javafunc = new SalesOrderEntryMFG;
    $DELIVERYCD = isset($_POST['DELIVERYCD']) ? $_POST['DELIVERYCD']: '';
    $query = $javafunc->getDel($DELIVERYCD);
    if(!empty($query)) { $data = $query; }
    $data['DELIVERYCD'] = $query['DELIVERYCD'];
    $data['DELIVERYNAME'] = $query['DELIVERYNAME'];
    $data['SALEDLVSTAFF'] = $query['SALEDLVSTAFF'];
    $data['SALEDLVTEL'] = $query['SALEDLVTEL'];
    $data['SALEPOSTCODE'] = $query['SALEPOSTCODE'];
    $data['SALEDLVADDR1'] = $query['SALEDLVADDR1'];
    $data['SALEDLVADDR2'] = $query['SALEDLVADDR2'];
    $data['TRANSPORTER'] = $query['TRANSPORTER'];
    if(!empty($query)) { setSessionArray($data); }
    echo json_encode($query);
}

function getItem() {

    $response = array();
    $javafunc = new SalesOrderEntryMFG;
    $Param = array( 'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'SALELNQTY' => isset($_POST['SALELNQTY']) ? $_POST['SALELNQTY']: '',
                    'UNITPRICE' => isset($_POST['UNITPRICE']) ? $_POST['UNITPRICE']: '',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '',
                    'VATRATE' => isset($_POST['VATRATE']) ?  $_POST['VATRATE']: '');
    $query = $javafunc->getItem($Param);
    if(!empty($query)) {
        $response = array(  'ITEMCD' => $query['ITEMCD'],
                            'ITEMNAME' => $query['ITEMNAME'],
                            'SALELNQTY' => isset($query['SALELNQTY']) ? $query['SALELNQTY']: '0.00',
                            'ITEMUNITTYP' => $query['ITEMUNITTYP'],
                            'SALELNUNITPRC' => isset($query['SALELNUNITPRC']) ? $query['SALELNUNITPRC']: '0.00',
                            'SALELNDISCOUNT' => isset($query['SALELNDISCOUNT']) ? $query['SALELNDISCOUNT']: '0.00',
                            'SALELNAMT' => isset($query['SALELNAMT']) ? $query['SALELNAMT']: '0.00',
                            'SALELNDISCOUNT2' => $query['SALELNDISCOUNT2'],
                            'SALELNTAXAMT' => isset($query['SALELNTAXAMT']) ? $query['SALELNTAXAMT']: '0.00');
    }

    echo json_encode($response);
}

function commit() {
    $RowParam = array();
    $cmtfunc = new SalesOrderEntryMFG;
    for ($i = 0 ; $i < count($_POST['ITEMCDZ']); $i++) { 
        if($_POST['ITEMCDZ'][$i] != '' && isset($_POST['ITEMCDZ'][$i])) {
            $RowParam[] = array('ROWNO' => $i+1,
                                'ITEMCD' => $_POST['ITEMCDZ'][$i],
                                'ITEMNAME' => $_POST['ITEMNAMEZ'][$i],
                                'SALELNQTY' => isset($_POST['SALELNQTYZ'][$i]) ? implode(explode(',', $_POST['SALELNQTYZ'][$i])): '0.00',
                                'ITEMUNITTYP' => $_POST['ITEMUNITTYPZ'][$i],
                                'SALELNUNITPRC' => isset($_POST['SALELNUNITPRCZ'][$i]) ? implode(explode(',', $_POST['SALELNUNITPRCZ'][$i])): '0.00',
                                'SALELNDISCOUNT' => isset($_POST['SALELNDISCOUNTZ'][$i]) ? implode(explode(',', $_POST['SALELNDISCOUNTZ'][$i])): '0.00',
                                'SALELNAMT' => isset($_POST['SALELNAMTZ'][$i]) ? implode(explode(',', $_POST['SALELNAMTZ'][$i])): '0.00',
                                'SALELNDISCOUNT2' => isset($_POST['SALELNDISCOUNT2Z'][$i]) ? $_POST['SALELNDISCOUNT2Z'][$i]: '',
                                'SALELNTAXAMT' => isset($_POST['SALELNTAXAMT'][$i]) ? implode(explode(',', $_POST['SALELNTAXAMT'][$i])): '0.00',
                                'SALELNDUEDT' => !empty($_POST['SALELNDUEDTZ'][$i]) ? str_replace('-', '', $_POST['SALELNDUEDTZ'][$i]): '',
                                'SALELNPLANSHIPDT' => !empty($_POST['SALELNPLANSHIPDTZ'][$i]) ? str_replace('-', '', $_POST['SALELNPLANSHIPDTZ'][$i]): '',
                                'SALELNREM' => isset($_POST['SALELNREMZ'][$i]) ? $_POST['SALELNREMZ'][$i]: '');         
        }
    }
    // print_r($RowParam);
    $param = array( 'SALEORDERNO' => isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '',
                    'ESTNO' =>isset($_POST['ESTNO']) ? $_POST['ESTNO']: '',
                    'SALEISSUEDT' => str_replace('-', '', $_POST['SALEISSUEDT']),
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'ESTCUSTEL' => isset($_POST['ESTCUSTEL']) ? $_POST['ESTCUSTEL']: '',
                    'ESTCUSFAX' => isset($_POST['ESTCUSFAX']) ? $_POST['ESTCUSFAX']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'ESTCUSSTAFF' => isset($_POST['ESTCUSSTAFF']) ? $_POST['ESTCUSSTAFF']: '',
                    'DELIVERYCD' => isset($_POST['DELIVERYCD']) ? $_POST['DELIVERYCD']: '',
                    'DELIVERYNAME' => isset($_POST['DELIVERYNAME']) ? $_POST['DELIVERYNAME']: '',
                    'SALEDLVADDR1' => isset($_POST['SALEDLVADDR1']) ? $_POST['SALEDLVADDR1']: '',
                    'SALEDLVADDR2' => isset($_POST['SALEDLVADDR2']) ? $_POST['SALEDLVADDR2']: '',
                    'SALEPOSTCODE' => isset($_POST['SALEPOSTCODE']) ? $_POST['SALEPOSTCODE']: '',
                    'SALEDLVSTAFF' => isset($_POST['SALEDLVSTAFF']) ? $_POST['SALEDLVSTAFF']: '',
                    'SALEDLVTEL' => isset($_POST['SALEDLVTEL']) ? $_POST['SALEDLVTEL']: '',            
                    'ESTREM1' => isset($_POST['ESTREM1']) ? $_POST['ESTREM1']: '',
                    'ESTREM2' => isset($_POST['ESTREM2']) ? $_POST['ESTREM2']: '',
                    'ESTREM3' => isset($_POST['ESTREM3']) ? $_POST['ESTREM3']: '',
                    'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'BRANCHKBN' => isset($_POST['BRANCHKBN']) ? $_POST['BRANCHKBN']: '',
                    'SALECUSMEMO' => isset($_POST['SALECUSMEMO']) ? $_POST['SALECUSMEMO']: '',
                    'SALEDIVCON1' => isset($_POST['SALEDIVCON1']) ? $_POST['SALEDIVCON1']: '',
                    'SALEDIVCON2' => isset($_POST['SALEDIVCON2']) ? $_POST['SALEDIVCON2']: '',
                    'SALEDIVCON3' => isset($_POST['SALEDIVCON3']) ? $_POST['SALEDIVCON3']: '',
                    'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                    'SALELNDUEDT' => !empty($_POST['SALELNDUEDTZ'][0]) ? str_replace('-', '', $_POST['SALELNDUEDTZ'][0]): '',
                    'S_TTL' => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0',
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? str_replace(',', '', $_POST['DISCOUNTAMOUNT']): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? str_replace(',', '', $_POST['QUOTEAMOUNT']): '0.00',
                    'VATRATE' => isset($_POST['VATRATE']) ? $_POST['VATRATE']: '0.00',
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? str_replace(',', '', $_POST['VATAMOUNT']): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? str_replace(',', '', $_POST['VATAMOUNT1']): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? str_replace(',', '', $_POST['T_AMOUNT']): '0.00',
                    'DATA' => $RowParam);
    // print_r($param);
    // exit();
    $commit = $cmtfunc->commit($param);
    echo json_encode($commit);
}

function printed() {
    $printfunc = new SalesOrderEntryMFG;
    if(!empty($_POST['SALEORDERNO'])) {
        $SALEORDERNO = isset($_POST['SALEORDERNO']) ? $_POST['SALEORDERNO']: '';
        $param = array( 'SALEORDERNO' => $SALEORDERNO,
                        'SALEISSUEDT' => isset($_POST['SALEISSUEDT']) ? str_replace('-', '', $_POST['SALEISSUEDT']): '',
                        'SALELNDUEDT' => isset($_POST['SALELNDUEDT']) ? str_replace('-', '', $_POST['SALELNDUEDT']): '',
                        'STAFFNAME' => isset($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: '',
                        'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                        'SALECUSMEMO' => isset($_POST['SALECUSMEMO']) ? $_POST['SALECUSMEMO']: '',
                        'ESTCUSSTAFF' => isset($_POST['ESTCUSSTAFF']) ? $_POST['ESTCUSSTAFF']: '',
                        'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                        'SALEDIVCON1' => isset($_POST['SALEDIVCON1']) ? $_POST['SALEDIVCON1']: '',
                        'SALEDIVCON2' => isset($_POST['SALEDIVCON2']) ? $_POST['SALEDIVCON2']: '',
                        'SALEDIVCON3' => isset($_POST['SALEDIVCON3']) ? $_POST['SALEDIVCON3']: '',
                        'ESTCUSTEL' => isset($_POST['ESTCUSTEL']) ? $_POST['ESTCUSTEL']: '',
                        'ESTCUSFAX' => isset($_POST['ESTCUSFAX']) ? $_POST['ESTCUSFAX']: '',
                        'CUSCURDISP' => isset($_POST['CUSCURDISP']) ? $_POST['CUSCURDISP']: '');
        // print_r($param);
        $printStatic = $printfunc->printStatic($param);
        $printDynamic = $printfunc->printDynamic($SALEORDERNO);
        // print_r($printStatic);
        // print_r($printDynamic); 
        if(is_array($printStatic) && is_array($printDynamic)) {
            printPDF($printStatic, $printDynamic, $SALEORDERNO);
        }
    }
}

function printPDF($printStatic, $printDynamic, $SALEORDERNO) {

    try {
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
        // Load an existing spreadsheet
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEORDERENTRY_MFG.xlsx';
        // print_r($printStatic);
        // print_r($printDynamic);
        $sheetExcel = PHPExcel_IOFactory::load($file_path);
        // --------------------------------------------------
        // Set Active Sheet
        $sheetExcel->setActiveSheetIndex($sheetData);
        // --------------------------------------------------
        // Set Sheet Name [DATA]
        $sheetExcel->getActiveSheet()->setTitle('DATA');
        // --------------------------------------------------
        // Write Report Data to Sheet [DATA]
        $VATAMOUNT = str_replace(',', '', $printStatic['T_AMOUNT']) - str_replace(',', '', $printStatic['QUOTEAMOUNT']);
        $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPCD'])
                                    ->setCellValue('B1', $printStatic['COMPNMEN'])
                                    ->setCellValue('C1', $printStatic['COMPNMTH'])
                                    ->setCellValue('D1', $printStatic['COMPADDR1'])
                                    ->setCellValue('E1', $printStatic['COMPADDR2'])
                                    ->setCellValue('F1', $printStatic['COMPTEL'])
                                    ->setCellValue('G1', $printStatic['COMPFAX'])
                                    ->setCellValue('H1', $printStatic['COMPTAXID'])
                                    ->setCellValue('I1', $printStatic['COMPBRANCH'])
                                    ->setCellValue('J1', $printStatic['SALEORDERNO'])
                                    ->setCellValue('K1', $printStatic['QUOTENO'])
                                    ->setCellValue('L1', $printStatic['ISSUEDATE'])
                                    ->setCellValue('M1', $printStatic['DIVCD'])
                                    ->setCellValue('N1', $printStatic['DIVNAME'])
                                    ->setCellValue('O1', $printStatic['STAFFCD'])
                                    ->setCellValue('P1', $printStatic['STAFFNAME'])
                                    ->setCellValue('Q1', $printStatic['CUSCD'])
                                    ->setCellValue('R1', $printStatic['CUSNAME'])
                                    ->setCellValue('S1', $printStatic['CUSSHNAME'])
                                    ->setCellValue('T1', $printStatic['CUSTAXID'])
                                    ->setCellValue('U1', $printStatic['CUSBRANCH'])
                                    ->setCellValue('V1', $printStatic['CUSADDR1'])
                                    ->setCellValue('W1', $printStatic['CUSADDR2'])
                                    ->setCellValue('X1', $printStatic['CUSADDR3'])
                                    ->setCellValue('Y1', $printStatic['CUSTEL'])
                                    ->setCellValue('Z1', $printStatic['CUSFAX'])
                                    ->setCellValue('AA1', $printStatic['CUSSTAFF'])
                                    ->setCellValue('AB1', $printStatic['CUSMEMO'])
                                    ->setCellValue('AC1', $printStatic['SALEDLVCD'])
                                    ->setCellValue('AD1', $printStatic['SALEDLVNAME'])
                                    ->setCellValue('AE1', $printStatic['SALEDLVADDR1'])
                                    ->setCellValue('AF1', $printStatic['SALEDLVADDR2'])
                                    ->setCellValue('AG1', $printStatic['SALEPOSTCODE'])
                                    ->setCellValue('AH1', $printStatic['SALEDLVTEL'])
                                    ->setCellValue('AI1', $printStatic['SALEDLVSTAFF'])
                                    ->setCellValue('AJ1', $printStatic['SALEDLVCON1'])
                                    ->setCellValue('AK1', $printStatic['SALEDLVCON2'])
                                    ->setCellValue('AL1', $printStatic['SALEDLVCON3'])
                                    ->setCellValue('AM1', $printStatic['SALEDLVCON4'])
                                    ->setCellValue('AN1', isset($_POST['S_TTL']) ? $_POST['S_TTL']: '0.00')
                                    ->setCellValue('AO1', isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0.00')
                                    ->setCellValue('AP1', $printStatic['DISCOUNTAMOUNT'])
                                    ->setCellValue('AQ1', isset($_POST['QUOTEAMOUNT']) ? $_POST['QUOTEAMOUNT']: '0.00')
                                    ->setCellValue('AR1', isset($_POST['VATRATE']) ? $_POST['VATRATE']: '0.00')
                                    ->setCellValue('AS1', isset($_POST['VATAMOUNT1']) ? $_POST['VATAMOUNT1']: '0.00')
                                    ->setCellValue('AT1', isset($_POST['T_AMOUNT']) ? $_POST['T_AMOUNT']: '0.00');
                                    // ->setCellValue('AN1', $printStatic['S_TTL'])
                                    // ->setCellValue('AO1', $printStatic['DISCRATE'])
                                    // ->setCellValue('AP1', $printStatic['DISCOUNTAMOUNT'])
                                    // ->setCellValue('AQ1', $printStatic['QUOTEAMOUNT'])
                                    // ->setCellValue('AR1', $printStatic['VATRATE'])
                                    // ->setCellValue('AS1', $VATAMOUNT)
                                    // ->setCellValue('AT1', $printStatic['T_AMOUNT']);
        //------------- Item List ----------- //                            
        foreach ($printDynamic as $key => $value) {
                                         
        $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['ROWNO'])
                                    ->setCellValue('B'.$key+1, $value['ITEMCD'])
                                    ->setCellValue('C'.$key+1, $value['ITEMNAME'])
                                    ->setCellValue('D'.$key+1, $value['ITEMSPEC'])
                                    ->setCellValue('E'.$key+1, isset($value['ITEMQTY']) ? number_format(str_replace(',', '', $value['ITEMQTY']), 2): '0.00')
                                    ->setCellValue('F'.$key+1, $value['ITEMUNITCD'])
                                    ->setCellValue('G'.$key+1, $value['ITEMUNITNAME'])
                                    ->setCellValue('H'.$key+1, $value['CURCD'])
                                    ->setCellValue('I'.$key+1, $value['CURDISP'])
                                    ->setCellValue('J'.$key+1, isset($value['UNITPRICE']) ? number_format(str_replace(',', '', $value['UNITPRICE']), 2): '0.00')
                                    ->setCellValue('K'.$key+1, $value['EXUNITPRICE'])
                                    ->setCellValue('L'.$key+1, $value['DISCOUNT'])
                                    ->setCellValue('M'.$key+1, $value['DISCOUNT2'])
                                    ->setCellValue('N'.$key+1, isset($value['AMOUNT']) ? number_format(str_replace(',', '', $value['AMOUNT']), 2): '0.00')
                                    ->setCellValue('O'.$key+1, $value['EXAMOUNT'])
                                    ->setCellValue('P'.$key+1, $value['TAXRATE'])
                                    ->setCellValue('Q'.$key+1, $value['TAXAMT'])
                                    ->setCellValue('R'.$key+1, $value['EXTAXAMT'])
                                    ->setCellValue('S'.$key+1, $value['CUSPONO'])
                                    ->setCellValue('T'.$key+1, !empty($value['DUEDATE']) ? date('Y-m-d', strtotime($value['DUEDATE'])) : '')
                                    ->setCellValue('U'.$key+1, !empty($value['PLANSHIPDATE']) ? date('Y-m-d', strtotime($value['PLANSHIPDATE'])) : '')
                                    ->setCellValue('V'.$key+1, $value['SALELNREM']);
        }
        // $sheetExcel->getActiveSheet()->getStyle('E2:R10')->getNumberFormat()->setFormatCode('#,##.00');
        // --------------------------------------------------
        // Set Active Sheet to [REPORT]
        $sheetExcel->setActiveSheetIndex($sheetRpt);
        // --------------------------------------------------
        $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
        // Save Excel Report File on Server
        $report_file = $SALEORDERNO.'_'.date('Ymd_Hi').'.xlsx';
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
        $pdf_name = $SALEORDERNO.'_'.date('Ymd_Hi').'.pdf';
        $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
        $pdf_path = $outputPath.'/'.$pdf_name;
        $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
        $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
        if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
            die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
        }

        // $sheetPDF = PHPExcel_IOFactory::load($report_path);
        // $sheetPDF->setActiveSheetIndex($sheetRpt);
        // $sheetPDF->setReadDataOnly(true);
        $sheetExcel->getActiveSheet()->getStyle('K21:N32')->getNumberFormat()->setFormatCode('#,##.00');
        $sheetExcel->getActiveSheet()->getStyle('O33:Q37')->getNumberFormat()->setFormatCode('#,##.00');
        // --------------------------------------------------
        $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        // $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
        $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
        $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
        $sheetExcel->getActiveSheet()->setShowGridLines(false);

        $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
        $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.8);
        $sheetExcel->getActiveSheet()->getPageMargins()->setRight(0.5);           
        $sheetExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);

        $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'PDF');
        $pdf_writer->save($pdf_path);
        // --------------------------------------------------
        // --------------------------------------------------
        // Response PDF Report File URL
        array_push($response, array('url' => $pdf_download_path,
                                    'filename' => $pdf_name));
        // --------------------------------------------------
        // --------------------------------------------------       
        echo json_encode($response);
        // --------------------------------------------------
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------
    } 
    catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function cancel() {
    $cancelfunc = new SalesOrderEntryMFG;
    $cancel = $cancelfunc->cancel($_POST['SALEORDERNO']);
    echo json_encode($cancel);
}

function getAmt() {
    global $data;
    $amtfunc = new SalesOrderEntryMFG;
    $data = getSessionData();
    $Param = array( 'SALELNQTY' => 2,
                    'SALELNUNITPRC' =>  2000,
                    'SALELNDISCOUNT' =>  0,
                    'CUSCURCD' => $data['CUSCURCD'],
                    'DISCRATE' => $data['DISCRATE'],
                    'VATRATE' => $data['VATRATE'],
                    'CUSTOMERCD' => $data['CUSTOMERCD']);
    $amt = $amtfunc->getAmt($Param);
    // print_r($amt['SALELNAMT']);
    // print_r($amt['SALELNDISCOUNT2']);
    // print_r($amt['SALELNTAXAMT']);
    echo json_encode($amt);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'SALELNQTY' => $_POST['SALELNQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SALELNUNITPRC' => $_POST['SALELNUNITPRC'][$i],
                                    'SALELNDISCOUNT' => $_POST['SALELNDISCOUNT'][$i],
                                    'SALELNAMT' => $_POST['SALELNAMT'][$i],
                                    'SALELNDISCOUNT2' => $_POST['SALELNDISCOUNT2'][$i],
                                    'SALELNTAXAMT' => $_POST['SALELNTAXAMT'][$i],
                                    'SALELNDUEDT' => !empty($_POST['SALELNDUEDT'][$i]) ? $_POST['SALELNDUEDT'][$i]: '',
                                    'SALELNPLANSHIPDT' => !empty($_POST['SALELNPLANSHIPDT'][$i]) ? $_POST['SALELNPLANSHIPDT'][$i]: '',
                                    'SALELNREM' => $_POST['SALELNREM'][$i] );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'SERSONO1', 'SERSONO2', 'SERINPDATE1', 'SERINPDATE2', 'SERCUSTCD', 'SERCUSTNAME', 'SERSTAFFCD', 'SERSTAFFNAME', 'SEARCHITEM');
      
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
?>