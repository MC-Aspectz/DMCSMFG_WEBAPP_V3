<?php 
require_once('./function/index_x.php');
printed(); 
$index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="printReport">
		<div class="page">
			<div class="flex-column">
				<label class="label-text17"><?=$data['PRINTSTATIC']['COMPNTH']?></label>
				<label class="label-text17"><?=$data['PRINTSTATIC']['COMPNEN']?></label>
				<label class="label-text16">Supplier:&emsp;<?=$data['PRINTDYNAMIC'][1]['SUPNAME']?></label>
			</div>
			<h3 class="title-bill">ใบสั่งซื้อ / Purchase Requisition</h3>
			<div class="flex space-evenly">
				<label class="label-text15">ผู้ขอซื้อ&nbsp;<span class="span-underline">
				<?=(isset($data['PRINTDYNAMIC'][$index]['REQN'])) ? $data['PRINTDYNAMIC'][$index]['REQN'].str_repeat('&emsp;', 2): str_repeat('&emsp;', 6) ?></span><br>Request By</label>
				<label class="label-text15">แผนก&nbsp;<span class="span-underline">
				<?=(isset($data['PRINTDYNAMIC'][$index]['DEPT'])) ? $data['PRINTDYNAMIC'][$index]['DEPT'].str_repeat('&emsp;', 2): str_repeat('&emsp;', 6) ?></span><br>Department</label>
				<label class="label-text15">วันที่&nbsp;<span class="span-underline">
				<?=(isset($data['PRINTDYNAMIC'][$index]['TDATE'])) ? $data['PRINTDYNAMIC'][$index]['TDATE'].str_repeat('&emsp;', 2): str_repeat('&emsp;', 6) ?></span><br>Date</label>
				<label class="label-text15">เลขที่&nbsp;<span class="span-underline">
				<?=(isset($data['PRINTDYNAMIC'][$index]['DOCN'])) ? $data['PRINTDYNAMIC'][$index]['DOCN'].str_repeat('&emsp;', 2): str_repeat('&emsp;', 6) ?></span><br>Doc No.</label>
				<label class="label-text15">วันที่ต้องการ&nbsp;<span class="span-underline">
				<?=(isset($data['PRINTDYNAMIC'][$index]['REQDT'])) ? $data['PRINTDYNAMIC'][$index]['REQDT'].str_repeat('&emsp;', 2): str_repeat('&emsp;', 6) ?></span><br>Required Date</label>
			</div><br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width10">ลำดับ<br>No</td>
						<td class="td-label-width20">รายการ<br>Description</td>
						<td class="td-label-width20">วัตถุประสงค์ในการขอซื้อ<br>Purpose of Order</td>
						<td class="td-label-width10">หน่วย<br>Unit</td>
						<td class="td-label-width10">จำนวน<br>Quantity</td>
						<td class="td-label-width15">รหัส<br>Code</td>
						<td class="td-label-width15">หมายเหตุ<br>Remark</td>
					</tr>
				</thead>
				<tbody><?php 

				if(!empty($data['PRINTDYNAMIC']))  {  
					$maxrow = 16; 
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
	  					$minrow = count($data['PRINTDYNAMIC']); ?>
		                <tr class="tr-height">
		                    <td class="td-text-center"><?=$value['NUM']; ?></td>
		                    <td class="td-text-left"><?=$value['DESCR']; ?></td>
		        			<td class="td-text-left"><?=$value['POO']; ?></td>
							<td class="td-text-center"><?=$value['UT']; ?></td>
							<td class="td-text-right"><?=$value['QTY']; ?></td>
							<td class="td-text-center"><?=$value['RD']; ?></td>
				         	<td class="td-text-left"><?=$value['REM']; ?></td>
		                </tr> <?php 
		            }
		            if($minrow < $maxrow) { 
		            	for ($i = $minrow; $i <= $maxrow; $i++) { ?>
			        		<tr class="tr-height">
				                <td class="td-border"></td>
				                <td class="td-border"></td>
				                <td class="td-border"></td>
			                  	<td class="td-border"></td>
				                <td class="td-border"></td>
				                <td class="td-border"></td>
				                <td class="td-border"></td>
				            </tr><?php
				        }
			       	}
		       	} ?>
				</tbody>
				<tfoot>
					<tr class="tr-height">
						<td colspan="4" class="td-boder-left">TOTAL&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['TOTQTY'])) ? $data['PRINTSTATIC']['TOTQTY']: '' ?></td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['TCRE'])) ? $data['PRINTSTATIC']['TCRE']: '' ?></td>
					</tr>
				</tfoot>
			</table><br>
			<div class="flex space-evenly">
		    	<div class="div-center">
					<p class="label-text13">____________________________<br>ผู้ขอซื้อ/Request by</p>
				</div>
				<div class="div-center">
					<p class="label-text13">____________________________<br>หัวหน้าแผนก/Check by</p>
				</div>
				<div class="div-center">
					<p class="label-text13">____________________________<br>ผู้อนุมัติ/Approve by</p>
				</div>
				<div class="div-center">
					<p class="label-text13">____________________________<br>แผนกจัดซื้อ/Purchasing Dept.<br>______/______/______</p>
				</div>
			</div>
			<p class="remark">1. กรุณาระบุรายละเอียดสินค้าให้ชัดเจนหรือในกรณีที่เป็นสินค้าสั่งทำพิเศษให้แบบรายละเอียดสินค้า ( Please explain the goods in detail and in case of special specification goods please attach a reference data )</p>
		</div>
	</div>
</body>
</html>