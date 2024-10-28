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
          <form class="w-full" method="POST" id="accountmaster_acc" name="accountmaster_acc" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
              <div class="flex mb-1 px-2">
                <div class="flex w-8/12">
                  <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_GROUP')?></label>
                  <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="ACC_GPS" name="ACC_GPS">
                      <option value=""></option>
                      <?php foreach ($acc01 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?php echo (isset($data['ACC_GPS']) && $data['ACC_GPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                      <?php } ?>
                  </select>
                  <!-- <?php if(!empty($data['ACC_GPS'])) { ?> <label class="w-4/12 pl-6 pt-1 font-semibold"><?=$data['DRPLANG']['ACC01'][$data['ACC_GPS']]; ?>?></label> <?php }?> -->
                  <input type="hidden" class="hidden" name="ACC_GPSNM" id="ACC_GPSNM" value="<?=isset($data['ACC_GPSNM']) ? $data['ACC_GPSNM']: ''; ?>" readonly/>
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
  
              <div class="overflow-scroll block h-[310px] max-h-[310px]"> 
                <table id="search_table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                              </th>
                              <th class="px-10 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                              </th>
                              <th class="px-10 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME2')?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 2); ?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 2); ?></span>
                              </th>
                              <th class="px-3 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCOUNTTYP')?></span>
                              </th>
                              <th class="px-6 text-center border border-slate-700">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_GROUP')?></span>
                              </th>
                          </tr>
                      </thead>
                      <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ACCMAS'])) {
                          $minrow = count($data['ACCMAS']);
                          foreach ($data['ACCMAS'] as $key => $value) { ?>
                              <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCOUNTCD']) ? $value['ACCOUNTCD']: '' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCOUNTNAME']) ? $value['ACCOUNTNAME']: '' ?></td>
                                  <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCOUNTNAME2']) ? $value['ACCOUNTNAME2']:'' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_TYP']) ? $data['DRPLANG']['TAISYAKU'][$value['ACC_TYP']]: '' ?></td>
                                  <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['INPACCEPT_TYP']) ? $data['DRPLANG']['YESNOFLG'][$value['INPACCEPT_TYP']]: '' ?></td>
                                  <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCSUM_TYP']) ? $data['DRPLANG']['YESNOFLG'][$value['ACCSUM_TYP']] : '' ?></td>
                                  <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_GRP']) ? $data['DRPLANG']['ACC01'][$value['ACC_GRP']]: '' ?></td>
                                  <td class="hidden"><?=isset($value['ACC_TYP']) ? $value['ACC_TYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['INPACCEPT_TYP']) ? $value['INPACCEPT_TYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['ACCSUM_TYP']) ? $value['ACCSUM_TYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['ACC_GRP']) ? $value['ACC_GRP']: '' ?></td>
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
                  <div class="flex p-2">
                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                  </div>
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
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                  id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                  id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                            </div>
                            <div class="flex w-5/12 px-2 justify-end">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center" 
                                    id="CSV" name="CSV" onclick="exportCSV();"><?=checklang('CSV'); ?></button>&emsp;&emsp;
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                    id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                            </div>
                          </div>
                        </summary> 

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                          <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                  name="ACCOUNTCD" id="ACCOUNTCD" value="<?=isset($data['ACCOUNTCD']) ? $data['ACCOUNTCD']: ''; ?>" onchange="unRequired();" required/>
                          <input type="hidden" id="CARRYOVERFLG" name="CARRYOVERFLG" value="<?=isset($data['CARRYOVERFLG']) ? $data['CARRYOVERFLG']: ''?>" />
                          <input type="hidden" id="ACCLIST_TYP" name="ACCLIST_TYP" value="<?=isset($data['ACCLIST_TYP']) ? $data['ACCLIST_TYP']: ''?>" />
                          <div class="w-5/12"></div>
                        </div>        

                        <div class="flex mb-1 px-2">
                              <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_NAME')?></label>
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-2 py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="ACCOUNTNAME" id="ACCOUNTNAME" value="<?=isset($data['ACCOUNTNAME']) ? $data['ACCOUNTNAME']: ''; ?>" onchange="unRequired();" required/>
                              <input type="checkbox" id="INPACCEPT_TYP" name="INPACCEPT_TYP" value="T" <?php echo (isset($data['INPACCEPT_TYP']) && $data['INPACCEPT_TYP'] == 'T') ? 'checked' : '' ?>/>
                              <input type="hidden" name="INPACCEPT_TYP" value="F"/>
                              <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('INPACCEPT_TYPE'); ?></label>
                        </div>   

                        <div class="flex mb-1 px-2">
                              <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_NAME2')?></label>
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-2 py-2 px-3 text-gray-700 border-gray-300"
                                      name="ACCOUNTNAME2" id="ACCOUNTNAME2" value="<?=isset($data['ACCOUNTNAME2']) ? $data['ACCOUNTNAME2']: ''; ?>"/>
                              <input type="checkbox" id="ACCSUM_TYP" name="ACCSUM_TYP" value="T" <?php echo (isset($data['ACCSUM_TYP']) && $data['ACCSUM_TYP'] == 'T') ? 'checked' : '' ?>/>
                              <input type="hidden" name="ACCSUM_TYP" value="F"/>
                              <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('ACCSUM_TYPE'); ?></label>
                        </div>   

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACCOUNTTYP')?></label>
                          <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="ACC_TYP" name="ACC_TYP" onchange="unRequired();" required>
                              <option value=""></option>
                              <?php foreach ($taisyakul as $key => $item) { ?>
                                <option value="<?=$key ?>" <?php echo (isset($data['ACC_TYP']) && $data['ACC_TYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                              <?php } ?>
                          </select>
                          <div class="w-6/12"></div>
                        </div>  

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_GROUP')?></label>
                          <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="ACC_GRP" name="ACC_GRP" onchange="unRequired();" required>
                              <option value=""></option>
                              <?php foreach ($ACC01S as $key => $item) { ?>
                                <option value="<?=$key ?>" <?php echo (isset($data['ACC_GRP']) && $data['ACC_GRP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                              <?php } ?>
                          </select>
                          <div class="w-6/12"></div>
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
          if (result.isConfirmed) {}
      });
  }
</script>
</html>
