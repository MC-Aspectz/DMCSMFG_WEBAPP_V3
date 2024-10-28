<?php
    function lang($msg) {

        $lang = [
            'itemmaster' => 'Item Master', 
            'itemindex' => 'Item Index',

            'searchcondition' => 'เงื่อนไขการค้นหา'

            'groupitem' => 'ค้นหา, ข้อมูลจำเพาะ, วัสดุ',
            'grouptype' => 'BOI, ประเภท, หมวดหมู่',
            'groupunit' => 'หน่วย, บรรจุภัณฑ์, ความจุ, น้ำหนัก',
            'grouppurchase' => 'จัดซื้อ',
            'groupsale' => 'การขาย',
            'groupinventory' => 'สินค้าคงคลัง',
            'groupimage' => 'รูปภาพสินค้า',
            'groupworkcenter' => 'ศูนย์งาน, ตัวเลือกต้นทุน',
            'gruopcheckbox' => 'รายการ FIFO, สินค้าแฝง, การควบคุมสินค้าคงคลัง, แผนการผลิต, การควบคุมหมายเลขซีเรียล',

            'yes' => 'ใช่',
            'no' => 'ไม่',
            'close' => 'ปิด',
            
            'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่',
            'validation1' => 'ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน',
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
    }
?>
