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
$javaFunc = new AccBSPL1;
$systemName = strtolower($appcode);
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
        if ($_POST['action'] == 'PrintBSPL1') { PrintBSPL1(); }
    }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
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
$rptform = $data['DRPLANG']['RPTFORM'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
$accyearvalue = $data['DRPLANG']['ACCYEARVALUE'];
$data['RPTFORMTYP'] = 'FORM1';
if(empty($data['ACCY'])) { $data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: date('Y'); }
if(empty($data['YEAR'])) { $data['YEAR'] = isset($load['YEAR']) ? $load['YEAR']: date('Y'); }
// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($load);
// echo "</pre>";
// --------------------------------------------------------------------------//
function PrintBSPL1() {
    $printfunc = new AccBSPL1;
    $param = array( 'YEAR' => isset($_POST['YEAR']) ? $_POST['YEAR']: '',
                    'MONTH' => isset($_POST['MONTH']) ? $_POST['MONTH']: '',
                    'ACCY' => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    'RPTFORMTYP' => isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: '');
    // print_r($param);
    $printStatic = $printfunc->printStatic($param);
    $printDynamic = $printfunc->printDynamic($param);
    // print_r($printStatic);
    // print_r($printDynamic);
    // exit();
    if(!empty($printDynamic)) {
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
        global $data; $data = getSessionData();
        $ACCYEARVALUE = isset($data['ACCYEARVALUE']) ? $data['ACCYEARVALUE']: '';
        // Load an existing spreadsheet
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_BSPL1.xlsx';
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
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1', $printStatic['COMPANYNAME'])
                                            ->setCellValue('B1', $printStatic['REPDATE'])
                                            ->setCellValue('C1', $printStatic['YEARMONTH'])
                                            ->setCellValue('D1', $printStatic['YEARMONTHTEXT']);
            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                if ($seq > 25) { $seq = 2; }
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['DISCRIPTION'])
                                                ->setCellValue('B'.$seq, $value['BEGINNING'])
                                                ->setCellValue('C'.$seq, $value['M1AMOUNT'])
                                                ->setCellValue('D'.$seq, $value['M0AMOUNT'])
                                                ->setCellValue('E'.$seq, $value['ENDING']) 
                                                ->setCellValue('F'.$seq, $value['AMOUNT'])
                                                ->setCellValue('G'.$seq, $value['CAMOUNT'])
                                                ->setCellValue('H'.$seq, $value['DATAFLG'])
                                                ->setCellValue('I'.$seq, $value['LISTFLG'])
                                                ->setCellValue('J'.$seq, $value['ACCY'])
                                                ->setCellValue('K'.$seq, $value['M0YEAR'])
                                                ->setCellValue('L'.$seq, $value['M0MONTH']);
                }
                ++$seq; 
            }
        
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'FINANCIAL_STATEMANTS_'.$x.'_'.date('Ymd_Hi').'.xlsx';
            $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
            $report_path = $outputPath.'/'.$report_file;
            $writer->save($report_path);
            // print_r($download_path);
            // Response Excel Report File URL
            array_push($response, array('url' => $download_path,
                                        'filename' => $report_file));
            echo json_encode($response);
            exit();
            // --------------------------------------------------
            // ----------------------------------------------------------------------------------------------------
            // --------------------------------------------------
            // Generate PDF Report File
            // --------------------------------------------------
            // --------------------------------------------------
            $pdf_name = 'FINANCIAL_STATEMANTS_'.$x.'_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName asssssssssssssssssssssssssssssssssssssssnd $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
            $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$x]->getActiveSheet()->setShowGridLines(false);

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
    } 
    catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}
// function PrintState() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccBSPL1;
//     $param = array( 'YEAR' => isset($data['YEAR']) ? $data['YEAR']: '',
//                     'MONTH' => isset($data['MONTH']) ? $data['MONTH']: '',
//                     'RPTFORMTYP' => isset($data['RPTFORMTYP']) ? $data['RPTFORMTYP']: '',
//                     'ACCY' => isset($data['ACCY']) ? $data['ACCY']: '');
//     // print_r($param);
//     $printStatic = $printfunc->printStatic($param);
//     $data['PRINTSTATIC'] = $printStatic;
//     $printDynamic = $printfunc->printDynamic($param);
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//         }
//         setSessionArray($data);
//     }
//     // echo "<pre>";
//     // print_r($data['PRINTDYNAMIC']);
//     // echo "</pre>";
//     // echo "<pre>";
//     // print_r($data['PRINTSTATIC']);
//     // echo "</pre>";
// }

function setOldValue() {
    setSessionArray($_POST); 
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ACCY', 'YEAR', 'MONTH', 'RPTFORMTYP');

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