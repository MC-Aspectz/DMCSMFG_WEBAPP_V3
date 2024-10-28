<?php
    function lang($msg) {

        $lang = [
            'close' => 'Close', 
            'yes' => 'ใช่',
            'no' => 'ไม่',

            'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?',

            'validation1' => 'ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน',
            
            'ERRORUNCHECK' => 'กระบวนการใช้งานปัจจุบันถูกใช้งานโดยคอมพิวเตอร์เครื่องอื่น',

            'ERRO_CLEARANCE_DATE' => 'ERRO_CLEARANCE_DATE',
        ];
            
        return $lang[$msg];    
    }

?>