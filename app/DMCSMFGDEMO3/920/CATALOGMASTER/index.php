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
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-acDbhlvH9DufvmCPyS1tyL7yeN0gBK4eOA4kh7+XrtCoCSp9/1NtYoxVTq9MZRy0" crossorigin="anonymous"></script>
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
                <p class="text-white" style="font-size: 1.0em; margin: 0.1em;"><?=$packname . ' > ' . $appname; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?=$_SESSION['APPURL'] . '/home.php'; ?>" id="CLOSEPAGE">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.0em; margin: 0.1em;">[ <?=$lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <form class="form" method="POST" id="category_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['categorycode']?></label>
                    <input class="form-control width26" type="text" id="CATALOGCD_S" name="CATALOGCD_S" value="<?=$CATALOGCD_S?>" />
                </div>
              
                <div class="flex .col45">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();"><?=$lang['search']?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height365"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                             <th class="th-class"><?=$lang['categorycode']?></th>
                            <th class="th-class"><?=$data['TXTLANG']['CATEGORY_NAME']?></th>
                            <th class="th-class"><?=$data['TXTLANG']['CATALOGDESC']?></th>
                            <th class="th-class"><?=$lang['accinf']?></th>
                            <th class="th-class"><?=$lang['accinfnm']?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['CATE']))  {
                        foreach ($data['CATE'] as $key => $value) {
                            if(is_array($value)) { $minrow = count($data['CATE']); ?>
                              <tr class="tr_border table-secondary">
                                  <td class="td-class"><?=isset($value['CATALOGCD']) ? $value['CATALOGCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CATALOGNAME']) ? $value['CATALOGNAME']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CATALOGDESC']) ? $value['CATALOGDESC']: ''?></td>
                                  <td class="td-class"><?=isset($value['ACCIFCD']) ? $value['ACCIFCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ACCIFNAME']) ? $value['ACCIFNAME']: '' ?></td>
                                  <td class="td-hide"><?=$key ?></td>
                              </tr> <?php 
                              } else { $minrow = 1; ?>
                                <tr class="tr_border table-secondary">
                                      <td class="td-class"><?=$data['CATE']['CATALOGCD'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['CATALOGNAME'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['CATALOGDESC'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['ACCIFCD'] ?></td>
                                      <td class="td-class"><?=$data['CATE']['ACCIFNAME'] ?></td>
                                      <td class="td-hide"><?=$minrow ?></td>
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
        <div class="font-size14" style="margin-top: 0.0em;"><?=$data['TXTLANG']['ROWCOUNT']; ?>  <?=$minrow ?></div>
        <div class="d-flex p-2" style="margin-top: 0.0em;">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="insert" name="insert"
                    <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['INSERT']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update"
                    <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['UPDATE']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="delete" name="delete"
                    <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['DELETE']?></button>
                </div>
                <div class="flex .col45">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="entry" name="entry" onclick="enrty();"><?=$data['TXTLANG']['ENTRY']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="end" name="end"
                      onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?=$data['TXTLANG']['END']?></button>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$lang['categorycode']?></label>
                    <input class="form-control width43 req" type="text" id="CATALOGCD" name="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''?>" onchange="unRequired();" required/>
                    <input type="hidden" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''?>"/>
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$data['TXTLANG']['CATEGORY_NAME']?></label>
                     <input class="form-control width70 req" type="text" id="CATALOGNAME" name="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''?>"  onchange="unRequired();" required />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2" style="margin-bottom: 10.0px;">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$data['TXTLANG']['CATALOGDESC']?></label>
                    <input class="form-control width70 req" type="text" id="CATALOGDESC" name="CATALOGDESC" value="<?=isset($data['CATALOGDESC']) ? $data['CATALOGDESC']: ''?>"  onchange="unRequired();" required/>
                </div>
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$data['TXTLANG']['ACCIFCD']?></label>
                    &emsp;
                    <input class="form-control width30" type="text" id="ACCIFCD" name="ACCIFCD"
                    value="<?=isset($data['ACCIFCD']) ? $data['ACCIFCD']: ''?>" />
                     <div class="fix-icon" style="margin-top: 2px;">
                  <a href="#" id="accInterface"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
              </div>&emsp;
                    <input class="form-control width43 read" type="text" id="ACCIFNAME" name="ACCIFNAME" readonly value="<?=isset($data['ACCIFNAME']) ? $data['ACCIFNAME']: ''?>"  />
                </div>
                <div class="flex .col45"></div>
            </div>
        </div>
    </form>
    <!---------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
      <div class="cv-spinner"><div class="spinner"></div></div>
    </div>

    <footer>
        <p class="text-black" style="font-size: 0.8em;"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
    </footer>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-wjZGBM5DySH/RQ4z857GFeXWE8Y2YedM8PEeZzmHDZuadVCKGKJNkYZF2Ve+WHI+" crossorigin="anonymous"></script> -->
<script type="text/javascript">
  $(document).ready(function() {
      unRequired();
      document.getElementById("update").disabled = true;
      document.getElementById("delete").disabled = true;
      if($('#ROWNO').val() != '') {
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
      }
  });

  function unRequired() {
    if(CATALOGCD.val() != '') {
        document.getElementById('CATALOGCD').classList.remove('req');
    } else {
        document.getElementById('CATALOGCD').classList.add('req');
    }
    if(CATALOGNAME.val() != '') {
        document.getElementById('CATALOGNAME').classList.remove('req');
    } else {
        document.getElementById('CATALOGNAME').classList.add('req');
    }
    if(CATALOGDESC.val() != '') {
        document.getElementById('CATALOGDESC').classList.remove('req');
    } else {
        document.getElementById('CATALOGDESC').classList.add('req');
    }
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
