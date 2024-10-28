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
$javaFunc = new AccOutStandingAP;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 16;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    // 
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'getElement') { getElement(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }  
        if ($_POST['action'] == 'printAP') { printAP(); }  
    }
    if (isset($_POST['SEARCH'])) { SearchDataOutStdAP(); }
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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$currency = $data['DRPLANG']['CURRENCY'];
$paymentstatus = $data['DRPLANG']['PAYMENTSTATUS'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getElement() {

    if(isset($_POST['SUPPLIERCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['SUPPLIERFR'] = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD'] : '';
        } else {
            $data['SUPPLIERTO'] = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD'] : '';
        }
    } else if(isset($_POST['INVNO']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['SUPPINVNOFR'] = isset($_POST['INVNO']) ? $_POST['INVNO'] : '';
        } else {
            $data['SUPPINVNOTO'] = isset($_POST['INVNO']) ? $_POST['INVNO'] : '';
        }
    } else if(isset($_POST['DIVISIONCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['DEPARTMENTFR'] = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD'] : '';
        } else {
            $data['DEPARTMENTTO'] = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD'] : '';
        }
    } else if(isset($_POST['STAFFCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['STAFFFR'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD'] : '';
        } else {
            $data['STAFFTO'] = isset($_POST['STAFFCD']) ? $_POST['STAFFCD'] : '';
        }
    } else if(isset($_POST['CURRENCYCD'])) {
        $data['CURRENCY'] = isset($_POST['CURRENCYCD']) ? $_POST['CURRENCYCD'] : '';
    }

    setSessionArray($data); 

    // if(checkSessionData()) { $data = getSessionData(); }

    echo json_encode($data);
}  

function SearchDataOutStdAP() {
    global $data; $data['ITEM'] = array();
    $data = getSessionData();
    $searchfunc = new AccOutStandingAP;
    $PAYMENTSTATUS = isset($_POST['PAYMENTSTATUS']) ? $_POST['PAYMENTSTATUS']: '';
    $param = array( 'PAYMENTSTATUS' => isset($_POST['PAYMENTSTATUS']) ? $_POST['PAYMENTSTATUS']: '',
                    'DUEDATEFR' => isset($_POST['DUEDATEFR']) ? str_replace('-', '', $_POST['DUEDATEFR']): '',
                    'DUEDATETO' => isset($_POST['DUEDATETO']) ? str_replace('-', '', $_POST['DUEDATETO']): '',
                    'VOUCHERDTFR' => isset($_POST['VOUCHERDTFR']) ? str_replace('-', '', $_POST['VOUCHERDTFR']): '',
                    'VOUCHERDTTO' => isset($_POST['VOUCHERDTTO']) ? str_replace('-', '', $_POST['VOUCHERDTTO']): '',
                    'SUPPINVNOFR' => isset($_POST['SUPPINVNOFR']) ? $_POST['SUPPINVNOFR']: '',
                    'SUPPINVNOTO' => isset($_POST['SUPPINVNOTO']) ? $_POST['SUPPINVNOTO']: '',
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'DEPARTMENTFR' => isset($_POST['DEPARTMENTFR']) ? $_POST['DEPARTMENTFR']: '',
                    'DEPARTMENTTO' => isset($_POST['DEPARTMENTTO']) ? $_POST['DEPARTMENTTO']: '',
                    'SUPPINVDTFR' => isset($_POST['SUPPINVDTFR']) ? str_replace('-', '', $_POST['SUPPINVDTFR']): '',
                    'SUPPINVDTTO' => isset($_POST['SUPPINVDTTO']) ?  str_replace('-', '', $_POST['SUPPINVDTTO']): '',
                    'SUPPLIERFR' => isset($_POST['SUPPLIERFR']) ? $_POST['SUPPLIERFR']: '',
                    'SUPPLIERTO' => isset($_POST['SUPPLIERTO']) ? $_POST['SUPPLIERTO']: '',
                    'VOUCHERNOFR' => isset($_POST['VOUCHERNOFR']) ? $_POST['VOUCHERNOFR']: '',
                    'VOUCHERNOTO' => isset($_POST['VOUCHERNOTO']) ? $_POST['VOUCHERNOTO']: '',
                    'STAFFFR' => isset($_POST['STAFFFR']) ? $_POST['STAFFFR']: '',
                    'STAFFTO' => isset($_POST['STAFFTO']) ? $_POST['STAFFTO']: '');
    $searchDataOutStdAP = $searchfunc->SearchDataOutStdAP($param);
    // print_r($searchDataOutStdAP);
    if(!empty($searchDataOutStdAP)) {
        $upTmpOutStdAP1 = $searchfunc->UpTmpOutStdAP1($searchDataOutStdAP);
        $searchDataPay = $searchfunc->SearchDataPay();
        $upTmpPay = $searchfunc->UpTmpPay($searchDataPay);
        $calDataOutStd = $searchfunc->CalDataOutStd();
        $upTmpOutStd = $searchfunc->UpTmpOutStd($calDataOutStd);
        $getTmpOutStdAP1 = $searchfunc->GetTmpOutStdAP1($PAYMENTSTATUS);
        $upTmpOutStdAP2 = $searchfunc->UpTmpOutStdAP2($getTmpOutStdAP1);
        $sumBySuppCurr = $searchfunc->SumBySuppCurr();
        $upTmpOutStdAR2Sum = $searchfunc->UpTmpOutStdAP2Sum($sumBySuppCurr);
        $getTmpOutStdAP2 = $searchfunc->GetTmpOutStdAP2();
        if(!empty($getTmpOutStdAP2)) {
            $data['ITEM'] = $getTmpOutStdAP2;
        }
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($getTmpOutStdAP2);
    // echo '</pre>';
}

function printAP() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccOutStandingAP;
    $param = array( 'PAYMENTSTATUS' => isset($_POST['PAYMENTSTATUS']) ? $data['PAYMENTSTATUS']: '',
                    'DUEDATEFR' => isset($_POST['DUEDATEFR']) ? str_replace('-', '', $_POST['DUEDATEFR']): '',
                    'DUEDATETO' => isset($_POST['DUEDATETO']) ? str_replace('-', '', $_POST['DUEDATETO']): '',
                    'VOUCHERDTFR' => isset($_POST['VOUCHERDTFR']) ? str_replace('-', '', $_POST['VOUCHERDTFR']): '',
                    'VOUCHERDTTO' => isset($_POST['VOUCHERDTTO']) ? str_replace('-', '', $_POST['VOUCHERDTTO']): '',
                    'SUPPINVNOFR' => isset($_POST['SUPPINVNOFR']) ? $_POST['SUPPINVNOFR']: '',
                    'SUPPINVNOTO' => isset($_POST['SUPPINVNOTO']) ? $_POST['SUPPINVNOTO']: '',
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'DEPARTMENTFR' => isset($_POST['DEPARTMENTFR']) ? $_POST['DEPARTMENTFR']: '',
                    'DEPARTMENTTO' => isset($_POST['DEPARTMENTTO']) ? $_POST['DEPARTMENTTO']: '',
                    'SUPPINVDTFR' => isset($_POST['SUPPINVDTFR']) ? str_replace('-', '', $_POST['SUPPINVDTFR']): '',
                    'SUPPINVDTTO' => isset($_POST['SUPPINVDTTO']) ?  str_replace('-', '', $_POST['SUPPINVDTTO']): '',
                    'SUPPLIERFR' => isset($_POST['SUPPLIERFR']) ? $_POST['SUPPLIERFR']: '',
                    'SUPPLIERTO' => isset($_POST['SUPPLIERTO']) ? $_POST['SUPPLIERTO']: '',
                    'VOUCHERNOFR' => isset($_POST['VOUCHERNOFR']) ? $_POST['VOUCHERNOFR']: '',
                    'VOUCHERNOTO' => isset($_POST['VOUCHERNOTO']) ? $_POST['VOUCHERNOTO']: '',
                    'STAFFFR' => isset($_POST['STAFFFR']) ? $_POST['STAFFFR']: '',
                    'STAFFTO' => isset($_POST['STAFFTO']) ? $_POST['STAFFTO']: '');
    // print_r($param);
    $printStatic = $printfunc->PrintStatic($param);
    $printDynamic = $printfunc->PrintDynamic($param);
    // print_r($printStatic);
    // print_r($printDynamic); 
    // exit();
    if(!empty($printStatic) && !empty($printDynamic)) {
        printPDF($printStatic, $printDynamic);
    }
}

function printPDF($printStatic, $printDynamic) {

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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_OUTSTANDINGAP.xlsx';
        $item = 25; // per page
        foreach ($printDynamic as $key => $value) {
            $page = ceil($key/$item); // if($key%$item == 0) {}
            $printDynamic[$key]['PAGE'] = $page;
        }
        // print_r($printStatic);
        // print_r($printDynamic);
        $seq = 2; // row excel new 1 start row 2 
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
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1', $printStatic['P_PAYMENTSTATUS'])
                                            ->setCellValue('B1', $printStatic['P_DUEDATEFR'])
                                            ->setCellValue('C1', $printStatic['P_DUEDATETO'])
                                            ->setCellValue('D1', $printStatic['P_VOUCHERDTFR'])
                                            ->setCellValue('E1', $printStatic['P_VOUCHERDTTO'])
                                            ->setCellValue('F1', $printStatic['P_SUPPINVNOFR'])
                                            ->setCellValue('G1', $printStatic['P_SUPPINVNOTO'])
                                            ->setCellValue('H1', $printStatic['P_CURRENCY'])
                                            ->setCellValue('I1', $printStatic['P_DEPARTMENTFR'])
                                            ->setCellValue('J1', $printStatic['P_DEPARTMENTTO'])
                                            ->setCellValue('K1', $printStatic['SUPPINVDTFR'])
                                            ->setCellValue('L1', $printStatic['SUPPINVDTTO'])
                                            ->setCellValue('M1', $printStatic['P_SUPPLIERFR'])
                                            ->setCellValue('N1', $printStatic['P_SUPPLIERTO'])
                                            ->setCellValue('O1', $printStatic['P_VOUCHERNOFR'])
                                            ->setCellValue('P1', $printStatic['P_VOUCHERNOTO'])
                                            ->setCellValue('Q1', $printStatic['P_STAFFFR'])
                                            ->setCellValue('R1', $printStatic['P_STAFFTO'])
                                            ->setCellValue('S1', $x);

            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                if ($seq > 25) { $seq = 2; }
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['ROWCOUNTER'])
                                                ->setCellValue('B'.$seq, $value['SUPPINVNO'])
                                                ->setCellValue('C'.$seq, $value['VOUCHERNO'])
                                                ->setCellValue('D'.$seq, $value['SUPPINVDT'])
                                                ->setCellValue('E'.$seq, $value['CTERM']) 
                                                ->setCellValue('F'.$seq, $value['DUEDT'])
                                                ->setCellValue('G'.$seq, $value['DAYOVERDUE'])
                                                ->setCellValue('H'.$seq, $value['PAIDDT'])
                                                ->setCellValue('I'.$seq, $value['SUPPCD'])
                                                ->setCellValue('J'.$seq, $value['SUPPNAME'])
                                                ->setCellValue('K'.$seq, $value['CURR'])
                                                ->setCellValue('L'.$seq, $value['INVAMT'])
                                                ->setCellValue('M'.$seq, $value['OUTSTDAMT'])
                                                ->setCellValue('N'.$seq, $value['STATUS'])
                                                ->setCellValue('O'.$seq, $value['B']);
                }
                ++$seq; 
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'OUTSTANDING_AP_CHECK_LIST_'.$x.'_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = 'OUTSTANDING_AP_CHECK_LIST_'.$x.'_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetExcel[$x] = PHPExcel_IOFactory::load($report_path);
            // $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_RECTANGLE);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.3);
            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.3);
            // $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);           

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
        echo json_encode($response);
        // --------------------------------------------------
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
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'PAYMENTSTATUS', 'DUEDATEFR', 'DUEDATETO', 'SUPPINVDTFR', 'SUPPINVDTTO', 'VOUCHERDTFR', 'VOUCHERDTTO', 'SUPPLIERFR', 'SUPPLIERTO', 'SUPPINVNOFR', 'SUPPINVNOTO', 'CURRENCY', 'DEPARTMENTFR', 'DEPARTMENTTO', 'VOUCHERNOFR', 'VOUCHERNOTO', 'STAFFFR', 'STAFFTO', 'TTLINVAMT', 'TTLOUTSTDAMT');

    foreach($arr as $k => $v) {
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
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

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>