<?php

    function lang($msg) {

        $lang = [
            'itemmaster' => 'Item Master', 
            'itemindex' => 'Item Index',
            'itemcode' => 'รหัสรายการ', 
            'itemname' => 'ชื่อรายการ',
            'searchstr' => 'ข้อความการค้นหา',
            'speciafication' => 'สเป็ค',
            'typeofitem' => 'ประเภทรายการ',
            'clear' => 'ล้าง',
            'end' => 'สิ้นสุด',
            'select' => 'เลือก',
            'view' => 'แสดง',
            'back' => 'ย้อนกลับ',
            'drawingno' => 'เลขที่แบบ',
            'saleenddate' => 'วันที่สิ้นสุดการขาย',
            'search' => 'ค้นหา',
            'no' => 'เลขที่',
            'rowcount' => 'จำนวนแถว',
            'detail' => 'รายละเอียด',
            'title' => 'หัวข้อ',
            'value' => 'ราคา',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
