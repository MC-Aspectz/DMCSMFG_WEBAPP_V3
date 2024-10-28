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
            <form class="w-full" method="POST" action="" id="invfuture" name="invfuture" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-2">
                                    <div class="flex w-7/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ITEMCODE_LB"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                    name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                name="ITEMNAME" id="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-5/12 px-1"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1">&emsp;</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-2 text-gray-700 border-gray-300 read"
                                                name="ITEMSPEC" id="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ITEMDRAWNUMBER" id="ITEMDRAWNUMBER" value="<?=isset($data['ITEMDRAWNUMBER']) ? $data['ITEMDRAWNUMBER']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-5/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="ONHAND_LB"><?=checklang('ONHAND')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-2 text-gray-700 border-gray-300 text-right read"
                                                name="ONHANDQTY" id="ONHANDQTY" value="<?=isset($data['ONHANDQTY']) ? $data['ONHANDQTY']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="UNIT" id="UNIT" value="<?=isset($data['UNIT']) ? $data['UNIT']: ''; ?>" readonly/>
                                        <div class="flex w-5/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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
                <!-- Table -->
                <div id="table-area" class="overflow-scroll block mx-2 h-[600px]"> 
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-10 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WAREHOUSE_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QTYOUT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('EFFECTIVE_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_NO')?></span>
                                </th>
                                <th class="px-20 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                            if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                                foreach($data['ITEM'] as $key => $item) { ?>
                                    <tr class="divide-y divide-gray-200 csv row-id" id="rowId<?=$key?>" style="background-color: <?=$item['SYSROWCOLOR'];?>">
                                        <td class="hidden row-seq"><?=$key; // $key+1?></td>
                                        <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=isset($item['INVDATE']) ? $item['INVDATE']: ''; ?></td>
                                        <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['VOUCHERNO']) ? $item['VOUCHERNO']: ''; ?></td>
                                        <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($item['INQTY']) ? $item['INQTY']: ''; ?></td>
                                        <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($item['OUTQTY']) ? $item['OUTQTY']: ''; ?></td>
                                        <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($item['BALANCE']) ? $item['BALANCE']: ''; ?></td>
                                        <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['ORDERNUM']) ? $item['ORDERNUM']: ''; ?></td>
                                        <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['REMARK']) ? $item['REMARK']: ''; ?></td>
                                    </tr><?php
                                }
                            }
                            for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                    <td class="hidden row-seq"><?=$i;?></td>
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
                    <div class="flex w-full">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowCount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-2 mx-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="DETAIL" onclick="$('#modal-view').modal('show');"><?=checklang('DETAIL'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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

<!-- start::modal -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="item_view" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="text-gray-700 text-base font-semibold"><?=checklang('DETAIL'); ?></label>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <table class="w-full border-collapse border border-slate-500" id="tb-modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm bg-yellow-100"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm bg-yellow-100"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('VOUCHER_NO') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="VOUCHER_NO"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WAREHOUSE_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="WAREHOUSE_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('QTYOUT') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="QTYOUT"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('EFFECTIVE_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="EFFECTIVE_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ORDER_NO') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ORDER_NO"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REMARK') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="REMARK"></td>
                    </tr>
                </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 7</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        document.getElementById('DETAIL').disabled = true;
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 23); ?>';
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[600px]');
                tablearea.classList.add('h-[680px]');
                maxrow = 26;
            } else {
                tablearea.classList.remove('h-[680px]');
                tablearea.classList.add('h-[600px]');
                maxrow = 23;
            }
            emptyRows(maxrow);
        });

        if(minrow > 0) {
            $('#table').DataTable({
                processing: false,
                searching: false,
                responsive: true,
                fixedHeader: false,
                paging: false,
                ordering: false,
                info: false,
                language: {
                    emptyTable: ' ',
                    infoEmpty: ' ',
                    search: ''
                    // search: '<?=checklang('SEARCH')?>'
                },
            });
        }
    });

    var isItem = false;
    $('table#table tr').click(function () {
        isItem = false;
        $('table#table tr').removeAttr('id');
        document.getElementById('DETAIL').disabled = true;

        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '' && item.eq(5).text() != '') {
            $(this).attr('id', 'selected-row');
            $('#DATE').html(item.eq(1).text());
            $('#VOUCHER_NO').html(item.eq(2).text());
            $('#WAREHOUSE_QTY').html(item.eq(3).text());
            $('#QTYOUT').html(item.eq(4).text());
            $('#EFFECTIVE_QTY').html(item.eq(5).text());
            $('#ORDER_NO').html(item.eq(6).text());
            $('#REMARK').html(item.eq(7).text());
           
            document.getElementById('DETAIL').disabled = false;
        }
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);    
    }
</script>
</html>