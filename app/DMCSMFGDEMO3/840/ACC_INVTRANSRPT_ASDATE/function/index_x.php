<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/PHPExcel.php');

//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    if($_SESSION['APPCODE'] != $appcode) {
        $syslogic->ProgramRundelete($_SESSION['APPCODE']);
        $syslogic->setLoadApp($appcode);
        $_SESSION['PACKCODE'] = $packcode;
        $_SESSION['PACKNAME'] = $packname;
        $_SESSION['APPCODE'] = $appcode;
        $_SESSION['APPNAME'] = $appname;
    }  // if($_SESSION['APPCODE'] != $appcode) {
} else {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}  // if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// エラーメッセージの初期化
$errorMessage = "";
//--------------------------------------------------------------------------------
//  LANGUAGE
// if (isset($_SESSION['LANG'])) {
//     require_once('./lang/' . strtolower($_SESSION['LANG']) . '.php');
// } else {  
//     require_once('./lang/en.php');
// }
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}


$javaFunc = new AccInvTransRptAsDate;
$data = array();
$systemName = 'AccInvTransRptAsDate';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 18;
$rowno = 0;
//DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMCD2,RPTDOCEN,RPTDOCTH,RPTDOC
$DVPERIOD ='';
$RPTDATE1 ='';
$RPTDATE2 = '';
$ITEMCD = '';
$ITEMCD2 ='';
$RPTDOCEN = '';
$RPTDOCTH ='';
$RPTDOC ='';

$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
    print_r("load");
    print_r($load);
}
$data = $load;



if(!empty($_POST)) {
    // print_r($_POST);

   if(isset($_POST['search'])) {

        $data['DVPERIOD'] = '';
        $data['RPTDATE1'] = isset($_POST['RPTDATE1']) ? $_POST['RPTDATE1']: '';
        $data['RPTDATE2'] = isset($_POST['RPTDATE2']) ? $_POST['RPTDATE2']: '';
        $data['ITEMCD'] = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
        $data['ITEMCD2'] = isset($_POST['ITEMCD2']) ? $_POST['ITEMCD2']: '';
        //acc.THA.ACC_FIFOLIST_RD.getInvTrans	DVPERIOD,YEAR,MONTH,YEAR2,MONTH2,ITEMCD,ITEMCD2
        // $query = $javaFunc->search($_POST['YEAR'], str_replace('-','',$_POST['ASOFDT'])
        //                             $_POST['MONTH'], $_POST['YEAR2'],
        //                             $_POST['MONTH2'], $_POST['ITEMCD'],);
        $query = $javaFunc->getInvTrans('', date("Ymd", strtotime($_POST['RPTDATE1'])),date("Ymd", strtotime($_POST['RPTDATE2'])),
                                        $_POST['ITEMCD'],$_POST['ITEMCD2'],);
        $data['INV'] = $query;
        // print_r($data['INV']);
        if(!empty($query)) {
            setSessionArray($data); 

        }
            
        if(checkSessionData()) { 
            $data = getSessionData(); 
        }

        // print_r($CODEKEY_S);
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == 'printen') { sheetDetailPrint(); } 
        if ($_POST['action'] == 'printth') { sheetDetailPrint(); } 

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();

        $DVPERIOD = isset($data['DVPERIOD']) ? $data['DVPERIOD']: '';
        $RPTDATE1 = isset($data['RPTDATE1']) ? $data['RPTDATE1']: '';
        $RPTDATE2 = isset($data['RPTDATE2']) ? $data['RPTDATE2']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        $ITEMCD2 = isset($data['ITEMCD2']) ? $data['ITEMCD2']: '';
        
        // $query = $javaFunc->search($YEAR,$MONTH,$YEAR2,$MONTH2,$ITEMCD);
        $query = $javaFunc->getInvTrans($DVPERIOD,$RPTDATE1,$RPTDATE2,$ITEMCD,$ITEMCD2);
        $data['INV'] = $query;
        setSessionArray($data); 
    }

    // onchange


    else if(!empty($_GET['ITEMCD']) && empty($_GET['index'])) {
        unsetSessionkey('ITEMCD');

        $data['ITEMCD'] = isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '';
        $excute = $javaFunc->get($_GET['ITEMCD']);

        // print_r($excute);
        $data = $excute;


    } else if(!empty($_GET['ITEMCD2'])) {
        unsetSessionkey('ITEMCD2');

        $data['ITEMCD2'] = isset($_GET['ITEMCD2']) ? $_GET['ITEMCD2']: '';
        $excute = $javaFunc->get($_GET['ITEMCD2']);
        if(!empty($excute))
        {
            // print_r('***not empty***');
            $excute['ITEMCD2'] = isset($excute['ITEMCD']) ? $excute['ITEMCD']: '';
            $data['ITEMCD2'] = $excute['ITEMCD2'];
            $excute['ITEMCD'] = isset($data['ITEMCD']) ? $data['ITEMCD']: '';

        }

        // print_r($excute);
        $data = $excute;


    }

    //from search     

    else if(!empty($_GET['index'])&&$_GET['index']==1)
    {
        $data['ITEMCD'] = $_GET['ITEMCD'];
        setSessionArray($data); 

    }
    else if(!empty($_GET['index'])&&$_GET['index']==2)
    {
        $data['ITEMCD2'] = $_GET['ITEMCD'];
        setSessionArray($data); 

    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }

    // if(!empty($query)) {
    //     setSessionArray($data); 
    //     // print_r('1');
    // }


    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('3');
    }
    // print_r($data);
}


// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
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

// $year = $data['DRPLANG']['YEARVALUE'];
// $year2 = $data['DRPLANG']['YEARVALUE'];
// $month = $data['DRPLANG']['MONTHVALUE'];
// $month2 = $data['DRPLANG']['MONTHVALUE'];
$unit = $data['DRPLANG']['UNIT'];

// $javaFunc->get_com();


// print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//


// $opr = getDropdownData("TRXTYPE");
// if(empty($opr)) {
//     $opr = $syslogic->getPullDownData('TRXTYPE', $_SESSION['TRXTYPE']);
//     setDropdownData("TRXTYPE", $opr);
// }

// $str = getDropdownData("STORAGETYPE");
// if(empty($str)) {
//     $str = $syslogic->getPullDownData('STORAGETYPE', $_SESSION['STORAGETYPE']);
//     setDropdownData("STORAGETYPE", $str);
// }

function sheetDetailPrint() {
    // print_r("sheetDetailPrint");
    $RowParam = array();
    // if ($_POST['action'] == 'printen') { sheetDetailPrint(); } 
    // if ($_POST['action'] == 'printth') { sheetDetailPrint(); } 
    $ENTH = isset($_POST['action']) ? $_POST['action']: '';
    $RPTDOCEN = 'INVTRANS_ASDATE_E';
    $RPTDOCTH = 'INVTRANS_ASDATE_T';
    $javafunc = new AccInvTransRptAsDate;
    // if(isset($_POST['CHECKROW'])) {
    //     for ($i = 0 ; $i < count($_POST['SHIPREQUESTVOUCHERNUMBER']); $i++) { 
    //         $RowParam[] = array('CHECKROW' => isset($_POST['CHECKROW'][$i]) ? $_POST['CHECKROW'][$i]: 'F',
    //                             'SHIPREQUESTVOUCHERNUMBER' => isset($_POST['SHIPREQUESTVOUCHERNUMBER'][$i]) ? $_POST['SHIPREQUESTVOUCHERNUMBER'][$i]: '',
    //                             'SHIPREQUESTVOUCHERLINE' => isset($_POST['SHIPREQUESTVOUCHERLINE'][$i]) ? $_POST['SHIPREQUESTVOUCHERLINE'][$i]: '',
    //                             // 'REP01' => isset($_POST['REP01'][$i]) ? $_POST['REP01'][$i]: ''
    //                         );
    //     }
    // }
    // $param = array( 'SHEETDETAILPRINT' => '',
    //                 'REP01' => $REP01,
    //                 'SALEORDERNUMBER_S' => isset($_POST['SALEORDERNUMBER_S']) ? $_POST['SALEORDERNUMBER_S']: '',
    //                 'BILLING' => isset($_POST['BILLING']) ? $_POST['BILLING']: '', 
    //                 'FACTORY' => isset($_POST['FACTORY']) ? $_POST['FACTORY']: '', 
    //                 'DATE1' => isset($_POST['DATE1']) ? str_replace('-', '', $_POST['DATE1']): '', 
    //                 'DATE2' => isset($_POST['DATE2']) ? str_replace('-', '', $_POST['DATE2']): '', 
    //                 'STAFFCODE' => isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '', 
    //                 'CATALOGCODE' => isset($_POST['CATALOGCODE']) ? $_POST['CATALOGCODE']: '',
    //                 'DATA' => $RowParam);
    // print_r($param);    
    // $print = $javafunc->print($param);
    // echo json_encode($print);
    if($ENTH == 'printen') { // EN

        // print_r("EN");
        echo json_encode("EN");
        //syslogic(Set_RptDoc_EN)	RPTDOCEN
        $printRptDocEN = $javafunc->Set_RptDoc_EN($RPTDOCEN);
        echo json_encode($printRptDocEN);
        // echo json_encode($printRptDocEN);

        $result = array('printRptDocEN' => $printRptDocEN);
        if($printRptDocEN == 'ERRO:ERRONODATAPRINT') { echo json_encode($result); exit(); }

        $RPTDATE1 = isset($data['RPTDATE1']) ? $data['RPTDATE1']: '';
        $RPTDATE2 = isset($data['RPTDATE2']) ? $data['RPTDATE2']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        $ITEMCD2 = isset($data['ITEMCD2']) ? $data['ITEMCD2']: '';

        $RPTDOC = 'INVTRANS_ASDATE_E';

        $printRptDoc = $javafunc->Print_Rpt($RPTDATE1,$RPTDATE2,$ITEMCD,$ITEMCD2,$RPTDOC);
        echo json_encode($printRptDoc);

        // printReport($printRptDoc);
        // syslogic(Print_Rpt) RPTDATE1,RPTDATE2,ITEMCD,ITEMCD2,RPTDOC

    } else { // TH

        // print_r("TH");
        echo json_encode("TH");
        //syslogic(Set_RptDoc_TH)	RPTDOCTH
        $printRptDocTH = $javafunc->Set_RptDoc_TH($RPTDOCTH);
        echo json_encode($printRptDocTH);

        $result = array('printRptDocTH' => $printRptDocTH);
        if($printRptDocTH == 'ERRO:ERRONODATAPRINT') { echo json_encode($result); exit(); }

        $RPTDATE1 = isset($data['RPTDATE1']) ? $data['RPTDATE1']: '';
        $RPTDATE2 = isset($data['RPTDATE2']) ? $data['RPTDATE2']: '';
        $ITEMCD = isset($data['ITEMCD']) ? $data['ITEMCD']: '';
        $ITEMCD2 = isset($data['ITEMCD2']) ? $data['ITEMCD2']: '';

        $RPTDOC = 'INVTRANS_ASDATE_T';

        $printRptDoc = $javafunc->Print_Rpt($RPTDATE1,$RPTDATE2,$ITEMCD,$ITEMCD2,$RPTDOC);
        echo json_encode($printRptDoc);

        // printReport($printRptDoc);
        // syslogic(Print_Rpt) RPTDATE1,RPTDATE2,ITEMCD,ITEMCD2,RPTDOC

    }

}

function printReport($printRptDoc) {
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
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_INVTRANSRPT_ASDATE.xlsx';
        // print_r($printStatic);
        // print_r($printDynamic);
        foreach ($printRptDoc as $key => $value) {
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
            $sheetExcel[$key]->getActiveSheet()->SetCellValue('A1',  $printRptDoc['DATERANGE'])  // [A] Planned Shipping
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
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF[$key]->getActiveSheet()->getPageSetup()->setFitToPage(true);
            $sheetPDF[$key]->getActiveSheet()->setShowGridLines(false);
            // $sheetPDF[$key]->getActiveSheet()->getColumnDimension('D')->setWidth('30');

            // Calculate the column widths
            // foreach(range('A', 'J') as $columnID) {
            //     $sheetPDF[$key]->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            // }
            // $sheetPDF[$key]->getActiveSheet()->calculateColumnWidths();
            // Set setAutoSize(false) so that the widths are not recalculated

            // // Set margins if needed
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setTop(0.5);
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setRight(0.5);
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setLeft(0.5);
            // $sheetPDF[$key]->getActiveSheet()->getPageMargins()->setBottom(0.5);
            // header('Content-Type: application/pdf; charset=UTF-8');
            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF[$key], 'PDF');
            // $pdf_writer->setInputEncoding('CP1252');
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

//ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
function setSessionArray($arr){
    $keepField = array('INV', 'DVPERIOD', 'RPTDATE1', 'RPTDATE2', 'ITEMCD', 'ITEMCD2', 'RPTDOCEN', 'RPTDOCTH');
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

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getDropdownData($key = "") {
    return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
    return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = "") {
    return get_sys_data(SESSION_NAME_SYSTEM, $key);
}
  
function setSystemData($key, $val) {
return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

?>