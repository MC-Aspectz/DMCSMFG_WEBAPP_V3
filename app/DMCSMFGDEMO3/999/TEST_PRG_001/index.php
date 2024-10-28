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
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?=$packname . ' > ' . $appname; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?=$_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?=$lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <form class="form" method="POST" id="category_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['categorycode']?></label>
                    <input class="form-control width26" type="text" id="CATALOGCD_S" name="CATALOGCD_S" value="<?=$CATALOGCD_S?>" />
                </div>
              
                <div class="flex .col45">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?=$lang['search']?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height365"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                             <th style="text-align: center; "><?=$lang['categorycode']?></th>
                            <th style="text-align: center; "><?=$lang['categoryname']?></th>
                            <th style="text-align: center; "><?=$lang['describtion']?></th>
                            <th style="text-align: center; "><?=$lang['accinf']?></th>
                            <th style="text-align: center; "><?=$lang['accinfnm']?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['CATE']))  {
                        foreach ($data['CATE'] as $key => $value) {
                            if(is_array($value)) {
                              $minrow = count($data['CATE']) + 1;
                             ?>
                              <tr class="tr_border table-secondary">
                                  <td class="td-class"><?=isset($value['CATALOGCD']) ? $value['CATALOGCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CATALOGNAME']) ? $value['CATALOGNAME']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CATALOGDESC']) ? $value['CATALOGDESC']: ''?></td>
                                  <td class="td-class"><?=isset($value['ACCIFCD']) ? $value['ACCIFCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ACCIFNAME']) ? $value['ACCIFNAME']: '' ?></td>
                              </tr> <?php 
                              } else {
                                $minrow = 1; ?>
                                <tr class="tr_border table-secondary">
                                      <td class="td-class"><?=$data['CATE']['CATALOGCD'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['CATALOGNAME'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['CATALOGDESC'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['ACCIFCD'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['ACCIFNAME'] ?></td>
                                  </tr><?php
                                  break;
                                }
                            }  
                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                  <tr class="tr_border table-secondary">
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
                              </tr><?php
                          }
                    } ?>
                  </tbody>
              </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $lang['rowcount']; ?>  <?=$minrow ?></div>
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="insert" name="insert"><?=$lang['insert']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update"><?=$lang['update']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="delete" name="delete"><?=$lang['delete']?></button>
                </div>
                <div class="flex .col45">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="entry" name="entry" onclick="enrty();"><?=$lang['entry']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="clear" name="clear" onclick="unsetSession();"><?=$lang['clear']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="end" name="end"
  onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?=$lang['end']?></button>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['categorycode']?></label>
                    <input class="form-control width43 req" type="text" id="CATALOGCD" name="CATALOGCD" 
                    value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''?>"  required
                     />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['categoryname']?></label>
                     <input class="form-control width70 req" type="text" id="CATALOGNAME" name="CATALOGNAME"value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''?>" required />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['describtion']?></label>
                    <input class="form-control width70 req" type="text" id="CATALOGDESC" name="CATALOGDESC" value="<?=isset($data['CATALOGDESC']) ? $data['CATALOGDESC']: ''?>" required/>
                </div>
                <div class="flex .col45"></div>
            </div>
        </div>
        <br>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['accinfcde']?></label>
                    &emsp;
                    <input class="form-control width30" type="text" id="ACCIFCD" name="ACCIFCD"
                    value="<?=isset($data['ACCIFCD']) ? $data['ACCIFCD']: ''?>" />
                     <div class="fix-icon" style="margin-top: 2px;">
                  <a href="#" id="accInterface"><img style="img-height20" src="../../../../img/search.png"></a>
              </div>&emsp;
                    <input class="form-control width43" type="text" id="ACCIFNAME" name="ACCIFNAME" readonly value="<?=isset($data['ACCIFNAME']) ? $data['ACCIFNAME']: ''?>"  />
                </div>
                <div class="flex .col45"></div>
            </div>
        </div>
    </form>
    <!---------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
});


$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#CATALOGCD').val(item.eq(0).text());
        $('#CATALOGNAME').val(item.eq(1).text());
        $('#CATALOGDESC').val(item.eq(2).text());
        $('#ACCIFCD').val(item.eq(3).text());
        $('#ACCIFNAME').val(item.eq(4).text());
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();
    }
});

//input serach
const CATALOGCD = $("#CATALOGCD");
const ACCIFCD = $("#ACCIFCD");

// button search
const accInterface = $("#accInterface");

const input_serach = [CATALOGCD, ACCIFCD];

accInterface.attr('href', $('#sessionUrl').val() + '/guide/SEARCHACCOUNT/index.php');

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

CATALOGCD.change(function() {
    window.location.href="index.php?CATALOGCD=" + CATALOGCD.val();
});

CATALOGCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?CATALOGCD=" + CATALOGCD.val();
    }
})

ACCIFCD.change(function() {
    window.location.href="index.php?ACCIFCD=" + ACCIFCD.val();
});

ACCIFCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?ACCIFCD=" + ACCIFCD.val();
    }
})

function enrty() {
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
     $('#CATALOGCD').val('');
    $('#CATALOGNAME').val('');
    $('#CATALOGDESC').val('');
    $('#ACCIFCD').val('');
    $('#ACCIFNAME').val('');
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