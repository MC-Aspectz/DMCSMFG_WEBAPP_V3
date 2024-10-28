<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/PHPExcel.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode('/', dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
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
}  // if ($_SESSION['MENU'] != ' and is_array($_SESSION['MENU'])) {

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
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
}

$data = array();
$syslogic = new Syslogic;
$javaFunc = new ShipRequestVoucherPrint;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 21;
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
        if ($_POST['action'] == 'STAFFCODE') { getStaff(); }
        if ($_POST['action'] == 'CATALOGCODE') { getCatalog(); }   
        if ($_POST['action'] == 'SEARCH') { searchPrint(); } 
        if ($_POST['action'] == 'controlPrint') { controlPrint(); } 
        if ($_POST['action'] == 'print') { sheetDetailPrint(); } 
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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
if(empty($data['REP01'])) { $data['REP01'] = 0; }
if(empty($data['BILLING'])) { $data['BILLING'] = 0; }
$FACTORY = $data['DRPLANG']['FACTORY'];
$BILLING = $data['DRPLANG']['BILLING'];
$CURRENCY = $data['DRPLANG']['CURRENCY'];
$SELECT_REP01 = $data['DRPLANG']['SELECT_REP01'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
  
function getStaff() {
    $javafunc = new ShipRequestVoucherPrint;
    $STAFFCODE = isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '';
    $query = $javafunc->getStaff($STAFFCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCatalog() {
    $javafunc = new ShipRequestVoucherPrint;
    $CATALOGCODE = isset($_POST['CATALOGCODE']) ? $_POST['CATALOGCODE']: '';
    $query = $javafunc->getCatalog($CATALOGCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function searchPrint() {
    global $data; $data = getSessionData(); unsetSessionkey('ITEM');
    $searchfunc = new ShipRequestVoucherPrint;
    $param = array( 'SALEORDERNUMBER_S' => isset($_POST['SALEORDERNUMBER_S']) ? $_POST['SALEORDERNUMBER_S']: '',
                    'BILLING' => isset($_POST['BILLING']) ? $_POST['BILLING']: '', 
                    'FACTORY' => isset($_POST['FACTORY']) ? $_POST['FACTORY']: '', 
                    'DATE1' => isset($_POST['DATE1']) ? str_replace('-', '', $_POST['DATE1']): '', 
                    'DATE2' => isset($_POST['DATE2']) ? str_replace('-', '', $_POST['DATE2']): '', 
                    'STAFFCODE' => isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '', 
                    'CATALOGCODE' => isset($_POST['CATALOGCODE']) ? $_POST['CATALOGCODE']: '');
    $searchPrint = $searchfunc->searchPrint($param);
    if(!empty($searchPrint)) {
        $data['ITEM'] = $searchPrint; 
        setSessionArray($data);
    }
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($searchPrint);
    // echo '</pre>';
}

function controlPrint() {
    $javafunc = new ShipRequestVoucherPrint;
    $REP01 = isset($_POST['REP01']) ? $_POST['REP01']: '';
    $controlPrint = $javafunc->controlPrint($REP01);
    echo json_encode($controlPrint);
}

function sheetDetailPrint() {

    $RowParam = array();
    $REP01 = isset($_POST['REP01']) ? $_POST['REP01']: '';
    $javafunc = new ShipRequestVoucherPrint;
    if(isset($_POST['CHECKROW'])) {
        for ($i = 0 ; $i < count($_POST['SHIPREQUESTVOUCHERNUMBER']); $i++) { 
            $RowParam[] = array('CHECKROW' => isset($_POST['CHECKROW'][$i]) ? $_POST['CHECKROW'][$i]: 'F',
                                'SHIPREQUESTVOUCHERNUMBER' => isset($_POST['SHIPREQUESTVOUCHERNUMBER'][$i]) ? $_POST['SHIPREQUESTVOUCHERNUMBER'][$i]: '',
                                'SHIPREQUESTVOUCHERLINE' => isset($_POST['SHIPREQUESTVOUCHERLINE'][$i]) ? $_POST['SHIPREQUESTVOUCHERLINE'][$i]: '',
                                // 'REP01' => isset($_POST['REP01'][$i]) ? $_POST['REP01'][$i]: ''
                            );
        }
    }
    $param = array( 'SHEETDETAILPRINT' => '',
                    'REP01' => $REP01,
                    'SALEORDERNUMBER_S' => isset($_POST['SALEORDERNUMBER_S']) ? $_POST['SALEORDERNUMBER_S']: '',
                    'BILLING' => isset($_POST['BILLING']) ? $_POST['BILLING']: '', 
                    'FACTORY' => isset($_POST['FACTORY']) ? $_POST['FACTORY']: '', 
                    'DATE1' => isset($_POST['DATE1']) ? str_replace('-', '', $_POST['DATE1']): '', 
                    'DATE2' => isset($_POST['DATE2']) ? str_replace('-', '', $_POST['DATE2']): '', 
                    'STAFFCODE' => isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '', 
                    'CATALOGCODE' => isset($_POST['CATALOGCODE']) ? $_POST['CATALOGCODE']: '',
                    'DATA' => $RowParam);
    // print_r($param);    
    // $print = $javafunc->print($param);
    // echo json_encode($print);
    if($REP01 == 0) { // basic
        $printStatic = $javafunc->printStatic1($param);
        $printDynamic = $javafunc->printDynamic1($param);
        $result = array('printStatic' => $printStatic, 'printDynamic' => $printDynamic);
        if($printStatic == 'ERRO:ERRONODATAPRINT') { echo json_encode($result); exit(); }
        printBasic($printStatic, $printDynamic);
    } else { // standard
        $printStatic = $javafunc->printStatic2($param);
        $printDynamic = $javafunc->printDynamic2($param);
        $result = array('printStatic' => $printStatic, 'printDynamic' => $printDynamic);
        if($printStatic == 'ERRO:ERRONODATAPRINT') { echo json_encode($result); exit(); }
        printStandard($printStatic, $printDynamic);
    }

}

function printBasic($printStatic, $printDynamic) {
    // /** Error reporting */
    // error_reporting(E_ALL);
    // ini_set('display_errors', TRUE);
    // ini_set('display_startup_errors', TRUE);
    // page-break-inside
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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/SHIPREQUESTVOUCHERPRINT1.xlsx';
        // print_r($printStatic);
        // print_r($printDynamic);
        foreach ($printDynamic as $key => $value) {
            // print_r($key);
            // print_r($value);
            $sheetExcel[$key] = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel[$key]->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel[$key]->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------
            // Write Report Data to Sheet [DATA]
            $sheetExcel[$key]->getActiveSheet()->SetCellValue('A1',  $printStatic['DATERANGE'])  // [A] Planned Shipping
                                                ->SetCellValue('B1', $value['CUSTOMERCD'])  // [B] Customer Code
                                                ->SetCellValue('C1', $value['CUSTOMERNAME'])  // [C] Customer Name
                                                ->SetCellValue('D1', $value['CUSTOMERADDR']) // [D] Customer Address
                                                ->SetCellValue('E1', $value['CUSTOMERTEL']) // [E] Customer TEL
                                                ->SetCellValue('F1', $value['CUSTOMERFAX']) // [F] Customer FAX
                                                ->SetCellValue('G1', $value['CUSTOMERZIPCODE']) // [G] Customer ZIPCODE
                                                ->SetCellValue('H1', $value['DELIVERYNAME']) // [H] Delivery Name
                                                ->SetCellValue('I1', $value['DELIVERYSHORTNAME']) // [I] Delivery ShortName
                                                ->SetCellValue('J1', $value['DELADDA']) // [J] Delivery Address 1
                                                ->SetCellValue('K1', $value['DELADDB']) // [K] Delivery Address 2
                                                ->SetCellValue('L1', $value['DELIVERYTEL']) // [L] Delivery TEL
                                                ->SetCellValue('M1', $value['DELIVERYFAX']) // [M] Delivery FAX
                                                ->SetCellValue('N1', $value['DELIVERYZIPCODE']) // [N] Delivery ZIPCODE
                                                ->SetCellValue('O1', date('Y-m-d'))  // [O] Print Date
                                                //------------- Item List ----------- //
                                                ->SetCellValue('A2', $value['ITEMCODE'].'  '.$value['ITEMNAME'])  // [A] Item Code / Item Name
                                                ->SetCellValue('B2', $value['SALEORDERNO'])  // [B] Sale Order Number
                                                ->SetCellValue('C2', $value['SALECUSNO'])  // [C] Customer PO No.
                                                ->SetCellValue('D2', $value['SHIPREQSALEDT'])  // [D] Planned Shipping
                                                ->SetCellValue('E2', $value['SHIPSALEQTY'])  // [E] Estimated Qty.  
                                                ->SetCellValue('F2', $value['SHIPPEDQTY'])  // [F] Actual Shipping Qty.
                                                ->SetCellValue('G2', $value['QTY']) // [G] Unit Qty.
                                                ->SetCellValue('H2', $value['TRANSPORT']); // [H] Freight Company
                                                // ->setCellValueExplicit('H2', $value['TRANSPORT'], PHPExcel_Cell_DataType::TYPE_FORMULA); // [H] Freight Company
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$key]->setActiveSheetIndex($sheetRpt);

            $sheetExcel[$key]->getActiveSheet()->getSheetView()->setZoomScale(90);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$key], 'Excel2007');
            
            // Save Excel Report File on Server
            // header('Content-type: text/csv; charset=UTF-8');
            // header('Content-type: application/vnd.ms-excel; charset=UTF-8');
            $report_file = 'SHIPPING_REQUEST_VOUCHER'.'_BASIC_'.$key.'_'.date('Ymd_His').'.xlsx';
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
            // $excel_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
            $pdf_name = 'SHIPPING_REQUEST_VOUCHER'.'_BASIC_'.$key.'_'.date('Ymd_His').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            // $rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            // $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
            // $rendererLibrary = 'DomPDF.php';
            // $rendererLibrary = 'tcPDF.php';
            // $rendererLibrary = 'mPDF.php';
            // $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/Writer/PDF/' . $rendererLibrary;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            // $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/mpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            $sheetPDF[$key] = PHPExcel_IOFactory::load($report_path);
            $sheetPDF[$key]->setActiveSheetIndex($sheetRpt);
            // $sheetPDF[$key]->getActiveSheet()->getRowIterator();
            // $sheetPDF[$key]->getActiveSheet();
            // $sheetPDF[$key]->getSheetByName('LAYOUT'); 
            // --------------------------------------------------
            // Set Sheet to [REPORT]
            // $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);     
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setVerticalCentered(true);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            // $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToPage(true);
            $sheetPDF[$key]->getActiveSheet()->setShowGridLines(false);
            // $sheetPDF[$key]->getActiveSheet()->getColumnDimension('D')->setWidth('30');

            // Calculate the column widths
            // foreach(range('A', 'J') as $columnID) {
            //     $sheetPDF[$key]->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            // }
            // $sheetPDF[$key]->getActiveSheet()->calculateColumnWidths();
            // Set setAutoSize(false) so that the widths are not recalculated

            // // Set margins if needed
            $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setBottom(0.5);
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setRight(0.5);
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setLeft(0.5);
            
            // header('Content-Type: application/pdf; charset=UTF-8');
            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF[$key], 'PDF');
            // $pdf_writer->setIncludeCharts(TRUE);
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

function printStandard($printStatic, $printDynamic) {

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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/SHIPREQUESTVOUCHERPRINT2.xlsx';
        $item = 10; // per page
        $index = isset($printStatic) ? array_key_first($printStatic) : 1 ;
        foreach ($printDynamic as $key => $value) {
            $page = ceil($key/$item); // if($key%$item == 0) {}
            $printDynamic[$key]['PAGE'] = $page;
        }
        // print_r($page);
        // print_r($printDynamic);
        // print_r($printStatic);
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
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1',  $printStatic[$index]['DATERANGE'])  // [A] Planned Shipping
                                            ->setCellValue('B1', $printStatic[$index]['DIVISIONCD'])  // [B] Department Code
                                            ->setCellValue('C1', $printStatic[$index]['DIVISIONNAME'])  // [C] Department Name
                                            ->setCellValue('D1', $printStatic[$index]['PRINTDATE']);  // [D] Print Date

            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                    if ($seq > 11) { $seq = 2; }
                    // echo $seq."\n";
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['SHIPREQSALEDT'])  // [A] Planned Shipping
                                                    ->setCellValue('B'.$seq, $value['DUEDTFLG'])  // [B] Expected Shipping
                                                    ->setCellValue('C'.$seq, $value['CUSTTOMERCODE'].'  '.$value['CUSTOMERNAME'])  // [C] Customer
                                                    ->setCellValue('D'.$seq, $value['DELIVERYSHORTNAME'])  // [D] Recipient
                                                    ->setCellValue('E'.$seq, $value['ITEMCODE'].'  '.$value['ITEMNAME'])  // [E] Product Name    
                                                    ->setCellValue('F'.$seq, $value['SHIPSALEQTY'])  // [F] Quantity
                                                    ->setCellValue('G'.$seq, $value['SALECUSNO']) // [G] Order No.
                                                    ->setCellValue('H'.$seq, $value['SALEORDERNO']) // [H] Sale Order No.
                                                    ->setCellValue('I'.$seq, $value['PAGE']);  // [I] PAGE
                }
                ++$seq;  
            }
            // $sheetExcel[$x]->getActiveSheet()->getColumnDimension('C')->setWidth(60);
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'SHIPPING_REQUEST_VOUCHER'.'_STD_'.$x.'_'.date('Ymd_His').'.xlsx';
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
            // $excel_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
            $pdf_name = 'SHIPPING_REQUEST_VOUCHER'.'_STD_'.$x.'_'.date('Ymd_His').'.pdf';
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
            // Set Sheet to [REPORT]
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_RECTANGLE);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToPage(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetPDF[$x]->getActiveSheet()->setShowGridLines(false);

            // // Set margins if needed
            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setBottom(0.5);
            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setRight(0.5);
            $sheetPDF[$x]->getActiveSheet()->getPageMargins()->setLeft(0.5);

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

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SALEORDERNUMBER_S', 'DATE1', 'DATE2', 'STAFFCODE', 'STAFFNAME', 'CATALOGCODE', 'CATALOGNAME', 'BILLING', 'FACTORY', 'REP01');
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
?>