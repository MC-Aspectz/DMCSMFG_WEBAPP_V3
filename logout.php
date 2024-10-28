<?php 
    require_once(dirname(__FILE__, 1) . '/common/RTNServer.php');
    //--------------------------------------------------------------------------------
    //  SESSION
    //--------------------------------------------------------------------------------
    session_start();
    //--------------------------------------------------------------------------------
    try {
        // logout close app
        if(!empty($_SESSION['USERCODE'])) { deleteAll(); }
        $_SESSION = array();

        @session_destroy();

    } catch (Exception $e) {
        return;
    }
    //--------------------------------------------------------------------------------
    header('Location:login.php');
    exit;
    //--------------------------------------------------------------------------------
    function deleteAll() {
        $Param = array( 'STAFFCD' => $_SESSION['USERCODE'],
                        'COMPUTERNAME' => $_SESSION['COMPNAME']);
        $cmd = GetRequestData($Param, 'gen.ProgramRun.deleteAll', '', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
?>