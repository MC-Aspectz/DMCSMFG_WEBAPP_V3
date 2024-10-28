<?php if(!empty($data['isPrint']) && $data['isPrint'] == 'on') printed($data); $color = '#3c5564'; ?>
<div id="printReport" style="display:none;">

    <h3 style="font-family: Times New Roman;  color: <?=$color;?>">Inventory Repport</h3>

	<div style="display: flex;">
	    <div style="display: flex; width: 75%; ">
		    <div style="width: 25%;">
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">item code</label>&emsp;
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">com-02</label><br>
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">on-hand</label>&emsp;
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">2.00</label>
			</div>
			<div style="width: 75%;">
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">computer</label>&emsp;
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">...</label><br>
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">backlog</label>&emsp;
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">0.00</label>
			</div>
	    </div>&emsp;
	    <div style="display: flex;  width: 20%; ">
			<div style="width: 40%;">
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">page</label><br>
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">printed date</label>
			</div>
			<div style="width: 60%;">
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">1</label><br>
                <label style="font-family: Times New Roman; margin-left: 5px; margin-bottom: 3px; color: <?=$color;?>">07/09/2018</label>
			</div>
	    </div>
	</div><br>

    <table style="height: 340px; width: 98%; border: 1px solid black; border-collapse: collapse;">
		<thead>
			<tr style="height: 30px; vertical-align: bottom;">
            <!-- 12col -->
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Voucher No.</td>
                <td style="border: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">Line</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Date</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Process Type</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Location Type</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Location Code</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Location Name</td>
                <td style="border: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">Receiving Qty.</td>
                <td style="border: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">Supply Qty.</td>
                <td style="border: 1px solid black; text-align: center; font-size: 14px; color: <?=$color;?>">Voucher Date</td>
                <td style="border: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">OrderNo.</td>
                <td style="border: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Comment</td>
			</tr>
		</thead>
		<tbody><?php 
		if(!empty($data['ITEMPRINT']))  {   
			foreach ($data['ITEMPRINT'] as $key => $value) { ?>
                <tr>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">VD220800001</td>
					<td style="border-left: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">1</td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">05/08/2022</td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Purchase</td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Location</td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">WH0</td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>">Admin Office</td>
					<td style="border-left: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>">2.00</td>
					<td style="border-left: 1px solid black; text-align: right;  font-size: 14px; color: <?=$color;?>"></td>
                    <td style="border-left: 1px solid black; text-align: center; font-size: 14px; color: <?=$color;?>">05/08/2022</td>
                    <td style="border-left: 1px solid black; text-align: center; font-size: 14px; color: <?=$color;?>"></td>
                    <td style="border-left: 1px solid black; padding-left:  3px; font-size: 14px; color: <?=$color;?>"></td>

                </tr> <?php 
            }
            if(count($data['ITEMPRINT']) < 11) {
	        //for ($i = count($data['ITEMPRINT'])+1; $i <= 11; $i++) { ?>
	        	<!-- <tr> -->
        		<tr style="height: 140px;">
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	                <td style="border-left: 1px solid black;"></td>
	            </tr><?php
	       	}
       	} ?>
		</tbody>
	</table>



</div>