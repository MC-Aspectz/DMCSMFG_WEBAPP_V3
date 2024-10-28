<?php
    //--------------------------------------------------------------------------------
    require_once(dirname(__FILE__,1) . '/SysConfig.php');
    require_once(dirname(__FILE__, 1) . '/RTNServer.php');
    //--------------------------------------------------------------------------------
    //  SESSION
    //--------------------------------------------------------------------------------
    session_start();

    if(!empty($_SESSION)) {
        //--------------------------------------------------------------------------------
        if (empty($_SESSION['USERNAME'])) {
            // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/logout.php');
            if(isset($_SESSION['USERCODE']) && isset($_SESSION['COMPNAME']) && isset($_SESSION['COMCD']) && isset($_SESSION['COMPWD']) && isset($_SESSION['LANG']) && isset($_SESSION['HOST'])) {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/logout.php');
            } else {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/login.php');
            }
            exit;
        }  // if (empty($_SESSION['USERNAME'])) {
        //--------------------------------------------------------------------------------
        if (!isset($_SESSION['APPURL']) or empty($_SESSION['APPURL']) or empty($_SESSION['MENU'])) {
            if(isset($_SESSION['USERCODE']) && isset($_SESSION['COMPNAME']) && isset($_SESSION['COMCD']) && isset($_SESSION['COMPWD']) && isset($_SESSION['LANG']) && isset($_SESSION['HOST'])) {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/logout.php');
            } else {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/login.php');
            }
            exit;
        }  // if (!isset($_SESSION['APPURL']) or empty($_SESSION['APPURL'])) {
        //--------------------------------------------------------------------------------
        if (!isset($_SESSION['APPPATH']) or empty($_SESSION['APPPATH']) or empty($_SESSION['MENU'])) {
            if(isset($_SESSION['USERCODE']) && isset($_SESSION['COMPNAME']) && isset($_SESSION['COMCD']) && isset($_SESSION['COMPWD']) && isset($_SESSION['LANG']) && isset($_SESSION['HOST'])) {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/logout.php');
            } else {
                header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/login.php');
            }
            exit;
        }  // if (!isset($_SESSION['APPPATH']) or empty($_SESSION['APPPATH'])) {
        //--------------------------------------------------------------------------------
    } else {
        header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/login.php');
    }
?>