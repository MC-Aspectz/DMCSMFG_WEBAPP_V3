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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="shipRequestCancel" name="shipRequestCancel" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                                id="SEARCHSALEORDERDETAIL">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="SALEORDERLINE_S" name="SALEORDERLINE_S" value="<?=isset($data['SALEORDERLINE_S']) ? $data['SALEORDERLINE_S']: ''; ?>"/>
                                        <div class="w-4/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DELIVERY_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="ISSUEDATE1" name="ISSUEDATE1" value="<?=!empty($data['ISSUEDATE1']) ? date('Y-m-d', strtotime($data['ISSUEDATE1'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="ISSUEDATE2" name="ISSUEDATE2" value="<?=!empty($data['ISSUEDATE2']) ? date('Y-m-d', strtotime($data['ISSUEDATE2'])) : ''; ?>"/>
                                        <label class="w-2/12"></label>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LO_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="LC_CODE" id="LC_CODE" value="<?=isset($data['LC_CODE']) ? $data['LC_CODE']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTORAGE">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="STORAGENAME" id="STORAGENAME" value="<?=isset($data['STORAGENAME']) ? $data['STORAGENAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CATEGORY_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CATALOGCD" id="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>"/>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
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
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TRANSPORTER')?></label>
                                        <select class="text-control text-[11px] shadow-md border mr-2 px-2 h-7 w-4/12 text-left rounded-xl border-gray-300"
                                                id="TRANSPORT" name="TRANSPORT">
                                                <option value=""></option>
                                                <?php foreach ($TRANSPORT as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['TRANSPORT']) && $data['TRANSPORT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <input type="hidden" name="TRANSPORT_S" value="<?=isset($data['TRANSPORT_S']) ? $data['TRANSPORT_S']: ''; ?>">
                                        <div class=" flex w-5/12 justify-end">
                                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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
                <div id="table-area" class="overflow-scroll px-2 block h-[328px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_NO_CUSTOMER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMSPEC')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_PLAN_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TRANSPORTER')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUSPEND_FLG')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id" id="rowId<?=$key?>">
                                    <td class="hidden"><?=$key?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ODRNUMLINE']) ? $value['ODRNUMLINE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPDT']) ? $value['SHIPDT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERNUMBER']) ? $value['SALEORDERNUMBER']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERCUSTOMERCODE']) ? $value['SALEORDERCUSTOMERCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SALEORDERCUSTOMERNAME']) ? $value['SALEORDERCUSTOMERNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SALEORDERCUSTOMERSTAFF']) ? $value['SALEORDERCUSTOMERSTAFF']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ORDERDETAILCUSTOMERORDERNUMBER']) ? $value['ORDERDETAILCUSTOMERORDERNUMBER']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['SHIPQTY']) ? $value['SHIPQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERDELIVERYNAME']) ? $value['SALEORDERDELIVERYNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=!empty($value['SHIPREQTRANSTYPSTR']) ? $TRANSPORT[$value['SHIPREQTRANSTYPSTR']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SHIPREQSUSPENDTYP']) ? $SUSPEND_SEL[$value['SHIPREQSUSPENDTYP']]: '' ?></td>

                                    <input type="hidden" id="ODRNUMLINE<?=$key?>" name="ODRNUMLINEZ[]" value="<?=isset($value['ODRNUMLINE']) ? $value['ODRNUMLINE']: '' ?>"/>
                                    <input type="hidden" id="SHIPDT<?=$key?>" name="SHIPDTZ[]" value="<?=isset($value['SHIPDT']) ? $value['SHIPDT']: '' ?>"/>
                                    <input type="hidden" id="SALEORDERNUMBER<?=$key?>" name="SALEORDERNUMBERZ[]" value="<?=isset($value['SALEORDERNUMBER']) ? $value['SALEORDERNUMBER']: '' ?>"/>
                                    <input type="hidden" id="SALEORDERCUSTOMERCODE<?=$key?>" name="SALEORDERCUSTOMERCODEZ[]" value="<?=isset($value['SALEORDERCUSTOMERCODE']) ? $value['SALEORDERCUSTOMERCODE']: '' ?>"/>
                                    <input type="hidden" id="SALEORDERCUSTOMERNAME<?=$key?>" name="SALEORDERCUSTOMERNAMEZ[]" value="<?=isset($value['SALEORDERCUSTOMERNAME']) ? $value['SALEORDERCUSTOMERNAME']: '' ?>"/>
                                    <input type="hidden" id="SALEORDERCUSTOMERSTAFF<?=$key?>" name="SALEORDERCUSTOMERSTAFFZ[]" value="<?=isset($value['SALEORDERCUSTOMERSTAFF']) ? $value['SALEORDERCUSTOMERSTAFF']: '' ?>"/>
                                    <input type="hidden" id="ORDERDETAILCUSTOMERORDERNUMBER<?=$key?>" name="ORDERDETAILCUSTOMERORDERNUMBERZ[]" 
                                            value="<?=isset($value['ORDERDETAILCUSTOMERORDERNUMBER']) ? $value['ORDERDETAILCUSTOMERORDERNUMBER']: '' ?>"/>
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODEZ[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>"/>
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAMEZ[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>"/>
                                    <input type="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPECZ[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>"/>
                                    <input type="hidden" id="SHIPQTY<?=$key?>" name="SHIPQTYZ[]" value="<?=isset($value['SHIPQTY']) ? $value['SHIPQTY']: '' ?>"/>
                                    <input type="hidden" id="SALEORDERDELIVERYNAME<?=$key?>" name="SALEORDERDELIVERYNAMEZ[]" value="<?=isset($value['SALEORDERDELIVERYNAME']) ? $value['SALEORDERDELIVERYNAME']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQTRANSTYP<?=$key?>" name="SHIPREQTRANSTYPZ[]" value="<?=isset($value['SHIPREQTRANSTYP']) ? $value['SHIPREQTRANSTYP']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQSUSPENDTYP<?=$key?>" name="SHIPREQSUSPENDTYPZ[]" value="<?=isset($value['SHIPREQSUSPENDTYP']) ? $value['SHIPREQSUSPENDTYP']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQNO<?=$key?>" name="SHIPREQNOZ[]" value="<?=isset($value['SHIPREQNO']) ? $value['SHIPREQNO']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQLN<?=$key?>" name="SHIPREQLNZ[]" value="<?=isset($value['SHIPREQLN']) ? $value['SHIPREQLN']: '' ?>"/>
                                    <input type="hidden" id="LOCTYP<?=$key?>" name="LOCTYPZ[]" value="<?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?>"/>
                                    <input type="hidden" id="LOCCD<?=$key?>" name="LOCCDZ[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>"/>
                                    <input type="hidden" id="LOCNAME<?=$key?>" name="LOCNAMEZ[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>"/>
                                    <input type="hidden" id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYPZ[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>"/>
                                    <input type="hidden" id="TOTALOH<?=$key?>" name="TOTALOHZ[]" value="<?=isset($value['TOTALOH']) ? $value['TOTALOH']: '' ?>"/>
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

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                            <summary class="text-color mx-auto py-2 text-sm font-semibold">
                                <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center mr-2"
                                    id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button> -->
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 ml-2"
                                    id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSVIS_UPDATE']) && $data['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                            </summary> 

                            <!-- <div class="flex mb-1">
                                <div class="flex w-7/12 px-2">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center mr-2"
                                    id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center mr-2"
                                    id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSVIS_UPDATE']) && $data['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                </div>
                                <div class="flex w-5/12 px-2 justify-end">
                                </div>
                            </div> -->
                            <div class="flex mb-1 ">
                                <div class="flex w-8/12 px-2">
                                    <div class="flex-col w-full">
                                        <div class="flex mb-1">
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('VOUCHER_NO');?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="ODRNUMLINE" name="ODRNUMLINE" readonly/>
                                            <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('DELIVERY_DATE');?></label>
                                            <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                    id="SHIPDT" name="SHIPDT" value="<?=!empty($data['SHIPDT']) ? date('Y-m-d', strtotime($data['SHIPDT'])) : ''; ?>"/>
                                            <input type="hidden" id="ROWNO" name="ROWNO"/>
                                        </div>
                                        <div class="flex mb-1">
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ITEMCODE');?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="ITEMCODE" name="ITEMCODE" readonly/>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="ITEMNAME" name="ITEMNAME" readonly/>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="ITEMSPEC" name="ITEMSPEC" readonly/>
                                            <input type="hidden" id="SALEORDERCUSTOMERCODE" name="SALEORDERCUSTOMERCODE"/>
                                            <input type="hidden" id="SALEORDERCUSTOMERNAME" name="SALEORDERCUSTOMERNAME"/>
                                            <input type="hidden" id="SALEORDERNUMBER" name="SALEORDERNUMBER"/>
                                            <input type="hidden" id="SALEORDERCUSTOMERSTAFF" name="SALEORDERCUSTOMERSTAFF"/>
                                            <input type="hidden" id="ORDERDETAILCUSTOMERORDERNUMBER" name="ORDERDETAILCUSTOMERORDERNUMBER"/>
                                            <input type="hidden" id="SALEORDERDELIVERYNAME" name="SALEORDERDELIVERYNAME"/>
                                            <input type="hidden" id="SHIPREQNO" name="SHIPREQNO"/>
                                            <input type="hidden" id="SHIPREQLN" name="SHIPREQLN"/>
                                        </div>

                                        <div class="flex mb-1">
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SHIP_PLAN_QTY');?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right req"
                                                    id="SHIPQTY" name="SHIPQTY" value="<?=isset($data['SHIPQTY']) ? $data['SHIPQTY']: ''; ?>" onchange="this.value = num2digit(this.value); unRequired();"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                            <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read"
                                                    id="ITEMUNITTYP" name="ITEMUNITTYP">
                                                    <option value=""></option>
                                                    <?php foreach ($UNIT as $key => $item) { ?>
                                                        <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>

                                        <div class="flex mb-1">
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SOURCE_STORAGE');?></label>
                                            <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300"
                                                    id="STORAGETYPE" name="STORAGETYPE">
                                                    <option value=""></option>
                                                    <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                        <option value="<?=$key ?>" <?=(isset($data['STORAGETYPE']) && $data['STORAGETYPE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                    <?php } ?>
                                            </select>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        name="LOCCD" id="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>"/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHLOC">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                 name="LOCNAME" id="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                        </div>

                                        <div class="flex mb-1">
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TRANSPORTER');?></label>
                                            <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                                    id="SHIPREQTRANSTYP" name="SHIPREQTRANSTYP">
                                                    <option value=""></option>
                                                    <?php foreach ($TRANSPORT as $key => $item) { ?>
                                                        <option value="<?=$key ?>" <?=(isset($data['SHIPREQTRANSTYP']) && $data['SHIPREQTRANSTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                    <?php } ?>
                                            </select>
                                            <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('SUSPEND_FLG');?></label>
                                            <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300"
                                                    id="SHIPREQSUSPENDTYP" name="SHIPREQSUSPENDTYP">
                                                    <option value=""></option>
                                                    <?php foreach ($SUSPEND_SEL as $key => $item) { ?>
                                                        <option value="<?=$key ?>" <?=(isset($data['SHIPREQSUSPENDTYP']) && $data['SHIPREQSUSPENDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex w-4/12 px-2">
                                    <div class="flex-col">
                                        <div class="flex">
                                            <div class="overflow-scroll block h-[115px] max-h-[115px]">
                                                <table id="tableLoc" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                                                    <thead class="sticky top-0 bg-gray-50">
                                                        <tr class="border border-gray-600">
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_NAME')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ONHAND')?></span>
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="dvwloc" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                                                        for ($i = $minrowB+1; $i <= 3; $i++) { ?>
                                                            <tr class="divide-y divide-gray-200" id="rowlocId<?=$i?>">
                                                                <td class="h-6 border border-slate-700"></td>
                                                                <td class="h-6 border border-slate-700"></td>
                                                                <td class="h-6 border border-slate-700"></td>
                                                            </tr> <?php
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="flex mb-1">
                                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record">0</span></label>
                                        </div>

                                        <div class="flex mb-1 justify-end">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TOTAL')?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="TOTALOH" name="TOTALOH" value="<?=!empty($data['TOTALOH']) ? number_format(str_replace(',', '', $data['TOTALOH']), 2): '0.00'; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">   
    $(document).ready(function() {
        document.getElementById('UPDATE').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 12); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[328px]');
                tablearea.classList.add('h-[420px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[420px]');
                tablearea.classList.add('h-[328px]');
                maxrow = 12;
            }
            emptyRows(maxrow);
        });

        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let index;
            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                let index = item.eq(0).text();
                // console.log(dashFormatDate($('#SHIPDT'+index+'').val()));
                searchImOh(index);
                $('#ROWNO').val(index);
                $('#ODRNUMLINE').val($('#ODRNUMLINE'+index+'').val());
                $('#SHIPDT').val(dashFormatDate($('#SHIPDT'+index+'').val()));
                $('#ITEMCODE').val($('#ITEMCODE'+index+'').val());
                $('#ITEMNAME').val($('#ITEMNAME'+index+'').val());
                $('#ITEMSPEC').val($('#ITEMSPEC'+index+'').val());
                $('#SALEORDERCUSTOMERCODE').val($('#SALEORDERCUSTOMERCODE'+index+'').val());
                $('#SALEORDERCUSTOMERNAME').val($('#SALEORDERCUSTOMERNAME'+index+'').val());
                $('#SALEORDERNUMBER').val($('#SALEORDERNUMBER'+index+'').val());
                $('#SALEORDERCUSTOMERSTAFF').val($('#SALEORDERCUSTOMERSTAFF'+index+'').val());
                $('#ORDERDETAILCUSTOMERORDERNUMBER').val($('#ORDERDETAILCUSTOMERORDERNUMBER'+index+'').val());
                $('#SALEORDERDELIVERYNAME').val($('#SALEORDERDELIVERYNAME'+index+'').val());
                $('#SHIPREQNO').val($('#SHIPREQNO'+index+'').val());
                $('#SHIPREQLN').val($('#SHIPREQLN'+index+'').val());
                $('#SHIPQTY').val($('#SHIPQTY'+index+'').val());
                $('#ITEMUNITTYP').val($('#ITEMUNITTYP'+index+'').val());
                $('#STORAGETYPE').val($('#LOCTYP'+index+'').val());
                $('#LOCCD').val($('#LOCCD'+index+'').val());
                $('#LOCNAME').val($('#LOCNAME'+index+'').val());
                $('#SHIPREQTRANSTYP').val($('#SHIPREQTRANSTYP'+index+'').val());
                $('#SHIPREQSUSPENDTYP').val($('#SHIPREQSUSPENDTYP'+index+'').val());
                $('#TOTALOH').val(num2digit($('#TOTALOH'+index+'').val()));
                
                unRequired();
                document.getElementById('UPDATE').disabled = false;
            }
        });


    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getSearch(code, result);    
    }

    function HandlePopupLocResult(result, type) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getLoc(result, type);    
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
</html>