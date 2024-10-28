<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="shipRequestVoucherPrint" name="shipRequestVoucherPrint" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SALEORDERNUMBER_S" id="SALEORDERNUMBER_S" value="<?=isset($data['SALEORDERNUMBER_S']) ? $data['SALEORDERNUMBER_S']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALEORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DELIVERY_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="DATE1" name="DATE1" value="<?=!empty($data['DATE1']) ? date('Y-m-d', strtotime($data['DATE1'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="DATE2" name="DATE2" value="<?=!empty($data['DATE2']) ? date('Y-m-d', strtotime($data['DATE2'])) : ''; ?>"/>
                                        <label class="w-2/12"></label>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALESTAFFCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFCODE" id="STAFFCODE" value="<?=isset($data['STAFFCODE']) ? $data['STAFFCODE']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-[14px] text-gray-700 border-gray-300 read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CATEGORY_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CATALOGCODE" id="CATALOGCODE" value="<?=isset($data['CATALOGCODE']) ? $data['CATALOGCODE']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCATALOG">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CATALOGNAME" id="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PRINT_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="BILLING" name="BILLING">
                                            <option value=""></option>
                                            <?php foreach ($BILLING as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BILLING']) && $data['BILLING'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>

                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('FACTORYNAME')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="FACTORY" name="FACTORY">
                                            <option value=""></option>
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTORY']) && $data['FACTORY'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <div class="flex w-6/12">
                                            <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300" id="REP01" name="REP01" onchange="controlPrint();">
                                                <option value=""></option>
                                                <?php foreach ($SELECT_REP01 as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['REP01']) && $data['REP01'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="flex w-6/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <hr class="divide-y divide-dotted my-2 mx-2">

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[550px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ACT_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_AMOUNT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id" id="rowId<?=$key?>">
                                    <td class="hidden"><?=$key?></td>
                                    <td class="h-6 w-16 text-sm text-center">
                                        <input type="hidden" id="CHECKROWH<?=$key?>" name="CHECKROW[]" value="F" <?=isset($value['CHECKROW']) && $value['CHECKROW'] == 'T' ? 'disabled' : '' ?>/>
                                        <input class="chkbox" type="checkbox" id="CHECKROW<?=$key?>" name="CHECKROW[]" value="T" 
                                                onchange="chked(<?=$key?>);" <?=isset($value['CHECKROW']) && $value['CHECKROW'] == 'T' ? 'checked' : '' ?>/>
                                    </td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPREQUESTSHIPPEDDATE']) ? $value['SHIPREQUESTSHIPPEDDATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPREQUESTVOUCHERNUMBER']) ? $value['SHIPREQUESTVOUCHERNUMBER']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['SHIPREQUESTVOUCHERLINE']) ? $value['SHIPREQUESTVOUCHERLINE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CUSTOMERCODE']) ? $value['CUSTOMERCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['SHIPREQUESTSALEQUANTITY']) ? $value['SHIPREQUESTSALEQUANTITY']: '' ?></td>
                                    <td class="h-6 w-2/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['ORDERDETAILUNITPRICE']) ? $value['ORDERDETAILUNITPRICE']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['AMOUNT']) ? $value['AMOUNT']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['ORDERDETAILCURRENCY']) ? $value['ORDERDETAILCURRENCY']: '' ?></td>

                                <input type="hidden" id="SHIPREQUESTSHIPPEDDATE<?=$key?>" name="SHIPREQUESTSHIPPEDDATE[]" value="<?=isset($value['SHIPREQUESTSHIPPEDDATE']) ? $value['SHIPREQUESTSHIPPEDDATE']: '' ?>"/>
                                <input type="hidden" id="SHIPREQUESTVOUCHERNUMBER<?=$key?>" name="SHIPREQUESTVOUCHERNUMBER[]" value="<?=isset($value['SHIPREQUESTVOUCHERNUMBER']) ? $value['SHIPREQUESTVOUCHERNUMBER']: '' ?>"/>
                                <input type="hidden" id="SHIPREQUESTVOUCHERLINE<?=$key?>" name="SHIPREQUESTVOUCHERLINE[]" value="<?=isset($value['SHIPREQUESTVOUCHERLINE']) ? $value['SHIPREQUESTVOUCHERLINE']: '' ?>"/>
                                <input type="hidden" id="CUSTOMERCODE<?=$key?>" name="CUSTOMERCODE[]" value="<?=isset($value['CUSTOMERCODE']) ? $value['CUSTOMERCODE']: '' ?>"/>
                                <input type="hidden" id="CUSTOMERNAME<?=$key?>" name="CUSTOMERNAME[]" value="<?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?>"/>
                                <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODE[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>"/>
                                <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>"/>
                                <input type="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPEC[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>"/>
                                <input type="hidden" id="SHIPREQUESTSALEQUANTITY<?=$key?>" name="SHIPREQUESTSALEQUANTITY[]" value="<?=isset($value['SHIPREQUESTSALEQUANTITY']) ? $value['SHIPREQUESTSALEQUANTITY']: '' ?>"/>
                                <input type="hidden" id="ORDERDETAILUNITPRICE<?=$key?>" name="ORDERDETAILUNITPRICE[]" value="<?=isset($value['ORDERDETAILUNITPRICE']) ? $value['ORDERDETAILUNITPRICE']: '' ?>"/>
                                <input type="hidden" id="AMOUNT<?=$key?>" name="AMOUNT[]" value="<?=isset($value['AMOUNT']) ? $value['AMOUNT']: '' ?>"/>
                                <input type="hidden" id="ORDERDETAILCURRENCY<?=$key?>" name="ORDERDETAILCURRENCY[]" value="<?=isset($value['ORDERDETAILCURRENCY']) ? $value['ORDERDETAILCURRENCY']: '' ?>"/>
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex p-2">
                    <div class="flex w-12/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>
     
                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
                        <label class="text-color block text-sm w-4/12 px-2 pt-1"><?=checklang('')?></label>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[550px]');
                tablearea.classList.add('h-[660px]');
                maxrow = 25;
            } else {
                tablearea.classList.remove('h-[660px]');
                tablearea.classList.add('h-[550px]');
                maxrow = 21;
            }
            emptyRows(maxrow);
        });

        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                let index = item.eq(0).text(); $('#GMAPADR').val('');
                $('#GMAPADR').val($('#GMAPADR'+index+'').val());
            }
        });
    });
   
    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if (code == 'SALEORDERNUMBER_S') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function checkedAll() {
        var checkall = document.getElementById('CHKALL');
        var dvw = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>'; 
        if(dvw != '') {
            let dvwArray = JSON.parse(dvw);
            $.each(dvwArray, function(key, value) {  
                // console.log(key);
                if (checkall.checked) {
                    $('#CHECKROW'+key+'').prop('checked', true);
                    document.getElementById('CHECKROWH'+key+'').disabled = true;
                } else {
                    $('#CHECKROW'+key+'').prop('checked', false);
                    document.getElementById('CHECKROWH'+key+'').disabled = false;
                }
            });
        }
    }

    function chked(index) {
      // console.log(index);
        if (document.getElementById('CHECKROW' + index + '').checked) {
            document.getElementById('CHECKROWH' + index + '').disabled = true;
        } else {
            document.getElementById('CHECKROWH' + index + '').disabled = false;
        }
    }

    function printCheck() {
        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        if (dataItem < 1) {
            return printWarning();
        } else {
            return action('print');
        }
    }

    function printWarning() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('MSG_PRINT'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('nono'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>
</html>