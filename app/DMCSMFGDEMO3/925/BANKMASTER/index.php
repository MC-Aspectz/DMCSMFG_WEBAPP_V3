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
                <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
                <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
                <form class="w-full" method="POST" id="bank_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                    <div class="flex flex-col">
                        <div class="flex mb-2">
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('BANK_CODE'); ?></label>
                                <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 ml-1 py-2 px-3 text-gray-700 border-gray-300" type="text" 
                                       id="BANKCD_S" name="BANKCD_S" value="<?=isset($data['BANKCD_S']) ? $data['BANKCD_S']: ''?>" />
                            </div>
                        
                            <div class="flex w-6/12 justify-end">
                                <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-scroll px-2 block h-[380px] max-h-[380px]">
                        <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr class="border border-gray-600">
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BANK_CODE')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BANK_NAME')?></span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                            if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                                foreach($data['ITEM'] as $key => $value) { ?>
                                    <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                        <td class="hidden"><?=isset($value['BANKCDID']) ? $value['BANKCDID']: '' ?></td>
                                        <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['BANKCD']) ? $value['BANKCD']: '' ?></td>
                                        <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['BANKNAME']) ? $value['BANKNAME']: '' ?></td>
                                    </tr><?php
                                }
                            }
                            for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                </tr> <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex p-2">
                        <div class="flex w-full">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowCount"><?=$minrow;?></span></label>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('BANK_CODE'); ?></label>
                            <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 req" 
                                   type="text" id="BANKCD" name="BANKCD" value="<?=isset($BANKCD) ? $BANKCD: '' ?>" onchange="unRequired();" required/>
                            <input type="hidden" id="BANKCDID" name="BANKCDID">
                        </div>
                    
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex">
                        <div class="flex w-6/12 pt-2">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('BANK_NAME'); ?></label>
                            <input class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 req" 
                                   type="text" id="BANKNAME" name="BANKNAME" onchange="unRequired();" required/>
                        </div>
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex pt-4 px-2">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 mr-2 text-center me-2 mb-"
                            id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']['SYSVIS_INSERT']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') { ?> disabled <?php } ?>><?=checklang('INSERT'); ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 mr-2 text-center me-2 mb-"
                            id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPDATE']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 mr-2 text-center me-2 mb-"
                            id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DELETE']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                        </div>
                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-"
                                    id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession(this.form);"><?=checklang('CLEAR'); ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?>
                            </button>
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
<script type="text/javascript">

$(document).ready(function() {
    unRequired();
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    $('table#table tbody tr').click(function () {
        $('table#table tbody tr').removeAttr('id'); entry();
    
        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            $(this).attr('id', 'selected-row');
            // console.log(item.eq(0).text());
            $('#BANKCDID').val(item.eq(0).text());
            $('#BANKCD').val(item.eq(1).text());
            $('#BANKNAME').val(item.eq(2).text());
           
            document.getElementById('INSERT').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;

            unRequired();
            // document.getElementById("CATALOGNAME").value = item.eq(1).text();
        }
    });
});

function validationDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=$lang['validation1']; ?>',
        showCancelButton: false,
        confirmButtonText:  '<?=$lang['yes']; ?>',
        cancelButtonText: '<?=$lang['nono']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
            }
        }
    });
}

</script>
</html>