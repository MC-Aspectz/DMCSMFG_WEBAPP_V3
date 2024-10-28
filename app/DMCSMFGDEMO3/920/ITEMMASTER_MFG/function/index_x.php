<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode('\\', dirname(__FILE__));  // for localhost
$arydirname = explode('/', dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}
 // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}  // if ($appname == '') {
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
// if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2).'/lang/en.php');
}
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$filetype = 'image';
$itemtype = 'itemmaster';
$pathApp = dirname(__FILE__, 6);
$syslogic = new Syslogic;
$javaFunc = new ItemMasterMFG;
$systemName = strtolower($appcode);
$minsearchrow = 0;
$maxsearchrow = 19;

// ----  GET --------//
if(!empty($_GET)) {
    // 
}
// -------------------------------------------------//
// ----  POST --------//
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'SEARCH') { search(); }
        if ($_POST['action'] == 'SEARCHITEMCATCD') { getSearchItemCategory(); }
        if ($_POST['action'] == 'SEARCHITEMSTORAGECD') { getSearchItemLocation(); }
        if ($_POST['action'] == 'ITEMCD') { getItem(); }
        if ($_POST['action'] == 'ITEMCLONE') { getClone(); }
        if ($_POST['action'] == 'CATALOGCD') { getCat(); }
        if ($_POST['action'] == 'SUPPLIERCD') { getSup(); }
        if ($_POST['action'] == 'STORAGECD') { getStg(); }
        if ($_POST['action'] == 'WCCD') { getWc(); }
        if ($_POST['action'] == 'MATERIALCD') { getMat(); }
        if ($_POST['action'] == 'SAVE') { save(); }
        if ($_POST['action'] == 'DELETE') { delete(); }
    }
} else {
    $data['SEARCHITEM'] = array();
}
// -------------------------------------------------//

// ------------------------- CALL Langauge AND Privilege -------------------//
 if(checkSessionData()) { $data = getSessionData(); }
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$load = $javaFunc->load();
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['CURRENCY'] = $load['CURRENCY'];
$data['CURRENCYDISP'] = $load['CURRENCYDISP'];
$data['WORKFLOW'] = $load['WORKFLOW'];
$data['BMVERSION'] = $load['BMVERSION'];
$data['AUTOWDPURCHASE'] = $load['AUTOWDPURCHASE'];
$data['COMPRICETYPE'] = $load['COMPRICETYPE'];
$data['COMAMOUNTTYPE'] = $load['COMAMOUNTTYPE'];
$data['L_INSPECT_PURCH'] = $load['L_INSPECT_PURCH'];
$data['PURCHASE_ORDER_NO'] = $load['PURCHASE_ORDER_NO'];
$ITEM_TYPE = $data['DRPLANG']['ITEM_TYPE'];
$BOI_TYPE = $data['DRPLANG']['BOI_TYPE'];
$WHTAXTYP = $data['DRPLANG']['WHTAXTYP'];
$UNIT = $data['DRPLANG']['UNIT'];
$ITEM_ORDER = $data['DRPLANG']['ITEM_ORDER'];
$INVCALC_TYPE = $data['DRPLANG']['INVCALC_TYPE'];
$PACKAGE_TYPE = $data['DRPLANG']['PACKAGE_TYPE'];
$MAKER = $data['DRPLANG']['MAKER'];
$COST_NAME = $data['DRPLANG']['COST_NAME'];
$CLEARANCE = $data['DRPLANG']['CLEARANCE'];
if(empty($data['ITEMCLEARANCETYP'])) { $data['ITEMCLEARANCETYP'] = 0; }
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($load);
// echo '</pre>';
// --------------------------------------------------------------------------//

function search() {
    $data['SEARCHITEM'] = array();
    $javafunc = new ItemMasterMFG;
    $data['SEARCHITEMCD1'] = isset($_POST['SEARCHITEMCD1']) ? $_POST['SEARCHITEMCD1']: '';
    $data['SEARCHITEMCD2'] = isset($_POST['SEARCHITEMCD2']) ? $_POST['SEARCHITEMCD2']: '';
    $data['SEARCHITEMNAME'] = isset($_POST['SEARCHITEMNAME']) ? $_POST['SEARCHITEMNAME']: '';
    $data['SEARCHITEMTYPE'] = isset($_POST['SEARCHITEMTYPE']) ? $_POST['SEARCHITEMTYPE']: '';
    $data['SEARCHITEMCATCD'] = isset($_POST['SEARCHITEMCATCD']) ? $_POST['SEARCHITEMCATCD']: '';
    $data['SEARCHITEMSTORAGECD'] = isset($_POST['SEARCHITEMSTORAGECD']) ? $_POST['SEARCHITEMSTORAGECD']: '';
    $search = $javafunc->search($data['SEARCHITEMCD1'], $data['SEARCHITEMCD2'], $data['SEARCHITEMNAME'],  $data['SEARCHITEMTYPE'],  $data['SEARCHITEMCATCD'], $data['SEARCHITEMSTORAGECD']);
    if(!empty($search)) {
        $data['SEARCHITEM'] = $search; 
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($data['SEARCHITEM']);
    // echo '</pre>';
}

function getSearchItemCategory() {
    $javafunc = new ItemMasterMFG;
    $SEARCHITEMCATCD = isset($_POST['SEARCHITEMCATCD']) ? $_POST['SEARCHITEMCATCD']: '';
    $query = $javafunc->getSearchItemCategory($SEARCHITEMCATCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getSearchItemLocation() {
    $javafunc = new ItemMasterMFG;
    $SEARCHITEMSTORAGECD = isset($_POST['SEARCHITEMSTORAGECD']) ? $_POST['SEARCHITEMSTORAGECD']: '';
    $query = $javafunc->getSearchItemLocation($SEARCHITEMSTORAGECD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getItem() {
    $javafunc = new ItemMasterMFG;
    $ITEMCD = isset($_POST['ITEMCD']) ? $_POST['ITEMCD']: '';
    $query = $javafunc->getItem($ITEMCD);
    echo json_encode($query);
}

function getClone() {
    $javafunc = new ItemMasterMFG;
    $ITEMCLONE = isset($_POST['ITEMCLONE']) ? $_POST['ITEMCLONE']: '';
    $query = $javafunc->getClone($ITEMCLONE);
    echo json_encode($query);
}

function getCat() {
    $javafunc = new ItemMasterMFG;
    $CATALOGCD = isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '';
    $query = $javafunc->getCat($CATALOGCD);
    echo json_encode($query);
}

function getSup() {
    $javafunc = new ItemMasterMFG;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSup($SUPPLIERCD);
    echo json_encode($query);
}

function getStg() {
    $javafunc = new ItemMasterMFG;
    $STORAGECD = isset($_POST['STORAGECD']) ? $_POST['STORAGECD']: '';
    $query = $javafunc->getStg($STORAGECD);
    echo json_encode($query);
}

function getWc() {
    $javafunc = new ItemMasterMFG;
    $WCCD = isset($_POST['WCCD']) ? $_POST['WCCD']: '';
    $query = $javafunc->getWc($WCCD);
    echo json_encode($query);
}

function getMat() {
    $javafunc = new ItemMasterMFG;
    $MATERIALCD = isset($_POST['MATERIALCD']) ? $_POST['MATERIALCD']: '';
    $query = $javafunc->getMat($MATERIALCD);
    echo json_encode($query);
}

function save() {
    $javafunc = new ItemMasterMFG;
    // --------------------------------------------------
    global $pathApp, $filetype, $itemtype;
    if($_FILES['ITEMIMGLOC']['error'] != 4) {
        $target_dir = $pathApp.'/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/';
        if(!file_exists($target_dir)) {
            $old = umask(0);
            $mk = mkdir($target_dir, 0755, true);
            umask($old);
            if (!$mk) { chmod($target_dir, 0755); }
        }
        $typefile = strtolower(pathinfo(basename($_FILES['ITEMIMGLOC']['name']), PATHINFO_EXTENSION));
        $filename = isset($_POST['ITEMCD']) ? $_POST['ITEMCD'].'.'.$typefile: basename($_FILES['ITEMIMGLOC']['name']);
        $target_file = $target_dir.$filename;
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['ITEMIMGLOC']['tmp_name']);
        if($check !== false) { move_uploaded_file($_FILES['ITEMIMGLOC']['tmp_name'], $target_file); }
        $ITEMIMGLOC = '/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/'.$filename;
    } else {
        $ITEMIMGLOC = isset($_POST['OLDITEMIMGLOC']) ? $_POST['OLDITEMIMGLOC']: '';
    }
    // --------------------------------------------------

    $param = array( 'ITEMCD' => $_POST['ITEMCD'],
                    'ITEMSEARCH' => isset($_POST['ITEMSEARCH']) ? $_POST['ITEMSEARCH']: '',
                    'ITEMNAME' => isset($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: '',
                    'ITEMSPEC' => isset($_POST['ITEMSPEC']) ? $_POST['ITEMSPEC']: '',
                    'ITEMDRAWNO' => isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    'ITEMDOC' => isset($_POST['ITEMDOC']) ? $_POST['ITEMDOC']: '',
                    'ITEMMAKERTYP' => isset($_POST['ITEMMAKERTYP']) ? $_POST['ITEMMAKERTYP']: '',
                    'MATERIALCD' => isset($_POST['MATERIALCD']) ? $_POST['MATERIALCD']: '',
                    'ITEMTYP' => isset($_POST['ITEMTYP']) ? $_POST['ITEMTYP']: '',
                    'ACCOUNTCD' => isset($_POST['ACCOUNTCD']) ? $_POST['ACCOUNTCD']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'ITEMUNITTYP' => isset($_POST['ITEMUNITTYP']) ? $_POST['ITEMUNITTYP']: '',
                    'ITEMLEADTIME' => isset($_POST['ITEMLEADTIME']) ? $_POST['ITEMLEADTIME']: '',
                    'ITEMORDRULETYP' => isset($_POST['ITEMORDRULETYP']) ? $_POST['ITEMORDRULETYP']: '',
                    'ITEMINSPTYP' => isset($_POST['ITEMINSPTYP']) ? $_POST['ITEMINSPTYP']: '0',
                    'ITEMTAXTYP' => isset($_POST['ITEMTAXTYP']) ? $_POST['ITEMTAXTYP']: '',
                    'ITEMTAXRATE' => isset($_POST['ITEMTAXRATE']) ? $_POST['ITEMTAXRATE']: '',
                    'ITEMPACKTYP' => isset($_POST['ITEMPACKTYP']) ? $_POST['ITEMPACKTYP']: '',
                    'ITEMQTYINCASE' => isset($_POST['ITEMQTYINCASE']) ? $_POST['ITEMQTYINCASE']: '',
                    'ITEMCOSTTYP' => isset($_POST['ITEMCOSTTYP']) ? $_POST['ITEMCOSTTYP']: '',
                    'ITEMPSSTIME' => isset($_POST['ITEMPSSTIME']) ? $_POST['ITEMPSSTIME']: '',
                    'ITEMWEIGHT' => isset($_POST['ITEMWEIGHT']) ? $_POST['ITEMWEIGHT']: '',
                    'STORAGECD' => isset($_POST['STORAGECD']) ? $_POST['STORAGECD']: '',
                    'WCCD' => isset($_POST['WCCD']) ? $_POST['WCCD']: '',
                    'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    'ITEMINVPRICE' => isset($_POST['ITEMINVPRICE']) ? str_replace(',', '', $_POST['ITEMINVPRICE']): '0.00',
                    'ITEMSHOPPRICE' => isset($_POST['ITEMSHOPPRICE']) ? str_replace(',', '', $_POST['ITEMSHOPPRICE']): '0.00',
                    'ITEMSTDSALEPRICE' => isset($_POST['ITEMSTDSALEPRICE']) ? str_replace(',', '', $_POST['ITEMSTDSALEPRICE']): '0.00',
                    'ITEMSTDPURPRICE' => isset($_POST['ITEMSTDPURPRICE']) ? str_replace(',', '', $_POST['ITEMSTDPURPRICE']): '0.00',
                    'ITEMSTDSUPPLYPRICE' => isset($_POST['ITEMSTDSUPPLYPRICE']) ? str_replace(',', '', $_POST['ITEMSTDSUPPLYPRICE']): '0.00',
                    'ITEMMARKETPRICE' => isset($_POST['ITEMMARKETPRICE']) ? str_replace(',', '', $_POST['ITEMMARKETPRICE']): '0.00',
                    'ITEMAGREEPRICEFLG' => isset($_POST['ITEMAGREEPRICEFLG']) ? $_POST['ITEMAGREEPRICEFLG']: 'F',
                    'ITEMUNITPRICETYP' => isset($_POST['ITEMUNITPRICETYP']) ? $_POST['ITEMUNITPRICETYP']: '',
                    'ITEMCLEARANCETYP' => isset($_POST['ITEMCLEARANCETYP']) ? $_POST['ITEMCLEARANCETYP']: '',
                    'ITEMABC' => isset($_POST['ITEMABC']) ? $_POST['ITEMABC']: '',
                    'ITEMFIFOLISTFLG' => isset($_POST['ITEMFIFOLISTFLG']) ? $_POST['ITEMFIFOLISTFLG']: 'F',
                    'ITEMMASTERPLANFLG' => isset($_POST['ITEMMASTERPLANFLG']) ? $_POST['ITEMMASTERPLANFLG']: 'F',
                    'ITEMSERIALLFLG' => isset($_POST['ITEMSERIALLFLG']) ? $_POST['ITEMSERIALLFLG']: 'F',
                    'ITEMINVFLG' => isset($_POST['ITEMINVFLG']) ? $_POST['ITEMINVFLG']: 'F',
                    'ITEMPHANTOMFLG' => isset($_POST['ITEMPHANTOMFLG']) ? $_POST['ITEMPHANTOMFLG']: 'F',
                    'ITEMBULKFLG' => isset($_POST['ITEMBULKFLG']) ? $_POST['ITEMBULKFLG']: 'F',
                    'ITEMSPECIALFLG' => isset($_POST['ITEMSPECIALFLG']) ? $_POST['ITEMSPECIALFLG']: 'F',
                    'ITEMPURGRPTYP' => isset($_POST['ITEMPURGRPTYP']) ? $_POST['ITEMPURGRPTYP']: '',
                    'ITEMSTOPDT' => isset($_POST['ITEMSTOPDT']) ? str_replace('-', '', $_POST['ITEMSTOPDT']) : '',
                    'ITEMALTERFLG' => isset($_POST['ITEMALTERFLG']) ? $_POST['ITEMALTERFLG']: 'F',
                    'ITEMPAINTIN' => isset($_POST['ITEMPAINTIN']) ? str_replace(',', '', $_POST['ITEMPAINTIN']): '0.00',
                    'ITEMPAINTOUT' => isset($_POST['ITEMPAINTOUT']) ? str_replace(',', '', $_POST['ITEMPAINTOUT']): '0.00',
                    'ITEMMAXSTOCK' => isset($_POST['ITEMMAXSTOCK']) ? str_replace(',', '', $_POST['ITEMMAXSTOCK']): '0.00',
                    'ITEMMINSTOCK' => isset($_POST['ITEMMINSTOCK']) ? str_replace(',', '', $_POST['ITEMMINSTOCK']): '0.00',
                    'ITEMORDERUNIT' => isset($_POST['ITEMORDERUNIT']) ? str_replace(',', '', $_POST['ITEMORDERUNIT']): '0.00',
                    'ITEMFIXORDER' => isset($_POST['ITEMFIXORDER']) ? str_replace(',', '', $_POST['ITEMFIXORDER']): '0.00',
                    'ITEMMINORDER' => isset($_POST['ITEMMINORDER']) ? str_replace(',', '', $_POST['ITEMMINORDER']): '0.00',
                    'ITEMBADRATE' => isset($_POST['ITEMBADRATE']) ? str_replace(',', '', $_POST['ITEMBADRATE']): '0.00',
                    'ITEMSALEDT' => isset($_POST['ITEMSALEDT']) ? str_replace('-', '', $_POST['ITEMSALEDT']) : '',
                    'ITEMPURADDDAY' => isset($_POST['ITEMPURADDDAY']) ? $_POST['ITEMPURADDDAY']: '0',
                    'ITEMINSPADDDAY' => isset($_POST['ITEMINSPADDDAY']) ? $_POST['ITEMINSPADDDAY']: '',
                    'AUTOINSPCD' => isset($_POST['AUTOINSPCD']) ? $_POST['AUTOINSPCD']: '',
                    'ITEMCOSTMETHODFLG' => isset($_POST['ITEMCOSTMETHODFLG']) ? $_POST['ITEMCOSTMETHODFLG']: 'F',
                    'ITEMADDNOTE1FLG' => isset($_POST['ITEMADDNOTE1FLG']) ? $_POST['ITEMADDNOTE1FLG']: '',
                    'ITEMADDNOTE2FLG' => isset($_POST['ITEMADDNOTE2FLG']) ? $_POST['ITEMADDNOTE2FLG']: '',
                    'ITEMADDNOTE3FLG' => isset($_POST['ITEMADDNOTE3FLG']) ? $_POST['ITEMADDNOTE3FLG']: '',
                    'ITEMADDNOTE4FLG' => isset($_POST['ITEMADDNOTE4FLG']) ? $_POST['ITEMADDNOTE4FLG']: '',
                    'ITEMADDTANABAN' => isset($_POST['ITEMADDTANABAN']) ? $_POST['ITEMADDTANABAN']: '',
                    'ITEMIMGLOC' => $ITEMIMGLOC,
                    'ITEMCATEGORY' => isset($_POST['ITEMCATEGORY']) ? $_POST['ITEMCATEGORY']: '',
                    'ITEMSUBCATEGORY' => isset($_POST['ITEMSUBCATEGORY']) ? $_POST['ITEMSUBCATEGORY']: '',
                    'ITEMEDIFLG' => isset($_POST['ITEMEDIFLG']) ? $_POST['ITEMEDIFLG']: '',
                    'CATALOGCD' => isset($_POST['CATALOGCD']) ? $_POST['CATALOGCD']: '',
                    'ITEMMULTIPURCHASETYP' => isset($_POST['ITEMMULTIPURCHASETYP']) ? $_POST['ITEMMULTIPURCHASETYP']: '',
                    'ITEMTAXCLASSCD' => isset($_POST['ITEMTAXCLASSCD']) ? $_POST['ITEMTAXCLASSCD']: 'J01',
                    'ITEMRLTYP' => isset($_POST['ITEMRLTYP']) ? $_POST['ITEMRLTYP']: '',
                    'ITEMTAGCD1' => isset($_POST['ITEMTAGCD1']) ? $_POST['ITEMTAGCD1']: '',
                    'ITEMTAGCD2' => isset($_POST['ITEMTAGCD2']) ? $_POST['ITEMTAGCD2']: '',
                    'ITEMTAGCD3' => isset($_POST['ITEMTAGCD3']) ? $_POST['ITEMTAGCD3']: '',
                    'ITEMINSPECTMCCD' => isset($_POST['ITEMINSPECTMCCD']) ? $_POST['ITEMINSPECTMCCD']: '',
                    'ITEMLOCATEBODY' => isset($_POST['ITEMLOCATEBODY']) ? $_POST['ITEMLOCATEBODY']: '',
                    'ITEMCARTYP' => isset($_POST['ITEMCARTYP']) ? $_POST['ITEMCARTYP']: '',
                    'ITEMSPEC1' => isset($_POST['ITEMSPEC1']) ? $_POST['ITEMSPEC1']: '',
                    'ITEMSPEC2' => isset($_POST['ITEMSPEC2']) ? $_POST['ITEMSPEC2']: '',
                    'ITEMSPEC3' => isset($_POST['ITEMSPEC3']) ? $_POST['ITEMSPEC3']: '',
                    'ITEMSPEC4' => isset($_POST['ITEMSPEC4']) ? $_POST['ITEMSPEC4']: '',
                    'ITEMSPEC5' => isset($_POST['ITEMSPEC5']) ? $_POST['ITEMSPEC5']: '',
                    'ITEMSPEC6' => isset($_POST['ITEMSPEC6']) ? $_POST['ITEMSPEC6']: '',
                    'ITEMCASEFLG' => isset($_POST['ITEMCASEFLG']) ? $_POST['ITEMCASEFLG']: 'F',
                    'CUSTOMERCD' => isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '',
                    'ITEMBOI' => isset($_POST['ITEMBOI']) ? $_POST['ITEMBOI']: '',
                    'ITEMPOUNITTYP' => isset($_POST['ITEMPOUNITTYP']) ? $_POST['ITEMPOUNITTYP']: '',
                    'ITEMINVCALCTYP' => isset($_POST['ITEMINVCALCTYP']) ? $_POST['ITEMINVCALCTYP']: '',
                    'ITEMWHTTYP' => isset($_POST['ITEMWHTTYP']) ? $_POST['ITEMWHTTYP']: '',
                    // 'ITEMPOUNITRATE' => isset($_POST['ITEMPOUNITRATE']) ? $_POST['ITEMPOUNITRATE']:'0',
                    'ITEMCOLORCD' => isset($_POST['ITEMCOLORCD']) ? $_POST['ITEMCOLORCD']: '');
    // print_r($param); exit();
    $save = $javafunc->save($param);
    echo json_encode($save);
}

function delete() {
    $delfunc = new ItemMasterMFG;
    $delete = $delfunc->delete($_POST['ITEMCD']);
    echo json_encode($delete);
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'DRPLANG', 'TXTLANG', 'SEARCHITEM', 'SEARCHITEMCD1', 'SEARCHITEMCD2', 'SEARCHITEMNAME', 'SEARCHITEMTYPE', 'SEARCHITEMCATCD', 'SEARCHITEMSTORAGECD',
                        'CURRENCYDISP', 'COMPRICETYPE', 'COMAMOUNTTYPE', 'CURRENCY', 'PURCHASE_ORDER_NO', 'L_INSPECT_PURCH', 'WORKFLOW', 'AUTOWDPURCHASE', 'BMVERSION');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getDropdownData($key = '') {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

?>