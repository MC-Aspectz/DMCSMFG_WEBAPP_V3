<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
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
            <form class="w-full" method="POST" action="" id="clearanceOnhandUpdate" name="clearanceOnhandUpdate" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LO_CODE')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300" id="LOCTYP" name="LOCTYP">
                            <option value=""></option>
                            <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                        <div class="relative w-5/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHLOC">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                        <div class="flex w-5/12 justify-end">
                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-scroll px-2 block h-[630px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-1 text-center border border-slate-700">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="hidden"><?=$key?></td>
                                    <td class="h-6 w-10 text-sm text-center">
                                        <input type="hidden" id="CHECKROWH<?=$key?>" name="CHECKROW[]" value="F" <?=isset($value['CHKROW']) && $value['CHKROW'] == 'T' ? 'disabled' : '' ?>/>
                                        <input class="chkbox" type="checkbox" id="CHECKROW<?=$key?>" name="CHECKROW[]" value="T" 
                                                onchange="chked(<?=$key?>);" <?=isset($value['CHKROW']) && $value['CHKROW'] == 'T' ? 'checked' : '' ?>/>
                                    </td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CLEARANCELOCTYP']) ? $STORAGETYPE[$value['CLEARANCELOCTYP']]: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CLEARANCELOCCD']) ? $value['CLEARANCELOCCD']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CLEARANCELOCNAME']) ? $value['CLEARANCELOCNAME']: '' ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SPACE']) ? $value['SPACE']: '' ?></td>

                                    <input type="hidden" id="CLEARANCELOCTYP<?=$key?>" name="CLEARANCELOCTYP[]" value="<?=isset($value['CLEARANCELOCTYP']) ? $value['CLEARANCELOCTYP']: '' ?>"/>
                                    <input type="hidden" id="CLEARANCELOCCD<?=$key?>" name="CLEARANCELOCCD[]" value="<?=isset($value['CLEARANCELOCCD']) ? $value['CLEARANCELOCCD']: '' ?>"/>
                                    <input type="hidden" id="CLEARANCELOCNAME<?=$key?>" name="CLEARANCELOCNAME[]" value="<?=isset($value['CLEARANCELOCNAME']) ? $value['CLEARANCELOCNAME']: '' ?>"/>
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

                <div class="flex p-2">
                    <div class="flex w-12/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LAST_CLEARANCE');?></label>
                    <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                            name="CLEARANCEDT" id="CLEARANCEDT" value="<?=!empty($data['CLEARANCEDT']) ? date('Y-m-d', strtotime($data['CLEARANCEDT'])) : ''; ?>"/>

                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CLEARANCE_ID');?></label>

                    <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="CLEARANCE" name="CLEARANCE">
                            <option value=""></option>
                            <?php foreach ($CLEARANCE as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['CLEARANCE']) && $data['CLEARANCE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                    </select>
                    <input class="hidden" type="text" id="Z" name="Z">
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="$('#loading').show(); unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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
</body>
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
    $('table#table tbody tr').click(function () {
        $('table#table tbody tr').removeAttr('id');
        let item = $(this).closest('tr').children('td');
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            // console.log(item.eq(0).text());
            $(this).attr('id', 'selected-row');
        }
    });
});

function checkedAll() {
    var checkall = document.getElementById('CHKALL');
    var dvw = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>'; 
    if(dvw != '') {
        let dvwArray = JSON.parse(dvw);
        $.each(dvwArray, function(key, value) {  
            // console.log(key);
            if (checkall.checked) {
                $('#CHECKROW'+key+'').prop('checked', true);
                document.getElementById('CHECKROWH'+key+'').disabled = true;
            } else {
                $('#CHECKROW'+key+'').prop('checked', false);
                document.getElementById('CHECKROWH'+key+'').disabled = false;
            }
        });
    }
}

function chked(index) {
  // console.log(index);
    if (document.getElementById('CHECKROW' + index + '').checked) {
        document.getElementById('CHECKROWH' + index + '').disabled = true;
    } else {
        document.getElementById('CHECKROWH' + index + '').disabled = false;
    }
}

function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
    return getLoc(result, $('#LOCTYP').val());
}

function errorDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=lang('ERRORUNCHECK'); ?>',
        showCancelButton: false,
        confirmButtonText:  '<?=lang('yes'); ?>',
        cancelButtonText: '<?=lang('no'); ?>'
        }).then((result) => {
        if (result.isConfirmed) {
        }
    });
}
</script>