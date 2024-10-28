<?php
    //--------------------------------------------------------------------------------
    //  SESSION
    //--------------------------------------------------------------------------------
    // セッション開始
    require_once('../../../../common/SessionStart.php');
    //--------------------------------------------------------------------------------
    //  Load Including Files
    //--------------------------------------------------------------------------------
    require_once($_SESSION['APPPATH'] . '/include/menu.php');
    //--------------------------------------------------------------------------------
    //  Pack Code & Name, Application Code & Name
    //--------------------------------------------------------------------------------
    $arydirname = explode("/", dirname(__FILE__));
    $appcode = $arydirname[array_key_last($arydirname)- 1];
    $packcode = $arydirname[array_key_last($arydirname) - 2];
    if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
        // Get Pack Name
        $packname = "";
        foreach($_SESSION['MENU'] as $menuitem) {
            if ($menuitem['NODEDATA'] == $packcode) {
                $packname = $menuitem['NODETITLE'];
                break;  // foreach($_SESSION['MENU'] as $menuitem) {
            }  // if ($menuitem['NODEDATA'] == $packcode) {
        }  // foreach($_SESSION['MENU'] as $menuitem) {
        // Get Application Name
        $appname = "";
        foreach($_SESSION['MENU'] as $menuitem) {
            if ($menuitem['NODEDATA'] == $appcode) {
                $appname = $menuitem['NODETITLE'];
                break;  // foreach($_SESSION['MENU'] as $menuitem) {
            }  // if ($menuitem['NODEDATA'] == $appcode) {
        }  // foreach($_SESSION['MENU'] as $menuitem) {
    }  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
    //--------------------------------------------------------------------------------
    // エラーメッセージの初期化
    $errorMessage = "";
    //--------------------------------------------------------------------------------
    //  LANGUAGE
    if (isset($_SESSION['LANG'])) {
        require_once('./lang/' . strtolower($_SESSION['LANG']) . '.php');
    } else {  
        require_once('./lang/en.php');
    }  // if (isset($_SESSION['LANG'])) { else
    //--------------------------------------------------------------------------------
    //  GET
    //--------------------------------------------------------------------------------
    //
    //
    // 
    // 
    //--------------------------------------------------------------------------------
    //  POST
    //--------------------------------------------------------------------------------
    // 
    // 
    // 
    // 
    //--------------------------------------------------------------------------------
?>