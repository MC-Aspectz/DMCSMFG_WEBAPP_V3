<?php require_once('./function/index_x.php');?>
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
    
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHPURCHASEORDER']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''; ?>">
    <form class="w-full h-screen p-2" method="POST" id="quotationindex" name="quotationindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PURCHASEORDERNO'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P1" name="P1" value="<?=isset($data['P1']) ? $data['P1'] : ''; ?>"/>
                <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('STATUS'); ?></label>
                <select id="P9" name="P9" class="text-control shadow-md border px-3 h-7 w-4/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" <?=(isset($data['P9']) && $data['P9'] === '') ? 'selected' : '' ?>></option>
                    <?php foreach ($statuspurchase as $k => $value) { ?>
                        <option value="<?=$k ?>"<?php echo (isset($data['P9']) && $data['P9'] == $k) ? 'selected' : '' ?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex w-2/12"></div>
        </div>
    
        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE'); ?></label>
                <div class="relative w-4/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="P2" name="P2" value="<?=isset($data['P2']) ? $data['P2'] : ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHSUPPLIER">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 ml-2 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        id="P2NAME" name="P2NAME" value="<?=isset($data['P2NAME']) ? $data['P2NAME'] : ''; ?>" readonly/>
            </div>
            <div class="flex w-4/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE'); ?></label>
                <div class="relative w-4/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="DIVISIONCD" name="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD'] : ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHDIVISION">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 ml-2 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME'] : ''; ?>" readonly/>
            </div>
            <div class="flex w-4/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE'); ?></label>
                <div class="relative w-4/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="P3" name="P3" value="<?=isset($data['P3']) ? $data['P3'] : ''; ?>" />
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHITEM">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex w-4/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMNAME'); ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="P4" name="P4" value="<?=isset($data['P4']) ? $data['P4'] : ''; ?>"/>
            </div>
            <div class="flex w-4/12">
            
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ISSUE_DATE'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P5" name="P5" value="<?=isset($data['P5']) ? $data['P5'] : ''; ?>"/>&ensp;→&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P6" name="P6" value="<?=isset($data['P6']) ? $data['P6'] : ''; ?>"/>       
            </div>
            <div class="flex w-4/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-8/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ORDERDUEDATE'); ?></label>
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P7" name="P7" value="<?=isset($data['P7']) ? $data['P7'] : ''; ?>"/>&ensp;→&ensp;
                <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        id="P8" name="P8" value="<?=isset($data['P8']) ? $data['P8'] : ''; ?>"/>       
            </div>
            <div class="flex w-4/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH'); ?>
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
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PURCHASEORDERNO'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ISSUE_DATE'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUE_DATE'); ?></span>
                        </th>
                         <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALEORDERNO'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) { $minrow = count($tdata);
                        foreach ($tdata as $item) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['PURORDERNO'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm text-center"><?=$item['PURORDERLN'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['PURITEMCD'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['PURITEMNAME'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['PURISSUEDT'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['PURDUEDT'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['PURSALENOLN'] ?></td>
                            </tr><?php 
                        }
                        for ($i = $minrow; $i < $maxrow; $i++) {?>
                          <tr class="flex w-full p-0 divide-x">
                              <td class="h-6 w-2/12"></td>
                              <td class="h-6 w-1/12"></td>
                              <td class="h-6 w-1/12"></td>
                              <td class="h-6 w-2/12"></td>
                              <td class="h-6 w-2/12"></td>
                              <td class="h-6 w-2/12"></td>
                              <td class="h-6 w-2/12"></td>
                          </tr><?php 
                        }
                    } else {
                        for ($i = $minrow; $i < $maxrow; $i++) {  ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                        </tr><?php }
                    } ?> 
                </tbody>
            </table>    
            <div class="flex pt-2">
                <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowcount" ><?=$minrow ?></span></label>
            </div>
        </div>
          
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=checklang('SELECT'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=checklang('DETAIL'); ?></button>&emsp;&emsp;
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return clearForm(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=checklang('BACK'); ?></button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <label class="text-gray-700 text-base font-semibold"><?=checklang('DETAIL'); ?></label>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <table class="w-full border-collapse border border-slate-500" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PURCHASEORDERNO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PURCHASEORDERNO"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('LINE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCODE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('ITEMNAME') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ISSUE_DATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="ISSUE_DATE"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=checklang('DUE_DATE') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="DUE_DATE" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALEORDERNO') ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="SALEORDERNO"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?> 7</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
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
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->
