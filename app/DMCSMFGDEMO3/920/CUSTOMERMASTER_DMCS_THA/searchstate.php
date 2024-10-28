<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../../css/menu.css">
    <link rel="stylesheet" href="../../../../css/bootstrap_523_min.css">
    <link rel="stylesheet" href="./css/style.css">

    <script src="../../../../js/jquery_363_min.js"></script>
    <script src="../../../../js/bootstrap_bundle_523_min.js"></script>

    <title><?php echo $lang['customermaster'].' - '.$lang['stateindexndex']; ?></title>
</head>
<body>
<!-- -------------------------------------------------------------------------------- -->
<!--  Menu  -->
<?php doMenu(); ?>
<!-- -------------------------------------------------------------------------------- -->
<form class="form" style="width: 90%;" method="POST" id="stateindex" name="stateindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?php echo $lang['statecd']; ?></label>
                <input class="width20 form-control" type="text" id="P1" name="P1" value="<?php  ?>"/>
            </div>
            <div class="flex col-second"></div>
        </div>
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?php echo $lang['statename']; ?></label>
                <input class="width30 form-control" type="text" id="P2" name="P2" value="<?php ?>"/>
            </div>
            <div class="flex col-second" style="justify-content: right; margin-right: 1%;">
                 <button type="submit" id="search" name="search" class="btn btn-action"><?php echo $lang['search']; ?></button>
            </div>
        </div>
        <br>
        <div class="flex">
            <div class="table height380"> 
                <table class="table-head" rules="cols" id="table_result" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr class="th-class table-secondary">
                            <th style="text-align: left; padding-left: 1%; width: 15%;"><?php echo $lang['statecd']; ?></th>
                            <th style="text-align: center; width: 25%;"><?php echo $lang['statename']; ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($tdata)) {
                    $run = 0;
                    foreach ($tdata as $item) { ?>
                        <tr class="table-warning">
                            <td style="display: none;"><?= ++$run; ?></td>
                            <td class="td-class"><?php echo $item["SUPPLIERCD"] ?></td>
                            <td class="td-class"><?php echo $item["SUPPLIERNAME"] ?></td>
                            <td class="td-class"><?php echo $item["SUPPLIERADDR1"] ?></td>
                            <td class="td-class"><?php echo $item["SUPPLIERADDR2"] ?></td>
                        </tr>
                    <?php }
                  } ?>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $lang['rowcount']; ?>  <?php echo !empty($tdata) ? count($tdata) : 0 ?></div>
        <div class="flex footer" style="width: 90%;">
            <div class="flex col-first">
                <button type="button" id="select_item" name="search" class="btn btn-action"><?php echo $lang['select']; ?></button>&emsp;&emsp;
                <button type="button" id="view_item" class="btn btn-action"><?php echo $lang['view']; ?></button>
            </div>
            <div class="flex col-second" style="justify-content: right;">
                <button type="reset" onclick="return clearForm(this.form);" class="btn btn-action"><?php echo $lang['clear']; ?></button>&emsp;&emsp;
                <button type="button" id="back" class="btn btn-action"><?php echo $lang['back']; ?></button>
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
                        <td class="td-class"><?php echo $lang["suppliercd"] ?></td>
                        <td class="td-class" id="suppliercd"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?php echo $lang["suppliername"] ?></td>
                        <td class="td-class" id="suppliername" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?php echo $lang["address"] ?></td>
                        <td class="td-class" id="address1"></td>
                    </tr>
                    <tr>
                        <td class="td-class" style="background-color:#ffe6cc;"><?php echo $lang["address"] ?></td>
                        <td class="td-class" id="address2" style="background-color:#ffe6cc;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="font-size14"><?php echo $lang['rowcount']; ?> 4</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-action" data-bs-dismiss="modal"><?php echo $lang['end']; ?></button>
        </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
    var isItem = false;
    $('table#table_result tr').click(function () {
        $('table#table_result tr').removeAttr('id')
   
        $(this).attr('id', 'click-row');
       
        let item = $(this).closest('tr').children('td');

        if(item.eq(0).text() != 'undefined') {
            isItem = true;
        }

        $('#suppliercd').html(item.eq(1).text());
        $('#suppliername').html(item.eq(2).text());
        $('#address1').html(item.eq(3).text());
        $('#address2').html(item.eq(4).text());

        $("#select_item").on('click', function() {
             window.location.href="index.php?suppliercd=" + item.eq(1).text();
        });
    });

    $("#view_item").on('click', function() {
        if(isItem) {
           $('#item_view').modal('show');
        }
    });    

    $("#back").on('click', function() {
        // history.back();
        window.history.go(-1); return false;
    });
</script>
<script src="./js/script.js"></script>
</html>