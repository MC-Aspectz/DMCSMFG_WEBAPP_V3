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
            <form class="w-full" method="POST" id="inqProductionOrder" name="inqProductionOrder" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PROD_DUEDATE_TXT"><?=checklang('PROD_DUEDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P2" name="P2" value="<?=!empty($data['P2']) ? date('Y-m-d', strtotime($data['P2'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center" id="ARROW_TXT"><?=checklang('ARROW')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P3"name="P3"  value="<?=!empty($data['P3']) ? date('Y-m-d', strtotime($data['P3'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('FACTORYNAME')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="FACTYP" name="FACTYP" >
                                            <option value=""></option>
                                            <?php foreach ($factory as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTYP']) && $data['FACTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="STATUS" name="STATUS">
                                            <option value=""></option>
                                            <?php foreach ($statusorder as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['STATUS']) && $data['STATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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
         
                <div id="table-area" class="overflow-scroll block h-[496px] mx-2"> 
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200 poinq" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCTIONORDER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_DATE')?></span>
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
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FACTORYNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_CENTER_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFFCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REFERENCE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCD')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME')?></span>
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
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_AMOUNT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MYCURRENCY_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPECTION')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLAN_START_DATE')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROD_DUEDATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGETYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACT_START_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LAST_SHIP_DATE')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCT_ORDER_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TOTAL_PROD_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STATUS')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $item) { ?>
                                <tr class="divide-y divide-gray-200 row-id csv" id="rowId<?=$key?>" style="background-color: <?=$item['SYSROWCOLOR'];?>">
                                    <td class="hidden rowId"><?=$key; // $key+1?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROORDERNO'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=!empty($item['PROISSUEDT']) ? date_format(date_create_from_format('Y-m-d', str_replace("/", "-", $item['PROISSUEDT'])), 'd/m/Y'): ''  ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROITEMCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['PROITEMNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['PROITEMSPEC'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset( $item['PROFACTYP']) ? optionValue($factory, $item['PROFACTYP']) : ''; ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROWCCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['WCNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROSTAFFCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['STAFFNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROSALENOLN'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['SALECUSCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['CUSTOMERNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['SALEDLVCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['DELIVERYNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['SALELNITEMCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNITEMNAME'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNITEMSPEC'] ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['SALELNQTY'] ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['SALELNUNITPRC'] ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['SALELNAMT'] ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=$item['CUSTOMERCURCD'] ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['SALELNEXAMT'] ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=$item['COMCURRENCY'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset( $item['PROFACTYP']) ? optionValue($inspection, $item['PROINSPTYP']) : ''; ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=!empty($item['PROPLANSTARTDT']) ? date_format(date_create_from_format('Y-m-d', str_replace("/", "-", $item['PROPLANSTARTDT'])), 'd/m/Y'): ''  ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=!empty($item['PROPLANENDDT']) ? date_format(date_create_from_format('Y-m-d', str_replace("/", "-", $item['PROPLANENDDT'])), 'd/m/Y'): ''  ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset( $item['PROFACTYP']) ? optionValue($storagetype, $item['PROLOCTYP']) : ''; ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=$item['PROLOCCD'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=!empty($item['PROSTARTDT']) ? date_format(date_create_from_format('Y-m-d', str_replace("/", "-", $item['PROSTARTDT'])), 'd/m/Y'): ''  ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=!empty($item['PROENDDT']) ? date_format(date_create_from_format('Y-m-d', str_replace("/", "-", $item['PROENDDT'])), 'd/m/Y'): ''  ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['PROQTY'] ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=$item['PROCOMPQTY'] ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset( $item['PROFACTYP']) ? optionValue($statusorder, $item['PROSTATUS']) : ''; ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['PROREM'] ?></td>
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
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRODUCTIONORDER') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="PRODUCTIONORDER"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INPUT_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="INPUT_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCODE1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SPECIFICATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SPECIFICATE1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('FACTORYNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="FACTORYNAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WC_CODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="WC_CODE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WORK_CENTER_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="WORK_CENTER_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STAFFCODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STAFFCODE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STAFF_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STAFF_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REFERENCE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="REFERENCE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERCD') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERCD"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERNAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELE_PLACE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELE_PLACE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELE_PLACE_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELE_PLACE_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCODE2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SPECIFICATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SPECIFICATE2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_PRICE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_PRICE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_AMOUNT') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_AMOUNT"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENCY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CURRENCY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('MYCURRENCY_PRICE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="MYCURRENCY_PRICE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENCY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CURRENCY1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INSPECTION') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPECTION"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PLAN_START_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="PLAN_START_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PROD_DUEDATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="PROD_DUEDATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STORAGETYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGETYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LO_CODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="LO_CODE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ACT_START_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ACT_START_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LAST_SHIP_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="LAST_SHIP_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRODUCT_ORDER_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="PRODUCT_ORDER_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TOTAL_PROD_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TOTAL_PROD_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STATUS') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STATUS1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REMARK') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="REMARK"></td>
                    </tr>
                </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 35</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
</html>
<script src="./js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('DETAIL').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[496px]');
                tablearea.classList.add('h-[596px]');
                maxrow = 22;
            } else {
                tablearea.classList.remove('h-[596px]');
                tablearea.classList.add('h-[496px]');
                maxrow = 18;
            }
            emptyRows(maxrow);
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);    
    }
</script>