<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class InvBalRpt extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'INVBALREPORT_THA';
    }

//SysLogic(GetInvTranBalance)	ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT 
    public function GetInvTranBalance($ACCCDF, $ACCCDT, $ITEMCDF,$ITEMCDT, $ITEMTYPF, $ITEMTYPT, $STORAGECDF, $STORAGECDT, $ASOFDT) {
        $Param = array( "ACCCDF" => $ACCCDF,
                        "ACCCDT" => $ACCCDT,
                        "ITEMCDF" => $ITEMCDF,
                        "ITEMCDT" => $ITEMCDT,
                        "ITEMTYPF" => $ITEMTYPF,
                        "ITEMTYPT" => $ITEMTYPT,
                        "STORAGECDF" => $STORAGECDF,
                        "STORAGECDT" => $STORAGECDT,
                        "ASOFDT" => $ASOFDT,);
        return $this->GetRequesAll($Param, $this->APPCODE, 'GetInvTranBalance');
    }

//SysLogic(PrintStatic)	ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT
    public function printStatic($ACCCDF, $ACCCDT, $ITEMCDF,$ITEMCDT, $ITEMTYPF, $ITEMTYPT, $STORAGECDF, $STORAGECDT, $ASOFDT) {
        $Param = array( "ACCCDF" => $ACCCDF,
                        "ACCCDT" => $ACCCDT,
                        "ITEMCDF" => $ITEMCDF,
                        "ITEMCDT" => $ITEMCDT,
                        "ITEMTYPF" => $ITEMTYPF,
                        "ITEMTYPT" => $ITEMTYPT,
                        "STORAGECDF" => $STORAGECDF,
                        "STORAGECDT" => $STORAGECDT,
                        "ASOFDT" => $ASOFDT,);
        return $this->GetReques($Param, $this->APPCODE, 'printStatic');
    }


//SysLogic(PrintDynamic)	ACCCDF,ACCCDT,ITEMCDF,ITEMCDT,ITEMTYPF,ITEMTYPT,STORAGECDF,STORAGECDT,ASOFDT
    public function printDynamic($ACCCDF, $ACCCDT, $ITEMCDF,$ITEMCDT, $ITEMTYPF, $ITEMTYPT, $STORAGECDF, $STORAGECDT, $ASOFDT) {
        $Param = array( "ACCCDF" => $ACCCDF,
                        "ACCCDT" => $ACCCDT,
                        "ITEMCDF" => $ITEMCDF,
                        "ITEMCDT" => $ITEMCDT,
                        "ITEMTYPF" => $ITEMTYPF,
                        "ITEMTYPT" => $ITEMTYPT,
                        "STORAGECDF" => $STORAGECDF,
                        "STORAGECDT" => $STORAGECDT,
                        "ASOFDT" => $ASOFDT,);
        return $this->GetReques($Param, $this->APPCODE, 'printDynamic');
    }
    // SysLogic(UpTmpInvTran1)	DVWTMP
    public function UpTmpInvTran1($DVWTMP) {
        $Param = array( "DVWTMP" => $DVWTMP,);
        return $this->GetReques($Param, $this->APPCODE, 'UpTmpInvTran1');
    }
    // SysLogic(GetAccLine)
    public function GetAccLine() {
        $Param = array( );
        return $this->GetRequesAll($Param, $this->APPCODE, 'GetAccLine');
    }

    // SysLogic(UpTmpInvTran2)	DVWTMP
    public function UpTmpInvTran2($DVWTMP) {
        $Param = array( "DVWTMP" => $DVWTMP,);
        return $this->GetReques($Param, $this->APPCODE, 'UpTmpInvTran2');
    }
    // SysLogic(GetAccSumLine)
    public function GetAccSumLine() {
        $Param = array( );
        return $this->GetRequesAll($Param, $this->APPCODE, 'GetAccSumLine');
    }
    // SysLogic(UpTmpInvTran3)	DVWTMP
    public function UpTmpInvTran3($DVWTMP) {
        $Param = array( "DVWTMP" => $DVWTMP,);
        return $this->GetReques($Param, $this->APPCODE, 'UpTmpInvTran3');
    }

    // SysLogic(GetGrandTotalLine)
    public function GetGrandTotalLine() {
        $Param = array( );
        return $this->GetRequesAll($Param, $this->APPCODE, 'GetGrandTotalLine');
    }
    // SysLogic(UpTmpInvTran4)	DVWTMP
    public function UpTmpInvTran4($DVWTMP) {
        $Param = array( "DVWTMP" => $DVWTMP,);
        return $this->GetReques($Param, $this->APPCODE, 'UpTmpInvTran4');
    }

    // SysLogic(GetTmpInvTran2Dvw)
    public function GetTmpInvTran2Dvw() {
        $Param = array( );
        return $this->GetRequesAll($Param, $this->APPCODE, 'GetTmpInvTran2Dvw');
    }

    //SysLogic(FormLoad)
    public function FormLoad() {
        $Param = array( );
        return $this->GetReques($Param, $this->APPCODE, 'FormLoad');
    }

}
?>