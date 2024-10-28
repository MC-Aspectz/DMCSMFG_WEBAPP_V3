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
$javaFunc = new AccReceiveVoucher3THA;
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
// $data['CUSCURCD'] = $load['CUSCURCD'];
// $data['CUSCURDISP'] = $load['CUSCURDISP'];
// $data['CUSCURAMTTYP'] = $load['CUSCURAMTTYP'];
// $data['SYSMSG'] = $load['SYSMSG'];
// $data['STAFFCD'] = $load['STAFFCD'];
// $data['STAFFNAME'] = $load['STAFFNAME'];
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
        if(!empty($query)) {
            $data = array_shift($query);
            $query2 = $javaFunc->Get_PrintCount($data['RVNO']);
            if(!empty($query2)) {
                $data['PRINTFLG'] = $query2['PRINTFLG'];
                $data['SYSVIS_REPRINTREASON'] = $query2['SYSVIS_REPRINTREASON'];
                $data['SYSVIS_REPRINTLBL'] = $query2['SYSVIS_REPRINTLBL'];
            }
            if($query2['SYSVIS_REPRINTREASON'] == 'F') {
                $printCheck = $javaFunc->RVprintCheck($data['RVNO'], '');
                // print_r($printCheck);
                $data['SYSVIS_REPRINTREASON'] = $printCheck['SYSVIS_REPRINTREASON'];
                $data['SYSVIS_REPRINTLBL'] = $printCheck['SYSVIS_REPRINTLBL'];               
            }
            $itemsale = $javaFunc->searchV3($data['RVNO'], $data['RVSVNO'], $data['CUSTOMERCD'], $data['CUSCURCD'], $data['DIVISIONCD']);
            if(!empty($itemsale)) {
                $data['ITEMSALE'] = $itemsale;
            }
            $itemacc = $javaFunc->searchJournalV3($data['RVNO'], $data['RVSVNO']);
            if(!empty($itemacc)) {
                $data['ITEMACC'] = $itemacc;
            }
            // echo '<pre>';
            // print_r($query2);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($itemsale);
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
        if ($_POST['action'] == 'keepSaleItemData') { keepSaleItemData(); }
        if ($_POST['action'] == 'keepAccItemData') { keepAccItemData(); }
        if ($_POST['action'] == 'unsetAccItemData') {  unsetAccItemData($_POST['lineIndex']); }
        if ($_POST['action'] == 'DIVISIONCD') { getDivision(); }
        if ($_POST['action'] == 'CUSTOMERCD') { getCustomer(); }
        if ($_POST['action'] == 'CUSCURCD') { getCurrency(); }
        if ($_POST['action'] == 'STAFFCD') { getStaff(); }
        if ($_POST['action'] == 'ACCCD') { getAcc(); }
        if ($_POST['action'] == 'setSelReceived') { setSelReceived(); }
        if ($_POST['action'] == 'setCalcReceived') { setCalcReceived(); }
        if ($_POST['action'] == 'setDCTypV2') { setDCTypV2(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'RCprint') { RCprint(); }
        if ($_POST['action'] == 'RVprint') { RVprint(); }
        if ($_POST['action'] == 'TAXINVprint') { TAXINVprint(); }
        if ($_POST['action'] == 'TAXINVRecprint') { TAXINVRecprint(); }
        if ($_POST['action'] == 'RCprintcheck' || $_POST['action'] == 'RVprintcheck' || $_POST['action'] == 'TAXINVprintcheck' || $_POST['action'] == 'TAXINVRecprintcheck') { printCheck(); }
    } else if(isset($_POST['SEARCH'])) {
        $query = $javaFunc->searchV3($_POST['RVNO'], $_POST['RVSVNO'], $_POST['CUSTOMERCD'], $_POST['CUSCURCD'], $_POST['DIVISIONCD']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $data['ITEMSALE'] = $query;
        }
    } else if(isset($_POST['SETACC'])) {
        if(!empty($_POST['RECEIVEDV_INVNO'])) {
            for ($i = 0 ; $i < count($_POST['RECEIVEDV_INVNO']); $i++) { 
                $RowParam[] = array('RECEIVEDV_INVNO' => $_POST['RECEIVEDV_INVNO'][$i],
                                    'RECEIVEDV_DCVNO' => $_POST['RECEIVEDV_DCVNO'][$i],
                                    'RECEIVEDV_INVDT' => str_replace('-', '', $_POST['RECEIVEDV_INVDT'][$i]),
                                    'RECEIVEDV_INVTTLAMT' => isset($_POST['RECEIVEDV_INVTTLAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_INVTTLAMT'][$i])): '0.00',
                                    'RECEIVEDV_OSTDAMT' => isset($_POST['RECEIVEDV_OSTDAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_OSTDAMT'][$i])): '0.00',
                                    'RECEIVEDV_OSTDVAT' => isset($_POST['RECEIVEDV_OSTDVAT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_OSTDVAT'][$i])): '0.00',
                                    'RECEIVEDV_OSTDWHT' => isset($_POST['RECEIVEDV_OSTDWHT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_OSTDWHT'][$i])): '0.00',
                                    'RECEIVEDV_OSTDTTLAMT' => isset($_POST['RECEIVEDV_OSTDTTLAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_OSTDTTLAMT'][$i])): '0.00',
                                    'RECEIVEDV_WHTTYP' => $_POST['RECEIVEDV_WHTTYP'][$i],
                                    'CALCBASE_OSTDAMT' => isset($_POST['CALCBASE_OSTDAMT'][$i]) ? implode(explode(',', $_POST['CALCBASE_OSTDAMT'][$i])): '0.00',
                                    'CALCBASE_VAT' => isset($_POST['CALCBASE_VAT'][$i]) ? implode(explode(',', $_POST['CALCBASE_VAT'][$i])): '0.00',
                                    'CALCBASE_WHT' => isset($_POST['CALCBASE_WHT'][$i]) ? implode(explode(',', $_POST['CALCBASE_WHT'][$i])): '0.00',
                                    'CALCBASE_OSTDTTLAMT' => isset($_POST['CALCBASE_OSTDTTLAMT'][$i]) ? implode(explode(',', $_POST['CALCBASE_OSTDTTLAMT'][$i])): '0.00',
                                    'VATRATE' => isset($_POST['VATRATE'][$i]) ? implode(explode(',', $_POST['VATRATE'][$i])): '0.00',
                                    'WHTRATE' => isset($_POST['WHTRATE'][$i]) ? implode(explode(',', $_POST['WHTRATE'][$i])): '0.00',
                                    'RECEIVEDV_SEL' => $_POST['RECEIVEDV_SEL'][$i],
                                    'RECEIVEDV_RECVAT' => isset($_POST['RECEIVEDV_RECVAT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECVAT'][$i])): '0.00',
                                    'RECEIVEDV_RECTTLAMT' => isset($_POST['RECEIVEDV_RECTTLAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECTTLAMT'][$i])): '0.00',
                                    'RECEIVEDV_STATUS' => $_POST['RECEIVEDV_STATUS'][$i],
                                    'RECEIVEDV_RECAMT' => isset($_POST['RECEIVEDV_RECAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECAMT'][$i])): '',
                                    'RECEIVEDV_RECFEE' => isset($_POST['RECEIVEDV_RECFEE'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECFEE'][$i])): '',
                                    'RECEIVEDV_RECWHT' => isset($_POST['RECEIVEDV_RECWHT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECWHT'][$i])): '');
            }
            $query = $javaFunc->setJournal($_POST['CUSTOMERCD'], $_POST['CUSCURAMTTYP'], $_POST['CUSCURCD'], $_POST['COMCURCD'], $RowParam);
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
$data['INPUTCURDISP'] = $load['COMCURDISP'];
$data['COMCURCD'] = $load['COMCURCD'];
$data['COMCURDISP'] = $load['COMCURDISP'];
$data['COMCURAMTTYP'] = $load['COMCURAMTTYP'];
$data['SYSVIS_COMMIT'] = $load['SYSVIS_COMMIT'];
$data['SYSVIS_CANCEL'] = $load['SYSVIS_CANCEL'];
$data['SYSVIS_INSERT'] = $load['SYSVIS_INSERT'];
$data['SYSVIS_UPDATE'] = $load['SYSVIS_UPDATE'];
$data['SYSVIS_DELETE'] = $load['SYSVIS_DELETE'];
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
$currebcy = $data['DRPLANG']['CURRENCY'];
$currebcytyp = $data['DRPLANG']['CURRENCYTYP'];
$dctyp = $data['DRPLANG']['DC_TYP'];
$receivestatus = $data['DRPLANG']['RECEIVESTATUS'];
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
function getDivision() {
    $javafunc = new AccReceiveVoucher3THA;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDiv($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new AccReceiveVoucher3THA;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new AccReceiveVoucher3THA;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getAcc() {
    $javafunc = new AccReceiveVoucher3THA;
    $ACCCD = isset($_POST['ACCCD']) ? $_POST['ACCCD']: '';
    $DCTYP = isset($_POST['DCTYP']) ? $_POST['DCTYP']: '';
    $query = $javafunc->getAcc($ACCCD, $DCTYP);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new AccReceiveVoucher3THA;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function commit() {
    $cmtfunc = new AccReceiveVoucher3THA;
    $RowParam = array(); $RowSale = array();
    // SALE DVWSALE
    if(!empty($_POST['RECEIVEDV_INVNO'])) {
        for ($i = 0 ; $i < count($_POST['RECEIVEDV_INVNO']); $i++) { 
            $RowSale[] = array( 'RECEIVEDV_INVNO' => $_POST['RECEIVEDV_INVNO'][$i],
                                'RECEIVEDV_DCVNO' => $_POST['RECEIVEDV_DCVNO'][$i],
                                'RECEIVEDV_SEL' => $_POST['RECEIVEDV_SEL'][$i],
                                'RECEIVEDV_WHTTYP' => $_POST['RECEIVEDV_WHTTYP'][$i],
                                'RECEIVEDV_RECAMT' => isset($_POST['RECEIVEDV_RECAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECAMT'][$i])): '',
                                'RECEIVEDV_RECFEE' => isset($_POST['RECEIVEDV_RECFEE'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECFEE'][$i])): '',
                                'RECEIVEDV_RECVAT' => isset($_POST['RECEIVEDV_RECVAT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECVAT'][$i])): '0.00',
                                'RECEIVEDV_RECWHT' => isset($_POST['RECEIVEDV_RECWHT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECWHT'][$i])): '',
                                'RECEIVEDV_RECTTLAMT' => isset($_POST['RECEIVEDV_RECTTLAMT'][$i]) ? implode(explode(',', $_POST['RECEIVEDV_RECTTLAMT'][$i])): '0.00',
                                'VATRATE' => isset($_POST['VATRATE'][$i]) ? implode(explode(',', $_POST['VATRATE'][$i])): '0.00',
                                'WHTRATE' => isset($_POST['WHTRATE'][$i]) ? implode(explode(',', $_POST['WHTRATE'][$i])): '0.00');
        }
    }

    if(!empty($_POST['ACCCDA'])) {
        // ACC DVW2
        for ($i = 0 ; $i < count($_POST['ACCCDA']); $i++) { 
            $RowParam[] = array('ROWNO' => $i+1,
                                'ACCCD' => $_POST['ACCCDA'][$i],
                                'ACCNM' => $_POST['ACCNMA'][$i],
                                // 'AMT' => isset($_POST['AMTA'][$i]) ? implode(explode(',', $_POST['AMTA'][$i])): '0.00',
                                'AMT' => $_POST['AMTA'][$i],
                                'INPUTCURDISP' => $_POST['INPUTCURDISPA'][$i],
                                'EXRATE' => $_POST['EXRATEA'][$i],
                                // 'ACCAMTC1' => isset($_POST['ACCAMTC1A'][$i]) ? implode(explode(',', $_POST['ACCAMTC1A'][$i])): '0.00',
                                // 'ACCAMTC2' => isset($_POST['ACCAMTC2A'][$i]) ? implode(explode(',', $_POST['ACCAMTC2A'][$i])): '0.00',
                                'ACCAMTC1' => $_POST['ACCAMTC1A'][$i],
                                'ACCAMTC2' => $_POST['ACCAMTC2A'][$i],
                                'ACCREM' => $_POST['ACCREMA'][$i],
                                'DCTYP' => $_POST['DCTYPA'][$i],
                                'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                'WHTAXTYP' => $_POST['WHTAXTYPA'][$i]);
        }
    }

    $param = array( 'RVNO' => $_POST['RVNO'],
                    'RVSVNO' => $_POST['RVSVNO'],
                    'ISSUEDT' => str_replace('-', '', $_POST['ISSUEDT']),
                    'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'REM' => $_POST['REM'],
                    'CASH' => isset($_POST['CASH']) ? $_POST['CASH']: 'F',
                    'CHEQUE' => isset($_POST['CHEQUE']) ? $_POST['CHEQUE']: 'F',
                    'OTHER' => isset($_POST['OTHER']) ? $_POST['OTHER']: 'F',
                    'OTHER2' => $_POST['OTHER2'],
                    'BANK' => $_POST['BANK'],
                    'BRANCH' => $_POST['BRANCH'],
                    'CHQNO' => $_POST['CHQNO'],
                    'CHQDT' => str_replace('-', '', $_POST['CHQDT']),
                    'DVW2' => $RowParam,
                    'DVWSALE' => $RowSale,
                );
    // echo "<pre>";
    // print_r($param);
    // echo "</pre>";
    $ttlrecamt = isset($_POST['TTLRECAMT']) ? implode(explode(',', $_POST['TTLRECAMT'])): '0.00';
    $ttlamtc1 = isset($_POST['TTL_AMTC1']) ? implode(explode(',', $_POST['TTL_AMTC1'])): '0.00';
    $ttlamtc2 = isset($_POST['TTL_AMTC2']) ? implode(explode(',', $_POST['TTL_AMTC2'])): '0.00';
    $checkV3 = $cmtfunc->checkV3($ttlrecamt, $ttlamtc1, $ttlamtc2, $RowParam);
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
    $cancelfunc = new AccReceiveVoucher3THA;
    $cancel = $cancelfunc->cancel($_POST['RVNO'], $_POST['RVSVNO']);
    unsetSessionData();
    echo json_encode($cancel);
}

function printCheck() {
    $printfunc = new AccReceiveVoucher3THA;
    // print_r($_POST['action']);
    $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
    $REPRINTREASON = isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '';
    if($_POST['action'] == 'RCprintcheck') {
        $printCheck = $printfunc->RCprintCheck1($RVNO, $REPRINTREASON); 
    } else if($_POST['action'] == 'RVprintcheck') {
        $printCheck = $printfunc->RVprintCheck($RVNO, $REPRINTREASON);
    } else if($_POST['action'] == 'TAXINVprintcheck' || $_POST['action'] == 'TAXINVRecprintcheck') {
        $printCheck = $printfunc->IVPrintCheck($RVNO, $REPRINTREASON);
    }
    echo json_encode($printCheck);
}

function RVprint() {

    try {
        $printfunc = new AccReceiveVoucher3THA;
        $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
        $Param = array( 'RVNO' => $RVNO,
                        'RVSVNO' => isset($_POST['RVSVNO']) ? $_POST['RVSVNO']: '',
                        'RVDATE' => !empty($_POST['RVDATE']) ? str_replace('-', '', $_POST['RVDATE']): '',
                        'ISSUEDT' => !empty($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                        'RECTTL' => '');
        $printStatic = $printfunc->RVprintStatic($Param);
        $printDynamic = $printfunc->RVprintDynamic($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_RECEIVEVOUCHER3_THA_VOUCHER.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['PONUM'])
                                            ->setCellValue('B1', $printStatic['TDATE'])
                                            ->setCellValue('C1', $printStatic['NAME'])
                                            ->setCellValue('D1', $printStatic['DSC'])
                                            ->setCellValue('E1', $printStatic['DDATE'])
                                            ->setCellValue('F1', $printStatic['AMMON'])
                                            ->setCellValue('G1', $printStatic['TDEB'])
                                            ->setCellValue('H1', $printStatic['TCRE'])
                                            ->setCellValue('I1', $printStatic['F1'])
                                            ->setCellValue('J1', $printStatic['F2'])
                                            ->setCellValue('K1', $printStatic['F3'])
                                            ->setCellValue('L1', $printStatic['TRANST'])
                                            ->setCellValue('M1', $printStatic['NUMB'])
                                            ->setCellValue('N1', $printStatic['CHEQUEN'])
                                            ->setCellValue('O1', $printStatic['ROWCOUNTER']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['SEQ'])
                                            ->setCellValue('B'.$key+1, $value['ACCTRANACCCD1'])
                                            ->setCellValue('C'.$key+1, $value['ACCTRANACCCD2'])
                                            ->setCellValue('D'.$key+1, $value['ACCNO'])
                                            ->setCellValue('E'.$key+1, $value['PATI'])
                                            ->setCellValue('F'.$key+1, $value['REM'])
                                            ->setCellValue('G'.$key+1, $value['DEB'])
                                            ->setCellValue('H'.$key+1, $value['CRE'])
                                            ->setCellValue('I'.$key+1, $value['SEC'])
                                            ->setCellValue('J'.$key+1, $value['ROWCOUNTER']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $RVNO.'_RECEIVE_VOUCHER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $RVNO.'_RECEIVE_VOUCHER_'.date('Ymd_Hi').'.pdf';
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
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
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

function RCprint() {

    try {
        $printfunc = new AccReceiveVoucher3THA;
        $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
        $Param = array( 'RVNO' => $RVNO,
                        'RVSVNO' => isset($_POST['RVSVNO']) ? $_POST['RVSVNO']: '',
                        'DOCTYPE' => isset($_POST['DOCTYPE']) ? $_POST['DOCTYPE']: '',
                        'RVDATE' => !empty($_POST['RVDATE']) ? str_replace('-', '', $_POST['RVDATE']): '',
                        'ISSUEDT' => !empty($_POST['ISSUEDT']) ? str_replace('-', '', $_POST['ISSUEDT']): '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                        'RECTTL' => '');
        $printStatic = $printfunc->RCprintStatic($Param);
        $printDynamic = $printfunc->RCprintDynamic($Param);
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
                $mk = mkdir($outputPath, 0775, true);
                umask($old);
                if ($mk) {
                    // echo 'directory created';
                } else {          
                    chmod($outputPath, 0775);
                }
            }
            // --------------------------------------------------
            // Excel Sheet Index 0 for Report Layout
            // Excel Sheet Index 1 for keep Report Data
            // --------------------------------------------------
            $sheetRpt = 0; // Layout
            $sheetData = 1; // Data
            $PAGES = 2; // Pages
            // --------------------------------------------------
            $response = array();
            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_RECEIVEVOUCHER3_THA_RECEIPT.xlsx';

            
            for ($page = 1; $page <= $PAGES ; $page++) { 
                
                $receiptType; // invoice Type
                $seq = 2; // row excel new 1 start row 2

                $sheetExcel[$page] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$page]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$page]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------

                // Write Report Data to Sheet [DATA]
                $sheetExcel[$page]->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                                    ->setCellValue('B1', $printStatic['COMPNTH'])
                                                    ->setCellValue('C1', $printStatic['ADDREN'])
                                                    ->setCellValue('D1', $printStatic['ADDRTH'])
                                                    ->setCellValue('E1', $printStatic['TELO'])
                                                    ->setCellValue('F1', $printStatic['FAXO'])
                                                    ->setCellValue('G1', $printStatic['TAXNO'])
                                                    ->setCellValue('H1', $printStatic['DEPT']);
                //------------- Item List ----------- //    
                foreach ($printDynamic as $key => $value) {
                    if($value['IDXNO'] == $page) { // separate page
                        $seq = $value['NUM'] + 1;
                        $receiptType = $value['RPTTITLE'];

                        $sheetExcel[$page]->getActiveSheet()->setCellValue('A'.$seq, $value['IDXNO'])
                                                            ->setCellValue('B'.$seq, $value['RPTTITLE'])
                                                            ->setCellValue('C'.$seq, $value['RPTTITLETH'])
                                                            ->setCellValue('D'.$seq, $value['CUSTOMERCD'])
                                                            ->setCellValue('E'.$seq, $value['CUSNM'])
                                                            ->setCellValue('F'.$seq, $value['ADDRCUS1'])
                                                            ->setCellValue('G'.$seq, $value['ADDRCUS2'])
                                                            ->setCellValue('H'.$seq, $value['ADDRCUS3'])
                                                            ->setCellValue('I'.$seq, $value['CTEL'])
                                                            ->setCellValue('J'.$seq, $value['CFAX'])
                                                            ->setCellValue('K'.$seq, $value['TAXID'])
                                                            ->setCellValue('L'.$seq, $value['OFFICE'])
                                                            ->setCellValue('M'.$seq, $value['RECNO'])
                                                            ->setCellValue('N'.$seq, $value['RECDT'])
                                                            ->setCellValue('O'.$seq, $value['NUM'])
                                                            ->setCellValue('P'.$seq, $value['INV'])
                                                            ->setCellValue('Q'.$seq, $value['INVDT'])
                                                            ->setCellValue('R'.$seq, $value['ACCREM'])
                                                            ->setCellValue('S'.$seq, $value['CUR'])
                                                            ->setCellValue('T'.$seq, $value['AMTEX'])
                                                            ->setCellValue('U'.$seq, $value['VAT'])
                                                            ->setCellValue('V'.$seq, $value['INVAMT'])
                                                            ->setCellValue('W'.$seq, $value['AMT'])
                                                            ->setCellValue('X'.$seq, $value['REMARK'])
                                                            ->setCellValue('Y'.$seq, $value['TTLAMT'])
                                                            ->setCellValue('Z'.$seq, $value['TTLINVAMT'])
                                                            ->setCellValue('AA'.$seq, $value['TTLAMTTXT1'])
                                                            ->setCellValue('AB'.$seq, $value['TTLAMTTXT2'])
                                                            ->setCellValue('AC'.$seq, $value['TTLAMTTXT'])
                                                            ->setCellValue('AD'.$seq, $value['PAYTYP1'])
                                                            ->setCellValue('AE'.$seq, $value['PAYTYP2'])
                                                            ->setCellValue('AF'.$seq, $value['PAYTYP3'])
                                                            ->setCellValue('AG'.$seq, $value['OTHER2'])
                                                            ->setCellValue('AH'.$seq, $value['BANK'])
                                                            ->setCellValue('AI'.$seq, $value['BRANCH'])
                                                            ->setCellValue('AJ'.$seq, $value['CHQNO'])
                                                            ->setCellValue('AK'.$seq, $value['CHQDT']);
                    }
                }

                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$page]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$page], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $RVNO.'_'.$receiptType.'_'.date('Ymd_Hi').'.xlsx';
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
                $pdf_name = $RVNO.'_'.$receiptType.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetPDF[$page] = PHPExcel_IOFactory::load($report_path);
                // $sheetPDF[$page]->setActiveSheetIndex($sheetRpt);
                $sheetExcel[$page]->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
                $sheetExcel[$page]->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$page]->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
            
                // --------------------------------------------------
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$page]->getActiveSheet()->setShowGridLines(false);

                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setTop(0.5);
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$page], 'PDF');
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

function TAXINVprint() {

    try {
        keepSaleItemData();
        global $data; $data = getSessionData();
        $printfunc = new AccReceiveVoucher3THA;
        $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
        $Param = array( 'RVNO' => $RVNO,
                        'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                        'ISSUEDT' => str_replace('-', '', $_POST['ISSUEDT']),
                        'RVSVNO' => isset($_POST['RVSVNO']) ? $_POST['RVSVNO']: '',
                        'DOCTYPE' => isset($_POST['DOCTYPE']) ? $_POST['DOCTYPE']: '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                        'RECTTL' => '',
                        'RPTTAXINVOICE' => '',
                        'DATA' => !empty($data['ITEMSALE']) ? $data['ITEMSALE']: '');
        // print_r($Param);
        $printStatic = $printfunc->IVprintStatic($Param);
        $printDynamic = $printfunc->IVprintDynamic($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_RECEIVEVOUCHER3_THA_TAXINVOICE.xlsx';

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $seq = $value['NUM'] + 1;

                $sheetExcel[$key] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$key]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$key]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------

                // Write Report Data to Sheet [DATA]
                $sheetExcel[$key]->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                                    ->setCellValue('B1', $printStatic['COMPNTH'])
                                                    ->setCellValue('C1', $printStatic['ADDREN'])
                                                    ->setCellValue('D1', $printStatic['ADDRTH'])
                                                    ->setCellValue('E1', $printStatic['TELO'])
                                                    ->setCellValue('F1', $printStatic['FAXO'])
                                                    ->setCellValue('G1', $printStatic['TAXNO'])
                                                    ->setCellValue('H1', $printStatic['DEPT'])
                                                    ->setCellValue('I1', $printStatic['REPRINTREASON'])
                                                    ->setCellValue('J1', $printStatic['SYSVIS_REPRINTREASONLBL']);

                $sheetExcel[$key]->getActiveSheet()->setCellValue('A'.$seq, $value['IDXNO'])
                                                    ->setCellValue('B'.$seq, $value['RPTTITLE'])
                                                    ->setCellValue('C'.$seq, $value['RPTTITLETH'])
                                                    ->setCellValue('D'.$seq, $value['CUSTOMERCD'])
                                                    ->setCellValue('E'.$seq, $value['CUSNM'])
                                                    ->setCellValue('F'.$seq, $value['ADDRCUS1'])
                                                    ->setCellValue('G'.$seq, $value['ADDRCUS2'])
                                                    ->setCellValue('H'.$seq, $value['ADDRCUS3'])
                                                    ->setCellValue('I'.$seq, $value['CTEL'])
                                                    ->setCellValue('J'.$seq, $value['CFAX'])
                                                    ->setCellValue('K'.$seq, $value['SONUM'])
                                                    ->setCellValue('L'.$seq, $value['TAXID'])
                                                    ->setCellValue('M'.$seq, $value['OFFICE'])
                                                    ->setCellValue('N'.$seq, $value['SAVONUM'])
                                                    ->setCellValue('O'.$seq, $value['INDATE'])
                                                    ->setCellValue('P'.$seq, $value['PTERM'])
                                                    ->setCellValue('Q'.$seq, $value['DDATE'])
                                                    ->setCellValue('R'.$seq, $value['PONUM'])
                                                    ->setCellValue('S'.$seq, $value['NUM'])
                                                    ->setCellValue('T'.$seq, $value['CODE'])
                                                    ->setCellValue('U'.$seq, $value['ITEMDESC'])
                                                    ->setCellValue('V'.$seq, $value['QTY'])
                                                    ->setCellValue('W'.$seq, $value['DIS'])
                                                    ->setCellValue('X'.$seq, $value['UPR'])
                                                    ->setCellValue('Y'.$seq, $value['AMT'])
                                                    ->setCellValue('Z'.$seq, $value['TOTALAMT'])
                                                    ->setCellValue('AA'.$seq, $value['LDIS'])
                                                    ->setCellValue('AB'.$seq, $value['AFDIS'])
                                                    ->setCellValue('AC'.$seq, $value['TVAT'])
                                                    ->setCellValue('AD'.$seq, $value['GTOT'])
                                                    ->setCellValue('AE'.$seq, $value['PVAT'])
                                                    ->setCellValue('AF'.$seq, $value['GTOT'])
                                                    ->setCellValue('AG'.$seq, $value['GTOTEN'])
                                                    ->setCellValue('AH'.$seq, $value['GTOTTH'])
                                                    ->setCellValue('AI'.$seq, $value['CUR'])
                                                    ->setCellValue('AJ'.$seq, $value['SALEDIVCON1'])
                                                    ->setCellValue('AK'.$seq, $value['SALEDIVCON2'])
                                                    ->setCellValue('AL'.$seq, $value['SALEDIVCON3'])
                                                    ->setCellValue('AM'.$seq, $value['CUSPONO']);
            
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$key]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$key], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $RVNO.'_TAXINVOICE_'.$key.'_'.date('Ymd_Hi').'.xlsx';
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
                $pdf_name = $RVNO.'_TAXINVOICE_'.$key.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetPDF = PHPExcel_IOFactory::load($report_path);
                // $sheetPDF->setActiveSheetIndex($sheetRpt);
                $sheetExcel[$key]->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
                $sheetExcel[$key]->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$key]->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
            
                // --------------------------------------------------
                $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$key]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$key]->getActiveSheet()->setShowGridLines(false);

                $sheetExcel[$key]->getActiveSheet()->getPageMargins()->setTop(0.5);
                $sheetExcel[$key]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                $sheetExcel[$key]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                $sheetExcel[$key]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$key], 'PDF');
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

function TAXINVRecprint() {
    try {
        keepSaleItemData();
        global $data; $data = getSessionData();
        $printfunc = new AccReceiveVoucher3THA;
        $RVNO = isset($_POST['RVNO']) ? $_POST['RVNO']: '';
        $Param = array( 'RVNO' => $RVNO,
                        'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                        'ISSUEDT' => str_replace('-', '', $_POST['ISSUEDT']),
                        'RVSVNO' => isset($_POST['RVSVNO']) ? $_POST['RVSVNO']: '',
                        'DOCTYPE' => isset($_POST['DOCTYPE']) ? $_POST['DOCTYPE']: '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                        'RECTTL' => '',
                        'RPTTAXINVOICE' => '',
                        'DATA' => !empty($data['ITEMSALE']) ? $data['ITEMSALE']: '');
        $printStatic = $printfunc->IVprintStatic($Param);
        $printDynamic = $printfunc->IVprintDynamic2($Param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_RECEIVEVOUCHER3_THA_TAXINVOICE_RECEIPT.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                                ->setCellValue('B1', $printStatic['COMPNTH'])
                                                ->setCellValue('C1', $printStatic['ADDREN'])
                                                ->setCellValue('D1', $printStatic['ADDRTH'])
                                                ->setCellValue('E1', $printStatic['TELO'])
                                                ->setCellValue('F1', $printStatic['FAXO'])
                                                ->setCellValue('G1', $printStatic['TAXNO'])
                                                ->setCellValue('H1', $printStatic['DEPT'])
                                                ->setCellValue('I1', $printStatic['REPRINTREASON'])
                                                ->setCellValue('J1', $printStatic['SYSVIS_REPRINTREASONLBL']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {
                $seq = $value['NUM'] + 1;
                
                $sheetExcel->getActiveSheet()->setCellValue('A'.$seq, $value['IDXNO'])
                                                    ->setCellValue('B'.$seq, $value['RPTTITLE'])
                                                    ->setCellValue('C'.$seq, $value['RPTTITLETH'])
                                                    ->setCellValue('D'.$seq, $value['CUSTOMERCD'])
                                                    ->setCellValue('E'.$seq, $value['CUSNM'])
                                                    ->setCellValue('F'.$seq, $value['ADDRCUS1'])
                                                    ->setCellValue('G'.$seq, $value['ADDRCUS2'])
                                                    ->setCellValue('H'.$seq, $value['ADDRCUS3'])
                                                    ->setCellValue('I'.$seq, $value['CTEL'])
                                                    ->setCellValue('J'.$seq, $value['CFAX'])
                                                    ->setCellValue('K'.$seq, $value['SONUM'])
                                                    ->setCellValue('L'.$seq, $value['TAXID'])
                                                    ->setCellValue('M'.$seq, $value['OFFICE'])
                                                    ->setCellValue('N'.$seq, $value['SAVONUM'])
                                                    ->setCellValue('O'.$seq, $value['INDATE'])
                                                    ->setCellValue('P'.$seq, $value['PTERM'])
                                                    ->setCellValue('Q'.$seq, $value['DDATE'])
                                                    ->setCellValue('R'.$seq, $value['PONUM'])
                                                    ->setCellValue('S'.$seq, $value['NUM'])
                                                    ->setCellValue('T'.$seq, $value['CODE'])
                                                    ->setCellValue('U'.$seq, $value['ITEMDESC'])
                                                    ->setCellValue('V'.$seq, $value['QTY'])
                                                    ->setCellValue('W'.$seq, $value['DIS'])
                                                    ->setCellValue('X'.$seq, $value['UPR'])
                                                    ->setCellValue('Y'.$seq, $value['AMT'])
                                                    ->setCellValue('Z'.$seq, $value['TOTALAMT'])
                                                    ->setCellValue('AA'.$seq, $value['LDIS'])
                                                    ->setCellValue('AB'.$seq, $value['AFDIS'])
                                                    ->setCellValue('AC'.$seq, $value['TVAT'])
                                                    ->setCellValue('AD'.$seq, $value['GTOT'])
                                                    ->setCellValue('AE'.$seq, $value['PVAT'])
                                                    ->setCellValue('AF'.$seq, $value['GTOT'])
                                                    ->setCellValue('AG'.$seq, $value['GTOTEN'])
                                                    ->setCellValue('AH'.$seq, $value['GTOTTH'])
                                                    ->setCellValue('AI'.$seq, $value['CUR'])
                                                    ->setCellValue('AJ'.$seq, $value['SALEDIVCON1'])
                                                    ->setCellValue('AK'.$seq, $value['SALEDIVCON2'])
                                                    ->setCellValue('AL'.$seq, $value['SALEDIVCON3'])
                                                    ->setCellValue('AM'.$seq, $value['CUSPONO']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $RVNO.'_TAXINVOICE_REC_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $RVNO.'_TAXINVOICE_REC_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF->setActiveSheetIndex($sheetRpt);
            $sheetExcel->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
            $sheetExcel->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
            // $sheetExcel->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
        
            // --------------------------------------------------
            $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
            $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel->getActiveSheet()->setShowGridLines(false);

            $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.4);
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

function setSelReceived() {
    $calcfunc = new AccReceiveVoucher3THA;
    $setSelReceived = $calcfunc->setSelReceived($_POST['CUSCURAMTTYP'], $_POST['RECEIVEDV_SEL'], $_POST['CALCBASE_OSTDAMT'], $_POST['CALCBASE_VAT'], $_POST['CALCBASE_WHT'], $_POST['CALCBASE_OSTDTTLAMT']);
    echo json_encode($setSelReceived);
    // echo '<pre>';
    // print_r($setSelReceived);
    // echo '</pre>';
}

function setCalcReceived() {
    $calcfunc = new AccReceiveVoucher3THA;
    $Param = array( 'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'CALCBASE_OSTDAMT' => $_POST['CALCBASE_OSTDAMT'],
                    'CALCBASE_VAT' => $_POST['CALCBASE_VAT'],
                    'CALCBASE_WHT' => $_POST['CALCBASE_WHT'],
                    'CALCBASE_OSTDTTLAMT' => $_POST['CALCBASE_OSTDTTLAMT'],
                    'VATRATE' => $_POST['VATRATE'],
                    'WHTRATE' => $_POST['WHTRATE'],
                    'RECEIVEDV_SEL' => $_POST['RECEIVEDV_SEL'],
                    'RECEIVEDV_STATUS' => $_POST['RECEIVEDV_STATUS'],
                    'RECEIVEDV_RECAMT' => $_POST['RECEIVEDV_RECAMT'],
                    'RECEIVEDV_RECFEE' => $_POST['RECEIVEDV_RECFEE'],
                    'RECEIVEDV_RECWHT' => $_POST['RECEIVEDV_RECWHT']);
    $setCalcReceived = $calcfunc->setCalcReceived($Param);
    echo json_encode($setCalcReceived);
    // echo '<pre>';
    // print_r($setCalcReceived);
    // echo '</pre>';
}

function setDCTypV2() {
    $calcfunc = new AccReceiveVoucher3THA;
    $Param = array( 'RVDATE' => str_replace('-', '', $_POST['RVDATE']),
                    'DCTYP' => $_POST['DCTYP'],
                    'ACCCD' => $_POST['ACCCD'],
                    'AMT' => isset($_POST['AMT']) ? implode(explode(',', $_POST['AMT'])): '0.00',
                    'EXRATE' => isset($_POST['EXRATE']) ? number_format(implode(explode(',', $_POST['EXRATE'])), 6, '.', ''): '1.000000',
                    'INPUTCURDISP' => $_POST['INPUTCURDISP'],);
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

function keepSaleItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['RECEIVEDV_INVNO']); $i++) { 
        $data['ITEMSALE'][$i+1] = array('ROWNO' => $i+1,
                                        'RECEIVEDV_INVNO' => $_POST['RECEIVEDV_INVNO'][$i],
                                        'RECEIVEDV_DCVNO' => $_POST['RECEIVEDV_DCVNO'][$i],
                                        'RECEIVEDV_INVDT' => $_POST['RECEIVEDV_INVDT'][$i],
                                        'RECEIVEDV_INVTTLAMT' => $_POST['RECEIVEDV_INVTTLAMT'][$i],
                                        'RECEIVEDV_OSTDAMT' => $_POST['RECEIVEDV_OSTDAMT'][$i],
                                        'RECEIVEDV_OSTDVAT' => $_POST['RECEIVEDV_OSTDVAT'][$i],
                                        'RECEIVEDV_OSTDWHT' => $_POST['RECEIVEDV_OSTDWHT'][$i],
                                        'RECEIVEDV_OSTDTTLAMT' => $_POST['RECEIVEDV_OSTDTTLAMT'][$i],
                                        'RECEIVEDV_WHTTYP' => $_POST['RECEIVEDV_WHTTYP'][$i],
                                        'CALCBASE_OSTDAMT' => $_POST['CALCBASE_OSTDAMT'][$i],
                                        'CALCBASE_VAT' => $_POST['CALCBASE_VAT'][$i],
                                        'CALCBASE_WHT' => $_POST['CALCBASE_WHT'][$i],
                                        'CALCBASE_OSTDTTLAMT' => $_POST['CALCBASE_OSTDTTLAMT'][$i],
                                        'VATRATE' => $_POST['VATRATE'][$i],
                                        'WHTRATE' => $_POST['WHTRATE'][$i],
                                        'RECEIVEDV_RECVAT' => $_POST['RECEIVEDV_RECVAT'][$i],
                                        'RECEIVEDV_RECTTLAMT' => $_POST['RECEIVEDV_RECTTLAMT'][$i],
                                        'RECEIVEDV_STATUS' => $_POST['RECEIVEDV_STATUS'][$i],
                                        'RECEIVEDV_SEL' => $_POST['RECEIVEDV_SEL'][$i],
                                        'RECEIVEDV_RECAMT' => $_POST['RECEIVEDV_RECAMT'][$i],
                                        'RECEIVEDV_RECFEE' => $_POST['RECEIVEDV_RECFEE'][$i],
                                        'RECEIVEDV_RECWHT' => $_POST['RECEIVEDV_RECWHT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEMSALE']);
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
                                        'ACCREM' => $_POST['ACCREMA'][$i],);
    }
    setSessionArray($data);
    // print_r($data['ITEMACC']);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEMSALE', 'ITEMACC', 'RVNO', 'RVSVNO', 'ISSUEDT', 'CUSTOMERCD', 'CUSTOMERNAME', 'BRANCHKBN', 'TAXID', 'CUSCURCD', 'CUSCURDISP', 'CUSCURAMTTYP', 'RVDATE',
                        'DIVISIONCD', 'DIVISIONNAME', 'STAFFCD', 'STAFFNAME', 'REM', 'CASH', 'CHEQUE', 'OTHER', 'OTHER2', 'BANK', 'BRANCH', 'CHQNO', 'CHQDT', 'TAXINVOICENO', 'WHTAXTYP', 'ROWNO', 'ACCCD', 'ACCNM', 'AMT',
                        'INPUTCURDISP', 'EXRATE', 'ACCAMTC1', 'ACCAMTC2', 'COMCURDISP', 'DOCTYPE', 'ACCREM', 'TTLOSTDAMT', 'TTLOSTDVAT', 'TTLOSTDWHT', 'TTLOSTDTTLAMT', 'TTLRECAMT', 'TTLRECFEE', 'TTLRECVAT', 'TTLRECWHT', 
                        'TTLRECTTLAMT', 'TTL_AMT1', 'TTL_AMTC1', 'COMCURCD',  'TTL_AMTC2', 'COMCURAMTTYP', 'REPRINTREASON', 'DCTYP', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'SYSVIS_INSERT', 'SYSVIS_UPDATE', 'SYSVIS_DELETE',
                        'SYSMSG', 'SYSEN_RVDATE', 'SYSEN_CUSTOMERCD', 'SYSEN_STAFFCD', 'SYSEN_CUSCURCD', 'SYSEN_DIVISIONCD', 'SYSEN_WHTAXTTL', 'SYSEN_REM', 'SYSEN_DVW', 'SYSEN_DVW2', 'SYSEN_SEARCH', 'SYSEN_CHK',
                        'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSEN_RECEIPT', 'SYSEN_BTNTAXINV', 'SYSEN_BTNTAXINVREC', 'SYSVIS_REPRINTREASON', 'SYSVIS_REPRINTLBL', 'PRINTFLG');

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

// function RCprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccReceiveVoucher3THA;
//     $Param = array( 'RVNO' => $data['RVNO'],
//                     'RVSVNO' => $data['RVSVNO'],
//                     'ISSUEDT' => str_replace('-', '', $data['ISSUEDT']),
//                     'DOCTYPE' => $data['DOCTYPE'],
//                     'REPRINTREASON' => $data['REPRINTREASON'],
//                     'RECTTL' => isset($data['RECEIVEDV_RECTTLAMT']) ? implode(explode(',', $data['RECEIVEDV_RECTTLAMT'])): '0.00');
//     $printCheck = $printfunc->RCprintCheck1($data['RVNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     $printStatic = $printfunc->RCprintStatic($Param);
//     $printDynamic = $printfunc->RCprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         $data['PRINTDYNAMIC'] = $printDynamic; 
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['ITEMPAGE'][$printDynamic[$i]['IDXNO']] = $printDynamic[$i];
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

// function TAXINVprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccReceiveVoucher3THA;
//     $Param = array( 'ISSUEDT' => str_replace('-', '', $data['ISSUEDT']),
//                     'RVDATE' => str_replace('-', '', $data['RVDATE']),
//                     'RVNO' => $data['RVNO'],
//                     'RVSVNO' => $data['RVSVNO'],
//                     'DOCTYPE' => $data['DOCTYPE'],
//                     'REPRINTREASON' => $data['REPRINTREASON'],
//                     'RECTTL' => isset($data['RECEIVEDV_RECTTLAMT']) ? implode(explode(',', $data['RECEIVEDV_RECTTLAMT'])): '0.00',
//                     'DATA' => !empty($data['ITEMSALE']) ? $data['ITEMSALE']: '');
//     $printCheck = $printfunc->IVPrintCheck($data['RVNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     // echo '</pre>';
//     // print_r($Param);
//     // echo '</pre>';
//     $printStatic = $printfunc->IVprintStatic($Param);
//     $printDynamic = $printfunc->IVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         $data['PRINTDYNAMIC'] = $printDynamic; 
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['ITEMPAGE'][$printDynamic[$i]['IDXNO']] = $printDynamic[$i];
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

// function TAXINVRecprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccReceiveVoucher3THA;
//     $Param = array( 'ISSUEDT' => str_replace('-', '', $data['ISSUEDT']),
//                     'RVDATE' => str_replace('-', '', $data['RVDATE']),
//                     'RVNO' => $data['RVNO'],
//                     'RVSVNO' => $data['RVSVNO'],
//                     'DOCTYPE' => $data['DOCTYPE'],
//                     'REPRINTREASON' => $data['REPRINTREASON'],
//                     'RECTTL' => isset($data['RECEIVEDV_RECTTLAMT']) ? implode(explode(',', $data['RECEIVEDV_RECTTLAMT'])): '0.00',
//                     'DATA' => !empty($data['ITEMSALE']) ? $data['ITEMSALE']: '');
//     $printCheck = $printfunc->IVPrintCheck($data['RVNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     $printStatic = $printfunc->IVprintStatic($Param);
//     $printDynamic = $printfunc->IVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         $data['PRINTDYNAMIC'] = $printDynamic; 
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['ITEMPAGE'][$printDynamic[$i]['IDXNO']] = $printDynamic[$i];
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

// function RVprint() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccReceiveVoucher3THA;
//     $Param = array( 'ISSUEDT' => str_replace('-', '', $data['ISSUEDT']),
//                     'RVDATE' => str_replace('-', '', $data['RVDATE']),
//                     'RVNO' => $data['RVNO'],
//                     'RVSVNO' => $data['RVSVNO'],
//                     'REPRINTREASON' => $data['REPRINTREASON'],
//                     'RECTTL' => isset($data['RECEIVEDV_RECTTLAMT']) ? implode(explode(',', $data['RECEIVEDV_RECTTLAMT'])): '0.00');
//     $printCheck = $printfunc->RVprintCheck($data['RVNO'], isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: '');
//     $printStatic = $printfunc->RVprintStatic($Param);
//     $printDynamic = $printfunc->RVprintDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         $data['PRINTDYNAMIC'] = $printDynamic;
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
?>