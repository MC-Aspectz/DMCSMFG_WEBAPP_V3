<?php
    //--------------------------------------------------------------------------------
    //  LANGUAGE DETECT
    //--------------------------------------------------------------------------------
    // $httplang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    // if ($httplang == "ja" || $httplang == "jp" || $httplang == "JA" || $httplang == "JP") {
    //     $lang = "JP";
    //     require_once('./lang/JP/Login.php');
    // } else {
    //     $lang = "EN";
    //     require_once('./lang/EN/Login.php');
    // }
    //--------------------------------------------------------------------------------
    //  SESSION
    //--------------------------------------------------------------------------------
    // セッション開始
    session_start();
    //--------------------------------------------------------------------------------
    try {
        // セッションの変数のクリア
        $_SESSION = array();
        // セッションクリア
        @session_destroy();
    } catch (Exception $e) {
        return;
    }
    //--------------------------------------------------------------------------------
    // セッション開始
    session_start();
    //--------------------------------------------------------------------------------
    if (isset($_SESSION['LANG'])) {
        if ($_SESSION['LANG'] == "JP") {
            require_once('./lang/jp/login.php');
        } elseif ($_SESSION['LANG'] == "TH") {
            require_once('./lang/th/login.php');
        } else {
            require_once('./lang/en/login.php');
        }
    } else {
        require_once('./lang/en/login.php');
    }
    //--------------------------------------------------------------------------------
    // エラーメッセージの初期化
    $errorMessage = "";
    //--------------------------------------------------------------------------------
    //  GET
    //--------------------------------------------------------------------------------
    //
    //
    //--------------------------------------------------------------------------------
    //  POST
    //--------------------------------------------------------------------------------
    // ログインボタンが押された場合
    if (isset($_POST["login"])) {
        //--------------------------------------------------------------------------------
        //session_idを新しく生成し、置き換える
        session_regenerate_id(true);
        //--------------------------------------------------------------------------------
        $_SESSION['USERCODE'] = $_POST['UserId'];
        $_SESSION['USERPWD'] = $_POST['UserPwd'];
        $_SESSION['COMCD'] = $_POST['ComCd'];
        $_SESSION['COMPWD'] = $_POST['ComPwd'];
        $_SESSION['HOST'] = $_POST['HostURL'];
        $_SESSION['LANG'] = strtoupper($_POST['Lang']);
        //--------------------------------------------------------------------------------
        //  REQUIRE RTNServer.php
        //--------------------------------------------------------------------------------
        require_once('./common/RTNServer.php');
        //--------------------------------------------------------------------------------
        $Param = array("P3" => $_POST['UserId']);
        $cmd = GetRequestData($Param,'search.SearchGeneral.getStaff','','');
        // echo "<pre>cmd = {$cmd}</pre><br>";
        $data = Execute($cmd, $errorMessage);
        // echo "<pre>data = {$data}</pre><br>";
        if ($data != "" and is_array($data)) {
            $_SESSION['USERNAME'] =$data['P3NAME'];
            echo "<pre>UserName = {$data['P3NAME']}</pre><br>";

            setcookie("USERCODE", $_POST['UserId'], time() + 86400*10, "", "", true, true);
            setcookie("USERPWD", $_POST['UserPwd'], time() + 86400*10, "", "", true, true);
            setcookie("COMCD", $_POST['ComCd'], time() + 86400*10, "", "", true, true);
            setcookie("COMPWD", $_POST['ComPwd'], time() + 86400*10, "", "", true, true);
            setcookie("HOST", $_POST['HostURL'], time() + 86400*10, "", "", true, true);
            setcookie("LANG", strtoupper($_POST['Lang']), time() + 86400*10, "", "", true, true);

            header("Location:home.php");

            exit();  // 処理終了
        } else {
            $errorMessage = 'No Data.';
        }
    } else {
        if (isset($_COOKIE["USERCODE"])){
            $_POST['UserId']=$_COOKIE["USERCODE"];
        }
        if (isset($_COOKIE["USERPWD"])){
            $_POST['UserPwd']=$_COOKIE["USERPWD"];
        }
        if (isset($_COOKIE["COMCD"])){
            $_POST['ComCd']=$_COOKIE["COMCD"];
        }
        if (isset($_COOKIE["COMPWD"])){
            $_POST['ComPwd']=$_COOKIE["COMPWD"];
        }
        if (isset($_COOKIE["HOST"])){
            $_POST['HostURL']=$_COOKIE["HOST"];
        }
        if (isset($_COOKIE["LANG"])){
            $_POST['Lang']=$_COOKIE["LANG"];
        }
    }
    //--------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DMCS Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Bootstrap  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!--  Load Google Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <!-- -------------------------------------------------------------------------------- -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- -------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="./css/login_html.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
    <div class="PageArea">
        <!-- -------------------------------------------------------------------------------- -->
        <!-- Page Main -->
        <div class="MainArea">
            <div class="TopArea">
                <img src="./img/dmcs_logo.jpg" alt="DMCS">
            </div>
            <div class="CenterArea">
                <div class="FormArea">
                    <form id="loginForm" name="LoginForm" action="" method="POST" autocomplete="on">
                        <table class="table1">
                            <tr>
                                <td class="tdpadding20">
                                    <table class="tableform">
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                                <label class="ComCd"><?php echo $txtbylang['compcode'] ?></label>
                                            </td>
                                            <td colspan="2">
                                                <input type="text" id="ComCd" name="ComCd" class="ComCd" placeholder="<?php echo $txtbylang['compcode'] ?>" autofocus="on" value="<?php if(!empty($_POST["ComCd"])) {echo htmlspecialchars($_POST["ComCd"], ENT_QUOTES);} else {if(isset($_COOKIE["COMCD"])) {echo htmlspecialchars($_COOKIE["COMCD"], ENT_QUOTES);}} ?>" required>
                                            </td>
                                            <td class="td4">
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                                <label class="ComPwd"><?php echo $txtbylang['comppwd'] ?></label>
                                            </td>
                                            <td colspan="2">
                                                <input type="password" id="ComPwd" name="ComPwd" class="ComPwd" placeholder="<?php echo $txtbylang['comppwd'] ?>" value="" required>
                                            </td>
                                            <td class="td4">
                                            </td>
                                        </tr>
                                        <tr class="trline" valign="middle">
                                            <td colspan="4">
                                                <hr style="width: 90%;text-align: left;margin-left: 5%;">
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                                <label class="UserID"><?php echo $txtbylang['userid'] ?></label>
                                            </td>
                                            <td colspan="2">
                                                <input type="text" id="UserId" name="UserId" class="UserID" placeholder="<?php echo $txtbylang['userid'] ?>" value="<?php if(!empty($_POST["UserId"])) {echo htmlspecialchars($_POST["UserId"], ENT_QUOTES);} else {if(isset($_COOKIE["USERCODE"])) {echo htmlspecialchars($_COOKIE["USERCODE"], ENT_QUOTES);}} ?>" required>
                                            </td>
                                            <td class="td4">
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                                <label class="UserPwd"><?php echo $txtbylang['userpwd'] ?></label>
                                            </td>
                                            <td colspan="2">
                                                <input type="password" id="UserPwd" name="UserPwd" class="UserPwd" placeholder="<?php echo $txtbylang['userpwd'] ?>" value="" required>
                                            </td>
                                            <td class="td4">
                                                <input type="submit" id="login" name="login" value="<?php echo $txtbylang['btnlogin'] ?>" class="BtnLogin">
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                                <label class="SvrURL"><?php echo $txtbylang['serverurl'] ?></label>
                                            </td>
                                            <td class="td_svrurl" colspan="3">
                                                <input type="text" id="HostURL" name="HostURL" class="HostURL" placeholder="<?php echo $txtbylang['serverurl'] ?>" value="<?php if(!empty($_POST["HostURL"])) {echo htmlspecialchars($_POST["HostURL"], ENT_QUOTES);} ?>" required>
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td1">
                                            </td>
                                            <td class="td_language">
                                                <select id="Lang" name="Lang" class="language">
                                                    <option value="EN" selected>English</option>
                                                    <option value="JP">Japanese</option>
                                                    <!-- <option value="CN">Chinese</option> -->
                                                    <!-- <option value="ES">Spanish</option> -->
                                                    <option value="TH">Thai</option>
                                                    <!-- <option value="KR">Korean</option> -->
                                                </select>
                                            </td>
                                            <td class="td_locallang" colspan="2">
                                                <select id="language2" name="language2" class="language">
                                                    <option value="" selected>Local language</option>
                                                    <option value="EN">English</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="tr1" valign="middle">
                                            <td class="td_errmsg" colspan="4">
                                                <label class="ErrMsg"><?php echo $errorMessage; ?></label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </from>
                </div>
            </div>
            <div class="BottomArea">
                <table class="tablesoftwaretext">
                    <tr class="trsoftwaretext" valign="top">
                        <td class="tdsoftwaretext">
                            <p>This software was developed by Cloud2Works (Thailand) Co.,Ltd.<br>
                            Its software house ID is XXXX and the software number of this software is X-XXXX.<br>
                            This software is standard software of The Revenue Department belonging to tax type ข.</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- -------------------------------------------------------------------------------- -->
    </div>
</body>
</html>
