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
    
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHSALENOSHIP']; ?></title>
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
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STAFFCODE')?></label>
                <div class="relative w-4/12 mr-1">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHSTAFF">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
            </div>
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                <div class="relative w-4/12 mr-1">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHCUSTOMER">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                <div class="relative w-4/12 mr-1">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="ITEMCODE" id="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHITEM">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ITEMNAME" id="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
            </div>
            <div class="flex w-6/12 px-2">
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ITEMSPEC" id="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DUEDATE'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="DUEDATE" name="DUEDATE" value="<?=!empty($data['DUEDATE']) ? date('Y-m-d', strtotime($data['DUEDATE'])) : date('Y-m-d'); ?>"/>
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

        <div class="table">
            <table id="table_result" class="w-full border-collapse border border-slate-500">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDERNUMBER'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCD'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('IM_CODE'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMSPEC'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUEDATE'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) { $minrow = count($tdata);
                        foreach ($tdata as $item) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['SALEORDERNO'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['SALECUSCD'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['CUSTOMERNAME'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['SALELNITEMCD'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['SALELNITEMNAME'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['SALELNITEMSPEC'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm text-center"><?=$item['SALELNDUEDT'] ?></td>
                            </tr><?php 
                        }
                    }

                    for ($i = $minrow; $i < $maxrow; $i++) {  ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-1/12"></td>
                        </tr><?php
                    } ?> 
                </tbody>
            </table>    
            <div class="flex pt-2">
                <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowcount" ><?=$minrow ?></span></label>
            </div>
        </div>
          
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=checklang('SELECT'); ?></button>&emsp;&emsp;
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=checklang('BACK'); ?></button>
            </div>
        </div>
    </form>

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
