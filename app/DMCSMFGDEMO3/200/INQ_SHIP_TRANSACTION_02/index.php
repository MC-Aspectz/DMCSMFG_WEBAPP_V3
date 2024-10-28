<?php require_once('./function/index_x.php');?>
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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="inqShiptransaction02" name="inqShiptransaction02" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="CUSTOMERCD_TXT"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME_S" id="CUSTOMERNAME_S" value="<?=isset($data['CUSTOMERNAME_S']) ? $data['CUSTOMERNAME_S']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="SHIP_DATE_TXT"><?=checklang('SHIP_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P2" name="P2" value="<?=!empty($data['P2']) ? date('Y-m-d', strtotime($data['P2'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center" id="ARROW_TXT"><?=checklang('ARROW')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P3"name="P3"  value="<?=!empty($data['P3']) ? date('Y-m-d', strtotime($data['P3'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div> 
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div id="table-area" class="overflow-scroll px-2 block h-[580px]">
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPECT_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_NO')?></span>
                                </th>
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
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
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FACTORYNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIPQTY')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPECTSTAFFNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPECTION')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PICK_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_ITEM_INV')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCEPTANCE_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STATUS')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGETYPE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRINT_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('EFFECTIVEDATE')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERYNO')?></span>
                                </th>
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id csv" id="rowId<?=$key?>">
                                    <td class="hidden rowId"><?=$key ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPTRANORDERNO']) ? $value['SHIPTRANORDERNO']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['SHIPTRANORDERLN']) ? $value['SHIPTRANORDERLN']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPTRANDT']) ? $value['SHIPTRANDT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPTRANINSPDT']) ? $value['SHIPTRANINSPDT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPTRANSALENO']) ? $value['SHIPTRANSALENO']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['SHIPTRANSALELN']) ? $value['SHIPTRANSALELN']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPTRANIMCD']) ? $value['SHIPTRANIMCD']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANIMNAME']) ? $value['SHIPTRANIMNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANIMSPEC']) ? $value['SHIPTRANIMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANFACTYP']) ? $value['SHIPTRANFACTYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANSTAFFNAME']) ? $value['SHIPTRANSTAFFNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANCUSTNAME']) ? $value['SHIPTRANCUSTNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['SHIPTRANSHIPQTY']) ? $value['SHIPTRANSHIPQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANINSPSTAFFNAME']) ? $value['SHIPTRANINSPSTAFFNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANINSPTYP']) ? $value['SHIPTRANINSPTYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['SHIPTRANINSPPICKQTY']) ? $value['SHIPTRANINSPPICKQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['SHIPTRANINSPBADQTY']) ? $value['SHIPTRANINSPBADQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['SHIPTRANINSPGOODQTY']) ? $value['SHIPTRANINSPGOODQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANSTATUS']) ? $value['SHIPTRANSTATUS']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANLOCTYP']) ? $value['SHIPTRANLOCTYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANLOCNAME']) ? $value['SHIPTRANLOCNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANREM']) ? $value['SHIPTRANREM']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANPRINTFLG']) ? $value['SHIPTRANPRINTFLG']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANPRINTDT']) ? $value['SHIPTRANPRINTDT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANINVOICENO']) ? $value['SHIPTRANINVOICENO']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['SHIPTRANINVOICELN']) ? $value['SHIPTRANINVOICELN']: '' ?></td>
                                    <!-- <td class="hidden"><?=isset($value['SHIPTRANORDERNO']) ? $value['SHIPTRANORDERNO']: '' ?></td>
                                    <td class="hidden"><?=isset($value['SHIPTRANSTAFFCD']) ? $value['SHIPTRANSTAFFCD']: '' ?></td>
                                    <td class="hidden"><?=isset($value['SHIPTRANCUSTCD']) ? $value['SHIPTRANCUSTCD']: '' ?></td>
                                    <td class="hidden"><?=isset($value['SHIPTRANINSPSTAFF']) ? $value['SHIPTRANINSPSTAFF']: '' ?></td>
                                    <td class="hidden"><?=isset($value['SHIPTRANLOCCD']) ? $value['SHIPTRANLOCCD']: '' ?></td>
                                    <td class="hidden"><?=isset($value['SHIPTRANINVVOUCHER']) ? $value['SHIPTRANINVVOUCHER']: '' ?></td> -->
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
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="DETAIL" name="DETAIL" onclick="$('#modal-view').modal('show');"><?=checklang('DETAIL'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
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
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
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
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('VOUCHER_NO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="VOUCHER_NO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LINE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE_1"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SHIP_DATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SHIP_DATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INSPECT_DATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPECT_DATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_NO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_NO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LINE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE_2"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCODE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SPECIFICATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SPECIFICATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('FACTORYNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="FACTORYNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STAFF_NAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STAFF_NAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SHIPQTY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SHIPQTY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INSPECTSTAFFNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPECTSTAFFNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INSPECTION') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPECTION"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PICK_QTY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PICK_QTY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('BAD_ITEM_INV') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="BAD_ITEM_INV"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ACCEPTANCE_QTY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ACCEPTANCE_QTY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STATUS') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STATUS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STORAGETYPE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGETYPE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STORAGE_NAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGE_NAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REMARK') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="REMARK"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRINT_TYPE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PRINT_TYPE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('EFFECTIVEDATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="EFFECTIVEDATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERYNO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERYNO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LINE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE_3"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 26</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('DETAIL').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[580px]');
                tablearea.classList.add('h-[675px]');
                maxrow = 25;
            } else {
                tablearea.classList.remove('h-[675px]');
                tablearea.classList.add('h-[580px]');
                maxrow = 22;
            }
            emptyRows(maxrow);
        });
    });

    $('table#table tr').click(function () {
        $('table#table tr').removeAttr('id');
        document.getElementById('DETAIL').disabled = true;

        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {

            $(this).attr('id', 'selected-row');
            // console.log(item.eq(0).text());
            $('#VOUCHER_NO').html(item.eq(1).text());
            $('#LINE_1').html(item.eq(2).text());
            $('#SHIP_DATE').html(item.eq(3).text());
            $('#INSPECT_DATE').html(item.eq(4).text());
            $('#SALES_ORDER_NO').html(item.eq(5).text());
            $('#LINE_2').html(item.eq(6).text());
            $('#ITEMCODE').html(item.eq(7).text());
            $('#ITEMNAME').html(item.eq(8).text());
            $('#SPECIFICATE').html(item.eq(9).text());
            $('#FACTORYNAME').html(item.eq(10).text());
            $('#STAFF_NAME').html(item.eq(11).text());
            $('#CUSTOMERNAME').html(item.eq(12).text());
            $('#SHIPQTY').html(item.eq(13).text());
            $('#INSPECTSTAFFNAME').html(item.eq(14).text());
            $('#INSPECTION').html(item.eq(15).text());
            $('#PICK_QTY').html(item.eq(16).text());
            $('#BAD_ITEM_INV').html(item.eq(17).text());
            $('#ACCEPTANCE_QTY').html(item.eq(18).text());
            $('#STATUS').html(item.eq(19).text());
            $('#STORAGETYPE').html(item.eq(20).text());
            $('#STORAGE_NAME').html(item.eq(21).text());
            $('#REMARK').html(item.eq(22).text());
            $('#PRINT_TYPE').html(item.eq(23).text());
            $('#EFFECTIVEDATE').html(item.eq(24).text());
            $('#DELIVERYNO').html(item.eq(25).text());
            $('#LINE_3').html(item.eq(26).text());

            document.getElementById('DETAIL').disabled = false;
        }
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);
    }

    function validationDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1');?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes');?>',
            cancelButtonText: '<?=lang('no');?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
