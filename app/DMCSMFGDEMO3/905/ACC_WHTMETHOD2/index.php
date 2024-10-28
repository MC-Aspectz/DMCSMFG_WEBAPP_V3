<?php require_once('./function/index_x.php');?>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
          <!-- Content Page -->
          <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
          <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
          <form class="w-full" method="POST" id="supplierwithholdtax" name="supplierwithholdtax" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
              <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
              <div class="flex mb-1 px-2">
                <div class="flex w-8/12">
                  <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCD')?></label>
                  <div class="relative w-4/12 mr-1">
                      <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                              name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" onchange="unRequired();" required/>
                      <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                          id="SEARCHSUPPLIER">
                          <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                          </svg>
                      </a>
                  </div>
                  <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                          name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>
                </div>
                <div class="flex w-4/12 justify-end">
                    <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                            id="SEARCH" name="SEARCH" onclick="searchs();"><?=checklang('SEARCH')?>
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>
                </div>
              </div>    

              <div class="overflow-scroll block h-[240px] max-h-[240px]"> 
                <table id="search_table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                              </th>
                              <th class="px-6 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYABLECD')?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                              </th>
                              <th class="px-6 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WITHHOLDINGTAXCD')?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                              </th>
                              <th class="px-6 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('EXPENSEITEMCD')?></span>
                              </th>
                          </tr>
                      </thead>
                      <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['CWH'])) {
                          $minrow = count($data['CWH']);
                          foreach ($data['CWH'] as $key => $value) { ?>
                              <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['WHTAXTYPE']) && isset($data['DRPLANG']['WHTAXTYP'][$value['WHTAXTYPE']]) ? $data['DRPLANG']['WHTAXTYP'][$value['WHTAXTYPE']] : '' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_CD1']) ? $value['ACC_CD1']: '' ?></td>
                                  <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCNAME1']) ? $value['ACCNAME1']:'' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_CD2']) ? $value['ACC_CD2']: '' ?></td>
                                  <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCNAME2']) ? $value['ACCNAME2']: '' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_CD3']) ? $value['ACC_CD3']: '' ?></td>
                                  <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCNAME3']) ? $value['ACCNAME3']: '' ?></td>
                                  <td class="hidden"><?=isset($value['WHTAXTYPE']) ? $value['WHTAXTYPE']: '' ?></td>
                              </tr><?php
                          }
                        }
                        for ($i = $minrow; $i < $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                      </tbody>
                  </table>
              </div>   

              <div class="flex p-2">
                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
              </div>

              <div class="flex flex-col">
                <!-- Card -->
                <div class="p-1 inline-block align-middle">
                    <!-- Header -->
                    <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                        <details class="p-1 w-full align-middle" open><!-- open -->
                        <summary class="text-color mx-auto py-2 text-sm font-semibold"> 
                          <div class="flex my-1">
                            <div class="flex w-7/12 px-2">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                  id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                  id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button> -->
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                  id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                            </div>
                            <div class="flex w-5/12 px-2 justify-end">
                                <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                        id="CSV" name="CSV"><?=checklang('CSV'); ?></button>&emsp;&emsp; -->
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                      id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                            </div>
                          </div>
                        </summary>

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WHTAXTYP')?></label>
                          <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="WHTAXTYPE" name="WHTAXTYPE" onchange="unRequired();">
                              <option value=""></option>
                              <?php foreach ($whtaxtype as $key => $item) { ?>
                                <option value="<?php echo $key ?>" <?php echo (isset($data['WHTAXTYPE']) && $data['WHTAXTYPE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                              <?php } ?>
                          </select>
                          <input type="hidden" class="hidden" name="ROWCOUNTER" id="ROWCOUNTER" value="<?=isset($data['ROWCOUNTER']) ? $data['ROWCOUNTER']: ''; ?>" readonly/>
                          <div class="w-6/12"></div>
                        </div>        


                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DEBITACC_TYP')?></label>
                          <div class="w-9/12"></div>
                        </div>        

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PAYABLECD')?></label>
                          <div class="relative w-3/12 mr-2">
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="ACC_CD1" id="ACC_CD1" value="<?=isset($data['ACC_CD1']) ? $data['ACC_CD1']: ''; ?>" onchange="unRequired();"/>
                              <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                  id="SEARCHACCOUNT1">
                                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                  </svg>
                              </a>
                          </div>
                          <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="ACCNAME1" id="ACCNAME1" value="<?=isset($data['ACCNAME1']) ? $data['ACCNAME1']: ''; ?>" readonly/>
                          <div class="w-1/12"></div>
                        </div>     
                        
                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CRDITACC_TYP')?></label>
                          <div class="w-9/12"></div>
                        </div>  

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WITHHOLDINGTAXCD')?></label>
                          <div class="relative w-3/12 mr-2">
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="ACC_CD2" id="ACC_CD2" value="<?=isset($data['ACC_CD2']) ? $data['ACC_CD2']: ''; ?>" onchange="unRequired();"/>
                              <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                  id="SEARCHACCOUNT2">
                                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                  </svg>
                              </a>
                          </div>
                          <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="ACCNAME2" id="ACCNAME2" value="<?=isset($data['ACCNAME2']) ? $data['ACCNAME2']: ''; ?>" readonly/>
                          <div class="w-1/12"></div>
                        </div>  

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('EXPENSEITEMCD')?></label>
                          <div class="relative w-3/12 mr-2">
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="ACC_CD3" id="ACC_CD3" value="<?=isset($data['ACC_CD3']) ? $data['ACC_CD3']: ''; ?>" onchange="unRequired();"/>
                              <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                  id="SEARCHACCOUNT3">
                                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                  </svg>
                              </a>
                          </div>
                          <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="ACCNAME3" id="ACCNAME3" value="<?=isset($data['ACCNAME3']) ? $data['ACCNAME3']: ''; ?>" readonly/>
                          <div class="w-1/12"></div>
                        </div>  
                        </details>
                    </div>
                    <!-- End Header -->
                </div>
                <!-- End Card -->
              </div>

              <div class="flex mt-2">
                  <div class="flex w-6/12"></div>
                  <div class="flex w-6/12 justify-end">
                      <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                              onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                      <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                              onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?></button>
                  </div>
              </div>
          </form>
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
  function HandlePopupResult(code, result) {
      // console.log("result of popup is: " + code + ' : ' + result);
      return getSearch(code, result);
  }

  function HandlePopupIndex(result, index) {
      $('#loading').show();
      return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/905/ACC_WHTMETHOD2/index.php?ACC_CD=' + result +'&index=' + index;
  }

  function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=$lang['validation1']; ?>',
          // background: '#8ca3a3',
          showCancelButton: false,
          // confirmButtonColor: 'silver',
          // cancelButtonColor: 'silver',
          confirmButtonText:  '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
          if (result.isConfirmed) {
          }
      });
  }
</script>
</html>
