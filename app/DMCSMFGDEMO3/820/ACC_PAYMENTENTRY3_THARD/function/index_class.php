<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccPayment3Entry3THA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PAYMENTENTRY3_THARD';
    }

    public function getRvV3($RVNO) {
        try {
            $Param = array('RVNO' => $RVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getRvV3', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getSupplier($SUPPLIERCD) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getSupplier', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getStaff($STAFFCD) {
        try {
            $Param = array('STAFFCD' => $STAFFCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getStaff', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getCurrency($SUPPLIERCD, $SUPCURCD) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getCurrency', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getDiv($DIVISIONCD) {
        try {
            $Param = array('DIVISIONCD' => $DIVISIONCD);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getDiv', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAcc($ACCCD, $DCTYP) {
        try {
            $Param = array('ACCCD' => $ACCCD, 'DCTYP' => $DCTYP);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.getAcc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // after RUN(SEARCHJ)
    public function searchV3($RVNO, $RVSVNO, $SUPPLIERCD, $SUPCURCD, $DIVISIONCD, $INVOICENOFR, $INVOICENOTO) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO, 'SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD, 'DIVISIONCD' => $DIVISIONCD, 'INVOICENOFR' => $INVOICENOFR, 'INVOICENOTO' => $INVOICENOTO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.searchV3', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchJournalV3($RVNO, $RVSVNO) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.searchJournalV3', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setJournal($SUPPLIERCD, $SUPCURAMTTYP, $SUPCURCD, $COMCURCD, $PAYMENTDVW) {
        try {
            $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURAMTTYP' => $SUPCURAMTTYP, 'SUPCURCD' => $SUPCURCD, 'COMCURCD' => $COMCURCD, 'PAYMENTDVW' => $PAYMENTDVW);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.setJournal', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setDCTypV2($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.setDCTypV2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setSelPaid($SUPCURAMTTYP, $PAYMENTDV_SEL, $CALCBASE_OSTDAMT, $CALCBASE_VAT, $CALCBASE_WHT, $CALCBASE_OSTDTTLAMT) {
        try {
            $Param = array('SUPCURAMTTYP' => $SUPCURAMTTYP, 'PAYMENTDV_SEL' => $PAYMENTDV_SEL, 'CALCBASE_OSTDAMT' => $CALCBASE_OSTDAMT, 'CALCBASE_VAT' => $CALCBASE_VAT, 'CALCBASE_WHT' => $CALCBASE_WHT, 'CALCBASE_OSTDTTLAMT' => $CALCBASE_OSTDTTLAMT);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.setSelPaid', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function setCalcPaid($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.setCalcPaid', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function checkV3($T_PAY, $TTL_AMTC1, $TTL_AMTC2, $DATA) {
        try {
            $Param = array('T_PAY' => $T_PAY, 'TTL_AMTC1' => $TTL_AMTC1, 'TTL_AMTC2' => $TTL_AMTC2, 'DVW2' => $DATA);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.checkV3', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function commitV3($Param) {
        try {
            $cmd = $this->GetRequestDataOnly($Param, 'acc.THA.AccPaymentEntry_RD.commitV3', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cancel($RVNO, $RVSVNO) {
        try {
            $Param = array('RVNO' => $RVNO, 'RVSVNO' => $RVSVNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.cancel', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function AmtC2Down($DCTYP, $BASEAMTC2) {
        $Param = array('DCTYP' => $DCTYP, 'BASEAMTC2' => $BASEAMTC2);
        return $this->GetReques($Param,  $this->APPCODE, 'AmtC2Down');
    }
    public function AmtC2Up($DCTYP, $BASEAMTC2) {
        $Param = array('DCTYP' => $DCTYP, 'BASEAMTC2' => $BASEAMTC2);
        return $this->GetReques($Param,  $this->APPCODE, 'AmtC2Up');
    }
  
    public function PVprintStatic($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'PVprintStatic');
    }

    public function PVprintDynamic($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'PVprintDynamic');
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccPaymentEntry_RD.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    function GetRequestDataOnly($Param, $Service, $SerLogAppCd, $SerLogChapter)  {
  
        if (!defined('DELIMITER')) define('DELIMITER', '<RTNDM\>');
        if (!defined('ROWCOLDELIMITER')) define('ROWCOLDELIMITER', '#TBCOL#');
        if (!defined('DATAROWDELIMITER')) define('DATAROWDELIMITER', '#TBROW#');
        //require_once('ComEnv.php');
        if(is_readable ('./ComEnv.php')) {
            require_once('./ComEnv.php');
        }

        $ComCd = isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';
        $ComPwd = isset($_SESSION['COMPWD']) ? $_SESSION['COMPWD']: '';
        $Lang = isset($_SESSION['LANG']) ? $_SESSION['LANG']: 'EN';
        $UserId = isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';
        $DateType = '1';
        $data = '';
        $appName = 'Cloud2Mfg';
        $syslang2 = '0';

        // Server logic check
        if(($Service === '') and ($SerLogAppCd !== '') and ($SerLogChapter !== '')) {
            // Server Logic
            $data = 'FAPPCD'
            .DELIMITER
            .$SerLogAppCd
            .DELIMITER
            .'CHAPID'
            .DELIMITER
            .$SerLogChapter
            .DELIMITER
            .'SERVICECLASS'
            .DELIMITER
            .'gen.SysLogic.runSys'
            .DELIMITER;
        } elseif($Service !== '') {
            // java class
            $data = 'FAPPCD'
            .DELIMITER
            .$SerLogAppCd
            .DELIMITER
            .'APPNAME'
            .DELIMITER
            .$appName
            .DELIMITER
            .'SERVICECLASS'
            .DELIMITER
            .$Service
            .DELIMITER;;
        } else {
            return '';
        }

        // count Array Parameter
        $countArray = 0;
        foreach ($Param as $key => $val ) {
            if (is_array($val)) {
                $countArray++;
            }
        }
        // Do data
        $sequeneArray = 0;
        foreach ($Param as $key => $val ) {
            // Parameter Array
            if (is_array($val)) {
                if($countArray > 1) {
                    // for array parameter > 1
                    // print_r($sequeneArray);
                    if($sequeneArray == 0) {
                        // DVW 1
                        $data = $data.$key.DELIMITER;
                    } else {
                        // DVW more than 1
                        $data = $data.$key.DELIMITER.DELIMITER.'PAYMENTDVW'.DELIMITER;
                    }
                    $sequeneArray++;
                } else {
                    // for array parameter == 1
                    $data = $data.'DATA'.DELIMITER;
                }
                // DVW TBROW
                $rowNo = 0;
                foreach ($val as $val2) {
                    if (is_array($val2)) {

                        if($rowNo > 0) {
                            $data = $data.DATAROWDELIMITER;                          
                        }                
                        // DVW Column Name
                        if($rowNo == 0) {

                            $colNo = 0;
                            foreach ($val2 as $key3 => $val3 ) {

                                if($colNo > 0) {
                                    $data = $data.ROWCOLDELIMITER;
                                }

                                $data = $data.$key3;
                                $colNo++;
                            }   
                            $data = $data.DATAROWDELIMITER;
                        }
                        // DV Value
                        $colValNo = 0;
                        foreach ($val2 as $key3 => $val3 ) {

                            if($colValNo > 0) {
                                $data = $data.ROWCOLDELIMITER;
                            }

                            $data = $data.$val3;
                            $colValNo++;
                        } 
                    }
                    $rowNo++;
                }

            } else {
                //  Parameter String
                $data = $data.$key.DELIMITER.$val;

            }
            // Parameter DELIMITER
            $data = $data.DELIMITER;
        }

        $data = $data
        // Language
        .'SYSLANG'
        .DELIMITER
        .$Lang
        // Language2
        .DELIMITER
        .'SYSLLANG'
        .DELIMITER
        .$Lang
        .DELIMITER
        .'SYSLANG2'
        .DELIMITER
        .$syslang2
        .DELIMITER
        .'SYSLLANG2'
        .DELIMITER
        .$syslang2
        // Login user
        .DELIMITER
        .'SYSLOGINUSER'
        .DELIMITER
        .$UserId
        .DELIMITER
        .'LOGINSTAFFCD'
        .DELIMITER
        .$UserId
        .DELIMITER
        .'SYSLLOGINUSER'
        .DELIMITER
        .$UserId
        // System Date Type
        .DELIMITER
        .'SYSDATETYPE'
        .DELIMITER
        .$DateType
        .DELIMITER
        .'SYSLDATETYPE'
        .DELIMITER
        .$DateType
        // System application name ??
        .DELIMITER
        .'SYSAPPNAME'
        .DELIMITER
        .'DS'
        .DELIMITER
        .'SYSLAPPNAME'
        .DELIMITER
        .'DS'
        .DELIMITER
        // OS Name
        .'SYSCOMPUTERNAME'
        .DELIMITER
        .'PHP WEB'
        .DELIMITER
        .'SYSLCOMPUTERNAME'
        .DELIMITER
        .'PHP WEB'
        // Company Code
        .DELIMITER
        .'SYSCOMCD'
        .DELIMITER
        .$ComCd
        // Company Password
        .DELIMITER
        .'SYSCOMPWD'
        .DELIMITER
        .$ComPwd
        // Max row returns
        .DELIMITER
        .'MAXROWRETURN'
        .DELIMITER;

        return $data;
    }
}
