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
    
    <title><?php echo $_SESSION['APPNAME'].' - '.$lang['materialindex']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page'] : ''; ?>"/>
    <input type="hidden" id="index" name="index" value="<?=!empty($_GET['index']) ? $_GET['index'] : ''; ?>"/>
    <input type="hidden" id="pageUrl" name="pageUrl" value="<?=!empty($_GET['pageUrl']) ? $_GET['pageUrl'] : ''; ?>"/>
    <form class="w-full h-screen p-2" method="POST" id="materialindex" name="materialindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['MATERIALCODE']; ?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P1" name="P1" value="<?=isset($P1) ? $P1 : ''; ?>" />
                </div>
            </div>
            <div class="flex w-4/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['MATERIALPARENTCD']; ?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P2" name="P2" value="<?=isset($P2) ? $P2 : ''; ?>" />
            </div>
            <div class="flex w-4/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=$lang['search']; ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>
            
       <!-- Table -->
        <div class="overflow-scroll px-2 block h-[310px] max-h-[310px]">
            <table id="table_result" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                <thead class="sticky top-0 bg-gray-50">
                    <tr class="border border-gray-600 ">
                        <th class="px-3 text-center border border-slate-700">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['MATERIALCODE']; ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['MATERIALNAME']; ?></span>
                        </th>
                        <th class="px-3 text-center border border-slate-700">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['MATERIALPARENTCD']; ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700">
                             <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['MATERIALSPEC']; ?></span>
                        </th>
                        <th class="px-6 text-center border border-slate-700">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['MATERIALNOTE']; ?></span>
                        </th>
                    </tr>
                </thead>

                <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                if (!empty($tdata)) { $run = 0; $minrow = count($tdata);
                    foreach ($tdata as $item) {  ?>
                        <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                            <td class="hidden"><?= ++$run; ?></td>
                            <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left"><?=isset($item['MATERIALCD']) ? $item['MATERIALCD']: '' ?></td>
                            <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['MATERIALNAME']) ? $item['MATERIALNAME']: '' ?></td>
                            <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['MATERIALPARENTCD']) ? $item['MATERIALPARENTCD']: '' ?></td>
                            <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['MATERIALSPEC']) ? $item['MATERIALSPEC']: '' ?></td>
                            <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($item['MATERIALNOTE']) ? $item['MATERIALNOTE']: '' ?></td>
                        </tr><?php
                    }
                }
                for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                    <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
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
        
        <div class="sticky bottom-0 flex pt-2 px-2">
            <div class="flex w-full">
                <label class="text-color text-[12px]"><?=$lang['rowcount'];?>  <span id="rowcount"><?=$minrow;?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=$lang['select']; ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=$lang['view']; ?></button>&emsp;&emsp;
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return clearForm(this.form);"><?=$lang['clear']; ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=$lang['back']; ?></button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <label class="text-gray-700 text-base font-semibold"><?=$lang['detail']; ?></label>
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
                                <th class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['title']; ?></th>
                                <th class="text-center border border-slate-700 text-sm"><?=$lang['value']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['MATERIALCODE'] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="MATERIALCODE"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['MATERIALNAME'] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="MATERIALNAME"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['MATERIALPARENTCD'] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="MATERIALPARENTCD"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['MATERIALSPEC'] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="MATERIALSPEC"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['MATERIALNOTE'] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="MATERIALNOTE"></td>
                            </tr>
                        </tbody>
                </table>
                <br>
                <div class="h-6 text-[12px]"><?=$lang['rowcount']; ?> 5</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=$lang['end']; ?></button>
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