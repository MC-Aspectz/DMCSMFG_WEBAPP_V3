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
                <form class="w-full" method="POST" id="branch_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                    <div class="flex mb-1 px-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('BANK_CODE'); ?></label>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="BANKCD" id="BANKCD" value="<?=isset($data['BANKCD']) ? $data['BANKCD']: ''?>" onchange="unRequired();"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="bankIndex">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="BANKNAME" name="BANKNAME" readonly value="<?=isset($data['BANKNAME']) ? $data['BANKNAME']: ''?>"/>
                        </div>
                        <!-- onclick="searchs();" -->
                        <div class="flex w-5/12 justify-end">
                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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
                                    <th class="w-40 text-center py-2" scope="col">
                                        <?=checklang('BRANCH_CODE'); ?>
                                    </th>
                                    <th class="w-full text-center py-2" scope="col">
                                        <?=checklang('BRANCH_NAME'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="flex flex-col overflow-y-scroll w-full h-[500px]">
                            <?php if(!empty($data['BRANCH']))  {
                                // print_r($data['BANK']);
                                    $rowno = 0;
                                    foreach ($data['BRANCH'] as $key => $value) {
                                        if(is_array($value)) {
                                        $minrow = count($data['BRANCH']) ;
                                        //   ++$rowno;
                                        ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['BRANCHCD']) ? $value['BRANCHCD']: '' ?></td>
                                            <td class="h-6 w-full text-sm pl-1 text-left"><?=isset($value['BRANCHNAME']) ? $value['BRANCHNAME']: '' ?></td>
                                        </tr> <?php 
                                        } else {
                                            $minrow = 1; 
                                            // print_r('2'); 
                                            ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=$data['BRANCH']['BRANCHCD'] ?></td>
                                                <td class="h-6 w-full text-sm pl-1 text-left"><?=$data['BRANCH']['BRANCHNAME'] ?></td>
                                            </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 py-2"></td>
                                                <td class="h-6 w-full py-2"></td>
                                            </tr><?php 
                                        }
                                } else {
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-40 py-2"></td>
                                            <td class="h-6 w-full py-2"></td>
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
                    <div class="flex">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['BRANCH_CODE']; ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="text" id="BRANCHCD" name="BRANCHCD" onchange="unRequired();" value="<?=isset($data['BRANCHCD']) ? $data['BRANCHCD']: ''?>"/>
                        </div>
                    
                        <div class="flex w-6/12"></div>
                    </div>
                    <!-- required -->
                    <div class="flex">
                        <div class="flex w-6/12 pt-2">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['BRANCH_NAME']; ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="text" id="BRANCHNAME" name="BRANCHNAME" onchange="unRequired();" value="<?=isset($data['BRANCHNAME']) ? $data['BRANCHNAME']: ''?>"/>
                        </div>
                    
                        <div class="flex w-6/12"></div>
                    </div>
                    
                    <div class="flex pt-12">
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
                                    id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?php echo $data['TXTLANG']['END']; ?></button>
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

    $('table#search_table tr').click(function () {
        $('table#search_table tbody tr').removeAttr('id');

        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            $(this).attr('id', 'selected-row');
            // console.log(item.eq(0).text());
            $('#BRANCHCD').val(item.eq(0).text());
            $('#BRANCHNAME').val(item.eq(1).text());
            document.getElementById("insert").disabled = true;
            document.getElementById("update").disabled = false;
            document.getElementById("delete").disabled = false;
            unRequired()
            // document.getElementById("CATALOGNAME").value = item.eq(1).text();
        }
    });
});

function HandlePopupResultIndex(code, result, index) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/BANKBRANCHMASTER/index.php?'+code+'=' + result + '&index=' + index;
}

function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/BANKBRANCHMASTER/index.php?'+code+'=' + result;
}

// BRANCHCD
// input serach
const BANKCD = $('#BANKCD');
const BRANCHCD = $('#BRANCHCD');

// button search
const input_serach = [BRANCHCD,BANKCD];
// const input_serach = [BANKCD];


const bankIndex = $("#bankIndex");
const search = $("search");

const search_icon = [search,bankIndex];

// bankIndex.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHBANK/index.php');
bankIndex.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHBANK/index.php?page=BANKBRANCHMASTER&index=1', 'authWindow', 'width=1200,height=600');});

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

BRANCHCD.change(function() {
    keepData();
    window.location.href="index.php?BRANCHCD=" + BRANCHCD.val() +'&BANKCD='+BANKCD.val();
});

BRANCHCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        window.location.href="index.php?BRANCHCD=" + BRANCHCD.val() +'&BANKCD='+BANKCD.val();
    }
})
BANKCD.change(function() {
    keepData();
    window.location.href="index.php?BANKCD=" + BANKCD.val();
});

BANKCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        window.location.href="index.php?BANKCD=" + BANKCD.val();
    }
})


function enrty() {
    $('table#search_table tbody tr').removeAttr('id');

    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#BRANCHCD').val('');
    $('#BRANCHNAME').val('');
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

function unRequired() {

    let BANKCD = document.getElementById("BANKCD");
    let BRANCHCD = document.getElementById("BRANCHCD");
    let BRANCHNAME = document.getElementById("BRANCHNAME");

    BANKCD.classList[BANKCD.value !== '' ? 'remove' : 'add']('req');
    BRANCHCD.classList[BRANCHCD.value !== '' ? 'remove' : 'add']('req');
    BRANCHNAME.classList[BRANCHNAME.value !== '' ? 'remove' : 'add']('req');
}

</script>
</html>