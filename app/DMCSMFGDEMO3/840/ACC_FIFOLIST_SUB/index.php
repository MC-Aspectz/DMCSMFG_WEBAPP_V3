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
    <input type="hidden" id="urlRoute" name="urlRoute" value="<?=$urlRoute?>">
    <form class="form" method="POST" id="acc_fifolist_sub" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['YEARMONTH']; ?></label>
                    <select class="width15 option-text form-select form-select-sm " id="YEAR" name="YEAR" readonly>
                        <option value="<?=date('Y')?>"><?=date('Y')?></option>
                        <?php foreach ($year as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['YEAR']) && $data['YEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <select class="width20 option-text form-select form-select-sm " id="MONTH" name="MONTH" readonly>
                    <option value="<?=date('m')?>"><?=date('F')?></option>
                        <?php foreach ($month as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['MONTH']) && $data['MONTH'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <select class="width15 option-text form-select form-select-sm " id="YEAR2" name="YEAR2" readonly>
                    <option value="<?=date('Y')?>"><?=date('Y')?></option>
                        <?php foreach ($year2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['YEAR2']) && $data['YEAR2'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <select class="width20 option-text form-select form-select-sm " id="MONTH2" name="MONTH2" readonly>
                    <option value="<?=date('m')?>"><?=date('F')?></option>
                        <?php foreach ($month2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['MONTH2']) && $data['MONTH2'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width15 " type="text" id="ITEMCODES" name="ITEMCODES" value="<?=isset($data['ITEMCODES']) ? $data['ITEMCODES']: '::WKITEMCD:'?>" readonly/>
                    <input class="form-control width32" type="text" id="ITEMNAMES" name="ITEMNAMES" value="<?=isset($data['ITEMNAMES']) ? $data['ITEMNAMES']: '::WKITEMNAME:'?>" readonly/>
                    <input class="form-control width32" type="text" id="ITEMSPECS" name="ITEMSPECS" value="<?=isset($data['ITEMSPECS']) ? $data['ITEMSPECS']: '::WKITEMSPEC:'?>" readonly/>
                </div>             
                <div class="flex .col45">
                    <input class="form-control width20" type="text" id="WKITEMUNITTYPS" name="WKITEMUNITTYPS" value="<?=isset($data['WKITEMUNITTYPS']) ? $data['WKITEMUNITTYPS']: '::WKITEMUNITTYP:'?>" readonly/>
                    <!-- <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp; -->
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="th-class table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['DATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ORDERNO']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['VOUCHERNO']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOQTY01']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOPRC01']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOAMT01']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOQTY02']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOPRC02']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOAMT02']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOQTY03']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOPRC03']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOAMT03']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['FIFO']))  {
                    // print_r($data['FIFO']);
                        $rowno = 0;
                        foreach ($data['FIFO'] as $key => $value) {
                            if(is_array($value)) {
                                $maxrow = count($data['FIFO']) + 1;
                                ++$rowno;
                            //   print_r($value);
                             ?>
                             <!-- WKISSUEDT,WKORDERNO,WKTRANNO,WKDQTY,WKDUNITPRC,WKDAMT,WKCQTY,WKCUNITPRC,WKCAMT,WKRQTY,WKRUNITPRC,WKRAMT,SPACE -->
                                <tr class="tr_border table-secondary">
                                    <td class="td-class"><?=isset($value['WKISSUEDT']) ? date('d/m/Y', strtotime($value['WKISSUEDT'])): ''  ?></td>
                                    <td class="td-class"><?=isset($value['WKORDERNO']) ? $value['WKORDERNO']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKTRANNO']) ? $value['WKTRANNO']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKDQTY']) ? $value['WKDQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKDUNITPRC']) ? $value['WKDUNITPRC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKDAMT']) ? $value['WKDAMT']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKCQTY']) ? $value['WKCQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKCUNITPRC']) ? $value['WKCUNITPRC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKCAMT']) ? $value['WKCAMT']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKRQTY']) ? $value['WKRQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKRUNITPRC']) ? $value['WKRUNITPRC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKRAMT']) ? $value['WKRAMT']: '' ?></td>
                                    <!-- <td class="td-class" style="display: none"><?=$value['DVPERIOD'] ?></td>
                                    <td class="td-class" style="display: none"><?=$value['WKITEMSPEC'] ?></td> -->
                                </tr> <?php 
                            } else {
                                $minrow = 1; 
                                ++$rowno;
                                // print_r('2'); 
                                ?>
                                    <tr class="tr_border table-secondary">
                                        <td class="td-class csv"><?=isset($data['FIFO']['WKISSUEDT']) ? date('d/m/Y', strtotime($data['FIFO']['WKISSUEDT'])): ''  ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKORDERNO'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKTRANNO'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKDQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKDUNITPRC'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKDAMT'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKCQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKCUNITPRC'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKCAMT'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKRQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKRUNITPRC'] ?></td>
                                        <td class="td-class csv"><?=$data['FIFO']['WKRAMT'] ?></td>
                                        <!-- <td class="td-class" style="display: none"><?=$data['FIFO']['DVPERIOD'] ?></td>
                                        <td class="td-class" style="display: none"><?=$data['FIFO']['WKITEMSPEC'] ?></td> -->
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
                    <button type="button" class="btn btn-action" id="csv" name="csv"><?=$lang['csv']; ?></button>&emsp;&emsp;
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" id="back" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['BACK']; ?></button>
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


//คลิกตาราง คลิกแล้วไปหน้าอื่น
// $('table#search_table tr').click(function () {
//     $('table#search_table tr').removeAttr('id');

//     $(this).attr('id', 'click-row');
   
//     let item = $(this).closest('tr').children('td');

//     if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
//         $("#loading").show();
//         window.location.href=$("#urlRoute").val()+'?YEAR='+$("#YEAR").val()+'&MONTH'+$("#MONTH").val()                             
//                                                 +'&YEAR2'+$("#YEAR2").val()+'&MONTH2'+$("#MONTH2").val();
//                                                 +'&WKITEMCD'+item.eq(0).text()+'&WKITEMNAME'+item.eq(1).text();
//                                                 +'&WKITEMSPEC'+item.eq(16).text()+'&WKITEMUNITTYP'+item.eq(2).text();
//     }
// });

// ITEMCD
// input serach
// const ITEMCD = $("#ITEMCD");

// const input_serach = [ITEMCD];

// button search
// const guideindex1 = $("#guideindex1");

// guideindex1.attr('href', $('#sessionUrl').val() + '/guide/SEARCHITEM/index.php');

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

// ITEMCD.change(function() {
//     window.location.href="index.php?ITEMCD=" + ITEMCD.val();
// });

// ITEMCD.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         window.location.href="index.php?ITEMCD=" + ITEMCD.val();
//     }
// })

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



</script>
</html>
     