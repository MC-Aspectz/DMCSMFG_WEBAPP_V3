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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="accINCVO" name="accINCVO" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=!empty($data['DRPLANG']['APPCODE']['ACC_INCVO']) ? $_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['ACC_INCVO']: $_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details id="search-card" class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-8/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('VOUCHER_NO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="BOOKORDERNO" id="BOOKORDERNO" value="<?=isset($data['BOOKORDERNO']) ? $data['BOOKORDERNO']: ''; ?>" readonly/>
                                        <input class="hidden" type="text" name="COMCURRENCY" id="COMCURRENCY" value="<?=isset($data['COMCURRENCY']) ? $data['COMCURRENCY']: ''; ?>" />
                                        <input class="hidden" type="date" name="TDATE" id="TDATE" value="<?=!empty($data['TDATE']) ? date('Y-m-d', strtotime($data['TDATE'])): date('Y-m-d'); ?>"/>
                                        <div class="w-6/12"></div>
                                    </div>
                                    <div class="flex w-4/12 px-2 justify-end">
                                        <label class="w-3/12"></label>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center hidden"><?=checklang('INPUT_DATE')?></label>
                                        <input class="hidden" type="date" name="INPDATE" id="INPDATE" value="<?=!empty($data['INPDATE']) ? date('Y-m-d', strtotime($data['INPDATE'])): date('Y-m-d'); ?>"/>
                                        <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=checklang('V_ISSUE_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="INPUTDT" name="INPUTDT" value="<?=!empty($data['INPUTDT']) ? date('Y-m-d', strtotime($data['INPUTDT'])) : date('Y-m-d'); ?>" readonly/>
                                        <select class="hidden" id="ACCY" name="ACCY">
                                        <option value=""></option>
                                            <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                                <option value="<?=$yearkey ?>" <?=isset($data['ACCY']) && $data['ACCY'] == $yearkey ? 'selected' : '' ?>><?=$yearitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                 

                                <div class="flex mb-1">
                                    <div class="flex w-10/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=lang('customersupplier')?></label>
                                        <select id="CSS_TYPE" name="CSS_TYPE" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($csstyp as $css => $cssitem) { ?>
                                                <option value="<?=$css ?>" <?=isset($data['CSS_TYPE']) && $data['CSS_TYPE'] == $css ? 'selected' : '' ?>><?=$cssitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if(!empty($data['SYSVIS_CUSTOMERCODE']) && $data['SYSVIS_CUSTOMERCODE'] == 'T') { ?>
                                            <div class="relative w-2/12 mr-2 pointer-events-none">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        name="CUSTOMERCODE" id="CUSTOMERCODE" value="<?=isset($data['CUSTOMERCODE']) ? $data['CUSTOMERCODE']: ''; ?>" readonly/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none" id="SEARCHCUSTOMER">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                        <?php } else if(!empty($data['SYSVIS_SUPPLIERCD']) && $data['SYSVIS_SUPPLIERCD'] == 'T') { ?>
                                            <div class="relative w-2/12 mr-2 pointer-events-none">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" readonly/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none" id="SUPPLIERCD">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>                            
                                        <?php } else { ?>
                                            <div class="relative w-2/12 mr-2 pointer-events-none">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        name="STAFFCODE" id="STAFFCODE" value="<?=isset($data['STAFFCODE']) ? $data['STAFFCODE']: ''; ?>" readonly/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none" id="SEARCHSTAFF">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>   
                                        <?php } ?>
                                        <select class="text-control text-[12px] shadow-md border ml-2 px-3 h-7 w-2/12 rounded-xl border-gray-300 text-center"
                                                id="I_CURRENCY" name="I_CURRENCY">
                                                <option value=""></option>
                                                <?php foreach ($currencytyp as $curkey => $curitem) { ?>
                                                    <option value="<?=$curkey ?>" <?=isset($data['I_CURRENCY']) && $data['I_CURRENCY'] == $curkey ? 'selected' : '' ?>><?=$curitem ?></option>
                                                <?php } ?>
                                        </select>
                                        <div class="w-2/12"></div>
                                    </div>
                                    <div class="flex w-2/12 px-2"></div>
                                </div>           

                                <div class="flex mb-1">
                                    <div class="flex w-10/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INP_STAFF')?></label>
                                        <div class="relative w-2/12 mr-2 pointer-events-none">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="INP_STFCD" id="INP_STFCD" value="<?=isset($data['INP_STFCD']) ? $data['INP_STFCD']: ''; ?>" readonly/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none" id="SEARCHSTAFF1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            name="INP_STFNM" id="INP_STFNM" value="<?=isset($data['INP_STFNM']) ? $data['INP_STFNM']: ''; ?>" readonly/> 
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-2/12 mr-2 pointer-events-none">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" readonly/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none" id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/> 
                                    </div>
                                    <div class="flex w-2/12 px-2 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                                id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>  
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <!-- Table -->
                <div id="table-area" class="overflow-scroll block h-[500px] px-2"> 
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-2 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-4 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                <th class="px-6 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                <th class="px-3 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT')?></span>
                                </th>
                                <th class="px-3 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT')?></span>
                                </th>
                                <th class="px-3 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SECTION1')?></span>
                                </th>
                                <th class="px-3 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROJECTNO')?></span>
                                </th>
                                <th class="px-3 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 3); ?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                        if(!empty($data['DVWITEM']))  {
                            $minrow = count($data['DVWITEM']);
                            foreach ($data['DVWITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['ROWCOUNTER']) ? $value['ROWCOUNTER']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm pl-1 border border-slate-700 text-left"><?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?></td>
                                    <td class="h-6 w-2/12 text-sm pl-1 border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ACC_NM']) ? $value['ACC_NM']:'' ?></td>
                                    <td class="h-6 w-3/12 text-sm pl-1 border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '0.00' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '0.00' ?></td>
                                    <td class="h-6 w-1/12 text-sm pl-1 border border-slate-700 text-left"><?=isset($value['SECTION1']) ? $value['SECTION1']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm pl-1 border border-slate-700 text-left"><?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm pl-1 border border-slate-700 text-left"></td>
                                </tr><?php
                                }
                            }
                            for ($i = $minrow; $i < $maxrow; $i++) { ?>
                                <tr class="divide-y divide-gray-200 row-empty"><?php
                                    for($x = 1; $x <= 9; $x++) { ?>
                                    <td class="h-6 border border-slate-700"></td><?php
                                    } ?>
                                </tr> <?php
                            } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0">
                            <tr class="bg-white pointer-events-none">
                                <td class="text-color h-6 text-[12px]" colspan="4"><?=str_repeat('&emsp;', 2);?></td>
                                <td class="h-6"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                                        id="TTL_AMT1" name="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1'] : '' ?>" readonly/></td>
                                <td class="h-6"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                                        id="TTL_AMT2" name="TTL_AMT2" value="<?=isset($data['TTL_AMT2']) ? $data['TTL_AMT2'] : '' ?>" readonly/></td>
                                <td class="text-color h-6 text-[12px]" colspan="3"><?=str_repeat('&emsp;', 2);?></td>
                            </tr>
                            <tr class="bg-white pointer-events-none">
                                <td class="text-color h-6 text-[12px]" colspan="9"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="record" ><?=$minrow; ?></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
          
                <div class="flex mt-2">
                    <div class="flex w-8/12 px-1"></div>
                    <div class="flex w-4/12 px-1 justify-end">
                        <input type="hidden" name="historyback" id="historyback" value="<?=$historyback?>">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                id="END" onclick="$('#loading').show(); window.location = '<?=$historyback?>';"><?=checklang('BACK'); ?></button>
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
        calculateDVW();
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(2).text() != 'undefined' && item.eq(3).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                $('#VOUCHERNO').val(item.eq(3).text());
            }
        });

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 10); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[500px]');
                tablearea.classList.add('h-[600px]');
                maxrow = 20;
            } else {
                tablearea.classList.remove('h-[600px]');
                tablearea.classList.add('h-[500px]');
                maxrow = 15;
            }
            emptyRows(maxrow);
        });
    });

    function calculateDVW() {
        let item = '<?php echo !empty($data['DVWITEM']) ? json_encode($data['DVWITEM']): ''; ?>';
        let accamt1 = 0; let accamt2 = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            // console.log(paymentArray);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
                accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
            });

            $('#TTL_AMT1').val(num2digit(accamt1));
            $('#TTL_AMT2').val(num2digit(accamt2));
        }        
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