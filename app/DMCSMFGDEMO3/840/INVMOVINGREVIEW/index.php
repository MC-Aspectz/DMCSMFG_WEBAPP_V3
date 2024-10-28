<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
    <div class="flex flex-col h-screen">
        <!--  start::navbar Menu -->
        <header class="flex relative top-0 text-semibold">
            <!-------------------------------------------------------------------------------------->
            <?php navBar(); ?>
            <!-------------------------------------------------------------------------------------->
        </header>
        <!--  end::navbar Menu -->
        <div class="flex flex-1 overflow-hidden">
            <!--   start::Sidebar Menu -->
            <!-------------------------------------------------------------------------------------->
            <?php sideBar(); ?>
            <!-------------------------------------------------------------------------------------->
            <!--   end::Sideba Menu -->

            <!--   start::Main Content  -->
            <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
                <!-- Content Page -->
                <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
                <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
                <form class="w-full" method="POST" id="inv_moving_review" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                <div class="flex mb-1 px-2 mt-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                name="ITEMCODE" id="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''?>" onchange="unRequried();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHITEM">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''?>" readonly/>
                        </div>     

                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="COMPANYNAME" name="COMPANYNAME" value="<?=isset($data['COMPANYNAME']['COMPANYNAME']) ? $data['COMPANYNAME']['COMPANYNAME']: ''?>" readonly/>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="COMPANY_MD" name="COMPANY_MD" value="<?=isset($data['COMPANYNAME']['COMPANY_MD']) ? $data['COMPANYNAME']['COMPANY_MD']: ''?>" readonly/>
                        
                    </div>
                </div>
                
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                        <input class="text-control shadow-md border rounded-xl h-7 -ml-1 w-10/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''?>" readonly/>
                    </div>   

                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['FOB4']; ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="TAXID" name="TAXID" value="<?=isset($data['COMPANYNAME']['TAXID']) ? $data['COMPANYNAME']['TAXID']: ''?>" readonly/>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="COM_CCODE" name="COM_CCODE" value="<?=isset($data['COMPANYNAME']['COM_CCODE']) ? $data['COMPANYNAME']['COM_CCODE']: ''?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['ONHAND']; ?></label>&emsp;&emsp;
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-2 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="ONHAND" name="ONHAND" value="<?=!empty($data['ONHAND']) ? number_format($data['ONHAND'], 2): ''?>" readonly/>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['BACKLOG']; ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" id="BACKLOG" name="BACKLOG" value="<?=!empty($data['BACKLOG']) ? number_format($data['BACKLOG'], 2): ''?>" readonly/>
                    </div> 

                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['DATE_RANGE']; ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 ml-2 w-7/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                               type="date" id="FROMDATE" name="FROMDATE" value="<?=isset($data['FROMDATE']) ? $data['FROMDATE']: ''?>" />
                        <label class="text-color block text-sm pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['ARROW']; ?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                               type="date" id="TODATE" name="TODATE" value="<?=isset($data['TODATE']) ? $data['TODATE']: ''?>" />
                    </div>
                </div>

                <div class="flex mb-1 px-2 mt-2">
                    <div class="flex w-6/12">

                    </div>    

                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                            id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="overflow-scroll mb-1 mt-3"> 
                    <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table">
                        <thead class="w-full bg-gray-100"> 
                            <tr class="flex w-full divide-x">
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['VOUCHER_NO']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['LINE']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['DATE']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['OPERATION']; ?></th><!-- dropdown -->
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['STORAGETYPE']; ?></th><!-- dropdown -->
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['STORAGE_CODE']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['LO_NAME']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['WAREHOUSE_QTY']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['QTYOUT']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['ORDER_NO']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['V_ISSUE_DATE']; ?></th>
                                <th class="w-40 text-center py-2" scope="col"><?php echo $data['TXTLANG']['REMARK']; ?></th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col overflow-y-scroll w-full h-[450px]">
                            <?php if(!empty($data['INV']))  {
                                $minrow = count($data['INV']);
                                // print_r($data['INV']);
                                    $rowno = 0;
                                    foreach ($data['INV'] as $key => $value) {
                                        if(is_array($value)) {
                                            $maxrow = count($data['INV']) + 1;
                                            ++$rowno;
                                        //   print_r($value);
                                        ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANVOUCHER']) ? $value['INVTRANVOUCHER']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANVOUCHERLINE']) ? $value['INVTRANVOUCHERLINE']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANENTRYDATE']) ? date('d/m/Y', strtotime($value['INVTRANENTRYDATE'])): ''  ?></td>
                                                <!-- <td class="h-6 w-40 text-sm pl-1 text-left" style="display: none"><?=isset($value['INVTRANTRXTYPE']) ? $value['INVTRANTRXTYPE']: '' ?></td> -->
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?php 
                                                if(isset($value['INVTRANTRXTYPE'])){
                                                foreach ($opr as $key => $item) { 
                                                    if($key == $value['INVTRANTRXTYPE'])
                                                        {
                                                            echo($item);
                                                        }
                                                    }                                 
                                                } ?></td>
                                                <!-- <td class="h-6 w-40 text-sm pl-1 text-left" style="display: none"><?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?></td> -->
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?php 
                                                if(isset($value['LOCTYP'])){
                                                foreach ($str as $key => $item) { 
                                                    if($key == $value['LOCTYP'])
                                                        {
                                                            echo($item);
                                                        }
                                                    }                                 
                                                } ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANQTY0']) ? $value['INVTRANQTY0']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANQTY1']) ? $value['INVTRANQTY1']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANORDERNUMBER']) ? $value['INVTRANORDERNUMBER']: '' ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANISSUEDT']) ? date('d/m/Y', strtotime($value['INVTRANISSUEDT'])): ''  ?></td>
                                                <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVTRANREMARK']) ? $value['INVTRANREMARK']: '' ?></td>
                                            </tr> <?php 
                                        } else {
                                            $minrow = 1; 
                                            ++$rowno;
                                            // print_r('2'); 
                                            ?>
                                                <tr class="flex w-full p-0 divide-x">
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANVOUCHER'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANVOUCHERLINE'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=isset($data['INV']['INVTRANENTRYDATE']) ? date('d/m/Y', strtotime($data['INV']['INVTRANENTRYDATE'])): ''  ?></td>
                                                    <!-- <th class="export-exclude" style="display: none"><?=isset($data['INV']['INVTRANTRXTYPE']) ? $data['INV']['INVTRANTRXTYPE']: '' ?></th> -->
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?php 
                                                    if(isset($data['INV']['INVTRANTRXTYPE'])){
                                                    foreach ($opr as $key => $item) { 
                                                        if($key == $data['INV']['INVTRANTRXTYPE'])
                                                            {
                                                                echo($item);
                                                            }
                                                        }                                 
                                                    } ?></td>
                                                    <!-- <th class="export-exclude" style="display: none"><?=isset($data['INV']['LOCTYP']) ? $data['INV']['LOCTYP']: '' ?></th> -->
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?php 
                                                    if(isset($data['INV']['LOCTYP'])){
                                                    foreach ($str as $key => $item) { 
                                                        if($key == $data['INV']['LOCTYP'])
                                                            {
                                                                echo($item);
                                                            }
                                                        }
                                                    } ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['LOCCD'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['LOCNAME'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANQTY0'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANQTY1'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANORDERNUMBER'] ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=isset($data['INV']['INVTRANISSUEDT']) ? date('d/m/Y', strtotime($data['INV']['INVTRANISSUEDT'])): ''  ?></td>
                                                    <td class="h-6 w-40 text-sm pl-1 text-left csv"><?=$data['INV']['INVTRANREMARK'] ?></td>
                                                </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $maxrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                                <td class="h-6 w-40 text-sm"></td>
                                            </tr><?php 
                                        }
                                        } else {
                                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                                <tr class="flex w-full p-0 divide-x">
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                    <td class="h-6 w-40 text-sm"></td>
                                                </tr><?php
                                            }
                                        } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>

                    <div class="flex mt-5">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="PRINT" name="PRINT" <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'on') ?>><?=$data['TXTLANG']['PRINT']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="CSV" name="CSV"><?=$lang['csv']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="view" name="view" <?php if(!empty($data['isView']) && $data['isView'] == 'on') ?>><?=$data['TXTLANG']['DETAIL']; ?>
                            </button>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']; ?>
                            </button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?php echo $data['TXTLANG']['END']; ?>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="text-gray-700 text-base font-semibold"><?php echo $lang['detail']; ?></label>
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
                                <tr class="th-class">
                                    <th class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['TITLE']; ?></th>
                                    <th class="text-center border border-slate-700 text-sm"><?=$data['TXTLANG']['VALUE']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['VOUCHER_NO']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="VOUCHER_NO" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['LINE']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['DATE']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="DATE" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['OPERATION']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="OPERATION"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['STORAGETYPE']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGETYPE" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['STORAGE_CODE']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGE_CODE"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['LO_NAME']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="LO_NAME" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['WAREHOUSE_QTY']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="WAREHOUSE_QTY"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['QTYOUT']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="QTYOUT" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['ORDER_NO']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="ORDER_NO"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$data['TXTLANG']['V_ISSUE_DATE']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="V_ISSUE_DATE" style="background-color:#ffe6cc;"></td>
                                </tr>
                                <tr>
                                    <td class="text-left pl-1 border border-slate-700 text-sm"><?=$data['TXTLANG']['REMARK']; ?></td>
                                    <td class="text-left pl-1 border border-slate-700 text-sm" id="REMARK"></td>
                                </tr>

                            </tbody>
                        </table>
                        <br>
                        <div class="h-6 text-[12px]"><?=$data['TXTLANG']['ROWCOUNT']; ?> 12</div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            data-bs-dismiss="modal"><?=$data['TXTLANG']['END']; ?></button>
                    </div>
                </div>
            </div>
            </div>
                <!-- -------------------------------------------------------------------------------- -->
                <div id="loading" class="on" style="display: none;">
                    <div class="cv-spinner">
                        <div class="spinner"></div>
                    </div>
                </div>
            </main>
            <!--   end::Main Content -->
        </div>

        <!-- start::footer -->
        <div class="flex bg-gray-200">
            <!-------------------------------------------------------------------------------------->
            <?php footerBar(); ?>
            <!-------------------------------------------------------------------------------------->
        </div>
        <!-- end::footer -->

        <!-- start::loading -->
        <div id="loading" class="on hidden">
            <div class="cv-spinner"><div class="spinner"></div></div>
        </div>
        <!-- end::loading -->
    </div>
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {
    unRequried();
});

var isItem = false;



$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');
  
    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        isItem = true;
        $('#VOUCHER_NO').html(item.eq(0).text());
        $('#LINE').html(item.eq(1).text());
        $('#DATE').html(item.eq(2).text());
        $('#OPERATION').html(item.eq(3).text());
        $('#STORAGETYPE').html(item.eq(4).text());
        $('#STORAGE_CODE').html(item.eq(5).text());
        $('#LO_NAME').html(item.eq(6).text());
        $('#WAREHOUSE_QTY').html(item.eq(7).text());
        $('#QTYOUT').html(item.eq(8).text());
        $('#ORDER_NO').html(item.eq(9).text());
        $('#V_ISSUE_DATE').html(item.eq(10).text());
        $('#REMARK').html(item.eq(11).text());
        unRequried();
    }
});

$("#view").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    


function unRequried() {
    if($('#ITEMCODE').val() != '') {
        document.getElementById('ITEMCODE').classList.remove('req');
    } else {
        document.getElementById('ITEMCODE').classList.add('req');
    }
}

// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

function enrty() {
    $('#CODEKEY').val('');
    $('#CODE').val('');
    document.getElementById("LANG").value = '';
    $('#TEXT').val('');
    $('#CODEID').val('');
}

function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=$lang['validation1']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else if(type == 2) {
            var item = '<?php echo (isset($data['INV']) ? count($data['INV']) : 0); ?>';
            if(item < 1) {
                alertWarning('<?=$lang['validation3']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
                return false;
            }
            return questionDialog(2, '<?=$lang['question4']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else if(type == 3) {
            var item = '<?php echo (isset($data['INV']) ? count($data['INV']) : 0); ?>';
            if(item < 1) {
                alertWarning('<?=$lang['validation1']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
                return false;
            }
            return exportCSV();
        } else {
            return alertWarning(type, '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        }
    }
    
</script>
</html>
     