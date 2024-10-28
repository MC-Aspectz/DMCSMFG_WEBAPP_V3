<?php
    function lang($msg) {
            
        $lang = [
            
            "itemmaster" => "Item Master", 
            "searchstr" => "ข้อความการค้นหา",
            "suppliercd" => "รหัสผู้ผลิต",
            "clear" => "ล้าง",
            "end" => "สิ้นสุด",
            "select" => "เลือก",
            "view" => "แสดง",
            "back" => "ย้อนกลับ",
            "search" => "ค้นหา",
            "rowcount" => "จำนวนแถว",
            "detail" => "รายละเอียด",
            "title" => "หัวข้อ",
            "value" => "ราคา",
            "supplierindex" => "Supplier Index",
            "suppliername" => "ชื่อผู้ผลิต",
            "address" => "ที่อยู่",
            "close" => "ปิด", 
           
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
