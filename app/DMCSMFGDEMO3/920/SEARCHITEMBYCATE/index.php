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
        <p class="text-white" style="font-size: 1.0em; margin: 0.1em;"><?php echo $packname . ' > ' . $appname; ?></p>
      </div>
      <div class="col-2 text-end align-middle">
        <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>" id="CLOSEPAGE">
          <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
          <p class="text-white" style="font-size: 1.0em; margin: 0.1em;">[ <?php echo $lang['close']; ?> ]</p>
        </a>
      </div>
    </div>
  </div>
  <!---------------------------------------------------------------------------------- -->
  <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
  <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
  <form class="form" method="POST" id="searchcatalog" name="searchcatalog" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="d-flex p-2">
      <div class="flex">
        <div class="flex col-100">
          <label class="label-width10"><?=$data['TXTLANG']['FM0931CATEFROM'];?></label>&ensp;
          <input class="form-control width15 req" type="text" id="FM0931CATESTART" name="FM0931CATESTART" value="<?=isset($data['FM0931CATESTART']) ? $data['FM0931CATESTART'] : ''; ?>" />
          <div class="fix-icon">
            <a href="#" id="searchcatalog1"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
          </div>&ensp;
          <label class="width3">-</label>
          <input class="form-control width15 req" type="text" id="FM0931CATEEND" name="FM0931CATEEND" value="<?=isset($data['FM0931CATEEND']) ? $data['FM0931CATEEND'] : ''; ?>" />
          <div class="fix-icon">
            <a href="#" id="searchcatalog2"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
          </div>&emsp;&emsp;
          <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search"><?=$data['TXTLANG']['FM0931SEARCH']?></button>
        </div>
      </div>
    </div>

    <div class="d-flex p-2">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="table height365"> 
            <table class="table-head table-striped search_table" id="table" rules="cols" cellpadding="3" cellspacing="1">
              <thead>
                <tr class="table-secondary">
                  <th class="th-class width10"><?=$data['TXTLANG']['FM0931DVCOL1']; ?></th>
                  <th class="th-class width10"><?=$data['TXTLANG']['FM0931DVCOL2']; ?></th>
                  <th class="th-class width15"><?=$data['TXTLANG']['FM0931DVCOL3']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['FM0931DVCOL4']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['FM0931DVCOL5']; ?></th>
                  <th class="th-class width15"><?=$data['TXTLANG']['FM0931DVCOL6']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['CATE']))  {
                  foreach ($data['CATE'] as $key => $value) {
                    if(is_array($value)) {
                      $minrow = count($data['CATE']);?>
                      <tr class="tr_border table-secondary">
                        <td class="td-class"><?=isset($value['FM0931DVCOL1']) ? $value['FM0931DVCOL1']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0931DVCOL2']) ? $value['FM0931DVCOL2']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0931DVCOL3']) ? $value['FM0931DVCOL3']: ''?></td>
                        <td class="td-class"><?=isset($value['FM0931DVCOL4']) ? $value['FM0931DVCOL4']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0931DVCOL5']) ? $value['FM0931DVCOL5']: '' ?></td>
                        <td class="td-class"><?=isset($value['FM0931DVCOL6']) ? $value['FM0931DVCOL6']: '' ?></td>
                      </tr> 
                      <?php 
                    } else {
                      $minrow = 1; ?>
                      <tr class="tr_border table-secondary">
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL1'] ?></td>
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL2'] ?></td>
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL3'] ?></td>
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL4'] ?></td>
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL5'] ?></td>
                        <td class="td-class"><?=$data['CATE']['FM0931DVCOL6'] ?></td>
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
              <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=!empty($data['CATE']) ? count($data['CATE']) : 0 ?></div>
            </div>
          </div>
        </div>

        <div class="d-flex p-2" style="margin-top: 0.0em;">
          <div class="flex footer">
            <div class="flex col-first">
              <button type="button" class="btn btn-outline-secondary btn-action" id="csv" name="csv"><?=$data['TXTLANG']['FM0931CSV'] ?></button>&emsp;&emsp;
            </div>
            <div class="flex col-second" style="justify-content: right;">
              <button type="reset" id="clear" name="clear" class="btn btn-outline-secondary btn-action" onclick="unsetSession(this.form);" ><?=$data['TXTLANG']['FM0931CLEAR']?></button>&emsp;&emsp;
              <button type="button" id="end" name="end" class="btn btn-outline-secondary btn-action" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                <?=$data['TXTLANG']['FM0931END']?></button>
              </div>
            </div>      
          </div>
        </form>
        <div id="loading" class="on" style="display: none;">
          <div class="cv-spinner"><div class="spinner"></div></div>
        </div>

        <footer>
            <p class="text-black" style="font-size: 0.8em;"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
        </footer>
        <!---------------------------------------------------------------------------------- -->
      </body>
      <script src="./js/script.js" ></script>
      <!-- <script src="./js/script.js" integrity="sha384-aDGGwvYs2PH+vn8KAqucRpFYmNEF5e/KoBmzRqeXkRNgoUvU9E1yot0/gIq6El1Z" crossorigin="anonymous"></script> -->
      </html>