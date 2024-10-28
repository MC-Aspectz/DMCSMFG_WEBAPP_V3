<?php

function lang($msg) {

    $lang = [
        'SEARCHPRODUCTIONORDER' => 'Production Order Index',
        'entrydate' => 'วันที่เข้า',
        'itemcode' => 'รหัสสินค้า',
        'production' => 'การผลิต', 
        'itemname' => 'ชื่อสินค้า',
        'specification' => 'ข้อมูลจำเพาะ',
        'referenceno' => 'เลขอ้างอิง.',
        'planned' => 'วางแผนแล้ว',
        'estimatedduedate' => 'วันที่ครบกำหนดโดยประมาณ',
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
        'inputdate' => 'วันที่ป้อนข้อมูล'
    ];
    
    return $lang[$msg];

}
?>