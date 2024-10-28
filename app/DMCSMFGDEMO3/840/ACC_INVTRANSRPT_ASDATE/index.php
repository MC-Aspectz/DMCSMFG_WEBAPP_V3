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
                <form class="w-full" method="POST" id="acc_invtransrpt_asdate" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                
                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-4/12">
                            <label class="text-color block text-sm w-2/12 pr-1 pt-1 ml-2"><?=checklang('LBLDATE'); ?></label>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   type="date" id="RPTDATE1" name="RPTDATE1" value="<?=isset($data['RPTDATE1']) ? $data['RPTDATE1']: ''?>" />
                            <label class="text-color block text-xl pr-2 mr-1 ml-2"><?=checklang('ARROW'); ?></label>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   type="date" id="RPTDATE2" name="RPTDATE2" value="<?=isset($data['RPTDATE2']) ? $data['RPTDATE2']: ''?>" />
                        </div>         

                        <div class="flex w-8/12 justify-end">
                            <input class="hidden" id="RPTDOCEN" name="RPTDOCEN" value="<?=isset($data['RPTDOCEN']) ? $data['RPTDOCEN']: ''?>" />
                            <input class="hidden" id="RPTDOCTH" name="RPTDOCTH" value="<?=isset($data['RPTDOCTH']) ? $data['RPTDOCTH']: ''?>" />
                            <input class="hidden" id="RPTDOC" name="RPTDOC" value="<?=isset($data['RPTDOC']) ? $data['RPTDOC']: ''?>" />
                            <label class="text-color block text-sm w-2/12 pr-1 pt-1 ml-2">&emsp;&emsp;<?=checklang('ITEMCODE'); ?></label>
                            <div class="relative w-3/12">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex1">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <label class="text-color block text-xl pr-2 mr-1 ml-2"><?=checklang('ARROW'); ?></label>
                            <div class="relative w-3/12">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="ITEMCD2" id="ITEMCD2" value="<?=isset($data['ITEMCD2']) ? $data['ITEMCD2']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex2">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <label class="text-color block text-xl w-1/12 pr-2 mr-1 ml-2"></label>
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
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE'); ?></span>
                                        </th>
                                        <th class="w-64 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMUNIT'); ?></span>
                                        </th><!--  dropdown -->
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE'); ?></span>
                                        </th><!--  date -->
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFOTRANNO'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFOREFNO'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFOQTY01'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFOQTY02'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFOQTY03'); ?></span>
                                        </th>
                                        <th class="w-40 text-center py-2" scope="col">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                                        </th>
                                </tr>
                            </thead>
                            <tbody class="flex flex-col overflow-y-scroll w-full h-[450px]">
                            <?php if(!empty($data['INV']))  {
                                // print_r($data['INV']);
                                    $rowno = 0;
                                    foreach ($data['INV'] as $key => $value) {
                                        if(is_array($value)) {
                                            $maxrow = count($data['INV']) + 1;
                                            ++$rowno;
                                        //   print_r($value);
                                        ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKITEMCD']) ? $value['WKITEMCD']: '' ?></td>
                                                <td class="h-6 w-64 text-sm pl-1 text-left"><?=isset($value['WKITEMNAME']) ? $value['WKITEMNAME']: '' ?></td>
                                                <!-- <td class="h-6 w-40 text-sm pl-1 text-left" style="display: none"><?=isset($value['WKITEMUNITTYP']) ? $value['WKITEMUNITTYP']: '' ?></td> -->
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?php 
                                                if(isset($value['WKITEMUNITTYP'])){
                                                foreach ($unit as $key => $item) { 
                                                    if($key == $value['WKITEMUNITTYP'])
                                                        {
                                                            echo($item);
                                                        }
                                                    }                                 
                                                } ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKISSUEDT']) ? date('d/m/Y', strtotime($value['WKISSUEDT'])): ''  ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKTRANNO']) ? $value['WKTRANNO']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKREFNO']) ? $value['WKREFNO']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKDQTY']) ? $value['WKDQTY']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKCQTY']) ? $value['WKCQTY']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['WKRQTY']) ? $value['WKRQTY']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left" style="display: none"><?=$value['DVPERIOD'] ?></td>
                                            </tr> <?php 
                                        } else {
                                            $minrow = 1;
                                            ++$rowno;
                                            // print_r('2'); 
                                            ?>
                                                <tr class="flex w-full p-0 divide-x">
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKITEMCD'] ?></td>
                                                    <td class="h-6 w-64 text-sm pl-1 text-left csv"><?=$data['INV']['WKITEMNAME'] ?></td>
                                                    <!-- <th class="export-exclude" style="display: none"><?=isset($data['INV']['WKITEMUNITTYP']) ? $data['INV']['WKITEMUNITTYP']: '' ?></th> -->
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?php 
                                                    if(isset($data['INV']['WKITEMUNITTYP'])){
                                                    foreach ($unit as $key => $item) { 
                                                        if($key == $data['INV']['WKITEMUNITTYP'])
                                                            {
                                                                echo($item);
                                                            }
                                                        }                                 
                                                    } ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=isset($data['INV']['WKISSUEDT']) ? date('d/m/Y', strtotime($data['INV']['WKISSUEDT'])): ''  ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKTRANNO'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKREFNO'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKDQTY'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKCQTY'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['WKRQTY'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left" style="display: none"><?=$data['CM']['DVPERIOD'] ?></td>
                                                </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $maxrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-64 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                            </tr><?php 
                                        }
                                        } else {
                                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                                <tr class="w-full p-0 divide-x">
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-64 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                </tr><?php
                                            }
                                        } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$rowno;?></span></label>
                    </div>

                    <div class="flex mt-6">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="PRINTEN" name="PRINTEN"
                                    <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'on') ?>><?=$data['TXTLANG']['PRINT']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="PRINTTH" name="PRINTTH"
                                    <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'on') ?>><?=$data['TXTLANG']['PRINT(TH)']; ?>
                            </button>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?php echo $data['TXTLANG']['END']; ?>
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
});



// ITEMCD
// input serach
const ITEMCD = $("#ITEMCD");
const ITEMCD2 = $("#ITEMCD2");

const input_serach = [ITEMCD,ITEMCD2];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const search = $("search");

const search_icon = [guideindex1,guideindex2,search];

// guideindex1.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?index=1');
guideindex1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_INVTRANSRPT_ASDATE&index=1', 'authWindow', 'width=1200,height=600');});
// guideindex2.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?index=2');
guideindex2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_INVTRANSRPT_ASDATE&index=2', 'authWindow', 'width=1200,height=600');});

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

ITEMCD.change(function() {
    keepData();
window.location.href="index.php?ITEMCD=" + ITEMCD.val();
});

ITEMCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        window.location.href="index.php?ITEMCD=" + ITEMCD.val();
    }
})

ITEMCD2.change(function() {
    keepData();
    window.location.href="index.php?ITEMCD2=" + ITEMCD2.val();
});

ITEMCD2.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        window.location.href="index.php?ITEMCD2=" + ITEMCD2.val();
    }
})

// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

// function enrty() {
//     $('#CODEKEY').val('');
//     $('#CODE').val('');
//     document.getElementById("LANG").value = '';
//     $('#TEXT').val('');
//     $('#CODEID').val('');
// }

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

function printDialog() {
       return questionDialog(4, '<?=$lang['question4']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
    }

function printCheckEN() {
    var dataItem = '<?php echo (!empty($data['INV']) ? count($data['INV']) : 0); ?>';
    if (dataItem < 1) {
        return printWarning();
    } else {
        return action('printen');
    }
}

function printCheckTH() {
    var dataItem = '<?php echo (!empty($data['INV']) ? count($data['INV']) : 0); ?>';
    if (dataItem < 1) {
        return printWarning();
    } else {
        return action('printth');
    }
}

function printWarning() {
    return Swal.fire({ 
        title: '',
        text: '<?=lang('MSG_PRINT'); ?>',
        showCancelButton: false,
        confirmButtonText: '<?=lang('yes'); ?>',
        cancelButtonText: '<?=lang('nono'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
        }
    });
}

</script>
</html>
     