<?php require_once('./function/index_x.php'); printed(); $index = isset($data['PRINTDYNAMIC']) ? array_key_last($data['PRINTDYNAMIC']) : 0;?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="printReport">
		<?php for ($i = 1; $i <= $data['PRINTDYNAMIC'][$index]['PPAGE']; $i++) { ?>
		<div class="page">
			<div class="flex">
				<div class="justify-start">
					<div>
						<p class="label-text13"><?=isset($data['PRINTSTATIC']['COMPN']) ? $data['PRINTSTATIC']['COMPN'] : '' ?></p>
					</div>
				</div>
				<div class="justify-center">
					<div>
						<h3 class="title-bill">รายงานภาษีขาย</h3>
						<h5 class="label-text14">เดือน/ปีภาษี<?=isset($data['PRINTSTATIC']['MONTHY']) ? $data['PRINTSTATIC']['MONTHY'] : ''?></h5>
					</div>
				</div>
				<div class="justify-end">
					<div class="flex-column">
						<p class="label-text14">วันที่พิมพ์/No.&nbsp;<?=isset($data['PRINTSTATIC']['TDATE']) ? str_repeat('&emsp;', 1).$data['PRINTSTATIC']['TDATE'] : '' ?></p>
						<p class="label-text14">หน้า&nbsp;<?= str_repeat('&emsp;', 5).$i ?></p>
					</div>
				</div>
			</div>

			<div class="flex">
		    	<table class="table-head">
		    		<tbody>
    			        <tr>
	                        <td class="border-none" colspan="2"><label class="label-text13">ชื่อผู้ประกอบการ</label></td>
	                        <td class="border-none text-left" colspan="8"><label class="label-text13 text-left"><?=!empty($data['PRINTSTATIC']['COMPN']) ? $data['PRINTSTATIC']['COMPN']: '' ?></label></td>
	                    </tr>
	                    <tr>
	                        <td class="border-none" colspan="2"><label class="label-text13">ชื่อสถานประกอบการ</label></td>
	                        <td class="border-none text-left" colspan="5"><label class="label-text13 text-left"><?=!empty($data['PRINTSTATIC']['COMPN']) ? $data['PRINTSTATIC']['COMPN']: '' ?></label></td>

                          	<td class="border-none text-right" colspan="2"><label class="label-text13 text-left">เลขประจำตัวผู้เสียภาษีอากร</label></td>
	                        <td class="border-none text-right"><label class="label-text13 text-left"><?=!empty($data['PRINTSTATIC']['CNUM']) ? $data['PRINTSTATIC']['CNUM']: '' ?></label></td>
	                    </tr>

	                    <tr>
	                        <td class="border-none" colspan="2"><label class="label-text13">สถานประกอบการ</label></td>
	                        <td class="border-none text-left" colspan="5"><label class="label-text13 text-left"><?=!empty($data['PRINTSTATIC']['ADDRESS']) ? $data['PRINTSTATIC']['ADDRESS']: '' ?></label></td>

                          	<td class="border-none text-right" colspan="2"><label class="label-text13 text-left">สำนักงานใหญ่/สาขา</label></td>
	                        <td class="border-none text-right"><label class="label-text13 text-left"><?=!empty($data['PRINTSTATIC']['DEPT']) ? $data['PRINTSTATIC']['DEPT']: '' ?></label></td>
	                    </tr>
	                </tbody>
		    	</table>
		    </div>
			<table class="table" style="margin-top: 0.5em;">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width25"><----------ใบกำกับภาษี ----------><br>ลำดับ<?=str_repeat('&emsp;', 1)?>วัน/เดือน/ปี<?=str_repeat('&emsp;', 1)?>เลขที่</td>
	 					<td class="td-label-width15">ชื่อผู้ซื้อสินค้า/ผู้รับบริการ<br><?=str_repeat('&emsp;', 1)?></td>
	 					<td class="td-label-width10">เลขประจำตัวผู้เสียภาษีอากรของ<br>ผู้ซื้อสินค้า/ผู้รับบริการ</td>
 						<td class="td-label-width10">สถานประกอบการ<br>สนญ.<?=str_repeat('&emsp;', 1)?>สาขาที่</td>
	 					<td class="td-label-width10">มูลค่าสินค้า<br>หรือบริการ</td>
	 					<td class="td-label-width10">จำนวนเงิน<br>ภาษีมูลค่าเพิ่ม</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  {  
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						if($value['PPAGE'] == $i)  { ?>
			                <tr class="tr-height">
								<td class="td-text-left" style="padding-left: 3%;">
									<label><?=!empty($value['LINE']) ? str_repeat('&emsp;', 1).$value['LINE']: str_repeat('&emsp;', 2); ?></label>
									<label><?=!empty($value['DMY']) ? str_repeat('&emsp;', 1).$value['DMY']: str_repeat('&emsp;', 5).str_repeat('&ensp;', 1); ?></label>
									<label><?=!empty($value['INVNO']) ? str_repeat('&emsp;', 1).$value['INVNO']: str_repeat('&emsp;', 1); ?></td></label>
									
								<td class="td-text-left"><?=isset($value['COMPNAME']) ? $value['COMPNAME']: '' ?></td>
								<td class="td-text-left"><?=isset($value['TAXNUM']) ? $value['TAXNUM']: '' ?></td>
								<td class="td-text-left"><?=isset($value['BRANCH']) ? $value['BRANCH']: '' ?></td>
								<td class="td-text-right"><?=isset($value['SMON']) ? $value['SMON']: str_repeat('&emsp;', 1) ?></td>
								<td class="td-text-right"><?=isset($value['TAXMON']) ? $value['TAXMON']: '' ?></td>
			                </tr> <?php
			            }
		            }
		       	} ?>
				</tbody>
				<tfoot>
				   <tr class="tr-height">
				   		<td class="td-text-right" colspan="4">รวม</td>
				   		<td class="td-text-right" style="border-top: 1.0px solid black; border-bottom: 4.0px double black;">
				   			<label><?=isset($data['PRINTSTATIC']['TSMON']) ? $data['PRINTSTATIC']['TSMON']: '' ?></label></td>
			   			<td class="td-text-right" style="border-top: 1.0px solid black; border-bottom: 4.0px double black;">
			   				<label><?=isset($data['PRINTSTATIC']['TTAXMON']) ? $data['PRINTSTATIC']['TTAXMON']: '' ?></label></td>
				   </tr>
				</tfoot>
			</table>
		</div><?php } ?>
	</div>
</body>
</html>