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
$javaFunc = new AccPurchaseDCNoteEntryRD;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 8;
if(empty($data['DCTYP'])) { $data['DCTYP'] = 0; }
// $data['CHANGETYP'] = 1;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['DCNO'])) {
        unsetSessionData();
        $data['DCNO'] = isset($_GET['DCNO']) ? $_GET['DCNO']: '';
        $query = $javaFunc->getDC($data['DCNO']);
        $data = $query;
        if(isset($query['DCNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $query2 = $javaFunc->getDC2($query['DCNO'], $query['PVNO'], $query['DCTYP'], $query['CHANGETYP']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            if(!empty($query2)) {
                $data['S_TTL'] = isset($query2['S_TTL']) ? $query2['S_TTL']: '0';
                $data['OLDINVAMT'] = isset($query2['OLDINVAMT']) ? $query2['OLDINVAMT']: '0';
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['DIFF'] = $query2['DIFF'];
                $data['DIFFDISP'] = $query2['DIFFDISP'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = isset($query2['VATAMOUNT']) ? $query2['VATAMOUNT']: '0';
                $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['DCSVNO'] = $query2['DCSVNO'];
                // DIFFDISP,T_AMOUNT
                // 0::OLDINVAMT:+0::DIFF:
                // T_AMOUNT,VATAMOUNT1
                // 0::S_TTL:
                // 0::S_TTL:+0::VATAMOUNT:+0::VATAMOUNT1:
            }
            $query3 = $javaFunc->DCMESSAGECMB($query['DCTYP']);
            // echo '<pre>';
            // print_r($query3);
            // echo '</pre>';
            if(!empty($query3)) {
                // $data['ADD11'] = $query3['ADD11'];
                // $data['SYSVIS_DRMSG'] = $query3['SYSVIS_DRMSG'];
                // $data['SYSVIS_CRMSG'] = $query3['SYSVIS_CRMSG'];
                // $data['DCMESSAGE'] = array();
                // foreach ($query3 as $key => $value) {
                //     $data['DCMESSAGE'] += array($value['CODE'] => $value['TEXT']);
                // }
            }
            $query4 = $javaFunc->MESSAGECMB($query['CHANGETYP']);
            // echo '<pre>';
            // print_r($query4);
            // echo '</pre>';
            $itemlist = $javaFunc->getDCLn($query['DCNO'], $query['PVNO'], $query['DCTYP'], $query['CHANGETYP']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }
    } else if(!empty($_GET['PVNO'])) {
        unsetSessionData();
        $data['PVNO'] = isset($_GET['PVNO']) ? $_GET['PVNO']: '';
        $query = $javaFunc->getPV($data['PVNO']);
        $data = $query;
        if(isset($query['PVNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $query2 = $javaFunc->getPV2($query['PVNO']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            if(!empty($query2)) {
                $data['DCTYP'] = $query2['DCTYP'];
                $data['CHANGETYP'] = $query2['CHANGETYP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['OLDINVAMT'] = $query2['OLDINVAMT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['DIFF'] = $query2['DIFF'];
                $data['DIFFDISP'] = $query2['DIFFDISP'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                // $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $query3 = $javaFunc->DCMESSAGECMB($query2['DCTYP']);
                if(!empty($query3)) {
                    $data['ADD11'] = $query3['ADD11'];
                    $data['SYSVIS_DRMSG'] = $query3['SYSVIS_DRMSG'];
                    $data['SYSVIS_CRMSG'] = $query3['SYSVIS_CRMSG'];
                    // $data['DCMESSAGE'] = array();
                    // foreach ($query3 as $key => $value) {
                    //     $data['DCMESSAGE'] += array($value['CODE'] => $value['TEXT']);
                    // }
                }
                // echo '<pre>';
                // print_r($query3);
                // echo '</pre>';
                $query4 = $javaFunc->MESSAGECMB($query2['CHANGETYP']);
                // echo '<pre>';
                // print_r($query4);
                // echo '</pre>';
            }

            $itemlist = $javaFunc->getPVLn($query['PVNO'], $query2['DCTYP'], $query2['CHANGETYP']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }

    }

    if(!empty($query) || !empty($query2) || !empty($itemlist) ) {
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
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'DCMESSAGE') { getDCMESSAGE(); }
        if ($_POST['action'] == 'CRMSG') { CRMSG2ADD11(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'printedVoucher') { printedVoucher(); }
    }
}
//--------------------------------------------------------------------------------

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
// $load = $javaFunc->load();
// print_r($load);
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$dctype = $data['DRPLANG']['DC_TYPE'];
$chamgetyp = $data['DRPLANG']['CHANGETYP'];
$unit = $data['DRPLANG']['UNIT'];
if(isset($data['DCTYP']) && $data['DCTYP'] == 0) {
    $data['DCMESSAGE'] = $data['DRPLANG']['DCMESSAGE03']; 
} else {
    $data['DCMESSAGE'] = $data['DRPLANG']['DCMESSAGE02'];    
}
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getStaff() {
    $javafunc = new AccPurchaseDCNoteEntryRD;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function CRMSG2ADD11() {
    $javafunc = new AccPurchaseDCNoteEntryRD;
    $CRMSG = isset($_POST['CRMSG']) ? $_POST['CRMSG']: '';
    $query = $javafunc->CRMSG2ADD11($CRMSG);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
} 

function getDCMESSAGE() {
    $javafunc = new AccPurchaseDCNoteEntryRD;
    $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
    $DCTYP = isset($_POST['DCTYP']) ? $_POST['DCTYP']:'';
    $CHANGETYP = isset($_POST['CHANGETYP']) ? $_POST['CHANGETYP']:'';
    $PVNO = isset($_POST['PVNO']) ? $_POST['PVNO']: '';
    $query = $javafunc->DCMESSAGECMB($DCTYP);
    if(!empty($query)) { 
        $getPV2 = $javafunc->getPV2($PVNO);
        if (!empty($getPV2)) { $data = $getPV2; }
        // print_r($getPV2);
        $getPVLn = $javafunc->getPVLn($PVNO, $DCTYP, $CHANGETYP);
        // print_r($getPVLn);
        if (!empty($getPV2)) { $data['ITEM'] = $getPVLn; }
        $getSALEDIVCON = $javafunc->getSALEDIVCON($DCNO);
        // print_r($getSALEDIVCON);
        // if (!empty($getSALEDIVCON)) { $data['CRMSG'] = $getSALEDIVCON['SALEDIVCON']; }
        $data['DCTYP'] = $DCTYP;
        $data['CRMSG'] = $query;
        $data['CHANGETYP'] = $CHANGETYP;
    }
    setSessionArray($data);
    echo json_encode($data);
}

function commit() {

    $cmtfunc = new AccPurchaseDCNoteEntryRD;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $RowParam[] = array('ROWNO' => $i+1,
                            'ITEMCD' => $_POST['ITEMCD'][$i],
                            'ITEMNAME' => $_POST['ITEMNAME'][$i],
                            'SPURQTY' => isset($_POST['SPURQTY'][$i]) ? implode(explode(',', $_POST['SPURQTY'][$i])): '0.00',
                            'PURQTY' => isset($_POST['PURQTY'][$i]) ? implode(explode(',', $_POST['PURQTY'][$i])): '0.00',
                            'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                            'SPURUNITPRC' => isset($_POST['SPURUNITPRC'][$i]) ? implode(explode(',', $_POST['SPURUNITPRC'][$i])): '0.00',
                            'PURUNITPRC' => isset($_POST['PURUNITPRC'][$i]) ? implode(explode(',', $_POST['PURUNITPRC'][$i])): '0.00',
                            'PURAMT' => isset($_POST['PURAMT'][$i]) ? implode(explode(',', $_POST['PURAMT'][$i])): '0.00',
                            'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                            'VATAMT' => isset($_POST['VATAMT'][$i]) ? implode(explode(',', $_POST['VATAMT'][$i])): '0.00',
                            'SYSROWCOLOR' => isset($_POST['SYSROWCOLOR'][$i]) ? implode(explode(',', $_POST['SYSROWCOLOR'][$i])): '0.00');
    }

    $param = array( 'DCNO' => $_POST['DCNO'],
                    'DCSVNO' => $_POST['DCSVNO'],
                    'DCTYP' => $_POST['DCTYP'],
                    'PVNO' => $_POST['PVNO'],
                    'SVNO' => $_POST['SVNO'],
                    'CHANGETYP' => $_POST['CHANGETYP'],
                    'DCDATE' => str_replace('-', '', $_POST['DCDATE']),
                    'PURRECINSPDT' => str_replace('-', '', $_POST['PURRECINSPDT']),
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'DIVISIONNAME' => $_POST['DIVISIONNAME'],
                    'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'SUPPLIERTEL' => $_POST['SUPPLIERTEL'],
                    'SUPPLIERFAX' => $_POST['SUPPLIERFAX'],
                    'SUPPLIERCONTACT' => $_POST['SUPPLIERCONTACT'],
                    'SUPCURCD' => $_POST['SUPCURCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'ADD03' => $_POST['ADD03'],
                    'ADD04' => $_POST['ADD04'],
                    'ADD05' => $_POST['ADD05'],
                    'ADD06' => $_POST['ADD06'],
                    'ADD07' => $_POST['ADD07'],
                    'ADD08' => $_POST['ADD08'],
                    'ADD11' => isset($_POST['ADD11']) ? $_POST['ADD11']: '',
                    'ADD12' => isset($_POST['ADD12']) ? $_POST['ADD12']: '',
                    'CRMSG' => $_POST['CRMSG'],
                    'DRMSG' => $_POST['CRMSG'],
                    'S_TTL' => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    'DIFFDISP' => isset($_POST['DIFFDISP']) ? implode(explode(',', $_POST['DIFFDISP'])): '0.00',
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0',
                    'VATRATE' => $_POST['VATRATE'],
                    'DIFF' => isset($_POST['DIFF']) ? implode(explode(',', $_POST['DIFF'])): '0.00',
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'DVW' => '',
                    'DATA' => $RowParam);
    // print_r($param);
    $checkb4commit = $cmtfunc->checkb4commit(isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',  isset($_POST['ADD12']) ? $_POST['ADD12']: '', str_replace('-', '', $_POST['DCDATE']));
    // print_r($checkb4commit);
    $commit = $cmtfunc->commit($param);
    unsetSessionData();
    echo json_encode($commit);
}

function cancel() {
    $cancelfunc = new AccPurchaseDCNoteEntryRD;
    $cancel = $cancelfunc->cancel($_POST['DCNO'], $_POST['DCSVNO']);
    unsetSessionData();
}

function printedVoucher() {
 
    try {
        $printfunc = new AccPurchaseDCNoteEntryRD;
        $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
        $Param = array( 'DCNO' => $DCNO,
                        'DCSVNO' => isset($_POST['DCSVNO']) ? $_POST['DCSVNO']: '',
                        'DCDATE' => isset($_POST['DCDATE']) ? str_replace('-', '', $_POST['DCDATE']): '',
                        'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME']) ? $_POST['SUPPLIERNAME']: '',
                        'DIFF' => isset($_POST['DIFF']) ? implode(explode(',', $_POST['DIFF'])): '0.00',
                        'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                        'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        $printStatic = $printfunc->VoucherprintStatic($Param);
        $printDynamic = $printfunc->VoucherprintDaynamic($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_PURCHASEDCNOTEENTRY2_THARD.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['RPTTITLE'])
                                        ->setCellValue('B1', $printStatic['DETAILS'])
                                        ->setCellValue('C1', $printStatic['TDATE'])
                                        ->setCellValue('D1', $printStatic['NOTENO'])
                                        ->setCellValue('E1', $printStatic['PAIDTO'])
                                        ->setCellValue('F1', $printStatic['AMMON'])
                                        ->setCellValue('G1', $printStatic['REPRINTREASON'])
                                        ->setCellValue('H1', $printStatic['SYSVIS_REPRINTREASONLBL']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['SEQ'])
                                            ->setCellValue('B'.$key+1, $value['PONUM'])
                                            ->setCellValue('C'.$key+1, $value['ACCNO'])
                                            ->setCellValue('D'.$key+1, $value['PATI'])
                                            ->setCellValue('E'.$key+1, $value['REM'])
                                            ->setCellValue('F'.$key+1, $value['DEB'])
                                            ->setCellValue('G'.$key+1, $value['CRE'])
                                            ->setCellValue('H'.$key+1, $value['SEC'])
                                            ->setCellValue('I'.$key+1, $value['TDEB'])
                                            ->setCellValue('J'.$key+1, $value['TCRE'])
                                            ->setCellValue('K'.$key+1, $value['PAGESEQ'])
                                            ->setCellValue('L'.$key+1, $value['PAGENO'])
                                            ->setCellValue('M'.$key+1, $value['ROWCOUNTER']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $DCNO.'_DCNOTE_VOUCHER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $DCNO.'_DCNOTE_VOUCHER_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF->setActiveSheetIndex($sheetRpt);
            // $sheetExcel->getActiveSheet()->getStyle('A4:D4')->getFont()->setSize(8);
            // $sheetExcel->getActiveSheet()->getStyle('A10:D10')->getFont()->setSize(8);
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
        $data['ITEM'][$i+1] = array('ROWNO' => $i+1,
                                    'ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'SPURQTY' => $_POST['SPURQTY'][$i],
                                    'PURQTY' => $_POST['PURQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SPURUNITPRC' => $_POST['SPURUNITPRC'][$i],
                                    'PURUNITPRC' => $_POST['PURUNITPRC'][$i],
                                    'PURAMT' => $_POST['PURAMT'][$i],
                                    'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                                    'VATAMT' => $_POST['VATAMT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'DCNO', 'DCDATE', 'PVNO', 'DCTYP', 'CHANGETYP', 'DIVISIONCD', 'DIVISIONNAME', 'SUPPLIERCD', 'SUPPLIERNAME', 'SUPPLIERADDR1', 'SUPPLIERADDR2', 'SUPPLIERTEL', 
        'SUPPLIERFAX', 'SUPCURDISP', 'SUPCURCD', 'BRANCHKBN', 'TAXID', 'SUPPLIERCONTACT', 'PURRECINSPDT', 'ADD05', 'SALETERM', 'STAFFCD', 'STAFFNAME', 'ITEM','ADD12', 'ADD03', 'STAFFCD', 'ADD04', 'ADD06', 'CRMSG',
        'ADD07', 'ADD11', 'ADD08', 'S_TTL', 'OLDINVAMT', 'QUOTEAMOUNT', 'DIFFDISP', 'VATRATE',  'SYSEN_DCDATE', 'SYSEN_PVNO', 'SYSEN_DCTYP', 'SYSEN_CHANGETYP', 'SYSEN_SUPPLIERCONTACT', 'SYSEN_ADD03', 'SYSEN_STAFFCD', 
        'SYSEN_ADD04', 'SYSEN_ADD06', 'SYSEN_ADD07', 'SYSEN_ADD08', 'SYSEN_VATRATE', 'SYSEN_DVW', 'SYSEN_COMMIT', 'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSVIS_REPRINTREASON', 'SYSVIS_REPRINTLBL', 'SYSEN_DNCNREM',
        'SYSEN_REPRINTREASON', 'SYSVIS_DUMMYPRT1', 'SYSVIS_DUMMYPRT2', 'DIFF', 'VATAMOUNT1', 'DCSVNO', 'T_AMOUNT', 'DCMESSAGE', 'REPRINTREASON', 'SYSVIS_DRMSG', 'SYSVIS_CRMSG', 'SYSEN_ADD05', 'SYSEN_ADD12', 
        'SYSEN_BRANCHKBN', 'SYSEN_DISCRATE', 'SVNO', 'VATAMOUNT', 'DRMSG');

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

// function printedVoucher() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccPurchaseDCNoteEntryRD;
//     $Param = array( 'DCNO' => $data['DCNO'],
//                     'DCSVNO' => $data['DCSVNO'],
//                     'DCDATE' => str_replace('-', '', $data['DCDATE']),
//                     'SUPPLIERNAME' => $data['SUPPLIERNAME'],
//                     'DIFF' => isset($data['DIFF']) ? implode(explode(',', $data['DIFF'])): '0.00',
//                     'VATAMOUNT1' => isset($data['VATAMOUNT1']) ? implode(explode(',', $data['VATAMOUNT1'])): '0.00',
//                     'T_AMOUNT' => isset($data['T_AMOUNT']) ? implode(explode(',', $data['T_AMOUNT'])): '0.00',
//                     'REPRINTREASON' => isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     $printStatic = $printfunc->VoucherprintStatic($Param);
//     $printDynamic = $printfunc->VoucherprintDaynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         if(empty($printDynamic['ROWCOUNTER'])) {
//             for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//                 $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//             }
//         } else {
//             $data['PRINTDYNAMIC'][$printDynamic['ROWCOUNTER']] = $printDynamic; 
//         }
//         setSessionArray($data);
//     }
//     // echo '<pre>';
//     // print_r($data['PRINTSTATIC']);
//     // echo '</pre>';
//     // echo '<pre>';
//     // print_r($data['PRINTDYNAMIC']);
//     // echo '</pre>';
// }
?>