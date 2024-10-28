<?php
    function lang($msg) {

	    $txtbylang = [
	        'login' => 'ログイン', 
	        'compcode' => '会社コード', 
	        'comppwd' => '会社パスワード', 
	        'userid' => 'ユーザー名', 
	        'userpwd' => 'パスワード', 
	        'serverurl' => '接続先 URL', 
	        'btnlogin' => 'ログイン',
	        'language' => '言語',
         	         	
	        'software1' => 'このソフトウェアは、Cloud2Works (Thailand) Co.,Ltd. によって開発されました。',	        
			'software2' => 'ソフトウェアハウスIDはXXXXで、このソフトウェアのソフトウェア番号はX-XXXXです。',
			'software3' => 'このソフトウェアは、税務署の標準ソフトウェアであり、税の種類に属しています ข‚.', 
	    ];
	    
        return $txtbylang[$msg];    
    }
?>
