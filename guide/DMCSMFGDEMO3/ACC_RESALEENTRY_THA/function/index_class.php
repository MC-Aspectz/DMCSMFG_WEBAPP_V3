<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ReSaleEntryTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_RESALEENTRY_THA';
    }

    public function getST($CANCELTRANNO) {
        try {
            $Param = array('CANCELTRANNO' => $CANCELTRANNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleTranReplaceEntry.getST', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getST2($CANCELTRANNO) {
        try {
            $Param = array('CANCELTRANNO' => $CANCELTRANNO);
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleTranReplaceEntry.getST2', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            if(!empty($errorMessage)){
              $data['alert'] = $this->setAlert($errorMessage);
            }
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function getSTLn($CANCELTRANNO) {
        $Param = array('CANCELTRANNO' => $CANCELTRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleTranReplaceEntry.getSTLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getDiv', 'ACC_SALEENTRY_THA2', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getCustomer', 'ACC_SALEENTRY_THA2', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getStaff', 'ACC_SALEENTRY_THA2', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getCurrency', 'ACC_SALEENTRY_THA2', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.THA.AccSaleTranReplaceEntry.commit', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            if(!empty($errorMessage)){
              $data['alert'] = $this->setAlert($errorMessage);
            }
            return $data;
        } catch (Exception $ex) {
            return array('alert'=> $this->setAlert($ex->getMessage()));
        }
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleTranReplaceEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function setSaleDivCon2($SALEDIVCON2CBO) {
        $Param = array( 'SALEDIVCON2CBO' => $SALEDIVCON2CBO);
        return $this->GetReques($Param, $this->APPCODE, 'setSaleDivCon2');
    }
}
