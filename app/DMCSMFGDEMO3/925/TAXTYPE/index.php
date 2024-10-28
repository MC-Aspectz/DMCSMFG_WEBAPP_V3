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
                <form class="w-full" method="POST" id="tax_code_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                    <div class="flex mb-1 px-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('TAXTYPECD'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                   type="text" id="TAXTYPESEARCH" name="TAXTYPESEARCH" value="<?=$TAXTYPESEARCH?>" />
                        </div>
                    
                        <div class="flex w-6/12 justify-end">
                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="search" name="search" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-scroll mb-1">
                        <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table">
                            <thead class="w-full bg-gray-100">
                                <tr class="flex w-full divide-x">
                                        <th class="w-64 text-center py-2"><?=checklang('ROWNO'); ?></th>
                                        <th class="w-64 text-center py-2"><?=checklang('TAXTYPECD'); ?></th>
                                        <th class="w-3/6 text-center py-2"><?=checklang('TAXTYPENAME'); ?></th>
                                        <th class="w-64 text-center py-2"><?=checklang('TAXKBN'); ?></th>
                                        <th class="w-64 text-center py-2"><?=checklang('VATRATE'); ?></th>
                                        <th class="w-64 text-center py-2"><?=checklang('TAXTTL'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="flex flex-col w-full h-[500px]">
                            <?php if(!empty($data['TAX']))  {
                                // print_r($data['TAX']);  ROWNO,TAXTYPECD,TAXTTL
                                    $rowno = 0;
                                    foreach ($data['TAX'] as $key => $value) {

                                        if(is_array($value)) {
                                        $minrow = count($data['TAX']) ;
                                        ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-64 text-sm pr-1 text-right"><?=++$rowno?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?=isset($value['TAXTYPECD']) ? $value['TAXTYPECD']: '' ?></td>
                                                <td class="h-6 w-3/6 text-sm pl-1 text-left"><?=isset($value['TAXTYPENAME']) ? $value['TAXTYPENAME']: '' ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left" style="display: none"><?=isset($value['TAXKBN']) ? $value['TAXKBN']: '' ?></td>                                    
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?php 
                                                if(isset($value['TAXKBN'])){
                                                    foreach ($type as $key => $item) { 
                                                            if($key == $value['TAXKBN'])
                                                                {
                                                                    echo($item);
                                                                }
                                                            }                                 
                                                    } ?></td>
                                                <td class="h-6 w-64 text-sm pr-1 text-right"><?=isset($value['VATRATE']) ? $value['VATRATE']: '' ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left" style="display: none;"><?=isset($value['TAXTTL']) ? $value['TAXTTL']: '' ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?php 
                                                if(isset($value['TAXTTL'])){
                                                    foreach ($cate as $key => $item) { 
                                                            if($key == $value['TAXTTL'])
                                                                {
                                                                    echo($item);
                                                                }
                                                            }                                 
                                                    } ?></td>
                                            </tr> <?php 
                                            } else {
                                            $minrow = 1; 
                                            // print_r('3'); 
                                            ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-64 text-sm pr-1 text-right"><?=$minrow ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?=$data['TAX']['TAXTYPECD'] ?></td>
                                                <td class="h-6 w-3/6 text-sm pl-1 text-left" ><?=$data['TAX']['TAXTYPENAME'] ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left" style="display: none;"><?=$data['TAX']['TAXKBN'] ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?php 
                                                    if(isset($data['TAX']['TAXKBN'])){
                                                        foreach ($type as $key => $item) { 
                                                                if($key == $data['TAX']['TAXKBN'])
                                                                    {
                                                                        echo($item);
                                                                    }
                                                                }                                 
                                                    } ?></td>
                                                <td class="h-6 w-64 text-sm pr-1 text-right"><?=$data['TAX']['VATRATE'] ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left" style="display: none;"><?=$data['TAX']['TAXTTL'] ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?php 
                                                    if(isset($data['TAX']['TAXTTL'])){
                                                        foreach ($cate as $key => $item) { 
                                                                if($key == $data['TAX']['TAXTTL'])
                                                                    {
                                                                        echo($item);
                                                                    }
                                                                }                                 
                                                        } ?></td>
                                            </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-64 text-sm pr-1 text-right"></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                                <td class="h-6 w-3/6 text-sm pl-1 text-left"></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                                <td class="h-6 w-64 text-sm pr-1 text-right"></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                            </tr><?php 
                                        }
                                } else {
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-64 text-sm pr-1 text-right"></td>
                                            <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-3/6 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-64 text-sm pr-1 text-right"></td>
                                            <td class="h-6 w-64 text-sm pl-1 text-left"></td>
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                        <div class="flex p-2">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                        </div>
                    </div>
                
                    <div class="flex">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('TAXTYPECD'); ?></label>
                            <label class="text-color block text-sm w-9/12 pr-2 pt-1 ml-2"><?=checklang('TAXTYPENAME'); ?></label>
                        </div>
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('TAXKBN'); ?></label>
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-1"><?=checklang('VATRATE'); ?></label>
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-1"><?=checklang('TAXTTL'); ?></label>

                        </div>
                    </div>

                    <div class="flex">
                        <div class="flex w-6/12">
                            <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="text" id="TAXTYPECD" name="TAXTYPECD" value="<?=isset($data['TAXTYPECD']) ? $data['TAXTYPECD']: ''?>"  onchange="unRequired();"/>
                            <input class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 " 
                                   type="text" id="TAXTYPENAME" name="TAXTYPENAME" value="<?=isset($data['TAXTYPENAME']) ? $data['TAXTYPENAME']: ''?>"  />
                            <!-- ใช้เป็นdata array เวลารีเซ็ตจะได้ไม่หาย -->
                        </div>
                        <div class="flex w-6/12">
                            <select class="text-control shadow-md border mr-1 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="TAXKBN" name="TAXKBN" onchange="unRequired();">
                                <option value=""></option>
                                <?php foreach ($type as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['TAXKBN']) && $data['TAXKBN'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                            <input class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                   type="number" id="VATRATE" name="VATRATE" value="<?=!empty($data['VATRATE']) ? number_format($data['VATRATE'], 2): ''?>"  />
                            <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="TAXTTL" name="TAXTTL" >
                                <option value=""></option>
                                <?php foreach ($cate as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['TAXTTL']) && $data['TAXTTL'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="flex mt-12">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?>
                            </button>
                        </div>
                        
                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?>
                            </button>
                            <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                                    <?php echo $data['TXTLANG']['END']; ?>
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
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    let readonly = '<?php echo (!empty($data['SYSEN_TAXTYPECD']) ? $data['SYSEN_TAXTYPECD']: 'null'); ?>';
    if(readonly=='F')
    {
        $('#TAXTYPECD').attr('readonly',true).css('background-color', 'whitesmoke');
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;

    }
    else
    {
        $('#TAXTYPECD').removeAttr('readonly').css('background-color', 'white');
        document.getElementById("insert").disabled = false;
        document.getElementById("update").disabled = true;
        document.getElementById("delete").disabled = true;

    }

});

$('table#search_table tbody tr').click(function () {
    $('table#search_table tbody tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#TAXTYPECD').val(item.eq(1).text());
        $('#TAXTYPENAME').val(item.eq(2).text());
        $('#VATRATE').val(item.eq(5).text());
        document.getElementById("TAXKBN").value = item.eq(3).text();
        document.getElementById("TAXTTL").value = item.eq(6).text();
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        $('#TAXTYPECD').attr('readonly',true).css('background-color', 'whitesmoke');
        unRequired();
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();    
    }
});

// CURRENCYCD
// input serach

// <!-- CURRENCYCD,CURRENCYUNITTYP,TAXTTL,CURRENCYDISP  -->

function unRequired() {

    let TAXTYPECD = document.getElementById("TAXTYPECD");
    let TAXKBN = document.getElementById("TAXKBN");

    TAXTYPECD.classList[TAXTYPECD.value !== '' ? 'remove' : 'add']('req');
    TAXKBN.classList[TAXKBN.value !== '' ? 'remove' : 'add']('req');

}

function enrty() {
    $('table#search_table tr').removeAttr('id');
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#TAXTYPECD').val('');
    $('#TAXTYPECD').removeAttr('readonly').css('background-color', 'white');
    $('#TAXTYPENAME').val('');
    document.getElementById("TAXKBN").value = '';
    $('#VATRATE').val('');
    document.getElementById("TAXTTL").value = '';
    unRequired();
}

function validationDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=$lang['validation1']; ?>',
        background: '#8ca3a3',
        showCancelButton: false,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText:  '<?=$lang['yes']; ?>',
        cancelButtonText: '<?=$lang['nono']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                window.location.href="/DMCS_WEBAPP";          
            }
        }
    });
}

</script>
</html>