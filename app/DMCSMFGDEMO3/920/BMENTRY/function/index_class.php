<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class BMEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'BMENTRY';
    }

    // mas.ItemBOM.load
    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'mas.ItemBOM.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // mas.ItemBOM.getPItem BMPITEMCD RUN(SEARCH)
    public function getPItem($BMPITEMCD) {
        $Param = array( "BMPITEMCD" => $BMPITEMCD);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.getPItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // mas.ItemBOM.getStaff STAFFCD
    public function getStaff($STAFFCD) {
        $Param = array( "STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // mas.ItemBOM.getClone ITEMCLONE,BMCOMB
    public function getClone($ITEMCLONE,$BMCOMB) {
        $Param = array( "ITEMCLONE" => $ITEMCLONE,
                        "BMCOMB" => $BMCOMB);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.getClone', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    
    // mas.ItemBOM.getCItem BMCITEMCD,PITEM
    public function getCItem($BMCITEMCD,$PITEM) {
        $Param = array( "BMCITEMCD" => $BMCITEMCD,
                        "PITEM" => $PITEM);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.getCItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    } 

    // mas.ItemBOM.searchDvw PITEM,BMVERSION RUN(CLEARE)
    // ,mas.ItemBOM.searchDvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY
    public function searchDvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$CURRENCY) {
        $Param = array( "BMPITEMCD" => $BMPITEMCD,
                        "SYSLANG" => $SYSLANG,
                        "BMVERSION" => $BMVERSION,
                        "SYSAPPNAME" => $SYSAPPNAME,
                        "PITEM" => $PITEM,
                        "BMVERSION" => $BMVERSION,
                        "CURRENCY" => $CURRENCY);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.searchDvw', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    // mas.ItemBOM.searchTvw BMPITEMCD,SYSLANG,BMVERSION,SYSAPPNAME,PITEM,BMVERSION,CURRENCY
    public function searchTvw($BMPITEMCD,$SYSLANG,$BMVERSION,$SYSAPPNAME,$PITEM,$CURRENCY) {
        $Param = array( "BMPITEMCD" => $BMPITEMCD,
                        "SYSLANG" => $SYSLANG,
                        "BMVERSION" => $BMVERSION,
                        "SYSAPPNAME" => $SYSAPPNAME,
                        "PITEM" => $PITEM,
                        "BMVERSION" => $BMVERSION,
                        "CURRENCY" => $CURRENCY);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.searchTvw', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
    // mas.ItemBOM.searchClone ITEMCLONE,BMVERSION,CURRENCY
    public function searchClone($ITEMCLONE,$BMVERSION,$CURRENCY) {
        $Param = array( "ITEMCLONE" => $ITEMCLONE,
                        "BMVERSION" => $BMVERSION,
                        "CURRENCY" => $CURRENCY);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.searchClone', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // mas.ItemBOM.chkBmExpDt BMEXPDT
    public function chkBmExpDt($BMEXPDT) {
        $Param = array( "BMEXPDT" => $BMEXPDT);
        $cmd = GetRequestData($Param, 'mas.ItemBOM.chkBmExpDt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // BMCITEMCD CITEMNAME CITEMSPEC BMBASETYP BMQTY BMSCRAPRATE BMISSUEDT BMEXPDT BMREM BMPHANTOMFLG 
    // ITEMUNITTYP BMSUPPLYTYP CITEMDRAWNO BMID BMADDSTDUNITPRC CURRENCYDISP BMADDSRPG BMADDSRPUNITPRC RUNNER_WGT REUSE_RATE

    // mas.ItemBOM.commitAll BMVERSION,PITEM,BMENTRYDT,STAFFCD,BMCITEMCD,CITEMNAME,CITEMSPEC,
    // BMBASETYP,BMQTY,ITEMUNITTYPSTR,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYPSTR,BMREM,BMPHANTOMFLG,
    // ITEMUNITTYP,BMSUPPLYTYP,CITEMDRAWNO,BMID,BMADDSTDUNITPRC,CURRENCYDISP,BMADDSRPG,BMADDSRPUNITPRC,RUNNER_WGT,REUSE_RATE
    // mas.ItemBOM.commitAll DVWDETAIL,BMVERSION,PITEM,BMENTRYDT,STAFFCD RUN(END)
    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'mas.ItemBOM.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?>