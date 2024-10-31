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
$javaFunc = new AccSaleEntryMFG;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 6;
$minsearchrow = 0;
$maxsearchrow = 16;

if(!empty($_GET)) {
    if(!empty($_GET['SALETRANNO'])) {
        unsetSessionData();
        $query = $javaFunc->getST($_GET['SALETRANNO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query['SALETRANNO'])) { 
            $query2 = $javaFunc->getST2($query['SALETRANNO']);
            $data = $query;
            if(!empty($query2)) {
                $data['CUSCURCD'] = $query2['CUSCURCD'];
                $data['CUSCURDISP'] = $query2['CUSCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['T_AMOUNT1'] = $query2['T_AMOUNT'];           
            }
            $itemlist = $javaFunc->getSTLn($query['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }
    } else if(!empty($_GET['SALEORDERNO'])) {
        unsetSessionData();
        $query = $javaFunc->getSO($_GET['SALEORDERNO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        $data = $query;
        if(!empty($query['SALEORDERNO'])) {
            $query2 = $javaFunc->getSO2($query['SALEORDERNO'], $query['SALETRANNO']);
            // print_r($query2);
            if(!empty($query2)) {
                $data['CUSCURCD'] = $query2['CUSCURCD'];
                $data['CUSCURDISP'] = $query2['CUSCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['T_AMOUNT1'] = $query2['T_AMOUNT'];           
            }
            $itemlist = $javaFunc->getSOLn($query['SALEORDERNO'], $query['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
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
    if ($_POST['action'] == 'getAmt') { getAmt(); }
    if ($_POST['action'] == 'ITEMCD') { getItem(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'replacez') { replacez(); }
    if ($_POST['action'] == 'setSaleDivCon2') { setSaleDivCon2(); }
    if ($_POST['action'] == 'SVPrint') { saleVoucher(); }
    if ($_POST['action'] == 'IVprint') { invoice(); }
    if ($_POST['action'] == 'TIVprint') { taxInvoice(); }
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
$loadevent = getSystemData($_SESSION['APPCODE'].'_EVENT');
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_EVENT', $loadevent);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['GROUPRT'] = $loadevent['GROUPRT'];
$BRANCH_KBN = $data['DRPLANG']['BRANCH_KBN'];
$CANCELREASON = $data['DRPLANG']['CANCELREASON'];
// setSessionArray($data);
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
function getDivision() {
    $javafunc = new AccSaleEntryMFG;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDivision($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new AccSaleEntryMFG;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    if(!empty($query)) { $data = $query; }
    $data['QUOTEAMOUNT'] = '0.00';
    $data['VATAMOUNT'] = '0.00';
    $data['VATAMOUNT1'] = '0.00';
    $data['T_AMOUNT'] = '0.00';
    $data['T_AMOUNT1'] = '0.00';
    if(!empty($query)) { setSessionArray($data); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new AccSaleEntryMFG;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new AccSaleEntryMFG;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function setSaleDivCon2() {
    $javafunc = new AccSaleEntryMFG;
    $SALEDIVCON2CBO = isset($_POST['SALEDIVCON2CBO']) ? $_POST['SALEDIVCON2CBO']: '';
    $query = $javafunc->setSaleDivCon2($SALEDIVCON2CBO);
    // if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getItem() {
    $javafunc = new AccSaleEntryMFG;
    $Param = array( 'CUSCURCD' => isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'SALEQTY' => '',
                    'UNITPRICE' => '',
                    'DISCRATE' => '', // isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '',
                    'VATRATE' => isset($_POST['VATRATE']) ?  $_POST['VATRATE']: '');
    $index = isset($_POST['index']) ? $_POST['index']: '';
    $query = $javafunc->getItem($Param);
    if(!empty($query)) {
        $data['ITEM'][$index] = array(  'ROWNO' => $index,
                                        'ITEMCD' => $query['ITEMCD'],
                                        'ITEMNAME' => $query['ITEMNAME'],
                                        'SALEQTY' => isset($query['SALEQTY']) ? $query['SALEQTY']: '0.00',
                                        'SALEORDERQTY' => isset($query['SALEORDERQTY']) ? $query['SALEORDERQTY']: '0.00',
                                        'ITEMUNITTYP' => $query['ITEMUNITTYP'],
                                        'SALEUNITPRC' => isset($query['SALEUNITPRC']) ? $query['SALEUNITPRC']: '0.00',
                                        'SALEDISCOUNT' => isset($query['SALEDISCOUNT']) ? $query['SALEDISCOUNT']: '0.00',
                                        'SALEAMT' => isset($query['SALEAMT']) ? $query['SALEAMT']: '0.00',
                                        'SALEDISCOUNT2' => $query['SALEDISCOUNT2'],
                                        'SALETAXAMT' => isset($query['SALETAXAMT']) ? $query['SALETAXAMT']: '0.00',
                                        'SALELN' => isset($query['SALELN']) ? $query['SALELN']: '0.00',
                                        'WHTTYP' => isset($query['WHTTYP']) ? $query['WHTTYP']: '');
        setSessionArray($data);
    }
    echo json_encode($query);
}  

function commit() {
    $RowParam = array();
    $cmtfunc = new AccSaleEntryMFG;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        if($_POST['ITEMCD'][$i] != '' && isset($_POST['ITEMCD'][$i])) {
            $RowParam[] = array('ROWNO' => $i+1,
                                'ITEMCD' => isset($_POST['ITEMCD'][$i]) ? $_POST['ITEMCD'][$i]: '',
                                'ITEMNAME' => isset($_POST['ITEMNAME'][$i]) ? $_POST['ITEMNAME'][$i]: '',
                                'SALEQTY' => !empty($_POST['SALEQTY'][$i]) ? str_replace(',', '', $_POST['SALEQTY'][$i]): '0.00',
                                'SALEORDERQTY' => !empty($_POST['SALEORDERQTY'][$i]) ? str_replace(',', '', $_POST['SALEORDERQTY'][$i]): '0.00',
                                'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP'][$i]) ? $_POST['ITEMUNITTYP'][$i]: '',
                                'SALEUNITPRC' => !empty($_POST['SALEUNITPRC'][$i]) ? str_replace(',', '', $_POST['SALEUNITPRC'][$i]): '0.00',
                                'SALEDISCOUNT' => !empty($_POST['SALEDISCOUNT'][$i]) ? str_replace(',', '', $_POST['SALEDISCOUNT'][$i]): '0.00',
                                'SALEAMT' => !empty($_POST['SALEAMT'][$i]) ? $_POST['SALEAMT'][$i]: '0.00',
                                'SALEDISCOUNT2' => is_array($_POST['SALEDISCOUNT2'][$i]) ? $_POST['SALEDISCOUNT2'][$i]: '0.00',
                                'SALETAXAMT' => !empty($_POST['SALETAXAMT'][$i]) ? str_replace(',', '', $_POST['SALETAXAMT'][$i]): '0.00',
                                'SALELN' => !empty($_POST['SALELN'][$i]) ? str_replace(',', '', $_POST['SALELN'][$i]): '0.00',
                                'SALELNNO' => isset($_POST['SALELNNO'][$i]) ? $_POST['SALELNNO'][$i]: '',
                                'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN'][$i]) ? $_POST['SALEORDERNOLN'][$i]: '',
                                'SHIPTRANNO' => isset($_POST['SHIPTRANNO'][$i]) ? $_POST['SHIPTRANNO'][$i]: '',
                                'SHIPTRANLN' => isset($_POST['SHIPTRANLN'][$i]) ? $_POST['SHIPTRANLN'][$i]: '',
                                'CUSPONO' => isset($_POST['CUSPONO'][$i]) ? $_POST['CUSPONO'][$i]: '',
                                'WHTTYP' => isset($_POST['WHTTYP'][$i]) ? $_POST['WHTTYP'][$i]: '',
                                'SALETRANADD31' => isset($_POST['SALETRANADD31'][$i]) ? $_POST['SALETRANADD31'][$i]: '',
                                'SALETRANADD32' => isset($_POST['SALETRANADD32'][$i]) ? $_POST['SALETRANADD32'][$i]: '',
                                'SALETRANADD33' => isset($_POST['SALETRANADD33'][$i]) ? $_POST['SALETRANADD33'][$i]: '',
                                'SALETRANADD34' => isset($_POST['SALETRANADD34'][$i]) ? $_POST['SALETRANADD34'][$i]: '',
                                'SALETRANADD35' => isset($_POST['SALETRANADD35'][$i]) ? $_POST['SALETRANADD35'][$i]: '');
        }
    }
    // print_r($RowParam);
    $param = array( 'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                    'SVNO' => isset($_POST['SVNO']) ? $_POST['SVNO']: '',
                    'SALETRANSALEDT' => str_replace('-', '', $_POST['SALETRANSALEDT']),
                    'SALETRANINSPDT' => str_replace('-', '', $_POST['SALETRANINSPDT']),
                    'SALEORDERNO' => $_POST['SALEORDERNO'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'DIVISIONNAME' => $_POST['DIVISIONNAME'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'ESTCUSTEL' => $_POST['ESTCUSTEL'],
                    'ESTCUSFAX' => $_POST['ESTCUSFAX'],
                    'ESTCUSSTAFF' => $_POST['ESTCUSSTAFF'],
                    'SALEDIVCON1' => $_POST['SALEDIVCON1'],
                    'SALEDIVCON2' => $_POST['SALEDIVCON2'],
                    'SALEDIVCON3' => $_POST['SALEDIVCON3'],
                    'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                    'DESCRIPTION' => $_POST['DESCRIPTION'],
                    'SALETERM' => $_POST['SALETERM'],
                    'SALECUSMEMO' => $_POST['SALECUSMEMO'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'SALELNDUEDT' => isset($_POST['SALELNDUEDT']) ? str_replace('-', '', $_POST['SALELNDUEDT']) :'',
                    'S_TTL' => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0',
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    'VATRATE' => $_POST['VATRATE'],
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'REPLACEMODE' => isset($_POST['REPLACEMODE']) ? $_POST['REPLACEMODE']: '0',
                    'CANCELSALETRANNO' => isset($_POST['CANCELSALETRANNO']) ? $_POST['CANCELSALETRANNO']: '',
                    'SALEDIVCON2CBO' => isset($_POST['SALEDIVCON2CBO']) ? $_POST['SALEDIVCON2CBO']: '',
                    'DATA' => $RowParam, 'DVW' => '');
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    // if(is_array($commit)) { unsetSessionData(); }
    echo json_encode($commit);
}

function replacez() {
    $replace = array();
    $javafunc = new AccSaleEntryMFG;
    $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
    $query = $javafunc->replace($SALETRANNO);
    if(!empty($query)) { $replace = array_shift($query); }
    echo json_encode($replace);
}

function invoice() {

    try {
        $printfunc = new AccSaleEntryMFG;
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $printInv = $printfunc->printInv($SALETRANNO);        
        // print_r($printInv);
        // exit();
        if(!empty($printInv) && is_array($printInv)) {
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
        } else {
            echo json_encode($printInv);
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
        $printfunc = new AccSaleEntryMFG;
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
        $printfunc = new AccSaleEntryMFG;
        $SVNO = isset($_POST['SVNO']) ? $_POST['SVNO']: '';
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $printVoucher = $printfunc->printVoucher($SALETRANNO, $SVNO);
        // print_r($printVoucher);
        // exit();
        if(!empty($printVoucher) && is_array($printVoucher)) {
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
        } else {
            echo json_encode($printVoucher);
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
    $amtfunc = new AccSaleEntryMFG;
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
        $data['ITEM'][$i+1] = array('ROWNO' => isset($_POST['ROWNO'][$i]) ? $_POST['ROWNO'][$i]: '',
                                    'ITEMCD' => isset($_POST['ITEMCD'][$i]) ? $_POST['ITEMCD'][$i]: '',
                                    'ITEMNAME' => isset($_POST['ITEMNAME'][$i]) ? $_POST['ITEMNAME'][$i]: '',
                                    'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? $_POST['SALEQTY'][$i]: '',
                                    'SALEORDERQTY' => isset($_POST['SALEORDERQTY'][$i]) ? $_POST['SALEORDERQTY'][$i]: '',
                                    'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP'][$i]) ? $_POST['ITEMUNITTYP'][$i]: '',
                                    'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? $_POST['SALEUNITPRC'][$i]: '',
                                    'SALEDISCOUNT' => isset($_POST['SALEDISCOUNT'][$i]) ? $_POST['SALEDISCOUNT'][$i]: '',
                                    'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? $_POST['SALEAMT'][$i]: '',
                                    'SALEDISCOUNT2' => isset($_POST['SALEDISCOUNT2'][$i]) ? $_POST['SALEDISCOUNT2'][$i]: '',
                                    'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? $_POST['SALETAXAMT'][$i]: '',
                                    'SALELNNO' => isset($_POST['SALELNNO'][$i]) ? $_POST['SALELNNO'][$i]: '',
                                    'SALELN' => isset($_POST['SALELN'][$i]) ? $_POST['SALELN'][$i]: '',
                                    'SALEORDERNOLN' => isset($_POST['SALEORDERNOLN'][$i]) ? $_POST['SALEORDERNOLN'][$i]: '',
                                    'SHIPTRANNO' => isset($_POST['SHIPTRANNO'][$i]) ? $_POST['SHIPTRANNO'][$i]: '',
                                    'SHIPTRANLN' => isset($_POST['SHIPTRANLN'][$i]) ? $_POST['SHIPTRANLN'][$i]: '',
                                    'CUSPONO' => isset($_POST['CUSPONO'][$i]) ? $_POST['CUSPONO'][$i]: '',
                                    'WHTTYP' => isset($_POST['WHTTYP'][$i]) ? $_POST['WHTTYP'][$i]: '',
                                    'SALETRANADD31' => isset($_POST['SALETRANADD31'][$i]) ? $_POST['SALETRANADD31'][$i]: '',
                                    'SALETRANADD32' => isset($_POST['SALETRANADD32'][$i]) ? $_POST['SALETRANADD32'][$i]: '',
                                    'SALETRANADD33' => isset($_POST['SALETRANADD33'][$i]) ? $_POST['SALETRANADD33'][$i]: '',
                                    'SALETRANADD34' => isset($_POST['SALETRANADD34'][$i]) ? $_POST['SALETRANADD34'][$i]: '',
                                    'SALETRANADD35' => isset($_POST['SALETRANADD35'][$i]) ? $_POST['SALETRANADD35'][$i]: '');
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SALETRANNO', 'DIVISIONCD', 'DIVISIONNAME', 'SALEISSUEDT', 'CUSTOMERCD', 'BRANCHKBN', 'TAXID', 'CUSCURCD', 'CUSTOMERNAME', 'SALEORDERNO', 'DESCRIPTION',
                        'SALECUSMEMO', 'SALEDIVCON4', 'SALELNDUEDT', 'CUSTADDR1', 'CUSTADDR2', 'ESTCUSSTAFF', 'ESTCUSTEL', 'ESTCUSFAX', 'STAFFCD', 'STAFFNAME', 'SALETERM', 'SVNO',
                        'ITEM', 'CUSCURDISP', 'S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'REPRINTREASON', 'SYSVIS_LOADAPPREPLACE', 'SYSVIS_DUMMYPRT1', 'T_AMOUNT1',
                        'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'SYSMSG', 'SYSVIS_CANCELLBL', 'SUB', 'LDIS', 'AFDIS', 'TOT', 'TVAT',
                        'ROWCOUNTER', 'COMPNTH', 'COMPNEN', 'ADDR1', 'ADDR2', 'ADDREN1', 'ADDREN2', 'TELO', 'FAXO', 'ATNAME', 'PONUM', 'SHDATE', 'SLMAN', 'GROUPRT', 'DIVISIONNAME',
                        'CUSN', 'ADDR10', 'ADDR20', 'CTEL', 'CFAX', 'QONUM', 'TDATE', 'PAYTERM', 'PRVALID', 'QOBY', 'REM1', 'REM2', 'REM3', 'CUR', 'ITEMINV', 'CADDR1', 'CADDR2', 'SONUM',
                        'SYSPVL', 'TXTLANG', 'DRPLANG', 'SALEDIVCON1', 'SALEDIVCON2', 'SALEDIVCON3', 'DEPT', 'DES', 'CDEPT', 'ANUM', 'CTAXID', 'REF', 'SHV', 'SALETRANINSPDT', 'CANCELSALETRANNO',
                        'SYSVIS_REPRINTREASON',  'SYSEN_COMMIT', 'SYSEN_CANCEL', 'SYSEN_DEL', 'SYSEN_SALEORDERNO' , 'SYSEN_CUSCURCD', 'SYSEN_STAFFCD', 'SYSEN_ESTCUSSTAFF', 'SYSEN_SALEDIVCON1', 'SYSEN_SALEDIVCON2', 'SYSEN_SALEDIVCON3', 'SYSEN_SALETERM', 'SYSEN_SALECUSMEMO', 'SYSEN_SALEDIVCON4', 'SYSEN_DVW', 'SYSEN_SALETRANPLANRECMONEYDT', 'SYSVIS_REPRINTLBL', 'SYSEN_DESCRIPTION', 'SYSEN_REPRINTREASON',
                        'SYSVIS_DUMMYPRT2', 'SYSEN_DIVISIONCD', 'SYSEN_CUSTOMERCD', 'ADDRTH', 'ADDREN', 'TELO', 'FAXO', 'TAXNO', 'ITEMPAGE', 'ITEMTAXINV', 'LOADPRINT', 'TAXINV', 'SVSTATIC', 'SVDYNAMIC', 'SYSVIS_CANCELSALETRANNO', 'SALETRANSALEDT', 'SALETRANPLANRECMONEYDT', 'SYSVIS_PRINTINV', 'SYSEN_PRINTINV', 'SYSVIS_PRINTTAXINV', 'SYSEN_PRINTTAXINV', 'SYSVIS_PRINTVOU', 'SYSEN_PRINTVOU', 'SYSVIS_REPLACE', 'SYSEN_REPLACE', 'REPLACEMODE', 'LOADSOFLG', 'SYSVIS_SALEDIVCON2CBO', 'SYSVIS_SALEDIVCON2', 'SYSVIS_CANCELSALETRANNO', 'SYSEN_VATRATE', 'SYSEN_DISCRATE');
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

// function invoice() {
//     global $data;
//     $data = getSessionData();
//     $invfunc = new AccSaleEntryMFG;
//     if(!empty($data['SALETRANNO'])) {
//         $param = array( 'SALETRANNO' => $data['SALETRANNO'],
//                         'REPRINTREASON' => $data['REPRINTREASON']);
//         $inv = $invfunc->IVprintStatic($param);
//         $invoice = $invfunc->IVprintDynamic($param);
//         $data = $inv;
//         // echo '<pre>';
//         // print_r($inv);
//         // echo '</pre>';
//         // echo '<pre>';
//         // print_r($invoice);
//         // echo '</pre>';
//         if(!empty($invoice)) {
//             if(empty($invoice['ROWCOUNTER'])) {
//                 for ($i = 1 ; $i < count($invoice)+1; $i++) {
//                     $data['ITEMINV'][$i] = $invoice[$i];
//                     $data['ITEMPAGE'][$invoice[$i]['IDXNO']] = $invoice[$i];
//                 }
              
//             } else {
//                 $data['ITEMPAGE'][$invoice['IDXNO']] = $invoice; 
//                 $data['ITEMINV'][$invoice['IDXNO']] = $invoice; 
//             }
//         }
//         setSessionArray($data);
//         $data = getSessionData();
//     }
//     // echo '<pre>';
//     // print_r($data);
//     // echo '</pre>';
// }

// function invoiceTax() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccSaleEntryMFG;
//     if(!empty($data['SALETRANNO'])) {
//         $param = array( 'SALETRANNO' => $data['SALETRANNO'],
//                         'REPRINTREASON' => $data['REPRINTREASON']);
//         // $printCheck = $printfunc->IVprintCheck($param);
//         $invtax = $printfunc->TIVprintStatic($param);
//         $invoicetax = $printfunc->TIVprintDynamic($param);
//         $data = $invtax;
//         if(!empty($invoicetax)) {
//             if(empty($invoicetax['IDXNO'])) {
//                 for ($i = 1 ; $i < count($invoicetax)+1; $i++) {
//                     $data['ITEMTAXINV'][$i] = $invoicetax[$i];
//                 }
//             } else {
//                 $data['ITEMTAXINV'][$invoicetax['NUM']] = $invoicetax; 
//             }
//         }
//         setSessionArray($data);
//         $data = getSessionData();
//     }
//     // echo '<pre>';
//     // print_r($data);
//     // echo '</pre>';
// }
?>