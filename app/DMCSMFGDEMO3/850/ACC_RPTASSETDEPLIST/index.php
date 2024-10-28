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
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="accRPTAssetDeplist" name="accRPTAssetDeplist" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

            <!-- Fiscal Period -->
            <div class="flex mb-1">
                <div class="flex w-10/12">
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('YEAR_TERM')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="YEAR" name="YEAR">
                        <option value=""></option>
                        <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                            <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                        <?php } ?>
                    </select> 
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ASSETACCCD')?></label>
                    <div class="relative w-2/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="GA1" id="GA1" value="<?=isset($data['GA1']) ? $data['GA1']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="ASSETACCGUIDE">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                    name="GANAME" id="GANAME" value="<?=isset($data['GANAME']) ? $data['GANAME']: ''; ?>"readonly/>
                </div>
                <div class="flex w-2/12 justify-end">
                    <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 "
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                        <svg class="w-4 h-4 ml-2" aria-hidden="true"YEAR fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>  
                </div>
            </div>



            <!-- Table -->
            <div class="overflow-scroll mb-1 ">
                <table id="search_table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                    <thead class="w-full bg-gray-100">
                        <tr class="flex w-full divide-x csv">
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCASSET')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ASSETCODE')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ASSETNM_E')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JAN')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FEB')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MAR')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('APR')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MAY')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JUN')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JUL')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AUG')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEP')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('OCT')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NOV')?></span>
                            </th>
                            <th class="w-40 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEC')?></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[192px]"><?php
                        if(!empty($data['ITEM']))  { 
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                            <tr class="flex w-full p-0 divide-x csv" id="rowId<?=$key?>">
                                <td class="h-6 w-40 text-sm border border-slate-700 text-left"><?=isset($value['ACCASSET']) ? $value['ACCASSET']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-left"><?=isset($value['ASSETCD']) ? $value['ASSETCD']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-left"><?=isset($value['ASSETNM_E']) ? $value['ASSETNM_E']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['JAN']) ? $value['JAN']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['FEB']) ? $value['FEB']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['MAR']) ? $value['MAR']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['APR']) ? $value['APR']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['MAY']) ? $value['MAY']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['JUN']) ? $value['JUN']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['JUL']) ? $value['JUL']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['AUG']) ? $value['AUG']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['SEP']) ? $value['SEP']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['OCT']) ? $value['OCT']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['NOV']) ? $value['NOV']: '' ?></td>
                                <td class="h-6 w-40 text-sm border border-slate-700 text-right"><?=isset($value['DECM']) ? $value['DECM']: '' ?></td>
                        </tr><?php 
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                            </tr><?php 
                        }
                    } else {                            
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                                <td class="h-6 w-40 border border-slate-700"></td>
                            </tr><?php
                        }
                    } ?>
                    </tbody>
                </table>
                <div class="flex p-2">
                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                </div>
            </div>



        <!-- JAN -->
        <div class="flex mb-1">
            <div class="flex w-full">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('JAN')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="JANTTL" id="JANTTL" value="<?=isset($data['JANTTL']) ? $data['JANTTL']: ''; ?>"
                    onchange="this.value = numberWithCommas(parseFloat(this.value || 0).toFixed(2));"
                    onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value || 0).toFixed(2)); }"
                    oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('FEB')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="FEBTTL" id="FEBTTL" value="<?=isset($data['FEBTTL']) ? $data['FEBTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('MAR')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="MARTTL" id="MARTTL" value="<?=isset($data['MARTTL']) ? $data['MARTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('APR')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="APRTTL" id="APRTTL" value="<?=isset($data['APRTTL']) ? $data['APRTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('MAY')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="MAYTTL" id="MAYTTL" value="<?=isset($data['MAYTTL']) ? $data['MAYTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('JUN')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="JUNTTL" id="JUNTTL" value="<?=isset($data['JUNTTL']) ? $data['JUNTTL']: ''; ?>"readonly/>

            </div>
        </div>


        <!-- JUL -->
        <div class="flex mb-1">
            <div class="flex w-full">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('JUL')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="JULTTL" id="JULTTL" value="<?=isset($data['JULTTL']) ? $data['JULTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('AUG')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="AUGTTL" id="AUGTTL" value="<?=isset($data['AUGTTL']) ? $data['AUGTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('SEP')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="SEPTTL" id="SEPTTL" value="<?=isset($data['SEPTTL']) ? $data['SEPTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('OCT')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="OCTTTL" id="OCTTTL" value="<?=isset($data['OCTTTL']) ? $data['OCTTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('NOV')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="NOVTTL" id="NOVTTL" value="<?=isset($data['NOVTTL']) ? $data['NOVTTL']: ''; ?>"readonly/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('DEC')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                name="DECTTL" id="DECTTL" value="<?=isset($data['DECTTL']) ? $data['DECTTL']: ''; ?>"readonly/>
            </div>
        </div>



        <!-- button -->
        <div class="flex">
            <div class="flex w-6/12 px-1">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="csv" name="csv" onclick="exportCSV();"><?=checklang('CSV'); ?></button>
            </div>
            <div class="flex w-6/12 px-1 justify-end">
                <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                    onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
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
</body><script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        startDVW();
        $('table#search_table tbody tr').click(function () {
            $('table#search_table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'click-row');
                $('#JANTTL').val(item.eq(3).text() || '0.00');
                $('#FEBTTL').val(item.eq(4).text() || '0.00');
                $('#MARTTL').val(item.eq(5).text() || '0.00');
                $('#APRTTL').val(item.eq(6).text() || '0.00');
                $('#MAYTTL').val(item.eq(7).text() || '0.00');
                $('#JUNTTL').val(item.eq(8).text() || '0.00');
                $('#JULTTL').val(item.eq(9).text() || '0.00');
                $('#AUGTTL').val(item.eq(10).text() || '0.00');
                $('#SEPTTL').val(item.eq(11).text() || '0.00');
                $('#OCTTTL').val(item.eq(12).text() || '0.00');
                $('#NOVTTL').val(item.eq(13).text() || '0.00');
                $('#DECTTL').val(item.eq(14).text() || '0.00');
            }
        });
    });

    function startDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        if(item != '') {
            $('#JANTTL').val('0.00');
            $('#FEBTTL').val('0.00');
            $('#MARTTL').val('0.00');
            $('#APRTTL').val('0.00');
            $('#MAYTTL').val('0.00');
            $('#JUNTTL').val('0.00');
            $('#JULTTL').val('0.00');
            $('#AUGTTL').val('0.00');
            $('#SEPTTL').val('0.00');
            $('#OCTTTL').val('0.00');
            $('#NOVTTL').val('0.00');
            $('#DECTTL').val('0.00');
        }        
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            // var item = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
            // if(item < 1)
            //     return false;
            // return questionDialog(2, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACC_RPTASSETDEPLIST/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACC_RPTASSETDEPLIST/index.php?'+code+'=' + result;
    }
</script>
</html>