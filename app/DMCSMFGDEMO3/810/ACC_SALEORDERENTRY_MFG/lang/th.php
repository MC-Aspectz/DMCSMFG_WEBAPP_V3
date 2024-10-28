<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'กรุณากรอกรหัสสกุลเงิน',
            'ERRO_NO_CUTOMER' => 'กรุณากรอกรหัสลูกค้า',
            'ERRO_SALEORDERNO' => 'กรุณากรอกหมายเลขใบสั่งซื้อ',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',

            'searchcondition' => 'เงื่อนไขการค้นหา'

            'groupsaleheader' => 'ข้อมูลส่วนหัวของใบสั่งซื้อ',
            'groupcustomer' => 'ลูกค้า',
            'grouprecipient' => 'ผู้รับ',
            'groupsaledetail' => 'ข้อมูลรายละเอียดใบสั่งซื้อ',
            'groupsaleitem' => 'รายการใบสั่งซื้อ',
            'grouptotal' => 'รวม',
            'groupitemremark' => '述べる',
            'groupitementry' => 'แบบฟอร์มรายการสินค้า',

            'newitems' => 'รายการใหม่',
            'saveitems' => 'บันทึกรายการ',
            'deleteitems' => 'ลบรายการ',

            'yes' => 'ใช่',
            'no' => 'ไม่',
            'ok' => 'Ok',
            'close' => 'ปิด',
            
            'canceled' => 'ยกเลิกแล้ว',

            'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?',
            'question2' => 'คุณต้องการยกเลิกข้อมูลหรือไม่ ? (หลังจากดำเนินการยกเลิกแล้ว จะไม่สามารถนำข้อมูลกลับมาใช้ใหม่ได้)',
            'question3' => 'คุณต้องการบันทึกข้อมูลหรือไม่ ?',
            'question4' => 'คุณต้องการพิมพ์ข้อมูลนี้หรือไม่ ?',

            'validation1' => 'ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน',
            'validation2' => 'กรุณากรอกรหัสสินค้า',
            
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;

    }
?>