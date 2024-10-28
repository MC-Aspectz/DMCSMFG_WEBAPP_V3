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
                <form class="w-full" method="POST" id="city_entry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('COUNTRYCD'); ?></label>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    name="COUNTRYCD" id="COUNTRYCD" value="<?=isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: ''?>" onchange="unRequired();"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex1">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                                   type="text" id="COUNTRYNAME" name="COUNTRYNAME" readonly value="<?=isset($data['COUNTRYNAME']) ? $data['COUNTRYNAME']: ''?>"/>
                        </div>                    
                    </div>

                    <div class="flex mb-1 px-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('STATECD'); ?></label>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    name="STATECD" id="STATECD" value="<?=isset($data['STATECD']) ? $data['STATECD']: ''?>" onchange="unRequired();"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex2">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="STATENAME" name="STATENAME" readonly value="<?=isset($data['STATENAME']) ? $data['STATENAME']: ''?>"/>
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

                    <div class="overflow-scroll mb-1 mt-3"> 
                        <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table">
                            <thead class="w-full bg-gray-100">
                                <tr class="flex w-full divide-x">
                                    <th class="w-40 text-center py-2" scope="col">
                                        <?=checklang('ROWNO'); ?>
                                    </th>
                                    <th class="w-100 text-center py-2" scope="col">
                                        <?=checklang('CITYCD'); ?>
                                    </th>
                                    <th class="w-100 text-center py-2" scope="col">
                                        <?=checklang('CITYNAME'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="flex flex-col overflow-y-scroll w-full h-[450px]">
                            <?php if(!empty($data['CITY']))  {
                                // print_r($data['CITY']);  ROWNO,CITYCD,CITYNAME
                                    $rowno = 0;
                                    foreach ($data['CITY'] as $key => $value) {

                                        if(is_array($value)) {
                                        $minrow = count($data['CITY']);
                                        ?>
                                        <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=++$rowno?></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"><?=isset($value['CITYCD']) ? $value['CITYCD']: '' ?></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"><?=isset($value['CITYNAME']) ? $value['CITYNAME']: '' ?></td>
                                        </tr> <?php 
                                        } else {
                                            $minrow = 1; 
                                            // print_r('2'); 
                                            ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=$minrow ?></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"><?=$data['CITY']['CITYCD'] ?></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"><?=$data['CITY']['CITYNAME'] ?></td>
                                            </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                                <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                            </tr><?php 
                                        }
                                } else {
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-40 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                        <div class="flex p-2">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                        </div>
                    </div>

                    <!-- required -->
                    <div class="flex mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('CITYCD'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="text" id="CITYCD" name="CITYCD" value="<?=isset($data['CITYCD']) ? $data['CITYCD']: ''?>" onchange="unRequired();" />
                        </div>
                    </div>

                    <div class="flex mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('CITYNAME'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="text" id="CITYNAME" name="CITYNAME" value="<?=isset($data['CITYNAME']) ? $data['CITYNAME']: ''?>" onchange="unRequired();" />
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
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                                    <?php echo $data['TXTLANG']['END']; ?>
                            </button>
                        </div>
                    </div>

                </form>
                <!-- -------------------------------------------------------------------------------- -->
                <div id="loading" class="on" style="display: none;">
                    <div class="cv-spinner">
                        <div class="spinner"></div>
                    </div>
                </div>
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
    let readonly = '<?php echo (!empty($readonly['SYSEN_CITYCD']) ? $readonly['SYSEN_CITYCD']: 'null'); ?>';
    if(readonly=='F')
    {
        $('#CITYCD').attr('readonly',true).css('background-color', 'whitesmoke');
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;

    }
    else
    {
        $('#CITYCD').removeAttr('readonly').css('background-color', 'white');
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
        $('#CITYCD').val(item.eq(1).text());
        $('#CITYNAME').val(item.eq(2).text());
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        $('#CITYCD').attr('readonly',true).css('background-color', 'whitesmoke');
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();
        unRequired();
    }
});

// CITYCD
// input serach
const CITYCD = $('#CITYCD');
const STATECD = $('#STATECD');
const COUNTRYCD = $('#COUNTRYCD');

const input_serach = [CITYCD,COUNTRYCD,STATECD];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const search = $("#search");

const search_icon = [guideindex1,guideindex2,search];

// ทำหน้าsearchเพิ่ม
// guideindex1.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY1/index.php');
guideindex1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY1/index.php?page=CITYENTRY&index=1', 'authWindow', 'width=1200,height=600');});
// guideindex2.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTATE/index.php?COUNTRYCD=' + COUNTRYCD.val());
guideindex2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTATE/index.php?page=CITYENTRY&index=1&COUNTRYCD=' + COUNTRYCD.val(), 'authWindow', 'width=1200,height=600');});

for(const input of input_serach) {
    input.change(function () {
        $("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
       keepData(); 
    });
};

CITYCD.change(function() {
    keepData(); 
    window.location.href="index.php?CITYCD=" + CITYCD.val() +'&COUNTRYCD=' +COUNTRYCD.val() +'&STATECD=' +STATECD.val();
});

CITYCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?CITYCD=" + CITYCD.val() +'&COUNTRYCD=' +COUNTRYCD.val() +'&STATECD=' +STATECD.val();
    }
})

STATECD.change(function() {
    keepData(); 
    window.location.href="index.php?STATECD=" + STATECD.val()  +'&COUNTRYCD=' +COUNTRYCD.val();
});

STATECD.keyup(function(e) {
    if(COUNTRYCD.val()==''){
        COUNTRYCD.val('');
    }
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?STATECD=" + STATECD.val()  +'&COUNTRYCD=' +COUNTRYCD.val();
    }
})

COUNTRYCD.change(function() {
    keepData(); 
    window.location.href="index.php?COUNTRYCD=" + COUNTRYCD.val();
});

COUNTRYCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?COUNTRYCD=" + COUNTRYCD.val();
    }
})

function HandlePopupResultIndex(code, result, index) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/CITYENTRY/index.php?'+code+'=' + result + '&index=' + index;
}

function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/CITYENTRY/index.php?'+code+'=' + result;
}

function HandlePopupResultMultiple(code, result, code2, result2) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/CITYENTRY/index.php?'+code+'=' + result + '&'+code2+'=' + result2;
}

function enrty() {
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#CITYCD').removeAttr('readonly').css('background-color', 'white');
    $('#CITYCD').val('');
    $('#CITYNAME').val('');
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