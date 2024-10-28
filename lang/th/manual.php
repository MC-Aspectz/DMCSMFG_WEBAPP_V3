<?php
    function language($msg) {

        $manualmenubylang = [
            'manual' => 'คู่มือ',
            'edit' => 'แก้ไข',
            'preview' => 'แสดงผล',
            'commit' => 'บันทึก',
            'help' => 'ช่วยเหลือ', 
            'home' => 'หน้าหลัก', 
            'logout' => 'ออกจากระบบ', 
            'changepassword' => 'เปลี่ยนรหัสผ่าน', 
            'about' => 'เกี่ยวกับ', 
            'close' => 'ปิด'
        ];
            
        return $manualmenubylang[$msg];    
    }

?>