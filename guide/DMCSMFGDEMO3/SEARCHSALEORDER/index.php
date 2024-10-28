<?php
    require_once('./function/index_x.php');
?>
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


    <title><?=$_SESSION['APPNAME'].' - '.lang('salesorderindex'); ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: '' ?>">
    <input type="hidden" id="index" name="index" value="<?=!empty($_GET['index']) ? $_GET['index']: '' ?>">
    <form class="w-full h-screen p-2" method="POST" id="quotationindex" name="quotationindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('customercode'); ?></label>
                <div class="relative w-5/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="P1" id="P1" value="<?=$P1 ?>" />
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHCUSTOMER">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('staffcode'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P3" name="P3" value="<?=$P3 ?>"/>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('salesorderno'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P4" name="P4" value="<?=$P4 ?>"/>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('cateogorycode'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P2" name="P2" value="<?=$P2 ?>"/>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('status'); ?></label>
                <select class="text-control shadow-md border px-3 h-7 w-5/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="P9" name="P9" >
                    <option value="" <?=(isset($P9) && $P9 === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($statussale as $k => $value) { ?>
                        <option value="<?=$k ?>"<?php echo (isset($P9) && $P9 == $k) ? 'selected' : '' ?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('factory'); ?></label>
                <select class="text-control shadow-md border px-3 h-7 w-5/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="P10" name="P10">
                    <option value="" <?=(isset($P10) && $P10 === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($branchtype as $key => $item) { ?>
                        <option value="<?=$key ?>"<?php echo (isset($P10) && $P10 == $key) ? 'selected' : '' ?>><?=$item?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('orderdate'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P5" name="P5" value="<?=$P5 ?>"/>&ensp;→&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P6" name="P6" value="<?=$P6 ?>"/>
            </div>
            <div class="flex w-6/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=lang('plannedshipping'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P7" name="P7" value="<?=$P7 ?>"/>&ensp;→&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P8" name="P8" value="<?=$P8 ?>"/>
            </div>
            <div class="flex w-6/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="search" name="search" onclick="$('#loading').show();"><?=lang('search'); ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>

         <div id="table-area" class="overflow-scroll px-2 block h-[280px]">
            <table id="table_result" class="quote_table w-full border-collapse border border-slate-500">
                <thead class="sticky top-0 z-20 bg-gray-50">
                    <tr class="border border-gray-600">
                        <th class="px-6 text-center border border-slate-700 text-left">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('salesorderno'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('customercode'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('customername'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=lang('status'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="dvwdetail" class="divide-y divide-gray-200"><?php
                    if (!empty($tdata)) { $minrow = count($tdata);
                        foreach($tdata as $key => $item) { ?>
                            <tr class="row-id">
                                <td class="hidden"><?=$key; ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEORDERNO'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['CUSTOMERCD'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['CUSTOMERNAME'] ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?php foreach ($statusale as $i => $v) { echo $item['ORDERSTATUS'] == $i ? $v : ''; } ?></td>
                            </tr><?php 
                        }
                    } 
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="row-empty" id="rowId<?=$i?>">
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
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('salesorderno') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="salesorderno"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('customercode') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="customercode"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('customername') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="customername"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=lang('status') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="status"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="h-6 text-[12px]"><?=lang('rowcount'); ?> 4</div>
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
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->