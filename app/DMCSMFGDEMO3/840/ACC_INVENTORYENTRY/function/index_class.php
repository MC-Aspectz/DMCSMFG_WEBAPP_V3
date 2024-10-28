<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccInventoryEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_INVENTORYENTRY';
    }

    // systemlogic  Syslogic(load)
    public function load() {
        $Param = array();
        return $this->GetReques($Param, $this->APPCODE, 'load');
    }

//acc.AccInvTranEntry.getInvTran	INVTRANNO
    public function getInvTran($INVTRANNO) {
        $Param = array( "INVTRANNO" => $INVTRANNO);
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.getInvTran', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

//acc.AccInvTranEntry.getCtrlEntryObj	INVTRANTYPE,WDPURPOSE
    public function getCtrlEntryObj($INVTRANTYPE,$WDPURPOSE) {
        $Param = array( "INVTRANTYPE" => $INVTRANTYPE,
                        "WDPURPOSE" => $WDPURPOSE);
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.getCtrlEntryObj', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //acc.AccInvTranEntry.getLoc	LOCTYP,LOCCD
    public function getLoc($LOCTYP,$LOCCD) {
        $Param = array( "LOCTYP" => $LOCTYP,
                        "LOCCD" => $LOCCD);
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.getLoc', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //acc.AccInvTranEntry.search	INVTRANNO,INVTRANTYPE
    public function search($INVTRANNO,$INVTRANTYPE) {
        $Param = array( "INVTRANNO" => $INVTRANNO,
                        "INVTRANTYPE" => $INVTRANTYPE);
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.search', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //acc.AccInvTranEntry.commitAll	DVWDETAIL,INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM
    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //acc.AccInvTranEntry.getCtrlClearObj
    public function getCtrlClearObj() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.getCtrlClearObj', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    //acc.AccInvTranEntry.getItem	ITEMCD
    public function getItem($ITEMCD) {
        $Param = array( "ITEMCD" => $ITEMCD);
        $cmd = GetRequestData($Param, 'acc.AccInvTranEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

}
?>