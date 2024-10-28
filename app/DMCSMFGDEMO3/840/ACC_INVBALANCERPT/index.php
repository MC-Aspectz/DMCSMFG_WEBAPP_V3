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
    <form class="form" method="POST" id="acc_invbalancerpt" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['YEARMONTH']; ?></label>
                    <select class="width15 option-text form-select form-select-sm " id="YEAR" name="YEAR" >
                        <option value="<?=date('Y')?>"><?=date('Y')?></option>
                        <?php foreach ($year as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['YEAR']) && $data['YEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <select class="width20 option-text form-select form-select-sm " id="MONTH" name="MONTH" >
                    <option value="<?=date('m')?>"><?=date('F')?></option>
                        <?php foreach ($month as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['MONTH']) && $data['MONTH'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                </div>             
                <div class="flex .col45">
                    <input class="form-control width60" type="hidden" id="RPTDOCEN" name="RPTDOCEN" value="<?=isset($data['RPTDOCEN']) ? $data['RPTDOCEN']: ''?>" />
                    <input class="form-control width60" type="hidden" id="RPTDOCTH" name="RPTDOCTH" value="<?=isset($data['RPTDOCTH']) ? $data['RPTDOCTH']: ''?>" />
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width30 " type="text" id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <label class="label-width4"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                    <input class="form-control width30 " type="text" id="ITEMCD2" name="ITEMCD2" value="<?=isset($data['ITEMCD2']) ? $data['ITEMCD2']: ''?>" />
                    <div class="fix-icon" style="margin-top: 2px;">
                    <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="th-class table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMCODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMUNIT']; ?></th><!--  dropdown -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOQTY03']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOPRC03']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['FIFOAMT03']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['INV']))  {
                    // print_r($data['INV']);
                        $rowno = 0;
                        foreach ($data['INV'] as $key => $value) {
                            if(is_array($value)) {
                                $maxrow = count($data['INV']) + 1;
                                ++$rowno;
                            //   print_r($value);
                             ?>
                                <tr class="tr_border table-secondary">
                                    <td class="td-class"><?=isset($value['WKITEMCD']) ? $value['WKITEMCD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKITEMNAME']) ? $value['WKITEMNAME']: '' ?></td>
                                    <!-- <td class="td-class" style="display: none"><?=isset($value['WKITEMUNITTYP']) ? $value['WKITEMUNITTYP']: '' ?></td> -->
                                    <td class="td-class"><?php 
                                    if(isset($value['WKITEMUNITTYP'])){
                                    foreach ($unit as $key => $item) { 
                                        if($key == $value['WKITEMUNITTYP'])
                                            {
                                                echo($item);
                                            }
                                        }                                 
                                    } ?></td>
                                    <td class="td-class"><?=isset($value['WKRQTY']) ? $value['WKRQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKRUNITPRC']) ? $value['WKRUNITPRC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WKRAMT']) ? $value['WKRAMT']: '' ?></td>
                                    <td class="td-class" style="display: none"><?=$value['DVPERIOD'] ?></td>
                                </tr> <?php 
                            } else {
                                $minrow = 1; 
                                ++$rowno;
                                // print_r('2'); 
                                ?>
                                    <tr class="tr_border table-secondary">
                                        <td class="td-class csv"><?=$data['INV']['WKITEMCD'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['WKITEMNAME'] ?></td>
                                        <!-- <th class="export-exclude" style="display: none"><?=isset($data['INV']['WKITEMUNITTYP']) ? $data['INV']['WKITEMUNITTYP']: '' ?></th> -->
                                        <td class="td-class csv"><?php 
                                        if(isset($data['INV']['WKITEMUNITTYP'])){
                                        foreach ($unit as $key => $item) { 
                                            if($key == $data['INV']['WKITEMUNITTYP'])
                                                {
                                                    echo($item);
                                                }
                                            }                                 
                                        } ?></td>
                                        <td class="td-class csv"><?=$data['INV']['WKRQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['WKRUNITPRC'] ?></td>
                                        <td class="td-class csv"><?=$data['INV']['WKRAMT'] ?></td>
                                        <td class="td-class" style="display: none"><?=$data['CM']['DVPERIOD'] ?></td>
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
                    <button type="button" class="btn btn-action" id="print" name="print"
                    <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'on') ?>><?=$data['TXTLANG']['PRINT(TH)']; ?></button>&emsp;&emsp;
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

//คลิกตาราง คลิกแล้วไปหน้าอื่น
// $('table#search_table tr').click(function () {
//     $('table#search_table tr').removeAttr('id');

//     $(this).attr('id', 'click-row');
   
//     let item = $(this).closest('tr').children('td');

//     if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
//         // console.log(item.eq(0).text());
//         $('#CODEKEY').val(item.eq(0).text());
//         $('#CODE').val(item.eq(1).text());
//         $('#TEXT').val(item.eq(4).text());
//         $('#CODEID').val(item.eq(5).text());
//         // console.log(item.eq(5).text());
//         document.getElementById("LANG").value = item.eq(2).text();
//         // document.getElementById("CATALOGNAME").value = item.eq(1).text();    
//     }
// });

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

guideindex1.attr('href', $('#sessionUrl').val() + '/guide/SEARCHITEM/index.php?index=1');
guideindex2.attr('href', $('#sessionUrl').val() + '/guide/SEARCHITEM/index.php?index=2');

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



</script>
</html>
     