<?php 
require_once('./function/index_x.php');	printed(); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="salevoucherReport">
		<div class="page">
			<div class="flex">
				<div class="justify-start">
					<div>
						<p class="label-text13"><?=$data['PRINTSTATIC']['COMPN']?></p>
					</div>
				</div>
				<div class="justify-center">
					<div>
						<p class="label-text14-head"><?=$data['PRINTSTATIC']['RPTTITLE1']?></p>
						<p class="label-text14-head"><?=$data['PRINTSTATIC']['RPTTITLE2']?></p>
					</div>
				</div>
				<div class="justify-end">
					<div class="frame-border60">
						<p class="label-text14I">เลขที่/No.&nbsp;<?=str_repeat('&emsp;', 2)?><?=(isset($data['PRINTSTATIC']['PVNO'])) ? $data['PRINTSTATIC']['PVNO']: '' ?></p>
						<p class="label-text14I">วันที่/Date&nbsp;<?=str_repeat('&emsp;', 2)?><?=(isset($data['PRINTSTATIC']['TDATE'])) ? $data['PRINTSTATIC']['TDATE']: '' ?></p>
					</div>
				</div>
			</div>
			<br>
			<div class="flex">
			    <div class="width97">
			    	<p class="label-text15">ซื้อจาก&ensp;<span class="span-underline15"><?=isset($data['PRINTSTATIC']['PUFROM']) ? $data['PRINTSTATIC']['PUFROM']: '' ?><?=str_repeat('&emsp;', 14)?></span><br>Purchase From:</p>
					<p><label class="label-text15">รหัสผู้ขาย&ensp;</label>
						<span class="span-underline15"><?=isset($data['PRINTSTATIC']['SUPCD']) ? $data['PRINTSTATIC']['SUPCD'].str_repeat('&nbsp;', 1): str_repeat('&emsp;', 3) ?><?=str_repeat('&emsp;', 6)?></span>
			    		<label class="label-text15">รายละเอียดสินค้า&ensp;</label>
			    		<span class="span-underline15"><?=isset($data['PRINTSTATIC']['DESCRIPT']) ? $data['PRINTSTATIC']['DESCRIPT']: '' ?><?=str_repeat('&emsp;', 14)?></span>
			    		<br><label class="label-text15">&nbsp;Supplier Code:<?=str_repeat('&emsp;', 8)?>Details&nbsp;</label></p>
			    	<p class="label-text15">จำนวนเงิน&emsp;
			    		<span class="span-underline15"><?=str_repeat('&emsp;', 8)?><?=isset($data['PRINTSTATIC']['AMMON']) ? $data['PRINTSTATIC']['AMMON']: '' ?><?=str_repeat('&emsp;', 2)?></span>&emsp;บาท<br>Amount</p>
				</div>
			</div><br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width10">รหัสบัญชี<br>Acc code</td>
						<td class="td-label-width30">รายการ<br>Particulars</td>
						<td class="td-label-width15">หมายเหตุ<br>Remarks</td>
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
						<td class="td-text-right"><?=(isset($data['PRINTSTATIC']['TDEB'])) ? $data['PRINTSTATIC']['TDEB']: '' ?></td>
						<td class="td-text-right"><?=(isset($data['PRINTSTATIC']['TCRE'])) ? $data['PRINTSTATIC']['TCRE']: '' ?></td>
						<td class="td-text-left"></td>
					</tr>
				</tfoot>
			</table>
			<p class="label-text14I" style="margin-left: 2%;"><?=(isset($data['PRINTSTATIC']['TDEBTH'])) ? $data['PRINTSTATIC']['TDEBTH']: '' ?></p>
			<p class="label-text14I" style="margin-left: 2%;"><?=(isset($data['PRINTSTATIC']['TDEBEN'])) ? $data['PRINTSTATIC']['TDEBEN']: '' ?></p>
			<div class="flex space-between">
		    	<div class="width50" style="margin-left: 2%;">
					<p class="label-text13">______________________________<br><?=str_repeat('&emsp;', 2)?>ผู้จัดทำ<?=str_repeat('&emsp;', 3)?>Prepared By</p>
				</div>
				<div class="width45">
					<p class="label-text13">______________________________<br>&emsp;ผู้ตรวจสอบ<?=str_repeat('&emsp;', 3)?>Checked By</p>
				</div>
			</div>
			<p class="label-text13" style="padding-left: 2%;"><?=!empty($_GET['REPRINTREASON']) ? 'Reprint reason': ''?></p>
			<p class="label-text13" style="padding-left: 4%;"><?=!empty($_GET['REPRINTREASON']) ? $_GET['REPRINTREASON']: ''?></p>
		</div>
	</div>
</body>
</html>