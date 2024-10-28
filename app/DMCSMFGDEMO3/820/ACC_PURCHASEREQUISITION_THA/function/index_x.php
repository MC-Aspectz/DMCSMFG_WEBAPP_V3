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
$javaFunc = new PurchaseRequisition;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 15;

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['PURREQNO'])) {
        unsetSessionData();
        $PURREQNO = isset($_GET['PURREQNO']) ? $_GET['PURREQNO']:'';
        $query = $javaFunc->getPR($PURREQNO);
        if(!empty($query)) { 
            $data = $query;
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
            $itemlist = $javaFunc->getPRLn($query['PURREQNO']);
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
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'SUPCD') { getSup(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'print') { printed(); }
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
$BRANCH_KBN = $data['DRPLANG']['BRANCH_KBN'];
$UNIT = $data['DRPLANG']['UNIT'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getDiv() {
    $javafunc = new PurchaseRequisition;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new PurchaseRequisition;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getSup() {
    $javafunc = new PurchaseRequisition;
    $SUPCD = isset($_POST['SUPCD']) ? $_POST['SUPCD']: '';
    $query = $javafunc->getSup($SUPCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
} 

function getItem() {
    $javafunc = new PurchaseRequisition;
    $index = isset($_POST['index']) ? $_POST['index']: '';
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $query = $javafunc->getItem($ITEMCD);
    if(!empty($query)) {
        $query['REQQTY'] = '1.00';
        $data['ITEM'][$index] = array(  'ROWNO' => $index,
                                        'ITEMCD' => $query['ITEMCD'],
                                        'ITEMNAME' => $query['ITEMNAME'],
                                        'PURPOSETYP' => isset($query['PURPOSETYP']) ? $query['PURPOSETYP']: '',
                                        'REQQTY' => isset($query['REQQTY']) ? $query['REQQTY']: '1.00',
                                        'ITEMUNITTYP' => $query['ITEMUNITTYP'],
                                        'REM' => isset($query['REM']) ? $query['REM']: '',
                                        'OLDLN' => isset($query['OLDLN']) ? $query['OLDLN']: '');
        setSessionArray($data);
    }
    echo json_encode($query);
} 

function commit() {
    $RowParam = array();
    $cmtfunc = new PurchaseRequisition;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        if($_POST['ITEMCD'][$i] != '' && isset($_POST['ITEMCD'][$i])) {
            $RowParam[] = array('ROWNO' => $i + 1,
                                'ITEMCD' => $_POST['ITEMCD'][$i],
                                'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                'PURPOSETYP' => $_POST['PURPOSETYP'][$i],
                                'REQQTY' => isset($_POST['REQQTY'][$i]) ? str_replace(',', '', $_POST['REQQTY'][$i]): '1.00',
                                'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                'REM' => $_POST['REM'][$i],
                                'OLDLN' => $_POST['OLDLN'][$i]);
        }
    }
    // print_r($RowParam);
    $param = array( 'PURREQNO' => $_POST['PURREQNO'],
                    'INPUTDT' => str_replace('-', '', $_POST['INPUTDT']),
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'PURREQDUEDT' => str_replace('-', '', $_POST['PURREQDUEDT']),
                    'STAFFCD' => $_POST['STAFFCD'],
                    'SUPCD' => $_POST['SUPCD'],
                    'PURREQADD01' => $_POST['PURREQADD01'],
                    'PURREQADD02' => $_POST['PURREQADD02'],
                    'PURREQADD03' => $_POST['PURREQADD03'],
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    if(is_array($commit)) { unsetSessionData(); }
    echo json_encode($commit);
}

function cancel() {
    $cancelfunc = new PurchaseRequisition;
    $cancel = $cancelfunc->cancel($_POST['PURREQNO']);
    unsetSessionData();
}
 
function printed() {

    try {
        $printfunc = new PurchaseRequisition;
        $PURREQNO = isset($_POST['PURREQNO']) ? $_POST['PURREQNO']: '';
        $printStatic = $printfunc->printStatic($PURREQNO);
        $printDynamic = $printfunc->printDynamic($PURREQNO);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_PURCHASEREQUISITION_THA.xlsx';
            $item = 12; // per page
            foreach ($printDynamic as $key => $value) {
                $page = ceil($key/$item); // if($key%$item == 0) {}
                $printDynamic[$key]['PAGE'] = $page;
            }

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
                $sheetExcel[$x]->getActiveSheet()->setCellValue('A1',  $printStatic['COMPNEN'])
                                            ->setCellValue('B1', $printStatic['COMPNTH'])
                                            ->setCellValue('C1', $printStatic['TOTQTY'])
                                            ->setCellValue('D1', $printStatic['ROWCOUNTER']);

                //------------- Item List ----------- //                            
                foreach ($printDynamic as $key => $value) {
                    if($value['PAGE'] == $x) { // separate page
                        if ($seq > 12) { $seq = 2; }           
                        $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['NUM'])
                                                    ->setCellValue('B'.$seq, $value['SUPNAME'])
                                                    ->setCellValue('C'.$seq, $value['REQN'])
                                                    ->setCellValue('D'.$seq, $value['DEPT'])
                                                    ->setCellValue('E'.$seq, $value['TDATE'])
                                                    ->setCellValue('F'.$seq, $value['DOCN'])
                                                    ->setCellValue('G'.$seq, $value['REQDT'])
                                                    ->setCellValue('H'.$seq, $value['DESCR'])
                                                    ->setCellValue('I'.$seq, $value['POO'])
                                                    ->setCellValue('J'.$seq, $value['UT'])
                                                    ->setCellValue('K'.$seq, $value['QTY'])
                                                    ->setCellValue('L'.$seq, $value['RD'])
                                                    ->setCellValue('M'.$seq, $value['REM'])
                                                    ->setCellValue('N'.$seq, $value['EFFDT'])
                                                    ->setCellValue('O'.$seq, $value['SUPPLIERCD'])
                                                    ->setCellValue('P'.$seq, $value['STAFFCD'])
                                                    ->setCellValue('Q'.$seq, $value['DIVISIONCD'])
                                                    ->setCellValue('R'.$seq, $value['ROWCOUNTER']);
                    }
                    ++$seq; 
                }
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $PURREQNO.'_PURCHASE_REQUISITION_'.$x.'_'.date('Ymd_Hi').'.xlsx';
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
                $pdf_name = $PURREQNO.'_PURCHASE_REQUISITION_'.$x.'_'.date('Ymd_Hi').'.pdf';
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
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.1);
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.5);
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'PDF');
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
            exit;
            // ----------------------------------------------------------------------------------------------------
        }
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
        $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'PURPOSETYP' => $_POST['PURPOSETYP'][$i],
                                    'REQQTY' => $_POST['REQQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'REM' => $_POST['REM'][$i],
                                    'OLDLN' => $_POST['OLDLN'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function setSessionArray($arr){
    $keepField = array('SYSPVL', 'TXTLANG', 'DRPLANG', 'PURREQNO', 'DIVISIONCD', 'DIVISIONNAME', 'STAFFCD', 'STAFFNAME', 'SUPCD', 'SUPNAME', 'INPUTDT', 'PURREQDUEDT', 'BRANCHKBN',
                        'TAXID', 'ITEM', 'PURREQADD01', 'PURREQADD02', 'PURREQADD03', 'SYSEN_DIVISIONCD', 'SYSEN_STAFFCD', 'SYSEN_SUPCD', 'SYSEN_PURREQDUEDT', 'PURREQADD01', 'PURREQADD02', 'PURREQADD03',
                        'SYSEN_PURREQADD01', 'SYSEN_PURREQADD02', 'SYSEN_PURREQADD03', 'SYSEN_COMMIT', 'SYSEN_CANCEL', 'SYSEN_DVW', 'SYSVIS_CANCELLBL', 'SYSVIS_PRINT', 'PRINTSTATIC', 'PRINTDYNAMIC');
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
//     $printfunc = new PurchaseRequisition;
//     $printStatic = $printfunc->printStatic($data['PURREQNO']);
//     $printDynamic = $printfunc->printDynamic($data['PURREQNO']);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         if(empty($printDynamic['ROWCOUNTER'])) {
//             for ($i = 1 ; $i < count($printDynamic)+1; $i++) {
//                 $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//             }
//         } else {
//             $data['PRINTDYNAMIC'][$printDynamic['ROWCOUNTER']] = $printDynamic; 
//         }
//     }
//     setSessionArray($data);
//     // echo "<pre>";
//     // print_r($data);
//     // echo "</pre>";
// }
?>