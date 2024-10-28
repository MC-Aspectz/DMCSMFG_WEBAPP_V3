<?php require_once('./function/index_x.php');?>
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
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="accINCVOURL" name="accINCVOURL" value="<?=$accINCVOURL;?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="AccMonthReportAll" name="AccMonthReportAll" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold pl-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=checklang('SEARCH')?></summary>
                                 <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TARGETYM')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="P1" id="P1" value="<?=!empty($data['P1']) ? date('Y-m-d', strtotime($data['P1'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center"><?=checklang('ARROW')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="P2" id="P2" value="<?=!empty($data['P2']) ? date('Y-m-d', strtotime($data['P2'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="ACCCD1" id="ACCCD1" value="<?=isset($data['ACCCD1']) ? $data['ACCCD1']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHACCOUNT1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center"><?=checklang('ARROW')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="ACCCD2" id="ACCCD2" value="<?=isset($data['ACCCD2']) ? $data['ACCCD2']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHACCOUNT2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 py-2"><?=checklang('DMCSREM3')?></label>
                                        <select class="hidden" id="ACCY" name="ACCY">
                                        <option value=""></option>
                                            <?php foreach ($accyearvalue as $accyearkey => $accyearitem) { ?>
                                                <option value="<?=$accyearkey ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $accyearkey) ? 'selected' : '' ?>><?=$accyearitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="STARTAMT" id="STARTAMT" value="<?=isset($data['STARTAMT']) ? $data['STARTAMT']: ''; ?>"/>
                                        <input type="hidden" name="STARTDB" id="STARTDB" value="<?=isset($data['STARTDB']) ? $data['STARTDB']: ''; ?>"/>
                                        <input type="hidden" name="STARTCR" id="STARTCR" value="<?=isset($data['STARTCR']) ? $data['STARTCR']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex mb-1 hidden">
                                    <div class="flex w-6/12">
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="ACCCD" id="ACCCD" value="<?=isset($data['ACCCD']) ? $data['ACCCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHACCOUNT">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300" 
                                                id="ACCNAME" name="ACCNAME" value="<?=isset($data['ACCNAME']) ? $data['ACCNAME']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 justify-end"></div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <!-- Table -->
                <div class="overflow-scroll mb-1 px-2">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="w-full bg-gray-100">
                            <tr class="flex w-full divide-x csv">
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCOUNTCD')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRINT_VOUCHER_DATE')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHERNO')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAXINVOICE')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHERDESC')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT_AMOUNT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT_AMOUNT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BALANCE_AMOUNT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIER_NAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DIVISIONNAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROJECTNO')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[520px]"><?php
                        if(!empty($data['ITEM']))  { $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x csv row-id" id="rowId<?=$key?>"<?php if(isset($value['SYSROWCOLOR'])) { ?> style="background-color:<?=$value['SYSROWCOLOR']?>" <?php } ?>>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['ACCCODE']) ? $value['ACCCODE']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['ACCNAME']) ? $value['ACCNAME']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['VOUCHER_DATE']) ? $value['VOUCHER_DATE']:'' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['VOUCHERNO']) ? $value['VOUCHERNO']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['VOUCHERLN']) ? $value['VOUCHERLN']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['VTAXINVOICE']) ? $value['VTAXINVOICE']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['VOUCHERDESC']) ? $value['VOUCHERDESC']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['MY_CURR_AMT0']) ? $value['MY_CURR_AMT0']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['MY_CURR_AMT1']) ? $value['MY_CURR_AMT1']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['MY_BAL_AMT']) ? $value['MY_BAL_AMT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']:'' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DIVISIONNAME']) ? $value['DIVISIONNAME']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?></td>
                                </tr><?php 
                            }
                        }                           
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x row-empty" id="rowId<?=$i?>"><?php
                                for($x = 1; $x <= 15; $x++) { ?>
                                <td class="h-6 w-40 py-2"></td><?php
                                } ?>
                            </tr><?php
                        } ?>
                        </tbody>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex my-1 mx-1">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 mx-2 text-gray-700 border-gray-300 read" 
                                id="VOUCHERNO" name="VOUCHERNO" value="<?=isset($data['VOUCHERNO']) ? $data['VOUCHERNO']: ''; ?>" read/>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="REVIEW" name="REVIEW"><?=checklang('REVIEW'); ?></button>     
                        <input class="hidden" type="hidden" name="BALAMT" id="BALAMT" value="<?=isset($data['BALAMT']) ? $data['BALAMT']: ''; ?>"/>
                        <input class="hidden" type="hidden" name="TTL_MY_CURR_AMT0" id="TTL_MY_CURR_AMT0" value="<?=isset($data['TTL_MY_CURR_AMT0']) ? $data['TTL_MY_CURR_AMT0']: ''; ?>"/>
                        <input class="hidden" type="hidden" name="TTL_MY_CURR_AMT1" id="TTL_MY_CURR_AMT1" value="<?=isset($data['TTL_MY_CURR_AMT1']) ? $data['TTL_MY_CURR_AMT1']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(3).text() != 'undefined' && item.eq(3).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                $('#VOUCHERNO').val(item.eq(3).text());
            }
        });

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 21); ?>';
        const details = document.querySelector('details');
        const dvwdetail = document.getElementById('dvwdetail');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                dvwdetail.classList.remove('h-[520px]');
                dvwdetail.classList.add('h-[600px]');
                maxrow = 25;
            } else {
                dvwdetail.classList.remove('h-[600px]');
                dvwdetail.classList.add('h-[520px]');
                maxrow = 21;
            }
            emptyRow(maxrow);
        });
    });

    function HandlePopupIndex(result, index) {
        $('#loading').show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/830/ACCMONTHREPORT_ALL/index.php?'+ index + '=' + result;
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
          //
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>