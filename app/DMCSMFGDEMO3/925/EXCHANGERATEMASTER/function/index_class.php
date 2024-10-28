<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class ExchangeRateM extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'EXCHANGERATEMASTER';
    }

    public function Load() {
        try {
            $Param = array();
            $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.load', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function SearchCurrent() {
        try {
            $Param = array();
            $cmd = GetRequestData($Param , 'mas.ExchangeRateMaster.searchCurrent', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function SearchExc($EXDATE,$EXRATETO) {
        try {
            $Param = array('EXDATE' => $EXDATE,'EXRATETO' => $EXRATETO);
            $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.search', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //EXRATEFR,EXRATETO,EXDATE
    public function getCurFm($EXRATEFR,$EXRATETO,$EXDATE) {
        try {
        $Param = array("EXRATEFR" => $EXRATEFR,"EXRATETO" => $EXRATETO,"EXDATE" => $EXDATE);
        $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.getCurFm', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
    }


    public function insExc($Param) {
        $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.ins', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updExc($Param) {
        $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.upd', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delExc($Param) {
        $cmd = GetRequestData($Param, 'mas.ExchangeRateMaster.del', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }






}
?>