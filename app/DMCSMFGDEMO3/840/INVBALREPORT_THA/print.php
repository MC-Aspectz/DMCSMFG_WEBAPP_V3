<?php 
require_once('./function/index_x.php');
printed(); 
$index = isset($data['PRINTDYNAMIC']) ? array_key_first($data['PRINTDYNAMIC']) : 0; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>

<body>
<!-- <body onload="window.print();"> -->

<div id="printReport" >


	<div class="page">

	<h3 class="label-text14"><?=$data['PRINTSTATIC']['COMNM_EN']?></h3>

	<div class="flex">
	    <div class="width50">
                <h3 class="title-bill"><?=$data['PRINTSTATIC']['RPTTITLE_EN']?></h3>
	    </div>&emsp;
	    <div class="width50">
                <h3 class="title-bill"><?=$data['PRINTSTATIC']['ASOFDT']?></h3>
	    </div>

	</div><br>	

	<div class="flex">
		<div class="flex width50">
			<div class="width40">
				<label class="label-text14">Acc Code</label><br>
				<label class="label-text14">Item Code</label><br>
				<label class="label-text14">Type of Item</label><br>
				<label class="label-text14">Date (As of)</label>
			</div>
			<div class="width40">
				<label class="label-text14"><?=$data['PRINTSTATIC']['ACCCDF']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['ITEMCDF']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['ITEMTYPF']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['STORAGECDF']?></label>
			</div>
			<div class="width5">
				<label class="label-text14">-</label><br>
				<label class="label-text14">-</label><br>
				<label class="label-text14">-</label><br>
				<label class="label-text14">-</label>
			</div>
			<div class="width15">
				<label class="label-text14"><?=$data['PRINTSTATIC']['ACCCDT']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['ITEMCDT']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['ITEMTYPT']?></label><br>
				<label class="label-text14"><?=$data['PRINTSTATIC']['STORAGECDT']?></label>
			</div>
		</div>&emsp;
		<div class="flex width50">

		</div>
	</div><br>

    <table class="table" style="border:none !important;">
		<thead>
			<tr class="table-tr">
                <td class="td-label-width20 border-head-top">Item Code/Name</td>
                <td class="td-label-width30 border-head-top"></td>
                <td class="td-label-width10 border-head-top">Quantity</td>
                <td class="td-label-width10 border-head-top"></td>
                <td class="td-label-width15 border-head-top">Unit Price</td>
                <td class="td-label-width15 border-head-top">Amount</td>
			</tr><br>
			<tr class="table-tr">
                <td class="td-label-width20 border-head-bottom">Warehouse</td>
                <td class="td-label-width30 border-head-bottom">Quantity&emsp;Unit Price&emsp;Amount</td>
                <td class="td-label-width10 border-head-bottom"></td>
                <td class="td-label-width10 border-head-bottom"></td>
                <td class="td-label-width15 border-head-bottom"></td>
                <td class="td-label-width15 border-head-bottom"></td>
			</tr>
		</thead>
		<tbody><?php 
		if(!empty($data['PRINTDYNAMIC']))  {   
			// sort($data['PRINTDYNAMIC']['B']);
			$maxrow = 10; 
			foreach ($data['PRINTDYNAMIC'] as $key => $value) {
				$minrow = count($data['PRINTDYNAMIC']);
				// if($value['PAGE']==$i)
				// {
				//ACCCD,LOCCD,ITEMCD,ITEMNAME,QTY,UNIT,UNITPRC,AMT

				?>
                <tr class="tr-height">
                    <td class="td-text-left"><?=$value['WH']; ?>&emsp;<?=$value['ITEMCD']; ?></td>
					<td class="td-text-left"><?=$value['ITEMNM']; ?></td>
                    <td class="td-text-right"><?=$value['QTY']; ?></td>
                    <td class="td-text-left"><?=$value['UNIT']; ?></td>
                    <td class="td-text-right"><?=$value['UNITPRC']; ?></td>
                    <td class="td-text-right"><?=$value['AMT']; ?></td>
                </tr> <?php 
				// }
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
	</table>

</div>

<?php
		// }
?>

</div>
</body>
</html>