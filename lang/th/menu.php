<?php
    function language($msg) {

        $menubylang = [
            'file' => 'ไฟล์', 
            'tools' => 'เครื่องมือ', 
            'mainmenu' => 'เมนูหลัก', 
            'help' => 'ช่วยเหลือ', 
            'home' => 'หน้าหลัก', 
            'logout' => 'ออกจากระบบ', 
            'changepassword' => 'เปลี่ยนรหัสผ่าน', 
            'about' => 'เกี่ยวกับ', 
            'manual' => 'คู่มือ',
            'colorconfig' => 'ตั้งค่าสีหน้าจอ',
            'info' => 'ข้อมูล',
            'flowchart' => 'ผังงาน',

            'development' => 'ขออภัยระบบกำลังอยู่ในระหว่างการพัฒนา...',
        ]; 

        return $menubylang[$msg];    
    }

?>