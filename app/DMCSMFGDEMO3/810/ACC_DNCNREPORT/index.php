<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <?php navBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </header>
    <!--  end::navbar Menu -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <?php sideBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="accDNCNReport" name="accDNCNReport" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12">
                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('DATE')?></label>
                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                type="date" name="D1" id="D1" value="<?=!empty($data['D1']) ? date('Y-m-d', strtotime($data['D1'])): ''; ?>" onchange="unRequired();" required/>
                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                type="date" name="D2" id="D2" value="<?=!empty($data['D2']) ? date('Y-m-d', strtotime($data['D2'])): date('Y-m-d'); ?>"/>

                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 ml-5 req" 
                                id="DCTYP" name="DCTYP" onchange="unRequired();" required>
                                <option value=""></option>
                                <?php foreach ($dctype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?php echo (isset($data['DCTYP']) && $data['DCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                id="SEARCH" name="SEARCH" onclick="search();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-scroll mb-1">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr class="flex divide-x">
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="w-20 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                </th>
                                <th class="w-64 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARKS')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[570px]"><?php
                        if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x" id="rowId<?=$key?>">
                                    <td class="h-6 w-32 text-sm pl-1 text-left"><?=isset($value['VO_NO']) ? $value['VO_NO']: '' ?></td>
                                    <td class="h-6 w-24 text-sm pl-1 text-left"><?=!empty($item['ISSUEDATE']) ? date('Y-m-d', strtotime(str_replace("/", "-", $item['ISSUEDATE']))) : '' ?></td>
                                    <td class="h-6 w-24 text-sm pl-1 text-left"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-right"><?=isset($value['QTY']) ? $value['QTY']: '' ?></td>
                                    <td class="h-6 w-20 text-sm text-center"><?=isset($value['UOM']) ? $value['UOM']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-right"><?=isset($value['UNIT_PRICE']) ? $value['UNIT_PRICE']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-right"><?=isset($value['AMOUNT']) ? $value['AMOUNT']: '' ?></td>
                                    <td class="h-6 w-64 text-sm pl-1 text-left tracking-wide whitespace-nowrap"><?=isset($value['REMARK']) ? $value['REMARK']: '' ?></td>
                                    <td class="hidden"><input type="hidden" id="AMOUNTH<?=$key?>" name="AMOUNTH[]" value="<?=isset($item['AMOUNTH']) ? $item['AMOUNTH']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="VAT<?=$key?>" name="VAT[]" value="<?=isset($item['VAT']) ? $item['VAT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="TOT_AMT<?=$key?>" name="TOT_AMT[]" value="<?=isset($item['TOT_AMT']) ? $item['TOT_AMT']: '' ?>"/></td>
                                </tr><?php 
                            }
                        }                   
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-20 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-64 py-2"></td>
                            </tr><?php
                    } ?>
                        </tbody>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-3/12"></div>
                    <div class="flex w-9/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TTLAMTB')?></label>
                        <input type="text" class="text-control text-right shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="RAMT" id="RAMT" value="<?=isset($data['RAMT']) ? $data['RAMT']: '0.00'; ?>" readonly/>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('VATTTL')?></label>
                        <input type="text" class="text-control text-right shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="RVAT" id="RVAT" value="<?=isset($data['RVAT']) ? $data['RVAT']: '0.00'; ?>" readonly/>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('GROUND_TOTAL')?></label>
                        <input type="text" class="text-control text-right shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="RTTL" id="RTTL" value="<?=isset($data['RTTL']) ? $data['RTTL']: '0.00'; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="PRINT" name="PRINT"<?php if(empty($data['ITEM'])) { ?> disabled <?php } ?>><?=checklang('PRINT'); ?></button>
                        <input type="hidden" class="text-control text-right shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="DCNT" id="DCNT" value="<?=isset($data['DCNT']) ? $data['DCNT']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                 onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['no']; ?>');"><?=checklang('END'); ?></button>
                    </div>
                </div>
            </form>
        </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-------------------------------------------------------------------------------------->
        <?php footerBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</div>
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        calAmout();
        calVat();
        calTotalAmout();

        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
            }
        });

        if(dataItem > 0) {
            dvwdetail.classList.remove('w-full');
            dvwdetail.classList.add('w-screen');
        }
    })

    function checkValue(event) {
        if( $('#D1').val() == '' || $('#DCTYP').val() == '') {
            alertValidation();
            return false;
        } else {
            $("#loading").show();
            return true;
        }
    }

    function calAmout() {

        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalamt += parseFloat(value.AMOUNTH.replace(/,/g, '')) || 0;
            });
            const formattedTotalAmt = totalamt.toLocaleString('th-TH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            $('#RAMT').val(formattedTotalAmt);
        }    

    }

    function calVat() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalamt += parseFloat(value.VAT.replace(/,/g, '')) || 0;
            });
            const formattedTotalAmt = totalamt.toLocaleString('th-TH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            $('#RVAT').val(formattedTotalAmt);
        }    
    }

    function calTotalAmout() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalamt += parseFloat(value.TOT_AMT.replace(/,/g, '')) || 0;
            });
            const formattedTotalAmt = totalamt.toLocaleString('th-TH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            $('#RTTL').val(formattedTotalAmt);
        }    
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>
</html>
