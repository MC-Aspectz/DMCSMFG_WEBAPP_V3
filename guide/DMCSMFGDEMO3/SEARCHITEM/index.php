<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <!-- -------------------------------------------------------------------------------- -->
    <!--  guide Include  -->
    <?php guideInclude(); ?>
    <!-- -------------------------------------------------------------------------------- -->
    
    <title><?=$_SESSION['APPNAME'].' - '.lang('itemindex'); ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: '' ?>">
    <input type="hidden" id="index" name="index" value="<?=!empty($_GET['index']) ? $_GET['index']: '' ?>">
    <form class="w-full h-screen p-2" method="POST" id="itemindex" name="itemindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('itemcode'); ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="P1" name="P1" value="<?=$P1 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('searchstr'); ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="P2" name="P2" value="<?=$P2 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('speciafication'); ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="P3" name="P3" value="<?=$P3 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('drawingno'); ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="P4" name="P4" value="<?=$P4 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('typeofitem'); ?></label>
                <select class="text-control text-sm shadow-md border px-3 h-7 w-4/12 text-left text-sm rounded-xl border-gray-300" id="TRANSACTIONTYPEFR" name="TRANSACTIONTYPEFR" >
                    <option value="" <?php echo (isset($P5) && $P5 === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($typeItem as $key => $item) { ?>
                        <option value="<?php echo $key ?>"<?php echo (isset($P5) && $P5 == $key) ? 'selected' : '' ?>><?=$item?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="submit" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="search" name="search" onclick="$('#loading').show();"><?=lang('search'); ?></button>
            </div>
        </div>


         <div id="table-area" class="overflow-scroll px-2 block h-[280px]">
            <table id="table_result" class="quote_table w-full border-collapse border border-slate-500">
                <thead class="sticky top-0 z-20 bg-gray-50">
                    <tr class="border border-gray-600">
                        <th class="px-6 text-center border border-slate-700 text-left">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('itemcode'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('itemname'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('speciafication'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('drawingno'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('search'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('saleenddate'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="dvwdetail" class="divide-y divide-gray-200"><?php
                    if (!empty($tdata)) { $minrow = count($tdata);
                        foreach($tdata as $key => $item) { ?>
                            <tr class="row-id">
                                <td class="hidden"><?=$key; ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMCD'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMNAME'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMSPEC'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMDRAWNO'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMSEARCH'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['ITEMSTOPDT'] ?></td>
                            </tr><?php 
                        }
                    } 
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="row-empty" id="rowId<?=$i?>">
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
            <label class="text-color h-6 text-[12px]"><?=lang('rowcount'); ?>  <span id="rowcount" ><?=$minrow ?></span></label>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=lang('select'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=lang('view'); ?></button>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return clearForm(this.form);"><?=lang('clear'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=lang('back'); ?></button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="text-gray-700 text-base font-semibold"><?=lang('detail'); ?></label>
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
                                <th class="text-left pl-1 border border-slate-700 text-sm"><?=lang('title'); ?></th>
                                <th class="text-center border border-slate-700 text-sm"><?=lang('value'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('itemcode') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="itemcd"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('itemname') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="itemname"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('speciafication') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="itempec"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('drawingno') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="drowno"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('search') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="seach"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('saleenddate') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="saledate"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="h-6 text-[12px]"><?=lang('rowcount'); ?> 6</div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=lang('end'); ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</main>
</body>
<script src="./js/script.js"></script>
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->