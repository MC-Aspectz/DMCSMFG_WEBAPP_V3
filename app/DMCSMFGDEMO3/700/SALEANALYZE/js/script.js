// search
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHITEM = $('#SEARCHITEM');

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SALEANALYZE', 'authWindow', 'width=1200,height=600');});
SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=SALEANALYZE', 'authWindow', 'width=1200,height=600');});

//input serach
const STAFFCD = $('#STAFFCD');
const ITEMCD = $('#ITEMCD');

const input_serach = [STAFFCD, ITEMCD];
const serachIcon = [SEARCHSTAFF, SEARCHITEM];

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');
const COMMIT = $('#COMMIT');
const ARROWLEFT = $('#ARROWLEFT');
const ARROWRIGHT = $('#ARROWRIGHT');

// form
const form = document.getElementById('saleAnalyze');

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
    if($('#ITEMCD').val() == '') { return false; }
    return await commitAll();
})

CSV.click(function() {
    return exportCSV();
});

STAFFCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getElement('STAFFCD', STAFFCD.val());
    }
});

ITEMCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
      return getElement('ITEMCD', ITEMCD.val());
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                } 
            });
        }
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function commitAll() {
    $('#loading').show();
    let kakuteitorikom; let forword;
    let fw = document.getElementById('FORWARD');
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(fw.checked) { forword = 'T';  } else { forword = 'F'; }
    if(kakut.checked) { kakuteitorikom = 'T';  } else { kakuteitorikom = 'F'; }
    const data = new FormData(form);
    data.append('action', 'commitAll');
    data.append('FORWARD', kakuteitorikom);
    data.append('KAKUTEITORIKOM', forword);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      return clearForm(form);
      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function refreshfData(x) {
    if($('#DATE'+x+'').val() == '') { return false; }
    $('#loading').show();
    const data = new FormData();
    data.append('action', 'refreshfData');
    data.append('SYSTIMESTAMP', $('#SYSTIMESTAMP').val());
    data.append('ITEMCD', $('#ITEMCD').val());
    data.append('DATECD1', $('#DATECD1').val());
    data.append('DATECD'+x, $('#DATECD'+x+'').val());
    data.append('PLAN'+x, $('#PLAN'+x+'').val());
    data.append('ITEMBADRATE', $('#ITEMBADRATE').val());
    data.append('FIRST_PREBALANCEQTY', $('#FIRST_PREBALANCEQTY').val());
    data.append('FIRST_PREORDERQTY', $('#FIRST_PREORDERQTY').val());
    data.append('CNT', $('#CNT').val());
    data.append('NUM', x);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data;
      // console.log(value);
      if(!value.length) {
        $('#PROPLAN1STQTY').val(num2digit(value['PROPLAN1STQTY']));
        $('#PROPLAN2STQTY').val(num2digit(value['PROPLAN2STQTY']));
        $('#PROPLAN3STQTY').val(num2digit(value['PROPLAN3STQTY']));
        $('#SHIPPLAN1STQTY').val(num2digit(value['SHIPPLAN1STQTY']));
        $('#SHIPPLAN2STQTY').val(num2digit(value['SHIPPLAN2STQTY']));
        $('#SHIPPLAN3STQTY').val(num2digit(value['SHIPPLAN3STQTY']));
        $('#PROPLANQTY').val(num2digit(value['PROPLANQTY']));
        $('#SHIPPLANQTY').val(num2digit(value['SHIPPLANQTY']));
        $('#CARRYQTY').val(num2digit(value['CARRYQTY']));
        $('#PREBALANCEQTY').val(num2digit(value['PREBALANCEQTY']));
        $('#PREORDERQTY').val(num2digit(value['PREORDERQTY']));

        for (var i = 1; i <= 31; i++) {
          // console.log(value['DATE'+i+'']);
          document.getElementById('DATEH'+i+'').innerHTML = value['DATE'+i+''];
          document.getElementById('DATEH'+i+'').style.color = value['SYSFC_DATE'+i+''];

          document.getElementById('SALEORDER'+i+'').value = value['SALEORDER'+i+''];
          document.getElementById('FORCAST'+i+'').value = value['FORCAST'+i+''];
          document.getElementById('ORDER'+i+'').value = value['ORDER'+i+''];
          document.getElementById('BALANCE'+i+'').value = value['BALANCE'+i+''];
          document.getElementById('PLAN'+i+'').value = value['PLAN'+i+''];
          document.getElementById('PLAN'+i+'').style.color = value['SYSFC_PLAN'+i+''];
          document.getElementById('HOLIDAY'+i+'').value = value['HOLIDAY'+i+''];
          document.getElementById('DATE'+i+'').value = value['DATE'+i+''];
          document.getElementById('DATECD'+i+'').value = value['DATECD'+i+''];
          
        }

        if(value['SYSEN_SEARCHP'] == 'F') { document.getElementById("ARROWLEFT").disabled = true; } else { document.getElementById("ARROWLEFT").disabled = false; }
        if(value['SYSEN_SEARCHN'] == 'F') { document.getElementById("ARROWRIGHT").disabled = true; } else { document.getElementById("ARROWRIGHT").disabled = false; }
        if(value['SYSEN_YEAR'] == 'F') { document.getElementById("YEARVALUE").readonly = true; } else { document.getElementById("YEARVALUE").readonly = false; }
        if(value['SYSEN_MONTH'] == 'F') { document.getElementById("MONTHVALUE").readonly = true; } else { document.getElementById("MONTHVALUE").readonly = false; }
      }

      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function search() {
    $('#loading').show();
    let kakuteitorikom; let forword;
    let fw = document.getElementById('FORWARD');
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(fw.checked) { forword = 'T';  } else { forword = 'F'; }
    if(kakut.checked) { kakuteitorikom = 'T';  } else { kakuteitorikom = 'F'; }
    const data = new FormData(form);
    data.append('action', 'search');
    data.append('FORWARD', kakuteitorikom);
    data.append('KAKUTEITORIKOM', forword);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data;
      // console.log(value);
      $('#CNT').val(value['CNT']);
      $('#STARTDT').val(value['STARTDT']);
      $('#TODATE').val(value['TODATE']);
      $('#PROPLAN1STQTY').val(num2digit(value['PROPLAN1STQTY']));
      $('#PROPLAN2STQTY').val(num2digit(value['PROPLAN2STQTY']));
      $('#PROPLAN3STQTY').val(num2digit(value['PROPLAN3STQTY']));
      $('#SHIPPLAN1STQTY').val(num2digit(value['SHIPPLAN1STQTY']));
      $('#SHIPPLAN2STQTY').val(num2digit(value['SHIPPLAN2STQTY']));
      $('#SHIPPLAN3STQTY').val(num2digit(value['SHIPPLAN3STQTY']));
      $('#PROPLANQTY').val(num2digit(value['PROPLANQTY']));
      $('#SHIPPLANQTY').val(num2digit(value['SHIPPLANQTY']));
      $('#CARRYQTY').val(num2digit(value['CARRYQTY']));
      $('#PREBALANCEQTY').val(num2digit(value['PREBALANCEQTY']));
      $('#PREORDERQTY').val(num2digit(value['PREORDERQTY']));

      for (var i = 1; i <= 31; i++) {
        // console.log(value['DATE'+i+'']);
        document.getElementById('DATEH'+i+'').innerHTML = value['DATE'+i+''];
        document.getElementById('DATEH'+i+'').style.color = value['SYSFC_DATE'+i+''];

        document.getElementById('SALEORDER'+i+'').value = value['SALEORDER'+i+''];
        document.getElementById('FORCAST'+i+'').value = value['FORCAST'+i+''];
        document.getElementById('ORDER'+i+'').value = value['ORDER'+i+''];
        document.getElementById('BALANCE'+i+'').value = value['BALANCE'+i+''];
        document.getElementById('PLAN'+i+'').value = value['PLAN'+i+''];
        document.getElementById('HOLIDAY'+i+'').value = value['HOLIDAY'+i+''];
        document.getElementById('DATE'+i+'').value = value['DATE'+i+''];
        document.getElementById('DATECD'+i+'').value = value['DATECD'+i+''];
      }
      if(value['SYSEN_SEARCHP'] == 'F') { document.getElementById("ARROWLEFT").disabled = true; } else { document.getElementById("ARROWLEFT").disabled = false; }
      if(value['SYSEN_SEARCHN'] == 'F') { document.getElementById("ARROWRIGHT").disabled = true; } else { document.getElementById("ARROWRIGHT").disabled = false; }
      if(value['SYSEN_YEAR'] == 'F') { document.getElementById("YEARVALUE").readonly = true; } else { document.getElementById("YEARVALUE").readonly = false; }
      if(value['SYSEN_MONTH'] == 'F') { document.getElementById("MONTHVALUE").readonly = true; } else { document.getElementById("MONTHVALUE").readonly = false; }

      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getNextMonth() {
    if($('#ITEMCD').val() == '') { return false; }
    $('#loading').show();
    let kakuteitorikom; let forword;
    let fw = document.getElementById('FORWARD');
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(fw.checked) { forword = 'T';  } else { forword = 'F'; }
    if(kakut.checked) { kakuteitorikom = 'T';  } else { kakuteitorikom = 'F'; }
    const data = new FormData(form);
    data.append('action', 'getNextMonth');
    data.append('FORWARD', kakuteitorikom);
    data.append('KAKUTEITORIKOM', forword);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data;
      // console.log(value);
      $('#CNT').val(value['CNT']);
      $('#PROPLAN1STQTY').val(num2digit(value['PROPLAN1STQTY']));
      $('#PROPLAN2STQTY').val(num2digit(value['PROPLAN2STQTY']));
      $('#PROPLAN3STQTY').val(num2digit(value['PROPLAN3STQTY']));
      $('#SHIPPLAN1STQTY').val(num2digit(value['SHIPPLAN1STQTY']));
      $('#SHIPPLAN2STQTY').val(num2digit(value['SHIPPLAN2STQTY']));
      $('#SHIPPLAN3STQTY').val(num2digit(value['SHIPPLAN3STQTY']));
      $('#PROPLANQTY').val(num2digit(value['PROPLANQTY']));
      $('#SHIPPLANQTY').val(num2digit(value['SHIPPLANQTY']));
      $('#CARRYQTY').val(num2digit(value['CARRYQTY']));
      $('#PREBALANCEQTY').val(num2digit(value['PREBALANCEQTY']));
      $('#PREORDERQTY').val(num2digit(value['PREORDERQTY']));

      for (var i = 1; i <= 31; i++) {
        // console.log(value['DATE'+i+'']);
        document.getElementById('DATEH'+i+'').innerHTML = value['DATE'+i+''];
        document.getElementById('DATEH'+i+'').style.color = value['SYSFC_DATE'+i+''];

        document.getElementById('SALEORDER'+i+'').value = value['SALEORDER'+i+''];
        document.getElementById('FORCAST'+i+'').value = value['FORCAST'+i+''];
        document.getElementById('ORDER'+i+'').value = value['ORDER'+i+''];
        document.getElementById('BALANCE'+i+'').value = value['BALANCE'+i+''];
        document.getElementById('PLAN'+i+'').value = value['PLAN'+i+''];
        document.getElementById('HOLIDAY'+i+'').value = value['HOLIDAY'+i+''];
        document.getElementById('DATE'+i+'').value = value['DATE'+i+''];
        document.getElementById('DATECD'+i+'').value = value['DATECD'+i+''];
      }
      if(value['SYSEN_SEARCHP'] == 'F') { document.getElementById("ARROWLEFT").disabled = true; } else { document.getElementById("ARROWLEFT").disabled = false; }
      if(value['SYSEN_SEARCHN'] == 'F') { document.getElementById("ARROWRIGHT").disabled = true; } else { document.getElementById("ARROWRIGHT").disabled = false; }
      if(value['SYSEN_YEAR'] == 'F') { document.getElementById("YEARVALUE").readonly = true; } else { document.getElementById("YEARVALUE").readonly = false; }
      if(value['SYSEN_MONTH'] == 'F') { document.getElementById("MONTHVALUE").readonly = true; } else { document.getElementById("MONTHVALUE").readonly = false; }

      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getPreMonth() {
    if($('#ITEMCD').val() == '') { return false; }
    $('#loading').show();
    let kakuteitorikom; let forword;
    let fw = document.getElementById('FORWARD');
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(fw.checked) { forword = 'T';  } else { forword = 'F'; }
    if(kakut.checked) { kakuteitorikom = 'T';  } else { kakuteitorikom = 'F'; }
    const data = new FormData(form);
    data.append('action', 'getPreMonth');
    data.append('FORWARD', kakuteitorikom);
    data.append('KAKUTEITORIKOM', forword);
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      var value = response.data;
      // console.log(value);
      $('#CNT').val(value['CNT']);
      $('#PROPLAN1STQTY').val(num2digit(value['PROPLAN1STQTY']));
      $('#PROPLAN2STQTY').val(num2digit(value['PROPLAN2STQTY']));
      $('#PROPLAN3STQTY').val(num2digit(value['PROPLAN3STQTY']));
      $('#SHIPPLAN1STQTY').val(num2digit(value['SHIPPLAN1STQTY']));
      $('#SHIPPLAN2STQTY').val(num2digit(value['SHIPPLAN2STQTY']));
      $('#SHIPPLAN3STQTY').val(num2digit(value['SHIPPLAN3STQTY']));
      $('#PROPLANQTY').val(num2digit(value['PROPLANQTY']));
      $('#SHIPPLANQTY').val(num2digit(value['SHIPPLANQTY']));
      $('#CARRYQTY').val(num2digit(value['CARRYQTY']));
      $('#PREBALANCEQTY').val(num2digit(value['PREBALANCEQTY']));
      $('#PREORDERQTY').val(num2digit(value['PREORDERQTY']));

      for (var i = 1; i <= 31; i++) {
        // console.log(value['DATE'+i+'']);
        document.getElementById('DATEH'+i+'').innerHTML = value['DATE'+i+''];
        document.getElementById('DATEH'+i+'').style.color = value['SYSFC_DATE'+i+''];

        document.getElementById('SALEORDER'+i+'').value = value['SALEORDER'+i+''];
        document.getElementById('FORCAST'+i+'').value = value['FORCAST'+i+''];
        document.getElementById('ORDER'+i+'').value = value['ORDER'+i+''];
        document.getElementById('BALANCE'+i+'').value = value['BALANCE'+i+''];
        document.getElementById('PLAN'+i+'').value = value['PLAN'+i+''];
        document.getElementById('HOLIDAY'+i+'').value = value['HOLIDAY'+i+''];
        document.getElementById('DATE'+i+'').value = value['DATE'+i+''];
        document.getElementById('DATECD'+i+'').value = value['DATECD'+i+''];
      }
      if(value['SYSEN_SEARCHP'] == 'F') { document.getElementById("ARROWLEFT").disabled = true; } else { document.getElementById("ARROWLEFT").disabled = false; }
      if(value['SYSEN_SEARCHN'] == 'F') { document.getElementById("ARROWRIGHT").disabled = true; } else { document.getElementById("ARROWRIGHT").disabled = false; }
      if(value['SYSEN_YEAR'] == 'F') { document.getElementById("YEARVALUE").readonly = true; } else { document.getElementById("YEARVALUE").readonly = false; }
      if(value['SYSEN_MONTH'] == 'F') { document.getElementById("MONTHVALUE").readonly = true; } else { document.getElementById("MONTHVALUE").readonly = false; }

      $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function exportCSV() {
    // Variable to store the final csv data
    let styymm = document.getElementById('ST_YYMM');
    let ST_YYMM = (styymm.innerText || styymm.textContent);
    let dotxt = document.getElementById('DO_TXT');
    let DO_TXT = (dotxt.innerText || dotxt.textContent);
    let kakuteitorikom = document.getElementById('KAKU');
    let kaku = (kakuteitorikom.innerText || kakuteitorikom.textContent);
    let saleplantxt = document.getElementById('SALE_PLAN_TXT');
    let SALE_PLAN_TXT = (saleplantxt.innerText || saleplantxt.textContent);
    let inputdate = document.getElementById('INPUT_DATE');
    let INPUT_DATE = (inputdate.innerText || inputdate.textContent);
    let person = document.getElementById('PERSON_RESPONSE');
    let PERSON_RESPONSE = (person.innerText || person.textContent);
    let mpsmsg = document.getElementById('MPS_MSG');
    let MPS_MSG = (mpsmsg.innerText || mpsmsg.textContent);
    let fixed = document.getElementById('FIXED_ORDER');
    let FIXED_ORDER = (fixed.innerText || fixed.textContent);
    let item = document.getElementById('ITEMCODE');
    let ITEMCODE = (item.innerText || item.textContent);
    let lead = document.getElementById('LEADTIME');
    let LEADTIME = (lead.innerText || lead.textContent);
    let dt = document.getElementById('DAY');
    let DAY = (dt.innerText || dt.textContent);
    let buffer = document.getElementById('BUFFER_STOCK');
    let BUFFER_STOCK = (buffer.innerText || buffer.textContent);
    let drw = document.getElementById('DRAWING');
    let DRAWING = (drw.innerText || drw.textContent);
    let daily = document.getElementById('DAILY_QTY');
    let DAILY_QTY = (daily.innerText || daily.textContent);
    let onh = document.getElementById('ONH');
    let ONHAND = (onh.innerText || onh.textContent);
    let category = document.getElementById('CATEGORY_CODE');
    let CATEGORY_CODE = (category.innerText || category.textContent);
    let proplan = document.getElementById('PROPLAN_QTY_THISMONTH');
    let PROPLAN_QTY_THISMONTH = (proplan.innerText || proplan.textContent);
    let st = document.getElementById('1ST_10DAYS');
    let ST10DAYS = (st.innerText || st.textContent);
    let nd = document.getElementById('2ND_10DAYS');
    let ND_10DAYS = (nd.innerText || nd.textContent);
    let rd = document.getElementById('3RD_10DAYS');
    let RD_10DAYS = (rd.innerText || rd.textContent);
    let proplanqty = document.getElementById('PRO_PLAN_QTY');
    let PRO_PLAN_QTY = (proplanqty.innerText || proplanqty.textContent);
    let carry = document.getElementById('CARRYOVER_INV');
    let CARRYOVER_INV = (carry.innerText || carry.textContent);
    let ship = document.getElementById('SHIP_PLAN_QTY');
    let SHIP_PLAN_QTY = (ship.innerText || ship.textContent);
    let prebl = document.getElementById('PREBALANCE');
    let PREBALANCE = (prebl.innerText || prebl.textContent);
    let pre = document.getElementById('PRE_ODR_QTY');
    let PRE_ODR_QTY = (pre.innerText || pre.textContent);
    // 
    let YEARVALUE = document.getElementById('YEARVALUE').options[document.getElementById('YEARVALUE').selectedIndex].text;
    let MONTHVALUE = document.getElementById('MONTHVALUE').options[document.getElementById('MONTHVALUE').selectedIndex].text;
    let ITEMUNITTYP = document.getElementById('ITEMUNITTYP').options[document.getElementById('ITEMUNITTYP').selectedIndex].text;
    let KAKUTEITORIKOM;
    let kakut = document.getElementById('KAKUTEITORIKOM');
    if(kakut.checked) { KAKUTEITORIKOM = 'T';  } else { KAKUTEITORIKOM = 'F'; }
    let ENTRYDT = '--/--/----';
    let PLANDT = '--/--/----';
    // console.log(stdate);
    if($('#ENTRYDT').val() != '') { ENTRYDT = $('#ENTRYDT').val(); }
    if($('#PLANDT').val() != '') { PLANDT = $('#PLANDT').val(); }

    var csv_data = [ST_YYMM + ',' + YEARVALUE + ',' + MONTHVALUE + ',' + DO_TXT + ',' + KAKUTEITORIKOM  + ',' + PLANDT + ',' + SALE_PLAN_TXT + ',' + INPUT_DATE + ',' + ENTRYDT];
        csv_data.push(PERSON_RESPONSE + ',' +  $('#STAFFCD').val() + ',' + $('#STAFFNAME').val() + ',' + MPS_MSG);
        csv_data.push(ITEMCODE + ',' +  $('#ITEMCD').val() + ',' + $('#ITEMNAME').val() + ',' + LEADTIME + ',' + $('#ITEMLEADTIME').val() + ',' + DAY);
        csv_data.push(DRAWING + ',' +  $('#ITEMDRAWNO').val() + ',' + $('#ITEMSPEC').val() + ',' + DAILY_QTY + ',' + $('#ITEMBADRATE').val());
        csv_data.push(FIXED_ORDER + ',' +  $('#ITEMFIXORDER').val() + ',' + ITEMUNITTYP);
        csv_data.push(BUFFER_STOCK + ',' +  $('#ITEMMINSTOCK').val() + ',' + ITEMUNITTYP);
        csv_data.push(ONHAND + ',' +  $('#ONHAND').val() + ',' + ITEMUNITTYP);
        csv_data.push(PROPLAN_QTY_THISMONTH + ',' +  $('#PROPLANQTY').val() + ',' + ITEMUNITTYP);
        csv_data.push(SHIPPING_QTY_THISMONTH + ',' +  $('#SHIPPLANQTY').val() + ',' + ITEMUNITTYP);
        csv_data.push(CARRYOVER_INV + ',' +  $('#CARRYQTY').val() + ',' + ITEMUNITTYP);
        csv_data.push(PRE_ODR_QTY + ',' +  $('#PREORDERQTY').val() + ',' + ITEMUNITTYP);
        csv_data.push('' + ',' + ST10DAYS + ',' + '' + ',' + ND_10DAYS + ',' + '' + ',' + RD_10DAYS);
        csv_data.push(PRO_PLAN_QTY + ',' + $('#PROPLAN1STQTY').val() + ',' + ITEMUNITTYP + ',' + $('#PROPLAN2STQTY').val() + ',' + ITEMUNITTYP + ',' + $('#PROPLAN3STQTY').val() + ',' + ITEMUNITTYP + ',' + PREBALANCE + ',' + $('#PREBALANCEQTY').val() + ',' + ITEMUNITTYP);
        csv_data.push(SHIP_PLAN_QTY + ',' + $('#SHIPPLAN1STQTY').val() + ',' + ITEMUNITTYP + ',' + $('#SHIPPLAN2STQTY').val() + ',' + ITEMUNITTYP + ',' + $('#SHIPPLAN3STQTY').val() + ',' + ITEMUNITTYP + ',' + PRE_ODR_QTY + ',' + $('#PREORDERQTY').val() + ',' + ITEMUNITTYP);
    // Table Header
    var th = document.getElementById('tableResult').querySelectorAll('th');
    var csvrow = [];
    for (var j = 0; j < th.length; j++) {
      csvrow.push(th[j].innerText);
    }
    csv_data.push(csvrow.join(","));
    // Get each row data
    // var rows = document.getElementsByClassName('csv');
    var rows = document.getElementById('tableResult').querySelectorAll('table tr');
    // console.log(rows.length);
    for (var i = 1; i < rows.length; i++) {
        // Get each column data
        var csvrow = [];
        var cols = rows[i].querySelectorAll('td');
        // Stores each csv row data
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            if (el.children.length > 0) { //assuming your structure is always the same and the table only contains inputs as child elements inside a td
              csvrow.push(el.firstChild.value);
            } else {
              // csvrow.push(el.innerText);
              csvrow.push("\""+el.innerText+"\"");
            }
        });
        // console.log(csvrow);
        // Combine each column value with comma
        csv_data.push(csvrow.join(","));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
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
              console.error(err.name, err.message);
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

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: '',
    text: txt,
    showCancelButton: type != 3 ? true : false,
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
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        $('#loading').hide();
    })
    .catch((e) => {
      // console.log(e);
      $('#loading').hide();
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'SaleAnalyze');
    await axios.post('../SALEANALYZE/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
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
  // refresh
  // window.location.href = "index.php";
  window.location.href = '../SALEANALYZE/';
  return false;
}

function unRequired() {
    document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMCD').classList[document.getElementById('ITEMCD').value !== '' ? 'remove' : 'add']('req');
}
