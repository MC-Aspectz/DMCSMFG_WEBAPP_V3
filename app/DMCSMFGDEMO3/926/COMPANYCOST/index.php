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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="company_cost" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>



            <!-- COST_NAME 01 11 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1">1</label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['01']?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="COST_VALUE_01" name="COST_VALUE_01">
                        <option value=""></option>
                        <?php foreach ($dd1 as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_01']) && $data['load']['COST_VALUE_01'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                    <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1">11</label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['11']?></label>

                </div>

                <div class="flex w-6/12">
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="COST_VALUE_11" name="COST_VALUE_11">
                        <option value=""></option>
                        <?php foreach ($dd1 as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_11']) && $data['load']['COST_VALUE_11'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                </div>
            </div>

            <!-- COST_NAME 02 12 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">2</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['02']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_02" name="COST_VALUE_02">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_02']) && $data['load']['COST_VALUE_02'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">12</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['12']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_12" name="COST_VALUE_12">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_12']) && $data['load']['COST_VALUE_12'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            


            <!-- COST_NAME 03 13 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">3</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['03']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_03" name="COST_VALUE_03">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_03']) && $data['load']['COST_VALUE_03'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">13</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['13']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_13" name="COST_VALUE_13">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_13']) && $data['load']['COST_VALUE_13'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- COST_NAME 04 14 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">4</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['04']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_04" name="COST_VALUE_04">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_04']) && $data['load']['COST_VALUE_04'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">14</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['14']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_14" name="COST_VALUE_14">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_14']) && $data['load']['COST_VALUE_14'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- COST_NAME 05 15 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">5</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['05']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_05" name="COST_VALUE_05">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_05']) && $data['load']['COST_VALUE_05'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">15</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['15']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_15" name="COST_VALUE_15">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_15']) && $data['load']['COST_VALUE_15'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>         
            
            <!-- COST_NAME 06 16 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">6</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['06']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_06" name="COST_VALUE_06">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_06']) && $data['load']['COST_VALUE_06'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">16</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['16']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_16" name="COST_VALUE_16">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_16']) && $data['load']['COST_VALUE_16'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- COST_NAME 07 17 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">7</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['07']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_07" name="COST_VALUE_07">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_07']) && $data['load']['COST_VALUE_07'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">17</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['17']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_17" name="COST_VALUE_17">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_17']) && $data['load']['COST_VALUE_17'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- COST_NAME 08 18 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">8</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['08']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_08" name="COST_VALUE_08">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_08']) && $data['load']['COST_VALUE_08'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">18</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['18']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_18" name="COST_VALUE_18">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_18']) && $data['load']['COST_VALUE_18'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>           
            
            <!-- COST_NAME 09 19 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">9</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['09']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_09" name="COST_VALUE_09">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_09']) && $data['load']['COST_VALUE_09'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">19</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['19']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_19" name="COST_VALUE_19">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_19']) && $data['load']['COST_VALUE_19'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- COST_NAME 10 20 -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">10</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['10']?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_10" name="COST_VALUE_10">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_10']) && $data['load']['COST_VALUE_10'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1">20</label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$dd2['20']?></label>

                </div>

                <div class="flex w-6/12">
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="COST_VALUE_20" name="COST_VALUE_20">
                    <option value=""></option>
                    <?php foreach ($dd1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['load']['COST_VALUE_20']) && $data['load']['COST_VALUE_20'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                </div>
            </div>            

            <!-- divider -->
            <div class="grid grid-cols-3 divide-x-4 divide-teal-600 my-4"></div>

            <!-- subcontract -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                <label class="invisible text-color block text-sm w-1/12 pr-2 pt-1"></label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUBCONTRACTER_COST')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="SUBCONTRACT_COST" name="SUBCONTRACT_COST">
                        <option value=""></option>
                        <?php foreach ($dd2 as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['SUBCONTRACT_COST']) && $data['SUBCONTRACT_COST'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                </div>
                <div class="flex w-6/12">
                </div>
            </div>
            
            <!-- meth -->
            <!-- <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="hidden text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('METHPROCOST')?></label>
                    <select class="hidden text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="COST_METHOD" name="COST_METHOD">
                        <option value=""></option>
                        <?php foreach ($dd3 as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['COST_METHOD']) && $data['COST_METHOD'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                </div>
                <div class="flex w-6/12">
                </div>
            </div> -->
            <div class="grid grid-cols-3 divide-x-4 divide-teal-600 my-4"></div>

            <!-- update -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                </div>
                <div class="flex w-6/12">
                    <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
</body><script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">

    function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=lang('validation1'); ?>',
        //   background: '#8ca3a3',
          showCancelButton: false,
        //   confirmButtonColor: 'silver',
        //   cancelButtonColor: 'silver',
        confirmButtonText:  '<?=lang('yes'); ?>',
          cancelButtonText: '<?=lang('no'); ?>'
          }).then((result) => {
          if (result.isConfirmed) {
              if(type == 1) {
                  window.location.href="/DMCS_WEBAPP";          
              }
          }
      });
  }

    
</script>
</html>
