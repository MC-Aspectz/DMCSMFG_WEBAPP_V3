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
$javaFunc = new AccReceivePurchaseTHA;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 8;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['PVNO'])) {
        unsetSessionData();
        $data['PVNO'] = isset($_GET['PVNO']) ? $_GET['PVNO']: '';
        $query = $javaFunc->getPV($data['PVNO']);
        $data = $query;
        if(isset($query['PVNO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $data['VATAMOUNT2'] = $query['VATAMOUNT1'];
            $query2 = $javaFunc->getPV2($query['PVNO']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            if(!empty($query2)) {
                $data['SUPCURCD'] = $query2['SUPCURCD'];
                $data['SUPCURDISP'] = $query2['SUPCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
            }
            $itemlist = $javaFunc->getPVLn($query['PVNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist; 
            }
        }
    } else if(!empty($_GET['PONO'])) {
        unsetSessionData();
        $data['PONO'] = isset($_GET['PONO']) ? $_GET['PONO']: '';
        $query = $javaFunc->getPO($data['PONO']);
        $data = $query;
        if(isset($query['PONO'])) { 
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $data['VATAMOUNT2'] = $query['VATAMOUNT1'];
            $query2 = $javaFunc->getPO2($query['PONO']);
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            if(!empty($query2)) {
                $data['SUPCURCD'] = $query2['SUPCURCD'];
                $data['SUPCURDISP'] = $query2['SUPCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
            }
            $itemlist = $javaFunc->getPOLn($query['PONO']);
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
        if ($_POST['action'] == 'ADD11') { chkSupInvoiceDt(); }
        if ($_POST['action'] == 'INSPDT') { chkSupInvoiceDt(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'checkDistribute') { checkDistribute(); }
        if ($_POST['action'] == 'checkIEAmt') { checkIEAmt(); }
        if ($_POST['action'] == 'distribute') { distribute(); }
        if ($_POST['action'] == 'getVatAmtUp') { getVatAmtUp(); }
        if ($_POST['action'] == 'getVatAmtDown') { getVatAmtDown(); }
        if ($_POST['action'] == 'PURCHV') { purchaseVoucher(); }
    }
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
$iecalcmethod = $data['DRPLANG']['IECALCMETHOD'];
$fifoflg = $data['DRPLANG']['FIFOFLG'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getDiv() {
    $javafunc = new AccReceivePurchaseTHA;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getSupplier() {
    $javafunc = new AccReceivePurchaseTHA;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSupplier($SUPPLIERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new AccReceivePurchaseTHA;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new AccReceivePurchaseTHA;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $SUPCURCD = isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '';
    $query = $javafunc->getCurrency($SUPPLIERCD, $SUPCURCD);
    if(!empty($query)) { chk_currency($query['SUPCURCD']); setSessionArray($query); }
    echo json_encode($query);
}  

function chkSupInvoiceDt() {
    $javafunc = new AccReceivePurchaseTHA;
    $ADD11 = isset($_POST['ADD11']) ? str_replace('-', '', $_POST['ADD11']): date('Ymd');
    $INSPDT = isset($_POST['INSPDT']) ? str_replace('-', '', $_POST['INSPDT']): date('Ymd');
    $ISSUEDT = isset($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): date('Ymd');
    $query = $javafunc->chkSupInvoiceDt($ADD11, $INSPDT, $ISSUEDT);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getItem() {
    $javafunc = new AccReceivePurchaseTHA;
    $Param = array( 'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    'SUPCURCD' => isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '',
                    'ITEMCD' => isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '',
                    'PURQTY' => '',
                    'DISCRATE' => '',
                    'VATRATE' => isset($_POST['VATRATE']) ?  $_POST['VATRATE']: '');
    $index = isset($_POST['index']) ? $_POST['index']: '';
    $query = $javafunc->getItem($Param);
    if(!empty($query)) {
        $data['ITEM'][$index] = array(  'ROWNO' => $index,
                                        'ITEMCD' => isset($query['ITEMCD']) ? $query['ITEMCD']: '',
                                        'ITEMNAME' => isset($query['ITEMNAME']) ? $query['ITEMNAME']: '',
                                        'PURQTY' => '0.00',
                                        'ITEMUNITTYP' => is_array($query['ITEMUNITTYP']) ? $query['ITEMUNITTYP']: '',
                                        'PURUNITPRC' => isset($query['PURUNITPRC']) ? $query['PURUNITPRC']: '0.00',
                                        'PURAMT' => isset($query['PURAMT']) ? $query['PURAMT']: '0.00',
                                        'DISCOUNT' => isset($query['DISCOUNT']) ? $query['DISCOUNT']: '0.00',
                                        'DISCOUNT2' => is_array($query['DISCOUNT2']) ? $query['DISCOUNT2']: '',
                                        'FIFOFLG' => is_array($query['FIFOFLG']) ? $query['FIFOFLG']: '',
                                        'IEAMT' => isset($query['IEAMT']) ? $query['IEAMT']: '',
                                        'VATAMT' => isset($query['VATAMT']) ? $query['VATAMT']: '0.00',
                                        'CALCIE' => is_array($query['CALCIEMETHOD']) ? $query['CALCIEMETHOD']: '',
                                        'PURLN' => isset($query['PURLN']) ? $query['PURLN']: '');
        setSessionArray($data);
    }
    echo json_encode($query);
} 

function commit() {
    $SYSMSG = 'NOTITEM'; $RowParam = array();
    $cmtfunc = new AccReceivePurchaseTHA;
    $PVNO = isset($_POST['PVNO']) ? $_POST['PVNO']: '';
    $ADD05 = isset($_POST['ADD05']) ? $_POST['ADD05']: '';
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $ADD11 = isset($_POST['ADD11']) ? str_replace('-', '', $_POST['ADD11']): '';
    if(!empty($_POST['ITEMCD']) && $_POST['ITEMCD'][0] != '') {
        for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
            if($_POST['ITEMCD'][$i] != '' && isset($_POST['ITEMCD'][$i])) {
                $RowParam[] = array('ROWNO' => $i + 1,
                                    'ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'PURQTY' => !empty($_POST['PURQTY'][$i]) ? str_replace(',', '', $_POST['PURQTY'][$i]): '0.00',
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'PURUNITPRC' => !empty($_POST['PURUNITPRC'][$i]) ? str_replace(',', '', $_POST['PURUNITPRC'][$i]): '0.00',
                                    'PURAMT' => isset($_POST['PURAMT'][$i]) ? $_POST['PURAMT'][$i]: '0.00',
                                    'PURORDERQTY' => !empty($_POST['PURORDERQTY'][$i]) ? str_replace(',', '', $_POST['PURORDERQTY'][$i]): '0.00',
                                    'DISCOUNT' => !empty($_POST['DISCOUNT'][$i]) ? str_replace(',', '', $_POST['DISCOUNT'][$i]): '0.00',
                                    'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                                    'FIFOFLG' => $_POST['FIFOFLG'][$i],
                                    'IEAMT' => isset($_POST['IEAMT'][$i]) ? implode(explode(',', $_POST['IEAMT'][$i])): '',
                                    'VATAMT' => isset($_POST['VATAMT'][$i]) ? $_POST['VATAMT'][$i]: '0.00',
                                    'CALCIE' => isset($_POST['CALCIE'][$i]) ? $_POST['CALCIE'][$i]: '',
                                    'PURLN' => isset($_POST['PURLN'][$i]) ? $_POST['PURLN'][$i]: '');
            }
        }    

        $param = array( 'PONO' => isset($_POST['PONO']) ? $_POST['PONO']: '',
                        'PVNO' => isset($_POST['PVNO']) ? $_POST['PVNO']: '',
                        'SVNO' => isset($_POST['SVNO']) ? $_POST['SVNO']: '',
                        'ISSUEDT' => isset($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): '',
                        'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                        'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                        'SUPCURCD' => isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '',
                        'SUPPLIERTEL' => isset($_POST['SUPPLIERTEL']) ? $_POST['SUPPLIERTEL']: '',
                        'SUPPLIERFAX' => isset($_POST['SUPPLIERFAX']) ? $_POST['SUPPLIERFAX']: '',
                        'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                        'INVOICENO' => isset($_POST['INVOICENO']) ? $_POST['INVOICENO']: '',
                        'ADD03' => isset($_POST['ADD03']) ? $_POST['ADD03']: '',
                        'ADD04' => isset($_POST['ADD04']) ? $_POST['ADD04']: '',
                        'ADD05' => isset($_POST['ADD05']) ? $_POST['ADD05']: '',
                        'ADD11' => isset($_POST['ADD11']) ? str_replace('-', '', $_POST['ADD11']): '',
                        'ADD12' => isset($_POST['ADD12']) ? $_POST['ADD12']: '',
                        'INSPDT' => isset($_POST['INSPDT']) ? str_replace('-', '', $_POST['INSPDT']): '',
                        // 'PURDUEDT' => isset($_POST['PURDUEDT']) ? str_replace('-', '', $_POST['PURDUEDT']): '',
                        'REM' => isset($_POST['REM']) ? $_POST['REM']: '',
                        'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '',
                        'VATRATE' => isset($_POST['VATRATE']) ? $_POST['VATRATE']: '',
                        'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? $_POST['VATAMOUNT1']: '',
                        'DVW' => '',
                        'DATA' => $RowParam);
        // print_r($param);
        // exit();
        $checkDt = $cmtfunc->checkDt($PVNO, $SUPPLIERCD, $ADD05, $ADD11);
        // print_r($checkDt);
        if(is_array($checkDt)) {
            $commit = $cmtfunc->commit($param);
            $showMsg1 = $cmtfunc->ShowMsg1();
            $SYSMSG = isset($showMsg1['SYSMSG'])? $showMsg1['SYSMSG']: '';
            // print_r($commit['PVNO']);
            // print_r($commit);
            if(is_array($commit)) { unsetSessionData(); }
        } else {
            // INV240900010
            // $SYSMSG = 'ERRODUPLICATESUPINVOICE';
            $SYSMSG = $checkDt; 
        }
    }

    $response = array(  'PVNO' => isset($commit['PVNO']) ? $commit['PVNO']: '',
                        'SVNO' => isset($commit['SVNO']) ? $commit['SVNO']: '',
                        'ROWCOUNTER' => isset($checkDt['ROWCOUNTER']) ? $checkDt['ROWCOUNTER']: '',
                        'SUPINVCNT' => isset($checkDt['SUPINVCNT']) ? $checkDt['SUPINVCNT']: '',
                        'SYSMSG' => $SYSMSG);
    // print_r($response);
    echo json_encode($response);
}

function cancel() {
    $cancelfunc = new AccReceivePurchaseTHA;
    $cancel = $cancelfunc->cancel($_POST['PVNO'], $_POST['SVNO']);
    unsetSessionData();
}

function distribute() {

    $distributefunc = new AccReceivePurchaseTHA;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $DVW[] = array( 'ROWNO' => $i + 1,
                        'ITEMCD' => $_POST['ITEMCD'][$i],
                        'ITEMNAME' => $_POST['ITEMNAME'][$i],
                        'PURQTY' => isset($_POST['PURQTY'][$i]) ? implode(explode(',', $_POST['PURQTY'][$i])): '0.00',
                        'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                        'PURUNITPRC' => isset($_POST['PURUNITPRC'][$i]) ? implode(explode(',', $_POST['PURUNITPRC'][$i])): '0.00',
                        'PURAMT' => isset($_POST['PURAMT'][$i]) ? implode(explode(',', $_POST['PURAMT'][$i])): '0.00',
                        'DISCOUNT' => isset($_POST['DISCOUNT'][$i]) ? implode(explode(',', $_POST['DISCOUNT'][$i])): '0.00',
                        'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                        'FIFOFLG' => $_POST['FIFOFLG'][$i],
                        'IEAMT' => isset($_POST['IEAMT'][$i]) ? implode(explode(',', $_POST['IEAMT'][$i])): '',
                        'VATAMT' => isset($_POST['VATAMT'][$i]) ? $_POST['VATAMT'][$i]: '0.00',
                        'CALCIE' => $_POST['CALCIE'][$i],
                        'PURLN' => isset($_POST['PURLN']) ? $_POST['PURLN']: '');
    }

    $distribute = $distributefunc->calcIncidentalExp($_POST['SUPCURCD'], $DVW);
    // print_r($distribute);
    // unsetSessionData();
    echo json_encode($distribute);
}
  
function purchaseVoucher() {

    try {
        $printfunc = new AccReceivePurchaseTHA;
        $PVNO = isset($_POST['PVNO']) ? $_POST['PVNO']: '';
        $Param = array( 'PVNO' => $PVNO,
                        'SVNO' => isset($_POST['SVNO']) ? $_POST['SVNO']: '',
                        'INSPDT' => !empty($_POST['INSPDT']) ? str_replace('-', '', $_POST['INSPDT']): '',
                        'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                        'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME']) ? $_POST['SUPPLIERNAME']: '',
                        'REM' => isset($_POST['REM']) ? $_POST['REM']: '',
                        'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? $_POST['T_AMOUNT']: '',
                        'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? $_POST['VATAMOUNT1']: '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        $printStatic = $printfunc->PVprintStatic($Param);
        $printDynamic = $printfunc->PVprintDynamic($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_RECEIVEPURCHASE_THA.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------
            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPN'])
                                        ->setCellValue('B1', $printStatic['RPTTITLE1'])
                                        ->setCellValue('C1', $printStatic['RPTTITLE2'])
                                        ->setCellValue('D1', $printStatic['PVNO'])
                                        ->setCellValue('E1', $printStatic['TDATE'])
                                        ->setCellValue('F1', $printStatic['PUFROM'])
                                        ->setCellValue('G1', $printStatic['SUPCD'])
                                        ->setCellValue('H1', $printStatic['DESCRIPT'])
                                        ->setCellValue('I1', $printStatic['AMMON'])
                                        ->setCellValue('J1', $printStatic['TDEB'])
                                        ->setCellValue('K1', $printStatic['TCRE'])
                                        ->setCellValue('L1', $printStatic['TDEBEN'])
                                        ->setCellValue('M1', $printStatic['TDEBTH'])
                                        ->setCellValue('N1', $printStatic['ROWCOUNTER']);

            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                                           
            $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1,  $value['ROWCOUNTER'])
                                        ->setCellValue('B'.$key+1, $value['SEQ'])
                                        ->setCellValue('C'.$key+1, $value['ACCNO'])
                                        ->setCellValue('D'.$key+1, $value['PATI'])
                                        ->setCellValue('E'.$key+1, $value['REM'])
                                        ->setCellValue('F'.$key+1, $value['DEB'])
                                        ->setCellValue('G'.$key+1, $value['CRE'])
                                        ->setCellValue('H'.$key+1, $value['SEC']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $PVNO.'_PURCHASE_VOUCHER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $PVNO.'_PURCHASE_VOUCHER_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            $sheetPDF = PHPExcel_IOFactory::load($report_path);
            $sheetPDF->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetPDF->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetPDF->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetPDF->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetPDF->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetPDF->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF->getActiveSheet()->setShowGridLines(false);

            $sheetPDF->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetPDF->getActiveSheet()->getPageMargins()->setLeft(0.2);
            $sheetPDF->getActiveSheet()->getPageMargins()->setRight(0.5);           
            $sheetPDF->getActiveSheet()->getPageMargins()->setBottom(0.5);

            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF, 'PDF');
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
        } else {
            echo json_encode('ERRONOTFOUNDPRINTDATA');
        }
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function chk_currency($SUPCURCD) {
    // print_r($_POST);
    $chk_curfunc = new AccReceivePurchaseTHA;
    $chk_currency = $chk_curfunc->chk_currency($SUPCURCD);
    // print_r($chk_currency);
    // echo json_encode($chk_currency);
}

function checkDistribute() {
    // print_r($_POST);
    $checkdtbfunc = new AccReceivePurchaseTHA;
    $checkDistribute = $checkdtbfunc->checkDistribute($_POST['ITEMCD_DVW'], $_POST['FIFOFLG_DVW']);
    // print_r($checkDistribute);
    echo json_encode($checkDistribute);
}

function checkIEAmt() {
    // print_r($_POST);
    $checkIEAmtfunc = new AccReceivePurchaseTHA;
    $checkIEAmt = $checkIEAmtfunc->checkIEAmt($_POST['FIFOFLG_DVW'], $_POST['IEAMT_DVW']);
    // print_r($checkIEAmt);
    echo json_encode($checkIEAmt);
}

function getVatAmtUp() {
    // print_r($_POST);
    $vatAmtUp = new AccReceivePurchaseTHA;
    $getVatAmtUp = $vatAmtUp->getVatAmtUp(isset($_POST['VATAMOUNT2']) ? implode(explode(',', $_POST['VATAMOUNT2'])): '0.00');
    // print_r($getVatAmtUp);
    echo json_encode($getVatAmtUp);
}

function getVatAmtDown() {
    // print_r($_POST);
    $vatAmtDown = new AccReceivePurchaseTHA;
    $getVatAmtDown = $vatAmtDown->getVatAmtDown(isset($_POST['VATAMOUNT2']) ? implode(explode(',', $_POST['VATAMOUNT2'])): '0.00');
    // print_r($getVatAmtDown);
    echo json_encode($getVatAmtDown);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {
    global $data;
    if(!empty($_POST['ITEMCD'])) {
        for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
            $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                        'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                        'PURQTY' => $_POST['PURQTY'][$i],
                                        'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                        'PURUNITPRC' => $_POST['PURUNITPRC'][$i],
                                        'PURAMT' => $_POST['PURAMT'][$i],
                                        'DISCOUNT' => $_POST['DISCOUNT'][$i],
                                        'DISCOUNT2' => $_POST['DISCOUNT2'][$i],
                                        'FIFOFLG' => $_POST['FIFOFLG'][$i],
                                        'IEAMT' => $_POST['IEAMT'][$i],
                                        'VATAMT' => $_POST['VATAMT'][$i],
                                        'CALCIE' => $_POST['CALCIE'][$i],
                                        'PURLN' => $_POST['PURLN'][$i]);
        }
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function setSessionArray($arr){
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'PVNO', 'PONO', 'ISSUEDT', 'DIVISIONCD', 'DIVISIONNAME', 'SUPPLIERCD', 'SUPPLIERNAME', 'BRANCHNO', 'SVNO',
                        'BRANCHKBN', 'TAXID', 'SUPCURCD', 'SUPCURDISP', 'SUPPLIERADDR1', 'SUPPLIERADDR2', 'SUPPLIERTEL', 'SUPPLIERFAX', 'STAFFCD', 'STAFFNAME', 'PURDUEDT', 'INSPDT',
                        'ADD03', 'ADD04', 'ADD05', 'ADD11', 'ADD12', 'S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'VATAMOUNT2', 'GROUPRT', 'REM',
                        'SYSEN_ISSUE', 'SYSEN_INSPDT', 'SYSEN_PONO', 'SYSEN_DIVISIONCD', 'SYSEN_SUPPLIERCD', 'SYSEN_SUPCURCD', 'SYSEN_STAFFCD', 'SYSEN_REM',
                        'SYSEN_ADD03', 'SYSEN_ADD04','SYSEN_ADD05', 'SYSEN_ADD11', 'SYSEN_VATRATE', 'SYSEN_DISCRATE', 'SYSEN_COMMIT', 'SYSEN_DVW', 'SYSVIS_DUMMYPRT1',
                        'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSVIS_REPRINTREASON', 'SYSVIS_INVOICEDATEOVER', 'SYSVIS_REPRINTLBL', 'SYSEN_REPRINTREASON');
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
//     $printfunc = new AccReceivePurchaseTHA;
//     $Param = array( 'SVNO' => $data['SVNO'],
//                     'PVNO' => $data['PVNO'],
//                     'INSPDT' => str_replace('-', '', $data['INSPDT']),
//                     'SUPPLIERCD' => $data['SUPPLIERCD'],
//                     'SUPPLIERNAME' => $data['SUPPLIERNAME'],
//                     'REM' => isset($data['REM']) ? $data['REM']: '',
//                     'T_AMOUNT' => $data['T_AMOUNT'],
//                     'VATAMOUNT1' => $data['VATAMOUNT1'],
//                     'REPRINTREASON' => isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');

//     $printStatic = $printfunc->PVprintStatic($Param);
//     $printDynamic = $printfunc->PVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic) && is_array($printDynamic)) {
//         if(empty($printDynamic['ROWCOUNTER'])) {
//             for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//                 $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//             }
//         } else {
//             $data['PRINTDYNAMIC'][$printDynamic['ROWCOUNTER']] = $printDynamic; 
//         }
//         setSessionArray($data);
//     } else {
//         echo json_encode($printDynamic);
//     }
//     // echo '<pre>';
//     // print_r($data);
//     // echo '</pre>';
// }
?>