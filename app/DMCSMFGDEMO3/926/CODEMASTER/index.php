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
    <form class="form" method="POST" id="code_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

    <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CODE_KEY']; ?></label>
                    <input class="form-control width40" type="text" id="CODEKEY_S" name="CODEKEY_S" value="<?=isset($data['CODEKEY_S']) ? $data['CODEKEY_S']: ''?>" />
                </div>             
                <div class="flex .col45">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CODE']; ?></label>
                    <input class="form-control width40" type="text" id="CODE_S" name="CODE_S" value="<?=isset($data['CODE_S']) ? $data['CODE_S']: ''?>" />
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['LANG']; ?></label>
                    <select class="width30 option-text form-select form-select-sm " id="LANG_S" name="LANG_S" >
                        <option value=""></option>
                        <?php foreach ($lang1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['LANG_S']) && $data['LANG_S'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                </div>             
                <div class="flex .col45">
                    <label class="label-width27"><?php echo $data['TXTLANG']['TEXT']; ?></label>
                    <input class="form-control width60  " type="text" id="TEXT_S" name="TEXT_S" value="<?=isset($data['TEXT_S']) ? $data['TEXT_S']: ''?>" />
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CODE_KEY']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['LANG']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['TEXT']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['CM']))  {
                    // print_r($data['CM']);
                        $rowno = 0;
                        foreach ($data['CM'] as $key => $value) {
                            if(is_array($value)) {
                              $maxrow = count($data['CM']) + 1;
                              ++$rowno;
                            //   print_r($value);
                             ?>
                            <tr class="tr_border table-secondary">
                                <td class="td-class"><?=isset($value['CODEKEY']) ? $value['CODEKEY']: '' ?></td>
                                <td class="td-class"><?=isset($value['CODE']) ? $value['CODE']: '' ?></td>
                                <td class="td-class" style="display: none"><?=isset($value['LANG']) ? $value['LANG']: '' ?></td>                                    
                                <td class="td-class"><?php 
                                if(isset($value['LANG'])){
                                foreach ($lang1 as $key => $item) { 
                                        if($key == $value['LANG'])
                                            {
                                                echo($item);
                                            }
                                        }                                 
                                } ?></td>
                                <td class="td-class"><?=isset($value['TEXT']) ? $value['TEXT']: '' ?></td>
                                <td class="td-class" style="display: none"><?=$value['CODEID'] ?></td>
                            </tr> <?php 
                              } else {
                                $minrow = 1; 
                                ++$rowno;
                              // print_r('2'); 
                                ?>
                                <tr class="tr_border table-secondary">
                                        <td class="td-class"><?=$data['CM']['CODEKEY'] ?></td>
                                        <td class="td-class"><?=$data['CM']['CODE'] ?></td>
                                        <td class="td-class" style="display: none"><?=isset($data['CM']['LANG']) ? $data['CM']['LANG']: '' ?></td>                                    
                                        <td class="td-class"><?php 
                                        if(isset($data['CM']['LANG'])){
                                        foreach ($lang1 as $key => $item) { 
                                            if($key == $data['CM']['LANG'])
                                                {
                                                    echo($item);
                                                }
                                            }                                 
                                        } ?></td>
                                        <td class="td-class"><?=$data['CM']['TEXT'] ?></td>
                                        <td class="td-class" style="display: none"><?=$data['CM']['CODEID'] ?></td>
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
                                  </tr><?php 
                            }
                    } else {
                          for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                              <tr class="tr_border table-secondary">
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
                    <button type="button" class="btn btn-action" id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" class="btn btn-action" id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>
        
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CODE_KEY']; ?></label>
                    <input class="form-control width40 req" type="text" id="CODEKEY" name="CODEKEY" value="<?=isset($data['CODEKEY']) ? $data['CODEKEY']: ''?>" required/>
                </div>             
                <div class="flex .col45">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CODE']; ?></label>
                    <input class="form-control width40" type="text" id="CODE" name="CODE" value="<?=isset($data['CODE']) ? $data['CODE']: ''?>" />
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['LANG']; ?></label>
                    <select class="width30 option-text form-select form-select-sm req" id="LANG" name="LANG" required>
                        <option value=""></option>
                        <?php foreach ($lang2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['LANG']) && $data['LANG'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                </div>
              
                <div class="flex .col45">
                    <label class="label-width27"><?php echo $data['TXTLANG']['TEXT']; ?></label>
                    <input class="form-control width60" type="text" id="TEXT" name="TEXT" value="<?=isset($data['TEXT']) ? $data['TEXT']: ''?>" />
                    <input class="form-control width60" type="hidden" id="CODEID" name="CODEID" value="<?=isset($data['CODEID']) ? $data['CODEID']: ''?>" />
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
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
});

$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#CODEKEY').val(item.eq(0).text());
        $('#CODE').val(item.eq(1).text());
        $('#TEXT').val(item.eq(4).text());
        $('#CODEID').val(item.eq(5).text());
        // console.log(item.eq(5).text());
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        document.getElementById("LANG").value = item.eq(2).text();
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();    
    }
});

// CURRENCYCD
// input serach
// const CURRENCYCD = $('#CURRENCYCD');

// button search

// const input_serach = [CURRENCYCD];

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

// CURRENCYCD.change(function() {
//     window.location.href="index.php?CURRENCYCD=" + CURRENCYCD.val();
// });

// CURRENCYCD.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         window.location.href="index.php?CURRENCYCD=" + CURRENCYCD.val();
//     }
// })

// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

function enrty() {
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#CODEKEY').val('');
    $('#CODE').val('');
    document.getElementById("LANG").value = '';
    $('#TEXT').val('');
    $('#CODEID').val('');
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