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
                    <p class="text-white" style="font-size: 1.0em; margin: 0.1em;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
  <!---------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <form class="form" method="POST" id="appmanager" name="appmanager" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
      <div class="d-flex p-2">
        <div class="flex col-100" style="justify-content: right; margin-top: 10px">
            <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();"><?=$data['TXTLANG']['SEARCH']?></button>
        </div>
      </div>
      <div class="d-flex p-2">
        <div class="flex">
          <div class="flex col-100 flex-col">
              <div class="table height405">
                <table class="table-head table-striped" id="tablemonitor" rules="cols" cellpadding="3" cellspacing="1">
                    <thead>
                        <tr class="table-secondary">
                            <th class="th-class width3"></th>
                            <th class="th-class width12"><?=$data['TXTLANG']['PID']; ?></th>
                            <th class="th-class width7"><?=$data['TXTLANG']['STAFFCODE']; ?></th>
                            <th class="th-class width10"><?=$data['TXTLANG']['APPNAME']; ?></th>
                            <th class="th-class width24"><?=$data['TXTLANG']['COMPUTERNAME']; ?></th>
                            <th class="th-class width13"><?=$data['TXTLANG']['PROGRAMCODE']; ?></th>
                            <th class="th-class width17"><?=$data['TXTLANG']['PROGRAMNAME']; ?></th>
                            <th class="th-class width7"><?=$data['TXTLANG']['STARTDATE']; ?></th>
                            <th class="th-class width7"><?=$data['TXTLANG']['STARTTIME']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($data['SHEETDETAIL']))  {
                            // print_r($data['SHEETDETAIL']);
                            foreach ($data['SHEETDETAIL'] as $key => $value) {
                              if(is_array($value)) {
                                $minrow = count($data['SHEETDETAIL']); ?>
                                <tr class="tr_border">
                                  <td class="td-class text-center">
                                    <input type="hidden" id="CHECKROWH<?=$key?>" name="CHECKROW[]" value="F"/>
                                    <input type="checkbox" id="CHECKROW<?=$key?>" name="CHECKROW[]" value="T" onchange="chked(<?=$key?>);"/>
                                  </td>
                                  <td class="td-class"><?=$value['PID'] ?></td>
                                  <td class="td-class"><?=$value['STAFFCD'] ?></td>
                                  <td class="td-class"><?=$value['APPNAME'] ?></td>
                                  <td class="td-class"><?=$value['COMPNAME'] ?></td>
                                  <td class="td-class"><?=$value['PROGRAMCODE'] ?></td>
                                  <td class="td-class"><?=$value['PROGRAMNAME'] ?></td>
                                  <td class="td-class"><?=$value['STARTDATE'] ?></td>
                                  <td class="td-class"><?=$value['STARTTIME'] ?></td>
                                  <td class="td-hide"><input type="text" name="PID[]" value="<?=$value['PID'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="STAFFCD[]" value="<?=$value['STAFFCD'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="APPNAME[]" value="<?=$value['APPNAME'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="COMPNAME[]" value="<?=$value['COMPNAME'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="PROGRAMCODE[]" value="<?=$value['PROGRAMCODE'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="PROGRAMNAME[]" value="<?=$value['PROGRAMNAME'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="STARTDATE[]" value="<?=$value['STARTDATE'] ?>"></td>
                                  <td class="td-hide"><input type="text" name="STARTTIME[]" value="<?=$value['STARTTIME'] ?>"></td>
                                </tr> <?php 
                              } else {
                                $minrow = 1; ?>
                                <tr class="tr_border">
                                    <td class="td-class text-center">
                                      <input type="hidden" id="CHECKROWH1" name="CHECKROW[]" value="F"/>
                                      <input type="checkbox" id="CHECKROW1" name="CHECKROW[]" value="T" onchange="chked(1);"/>
                                    </td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['PID'] ?></td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['STAFFCD'] ?></td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['APPNAME'] ?></td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['COMPNAME'] ?></td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['PROGRAMCODE'] ?></td>
                                    <td class="td-class"><?=$data['SHEETDETAIL']['PROGRAMNAME'] ?></td> 
                                    <td class="td-class"><?=$data['SHEETDETAIL']['STARTDATE'] ?></td>      
                                    <td class="td-class"><?=$data['SHEETDETAIL']['STARTTIME'] ?></td>
                                    <td class="td-hide"><input type="text" name="PID[]" value="<?=$data['SHEETDETAIL']['PID'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="STAFFCD[]" value="<?=$data['SHEETDETAIL']['STAFFCD'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="APPNAME[]" value="<?=$data['SHEETDETAIL']['APPNAME'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="COMPNAME[]" value="<?=$data['SHEETDETAIL']['COMPNAME'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="PROGRAMCODE[]" value="<?=$data['SHEETDETAIL']['PROGRAMCODE'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="PROGRAMNAME[]" value="<?=$data['SHEETDETAIL']['PROGRAMNAME'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="STARTDATE[]" value="<?=$data['SHEETDETAIL']['STARTDATE'] ?>"></td>
                                    <td class="td-hide"><input type="text" name="STARTTIME[]" value="<?=$data['SHEETDETAIL']['STARTTIME'] ?>"></td>                                                                      
                                </tr><?php
                                break;
                              }
                            } 
                            for ($i = $minrow; $i < $maxrow; $i++) { ?>
                                <tr class="tr_border">
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
                            for ($i = $minrow; $i < $maxrow; $i++) { ?>
                                <tr class="tr_border">
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
            <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=$minrow ?></div>
          </div>
        </div>
      </div>

      <div class="d-flex p-2">
        <div class="flex footer">
          <div class="flex col-100">
            <button type="button" class="btn btn-outline-secondary btn-action" id="kill" name="kill"><?=$data['TXTLANG']['KILL']; ?></button>
            <button type="button" id="end" name="end" class="btn btn-outline-secondary btn-action" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
            <?=$data['TXTLANG']['END']?></button>
          </div>
        </div>      
      </div>
  </form>
  <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
  </div>
  <!---------------------------------------------------------------------------------- -->
  <footer>
      <p class="text-black" style="font-size: 0.8em;"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
  </footer>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-U3Ap9l1MWNyB+HE6fdt7quTR/6u/L6zew6TR8tceOu8tvGGMcmLhZ6VFKsDu4f7g" crossorigin="anonymous"></script> -->
<script type="text/javascript">
  function alertValidation() {
      return Swal.fire({ 
          title: '',
          // icon: 'success',
          text: '<?=$lang['validation1']; ?>',
          background: '#8ca3a3',
          showCancelButton: false,
          confirmButtonColor: 'silver',
          cancelButtonColor: 'silver',
          confirmButtonText: '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
              if (result.isConfirmed) { //
          }
      });
  }
</script>
</html>