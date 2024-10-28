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
            <form class="w-full" method="POST" id="planView" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('FACTORYNAME')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="FACTORYCODE" name="FACTORYCODE" >
                                            <option value=""></option>
                                            <?php foreach ($factory as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req" 
                                                    id="ITEMCODE" name="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>" onchange="unRequired();"/>
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
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMDRAWNUMBER" name="ITEMDRAWNUMBER" value="<?=isset($data['ITEMDRAWNUMBER']) ? $data['ITEMDRAWNUMBER']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ONHAND_TXT"><?=checklang('ONHAND')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="ONHAND" name="ONHAND" value="<?=!empty($data['ONHAND']) ? number_format(str_replace(',', '',$data['ONHAND']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="AWAIT_TEST_TXT"><?=checklang('AWAIT_TEST')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="AWAIT_TEST" name="AWAIT_TEST" value="<?=!empty($data['AWAIT_TEST']) ? number_format(str_replace(',', '',$data['AWAIT_TEST']), 2): ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="INV_OF_ORDER_TXT"><?=checklang('INV_OF_ORDER')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="INV_OF_ORDER" name="INV_OF_ORDER" value="<?=!empty($data['INV_OF_ORDER']) ? number_format(str_replace(',', '',$data['INV_OF_ORDER']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="BACKLOG_TXT"><?=checklang('BACKLOG')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="BACKLOG" name="BACKLOG" value="<?=!empty($data['BACKLOG']) ? number_format(str_replace(',', '',$data['BACKLOG']), 2): ''; ?>" readonly/>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ALLOCATE_TXT"><?=checklang('ALLOCATE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="ALLOCATE" name="ALLOCATE" value="<?=!empty($data['ALLOCATE']) ? number_format(str_replace(',', '',$data['ALLOCATE']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="FIXED_ORDER_TXT"><?=checklang('FIXED_ORDER')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="ITEMORDERROT" name="ITEMORDERROT" value="<?=!empty($data['ITEMORDERROT']) ? number_format(str_replace(',', '',$data['ITEMORDERROT']), 2): ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="MIN_ORDER_TXT"><?=checklang('MIN_ORDER')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="ITEMORDERMINIMUMQUANTITY" name="ITEMORDERMINIMUMQUANTITY" value="<?=!empty($data['ITEMORDERMINIMUMQUANTITY']) ? number_format(str_replace(',', '',$data['ITEMORDERMINIMUMQUANTITY']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="BUFFER_STOCK_TXT"><?=checklang('BUFFER_STOCK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="ITEMMINIMUMQUANTITY" name="ITEMMINIMUMQUANTITY" value="<?=!empty($data['ITEMMINIMUMQUANTITY']) ? number_format(str_replace(',', '',$data['ITEMMINIMUMQUANTITY']), 2): ''; ?>" readonly/>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LEADTIME')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMLEADTIME" name="ITEMLEADTIME" value="<?=isset($data['ITEMLEADTIME']) ? $data['ITEMLEADTIME']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('DAY')?></label>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('PRDER_RULE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" id="ITEMORDERTRIGGER" name="ITEMORDERTRIGGER">
                                            <option value=""></option>
                                            <?php foreach ($itemorder as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMORDERTRIGGER']) && $data['ITEMORDERTRIGGER'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" id="ITEMUNIT" name="ITEMUNIT">
                                            <option value=""></option>
                                            <?php foreach ($unit as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="flex w-9/12 justify-end">
                                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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

                <div id="table-area" class="overflow-scroll block mx-2 h-[500px]"> 
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 pv" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUE_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('P_ITEMCODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AS_REQUIRED')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ALLOCATED_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('EFFECTIVE_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('START_DATE_PRODUCE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENT_DUE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $item) { ?>
                                <tr class="divide-y divide-gray-200 row-id csv" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=!empty($item['DUEDATE']) ?  $item['DUEDATE'] : '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['PARENTITEMCODE']) ? $item['PARENTITEMCODE'] : '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['ORDERNUMBER']) ? $item['ORDERNUMBER'] : '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($item['QTYIN']) ? $item['QTYIN'] : '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($item['QTYOUT']) ? $item['QTYOUT'] : '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($item['TOTAL']) ? $item['TOTAL'] : '' ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center"><?=isset($item['STARTDATE']) ? $item['STARTDATE'] : '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=!empty($item['PRODUCTIONPLANTYPE']) ? $PRODUCTIONPLANTYPE[$item['PRODUCTIONPLANTYPE']] : '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['CURDUEDATE']) ? $item['CURDUEDATE'] : '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['SPACE']) ? $item['SPACE'] : '' ?></td>
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
                                onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['no']; ?>');"><?=checklang('END'); ?></button>
                        <button type="button" id="BACK" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 hidden" onclick="return back();"><?=checklang('BACK'); ?></button>
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
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DUE_DATE'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="DUEDATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('P_ITEMCODE'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PARENTITEMCODE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ORDER_NO'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ORDERNUMBER"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('AS_REQUIRED'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="QTYIN"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ALLOCATED_QTY'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="QTYOUT"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('EFFECTIVE_QTY'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="TOTAL"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('START_DATE_PRODUCE'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STARTDATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REMARK'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PRODUCTIONPLANTYPE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENT_DUE'); ?></th>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="CURDUEDATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 10</div>
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
        unRequired();
        document.getElementById('DETAIL').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 19); ?>';
        const tablearea = document.getElementById('table-area');
        const details = document.querySelector('details');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[500px]');
                tablearea.classList.add('h-[670px]');
                maxrow = 25;
            } else {
                tablearea.classList.remove('h-[670px]');
                tablearea.classList.add('h-[500px]');
                maxrow = 19;
            }
            emptyRows(maxrow);
        })

        let actionz = '<?php echo (!empty($_POST['action']) ? $_POST['action'] : ''); ?>';
        // console.log(actionz);
        document.getElementById('BACK').classList[actionz == 'PRODUCTIONPLAN' ? 'remove' : 'add']('hidden');
        document.getElementById('SEARCH').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('hidden');
        document.getElementById('CLEAR').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('hidden');
        document.getElementById('END').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('hidden');
        document.getElementById('FACTORYCODE').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('read');
        document.getElementById('ITEMCODE').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('read');
        document.getElementById('SEARCHITEM').classList[actionz == 'PRODUCTIONPLAN' ? 'add' : 'remove']('read');
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);    
    }
</script>