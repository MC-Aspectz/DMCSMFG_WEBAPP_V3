<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  guide Include  -->
    <?php guideInclude(); ?>
    <!-- -------------------------------------------------------------------------------- -->
    
    <title><?=$_SESSION['APPNAME'].' - '.$lang['searchstate']; ?></title>
</head>
<body>
<main>
<input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="pageUrl" name="pageUrl" <?php if(!empty($_GET['pageUrl'])){ ?> value="<?=$_GET['pageUrl']; ?>"<?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>" <?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="guideindex" name="guideindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['countrycode']; ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        id="COUNTRYCD" name="COUNTRYCD" value="<?=$COUNTRYCD ?>" readonly/>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['statename']; ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="STATENAME" name="STATENAME" value="<?=$STATENAME ?>"/>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="search" name="search" onclick="$('#loading').show();"><?=$lang['search']; ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="table">
            <table id="table_result" class="w-full border-collapse border border-slate-500">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-1/2 text-left pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['statecode']; ?></span>
                        </th>
                        <th class="w-1/2 text-left pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['statename']; ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php 
                    if (!empty($tdata)) {
                        foreach ($tdata as $item) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/2 text-sm pl-1"><?=$item['STATECD'] ?></td>
                            <td class="h-6 w-1/2 text-sm pl-1"><?=$item['STATENAME'] ?></td>
                        </tr>
                    <?php }
                            for ($i = count($tdata)+1; $i <= 10; $i++) { ?>
                                <tr class="flex w-full p-0 divide-x">
                                    <td class="h-6 w-1/2"></td>
                                    <td class="h-6 w-1/2"></td>
                                </tr><?php 
                            }
                        } else {
                            for ($i = 0; $i < 10; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/2"></td>
                            <td class="h-6 w-1/2"></td>
                        </tr><?php }
                    } ?> 
                  </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?php echo $lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                id="select_item" name="search"><?=$lang['select']; ?></button>&emsp;&emsp;
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back" class="btn btn-outline-secondary btn-action"><?=$lang['back']; ?></button>
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
                        <td class="td-class" style="background-color:#ffe6cc;"><?php echo $lang["statecode"] ?></td>
                        <td class="td-class" id="statecode" style="background-color:#ffe6cc;"></td>
                    </tr>   
                    <tr>
                        <td class="td-class"><?php echo $lang["statename"] ?></td>
                        <td class="td-class" id="statenames"></td>
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

<!-- start::loading -->
<div id="loading" class="on hidden">
    <div class="cv-spinner"><div class="spinner"></div></div>
</div>
<!-- end::loading -->
</main>
</body>
<script src="./js/script.js"></script>
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->