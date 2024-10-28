<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccWHTMethod extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_WHTMETHOD';
    }

    public function search() {
        $Param = array();
        return $this->GetRequesAll($Param,  $this->APPCODE, 'search');
    }

    public function insert($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'insert');
    }
    
    public function update($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'update');
    }
 
    public function delete($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'delete');
    }

    public function setView($PMNOTE01) {
        $Param = array("PMNOTE01" => $PMNOTE01);
        return $this->GetReques($Param,  $this->APPCODE, 'setView');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'load');
    }
}
