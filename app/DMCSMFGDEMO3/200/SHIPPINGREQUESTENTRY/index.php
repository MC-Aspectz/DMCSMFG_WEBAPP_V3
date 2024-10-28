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
            <form class="w-full" method="POST" action="" id="shipingRequestEntry" name="shipingRequestEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="SALEORDERNO" id="SALEORDERNO" value="<?=isset($data['SALEORDERNO']) ? $data['SALEORDERNO']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALENOSHIP">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-5/12 justify-end">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                            id="SHIPREQUESTSALEDATE" name="SHIPREQUESTSALEDATE" value="<?=!empty($data['SHIPREQUESTSALEDATE']) ? date('Y-m-d', strtotime($data['SHIPREQUESTSALEDATE'])): date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    name="SALEORDERCUSTOMERCODE" id="SALEORDERCUSTOMERCODE" value="<?=isset($data['SALEORDERCUSTOMERCODE']) ? $data['SALEORDERCUSTOMERCODE']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SALEORDERCUSTOMERSTAFF" id="SALEORDERCUSTOMERSTAFF" value="<?=isset($data['SALEORDERCUSTOMERSTAFF']) ? $data['SALEORDERCUSTOMERSTAFF']: ''; ?>" readonly/>
                                        <div class="w-6/12"></div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERADDRESS1" id="CUSTOMERADDRESS1" value="<?=isset($data['CUSTOMERADDRESS1']) ? $data['CUSTOMERADDRESS1']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERADDRESS2" id="CUSTOMERADDRESS2" value="<?=isset($data['CUSTOMERADDRESS2']) ? $data['CUSTOMERADDRESS2']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-5/12"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DELI_PLACE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="SALEORDERDELIVERYCODE" id="SALEORDERDELIVERYCODE" value="<?=isset($data['SALEORDERDELIVERYCODE']) ? $data['SALEORDERDELIVERYCODE']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DELIVERYNAME" id="DELIVERYNAME" value="<?=isset($data['DELIVERYNAME']) ? $data['DELIVERYNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SALEORDERDELIVERYSTAFF" id="SALEORDERDELIVERYSTAFF" value="<?=isset($data['SALEORDERDELIVERYSTAFF']) ? $data['SALEORDERDELIVERYSTAFF']: ''; ?>" readonly/>
                                        <div class="w-6/12"></div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="DELIVERYADDRESS1" id="DELIVERYADDRESS1" value="<?=isset($data['DELIVERYADDRESS1']) ? $data['DELIVERYADDRESS1']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DELIVERYADDRESS2" id="DELIVERYADDRESS2" value="<?=isset($data['DELIVERYADDRESS2']) ? $data['DELIVERYADDRESS2']: ''; ?>" readonly/>
                                    </div>
                                    <div class=" flex w-5/12 justify-end">
                                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center"        id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
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
                
                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[328px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
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
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMSPEC')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDERQTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_REQ_BALANCE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('THISSHIPQTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_DATE')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['ORDERQTY']) ? $value['ORDERQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['ORDERBALANCE']) ? $value['ORDERBALANCE']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="THISSHIPQTY_TD<?=$key?>"><?=isset($value['THISSHIPQTY']) ? $value['THISSHIPQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SHIPPEDDATE_TD<?=$key?>"><?=isset($value['SHIPREQUESTSHIPPEDDATE']) ? $value['SHIPREQUESTSHIPPEDDATE']: '' ?></td>
                                   
                                    <input type="hidden" id="ROWNO<?=$key?>" name="ROWNOZ[]" value="<?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?>"/>
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODEZ[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>"/>
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAMEZ[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>"/>
                                    <input type="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPECZ[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>"/>
                                    <input type="hidden" id="ORDERQTY<?=$key?>" name="ORDERQTYZ[]" value="<?=isset($value['ORDERQTY']) ? $value['ORDERQTY']: '' ?>"/>
                                    <input type="hidden" id="ORDERBALANCE<?=$key?>" name="ORDERBALANCEZ[]" value="<?=isset($value['ORDERBALANCE']) ? $value['ORDERBALANCE']: '' ?>"/>
                                    <input type="hidden" id="THISSHIPQTY<?=$key?>" name="THISSHIPQTYZ[]"  value="<?=isset($value['THISSHIPQTY']) ? $value['THISSHIPQTY']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQUESTSHIPPEDDATE<?=$key?>" name="SHIPREQUESTSHIPPEDDATEZ[]" value="<?=isset($value['SHIPREQUESTSHIPPEDDATE']) ? $value['SHIPREQUESTSHIPPEDDATE']: '' ?>"/>
                                    <input type="hidden" id="ITEMUNIT<?=$key?>" name="ITEMUNITZ[]" value="<?=isset($value['ITEMUNIT']) ? $value['ITEMUNIT']: '' ?>"/>
                                    <input type="hidden" id="LOCTYP<?=$key?>" name="LOCTYPZ[]" value="<?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?>"/>
                                    <input type="hidden" id="LOCCD<?=$key?>" name="LOCCDZ[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>"/>
                                    <input type="hidden" id="LOCNAME<?=$key?>" name="LOCNAMEZ[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>"/>
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

                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LINE');?></label>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ROWNO" name="ROWNO" readonly/>

                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DELIVERY_DATE');?></label>
                                    <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                            id="SHIPREQUESTSHIPPEDDATE" name="SHIPREQUESTSHIPPEDDATE" value="<?=!empty($data['SHIPREQUESTSHIPPEDDATE']) ? date('Y-m-d', strtotime($data['SHIPREQUESTSHIPPEDDATE'])) : ''; ?>"/>
                                </div>
                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ITEMCODE');?></label>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                            id="ITEMCODE" name="ITEMCODE" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                            id="ITEMNAME" name="ITEMNAME" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMSPEC" name="ITEMSPEC" readonly/>
                                    <input type="hidden" id="ORDERQTY" name="ORDERQTY"/>
                                    <input type="hidden" id="ORDERBALANCE" name="ORDERBALANCE"/>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SHIP_QTY');?></label>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-2 mr-1 text-[14px] text-gray-700 border-gray-300 text-right req"
                                            id="THISSHIPQTY" name="THISSHIPQTY" value="<?=isset($data['THISSHIPQTY']) ? $data['THISSHIPQTY']: ''; ?>" onchange="this.value = num2digit(this.value); unRequired();"
                                            oninput="this.value = stringReplacez(this.value);"/>
                                    <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-1/12 text-left rounded-xl border-gray-300 read"
                                            id="ITEMUNIT" name="ITEMUNIT">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                    </select>
                                    <label class="text-color block text-sm w-32 pt-1 text-center"><?=checklang('SOURCE_STORAGE');?></label>
                                    <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-40 mr-1 text-left rounded-xl border-gray-300"
                                            id="LOCTYP" name="LOCTYP">
                                            <option value=""></option>
                                            <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                    </select>
                                    <div class="relative w-2/12 mr-1">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                name="LOCCD" id="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>"/>
                                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                            id="SEARCHLOC">
                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                         name="LOCNAME" id="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>

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
        unRequired();
        document.getElementById('UPDATE').disabled = true;
        
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 12); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[328px]');
                tablearea.classList.add('h-[480px]');
                maxrow = 18;
            } else {
                tablearea.classList.remove('h-[480px]');
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
                    
                $('#ROWNO').val(index);
                $('#SHIPREQUESTSHIPPEDDATE').val(dashFormatDate($('#SHIPREQUESTSHIPPEDDATE'+index+'').val()));
                $('#ITEMCODE').val($('#ITEMCODE'+index+'').val());
                $('#ITEMNAME').val($('#ITEMNAME'+index+'').val());
                $('#ITEMSPEC').val($('#ITEMSPEC'+index+'').val());
                $('#ORDERQTY').val($('#ORDERQTY'+index+'').val());
                $('#ORDERBALANCE').val($('#ORDERBALANCE'+index+'').val());
                $('#THISSHIPQTY').val($('#THISSHIPQTY'+index+'').val());
                $('#ITEMUNIT').val($('#ITEMUNIT'+index+'').val());
                $('#LOCTYP').val($('#LOCTYP'+index+'').val());
                $('#LOCCD').val($('#LOCCD'+index+'').val());
                $('#LOCNAME').val($('#LOCNAME'+index+'').val());
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

    function chkQtyDialog() {
        return Swal.fire({ 
        title: '',
        text: '<?=lang('validation2');?>',
        showCancelButton: true,
        confirmButtonText: '<?=lang('yes');?>',
        cancelButtonText: '<?=lang('no');?>'
        }).then((result) => {
            if (!result.isConfirmed) {
                $('#THISSHIPQTY').val('');
                $('#ORDERBALANCE').val('');
            }
        });
    }
</script>
</html>