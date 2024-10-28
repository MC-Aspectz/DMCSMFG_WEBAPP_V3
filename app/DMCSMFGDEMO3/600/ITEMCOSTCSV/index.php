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
            <form class="w-full" method="POST" action="" id="itemCostCSV" name="itemCostCSV" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary> 
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="ITEMCODE" id="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ITEMNAME" id="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input type="hidden" name="ITEMUNIT" id="ITEMUNIT" value="<?=isset($data['ITEMUNIT']) ? $data['ITEMUNIT']: ''; ?>" readonly/>
                                        <input type="hidden" name="COMBINATION" id="COMBINATION" value="<?=isset($data['COMBINATION']) ? $data['COMBINATION']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                       <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-2 text-gray-700 border-gray-300 read"
                                            name="ITEMSPEC" id="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                       <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            name="ITEMDRAWNUMBER" id="ITEMDRAWNUMBER" value="<?=isset($data['ITEMDRAWNUMBER']) ? $data['ITEMDRAWNUMBER']: ''; ?>" readonly/>
                                        <div class="w-3/12"></div>
                                    </div>
                                </div> 

                                <div class="flex mb-1 px-2 hidden">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INT_YEAR_MONTH')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="YEAR" name="YEAR">
                                                <option value=""></option>
                                                <?php foreach ($yearvalue as $yearkey2 => $yearitem2) { ?>
                                                    <option value="<?=$yearkey2 ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey2) ? 'selected' : '' ?>><?=$yearitem2 ?></option>
                                                <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="MONTH" name="MONTH">
                                                <option value=""></option>
                                                <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                                    <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                                <?php } ?>
                                        </select>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                            name="BOMDATE" id="BOMDATE" value="<?=!empty($data['BOMDATE']) ? date('Y-m-d', strtotime($data['BOMDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                    <div class="flex w-6/12"></div>
                                </div> 

                                <div class="flex mb-1">
                                     <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="COSTSC_TXT"><?=checklang('COSTSC')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 req" id="COSTSC" name="COSTSC" onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($costsc as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['COSTSC']) && $data['COSTSC'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="BMVERSION" name="BMVERSION">
                                            <option value=""></option>
                                            <?php foreach ($bmversion as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BMVERSION']) && $data['BMVERSION'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                   <div class="flex w-6/12 px-2 justify-end">
                                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                                id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
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

                <div id="table-area" class="overflow-scroll px-2 block h-[550px]">
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LEVEL')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BASEID')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RUNNER_WGT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REUSE_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PERCENT_DEFECTIVE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SRP_G')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SRP_U_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TCOST_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TBCOST_TYPE')?></span>
                                </th>
                                <th class="px-8 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BUILDUPDATE')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <!-- ITEMLEVEL,LITEMCODE,LITEMNAME,QTY,LITEMUNIT,BMSCRAPRATE,BMADDSRPG,BMADDSRPUNITPRC,COST_TYPE_01,COST_TYPE_02,COST_TYPE_03,COST_TYPE_04,COST_TYPE_05,COST_TYPE_06,COST_TYPE_07,COST_TYPE_08,COST_TYPE_09,TCOST_TYPE,TBCOST_TYPE,BUILDUPDATE,BMRUNNERWEIGHT,BMREUSERATE,BMBASETYP -->
                                <tr class="divide-y divide-gray-200 row-id csv" id="rowId<?=$key?>">
                                    <td class="hidden rowId"><?=$key ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ITEMLEVEL']) ? $value['ITEMLEVEL']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['LITEMCODE']) ? $value['LITEMCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['LITEMNAME']) ? $value['LITEMNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['BMBASETYP']) ? $value['BMBASETYP']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['QTY']) ? $value['QTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['LITEMUNIT']) ? optionValue($unit, $value['LITEMUNIT']): '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['BMRUNNERWEIGHT']) ? $value['BMRUNNERWEIGHT']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['BMREUSERATE']) ? $value['BMREUSERATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['BMSCRAPRATE']) ? $value['BMSCRAPRATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['BMADDSRPG']) ? $value['BMADDSRPG']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['BMADDSRPUNITPRC']) ? $value['BMADDSRPUNITPRC']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['TCOST_TYPE']) ? $value['TCOST_TYPE']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['TBCOST_TYPE']) ? $value['TBCOST_TYPE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['BUILDUPDATE']) ? $value['BUILDUPDATE']: '' ?></td>
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
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LEVEL') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="LEVEL"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCD') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCD"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNM') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNM"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('BASEID') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="BASEID"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('QUANTITY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="QUANTITY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('UNIT') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="UNIT"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('RUNNER_WGT') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="RUNNER_WGT"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REUSE_RATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="REUSE_RATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PERCENT_DEFECTIVE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PERCENT_DEFECTIVE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SRP_G') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SRP_G"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SRP_U_PRICE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SRP_U_PRICE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TCOST_TYPE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="TCOST_TYPE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TBCOST_TYPE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="TBCOST_TYPE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('BUILDUPDATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="BUILDUPDATE"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 14</div>
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
        unRequired();
        document.getElementById('DETAIL').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[550px]');
                tablearea.classList.add('h-[640px]');
                maxrow = 23;
            } else {
                tablearea.classList.remove('h-[640px]');
                tablearea.classList.add('h-[550px]');
                maxrow = 20;
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
            $('#LEVEL').html(item.eq(1).text());
            $('#ITEMCD').html(item.eq(2).text());
            $('#ITEMNM').html(item.eq(3).text());
            $('#BASEID').html(item.eq(4).text());
            $('#QUANTITY').html(item.eq(5).text());
            $('#UNIT').html(item.eq(6).text());
            $('#RUNNER_WGT').html(item.eq(7).text());
            $('#REUSE_RATE').html(item.eq(8).text());
            $('#PERCENT_DEFECTIVE').html(item.eq(9).text());
            $('#SRP_G').html(item.eq(10).text());
            $('#SRP_U_PRICE').html(item.eq(11).text());
            $('#TCOST_TYPE').html(item.eq(12).text());
            $('#TBCOST_TYPE').html(item.eq(13).text());
            $('#BUILDUPDATE').html(item.eq(14).text());

            document.getElementById('DETAIL').disabled = false;
        }
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getSearch(code, result, 'getItem');
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
