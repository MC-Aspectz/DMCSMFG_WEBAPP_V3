<?php 
require_once('./function/index_x.php');	printBilling(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="tax_inv">
		<div class="page">
			<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNTH'])) ? $data['PRINTSTATIC']['COMPNTH'] : "" ?></p>
			<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNEN'])) ? $data['PRINTSTATIC']['COMPNEN'] : "" ?></p>
			<hr>
			<div class="width98">
				<label class="label-text14"><?=(!empty($data['PRINTSTATIC']['ADDR1'])) ? $data['PRINTSTATIC']['ADDR1'] : '' ?></label><br>
				<label class="label-text14"><?=(!empty($data['PRINTSTATIC']['ADDR2'])) ? $data['PRINTSTATIC']['ADDR2'] : '' ?></label><br>
				<label class="label-text14">โทร/Tel&emsp;<?=(!empty($data['PRINTSTATIC']['TELTH'])) ? $data['PRINTSTATIC']['TELTH']: '     ' ?></label>&emsp;
				<label class="label-text14">แฟกซ์/Fax&emsp;<?=(!empty($data['PRINTSTATIC']['FAXTH'])) ? $data['PRINTSTATIC']['FAXTH']: '     ' ?></label>&emsp;
			</div>
			<p class="title-bill">บิลเรียกเก็บเงิน</p>
			<p class="title-bill">BILL SLIP</p>
			<div class="flex">
			    <div class="frame60">
				    <div class="width98">
				    	<p class="label-text14">ลูกค้า/CUSTOMER</p>
				 		<p class="label-text15-bold"><?=isset($data['PRINTSTATIC']['CUSFN']) ? $data['PRINTSTATIC']['CUSFN']: '' ?></p>
						<p class="label-text14I"><?=isset($data['PRINTSTATIC']['ADDRCUS1']) ? $data['PRINTSTATIC']['ADDRCUS1']: '' ?></p>
				    	<p class="label-text14I"><?=isset($data['PRINTSTATIC']['ADDRCUS2']) ? $data['PRINTSTATIC']['ADDRCUS2']: '' ?></p>
				    	<p class="label-text14I"><?=isset($data['PRINTSTATIC']['ADDRCUS3']) ? $data['PRINTSTATIC']['ADDRCUS3']: '' ?></p>
						<p class="label-text14I">โทร/Tel :  <?=isset($data['PRINTSTATIC']['TELCUS']) ? $data['PRINTSTATIC']['TELCUS']: '' ?>&emsp;&emsp;แฟกซ์/Fax:  <?=isset($data['PRINTSTATIC']['FAXCUS']) ? $data['PRINTSTATIC']['FAXCUS']: '' ?></p>
					</div>
			    </div>&emsp;
			    <div class="flex" style="width: 38%;">
			    	<table class="table-head">
			    		<tbody>
		                    <tr>
		                        <td class="width45-border-none"><label class="label-text14N">&nbsp;เลขที่บิลสลิป<br>&nbsp;Bill Slip No.</label></td>
		                        <td class="width65-border-none"><label class="label-text15-bold">&emsp;<?=isset($data['PRINTSTATIC']['BSNO']) ? $data['PRINTSTATIC']['BSNO']: '' ?></label></td>
		                    </tr>
		                    <tr>
								<td class="width45-border-none"><label class="label-text14N">&nbsp;วันที่<br>&nbsp;Date</td>
								<td class="width65-border-none"><label class="label-text14N">&emsp;<?=isset($data['PRINTSTATIC']['TDATE']) ? $data['PRINTSTATIC']['TDATE']: '' ?></label></td>
		                    </tr>
		                    <tr>
		                    	<td class="width45-border-none"><?=str_repeat('&emsp;', 2)?></td>
		                    	<td class="width65-border-none"><?=str_repeat('&emsp;', 2)?></td>
 							</tr>
		                </tbody>
			    	</table>
			    </div>
			</div>
			<br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width3">ลำดับ<br>NO.</td>
						<td class="td-label-width15">เลขที่ใบแจ้งหนี้<br>VOUCHER NO.</td>
						<td class="td-label-width10">วันที่<br>DATE</td>
						<td class="td-label-width10">วันที่ครบกำหนด<br>DUE DATE</td>
						<td class="td-label-width10">จำนวนเงิน<br>AMOUNT</td>
						<td class="td-label-width10">ภาษีมูลค่าเพิ่ม<br>VAT</td>
						<td class="td-label-width10">จำนวนรวมภาษี<br>TOTAL</td>
						<td class="td-label-width10">ภาษีหัก ณ ที่จ่าย<br>WHT</td>
						<td class="td-label-width10">ปริมาณสุทธิ<br>NET AMOUNT</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  { 
					$maxrow = 14;    
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						$minrow = count($data['PRINTDYNAMIC']);?>
		                <tr>
		                    <td class="td-text-center"><?=$value['BILLSLIPLN']; ?></td>
		                    <td class="td-text-left"><?=$value['INVNO']; ?></td>
		                    <td class="td-text-center"><?=$value['DATE']; ?></td>
		        			<td class="td-text-center"><?=$value['DUDATE']; ?></td>
							<td class="td-text-right"><?=$value['AMT']; ?></td>
							<td class="td-text-right"><?=$value['VAT']; ?></td>
							<td class="td-text-right"><?=$value['TOT']; ?></td>
							<td class="td-text-right"><?=$value['WT']; ?></td>
							<td class="td-text-right"><?=$value['NETAMT']; ?></td>
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
				                <td class="td-border"></td>
				            </tr><?php
				        }
			       	}
		       	} ?>
				</tbody>
				<tfoot>
					<tr class="tr-height">
						<td class="td-text-left td-boder-button label-text12" colspan="8"><?=isset($data['PRINTSTATIC']['GTOTEN']) ? $data['PRINTSTATIC']['GTOTEN']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTSTATIC']['TTLAMT']) ? $data['PRINTSTATIC']['TTLAMT']: '' ?></td>
					</tr>
				</tfoot>
			</table>
	    	<div class="flex" style="margin: 15.0px;">
			    <div class="flex width50">
				  	<table class="table-head">
			    		<tbody>
		                    <tr>
		                        <td class="width45-border-none"><label class="label-text12">ผู้รับบิลเรียกเก็บเงิน<br>&nbsp;Bill Slip No.</label></td>
		                       	<td class="width65-border-none"><label class="label-text12">__________________________</label></td>
		                    </tr>
		                    <tr>
								<td class="width45-border-none"><label class="label-text12">วันที่<br>Date</td>
								<td class="width65-border-none"><label class="label-text12"><p>_____/_____/_____</p></label></td>
		                    </tr>
		                    <tr>
		                    	<td class="width45-border-none"><label class="label-text12">วันที่นัดหมาย<br>Appointment Date</td>
		                    	<td class="width65-border-none"><label class="label-text12">__________________________</label></td>
 							</tr>
		                </tbody>
			    	</table>
			    </div>&emsp;
			    <div class="flex width50">
			    	<table class="table-head">
			    		<tbody>
		                    <tr>
		                    	<td class="width45-border-none"><?=str_repeat('&emsp;', 2)?></td>
		                    	<td class="width65-border-none"><?=str_repeat('&emsp;', 2)?></td>
		                    </tr>
		                    <tr>
								<td class="width45-border-none"><label class="label-text12">ได้รับอนุญาตโดย<br>Authorized By</td>
								<td class="width65-border-none"><label class="label-text12">__________________________</label></td>
		                    </tr>
		                    <tr>
		                    	<td class="width45-border-none"><?=str_repeat('&emsp;', 2)?></td>
		                    	<td class="width65-border-none"><?=str_repeat('&emsp;', 2)?></td>
 							</tr>
		                </tbody>
			    	</table>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>