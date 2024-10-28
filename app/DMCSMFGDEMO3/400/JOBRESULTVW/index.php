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
            <form class="w-full" method="POST" id="jobResultTW" name="jobResultTW" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    id="I_WCCD" name="I_WCCD" value="<?=isset($data['I_WCCD']) ? $data['I_WCCD']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHWORKCENTER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="D_WCNM" id="D_WCNM" value="<?=isset($data['D_WCNM']) ? $data['D_WCNM']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="WORKDAY_TXT"><?=checklang('WORK_DAY')?></label>
                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                id="I_DATE1" name="I_DATE1" value="<?=!empty($data['I_DATE1']) ? date('Y-m-d', strtotime($data['I_DATE1'])): ''; ?>" onchange="unRequired();"/>
                        <label class="text-color block text-sm pt-1 w-1/12 text-center"><?=checklang('ARROW')?></label>
                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                id="I_DATE2"name="I_DATE2" value="<?=!empty($data['I_DATE2']) ? date('Y-m-d', strtotime($data['I_DATE2'])): ''; ?>" onchange="unRequired();"/>
                        <div class="w-2/12"></div>
                    </div>

                    <div class="flex w-6/12 px-2 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div> 
    
                <!-- Table -->
                <div class="overflow-scroll px-2 block h-[600px] max-h-[600px]">
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_DAY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHERNO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_CENTER_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCTIONORDER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('IM_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('COMPLETE_QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_TIME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEMO')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <!-- <td class="hidden"><?=$key?></td> -->
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROSTARTDT']) ? $value['JOBPROSTARTDT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROORDERNO']) ? $value['JOBPROORDERNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROPLACE']) ? $value['JOBPROPLACE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['WCNM']) ? $value['WCNM']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROPSSORDERNO']) ? $value['JOBPROPSSORDERNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROPSSNO']) ? $value['JOBPROPSSNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROITEMCD']) ? $value['PROITEMCD']: '' ?></td>
                                    <td class="h-6 w-6/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNM']) ? $value['ITEMNM']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['COMPQTY']) ? $value['COMPQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center whitespace-nowrap"><?=isset($value['PROHOUR']) ? $value['PROHOUR']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['JOBPROREM']) ? $value['JOBPROREM']: '' ?></td>
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

                    <div class="sticky bottom-0 bg-white flex pt-2 px-2">
                        <div class="flex w-12/12">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                        </div>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="DETAIL" name="DETAIL"><?=checklang('DETAIL'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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

<!-- start::modal -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
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
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WORK_DAY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WORK_DAY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('VOUCHERNO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="VOUCHERNO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WC_CODE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WC_CODE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WORK_CENTER_NAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WORK_CENTER_NAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRODUCTIONORDER') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PRODUCTIONORDER"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ROUT_NO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ROUT_NO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('IM_CODE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="IM_CODE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('COMPLETE_QUANTITY') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="COMPLETE_QUANTITY"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WORK_TIME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WORK_TIME"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('MEMO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="MEMO"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 11</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
</html>
<script src="./js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
    })

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);    
    }
    // let toggle = false;
    // function sortTb(colIndex) {
    //     var table, rows, switching, i, x, y, shouldSwitch;
    //     table = document.getElementById('table');
    //     switching = true;
    //     toggle = !toggle;
    //     // console.log(toggle);
    //     /*Make a loop that will continue until no switching has been done:*/
    //     while (switching) {
    //         //start by saying: no switching is done:
    //         switching = false;
    //         rows = table.rows;
    //         var datalength = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
    //         /*Loop through all table rows (except the first, which contains table headers):*/
    //         // for (i = 1; i < (rows.length - 1); i++) {
    //         for (i = 1; i < (datalength); i++) {
    //             //start by saying there should be no switching:
    //             shouldSwitch = false;
    //             /*Get the two elements you want to compare, one from current row and one from the next:*/
    //             x = rows[i].getElementsByTagName('td')[colIndex];
    //             y = rows[i + 1].getElementsByTagName('td')[colIndex];
    //             // check if the two rows should switch place:
    //             if(toggle) {
    //                 if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
    //                     //if so, mark as a switch and break the loop:
    //                     shouldSwitch = true;
    //                     break;
    //                 }
    //             } else {
    //                 if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
    //                     //if so, mark as a switch and break the loop:
    //                     shouldSwitch = true;
    //                     break;
    //                 }
    //             }
    //         }

    //         if (shouldSwitch) {
    //             /*If a switch has been marked, make the switch and mark that a switch has been done:*/
    //             rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    //             switching = true;
    //         }
    //     }
    // }
</script>