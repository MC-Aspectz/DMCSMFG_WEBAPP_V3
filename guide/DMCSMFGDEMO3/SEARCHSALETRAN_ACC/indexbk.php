<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">

    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-acDbhlvH9DufvmCPyS1tyL7yeN0gBK4eOA4kh7+XrtCoCSp9/1NtYoxVTq9MZRy0" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHSALETRAN_ACC']; ?></title>
</head>
<body>
<!-- -------------------------------------------------------------------------------- -->
<!--  Menu  -->
<?php doMenu(); ?>
<!-- -------------------------------------------------------------------------------- -->
<input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
<input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
<input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>" <?php } else { ?> value="" <?php }?>>
<form class="form" method="POST" id="saletrans" name="saletrans" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?php echo $data['TXTLANG']['INVOICE_NO']; ?></label>
                <input class="form-control width20" type="text" id="P1" name="P1" value="<?=$P1 ?>"/>&ensp;
            </div>
            <div class="flex col-second"></div>
        </div>
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCD']; ?></label>
                <input class="form-control width20" type="text" id="P2" name="P2" value="<?=$P2 ?>"/>&ensp;
            </div>
            <div class="flex col-second"></div>
        </div>
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?=$data['TXTLANG']['INVDATE']; ?></label>
                <input class="form-control width20 " type="date" id="P3" name="P3" value="<?=$P3 ?>"/>&ensp;→&ensp;
                <input class="form-control width20 " type="date" id="P4" name="P4" value="<?=$P4 ?>"/>
            </div>
            <div class="flex col-second"></div>
        </div>
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?=$data['TXTLANG']['STATUS']; ?></label>
                <select class="width30 option-text form-select form-select-sm" id="P5" name="P5">
                    <option value="" <?=(isset($P5) && $P5 === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($accststatus as $key => $value) { ?>
                        <option value="<?=$key ?>"<?php echo (isset($P5) && $P5 == $key) ? 'selected' : '' ?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex col-second" style="justify-content: right; padding-right: 1%;">
                 <button type="submit" id="search" name="search" class="btn btn-outline-secondary btn-action" onclick="$('#loading').show();"><?=$data['TXTLANG']['SEARCH']; ?></button>
            </div>
        </div>
        <br>
        <div class="flex">
            <div class="table height280"> 
                <table class="table-head" rules="cols" id="table_result" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr class="th-class table-secondary">
                            <th class="width10" style="text-align: left; padding-left: 1%;"><?=$data['TXTLANG']['INVOICE_NO']; ?></th>
                            <th class="width10" style="text-align: center;"><?=$data['TXTLANG']['SALEORDERNO']; ?></th>
                            <th class="width10" style="text-align: center;"><?=$data['TXTLANG']['LINE']; ?></th>
                            <th class="width10" style="text-align: center;"><?=$data['TXTLANG']['ITEMCD']; ?></th>
                            <th class="width30" style="text-align: center;"><?=$data['TXTLANG']['ITEMNAME']; ?></th>
                            <th class="width20" style="text-align: center;"><?=$data['TXTLANG']['STATUS']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty($tdata)) {
                        foreach ($tdata as $item) { 
                            if(is_array($item)) {
                                $minrow = count($tdata) + 1;?>
                                <tr class="table-warning">
                                    <td style="display: none;"><?=$item["ROWCOUNTER"] ?></td>
                                    <td class="td-class"><?=$item["SALETRANNO"] ?></td>
                                    <td class="td-class"><?=$item["SALEORDERNO"] ?></td>
                                    <td class="td-class"><?=$item["SALETRANLN"] ?></td>
                                    <td class="td-class"><?=$item["ITEMCD"] ?></td>
                                    <td class="td-class"><?=$item["ITEMNAME"] ?></td>
                                    <td class="td-class"><?php foreach ($accststatus as $i => $v) { echo $item["STATUS"] == $i ? $v : ''; } ?></td>
                                </tr> <?php 
                            } else {
                                $minrow = 1; ?>
                                <tr class="table-warning">
                                    <td style="display: none;"><?=$minrow ?></td>
                                    <td class="td-class"><?=$tdata['SALETRANNO'] ?></td>
                                    <td class="td-class"><?=$tdata['SALEORDERNO'] ?></td>
                                    <td class="td-class"><?=$tdata['SALETRANLN'] ?></td>
                                    <td class="td-class"><?=$tdata['ITEMCD'] ?></td>
                                    <td class="td-class"><?=$tdata['ITEMNAME'] ?></td>
                                    <td class="td-class"><?php foreach ($accststatus as $i => $v) { echo $tdata["STATUS"] == $i ? $v : ''; } ?></td>
                                </tr><?php
                                break;
                            }
                        }  
                        for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                            <tr class="table-warning">
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                            </tr> <?php 
                        }
                    } else {
                        for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                        <tr class="table-warning">
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                        </tr><?php }
                    } ?> 
                  </tbody>
                </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>  <?php echo !empty($tdata) ? count($tdata) : 0 ?></div>
        <div class="flex footer">
            <div class="flex col-first">
                <button type="button" id="select_item" name="search" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['SELECT']; ?></button>&emsp;&emsp;
                <button type="button" id="view_item" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['DETAIL']; ?></button>
            </div>
            <div class="flex col-second" style="justify-content: right;">
                <button type="reset" onclick="return clearForm(this.form);" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                <button type="button" id="back" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['BACK']; ?></button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <label class="font-size16"><?=$lang['detail']; ?></label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <table class="table-head table-striped" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                <thead>
                    <tr class="th-class">
                        <th style="text-align: left; padding-left: 2%;"><?=$data['TXTLANG']['TITLE']; ?></th>
                        <th style="text-align: center;"><?=$data['TXTLANG']['VALUE']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']["INVOICE_NO"] ?></td>
                        <td class="td-class" id="INVOICE_NO"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']["SALEORDERNO"] ?></td>
                        <td class="td-class" id="SALEORDERNO" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']["LINE"] ?></td>
                        <td class="td-class" id="LINE"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']["ITEMCD"] ?></td>
                        <td class="td-class" id="ITEMCD" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?=$data['TXTLANG']["ITEMNAME"] ?></td>
                        <td class="td-class" id="ITEMNAME"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?=$data['TXTLANG']["STATUS"] ?></td>
                        <td class="td-class" id="STATUS" style="background-color:#ffe6cc;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?> 6</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-action" data-bs-dismiss="modal"><?php echo $data['TXTLANG']['END']; ?></button>
        </div>
    </div>
  </div>
</div>
<div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
</div>
</body>
<script src="./js/script.js"></script>
</html>