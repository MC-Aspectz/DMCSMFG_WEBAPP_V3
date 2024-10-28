<?php require_once('./function/index_x.php'); PrintAR(); $index = isset($data['PRINTDYNAMIC']) ? array_key_last($data['PRINTDYNAMIC']) : 0; ?>
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
			<h3 class="title-bill">Report Outstanding AR Check List</h3>
			<div class="flex">
		    	<table class="table-head">
		    		<tbody>
	                    <tr>
	                        <td class="border-none"><label class="label-text14">Status</label></td>
	                        <td class="border-none text-left" colspan="6"><label class="label-text14 text-left"><?=!empty($data['PRINTSTATIC']['P_RECEIVESTATUS']) ? $data['PRINTSTATIC']['P_RECEIVESTATUS']: '' ?></label></td>
	                        <td class="border-none text-right">Page<?=str_repeat('&emsp;', 1).$i ?></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Due Date</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DUEDATEFR']) ? $data['PRINTSTATIC']['P_DUEDATEFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_DUEDATETO']) ? $data['PRINTSTATIC']['P_DUEDATETO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Invoice Date</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_INVDATEFR']) ? $data['PRINTSTATIC']['P_INVDATEFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_INVDATETO']) ? $data['PRINTSTATIC']['P_INVDATETO']: '' ?></label></td>
	                        <td class="border-none" colspan="2"><?=str_repeat('&emsp;', 2)?></td>
	                    </tr>
   	                    <tr>
	                        <td class="border-none"><label class="label-text14">Customer Code</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_CUSTOMERFR']) ? $data['PRINTSTATIC']['P_CUSTOMERFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_CUSTOMERTO']) ? $data['PRINTSTATIC']['P_CUSTOMERTO']: '' ?></label></td>

    						<td class="border-none"><label class="label-text14">Invoice No.</label></td>
	                        <td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_INVNOFR']) ? $data['PRINTSTATIC']['P_INVNOFR']: '' ?></label></td>
 							<td class="border-none text-center"><label class="label-text14 text-center">-</label></td>
 							<td class="border-none"><label class="label-text14"><?=!empty($data['PRINTSTATIC']['P_INVNOTO']) ? $data['PRINTSTATIC']['P_INVNOTO']: '' ?></label></td>
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
						<td class="td-label-width10">Invoice No.</td>
	 					<td class="td-label-width10">Invoice Date</td>
	 					<td class="td-label-width5">Credit Team</td>
	 					<td class="td-label-width10">Due Date</td>
	 					<td class="td-label-width5">Days Over Due</td>
						<td class="td-label-width10">Receive Date</td>
						<td class="td-label-width10">Customer Code</td>
						<td class="td-label-width15">Customer Name</td>
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
								<td class="td-text-left"><?=isset($value['INVNO']) ? $value['INVNO']: '' ?></td>
								<td class="td-text-left"><?=isset($value['INVDATE']) ? $value['INVDATE']: '' ?></td>
								<td class="td-text-center"><?=isset($value['CRTERM']) ? $value['CRTERM']: '' ?></td>
								<td class="td-text-center"><?=isset($value['DUEDT']) ? $value['DUEDT']: '' ?></td>
								<td class="td-text-center"><?=isset($value['DAYOVERDUE']) ? $value['DAYOVERDUE']: str_repeat('&emsp;', 1) ?></td>
								<td class="td-text-center"><?=isset($value['RECVDT']) ? $value['RECVDT']: '' ?></td>
								<td class="td-text-left"><?=isset($value['CUSTCD']) ? $value['CUSTCD']: '' ?></td>
								<td class="td-text-left"><pre><?=isset($value['CUSTNM']) ? $value['CUSTNM']: '' ?></pre></td>
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