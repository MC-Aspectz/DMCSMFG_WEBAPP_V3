<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class TaxDetailEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'TaxType';
    }


//gen.TaxDetailEntry.search PROCESSTYPE,COUNTRYCD,STATECD,CITYCD
    public function search($PROCESSTYPE,$COUNTRYCD,$STATECD,$CITYCD) {
        $Param = array( "PROCESSTYPE" => $PROCESSTYPE,
                        "COUNTRYCD" => $COUNTRYCD,
                        "STATECD" => $STATECD,
                        "CITYCD" => $CITYCD,);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

//gen.TaxDetailEntry.commit PROCESSTYPE,COUNTRYCD,STATECD,CITYCD,TAXTYPECD,TDSTARTDATE,TDENDDATE
    public function commit($Param) {
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxDetailEntry.getCity COUNTRYCD,STATECD,CITYCD
    public function getCity($COUNTRYCD,$STATECD,$CITYCD) {
    $Param = array( "COUNTRYCD" => $COUNTRYCD,
                    "STATECD" => $STATECD,
                    "CITYCD" => $CITYCD,);
    $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getCity', $this->APPCODE, '');
    $data = Execute($cmd, $errorMessage);
    return $data;
}

//gen.TaxDetailEntry.getTaxType TAXTYPECD,TDSTARTDATE,ITDSTARTDATE,TDENDDATE,ITDENDDATE
    public function getTaxType($TAXTYPECD,$TDSTARTDATE,$ITDSTARTDATE,$TDENDDATE,$ITDENDDATE) {
        $Param = array( "TAXTYPECD" => $TAXTYPECD,
                        "TDSTARTDATE" => $TDSTARTDATE,
                        "ITDSTARTDATE" => $ITDSTARTDATE,
                        "TDENDDATE" => $TDENDDATE,
                        "ITDENDDATE" => $ITDENDDATE,);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getTaxType', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//gen.TaxDetailEntry.getEndDate TDENDDATE,ITDENDDATE
    public function getEndDate($TDENDDATE,$ITDENDDATE) {
        $Param = array( "TDENDDATE" => $TDENDDATE,
                        "ITDENDDATE" => $ITDENDDATE);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getEndDate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }



}
?>