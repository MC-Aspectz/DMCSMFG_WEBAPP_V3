<?php 
require_once('./function/index_x.php');	TAXINVRecprint(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="tax_inv"><?php 
	if(!empty($data['PRINTDYNAMIC'])) {
		foreach ($data['ITEMPAGE'] as $index => $value) { ?>
			<div class="page">
				<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNTH'])) ? $data['PRINTSTATIC']['COMPNTH'] : "" ?></p>
				<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNEN'])) ? $data['PRINTSTATIC']['COMPNEN'] : "" ?></p>
				<hr>
				<div class="width98">
					<label class="label-text14"><?=(!empty($data['PRINTSTATIC']['ADDRTH'])) ? $data['PRINTSTATIC']['ADDRTH'] : '' ?></label><br>
					<label class="label-text14"><?=(!empty($data['PRINTSTATIC']['ADDREN'])) ? $data['PRINTSTATIC']['ADDREN'] : '' ?></label><br>
					<label class="label-text14">โทร/Tel&emsp;<?=(!empty($data['PRINTSTATIC']['TELO'])) ? $data['PRINTSTATIC']['TELO']: '     ' ?></label>&emsp;
					<label class="label-text14">แฟกซ์/Fax&emsp;<?=(!empty($data['PRINTSTATIC']['FAXO'])) ? $data['PRINTSTATIC']['FAXO']: '     ' ?></label>&emsp;
					<label class="label-text14">สาขา/Branch&emsp;<?=(!empty($data['PRINTSTATIC']['DEPT'])) ? $data['PRINTSTATIC']['DEPT']: '' ?></label><br>
					<label class="label-text14">เลขประจำตัวผู้เสียภาษีอากร/ Tax ID No.&emsp;<?=(!empty($data['PRINTSTATIC']['TAXNO'])) ? $data['PRINTSTATIC']['TAXNO']: '' ?></label>
				</div>
				<p class="title-bill" style="font-size: 18.0px;"><?=$value['RPTTITLETH']?></p>
				<div class="flex">
					<label class="label-justify-start"><?=$value['SONUM']?></label>
					<label class="label-justify-center2"><?=$value['RPTTITLE']?></label>
					<label class="label-justify-end">(<?=lang('setofdocuments')?>)</label>
				</div>
				<div class="flex">
				    <div class="border-frame60">
					    <div class="width40">
					    	<p class="label-text13I">ลูกค้า/CUSTOMER:</p>
							<p class="label-text13I">TAX ID NO.</p>
					    	<p class="label-text13I">ที่อยู่/ADDRESS: </p>
					    	<p class="label-text13I"><?=str_repeat('&emsp;', 2)?><br><?=str_repeat('&emsp;', 2)?></p>
							<p class="label-text13I">โทร/Tel : <?=(!empty($value['CTEL'])) ? $value['CTEL']: '' ?>&emsp;&emsp;</p>
						</div>
						<div class="width60">
					 		<p class="label-text15-bold"><?=(isset($value['CUSNM'])) ? $value['CUSNM']: '' ?><?=str_repeat('&emsp;', 2)?></p>
		 					<p class="label-text13"><?=(isset($value['TAXID'])) ? $value['TAXID']: '' ?>&emsp;&emsp;Branch&emsp;&emsp;<?=(isset($value['OFFICE'])) ? $value['OFFICE']: '' ?></p>
							<p class="label-text13"><?=(isset($value['ADDRCUS1'])) ? $value['ADDRCUS1']: '' ?>
							<?=(isset($value['ADDRCUS2'])) ? $value['ADDRCUS2']: ' ' ?></p>
							<p class="label-text13">แฟกซ์/Fax: <?=(isset($value['CFAX'])) ? $value['CFAX']: '' ?></p>
						</div>
				    </div>&emsp;
				    <div class="flex" style="width: 38%;">
				    	<table class="table-head">
				    		<tbody>
			                    <tr>
			                        <td class="width45-border"><label class="label-text12">&nbsp;เลขที่<br>&nbsp;NUMBER</label></td>
			                        <td class="width65-border"><label class="label-text12">&emsp;<?=(isset($value['SAVONUM'])) ? $value['SAVONUM']: '' ?></label></td>
			                    </tr>
			                    <tr>
									<td class="width45-border"><label class="label-text12">&nbsp;วันที่<br>&nbsp;INVOCIE DATE</td>
									<td class="width65-border"><label class="label-text12">&emsp;<?=(isset($value['INDATE'])) ? $value['INDATE']: '' ?></label></td>
			                    </tr>
			                    <tr>
			                        <td class="width45-border"><label class="label-text12">&nbsp;เงื่อนไชการชำระเงิน<br>&nbsp;PAYMENT TERM</label></td>
			                        <td class="width65-border"><label class="label-text12">&emsp;<?=(isset($value['PTERM'])) ? $value['PTERM']: '' ?>&nbsp;
			                        	วัน<br><?=str_repeat('&emsp;', 2)?>Day(s)</label></td>
			                    </tr>
			                    <tr>
			                        <td class="width45-border"><label class="label-text12">&nbsp;วันครบกำหนด<br>&nbsp;DUE DATE</td>
			                        <td class="width65-border"><label class="label-text12">&emsp;<?=(isset($value['DDATE'])) ? $value['DDATE']: '' ?></label></td>
			                    </tr>
			                    <tr>
									<td class="width45-border"><label class="label-text12">&nbsp;อ้างอิง<br>&nbsp;REFERENCE</label></td>
									<td class="width65-border"><label class="label-text12">&emsp;P/O No. <?=(isset($value['PONUM'])) ? $value['PONUM']: '' ?></label></td>
			                    </tr>
			                </tbody>
				    	</table>
				    </div>
				</div>
				<br>
				<table class="table">
					<thead>
						<tr class="table-tr">
							<td class="td-label-width3">ลำดับ<br>No.</td>
							<td class="td-label-width15">รหัส<br>Code</td>
							<td class="td-label-width25">รายละเอียด<br>Description</td>
							<td class="td-label-width10">จำนวน<br>Quantity</td>
							<td class="td-label-width10">ราคาต่อหน่วย<br>Unit Price</td>
							<td class="td-label-width10">จำนวนเงิน<br>Amount<?=isset($value['CUR']) ?str_repeat('&emsp;', 1).$value['CUR']: '' ?></td>
						</tr>
					</thead>
					<tbody><?php 
					if(!empty($data['PRINTDYNAMIC']))  { $maxrow = 10;    
						foreach ($data['PRINTDYNAMIC'] as $key => $item) { $minrow = count($data['PRINTDYNAMIC']);
							if($item['IDXNO'] == $value['IDXNO']) {	?>
			                <tr>
			                    <td class="td-text-center"><?=$item['ROWCOUNTER']; ?></td>
			                    <td class="td-text-left"><?=$item['CODE']; ?></td>
			                    <td class="td-text-left"><?=$item['ITEMDESC']; ?></td>
			        			<td class="td-text-center"><?=$item['QTY']; ?></td>
								<td class="td-text-right"><?=$item['UPR']; ?></td>
								<td class="td-text-right"><?=$item['AMT']; ?></td>
			                </tr> <?php 
			            	}
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
					            </tr><?php
					        }
				       	}
			       	} ?>
					</tbody>
					<tfoot>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12">จำนวนเงิน</td>
							<td class="td-text-left label-text12"></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left td-boder-button label-text12">TOTAL</td>
							<td class="td-text-right td-boder-button label-text12"><?=isset($value['TOTALAMT']) ? $value['TOTALAMT'] : '0.00' ?></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12">หักส่วนลด</td>
							<td class="td-text-left label-text12"></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12 td-boder-button">LESS DISCOUNT</td>
							<td class="td-text-right label-text12 td-boder-button"><?=isset($value['LDIS']) ? $value['LDIS'] : '0.00' ?></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12">ยอดหลังหักส่วนลด</td>
							<td class="td-text-left label-text12"></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12 td-boder-button">AFTER DISCOUNT</td>
							<td class="td-text-right label-text12 td-boder-button"><?=isset($value['AFDIS']) ? $value['AFDIS'] : '0.00' ?></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4"></td>
							<td class="td-text-left label-text12">ภาษีมูลค่าเพิ่ม <?=isset($value['PVAT']) ? $value['PVAT'] : '0'?>%</td>
							<td class="td-text-left label-text12"></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4" class="label-text13 td-boder-button" style="padding-left: 5.0px;"><?php if(isset($data['REPRINTREASON'])) { ?>
								<label id="reprintreason<?=$index?>">Reprint reason</label>&emsp;<span id="reprintinv<?=$index?>" style="color: #3e4444; font-weight: bolder;"><?=$data['REPRINTREASON']?></span><?php } ?>
							</td>
							<td class="td-text-left label-text12 td-boder-button">VAT</td>
							<td class="td-text-right label-text12 td-boder-button"><?=isset($value['TVAT']) ? $value['TVAT'] : '0.00' ?></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4" class="label-text13I"><?=isset($value['GTOTTH']) ? $value['GTOTTH'] : '' ?></td>
							<td class="td-text-left label-text12">จำนวนเงินรวมทั้งสิ้น</td>
							<td class="td-text-left label-text12"></td>
						</tr>
						<tr class="tr-height">
							<td colspan="4" class="label-text13I"><?=isset($value['GTOTEN']) ? $value['GTOTEN'] : '' ?></td>
							<td class="td-text-left label-text12">GRAND TOTAL</td>
							<td class="td-text-right label-text12"><?=isset($value['GTOT']) ? $value['GTOT'] : '0.00' ?></td>
						</tr>
					</tfoot>
				</table><br>
				<table class="table" style="border: none;">
					<tbody>
						<tr>
							<td class="label-text11" style="border-right: 1.0px solid black; padding-left: 5.0px;">ได้รับสินค้าข้างต้นในสภาพเรียบร้อยโดยถูกต้องและครบถ้วนแล้ว</td>
							<td class="td-border-right"></td>
							<td></td>
						</tr>
						<tr>
							<td class="label-text10" style="border-right: 1.0px solid black; padding-left: 5.0px;">RECEIVED THE ABOVE GOODS IN GOOD ORDER & CONDITION</td>
							<td class="td-border-right"></td>
							<td></td>
						</tr>
						<tr>
							<td class="td-border-right">&emsp;</td>
							<td class="td-border-right">&emsp;</td>
							<td>&emsp;</td>
						</tr>
						<tr>
							<td class="label-text12 td-border-right text-center"><p>__________________________</p></td>
							<td class="label-text12 td-border-right text-center"><p>__________________________</p></td>
							<td class="label-text12 text-center"><p>__________________________</p></td>
						</tr>
						<tr>
							<td class="label-text12 td-border-right text-center">ผู้รับสินค้า / RECEIVED BY</td>
							<td class="label-text12 td-border-right text-center">ผู้ส่งสินค้า / DELIVERED BY</td>
							<td class="label-text12 text-center">ผู้มีอำนาจลงนาม / AUTHORIZED SIGNATURE</td>
						</tr>
						<tr>
							<td class="label-text12 td-border-right text-center" style="padding-bottom: 1%;"><p>_____/_____/_____</p></td>
							<td class="label-text12 td-border-right text-center" style="padding-bottom: 1%;"><p>_____/_____/_____</p></td>
							<td class="label-text12 text-center" style="padding-bottom: 1%;"><p>_____/_____/_____</p></td>
						<tr>
					</tbody>
				</table>
			</div>
	</div><?php 
		}	
	} ?>
</body>
</html>