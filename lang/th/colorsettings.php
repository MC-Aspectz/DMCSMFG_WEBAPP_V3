<?php
    function lang($msg) {

	    $lang = [
        	"colorsettings" => "ตั้งค่าสีหน้าจอ",
			"navbarcolor" => "สีของแถบด้านบน",
			"sidebarcolor" => "สีของแถบด้านข้าง",
			"background" => "พื้นหลัง",
			"navbartextcolor" => "สีข้อความแถบด้านบน",
			"sidebartextcolor" => "สีข้อความแถบด้านข้าง",
			"backgroundtextcolor" => "สีข้อความพื้นหลัง",
			"module" => "โมดูล",
			"applicationI" => "แอปพลิเคชัน 1",
			"applicationII" => "แอปพลิเคชัน 2"
			"color" => "สี",
			"image" => "ภาพ",	
			"apply" => "นำมาใช้",
			"cancel" => "ยกเลิก",
			"chooseyourcolor" => "เลือกสีของคุณ",
			"okay" => "ตกลง",
			"no" => "ไม่",
			
			"question1" => "คุณต้องการนำชุดสีที่เลือกไปใช้หรือไม่", 

			'success' => 'ตั้งค่าสีเรียบร้อยแล้ว',
			'fail' => 'ไม่สำเร็จ กรุณาลองใหม่อีกครั้ง',
	    ];
	    
        return $lang[$msg];    
    }

?>