<?php require_once('./function/index_x.php'); printPND53(); $index = isset($data['PRINTDYNAMIC']) ? array_key_last($data['PRINTDYNAMIC']) : 0;?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="printReport">
		<div class="page">
			<div class="flex">
				<div class="justify-start40">
					<div>
						<p class="label-text14">ใบต่อ ภ.ง.ด.53</p>
					</div>
				</div>
				<div class="justify-end60"></div>
			</div>
			<div class="flex space-between">
				<div class="justify-start40"></div>
				<div class="justify-end60">
					<p class="label-text14">เลขประจำตัวผู้เสียภาษีอากร<?=isset($data['PRINTSTATIC']['CTNUM']) ? str_repeat('&emsp;', 2).$data['PRINTSTATIC']['CTNUM'] : '' ?></p>
				</div>
			</div>

			<div class="flex space-between">
				<div class="justify-start40">
					<div>
						<p class="label-text14">สำหรับเดือน<?=isset($data['PRINTSTATIC']['MONTH']) ? str_repeat('&emsp;', 2).$data['PRINTSTATIC']['MONTH'] : '' ?>
						<?=isset($data['PRINTSTATIC']['YEAR_BE']) ? str_repeat('&emsp;', 2).$data['PRINTSTATIC']['YEAR_BE'] : '' ?></p>
					</div>
				</div>
				<div class="justify-end60">
					<p class="label-text14">แผ่นที่&nbsp;<?=isset($data['PRINTSTATIC']['TPAGE']) ? str_repeat('&emsp;', 1).$data['PRINTSTATIC']['TPAGE'] : '' ?>&emsp;ในจำนวน&nbsp;<?=isset($data['PRINTSTATIC']['TPAGE']) ? str_repeat('&emsp;', 1).$data['PRINTSTATIC']['TPAGE'].str_repeat('&emsp;', 1) : '' ?>แผ่น</p>
				</div>
			</div>

			<table class="table" style="margin-top: 0.5em;">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width3 borderTop borderLeft borderRight">ลำดับ</td>
						<td class="td-label-width15 td-text-left">ผู้รับเงินได้พึ่งประเมิน</td>
	 					<td class="td-label-width10 borderRight">เลขประจำตัวผู้เสียภาษี</td>
	 					<td class="td-label-width40 borderBottom borderRight" colspan="4">รายละเอียดเกี่ยวกับการจ่ายเงินได้พึ่งประมาณ</td>
 						<td class="td-label-width10 borderRight">เงินภาษีที่หัก</td>
	 					<td class="td-label-width10">เงื่อนไข</td>
					</tr>
					<tr class="table-tr">
						<td class="td-label-width3 borderBottom borderLeft borderRight">ที่</td>
						<td class="td-label-width1 td-text-left borderBottom borderRight" colspan="2">ที่อยู่ของผู้มีเงินได้</td>
						<td class="td-label-width10 borderBottom borderRight" colspan="1">วันจ่าย</td>
						<td class="td-label-width10 borderBottom borderRight" colspan="1">ประเถทเงินได้ (1)</td>
						<td class="td-label-width10 borderBottom borderRight" colspan="1">อัตรา</td>
						<td class="td-label-width10 borderBottom borderRight" colspan="1">เงินที่จ่าย</td>
						<td class="td-label-width10 borderBottom borderRight" colspan="1">และนำส่งในครั้งนี้</td>
						<td class="td-label-width10 borderBottom" colspan="1">(2)</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  {
					$maxrow = 6;
					$minrow = count($data['PRINTDYNAMIC']);  
					foreach ($data['PRINTDYNAMIC'] as $key => $value) { ?>
		                <tr class="tr-height">
    						<td class="td-text-center borderLeft"><?=isset($value['RNO']) ? $value['RNO']: '' ?></td>
							<td class="td-text-left borderLeft"><?=isset($value['NAME']) ? $value['NAME']: '' ?></td>
							<td class="td-text-left"><?=isset($value['NAMETAX']) ? $value['NAMETAX']: '' ?></td>	
							<td class="td-text-left borderLeft" colspan="1"><?=isset($value['DATE']) ? date_format(date_create($value['DATE']),"d/m/Y"): '' ?></td>
							<td class="td-text-left borderLeft" colspan="1"><?=isset($value['MON']) ? $value['MON']: '' ?></td>
							<td class="td-text-center borderLeft" colspan="1"><?=isset($value['A']) ? $value['A']: str_repeat('&emsp;', 1) ?></td>
							<td class="td-text-right borderLeft" colspan="1"><?=isset($value['PAY']) ? $value['PAY']: '' ?></td>
							<td class="td-text-right borderLeft" colspan="1"><?=isset($value['TAXM']) ? $value['TAXM']: '' ?></td>
							<td class="td-text-center borderLeft" colspan="1"><?=isset($value['REM']) ? $value['REM']: '' ?></td>
		                </tr>
	                   <tr class="tr-height">
    						<td class="td-text-center borderLeft borderBottom"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="2"><?=isset($value['ADD1']) ? $value['ADD1']: '' ?><?=isset($value['ADD2']) ? $value['ADD2']: '' ?></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
							<td class="td-text-left borderLeft borderBottom" colspan="1"></td>
		                </tr><?php
		            }
	               	if($minrow < $maxrow) { 
		            	for ($i = $minrow; $i <= $maxrow; $i++) { ?>
			        		<tr class="tr-height">
				                <td class="borderLeft"></td>
				                <td class="borderLeft"></td>
				                <td class="td-text-left"></td>
			                  	<td class="borderLeft"></td>
			                  	<td class="borderLeft"></td>
				                <td class="borderLeft"></td>
								<td class="borderLeft"></td>
								<td class="borderLeft"></td>
								<td class="borderLeft"></td>
				            </tr>
							<tr class="tr-height">
				                <td class="borderLeft borderBottom"></td>
				                <td class=" borderLeft borderBottom" colspan="2"></td>
				                <td class=" borderLeft borderBottom"></td>
			                  	<td class=" borderLeft borderBottom"></td>
			                  	<td class=" borderLeft borderBottom"></td>
				                <td class=" borderLeft borderBottom"></td>
			                	<td class=" borderLeft borderBottom"></td>
				                <td class=" borderLeft borderBottom"></td>
				            </tr2>
			            <?php
				        }
			       	}
		       	} ?>
				</tbody>
				<tfoot>
				   <tr class="tr-height">
				   		<td class="td-text-left padding-left3" colspan="6">รวมยอดเงินได้และภาษีที่นำส่งทั้งสิ้น&ensp;<?=isset($data['PRINTSTATIC']['TTAXTC']) ? $data['PRINTSTATIC']['TTAXTC']: '' ?></td>
				   		<td class="td-text-right borderAll"><?=isset($data['PRINTSTATIC']['TPAY']) ? $data['PRINTSTATIC']['TPAY']: '' ?></td>
			   			<td class="td-text-right borderAll"><?=isset($data['PRINTSTATIC']['TTAXM']) ? $data['PRINTSTATIC']['TTAXM']: '' ?></td>
		   				<td class="td-text-left" colspan="1"></td>
				   </tr>
				</tfoot>
			</table>
			<div class="flex padding-left3">
				<p class="label-text14">งวด&emsp;<?=isset($data['PRINTSTATIC']['FDT_AD']) ? $data['PRINTSTATIC']['FDT_AD']: '' ?>&emsp;ถึง&emsp;<?=isset($data['PRINTSTATIC']['TDT_AD']) ? $data['PRINTSTATIC']['TDT_AD']: '' ?></p>
				<p class="label-text14">รวมใบ ภ.ง.ด.53 ทั้งสิ้น&emsp;<?=isset($data['PRINTSTATIC']['TPAGE']) ? $data['PRINTSTATIC']['TPAGE']: '' ?>&emsp;แผ่น</p>
			</div>
			<div class="flex-column" style="margin-top: 3%;">
				<p class="label-text14" style="padding-left: 40%;">ลงชื่อ..........................................................ผู้จ่ายเงิน</p>
				<p class="label-text14" style="padding-left: 45%;">(......................................................)<?=str_repeat('&emsp;', 4)?>ประทับตรานิติบุคคล</p>
				<p class="label-text14" style="padding-left: 42%;">ตำแหน่ง......................................................<?=str_repeat('&emsp;', 6)?>(ถ้ามี)</p>
				<p class="label-text14" style="padding-left: 41%;">ยื่นวันที่..........เดือน.....................พ.ศ.............</p>
			</div>
			<div class="flex-column padding-left3">
				<p class="label-text14">หมายเหตุ (1) ให้ระบุว่าจ่ายเป็นค่าอะไร เช่น ค่าเช่าอาคาร ค่าสอบบัญชี ค่าออกแบบ ค่าก่อสร้างโรงเรียน</p>
				<p class="label-text14" style="padding-left: 12%;">ค่าซื้อเครื่องพิมพ์ดีด ค่าซื้อพืชผลทางการเกษตร (ยางพารา มันสำปะหลัง ปอ ข้าว ฯลฯ)</p>
			</div>
		</div>
	</div>
</body>
</html>