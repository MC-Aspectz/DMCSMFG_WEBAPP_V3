<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class CustomerIndex {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';


    public function __construct() {
        $this->APPCODE = 'SEARCHCUSTOMER';
    }

    public function searchCustomer($P1, $P2, $P3) {
        $Param = array("P1" => $P1, "P2" => $P2, "P3" => $P3);
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchCustomer', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getResult($P1_CUSTCD, $P2_CUSTCD, $P3_CUSTNM, $P4_SEARCHCHAR, $P5_CUSTADDR, $P6_CUSTADDR) {
        // ----------------------------------------------------------------------------------------------------
        $SQLCMD = "select";
        $SQLCMD = $SQLCMD . " CustomerCd";
        $SQLCMD = $SQLCMD . ", CustomerName";
        $SQLCMD = $SQLCMD . ", CustomerZipCode";
        $SQLCMD = $SQLCMD . ", CustomerAddr1";
        $SQLCMD = $SQLCMD . ", CustomerAddr2";
        $SQLCMD = $SQLCMD . ", CustomerTel";
        $SQLCMD = $SQLCMD . " from";
        $SQLCMD = $SQLCMD . " DsCustomerVw";
        $SQLCMD = $SQLCMD . " where";
        $SQLCMD = $SQLCMD . " (SysComCd = '::SYSCOMCD:')";
        if (($P1_CUSTCD != '') && ($P2_CUSTCD != '')) {
            $SQLCMD = $SQLCMD . " and (CustomerCd between '::P1_CUSTCD:' and '::P2_CUSTCD:')";
        } 
        elseif (($P1_CUSTCD != '')) {
            $SQLCMD = $SQLCMD . " and (CustomerCd >= '::P1_CUSTCD:')";
        }
        elseif (($P2_CUSTCD != '')) {
            $SQLCMD = $SQLCMD . " and (CustomerCd <= '::P2_CUSTCD:')";
        }
        if ($P3_CUSTNM != '') {
            $SQLCMD = $SQLCMD . " and (CustomerName like '%::P3_CUSTNM:%')";
        }
        if ($P4_SEARCHCHAR != '') {
            $SQLCMD = $SQLCMD . " and (CustomerSearch like '%::P4_SEARCHCHAR:%')";
        }
        if ($P5_CUSTADDR != '') {
            $SQLCMD = $SQLCMD . " and (CustomerAddr1 like '%::P5_CUSTADDR:%')";
        }
        if ($P6_CUSTADDR != '') {
            $SQLCMD = $SQLCMD . " and (CustomerAddr2 like '%::P6_CUSTADDR:%')";
        }
        $SQLCMD = $SQLCMD . " order by CustomerCd";
        // ----------------------------------------------------------------------------------------------------
        $Param = array( "P1_CUSTCD" => $P1_CUSTCD,
                        "P2_CUSTCD" => $P2_CUSTCD,
                        "P3_CUSTNM" => $P3_CUSTNM,
                        "P4_SEARCHCHAR" => $P4_SEARCHCHAR,
                        "P5_CUSTADDR" => $P5_CUSTADDR,
                        "P6_CUSTADDR" => $P6_CUSTADDR,
                        "SQLSTATEMENT"=> $SQLCMD
                    );
        $cmd = GetRequestData($Param, 'gen.GuideReport.getResult', 'SEARCHCUSTOMER', '');
        $data = ExecuteaLL($cmd, $errorMessage);
        // ----------------------------------------------------------------------------------------------------
        return $data;
        // ----------------------------------------------------------------------------------------------------
    }

}
?> 
