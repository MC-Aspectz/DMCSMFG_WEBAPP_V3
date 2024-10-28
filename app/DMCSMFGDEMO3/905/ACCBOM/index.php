<?php require_once('./function/index_x.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/font-awesome-6.4.0-all.min.css'; ?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="accountcodetree" name="accountcodetree" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
              <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
              <div class="flex mb-1">
                <div class="flex w-6/12 px-2">
                    <div class="flex-col w-full">
                      <div class="flex mb-1">
                          <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_GROUP')?></label>
                          <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 req" id="ACCGROUPTYP" name="ACCGROUPTYP" onchange="unRequired();" required>
                                <option value=""></option>
                                <?php foreach ($acc01 as $acc01key => $acc01item) { ?>
                                    <option value="<?=$acc01key?>" <?=(isset($data['ACCGROUPTYP']) && $data['ACCGROUPTYP'] == $acc01key) ? 'selected' : '' ?>><?=$acc01item ?></option>
                                <?php } ?>
                          </select>
                      </div>
                      <div class="flex mb-1">
                        <div class="w-full h-[450px] border border-black overflow-auto" id="account_tree"><?php 
                          if(!empty($data['searchG'])) { // print_r($data['searchG']);
                            foreach ($data['searchG'] as $searchkey => $item) { 
                              if($item['PATH'] == $data['ACCGROUPTYP']) { ?>
                                <div class="title" id="title<?=$item['PATH']?>" onclick="expanded(<?=$item['PATH']?>, 1); searchC(<?=$item['DATA']?>);">
                                    <i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$item['TITLE']?></label>
                                </div>
                              <div class="accountView" id="accountView<?=$item['PATH']?>"><?php
                                  foreach ($data['searchC'] as $key => $value) { ?>
                                     <div class="title1" id="title1<?=$value['ACCOUNTCD']?>" onclick="expanded(<?=$value['ACCOUNTCDID']?>, 2); searchC(<?=$value['ACCOUNTCDID']?>);">
                                      <ul id="selectView<?=$key?>" onclick="selectView('<?=$key?>');" >
                                        <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$value['ACCOUNTNAME'].'('.$value['ACCOUNTCDID'].')';?></label></li>
                                      </ul>
                                    </div>
                                
                                    <div class="accountView1 pl-5" id="accountView1<?=$value['ACCOUNTCD']?>"> <?php 
                                        foreach ($data['searchG'] as $stkey => $stitem) {
                                          if(strlen($stitem['PATH']) == 14 && substr($stitem['PATH'], 5, 4) == $value['ACCOUNTCD']) {
                                            // print_r($stitem['PATH'].'</br>');
                                            // print_r(substr($stitem['PATH'], -4).'=='.$value['ACCOUNTCD']);
                                            ?>
                                          <div class="title2" id="title2<?=$stkey?>" onclick="expanded(<?=$stkey?>, 3); searchC('<?=$stitem['DATA']?>');">
                                            <ul id="selectView<?=$stkey?>" onclick="selectView('<?=$stkey?>');">
                                              <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$stitem['TITLE']?></label></li>
                                            </ul>
                                          </div>

                                          <div class="accountView2" id="accountView2<?=$stkey?>"> <?php
                                              foreach($data['searchG'] as $ndkey => $nditem) {
                                                // && substr($nditem['PATH'], 5, 4) == $value['ACCOUNTCD']
                                              if(strlen($nditem['PATH']) == 19 && substr($nditem['PATH'], 10, 4) === $stitem['DATA']) {  // Check ว่าสิ้นสุดออกเป็น folder หรือ เอกสาร 1210-01 checkจากอันทีมี ?>
                                                <div class="title3" id="title3<?=$ndkey?>" onclick="expanded(<?=$ndkey?>, 4); searchC('<?=$nditem['DATA']?>');">
                                                  <ul id="selectView<?=$ndkey?>" onclick="selectView('<?=$ndkey?>');">
                                                    <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$nditem['TITLE']?></label></li>
                                                  </ul>
                                                </div>
                                                  <div class="accountView3" id="accountView3<?=$ndkey?>"> <?php
                                                    foreach ($data['searchG'] as $thkey => $thitem) {
                                                      // print_r($thitem['PATH'].'</br>');
                                                      // print_r(substr($thitem['PATH'], 15, 4).'</br>');
                                                      if(strlen($thitem['PATH']) == 27 && substr($thitem['PATH'], 15, 4) == $nditem['DATA']) { ?>
                                                        <div class="title4" id="title4<?=$thkey?>" onclick="searchC('<?=$thitem['DATA']?>');">
                                                          <ul id="selectView<?=$thkey?>" onclick="selectView('<?=$thkey?>');">
                                                            <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i>&ensp;<?=$thitem['TITLE']?></li>
                                                          </ul>
                                                        </div><?php
                                                      } 
                                                      if(strlen($thitem['PATH']) == 37 && substr($thitem['PATH'], 15, 4) == substr($thitem['PATH'], 20, 4) && substr($thitem['PATH'], 20, 4) == $nditem['DATA']) { ?>
                                                        <div class="title5" id="title5<?=$thkey?>">
                                                          <ul id="selectView<?=$thkey?>" onclick="selectView('<?=$thkey?>'); searchC('<?=$thitem['DATA']?>');">
                                                            <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i>&ensp;<?=$thitem['TITLE']?></li>
                                                          </ul>
                                                        </div><?php
                                                      }
                                                    } ?>
                                                  </div>
                                                <?php
                                              } else if(strrpos($nditem['TITLE'], '-') != '' && strlen($nditem['PATH']) == 22 && substr($nditem['PATH'], 10, 4) == $stitem['DATA']) { ?>
                                                <div class="title3" id="title3<?=$ndkey?>">
                                                  <ul id="selectView<?=$ndkey?>" onclick="selectView('<?=$ndkey?>'); searchC('<?=$nditem['DATA']?>');">
                                                    <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i><label class="text-item"><?=$nditem['TITLE']?></label></li>
                                                  </ul>
                                                </div><?php  
                                              }
                                            } ?>
                                          </div>  <?php
                                          } ?>
                                     <?php
                                        } ?>
                                    </div> 
                                      <?php
                                  }  ?>
                              </div> <?php
                              }
                            } 
                          }?>
                        </div> 
                      </div>
                    </div>
                </div>

                <div class="flex w-6/12 px-2">
                    <div class="flex-col w-full">
                      <div class="flex mb-1 justify-end">
                          <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                              id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                              <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                              </svg>
                          </button>
                      </div>
           
                      <div class="overflow-scroll block h-[360px] max-h-[360px]"> 
                        <table id="table_acc" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                          <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                </th>
                                <th class="px-14 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                 <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 2); ?></span>
                                </th>
                              </tr>
                            </thead>
                            <!-- <tbody> -->
                            <tbody id="datadvw" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                              if(!empty($data['ITEM'])) {
                                // print_r($data['ITEM']);
                                $minrow = count($data['ITEM']);
                                foreach ($data['ITEM'] as $key => $value) { ?>
                                  <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=$key?></td>
                                    <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=$value['ACCOUNTCD']?></td>
                                    <td class="h-6 w-6/12 pl-1 text-sm border border-slate-700 text-left"><?=$value['ACCOUNTNAME']?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700"></td>
                                    <td class="hidden"><?=$value['ACCOUNTCDID']?></td>
                                    <td class="hidden"><input type="text" name="ACCOUNTCDIDA[]" value="<?=$value['ACCOUNTCDID']?>"></td>
                                    <td class="hidden"><input type="text" name="ACCOUNTCDA[]" value="<?=$value['ACCOUNTCD']?>"></td>
                                    <td class="hidden"><input type="text" name="ACCOUNTNAMEA[]" value="<?=$value['ACCOUNTNAME']?>"></td>
                                  </tr><?php
                                }
                              }
                              for ($i = $minrow; $i < $maxrow; $i++) { ?>
                                <tr class="divide-y divide-gray-200">
                                  <td class="h-6 border border-slate-700"></td>
                                  <td class="h-6 border border-slate-700"></td>
                                  <td class="h-6 border border-slate-700"></td>
                                  <td class="h-6 border border-slate-700"></td>
                                </tr> <?php
                              } ?>
                            </tbody>
                                <tfoot class="sticky bottom-0">
                                  <tr class="pointer-events-none">
                                    <td class="text-color h-6 text-[12px]" colspan="11"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowCount" ><?=$minrow; ?></span></td>
                                  </tr>
                                </tfoot>
                        </table>
                      </div>  

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
                              id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                        </div>
                      </div>

                      <div class="flex mb-1">
                        <div class="flex w-full px-2">
                          <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                          <div class="relative w-4/12 mr-2">
                              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="ACCOUNTCD" id="ACCOUNTCD" value="<?=isset($data['ACCOUNTCD']) ? $data['ACCOUNTCD']: ''; ?>" onchange="unRequired();"/>
                              <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                  id="SEARCHACCOUNT">
                                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                  </svg>
                              </a>
                          </div>
                          <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="ACCOUNTNAME" id="ACCOUNTNAME" value="<?=isset($data['ACCOUNTNAME']) ? $data['ACCOUNTNAME']: ''; ?>" readonly/>
                          <input class="hidden" type="hidden" name="ACCOUNTCDID" id="ACCOUNTCDID" value="<?=isset($data['ACCOUNTCDID']) ? $data['ACCOUNTCDID']: ''; ?>" />
                          <input class="hidden" type="hidden" name="DATA" id="DATA" value="<?=isset($data['DATA']) ? $data['DATA']: ''; ?>" />
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="flex mt-2">
                  <div class="flex w-6/12"></div>
                  <div class="flex w-6/12 justify-end">
                      <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                              onclick="unsetSession(this.form); window.location.href = '../ACCBOM/';"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                      <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                               onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-U3Ap9l1MWNyB+HE6fdt7quTR/6u/L6zew6TR8tceOu8tvGGMcmLhZ6VFKsDu4f7g" crossorigin="anonymous"></script> -->
<script type="text/javascript">
  $(document).ready(function() {  
      unRequired();
      document.getElementById('UPDATE').disabled = true;
      document.getElementById('DELETE').disabled = true;  

      $('#table_acc').on('click', 'tr', function(e) { e.preventDefault();
        changeRowId();
        let itemacc = $(this).closest('tr').children('td');
        // console.log($(this));
        // console.log(itemacc.eq(0).text());
        if(itemacc.eq(0).text() != 'undefined' && itemacc.eq(0).text() != '') {
            // console.log(itemacc.eq(0).text());
          $(this).attr('id', 'click-row');
          // $(this).addClass('clickRow');
          $('#ACCOUNTCD').val(itemacc.eq(1).text());
          $('#ACCOUNTNAME').val(itemacc.eq(2).text());
          $('#ACCOUNTCDID').val(itemacc.eq(4).text());
          document.getElementById('INSERT').disabled = true;
          document.getElementById('UPDATE').disabled = false;
          document.getElementById('DELETE').disabled = false;
          unRequired();
        }
      });
  }); 

  function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    return getAccCCd(result);
  }

  function actionDialog(type) {
      if(type == 1) {
          return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
      } else {
          return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
      }
  }

  function unRequired() {
      document.getElementById('ACCOUNTCD').classList[document.getElementById('ACCOUNTCD').value !== '' ? 'remove' : 'add']('req');
      document.getElementById('ACCGROUPTYP').classList[document.getElementById('ACCGROUPTYP').value !== '' ? 'remove' : 'add']('req');
  }
</script>
</html>