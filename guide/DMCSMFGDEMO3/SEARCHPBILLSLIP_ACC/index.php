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

    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHPBILLSLIP_ACC']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="guideUrl" name="guideUrl" value="<?=$guideUrl?>">
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="billslipAcc" name="billslipAcc" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PBILL_NO'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P1" name="P1" value="<?=$P1 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCD'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P2" name="P2" value="<?=$P2 ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATUS'); ?></label>
                <select class="text-control shadow-md border px-3 h-7 w-4/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="P5" name="P5" >
                    <option value="" <?=isset($P5) && $P5 === '' ? 'selected' : '' ?>></option>
                    <?php foreach ($accstatus as $key => $value) { ?>
                        <option value="<?=$key ?>" <?php echo isset($P5) && $P5 == $key ? 'selected' : '' ?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DATE'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P3" name="P3" value="<?=$P3 ?>"/>&ensp;<?=checklang('ARROW'); ?>&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P4" name="P4" value="<?=$P4 ?>"/>
            </div>
            <div class="flex w-5/12 justify-end">
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
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PBILL_NO'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE'); ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIERCD'); ?></span>
                        </th>
                         <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIERNAME'); ?></span>
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
                        <td class="hidden"><?=$item['ROWCOUNTER'] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['BILLNO'] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['BILLSLIPNOTE03'] ?></td>
                        <td class="h-6 w-3/12 pl-1 text-sm"><?=$item['SUPPLIERCD'] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['SUPPLIERNAME'] ?></td>
                        <td class="h-6 w-2/12 pl-1 text-sm"><?php foreach ($accstatus as $i => $v) { echo $item['STATUS'] == $i ? $v : ''; } ?></td>
                        <td class="h-6 w-1/12 pl-1 text-sm"></td>
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
                            <tr class="th-class">
                                <th class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TITLE'); ?></th>
                                <th class="text-center border border-slate-700 text-sm"><?=checklang('VALUE'); ?></th>
                            </tr>
                        </thead>
                        <tbody>                          
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PBILL_NO') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="PBILL_NO"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('DATE') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="DATE" style="background-color:#ffe6cc;"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SUPPLIERCD') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="SUPPLIERCD"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('SUPPLIERNAME') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="SUPPLIERNAME" style="background-color:#ffe6cc;"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STATUS') ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="STATUS"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?> 5</div>
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
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->