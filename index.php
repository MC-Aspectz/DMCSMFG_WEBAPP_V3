<?php
    //--------------------------------------------------------------------------------
    session_start();
    //--------------------------------------------------------------------------------
    // Check Session
    if (array_key_exists('COMCD', $_SESSION) and array_key_exists('COMPWD', $_SESSION) and array_key_exists('USERCODE', $_SESSION) and array_key_exists('USERPWD', $_SESSION) and array_key_exists('HOST', $_SESSION)) {
        if ((!empty($_SESSION['COMCD'])) and (!empty($_SESSION['COMPWD'])) and (!empty($_SESSION['USERCODE'])) and (!empty($_SESSION['USERPWD'])) and (!empty($_SESSION['HOST']))) {
            //--------------------------------------------------
            echo '<pre>Check Login..</pre><br>';
            //  Check Login
            require_once('./common/RTNServer.php');
            $Param = array('P3' => $_SESSION['USERCODE']);
            $cmd = GetRequestData($Param, 'search.SearchGeneral.getStaff', '', '');
            $data = Execute($cmd, $errorMessage);
            if ($data != '' and is_array($data)) {
                header('Location:home.php');
                exit();
            }  // if ($data != ' and is_array($data)) {

            //--------------------------------------------------
        }  // if ((!empty($_SESSION['COMCD'])) and (!empty($_SESSION['COMPWD'])) and (!empty($_SESSION['USERCODE'])) and (!empty($_SESSION['USERPWD'])) and (!empty($_SESSION['HOST']))) {
    }  // if (array_key_exists('COMCD',$_SESSION) and array_key_exists('COMPWD',$_SESSION) and array_key_exists('USERCODE',$_SESSION) and array_key_exists('USERPWD',$_SESSION) and array_key_exists('HOST',$_SESSION)) {
    //--------------------------------------------------------------------------------
    // Load Login Screen
    header('Location:login.php');
    exit();
    //--------------------------------------------------------------------------------
?>

