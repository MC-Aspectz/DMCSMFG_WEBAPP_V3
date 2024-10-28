<?php
require_once(dirname(__FILE__, 5) . '/common/syslogic.php');
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class ShipReqSaleOrderGuide extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SEARCHSALENOSHIP';
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'sale.SaleOrderEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCus($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'sale.SaleOrderEntry.getCus', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCODE) {
        $Param = array('ITEMCODE' => $ITEMCODE);
        return $this->GetReques($Param,  $this->APPCODE, 'COMMON:getItem');
    }

    public function Search_Order($Param) {
        return $this->GetRequesAll($Param,  $this->APPCODE, 'Search_Order');
    }
}
?> 
