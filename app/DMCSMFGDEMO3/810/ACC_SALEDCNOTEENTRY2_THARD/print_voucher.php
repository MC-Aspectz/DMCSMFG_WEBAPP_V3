<?php 
require_once('./function/index_x.php');	printedVoucher(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="debitVoucher">
		<div class="page">
			<div class="flex">
				<div class="justify-start">
					<div>
						<p class="label-text13"><?=str_repeat('&emsp;', 2)?></p>
					</div>
				</div>
				<div class="justify-center">
					<div>
						<h3 class="title-bill">สมุดรายวันทั่วไป</h3>
						<h3 class="title-bill"><?=(isset($data['PRINTSTATIC']['RPTTITLE'])) ? $data['PRINTSTATIC']['RPTTITLE']: 'CREDIT NOTE VOUCHER' ?></h3>
					</div>
				</div>
				<div class="justify-end">
					<div class="frame-border60">
						<p class="label-text14I">เลขที่/No.&nbsp;<?=isset($data['PRINTDYNAMIC'][$index]['PONUM']) ? str_repeat('&emsp;', 2).$data['PRINTDYNAMIC'][$index]['PONUM'] : '' ?></p>
						<p class="label-text14I">Note No.&nbsp;<?=(isset($data['PRINTSTATIC']['NOTENO'])) ? str_repeat('&emsp;', 2).$data['PRINTSTATIC']['NOTENO']: '' ?></p>
						<p class="label-text14I">วันที่/Date&nbsp;<?=(isset($data['PRINTSTATIC']['TDATE'])) ? str_repeat('&emsp;', 2).$data['PRINTSTATIC']['TDATE']: '' ?></p>
					</div>
				</div>
			</div>
			<br>
			<div class="flex">
			    <div class="width97">
			    	<p class="label-text15">Customer&emsp;<span class="span-underline"><?=isset($data['PRINTSTATIC']['DETAILS']) ? $data['PRINTSTATIC']['DETAILS']: '' ?><?=str_repeat('&emsp;', 20)?></p>
		    		<p class="label-text15"><?=str_repeat('&emsp;', 14)?></p>
			    	<p class="label-text15">จำนวนเงิน&emsp;
			    		<span class="span-underline"><?=str_repeat('&emsp;', 8)?><?=isset($data['PRINTSTATIC']['AMMON']) ? $data['PRINTSTATIC']['AMMON']: '' ?><?=str_repeat('&emsp;', 2)?></span>&emsp;บาท<br>Amount</p>
				</div>
			</div><br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width10">รหัสบัญชี<br>Account code</td>
						<td class="td-label-width25">รายการ<br>Particulars</td>
						<td class="td-label-width20">หมายเหตุ<br>Remarks</td>
						<td class="td-label-width15">เดบิต<br>Debit</td>
						<td class="td-label-width15">เครดิต<br>Credit</td>
						<td class="td-label-width15">แผนก<br>Section</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  { 
					$maxrow = 16;    
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						$minrow = count($data['PRINTDYNAMIC']);?>
		                <tr>
		                    <td class="td-text-center"><?=$value['ACCNO']; ?></td>
		                    <td class="td-text-left"><?=$value['PATI']; ?></td>
		        			<td class="td-text-left"><?=$value['REM']; ?></td>
							<td class="td-text-right"><?=$value['DEB']; ?></td>
							<td class="td-text-right"><?=$value['CRE']; ?></td>
							<td class="td-text-right"><?=$value['SEC']; ?></td>
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
				            </tr><?php
				        }
			       	}
		       	} ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" class="td-text-right">TOTAL&emsp;</td>
						<td class="td-text-right"><?=(isset($data['PRINTDYNAMIC'][$index]['TDEB'])) ? $data['PRINTDYNAMIC'][$index]['TDEB']: '' ?></td>
						<td class="td-text-right"><?=(isset($data['PRINTDYNAMIC'][$index]['TCRE'])) ? $data['PRINTDYNAMIC'][$index]['TCRE']: '' ?></td>
						<td class="td-text-left"></td>
					</tr>
				</tfoot>
			</table>
			<div class="flex space-between" style="margin-top: 5%;">
		    	<div class="width60" style="margin-left: 2%;">
					<p class="label-text14">______________________________<br><?=str_repeat('&emsp;', 2)?>ผู้จัดทำ<?=str_repeat('&emsp;', 3)?>Prepared By</p>
				</div>
				<div class="width40">
					<p class="label-text14">______________________________<br>&emsp;ผู้ตรวจสอบ<?=str_repeat('&emsp;', 3)?>Checked By</p>
				</div>
			</div>
			<p class="label-text15" style="padding-left: 2%; margin-top: 2%;"><?=!empty($_GET['REPRINTREASON']) ? 'Reprint reason': ''?></p>
			<p class="label-text15-black" style="padding-left: 4%;"><?=!empty($_GET['REPRINTREASON']) ? $_GET['REPRINTREASON']: ''?></p>
		</div>
	</div>
</body>
</html>