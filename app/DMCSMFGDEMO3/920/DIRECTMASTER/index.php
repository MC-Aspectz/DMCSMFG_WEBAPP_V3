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
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>">  integrity="sha384-acDbhlvH9DufvmCPyS1tyL7yeN0gBK4eOA4kh7+XrtCoCSp9/1NtYoxVTq9MZRy0" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <!--  Bootstrap  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
      <!-- ---------------------------------------------------------------------------------->
    <!--  Menu -->
    <?php doMenu(); ?>
    <!-- ---------------------------------------------------------------------------------->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-10">
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?php echo $_SESSION['PACKNAME'] . ' > ' . $_SESSION['APPNAME']; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>



    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <form class="form" method="POST" id="direct_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">
        
            <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['DISTRICT_CODE'];?></label>
            <input class="form-control width26" type="text" id="DIRECTCD_S" name="DIRECTCD_S" value="<?=$DIRECTCD_S?>" />
             
                <div class="fix-icon">
                <a href="#" id="searchdirect"><img style="img-height20" src="../../../../img/search.png"></a>
                </div>
              </div>
                    <div class="flex col-first">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?=$lang['search']?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height365"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                             <th style="text-align: center; "><?=$data['TXTLANG']['DISTRICT_CODE']; ?></th>
                            <th style="text-align: center; "><?=$data['TXTLANG']['DISTRICT_NAME']?></th>                       
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['DIR']))  {
                        foreach ($data['DIR'] as $key => $value) {
                            if(is_array($value)) {
                              $minrow = count($data['DIR']) + 1;
                             ?>
                              <tr class="tr_border table-secondary">
                                  <td class="td-class"><?=isset($value['DIRECTCD']) ? $value['DIRECTCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['DIRECTNAME']) ? $value['DIRECTNAME']: '' ?></td>                                  
                             </tr> <?php 
                              } else {
                                $minrow = 1; ?>
                                <tr class="tr_border table-secondary">
                                      <td class="td-class"><?=$data['DIR']['DIRECTCD'] ?></td>
                                      <td class="td-class"><?=$data['DIR']['DIRECTNAME'] ?></td>                                
                                   
                                  </tr><?php
                                  break;
                                }
                            }  
                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                  <tr class="tr_border table-secondary">
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                     
                                  </tr><?php 
                            }
                    } else {
                          for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                              <tr class="tr_border table-secondary">
                                  <td class="td-class"></td>
                                  <td class="td-class"></td>

                                
                              </tr><?php
                          }
                    } ?>
                  </tbody>
              </table>
            </div>
        </div>
        <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>  <?=$minrow ?></div>
        <div class="d-flex p-2">
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
                    <label class="label-width27"><?=$data['TXTLANG']['DISTRICT_CODE']; ?></label>
                    <input class="form-control width43 req" type="text" id="DIRECTCD" name="DIRECTCD"
                     value="<?=isset($data['DIRECTCD']) ? $data['DIRECTCD']: ''?>" required  />
                   
                   
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?=$data['TXTLANG']['DISTRICT_NAME']?></label>
                     <input class="form-control width70 req" type="text" id="DIRECTNAME" name="DIRECTNAME" value="<?=isset($data['DIRECTNAME']) ? $data['DIRECTNAME']: ''?>" required />
                </div>
              
                <div class="flex .col45"></div>
            </div>
        </div>
        
        <br>

    
    </form>
    <!---------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
      <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">
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
