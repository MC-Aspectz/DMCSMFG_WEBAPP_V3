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
$javaFunc = new DNCNReport;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 23;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    
    if(!empty($query)) {
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
        if ($_POST['action'] == 'printPur') { printPur(); }

    }
    if (isset($_POST['SEARCH'])) { search(); }
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
$dctype = $data['DRPLANG']['DC_TYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function search() {
    global $data;//D1,D2,DCTYP
    // $data = getSessionData();
    $logicfunc = new DNCNReport;
    setOldValue();
    $Param = array( 'DCTYP' => $_POST['DCTYP'],
                    'D1' => str_replace("-", "", $_POST['D1']),
                    'D2' => str_replace("-", "", $_POST['D2']),
                  );
    $DataPur = $logicfunc->getDataPur($Param);
    $DataPurCnt = $logicfunc->getDataPurCnt($Param);
    // print_r($DataPur);
    // print_r($DataPurCnt);
    if(!empty($DataPur)) {
        $data['ITEM'] = $DataPur;
        // $data['ITEM'] = array('DataSaleCnt' => $DataSaleCnt,'DataSale' => $DataSale); 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
    // printReport();
}

function printPur() {

    $printfunc = new DNCNReport;
    $Param = array( 'DCTYP' => isset($_POST['DCTYP']) ? $_POST['DCTYP']: '0',
                    'RAMT' => isset($_POST['RAMT']) ? str_replace([','], '', $_POST['RAMT']): '',
                    'RVAT' => isset($_POST['RVAT']) ? str_replace([','], '', $_POST['RVAT']): '',
                    'RTTL' => isset($_POST['RTTL']) ? str_replace([','], '', $_POST['RTTL']): '',
                    'D1' => isset($_POST['D1']) ? str_replace('-', '', $_POST['D1']): '',
                    'D2' => isset($_POST['D2']) ? str_replace('-', '', $_POST['D2']): '',
                    'PRTDT' => isset($_POST['PRTDT']) ? str_replace('-', '', $_POST['PRTDT']) : str_replace('-', '',date('Y-m-d')),
                  );
    // print_r($Param);
    $printStatic = $printfunc->printStaticPur($Param);
    $printDynamic = $printfunc->printDynamicPur($Param);
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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_DNCNREPORT.xlsx';
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
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                            ->setCellValue('B1', $printStatic['RPTTITLE'])
                                            ->setCellValue('C1', $printStatic['DATEB'])
                                            ->setCellValue('D1', $printStatic['DATEE'])
                                            ->setCellValue('E1', $printStatic['PAGE'])
                                            ->setCellValue('F1', $printStatic['TDATE'])
                                            ->setCellValue('G1', $printStatic['RAMT'])
                                            ->setCellValue('H1', $printStatic['RVAT'])
                                            ->setCellValue('I1', $printStatic['RTTL'])
                                            ->setCellValue('J1', '(Purchase)');

            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                if ($seq > 25) { $seq = 2; }
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['DNO'])
                                                ->setCellValue('B'.$seq, $value['LN'])
                                                ->setCellValue('C'.$seq, $value['IDATE'])
                                                ->setCellValue('D'.$seq, $value['SNAME'])
                                                ->setCellValue('E'.$seq, $value['ITNAME']) 
                                                ->setCellValue('F'.$seq, $value['QTY'])
                                                ->setCellValue('G'.$seq, $value['UOM'])
                                                ->setCellValue('H'.$seq, $value['UPR'])
                                                ->setCellValue('I'.$seq, $value['AMT'])
                                                ->setCellValue('J'.$seq, $value['REM']);
                }
                ++$seq; 
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'PUR_DEBIT_CREDIT_REPORT_'.$x.'_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = 'PUR_DEBIT_CREDIT_REPORT_'.$x.'_'.date('Ymd_Hi').'.pdf';
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
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_RECTANGLE);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$x]->getActiveSheet()->setShowGridLines(false);

            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setLeft(0.5);
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
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'DVW1',
                        'D1', 'D2', 'DCTYP', 'RAMT', 'RVAT', 'RTTL',
                        'SYSVIS_COMMIT', 'SYSVIS_CANCEL',);

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

// function printReport() {
//     //D1,D2,PRTDT,DCTYP,RAMT,RVAT,RTTL
//     global $data;
//     $data = getSessionData();
//     $printfunc = new DNCNReport;
//     $Param = array( 'DCTYP' => $data['DCTYP'],
//                     'RAMT' => isset($data['RAMT']) ? str_replace([','], '', $data['RAMT']): '',
//                     'RVAT' => isset($data['RVAT']) ? str_replace([','], '', $data['RVAT']): '',
//                     'RTTL' => isset($data['RTTL']) ? str_replace([','], '', $data['RTTL']): '',
//                     'D1' => isset($data['D1']) ? str_replace('-', '', $data['D1']): '',
//                     'D2' => isset($data['D2']) ? str_replace('-', '', $data['D2']): '',
//                     'PRTDT' => isset($data['PRTDT']) ? str_replace('-', '', $data['PRTDT']) : str_replace('-', '',date('Y-m-d')),
//                   );
//     // print_r($Param);
//     $printStatic = $printfunc->printStaticPur($Param);
//     $printDynamic = $printfunc->printDynamicPur($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     // print_r($printStatic);
//     // print_r($printDynamic);
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i <= count($printDynamic); $i++) {
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