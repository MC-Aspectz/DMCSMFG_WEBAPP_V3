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
            <form class="w-full" method="POST" id="masterPlan" name="masterPlan" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="STARTDATE"><?=checklang('STARTDATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center mr-2"
                                id="FROMDATE" name="FROMDATE" value="<?=!empty($data['FROMDATE']) ? date('Y-m-d', strtotime($data['FROMDATE'])): date('Y-m-d'); ?>"/>
                        <input type="checkbox" class="ml-2" id="KAKUTEITORIKOM" name="KAKUTEITORIKOM" onclick="javascript:changeCondition();" value="T"/> 
                        <label class="text-color block text-sm w-4/12 pt-1 text-center" id="KAKU"><?=checklang('KAKUTEITORIKOM')?></label>
                    </div>

                    <div class="flex w-6/12">
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                id="PLANDT" name="PLANDT" value="<?=!empty($data['PLANDT']) ? date('Y-m-d', strtotime($data['PLANDT'])): date('Y-m-d'); ?>"/>
                        <label class="text-color block text-sm w-8/12 pt-1 text-center" id="SALE_PLAN_TXT"><?=checklang('SALE_PLAN_TXT')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300 hidden"
                                id="DIVISIONTYP" name="DIVISIONTYP" onchange="javascript:changeCondition();">
                            <option value=""></option>
                            <?php foreach ($factory as $factory => $factoryitem) { ?>
                                <option value="<?=$factory ?>" <?php echo (isset($data['DIVISIONTYP']) && $data['DIVISIONTYP'] == $factory) ? 'selected' : '' ?>><?=$factoryitem ?></option>
                            <?php } ?>
                        </select>
                        <select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300 hidden"
                                id="DISPOPT" name="DISPOPT" onchange="javascript:changeCondition();">
                            <option value=""></option>
                            <?php foreach ($plandisptyp as $plan => $planitem) { ?>
                                <option value="<?=$plan ?>" <?php echo (isset($data['DISPOPT']) && $data['DISPOPT'] == $plan) ? 'selected' : '' ?>><?=$planitem ?></option>
                            <?php } ?>
                        </select>
                        <input class="hidden" type="hidden" id="SYSTIMESTAMP" name="SYSTIMESTAMP" value="<?=!empty($data['SYSTIMESTAMP']) ? $data['SYSTIMESTAMP']: ''; ?>" />
                        <input class="hidden" type="hidden" id="MONTHCTR" name="MONTHCTR" value="<?=!empty($data['MONTHCTR']) ? $data['MONTHCTR']: ''; ?>" />
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-full">
                        <input type="radio" class="radiobox" id="ONEMONTH" name="ONEMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('ONEMONTH')?></label>
                        <input type="radio" class="radiobox" id="TWOMONTH" name="TWOMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('TWOMONTH')?></label>
                        <input type="radio" class="radiobox" id="THREEMONTH" name="THREEMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('THREEMONTH')?></label>
                        <input type="radio" class="radiobox" id="FOURMONTH" name="FOURMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('FOURMONTH')?></label>
                        <input type="radio" class="radiobox" id="FIVEMONTH" name="FIVEMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('FIVEMONTH')?></label>
                        <input type="radio" class="radiobox" id="SIXMONTH" name="SIXMONTH" value="T">
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('SIXMONTH')?></label>
                        <div class="flex w-2/12 justify-end">
                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" 
                                id="SEARCH" name="SEARCH" onclick="search();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="px-2" id="tableResult">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 detail_table" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-6 text-center border border-slate-700 bg-white">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700 bg-white">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700 bg-white">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ONHAND')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none"> <?php 
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
                                <td class="h-6 text-sm border border-slate-700"></td>
                                <td class="h-6 text-sm border border-slate-700"></td>
                                <td class="h-6 text-sm border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex pt-2 px-2">
                    <div class="flex w-12/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-1 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="DETAIL" name="DETAIL"><?=checklang('DETAIL'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;
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
            <div class="modal-body" id="tabelModal">
                <table class="w-full border-collapse border border-slate-500" id="tabelModal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="tbodyModal"></tbody>
                </table>
                <br>
                <div class="h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?> <label id="viewCount"></label></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('DETAIL').disabled = true;
        // $('#table').DataTable({
        //     scrollY: '414.0px',
        //     // scrollX: true,
        //     // scrollCollapse: true,
        //     processing: false,
        //     searching: false,
        //     responsive: true,
        //     fixedHeader: false,
        //     paging: false,
        //     ordering: false,
        //     info: false,
        //     language: {
        //         emptyTable: ' ',
        //         infoEmpty: ' '
        //     },
        // });

        // $('#table').each(function(){ $(this).find('tr:even').css('background', '#f5f5f4'); });

        $('.radiobox').click(function(){
            $(this).prop('checked', true).siblings().prop('checked', false);
        });

        // $('div > input[type=radio]').click(function() {
        //     var thisParent = $(this).closest('div');
        //     var prevClicked = thisParent.find(':checked');
        //     var currentObj = $(this);
        //     prevClicked.each(function() {
        //         if (!$(currentObj).is($(this))) {
        //             $(this).prop('checked', false);
        //         }
        //     });
        // });
    });
</script>
