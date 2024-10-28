<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class INVFuture extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'INVFUTURE';
    }

    public function getItem($ITEMCD) {
        try {
            $Param = array('ITEMCD' => $ITEMCD);
            $cmd = GetRequestData($Param, 'inv.InvFuture.getItem', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchItem($ITEMCD) {
        try {
            $Param = array('ITEMCD' => $ITEMCD);
            $cmd = GetRequestData($Param, 'inv.InvFuture.searchItem', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>