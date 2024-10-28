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
$javaFunc = new AccSaleDCNoteEntryRD;
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
        // $query = $javaFunc->getDC1($data['DCNO']);
        $data = $query;
        if(isset($query['DCNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $query2 = $javaFunc->getDC2($query['DCNO'], $query['SALETRANNO'], $query['DCTYP'], $query['CHANGETYP']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            $query3 = $javaFunc->DCMESSAGECMB($query['DCTYP']);
            if(!empty($query3)) {
                $data['DCMESSAGE3'] = array();
                foreach ($query3 as $key => $value) {
                    $data['DCMESSAGE3'] += array($value['CODE'] => $value['TEXT']);
                }
            }
            $query4 = $javaFunc->getSALEDIVCON($query['DCNO']);
           // print_r($query4);
            if(!empty($query4)) {
                $data['SALEDIVCON'] = $query4['SALEDIVCON'];
            }
            // if($query['SYSVIS_REPRINTREASON'] == 'F') {
            //     $printCheck = $javaFunc->NoteprintCheck($query['DCNO'], '');
            //     // print_r($printCheck);
            //     $data['SYSVIS_REPRINTREASON'] = $printCheck['SYSVIS_REPRINTREASON'];
            //     $data['SYSVIS_REPRINTLBL'] = $printCheck['SYSVIS_REPRINTLBL'];               
            // }
            if(!empty($query2)) {
                $data['S_TTL'] = $query2['S_TTL'];
                $data['OLDINVAMT'] = $query2['OLDINVAMT'];
                $data['CHANGETYP'] = $query2['CHANGETYP'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['DIFF'] = $query2['DIFF'];
                $data['DIFFDISP'] = $query2['DIFFDISP'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['DCSVNO'] = $query2['DCSVNO'];
            }
            $itemlist = $javaFunc->getDCLn($query['DCNO'], $query['SALETRANNO'], $query['DCTYP'], $query['CHANGETYP']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist; 
            }
        }
    } else if(!empty($_GET['SALETRANNO'])) {
        unsetSessionData();
        $data['SALETRANNO'] = isset($_GET['SALETRANNO']) ? $_GET['SALETRANNO']: '';
        $query = $javaFunc->getST($data['SALETRANNO']);
        $data = $query;
        if(isset($query['SALETRANNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            // $data['VATAMOUNT2'] = $query['VATAMOUNT1'];
            $query2 = $javaFunc->getST2($query['SALETRANNO']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            if(!empty($query2)) {
                $data['DCTYP'] = $query2['DCTYP'];
                $data['CHANGETYP'] = $query2['CHANGETYP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['OLDINVAMT'] = $query2['OLDINVAMT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['DIFF'] = $query2['DIFFD'];
                $data['DIFFDISP'] = $query2['DIFFC'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['VATAMOUNT1'] = $query2['VATAMOUNT'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];

                $query3 = $javaFunc->DCMESSAGECMB($query2['DCTYP']);
                if(!empty($query3)) {
                    $data['DCMESSAGE3'] = array();
                    foreach ($query3 as $key => $value) {
                        $data['DCMESSAGE3'] += array($value['CODE'] => $value['TEXT']);
                    }
                }
                // echo '<pre>';
                // print_r($query3);
                // echo '</pre>';
            }
            $itemlist = $javaFunc->getSTLn($query['SALETRANNO'], $query2['DCTYP'], $query2['CHANGETYP']);
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
        if ($_POST['action'] == 'DCMESSAGECMB') { getDCMESSAGECMB(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'SALEDIVCON') { copy_txt(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'debitNote') { debitNote();}
        if ($_POST['action'] == 'debitNoteVoucher') { debitNoteVoucher();}
        if ($_POST['action'] == 'printChecknote' || $_POST['action'] == 'printCheckVoucher') { noteprintCheck(); }
        // if ($_POST['action'] == 'cancel') { cancel(); }
        // if ($_POST['action'] == 'calculate') { calculate(); }
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
if(isset($data['DCTYP']) && $data['DCTYP'] == 0) {
    $data['DCMESSAGE3'] = $data['DRPLANG']['DCMESSAGE3']; 
}
// setSessionArray($data);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getStaff() {
    $javafunc = new AccSaleDCNoteEntryRD;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function copy_txt() {
    $javafunc = new AccSaleDCNoteEntryRD;
    $SALEDIVCON = isset($_POST['SALEDIVCON']) ? $_POST['SALEDIVCON']: '';
    $query = $javafunc->copy_txt($SALEDIVCON);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
} 

function getDCMESSAGECMB() {
    $javafunc = new AccSaleDCNoteEntryRD;
    $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
    $DCTYP = isset($_POST['DCTYP']) ? $_POST['DCTYP']:'';
    $CHANGETYP = isset($_POST['CHANGETYP']) ? $_POST['CHANGETYP']:'';
    $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
    $query = $javafunc->DCMESSAGECMB($DCTYP);
    if(!empty($query)) { 
        $getST2 = $javafunc->getST2($SALETRANNO);
        if (!empty($getST2)) { $data = $getST2; }
        // print_r($getST2);
        $getSTLn = $javafunc->getSTLn($SALETRANNO, $DCTYP, $CHANGETYP);
        // print_r($getSTLn);
        if (!empty($getST2)) { $data['ITEM'] = $getSTLn; }
        $getSALEDIVCON = $javafunc->getSALEDIVCON($DCNO);
        // print_r($getSALEDIVCON);
        if (!empty($getSALEDIVCON)) { $data['SALEDIVCON'] = $getSALEDIVCON['SALEDIVCON']; }
        $data['DCTYP'] = $DCTYP;
        $data['DCMESSAGE3'] = $query;
        $data['CHANGETYP'] = $CHANGETYP;
    }
    // $MESSAGECMB = $javafunc->MESSAGECMB($CHANGETYP);
    // print_r($MESSAGECMB);
    setSessionArray($data);
    echo json_encode($data);
}  

function commit() {
    $cmtfunc = new AccSaleDCNoteEntryRD;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $RowParam[] = array('ROWNO' => $i+1,
                            'ITEMCD' => $_POST['ITEMCD'][$i],
                            'ITEMNAME' => $_POST['ITEMNAME'][$i],
                            'SSALEQTY' => isset($_POST['SSALEQTY'][$i]) ? implode(explode(',', $_POST['SSALEQTY'][$i])): '0.00',
                            'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? implode(explode(',', $_POST['SALEQTY'][$i])): '0.00',
                            'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                            'SSALEUNITPRC' => isset($_POST['SSALEUNITPRC'][$i]) ? implode(explode(',', $_POST['SSALEUNITPRC'][$i])): '0.00',
                            'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? implode(explode(',', $_POST['SALEUNITPRC'][$i])): '0.00',
                            'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? implode(explode(',', $_POST['SALEAMT'][$i])): '0.00',
                            'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                            'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? implode(explode(',', $_POST['SALETAXAMT'][$i])): '0.00',
                            'SALELN' => isset($_POST['SALELN'][$i]) ? implode(explode(',', $_POST['SALELN'][$i])): '0.00',
                            'SALEORDERQTY' => isset($_POST['SALEORDERQTY'][$i]) ? implode(explode(',', $_POST['SALEORDERQTY'][$i])): '0.00');
    }

    $param = array( 'DCNO' => $_POST['DCNO'],
                    'DCSVNO' => $_POST['DCSVNO'],
                    'DCTYP' => $_POST['DCTYP'],
                    'CHANGETYP' => $_POST['CHANGETYP'],
                    'DCDATE' => str_replace('-', '', $_POST['DCDATE']),
                    'SALETRANINSPDT' => str_replace('-', '', $_POST['SALETRANINSPDT']),
                    'SALETRANNO' => $_POST['SALETRANNO'],
                    'SVNO' => $_POST['DCSVNO'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'DIVISIONNAME' => $_POST['DIVISIONNAME'],
                    'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'ESTCUSTEL' => $_POST['ESTCUSTEL'],
                    'ESTCUSFAX' => $_POST['ESTCUSFAX'],
                    'ESTCUSSTAFF' => $_POST['ESTCUSSTAFF'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'SALETERM' => $_POST['SALETERM'],
                    'SALECUSMEMO' => $_POST['SALECUSMEMO'],
                    'SALEDIVCON' => $_POST['SALEDIVCON'],
                    'SALEDIVCON1' => $_POST['SALEDIVCON1'],
                    'SALEDIVCON2' => $_POST['SALEDIVCON2'],
                    'SALEDIVCON3' => $_POST['SALEDIVCON3'],
                    'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
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
    $checkb4commit = $cmtfunc->checkb4commit(isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00');
    // print_r($checkb4commit);
    $commit = $cmtfunc->commit($param);
    if(isset($commit['DCNO'])) {
        $commitAddData = $cmtfunc->commitAddData($commit['DCNO'], $_POST['SALEDIVCON']);
        // print_r($commitAddData);      
    }
    unsetSessionData();
    echo json_encode($commit);
}

function noteprintCheck() {
    $printfunc = new AccSaleDCNoteEntryRD;
    $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
    $REPRINTREASON = isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '';
    if($_POST['action'] == 'printChecknote') {
        $noteprintCheck = $printfunc->NoteprintCheck($DCNO, $REPRINTREASON); 
    } else if($_POST['action'] == 'printCheckVoucher') {
        $noteprintCheck = $printfunc->VoucherprintCheck($DCNO, $REPRINTREASON);
    }
    echo json_encode($noteprintCheck);
}

function debitNote() {

    try {
        $printfunc = new AccSaleDCNoteEntryRD;
        $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
        $Param = array( 'DCNO' => $DCNO,
                        'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                        'DCDATE' => !empty($_POST['DCDATE']) ? str_replace('-', '', $_POST['DCDATE']): '',
                        'SALETRANINSPDT' => !empty($_POST['SALETRANINSPDT']) ? str_replace('-', '', $_POST['SALETRANINSPDT']) : '',
                        'CUSTOMERNAME' => isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                        'CUSTOMERADDR1' => $_POST['CUSTOMERADDR1'],
                        'CUSTOMERADDR2' => $_POST['CUSTOMERADDR2'],
                        'CUSTOMERADDR1' => $_POST['CUSTOMERADDR1'],
                        'SALEDIVCON1' => isset($_POST['SALEDIVCON1']) ? $_POST['SALEDIVCON1']: '',
                        'SALEDIVCON2' => isset($_POST['SALEDIVCON2']) ? $_POST['SALEDIVCON2']: '',
                        'SALEDIVCON3' => isset($_POST['SALEDIVCON3']) ? $_POST['SALEDIVCON3']: '',
                        'OLDINVAMT' => !empty($_POST['OLDINVAMT']) ? implode(explode(',', $_POST['OLDINVAMT'])): '0.00',
                        'QUOTEAMOUNT' => !empty($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        // print_r($Param);
        $printStatic = $printfunc->NoteprintStatic($Param);
        $printDynamic = $printfunc->NoteprintDaynamic($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEDCNOTEENTRY2_THARD_DCNOTE.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPNEN'])
                                            ->setCellValue('B1', $printStatic['ADDR'])
                                            ->setCellValue('C1', $printStatic['TELTH'])
                                            ->setCellValue('D1', $printStatic['FAXTH'])
                                            ->setCellValue('E1', $printStatic['TAXID'])
                                            ->setCellValue('F1', $printStatic['DEPT'])
                                            ->setCellValue('G1', $printStatic['RPTTITLE'])
                                            ->setCellValue('H1', $printStatic['RPTCUSSUP'])
                                            ->setCellValue('I1', $printStatic['CUSFN'])
                                            ->setCellValue('J1', $printStatic['CUSADDR1'])
                                            ->setCellValue('K1', $printStatic['CUSADDR2'])
                                            ->setCellValue('L1', $printStatic['CRENUM'])
                                            ->setCellValue('M1', $printStatic['TDATE'])
                                            ->setCellValue('N1', $printStatic['INVNUM'])
                                            ->setCellValue('O1', $printStatic['INVDATE'])
                                            ->setCellValue('P1', $printStatic['REM1'])
                                            ->setCellValue('Q1', $printStatic['REM2'])
                                            ->setCellValue('R1', $printStatic['REM3'])
                                            ->setCellValue('S1', $printStatic['SUB'])
                                            ->setCellValue('T1', $printStatic['LDIS'])
                                            ->setCellValue('U1', $printStatic['AFDIS'])
                                            ->setCellValue('V1', $printStatic['OLDINV'])
                                            ->setCellValue('W1', $printStatic['CORINV'])
                                            ->setCellValue('X1', $printStatic['DIFF'])
                                            ->setCellValue('Y1', $printStatic['PVAT'])
                                            ->setCellValue('Z1', $printStatic['TVAT'])
                                            ->setCellValue('AA1', $printStatic['TOT'])
                                            ->setCellValue('AB1', $printStatic['CUR'])
                                            ->setCellValue('AC1', $printStatic['REPRINTREASON'])
                                            ->setCellValue('AD1', $printStatic['SYSVIS_REPRINTREASONLBL'])
                                            ->setCellValue('AE1', $printStatic['ROWCOUNTER']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['NUM'])
                                            ->setCellValue('B'.$key+1, $value['CODE'])
                                            ->setCellValue('C'.$key+1, $value['DESCR'])
                                            ->setCellValue('D'.$key+1, $value['QTY'])
                                            ->setCellValue('E'.$key+1, $value['UPR'])
                                            ->setCellValue('F'.$key+1, $value['AMT'])
                                            ->setCellValue('G'.$key+1, $value['BRANCHKBN'])
                                            ->setCellValue('H'.$key+1, $value['BRANCHNO'])
                                            ->setCellValue('I'.$key+1, $value['TAXIDC'])
                                            ->setCellValue('J'.$key+1, $value['ROWCOUNTER'])
                                            ->setCellValue('K'.$key+1, $value['TMPSEQ'])
                                            ->setCellValue('L'.$key+1, $value['TMPSEQ'])
                                            ->setCellValue('M'.$key+1, $value['PAGETYP'])
                                            ->setCellValue('N'.$key+1, $value['PAGETYPE']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $DCNO.'_DCNOTE_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $DCNO.'_DCNOTE_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF->setActiveSheetIndex($sheetRpt);
            $sheetExcel->getActiveSheet()->getStyle('A4:D4')->getFont()->setSize(8);
            $sheetExcel->getActiveSheet()->getStyle('A10:D10')->getFont()->setSize(8);
            // --------------------------------------------------
            $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel->getActiveSheet()->setShowGridLines(false);

            $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.6);
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

function debitNoteVoucher() {
   
    try {
        $printfunc = new AccSaleDCNoteEntryRD;
        $DCNO = isset($_POST['DCNO']) ? $_POST['DCNO']: '';
        $Param = array( 'DCSVNO' => isset($_POST['DCSVNO']) ? $_POST['DCSVNO']: '',
                        'DCNO' => $DCNO,
                        'DCDATE' => !empty($_POST['DCDATE']) ? str_replace('-', '', $_POST['DCDATE']): '',
                        'CUSTOMERNAME' => isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                        'DIFF' => isset($_POST['DIFF']) ? $_POST['DIFF']: '',
                        'T_AMOUNT' => !empty($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEDCNOTEENTRY2_THARD_DCNOTE_VOUCHER.xlsx';

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
                                    'SSALEQTY' => $_POST['SSALEQTY'][$i],
                                    'SALEQTY' => $_POST['SALEQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SSALEUNITPRC' => $_POST['SSALEUNITPRC'][$i],
                                    'SALEUNITPRC' => $_POST['SALEUNITPRC'][$i],
                                    'SALEAMT' => $_POST['SALEAMT'][$i],
                                    'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                                    'SALETAXAMT' => $_POST['SALETAXAMT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}
   
/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'DCNO', 'DCDATE', 'SALETRANNO', 'DCTYP', 'CHANGETYP', 'DIVISIONCD', 'DIVISIONNAME', 'CUSTOMERCD', 'CUSTOMERNAME', 'CUSTOMERADDR1', 'CUSTOMERADDR2', 'ESTCUSTEL', 
        'ESTCUSFAX', 'CUSCURDISP', 'CUSCURCD', 'BRANCHKBN', 'TAXID', 'ESTCUSSTAFF', 'SALETRANINSPDT', 'SALECUSMEMO', 'SALETERM', 'STAFFCD', 'STAFFNAME', 'ITEM', 'SALEDIVCON', 'SALEDIVCON1', 'SALEDIVCON2', 'SALEDIVCON3', 
        'SALEDIVCON4', 'S_TTL', 'OLDINVAMT', 'QUOTEAMOUNT', 'DIFFDISP', 'VATRATE',  'SYSEN_DCDATE', 'SYSEN_SALETRANNO', 'SYSEN_DCTYP', 'SYSEN_CHANGETYP', 'SYSEN_ESTCUSSTAFF', 'SYSEN_SALETERM', 'SYSEN_STAFFCD', 
        'SYSEN_SALEDIVCON1', 'SYSEN_SALEDIVCON2', 'SYSEN_SALEDIVCON3', 'SYSEN_SALEDIVCON4', 'SYSEN_VATRATE', 'SYSEN_DVW', 'SYSEN_COMMIT', 'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSVIS_REPRINTREASON', 'SYSVIS_REPRINTLBL', 
        'SYSEN_REPRINTREASON', 'SYSVIS_DUMMYPRT1', 'SYSVIS_DUMMYPRT2', 'DIFF', 'VATAMOUNT1', 'DCSVNO', 'T_AMOUNT', 'DCMESSAGE3', 'REPRINTREASON');

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

// function printed() {
    //     global $data;
    //     $data = getSessionData();
    //     $printfunc = new AccSaleDCNoteEntryRD;
    //     $Param = array( 'DCNO' => $data['DCNO'],
    //                     'SALETRANNO' => $data['SALETRANNO'],
    //                     'DCDATE' => str_replace('-', '', $data['DCDATE']),
    //                     'SALETRANINSPDT' => str_replace('-', '', $data['SALETRANINSPDT']),
    //                     'CUSTOMERNAME' => $data['CUSTOMERNAME'],
    //                     'CUSTOMERADDR1' => $data['CUSTOMERADDR1'],
    //                     'CUSTOMERADDR2' => $data['CUSTOMERADDR2'],
    //                     'CUSTOMERADDR1' => $data['CUSTOMERADDR1'],
    //                     'SALEDIVCON1' => isset($data['SALEDIVCON1']) ? $data['SALEDIVCON1']: '',
    //                     'SALEDIVCON2' => isset($data['SALEDIVCON2']) ? $data['SALEDIVCON2']: '',
    //                     'SALEDIVCON3' => isset($data['SALEDIVCON3']) ? $data['SALEDIVCON3']: '',
    //                     'OLDINVAMT' => isset($data['OLDINVAMT']) ? implode(explode(',', $data['OLDINVAMT'])): '0.00',
    //                     'QUOTEAMOUNT' => isset($data['QUOTEAMOUNT']) ? implode(explode(',', $data['QUOTEAMOUNT'])): '0.00',
    //                     'REPRINTREASON' => isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
    //     $noteprintCheck = $printfunc->NoteprintCheck($data['DCNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
    //     $printStatic = $printfunc->NoteprintStatic($Param);
    //     $printDynamic = $printfunc->NoteprintDaynamic($Param);
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
    //     // print_r($noteprintCheck);
    //     // echo '<pre>';
    //     // print_r($data['PRINTSTATIC']);
    //     // echo '</pre>';
    //     // echo '<pre>';
    //     // print_r($data['PRINTDYNAMIC']);
    //     // echo '</pre>';
// }

// function printedVoucher() {
    //     global $data;
    //     $data = getSessionData();
    //     $printfunc = new AccSaleDCNoteEntryRD;
    //     $Param = array( 'DCSVNO' => $data['DCSVNO'],
    //                     'DCNO' => $data['DCNO'],
    //                     'DCDATE' => str_replace('-', '', $data['DCDATE']),
    //                     'CUSTOMERNAME' => $data['CUSTOMERNAME'],
    //                     'DIFF' => $data['DIFF'],
    //                     'T_AMOUNT' => isset($data['T_AMOUNT']) ? implode(explode(',', $data['T_AMOUNT'])): '0.00',
    //                     'REPRINTREASON' => isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
    //     $voucherprintCheck = $printfunc->VoucherprintCheck($data['DCNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
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
    //     // print_r($voucherprintCheck);
    //     // echo '<pre>';
    //     // print_r($data['PRINTSTATIC']);
    //     // echo '</pre>';
    //     // echo '<pre>';
    //     // print_r($data['PRINTDYNAMIC']);
    //     // echo '</pre>';
// }
?>