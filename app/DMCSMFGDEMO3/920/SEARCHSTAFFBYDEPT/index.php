<?php
require_once('./function/index_x.php');

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $appname; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  Bootstrap  -->
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
        <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>" id="closepage">
          <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
          <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $lang['close']; ?> ]</p>
        </a>
      </div>
    </div>
  </div>
  <!---------------------------------------------------------------------------------- -->
  <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
  <form class="form" method="POST" id="searchstaffbydept" name="searchstaffbydept" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="d-flex p-2">
      <div class="flex">
        <div class="flex col-100">
          <label class="label-width10"><?=$data['TXTLANG']['FM0932DEPTFROM'];?></label>&ensp;
          <input class="form-control width15 req" type="text" id="FM0932DEPTSTART" name="FM0932DEPTSTART" value="<?=isset($data['FM0932DEPTSTART']) ? $data['FM0932DEPTSTART'] : ''; ?>" />
          
          <div class="fix-icon" >
            <a href="#" id="searchdivision"><img style="img-height20" src="../../../../img/search.png"></a>
          </div>&emsp;&emsp;
          <label class="width3">-</label>
          <input class="form-control width15 req" type="text" id="FM0932DEPTEND" name="FM0932DEPTEND" value="<?=isset($data['FM0932DEPTEND']) ? $data['FM0932DEPTEND'] : ''; ?>" />
          <div class="fix-icon">
            <a href="#" id="searchdivision1"><img style="img-height20" src="../../../../img/search.png"></a>
          </div>&emsp;&emsp;
          <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search"><?=$data['TXTLANG']['FM0932SEARCH']?></button>
        </div>
      </div>
    </div>
    <br>
    <div class="d-flex p-2">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="table height365"> 
            <table class="table-head table-striped search_table" id="table" rules="cols" cellpadding="3" cellspacing="1">
              <thead>
                <tr class="table-secondary">
                  <th class="th-class width10"><?=$data['TXTLANG']['FM0932DVCOL1']; ?></th>
                  <th class="th-class width10"><?=$data['TXTLANG']['FM0932DVCOL2']; ?></th>
                  <th class="th-class width15"><?=$data['TXTLANG']['FM0932DVCOL3']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['FM0932DVCOL4']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['FM0932DVCOL5']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['STDEP']))  {
                  foreach ($data['STDEP'] as $key => $value) {
                    if(is_array($value)) {
                      $minrow = count($data['STDEP']);?>
                      <tr class="tr_border table-secondary">
                        <td class="td-class"><?=isset($value['FM0932DVCOL1']) ? $value['FM0932DVCOL1']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0932DVCOL2']) ? $value['FM0932DVCOL2']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0932DVCOL3']) ? $value['FM0932DVCOL3']: ''?></td>
                        <td class="td-class"><?=isset($value['FM0932DVCOL4']) ? $value['FM0932DVCOL4']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0932DVCOL5']) ? $value['FM0932DVCOL5']: '' ?></td>
                       
                      </tr> 
                      <?php 
                    } else {
                      $minrow = 1; ?>
                      <tr class="tr_border table-secondary">
                        <td class="td-class"><?=$data['STDEP']['FM0932DVCOL1'] ?></td>
                        <td class="td-class"><?=$data['STDEP']['FM0932DVCOL2'] ?></td>
                        <td class="td-class"><?=$data['STDEP']['FM0932DVCOL3'] ?></td>
                        <td class="td-class"><?=$data['STDEP']['FM0932DVCOL4'] ?></td>
                        <td class="td-class"><?=$data['STDEP']['FM0932DVCOL5'] ?></td>
                      </tr>
                      <?php
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
              <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=!empty($data['STDEP']) ? count($data['STDEP']) : 0 ?></div>
            </div>
          </div>
        </div>

        <div class="d-flex p-2">
          <div class="flex footer">
            <div class="flex col-first">
              <button type="button" class="btn btn-outline-secondary btn-action" id="csv" name="csv"><?=$data['TXTLANG']['FM0932CSV'] ?></button>&emsp;&emsp;
            </div>
            <div class="flex col-second" style="justify-content: right;">
              <button type="reset" id="clear" name="clear" class="btn btn-outline-secondary btn-action" onclick="unsetSession(this.form);" ><?=$data['TXTLANG']['FM0932CLEAR']?></button>&emsp;&emsp;
              <button type="button" id="end" name="end" class="btn btn-outline-secondary btn-action" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                <?=$data['TXTLANG']['FM0932END']?></button>
              </div>
            </div>      
          </div>
        </form>
        <div id="loading" class="on" style="display: none;">
          <div class="cv-spinner"><div class="spinner"></div></div>
        </div>
        <!---------------------------------------------------------------------------------- -->
      </body>
      <!-- <script src="./js/script.js" ></script> -->
      <script src="./js/script.js"></script>
      </html>