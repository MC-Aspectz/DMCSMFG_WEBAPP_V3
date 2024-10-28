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
    <form class="form" method="POST" id="clearance_month_inq" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['INT_YEAR_MONTH']; ?></label>
                    <select class="width15 option-text form-select form-select-sm" id="YEAR" name="YEAR">
                        <option value=""></option>
                        <?php foreach ($year as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['YEAR']) && $data['YEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <select class="width20 option-text form-select form-select-sm" id="MONTH" name="MONTH">
                        <option value=""></option>
                        <?php foreach ($month as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['MONTH']) && $data['MONTH'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <label class="label-width20"><?php echo $data['TXTLANG']['LAST_CLEARANCE']; ?></label>
                    <input class="form-control width20 " type="text" id="CLEARANCE_ARRANGE_DATE" name="CLEARANCE_ARRANGE_DATE" value="<?=isset($data['CADATE']['CLEARANCE_ARRANGE_DATE']) ? $data['CADATE']['CLEARANCE_ARRANGE_DATE']: ''?>" readonly/>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['CLEARANCE_ID']; ?></label>
                    <select class="width30 option-text form-select form-select-sm" id="CLEARANCE" name="CLEARANCE">
                        <option value=""></option>
                        <?php foreach ($clear as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['CLEARANCE']) && $data['CLEARANCE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                    <input type="checkbox"  id="ADJUSTFLG" name="ADJUSTFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['ADJUSTFLG']) && $data['ADJUSTFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width40"><?php echo $data['TXTLANG']['CLEARANCEMSGADJUST']; ?></label>
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ZENKAI_PRO']; ?></label>
                    <input class="form-control width20 " type="text" id="LASTBATCHMONTH" name="LASTBATCHMONTH" value="<?=isset($data['CADATE']['LASTBATCHMONTH']) ? $data['CADATE']['LASTBATCHMONTH']: ''?>" readonly/>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['IM_TYPE']; ?></label>
                    <select class="width20 option-text form-select form-select-sm" id="ITEMTYPE" name="ITEMTYPE">
                        <option value=""></option>
                        <?php foreach ($ityp as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMTYPE']) && $data['ITEMTYPE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
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
                    <label class="label-width20"><?php echo $data['TXTLANG']['DIVISIONCODE']; ?></label>
                    <input class="form-control width20 " type="text" id="DIVISIONCD" name="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''?>" />
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <input class="form-control width20 " type="text" id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''?>" readonly/>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width20 " type="text" id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>" />
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <input class="form-control width20 " type="text" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''?>" readonly/>
                    <input class="form-control width20 " type="text" id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''?>" readonly/>&emsp;
                    <input type="checkbox" id="ALLITEM" name="ALLITEM" value="T" style="width: 15px"
                    <?php echo (!empty($data['ALLITEM']) && $data['ALLITEM'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width10"><?php echo $data['TXTLANG']['SHOWALL']; ?></label>
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
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['IM_TYPE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMCODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMSPEC']; ?></th><!-- dropdown -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['THIS_END_INV']; ?></th><!-- dropdown -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['INVACTUALQTY']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CLEARANCE_DIFF_QTY']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['CMI']))  {
                    // print_r($data['CMI']); ITEMTYP,IMCODE,IMNAME,IMSPEC,INVMONTHQTY,CLEARANCEQTY,INVDIFFQTY,SPACE
                        $rowno = 0;
                        foreach ($data['CMI'] as $key => $value) {
                            if(is_array($value)) {
                                $maxrow = count($data['CMI']) + 1;
                                ++$rowno;
                            //   print_r($value);
                             ?>
                                <tr class="tr_border table-secondary">
                                    <!-- <td class="td-class" style="display: none"><?=isset($value['ITEMTYP']) ? $value['ITEMTYP']: '' ?></td> -->
                                    <td class="td-class"><?php 
                                    if(isset($value['ITEMTYP'])){
                                    foreach ($ityp as $key => $item) { 
                                        if($key == $value['ITEMTYP'])
                                            {
                                                echo($item);
                                            }
                                        }                                 
                                    } ?></td>
                                    <td class="td-class"><?=isset($value['IMCODE']) ? $value['IMCODE']: '' ?></td>
                                    <td class="td-class"><?=isset($value['IMNAME']) ? $value['IMNAME']: '' ?></td>
                                    <td class="td-class"><?=isset($value['IMSPEC']) ? $value['IMSPEC']: '' ?></td>
                                    <td class="td-class"><?=isset($value['INVMONTHQTY']) ? $value['INVMONTHQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['CLEARANCEQTY']) ? $value['CLEARANCEQTY']: '' ?></td>
                                    <td class="td-class"><?=isset($value['INVDIFFQTY']) ? $value['INVDIFFQTY']: '' ?></td>
                                </tr> <?php 
                            } else {
                                $minrow = 1; 
                                ++$rowno;
                                // print_r('2'); 
                                ?>
                                    <tr class="tr_border table-secondary">
                                        <!-- <th class="export-exclude" style="display: none"><?=isset($data['CMI']['ITEMTYP']) ? $data['CMI']['ITEMTYP']: '' ?></th> -->
                                        <td class="td-class csv"><?php 
                                        if(isset($data['CMI']['ITEMTYP'])){
                                        foreach ($ityp as $key => $item) { 
                                            if($key == $data['CMI']['ITEMTYP'])
                                                {
                                                    echo($item);
                                                }
                                            }                                 
                                        } ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['IMCODE'] ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['IMNAME'] ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['IMSPEC'] ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['INVMONTHQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['CLEARANCEQTY'] ?></td>
                                        <td class="td-class csv"><?=$data['CMI']['INVDIFFQTY'] ?></td>
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
                    <button type="button" class="btn btn-action" id="view" name="view" 
                    <?php if(!empty($data['isView']) && $data['isView'] == 'on') ?>><?=$data['TXTLANG']['DETAIL']; ?></button>
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

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <label class="font-size16"><?php echo $lang['detail']; ?></label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- IM_TYPE,ITEMCODE,ITEMNAME,ITEMSPEC,THIS_END_INV:R,INVACTUALQTY:R,CLEARANCE_DIFF_QTY:R,SPACE -->
           <table class="table-head" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                <thead>
                    <tr class="th-class">
                        <th style="text-align: left; padding-left: 2%;"><?=$data['TXTLANG']['TITLE']; ?></th>
                        <th style="text-align: center;"><?=$data['TXTLANG']['VALUE']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['IM_TYPE']; ?></td>
                        <td class="td-class" id="IM_TYPE" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']['ITEMCODE']; ?></td>
                        <td class="td-class" id="ITEMCODE"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['ITEMNAME']; ?></td>
                        <td class="td-class" id="ITEMNAME1" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']['ITEMSPEC']; ?></td>
                        <td class="td-class" id="ITEMSPEC"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['THIS_END_INV']; ?></td>
                        <td class="td-class" id="THIS_END_INV" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']['INVACTUALQTY']; ?></td>
                        <td class="td-class" id="INVACTUALQTY"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['CLEARANCE_DIFF_QTY']; ?></td>
                        <td class="td-class" id="CLEARANCE_DIFF_QTY" style="background-color:#ffe6cc;"></td>
                    </tr>
                    

                </tbody>
            </table>
            <br>
            <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?> 12</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-action" data-bs-dismiss="modal"><?=$data['TXTLANG']['END']; ?></button>
        </div>
    </div>
  </div>
</div>
    <!-- -------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {
});

var isItem = false;



$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');
  
    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        $('#IM_TYPE').html(item.eq(0).text());
        $('#ITEMCODE').html(item.eq(1).text());
        $('#ITEMNAME1').html(item.eq(2).text());
        $('#ITEMSPEC').html(item.eq(3).text());
        $('#THIS_END_INV').html(item.eq(4).text());
        $('#INVACTUALQTY').html(item.eq(5).text());
        $('#CLEARANCE_DIFF_QTY').html(item.eq(6).text());
    }
});

$("#view").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    


// input serach
// const DIVISIONCD = $("#DIVISIONCD");
// const ITEMCD = $("#ITEMCD");

const input_serach = [DIVISIONCD,ITEMCD,];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const search = $("#search");

const search_icon = [guideindex1,guideindex2,search];

guideindex1.attr('href', $('#sessionUrl').val() + '/guide/SEARCHDIVISION/index.php?index=1');
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
DIVISIONCD.change(function() {
    keepData();
    window.location.href="index.php?DIVISIONCD=" + DIVISIONCD.val();
});

DIVISIONCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
       keepData();
       window.location.href="index.php?DIVISIONCD=" + DIVISIONCD.val();
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
     