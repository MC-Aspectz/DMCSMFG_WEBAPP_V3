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
$javaFunc = new AccOutStandingAR;
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
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'getElement') { getElement(); }
        if ($_POST['action'] == 'printAR') { printAR();}
    }
    if (isset($_POST['SEARCH'])) { searchDataOutStdAR(); }
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
$receivestatus = $data['DRPLANG']['RECEIVESTATUS'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getElement() {

    if(isset($_POST['CUSTOMERCD']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['CUSTOMERFR'] = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD'] : '';
        } else {
            $data['CUSTOMERTO'] = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD'] : '';
        }
    } else if(isset($_POST['SALETRANNO']) && isset($_POST['index'])) {
        if($_POST['index'] == 1) {
            $data['INVNOFR'] = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO'] : '';
        } else {
            $data['INVNOTO'] = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO'] : '';
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


function searchDataOutStdAR() {
    global $data; $data['ITEM'] = array();
    $data = getSessionData();
    $searchfunc = new AccOutStandingAR;
    $RECEIVESTATUS = isset($_POST['RECEIVESTATUS']) ? $_POST['RECEIVESTATUS']: '';
    $param = array( 'DUEDATEFR' => isset($_POST['DUEDATEFR']) ? str_replace('-', '', $_POST['DUEDATEFR']): '',
                    'DUEDATETO' => isset($_POST['DUEDATETO']) ? str_replace('-', '', $_POST['DUEDATETO']): '',
                    'CUSTOMERFR' => isset($_POST['CUSTOMERFR']) ? $_POST['CUSTOMERFR']: '',
                    'CUSTOMERTO' => isset($_POST['CUSTOMERTO']) ? $_POST['CUSTOMERTO']: '',
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'DEPARTMENTFR' => isset($_POST['DEPARTMENTFR']) ? $_POST['DEPARTMENTFR']: '',
                    'DEPARTMENTTO' => isset($_POST['DEPARTMENTTO']) ? $_POST['DEPARTMENTTO']: '',
                    'INVDATEFR' => isset($_POST['INVDATEFR']) ? str_replace('-', '', $_POST['INVDATEFR']): '',
                    'INVDATETO' => isset($_POST['INVDATETO']) ?  str_replace('-', '', $_POST['INVDATETO']): '',
                    'INVNOFR' => isset($_POST['INVNOFR']) ? $_POST['INVNOFR']: '',
                    'INVNOTO' => isset($_POST['INVNOTO']) ? $_POST['INVNOTO']: '',
                    'STAFFFR' => isset($_POST['STAFFFR']) ? $_POST['STAFFFR']: '',
                    'STAFFTO' => isset($_POST['STAFFTO']) ? $_POST['STAFFTO']: '');
    $searchDataOutStdAR = $searchfunc->searchDataOutStdAR($param);
    // print_r($searchDataOutStdAR);
    if(!empty($searchDataOutStdAR)) {
        $upTmpOutStdAR1 = $searchfunc->UpTmpOutStdAR1($searchDataOutStdAR);
        $getTmpOutStdAR1 = $searchfunc->GetTmpOutStdAR1($RECEIVESTATUS);
        $upTmpOutStdAR2 = $searchfunc->UpTmpOutStdAR2($getTmpOutStdAR1);
        $sumByCustCurr = $searchfunc->SumByCustCurr();
        $upTmpOutStdAR2Sum = $searchfunc->UpTmpOutStdAR2Sum($sumByCustCurr);
        $getTmpOutStdAR2 = $searchfunc->GetTmpOutStdAR2($RECEIVESTATUS);
        if(!empty($getTmpOutStdAR2)) {
            $data['ITEM'] = $getTmpOutStdAR2;
        }
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo "<pre>";
    // print_r($getTmpOutStdAR2);
    // echo "</pre>";
}

function printAR() {

    $printfunc = new AccOutStandingAR;
    $param = array( 'RECEIVESTATUS' => isset($_POST['RECEIVESTATUS']) ? $_POST['RECEIVESTATUS']: '',
                    'DUEDATEFR' => isset($_POST['DUEDATEFR']) ? str_replace('-', '', $_POST['DUEDATEFR']): '',
                    'DUEDATETO' => isset($_POST['DUEDATETO']) ? str_replace('-', '', $_POST['DUEDATETO']): '',
                    'CUSTOMERFR' => isset($_POST['CUSTOMERFR']) ? $_POST['CUSTOMERFR']: '',
                    'CUSTOMERTO' => isset($_POST['CUSTOMERTO']) ? $_POST['CUSTOMERTO']: '',
                    'CURRENCY' => isset($_POST['CURRENCY']) ? $_POST['CURRENCY']: '',
                    'DEPARTMENTFR' => isset($_POST['DEPARTMENTFR']) ? $_POST['DEPARTMENTFR']: '',
                    'DEPARTMENTTO' => isset($_POST['DEPARTMENTTO']) ? $_POST['DEPARTMENTTO']: '',
                    'INVDATEFR' => isset($_POST['INVDATEFR']) ? str_replace('-', '', $_POST['INVDATEFR']): '',
                    'INVDATETO' => isset($_POST['INVDATETO']) ?  str_replace('-', '', $_POST['INVDATETO']): '',
                    'INVNOFR' => isset($_POST['INVNOFR']) ? $_POST['INVNOFR']: '',
                    'INVNOTO' => isset($_POST['INVNOTO']) ? $_POST['INVNOTO']: '',
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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_OUTSTANDINGAR.xlsx';
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
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1', $printStatic['P_RECEIVESTATUS'])
                                            ->setCellValue('B1', $printStatic['P_DUEDATEFR'])
                                            ->setCellValue('C1', $printStatic['P_DUEDATETO'])
                                            ->setCellValue('D1', $printStatic['P_CUSTOMERFR'])
                                            ->setCellValue('E1', $printStatic['P_CUSTOMERTO'])
                                            ->setCellValue('F1', $printStatic['P_CURRENCY'])
                                            ->setCellValue('G1', $printStatic['P_DEPARTMENTFR'])
                                            ->setCellValue('H1', $printStatic['P_DEPARTMENTTO'])
                                            ->setCellValue('I1', $printStatic['P_INVDATEFR'])
                                            ->setCellValue('J1', $printStatic['P_INVDATETO'])
                                            ->setCellValue('K1', $printStatic['P_INVNOFR'])
                                            ->setCellValue('L1', $printStatic['P_INVNOTO'])
                                            ->setCellValue('M1', $printStatic['P_STAFFFR'])
                                            ->setCellValue('N1', $printStatic['P_STAFFTO'])
                                            ->setCellValue('O1', $x);

            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                if ($seq > 25) { $seq = 2; }
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['ROWCOUNTER'])
                                                ->setCellValue('B'.$seq, $value['INVNO'])
                                                ->setCellValue('C'.$seq, $value['INVDATE'])
                                                ->setCellValue('D'.$seq, $value['CRTERM'])
                                                ->setCellValue('E'.$seq, $value['DUEDT']) 
                                                ->setCellValue('F'.$seq, $value['DAYOVERDUE'])
                                                ->setCellValue('G'.$seq, $value['RECVDT'])
                                                ->setCellValue('H'.$seq, $value['CUSTCD'])
                                                ->setCellValue('I'.$seq, $value['CUSTNM'])
                                                ->setCellValue('J'.$seq, $value['CURR'])
                                                ->setCellValue('K'.$seq, $value['INVAMT'])
                                                ->setCellValue('L'.$seq, $value['OUTSTDAMT'])
                                                ->setCellValue('M'.$seq, $value['STATUS'])
                                                ->setCellValue('N'.$seq, $value['B']);
                }
                ++$seq; 
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'OUTSTANDING_AR_CHECK_LIST_'.$x.'_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = 'OUTSTANDING_AR_CHECK_LIST_'.$x.'_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_RECTANGLE);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.3);
            $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.6);
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
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'RECEIVESTATUS', 'DUEDATEFR', 'DUEDATETO', 'INVDATEFR', 'INVDATETO', 'CUSTOMERFR', 'CUSTOMERTO', 'INVNOFR', 'INVNOTO', 'CURRENCY', 'DEPARTMENTFR', 'DEPARTMENTTO', 'STAFFFR', 'STAFFTO', 'TTLINVAMT', 'TTLOUTSTDAMT');

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

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

// function printAR() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccOutStandingAR;
//     // RECEIVESTATUS,DUEDATEFR,DUEDATETO,CUSTOMERFR,CUSTOMERTO,CURRENCY,DEPARTMENTFR,DEPARTMENTTO,INVDATEFR,INVDATETO,INVNOFR,INVNOTO,STAFFFR,STAFFTO
//     $param = array( 'RECEIVESTATUS' => isset($data['RECEIVESTATUS']) ? $data['RECEIVESTATUS']: '',
//                     'DUEDATEFR' => isset($data['DUEDATEFR']) ? str_replace('-', '', $data['DUEDATEFR']): '',
//                     'DUEDATETO' => isset($data['DUEDATETO']) ? str_replace('-', '', $data['DUEDATETO']): '',
//                     'CUSTOMERFR' => isset($data['CUSTOMERFR']) ? $data['CUSTOMERFR']: '',
//                     'CUSTOMERTO' => isset($data['CUSTOMERTO']) ? $data['CUSTOMERTO']: '',
//                     'CURRENCY' => isset($data['CURRENCY']) ? $data['CURRENCY']: '',
//                     'DEPARTMENTFR' => isset($data['DEPARTMENTFR']) ? $data['DEPARTMENTFR']: '',
//                     'DEPARTMENTTO' => isset($data['DEPARTMENTTO']) ? $data['DEPARTMENTTO']: '',
//                     'INVDATEFR' => isset($data['INVDATEFR']) ? str_replace('-', '', $data['INVDATEFR']): '',
//                     'INVDATETO' => isset($data['INVDATETO']) ?  str_replace('-', '', $data['INVDATETO']): '',
//                     'INVNOFR' => isset($data['INVNOFR']) ? $data['INVNOFR']: '',
//                     'INVNOTO' => isset($data['INVNOTO']) ? $data['INVNOTO']: '',
//                     'STAFFFR' => isset($data['STAFFFR']) ? $data['STAFFFR']: '',
//                     'STAFFTO' => isset($data['STAFFTO']) ? $data['STAFFTO']: '');
//     // print_r($param);
//     $printStatic = $printfunc->PrintStatic($param);
//     $printDynamic = $printfunc->PrintDynamic($param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//         }
//         setSessionArray($data);
//     }
//     // echo "<pre>";
//     // print_r($data['PRINTSTATIC']);
//     // echo "</pre>";
//     // echo "<pre>";
//     // print_r($data['PRINTDYNAMIC']);
//     // echo "</pre>";
// }
?>