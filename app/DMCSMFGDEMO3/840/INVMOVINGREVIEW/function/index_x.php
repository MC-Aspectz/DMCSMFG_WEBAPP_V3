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


$javaFunc = new InvReview;
$data = array();
$systemName = 'InvReview';
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 18;
$rowno = 0;
//ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
$ITEMCODE ='';
$ITEMNAME ='';
$ITEMSPEC = '';
$ONHAND ='';
$BACKLOG ='';
$FROMDATE = '';
$TODATE ='';
$SYSDATE ='';
//COMPANYNAME,COMPANY_MD,TAXID,COM_CCODE
$COMPANYNAME ='';
$COMPANY_MD = '';
$TAXID ='';
$COM_CCODE ='';
$TRXTYPE ='';
$STORAGETYPE ='';


if(!empty($_POST)) {
   if(isset($_POST['SEARCH'])) {
        $data['ITEMCODE'] = $_POST['ITEMCODE'];
        $data['FROMDATE'] = $_POST['FROMDATE'];
        $data['TODATE'] = $_POST['TODATE'];

        print_r($data['FROMDATE']);
        print_r($data['TODATE']);
        //str_replace('-','',$_POST['ASOFDT']) ใช้แล้วใช้ได้เหมือนเดิมมั้ย
        //inv.InvReview.reviewMV	ITEMCODE,FROMDATE,TODATE (ไปรันgetItemต่อ)
        $query = $javaFunc->reviewMV($_POST['ITEMCODE'],str_replace('-','',$_POST['FROMDATE']),
                                    str_replace('-','',$_POST['TODATE']));
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
        if ($_POST['action'] == 'PrintReport') { PrintReport(); }
        // if ($_POST['action'] == "insert") { insert(); }
        // if ($_POST['action'] == "update") { update(); }
        // if ($_POST['action'] == "deletes") { deletes(); }

    }

}

if(checkSessionData()) { 
    $data = getSessionData(); 
}

if(!empty($_GET)) {

    if(isset($_GET['refresh'])) {
        $data = getSessionData();
        $ITEMCODE = isset($data['ITEMCODE']) ? $data['ITEMCODE']: '';
        $FROMDATE = isset($data['FROMDATE']) ? $data['FROMDATE']: '';
        $TODATE = isset($data['TODATE']) ? $data['TODATE']: '';
        
        $query = $javaFunc->reviewMV($ITEMCODE,$FROMDATE,$TODATE);
        $data['INV'] = $query;
        setSessionArray($data); 
    }
// onchange
    else if(isset($_GET['ITEMCODE'])) {
        unsetSessionkey('ITEMCODE');
        unsetSessionkey('ITEMNAME');
        unsetSessionkey('ITEMSPEC');

        $data['ITEMCODE'] = isset($_GET['ITEMCODE']) ? $_GET['ITEMCODE']: '';
        $excute = $javaFunc->getItem($_GET['ITEMCODE']);

        $data = $excute;

    }

    // itemcode   itemname  speciafication  drawingno   search  saleenddate
    else if(isset($_GET['itemcd']))
    {
        $data['ITEMCODE'] = isset($_GET['itemcd']) ? $_GET['itemcd']: '';
        $excute = $javaFunc->getItem($data['ITEMCODE']);
        // $data['ITEMNAME'] = $excute['ITEMNAME'];
        $data = $excute;

        // print_r($_GET['itemcd']);
    }

    if(!empty($excute)) {
        setSessionArray($data); 
        // print_r('1');
    }


    if(checkSessionData()) { 
        $data = getSessionData(); 
        // print_r('3');
    }
    // print_r($data);
}


$test = getSystemData($_SESSION['APPCODE']."test");
if(empty($test)) {
    // print_r('if');
    $test = $javaFunc->get_com();
    setSystemData($_SESSION['APPCODE']."test", $test);
    // print_r($test);
}
$data['COMPANYNAME'] = $test;

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

$opr = $data['DRPLANG']['TRXTYPE'];
$str = $data['DRPLANG']['STORAGETYPE'];

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

function PrintReport() {
    // date("Y-m-d")Today is 2020-11-03
    // ONHAND<RTNDM\>1,184.00<RTNDM\>
    // number_format("1000000",2)."<br>";1,000,000.00
    $ONHAND = str_replace(',', '', number_format(isset($_POST['ONHAND']) ? $_POST['ONHAND']: 0.00 ,2) );
    $BACKLOG = str_replace(',', '', number_format(isset($_POST['BACKLOG']) ? $_POST['BACKLOG']: 0.00 ,2) );
    $FROMDATE = isset($_POST['FROMDATE']) ? str_replace('-', '', $_POST['FROMDATE']): '';
    $TODATE = isset($_POST['TODATE']) ? str_replace('-', '', $_POST['TODATE']): '';
    $SYSDATE = str_replace('-', '', date("Y-m-d") );

    $printfunc = new InvReview;
    // ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
    $printStatic = $printfunc->printStatic(isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '',
                                        isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                                        isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                                        $ONHAND,
                                        $BACKLOG,
                                        $FROMDATE,
                                        $TODATE,
                                        $SYSDATE);
    $printDynamic = $printfunc->printDynamic(isset($_POST['ITEMCODE']) ? $_POST['ITEMCODE']: '',
                                        isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                                        isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                                        $ONHAND,
                                        $BACKLOG,
                                        $FROMDATE,
                                        $TODATE,
                                        $SYSDATE);
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
        // Load an existing spreadsheet
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/INVMOVINGREVIEW.xlsx';
        $itempage = 25; // per page
        foreach ($printDynamic as $key => $value) {
            $page = ceil($key/$itempage); // if($key%$item == 0) {}
            $printDynamic[$key]['PAGE'] = $page;
        }
        // print_r($printStatic);
        // print_r($printDynamic);
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
            // Header
            $cols = 0;
            foreach ($printStatic as $val) {
                $sheetExcel[$x]->getActiveSheet()->setCellValueByColumnAndRow($cols, 1, $val);
                $cols++;
            }
            // ITEM DATA
            $row = 2; // row excel new 1 start row 2 when header line 1
            foreach ($printDynamic as $key => $value) {
                $col = 0;
                if($value['PAGE'] == $x) { // separate page
                    if ($row > $itempage) { $row = 2; }  
                    foreach ($value as $item) {
                        $sheetExcel[$x]->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $item);
                        $col++;
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
            
            $report_file = 'INVENTORY_REPORT_'.$x.'_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = 'INVENTORY_REPORT_'.$x.'_'.date('Ymd_Hi').'.pdf';
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

//ITEMCODE,ITEMNAME,ITEMSPEC,ONHAND,BACKLOG,FROMDATE,TODATE,SYSDATE
function setSessionArray($arr){
    $keepField = array('INV', 'ITEMCODE', 'ITEMNAME', 'ITEMSPEC', 'ONHAND', 'BACKLOG', 'FROMDATE', 'TODATE', 'SYSDATE',
                         'COMPANYNAME');
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