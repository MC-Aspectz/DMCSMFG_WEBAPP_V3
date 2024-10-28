<?php
    function lang($msg) {

	    $lang = [
			'close' => 'ปิด',
			'savechanges' => 'บันทึกการเปลี่ยนแปลง',
			'changepassword' => 'เปลี่ยนรหัสผ่าน',
			'existingpassword' => 'รหัสผ่านเดิม',
			'newpassword' => 'รหัสผ่านใหม่',
			'confirmpassword' => 'ยืนยันรหัสผ่าน',
			'validation1' => 'รหัสผ่านไม่ถูกต้อง !',
			'validation2' => 'กรุณากรอกรหัสผ่านใหม่ !',
			'validation3' => 'รหัสผ่านไม่ตรงกัน !',
	    ];
	    
        return $lang[$msg];    
    }

?>

