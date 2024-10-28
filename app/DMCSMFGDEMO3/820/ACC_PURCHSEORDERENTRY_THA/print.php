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
				<label class="label-text18"><?=$data['PRINTSTATIC']['COMPNTH']?></label>
				<label class="label-text18"><?=$data['PRINTSTATIC']['COMPNEN']?></label>
				<div class='container'><hr></div>
				<label class="label-text14"><?=(!empty($data['PRINTSTATIC']['ADDR1'])) ? $data['PRINTSTATIC']['ADDR1'] : '' ?></label>
				<label class="label-text15"><?=(!empty($data['PRINTSTATIC']['ADDR2'])) ? $data['PRINTSTATIC']['ADDR2'] : '' ?></label>
				<label class="label-text15"><span>โทร/Tel&emsp;&emsp;<?=!empty($data['PRINTSTATIC']['TELTH']) ? $data['PRINTSTATIC']['TELTH'] : '' ?></span>&emsp;&emsp;
											<span>แฟกซ์/Fax&emsp;&emsp;<?=!empty($data['PRINTSTATIC']['FAXTH']) ? $data['PRINTSTATIC']['FAXTH'] : '' ?></span></label>
			</div>	
			<h4 class="title-bill">ใบสั่งซื้อ<br>PURCHASE ORDER</h4>
			<div class="flex space-evenly">
			    <div class="border-frame60">
				    <div class="width20">
				    	<p class="label-text14">ผู้ผลิต<br>Supplier:</p>
				    	<p class="label-text14"><?=str_repeat('&emsp;', 1)?></p>
						<p class="label-text14">ที่อยู่<br>Address:</p>
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?></p>
						<p class="label-text14">โทร/Tel:</p>
					</div>
					<div class="width80">
				 		<p class="label-text14"><?=str_repeat('&emsp;', 1)?><br><?=(!empty($data['PRINTSTATIC']['SUPN'])) ? $data['PRINTSTATIC']['SUPN']: str_repeat('&emsp;', 1); ?></p>
				 		<p class="label-text14"><?=str_repeat('&emsp;', 1)?></p>
						<p class="label-text14"><?=(!empty($data['PRINTSTATIC']['SUPADDR1'])) ? $data['PRINTSTATIC']['SUPADDR1']: str_repeat('&emsp;', 1); ?>
												<?=(!empty($data['PRINTSTATIC']['SUPADDR2'])) ? $data['PRINTSTATIC']['SUPADDR2']: str_repeat('&emsp;', 1); ?></p>
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?></p>
						<p class="label-text14"><?=(!empty($data['PRINTSTATIC']['CTEL'])) ? $data['PRINTSTATIC']['CTEL']: "" ?>
							<span class="label-text14">แฟกซ์/Fax:</span><label class="label-text14"><?=(!empty($data['PRINTSTATIC']['CFAX'])) ?  $data['PRINTSTATIC']['CFAX']: '' ?></label></p>
					</div>
			    </div>
			    <div class="border-frame35">
					<div class="width45">
						<p class="label-text14">เลขที่ใบสั่งซื้อ<br>P/O No.</p>
						<p class="label-text14">วันที่<br>Date</p>
						<p class="label-text14">ระยะเครดิต<br>Credit Term</p>
						<p class="label-text14">เอกสารอ้างอิง<br>Reference</p>
					</div>
					<div class="width55">
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?><br><?=(!empty($data['PRINTSTATIC']['PONUM'])) ? $data['PRINTSTATIC']['PONUM']: '' ?></p>
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?><br><?=(!empty($data['PRINTSTATIC']['TDATE'])) ? $data['PRINTSTATIC']['TDATE']: '' ?></p>
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?><br><?=(!empty($data['PRINTSTATIC']['PAYTERM'])) ? $data['PRINTSTATIC']['PAYTERM']: '' ?><span class="label-text14">day</span></p>
						<p class="label-text14"><?=str_repeat('&emsp;', 1)?><br><?=(!empty($data['PRINTSTATIC']['REFD'])) ? $data['PRINTSTATIC']['REFD']: '' ?></p>
					</div>
				</div>
		    </div><br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width10">ลำดับ<br>NO.</td>
						<td class="td-label-width15">รหัส<br>CODE</td>
						<td class="td-label-width20">รายละเอียด<br>DESCRIPTION</td>
						<td class="td-label-width10">จำนวน<br>QTY</td>
						<td class="td-label-width10">&emsp;<br>UOM</td>
						<td class="td-label-width15">ราคาต่อหน่วย<br>UNITPRICE</td>
						<td class="td-label-width10">ส่วนลด<br>DISCOUNT</td>
						<td class="td-label-width10">จำนวนเงิน<br>AMOUNT</td>
					</tr>
				</thead>
				<tbody><?php 
					if(!empty($data['PRINTDYNAMIC']))  {  
						$maxrow = 8; 
						foreach ($data['PRINTDYNAMIC'] as $key => $value) {
		  					$minrow = count($data['PRINTDYNAMIC']);
							?>
			                <tr class="tr-height">
			                    <td class="td-text-center"><?=$value['NUM']; ?></td>
			                    <td class="td-text-left"><?=$value['CODE']; ?></td>
			        			<td class="td-text-left"><?=$value['DESCR']; ?></td>
								<td class="td-text-center"><?=$value['QTY']; ?></td>
								<td class="td-text-center"><?=$value['UOM']; ?></td>
								<td class="td-text-right"><?=$value['UPR']; ?></td>
								<td class="td-text-center"><?=$value['DIS']; ?></td>
					         	<td class="td-text-left"><?=$value['AMT']; ?></td>
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
					                <td class="td-border"></td>
					            </tr><?php
					        }
				       	}
			       	} ?>
				</tbody>
				<tfoot>
					<tr class="tr-height">
						<td colspan="7" class="td-boder-left">ยอดเงินรวม/Subtotal&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['SUB'])) ? $data['PRINTSTATIC']['SUB']: '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="4" class="label-text13"><?=(isset($data['PRINTSTATIC']['GTOTTH'])) ? $data['PRINTSTATIC']['GTOTTH']: 'บาทถ้วน' ?></td>
						<td colspan="3" class="text-right">หักส่วนลด/Less Discount&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['LDIS'])) ? $data['PRINTSTATIC']['LDIS']: '0.00' ?></td>
					</tr>			
					<tr class="tr-height">
						<td colspan="4" class="label-text11"><?=(isset($data['PRINTSTATIC']['GTOTEN'])) ? $data['PRINTSTATIC']['GTOTEN']: 'ZERO BAHT' ?></td>
						<td colspan="3" class="text-right">ยอดหลังหักส่วนลด/After Discount&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['AFDIS'])) ? $data['PRINTSTATIC']['AFDIS']: '0.00' ?></td>
					</tr>			
					<tr class="tr-height">
						<td colspan="7" class="td-boder-left">ภาษีมูลค่าเพิ่ม/VAT Amount&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['TVAT'])) ? $data['PRINTSTATIC']['TVAT']: '0.00' ?></td>
					</tr>	
					<tr class="tr-height">
						<td colspan="7" class="td-boder-left">จำนวนเงินรวมทั้งสิ้น/Total Amount&emsp;</td>
						<td class="td-boder-left"><?=(isset($data['PRINTSTATIC']['TOT'])) ? $data['PRINTSTATIC']['TOT']: '0.00' ?></td>
					</tr>	
				</tfoot>
			</table>
			<div class="flex" style="margin: 10.0px;">
				<div class="flex width20">
					<label class="label-text14">หมายเหตุ/Remark</label>
				</div>
				<div class="flex-column width80">
					<label class="label-text13I"><?=(!empty($data['PRINTSTATIC']['REM1'])) ? $data['PRINTSTATIC']['REM1']: '' ?></label>
					<label class="label-text13I"><?=(!empty($data['PRINTSTATIC']['REM2'])) ? $data['PRINTSTATIC']['REM2']: '' ?></label>
					<label class="label-text13I"><?=(!empty($data['PRINTSTATIC']['REM3'])) ? $data['PRINTSTATIC']['REM3']: '' ?></label>
				</div>
			</div>
			<div class="flex">
				<div class="flex-column border-frame40" >
					<label class="label-text13I">สำหรับผู้ผลิต<br>FOR SUPPLIER</label>
					<label class="label-text13I">ยืนยันการสั่งซื้อโดย<br>Order confirmed by&nbsp;___________</label>
					<label class="label-text13I">วันที่<br>Date&emsp;______/______/______</label>
					<label class="label-text13I" style="margin-bottom: 5.0px;">วันที่จัดส่ง<br>Delivery Date&emsp;&emsp;
					<span class="span-underline"><?=(isset($data['PRINTSTATIC']['DELIDATE'])) ? $data['PRINTSTATIC']['DELIDATE'].str_repeat('&emsp;', 1): str_repeat('&emsp;', 3) ?></span></label>
				</div>
				<div class="flex width60 space-evenly">
					<div class="flex-column space-evenly width98">
						<div class="flex space-between div-center">
							<label class="label-text13">ขอซื้อโดย<br>Request by</label>
							<label class="label-text13">จัดทำโดย<br>Prepared By</label>
							<label class="label-text13">ตรวจสอบโดย<br>Verified By</label>
							<label class="label-text13">อนุมัติโดย<br>Approved By</label>
						</div>
						<div class="flex space-between div-center">
							<label class="label-text13">______________</label>
							<label class="label-text13">______________</label>
							<label class="label-text13">______________</label>
							<label class="label-text13">______________</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>