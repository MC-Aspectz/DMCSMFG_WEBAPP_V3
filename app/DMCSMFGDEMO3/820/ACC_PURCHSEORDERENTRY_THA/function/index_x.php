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
$javaFunc = new AccPurchseOrderEntryTHA;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 8;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['PRNO'])) {
        unsetSessionData();
        $data['PRNO'] = isset($_GET['PRNO']) ? $_GET['PRNO']: $_GET['PRNO'];
        $query = $javaFunc->getPR($data['PRNO']);
        $data = $query;
        if(!empty($query['PRNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $Param = array( 'PRNO' => isset($query['PRNO']) ? $query['PRNO']: '',
                            'SUPPLIERCD' => isset($query['SUPPLIERCD']) ? $query['SUPPLIERCD']: '',
                            'SUPCURCD' => isset($query['SUPCURCD']) ? $query['SUPCURCD']: '',
                            'VATRATE' => isset($query['VATRATE']) ? $query['VATRATE']: '',
                            'DISCRATE' => isset($query['DISCRATE']) ? $query['DISCRATE']: '0');
            $getPR2 = $javaFunc->getPR2($Param);
            // echo '<pre>';
            // print_r($getPR2);
            // echo '</pre>';
            if(!empty($getPR2)) {
                $data['S_TTL'] = isset($getPR2['S_TTL']) ? $getPR2['S_TTL']: '0.00';
                $data['DISCOUNTAMOUNT'] = isset($getPR2['DISCOUNTAMOUNT']) ? $getPR2['DISCOUNTAMOUNT']: '0.00';
                $data['QUOTEAMOUNT'] = isset($getPR2['QUOTEAMOUNT']) ? $getPR2['QUOTEAMOUNT']: '0.00';
                $data['VATAMOUNT'] = isset($getPR2['VATAMOUNT']) ? $getPR2['VATAMOUNT']: '0.00';
                $data['VATAMOUNT1'] = isset($getPR2['VATAMOUNT1']) ? $getPR2['VATAMOUNT1']: '0.00';
                $data['T_AMOUNT'] = isset($getPR2['T_AMOUNT']) ? $getPR2['T_AMOUNT']: '0.00';
            }
            $getPRLn = $javaFunc->getPRLn($Param);
            // echo '<pre>';
            // print_r($getPRLn);
            // echo '</pre>';
            if(!empty($getPRLn)) {
                $data['ITEM'] = $getPRLn; 
            }
        }
    } else if(!empty($_GET['PONO'])) {
        unsetSessionData();
        $data['PONO'] = isset($_GET['PONO']) ? $_GET['PONO']:'';
        $query = $javaFunc->getPO($data['PONO']);
        $data = $query;
        if(isset($query['PONO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $getPO2 = $javaFunc->getPO2($query['PONO']);
            // echo '<pre>';
            // print_r($getPO2);
            // echo '</pre>';
            if(!empty($getPO2)) {
                $data['SUPCURCD'] = isset($getPO2['SUPCURCD']) ? $getPO2['SUPCURCD']: '';
                $data['SUPCURDISP'] = isset($getPO2['SUPCURDISP']) ? $getPO2['SUPCURDISP']: '';
                $data['S_TTL'] = isset($getPO2['S_TTL']) ? $getPO2['S_TTL']: '0.00';
                $data['DISCOUNTAMOUNT'] = isset($getPO2['DISCOUNTAMOUNT']) ? $getPO2['DISCOUNTAMOUNT']: '0.00';
                $data['QUOTEAMOUNT'] = isset($getPO2['QUOTEAMOUNT']) ? $getPO2['QUOTEAMOUNT']: '0.00';
                $data['VATAMOUNT'] = isset($getPO2['VATAMOUNT']) ? $getPO2['VATAMOUNT']: '0.00';
                $data['VATAMOUNT1'] = isset($getPO2['VATAMOUNT1']) ? $getPO2['VATAMOUNT1']: '0.00';
                $data['T_AMOUNT'] = isset($getPO2['T_AMOUNT']) ? $getPO2['T_AMOUNT']: '0.00';
            }
            $getPOLn = $javaFunc->getPOLn($query['PONO']);
            // echo '<pre>';
            // print_r($getPOLn);
            // echo '</pre>';
            if(!empty($getPOLn)) {
                $data['ITEM'] = $getPOLn; 
            }
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { setItemValue(); }
        if ($_POST['action'] == 'unsetsessionItem') {  unsetSesstionItem($_POST['lineIndex']); }
        if ($_POST['action'] == 'DIVISIONCD') { getDiv(); }
        if ($_POST['action'] == 'SUPPLIERCD') { getSupplier(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'SUPCURCD') { getCurrency(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'print') { printed(); }
        if ($_POST['action'] == 'insertBak') { insertBak(); }
    }
    if(isset($_POST['ALLOCORDERFLG']) == '1') { setOrderBOMEntry(); }
}
//--------------------------------------------------------------------------------

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
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$unit = $data['DRPLANG']['UNIT'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getDiv() {
    $javafunc = new AccPurchseOrderEntryTHA;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getSupplier() {
    $javafunc = new AccPurchseOrderEntryTHA;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSupplier($SUPPLIERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new AccPurchseOrderEntryTHA;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new AccPurchseOrderEntryTHA;
    $SUPCURCD = isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '';
    $query = $javafunc->getCurrency($SUPCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getItem() {
    $javafunc = new AccPurchseOrderEntryTHA;
    $Param = array( 'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    'SUPCURCD' => isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'PURQTY' => '',
                    'DISCRATE' => isset($_POST['DISCRATE']) ?  $_POST['DISCRATE']: '0',
                    'VATRATE' => isset($_POST['VATRATE']) ?  $_POST['VATRATE']: '');
    $index = isset($_POST['index']) ? $_POST['index']: '';
    $query = $javafunc->getItem($Param);

    if(!empty($query)) {

        $data['ITEM'][$index] = array(  'ROWNO' => $index,
                                        'ITEMCD' => $query['ITEMCD'],
                                        'ITEMNAME' => $query['ITEMNAME'],
                                        'PURQTY' => '0.00',
                                        'ITEMUNITTYP' => $query['ITEMUNITTYP'],
                                        'PURUNITPRC' => isset($query['PURUNITPRC']) ? $query['PURUNITPRC']: '0.00',
                                        'DISCOUNT' => isset($query['DISCOUNT']) ? $query['DISCOUNT']: '0.00',
                                        'PURAMT' => isset($query['PURAMT']) ? $query['PURAMT']: '0.00',
                                        'DISCOUNT2' => $query['DISCOUNT2'],
                                        'VATAMT' => $query['VATAMT'],
                                        'PRLN' => isset($_POST['PRNO']) ? $_POST['PRNO']: '');

        setSessionArray($data);
    }
    echo json_encode($query);
} 

function commit() {
    $RowParam = array();
    $cmtfunc = new AccPurchseOrderEntryTHA;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        if($_POST['ITEMCD'][$i] != '' && isset($_POST['ITEMCD'][$i])) {
            $RowParam[] = array('ROWNO' => $i + 1,
                                'ITEMCD' => $_POST['ITEMCD'][$i],
                                'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                'PURQTY' => isset($_POST['PURQTY'][$i]) ? implode(explode(',', $_POST['PURQTY'][$i])): '0.00',
                                'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                'PURUNITPRC' => isset($_POST['PURUNITPRC'][$i]) ? implode(explode(',', $_POST['PURUNITPRC'][$i])): '0.00',
                                'DISCOUNT' => isset($_POST['DISCOUNT'][$i]) ? implode(explode(',', $_POST['DISCOUNT'][$i])): '0.00',
                                'PURAMT' => isset($_POST['PURAMT'][$i]) ? implode(explode(',', $_POST['PURAMT'][$i])): '0.00',
                                'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                                'VATAMT' => $_POST['VATAMT'][$i],
                                'PRLN' => $_POST['PRLN'][$i]);
        }
    }
    // print_r($RowParam);
    $param = array( 'PONO' => $_POST['PONO'],
                    'PRNO' => $_POST['PRNO'],
                    'ISSUEDT' => !empty($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): '',
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'PURDUEDT' => !empty($_POST['PURDUEDT']) ? str_replace('-', '', $_POST['PURDUEDT']): '',
                    'SUPCURCD' => $_POST['SUPCURCD'],
                    'SUPPLIERCONTACT' => $_POST['SUPPLIERCONTACT'],
                    'SUPPLIERTEL' => $_POST['SUPPLIERTEL'],
                    'SUPPLIERFAX' => $_POST['SUPPLIERFAX'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'ADD03' => $_POST['ADD03'],
                    'ADD04' => $_POST['ADD04'],
                    'ADD05' => $_POST['ADD05'],
                    'ADD06' => $_POST['ADD06'],
                    'ADD07' => $_POST['ADD07'],
                    'ADD08' => $_POST['ADD08'],
                    'DISCRATE' => $_POST['DISCRATE'],
                    'VATRATE' => $_POST['VATRATE'],
                    'VATAMOUNT1' => $_POST['VATAMOUNT1'],
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    if(is_array($commit)) { unsetSessionData(); }
    echo json_encode($commit);
}

function cancel() {
    $cancelfunc = new AccPurchseOrderEntryTHA;
    $cancel = $cancelfunc->cancel($_POST['PONO']);
    unsetSessionData();
}

function insertBak() {
    $insfunc = new AccPurchseOrderEntryTHA;
    $PROORDERNO = isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '';
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $BMVERSION = !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '';
    $param = array( 'PROORDERNO' => isset($_POST['PROORDERNO']) ? $_POST['PROORDERNO']: '',
                    'PROISSUEDT' => isset($_POST['PROISSUEDT']) ? str_replace('-', '', $_POST['PROISSUEDT']): '',
                    'PROQTY' => isset($_POST['PROQTY']) ? implode(explode(',', $_POST['PROQTY'])): '0.00',
                    'PROPLANSTARTDT' => isset($_POST['PROPLANSTARTDT']) ? str_replace('-', '', $_POST['PROPLANSTARTDT']): '',
                    'PROPLANENDDT' => isset($_POST['PROPLANENDDT']) ? str_replace('-', '', $_POST['PROPLANENDDT']): '',
                    'PROINSPTYP' => $_POST['PROINSPTYP'],
                    'PROREM' => $_POST['PROREM'],
                    'PROSAMPLEINSP' => isset($_POST['PROSAMPLEINSP']) ? $_POST['PROSAMPLEINSP']: '',
                    'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN']) ? $_POST['SALEORDERNOLN']: '',
                    'ITEMCD' => $_POST['ITEMCD'],
                    'ITEMNAME' => $_POST['ITEMNAME'],
                    'ITEMSPEC' => $_POST['ITEMSPEC'],
                    'MATERIALCD' => $_POST['MATERIALCD'],
                    'ITEMTAXTYP' => $_POST['ITEMTAXTYP'],
                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'],
                    'LOCTYP' => $_POST['LOCTYP'],
                    'LOCCD' => $_POST['LOCCD'],
                    'PROFACTYP' => $_POST['PROFACTYP'],
                    'WCCD' => $_POST['WCCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'PROSTATUS' => $_POST['PROSTATUS'],
                    'BMVERSION' => !empty($_POST['BMVERSION']) ? $_POST['BMVERSION']: '',
                    'ITEMPROPTNCD' => !empty($_POST['ITEMPROPTNCD']) ? $_POST['ITEMPROPTNCD']: '',
                );
    // print_r($param);
    $insert = $insfunc->insert($param);
    echo json_encode($insert);
    unsetSessionData();
}

function setOrderBOMEntry() {
    $javafunc = new AccPurchseOrderEntryTHA;
    // print_r($_POST);
    $param = array( 'PFAPPCD' => 'ORDERBMENTRY',
                    'ALLOCORDERFLG' => isset($_POST['ALLOCORDERFLG']) ? $_POST['ALLOCORDERFLG']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'ODRQTY' => isset($_POST['ODRQTY']) ? $_POST['ODRQTY']: '',
                    'ALLOCQTY' => isset($_POST['ALLOCQTY']) ? $_POST['ALLOCQTY']: '',
                    'ALLOCPURORDERNOLN' => isset($_POST['ALLOCPURORDERNOLN']) ? $_POST['ALLOCPURORDERNOLN']: '',
                    'ALLOCORDERTYP' => !empty($_POST['ALLOCORDERTYP']) ? $_POST['ALLOCORDERTYP']: '',
                    'ALLOCORDERNO' => !empty($_POST['ALLOCORDERNO']) ? $_POST['ALLOCORDERNO']: '');
    $query = $javafunc->loadForm($param);
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';
    if(!empty($query)) {
        $data = $query;
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}

function printed() {

    try {
        $printfunc = new AccPurchseOrderEntryTHA;
        $PONO = isset($_POST['PONO']) ? $_POST['PONO'] : '';
        $param = array( 'PONO' => $PONO,
                        'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME']) ? $_POST['SUPPLIERNAME']: '',
                        'SUPPLIERADDR1' => isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']: '',
                        'SUPPLIERADDR2' => isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']: '',
                        'SUPPLIERTEL' => isset($_POST['SUPPLIERTEL']) ? $_POST['SUPPLIERTEL']: '',
                        'SUPPLIERFAX' => isset($_POST['SUPPLIERFAX']) ? $_POST['SUPPLIERFAX']: '',
                        'ISSUEDT' => !empty($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']) : str_replace('-', '', date('Y-m-d')),
                        'PURDUEDT' => !empty($_POST['PURDUEDT']) ? str_replace('-', '', $_POST['PURDUEDT']) : str_replace('-', '', date('Y-m-d')),
                        'ADD03' => isset($_POST['ADD03']) ? $_POST['ADD03']: '',
                        'ADD05' => isset($_POST['ADD05']) ? $_POST['ADD05']: '',
                        'ADD06' => isset($_POST['ADD06']) ? $_POST['ADD06']: '',
                        'ADD07' => isset($_POST['ADD07']) ? $_POST['ADD07']: '',
                        'ADD08' => isset($_POST['ADD08']) ? $_POST['ADD08']: '',
                        'SUPCURDISP' => isset($_POST['SUPCURDISP']) ? $_POST['SUPCURDISP']: 'THB',
                        'VATAMOUNT' => !empty($_POST['VATAMOUNT']) ? str_replace([','], '', $_POST['VATAMOUNT']): '',
                        'VATAMOUNT1' => !empty($_POST['VATAMOUNT1']) ? str_replace([','], '', $_POST['VATAMOUNT1']): '');
        // print_r($param);
        $printStatic = $printfunc->printStatic($param);
        $printDynamic = $printfunc->printDynamic($param);
        // print_r($printStatic);
        // print_r($printDynamic);
        // exit();
        if(is_array($printDynamic) && is_array($printStatic)) {
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_PURCHSEORDERENTRY_THA.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPNTH'])
                                        ->setCellValue('B1', $printStatic['COMPNEN'])
                                        ->setCellValue('C1', $printStatic['ADDR1'])
                                        ->setCellValue('D1', $printStatic['ADDR2'])
                                        ->setCellValue('E1', $printStatic['TELTH'])
                                        ->setCellValue('F1', $printStatic['FAXTH'])
                                        ->setCellValue('G1', $printStatic['TELO'])
                                        ->setCellValue('H1', $printStatic['FAXO'])
                                        ->setCellValue('I1', $printStatic['SUPN'])
                                        ->setCellValue('J1', $printStatic['SUPADDR1'])
                                        ->setCellValue('K1', $printStatic['SUPADDR2'])
                                        ->setCellValue('L1', $printStatic['CTEL'])
                                        ->setCellValue('M1', $printStatic['CFAX'])
                                        ->setCellValue('N1', $printStatic['PONUM'])
                                        ->setCellValue('O1', $printStatic['TDATE'])
                                        ->setCellValue('P1', $printStatic['DELIDATE'])
                                        ->setCellValue('Q1', $printStatic['PAYTERM'])
                                        ->setCellValue('R1', $printStatic['REFD'])
                                        ->setCellValue('S1', $printStatic['REM1'])
                                        ->setCellValue('T1', $printStatic['REM2'])
                                        ->setCellValue('U1', $printStatic['REM3'])
                                        ->setCellValue('V1', $printStatic['CUR'])
                                        ->setCellValue('W1', $printStatic['SUB'])
                                        ->setCellValue('X1', $printStatic['LDIS'])
                                        ->setCellValue('Y1', $printStatic['AFDIS'])
                                        ->setCellValue('Z1', $printStatic['TVAT'])
                                        ->setCellValue('AA1', $printStatic['TOT'])
                                        ->setCellValue('AB1', $printStatic['GTOTEN'])
                                        ->setCellValue('AC1', $printStatic['GTOTTH']);

            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                                           
            $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1,  $value['ROWCOUNTER'])
                                        ->setCellValue('B'.$key+1, $value['NUM'])
                                        ->setCellValue('C'.$key+1, $value['CODE'])
                                        ->setCellValue('D'.$key+1, $value['DESCR'])
                                        ->setCellValue('E'.$key+1, $value['QTY'])
                                        ->setCellValue('F'.$key+1, $value['UOM'])
                                        ->setCellValue('G'.$key+1, $value['UPR'])
                                        ->setCellValue('H'.$key+1, $value['DIS'])
                                        ->setCellValue('I'.$key+1, $value['AMT']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $PONO.'_PURCHASE_ORDER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $PONO.'_PURCHASE_ORDER_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF->setActiveSheetIndex($sheetRpt);
            // $sheetExcel->getActiveSheet()->getStyle('A38:K38')->getFont()->setSize(8);
            // $sheetExcel->getActiveSheet()->getStyle('I45:T45')->getFont()->setSize(8);
            // $sheetExcel->getActiveSheet()->getStyle('I46:T46')->getFont()->setSize(8);
            // $sheetExcel->getActiveSheet()->getStyle('A45:G51')->getFont()->setSize(9);

            // $sheetExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(40);
            // $sheetExcel->getActiveSheet()->getStyle('K21:N32')->getNumberFormat()->setFormatCode('#,##.00');
            // $sheetExcel->getActiveSheet()->getStyle('O33:Q37')->getNumberFormat()->setFormatCode('#,##.00');
            // --------------------------------------------------
            $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel->getActiveSheet()->setShowGridLines(false);

            $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
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

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'PURQTY' => $_POST['PURQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'PURUNITPRC' => $_POST['PURUNITPRC'][$i],
                                    'DISCOUNT' => $_POST['DISCOUNT'][$i],
                                    'PURAMT' => $_POST['PURAMT'][$i],
                                    'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                                    'VATAMT' => $_POST['VATAMT'][$i],
                                    'PRLN' => $_POST['PRLN'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function setSessionArray($arr){
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'PRNO', 'PONO', 'ISSUEDT', 'DIVISIONCD', 'DIVISIONNAME', 'SUPPLIERCD', 'SUPPLIERNAME', 
                        'BRANCHKBN', 'TAXID', 'SUPCURCD', 'SUPCURDISP', 'SUPPLIERADDR1', 'SUPPLIERADDR2','SUPPLIERCONTACT', 'SUPPLIERTEL', 'SUPPLIERFAX', 'STAFFCD', 'STAFFNAME', 'PURDUEDT',
                        'ADD03', 'ADD04', 'ADD05', 'ADD06', 'ADD07', 'ADD08','S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'GROUPRT', 
                        'SYSEN_PRNO', 'SYSEN_ISSUEDT', 'SYSEN_PURDUEDT', 'SYSEN_DIVISIONCD', 'SYSEN_SUPPLIERCD', 'SYSEN_SUPCURCD', 'SYSEN_STAFFCD', 'SYSEN_SUPPLIERCONTACT', 'SYSEN_SUPPLIERTEL', 
                        'SYSEN_SUPPLIERFAX', 'SYSEN_ADD03', 'SYSEN_ADD04','SYSEN_ADD05', 'SYSEN_ADD06', 'SYSEN_ADD07', 'SYSEN_ADD08', 'SYSEN_VATRATE', 'SYSEN_DISCRATE', 'SYSEN_COMMIT', 'SYSEN_DVW',
                        'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSVIS_PTRESULTLBL');
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

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
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

// function printed() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccPurchseOrderEntryTHA;
//     $param = array( 'PONO' => $data['PONO'],
//                     'SUPPLIERNAME' => $data['SUPPLIERNAME'],
//                     'SUPPLIERADDR1' => $data['SUPPLIERADDR1'],
//                     'SUPPLIERADDR2' => $data['SUPPLIERADDR2'],
//                     'SUPPLIERTEL' => $data['SUPPLIERTEL'],
//                     'SUPPLIERFAX' => $data['SUPPLIERFAX'],
//                     'ISSUEDT' => isset($data['ISSUEDT']) ? str_replace('-', '', $data['ISSUEDT']) : str_replace('-', '', date('Y-m-d')),
//                     'PURDUEDT' => isset($data['PURDUEDT']) ? str_replace('-', '', $data['PURDUEDT']) : str_replace('-', '', date('Y-m-d')),
//                     'ADD03' => $data['ADD03'],
//                     'ADD05' => $data['ADD05'],
//                     'ADD06' => $data['ADD06'],
//                     'ADD07' => $data['ADD07'],
//                     'ADD08' => $data['ADD08'],
//                     'SUPCURDISP' => isset($data['SUPCURDISP']) ? $data['SUPCURDISP']: 'THB',
//                     'VATAMOUNT' => isset($data['VATAMOUNT']) ? str_replace([','], '', $data['VATAMOUNT']): '',
//                     'VATAMOUNT1' => isset($data['VATAMOUNT1']) ? str_replace([','], '', $data['VATAMOUNT1']): '');
//     // print_r($param);
//     $printStatic = $printfunc->printStatic($param);
//     $printDynamic = $printfunc->printDynamic($param);
//     // print_r($printStatic);
//     // print_r($printDynamic);
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
//     // echo '<pre>';
//     // print_r($data);
//     // echo '</pre>';
// }
?>