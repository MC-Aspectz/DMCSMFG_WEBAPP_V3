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
$javaFunc = new AccPayment3Entry3THA;
$systemName = strtolower($appcode);
// Table Row
$minrowA = 0;
$minrowB = 0;
$maxrow = 5;
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
$data = $load;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['RVNO'])) {
        unsetSessionData();
        $data['RVNO'] = isset($_GET['RVNO']) ? $_GET['RVNO']: '';
        $query = $javaFunc->getRvV3($data['RVNO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query[1])) {
            $index = isset($query) ? array_key_first($query) : 1;
            $data = $query[$index];
        } else {
            $data = $query;
        }
        if(!empty($query)) {
            $itempayment = $javaFunc->searchV3($data['RVNO'], $data['RVSVNO'], $data['SUPPLIERCD'], $data['SUPCURCD'], $data['DIVISIONCD'], isset($data['INVOICENOFR']) ? $data['INVOICENOFR']: '', isset($data['INVOICENOTO']) ? $data['INVOICENOTO']: '');
            if(!empty($itempayment)) {
                $data['ITEMPAYMENT'] = $itempayment; 
            }
            $itemacc = $javaFunc->searchJournalV3($data['RVNO'], $data['RVSVNO']);
            if(!empty($itemacc)) {
                $data['ITEMACC'] = $itemacc; 
            }
            // echo '<pre>';
            // print_r($itempayment);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($itemacc);
            // echo '</pre>';
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
        if ($_POST['action'] == 'keepPaymentItemData') { keepPaymentItemData(); }
        if ($_POST['action'] == 'keepAccItemData') { keepAccItemData(); }
        if ($_POST['action'] == 'unsetAccItemData') {  unsetAccItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'SUPPLIERCD') { getSupplier(); }
        if ($_POST['action'] == 'SUPCURCD') { getCurrency(); }
        if ($_POST['action'] == 'DIVISIONCD') { getDiv(); }
        if ($_POST['action'] == 'ACCCD') { getAcc(); }
        if ($_POST['action'] == 'setSelPaid') { setSelPaid(); }
        if ($_POST['action'] == 'setCalcPaid') { setCalcPaid(); }
        if ($_POST['action'] == 'setDCTypV2') { setDCTypV2(); }
        if ($_POST['action'] == 'AmtC2') { AmtC2(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'PVprint') { PVprint(); }
    } else if(isset($_POST['SEARCH'])) {
        $query = $javaFunc->searchV3($_POST['RVNO'], $_POST['RVSVNO'], $_POST['SUPPLIERCD'], $_POST['SUPCURCD'], $_POST['DIVISIONCD'], $_POST['INVOICENOFR'], $_POST['INVOICENOTO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $data['ITEMPAYMENT'] = $query;
        }
    } else if(isset($_POST['SETACC'])) {
        if(!empty($_POST['INVOICENO'])) {
            for ($i = 0 ; $i < count($_POST['INVOICENO']); $i++) { 
                $RowParam[] = array('INVOICENO' => $_POST['INVOICENO'][$i],
                                    'PAYMENTDV_PVNO' => $_POST['PAYMENTDV_PVNO'][$i],
                                    "PAYMENTDV_PVDT" => str_replace("-", "", $_POST['PAYMENTDV_PVDT'][$i]),
                                    'PAYMENTDV_PVAMT' => isset($_POST['PAYMENTDV_PVAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PVAMT'][$i])): '0.00',
                                    'PAYMENTDV_VAT' => isset($_POST['PAYMENTDV_VAT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_VAT'][$i])): '0.00',
                                    'PAYMENTDV_WHT' => isset($_POST['PAYMENTDV_WHT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_WHT'][$i])): '0.00',
                                    'PAYMENTDV_OSTDTTLAMT' => isset($_POST['PAYMENTDV_OSTDTTLAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_OSTDTTLAMT'][$i])): '0.00',
                                    'PAYMENTDV_WHTTYP' => $_POST['PAYMENTDV_WHTTYP'][$i],
                                    'CALCBASE_OSTDAMT' => isset($_POST['CALCBASE_OSTDAMT'][$i]) ? implode(explode(',', $_POST['CALCBASE_OSTDAMT'][$i])): '0.00',
                                    'CALCBASE_VAT' => isset($_POST['CALCBASE_VAT'][$i]) ? implode(explode(',', $_POST['CALCBASE_VAT'][$i])): '0.00',
                                    'CALCBASE_WHT' => isset($_POST['CALCBASE_WHT'][$i]) ? implode(explode(',', $_POST['CALCBASE_WHT'][$i])): '0.00',
                                    'CALCBASE_OSTDTTLAMT' => isset($_POST['CALCBASE_OSTDTTLAMT'][$i]) ? implode(explode(',', $_POST['CALCBASE_OSTDTTLAMT'][$i])): '0.00',
                                    'VATRATE' => isset($_POST['VATRATE'][$i]) ? implode(explode(',', $_POST['VATRATE'][$i])): '0.00',
                                    'WHTRATE' => isset($_POST['WHTRATE'][$i]) ? implode(explode(',', $_POST['WHTRATE'][$i])): '0.00',
                                    'PAYMENTDV_SEL' => $_POST['PAYMENTDV_SEL'][$i],
                                    'PAYMENTDV_PAYAMT' => isset($_POST['PAYMENTDV_PAYAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYAMT'][$i])): '0.00',
                                    'PAYMENTDV_PAYVATAMT' => isset($_POST['PAYMENTDV_PAYVATAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYVATAMT'][$i])): '0.00',
                                    'PAYMENTDV_STATUS' => $_POST['PAYMENTDV_STATUS'][$i],
                                    'PAYMENTDV_PAYVATAMT' => isset($_POST['PAYMENTDV_PAYVATAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYVATAMT'][$i])): '',
                                    'PAYMENTDV_PAYWHTAMT' => isset($_POST['PAYMENTDV_PAYWHTAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYWHTAMT'][$i])): '',
                                    'PAYMENTDV_PAYTTLAMT' => isset($_POST['PAYMENTDV_PAYTTLAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYTTLAMT'][$i])): '');
            }
            $query = $javaFunc->setJournal($_POST['SUPPLIERCD'], $_POST['SUPCURAMTTYP'], $_POST['SUPCURCD'], $_POST['COMCURCD'], $RowParam);
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            if(!empty($query)) {
                $data['ITEMACC'] = $query; 
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
$data['DCTYP'] = isset($data['DCTYP']) ? $data['DCTYP']: 0;
if(empty($data['SUPCURCD'])) {
    $data['SUPCURCD'] = $load['SUPCURCD'];
    $data['SUPCURDISP'] = $load['SUPCURDISP'];
    $data['SUPCURAMTTYP'] = $load['SUPCURAMTTYP'];   
}
$data['INPUTCURDISP'] = $load['SUPCURDISP'];
$data['COMCURCD'] = $load['COMCURCD'];
$data['COMCURDISP'] = $load['COMCURDISP'];
$data['COMCURAMTTYP'] = $load['COMCURAMTTYP'];
$data['SYSMSG'] = $load['SYSMSG'];
$data['STAFFCD'] = $load['STAFFCD'];
$data['STAFFNAME'] = $load['STAFFNAME'];
$data['SYSVIS_COMMIT'] = $load['SYSVIS_COMMIT'];
$data['SYSVIS_CANCEL'] = $load['SYSVIS_CANCEL'];
$data['SYSVIS_INS'] = $load['SYSVIS_INS'];
$data['SYSVIS_UPD'] = $load['SYSVIS_UPD'];
$data['SYSVIS_DEL'] = $load['SYSVIS_DEL'];
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$currebcy = $data['DRPLANG']['CURRENCY'];
$currebcytyp = $data['DRPLANG']['CURRENCYTYP'];
$dctyp = $data['DRPLANG']['DC_TYP'];
$paymentstatus = $data['DRPLANG']['PAYMENTSTATUS'];
$whtatyp = $data['DRPLANG']['WHTAXTYP'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($load);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getSupplier() {
    $javafunc = new AccPayment3Entry3THA;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSupplier($SUPPLIERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new AccPayment3Entry3THA;
    $SUPCURCD = isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '';
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getCurrency($SUPPLIERCD, $SUPCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getDiv() {
    $javafunc = new AccPayment3Entry3THA;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getAcc() {
    $javafunc = new AccPayment3Entry3THA;
    $DCTYP = isset($_POST['DCTYP']) ? $_POST['DCTYP']: '';
    $ACCCD = isset($_POST['ACCCD']) ? $_POST['ACCCD']: '';
    $query = $javafunc->getAcc($ACCCD, $DCTYP);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function commit() {
    $cmtfunc = new AccPayment3Entry3THA;
    $RowParam = array(); $RowPayment = array();
    // PAYMENTDVW
    if(isset($_POST['INVOICENO'])) {
        for ($i = 0 ; $i < count($_POST['PAYMENTDV_PVNO']); $i++) { 
            $RowPayment[] = array(  'INVOICENO' => $_POST['INVOICENO'][$i],
                                    'PAYMENTDV_PVNO' => $_POST['PAYMENTDV_PVNO'][$i],
                                    'PAYMENTDV_WHTTYP' => $_POST['PAYMENTDV_WHTTYP'][$i],
                                    'PAYMENTDV_SEL' => $_POST['PAYMENTDV_SEL'][$i],
                                    'VATRATE' => isset($_POST['VATRATE'][$i]) ? implode(explode(',', $_POST['VATRATE'][$i])): '0.00',
                                    'WHTRATE' => isset($_POST['WHTRATE'][$i]) ? implode(explode(',', $_POST['WHTRATE'][$i])): '0.00',
                                    'PAYMENTDV_PAYAMT' => isset($_POST['PAYMENTDV_PAYAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYAMT'][$i])): '0.00',
                                    'PAYMENTDV_PAYVATAMT' => isset($_POST['PAYMENTDV_PAYVATAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYVATAMT'][$i])): '0.00',
                                    'PAYMENTDV_PAYWHTAMT' => isset($_POST['PAYMENTDV_PAYWHTAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYWHTAMT'][$i])): '0.00',
                                    'PAYMENTDV_PAYTTLAMT' => isset($_POST['PAYMENTDV_PAYTTLAMT'][$i]) ? implode(explode(',', $_POST['PAYMENTDV_PAYTTLAMT'][$i])): '0.00',
                                    'PAYMENTDV_STATUS' => $_POST['PAYMENTDV_STATUS'][$i]);
        }
    }
    // ACC DVW2
    if(isset($_POST['ACCCDA'])) {
        for ($i = 0 ; $i < count($_POST['ACCCDA']); $i++) { 
            $RowParam[] = array('ROWNO' => $i+1,
                                'ACCCD' => $_POST['ACCCDA'][$i],
                                'ACCNM' => $_POST['ACCNMA'][$i],
                                'AMT' => $_POST['AMTA'][$i],
                                'INPUTCURDISP' => $_POST['INPUTCURDISPA'][$i],
                                'EXRATE' => $_POST['EXRATEA'][$i],
                                'ACCAMTC1' => $_POST['ACCAMTC1A'][$i],
                                'ACCAMTC2' => $_POST['ACCAMTC2A'][$i],
                                'DCTYP' => $_POST['DCTYPA'][$i],
                                'CHECKNO' => $_POST['CHECKNOA'][$i],
                                'CHECKDT' => str_replace("-", "", $_POST['CHECKDTA'][$i]),
                                'ACCREM' => $_POST['ACCREMA'][$i],
                                'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                'WHTAXTYP' => $_POST['WHTAXTYPA'][$i]);
        }
    }

    $param = array( 'RVNO' => $_POST['RVNO'],
                    'RVSVNO' => $_POST['RVSVNO'],
                    'ISSUEDT' => str_replace('-', '', $_POST['ISSUEDT']),
                    'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                    'SUPCURCD' => $_POST['SUPCURCD'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'DATA' => $RowParam,
                    'DVW2' => $RowPayment,
                    // 'PAYMENTDVW' => $RowPayment,
                    // 'DVW2' => $RowParam,
                );
    // echo '<pre>';
    // print_r($param);
    // echo '</pre>';
    $tpay = isset($_POST['T_PAY']) ? implode(explode(',', $_POST['T_PAY'])): '';
    $ttlamtc1 = isset($_POST['TTL_AMTC1']) ? implode(explode(',', $_POST['TTL_AMTC1'])): '';
    $ttlamtc2 = isset($_POST['TTL_AMTC2']) ? implode(explode(',', $_POST['TTL_AMTC2'])): '';
    $checkV3 = $cmtfunc->checkV3($tpay, $ttlamtc1, $ttlamtc2, $RowParam);
    // echo '<pre>';
    // print_r($checkV3);
    // echo '</pre>';
    if (str_contains($checkV3, 'ERRO')) {
        // echo json_encode($checkV3);
        // print_r($checkV3);
        echo json_encode($checkV3);
    } else {
        $commitV3 = $cmtfunc->commitV3($param);
        unsetSessionData();
        if(is_array($commitV3)) {
            echo json_encode($commitV3);
        } else {
            echo json_encode($commitV3);
        }
    }
}

function cancel() {
    $cancelfunc = new AccPayment3Entry3THA;
    $cancel = $cancelfunc->cancel($_POST['RVNO'], $_POST['RVSVNO']);
    unsetSessionData();
    echo json_encode($cancel);
}

function PVprint() {
    try {
        $printfunc = new AccPayment3Entry3THA;
        $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
        $Param = array( 'RVNO' => $RVNO,
                        'RVDATE' => !empty($_POST['RVDATE']) ? str_replace('-', '', $_POST['RVDATE']): '',
                        'T_PAY' => !empty($_POST['T_PAY']) ? implode(explode(',', $_POST['T_PAY'])): '0.00',
                        'ISSUEDT' => !empty($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): '',
                        'TTL_AMTC1' => !empty($_POST['TTL_AMTC1']) ? implode(explode(',', $_POST['TTL_AMTC1'])): '0.00',
                        'TTL_AMTC2' => !empty($_POST['TTL_AMTC2']) ? implode(explode(',', $_POST['TTL_AMTC2'])): '0.00');
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_PAYMENTENTRY3_THARD.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $index = isset($printStatic) ? array_key_first($printStatic) : 1;
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic[$index]['PONUM'])
                                            ->setCellValue('B1', $printStatic[$index]['TDATE'])
                                            ->setCellValue('C1', $printStatic[$index]['NAME'])
                                            ->setCellValue('D1', $printStatic[$index]['DSC'])
                                            ->setCellValue('E1', $printStatic[$index]['DDATE'])
                                            ->setCellValue('F1', $printStatic[$index]['AMMON'])
                                            ->setCellValue('G1', $printStatic[$index]['TDEB'])
                                            ->setCellValue('H1', $printStatic[$index]['TCRE'])
                                            ->setCellValue('I1', $printStatic[$index]['NUMB'])
                                            ->setCellValue('J1', $printStatic[$index]['CHEQUEN']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['SEQ'])
                                            ->setCellValue('B'.$key+1, $value['ACCNO'])
                                            ->setCellValue('C'.$key+1, $value['PATI'])
                                            ->setCellValue('D'.$key+1, $value['REM'])
                                            ->setCellValue('E'.$key+1, $value['DEB'])
                                            ->setCellValue('F'.$key+1, $value['CRE'])
                                            ->setCellValue('G'.$key+1, $value['SEC'])
                                            ->setCellValue('H'.$key+1, $value['CHEQUEN'])
                                            ->setCellValue('I'.$key+1, $value['NUMB'])
                                            ->setCellValue('J'.$key+1, $value['TRANST'])
                                            ->setCellValue('K'.$key+1, $value['ROWCOUNTER']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $RVNO.'_PAYMENT_VOUCHER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $RVNO.'_PAYMENT_VOUCHER_'.date('Ymd_Hi').'.pdf';
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
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.1);
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

function setSelPaid() {
    $setfunc = new AccPayment3Entry3THA;
    $setSelPaid = $setfunc->setSelPaid($_POST['SUPCURAMTTYP'], $_POST['PAYMENTDV_SEL'], $_POST['CALCBASE_OSTDAMT'], $_POST['CALCBASE_VAT'], $_POST['CALCBASE_WHT'], $_POST['CALCBASE_OSTDTTLAMT']);
    echo json_encode($setSelPaid);
    // echo "<pre>";
    // print_r($setSelPaid);
    // echo "</pre>";
}

function setCalcPaid() {
    $setfunc = new AccPayment3Entry3THA;
    $Param = array( 'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'SUPCURCD' => $_POST['SUPCURCD'],
                    'CALCBASE_OSTDAMT' => $_POST['CALCBASE_OSTDAMT'],
                    'CALCBASE_VAT' => $_POST['CALCBASE_VAT'],
                    'CALCBASE_WHT' => $_POST['CALCBASE_WHT'],
                    'CALCBASE_OSTDTTLAMT' => $_POST['CALCBASE_OSTDTTLAMT'],
                    'VATRATE' => $_POST['VATRATE'],
                    'WHTRATE' => $_POST['WHTRATE'],
                    'PAYMENTDV_SEL' => $_POST['PAYMENTDV_SEL'],
                    'PAYMENTDV_STATUS' => $_POST['PAYMENTDV_STATUS'],
                    'PAYMENTDV_PAYAMT' => $_POST['PAYMENTDV_PAYAMT'],
                    'PAYMENTDV_PAYWHTAMT' => $_POST['PAYMENTDV_PAYWHTAMT']);
    $setCalcPaid = $setfunc->setCalcPaid($Param);
    echo json_encode($setCalcPaid);
    // echo '<pre>';
    // print_r($setCalcPaid);
    // echo '</pre>';
}

function AmtC2() {
    $setfunc = new AccPayment3Entry3THA;
    if($_POST['AmtC2TYPE'] == '1') {
        $amtC2 = $setfunc->AmtC2Up($_POST['DCTYP'], isset($_POST['BASEAMTC2']) ? implode(explode(',', $_POST['BASEAMTC2'])): '0.00');
    } else {
        $amtC2 = $setfunc->amtC2Down($_POST['DCTYP'], isset($_POST['BASEAMTC2']) ? implode(explode(',', $_POST['BASEAMTC2'])): '0.00');
    }
    echo json_encode($amtC2);
}

function setDCTypV2() {
    $calcfunc = new AccPayment3Entry3THA;
    $Param = array( 'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                    'DCTYP' => $_POST['DCTYP'],
                    'ACCCD' => $_POST['ACCCD'],
                    'AMT' => isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00',
                    'EXRATE' => isset($_POST['EXRATE']) ? number_format(implode(explode(',', $_POST['EXRATE'])), 6, '.', ''): '1.000000',
                    'INPUTCURDISP' => $_POST['INPUTCURDISP']);
    if($_POST['CURFLG'] == 2) { 
        $Param['INPUTCURFLG'] = isset($_POST['INPUTCURFLG']) ? $_POST['INPUTCURFLG']: '';
    }
    $setDCTypV2 = $calcfunc->setDCTypV2($Param);
    echo json_encode($setDCTypV2);
    // echo '<pre>';
    // print_r($Param);
    // echo '</pre>';
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function keepPaymentItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['INVOICENO']); $i++) { 
        $data['ITEMPAYMENT'][$i+1] = array( 'ROWNO' => $i+1,
                                            'INVOICENO' => $_POST['INVOICENO'][$i],
                                            'PAYMENTDV_PVNO' => $_POST['PAYMENTDV_PVNO'][$i],
                                            'PAYMENTDV_PVDT' => $_POST['PAYMENTDV_PVDT'][$i],
                                            'PAYMENTDV_PVAMT' => $_POST['PAYMENTDV_PVAMT'][$i],
                                            'PAYMENTDV_OSTDAMT' => $_POST['PAYMENTDV_OSTDAMT'][$i],
                                            'PAYMENTDV_VAT' => $_POST['PAYMENTDV_VAT'][$i],
                                            'PAYMENTDV_WHT' => $_POST['PAYMENTDV_WHT'][$i],
                                            'PAYMENTDV_OSTDTTLAMT' => $_POST['PAYMENTDV_OSTDTTLAMT'][$i],
                                            'PAYMENTDV_WHTTYP' => $_POST['PAYMENTDV_WHTTYP'][$i],
                                            'CALCBASE_OSTDAMT' => $_POST['CALCBASE_OSTDAMT'][$i],
                                            'CALCBASE_VAT' => $_POST['CALCBASE_VAT'][$i],
                                            'CALCBASE_WHT' => $_POST['CALCBASE_WHT'][$i],
                                            'CALCBASE_OSTDTTLAMT' => $_POST['CALCBASE_OSTDTTLAMT'][$i],
                                            'VATRATE' => $_POST['VATRATE'][$i],
                                            'WHTRATE' => $_POST['WHTRATE'][$i],
                                            'PAYMENTDV_SEL' => $_POST['PAYMENTDV_SEL'][$i],
                                            'PAYMENTDV_PAYAMT' => $_POST['PAYMENTDV_PAYAMT'][$i],
                                            'PAYMENTDV_PAYVATAMT' => $_POST['PAYMENTDV_PAYVATAMT'][$i],
                                            'PAYMENTDV_PAYWHTAMT' => $_POST['PAYMENTDV_PAYWHTAMT'][$i],
                                            'PAYMENTDV_PAYTTLAMT' => $_POST['PAYMENTDV_PAYTTLAMT'][$i],
                                            'PAYMENTDV_STATUS' => $_POST['PAYMENTDV_STATUS'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEMPAYMENT']);
}

function keepAccItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ACCCDA']); $i++) { 
        $data['ITEMACC'][$i+1] = array( 'DCTYP' => $_POST['DCTYPA'][$i],
                                        'ACCCD' => $_POST['ACCCDA'][$i],
                                        'ACCNM' => $_POST['ACCNMA'][$i],
                                        'AMT' => $_POST['AMTA'][$i],
                                        'AMT1' => $_POST['AMT1A'][$i],
                                        'AMT2' => $_POST['AMT2A'][$i],
                                        'INPUTCURDISP' => $_POST['INPUTCURDISPA'][$i],
                                        'EXRATE' => $_POST['EXRATEA'][$i],
                                        'ACCAMTC1' => $_POST['ACCAMTC1A'][$i],
                                        'ACCAMTC2' => $_POST['ACCAMTC2A'][$i],
                                        'BASEAMTC1' => $_POST['BASEAMTC1A'][$i],
                                        'BASEAMTC2' => $_POST['BASEAMTC2A'][$i],
                                        'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                        'WHTAXTYP' => $_POST['WHTAXTYPA'][$i],
                                        'CHECKNO' => $_POST['CHECKNOA'][$i],
                                        'CHECKDT' => $_POST['CHECKDTA'][$i],
                                        'ACCREM' => $_POST['ACCREMA'][$i],);
    }
    setSessionArray($data);
    // print_r($data['ITEMACC']);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'RVNO', 'RVSVNO', 'ISSUEDT', 'SUPPLIERCD', 'SUPPLIERNAME', 'BRANCHKBN', 'BRANCHNO', 'TAXID', 'STAFFCD', 'STAFFNAME', 'SUPCURCD', 'SUPCURDISP', 'SUPCURAMTTYP', 'DIVISIONCD', 'DIVISIONNAME', 'INVOICENOFR', 'INVOICENOTO', 'RVDATE', 'PT_PVAMT', 'PT_OSTDAMT', 'PT_VATAMT', 'PT_WHTAMT', 'PT_OSTDTTLAMT', 'PT_PAYAMT', 'PT_PAYVATAMT', 'T_PAY', 'PT_PAYWHTAMT', 'PT_PAYTTLAMT', 'TTL_AMT1', 'TTL_AMTC1', 'TTL_AMTC2', 'COMCURDISP', 'TAXINVOICENO', 'ROWNO', 'ACCCD', 'ACCNM', 'AMT', 'DCTYP', 'WHTAXTYP', 'INPUTCURDISP', 'EXRATE', 'ACCAMTC1', 'BASEAMTC1', 'ACCAMTC2', 'BASEAMTC2', 'COMCURDISP', 'COMCURCD', 'COMCURAMTTYP', 'CHECKNO', 'CHECKDT', 'ACCREM', 'ITEMPAYMENT', 'ITEMACC', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SYSVIS_INSERT', 'SYSVIS_UPDATE', 'SYSVIS_DELETE', 'SYSEN_STAFFCD', 'SYSEN_DIVISIONCD', 'SYSEN_SUPCURCD', 'SYSEN_INVOICENOFR', 'SYSEN_INVOICENOTO', 'SYSEN_RVDATE', 'SYSEN_PAYMENTDVW', 'SYSEN_DVW2', 'SYSEN_SEARCHACC', 'SYSEN_COMMIT', 'SYSEN_INS', 'SYSEN_UPD', 'SYSEN_DEL', 'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'VATRATE', 'ADD03', 'SUPPLIERFAX', 'SUPPLIERTEL', 'SUPPLIERADDR2', 'SUPPLIERADDR1', 'SYSMSG');

    foreach($arr as $k => $v) {
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

function unsetAccItemData($lineIndex = '') {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEMACC', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEMACC']));
    $data['ITEMACC'] = array_combine(range(1, count($data['ITEMACC'])), array_values($data['ITEMACC']));
    setSessionArray($data);
    $data = getSessionData();
    // keepAccItemData();
    // print_r($data['ITEMACC']);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

// function PVprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccPayment3Entry3THA;
//     $Param = array( 'ISSUEDT' => str_replace('-', '', $data['ISSUEDT']),
//                     'RVDATE' => str_replace('-', '', $data['RVDATE']),
//                     'T_PAY' => isset($data['T_PAY']) ? implode(explode(',', $data['T_PAY'])): '0.00',
//                     'RVNO' => $data['RVNO'],
//                     'TTL_AMTC1' => isset($data['TTL_AMTC1']) ? implode(explode(',', $data['TTL_AMTC1'])): '0.00',
//                     'TTL_AMTC2' => isset($data['TTL_AMTC2']) ? implode(explode(',', $data['TTL_AMTC2'])): '0.00');
//     $printStatic = $printfunc->PVprintStatic($Param);
//     $printDynamic = $printfunc->PVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
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