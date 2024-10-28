<?php
    function lang($msg) {

	    $lang = [
			'close' => '近い',
			'savechanges' => '変更の保存',
			'changepassword' => 'パスワードの変更',
			'existingpassword' => '既存のパスワード',
			'newpassword' => '新しいパスワード',
			'confirmpassword' => 'パスワードの確認',
			'validation1' => '間違ったパスワード !',
			'validation2' => '新しいパスワードを入力してください !',
			'validation3' => 'パスワードが一致していません !',
	    ];
	    
        return $lang[$msg];    
    }

?>