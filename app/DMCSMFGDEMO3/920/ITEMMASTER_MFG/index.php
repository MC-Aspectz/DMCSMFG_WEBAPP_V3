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
        <main class="flex flex-1 overflow-hidden paragraph px-2">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">            
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="itemmastermfg" name="itemmastermfg" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <div class="flex py-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-lg font-bold"><?=$appname;?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm font-bold px-5 py-1 text-center me-2"
                            id="END" name="END" onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=lang('close')?>&nbsp;[X]</button>
                    </div>
                </div>

                <div class="flex w-full h-full">
                    <!-- Side Search -->
                    <aside class="w-[50%] h-[95%] mx-1 overflow-y-auto rounded shadow-sm border-2 border-gray-200 left-side-<?=$appcode?>">
                        <button type="button" class="p-1" id="left-side" onclick="javascript:toggleSideForm('<?=$appcode?>', 'left');">
                            <svg class="fill-current opacity-75 w-6 h-6 -mr-1 rotate-0" viewBox="0 0 256 512">
                                <path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"></path>
                            </svg>
                        </button> 

                        <div class="p-2 align-middle">
                            <details id="search-condition" class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('searchcondition')?></summary>
                                <div class="left-size">
                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                               type="text" id="SEARCHITEMCD1" name="SEARCHITEMCD1" value="<?=isset($data['SEARCHITEMCD1']) ? $data['SEARCHITEMCD1']: ''?>"/>&ensp;→&ensp;
                                        <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                               type="text" id="SEARCHITEMCD2" name="SEARCHITEMCD2" value="<?=isset($data['SEARCHITEMCD2']) ? $data['SEARCHITEMCD2']: ''?>"/>
                                    </div>

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="ITEMNAME_TXT"><?=checklang('ITEMNAME')?></label>
                                        <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                               type="text" id="SEARCHITEMNAME" name="SEARCHITEMNAME" value="<?=isset($data['SEARCHITEMNAME']) ? $data['SEARCHITEMNAME']: ''?>"/>
                                    </div>

                                    <div class="flex mb- hidden">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="IM_TYPE_TXT"><?=checklang('IM_TYPE')?></label>
                                        <select class="text-control shadow-sm border h-7 w-3/12 px-3 text-[12px] rounded-xl border-gray-300" id="SEARCHITEMTYPE" name="SEARCHITEMTYPE">
                                            <option value=""></option>
                                            <?php foreach ($ITEM_TYPE as $key => $item) { ?>
                                                <option value="<?=$key?>" <?=(isset($data['SEARCHITEMTYPE']) && $data['SEARCHITEMTYPE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="flex mb-1 hidden">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="CATEGORY_CODE_TXT"><?=checklang('CATEGORY_CODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SEARCHITEMCATCD" name="SEARCHITEMCATCD" value="<?=isset($data['SEARCHITEMCATCD']) ? $data['SEARCHITEMCATCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCATALOGS">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="SEARCHITEMCATNAME" name="SEARCHITEMCATNAME" value="<?=isset($data['SEARCHITEMCATNAME']) ? $data['SEARCHITEMCATNAME']: ''; ?>" readonly/>
                                        <div class="flex w-3/12"></div>
                                    </div>

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="STRAGE_CODE_TXT"><?=checklang('STRAGE_CODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SEARCHITEMSTORAGECD" name="SEARCHITEMSTORAGECD" value="<?=isset($data['SEARCHITEMSTORAGECD']) ? $data['SEARCHITEMSTORAGECD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTORAGES">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="SEARCHITEMSTORAGENAME" name="SEARCHITEMSTORAGENAME" value="<?=isset($data['SEARCHITEMSTORAGENAME']) ? $data['SEARCHITEMSTORAGENAME']: ''; ?>" readonly/>
                                        <div class="flex w-3/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex justify-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-3xl text-sm font-medium w-9/12 py-0.5"
                                                    id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2 mt-0.5" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>

                        <div id="table-search-area" class="overflow-scroll block mx-2 h-[66%]"> 
                            <table id="table-search" class="w-full border-collapse border border-slate-500 divide-gray-200 tb-search" rules="cols" cellpadding="3" cellspacing="1">
                                <thead class="sticky top-0 bg-gray-50">
                                    <tr class="border border-gray-600 csv">
                                        <th class="hidden"></th>
                                        <th class="px-6 text-center border border-slate-700 text-left">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE'); ?></span>
                                        </th>
                                        <th class="px-16 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DRAWING'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('IM_TYPE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATEGORY_NAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BOI_TYPE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STRAGE_CODE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEASURE_UNIT'); ?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="searchdetail" class="divide-y divide-gray-200"><?php
                                    if(!empty($data['SEARCHITEM'])) { $minsearchrow = count($data['SEARCHITEM']);
                                        foreach($data['SEARCHITEM'] as $key => $value) { ?>
                                        <tr class="divide-y divide-gray-200 cursor-pointer search-id csv" id="searchrow<?=$key?>">
                                            <td class="hidden search-seq"><?=$key ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMCD_TD<?=$key?>"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD<?=$key?>"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMSPEC_TD<?=$key?>"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMDRAWNO_TD<?=$key?>"><?=isset($value['ITEMDRAWNO']) ? $value['ITEMDRAWNO']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMTYPNAME_TD<?=$key?>"><?=isset($value['ITEMTYPNAME']) ? $value['ITEMTYPNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CATALOGNAME_TD<?=$key?>"><?=isset($value['CATALOGNAME']) ? $value['CATALOGNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMBOI_TD<?=$key?>"><?=isset($value['ITEMBOI']) ? $value['ITEMBOI']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="STORAGENAME_TD<?=$key?>"><?=isset($value['STORAGENAME']) ? $value['STORAGENAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMUNITTYP_TD<?=$key?>"><?=isset($value['ITEMUNITTYPDISP']) ? $value['ITEMUNITTYPDISP']: '' ?></td>
  
                                            <input type="hidden" id="ITEMCD<?=$key?>" value="<?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?>">
                                            <input type="hidden" id="ITEMNAME<?=$key?>" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>">
                                            <input type="hidden" id="ITEMSPEC<?=$key?>" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>">
                                            <input type="hidden" id="ITEMDRAWNO<?=$key?>" value="<?=isset($value['ITEMDRAWNO']) ? $value['ITEMDRAWNO']: '' ?>">
                                            <input type="hidden" id="ITEMTYPNAME<?=$key?>" value="<?=isset($value['ITEMTYPNAME']) ? $value['ITEMTYPNAME']: '' ?>">
                                            <input type="hidden" id="CATALOGCD<?=$key?>" value="<?=isset($value['CATALOGCD']) ? $value['CATALOGCD']: '' ?>">
                                            <input type="hidden" id="CATALOGNAME<?=$key?>" value="<?=isset($value['CATALOGNAME']) ? $value['CATALOGNAME']: '' ?>">
                                            <input type="hidden" id="ITEMBOI<?=$key?>" value="<?=isset($value['ITEMBOI']) ? $value['ITEMBOI']: '' ?>">
                                            <input type="hidden" id="STORAGENAME<?=$key?>" value="<?=isset($value['STORAGENAME']) ? $value['STORAGENAME']: '' ?>">
                                            <input type="hidden" id="ITEMUNITTYPDISP<?=$key?>" value="<?=isset($value['ITEMUNITTYPDISP']) ? $value['ITEMUNITTYPDISP']: '' ?>">
                                            <input type="hidden" id="ITEMSEARCH<?=$key?>" value="<?=isset($value['ITEMSEARCH']) ? $value['ITEMSEARCH']: '' ?>">
                                            <input type="hidden" id="ITEMTYP<?=$key?>" value="<?=isset($value['ITEMTYP']) ? $value['ITEMTYP']: '' ?>">
                                            <input type="hidden" id="MATERIALCD<?=$key?>" value="<?=isset($value['MATERIALCD']) ? $value['MATERIALCD']: '' ?>">
                                            <input type="hidden" id="MATERIALNAME<?=$key?>" value="<?=isset($value['MATERIALNAME']) ? $value['MATERIALNAME']: '' ?>">
                                            <input type="hidden" id="ITEMWHTTYP<?=$key?>" value="<?=isset($value['ITEMWHTTYP']) ? $value['ITEMWHTTYP']: '' ?>">
                                            <input type="hidden" id="ITEMUNITTYP<?=$key?>" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>">
                                            <input type="hidden" id="ITEMORDRULETYP<?=$key?>" value="<?=isset($value['ITEMORDRULETYP']) ? $value['ITEMORDRULETYP']: '' ?>">
                                            <input type="hidden" id="ITEMPOUNITTYP<?=$key?>" value="<?=isset($value['ITEMPOUNITTYP']) ? $value['ITEMPOUNITTYP']: '' ?>">
                                            <input type="hidden" id="SUPPLIERCD<?=$key?>" value="<?=isset($value['SUPPLIERCD']) ? $value['SUPPLIERCD']: '' ?>">
                                            <input type="hidden" id="SUPPLIERNAME<?=$key?>" value="<?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']: '' ?>">
                                            <input type="hidden" id="WCCD<?=$key?>" value="<?=isset($value['WCCD']) ? $value['WCCD']: '' ?>">
                                            <input type="hidden" id="WCNAME<?=$key?>" value="<?=isset($value['WCNAME']) ? $value['WCNAME']: '' ?>">
                                            <input type="hidden" id="STORAGECD<?=$key?>" value="<?=isset($value['STORAGECD']) ? $value['STORAGECD']: '' ?>">
                                            <input type="hidden" id="ITEMLEADTIME<?=$key?>" value="<?=isset($value['ITEMLEADTIME']) ? $value['ITEMLEADTIME']: '' ?>">
                                            <input type="hidden" id="ITEMINVPRICE<?=$key?>" value="<?=isset($value['ITEMINVPRICE']) ? $value['ITEMINVPRICE']: '' ?>">
                                            <input type="hidden" id="ITEMSTDPURPRICE<?=$key?>" value="<?=isset($value['ITEMSTDPURPRICE']) ? $value['ITEMSTDPURPRICE']: '' ?>">
                                            <input type="hidden" id="ITEMSHOPPRICE<?=$key?>" value="<?=isset($value['ITEMSHOPPRICE']) ? $value['ITEMSHOPPRICE']: '' ?>">
                                            <input type="hidden" id="ITEMFIXORDER<?=$key?>" value="<?=isset($value['ITEMFIXORDER']) ? $value['ITEMFIXORDER']: '' ?>">
                                            <input type="hidden" id="ITEMMINORDER<?=$key?>" value="<?=isset($value['ITEMMINORDER']) ? $value['ITEMMINORDER']: '' ?>">
                                            <input type="hidden" id="ITEMMINSTOCK<?=$key?>" value="<?=isset($value['ITEMMINSTOCK']) ? $value['ITEMMINSTOCK']: '' ?>">
                                            <input type="hidden" id="ITEMINVCALCTYP<?=$key?>" value="<?=isset($value['ITEMINVCALCTYP']) ? $value['ITEMINVCALCTYP']: '' ?>">
                                            <input type="hidden" id="ITEMSTDSALEPRICE<?=$key?>" value="<?=isset($value['ITEMSTDSALEPRICE']) ? $value['ITEMSTDSALEPRICE']: '' ?>">
                                            <input type="hidden" id="ITEMMAKERTYP<?=$key?>" value="<?=isset($value['ITEMMAKERTYP']) ? $value['ITEMMAKERTYP']: '' ?>">
                                            <input type="hidden" id="ITEMSTDSUPPLYPRICE<?=$key?>" value="<?=isset($value['ITEMSTDSUPPLYPRICE']) ? $value['ITEMSTDSUPPLYPRICE']: '' ?>">
                                            <input type="hidden" id="ITEMCOSTTYP<?=$key?>" value="<?=isset($value['ITEMCOSTTYP']) ? $value['ITEMCOSTTYP']: '' ?>">
                                            <input type="hidden" id="ITEMPACKTYP<?=$key?>" value="<?=isset($value['ITEMPACKTYP']) ? $value['ITEMPACKTYP']: '' ?>">
                                            <input type="hidden" id="ITEMORDERUNIT<?=$key?>" value="<?=isset($value['ITEMORDERUNIT']) ? $value['ITEMORDERUNIT']: '' ?>">
                                            <input type="hidden" id="ITEMWEIGHT<?=$key?>" value="<?=isset($value['ITEMWEIGHT']) ? $value['ITEMWEIGHT']: '' ?>">
                                            <input type="hidden" id="ITEMCLEARANCETYP<?=$key?>" value="<?=isset($value['ITEMCLEARANCETYP']) ? $value['ITEMCLEARANCETYP']: '' ?>">
                                            <input type="hidden" id="ITEMSTOPDT<?=$key?>" value="<?=isset($value['ITEMSTOPDT']) ? $value['ITEMSTOPDT']: '' ?>">
                                            <input type="hidden" id="ITEMQTYINCASE<?=$key?>" value="<?=isset($value['ITEMQTYINCASE']) ? $value['ITEMQTYINCASE']: '' ?>">
                                            <input type="hidden" id="ITEMFIFOLISTFLG<?=$key?>" value="<?=isset($value['ITEMFIFOLISTFLG']) ? $value['ITEMFIFOLISTFLG']: '' ?>">
                                            <input type="hidden" id="ITEMPHANTOMFLG<?=$key?>" value="<?=isset($value['ITEMPHANTOMFLG']) ? $value['ITEMPHANTOMFLG']: '' ?>">
                                            <input type="hidden" id="ITEMINVFLG<?=$key?>" value="<?=isset($value['ITEMINVFLG']) ? $value['ITEMINVFLG']: '' ?>">
                                            <input type="hidden" id="ITEMMASTERPLANFLG<?=$key?>" value="<?=isset($value['ITEMMASTERPLANFLG']) ? $value['ITEMMASTERPLANFLG']: '' ?>">
                                            <input type="hidden" id="ITEMSERIALLFLG<?=$key?>" value="<?=isset($value['ITEMSERIALLFLG']) ? $value['ITEMSERIALLFLG']: '' ?>">
                                            <input type="hidden" id="ITEMIMGLOC<?=$key?>" value="<?=isset($value['ITEMIMGLOC']) ? $value['ITEMIMGLOC']: '' ?>">
                                            <input type="hidden" id="ITEMIMGPREVIEW<?=$key?>" value="<?=isset($value['ITEMIMGPREVIEW']) ? $value['ITEMIMGPREVIEW']: '' ?>">
                                            <input type="hidden" id="SYSEN_ITEMCD<?=$key?>" value="<?=isset($value['SYSEN_ITEMCD']) ? $value['SYSEN_ITEMCD']: '' ?>">
                                        </tr><?php 
                                        }
                                    }
                                    for ($i = $minsearchrow+1; $i <= $maxsearchrow; $i++) { ?>
                                        <tr class="divide-y divide-gray-200 row-empty" id="searchrow<?=$i?>">
                                            <td class="hidden search-seq"><?=$i;?></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex p-2">
                            <div class="flex w-6/12">
                                <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowCountSearch" ><?=$minsearchrow ?></span></label>
                            </div>
                            <div class="flex w-6/12 justify-end">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm font-bold px-5 py-0.5 text-center me-2"
                                    id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                            </div>
                        </div>
                    </aside>

                    <!-- Content Page -->
                    <aside class="w-[50%] h-[95%] mx-1 rounded shadow-sm border-2 border-gray-200 right-side-<?=$appcode?>">
                        <button type="button" class="p-1" id="right-side" onclick="javascript:toggleSideForm('<?=$appcode?>', 'right');">
                            <svg class="fill-current opacity-75 w-6 h-6 transition-all duration-300 rotate-0" viewBox="0 0 256 512">
                                <path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"></path>
                            </svg>
                        </button> 

                        <div class="flex px-4">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="NEW" name="NEW" onclick="newMode();"><?=checklang('NEW'); ?></button>
                            <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="SEARCHBOI" name="SEARCHBOI"><?=checklang('CLONE'); ?></button> -->
                        </div>

                        <div class="flex px-6 my-2">
                            <div class="right-size flex w-full">
                                <label class="text-color block text-sm font-semibold w-3/12 pl-4 pt-1"><?=checklang('ITEMCODE')?></label>
                                <div class="relative w-3/12 mx-2">
                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                            id="ITEMCD" name="ITEMCD" value="" oninput="upperCase(this)" onchange="unRequired();" require/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none hidden"
                                        id="SEARCHITEM">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300"
                                        id="ITEMNAME" name="ITEMNAME" value=""/>
                            </div>
                        </div>

                        <article class="w-full max-h-[80%] overflow-y-auto px-2" id="form_data">
                            <input type="hidden" id="ROWNO" name="ROWNO" value="">
                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupitem')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SEARCH_CHAR')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   type="text" id="ITEMSEARCH" name="ITEMSEARCH" value="" onchange="unRequired();" required/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SPECIFICATE')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   type="text" id="ITEMSPEC" name="ITEMSPEC" value=""/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DRAWING')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   type="text" id="ITEMDRAWNO" name="ITEMDRAWNO" value=""/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('MATERIALCODE')?></label>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="MATERIALCD" name="MATERIALCD" value="" />
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHMATERIAL">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="MATERIALNAME" name="MATERIALNAME" value="" readonly/>
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('grouptype')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('BOI_TYPE')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMBOI" name="ITEMBOI">
                                                <option value=""></option>
                                                <?php foreach ($BOI_TYPE as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('IM_TYPE')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMTYP" name="ITEMTYP" onchange="unRequired();" required>
                                                <option value=""></option>
                                                <?php foreach ($ITEM_TYPE as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CATEGORY_CODE')?></label>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="CATALOGCD" name="CATALOGCD" value="" onchange="unRequired();" required/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHCATALOG">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="CATALOGNAME" name="CATALOGNAME" value="" readonly/>
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupunit')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <!-- Unit of Measure -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('MEASURE_UNIT')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMUNITTYP" name="ITEMUNITTYP" onchange="unRequired();" required>
                                                <option value=""></option>
                                                <?php foreach ($UNIT as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Unit of Measure -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Packaging -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('TYPE_PACK')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMPACKTYP" name="ITEMPACKTYP">
                                                <option value=""></option>
                                                <?php foreach ($PACKAGE_TYPE as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Packaging -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Capacity -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CAPACITY')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMQTYINCASE" name="ITEMQTYINCASE" value=""
                                                    onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <!-- Capacity -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Unit Weight -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('UNIT_WEIGHT')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMWEIGHT" name="ITEMWEIGHT" value=""
                                                   onchange="this.value = numberWithComma(this.value);" oninput="this.value = stringReplacez(this.value);" />
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=checklang('KG'); ?></label>
                                            <!-- Unit Weight -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('grouppurchase')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_CODE')?></label>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="SUPPLIERCD" name="SUPPLIERCD" value=""/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHSUPPLIER">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="SUPPLIERNAME" name="SUPPLIERNAME" value="" readonly/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Order Policy -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PRDER_RULE')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMORDRULETYP" name="ITEMORDRULETYP" onchange="unRequired();" required>
                                                <option value=""></option>
                                                <?php foreach ($ITEM_ORDER as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Order Policy -->
                                        </div>

                                       <div class="flex mb-1 pl-4">
                                            <!-- Order Multiple -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('FIXED_ORDER')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMFIXORDER" name="ITEMFIXORDER" value=""
                                                    onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <!-- Order Multiple -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Minium Order -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('MIN_ORDER')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMMINORDER" name="ITEMMINORDER" value=""
                                                    onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <!-- Minium Order -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Lead Time -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('LEADTIME')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMLEADTIME" name="ITEMLEADTIME" value=""
                                                   onchange="this.value = numberWithComma(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);" required/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=checklang('DAYS'); ?></label>
                                            <!-- Lead Time -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Po Unit -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PO_UNIT')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMPOUNITTYP" name="ITEMPOUNITTYP">
                                                <option value=""></option>
                                                <?php foreach ($UNIT as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" id="ITEMPOUNITRATE" name="ITEMPOUNITRATE" value=""/>
                                            <!-- Po Unit -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Purchase Price -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PURCHASE_PRICE')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMSTDPURPRICE" name="ITEMSTDPURPRICE" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?></label>
                                            <!-- Purchase Price -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Supply Price -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SUPPLY_PRICE')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right" type="text"
                                                   id="ITEMSTDSUPPLYPRICE" name="ITEMSTDSUPPLYPRICE" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?></label>
                                            <!-- Supply Price -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                             <!-- Manufacturer -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('MAKER_CODE')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMMAKERTYP" name="ITEMMAKERTYP">
                                                <option value=""></option>
                                                <?php foreach ($MAKER as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Manufacturer -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupsale')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <!-- Selling Price -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SALES_PRICE')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMSHOPPRICE" name="ITEMSHOPPRICE" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?></label>
                                            <!-- Selling Price -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Retail Price -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SHOP_PRICE')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMSTDSALEPRICE" name="ITEMSTDSALEPRICE" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?></label>
                                            <!-- Retail Price -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                             <!-- Sale End Date -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('STOP_ORDER')?></label>
                                            <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                    id="ITEMSTOPDT" name="ITEMSTOPDT" value=""/>
                                            <!-- Sale End Date -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Withholding Tax Type -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('WHTAXTYP')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMWHTTYP" name="ITEMWHTTYP">
                                                <option value=""></option>
                                                <?php foreach ($WHTAXTYP as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Withholding Tax Type -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupinventory')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('STRAGE_CODE')?></label>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="STORAGECD" name="STORAGECD" value="" onchange="unRequired();" required/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHSTORAGE">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="STORAGENAME" name="STORAGENAME" value="" readonly/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Withholding Tax Type -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('INVCALCTYP')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMINVCALCTYP" name="ITEMINVCALCTYP">
                                                <option value=""></option>
                                                <?php foreach ($INVCALC_TYPE as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Withholding Tax Type -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Buffer Stock -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('BUFFER_STOCK')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMMINSTOCK" name="ITEMMINSTOCK" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <!-- Buffer Stock -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Order Point -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ORDER_POINT')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMORDERUNIT" name="ITEMORDERUNIT" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <!-- Order Point -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Inventory Valuation -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('UNITPRICE_INV')?></label>
                                            <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                   type="text" id="ITEMINVPRICE" name="ITEMINVPRICE" value=""
                                                   onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?></label>
                                            <!-- Inventory Valuation -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Stocktake Freq. -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CLEARANCE_ID')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMCLEARANCETYP" name="ITEMCLEARANCETYP" onchange="unRequired();">
                                                <option value=""></option>
                                                <?php foreach ($CLEARANCE as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Stocktake Freq. -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupworkcenter')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <!-- Work Center -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                                            <div class="relative w-3/12 mr-1">
                                                <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="WCCD" name="WCCD" value=""/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHWORKCENTER">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                    id="WCNAME" name="WCNAME" value="" readonly/>
                                            <!-- Work Center -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Cost Option -->
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('COST_TYPE')?></label>
                                            <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300" id="ITEMCOSTTYP" name="ITEMCOSTTYP">
                                                <option value=""></option>
                                                <?php foreach ($COST_NAME as $key => $item) { ?>
                                                    <option value="<?=$key?>"><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- Cost Option -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('gruopcheckbox')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <!-- FIFO List -->
                                            <input type="hidden" name="ITEMFIFOLISTFLG" value="F"/>
                                            <input type="checkbox" id="ITEMFIFOLISTFLG" name="ITEMFIFOLISTFLG" value="T"/>
                                            <label class="text-color block text-sm font-normal w-10/12 pl-4 pt-1"><?=checklang('FIFO_LIST')?></label>
                                            <!-- FIFO List -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Phantom Item -->
                                            <input type="hidden" name="ITEMPHANTOMFLG" value="F"/>
                                            <input type="checkbox" id="ITEMPHANTOMFLG" name="ITEMPHANTOMFLG" value="T"/>
                                            <label class="text-color block text-sm font-normal w-10/12 pl-4 pt-1"><?=checklang('PHANTOM')?></label>
                                            <!-- Phantom Item -->
                                        </div>
                     
                                        <div class="flex mb-1 pl-4">
                                            <!-- No Inventory Control -->
                                            <input type="hidden" name="ITEMINVFLG" value="F"/>
                                            <input type="checkbox" id="ITEMINVFLG" name="ITEMINVFLG" value="T"/>
                                            <label class="text-color block text-sm font-normal w-10/12 pl-4 pt-1"><?=checklang('NO_INVENTRY')?></label>
                                            <!-- No Inventory Control -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Manufacturing Plan -->
                                            <input type="hidden" name="ITEMMASTERPLANFLG" value="F"/>
                                            <input type="checkbox" id="ITEMMASTERPLANFLG" name="ITEMMASTERPLANFLG" value="T"/>
                                            <label class="text-color block text-sm font-normal w-10/12 pl-4 pt-1"><?=checklang('MASTER_PLAN_ITEM')?></label>
                                            <!-- Manufacturing Plan -->
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <!-- Serial No. Control -->
                                            <input type="hidden" name="ITEMSERIALLFLG" value="F"/>
                                            <input type="checkbox" id="ITEMSERIALLFLG" name="ITEMSERIALLFLG" value="T"/>
                                            <label class="text-color block text-sm font-normal w-10/12 pl-4 pt-1"><?=checklang('SERIAL_CONTROL')?></label>
                                            <!-- Serial No. Control -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupimage')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <!-- Item Image -->
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('IMAGE')?></label>
                                            <input type="file" class="block w-9/12 text-sm text-slate-500 file:py-2 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                                file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" id="ITEMIMGLOC" name="ITEMIMGLOC" value="<?=isset($data['ITEMIMGLOC']) ? $data['ITEMIMGLOC'] : '' ?>"
                                                    accept=".jpg,.jpeg,.png"/>
                                            <input type="hidden" id="OLDITEMIMGLOC" name="OLDITEMIMGLOC">
                                            <!-- Item Image -->
                                        </div>

                                        <div class="flex mb-1">
                                            <!-- Image Preview -->
                                            <img class="rounded w-64 h-64 mx-auto" id="ITEMIMGPREVIEW" name="ITEMIMGPREVIEW" loading="lazy"
                                                src="<?=$_SESSION['APPURL'].'/img/image_mfg.png'; ?>">
                                            <!-- Image Preview -->
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="flex p-2">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                        id="SAVE" name="SAVE"><?=checklang('SAVE'); ?></button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                        id="DELETE" name="DELETE"><?=checklang('DELETE'); ?></button>
                            </div>
                        </article>
                    </aside>
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
    let itemMode = true;
    $(document).ready(function() {
        unRequired();
        sessionStorage.setItem('ITEMMODE', itemMode);
        document.getElementById('DELETE').disabled = true;
        document.getElementById('ITEMCLEARANCETYP').value = 0;
        document.getElementById('ITEMCLEARANCETYP').classList.remove('req');
        const searchCondition = document.getElementById('search-condition');
        const tablesearcharea = document.getElementById('table-search-area');
        let maxsearchrow = '<?php echo (isset($maxsearchrow) ? $maxsearchrow: 19); ?>';
        searchCondition.addEventListener('toggle', function() {
            if (!searchCondition.open) {
                tablesearcharea.classList.remove('h-[66%]');
                tablesearcharea.classList.add('h-[78%]');
                maxsearchrow = 23;
            } else {
                tablesearcharea.classList.remove('h-[78%]');
                tablesearcharea.classList.add('h-[66%]');
                maxsearchrow = 19;
            }
            emptySearchRows(maxsearchrow);
        });

        const ITEMIMGPREVIEW = document.getElementById('ITEMIMGPREVIEW');
        document.getElementById('ITEMIMGLOC').onchange = function() {
            var imgurl = URL.createObjectURL(this.files[0]);
            // ITEMIMGPREVIEW.style.background = 'url(' + imgurl + ')';
            ITEMIMGPREVIEW.src = imgurl;
            ITEMIMGPREVIEW.style.backgroundSize = 'cover';
        }

        $(document).on('click', '.tb-search tbody tr', function(event) {
            $('table#table-search tbody tr').not(this).removeClass('selected');
            let item = $(this).closest('tr').children('td');
            if(item.eq(1).text() != 'undefined' && item.eq(1).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table-search');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }
                // console.log(rec);
                document.getElementById('ROWNO').value = rec;
                document.getElementById('ITEMCD').value = document.getElementById('ITEMCD'+rec+'').value;
                document.getElementById('ITEMNAME').value = document.getElementById('ITEMNAME'+rec+'').value;
                document.getElementById('ITEMSPEC').value = document.getElementById('ITEMSPEC'+rec+'').value;
                document.getElementById('ITEMDRAWNO').value = document.getElementById('ITEMDRAWNO'+rec+'').value;
                document.getElementById('ITEMSEARCH').value = document.getElementById('ITEMSEARCH'+rec+'').value;
                document.getElementById('ITEMTYP').value = document.getElementById('ITEMTYP'+rec+'').value;
                document.getElementById('CATALOGCD').value = document.getElementById('CATALOGCD'+rec+'').value;
                document.getElementById('CATALOGNAME').value = document.getElementById('CATALOGNAME'+rec+'').value;
                document.getElementById('ITEMBOI').value = document.getElementById('ITEMBOI'+rec+'').value;
                document.getElementById('MATERIALCD').value = document.getElementById('MATERIALCD'+rec+'').value;
                document.getElementById('MATERIALNAME').value = document.getElementById('MATERIALNAME'+rec+'').value;
                document.getElementById('ITEMWHTTYP').value = document.getElementById('ITEMWHTTYP'+rec+'').value;
                document.getElementById('ITEMUNITTYP').value = document.getElementById('ITEMUNITTYP'+rec+'').value;
                document.getElementById('ITEMORDRULETYP').value = document.getElementById('ITEMORDRULETYP'+rec+'').value;
                document.getElementById('ITEMPOUNITTYP').value = document.getElementById('ITEMPOUNITTYP'+rec+'').value;
                document.getElementById('SUPPLIERCD').value = document.getElementById('SUPPLIERCD'+rec+'').value;
                document.getElementById('SUPPLIERNAME').value = document.getElementById('SUPPLIERNAME'+rec+'').value;
                document.getElementById('WCCD').value = document.getElementById('WCCD'+rec+'').value;
                document.getElementById('WCNAME').value = document.getElementById('WCNAME'+rec+'').value;
                document.getElementById('STORAGECD').value = document.getElementById('STORAGECD'+rec+'').value;
                document.getElementById('STORAGENAME').value = document.getElementById('STORAGENAME'+rec+'').value;
                document.getElementById('ITEMLEADTIME').value = numberWithComma(document.getElementById('ITEMLEADTIME'+rec+'').value);
                document.getElementById('ITEMINVPRICE').value = num2digit(document.getElementById('ITEMINVPRICE'+rec+'').value);
                document.getElementById('ITEMSTDPURPRICE').value = num2digit(document.getElementById('ITEMSTDPURPRICE'+rec+'').value);
                document.getElementById('ITEMSHOPPRICE').value = num2digit(document.getElementById('ITEMSHOPPRICE'+rec+'').value);
                document.getElementById('ITEMFIXORDER').value = num2digit(document.getElementById('ITEMFIXORDER'+rec+'').value);
                document.getElementById('ITEMMINORDER').value = num2digit(document.getElementById('ITEMMINORDER'+rec+'').value);
                document.getElementById('ITEMMINSTOCK').value = num2digit(document.getElementById('ITEMMINSTOCK'+rec+'').value);
                document.getElementById('ITEMINVCALCTYP').value = document.getElementById('ITEMINVCALCTYP'+rec+'').value;
                document.getElementById('ITEMSTDSALEPRICE').value = num2digit(document.getElementById('ITEMSTDSALEPRICE'+rec+'').value);
                document.getElementById('ITEMMAKERTYP').value = document.getElementById('ITEMMAKERTYP'+rec+'').value;
                document.getElementById('ITEMSTDSUPPLYPRICE').value = num2digit(document.getElementById('ITEMSTDSUPPLYPRICE'+rec+'').value);
                document.getElementById('ITEMCOSTTYP').value = document.getElementById('ITEMCOSTTYP'+rec+'').value;
                document.getElementById('ITEMPACKTYP').value = document.getElementById('ITEMPACKTYP'+rec+'').value;
                document.getElementById('ITEMORDERUNIT').value = num2digit(document.getElementById('ITEMORDERUNIT'+rec+'').value);
                document.getElementById('ITEMWEIGHT').value = num2digit(document.getElementById('ITEMWEIGHT'+rec+'').value);
                document.getElementById('ITEMCLEARANCETYP').value = document.getElementById('ITEMCLEARANCETYP'+rec+'').value;
                document.getElementById('ITEMQTYINCASE').value = document.getElementById('ITEMQTYINCASE'+rec+'').value;

                document.getElementById('ITEMSTOPDT').value = '';
                if($('#ITEMSTOPDT'+rec+'').val() != '' && $('#ITEMSTOPDT'+rec+'').val() != undefined) {
                    document.getElementById('ITEMSTOPDT').value = dateFormat(document.getElementById('ITEMSTOPDT'+rec+'').value);
                }

                const pathurl = document.getElementById('sessionUrl').value;
                if(document.getElementById('ITEMIMGLOC'+rec+'').value != '') {
                    let imgurl = pathurl + document.getElementById('ITEMIMGLOC'+rec+'').value;
                    // console.log(urlExists(imgurl));
                    if(urlExists(imgurl)){
                        // document.getElementById('ITEMIMGLOC').value = document.getElementById('ITEMIMGLOC'+rec+'').value;
                        document.getElementById('OLDITEMIMGLOC').value = document.getElementById('ITEMIMGLOC'+rec+'').value;
                        document.getElementById('ITEMIMGPREVIEW').src = imgurl;     
                    } else {
                        document.getElementById('OLDITEMIMGLOC').value = '';
                        document.getElementById('ITEMIMGPREVIEW').src = pathurl + '/img/image_mfg.png';
                    }
                } else {
                    document.getElementById('ITEMIMGPREVIEW').src = pathurl + '/img/image_mfg.png';
                }

                document.getElementById('ITEMFIFOLISTFLG').checked = document.getElementById('ITEMFIFOLISTFLG'+rec+'').value == 'T' ? true: false;
                document.getElementById('ITEMPHANTOMFLG').checked = document.getElementById('ITEMPHANTOMFLG'+rec+'').value == 'T' ? true: false;
                document.getElementById('ITEMINVFLG').checked = document.getElementById('ITEMINVFLG'+rec+'').value == 'T' ? true: false;
                document.getElementById('ITEMMASTERPLANFLG').checked = document.getElementById('ITEMMASTERPLANFLG'+rec+'').value == 'T' ? true: false;
                document.getElementById('ITEMSERIALLFLG').checked = document.getElementById('ITEMSERIALLFLG'+rec+'').value == 'T' ? true: false;
               
                // let SYSEN_ITEMCD = document.getElementById('SYSEN_ITEMCD'+rec+'').value;
                // document.getElementById('ITEMCD').classList[SYSEN_ITEMCD == 'T' ? 'remove' : 'add']('read');
                if(itemMode) {
                    document.getElementById('DELETE').disabled = false;   
                    // document.getElementById('ITEMCD').classList.add('read');
                    let SYSEN_ITEMCD = document.getElementById('SYSEN_ITEMCD'+rec+'').value;
                    document.getElementById('ITEMCD').classList[SYSEN_ITEMCD == 'T' ? 'remove' : 'add']('read');
                } else {
                    document.getElementById('ITEMCD').value = '';
                }

                return unRequired();
            }
        });
    });

    function newMode() {
        itemMode = !itemMode;
        // console.log(itemMode);
        sessionStorage.setItem('ITEMMODE', itemMode);
        let btn_new = document.getElementById('NEW');
        btn_new.classList.toggle('bg-yellow-300');
        if(!itemMode) {
            btn_new.textContent = '<?=checklang('CLONE'); ?>';
            document.getElementById('ITEMCD').value = '';
            document.getElementById('DELETE').disabled = true;  
            document.getElementById('ITEMCD').classList.remove('read');
        } else {
            btn_new.textContent = '<?=checklang('NEW'); ?>';
            return clearForm();
        }
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
</html>
