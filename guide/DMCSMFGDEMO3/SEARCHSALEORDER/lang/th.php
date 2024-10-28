<?php

function lang($msg) {

    $lang = [
        'saleorderentry' => 'Sale Order Entry',
        'salesorderindex' => 'Sales Order Index', 
        'customercode' => 'รหัสลูกค้า',
        'customername' => 'ชื่อลูกค้า',
        'cateogorycode' => 'รหัสประเภท',
        'staffcode' => 'รหัสพนักงาน', 
        'salesorderno' => 'หมายเลขคำสั่งขาย',
        'orderdate' => 'วันที่สั่งสินค้า',
        'plannedshipping' => 'วันที่คาดว่าจะจัดส่ง',
        'status' => 'สถานะ',
        'factory' => 'โรงงาน',
        'clear' => 'ล้าง',
        'end' => 'สิ้นสุด',
        'select' => 'เลือก',
        'view' => 'แสดง',
        'back' => 'ย้อนกลับ',
        'search' => 'ค้นหา',
        'no' => 'เลขที่',
        'rowcount' => 'จำนวนแถว',
        'detail' => 'รายละเอียด',
        'title' => 'หัวข้อ',
        'value' => 'ราคา',
    ];
    
    return $lang[$msg];

}
?>
