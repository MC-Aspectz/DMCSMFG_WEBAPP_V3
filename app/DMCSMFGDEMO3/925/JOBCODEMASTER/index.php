<?php 
    require_once('./function/index_x.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Bootstrap  -->
    <link rel="stylesheet" href="<?php echo $_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <!--  Load Google Fonts  -->
    <link href="<?php echo $_SESSION['APPURL'] . '/font/google/montserrat.css'; ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $_SESSION['APPURL'] . '/font/google/lato.css'; ?>" type="text/css">
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?php echo $_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>"></script>
    <script src="<?php echo $_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>"></script>
    <!-- -------------------------------------------------------------------------------- -->
    <!--  CSS  -->
    <!-- <link rel="stylesheet" href="./css/index.css"> -->
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
    <form class="form" method="POST" id="job_code_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

      <div class="d-flex p-2">    
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$data['TXTLANG']['JOB_INF']; ?></label>
                    <input class="form-control width26" type="text" id="JOBCDS" name="JOBCDS" value="<?=$JOBCDS?>" >
                </div>
                <div class="flex .col45"></div>
            </div>

        </div>

        <div class="d-flex p-2">
            <div class="flex .col55">
                <label class="label-width27"><?=$data['TXTLANG']['PROCESSTYPE']; ?></label>
                <select class="width20 option-text form-select form-select-sm " id="JOBTYPES" name="JOBTYPES" >
                        <option value=""></option>
                        <?php foreach ($type1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['JOBTYPES']) && $data['JOBTYPES'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                </select>
            </div>
            <div class="flex .col45">
                <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height380">
                <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['LINE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOB_INF']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['PROCESS_NAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['PROCESSTYPE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOBGROUPCD']; ?></th>
                        </tr>
                    </thead>
                    <tbody id="DVWJOBCODE">
                    <?php if(!empty($data['JC']))  {
                    // print_r($data['JC']);  //ROWNO,JOBCD,JOBNAME,JOBTYPE,JOBGROUP
                    // print_r(count($data['JC']));
                    for ($i = 1; $i <= count($data['JC']); $i++) { 
                        $minrow = count($data['JC']); ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                        <td class="td-class" id="ROWNO_TD<?=$i?>" style="text-align: center; "><?=++$rowno ?></td>
                        <td class="td-class" id="JOBCD_TD<?=$i?>" style="text-align: center; "><?=isset($data['JC'][$i]['JOBCD']) ? $data['JC'][$i]['JOBCD']: '' ?></td>
                        <td class="td-class" id="JOBNAME_TD<?=$i?>" style="text-align: center; "><?=isset($data['JC'][$i]['JOBNAME']) ? $data['JC'][$i]['JOBNAME']: '' ?></td>
                        <td class="td-class" id="JOBTYPE_TD<?=$i?>" style="display: none"><?=isset($data['JC'][$i]['JOBTYPE']) ? $data['JC'][$i]['JOBTYPE']: '' ?></td>
                        <td class="td-class" style="text-align: center; "><?php
                        if(isset($data['JC'][$i]['JOBTYPE'])){
                            foreach ($type1 as $key => $item) { 
                                if($key == $data['JC'][$i]['JOBTYPE'])
                                    {
                                        echo($item);
                                    }
                                }                                 
                            } ?></td>
                        <td class="td-class" id="JOBGROUP_TD<?=$i?>" style="display: none"><?=isset($data['JC'][$i]['JOBGROUP']) ? $data['JC'][$i]['JOBGROUP']: '' ?></td>
                        <td class="td-class" style="text-align: center; "><?php
                        if(isset($data['JC'][$i]['JOBGROUP'])){
                            foreach ($type2 as $key => $item) { 
                                if($key == $data['JC'][$i]['JOBGROUP'])
                                    {
                                        echo($item);
                                    }
                            }                                 
                        } ?></td>

                        <!-- JOBCD,JOBNAME,JOBTYPE,JOBGROUP,JOBCDS,JOBTYPES -->
                        <td class="td-hide"><input type="hidden" id="ROWNO<?=$i?>" name="ROWNOA[]" value="<?=$rowno?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBCD<?=$i?>" name="JOBCDA[]" value="<?=isset($data['JC'][$i]['JOBCD']) ? $data['JC'][$i]['JOBCD']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBNAME<?=$i?>" name="JOBNAMEA[]" value="<?=isset($data['JC'][$i]['JOBNAME']) ? $data['JC'][$i]['JOBNAME']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBTYPE<?=$i?>" name="JOBTYPEA[]" value="<?=isset($data['JC'][$i]['JOBTYPE']) ? $data['JC'][$i]['JOBTYPE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBGROUP<?=$i?>" name="JOBGROUPA[]" value="<?=isset($data['JC'][$i]['JOBGROUP']) ? $data['JC'][$i]['JOBGROUP']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBCDS<?=$i?>" name="JOBCDSA[]" value="<?=isset($data['JC'][$i]['JOBCDS']) ? $data['JC'][$i]['JOBCDS']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="JOBTYPES<?=$i?>" name="JOBTYPESA[]" value="<?=isset($data['JC'][$i]['JOBTYPES']) ? $data['JC'][$i]['JOBTYPES']: '' ?>"></td>

                        <? $i++ ?>
                        </tr> <?php
                        // break;
                    }
                    for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                        </tr> <?php 
                    }
                } else {                            
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
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
        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<label id="record"><?=$rowno?></label></div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55"> <!-- vvvv button vvvv -->
                    <button type="button" class="btn btn-action" id="commit" name="commit" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['COMMIT']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="modify" name="modify" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['MODIFY']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" class="btn btn-action"  id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>

        <!-- required -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <input class="form-control width10 " style="display: none;" type="text" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''?>" readonly/>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['JOB_INF']; ?></label>
                    <input class="form-control width43" type="text" id="JOBCD" name="JOBCD" 
                    value="<?=isset($data['JOBCD']) ? $data['JOBCD']: ''?>" 
                     />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PROCESS_NAME']; ?></label>
                     <input class="form-control width70" type="text" id="JOBNAME" name="JOBNAME"
                     value="<?=isset($data['JOBNAME']) ? $data['JOBNAME']: ''?>"  />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PROCESSTYPE']; ?></label>
                    <select class="width15 option-text form-select form-select-sm " id="JOBTYPE" name="JOBTYPE" >
                        <option value=""></option>
                        <?php foreach ($type1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['JOBTYPE']) && $data['JOBTYPE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['JOBGROUPCD']; ?></label>
                    <select class="width15 option-text form-select form-select-sm " id="JOBGROUP" name="JOBGROUP" >
                        <option value=""></option>
                        <?php foreach ($type2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['JOBGROUP']) && $data['JOBGROUP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="ok" name="ok" 
                    ><?php echo $data['TXTLANG']['OK']; ?>
                    </button>&emsp;&emsp;
                </div>
                <div class="flex .col45">
                </div>
            </div>
        </div>


    </form>
    <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {

    var index = 0;
    var index = '<?php echo (isset($data['JC']) ? count($data['JC']) : 0); ?>';
    
        // console.log(index);
        $(document).on('click', '#ok', function() {
            
        if($('#JOBCD').val() == '' || $('#JOBTYPE').val() == '' ) {
                return false;
        }
        index ++;  // index += 1; 
        var newRow = $('<tr class="tr_border" id=rowId' + index + '>');
        var cols = "";

        cols += '<td class="td-class" style="text-align: center; " id="ROWNO_TD' + index + '">' + index + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="JOBCD_TD' + index + '">' + $('#JOBCD').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="JOBNAME_TD' + index + '">' + $('#JOBNAME').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="JOBTYPE_TD' + index + '">' + $("#JOBTYPE option:selected").text()+'</td>';
        cols += '<td class="td-class" style="text-align: center; " id="JOBGROUP_TD' + index + '">' + $("#JOBGROUP option:selected").text()+'</td>';

        cols += '<td class="td-hide"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBCD'+index+'" name="JOBCDA[]"   value='+ $('#JOBCD').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBNAME'+index+'" name="JOBNAMEA[]"   value='+ $('#JOBNAME').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBTYPE'+index+'" name="JOBTYPEA[]"   value='+ $('#JOBTYPE').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBGROUP'+index+'" name="JOBGROUPA[]"   value='+ $('#JOBGROUP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBCDS'+index+'" name="JOBCDSA[]"   value='+ $('#JOBCDS').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOBTYPES'+index+'" name="JOBTYPESA[]"   value='+ $('#JOBTYPES').val() +'></td>';
            
        if(index <= 5) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
        } else {
                newRow.append(cols);
                $("table tbody").append(newRow);
        }
        $('#record').html(index);
        
        return enrty();

    });

    $(document).on('click', '#delete', function() {
        let id = $('#ROWNO').val();
        // console.log(id);
        if(id != '') {
            document.getElementById("search_table").deleteRow(id);
            $('#rowId'+id).closest("tr").remove();
            if(index <= 5) {
                emptyRow(id);
            }
            index--;
            $(".row-id").each(function (i) {
                $(this).text(i+1);
            }); 
            $('#record').html(index);
            unsetItemData(id);
            changeRowId();
            id = null;
            return enrty();
        }
    });

    document.getElementById("modify").disabled = true;
    document.getElementById("delete").disabled = true;
    document.getElementById("ok").disabled = true;
    
});

$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {

        $('#ROWNO').val(item.eq(0).text());
        $('#JOBCD').val(item.eq(1).text());
        $('#JOBNAME').val(item.eq(2).text());
        document.getElementById("JOBTYPE").value = item.eq(3).text();
        document.getElementById("JOBGROUP").value = item.eq(5).text();

        document.getElementById("commit").disabled = false;
        document.getElementById("modify").disabled = false;
        document.getElementById("delete").disabled = false;
        document.getElementById("ok").disabled = false;
        //$('#JOBCD').attr('readonly',true).css('background-color', 'whitesmoke');

    }
});

// JOBCD
// input serach
// const JOBCDS = $('#JOBCDS');
// const JOBTYPE = $('#JOBTYPE');//<<<<<<<<<

const input_serach = [JOBCDS,JOBTYPE];//<<<<<<<<<

// button search
const guideindex = $("#guideindex");
const search = $("search");

// const search_icon = [guideindex,search];


//guideindex.attr('href', $('#sessionUrl').val() + '/guide/SEARCHCOUNTRY1/index.php');

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


// for(const icon of search_icon) {
//     icon.click(function () {
//         keepData();
//     });

// };

// JOBCDS.change(function() {
//     keepData();
//     window.location.href="index.php?JOBCDS=" + JOBCDS.val() + '&JOBTYPE=' +JOBTYPE.val();
// });

// JOBCDS.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         keepData();
//         window.location.href="index.php?JOBCDS=" + JOBCDS.val() + '&JOBTYPE=' +JOBTYPE.val();
//     }
// })

// JOBTYPE.change(function() {
//     keepData();
//     window.location.href="index.php?JOBTYPE=" + JOBTYPE.val();
// });

// JOBTYPE.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         keepData();
//         window.location.href="index.php?JOBTYPE=" + JOBTYPE.val();
//     }
// })


function enrty() {
    document.getElementById("commit").disabled = false;
    document.getElementById("modify").disabled = true;
    document.getElementById("delete").disabled = true;
    document.getElementById("ok").disabled = false;

    $('#ROWNO').val('');
    $('#JOBCD').val('');
    $('#JOBNAME').val('');
    $('#JOBTYPE').val('');
    $('#JOBGROUP').val('');
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
