<?php require_once('./function/index_x.php');?>
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
    
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHDELIVERY']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''?>">
    <input type="hidden" id="pageUrl" name="pageUrl" value="<?=!empty($_GET['pageUrl']) ? $_GET['pageUrl']: ''?>">
    <form class="w-full h-screen p-2" method="POST" id="shipReqSaleOrderGuide" name="shipReqSaleOrderGuide" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DELE_PLACE')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="P1" id="P1" value="<?=isset($P1) ? $P1: ''; ?>"/>
            </div>
            <div class="flex w-6/12 px-2"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SEARCH_CHAR')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="P2" id="P2" value="<?=isset($P2) ? $P2: ''; ?>"/>
            </div>
            <div class="flex w-6/12 px-2 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH'); ?>
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
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME'); ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCH_CHAR'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="dvwdetail" class="divide-y divide-gray-200"><?php
                    if (!empty($tdata)) { $minrow = count($tdata);
                        foreach($tdata as $key => $item) { ?>
                            <tr class="row-id">
                                <td class="hidden"><?=$key; ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['DELIVERYCD']) ? $item['DELIVERYCD']: '' ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['DELIVERYNAME']) ? $item['DELIVERYNAME']: '' ?></td>
                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['DELIVERYSEARCH']) ? $item['DELIVERYSEARCH']: '' ?></td>
                            </tr><?php 
                        }
                    } 
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="row-empty" id="rowId<?=$i?>">
                            <td class="h-6 border border-slate-700"></td>
                            <td class="h-6 border border-slate-700"></td>
                            <td class="h-6 border border-slate-700"></td>
                        </tr><?php
                    } ?>
                </tbody>
            </table>
        </div>
        
        <div class="flex p-2">
            <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowcount" ><?=$minrow ?></span></label>
        </div>
          
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=checklang('SELECT'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=checklang('DETAIL'); ?></button>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=checklang('BACK'); ?></button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
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
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERYCD') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERYCD"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERYNAME') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERYNAME"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERYSEARCH') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERYSEARCH"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?> 3</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
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
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->
