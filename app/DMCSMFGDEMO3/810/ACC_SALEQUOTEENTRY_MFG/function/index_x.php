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
$javaFunc = new QuoteEntryMFG;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 6;
$minsearchrow = 0;
$maxsearchrow = 16;

// https://web-develop.dmcs.biz/
// http://acc01.dmcs.biz/
if(!empty($_GET)) {
    if(!empty($_GET['ESTNO'])) {
        unsetSessionData();
        // libxml_use_internal_errors(TRUE);
        $query = $javaFunc->getEst($_GET['ESTNO']);
        $data = $query;
        if(!empty($query['ESTNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            if($query['SYSMSG'] == 'WARN_CANCALEDQUOTE') {
                echo "<script type='text/javascript'>if(confirm('".$query['SYSMSG']. "') != true) { window.location.href='index.php'; };</script>";
            }
            // printest($query);
            setSessionData('isPrint', 'on');
            $itemlist = $javaFunc->searchItemEST($query['ESTNO']);
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist; 
            }
            // printDynamic(); printStatic();
            // unsetSessionkey('ITEM');
        } else { setSessionData('isPrint', 'off'); }
    } else if(!empty($_GET['ESTNOCLONE'])) {
        unsetSessionData();
        $query = $javaFunc->getCloneEst($_GET['ESTNOCLONE']);
        // print_r($query);
        $data = $query;
        if(!empty($query['ESTNOCLONE'])) { 
            $itemlist = $javaFunc->searchItemEST($query['ESTNOCLONE']);
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist; 
            }
        }
    }
    
    // print_r($data);
    if(!empty($query)) {
        setSessionArray($data); 
    }    

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
    if ($_POST['action'] == 'unsetsessionItem') {  unsetSesstionItem($_POST['lineIndex']); }
    if ($_POST['action'] == 'keepdata') { setOldValue(); }
    if ($_POST['action'] == 'keepItemData') { setItemValue(); }
    if ($_POST['action'] == 'DIVISIONCD') { getDivision(); }
    if ($_POST['action'] == 'CUSTOMERCD') { getCustomer(); }
    if ($_POST['action'] == 'CUSCURCD') { getCurrency(); }
    if ($_POST['action'] == 'STAFFCD') { getStaff(); }
    if ($_POST['action'] == 'ITEMCD') { getItem(); }
    if ($_POST['action'] == 'getAmt') { getAmt(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'print') { printed();}
    if ($_POST['action'] == 'cancel') { cancel(); }
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
// setSessionArray($data);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getDivision() {
    $javafunc = new QuoteEntryMFG;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDivision($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new QuoteEntryMFG;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    if(!empty($query)) { $data = $query; }
    $data['QUOTEAMOUNT'] = '0.00';
    $data['VATAMOUNT'] = '0.00';
    $data['VATAMOUNT1'] = '0.00';
    $data['T_AMOUNT'] = '0.00';
    if(!empty($query)) { setSessionArray($data); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new QuoteEntryMFG;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new QuoteEntryMFG;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getItem() {
    $javafunc = new QuoteEntryMFG;
    $UNIT = getSessionData('UNIT');
    $Param = array( 'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'ESTLNQTY' => '',
                    'DISCRATE' => '', // isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '',
                    'VATRATE' => isset($_POST['VATRATE']) ?  $_POST['VATRATE']: '');
    $index = isset($_POST['index']) ? $_POST['index']: '';//
    $query = $javafunc->getItem($Param);
    if(!empty($query)) {
        $query['ITEMUNITTYP2'] = array_key_exists($query['ITEMUNITTYP'], $UNIT) ? $UNIT[$query['ITEMUNITTYP']]: '';
      
        $data['ITEM'][$index] = $query;
    
        $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));

        setSessionArray($data);
    }
    echo json_encode($query);
} 

function commit() {
    $RowParam = array();
    $cmtfunc = new QuoteEntryMFG;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        if($_POST['ITEMCD'][$i] != '' && isset($_POST['ITEMCD'][$i])) {
            $RowParam[] = array('ROWNO' => $i+1,
                                'ITEMCD' => $_POST['ITEMCD'][$i],
                                'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                'ESTLNQTY' => isset($_POST['ESTLNQTY'][$i]) ? implode(explode(',', $_POST['ESTLNQTY'][$i])): '0.00',
                                'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                'ESTLNUNITPRC' => isset($_POST['ESTLNUNITPRC'][$i]) ? implode(explode(',', $_POST['ESTLNUNITPRC'][$i])): '0.00',
                                'ESTDISCOUNT' => isset($_POST['ESTDISCOUNT'][$i]) ? implode(explode(',', $_POST['ESTDISCOUNT'][$i])): '0.00',
                                'ESTLNAMTDISP' => $_POST['ESTLNAMTDISP'][$i],
                                'ESTDISCOUNT2' => $_POST['ESTDISCOUNT2'][$i],
                                'ESTLNVAT' => isset($_POST['ESTLNVAT'][$i]) ? implode(explode(',', $_POST['ESTLNVAT'][$i])): '0.00');
        }
    }
    // print_r($RowParam);
    $param = array( 'ESTNO' => $_POST['ESTNO'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'ESTENTRYDT' => str_replace('-', '', $_POST['ESTENTRYDT']),
                    'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'ESTCUSTEL' => $_POST['ESTCUSTEL'],
                    'ESTCUSFAX' => $_POST['ESTCUSFAX'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'ESTCUSSTAFF' => $_POST['ESTCUSSTAFF'],
                    'ESTDLVCON1' => $_POST['ESTDLVCON1'],
                    'ESTDLVCON2' => $_POST['ESTDLVCON2'],
                    'ESTREM1' => $_POST['ESTREM1'],
                    'ESTREM2' => $_POST['ESTREM2'],
                    'ESTREM3' => $_POST['ESTREM3'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'S_TTL' => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    'DISCRATE' => $_POST['DISCRATE'],
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    'VATRATE' => $_POST['VATRATE'],
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    if(is_array($commit)) { unsetSessionData(); }
    echo json_encode($commit);
}

function printed() {

    $printfunc = new QuoteEntryMFG;
    if(!empty($_POST['ESTNO'])) {
        $ESTNO = isset($_POST['ESTNO']) ? $_POST['ESTNO']: '';
        $param = array( 'ESTNO' => $ESTNO,
                        'ESTCUSSTAFF' => isset($_POST['ESTCUSSTAFF']) ? $_POST['ESTCUSSTAFF']: '',
                        'CUSTOMERNAME' => isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                        'CUSTADDR1' => isset($_POST['CUSTADDR1']) ? $_POST['CUSTADDR1']: '',
                        'CUSTADDR2' => isset($_POST['CUSTADDR2']) ? $_POST['CUSTADDR2']: '',
                        'ESTCUSTEL' => isset($_POST['ESTCUSTEL']) ? $_POST['ESTCUSTEL']: '',
                        'ESTCUSFAX' => isset($_POST['ESTCUSFAX']) ? $_POST['ESTCUSFAX']: '',
                        'ESTENTRYDT' => isset($_POST['ESTENTRYDT']) ? str_replace('-', '', $_POST['ESTENTRYDT']): '',
                        'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                        'ESTDLVCON1' => isset($_POST['ESTDLVCON1']) ? $_POST['ESTDLVCON1']: '',
                        'ESTDLVCON2' => isset($_POST['ESTDLVCON2']) ? $_POST['ESTDLVCON2']: '',
                        'STAFFNAME' => isset($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: '',
                        'ESTREM1' => isset($_POST['ESTREM1']) ? $_POST['ESTREM1']: '',
                        'ESTREM2' => isset($_POST['ESTREM2']) ? $_POST['ESTREM2']: '',
                        'ESTREM3' => isset($_POST['ESTREM3']) ? $_POST['ESTREM3']: '',
                        'CUSCURDISP' => isset($_POST['CUSCURDISP']) ? $_POST['CUSCURDISP']: '');
        $printStatic = $printfunc->printStatic($param);
        $printDynamic = $printfunc->printDynamic($ESTNO);
        // print_r($printStatic);
        // print_r($printDynamic);
        // exit();
        if(is_array($printStatic) && is_array($printDynamic)) {
            printPDF($printStatic, $printDynamic, $ESTNO);
        }
    }
}

function printPDF($printStatic, $printDynamic, $ESTNO) {

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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEQUOTEENTRY_MFG.xlsx';
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
        $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPNTH'])
                                    ->setCellValue('B1', $printStatic['COMPNEN'])
                                    ->setCellValue('C1', $printStatic['ADDR1'])
                                    ->setCellValue('D1', $printStatic['ADDR2'])
                                    ->setCellValue('E1', $printStatic['TELTH'])
                                    ->setCellValue('F1', $printStatic['FAXTH'])
                                    ->setCellValue('G1', $printStatic['ADDREN1'])
                                    ->setCellValue('H1', $printStatic['ADDREN2'])
                                    ->setCellValue('I1', $printStatic['TELO'])
                                    ->setCellValue('J1', $printStatic['FAXO'])
                                    ->setCellValue('K1', $printStatic['ATNAME'])
                                    ->setCellValue('L1', $printStatic['CUSN'])
                                    ->setCellValue('M1', $printStatic['ADDR10'])
                                    ->setCellValue('N1', $printStatic['ADDR20'])
                                    ->setCellValue('O1', $printStatic['CTEL'])
                                    ->setCellValue('P1', $printStatic['CFAX'])
                                    ->setCellValue('Q1', $printStatic['QONUM'])
                                    ->setCellValue('R1', $printStatic['TDATE'])
                                    ->setCellValue('S1', $printStatic['PAYTERM'])
                                    ->setCellValue('T1', $printStatic['PRVALID'])
                                    ->setCellValue('U1', $printStatic['QOBY'])
                                    ->setCellValue('V1', $printStatic['REM1'])
                                    ->setCellValue('W1', $printStatic['REM2'])
                                    ->setCellValue('X1', $printStatic['REM3'])
                                    ->setCellValue('Y1', $printStatic['CUR']);

        //------------- Item List ----------- //                            
        foreach ($printDynamic as $key => $value) {
                                       
        $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1,  $value['ROWCOUNTER'])
                                    ->setCellValue('B'.$key+1, $value['NUM'])
                                    ->setCellValue('C'.$key+1, $value['CODE'])
                                    ->setCellValue('D'.$key+1, $value['DESCRIPT'])
                                    ->setCellValue('E'.$key+1, $value['QTY'])
                                    ->setCellValue('F'.$key+1, $value['UOM'])
                                    ->setCellValue('G'.$key+1, $value['UPR'])
                                    ->setCellValue('H'.$key+1, $value['DIS'])
                                    ->setCellValue('I'.$key+1, $value['AMT'])
                                    ->setCellValue('J'.$key+1, $value['SUB'])
                                    ->setCellValue('K'.$key+1, $value['LDIS'])
                                    ->setCellValue('L'.$key+1, $value['AFDIS'])
                                    ->setCellValue('M'.$key+1, $value['VAMT'])
                                    ->setCellValue('N'.$key+1, $value['TOT']);
        }
        // $sheetExcel->getActiveSheet()->getStyle('E2:R10')->getNumberFormat()->setFormatCode('#,##.00');
        // --------------------------------------------------
        // Set Active Sheet to [REPORT]
        $sheetExcel->setActiveSheetIndex($sheetRpt);
        // --------------------------------------------------
        $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
        // Save Excel Report File on Server
        $report_file = $ESTNO.'_'.date('Ymd_Hi').'.xlsx';
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
        $pdf_name = $ESTNO.'_'.date('Ymd_Hi').'.pdf';
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
        $sheetExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
        $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.8);
        $sheetExcel->getActiveSheet()->getPageMargins()->setRight(0.5);           

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
    $cancelfunc = new QuoteEntry;
    $cancel = $cancelfunc->cancel($_POST['ESTNO']);
    unsetSessionData();
}

function getAmt() {
    global $data;
    $amtfunc = new QuoteEntry;
    $data = getSessionData();
    $Param = array( 'ESTLNQTY' => 2,
                    'ESTLNUNITPRC' =>  2000,
                    'ESTDISCOUNT' =>  0,
                    'CUSCURCD' => $data['CUSCURCD'],
                    'DISCRATE' => $data['DISCRATE'],
                    'VATRATE' => $data['VATRATE'],
                    'CUSTOMERCD' => $data['CUSTOMERCD']);
    $amt = $amtfunc->getAmt($Param);
    // print_r($amt['ESTLNAMTDISP']);
    // print_r($amt['ESTDISCOUNT2']);
    // print_r($amt['ESTLNVAT']);
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
                                    'ESTLNQTY' => $_POST['ESTLNQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'ESTLNUNITPRC' => $_POST['ESTLNUNITPRC'][$i],
                                    'ESTDISCOUNT' => $_POST['ESTDISCOUNT'][$i],
                                    'ESTLNAMTDISP' => $_POST['ESTLNAMTDISP'][$i],
                                    'ESTDISCOUNT2' => $_POST['ESTDISCOUNT2'][$i],
                                    'ESTLNVAT' => $_POST['ESTLNVAT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ESTNO', 'ESTNOCLONE', 'DIVISIONCD', 'DIVISIONNAME', 'ESTENTRYDT', 'CUSTOMERCD', 'BRANCHKBN', 'TAXID', 'CUSCURCD', 'CUSTOMERNAME',
                        'CUSTADDR1', 'CUSTADDR2', 'ESTCUSSTAFF', 'ESTCUSTEL', 'ESTCUSFAX', 'STAFFCD', 'STAFFNAME', 'ESTDLVCON1', 'ESTDLVCON2', 'ITEM', 'isPrint',
                        'CUSCURDISP', 'ESTREM1', 'ESTREM2', 'ESTREM3', 'S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'SYSMSG',
                        'ROWCOUNTER', 'COMPNTH', 'COMPNEN', 'ADDR1', 'ADDR2', 'TELTH', 'FAXTH', 'ADDREN1', 'ADDREN2', 'TELO', 'FAXO', 'ATNAME', 'SALETERM',
                        'CUSN', 'ADDR10', 'ADDR20', 'CTEL', 'CFAX', 'QONUM', 'TDATE', 'PAYTERM', 'PRVALID', 'QOBY', 'REM1', 'REM2', 'REM3', 'CUR', 'ITEMPRINT');
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

function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>