//
const page = $('#page').val();

// action button
const BACK = $('#BACK');

// form
const form = document.getElementById('salePlanDetail');

BACK.click(function () {
    return window.close();
});

async function getDetailDT(x) {
    if($('#LBLDATECD'+x+'').val() == '') { return false; }
    $('#loading').show();
    entrySearch(); for (var c = 1; c <= 5; c++) { clearTable(c); }
    let data = new FormData(form);
    data.append('action', 'getDetailDT');
    data.append('LBLDATECD'+x, $('#LBLDATECD'+x+'').val());
    data.append('LBLDATEFLG'+x, $('#LBLDATEFLG'+x+'').val());
    data.append('NUM', x);
    await axios.post('../SALEPLANDETAIL/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data['getDetailDT'];
      var items = response.data['searchLnDetailDt'];
      // getDetailDT
      let saleplandthd = moment(value['SALEPLANDTHD'], 'YYYYMMDD');
      document.getElementById('DATEIDX').value = value['DATEIDX'];
      document.getElementById('SALEPLANDTHD').value = saleplandthd.format('YYYY-MM-DD');
      // searchLnDetailDt
      $.each(items, function(index, item) {
        // console.log(index);
        // console.log(item);
        // console.log(decimal2digit(item.SALETOTALPRC.replace(/\,/g,'')));
        document.getElementById('LINE_TD'+index+'').innerHTML = index;
        document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = item.CUSTOMERCD;
        document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = item.CUSTOMERNAME;
        document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = item.ENDUSERCD;
        document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = item.ENDUSERNAME;
        document.getElementById('MARKETCD_TD'+index+'').innerHTML = item.MARKETCD;
        document.getElementById('MARKETNAME_TD'+index+'').innerHTML = item.MARKETNAME;
        document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = item.SALEPLANPOS;
        document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = item.SALEPLANQTY;
        document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = decimal2digit(item.SALETOTALPRC.replace(/\,/g,''));
        document.getElementById('ROWNO'+index+'').value = index;
        document.getElementById('CUSTOMERCD'+index+'').value = item.CUSTOMERCD;
        document.getElementById('CUSTOMERNAME'+index+'').value = item.CUSTOMERNAME;
        document.getElementById('ENDUSERCD'+index+'').value = item.ENDUSERCD;
        document.getElementById('ENDUSERNAME'+index+'').value = item.ENDUSERNAME;
        document.getElementById('MARKETCD'+index+'').value = item.MARKETCD;
        document.getElementById('MARKETNAME'+index+'').value = item.MARKETNAME;
        document.getElementById('SALEPLANPOS'+index+'').value = item.SALEPLANPOS;
        document.getElementById('SALEPLANREQTYP'+index+'').value = item.SALEPLANREQTYP;
        document.getElementById('SALEPLANTODO1FLG'+index+'').value = item.SALEPLANTODO1FLG;
        document.getElementById('SALEPLANTODO2FLG'+index+'').value = item.SALEPLANTODO2FLG;
        document.getElementById('SALEPLANTODO3FLG'+index+'').value = item.SALEPLANTODO3FLG;
        document.getElementById('SALEPLANTODO4FLG'+index+'').value = item.SALEPLANTODO4FLG;
        document.getElementById('SALEPLANTODO5FLG'+index+'').value = item.SALEPLANTODO5FLG;
        document.getElementById('SALEPLANTODO6FLG'+index+'').value = item.SALEPLANTODO6FLG;
        document.getElementById('SALEPLANTODO7FLG'+index+'').value = item.SALEPLANTODO7FLG;
        document.getElementById('SALEPLANTODO8FLG'+index+'').value = item.SALEPLANTODO8FLG;
        document.getElementById('SALEPLANTODO9FLG'+index+'').value = item.SALEPLANTODO9FLG;
        document.getElementById('SALEPLANQTY'+index+'').value = item.SALEPLANQTY;
        document.getElementById('SALEPLANPRC'+index+'').value = decimal2digit(item.SALEPLANPRC.replace(/\,/g,''));
        document.getElementById('MEMO'+index+'').value = item.MEMO;
        document.getElementById('SALETOTALPRC'+index+'').value = decimal2digit(item.SALETOTALPRC.replace(/\,/g,''));
        document.getElementById('SYSVIS_MEMO'+index+'').value = item.SYSVIS_MEMO;
        document.getElementById('SYSVIS_LBLMEMO'+index+'').value = item.SYSVIS_LBLMEMO;
      });

      countCustomerRow();

      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function search() {
    $('#loading').show();
    let allown;
    let alw = document.getElementById('ALLOWN');
    if(alw.checked) { allown = 'T';  } else { allown = 'F'; }
    const data = new FormData(form);
    data.append('action', 'search');
    data.append('ALLOWN', allown);
    await axios.post('../SALEPLANDETAIL/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data['dateSetHD'];
      var item = response.data['search'];
       // console.log(value);
      for (var i = 1; i <= 42; i++) {
        // console.log(value['LBLDATE'+i+'']);
        // dateSetHD
        document.getElementById('LBLDATE'+i+'').style.color = value['SYSFC_LBLDATE'+i+''];
        document.getElementById('LBLDATE'+i+'').value = value['LBLDATE'+i+''];
        document.getElementById('LBLDATECD'+i+'').value = value['LBLDATECD'+i+''];
        document.getElementById('LBLDATEFLG'+i+'').value = value['LBLDATEFLG'+i+''];
        // data search
        document.getElementById('FIXQTY'+i+'').value = decimal(item['FIXQTY'+i+'']);
        document.getElementById('PLANQTY'+i+'').value = decimal2digit(item['PLANQTY'+i+'']);
        document.getElementById('PLANRATE'+i+'').value = decimal2digit(item['PLANRATE'+i+'']);
      }
      for (var m = 1; m <= 5; m++) {
        clearTable(m);
      }
      // dateSetHD
      for (var s = 1; s <= 4; s++) {
        document.getElementById('START'+s+'').value = value['START'+s+''];
      }
      document.getElementById('STARTDT').value = value['STARTDT'];
      document.getElementById('ENDDT').value = value['ENDDT'];
      document.getElementById('DATEIDX').value = value['DATEIDX'];
      if(value['SYSEN_ALLOWN'] == 'T') { document.getElementById('ALLOWN').checked = true; } else { document.getElementById('ALLOWN').checked = false; }
      // data search
      document.getElementById('TOTAL01').value = decimal2digit(item['TOTAL01']);
      document.getElementById('TOTAL02').value = decimal2digit(item['TOTAL02']);
      document.getElementById('TOTAL03').value = decimal2digit(item['TOTAL03']);
      for (var t = 1; t <= 3; t++) {
        document.getElementById('FIXQTYST'+t+'').value = decimal2digit(item['FIXQTYST'+t+'']);
        document.getElementById('PLANQTYST'+t+'').value = decimal2digit(item['PLANQTYST'+t+'']);
        document.getElementById('PLANRATEST'+t+'').value = decimal2digit(item['PLANRATEST'+t+'']);
      }
      // if(value['SYSEN_YEAR'] == 'F') { document.getElementById("YEARVALUE").readonly = true; } else { document.getElementById("YEARVALUE").readonly = false; }
      // if(value['SYSEN_MONTH'] == 'F') { document.getElementById("MONTHVALUE").readonly = true; } else { document.getElementById("MONTHVALUE").readonly = false; }
      entrySearch();
      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function ctrlMemoOnClick() {
    $('#loading').show();
    let data = new FormData();
    let SALEPLANTODO4FLG;
    let todo4flg = document.getElementById('SALEPLANTODO4FLG');
    if(todo4flg.checked) { SALEPLANTODO4FLG = 'T';  } else { SALEPLANTODO4FLG = 'F'; }
    data.append('action', 'ctrlMemoOnClick');
    data.append('SALEPLANTODO4FLG', SALEPLANTODO4FLG);
    data.append('MEMO', $('#MEMO').val());
    await axios.post('../SALEPLANDETAIL/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data;
      // console.log(value.SYSVIS_MEMO);
      if(value.SYSVIS_MEMO == 'T') {
        document.getElementById('MEMO').type = 'text';
      } else {
        document.getElementById('MEMO').type = 'hidden';
      }
      document.getElementById('MEMO').value = value.MEMO;
    // SYSVIS_MEMO
    // SYSVIS_LBLMEMO
    // MEMO
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

function selectRow(index) {
    // console.log(index);
    document.getElementById('ROWNO').value = index;
    document.getElementById('CUSTOMERCD').value = document.getElementById('CUSTOMERCD'+index+'').value;
    document.getElementById('CUSTOMERNAME').value = document.getElementById('CUSTOMERNAME'+index+'').value;
    document.getElementById('ENDUSERCD').value = document.getElementById('ENDUSERCD'+index+'').value;
    document.getElementById('ENDUSERNAME').value = document.getElementById('ENDUSERNAME'+index+'').value;
    document.getElementById('MARKETCD').value = document.getElementById('MARKETCD'+index+'').value;
    document.getElementById('MARKETNAME').value = document.getElementById('MARKETNAME'+index+'').value;
    document.getElementById('SALEPLANPOS').value = document.getElementById('SALEPLANPOS'+index+'').value;
    document.getElementById('SALEPLANREQTYP').value = document.getElementById('SALEPLANREQTYP'+index+'').value;
    document.getElementById('SALEPLANQTY').value = document.getElementById('SALEPLANQTY'+index+'').value;
    document.getElementById('SALEPLANPRC').value = document.getElementById('SALEPLANPRC'+index+'').value;
    document.getElementById('SALETOTALPRC').value = document.getElementById('SALETOTALPRC'+index+'').value;
    document.getElementById('SALEPLANTODO6FLG').value = document.getElementById('SALEPLANTODO6FLG'+index+'').value;
    document.getElementById('SALEPLANTODO7FLG').value = document.getElementById('SALEPLANTODO7FLG'+index+'').value;
    document.getElementById('SALEPLANTODO8FLG').value = document.getElementById('SALEPLANTODO8FLG'+index+'').value;
    document.getElementById('SALEPLANTODO9FLG').value = document.getElementById('SALEPLANTODO9FLG'+index+'').value;
    document.getElementById('SYSVIS_MEMO').value = document.getElementById('SYSVIS_MEMO'+index+'').value;
    document.getElementById('SYSVIS_LBLMEMO').value = document.getElementById('SYSVIS_LBLMEMO'+index+'').value;

    for(var c = 1; c <= 5; c++) {
      if(document.getElementById('SALEPLANTODO'+c+'FLG'+index+'').value == 'T') {
        document.getElementById('SALEPLANTODO'+c+'FLG').checked = true;
      } else {
        document.getElementById('SALEPLANTODO'+c+'FLG').checked = false;
      }
    }

    if(document.getElementById('SYSVIS_MEMO'+index+'').value == 'T') {
      document.getElementById('MEMO').type = 'text';
      document.getElementById('MEMO').value = document.getElementById('MEMO'+index+'').value;
    } else {
      document.getElementById('MEMO').type = 'hidden';
      document.getElementById('MEMO').value = '';
    }
}

function countCustomerRow() {
  let cusrow = document.getElementsByName('CUSTOMERCD_I[]'), count = 0;
  cusrow.forEach((cuscd) => { if(cuscd.value != '') { count = count + 1; } });
  document.getElementById('rowCount').innerHTML = count;
}

function entrySearch() {
  $('#ROWNO').val('');
  $('#CUSTOMERCD').val('');
  $('#CUSTOMERNAME').val('');
  $('#ENDUSERCD').val('');
  $('#ENDUSERNAME').val('');
  $('#MARKETCD').val('');
  $('#MARKETNAME').val('');
  $('#SALEPLANPOS').val('');
  $('#SALEPLANREQTYP').val('');
  $('#SALEPLANPRC').val('');
  $('#SALEPLANQTY').val('');
  $('#COMPRICETYPE').val('');
  $('#COMAMOUNTTYPE').val('');
  $('#SALETOTALPRC').val('');
  $('#MEMO').val('');

  document.getElementById('SALEPLANTODO1FLG').checked = false;
  document.getElementById('SALEPLANTODO2FLG').checked = false;
  document.getElementById('SALEPLANTODO3FLG').checked = false;
  document.getElementById('SALEPLANTODO4FLG').checked = false;
  document.getElementById('SALEPLANTODO5FLG').checked = false;
  document.getElementById('MEMO').type = 'hidden';

  let tb = document.getElementById('table_customer');
  let row = tb.getElementsByTagName('tr');
  $('.row-id').each(function (i) {
    row[i+1].classList.remove('selected-row');
  });
}

function clearTable(index) {

  document.getElementById('LINE_TD'+index+'').innerHTML = '';
  document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = '';
  document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = '';
  document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = '';
  document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = '';
  document.getElementById('MARKETCD_TD'+index+'').innerHTML = '';
  document.getElementById('MARKETNAME_TD'+index+'').innerHTML = '';
  document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = '';
  document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = '';
  document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = '';
  document.getElementById('ROWNO'+index+'').value = '';
  document.getElementById('CUSTOMERCD'+index+'').value = '';
  document.getElementById('CUSTOMERNAME'+index+'').value = '';
  document.getElementById('ENDUSERCD'+index+'').value = '';
  document.getElementById('ENDUSERNAME'+index+'').value = '';
  document.getElementById('MARKETCD'+index+'').value = '';
  document.getElementById('MARKETNAME'+index+'').value = '';
  document.getElementById('SALEPLANPOS'+index+'').value = '';
  document.getElementById('SALEPLANREQTYP'+index+'').value = '';
  document.getElementById('SALEPLANTODO1FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO2FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO3FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO4FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO5FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO6FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO7FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO8FLG'+index+'').value = '';
  document.getElementById('SALEPLANTODO9FLG'+index+'').value = '';
  document.getElementById('SALEPLANQTY'+index+'').value = '';
  document.getElementById('SALEPLANPRC'+index+'').value = '';
  document.getElementById('MEMO'+index+'').value = '';
  document.getElementById('SALETOTALPRC'+index+'').value = '';
  document.getElementById('SYSVIS_MEMO'+index+'').value = '';
  document.getElementById('SYSVIS_LBLMEMO'+index+'').value = '';
  document.getElementById('rowCount').innerHTML = 0;
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
  return num.replace(/[^0-9.,]/g, "").replace(/(\..*?)\..*/g, "$1");
}

function decimal(num) {
   if (isNaN(num) || num == '' || num == null) {
     return '';
   }
   return parseFloat(num).toFixed(0);
}

function decimal2digit(num) {
   if (isNaN(num) || num == '' || num == null) {
     return '';
   }
   return numberWithCommas(parseFloat(num).toFixed(2));
}

function percentMax(num) {
  if (Number(num.value) > 100) {
    num.value = 100
  }
}