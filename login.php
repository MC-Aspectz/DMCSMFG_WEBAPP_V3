<?php
    //--------------------------------------------------------------------------------
    require_once(dirname(__FILE__,1) . '/common/SysConfig.php');
    //--------------------------------------------------------------------------------
    //  SESSION
    //--------------------------------------------------------------------------------
    session_start();
    //--------------------------------------------------------------------------------
    if (isset($_SESSION['COMCD']) and ($_SESSION['COMCD'] != '') and isset($_SESSION['USERCODE']) and ($_SESSION['USERCODE'] != '') and isset($_SESSION['USERNAME'])) {
        //--------------------------------------------------------------------------------
        //  Bypass Login to Home
        header('Location:home.php');
        exit();
        //--------------------------------------------------------------------------------
    } else {
        //--------------------------------------------------------------------------------
        try {
            $_SESSION = array();
            @session_destroy();
        } catch (Exception $e) {
            return;
        }
        //--------------------------------------------------------------------------------
    }  // if ((isset($_SESSION['USERCODE'])) && ($_SESSION['USERCODE'] != '')) {
    //--------------------------------------------------------------------------------
    session_start();
    //--------------------------------------------------------------------------------
    //  SESSION CONSTANT
    $_SESSION['APPURL'] = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $APP_FOLDER;
    // $_SESSION['APPURL'] = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'boom';
    $_SESSION['APPPATH'] = dirname(__FILE__, 1);
    //--------------------------------------------------------------------------------
    //  LANGUAGE DETECT
    //--------------------------------------------------------------------------------
    if (isset($_SESSION['LANG'])) {
        if ($_SESSION['LANG'] == 'JP') {
            // require_once('./lang/jp/login.php');
            require_once(dirname(__FILE__,1) . '/lang/jp/login.php');
        } elseif ($_SESSION['LANG'] == 'TH') {
            // require_once('./lang/th/login.php');
            require_once(dirname(__FILE__,1) . '/lang/th/login.php');
        } else {
            // require_once('./lang/en/login.php');
            require_once(dirname(__FILE__,1) . '/lang/en/login.php');
        }
    } else {  
        // require_once('./lang/en/login.php');
        require_once(dirname(__FILE__,1) . '/lang/en/login.php');
    }  // if (isset($_SESSION['LANG'])) { else
    //--------------------------------------------------------------------------------
    $errorMessage = '';
    //--------------------------------------------------------------------------------
    //  GET
    //--------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //--------------------------------------------------------------------------------
        // 
        // 
        //--------------------------------------------------------------------------------
    }  // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //--------------------------------------------------------------------------------
    //  POST
    //--------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //--------------------------------------------------------------------------------
        //session_id
        session_regenerate_id(true);
        //--------------------------------------------------------------------------------
        //  SESSION LOGIN
        $_SESSION['USERCODE'] = $_POST['USERCODE'];
        $_SESSION['USERPWD'] = $_POST['USERPWD'];
        $_SESSION['COMCD'] = strtoupper($_POST['COMCD']);
        $_SESSION['COMPWD'] = $_POST['COMPWD'];
        $_SESSION['HOST'] = $_POST['HOSTURL'];
        $_SESSION['LANG'] = strtoupper($_POST['LANG']);
        $_SESSION['COMPNAME'] = $_POST['COMPNAME'];
        // $_SESSION['COMPNAME'] = UniqueMachineID();
        if(strlen($_SESSION['COMPNAME']) == '36') {
            //--------------------------------------------------------------------------------
            //  REQUIRE RTNServer.php
            require_once(dirname(__FILE__,1) . '/common/RTNServer.php');
            require_once(dirname(__FILE__,1) . '/common/javaFunction.php');
            //--------------------------------------------------------------------------------
            $Param = array('P3' => $_POST['USERCODE']);
            $cmd = GetRequestData($Param, 'search.SearchGeneral.getStaff', '', '');
            // echo "<pre>cmd = {$cmd}</pre><br>";
            $data = Execute($cmd, $errorMessage);
            // echo "<pre>data = {$data}</pre><br>";
            // print_r($errorMessage);
            if (isset($data)) {
                //--------------------------------------------------------------------------------
                if ($data != '' and is_array($data)) {
                    $errorMessage = 'Have Data.';
                    //--------------------------------------------------------------------------------
                    $_SESSION['USERNAME'] = $data['P3NAME'];
                    //--------------------------------------------------------------------------------
                    // SET COOKIE
                    setcookie('USERCODE', $_POST['USERCODE'], time() + 86400*10, '', '', true, true);  // 86400 = 1 day
                    // setcookie('USERPWD', $_POST['UserPwd'], time() + 86400*10, '', '', true, true);
                    setcookie('COMCD', $_POST['COMCD'], time() + 86400*10, '', '', true, true);
                    setcookie('COMPWD', $_POST['COMPWD'], time() + 86400*10, '', '', true, true);
                    setcookie('HOST', $_POST['HOSTURL'], time() + 86400*10, '', '', true, true);
                    setcookie('LANG', strtoupper($_POST['LANG']), time() + 86400*10, '', '', true, true);
                    setcookie('COMPNAME', $_POST['COMPNAME'], time() + 86400*10, '', '', true, true);
                    //--------------------------------------------------------------------------------
                    //  MAIN MENU DATA
                    $Param = array('MODE' => 'RUNAPP');
                    $cmd = GetRequestData($Param, 'gen.THA.Application.getDefApp', 'FMAINAPP', '');
                    // echo '<pre>cmd = {$cmd}</pre><br>';
                    $data = Execute($cmd, $errorMessage);
                    if ($data != '' and is_array($data)) {
                        $_SESSION['MENU'] = array();
                        foreach ($data as $index => $datarec) {
                            // echo '<pre>Value = {$datarec['NODETITLE']}</pre><br>';
                            $_SESSION['MENU'][$index] = $datarec;
                        }  // foreach ($data as $datarec) {
                    }  // if ($data != '' and is_array($data)) {
                    dmcsTHALoad($_SESSION['COMPNAME']);
                    //--------------------------------------------------------------------------------
                    // LoadConfig Staff
                    $javafunc = new javaFunction;
                    $stconfig = $javafunc->getStaffConfig($_SESSION['USERCODE']);
                    if(!empty($stconfig)) {
                        $_SESSION['NAVBARBGCOLOR'] = $stconfig['NAVBARBGCOLOR'];
                        $_SESSION['NAVBARTXTCOLOR'] = $stconfig['NAVBARTXTCOLOR'];
                        $_SESSION['SIDEBARBGCOLOR'] = $stconfig['SIDEBARBGCOLOR'];
                        $_SESSION['SIDEBARTXTCOLOR1'] = $stconfig['SIDEBARTXTCOLOR1'];
                        $_SESSION['SIDEBARTXTCOLOR2'] = $stconfig['SIDEBARTXTCOLOR2'];
                        $_SESSION['MAINPAGEBGTYPE'] = $stconfig['MAINPAGEBGTYPE'];
                        $_SESSION['MAINPAGEBGVALUE'] = $stconfig['MAINPAGEBGVALUE'];
                        $_SESSION['MAINPAGETXTCOLOR'] = $stconfig['MAINPAGETXTCOLOR'];
                    }
                    //--------------------------------------------------------------------------------
                    //--------------------------------------------------------------------------------
                    header('Location:home.php');
                    exit();
                    //--------------------------------------------------------------------------------
                } else {  // if ($data != '' and is_array($data)) {
                    // $errorMessage = $errorMessage;
                }  // if ($data != '' and is_array($data)) { else {
                //--------------------------------------------------------------------------------
            } else {  // if (isset($data)) {
                $errorMessage = 'null';
            }  // if (isset($data)) else
        } else {
            $errorMessage = 'Get Computer Name Error.'; 
        }
        //--------------------------------------------------------------------------------
    }  // if (isset($_POST["login"])) {
    //--------------------------------------------------------------------------------
    // DMCSTHALOAD
    function dmcsTHALoad($COMPNAME) {
        $Param = array('COMPUTERNAME' => $COMPNAME);
        $cmd = GetRequestData($Param, 'gen.GuideReport.loadGuide,gen.Application.getLoadApp,gen.Application.loadEvent', 'DMCSTHALOAD', '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // GET MACHINE UUID //
    // function UniqueMachineID($salt = '') {
        // echo md5(session_id()).'<br>';
        // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        //     $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        //     if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        //     $output = shell_exec("diskpart /s ".$temp);
        //     $lines = explode("\n",$output);
        //     $result = array_filter($lines,function($line) {
        //         return stripos($line,"ID:")!==false;
        //     });
        //     if(count($result)>0) {
        //         $result = array_shift(array_values($result));
        //         $result = explode(":",$result);
        //         $result = trim(end($result));       
        //     } else $result = $output;       
        // } else {
        //     $result = shell_exec("blkid -o value -s UUID");  
        //     if(stripos($result,"blkid") !== false) {
        //         $result = $_SERVER['HTTP_HOST'];
        //     }
        // }   
        // $uuid = md5($salt.md5($result));
        // $uuidv4 = substr($uuid, 0, 8).'-'.substr($uuid, 8 ,4).'-'.substr($uuid, 12 ,4).'-'.substr($uuid, 16 ,4).'-'.substr($uuid, 20 ,12);
        // // return md5($salt.md5($result));
        // return strtoupper($uuidv4);
    // }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DMCSMFG Login</title>
    <!--  css  -->
    <!-- -------------------------------------------------------------------------------- -->
    <!-- <link rel="stylesheet" href="./css/login.css"> -->
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Bootstrap  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!-- Tailwind CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/tailwind/tailwind.min.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!-- Jquery -->
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <!-- -------------------------------------------------------------------------------- -->
    <!-- loading -->
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-oMQ5ko2jLSZXRA4GGPs7QohksV1sZ8/JIL8ioAdjU4XSSjvBKMoofyNrlREXWmbN" crossorigin="anonymous"></script>
    <!-- -------------------------------------------------------------------------------- -->
</head>                               
<body>
    <main class="container">
        <div class="min-h-screen w-full h-full mx-auto overflow-hidden">
            <div class="flex py-2 lg:px-32 flex-col mb-2">
                <!-- Card -->
                <div class="pt-1 inline-block align-middle px-auto">
                    <!--  DMCS Logo  -->
                    <div class="flex relative inset-0">
                        <img src="./img/dmcs_logo.jpg" class="object-center m-auto" alt="DMCS">
                    </div>
                    <div class="w-10/12 m-auto bg-white border border-gray-300 rounded-xl shadow-sm dark:bg-slate-900 dark:border-gray-700">
                        <div class="justify-between mb-2 px-4 py-2 md:items-center">
                            <!-- -------------------------------------------------------------------------------- -->
                            <!--  Login Form  -->
                            <!-- -------------------------------------------------------------------------------- -->
                            <form id="loginForm" name="loginForm" action="" method="POST" autocomplete="on" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                                <input type="hidden" class="form-control" id="COMPNAME" name="COMPNAME">
                                <div class="flex mt-2">
                                    <label class="block text-gray-700 text-base w-4/12 mr-2 mt-2" for="COMCD"><?=lang('compcode'); ?></label>
                                    <input type="text" id="COMCD" name="COMCD" class="shadow appearance-none border rounded w-5/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                            placeholder="<?=lang('compcode') ?>" autofocus="on" value="<?=isset($_COOKIE['COMCD']) ? $_COOKIE['COMCD']: ''?>" required/>
                                    <div class="w-3/12"></div>
                                </div>

                                <div class="flex mt-2 mb-3">
                                    <label class="block text-gray-700 text-base w-4/12 mr-2 mt-2" for="COMPWD"><?=lang('comppwd'); ?></label>
                                    <input type="password" id="COMPWD" name="COMPWD" class="shadow appearance-none border rounded w-5/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                            placeholder="<?=lang('comppwd') ?>" value="<?=isset($_COOKIE['COMPWD']) ? $_COOKIE['COMPWD']: ''?>" required/>
                                    <div class="w-3/12"></div>
                                </div>
                                <hr>
                                <div class="flex mt-3">
                                    <label class="block text-gray-700 text-base w-4/12 mr-2 mt-2" for="USERCODE"><?=lang('userid'); ?></label>
                                    <input type="text" id="USERCODE" name="USERCODE" class="shadow appearance-none border rounded w-5/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                            placeholder="<?=lang('userid') ?>" value="<?=isset($_COOKIE['USERCODE']) ? $_COOKIE['USERCODE']: ''?>" required/>
                                  <div class="w-3/12"></div>
                                </div>

                                <div class="flex mt-2">
                                    <label class="block text-gray-700 text-base w-4/12 mr-2 mt-2" for="USERPWD"><?=lang('userpwd'); ?></label>
                                    <input type="password" id="USERPWD" name="USERPWD" class="shadow appearance-none border rounded w-5/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                            placeholder="<?=lang('userpwd') ?>" value="" required/>&ensp;
                                    <button type="submit" class="w-3/12 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800" id="login" name="login"
                                            onclick="if (!document.getElementById('loginForm').reportValidity()) { return false; } $('#loading').show();"><?=lang('btnlogin') ?></button>
                                </div>

                                <div class="flex mt-2">
                                    <label class="block text-gray-700 text-base w-4/12 mr-2 mt-2" for="HOSTURL"><?=lang('serverurl'); ?></label>
                                    <input type="text" id="HOSTURL" name="HOSTURL" class="shadow appearance-none border rounded w-8/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                            placeholder="<?=lang('serverurl') ?>" value="<?=isset($_COOKIE['HOST']) ? $_COOKIE['HOST']: ''?>"  required/>
                                </div>


                                <div class="flex mt-2">
                                    <div class="w-4/12 mr-3"></div>
                                    <select class="mr-2 w-4/12 py-2 px-3 block text-left shadow text-sm rounded-lg" id="LANG" name="LANG">
                                        <option value="EN" <?php echo (isset($_COOKIE['LANG']) && $_COOKIE['LANG'] == 'EN') ? 'selected' : '' ?>>English</option>
                                        <option value="JP" <?php echo (isset($_COOKIE['LANG']) && $_COOKIE['LANG'] == 'JP') ? 'selected' : '' ?>>Japanese</option>
                                        <option value="TH" <?php echo (isset($_COOKIE['LANG']) && $_COOKIE['LANG'] == 'TH') ? 'selected' : '' ?>>Thai</option>
                                    </select>
                               
                                    <select class="w-4/12 py-2 px-3 block text-left shadow text-sm rounded-lg" id="language2" name="language2">
                                        <option value="" selected>Local language</option>
                                        <option value="EN">English</option>
                                    </select>
                                </div>
                                    
                                <div class="flex mt-2">
                                    <label class="block text-red-500 text-base w-12/12" for="SvrURL"><?=$errorMessage; ?></label>
                                </div>   
                            </form>
                            <!-- -------------------------------------------------------------------------------- -->
                            <br>
                        </div>
                    </div>
                </div>
                <!-- END Card -->
            </div>

            <div class="lg:px-32">
                <!-- -------------------------------------------------------------------------------- -->
                <!--  Software License  -->
                <div class="w-12/12 p-3 bg-white border-2 border-black rounded-xl shadow-sm">
                    <p><?=lang('software1');?><br>
                    <?=lang('software2');?><br>
                    <?=lang('software3');?></p>
                </div>
                <!-- -------------------------------------------------------------------------------- -->
            </div>
        </div>
    </main>
    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</body>
</html>
<script type="text/javascript">
    $('#COMPNAME').val(getMachineId());
    function getMachineId() {
        let machineId = localStorage.getItem('MachineId');

        if (!machineId) {
            machineId = crypto.randomUUID();
            localStorage.setItem('MachineId', machineId);
        }  
        return machineId.toUpperCase();
    }
</script>