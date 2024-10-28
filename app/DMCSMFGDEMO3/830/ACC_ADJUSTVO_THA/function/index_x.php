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
$javaFunc = new AccAdjustVoucherTHA;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 8;
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
// $data = $load;
$data['INP_STFCD'] = $load['INP_STFCD'];
$data['INP_STFNM'] = $load['INP_STFNM'];
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(!empty($_GET['BOOKORDERNO'])) {
        unsetSessionData();
        $data['BOOKORDERNO'] = isset($_GET['BOOKORDERNO']) ? $_GET['BOOKORDERNO']: '';
        $query = $javaFunc->getHeader($data['BOOKORDERNO']);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $print = $javaFunc->JVprintCheck($data['BOOKORDERNO'], 'T');
            // print_r($print);
            if(!empty($print)) {
                $data['SYSVIS_REPRINTREASON'] = $print['SYSVIS_REPRINTREASON'];
                $data['SYSVIS_REPRINTLBL'] = $print['SYSVIS_REPRINTLBL'];
            }
            $item = $javaFunc->getDetail($data['BOOKORDERNO'], isset($data['ACCY']) ? $data['ACCY']: '', isset($data['I_CURRENCY']) ? $data['I_CURRENCY']: '', isset($data['CURRENCY1']) ? $data['CURRENCY1']: '');
            if(!empty($item)) {
                $data['ITEM']= $item;
            }
            // echo '<pre>';
            // print_r($item);
            // echo '</pre>';
        }
    } else if(!empty($_GET['REFBOOKORDERNO'])) {
        unsetSessionData();
        $data['REFBOOKORDERNO'] = isset($_GET['REFBOOKORDERNO']) ? $_GET['REFBOOKORDERNO']: '';
        $query = $javaFunc->getRefHeader($data['REFBOOKORDERNO']);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $item = $javaFunc->getRefDetail($data['REFBOOKORDERNO'], isset($data['ACCY']) ? $data['ACCY']: '', isset($data['I_CURRENCY']) ? $data['I_CURRENCY']: '', isset($data['CURRENCY1']) ? $data['CURRENCY1']: '');
            if(!empty($item)) {
                $data['ITEM']= $item;
            }
            // echo '<pre>';
            // print_r($item);
            // echo '</pre>';
        }
    } else if(isset($_GET['CSSTYPE'])) {
        $data['CSSTYPE'] = isset($_GET['CSSTYPE']) ? $_GET['CSSTYPE']: '';
        $query = $javaFunc->setCss($data['CSSTYPE']);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
    } else if(isset($_GET['ACCTRANREMARK'])) {
        $data['ACCTRANREMARK'] = isset($_GET['ACCTRANREMARK']) ? $_GET['ACCTRANREMARK']: '';
        setSessionArray($data);
    } else if(isset($_GET['ACC_CD'])) {
        getACCCD();
    } else if(isset($_GET['RECURCD'])) {
        $query = $javaFunc->getRecur($_GET['RECURCD']);
        $data = $query;
        $data['RECURCD'] = isset($_GET['RECURCD']) ? $_GET['RECURCD']: '';
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

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
$data['CURRENCY1'] = $load['CURRENCY1'];
$data['I_CURRENCY'] = $load['I_CURRENCY'];
$data['PREFIXJV'] = $load['PREFIXJV'];
$data['DC_TYPE'] = isset($data['DC_TYPE']) ? $data['DC_TYPE']: 0;
$data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: date('Y');
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$csstyp = $data['DRPLANG']['CSS_TYP'];
$currencytyp = $data['DRPLANG']['CURRENCYTYP'];
$dctyp = $data['DRPLANG']['DC_TYP'];
$sectyp = $data['DRPLANG']['SEC_TYP'];
$whtatyp = $data['DRPLANG']['WHTAXTYP'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
setSessionData('DC_TYP', $dctyp);
setSessionData('SEC_TYP', $sectyp);
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
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'keepItemData') { keepItemData(); }
        if ($_POST['action'] == 'unsetItemData') {  unsetItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'entryUnset') { entryUnset(); }
        if ($_POST['action'] == 'getDetail') { getDetail(); }
        if ($_POST['action'] == 'DIVISIONCD') { getDiv(); }
        if ($_POST['action'] == 'CUSTOMERCODE') { getCustomer(); }
        if ($_POST['action'] == 'STAFFCODE') { getStaff(); }
        if ($_POST['action'] == 'SUPPLIERCD') { getSupllier(); }
        if ($_POST['action'] == 'getAcc') { getAcc(); }
        if ($_POST['action'] == 'getAmt') { getAmt(); }
        if ($_POST['action'] == 'ChkADJ') { ChkADJ(); }
        if ($_POST['action'] == 'getACCCD') { getACCCD(); }
        if ($_POST['action'] == 'getExRate') { getExRate(); }
        if ($_POST['action'] == 'searchRecur') { searchRecur(); }
        if ($_POST['action'] == 'commitRecurring') { commitRecurring(); }
        if ($_POST['action'] == 'commitRemark') { commitRemark(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'JVprint') { JVprint(); }
    }
}
//--------------------------------------------------------------------------------

function getDiv() {
    $javafunc = new AccGeneralVoucherTHARD;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new AccGeneralVoucherTHARD;
    $CUSTOMERCODE = isset($_POST['CUSTOMERCODE']) ? $_POST['CUSTOMERCODE']: '';
    $query = $javafunc->getCustomer($CUSTOMERCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new AccGeneralVoucherTHARD;
    $STAFFCODE = isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '';
    $query = $javafunc->getStaff($STAFFCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getSupllier() {
    $javafunc = new AccGeneralVoucherTHARD;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSupllier($SUPPLIERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
} 

function commit() {
    global $data;
    $data = getSessionData();
    // if(!empty($_POST['ROWNOA'])) { $data = getSessionData(); }
    $cmtfunc = new AccAdjustVoucherTHA;
    // print_r($_POST['ROWNOA']);
    $param = array( 'BOOKORDERNO' => $_POST['BOOKORDERNO'],
                    'VOUCHERNO' => $_POST['VOUCHERNO'],
                    'ISSUEDATE' => str_replace('-', '', $_POST['ISSUEDATE']),
                    'REFBOOKORDERNO' => $_POST['REFBOOKORDERNO'],
                    'REFVOUCHERNO' => $_POST['REFVOUCHERNO'],
                    'REFISSUEDATE' => str_replace('-', '', $_POST['REFISSUEDATE']),
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'CUSTOMERCODE' => isset($_POST['CUSTOMERCODE']) ? $_POST['CUSTOMERCODE']: '',
                    'STAFFCODE' => isset($_POST['STAFFCODE']) ? $_POST['STAFFCODE']: '',
                    'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    'CSSTYPE' => isset($_POST['CSSTYPE']) ? $_POST['CSSTYPE']: '',
                    'RECURCD' => $_POST['RECURCD'],
                    'DATA' => isset($data['ITEM']) ? $data['ITEM']: '',
                    // 'DVWDETAIL' => isset($data['ITEM']) ? $data['ITEM']: '',
                );
    // print_r($param);
    $ttlamt1 = isset($_POST['TTL_AMT1']) ? implode(explode(',', $_POST['TTL_AMT1'])): '';
    $ttlamt2 = isset($_POST['TTL_AMT2']) ? implode(explode(',', $_POST['TTL_AMT2'])): '';
    $chkCommitData = $cmtfunc->chkCommitData($ttlamt1, $ttlamt2);
    // print_r($chkCommitData);
    if (str_contains($chkCommitData, 'ERRO:')) {
        echo json_encode($chkCommitData);
        // print_r($chkCommitData);
        // echo json_encode(lang($chkCommitData));
    } else {
        $commit = $cmtfunc->commit($param);
        unsetSessionData();
        // print_r($commit);
        echo json_encode($commit);
    }
}

function JVprint() {
    global $data;
    $data = getSessionData();
    $printfunc = new AccAdjustVoucherTHA;
    $BOOKORDERNO = isset($_POST['BOOKORDERNO']) ? $_POST['BOOKORDERNO']: '';
    $Param = array( 'ACCY' => isset($_POST['ACCY']) ? $_POST['ACCY']: date('Y'),
                    'BOOKORDERNO' => $BOOKORDERNO,
                    'ISSUEDATE' => str_replace('-', '', $_POST['ISSUEDATE']),
                    'TTL_AMT1' => isset($_POST['TTL_AMT1']) ? implode(explode(',', $_POST['TTL_AMT1'])): '0.00',
                    'TTL_AMT2' => isset($_POST['TTL_AMT2']) ? implode(explode(',', $_POST['TTL_AMT2'])): '0.00',
                    'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
    $printCheck = $printfunc->JVprintCheck($data['BOOKORDERNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
    // print_r($Param);
    $printStatic = $printfunc->JVprintStatic($Param);
    $printDynamic = $printfunc->JVprintDynamic($Param);
    // print_r($printStatic);
    // print_r($printDynamic);
    // exit();
    if(!empty($printStatic) && !empty($printDynamic)) {
        printPDF($printStatic, $printDynamic, $BOOKORDERNO);
    }
}

function printPDF($printStatic, $printDynamic, $BOOKORDERNO) {

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
        $DC_TYP = isset($data['DC_TYP']) ? $data['DC_TYP']: '';
        $SEC_TYP = isset($data['SEC_TYP']) ? $data['SEC_TYP']: '';
        // Load an existing spreadsheet
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_ADJUSTVO_THA.xlsx';
        // print_r($printStatic);
        // print_r($printDynamic);
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
                                    ->setCellValue('B1', $printStatic['PONUM'])
                                    ->setCellValue('C1', $printStatic['DIVISION'])
                                    ->setCellValue('D1', $printStatic['TDATE'])
                                    ->setCellValue('E1', $printStatic['AMMON'])
                                    ->setCellValue('F1', $printStatic['TDEB'])
                                    ->setCellValue('G1', $printStatic['TCRE'])
                                    ->setCellValue('H1', $printStatic['DETAILS'])
                                    ->setCellValue('I1', $printStatic['BRANCHKBN'])
                                    ->setCellValue('J1', $printStatic['TAXID'])
                                    ->setCellValue('K1', isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '')
                                    ->setCellValue('L1', isset($_POST['DIVISIONNAME']) ? $_POST['DIVISIONNAME']: '');
        //------------- Item List ----------- //                            
        foreach ($printDynamic as $key => $value) {
                                         
            $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1,  $value['ACCNO'])
                                        ->setCellValue('B'.$key+1, $value['PATI'])
                                        ->setCellValue('C'.$key+1, $value['REM'])
                                        ->setCellValue('D'.$key+1, $value['DEB'])
                                        ->setCellValue('E'.$key+1, $value['CRE']) 
                                        ->setCellValue('F'.$key+1, !empty($value['SEC']) ? $SEC_TYP[$value['SEC']]: '')
                                        ->setCellValue('G'.$key+1, !empty($value['DCTYP']) ? $DC_TYP[$value['DCTYP']]: '')
                                        ->setCellValue('H'.$key+1, $value['REPRINTREASON']);
        }
        // --------------------------------------------------
        // Set Active Sheet to [REPORT]
        $sheetExcel->setActiveSheetIndex($sheetRpt);
        // --------------------------------------------------
        $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
        // Save Excel Report File on Server
        $report_file = $BOOKORDERNO.'_ADJUST_'.date('Ymd_Hi').'.xlsx';
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
        $pdf_name = $BOOKORDERNO.'_ADJUST_'.date('Ymd_Hi').'.pdf';
        $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
        $pdf_path = $outputPath.'/'.$pdf_name;
        $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
        $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
        if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
            die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
        }
        // $sheetPDF = PHPExcel_IOFactory::load($report_path);
        // $sheetPDF->setActiveSheetIndex($sheetRpt);
        // --------------------------------------------------
        $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
        $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
        $sheetExcel->getActiveSheet()->setShowGridLines(false);

        $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
        $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.8);
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
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------
    } 
    catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

// function JVprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccAdjustVoucherTHA;
//     $Param = array( 'ACCY' => isset($data['ACCY']) ? $data['ACCY']: date('Y'),
//                     'BOOKORDERNO' => $data['BOOKORDERNO'],
//                     'ISSUEDATE' => str_replace('-', '', $data['ISSUEDATE']),
//                     'TTL_AMT1' => isset($data['TTL_AMT1']) ? implode(explode(',', $data['TTL_AMT1'])): '0.00',
//                     'TTL_AMT2' => isset($data['TTL_AMT2']) ? implode(explode(',', $data['TTL_AMT2'])): '0.00',
//                     'REPRINTREASON' => isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     $printCheck = $printfunc->JVprintCheck($data['BOOKORDERNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     // print_r($Param);
//     $printStatic = $printfunc->JVprintStatic($Param);
//     $printDynamic = $printfunc->JVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//         }
//         setSessionArray($data);
//     }
//     // print_r($printCheck);
//     // echo '<pre>';
//     // print_r($data['PRINTSTATIC']);
//     // echo '</pre>';
//     // echo '<pre>';
//     // print_r($data['PRINTDYNAMIC']);
//     // echo '</pre>';
// }

function getACCCD() {
    global $data;
    $data = getSessionData();
    $accfunc = new AccAdjustVoucherTHA;
    if(isset($_GET['ACC_CD'])) {
        $data['ACC_CD'] = isset($_GET['ACC_CD']) ? $_GET['ACC_CD']: '';
    } else {
        $data['ACC_CD'] = isset($_POST['ACC_CD']) ? $_POST['ACC_CD']: '';   
    }
    $CSSTYPE = isset($data['CSSTYPE']) ? $data['CSSTYPE']: '';
    $SUPPLIERCD = isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: '';
    $query = $accfunc->chkAccCd($data['ACC_CD'], $CSSTYPE, $SUPPLIERCD);
    $data = $query;
    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(isset($_GET['ACC_CD'])) {
        return json_encode($query);
    } else {
        echo json_encode($query);
    }
}

function getDetail() {
    global $data;
    $data = getSessionData();
    $getfunc = new AccAdjustVoucherTHA;
    $bookorderno = isset($_POST['BOOKORDERNO']) ?  $_POST['BOOKORDERNO']: ''; 
    $accy = isset($_POST['ACCY']) ?  $_POST['ACCY']: ''; 
    $currency = isset($_POST['I_CURRENCY']) ? $_POST['I_CURRENCY']: ''; 
    $currency1 = isset($_POST['CURRENCY1']) ?  $_POST['CURRENCY1']: ''; 
    $getDetail = $getfunc->getDetail($bookorderno, $accy, $currency, $currency1);
    // print_r($getDetail);
    $data['ITEM'] = array(); unsetSessionkey('TTL_AMT1'); unsetSessionkey('TTL_AMT2');
    if(!empty($getDetail)) {
        $data['ITEM'] = $getDetail; 
    }
    setSessionArray($data);
    $data = getSessionData();
    $sectype = isset($data['SEC_TYP']) ? $data['SEC_TYP']: '';
    $response = array(  'sectype' => $sectype,
                        'getDetail' => $getDetail);
    echo json_encode($response);
}

function commitRemark() {
    $commitRemarkfunc = new AccAdjustVoucherTHA;
    $accremark = isset($_POST['ACCTRANREMARK']) ? implode(explode(',', $_POST['ACCTRANREMARK'])): '';
    $commitRemark = $commitRemarkfunc->commitRemark($accremark);
    echo json_encode($commitRemark);
}

function searchRecur() {
    global $data;
    $data = getSessionData();
    $recurfunc = new AccAdjustVoucherTHA;
    $recurcd = isset($_POST['RECURCD']) ? implode(explode(',', $_POST['RECURCD'])): ''; 
    $searchRecur = $recurfunc->searchRecur($recurcd);
    // print_r($searchRecur);
    $data['ITEM'] = array(); unsetSessionkey('TTL_AMT1'); unsetSessionkey('TTL_AMT2');
    if(!empty($searchRecur)) {
        $data['ITEM'] = $searchRecur; 
    }
    setSessionArray($data); 
    $data = getSessionData();
    $sectype = isset($data['SEC_TYP']) ? $data['SEC_TYP']: '';
    $response = array(  'sectype' => $sectype,
                        'searchRecur' => $searchRecur);
    echo json_encode($response);
}

function commitRecurring() {
    global $data;
    $data = getSessionData();
    if(!empty($data['ITEM'])) {
        $commitRecurringfunc = new AccAdjustVoucherTHA;
        $recurcd = isset($_POST['RECURCD']) ? implode(explode(',', $_POST['RECURCD'])): '';
        $commitRecurring = $commitRecurringfunc->commitRecurring($recurcd, $data['ITEM']);
        // // print_r($commitRecurring);
        if($commitRecurring) {
            $data['SYSVIS_SAVEREC'] = $commitRecurring['SYSVIS_SAVEREC'];
            $data['SYSVIS_RE01'] = $commitRecurring['SYSVIS_RE01'];
            setSessionArray($data);
        }
        echo json_encode($commitRecurring);
    } else {
        echo json_encode('ERRO_NO_INPUT_RECURRINGDATA');
    }
}

function ChkADJ() {
    global $data;
    $data = getSessionData();
    $adjfunc = new AccAdjustVoucherTHA;
    $ADJFLAG = isset($_POST['ADJFLAG']) ? implode(explode(',', $_POST['ADJFLAG'])): '';
    $ChkADJ = $adjfunc->ChkADJ($ADJFLAG);
    // print_r($ChkADJ);
    if($ChkADJ) {
        $data['SYSEN_DELETE'] = $ChkADJ['SYSEN_DELETE'];
        $data['SYSEN_UPDATE'] = $ChkADJ['SYSEN_UPDATE'];
        setSessionArray($data);
    }
    echo json_encode($ChkADJ);
}

function getAcc() {
    // global $data;
    // $data = getSessionData();
    $accfunc = new AccAdjustVoucherTHA;
    $amt = isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00';
    $dctyp = isset($_POST['DC_TYPE']) ? implode(explode(',', $_POST['DC_TYPE'])): '';
    $acccd = isset($_POST['ACC_CD']) ? implode(explode(',', $_POST['ACC_CD'])): '';
    $currency = isset($_POST['I_CURRENCY']) ? implode(explode(',', $_POST['I_CURRENCY'])): 'THB'; 
    $currency1 = isset($_POST['CURRENCY1']) ? implode(explode(',', $_POST['CURRENCY1'])): 'THB'; 
    $exrate = isset($_POST['EXRATE']) ? implode(explode(',', $_POST['EXRATE'])): '1.000000';
    $getAmt = $accfunc->getAmt($amt, $dctyp, $exrate);
    $getAcc = $accfunc->getAcc($dctyp, $acccd, $amt, $currency, $currency1, $exrate);
    // print_r($getAmt);
    // print_r($getAcc);
    echo json_encode($getAmt);
}

function getAmt() {
    global $data;
    $data = getSessionData();
    $amtfunc = new AccAdjustVoucherTHA;
    $amt = isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00';
    $dctyp = isset($_POST['DC_TYPE']) ? implode(explode(',', $_POST['DC_TYPE'])): '';
    $exrate = isset($_POST['EXRATE']) ? implode(explode(',', $_POST['EXRATE'])): '1.000000';
    $getAmt = $amtfunc->getAmt($amt, $dctyp, $exrate);
    // print_r($getAmt);
    echo json_encode($getAmt);
}

function getExRate() {
    global $data;
    $data = getSessionData();
    $exratefunc = new AccAdjustVoucherTHA;
    $currency = isset($_POST['I_CURRENCY']) ? implode(explode(',', $_POST['I_CURRENCY'])): 'THB'; 
    $currency1 = isset($_POST['CURRENCY1']) ? implode(explode(',', $_POST['CURRENCY1'])): 'THB'; 
    $amt = isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00';
    $dctyp = isset($_POST['DC_TYPE']) ? implode(explode(',', $_POST['DC_TYPE'])): '';
    $issuedate = isset($_POST['ISSUEDATE']) ? str_replace('-', '', $data['ISSUEDATE']): '';
    $getExRate = $exratefunc->getExRate($currency, $currency1, $amt, $dctyp, $issuedate);
    // print_r($getExRate);
    echo json_encode($getExRate);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'ACC_CD' => $_POST['ACC_CDA'][$i],
                                    'ACC_NM' => $_POST['ACC_NMA'][$i],
                                    'ACCTRANREMARK' => $_POST['ACCTRANREMARKA'][$i],
                                    'ACCAMT1' => $_POST['ACCAMT1A'][$i],
                                    'ACCAMT2' => $_POST['ACCAMT2A'][$i],
                                    'SECTION1' => $_POST['SECTION1A'][$i],
                                    'PROJECTNO' => $_POST['PROJECTNOA'][$i],
                                    'ADJFLAG' => $_POST['ADJFLAGA'][$i],
                                    'DC_TYPE' => $_POST['DC_TYPEA'][$i],
                                    'CURRENCY1' => $_POST['CURRENCY1A'][$i],
                                    'I_CURRENCY' => $_POST['I_CURRENCYA'][$i],
                                    'EXRATE' => $_POST['EXRATEA'][$i],
                                    'AMT' => $_POST['AMTA'][$i],
                                    'WHTAXTYP' => $_POST['WHTAXTYPA'][$i],
                                    'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

function entryUnset() {
    unsetSessionkey('ACC_CD');
    unsetSessionkey('ACC_NM');
    unsetSessionkey('ACCTRANREMARK');
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'BOOKORDERNO', 'ACCBOKGUIDE9', 'ISSUEDATE', 'COMCURRENCY', 'ACCY', 'CURRENCY1', 'INP_STFCD', 'INP_STFNM', 'DIVISIONCD', 'DIVISIONNAME', 'CSSTYPE', 'CUSTOMERCODE', 'CUSTOMERNAME', 'ITEM', 'GENERALV', 'REPRINTREASON', 'TTL_AMT1', 'TTL_AMT2', 'ROWNO', 'DC_TYPE', 'DEBIT', 'CREDIT', 'ACC_CD', 'ACC_NM', 'ACCAMT1', 'ACCAMT2', 'CURRENCY1', 'AMT', 'I_CURRENCY', 'EXRATE', 'PROJECTNO', 'TAXINVOICENO', 'WHTAXTYP', 'SECTION1', 'RECURCD', 'ACCTRANREMARK', 'SYSVIS_CANCELLBL', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SYSVIS_INS', 'SYSVIS_UPD', 'SYSVIS_DEL', 'STAFFCODE', 'STAFFNAME', 'SYSVIS_CUSTOMERCODE', 'SYSVIS_CUSTOMERNAME', 'SYSVIS_STAFFCODE', 'SYSVIS_STAFFNAME', 'SYSVIS_SUPPLIERCD', 'SYSVIS_SUPPLIERNAME', 'SYSVIS_BRANCHKBN', 'SYSVIS_TAXID', 'SUPPLIERCD', 'SUPPLIERNAME', 'BRANCHKBN', 'TAXID', 'SYSVIS_SAVEREC', 'SYSVIS_RE01', 'SYSVIS_CANCELLBL', 'SYSEN_CANCEL', 'SYSEN_CLEARE', 'SYSEN_COMMIT', 'SYSEN_INSERT', 'SYSEN_UPDATE', 'SYSEN_DELETE', 'SYSEN_DIVISIONCD', 'SYSEN_CUSTOMERCODE', 'SYSEN_SUPPLIERCD', 'SYSEN_STAFFCODE', 'SYSEN_ISSUEDATE', 'SYSEN_CSSTYPE', 'SYSEN_DVWDETAIL', 'SYSVIS_REPRINTREASON', 'SYSVIS_REPRINTLBL', 'REPRINTREASON', 'VOUCHERNO', 'PREFIXJV', 'SYSVIS_INSERT', 'SYSVIS_UPDATE', 'SYSVIS_DELETE', 'REFBOOKORDERNO', 'REFVOUCHERNO', 'REFISSUEDATE', 'SYSEN_REFBOOKORDERNO', 'SYSEN_REFISSUEDATE', 'SYSEN_DC_TYPE', 'SYSEN_ACC_CD', 'SYSEN_AMT', 'SYSEN_CURRENCYTYP', 'SYSEN_EXRATE', 'SYSEN_PROJECTNO', 'SYSEN_TAXINVOICENO', 'DC_TYP', 'SEC_TYP');

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

function unsetItemData($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>