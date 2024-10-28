<?php
define('SESSION_NAME_SYSTEM', 'SYSTEM');
define('SESSION_NAME_DROPDOWN', 'DROPDOWN');

function get_sys_data($sys, $key='')
{
    if(empty($key)) {
        return $_SESSION[$sys] ?? '';
    } else {
        return $_SESSION[$sys][$key] ?? '';
    }
}

function set_sys_data($sys, $key, $val)
{
    $_SESSION[$sys][$key] = $val;
}

function check_sys_data($sys)
{
    if(!isset($_SESSION[$sys])) return false;
    
    return is_array($_SESSION[$sys]);
}

function check_table_sys_data($sys, $key)
{
    if(!isset($_SESSION[$sys][$key])) return false;
    
    return is_array($_SESSION[$sys][$key]);
}

function unset_sys_data($sys)
{
    unset($_SESSION[$sys]);
}

function unset_sys_key($sys, $key)
{
    unset($_SESSION[$sys][$key]);
}

function unset_sys_array($sys, $key, $index)
{
    unset($_SESSION[$sys][$key][$index]);
}

function get_int($obj)
{
    if(empty($obj)) return 0;
    return intval($obj);
}

function get_floor($obj)
{
    if(empty($obj)) return $obj;
    return floor($obj);
}

function get_floor_zero($obj)
{
    if(empty($obj)) return 0;
    return floor($obj);
}


function get_floor1($obj)
{
    if(empty($obj)) return $obj;
    return floor($obj*10)/10;
}

function get_floor2($obj)
{
    if(empty($obj)) return $obj;
    return floor($obj*100)/100;
}

function get_floor2_zero($obj)
{
    if(empty($obj)) return 0;
    return floor($obj*100)/100;
}

function get_time($obj)
{
    if(empty($obj)) return '00:00';
    return $obj;
}

function check_clickrow($selectrow, $row)
{
    if($selectrow ==='' || $row === '') return '';
    if($selectrow == $row) {
        return 'id="click-row"';
    } else {
        return '';
    }
}

function get_sys_lang($loadApp) {
    $res = array();
    foreach ($loadApp as $key => $value) {
        if($value['FTYPE'] != 'CTR') {
            if($value['FCODE'] == '' && $value['FTYPE'] == 'CD'.$_SESSION['LANG']) {
                $res[$value['FKEY']] = $value['FVALUE'];
            }
        }
    }
    return $res;
}

function get_sys_dropdown($loadApp) {
    $res = array();
    foreach ($loadApp as $key => $value) {
        if($value['FTYPE'] != 'CTR') {
            if ($value['FCODE'] != '' && $value['FTYPE'] == 'CD'.$_SESSION['LANG'])  {
                $res[$value['FKEY']][$value['FCODE']] = $value['FVALUE'];
            }
        }
    }
    return $res;
}

function fetch_data($data) {
    $res = array();
    foreach ($data as $key => $value) {
        $res = $value;
    }
    return $res;
}

function checkLang($namelang) {
    global $data;
    $res;
    if(array_key_exists($namelang, $data['TXTLANG'])) {
        $res = $data['TXTLANG'][$namelang];
    } else {
        $res = $namelang;
    }
    return $res;
}

function optionValue($array, $key) {
    $results = '';
    if (is_array($array)) {
        if (isset($array[$key])) {
            $results = $array[$key];
        }
    }
    return $results;
}
// foreach (excelColumnRange('A', 'ZZ') as $value) {
//     echo $value, PHP_EOL;
// }
function excelColumnRange($start, $end) {
    $column = array();
    ++$end;
    for ($col = $start; $col !== $end; ++$col) {
        // yield $col;
        array_push($column, $col);
    }
    return $column;
}

function getTextColour($hex) {
    list($red, $green, $blue) = sscanf($hex, '#%02x%02x%02x');
    $luma = ($red + $green + $blue) / 3;

    if($luma < 128) {
      $textcolour = 'light';
    } else {
      $textcolour = 'dark';
    }
    return $textcolour;
}

function getContrastColor($hexColor) {
    // hexColor RGB
    $R1 = hexdec(substr($hexColor, 1, 2));
    $G1 = hexdec(substr($hexColor, 3, 2));
    $B1 = hexdec(substr($hexColor, 5, 2));

    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec(substr($blackColor, 1, 2));
    $G2BlackColor = hexdec(substr($blackColor, 3, 2));
    $B2BlackColor = hexdec(substr($blackColor, 5, 2));

     // Calc contrast ratio
     $L1 = 0.2126 * pow($R1 / 255, 2.2) +
           0.7152 * pow($G1 / 255, 2.2) +
           0.0722 * pow($B1 / 255, 2.2);

    $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
          0.7152 * pow($G2BlackColor / 255, 2.2) +
          0.0722 * pow($B2BlackColor / 255, 2.2);

    $contrastRatio = 0;
    if ($L1 > $L2) {
        $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
    }

    // If contrast is more than 5, return black color
    if ($contrastRatio > 5) {
        return '#000000';
    } else { 
        // if not, return white color.
        return '#FFFFFF';
    }
}
// echo getTextColour('#FFFFFF');
// echo getContrastColor($_SESSION['MAINPAGEBGVALUE']);
function IsNullEmpty(string|null $str){
    return $str === null || trim($str) === '';
}
?>