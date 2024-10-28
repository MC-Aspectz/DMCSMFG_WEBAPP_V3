<?php 
require_once('./function/index_x.php'); RCprint(); $maxrow = 12; $dataRow = end($data['PRINTDYNAMIC']); $minrow = $dataRow['IDXNO'];?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<?php if(!empty($data['PRINTDYNAMIC'])) {
		foreach ($data['ITEMPAGE'] as $index => $value) { ?>
			<div class="page">
				<div class="flex">
					<div class="width70"></div>
					<div class="width25">
						<p class="title-bill" style="font-size: 18.0px;"><?=isset($value['RPTTITLE']) ? $value['RPTTITLE'] : "" ?><br><?=isset($value['RPTTITLETH']) ? $value['RPTTITLETH'] : "" ?></p>
					</div>
				</div><br>
				<div class="flex">
					<div class="width70">
						<label class="label-text18"><?=$data['PRINTSTATIC']['COMPNEN']?></label><br>
						<label class="label-text18"><?=$data['PRINTSTATIC']['COMPNTH']?></label><br>
					</div>
					<div class="width25"></div>
				</div><br>
				<div class="flex">
					<div class="width70">
						<label class="label-text13b"><?=isset($data['PRINTSTATIC']['ADDREN']) ? $data['PRINTSTATIC']['ADDREN'].' ' : '' ?></label><br>
						<label class="label-text13b"><?=isset($data['PRINTSTATIC']['ADDRTH']) ? $data['PRINTSTATIC']['ADDRTH'].' ' : '' ?></label><br>
						<label class="label-text13I">โทร/Tel  <?=isset($data['PRINTSTATIC']['TELO']) ? $data['PRINTSTATIC']['TELO']: '' ?></label>&emsp;
						<label class="label-text13I">แฟกซ์/Fax  <?=isset($data['PRINTSTATIC']['FAXO']) ? $data['PRINTSTATIC']['FAXO']: '' ?></label><br>
						<label class="label-text13I">เลขประจำตัวผู้เสียภาษีอากร/ Tax ID No. <?=isset($data['PRINTSTATIC']['TAXNO']) ? $data['PRINTSTATIC']['TAXNO']: '' ?></label>&nbsp;
						<label class="label-text13I">สาขา/Branch <?=isset($data['PRINTSTATIC']['DEPT']) ? $data['PRINTSTATIC']['DEPT']: '' ?></label>
					</div>
					<div class="width25">
						<label class="label-text13I">No.<?=isset($value['RECNO']) ? str_repeat('&emsp;', 2).$value['RECNO'] : "" ?></label><br>
						<label class="label-text13I">Date<?=isset($value['RECDT']) ? str_repeat('&emsp;', 2).$value['RECDT'] : "" ?></label>
					</div>
				</div><br>
				<div class="flex">
				    <div class="border-frame50">
					    <div class="width98">
					    	<p class="label-text15">In case of payment by cheque. This receipt will be valid only after the cheque has been honoured.</p>
					    	<p class="label-text14I">กรณีชำระด้วยเช็ค ใบเสร็จนี้จะใช้ได้ต่อเมื่อตรวจสอบแล้วเท่านั้น</p>
						</div>
				    </div>&emsp;
				    <div class="border-frame50">
						<div class="width40">
							<p class="label-text14">Customer./ ลูกค้า</p>
							<p class="label-text14">Address./ ที่อยู่</p>
							<p class="label-text14"><?=str_repeat('&emsp;', 2)?></p>
							<p class="label-text13">Tax ID./ เลขประจำตัวผู้เสียภาษี</p>
							<p class="label-text14">Branch./ สาขา</p>
						</div>
						<div class="width60">
							<p class="label-text14I"><?=isset($value['CUSNM']) ? $value['CUSNM']: '' ?></p>
							<p class="label-text12I"><?=isset($value['ADDRCUS1']) ? $value['ADDRCUS1']: '' ?><?=isset($value['ADDRCUS2']) ? str_repeat('&emsp;', 1).$value['ADDRCUS2']: '' ?></p>
							<p class="label-text14I"><?=isset($value['TAXID']) ? $value['TAXID']: '' ?></p>
							<p class="label-text14I"><?=isset($value['OFFICE']) ? $value['OFFICE']: '' ?></p>
						</div>
				    </div>
				</div><br>
				<table class="table">
					<thead>
						<tr class="table-tr">
							<td class="td-label-width3">NO.</td>
							<td class="td-label-width20">Invoice No</td>
							<td class="td-label-width20">DESCRIPTION</td>
							<td class="td-label-width15">Amount<br><?=isset($value['CUR']) ? $value['CUR']: '' ?></td>
							<td class="td-label-width15">VAT<br><?=isset($value['CUR']) ? $value['CUR']: '' ?></td>
							<td class="td-label-width15">Total<br><?=isset($value['CUR']) ? $value['CUR']: '' ?></td>
						</tr>
					</thead>
					<tbody><?php
					if(!empty($data['PRINTDYNAMIC']))  { 
						foreach ($data['PRINTDYNAMIC'] as $key => $item) {
							if($item['IDXNO'] == $value['IDXNO']) {	?>
			                <tr>
			                    <td class="td-text-center"><?=$item['NUM']; ?></td>
			                    <td class="td-text-left"><?=$item['INV']; ?></td>
		            			<td class="td-text-left"><?=$item['INVDT']; ?></td>
								<td class="td-text-right"><?=$item['AMT']; ?></td>
								<td class="td-text-right"><?=$item['VAT']; ?></td>
								<td class="td-text-right"><?=$item['INVAMT']; ?></td>
			                </tr> <?php 
			            	}
			            }
			            if($minrow < $maxrow) { 
			            	for ($i = $minrow; $i <= $maxrow; $i++) { ?>
				        		<tr class="tr-height25">
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
						<tr class="tr-height25">
							<td colspan="4" class="label-text13"><?=isset($value['TTLAMTTXT']) ? $value['TTLAMTTXT'] : '' ?></td>
							<td colspan="1" class="label-text13 text-right">Grand Total</td>
							<td class="td-text-right"><?=isset($value['TTLINVAMT']) ? $value['TTLINVAMT'] : '0.00' ?></td>
						</tr>
					</tfoot>
				</table>
				<div class="flex" style="align-items: flex-end; margin-top: 20.0px;">
            		<label class="label-text14">Paid By</label>&emsp;
            		<label class="label-text14"><input type="checkbox" <?php if(isset($value['PAYTYP1']) && $value['PAYTYP1'] == 'X') { ?> checked <?php } ?>/>&emsp;Cash</label>&emsp;
            		<label class="label-text14"><input type="checkbox" <?php if(isset($value['PAYTYP2']) && $value['PAYTYP2'] == 'X') { ?> checked <?php } ?>/>&emsp;Cheque</label>&emsp;
            		<label class="label-text14"><input type="checkbox" <?php if(isset($value['PAYTYP3']) && $value['PAYTYP3'] == 'X') { ?> checked <?php } ?>/>&emsp;Other.</label>&emsp;
					<label class="label-text14"><?=!empty($value['OTHER2']) ? str_repeat('__', 1).$value['OTHER2'].str_repeat('__', 3) : str_repeat('__', 8)?></label>&emsp;
					<label class="label-text14">Amount&emsp;<?=str_repeat('__', 8)?></label>
				</div>
				<div class="flex" style="margin-top: 15.0px;">
					<label class="label-text14">Bank.&emsp;<?=!empty($value['BANK']) ? str_repeat('__', 1).$value['BANK'].str_repeat('__', 6) : str_repeat('__', 8)?></label>
					<label class="label-text14">Branch&emsp;<?=!empty($value['BRANCH']) ? str_repeat('__', 1).$value['BRANCH'].str_repeat('__', 6) : str_repeat('__', 8)?></label>
				</div>
				<div class="flex" style="margin-top: 15.0px;">
					<label class="label-text14">Cheque No.&emsp;<?=!empty($value['CHQNO']) ? str_repeat('__', 1).$value['CHQNO'].str_repeat('__', 3) : str_repeat('__', 8)?></label>&emsp;
					<label class="label-text14">Date&emsp;<?=!empty($value['CHQDT']) ? str_repeat('__', 1).$value['CHQDT'].str_repeat('__', 2) : str_repeat('__', 8)?></label>&emsp;
					<label class="label-text14 text-center"><?=str_repeat('__', 10)?><br>Bill Collector</label>&emsp;
					<label class="label-text14 text-center"><?=str_repeat('__', 10)?><br>Authorized Signature</label>
				</div>
			</div><?php }	
	} ?>
</body>
</html>