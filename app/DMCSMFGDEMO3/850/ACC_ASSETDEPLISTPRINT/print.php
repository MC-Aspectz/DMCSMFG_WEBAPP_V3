<?php 
require_once('./function/index_x.php');	PrintAssetDepreciationList(); $index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<!-- <body> -->
<body onload="window.print();">	
	<div id="tax_inv">
		<div class="page">
		
			<hr>
			<p class="title-bill">Asset Depreciation List</p>
			<div class="flex">
			<div class="width98">
				
				<label class="label-text14">Fiscal Period&emsp;<?=(isset($data['YEAR'])) ? $data['YEAR']: '' ?></label>&emsp;
				<label class="label-text14">Asset Group Code&emsp;<?=(isset($data['PRINTDYNAMIC']['ASSETGCODE'])) ? $data['PRINTDYNAMIC']['ASSETGCODE']: '     ' ?></label>&emsp;
				<label class="label-text14"><?=(isset($data['PRINTDYNAMIC']['ASSETGNAME'])) ? $data['PRINTDYNAMIC']['ASSETGNAME']: '     ' ?></label>&emsp;
				</div>
				<div class="flex width90 justify-right">
				<label class="label-text14">Printed Date&emsp;<?=(isset($data['PRINTSTATIC']['REPDATE'])) ? $data['PRINTSTATIC']['REPDATE']: '' ?></label>&emsp;
				<label class="label-text14">Page&emsp;<?=(isset($data['PRINTDYNAMIC'][1]['PAGE'])) ? $data['PRINTDYNAMIC'][1]['PAGE']: '' ?></label>&emsp;
				</div>
			</div>
			
	
			<br>
			<table class="table">
				<thead>

				<!-- <tfoot>
					<tr class="tr-height">
					<td class="td-text-center td-boder-button label-text12">Test</td>
					</tr>
				</tfoot> -->



					<tr class="table-tr">
					<td class="td-label-width10"></td>
					<td class="td-label-width10"></td>
					<td class="td-label-width10"></td>
					
						<td class="td-label-width5">JAN</td>
						<td class="td-label-width5">FEB</td>
						<td class="td-label-width5">MAR</td>
						<td class="td-label-width5">APR</td>
						<td class="td-label-width5">MAY</td>
						<td class="td-label-width5">JUN</td>
						<td class="td-label-width5">JUL</td>
						<td class="td-label-width5">AUG</td>
						<td class="td-label-width5">SEP</td>
						<td class="td-label-width5">OCT</td>
						<td class="td-label-width5">NOV</td>
						<td class="td-label-width5">DEC</td>
					</tr>


				</thead>
				<tbody><?php 
				if(!empty($data['PRINTDYNAMIC']))  { 
					$maxrow = 14;    
					foreach ($data['PRINTDYNAMIC'] as $key => $value) {
						$minrow = count($data['PRINTDYNAMIC']);?>
		                <tr>
						<td class="td-text-right">Asset Account</td>
						<td class="td-text-right"><?=$value['ACCCD']; ?></td>
						<td class="td-text-right"><?=$value['ACCNAME']; ?></td>
		                    <td class="td-text-right"><?=$value['JAN']; ?></td>
		                    <td class="td-text-right"><?=$value['FEB']; ?></td>
		                    <td class="td-text-right"><?=$value['MAR']; ?></td>
		        			<td class="td-text-right"><?=$value['APR']; ?></td>
							<td class="td-text-right"><?=$value['MAY']; ?></td>
							<td class="td-text-right"><?=$value['JUN']; ?></td>
							<td class="td-text-right"><?=$value['JUL']; ?></td>
							<td class="td-text-right"><?=$value['AUG']; ?></td>
							<td class="td-text-right"><?=$value['SEP']; ?></td>
							<td class="td-text-right"><?=$value['OCT']; ?></td>
							<td class="td-text-right"><?=$value['NOV']; ?></td>
							<td class="td-text-right"><?=$value['DECM']; ?></td>
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
						<td class="td-text-left td-boder-button label-text12"></td>
						<td class="td-text-right td-boder-button label-text12"></td>
						<td class="td-text-center td-boder-button label-text12">Total</td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JANGTTL']) ? $data['PRINTDYNAMIC'][15]['JANGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['FEBGTTL']) ? $data['PRINTDYNAMIC'][15]['FEBGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['MARGTTL']) ? $data['PRINTDYNAMIC'][15]['MARGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['APRGTTL']) ? $data['PRINTDYNAMIC'][15]['APRGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['MAYGTTL']) ? $data['PRINTDYNAMIC'][15]['MAYGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JUNGTTL']) ? $data['PRINTDYNAMIC'][15]['JUNGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JULGTTL']) ? $data['PRINTDYNAMIC'][15]['JULGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['AUGGTTL']) ? $data['PRINTDYNAMIC'][15]['AUGGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['SEPGTTL']) ? $data['PRINTDYNAMIC'][15]['SEPGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['OCTGTTL']) ? $data['PRINTDYNAMIC'][15]['OCTGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['NOVGTTL']) ? $data['PRINTDYNAMIC'][15]['NOVGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['DECMGTTL']) ? $data['PRINTDYNAMIC'][15]['DECMGTTL']: '' ?></td>
					</tr>
				</tfoot>





				<tfoot>
					<tr class="tr-height">
						<td class="td-text-left td-boder-button label-text12">Sub Total</td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][1]['ACCNAME']) ? $data['PRINTDYNAMIC'][1]['ACCNAME']: '' ?></td>
						<td class="td-text-left td-boder-button label-text12"></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JANTTL']) ? $data['PRINTDYNAMIC'][15]['JANTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['FEBTTL']) ? $data['PRINTDYNAMIC'][15]['FEBTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['MARTTL']) ? $data['PRINTDYNAMIC'][15]['MARTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['APRTTL']) ? $data['PRINTDYNAMIC'][15]['APRTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['MAYTTL']) ? $data['PRINTDYNAMIC'][15]['MAYTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JUNTTL']) ? $data['PRINTDYNAMIC'][15]['JUNTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['JULTTL']) ? $data['PRINTDYNAMIC'][15]['JULTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['AUGTTL']) ? $data['PRINTDYNAMIC'][15]['AUGTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['SEPTTL']) ? $data['PRINTDYNAMIC'][15]['SEPTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['OCTTTL']) ? $data['PRINTDYNAMIC'][15]['OCTTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['NOVTTL']) ? $data['PRINTDYNAMIC'][15]['NOVTTL']: '' ?></td>
						<td class="td-text-right td-boder-button label-text12"><?=isset($data['PRINTDYNAMIC'][15]['DECMTTL']) ? $data['PRINTDYNAMIC'][15]['DECMTTL']: '' ?></td>
					</tr>
				</tfoot>

			
			</table>
	    	
		</div>
	</div>
</body>
</html>