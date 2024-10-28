<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccAssetMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACCASSETMASTER';
    }

    public function cheak_if($ASSETCD) {
        $Param = array("ASSETCD" => $ASSETCD);
        return $this->GetReques($Param,  $this->APPCODE, 'cheak_if');
    }
    
    public function disp_photo($PICTURECD) {
        $Param = array("PICTURECD" => $PICTURECD);
        return $this->GetReques($Param,  $this->APPCODE, 'disp_photo');
    }

    public function get_exrate($I_CURRENCY, $COMCURRENCY) {
        $Param = array("I_CURRENCY" => $I_CURRENCY, "COMCURRENCY" => $COMCURRENCY);
        return $this->GetReques($Param,  $this->APPCODE, 'get_exrate');
    }

    public function get_assetacc($ASSETACC) {
        $Param = array("ASSETACC" => $ASSETACC);
        return $this->GetReques($Param,  $this->APPCODE, 'get_assetacc');
    }

    public function calc_Drate($ASSETTYP, $LIFEY) {
        $Param = array("ASSETTYP" => $ASSETTYP, "LIFEY" => $LIFEY);
        return $this->GetReques($Param,  $this->APPCODE, 'calc_Drate');
    }

    public function commit_all($ASSETCD, $DATA) {
        $Param = array("ASSETCD" => $ASSETCD, "DATA" => $DATA, "SYSDATETYPE" => '1', "SYSLDATETYPE" => '1');
        return $this->GetReques($Param,  $this->APPCODE, 'commit_all');
    }

    public function docal($DOCAL) {
        $Param = array("DOCAL" => $DOCAL);
        return $this->GetReques($Param,  $this->APPCODE, 'docal');
    }

    // ASSETTYP,PURCHAMT,LIFEY,DRATE,SOLVAGEVL,STDATE
    public function calc1($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'calc1');
    }

    public function commit_header($Param) {
        return $this->GetReques($Param,  $this->APPCODE, 'commit_header');
    }

    public function getThai($Param) {
        try {
            $cmd = GetRequestData($Param, 'acc.AssetMaster.getThai', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function get_info($ASSETCD) {
        $Param = array("ASSETCD" => $ASSETCD);
        return $this->GetReques($Param,  $this->APPCODE, 'get_info');
    }

    public function boka($ASSETCD, $PURCHAMT) {
        $Param = array("ASSETCD" => $ASSETCD, "PURCHAMT" => $PURCHAMT);
        return $this->GetReques($Param,  $this->APPCODE, 'boka');
    }

    public function load() {
        $Param = array();
        return $this->GetReques($Param,  $this->APPCODE, 'road');
    }
}
