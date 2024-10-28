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
            <form class="w-full" method="POST" id="mrpconfirmation" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1" id="STAFFCODE_TXT"><?=checklang('STAFFCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                </div> 


                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('IM_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="COSTTYPES" name="COSTTYPES" onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($COSTTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['COSTTYPES']) && $data['COSTTYPES'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1" id="OFFER_CODE_TXT"><?=checklang('OFFER_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="OFFERCODE" name="OFFERCODE" value="<?=isset($data['OFFERCODE']) ? $data['OFFERCODE']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHOFFER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="OFFERNAME" name="OFFERNAME" value="<?=isset($data['OFFERNAME']) ? $data['OFFERNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="radio" id="SD" name="radioGroup" value="SD" <?=!empty($data['radioGroup']) && $data['radioGroup'] == 'SD' ? 'checked' : '' ?>>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('START_DATE_PRODUCE')?></label>
                                        <input type="radio" id="TD" name="radioGroup" value="TD" <?=!empty($data['radioGroup']) && $data['radioGroup'] == 'TD' ? 'checked' : '' ?>>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('T_DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="DUEDATES" name="DUEDATES" value="<?=!empty($data['DUEDATES']) ? date('Y-m-d', strtotime($data['DUEDATES'])) : ''; ?>"/>
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

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[500px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 mrp" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STATUS')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NEED_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STARTDATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AS_REQUIRED')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEASURE_UNIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PURCHASE_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_COM_CODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_COM_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BRANCH_TYPE')?></span>
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
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['MRPSTATUS']) ? $value['MRPSTATUS']: '' ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center"><?=isset($value['DUEDATE']) ? $value['DUEDATE']: '' ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center"><?=isset($value['STARTDATE']) ? $value['STARTDATE']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['QTY']) ? $value['QTY']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMUNIT']) ? $UNIT[$value['ITEMUNIT']]: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['COSTTYPE']) ? $COSTTYPE[$value['COSTTYPE']]: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SUPPLIERCODE']) ? $value['SUPPLIERCODE']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['STORAGETYPE']) ? $STORAGETYPE[$value['STORAGETYPE']]: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['STORAGECODE']) ? $value['STORAGECODE']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['STORAGENAME']) ? $value['STORAGENAME']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['FACTYP']) ? $value['FACTYP']: '' ?></td>

                                    <input type="hidden" id="MRPSTATUS<?=$key?>" name="MRPSTATUS[]" value="<?=isset($value['MRPSTATUS']) ? $value['MRPSTATUS']: '' ?>"/>
                                    <input type="hidden" id="DUEDATE<?=$key?>" name="DUEDATE[]" value="<?=isset($value['DUEDATE']) ? $value['DUEDATE']: '' ?>"/>
                                    <input type="hidden" id="STARTDATE<?=$key?>" name="STARTDATE[]" value="<?=isset($value['STARTDATE']) ? $value['STARTDATE']: '' ?>"/>
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODE[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>"/>
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>"/>
                                    <input type="hidden" id="QTY<?=$key?>" name="QTY[]" value="<?=isset($value['QTY']) ? $value['QTY']: '' ?>"/>
                                    <input type="hidden" id="ITEMUNIT<?=$key?>" name="ITEMUNIT[]" value="<?=isset($value['ITEMUNIT']) ? $value['ITEMUNIT']: '' ?>"/>
                                    <input type="hidden" id="ITEMUNITSTR<?=$key?>" name="ITEMUNITSTR[]" value="<?=isset($value['ITEMUNITSTR']) ? $value['ITEMUNITSTR']: '' ?>"/>
                                    <input type="hidden" id="COSTTYPE<?=$key?>" name="COSTTYPE[]" value="<?=isset($value['COSTTYPE']) ? $value['COSTTYPE']: '' ?>"/>
                                    <input type="hidden" id="COSTTYPESTR<?=$key?>" name="COSTTYPESTR[]" value="<?=isset($value['COSTTYPESTR']) ? $value['COSTTYPESTR']: '' ?>"/>
                                    <input type="hidden" id="SUPPLIERCODE<?=$key?>" name="SUPPLIERCODE[]" value="<?=isset($value['SUPPLIERCODE']) ? $value['SUPPLIERCODE']: '' ?>"/>
                                    <input type="hidden" id="SUPPLIERNAME<?=$key?>" name="SUPPLIERNAME[]" value="<?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']: '' ?>"/>
                                    <input type="hidden" id="STORAGETYPE<?=$key?>" name="STORAGETYPE[]" value="<?=isset($value['STORAGETYPE']) ? $value['STORAGETYPE']: '' ?>"/>
                                    <input type="hidden" id="STORAGETYPESTR<?=$key?>" name="STORAGETYPESTR[]" value="<?=isset($value['STORAGETYPESTR']) ? $value['STORAGETYPESTR']: '' ?>"/>
                                    <input type="hidden" id="STORAGECODE<?=$key?>" name="STORAGECODE[]" value="<?=isset($value['STORAGECODE']) ? $value['STORAGECODE']: '' ?>"/>
                                    <input type="hidden" id="STORAGENAME<?=$key?>" name="STORAGENAME[]" value="<?=isset($value['STORAGENAME']) ? $value['STORAGENAME']: '' ?>"/>
                                    <input type="hidden" id="FACTYP<?=$key?>" name="FACTYP[]" value="<?=isset($value['FACTYP']) ? $value['FACTYP']: '' ?>"/>
                                    <input type="hidden" id="DVWID<?=$key?>" name="DVWID[]" value="<?=isset($value['DVWID']) ? $value['DVWID']: '' ?>"/>
                                    <input type="hidden" id="ODRPLAN<?=$key?>" name="ODRPLAN[]" value="<?=isset($value['ODRPLAN']) ? $value['ODRPLAN']: '' ?>"/>
                                    <input type="hidden" id="MRPSTATUSCD<?=$key?>" name="MRPSTATUSCD[]" value="<?=isset($value['MRPSTATUSCD']) ? $value['MRPSTATUSCD']: '' ?>"/>
                                    <input type="hidden" id="PROPLANORDERNO<?=$key?>" name="PROPLANORDERNO[]" value="<?=isset($value['PROPLANORDERNO']) ? $value['PROPLANORDERNO']: '' ?>"/>
                                    <input type="hidden" id="SEQ<?=$key?>" name="SEQ[]" value="<?=isset($value['SEQ']) ? $value['SEQ']: '' ?>"/>
                                    <input type="hidden" id="ITEMMASTERPLANFLG<?=$key?>" name="ITEMMASTERPLANFLG[]" value="<?=isset($value['ITEMMASTERPLANFLG']) ? $value['ITEMMASTERPLANFLG']: '' ?>"/>
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

                <div class="flex mb-1">
                    <div class="flex w-full px-2">
                        <input class="read" type="checkbox" id="MRPSUMFLG" name="MRPSUMFLG" value="T" checked>
                        <label class="text-color block text-sm w-5/12 pl-2 pt-1 text-gray-400"><?=checklang('MRP_MSG')?></label>
                        <input class="read" type="checkbox" id="MRPSUMFLG3" name="MRPSUMFLG3" value="T" checked>
                        <label class="text-color block text-sm w-5/12 pl-2 pt-1 text-gray-400"><?=checklang('MRP_MSG03')?></label>                     
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-full px-2">
                        <input class="read" type="checkbox" id="MRPSUMFLG2" name="MRPSUMFLG2" value="T" checked>
                        <label class="text-color block text-sm w-5/12 pl-2 pt-1 text-gray-400"><?=checklang('MRP_MSG02')?></label>
                        <input class="read" type="checkbox" id="MRPSUMFLG4" name="MRPSUMFLG4" value="T" checked>
                        <label class="text-color block text-sm w-5/12 pl-2 pt-1 text-gray-400"><?=checklang('MRP_MSG04')?></label>
                    </div>
                </div>
                        
                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="RUN" name="RUN"><?=checklang('RUN'); ?></button>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
    unRequired();
    let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
    const tablearea = document.getElementById('table-area');
    const details = document.querySelector('details');
    details.addEventListener('toggle', function() {
        if (!details.open) {
            tablearea.classList.remove('h-[500px]');
            tablearea.classList.add('h-[620px]');
            maxrow = 23;
        } else {
            tablearea.classList.remove('h-[620px]');
            tablearea.classList.add('h-[500px]');
            maxrow = 18;
        }
        emptyRows(maxrow);
    })

    $(document).on('click', '.mrp tbody tr', function(event) {
        $('table#table tbody tr').removeAttr('id');
        let item = $(this).closest('tr').children('td');
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            // console.log(item.eq(0).text());
            $(this).attr('id', 'selected-row');
        }
    });
});

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

function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
    if(code == 'OFFERCODE') {
        return getOffer(result, $('#COSTTYPES').val());
    } else {
        return getElement(code, result);    
    }
}

function validationDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=$lang['validation1']; ?>',
        showCancelButton: false,
        confirmButtonText:  '<?=$lang['yes']; ?>',
        cancelButtonText: '<?=$lang['no']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
          // 
        }
    });
}
</script>