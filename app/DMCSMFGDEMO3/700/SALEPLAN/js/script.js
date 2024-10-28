// search
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHENDUSER = $('#SEARCHENDUSER');
const SEARCHMARKET = $('#SEARCHMARKET');
const VIEWSALE = $('#VIEWSALE');

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});
SEARCHENDUSER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHENDUSER/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});
SEARCHMARKET.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHMARKET/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});
// VIEWSALE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEPLANVW/index.php?page=SALEPLAN', 'authWindow', 'width=1200,height=600');});

//input serach
const STAFFCD = $('#STAFFCD');
const ITEMCD = $('#ITEMCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const ENDUSERCD = $('#ENDUSERCD');
const MARKETCD = $('#MARKETCD');
const SALEPLANQTY = $('#SALEPLANQTY');
const SALEPLANPRC = $('#SALEPLANPRC');

// action button
const SEARCH = $('#SEARCH');
const COMMIT = $('#COMMIT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');
const OK = $('#OK');
const CSV = $('#CSV');

const input_serach = [STAFFCD, ITEMCD, CUSTOMERCD, ENDUSERCD, MARKETCD];
const serachIcon = [SEARCHSTAFF, SEARCHITEM];

// form
const form = document.getElementById('salePlan');

for (const input of input_serach) {
    input.change(async function () {
        $('#loading').show();
        await keepData();
    });

    input.keyup(async function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
          $('#loading').show();
          await keepData();
        }
    });
}

for (const serach of serachIcon) {
    serach.click(async function () {
      await keepData();
    });
}

COMMIT.click(async function () {
  return await commitLn();
});

UPDATE.click(function () {
  return update();
});

DELETE.click(function () {
  return del();
});

OK.click(function () {
  if(CUSTOMERCD.val() == '') {
    return false;
  }
  return insert();
});

CSV.click(function() {
    return exportCSV();
});

VIEWSALE.click(function () {
    var form = document.getElementById('salePlan');
    form.setAttribute('method', 'post');
    form.setAttribute('action', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEPLANVW/index.php?page=SALEPLAN');
    form.setAttribute('target', 'authWindow');
    window.open('', 'authWindow', 'width=1200,height=680');
    form.submit();
});

STAFFCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getSearch('STAFFCD', STAFFCD.val());
    }
});

ITEMCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getSearch('ITEMCD', ITEMCD.val());
    }
});

CUSTOMERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

ENDUSERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getElement('ENDUSERCD', ENDUSERCD.val());
    }
});

MARKETCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getElement('MARKETCD', MARKETCD.val());
    }
});

SALEPLANQTY.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getAmt();
    }
});

SALEPLANPRC.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return calculateTotal();
    }
});

SEARCH.click(async function () {
  if (!form.reportValidity()) {
    alertValidation();
    return false;
  }
  await search();
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/700/SALEPLAN/index.php?'+code+'=' + value;        
}

async function exportCSV() {
    // Variable to store the csv data
    let ITEMCODE = document.getElementById('ITEMCODE').innerText || document.getElementById('ITEMCODE').textContent;
    let DAY = document.getElementById('DAY').innerText || document.getElementById('DAY').textContent;
    let INPUT_DATE = document.getElementById('INPUT_DATE').innerText || document.getElementById('INPUT_DATE').textContent;
    let ST_YYMM = document.getElementById('ST_YYMM').innerText || document.getElementById('ST_YYMM').textContent;
    let ALL = document.getElementById('ALL').innerText || document.getElementById('ALL').textContent;
    let PERSON_RESPONSE = document.getElementById('PERSON_RESPONSE').innerText || document.getElementById('PERSON_RESPONSE').textContent;
    let DIVISIONCODE = document.getElementById('DIVISIONCODE').innerText || document.getElementById('DIVISIONCODE').textContent;
    let SALEREP_CODE = document.getElementById('SALEREP_CODE').innerText || document.getElementById('SALEREP_CODE').textContent;
    let ST_DATE = document.getElementById('ST_DATE').innerText || document.getElementById('ST_DATE').textContent;
    let CUSTOMERCODE = document.getElementById('CUSTOMERCODE').innerText || document.getElementById('CUSTOMERCODE').textContent;
    let END_USER = document.getElementById('END_USER').innerText || document.getElementById('END_USER').textContent;
    let MARKET_CODE = document.getElementById('MARKET_CODE').innerText || document.getElementById('MARKET_CODE').textContent;
    let PROBABILITY = document.getElementById('PROBABILITY').innerText || document.getElementById('PROBABILITY').textContent;
    let PERCENT = document.getElementById('PERCENT').innerText || document.getElementById('PERCENT').textContent;
    let PURCHASE_ALLOW = document.getElementById('PURCHASE_ALLOW').innerText || document.getElementById('PURCHASE_ALLOW').textContent;
    let QUANTITY = document.getElementById('QUANTITY').innerText || document.getElementById('QUANTITY').textContent;
    let SALES_PRICE = document.getElementById('SALES_PRICE').innerText || document.getElementById('SALES_PRICE').textContent;
    let SALES_AMOUNT = document.getElementById('SALES_AMOUNT').innerText || document.getElementById('SALES_AMOUNT').textContent;
    let TODOLIST01 = document.getElementById('TODOLIST01').innerText || document.getElementById('TODOLIST01').textContent;
    let TODOLIST02 = document.getElementById('TODOLIST02').innerText || document.getElementById('TODOLIST02').textContent;
    let TODOLIST03 = document.getElementById('TODOLIST03').innerText || document.getElementById('TODOLIST03').textContent;
    let TODOLIST04 = document.getElementById('TODOLIST04').innerText || document.getElementById('TODOLIST04').textContent;
    let TODOLIST05 = document.getElementById('TODOLIST05').innerText || document.getElementById('TODOLIST05').textContent;
    let ENTRYDT = '--/--/----';
    let SALEPLANDTHD = '--/--/----';
    if($('#ENTRYDT').val() != '') { ENTRYDT = $('#ENTRYDT').val(); }
    if($('#SALEPLANDTHD').val() != '') { SALEPLANDTHD = $('#SALEPLANDTHD').val(); }
    let YEARVALUE = document.getElementById('YEARVALUE').options[document.getElementById('YEARVALUE').selectedIndex].text;
    let MONTHVALUE = document.getElementById('MONTHVALUE').options[document.getElementById('MONTHVALUE').selectedIndex].text;
    let SALEPLANREQTYP = document.getElementById('SALEPLANREQTYP').options[document.getElementById('SALEPLANREQTYP').selectedIndex].text;
    let ALLOWN; let allow = document.getElementById('ALLOWN');
    if(allow.checked) { ALLOWN = 'T';  } else { ALLOWN = 'F'; }
    let SALEPLANTODO1FLG; let todo1 = document.getElementById('SALEPLANTODO1FLG');
    if(todo1.checked) { SALEPLANTODO1FLG = 'T';  } else { SALEPLANTODO1FLG = 'F'; }
    let SALEPLANTODO2FLG; let todo2 = document.getElementById('SALEPLANTODO2FLG');
    if(todo2.checked) { SALEPLANTODO2FLG = 'T';  } else { SALEPLANTODO2FLG = 'F'; }
    let SALEPLANTODO3FLG; let todo3 = document.getElementById('SALEPLANTODO3FLG');
    if(todo3.checked) { SALEPLANTODO3FLG = 'T';  } else { SALEPLANTODO3FLG = 'F'; }
    let SALEPLANTODO4FLG; let todo4 = document.getElementById('SALEPLANTODO4FLG');
    if(todo4.checked) { SALEPLANTODO4FLG = 'T';  } else { SALEPLANTODO4FLG = 'F'; }
    let SALEPLANTODO5FLG; let todo5 = document.getElementById('SALEPLANTODO5FLG');
    if(todo5.checked) { SALEPLANTODO5FLG = 'T';  } else { SALEPLANTODO5FLG = 'F'; }
    // -------------------------- Header -----------------------------------------//
    var csv_data = [ITEMCODE + ',' + $('#ITEMCD').val() + ',' + $('#ITEMNAME').val() + ',' + $('#ITEMLEADTIME').val() + ',' + DAY + ',' + INPUT_DATE + ',' + ENTRYDT + ',' + ST_YYMM + ',' + YEARVALUE + ',' + MONTHVALUE + ',' + ALLOWN + ',' + ALL];
        csv_data.push(PERSON_RESPONSE + ',' + $('#STAFFCD').val() + ',' + $('#STAFFNAME').val() + ',' + DIVISIONCODE + ',' + $('#DIVISIONCD').val() + ',' + $('#DIVISIONNAME').val() + ',' + SALEREP_CODE + ',' + $('#SALEDIVCD').val() + ',' + $('#SALEDIVNAME').val());
    // -------------------------- Table Mounth -----------------------------------------//
    var th_mounth = document.getElementById('mounth_table').querySelectorAll('th');
    var csvrow = [];
    for (var j = 0; j < th_mounth.length; j++) {
      csvrow.push(th_mounth[j].innerText);
    }
    csv_data.push(csvrow.join(','));
    // Get each row data
    var rows_mounth = document.getElementById('mounth_table').querySelectorAll('table tr');
    // console.log(rows_mounth.length);
    for (var i = 1; i < rows_mounth.length; i++) {
      // Get each column data
      var cols_mounth = rows_mounth[i].querySelectorAll('td');        
      // Stores each csv row datad
      var csvrow = [];
      [...cols_mounth].forEach((colm) => {
        if (colm.children.length > 0) { //assuming your structure is always the same and the table only contains inputs as child elements inside a td
          csvrow.push(colm.firstChild.value);
        } else {
          // csvrow.push(colm.innerText);
          csvrow.push("\""+colm.innerText+"\"");
        }
      });
      // console.log(csvrow);
      // Combine each column value with comma
      csv_data.push(csvrow.join(','));
    }
    // -------------------------- Table Total Mounth -----------------------------------------//
    var th_total = document.getElementById('total_table').querySelectorAll('th');
    var csvrow = [];
    for (var j = 0; j < th_total.length; j++) {
      csvrow.push(th_total[j].innerText);
    }
    csv_data.push(csvrow.join(','));

    var rows_total = document.getElementById('total_table').querySelectorAll('table tr');
    // console.log(rows_total.length);
    for (var i = 1; i < rows_total.length; i++) {
        // Get each column data
        var cols_total = rows_total[i].querySelectorAll('td');
        // Stores each csv row datad
        var csvrow = [];
        [...cols_total].forEach((colt) => {
          // console.log(colt);
          if (colt.children.length > 0) {
            csvrow.push(colt.firstChild.value);
          } else {
            csvrow.push("\""+colt.innerText+"\"");
          }
        });
        // console.log(csvrow);
        csv_data.push(csvrow.join(','));
    }

    // -------------------------- Table Plan Mounth -----------------------------------------//
    var th_plan = document.getElementById('plan_table').querySelectorAll('th');
    var csvrow = [];
    for (var j = 0; j < th_plan.length; j++) {
      if (th_plan[j].children.length > 0) {
        csvrow.push(',' + th_plan[j].firstChild.value + ',');
      } else {
        csvrow.push(th_plan[j].innerText);
      }
    }
    csv_data.push(csvrow.join(','));
    
    var rows_plan = document.getElementById('plan_table').querySelectorAll('table tr');
    // console.log(rows_plan.length);
    for (var i = 1; i < rows_plan.length; i++) {
        // Get each column data
        var cols_plan = rows_plan[i].querySelectorAll('td');
        // Stores each csv row datad
        var csvrow = [];
        [...cols_plan].forEach((colp) => {
          if (colp.children.length > 0) {
            // console.log(colp.firstChild.value);
            if(colp.firstChild.value == undefined || colp.firstChild.value == 'undefined') {
              csvrow.push(',');
            } else {
              csvrow.push("\""+colp.firstChild.value+"\"");
            }
        
          } else {
            csvrow.push("\""+colp.innerText+"\"");
          }
        });
        // console.log(csvrow);
        csv_data.push(csvrow.join(','));
    }
    // -----------------------------------------------------------------------------------//
    csv_data.push(ST_DATE + ',' + $('#SALEPLANDTHD').val());
    // -------------------------- Table Customer -----------------------------------------//
    var th = document.getElementById('table_customer').querySelectorAll('th');
    var csvrow = [];
    for (var j = 0; j < th.length; j++) {
      csvrow.push(th[j].innerText);
    }
    csv_data.push(csvrow.join(","));

    var rows = document.getElementById('table_customer').querySelectorAll('table tr');
    // console.log(rows.length);
    for (var i = 1; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td');
        // Stores each csv row datad
        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            csvrow.push("\""+el.innerText+"\"");
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(','));
    }

    // -----------------------------------------------------------------------------------//
    csv_data.push(CUSTOMERCODE + ',' + $('#CUSTOMERCD').val() + ',' + $('#CUSTOMERNAME').val());
    csv_data.push(END_USER + ',' + $('#ENDUSERCD').val() + ',' + $('#ENDUSERNAME').val());
    csv_data.push(MARKET_CODE + ',' + $('#MARKETCD').val() + ',' + $('#MARKETNAME').val());
    csv_data.push(PROBABILITY + ',' + $('#SALEPLANPOS').val() + ',' + PERCENT + ',' + PURCHASE_ALLOW + ',' + $('#SALEPLANREQTYP').val());
    csv_data.push(QUANTITY + ',' + $('#SALEPLANQTY').val() + ',' + SALES_PRICE + ',' + $('#SALEPLANPRC').val() + ',' + $('#CURRENCYDISP').val());
    csv_data.push($('#MEMO').val() + ',' + ',' + SALES_AMOUNT + ',' + $('#SALETOTALPRC').val() + ',' + $('#CURRENCYDISP').val());
    csv_data.push(TODOLIST01 + ',' + SALEPLANTODO1FLG + ',' + TODOLIST02 + ',' + SALEPLANTODO2FLG + ',' + TODOLIST03 + ',' + SALEPLANTODO3FLG + ',' + TODOLIST04 + ',' + SALEPLANTODO4FLG + ',' + TODOLIST05 + ',' + SALEPLANTODO5FLG);

    // Combine each row data with new line character
    csv_data = csv_data.join('\r\n');
    // -----------------------------------------------------------------------------------//
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
    CSVFile = new Blob(["\uFEFF" + csv_data], { type: "text/csv;charset=utf-8;", });
    // console.log(CSVFile);
    const supportsFileSystemAccess =
    "showSaveFilePicker" in window &&
    (() => { try {
                return window.self === window.top;
            } catch {
                return false;
            }
    });
    // If the File System Access API is supported…
    if (supportsFileSystemAccess) {
      try {
          // Show the file save dialog.
          const handle = await showSaveFilePicker({
              types: [
                  {
                      description: "CSV file",
                      accept: { "application/csv": [".csv"] },
                  },
              ],
          });
        // Write the CSVFile to the file.
        const writable = await handle.createWritable();
        await writable.write(CSVFile);
        await writable.close();
        return;
      } catch (err) {
          // Fail silently if the user has simply canceled the dialog.
        if (err.name !== "AbortError") {
          // console.error(err.name, err.message);
          return;
        }
      }
    }
    // Fallback if the File System Access API is not supported…
    // Create the CSVFile URL.
    const url = URL.createObjectURL(CSVFile);
    // Create the `<a download>` element and append it invisibly.
    const temp_link = document.createElement("a");
    temp_link.href = url;
    temp_link.download = suggestedName;
    temp_link.style.display = "none";
    document.body.append(temp_link);
    // Programmatically click the element.
    temp_link.click();
    // Revoke the CSVFile URL and remove the element.
    setTimeout(() => {
        URL.revokeObjectURL(url);
        temp_link.remove();
    }, 1000);
}

async function getDetailDT(x) {
    if($('#LBLDATECD'+x+'').val() == '') { return false; }
    $('#loading').show();
    entrySearch(); for (var c = 1; c <= 5; c++) { clearTable(c); }
    let data = new FormData(form);
    data.append('action', 'getDetailDT');
    data.append('LBLDATECD'+x, $('#LBLDATECD'+x+'').val());
    data.append('LBLDATEFLG'+x, $('#LBLDATEFLG'+x+'').val());
    data.append('NUM', x);
    await axios.post('../SALEPLAN/function/index_x.php', data)
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
        // console.log(dec2digit(item.SALETOTALPRC.replace(/\,/g,'')));
        document.getElementById('LINE_TD'+index+'').innerHTML = index;
        document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = item.CUSTOMERCD;
        document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = item.CUSTOMERNAME;
        document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = item.ENDUSERCD;
        document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = item.ENDUSERNAME;
        document.getElementById('MARKETCD_TD'+index+'').innerHTML = item.MARKETCD;
        document.getElementById('MARKETNAME_TD'+index+'').innerHTML = item.MARKETNAME;
        document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = item.SALEPLANPOS;
        document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = item.SALEPLANQTY;
        document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = dec2digit(item.SALETOTALPRC.replace(/\,/g,''));
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
        document.getElementById('SALEPLANPRC'+index+'').value = dec2digit(item.SALEPLANPRC.replace(/\,/g,''));
        document.getElementById('MEMO'+index+'').value = item.MEMO;
        document.getElementById('SALETOTALPRC'+index+'').value = dec2digit(item.SALETOTALPRC.replace(/\,/g,''));
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
    await axios.post('../SALEPLAN/function/index_x.php', data)
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
        document.getElementById('FIXQTY'+i+'').value = decimalnum(item['FIXQTY'+i+'']);
        document.getElementById('PLANQTY'+i+'').value = dec2digit(item['PLANQTY'+i+'']);
        document.getElementById('PLANRATE'+i+'').value = dec2digit(item['PLANRATE'+i+'']);
      }
      for (var td = 1; td <= 5; td++) {
        // dateSetHD
        document.getElementById('MONTHCODE'+td+'').style.color = value['SYSFC_MONTHCODE'+td+''];
        document.getElementById('MONTHCODE'+td+'').value = value['MONTHCODE'+td+''];
        document.getElementById('MONTHD'+td+'').value = value['MONTHD'+td+''];
        document.getElementById('SUM'+td+'').value = dec2digit(item['SUM'+td+'']);
        document.getElementById('MONTH_DETAIL'+td+'').disabled = false;
        // data search
        for (var tr = 1; tr <= 3; tr++) {
          document.getElementById('FIXQTY'+td+'ST'+tr+'').value = decimalnum(item['FIXQTY'+td+'ST'+tr+'']);
          document.getElementById('PLANQTY'+td+'ST'+tr+'').value = dec2digit(item['PLANQTY'+td+'ST'+tr+'']);
          document.getElementById('PLANRATE'+td+'ST'+tr+'').value = dec2digit(item['PLANRATE'+td+'ST'+tr+'']);
        }
        clearTable(td);
      }
      // dateSetHD
      for (var s = 1; s <= 4; s++) {
        document.getElementById('START'+s+'').value = value['START'+s+''];
      }
      document.getElementById('MONTHCODE0').value = value['MONTHCODE0'];
      document.getElementById('STARTDT').value = value['STARTDT'];
      document.getElementById('ENDDT').value = value['ENDDT'];
      document.getElementById('DATEIDX').value = value['DATEIDX'];
      if(value['SYSEN_ALLOWN'] == 'T') { document.getElementById('ALLOWN').checked = true; } else { document.getElementById('ALLOWN').checked = false; }
      // data search
      document.getElementById('TOTAL01').value = dec2digit(item['TOTAL01']);
      document.getElementById('TOTAL02').value = dec2digit(item['TOTAL02']);
      document.getElementById('TOTAL03').value = dec2digit(item['TOTAL03']);
      for (var t = 1; t <= 3; t++) {
        document.getElementById('FIXQTYST'+t+'').value = dec2digit(item['FIXQTYST'+t+'']);
        document.getElementById('PLANQTYST'+t+'').value = dec2digit(item['PLANQTYST'+t+'']);
        document.getElementById('PLANRATEST'+t+'').value = dec2digit(item['PLANRATEST'+t+'']);
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

async function getElement(code, value) {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'getSearch');
    data.append(code, value);
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      let result = response.data;
      if(objectArray(result)) {
        $.each(result, function(key, value) {
          if(document.getElementById(''+key+'')) {
            document.getElementById(''+key+'').value = value;
          }
        });
      } 
      document.activeElement.blur();
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}


async function ctrlAllOwn() {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'ctrlAllOwn');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function getAmt() {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'getAmt');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      document.getElementById('SALEPLANPRC').value = response.data['SALEPLANPRC'];
      document.getElementById('SALETOTALPRC').value = response.data['SALEPLANPRC'];
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function commitLn() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'commitLn');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var item = response.data['searchAfterCommit'];
      var items = response.data['searchLnDetailDt'];
      for (var i = 1; i <= 42; i++) {
        document.getElementById('FIXQTY'+i+'').value = decimalnum(item['FIXQTY'+i+'']);
        document.getElementById('PLANQTY'+i+'').value = dec2digit(item['PLANQTY'+i+'']);
        document.getElementById('PLANRATE'+i+'').value = dec2digit(item['PLANRATE'+i+'']);
      }
      document.getElementById('TOTAL01').value = dec2digit(item['TOTAL01']);
      document.getElementById('TOTAL02').value = dec2digit(item['TOTAL02']);
      document.getElementById('TOTAL03').value = dec2digit(item['TOTAL03']);

      for (var td = 1; td <= 5; td++) {
        document.getElementById('SUM'+td+'').value = dec2digit(item['SUM'+td+'']);
        for (var tr = 1; tr <= 3; tr++) {
          document.getElementById('FIXQTY'+td+'ST'+tr+'').value = decimalnum(item['FIXQTY'+td+'ST'+tr+'']);
          document.getElementById('PLANQTY'+td+'ST'+tr+'').value = dec2digit(item['PLANQTY'+td+'ST'+tr+'']);
          document.getElementById('PLANRATE'+td+'ST'+tr+'').value = dec2digit(item['PLANRATE'+td+'ST'+tr+'']);
        }
      }

      for (var t = 1; t <= 3; t++) {
        document.getElementById('FIXQTYST'+t+'').value = dec2digit(item['FIXQTYST'+t+'']);
        document.getElementById('PLANQTYST'+t+'').value = dec2digit(item['PLANQTYST'+t+'']);
        document.getElementById('PLANRATEST'+t+'').value = dec2digit(item['PLANRATEST'+t+'']);
      }

      $.each(items, function(index, value) {
        // console.log(index);
        // console.log(value);
        document.getElementById('LINE_TD'+index+'').innerHTML = index;
        document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = value.CUSTOMERCD;
        document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = value.CUSTOMERNAME;
        document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = value.ENDUSERCD;
        document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = value.ENDUSERNAME;
        document.getElementById('MARKETCD_TD'+index+'').innerHTML = value.MARKETCD;
        document.getElementById('MARKETNAME_TD'+index+'').innerHTML = value.MARKETNAME;
        document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = value.SALEPLANPOS;
        document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = value.SALEPLANQTY;
        document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = dec2digit(value.SALETOTALPRC.replace(/\,/g,''));
        document.getElementById('ROWNO'+index+'').value = index;
        document.getElementById('CUSTOMERCD'+index+'').value = value.CUSTOMERCD;
        document.getElementById('CUSTOMERNAME'+index+'').value = value.CUSTOMERNAME;
        document.getElementById('ENDUSERCD'+index+'').value = value.ENDUSERCD;
        document.getElementById('ENDUSERNAME'+index+'').value = value.ENDUSERNAME;
        document.getElementById('MARKETCD'+index+'').value = value.MARKETCD;
        document.getElementById('MARKETNAME'+index+'').value = value.MARKETNAME;
        document.getElementById('SALEPLANPOS'+index+'').value = value.SALEPLANPOS;
        document.getElementById('SALEPLANREQTYP'+index+'').value = value.SALEPLANREQTYP;
        document.getElementById('SALEPLANTODO1FLG'+index+'').value = value.SALEPLANTODO1FLG;
        document.getElementById('SALEPLANTODO2FLG'+index+'').value = value.SALEPLANTODO2FLG;
        document.getElementById('SALEPLANTODO3FLG'+index+'').value = value.SALEPLANTODO3FLG;
        document.getElementById('SALEPLANTODO4FLG'+index+'').value = value.SALEPLANTODO4FLG;
        document.getElementById('SALEPLANTODO5FLG'+index+'').value = value.SALEPLANTODO5FLG;
        document.getElementById('SALEPLANTODO6FLG'+index+'').value = value.SALEPLANTODO6FLG;
        document.getElementById('SALEPLANTODO7FLG'+index+'').value = value.SALEPLANTODO7FLG;
        document.getElementById('SALEPLANTODO8FLG'+index+'').value = value.SALEPLANTODO8FLG;
        document.getElementById('SALEPLANTODO9FLG'+index+'').value = value.SALEPLANTODO9FLG;
        document.getElementById('SALEPLANQTY'+index+'').value = value.SALEPLANQTY;
        document.getElementById('SALEPLANPRC'+index+'').value = dec2digit(value.SALEPLANPRC.replace(/\,/g,''));
        document.getElementById('MEMO'+index+'').value = value.MEMO;
        document.getElementById('SALETOTALPRC'+index+'').value = dec2digit(value.SALETOTALPRC.replace(/\,/g,''));
        document.getElementById('SYSVIS_MEMO'+index+'').value = value.SYSVIS_MEMO;
        document.getElementById('SYSVIS_LBLMEMO'+index+'').value = value.SYSVIS_LBLMEMO;
      });

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
    await axios.post('../SALEPLAN/function/index_x.php', data)
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

async function onClear() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'onClear');
    data.append('SYSTIMESTAMP', $('#SYSTIMESTAMP').val());
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function entry() {
    $('#loading').show();
    let data = new FormData();
    data.append('action', 'entry');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      entrySearch();
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

function salePlanDetail(index) {
    let monthd = document.getElementById('MONTHD'+index+'').value;
    // console.log(monthd);
    const month = document.createElement('input');
    month.id = 'MONTHD';
    month.name = 'MONTHD';
    month.value = monthd;
    month.type = 'hidden';
    var form = document.getElementById('salePlan');
    form.setAttribute('method', 'post');
    form.setAttribute('action', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SALEPLANDETAIL/index.php?page=SALEPLAN');
    form.setAttribute('target', 'authWindow');
    form.appendChild(month);
    window.open('', 'authWindow', 'width=1200,height=680');
    form.submit();
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

    document.getElementById('COMMIT').disabled = true;
    document.getElementById('UPDATE').disabled = false;
    document.getElementById('DELETE').disabled = false;
    document.getElementById('OK').disabled = true;
}

function insert() {
  let index = indexSequence();
  document.getElementById('LINE_TD'+index+'').innerHTML = index;
  document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = document.getElementById('CUSTOMERCD').value;
  document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = document.getElementById('CUSTOMERNAME').value;
  document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = document.getElementById('ENDUSERCD').value;
  document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = document.getElementById('ENDUSERNAME').value;
  document.getElementById('MARKETCD_TD'+index+'').innerHTML = document.getElementById('MARKETCD').value;
  document.getElementById('MARKETNAME_TD'+index+'').innerHTML = document.getElementById('MARKETNAME').value;
  document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = document.getElementById('SALEPLANPOS').value;
  document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = document.getElementById('SALEPLANQTY').value;
  document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = document.getElementById('SALETOTALPRC').value;
  document.getElementById('ROWNO'+index+'').value = index;
  document.getElementById('CUSTOMERCD'+index+'').value = document.getElementById('CUSTOMERCD').value;
  document.getElementById('CUSTOMERNAME'+index+'').value = document.getElementById('CUSTOMERNAME').value;
  document.getElementById('ENDUSERCD'+index+'').value = document.getElementById('ENDUSERCD').value;
  document.getElementById('ENDUSERNAME'+index+'').value = document.getElementById('ENDUSERNAME').value;
  document.getElementById('MARKETCD'+index+'').value = document.getElementById('MARKETCD').value;
  document.getElementById('MARKETNAME'+index+'').value = document.getElementById('MARKETNAME').value;
  document.getElementById('SALEPLANPOS'+index+'').value = document.getElementById('SALEPLANPOS').value;
  document.getElementById('SALEPLANREQTYP'+index+'').value = document.getElementById('SALEPLANREQTYP').value;
  document.getElementById('SALEPLANQTY'+index+'').value = document.getElementById('SALEPLANQTY').value;
  document.getElementById('SALEPLANPRC'+index+'').value = document.getElementById('SALEPLANPRC').value;
  document.getElementById('SALETOTALPRC'+index+'').value = document.getElementById('SALETOTALPRC').value;
  document.getElementById('MEMO'+index+'').value = document.getElementById('MEMO').value;
  document.getElementById('SALEPLANTODO6FLG'+index+'').value = document.getElementById('SALEPLANTODO6FLG').value;
  document.getElementById('SALEPLANTODO7FLG'+index+'').value = document.getElementById('SALEPLANTODO7FLG').value;
  document.getElementById('SALEPLANTODO8FLG'+index+'').value = document.getElementById('SALEPLANTODO8FLG').value;
  document.getElementById('SALEPLANTODO9FLG'+index+'').value = document.getElementById('SALEPLANTODO9FLG').value;

  if(document.getElementById('SALEPLANTODO4FLG').checked) {
    document.getElementById('SYSVIS_MEMO'+index+'').value = 'T';
    document.getElementById('SYSVIS_LBLMEMO'+index+'').value = 'T';
  } else {
    document.getElementById('SYSVIS_MEMO'+index+'').value = 'F';
    document.getElementById('SYSVIS_LBLMEMO'+index+'').value = 'F';
  }

  for(var u = 1; u <= 5; u++) {
    if(document.getElementById('SALEPLANTODO'+u+'FLG').checked) {
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
    } else {
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
    }
  }

  countCustomerRow();
  return entry();
}

function update() {
  let index = $('#ROWNO').val();
  // console.log(index);
  document.getElementById('CUSTOMERCD_TD'+index+'').innerHTML = document.getElementById('CUSTOMERCD').value;
  document.getElementById('CUSTOMERNAME_TD'+index+'').innerHTML = document.getElementById('CUSTOMERNAME').value;
  document.getElementById('ENDUSERCD_TD'+index+'').innerHTML = document.getElementById('ENDUSERCD').value;
  document.getElementById('ENDUSERNAME_TD'+index+'').innerHTML = document.getElementById('ENDUSERNAME').value;
  document.getElementById('MARKETCD_TD'+index+'').innerHTML = document.getElementById('MARKETCD').value;
  document.getElementById('MARKETNAME_TD'+index+'').innerHTML = document.getElementById('MARKETNAME').value;
  document.getElementById('SALEPLANPOS_TD'+index+'').innerHTML = document.getElementById('SALEPLANPOS').value;
  document.getElementById('SALEPLANQTY_TD'+index+'').innerHTML = document.getElementById('SALEPLANQTY').value;
  document.getElementById('SALETOTALPRC_TD'+index+'').innerHTML = document.getElementById('SALETOTALPRC').value;
  document.getElementById('CUSTOMERCD'+index+'').value = document.getElementById('CUSTOMERCD').value;
  document.getElementById('CUSTOMERNAME'+index+'').value = document.getElementById('CUSTOMERNAME').value;
  document.getElementById('ENDUSERCD'+index+'').value = document.getElementById('ENDUSERCD').value;
  document.getElementById('ENDUSERNAME'+index+'').value = document.getElementById('ENDUSERNAME').value;
  document.getElementById('MARKETCD'+index+'').value = document.getElementById('MARKETCD').value;
  document.getElementById('MARKETNAME'+index+'').value = document.getElementById('MARKETNAME').value;
  document.getElementById('SALEPLANPOS'+index+'').value = document.getElementById('SALEPLANPOS').value;
  document.getElementById('SALEPLANREQTYP'+index+'').value = document.getElementById('SALEPLANREQTYP').value;
  document.getElementById('SALEPLANQTY'+index+'').value = document.getElementById('SALEPLANQTY').value;
  document.getElementById('SALEPLANPRC'+index+'').value = document.getElementById('SALEPLANPRC').value;
  document.getElementById('SALETOTALPRC'+index+'').value = document.getElementById('SALETOTALPRC').value;
  document.getElementById('MEMO'+index+'').value = document.getElementById('MEMO').value;
  document.getElementById('SALEPLANTODO6FLG'+index+'').value = document.getElementById('SALEPLANTODO6FLG').value;
  document.getElementById('SALEPLANTODO7FLG'+index+'').value = document.getElementById('SALEPLANTODO7FLG').value;
  document.getElementById('SALEPLANTODO8FLG'+index+'').value = document.getElementById('SALEPLANTODO8FLG').value;
  document.getElementById('SALEPLANTODO9FLG'+index+'').value = document.getElementById('SALEPLANTODO9FLG').value;

  if(document.getElementById('SALEPLANTODO4FLG').checked) {
    document.getElementById('SYSVIS_MEMO'+index+'').value = 'T';
    document.getElementById('SYSVIS_LBLMEMO'+index+'').value = 'T';
  } else {
    document.getElementById('SYSVIS_MEMO'+index+'').value = 'F';
    document.getElementById('SYSVIS_LBLMEMO'+index+'').value = 'F';
  }

  for(var u = 1; u <= 5; u++) {
    if(document.getElementById('SALEPLANTODO'+u+'FLG').checked) {
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'T';
    } else {
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
      document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = 'F';
    }
  }
  return entry();
}

function del() {
  let index = $('#ROWNO').val();
  // console.log(index);
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
  document.getElementById('SALEPLANQTY'+index+'').value = '';
  document.getElementById('SALEPLANPRC'+index+'').value = '';
  document.getElementById('SALETOTALPRC'+index+'').value = '';
  document.getElementById('MEMO'+index+'').value = '';
  document.getElementById('SYSVIS_MEMO'+index+'').value = '';
  document.getElementById('SYSVIS_LBLMEMO'+index+'').value = '';
  for(var u = 1; u <= 9; u++) {
    document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = '';
    document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = '';
    document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = '';
    document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = '';
    document.getElementById('SALEPLANTODO'+u+'FLG'+index+'').value = '';
  }

  if(index < 5 && index > 0) { moveRowdata(index); }

  return entry();
}

function indexSequence() {
  // let rowno = document.getElementsByName('ROWNO_I[]');
  // let index; rowno.forEach((row) => { if(row.value != '') { index = row.value; } });
  // if (isNaN(index) || index == '' || index == null || index == 'undefined') {
  //   index = 0;
  // }
  let cusrow = document.getElementsByName('CUSTOMERCD_I[]'), index = 0;
  cusrow.forEach((cuscd) => { if(cuscd.value != '') { index = index + 1; } });
  return parseInt(index) + 1;
}

function moveRowdata(index) {
  var rows = $('#table_customer tbody tr'); var id;
  // console.log('index : ' + index);
  for (var v = parseInt(index); v < rows.length; v++) { id = v+1;
    // console.log(id);
    document.getElementById('LINE_TD'+v+'').innerHTML = document.getElementById('LINE_TD'+id+'').innerHTML;
    document.getElementById('CUSTOMERCD_TD'+v+'').innerHTML = document.getElementById('CUSTOMERCD_TD'+id+'').innerHTML;
    document.getElementById('CUSTOMERNAME_TD'+v+'').innerHTML = document.getElementById('CUSTOMERNAME_TD'+id+'').innerHTML;
    document.getElementById('ENDUSERCD_TD'+v+'').innerHTML = document.getElementById('ENDUSERCD_TD'+id+'').innerHTML;
    document.getElementById('ENDUSERNAME_TD'+v+'').innerHTML = document.getElementById('ENDUSERNAME_TD'+id+'').innerHTML;
    document.getElementById('MARKETCD_TD'+v+'').innerHTML = document.getElementById('MARKETCD_TD'+id+'').innerHTML;
    document.getElementById('MARKETNAME_TD'+v+'').innerHTML = document.getElementById('MARKETNAME_TD'+id+'').innerHTML;
    document.getElementById('SALEPLANPOS_TD'+v+'').innerHTML = document.getElementById('SALEPLANPOS_TD'+id+'').innerHTML;
    document.getElementById('SALEPLANQTY_TD'+v+'').innerHTML = document.getElementById('SALEPLANQTY_TD'+id+'').innerHTML;
    document.getElementById('SALETOTALPRC_TD'+v+'').innerHTML = document.getElementById('SALETOTALPRC_TD'+id+'').innerHTML;
    document.getElementById('CUSTOMERCD'+v+'').value = document.getElementById('CUSTOMERCD'+id+'').value;
    document.getElementById('CUSTOMERNAME'+v+'').value = document.getElementById('CUSTOMERNAME'+id+'').value;
    document.getElementById('ENDUSERCD'+v+'').value = document.getElementById('ENDUSERCD'+id+'').value;
    document.getElementById('ENDUSERNAME'+v+'').value = document.getElementById('ENDUSERNAME'+id+'').value;
    document.getElementById('MARKETCD'+v+'').value = document.getElementById('MARKETCD'+id+'').value;
    document.getElementById('MARKETNAME'+v+'').value = document.getElementById('MARKETNAME'+id+'').value;
    document.getElementById('SALEPLANPOS'+v+'').value = document.getElementById('SALEPLANPOS'+id+'').value;
    document.getElementById('SALEPLANREQTYP'+v+'').value = document.getElementById('SALEPLANREQTYP'+id+'').value;
    document.getElementById('SALEPLANQTY'+v+'').value = document.getElementById('SALEPLANQTY'+id+'').value;
    document.getElementById('SALEPLANPRC'+v+'').value = document.getElementById('SALEPLANPRC'+id+'').value;
    document.getElementById('SALETOTALPRC'+v+'').value = document.getElementById('SALETOTALPRC'+id+'').value;
    document.getElementById('MEMO'+v+'').value = document.getElementById('MEMO'+id+'').value;
    document.getElementById('SYSVIS_MEMO'+v+'').value = document.getElementById('SYSVIS_MEMO'+id+'').value;
    document.getElementById('SYSVIS_LBLMEMO'+v+'').value = document.getElementById('SYSVIS_LBLMEMO'+id+'').value;
    for(var u = 1; u <= 9; u++) {
      document.getElementById('SALEPLANTODO'+u+'FLG'+v+'').value = document.getElementById('SALEPLANTODO'+u+'FLG'+id+'').value
      document.getElementById('SALEPLANTODO'+u+'FLG'+v+'').value = document.getElementById('SALEPLANTODO'+u+'FLG'+id+'').value
      document.getElementById('SALEPLANTODO'+u+'FLG'+v+'').value = document.getElementById('SALEPLANTODO'+u+'FLG'+id+'').value
      document.getElementById('SALEPLANTODO'+u+'FLG'+v+'').value = document.getElementById('SALEPLANTODO'+u+'FLG'+id+'').value
      document.getElementById('SALEPLANTODO'+u+'FLG'+v+'').value = document.getElementById('SALEPLANTODO'+u+'FLG'+id+'').value
    }
  }
  return lineSequence();
  // ===================== Back up Code ====================== //
  // let tb = document.getElementById('table_customer');
  // let elem = tb.getElementsByTagName('tr');
  // // let elem = document.getElementsByClassName('row-customer');
  // let index = parseInt(document.getElementById('ROWNO').value);
  // var rows = $('#table_customer tbody tr');
  // if(index-1 > 0) {
  //   // rows.eq(index-1).insertBefore(rows.eq(index + 1));
  //   rows.eq(index-1).insertAfter(rows.eq(index + 1));
  // }
  // for (var v = 1; v <= rows.length; v++) {
  //   // console.log(v);
  //   if (elem[v].id) {
  //     index_x = Number(elem[v].rowIndex);
  //     elem[v].id = 'rowId' + index_x;
  //   }
  // }
  // ========================================================== //
}

function lineSequence() {
  let cusrow = document.getElementsByName('CUSTOMERCD_I[]'), count = 0;
  cusrow.forEach((cuscd) => { if(cuscd.value != '') { count = count + 1; } });
  // console.log('count is: ' + count);
  for (var l = 1; l <= count; l++) {
    document.getElementById('LINE_TD'+l+'').innerHTML = l;
    document.getElementById('ROWNO'+l+'').value = l;
  }

  document.getElementById('rowCount').innerHTML = count;
}

function countCustomerRow() {
  let cusrow = document.getElementsByName('CUSTOMERCD_I[]'), count = 0;
  cusrow.forEach((cuscd) => { if(cuscd.value != '') { count = count + 1; } });
  document.getElementById('rowCount').innerHTML = count;
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: txt,
    // background: "#8ca3a3",
    showCancelButton: type != 3 ? true : false,
    // confirmButtonColor: "silver",
    // cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
            // $('#loading').show();
        } else {
        // 
        }
    }
  });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
      $('#loading').hide();
      // console.log(e);
    });
}

async function unsetSession(form) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'SalePlan');
    await axios.post('../SALEPLAN/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function clearForm(form) {
  // clearing inputs
  var inputs = form.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
    switch (inputs[i].type) {
      // case 'hidden':
      case 'text':
        inputs[i].value = '';
        break;
      case 'date':
        inputs[i].value = '';
        break;
      case 'radio':
            case 'text':
        inputs[i].value = '';
        break;
      case 'checkbox':
        inputs[i].checked = false;
        break;
    }
  }
  // clearing selects
  var selects = form.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

  // clearing textarea
  var text = form.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

  // clearing table
  // $('#tableJob > tbody > tr').remove();
  // $('#tableScrap > tbody > tr').remove();
  // refresh
  // window.location.href = "index.php";
  window.location.href = "../SALEPLAN/";
  return false;
}

function unRequired() {

    if(ITEMCD.val() != '') {
        document.getElementById('ITEMCD').classList.remove('req');
    } else {
        document.getElementById('ITEMCD').classList.add('req');
    }

    if(STAFFCD.val() != '') {
        document.getElementById('STAFFCD').classList.remove('req');
    } else {
        document.getElementById('STAFFCD').classList.add('req');
    }

    const YEARVALUE = document.getElementById('YEARVALUE');
    if(YEARVALUE.selectedIndex != 0) {
        YEARVALUE.classList.remove('req');
    } else {
        YEARVALUE.classList.add('req');
    }

    const MONTHVALUE = document.getElementById('MONTHVALUE');
    if(MONTHVALUE.selectedIndex != 0) {
        MONTHVALUE.classList.remove('req');
    } else {
        MONTHVALUE.classList.add('req');
    }
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

  document.getElementById('COMMIT').disabled = false;
  document.getElementById('UPDATE').disabled = true;
  document.getElementById('DELETE').disabled = true;
  document.getElementById('OK').disabled = false;

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