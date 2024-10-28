<?php require_once('./function/index_x.php'); PrintAP(); $index = isset($data['PRINTDYNAMIC']) ? array_key_last($data['PRINTDYNAMIC']) : 0; ?>
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
			<h3 class="title-bill">Report Outstanding AP Check List</h3>
			<div class="flex">
		    	<table class="table-head">
		    		<tbody>
	                    <tr>
	                        <td class="border-none"><label class="label-text14">Status</label></td>
	                        <td class="border-none text-left" colspan="6"><label class="label-text14 text-left"><?=!empty($data['PRINTSTATIC']['P_PAYMENTSTATUS']) ? $data['PRINTSTATIC']['P_PAYMENTSTATUS']: '' ?></label></td>
	                        <td class="border-none text-right">Page<?=str_repeat('&emsp;', 1).$i ?></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Due Date</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DUEDATEFR']) ? $data['PRINTSTATIC']['P_DUEDATEFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DUEDATETO']) ? $data['PRINTSTATIC']['P_DUEDATETO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Supplier invoice date</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['SUPPINVDTFR']) ? $data['PRINTSTATIC']['SUPPINVDTFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['SUPPINVDTTO']) ? $data['PRINTSTATIC']['SUPPINVDTTO']: '' ?></label></td>
	                        <td class="border-none" colspan="2"><?=str_repeat('&emsp;', 2)?></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Voucher Date</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_VOUCHERDTFR']) ? $data['PRINTSTATIC']['P_VOUCHERDTFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_VOUCHERDTTO']) ? $data['PRINTSTATIC']['P_VOUCHERDTTO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Supplier Code</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_SUPPLIERFR']) ? $data['PRINTSTATIC']['P_SUPPLIERFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_SUPPLIERTO']) ? $data['PRINTSTATIC']['P_SUPPLIERTO']: '' ?></label></td>
	                        <td class="border-none" colspan="2"><?=str_repeat('&emsp;', 2)?></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Supplier Invoice No.</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_SUPPINVNOFR']) ? $data['PRINTSTATIC']['P_SUPPINVNOFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_SUPPINVNOTO']) ? $data['PRINTSTATIC']['P_SUPPINVNOTO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Voucher No.</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_VOUCHERNOFR']) ? $data['PRINTSTATIC']['P_VOUCHERNOFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_VOUCHERNOTO']) ? $data['PRINTSTATIC']['P_VOUCHERNOTO']: '' ?></label></td>
	                        <td class="border-none" colspan="2"><?=str_repeat('&emsp;', 2)?></td>
	                    </tr>
	                    <tr>
	                        <td class="border-none"><label class="label-text14">Currency</label></td>
	                        <td class="border-none" colspan="7"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_CURRENCY']) ? $data['PRINTSTATIC']['P_CURRENCY']: '' ?></label></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Department</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DEPARTMENTFR']) ? $data['PRINTSTATIC']['P_DEPARTMENTFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DEPARTMENTTO']) ? $data['PRINTSTATIC']['P_DEPARTMENTTO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Staff</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_STAFFFR']) ? $data['PRINTSTATIC']['P_STAFFFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_STAFFTO']) ? $data['PRINTSTATIC']['P_STAFFTO']: '' ?></label></td>
	                        <td class="border-none" colspan="2"><?=str_repeat('&emsp;', 2)?></td>
	                    </tr>	                
	                </tbody>
		    	</table>
		    </div>

			<table class="table" style="margin-top: 0.5em;">
				<thead>
					<tr class="table-tr">
						<td class="td-label-width8">Supplier Inv No.</td>
	 					<td class="td-label-width8">Voucher No.</td>
	 					<td class="td-label-width5">Supplier Inv. Date</td>
 						<td class="td-label-width5">Credit Term</td>
	 					<td class="td-label-width8">Due Date</td>
	 					<td class="td-label-width5">Days Over Due</td>
						<td class="td-label-width8">Paid Date</td>
						<td class="td-label-width10">Supplier Code</td>
						<td class="td-label-width15">Supplier Name</td>
						<td class="td-label-width5">Currency</td>
						<td class="td-label-width10">Invoice Total Amt</td>
						<td class="td-label-width10">Outstanding Amt</td>
						<td class="td-label-width10">Status</td>
					</tr>
				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  {  
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						if($value['PPAGE'] == $i)  { ?>
			                <tr class="tr-height">
								<td class="td-text-left"><?=isset($value['SUPPINVNO']) ? $value['SUPPINVNO']: '' ?></td>
								<td class="td-text-left"><?=isset($value['VOUCHERNO']) ? $value['VOUCHERNO']: '' ?></td>
								<td class="td-text-center"><?=isset($value['SUPPINVDT']) ? $value['SUPPINVDT']: '' ?></td>
								<td class="td-text-center"><?=isset($value['CTERM']) ? $value['CTERM']: '' ?></td>
								<td class="td-text-center"><?=isset($value['DUEDT']) ? $value['DUEDT']: '' ?></td>
								<td class="td-text-center"><?=isset($value['DAYOVERDUE']) ? $value['DAYOVERDUE']: str_repeat('&emsp;', 1) ?></td>
								<td class="td-text-center"><?=isset($value['PAIDDT']) ? $value['PAIDDT']: '' ?></td>
								<td class="td-text-left"><?=isset($value['SUPPCD']) ? $value['SUPPCD']: '' ?></td>
								<td class="td-text-left"><pre><?=isset($value['SUPPNAME']) ? $value['SUPPNAME']: '' ?></pre></td>
								<td class="td-text-center"><?=isset($value['CURR']) ? $value['CURR']: '' ?></td>
								<td class="td-text-right"><?=isset($value['INVAMT']) ? $value['INVAMT']: '' ?></td>
								<td class="td-text-right"><?=isset($value['OUTSTDAMT']) ? $value['OUTSTDAMT']: '' ?></td>
								<td class="td-text-left"><?=isset($value['STATUS']) ? $value['STATUS']: '' ?></td>
			                </tr> <?php 
			            }
		            }
		       	} ?>
				</tbody>
			</table>
		</div><?php } ?>
	</div>
</body>
</html>