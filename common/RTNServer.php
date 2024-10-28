<?php
    $RTNclient = null;
    $RTNMessage = "";

    function ExecuteAll($cmd, &$msg)
    {
//echo "ExecuteAll<br>";
        $arrData = Execute($cmd, $msg, 0);
//echo "msg = {$msg}<br>";
        // echo "<pre>";
        // print_r($arrData);
        // echo "</pre>";
        return $arrData;
    }

    function ExecuteLargeAll($cmd, &$msg)
    {
//echo "ExecuteAll<br>";
        $arrData = ExecuteLarge($cmd, $msg, 0);
//echo "msg = {$msg}<br>";
        // echo "<pre>";
        // print_r($arrData);
        // echo "</pre>";
        return $arrData;
    }

    function ExecuteOne($cmd, &$msg)
    {
//echo "ExecuteOne<br>";
        $arrData = Execute($cmd, $msg, 0);
//echo "msg = {$msg}<br>";
        if (count($arrData) > 0) {
            return $arrData[1];
        } else {
            return "";
        }
    }

    function Execute($cmd, &$msg, $ln=1)
    {
//echo "Execute msg = {$msg}<br>";
        $data = "";
        $result = getResult($cmd, $msg);

        // 2023.05.11 return 'ERRO:' data -->
        // if (strpos($result,'ERRO:') !== false) {
        //     $msg = $result;
        //     $result = "";
        // }
        // <-- 2023.05.11 return 'ERRO:' data
        // 2023.05.17 
        // due to return error null
        // change to return error
        // print_r($result);
        if (str_contains($result, 'ERRO:')) {
            $start = strpos($result, 'ERRO:');
            $error = substr($result, $start, strlen($result));
            $data = $error;
            return $data;
        }
        // 2023.05.17 
        if($result != "") {
            try {
                $search = array("\0", "\x01", "\x02", "\x03", "\x04", "\x05","\x06", "\x07", "\x08", "\x0b", "\x0c", "\x0e", "\x0f");
                $result = str_replace($search, '', $result);
                // $data = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOWARNING | LIBXML_NOERROR);
                // libxml_use_internal_errors (true);
                // print_r($result);
                // if (str_contains($result, 'ERRO')) {
                //     $start = strpos($result, 'ERRO');
                //     $error = substr($result, $start, strlen($result));
                //     $data = $error;
                //     // $xml = '<document><DATA>'.$error.'</DATA></document>';
                //     // $data = simplexml_load_string($xml);   
                //     return $data;
                // } else {
                    $data = simplexml_load_string($result);                 
                // }
                // if (!$data) {
                //     $xml_errors = libxml_get_errors();
                //     foreach ($xml_errors as $err) {
                //         var_dump($err);
                //     }
                //     libxml_clear_errors();
                // }
                restore_error_handler();
            } catch(Exception $e) {
                restore_error_handler();
                $msg = "Can not receive data.<br>".$e;
            }
        }

        if ($data == "") {
            return "";
        } else {
            $arrData = array();
            $row = 0;
            foreach ($data->{'DATA'} as $item) {
                $row++;
                $arrItem = array();
                foreach ($item as $key => $val) {
                    $arrItem[(string)$key] = (string)$val;
                }
                $arrData[$row] = $arrItem;
            }
            // echo "<pre>";
            // print_r($arrData);
            // echo "</pre>";
//            foreach ($arrData as $row => $item) {
//                //echo "row = {$row}<br>";
//                if (is_array($item)) {
//                    foreach ($item as $key => $val) {
//                        //echo "key = {$key}<br>";
//                        //echo "val = {$val}<br>";
//                        echo "row = {$row} : [{$key}] = {$val}<br>";
//                    }
//                }
//            }
            if ($ln === 0) {
                return $arrData;
            } else {
                if (count($arrData) > 1) {
                    return $arrData;
                } else {
                    return $arrData[1];
                }
            }
        }
    }

    function ExecuteLarge($cmd, &$msg, $ln=1) {
    //echo "Execute msg = {$msg}<br>";
        $data = "";
        $result = getLargeResult($cmd, $msg);

        // 2023.05.11 return 'ERRO:' data -->
        // if (strpos($result,'ERRO:') !== false) {
        //     $msg = $result;
        //     $result = "";
        // }
        // <-- 2023.05.11 return 'ERRO:' data
        // 2023.05.17 
        // due to return error null
        // change to return error
        // print_r($result);
        if (str_contains($result, 'ERRO:')) {
            $start = strpos($result, 'ERRO:');
            $error = substr($result, $start, strlen($result));
            $data = $error;
            return $data;
        }
        // 2023.05.17 
        if($result != "") {
            try {
                $search = array("\0", "\x01", "\x02", "\x03", "\x04", "\x05","\x06", "\x07", "\x08", "\x0b", "\x0c", "\x0e", "\x0f");
                $result = str_replace($search, '', $result);
                // $data = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOWARNING | LIBXML_NOERROR);
                // libxml_use_internal_errors (true);
                // print_r($result);
                // if (str_contains($result, 'ERRO')) {
                //     $start = strpos($result, 'ERRO');
                //     $error = substr($result, $start, strlen($result));
                //     $data = $error;
                //     // $xml = '<document><DATA>'.$error.'</DATA></document>';
                //     // $data = simplexml_load_string($xml);   
                //     return $data;
                // } else {
                    $data = simplexml_load_string($result);                 
                // }
                // if (!$data) {
                //     $xml_errors = libxml_get_errors();
                //     foreach ($xml_errors as $err) {
                //         var_dump($err);
                //     }
                //     libxml_clear_errors();
                // }
                restore_error_handler();
            } catch(Exception $e) {
                restore_error_handler();
                $msg = "Can not receive data.<br>".$e;
            }
        }

        if ($data == "") {
            return "";
        } else {
            $arrData = array();
            $row = 0;
            foreach ($data->{'DATA'} as $item) {
                $row++;
                $arrItem = array();
                foreach ($item as $key => $val) {
                    $arrItem[(string)$key] = (string)$val;
                }
                $arrData[$row] = $arrItem;
            }
            // echo "<pre>";
            // print_r($arrData);
            // echo "</pre>";
//            foreach ($arrData as $row => $item) {
//                //echo "row = {$row}<br>";
//                if (is_array($item)) {
//                    foreach ($item as $key => $val) {
//                        //echo "key = {$key}<br>";
//                        //echo "val = {$val}<br>";
//                        echo "row = {$row} : [{$key}] = {$val}<br>";
//                    }
//                }
//            }
            if ($ln === 0) {
                return $arrData;
            } else {
                if (count($arrData) > 1) {
                    return $arrData;
                } else {
                    return $arrData[1];
                }
            }
        }
    }


    function ExecuteUpdate($cmd,&$msg)
    {
        $result = getResult($cmd,$msg);
        if($result == "ERRO:DUPLICATE ENTRY") {
            $msg = "DUPLICATE ENTRY";
        } else {
            if (strpos($result,'ERRO:') !== false) {
                $msg = $result;
            }
        }
    }

    function getResult($cmd, &$msg)
    {
        try{
            global $RTNMessage;
            global $RTNclient;
            $sessionid = "ERRO:ERROINVALIDSESSION";
            // echo "RTNMessage = {$RTNMessage}<br>";
            // echo "RTNclient = {$RTNclient}<br>";
            for ($i = 0; $i < 10; $i++) {
                if($sessionid == "ERRO:ERROINVALIDSESSION") {     
                    //$sessionid = login($comcd,$compwd,$userid,$userpwd,$host);
                    $sessionid = login();
                    // echo "sessionid = {$sessionid}<br>";
                    if ($sessionid == "") {
                        $msg = $RTNMessage;
                        return "";
                    }
                } else {
                    break;
                }
                $response = $RTNclient->process(new SoapParam($sessionid, "String_1"),
                                                new SoapParam($cmd, "String_2")
                                               );
            }
            $result = "";
            sleep(1); // wait 1 sec.
            for ($i = 0; $i < 10; $i++) { // 1 sec.
                $response = $RTNclient->getResult(new SoapParam($sessionid, "String_1"),
                                                  new SoapParam('-1', "long_2")
                                                 );
                // $now = DateTime::createFromFormat('U.u', microtime(true));
                // print_r($now->format("m-d-Y H:i:s.u").'<br>');
                // print_r($response.'<br>');
                if (strcmp($response, 'ERRO:INFOSERVICERUNNING') == 0) {
                    usleep(500);  // wait 0.005 sec.
                } else {
                    $result = $response;
                    break;
                }
            }

            logout();

            return $result;
        } catch (SoapFault $e) {
            //SOAP通信の実行に失敗した場合の処理
            $msg = "Can not connect sever.<br>".$e;
        }
    }

    function getLargeResult($cmd, &$msg)
    {
        try{
            global $RTNMessage;
            global $RTNclient;
            $sessionid = "ERRO:ERROINVALIDSESSION";
            // echo "RTNMessage = {$RTNMessage}<br>";
            // echo "RTNclient = {$RTNclient}<br>";
            for ($i = 0; $i < 10; $i++) {
                if($sessionid == "ERRO:ERROINVALIDSESSION") {     
                    //$sessionid = login($comcd,$compwd,$userid,$userpwd,$host);
                    $sessionid = login();
                    // echo "sessionid = {$sessionid}<br>";
                    if ($sessionid == "") {
                        $msg = $RTNMessage;
                        return "";
                    }
                } else {
                    break;
                }
                $response = $RTNclient->process(new SoapParam($sessionid, "String_1"),
                                                new SoapParam($cmd, "String_2")
                                               );
            }
            $result = "";
            sleep(1); // wait 1 sec.
            for ($i = 0; $i < 600; $i++) {
                $response = $RTNclient->getResult(new SoapParam($sessionid, "String_1"),
                                                  new SoapParam('-1', "long_2")
                                                 );
                // $now = DateTime::createFromFormat('U.u', microtime(true));
                // print_r($now->format("m-d-Y H:i:s.u").'<br>');
                // print_r($response.'<br>');
                if (strcmp($response, 'ERRO:INFOSERVICERUNNING') == 0) {
                    usleep(100000);  // wait 0.1 sec.
                } else {
                    $result = $response;
                    break;
                }
            }

            logout();

            return $result;
        } catch (SoapFault $e) {
            //SOAP通信の実行に失敗した場合の処理
            $msg = "Can not connect sever.<br>".$e;
        }
    }

    function logout()
    {
        global $RTNclient;
        $response = $RTNclient->logout();
    }

    function login()
    {
        global $RTNMessage;
        $comcd = isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';
        $compwd = isset($_SESSION['COMPWD']) ? $_SESSION['COMPWD']: '';
        $userid = isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';
        $userpwd = isset($_SESSION['USERPWD']) ? $_SESSION['USERPWD']: '';
        $compname = isset($_SESSION['COMPNAME']) ? $_SESSION['COMPNAME']: '';
        $host = isset($_SESSION['HOST']) ? $_SESSION['HOST']: '';


        // 1. ユーザIDの入力チェック
        if (empty($comcd)) {
            $RTNMessage = 'Please input Company Code.';
        } else if (empty($compwd)) {
            $RTNMessage = 'Please input Company Password.';
        } else if (empty($userid)) {
            $RTNMessage = 'Please input User ID.';
        } else if (empty($userpwd)) {
            $RTNMessage = 'Please input User Password.';
        } else if (empty($host)) {
            $RTNMessage = 'Please input Server URL.';
        }

        $url = $host;
        $url = str_ireplace("https://","",$url);
        $url = str_ireplace("http://","",$url);
        if (strpos($url,'/') !== false) {
            $pos = strpos($url, '/');
            $url = substr($url,0,$pos);
        }
        if (strpos($url,':') !== false) {
            $pos = strpos($url, ':');
            $url = substr($url,0,$pos);
        }
        //if (strpos(strtoupper($url), 'DEVELOP') === 0) {
        //    $location = 'http://'.$url.':8090/RTNServer/process';
        //    $url = 'http://'.$url.':8090/RTNServer/process?WSDL';
        //} else {
        //    $location = 'http://'.$url.':8080/RTNServer/process';
        //    $url = 'http://'.$url.':8080/RTNServer/process?WSDL';
        //}
        if (strpos(strtoupper($url), 'DEVELOP') === 0) {
            $location = 'http://'.$url.':8090/RTNServer/process';
            $url = 'http://'.$url.':8090/RTNServer/process?WSDL';
        } elseif (strpos(strtoupper($url), 'LOCALHOST') === 0) {
            $location = 'http://'.$url.':8080/RTNServer/process';
            $url = 'http://'.$url.':8080/RTNServer/process?WSDL';
        } else {
            $location = 'http://'.$url.'/RTNServer/process';
            $url = 'http://'.$url.'/RTNServer/process?WSDL';
        }
        global $RTNclient;
        // echo "location = {$location}<br>";
        // echo "url = {$url}<br>";
        //set_error_handler(array(__CLASS__, "soapErrHandler"));
        try {
            // $RTNclient = new SoapClient($url, array('trace' => 1 ));
            $RTNclient = new SoapClient($url,
                array(
                    'trace' => 1,
                    'location' => $location,
                    'exceptions' => 1,
                    'stream_context' => stream_context_create(
                        array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                            )
                        )
                    ),
                    // 'soap_version'=> SOAP_1_2,
                    // 'connection_timeout' => 5,
                    // 'cache_wsdl'  => WSDL_CACHE_NONE,
                ) 
            );
            // echo "RTNclient = ".$RTNclient;
            // エラーハンドラ回復
            // restore_error_handler();
        } catch (Exception $e) {
            $RTNMessage = 'Can not connect server '.$host;
            // echo 'Can not connect server '.$host.'<br>';
            // echo 'Can not connect server '.$e.'<br>';
        }

        $sessionid = '';

        try{
            // SOAP 通信実行
            // print_r($RTNclient);
            // print_r(strlen(' BA22A849-C855-40F5-8C15-53521A63D5D9D'));
            $response = $RTNclient->login(new SoapParam($userid, 'String_1'),
                                          new SoapParam($userpwd, 'String_2'),
                                          // new SoapParam($comcd.' BA22A849-C855-40F5-8C15-53521A63D5D9D', 'String_3'),
                                          new SoapParam($comcd.' '.$compname.'D', 'String_3'),
                                          new SoapParam($compwd, 'String_4')
                                         );
            // print_r($response);  
            // $result = $RTNclient->__soapCall('login', array('String_1'=> $userid,
            //                                                 'String_2'=> $userpwd,
            //                                                 'String_3'=> $comcd.' '.$compname,
            //                                                 'String_4'=> $compwd));
            // print_r($result);
            // echo '<br>';
            // print_r($RTNclient->__getLastRequest());
            // echo '<br>';
            // echo '<pre>';
            // print_r($RTNclient->__getFunctions());
            // echo '</pre>';
            // echo '<br>'; 
            // print_r($RTNclient->__getLastResponse());
            // echo '<br>';


            // <-- Fix 2023.05.11 Use Multi login off
            if ($response == 'ERRO:INFOINVALIDUSRPWD') {
               $RTNMessage = 'Incorrect Password!';
            } elseif ($response == 'ERRO:ERROMULTILOGINUSER') {
               $RTNMessage = 'This User ID is currently in use.';
            // Add Use limit user -->
            } elseif ($response == 'ERRO:ERROLIMITUSER') {
               $RTNMessage = 'The user limit has been reached.';
            } elseif ($response == 'ERRO:ERROLICENSEEXPIRED') {
               $RTNMessage = 'The expiration date of license hs expired.';
            } elseif ($response == 'ERRO:ERRORMACEMPTY') {
                //$this->RTNMessage = 'Do you want to save the current device ?';
                $response = $RTNclient->login(new \SoapParam($userid, 'String_1'),
                                              new \SoapParam($userpwd, 'String_2'),
//                                              new \SoapParam($comcd.'RTNSERVICE-WEB-LARAVEL-SRCVER-1.0.0-T', 'String_3'),
                                              new \SoapParam($comcd.' '.$compname.'T', 'String_3'),
                                              new \SoapParam($compwd, 'String_4')
                                             );
                if ($response == 'ERRO:INFOINVALIDUSRPWD') {
                   $RTNMessage = 'Incorrect Password!';
                } elseif ($response == 'ERRO:ERROMULTILOGINUSER') {
                   $RTNMessage = 'This User ID is currently in use.';
                } else {
                    $sessionid = $response;
                }
            } elseif ($response == 'ERRO:ERRORREQMACADD') {
                //$this->RTNMessage = 'Do you want to send your request login for this device id to admin ?';
                $response = $RTNclient->login(new \SoapParam($userid, 'String_1'),
                                              new \SoapParam($userpwd, 'String_2'),
//                                              new \SoapParam($comcd.'RTNSERVICE-WEB-LARAVEL-SRCVER-1.0.0-R', 'String_3'),
                                              new \SoapParam($comcd.' '.$compname.'R', 'String_3'),
                                              new \SoapParam($compwd, 'String_4')
                                             );
                if ($response == 'ERRO:INFOINVALIDUSRPWD') {
                   $RTNMessage = 'Incorrect Password!';
                } elseif ($response == 'ERRO:ERROMULTILOGINUSER') {
                   $RTNMessage = 'This User ID is currently in use.';
                } else {
                    $sessionid = $response;
                }
            // <-- Add Use limit user
            } else {
                $sessionid = $response;
            }
           
        } catch (SoapFault $e) { 
            // SOAP 通信の実行に失敗した場合の処理
            // echo '<pre>';
            // print_r($e);  
            // echo '</pre>';
            $RTNMessage = 'Can not connect sever.<br>'.$e;
            // echo 'Can not connect sever.<br>'.$e;
        }

        return $sessionid;
    }

    function GetRequestData($Param, $Service, $SerLogAppCd, $SerLogChapter)
    {
        // define('DELIMITER', '<RTNDM\>');
        // define('ROWCOLDELIMITER', '#TBCOL#');
        // define('DATAROWDELIMITER', '#TBROW#');
        if (!defined('DELIMITER')) define('DELIMITER', '<RTNDM\>');
        if (!defined('ROWCOLDELIMITER')) define('ROWCOLDELIMITER', '#TBCOL#');
        if (!defined('DATAROWDELIMITER')) define('DATAROWDELIMITER', '#TBROW#');
        //require_once('ComEnv.php');
        if(is_readable ('./ComEnv.php')) {
            require_once('./ComEnv.php');
        }

        $ComCd = isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';
        $ComPwd = isset($_SESSION['COMPWD']) ? $_SESSION['COMPWD']: '';
        $Lang = isset($_SESSION['LANG']) ? $_SESSION['LANG']: '';
        $UserId = isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';
        $DateType = '0';
        $data = '';
        $appName = 'Cloud2Mfg';
        $syslang2 = '0';

        // Server logic check
        if(($Service === '') and ($SerLogAppCd !== '') and ($SerLogChapter !== '')) {
            // Server Logic
            $data = 'FAPPCD'
            .DELIMITER
            .$SerLogAppCd
            .DELIMITER
            .'CHAPID'
            .DELIMITER
            .$SerLogChapter
            .DELIMITER
            .'SERVICECLASS'
            .DELIMITER
            .'gen.SysLogic.runSys'
            .DELIMITER;
        } elseif($Service !== '') {
            // java class
            $data = 'FAPPCD'
            .DELIMITER
            .$SerLogAppCd
            .DELIMITER
            .'APPNAME'
            .DELIMITER
            .$appName
            .DELIMITER
            .'SERVICECLASS'
            .DELIMITER
            .$Service
            .DELIMITER;;
        } else {
            return "";
        }

        // count Array Parameter
        $countArray = 0;
        foreach ($Param as $key => $val ) {
            if (is_array($val)) {
                $countArray++;
            }
        }
        // Do data
        $sequeneArray = 0;
        foreach ($Param as $key => $val ) {
            // Parameter Array
            if (is_array($val)) {
                if($countArray > 1) {
                    // for array parameter > 1
                    // print_r($sequeneArray);
                    if($sequeneArray == 0) {
                        // DVW 1
                        $data = $data.$key.DELIMITER;
                    } else {
                        // DVW more than 1
                        $data = $data.$key.DELIMITER.DELIMITER.'DATA'.DELIMITER;
                    }
                    $sequeneArray++;
                } else {
                    // for array parameter == 1
                    $data = $data.'DATA'.DELIMITER;
                }
                // DVW TBROW
                $rowNo = 0;
                foreach ($val as $val2) {
                    if (is_array($val2)) {

                        if($rowNo > 0) {
                            $data = $data.DATAROWDELIMITER;                          
                        }                
                        // DVW Column Name
                        if($rowNo == 0) {

                            $colNo = 0;
                            foreach ($val2 as $key3 => $val3 ) {

                                if($colNo > 0) {
                                    $data = $data.ROWCOLDELIMITER;
                                }

                                $data = $data.$key3;
                                $colNo++;
                            }   
                            $data = $data.DATAROWDELIMITER;
                        }
                        // DV Value
                        $colValNo = 0;
                        foreach ($val2 as $key3 => $val3 ) {

                            if($colValNo > 0) {
                                $data = $data.ROWCOLDELIMITER;
                            }

                            $data = $data.$val3;
                            $colValNo++;
                        } 
                    }
                    $rowNo++;
                }

            } else {
                //  Parameter String
                $data = $data.$key.DELIMITER.$val;

            }
            // Parameter DELIMITER
            $data = $data.DELIMITER;
        }

        $data = $data
        // Language
        .'SYSLANG'
        .DELIMITER
        .$Lang
        // Language2
        .DELIMITER
        .'SYSLLANG'
        .DELIMITER
        .$Lang
        .DELIMITER
        .'SYSLANG2'
        .DELIMITER
        .$syslang2
        .DELIMITER
        .'SYSLLANG2'
        .DELIMITER
        .$syslang2
        // Login user
        .DELIMITER
        .'SYSLOGINUSER'
        .DELIMITER
        .$UserId
        .DELIMITER
        .'LOGINSTAFFCD'
        .DELIMITER
        .$UserId
        .DELIMITER
        .'SYSLLOGINUSER'
        .DELIMITER
        .$UserId
        // System Date Type
        .DELIMITER
        .'SYSDATETYPE'
        .DELIMITER
        .$DateType
        .DELIMITER
        .'SYSLDATETYPE'
        .DELIMITER
        .$DateType
        // System application name ??
        .DELIMITER
        .'SYSAPPNAME'
        .DELIMITER
        .'DS'
        .DELIMITER
        .'SYSLAPPNAME'
        .DELIMITER
        .'DS'
        .DELIMITER
        // OS Name
        .'SYSCOMPUTERNAME'
        .DELIMITER
        .'PHP WEB'
        .DELIMITER
        .'SYSLCOMPUTERNAME'
        .DELIMITER
        .'PHP WEB'
        // Company Code
        .DELIMITER
        .'SYSCOMCD'
        .DELIMITER
        .$ComCd
        // Company Password
        .DELIMITER
        .'SYSCOMPWD'
        .DELIMITER
        .$ComPwd
        // Max row returns
        .DELIMITER
        .'MAXROWRETURN'
        .DELIMITER;

        return $data;
    }
?>
