<?php
    function lang($msg) {

	    $lang = [
			'close' => 'Close',
			'savechanges' => 'Save changes',
			'changepassword' => 'Change Password',
			'existingpassword' => 'Existing Password',
			'newpassword' => 'New Password',
			'confirmpassword' => 'Confirm Password',
			'validation1' => 'Incorrect Password !',
			'validation2' => 'Please enter new password !',
			'validation3' => 'Passwords do not match !',
	    ];
	    
        return $lang[$msg];    
    }

?>