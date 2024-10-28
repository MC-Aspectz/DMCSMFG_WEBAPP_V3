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

    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHBILLNO']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="guideUrl" name="guideUrl" value="<?=$guideUrl?>">
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="billno" name="billno" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BILL_NO'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="BN" name="BN" value="<?=isset($data['BN']) ? $data['BN']: '' ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INSPDATE'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="D1" name="D1" value="<?=isset($data['D1']) ? $data['D1']: '' ?>"/>&ensp;<?=checklang('ARROW'); ?>&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="D2" name="D2" value="<?=isset($data['D2']) ? $data['D2']: '' ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCD'); ?></label>
                <div class="relative w-4/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="CD" id="CD" value="<?=isset($data['CD']) ? $data['CD']: '' ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHCUSTOMER">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>&ensp;
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="CN" id="CN" value="<?=isset($data['CN']) ? $data['CN']: '';?>" readonly/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATUS'); ?></label>
                <select class="text-control shadow-md border px-3 h-7 w-4/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="BN_STATUS" name="BN_STATUS" >
                    <option value="" <?=(isset($data['BN_STATUS']) && $data['BN_STATUS'] === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($bnstatus as $key => $value) { ?>
                        <option value="<?=$key ?>"<?php echo (isset($data['BN_STATUS']) && $data['BN_STATUS'] == $key) ? 'selected' : '' ?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=$lang['search']; ?>
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
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BILLNO'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCD'); ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME'); ?></span>
                        </th>
                         <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPDATE'); ?></span>
                        </th>
                         <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STATUS'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 2);?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                if (!empty($tdata)) {
                $minrow = count($tdata) + 1;
                foreach ($tdata as $item) {  ?>
                    <tr class="flex w-full p-0 divide-x">
                        <td class="hidden"><?=$item["ROWCOUNTER"] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm csv-col"><?=$item["BILLNO"] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm csv-col"><?=$item["CUSTOMERCD"] ?></td>
                        <td class="h-6 w-3/12 pl-1 text-sm csv-col"><?=$item["CUSTOMERNAME"] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm csv-col"><?=$item["INSPDATE"] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm csv-col"><?php foreach ($bnstatus as $i => $v) { echo $item["STATUS"] == $i ? $v : ''; } ?></td>
                        <td class="h-6 w-1/12 pl-1 text-sm csv-col"></td>
                    </tr>
                <?php }
                        for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-3/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-1/12"></td>
                            </tr><?php 
                        }
                    } else {
                        for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                    <tr class="flex w-full p-0 divide-x">
                        <td class="h-6 w-2/12"></td>
                        <td class="h-6 w-2/12"></td>
                        <td class="h-6 w-3/12"></td>
                        <td class="h-6 w-2/12"></td>
                        <td class="h-6 w-2/12"></td>
                        <td class="h-6 w-1/12"></td>
                    </tr><?php }
                } ?> 
                </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?php echo $lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" id="SELECT" name="SELECT" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?=checklang('SELECT'); ?></button>&emsp;&emsp;
                <button type="button" id="DETAIL" name="DETAIL" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?=checklang('DETAIL'); ?></button>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                    onclick="return unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                    id="BACK"><?=checklang('BACK'); ?></button>
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
                <table class="w-full border-collapse border border-slate-500" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['title']; ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=$lang['value']; ?></th>
                        </tr>
                    </thead>
                    <tbody>                          
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('BILLNO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="BILLNO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('CUSTOMERCD') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERCD" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('INSPDATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPDATE" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STATUS') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="STATUS"></td>
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
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->