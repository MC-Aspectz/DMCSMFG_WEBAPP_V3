<?php 
require_once('./function/index_x.php');	printed(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="debitNote">
		<div class="page">
			<div class="flex">
				<div class="flex width70">
					<div class="flex-column">
						<h3 class="company-head"><?=(isset($data['PRINTSTATIC']['COMPNEN'])) ? $data['PRINTSTATIC']['COMPNEN'] : "" ?></h3>
						<label class="label-text15"><?=(!empty($data['PRINTSTATIC']['ADDR'])) ? $data['PRINTSTATIC']['ADDR'] : '' ?></label>
						<label class="label-text15"><span>โทร/Tel&emsp;&emsp;<?=!empty($data['PRINTSTATIC']['TELTH']) ? $data['PRINTSTATIC']['TELTH'] : '' ?></span>&emsp;&emsp;
													<span>แฟกซ์/Fax&emsp;&emsp;<?=!empty($data['PRINTSTATIC']['FAXTH']) ? $data['PRINTSTATIC']['FAXTH'] : '' ?></span></label>
						<label class="label-text15"><span>เลขประจำตัวผู้เสียภาษีอากร/Tax ID No.&emsp;<?=!empty($data['PRINTSTATIC']['TAXID']) ? $data['PRINTSTATIC']['TAXID'] : '' ?></span>&emsp;&emsp;
													<span>สาขา/Branch&emsp;<?=!empty($data['PRINTSTATIC']['DEPT']) ? $data['PRINTSTATIC']['DEPT'] : '' ?></span></label>
						<label class="label-text15"><?=!empty($data['PRINTSTATIC']['RPTCUSSUP']) ? $data['PRINTSTATIC']['RPTCUSSUP'] : '' ?></label>
					</div>	
				</div>
				<div class="flex width30">
					<h3 class="title-bill"><?=isset($data['PRINTDYNAMIC'][$index]['PAGETYPE']) ? $data['PRINTDYNAMIC'][$index]['PAGETYPE']: ''?>
											<br><?=isset($data['PRINTSTATIC']['RPTTITLE']) ? $data['PRINTSTATIC']['RPTTITLE']: ''?></h3>
				</div>
			</div>
			<div class="flex">
			   <div class="flex width55">
			   		<div class="flex-column">
						<label class="customer-title"><?=isset($data['PRINTSTATIC']['CUSFN']) ? $data['PRINTSTATIC']['CUSFN'] : '' ?></label>
		    			<label class="label-text15"><?=(isset($data['PRINTSTATIC']['CUSADDR1'])) ? $data['PRINTSTATIC']['CUSADDR1'] : '' ?></label>
		    			<label class="label-text15"><?=(isset($data['PRINTSTATIC']['CUSADDR2'])) ? $data['PRINTSTATIC']['CUSADDR2'] : '' ?></label>
		    			<label class="label-text15">เลขประจำตัวผู้เสียภาษีอากร/Tax ID No.<?=isset($data['PRINTSTATIC']['TAXID']) ? str_repeat('&emsp;', 3).$data['PRINTSTATIC']['TAXID'] : '' ?></label>
		    			<label class="label-text15">สาขา/Branch<?=isset($data['PRINTDYNAMIC'][$index]['BRANCHNO']) ? str_repeat('&emsp;', 4).$data['PRINTDYNAMIC'][$index]['BRANCHNO'] : '' ?></label>
		    		</div>	
				</div>
				<div class="flex width45">
					<div class="width75">
						<div class="flex-column">
							<label class="label-text14">เลขที่/Note No.</label>
							<label class="label-text14">วันที่/Date</label>
							<label class="label-text13I">อ้างอิงใบกำกับภาษีเลขที่/Ref. Invoice No.</label>
							<label class="label-text14">อ้างอิงใบกำกับภาษีวันที่/Ref. Date</label>
						</div>
					</div>
					<div class="width25">
						<div class="flex-column">
							<label class="label-text14I"><?=(isset($data['PRINTSTATIC']['CRENUM'])) ? $data['PRINTSTATIC']['CRENUM']: '' ?></label>
							<label class="label-text14I"><?=(isset($data['PRINTSTATIC']['TDATE'])) ? $data['PRINTSTATIC']['TDATE']: '' ?></label>
							<label class="label-text14I"><?=(isset($data['PRINTSTATIC']['INVNUM'])) ? $data['PRINTSTATIC']['INVNUM']: '' ?></label>
							<label class="label-text14I"><?=(isset($data['PRINTSTATIC']['INVDATE'])) ? $data['PRINTSTATIC']['INVDATE']: '' ?></label>
						</div>
					</div>
				</div>
			</div><br>
			<table class="table">
				<thead>
					<tr class="table-tr">
					<td class="td-label-width3">ลำดับ<br>NO.</td>
					<td class="td-label-width40">สินค้า/รายละเอียด<br>ITEM/DESCRIPTION</td>
					<td class="td-label-width15">จำนวน<br>QUANTITY</td>
					<td class="td-label-width15">ราคาต่อหน่วย<br>Unit Price</td>
					<td class="td-label-width15">จำนวนเงิน<br>AMOUNT<?=isset($data['PRINTSTATIC']['CUR']) ?str_repeat('&emsp;', 1).$data['PRINTSTATIC']['CUR']: '' ?></td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  { 
					$maxrow = 10;    
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						$minrow = count($data['PRINTDYNAMIC']);?>
		                <tr>
		                    <td class="td-text-center"><?=$value['ROWCOUNTER']; ?></td>
		                    <td class="td-text-left"><?=$value['CODE'].str_repeat('&emsp;', 2).$value['DESCR']; ?></td>
		        			<td class="td-text-center"><?=$value['QTY']; ?></td>
							<td class="td-text-right"><?=$value['UPR']; ?></td>
							<td class="td-text-right"><?=$value['AMT']; ?></td>
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
				            </tr><?php
				        }
			       	}
		       	} ?>
				</tbody>
				<tfoot>
					<tr class="tr-height">
						<td colspan="2" class="label-text13">หมายเหตุ / Remark</td>
						<td colspan="2" class="label-text13">ยอดเงินรวม/Subtotal</td>
						<td class="td-text-right"><?=isset($data['PRINTSTATIC']['SUB']) ? $data['PRINTSTATIC']['SUB'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2" class="remark"><?=isset($data['PRINTSTATIC']['REM1']) ? $data['PRINTSTATIC']['REM1'] : '' ?></td>
						<td colspan="2" class="label-text13"></td>
						<td class="td-text-right"></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2" class="remark"><?=isset($data['PRINTSTATIC']['REM2']) ? $data['PRINTSTATIC']['REM2'] : '' ?></td>
						<td colspan="2" class="label-text13"></td>
						<td class="td-text-right"></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2" class="remark"><?=isset($data['PRINTSTATIC']['REM3']) ? $data['PRINTSTATIC']['REM3'] : '' ?></td>
						<td colspan="2" class="label-text13"></td>
						<td class="td-text-right td-boder-button"></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2"></td>
						<td colspan="2" class="label-text13">มูลค่าสินค้าตามใบกำกับภาษีเดิม/Old Invoice Amount</td>
						<td class="td-text-right"><?=isset($data['PRINTSTATIC']['OLDINV']) ? $data['PRINTSTATIC']['OLDINV'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2"></td>
						<td colspan="2" class="label-text13">มูลค่าสินค้าที่ถูกต้อง/Correct Invoice Amount</td>
						<td class="td-text-right"><?=isset($data['PRINTSTATIC']['CORINV']) ? $data['PRINTSTATIC']['CORINV'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2"></td>
						<td colspan="2" class="label-text13">ผลต่าง/Difference</td>
						<td class="td-text-right"><?=isset($data['PRINTSTATIC']['DIFF']) ? $data['PRINTSTATIC']['DIFF'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2"></td>
						<td colspan="2" class="label-text13">ภาษีมูลค่าเพิ่ม/VAT Amount<?=str_repeat('&emsp;', 2).$data['PRINTSTATIC']['PVAT']?></td>
						<td class="td-text-right"><?=isset($data['PRINTSTATIC']['TVAT']) ? $data['PRINTSTATIC']['TVAT'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height">
						<td colspan="2" class="td-boder-button"></td>
						<td colspan="2" class="label-text13 td-boder-button">มูลค่าสุทธิ/Tax-Included Amount</td>
						<td class="td-text-right td-boder-button"><?=isset($data['PRINTSTATIC']['TOT']) ? $data['PRINTSTATIC']['TOT'] : '0.00' ?></td>
					</tr>
					<tr class="tr-height25">
						<td colspan="5" class="td-boder-button"></td>
					</tr>
				</tfoot>
			</table>
			<div class="border-frame97">
		    	<div class="width50 height100px" style="float: left;">
					<p class="label-text13" style="margin-top: 10%; margin-left: 2%;">ผู้รับ<br>Received By<?=str_repeat('&emsp;', 2)?>______________________________</p>
				</div>
				<div class="width45 border-left height100px" style="float: right;">
					<p class="label-text13" style="margin-top: 10%; margin-left: 2%;">ได้รับอนุญาติโดย<br>Authorized By<?=str_repeat('&emsp;', 2)?>______________________________</p>
				</div>
			</div>
			<p class="label-text15" style="padding-left: 2%; margin-top: 2%;"><?=!empty($data['REPRINTREASON']) ? 'Reprint reason': ''?></p>
			<p class="label-text15-black" style="padding-left: 4%;"><?=!empty($data['REPRINTREASON']) ? $data['REPRINTREASON']: ''?></p>
		</div>
	</div>
</body>
</html>