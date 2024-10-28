<?php 
require_once('./function/index_x.php');	printReport(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">
	<div id="DCN_report">
		<div class="page">
			<!-- Company Name -->
			<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNTH'])) ? $data['PRINTSTATIC']['COMPNTH'] : "" ?></p>
			<p class="company-head"><?=(!empty($data['PRINTSTATIC']['COMPNEN'])) ? $data['PRINTSTATIC']['COMPNEN'] : "" ?></p>
			<!-- Company Name -->
			<hr>
			<!-- Titile -->
			<p class="title-bill"><?=(!empty($data['PRINTSTATIC']['RPTTITLE'])) ? $data['PRINTSTATIC']['RPTTITLE'] : "" ?></p>
			<p class="sub-bill">(Purchase)</p>
			<!-- Titile -->
			<!-- Date -->
			<p style="margin-left: 20px;">
                <?php
                    $startDate = isset($data['PRINTSTATIC']['DATEB']) ? $data['PRINTSTATIC']['DATEB'] : "";
                    $endDate = isset($data['PRINTSTATIC']['DATEE']) ? $data['PRINTSTATIC']['DATEE'] : "";
                    echo "Date: $startDate to $endDate";
                ?>
                <span style="float: right; margin-right: 20px;">Print Date: <?php echo date('Y/m/d'); isset($data['PRINTSTATIC']['PAGE']) ? $data['PRINTSTATIC']['PAGE'] : "";?></span>
            </p>
			<!-- Date -->
			<br>
			<table class="table">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width15">Voucher No.</td>
						<td class="td-label-width10">Date</td>
						<td class="td-label-width20">Supplier Name</td>
						<td class="td-label-width10">Item Name</td>
						<td class="td-label-width15" style="text-align: right;">Quantity</td>
						<td class="td-label-width10">Unit</td>
						<td class="td-label-width10">Unit Price</td>
						<td class="td-label-width10">Amount</td>
						<td class="td-label-width20">Remarks</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  { 
					$maxrow = 14;    
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						$minrow = count($data['PRINTDYNAMIC']);?>
		                <tr>
		                    <td class="td-text-center"><?=$value['DNO']; ?></td>
		                    <td class="td-text-left"><?=$value['IDATE']; ?></td>
		                    <td class="td-text-left"><?=$value['SNAME']; ?></td>
		        			<td class="td-text-center"><?=$value['ITNAME']; ?></td>
							<td class="td-text-right"><?=$value['QTY']; ?></td>
							<td class="td-text-left"><?=$value['UOM']; ?></td>
							<td class="td-text-right"><?=$value['UPR']; ?></td>
							<td class="td-text-right"><?=$value['AMT']; ?></td>
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
				                <td class="td-border"></td>
				                <td class="td-border"></td>
				            </tr><?php
				        }
			       	}
		       	} ?>
				</tbody>
			</table>
			<div class="flex">
				<div class="flex width50"></div>
				<div class="flex width50">
					<div class="flex" style="justify-content: right;">
						<label>__________________________________</label>
					</div>
				</div>
			</div>

	    	<div class="flex" style="margin: 15.0px;">
			    <div class="flex width50">
			    </div>&emsp;
			    <div class="flex width50">
			    	<div class="flex" style="justify-content: right;">
						<label>Report Total</td>&emsp;
						<label><?=(!empty($data['PRINTSTATIC']['RAMT'])) ? $data['PRINTSTATIC']['RAMT'] : "";?></label></td>&emsp;
						<label><?=(!empty($data['PRINTSTATIC']['RVAT'])) ? $data['PRINTSTATIC']['RVAT'] : "";?></label></td>&emsp;
						<label><?=(!empty($data['PRINTSTATIC']['RTTL'])) ? $data['PRINTSTATIC']['RTTL'] : "";?></label></td>&emsp;
					</div>
			    </div>
			</div>

			<div class="flex" style="margin-top: -15px;">
				<div class="flex width50"></div>
				<div class="flex width50">
					<div class="flex" style="justify-content: right;">
						<label>__________________________________</label>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>
</html>