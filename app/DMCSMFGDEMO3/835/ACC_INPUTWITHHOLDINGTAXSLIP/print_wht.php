<?php require_once('./function/index_x.php'); printWHT(); $index = isset($data['PRINTDYNAMIC']) ? array_key_last($data['PRINTDYNAMIC']) : 0;?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" href="./css/print.css" rel="stylesheet">
</head>
<style type="text/css">@media print{ @page { size: A4; }}</style>
<!-- <body> -->
<body onload="window.print();">	
	<div id="printReport">
		<?php if(!empty($data['PRINTDYNAMIC'])) { foreach($data['PRINTDYNAMIC'] as $key => $value) { ?>
		<div class="page">
			<div class="flex space-between">
				<div class="justify-start50 flex-column">
					<p class="label-text11">ฉบับที่ 1 (สำหรับผู้ถูกหักภาษี ณ ที่จ่าย ใช้พร้อมกับแบบแสดงรายการภาษี)</p>
					<p class="label-text11">ฉบับที่ 2 (สำหรับผู้ถูกหักภาษี ณ ที่จ่าย เก็บไว้เป็นหลักฐาน)</p>
				</div>
				<div class="justify-end50 flex-column">
					<p class="label-text11">ฉบับที่ 3 (สำหรับผู้ถูกหักภาษี ณ ที่จ่าย เก็บไว้เป็นหลักฐานในการออกใบแทน)</p>
					<p class="label-text11">ฉบับที่ 4 (สำหรับผู้ถูกหักภาษี ณ ที่จ่าย เก็บไว้เป็นหลักฐานในการออกใบแทน)</p>
				</div>
			</div>
			<div class="borderAll">
				<div class="flex" style="margin: 0.0em;">
					<div class="justify-start">
						<div><?=str_repeat('&emsp;', 2)?></div>
					</div>
					<div class="justify-center">
						<div>
							<label class="title-bill" style="margin-bottom: 0.0em; font-size: 15.0; font-weight: bold;">หนังสือรับรองการหักภาษี ณ ที่จ่าย</label>
							<h5 class="label-text14" style="margin-top: 0.0em;">ตามมาตรา  ทวิ แห่งประมวลรัษฎากร</h5>
						</div>
					</div>
					<div class="justify-end">
						<div class="flex-column">
							<p class="label-text14">เล่มที่ ...............</p>
							<p class="label-text14">เลขที่<?=isset($value['WHTNO']) ? str_repeat('&ensp;', 1).$value['WHTNO']: ''?></p>
						</div>
					</div>
				</div>
		
				<div class="flex borderAll" style="margin: -1.0em 8.0px 2.0px 8.0px;">
			    	<table class="table-head">
			    		<tbody>
	    			        <tr>
		                        <td class="border-none" colspan="5"><label class="label-text16">ผู้มีหน้าที่หักภาษี ณ ที่จ่าย</label></td>
		                        <td class="border-none text-right" colspan="6">
	                        		<label class="label-text13 text-left">เลขประจำตัวผู้เสียภาษีอากร (13 หลัก)*</label>
		                        	<label class="label-text13 text-left borderAll"><?=!empty($data['PRINTSTATIC']['ID_NOTAX']) ? $data['PRINTSTATIC']['ID_NOTAX'].str_repeat('&emsp;', 3): str_repeat('&ensp;', 1).str_repeat('&emsp;', 9) ?></label>
		                        </td>
		                    </tr>
	                       	<tr>
		                        <td class="border-none" colspan="5"><label class="label-text13">ขื่อ<?=!empty($data['PRINTSTATIC']['COMNAME']) ? str_repeat('&ensp;', 1).$data['PRINTSTATIC']['COMNAME']: '' ?></label></td>
		                        <td class="border-none text-right" colspan="6">
	                        		<label class="label-text13 text-left">เลขประจำตัวผู้เสียภาษีอากร</label>
		                        	<label class="label-text13 text-left borderAll"><?=str_repeat('&ensp;', 1).str_repeat('&emsp;', 9) ?></label>
		                        </td>
		                    </tr>
	                        <tr>
		                        <td class="border-none" colspan="12"><label class="label-text11">(ให้ระบุว่าเป็น บุลคล นิติบุคคล บริษัท สมาคม หรือคณะบุคคล)</label></td>
		                    </tr>
	                        <tr>
		                        <td class="border-none" colspan="12"><label class="label-text13">ที่อยู่<?=!empty($data['PRINTSTATIC']['COMADDR']) ? str_repeat('&ensp;', 1).$data['PRINTSTATIC']['COMADDR']: '' ?></label></td>
		                    </tr>
	                        <tr class="borderBottom">
		                        <td class="border-none" colspan="12"><label class="label-text11">(ให้ระบุ ชื่ออาคาร/หมู่บ้าน ห้องเลขที่ ชั้นที่ เลขที่ ตรอก/ซอย หมู่ที่ ถนน ตำบล/แขวง อำเภอ/เขต จังหวัด)</label></td>
		                    </tr>
		                    <tr>
		                        <td class="border-none" colspan="5"><label class="label-text16">ผู้ถูกพักภาษี ณ ที่จ่าย</label></td>
		                        <td class="border-none text-right" colspan="6">
	                        		<label class="label-text13 text-left">เลขประจำตัวผู้เสียภาษีอากร (13 หลัก)*</label>
		                        	<label class="label-text13 text-left borderAll"><?=!empty($value['ID_NOTAX2']) ? $value['ID_NOTAX2'].str_repeat('&emsp;', 3): str_repeat('&ensp;', 1).str_repeat('&emsp;', 9) ?></label>
		                        </td>
		                    </tr>
	                       	<tr>
		                        <td class="border-none" colspan="5"><label class="label-text13">ขื่อ<?=!empty($value['SUPNAME']) ? str_repeat('&ensp;', 1).$value['SUPNAME']: '' ?></label></td>
		                        <td class="border-none text-right" colspan="6">
	                        		<label class="label-text13 text-left">เลขประจำตัวผู้เสียภาษีอากร</label>
		                        	<label class="label-text13 text-left borderAll"><?=str_repeat('&ensp;', 1).str_repeat('&emsp;', 9) ?></label>
		                        </td>
		                    </tr>
	                        <tr>
		                        <td class="border-none" colspan="12"><label class="label-text11">(ให้ระบุว่าเป็น บุลคล นิติบุคคล บริษัท สมาคม หรือคณะบุคคล)</label></td>
		                    </tr>
	                        <tr>
		                        <td class="border-none" colspan="12"><label class="label-text13">ที่อยู่<?=!empty($value['SUPADDR']) ? str_repeat('&ensp;', 1).$value['SUPADDR']: '' ?></label></td>
		                    </tr>
	                        <tr>
		                        <td class="border-none" colspan="12"><label class="label-text11">(ให้ระบุ ชื่ออาคาร/หมู่บ้าน ห้องเลขที่ ชั้นที่ เลขที่ ตรอก/ซอย หมู่ที่ ถนน ตำบล/แขวง อำเภอ/เขต จังหวัด)</label></td>
		                    </tr>
		                    <tr>
		                        <td class="border-none text-left" colspan="4">
	                        		<label class="label-text12 text-left">ลำดับที่</label>
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 6) ?></label>
		                        	<label class="label-text12 text-left">ในแบบ</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(1) ภ.ง.ด.1ก</label>
		                        </td>
	                       		<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(2) ภ.ง.ด.1ก พิเศษ</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(3) ภ.ง.ด.2</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(4) ภ.ง.ด.3</label>
		                        </td>
		                    </tr>
		                    <tr class="borderBottom">
		                        <td class="border-none text-left" colspan="4">
	                        		<label class="label-text11 text-left">(ให้สามารถอ้างอิงหรือสอบยันกันได้ระหว่างลำดับที่ตาม<br>&emsp;หนังสือรับรองฯกับแบบยืนรายการภาษีหักที่จ่าย)</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(5) ภ.ง.ด.2ก</label>
		                        </td>
	                       		<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(6) ภ.ง.ด.3ก</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2">
		                        	<label class="label-text12 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
		                        	<label class="label-text12 text-left">(7) ภ.ง.ด.53</label>
		                        </td>
		                       	<td class="border-none text-left" colspan="2"></td>
		                    </tr>
		                </tbody>
			    	</table>
			    </div>

				<table class="table" style="margin: 0.5px 8.0px 1.0px 8.0px;">
					<thead> 
						<tr class="table-tr">
							<td class="label-text12 td-label-width60 borderRight borderBottom" colspan="9" style="vertical-align: top;">ประเภทเงินได้พึงประเมินที่จ่าย</td>
		 					<td class="label-text12 td-label-width10 borderRight borderBottom" colspan="1">วัน เดือน<br>หรือปีภาษี ที่จ่าย</td>
	 						<td class="label-text12 td-label-width10 borderRight borderBottom" colspan="1" style="vertical-align: top;">จำนวนเงินที่จ่าย</td>
		 					<td class="label-text12 td-label-width10 borderBottom" colspan="1">ภาษีที่หัก<br>และนำส่งไว้</td>
						</tr>
					</thead>
					<tbody>
		                <tr class="tr-height20">
							<td class="td-text-left borderRight borderBottom" colspan="9">
								<pre class="label-text12">1. เงินเดือน ค่าจ้าง เบี้ยเลี้ยง โบนัส ฯลฯ ตามมาตรา 40(1)</pre>
								<pre class="label-text12">2. ค่าธรรมเนียม ค่านายหน้า ฯลฯ ตามมาตรา 40(2)</pre>
								<pre class="label-text12">3. ค่าแห่งลิขสิทธิ์ ฯลฯ ตามมาตรา 40(3)</pre>
								<pre class="label-text12">4. (ก) ดอกเบี้ย ฯลฯ ตามมาตรา 40(4)(ก)</pre>
								<pre class="label-text12">&emsp;(ข) เงินปันผล เงินส่วนแบ่งกำไร ฯลฯ ตามมาตรา 40(4)(ข)</pre>
								<pre class="label-text12">&emsp;&emsp;(1) กรณีผู้ได้รับเงินปันผลได้รับเครดิตภาษี โดยจ่ายจาก</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;กำไรสุทธิของกิจการที่ต้องเสียภาษีเงินได้นิติบุคคลในอัตราดังนี้</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(1.1) อัตราร้อยละ 30 ของกำไรสุทธิ</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(1.2) อัตราร้อยละ 25 ของกำไรสุทธิ</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(1.3) อัตราร้อยละ 20 ของกำไรสุทธิ</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(1.4) อัตราอื่นๆ (ระบุ).......ของกำไรสุทธิ</pre>
								<pre class="label-text12">&emsp;&emsp;(2) กรณีผู้ได้รับเงินปันผลไม่ได้รับเครดิตภาษี เนื่องจากจ่ายจาก</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(2.1) กำไรสุทธิของกิจการที่ได้รับยกเว้นภาษีเงินได้นิติบุคคล</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(2.2) เงินปันผลหรือเงินส่วนแบ่งของกำไรที่ได้รับยกเว้นไม่ต้องนำมารวม</pre>
								<pre class="label-text12"><?=str_repeat('&emsp;', 5) ?>คำนวณเป็นรายได้เพื่อเสียภาษีเงินได้นิตอบุคคล</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(2.3) กำไรสุทธิที่ได้หักผลขาดทุนสุทธิยกมาไม่เกิน 5 ปี</pre>
								<pre class="label-text12"><?=str_repeat('&emsp;', 5) ?>ก่อนรอบระยะเวลาบัญชีปีปัจจุบัน</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(2.4) กำไรที่รับรู้ทางบัญชีโดยวิธีส่วนได้เสีย (equity method)</pre>
								<pre class="label-text12">&emsp;&emsp;&emsp;(2.5) อื่นๆ (ระบุ).............................</pre>
								<pre class="label-text12">5. การจ่ายเงินได้ที่ต้องหักภาษี ณ ที่จ่าย ตามคำสั่งกรมสรรพากรที่ออกตามมาตรา</pre>
								<pre class="label-text12">&emsp;3 เตรส เช่น รางวัล ส่วดลดหรือประโยชน์ใดๆ เนื่องจากการส่งเสริมการขาย รางวัล</pre>
								<pre class="label-text12">&emsp;ในการประกวด การแข่งขัน การชิงโชค ค่าแสดงของนักแสดงสาธารณะ ค่าจ้าง</pre>
								<pre class="label-text12">&emsp;ทำของ ค่าโฆษณา ค่าเช่า ค่าขนส่ง ค่าบริการ ค่าเบี้ยประกันวินาศภัย ฯลฯ</pre>
								<pre class="label-text12">6. อื่นๆ (ระบุ)...................................................</pre>
							</td>
							<td class="td-text-center borderRight borderBottom" style="vertical-align: bottom;" colspan="1"><?=!empty($value['DATE14']) ? date_format(date_create($value['DATE14']),"d/m/Y"): '' ?></td>
							<td class="td-text-right borderRight borderBottom" style="vertical-align: bottom;" colspan="1"><?=!empty($value['AMT14']) ? $value['AMT14']: '' ?></td>
							<td class="td-text-right borderBottom" style="vertical-align: bottom;" colspan="1"><?=!empty($value['TAX14']) ? $value['TAX14']: '' ?></td>
		                </tr>
					</tbody>
					<tfoot>
					   	<tr class="tr-height">
					   		<td class="text-right label-text12 borderRight borderLeft" colspan="10">รวมเงินที่จ่ายและภาษีที่หักนำส่ง</td>
					   		<td class="td-text-right borderRight" style="border-bottom: 4.0px double black;" colspan="1"><?=isset($value['TOTALAMT']) ? $value['TOTALAMT']: '' ?></td>
				   			<td class="td-text-right borderRight" style="border-bottom: 4.0px double black;" colspan="1"><?=isset($value['TOTALTAX']) ? $value['TOTALTAX']: '' ?></td>
					   	</tr>
					    <tr class="tr-height">
					   		<td class="text-left label-text12 borderBottom borderLeft" colspan="10">รวมเงินภาษีที่หักนำส่ง (ตัวอักษร)&emsp;&ensp;<?=!empty($value['AMTTXT']) ? $value['AMTTXT']: '' ?></td>
				   			<td class="text-right borderRight borderBottom"colspan="2"></td>
					   	</tr>
   					    <tr class="tr-height">
					   		<td class="td-text-left borderBottom borderLeft borderRight" style="font-size: 11.0px;" colspan="12">เงินที่จ่ายเข้า กบข./กสจ./กองทุนสงเคราะห์ครูโรงเรียนเอกชน..........บาท&ensp;กองทุนประกันสังคม&ensp;<?=!empty($value['SECFD']) ? $value['SECFD']: '0.00' ?>&ensp;บาท&ensp;กองทุนสำรองเลี้ยงชีพ&ensp;<?=!empty($value['PRVFD']) ? $value['PRVFD']: '0.00' ?>&ensp;บาท</td>
					   	</tr>
				   	  	<tr class="tr-height">
		   	  		    	<td class="borderBottom borderLeft text-left" colspan="3">
		   	  		    		<label class="label-text11 text-left">ผู้จ่ายเงิน</label>
	                        <!-- 	<label class="label-text11 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label> -->
	                        	<label class="label-text11 text-left borderAll"><?=!empty($value['CK5']) ? str_repeat('&nbsp;', 1).$value['CK5'].str_repeat('&nbsp;', 1):str_repeat('&emsp;', 1) ?></label>
	                        	<label class="label-text11 text-left">(1) หัก ณ ที่จ่าย</label>
	                        </td>
		   	  		    	<td class="borderBottom borderLeft text-left" colspan="3">
	                        	<label class="label-text11 text-left borderAll"><?=!empty($value['CK6']) ? str_repeat('&nbsp;', 1).$value['CK6'].str_repeat('&nbsp;', 1):str_repeat('&emsp;', 1) ?></label>
	                        	<label class="label-text11 text-left">(2) ออกให้ตลอด</label>
	                        </td>
		   	  		    	<td class="borderBottom borderLeft text-left" colspan="3">
	                        	<label class="label-text11 text-left borderAll"><?=!empty($value['CK7']) ? str_repeat('&nbsp;', 1).$value['CK7'].str_repeat('&nbsp;', 1):str_repeat('&emsp;', 1) ?></label>
	                        	<label class="label-text11 text-left">(3) อกกให้ครั้งเดียว</label>
	                        </td>				
		   	  		    	<td class="borderBottom borderLeft borderRight text-left" colspan="3">
	                        	<label class="label-text11 text-left borderAll"><?=str_repeat('&emsp;', 1) ?></label>
	                        	<label class="label-text11 text-left">(4) อื่นๆ(ระบุ).............</label>
	                        </td>
					   	</tr>
					</tfoot>
				</table>

				<table class="table" style="margin: 2.0px 8.0px 2.0px 8.0px;">
					<tr class="tr-height20">
						<td class="td-text-left borderRight borderBottom" colspan="4" width="40%;">
								<pre class="label-text12">คำเตือน&ensp;ผู้มีหน้าที่ออกหนังสือรับรองการหักภาษี ณ ที่จ่าย</pre>
								<pre class="label-text12"><?=str_repeat('&ensp;', 7)?>&nbsp;ฝ่าฝืนไม่ปฏิบัติตามมาตรา 50 ทวิ แห่งประมวล</pre>
								<pre class="label-text12"><?=str_repeat('&ensp;', 7)?>&nbsp;รัษฎากร ต้องรับโทษทางอาญาตามมาตรา 35</pre>
								<pre class="label-text12"><?=str_repeat('&ensp;', 7)?>&nbsp;แห่งประมวลรัษฎากร</pre>
							</td>
						<td class="td-text-center borderBottom" colspan="8" width="60%;">
							<pre class="label-text12 text-center">ขอรับรองว่าข้อความและตัวเลขดังดล่าวข้างต้นถูกต้องตรงกับความจริงทุกประการ</pre>
							<pre class="label-text12 text-center"/>ลงชื่อ..........................................ผู้จ่ายเงิน</pre>
							<pre class="label-text12 text-center" style="padding-left: 33%;"><?=isset($value['ISSUEDT']) ? date_format(date_create($value['ISSUEDT']),"d/m/Y"): ''?><?=str_repeat('&emsp;', 8)?>ประทับตรานิติบุคคล</pre>
							<pre class="label-text12 text-center" style="padding-left: 20%;">(วัน เดือน ปี ที่ออกหนังสือรับรองฯ)<?=str_repeat('&emsp;', 6)?>(ถ้ามี)</pre>
						</td>
					</tr>
				</table>
			</div>
			<div class="flex-column" style="margin-left: 5.0px;">
				<pre class="label-text11">หมายเหจุ&ensp;เลขประจำตัวผู้เสียภาษีอากร (13 หลัก)* หมายถึง&emsp;&emsp;1.กรณีบุคคลธรรมดาไทย ให้ใช้เลขประจำตัวประชาชนของกรมการปกครอง</pre>
				<pre class="label-text11"><?=str_repeat('&emsp;', 26)?>2.กรณีนิติบุลคล ให้ใช้เลขทะเบียนนิติบุคคลของกรมพัฒนากุรกิจการค้า</pre>
				<pre class="label-text11"><?=str_repeat('&emsp;', 26)?>3.กรณีอื่นๆ นอกเหนือจาก 1. และ 2. ให้ใช้เลขประจำตัวผู้เสียภาษีอากร (13หลัก) ของกรมสรรพากร</pre>
			</div>
		</div><?php } } ?>
	</div>
</body>
</html>