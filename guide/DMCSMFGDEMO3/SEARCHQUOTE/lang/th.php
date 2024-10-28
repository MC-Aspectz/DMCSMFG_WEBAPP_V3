<?php
    function lang($msg) {
        
        $lang = [
            'quoteentry' => 'Quote Entry',
            'quotationindex' => 'ดัชนีใบเสนอราคา', 
            'CUSTOMERCODE' => 'รหัสลูกค้า', 
            'CUSTOMERNAME' => 'ชื่อลูกค้า',
            'ESTIMATE_NO' => 'หมายเลขใบเสนอราคา',
            'ESTTMNAME' => 'ชื่อสินค้า',
            'HEADER_DATE' => 'วันที่',
            'DELI_PLACE' => 'รหัสผู้รับ',
            'DELE_PLACE_NAME' => 'ชื่อผู้รับ',
            'SEARCH' => 'ค้นหา',
            'select' => 'เลือก',
            'view' => 'แสดง',
            'back' => 'ย้อนกลับ',
            'clear' => 'ล้าง',
            'end' => 'สิ้นสุด',
            'no' => 'เลขที่',
            'rowcount' => 'จำนวนแถว',
            'detail' => 'รายละเอียด',
            'title' => 'หัวข้อ',
            'value' => 'ราคา',
        ];

        return !empty($lang[$msg]) ? $lang[$msg]: $msg;    
    }
?>
