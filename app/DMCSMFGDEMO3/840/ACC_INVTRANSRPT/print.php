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


	<?php   
		foreach($data['PRINTDYNAMIC'] as $data1 => $data2)
		{
			  
			$result[] = $data2['PAGE'];
		}
			
			// echo implode('', array_unique($result));
			// print_r(array_unique($result));
			// print_r(max(array_unique($result)));
			$maxpage=max(array_unique($result));
			
			for($i=1;$i<=$maxpage;$i++)
			{

			
	?>
	<div class="page">

    <h3 class="title-bill">Inventory Repport</h3>

	<div class="flex">
	    <div class="flex width70">
		    <div class="flex width30">
                <label class="label-text14">item code</label>&emsp;
                <label class="label-text14"><?=$data['PRINTSTATIC']['ITEMCODE']?></label><br>
                <label class="label-text14">on-hand</label>&emsp;
                <label class="label-text14"><?=$data['PRINTSTATIC']['ONHAND']?></label>
			</div>
			<div class="width70">
                <label class="label-text14"><?=$data['PRINTSTATIC']['ITEMNAME']?></label>&emsp;
                <label class="label-text14"><?=$data['PRINTSTATIC']['ITEMSPEC']?></label><br>
                <label class="label-text14">backlog</label>&emsp;
                <label class="label-text14"><?=$data['PRINTSTATIC']['BACKLOG']?></label>
			</div>
	    </div>&emsp;
	    <div class="flex width25">
			<div class="width40">
                <label class="label-text14">page</label><br>
                <label class="label-text14">printed date</label>
			</div>
			<div class="width60">
                <label class="label-text14"><?=$i?></label><br>
                <label class="label-text14"><?=$data['PRINTSTATIC']['REPDATE']?></label>
			</div>
	    </div>
	</div><br>

    <table class="table">
		<thead>
			<tr class="table-tr">
                <td class="td-label-width10">Voucher No.</td>
                <td class="td-label-width10">Line</td>
                <td class="td-label-width10">Date</td>
                <td class="td-label-width10">Process Type</td>
                <td class="td-label-width10">Location Type</td>
                <td class="td-label-width10">Location Code</td>
                <td class="td-label-width10">Location Name</td>
                <td class="td-label-width10">Receiving Qty.</td>
                <td class="td-label-width10">Supply Qty.</td>
                <td class="td-label-width10">Voucher Date</td>
                <td class="td-label-width10">OrderNo.</td>
                <td class="td-label-width10">Comment</td>
			</tr>
		</thead>
		<tbody><?php 
		if(!empty($data['PRINTDYNAMIC']))  {   
			// sort($data['PRINTDYNAMIC']['B']);
			$maxrow = 10; 
			foreach ($data['PRINTDYNAMIC'] as $key => $value) {
				$minrow = count($data['PRINTDYNAMIC']);
				if($value['PAGE']==$i)
				{
					
				?>
                <tr class="tr-height">
                    <td class="td-text-left"><?=$value['INVTRANVOUCHER']; ?></td>
					<td class="td-text-right"><?=$value['INVTRANVOUCHERLINE']; ?></td>
                    <td class="td-text-left"><?=$value['INVTRANENTRYDATE']; ?></td>
                    <td class="td-text-left"><?=$value['INVTRANTRXTYPE']; ?></td>
                    <td class="td-text-left"><?=$value['LOCTYP']; ?></td>
                    <td class="td-text-left"><?=$value['LOCCD']; ?></td>
                    <td class="td-text-left"><?=$value['LOCNAME']; ?></td>
					<td class="td-text-right"><?=$value['INVTRANQTY0']; ?></td>
					<td class="td-text-right"><?=$value['INVTRANQTY1']; ?></td>
                    <td class="td-text-center"><?=$value['INVTRANISSUEDT']; ?></td>
                    <td class="td-text-center"><?=$value['INVTRANORDERNUMBER']; ?></td>
                    <td class="td-text-left"><?=$value['INVTRANREMARK']; ?></td>
                </tr> <?php }
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
					</tr><?php
				}
			}
       	} ?>
		</tbody>
	</table>

</div>
<?php
		}
?>
</div>
</body>
</html>