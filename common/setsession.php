<?php 
//  Load Including Files
require_once('utils.php');
require_once('SysConfig.php');
require_once('SessionStart.php');
require_once('javaFunction.php');

// set session app modile
if(!empty($_POST)) {
	// print_r($_POST);
	if(isset($_POST['APPMOD'])) { checkSession(); } // $_SESSION['APPMOD'] = $_POST['APPMOD']; $_SESSION['APPCODE'] = ''; }
	if(isset($_POST['APPMANUAL'])) { checkSession(); $_SESSION['APPMANUAL'] = $_POST['APPMANUAL']; }
	if(isset($_POST['MPACKCODE'])) { $_SESSION['MPACKCODE'] = $_POST['MPACKCODE']; }
	// if(isset($_POST['SIDECTRL'])) { $_SESSION['SIDECTRL'] = $_POST['SIDECTRL']; }
    // if(isset($_POST['APPCDFORM'])) { $_SESSION['LEFTSIDECTRL_'.$_POST['APPCDFORM']] = $_POST['LEFTSIDECTRL']; $_SESSION['RIGHTSIDECTRL_'.$_POST['APPCDFORM']] = $_POST['RIGHTSIDECTRL']; }
	if(isset($_POST['BRIGHTNESS'])) { $_SESSION['BRIGHTNESS'] = $_POST['BRIGHTNESS']; }
    if(isset($_POST['SETLOADAPP'])) { setLoadApp(); }
    if(isset($_POST['CHANGEAPP'])) { checkSession(); chkLoadApp(); }
	if(isset($_POST['PROGRAMDELETE'])) { checkSession(); chkCloseApp(); }
    if(isset($_POST['PROGRAMRUNDELETE'])) { delChangeApp(); }
	if(isset($_POST['MESSAGE'])) { getMessage(); }
}

function chkLoadApp() {
    $javafunc = new javaFunction;
    if(isset($_POST['FAPPCD'])) {
        $chkLoadApp = $javafunc->chkLoadApp($_POST['FAPPCD']);
        echo json_encode($chkLoadApp);
    }
}

function chkCloseApp() {
    $javafunc = new javaFunction;
    if(isset($_POST['FAPPCD'])) {
        $chkCloseApp = $javafunc->chkCloseApp($_POST['FAPPCD']);
        if($chkCloseApp['APPOPEN'] > 0) { $javafunc->ProgramRundelete($_POST['FAPPCD']); unset_sys_data(strtolower($_POST['FAPPCD'])); }
        echo json_encode($chkCloseApp);
    }
}

function setLoadApp() {
    $javafunc = new javaFunction;
    if(isset($_POST['APPCODE'])) {
        $setLoadApp = $javafunc->setLoadApp($_POST['APPCODE']);
        echo json_encode($setLoadApp);
    }
}

function delChangeApp() {
    $javafunc = new javaFunction;
    if(isset($_POST['APPCODE'])) {
        $javafunc->ProgramRundelete($_POST['APPCODE']);
    }
}

function getMessage() {
    $javafunc = new javaFunction;
    $CODE = isset($_POST['CODE']) ? $_POST['CODE']: '';
    $MSG = $javafunc->getMessage($CODE, $_SESSION['LANG']);
    if(IsNullEmpty($MSG)) { echo json_encode($CODE); } else {
    echo json_encode($MSG); }
}

function checkSession() {
    if(empty($_SESSION['USERCODE']) || empty($_SESSION['COMCD']) || empty($_SESSION['APPURL']) || empty($_SESSION['APPPATH'])) {
        return header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER .'/logout.php');
    }
}
?>