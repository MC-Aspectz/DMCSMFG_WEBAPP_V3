<?php 
    require_once('./function/index_x.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  CSS  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/sweetalert2.min.css'; ?>">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <!--  Bootstrap  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Menu  -->
    <?php doMenu(); ?>
    <!-- -------------------------------------------------------------------------------- -->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-10">
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?php echo $packname . ' > ' . $appname; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <form class="form" method="POST" id="inv_bal_report" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ACC_CODE']; ?></label>
                    <input class="form-control width30 " type="text" id="ACCCDF" name="ACCCDF" value="<?=isset($data['ACCCDF']) ? $data['ACCCDF']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <input class="form-control width30 " type="text" id="ACCCDT" name="ACCCDT" value="<?=isset($data['ACCCDT']) ? $data['ACCCDT']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width30 " type="text" id="ITEMCDF" name="ITEMCDF" value="<?=isset($data['ITEMCDF']) ? $data['ITEMCDF']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex3"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <input class="form-control width30 " type="text" id="ITEMCDT" name="ITEMCDT" value="<?=isset($data['ITEMCDT']) ? $data['ITEMCDT']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex4"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['IM_TYPE']; ?></label>
                    <select class="width30 option-text form-select form-select-sm " id="ITEMTYPF" name="ITEMTYPF" >
                        <option value=""></option>
                        <?php foreach ($typf as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMTYPF']) && $data['ITEMTYPF'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <div class="fix-icon" style="margin-top: 2px;" type='hidden'>
                    <a href="#" id="guideindex3"><img style="img-height20" type='hidden'></a>
                    </div>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <select class="width30 option-text form-select form-select-sm " id="ITEMTYPT" name="ITEMTYPT" >
                        <option value=""></option>
                        <?php foreach ($typt as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMTYPT']) && $data['ITEMTYPT'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['STRAGE_CODE']; ?></label>
                    <input class="form-control width30 " type="text" id="STORAGECDF" name="STORAGECDF" value="<?=isset($data['STORAGECDF']) ? $data['STORAGECDF']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex5"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <input class="form-control width30 " type="text" id="STORAGECDT" name="STORAGECDT" value="<?=isset($data['STORAGECDT']) ? $data['STORAGECDT']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex6"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['LBLDATEASOF']; ?></label>
                    <input class="form-control width30 req" type="date" id="ASOFDT" name="ASOFDT" value="<?=isset($data['ASOFDT']) ? date('Y-m-d', strtotime($data['ASOFDT'])): date('Y-m-d'); ?>" required/>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>


        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="th-class table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ACCCD']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['LOCCD']; ?></th><!-- dropdown -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMCD']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['QUANTITY']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['UNIT']; ?></th><!-- dropdown -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['UNIT_PRICE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['AMOUNT']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['INV']))  {
                    // print_r($data['INV']);
                        $rowno = 0;
                        // array_multisort(array_column($data['INV'],'ACCCD'),SORT_ASC,$data['INV']);
                        foreach ($data['INV'] as $key => $value) {
                            if(is_array($value)) {
                                $maxrow = count($data['INV']) + 1;
                                ++$rowno;
                            //   print_r($value);   ACCCD,LOCCD,ITEMCD,ITEMNAME,QTY,UNIT,UNITPRC,AMT
                             ?>
                                <tr class="tr_border table-secondary">
                                    <td class="td-class"><?=isset($value['ACCCD']) ? $value['ACCCD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="td-class"><?=isset($value['QTY']) ? $value['QTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['UNIT']) ? $value['UNIT']: '' ?></td>
                                    <td class="td-class"><?=isset($value['UNITPRC']) ? $value['UNITPRC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['AMT']) ? $value['AMT']: '' ?></td>
                                </tr> <?php 
                            } else {
                                $minrow = 1; 
                                ++$rowno;
                                // print_r('2');    ACCCD,LOCCD,ITEMCD,ITEMNAME,QTY,UNIT,UNITPRC,AMT
                                ?>
                                    <tr class="tr_border table-secondary">
                                        <td class="td-class csv"><?=$data['INV']['ACCCD'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['LOCCD'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['ITEMCD'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['ITEMNAME'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['QTY'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['UNIT'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['UNITPRC'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['AMT'] ?></td>
                                    </tr><?php
                                  break;
                                }
                            }  
                            for ($i = $maxrow; $i <= $maxrow; $i++) { ?>
                                  <tr class="tr_border table-secondary">
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                  </tr><?php 
                            }
                            } else {
                                for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                    <tr class="tr_border table-secondary">
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                        <td class="td-class"></td>
                                    </tr><?php
                                }
                            } ?>
                  </tbody>
              </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=$rowno?></div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="print" name="print"
                    <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'on') ?>><?=$data['TXTLANG']['PRINT']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="csv" name="csv"><?=$lang['csv']; ?></button>
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>


    </form>

    
    <!-- -------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {
});

// var isItem = false;

// $('table#search_table tr').click(function () {
//     $('table#search_table tr').removeAttr('id');

//     $(this).attr('id', 'click-row');
   
//     let item = $(this).closest('tr').children('td');
  
//     if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
//         isItem = true;
//         $('#VOUCHER_NO').html(item.eq(0).text());
//         $('#LINE').html(item.eq(1).text());
//         $('#DATE').html(item.eq(2).text());
//         $('#OPERATION').html(item.eq(3).text());
//         $('#STORAGETYPE').html(item.eq(4).text());
//         $('#STORAGE_CODE').html(item.eq(5).text());
//         $('#LO_NAME').html(item.eq(6).text());
//         $('#WAREHOUSE_QTY').html(item.eq(7).text());
//         $('#QTYOUT').html(item.eq(8).text());
//         $('#ORDER_NO').html(item.eq(9).text());
//         $('#V_ISSUE_DATE').html(item.eq(10).text());
//         $('#REMARK').html(item.eq(11).text());

//     }
// });

// $("#view").on('click', function() {
//     if(isItem) {
//        $('#item_view').modal('show');
//     }
// });    


// ITEMCODE
// input serach

// const input_serach = [ITEMCODE];

// button search
const guideindex1 = $("#guideindex1");//SEARCHACCOUNT
const guideindex2 = $("#guideindex2");//SEARCHACCOUNT
const guideindex3 = $("#guideindex3");//SEARCHITEM
const guideindex4 = $("#guideindex4");//SEARCHITEM
const guideindex5 = $("#guideindex5");//SEARCHSTORAGE
const guideindex6 = $("#guideindex6");//SEARCHSTORAGE
const search = $("#search");//

const search_icon = [guideindex1,guideindex2,guideindex3,guideindex4,guideindex5,guideindex6,search];


guideindex1.attr('href', $('#sessionUrl').val() + '/guide/SEARCHACCOUNT/index.php?index=1');
guideindex2.attr('href', $('#sessionUrl').val() + '/guide/SEARCHACCOUNT/index.php?index=2');
guideindex3.attr('href', $('#sessionUrl').val() + '/guide/SEARCHITEM/index.php?index=3');
guideindex4.attr('href', $('#sessionUrl').val() + '/guide/SEARCHITEM/index.php?index=4');
guideindex5.attr('href', $('#sessionUrl').val() + '/guide/SEARCHSTORAGE/index.php?index=5');
guideindex6.attr('href', $('#sessionUrl').val() + '/guide/SEARCHSTORAGE/index.php?index=6');


for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });

};
// for(const input of input_serach) {
//     input.change(function () {
//         $("#loading").show();
//     });

//     input.keyup(function (e) {
//         if (e.key === 'Enter' || e.keyCode === 13) {
//             $("#loading").show();
//         }
//     });
// };

// ITEMCODE.change(function() {
//     window.location.href="index.php?ITEMCODE=" + ITEMCODE.val();
// });

// ITEMCODE.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         window.location.href="index.php?ITEMCODE=" + ITEMCODE.val();
//     }
// })


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



</script>
</html>
     