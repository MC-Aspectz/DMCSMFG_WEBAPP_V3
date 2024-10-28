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
            <form class="w-full" method="POST" id="country_entry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                
                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('COUNTRYCD'); ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                               type="text" id="COUNTRYSEARCH" name="COUNTRYSEARCH" value="<?=$COUNTRYSEARCH?>" />
                    </div>
                
                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                            id="search" name="search" onclick="searchs();"><?=checklang('SEARCH')?>
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
                                <th class="w-50 text-center py-2" scope="col">
                                    <?=checklang('ROWNO');?>
                                </th>
                                <th class="w-100 text-center py-2" scope="col">
                                    <?=checklang('COUNTRYCD');?>
                                </th>
                                <th class="w-100 text-center py-2" scope="col">
                                    <?=checklang('COUNTRYNAME');?>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col overflow-y-scroll w-full h-[500px]">
                        <?php if(!empty($data['COUNTRY']))  {
                            // print_r($data['BANK']); ROWNO,COUNTRYCD,COUNTRYNAME
                                $rowno = 0;
                                foreach ($data['COUNTRY'] as $key => $value) {
                                    if(is_array($value)) {
                                    $minrow = count($data['COUNTRY']);
                                    ?>
                                    <tr class="flex w-full p-0 divide-x">
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=++$rowno?></td>
                                        <td class="h-6 w-100 text-sm pl-1 text-left"><?=isset($value['COUNTRYCD']) ? $value['COUNTRYCD']: '' ?></td>
                                        <td class="h-6 w-100 text-sm pl-1 text-left"><?=isset($value['COUNTRYNAME']) ? $value['COUNTRYNAME']: '' ?></td>
                                    </tr> <?php 
                                    } else {
                                        $minrow = 1; 
                                        // print_r('2'); 
                                        ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-50 text-sm pl-1 text-left"><?=$minrow ?></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"><?=$data['COUNTRY']['COUNTRYCD'] ?></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"><?=$data['COUNTRY']['COUNTRYNAME'] ?></td>
                                        </tr><?php
                                        break;
                                        }
                                    }  
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-100 text-sm pl-1 text-left"></td>
                                        </tr><?php 
                                    }
                            } else {
                                for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                    <tr class="flex w-full p-0 divide-x">
                                        <td class="h-6 w-50 text-sm pl-1 text-left"></td>
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

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('COUNTRYCD'); ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-3/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                               type="text" id="COUNTRYCD" name="COUNTRYCD" value="<?=isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: ''?>" onchange="unRequired();" required/>
                    </div>
                
                    <div class="flex w-6/12"></div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('COUNTRYNAME'); ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-8/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                               type="text" id="COUNTRYNAME" name="COUNTRYNAME" value="<?=isset($data['COUNTRYNAME']) ? $data['COUNTRYNAME']: ''?>" onchange="unRequired();" required />
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
    unRequired()
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    let readonly = '<?php echo (!empty($readonly['SYSEN_COUNTRYCD']) ? $readonly['SYSEN_COUNTRYCD']: 'null'); ?>';
    if(readonly=='F')
    {
        $('#COUNTRYCD').attr('readonly',true).css('background-color', 'whitesmoke');
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;

    }
    else
    {
        $('#COUNTRYCD').removeAttr('readonly').css('background-color', 'white');
        document.getElementById("insert").disabled = false;
        document.getElementById("update").disabled = true;
        document.getElementById("delete").disabled = true;

    }
    // console.log(readonly);
});


$('table#search_table tbody tr').click(function () {
    $('table#search_table tbody tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#COUNTRYCD').val(item.eq(1).text());
        $('#COUNTRYNAME').val(item.eq(2).text());
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        $('#COUNTRYCD').attr('readonly',true).css('background-color', 'whitesmoke');
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();    COUNTRYCD
        unRequired()
    }
});

// COUNTRYCD
// input serach
const COUNTRYCD = $('#COUNTRYCD');

// button search

const input_serach = [COUNTRYCD];

const search = $("search");

const search_icon = [search];


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


function enrty() {
    $('table#search_table tbody tr').removeAttr('id');

    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#COUNTRYCD').removeAttr('readonly').css('background-color', 'white');
    $('#COUNTRYCD').val('');
    $('#COUNTRYNAME').val('');
    unRequired();
}

function unRequired() {

    let COUNTRYCD = document.getElementById("COUNTRYCD");
    let COUNTRYNAME = document.getElementById("COUNTRYNAME");

    COUNTRYCD.classList[COUNTRYCD.value !== '' ? 'remove' : 'add']('req');
    COUNTRYNAME.classList[COUNTRYNAME.value !== '' ? 'remove' : 'add']('req');

}

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
                window.location.href="/DMCS_WEBAPP";          
            }
        }
    });
}

</script>
</html>