<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">

    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>"></script>
    
    <title><?=$_SESSION['APPNAME'].' - '.$lang['searchtaxtype']; ?></title> -->

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
<!-- ---------------------------------------------------------------------------------->
<!--  Menu  -->
<?php doMenu(); ?>
<!-- ---------------------------------------------------------------------------------->
<input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">

<input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
<form class="form" style="width: 80%;" method="POST" id="guideindex" name="guideindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width27"><?php echo $data['TXTLANG']['TAXTYPECD']; ?></label>
                    <input class="form-control width26" type="text" id="TAXTYPESEARCH" name="TAXTYPESEARCH" value="<?=$TAXTYPESEARCH?>" />
                </div>
              
                <div class="flex .col45">
                    <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>        <br>
        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['TAXTYPECD']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['TAXTYPENAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['TAXKBN']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['VATRATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['TAXTTL']; ?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['TAX']))  {
                    // print_r($data['TAX']);  ROWNO,TAXTYPECD,TAXTTL
                        $rowno = 0;
                        foreach ($data['TAX'] as $key => $value) {

                            if(is_array($value)) {
                              $minrow = count($data['TAX']) ;
                             ?>
                                <tr class="tr_border table-secondary">
                                    <td class="td-class"><?=isset($value['TAXTYPECD']) ? $value['TAXTYPECD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['TAXTYPENAME']) ? $value['TAXTYPENAME']: '' ?></td>
                                    <td class="td-class" style="display: none"><?=isset($value['TAXKBN']) ? $value['TAXKBN']: '' ?></td>                                    
                                    <td class="td-class"><?php 
                                    if(isset($value['TAXKBN'])){
                                        foreach ($type as $key => $item) { 
                                                if($key == $value['TAXKBN'])
                                                    {
                                                        echo($item);
                                                    }
                                                }                                 
                                        } ?></td>
                                    <td class="td-class"><?=isset($value['VATRATE']) ? $value['VATRATE']: '' ?></td>
                                    <td class="td-class" style="display: none;"><?=isset($value['TAXTTL']) ? $value['TAXTTL']: '' ?></td>
                                    <td class="td-class"><?php 
                                    if(isset($value['TAXTTL'])){
                                        foreach ($cate as $key => $item) { 
                                                if($key == $value['TAXTTL'])
                                                    {
                                                        echo($item);
                                                    }
                                                }                                 
                                        } ?></td>
                                </tr> <?php 
                                } else {
                                $minrow = 1; 
                                // print_r('2'); 
                                ?>
                                <tr class="tr_border table-secondary">
                                      <td class="td-class"><?=$data['TAX']['TAXTYPECD'] ?></td>
                                      <td class="td-class" ><?=$data['TAX']['TAXTYPENAME'] ?></td>
                                      <td class="td-class" style="display: none;"><?=$data['TAX']['TAXKBN'] ?></td>
                                      <td class="td-class"><?php 
                                        if(isset($data['TAX']['TAXKBN'])){
                                            foreach ($type as $key => $item) { 
                                                    if($key == $data['TAX']['TAXKBN'])
                                                        {
                                                            echo($item);
                                                        }
                                                    }                                 
                                        } ?></td>
                                      <td class="td-class"><?=$data['TAX']['VATRATE'] ?></td>
                                      <td class="td-class" style="display: none;"><?=$data['TAX']['TAXTTL'] ?></td>
                                      <td class="td-class"><?php 
                                        if(isset($data['TAX']['TAXTTL'])){
                                            foreach ($cate as $key => $item) { 
                                                    if($key == $data['TAX']['TAXTTL'])
                                                        {
                                                            echo($item);
                                                        }
                                                    }                                 
                                            } ?></td>
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
        <div class="font-size14"><?php echo $lang['rowcount']; ?>  <?php echo !empty($tdata) ? count($tdata) : 0 ?></div>
        <div class="flex footer">
            <div class="flex col-first">
                <button type="button" id="select_item" name="select" class="btn btn-outline-secondary btn-action"><?php echo $lang['select']; ?></button>&emsp;&emsp;
                <button type="button" id="view_item" class="btn btn-outline-secondary btn-action"><?php echo $lang['view']; ?></button>
                <button type="button" id="csv" class="btn btn-outline-secondary btn-action"><?php echo $lang['csv']; ?></button>
            </div>
            <div class="flex col-second" style="justify-content: right;">
                <button type="button" id="back" class="btn btn-outline-secondary btn-action"><?php echo $lang['back']; ?></button>
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
           <table class="table-head" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                <thead>
                    <tr class="th-class">
                        <th style="text-align: left; padding-left: 2%;"><?php echo $lang['title']; ?></th>
                        <th style="text-align: center;"><?php echo $lang['value']; ?></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['TAXTYPECD']; ?></td>
                        <td class="td-class" id="TAXTYPECD" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']['TAXTYPENAME']; ?></td>
                        <td class="td-class" id="TAXTYPENAME"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['TAXKBN']; ?></td>
                        <td class="td-class" id="TAXKBN" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']['VATRATE']; ?></td>
                        <td class="td-class" id="VATRATE"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['TAXTTL']; ?></td>
                        <td class="td-class" id="TAXTTL" style="background-color:#ffe6cc;"></td>
                    </tr>
                    
                </tbody>
            </table>
            <br>
            <div class="font-size14"><?php echo $lang['rowcount']; ?> 2</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-action" data-bs-dismiss="modal"><?php echo $lang['end']; ?></button>
        </div>
    </div>
  </div>
</div>
</body>
<script src="./js/script.js"></script>
</html>