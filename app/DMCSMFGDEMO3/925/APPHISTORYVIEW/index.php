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
  <form class="form" method="POST" id="historyview" name="historyview" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <!-- <div class="d-flex p-2"> -->
    <div class="col-md-12">

      <div class="flex">
      <div class="flex col-first">  
          <label class="label-width27"><?=$data['TXTLANG']['STARTDATE'];?></label>&ensp;
          <input class="form-control width22" type="date" id="STARTDATE1" name="STARTDATE1" <?php if(!empty($_POST['STARTDATE1'])){ ?> value="<?=date('Y-m-d', strtotime($_POST['STARTDATE1'])); ?>"<?php } else { ?> value="<?=date('Y-m-d')?>" <?php }?>/>
          <!-- <?php echo $_POST['STARTDATE1']?> -->
          <label class="width3"><?=$data['TXTLANG']['ARROW'];?></label>
          <input class="form-control width22" type="date" id="STARTDATE2" name="STARTDATE2" <?php if(!empty($data['STARTDATE2'])){ ?> value="<?=date('Y-m-d', strtotime($data['STARTDATE2'])); ?>"<?php } else { ?> value="<?=date('Y-m-d')?>" <?php }?>/>
      </div>
          <div class="flex col-first">
          <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();"><?=$lang['search']?></button>&emsp;&emsp;
          <!-- <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?=$lang['search']?></button>&emsp;&emsp; -->
          
        </div>
      </div>
    </div>

      <div class="flex">
           
           <div class="flex col-first">            
           <label  class="label-width27"><?=$data['TXTLANG']['STAFFCODE'];?> </label>     &nbsp;&nbsp;
           <input class="form-control width26" type="text" id="STAFFCDS" name="STAFFCDS" value="<?=$STAFFCDS?>" />             
             <div class="fix-icon">
             <a href="#" id="searchstaff"><img style="img-height20" src="../../../../img/search.png"></a>
             </div> 
             <label  class="label-width26"><?=$data['TXTLANG']['PROGRAMCODE'];?> </label>     
           <input class="form-control width26" type="text" id="PRGCDS" name="PRGCDS" value="<?=$PRGCDS?>" />    

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
               



                  <th class="th-class width10"><?=$data['TXTLANG']['PID']; ?></th>
                  <th class="th-class width10"><?=$data['TXTLANG']['STAFFCODE']; ?></th>
                  <th class="th-class width15"><?=$data['TXTLANG']['DIVISIONCODE']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['APPNAME']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['COMPUTERNAME']; ?></th>
                  <th class="th-class width10"><?=$data['TXTLANG']['PROGRAMCODE']; ?></th>
                  <th class="th-class width10"><?=$data['TXTLANG']['PROGRAMNAME']; ?></th>
                  <th class="th-class width15"><?=$data['TXTLANG']['STARTDATE']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['STARTTIME']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['ENDDATE']; ?></th>
                  <th class="th-class width20"><?=$data['TXTLANG']['ENDTIME']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['AHV']))  {
                  foreach ($data['AHV'] as $key => $value) {
                    if(is_array($value)) {
                      $minrow = count($data['AHV']);?>
                      <tr class="tr_border table-secondary">

                    
                                  <td class="td-class"><?=$value['PID'] ?></td>
                                  <td class="td-class"><?=$value['STAFFCD'] ?></td>
                                  <td class="td-class"><?=$value['DIVISIONCD'] ?></td>
                                  <td class="td-class"><?=$value['APPNAME'] ?></td>
                                  <td class="td-class"><?=$value['COMPNAME'] ?></td>
                                  <td class="td-class"><?=$value['PROGRAMCODE'] ?></td>
                                  <td class="td-class"><?=$value['PROGRAMNAME'] ?></td>
                                  <td class="td-class"><?=$value['STARTDATE'] ?></td>
                                  <td class="td-class"><?=$value['STARTTIME'] ?></td>
                                  <td class="td-class"><?=$value['ENDDATE'] ?></td>
                                  <td class="td-class"><?=$value['ENDTIME'] ?></td>
                                




                        <!-- <td class="td-class"><?=isset($value['PID']) ? $value['PID']: '' ?></td>
                        <td class="td-class"><?=isset($value['STAFFCD']) ? $value['STAFFCD']: '' ?></td>
                        <td class="td-class"><?=isset($value['DIVISIONCD']) ? $value['DIVISIONCD']: ''?></td>
                        <td class="td-class"><?=isset($value['APPNAME']) ? $value['APPNAME']: '' ?></td>
                        <td class="td-class"><?=isset($value['COMPNAME']) ? $value['COMPNAME']: '' ?></td>
                        <td class="td-class"><?=isset($value['PROGRAMCODE']) ? $value['PROGRAMCODE']: '' ?></td>
                        <td class="td-class"><?=isset($value['PROGRAMNAME']) ? $value['PROGRAMNAME']: '' ?></td>
                        <td class="td-class"><?=isset($value['STARTDATE']) ? $value['STARTDATE']: ''?></td>
                        <td class="td-class"><?=isset($value['STARTTIME']) ? $value['STARTTIME']: '' ?></td>
                        <td class="td-class"><?=isset($value['ENDDATE']) ? $value['ENDDATE']: '' ?></td>
                        <td class="td-class"><?=isset($value['ENDTIME']) ? $value['ENDTIME']: '' ?></td> -->
                       
                      </tr> 
                      <?php 
                    } else {
                      $minrow = 1; ?>
                      <tr class="tr_border table-secondary">
                        <td class="td-class"><?=$data['AHV']['PID'] ?></td>
                        <td class="td-class"><?=$data['AHV']['STAFFCD'] ?></td>
                        <td class="td-class"><?=$data['AHV']['DIVISIONCD'] ?></td>
                        <td class="td-class"><?=$data['AHV']['APPNAME'] ?></td>
                        <td class="td-class"><?=$data['AHV']['COMPNAME'] ?></td>
                        <td class="td-class"><?=$data['AHV']['PROGRAMCODE'] ?></td>
                        <td class="td-class"><?=$data['AHV']['PROGRAMNAME'] ?></td>
                        <td class="td-class"><?=$data['AHV']['STARTDATE'] ?></td>
                        <td class="td-class"><?=$data['AHV']['STARTTIME'] ?></td>
                        <td class="td-class"><?=$data['AHV']['ENDDATE'] ?></td>
                        <td class="td-class"><?=$data['AHV']['ENDTIME'] ?></td>
                       
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
              <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=!empty($data['AHV']) ? count($data['AHV']) : 0 ?></div>
            </div>
          </div>
        </div>

        <div class="d-flex p-2">
          <div class="flex footer">
            <div class="flex col-first">
              <button type="button" class="btn btn-outline-secondary btn-action" id="csv" name="csv"onclick="exportCSV();">CSV</button>&emsp;&emsp;
            </div>
            
            <div class="flex col-second" style="justify-content: right;">
            
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
      </body>
      <!-- <script src="./js/script.js" ></script> -->
      <script src="./js/script.js"></script>
      </html>