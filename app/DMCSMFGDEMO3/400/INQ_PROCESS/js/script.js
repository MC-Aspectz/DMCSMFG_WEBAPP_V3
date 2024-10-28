// button search
const SEARCHPRODUCTIONORDER = $('#SEARCHPRODUCTIONORDER');

SEARCHPRODUCTIONORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPRODUCTIONORDER/index.php?page=INQ_PROCESS', 'authWindow', 'width=1200,height=600');});

const CSV = $('#CSV');

// form
const form = document.getElementById('inqProcess');

var isItem = false;
$('table#table tr').click(function () {
    $('table#table tr').removeAttr('id')
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        $(this).attr('id', 'selected-row');
        isItem = true;
        // console.log(item.eq(0).text());
        $('#PROPSSORDERNOS').html(item.eq(0).text());
        $('#PROITEMCDS').html(item.eq(1).text());
        $('#PROITEMNAMES').html(item.eq(2).text());
        $('#PROITEMSPECS').html(item.eq(3).text());
        $('#PROQTYS').html(item.eq(4).text());
        $('#PROPLANENDDTS').html(item.eq(5).text());
        $('#PROPSSNOS').html(item.eq(6).text());
        $('#PROPSSTYPS').html(item.eq(7).text());
        $('#PROPSSPLACES').html(item.eq(8).text());
        $('#WCNAMES').html(item.eq(9).text());
        $('#WCSTDHOURRATES').html(item.eq(10).text());
        $('#WCHOURRATES').html(item.eq(11).text());
        $('#WCSTDCOSTS').html(item.eq(12).text());
        $('#WCCOSTS').html(item.eq(13).text());
        $('#COMCURRENCYS').html(item.eq(14).text());
        $('#PROPSSJOBTYPS').html(item.eq(15).text());
        $('#PROPSSREMS').html(item.eq(16).text());
        $('#PROPSSQTYS').html(item.eq(17).text());
        $('#PROPSSDURATIONS').html(item.eq(18).text());
        $('#PROPSSUNITTYPS').html(item.eq(19).text());
        $('#PROPSSSTARTDTS').html(item.eq(20).text());
        $('#PROPSSSTARTTMS').html(item.eq(21).text());
        $('#PROPSSENDDTS').html(item.eq(22).text());
        $('#PROPSSENDTMS').html(item.eq(23).text());
    }
});

$("#view_item").on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#DETAIL').on('click', function() {
    if(isItem) {
        $('#modal-view').modal('show');
    }
});

CSV.click(function() {
    return exportCSV();
});

async function exportCSV() {

let PRODUCTIONORDERTXT = (document.getElementById('PRODUCTIONORDER_TXT').innerText || document.getElementById('PRODUCTIONORDER_TXT').textContent);

var csv_data = [ PRODUCTIONORDERTXT + ',' + $('#P1').val()];

  // Get each row data
  var rows = document.getElementsByClassName('csv');
  for (var i = 0; i < rows.length; i++) {
      // Get each column data
      var cols = rows[i].querySelectorAll('td, th');
      // Stores each csv row datad
      var csvrow = [];
      [...cols].forEach((el) => {
          // console.log(el.innerText);
          csvrow.push("\""+el.innerText+"\"");
      });
      // Combine each column value with comma
      csv_data.push(csvrow.join(','));
  }
  // Combine each row data with new line character
  csv_data = csv_data.join("\n");
  // Call this function to download csv file
  // console.log(csv_data);
  await handleSaveAsCSV(csv_data);
}

async function keepData() {
    // console.log('Keepdata');
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios
    .post('../INQ_PROCESS/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'INQ_PROCESS');
    await axios
    .post('../INQ_PROCESS/function/index_x.php', data)
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
            case 'checkbox':
                inputs[i].checked = false; 
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    $('#table_result > tbody > tr').remove();

    // refresh
    window.location.href = 'index.php';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
    if (result.isConfirmed) {
        if (type == 1) {
            return closeApp($('#appcode').val()); 
        } else if (type == 2) {
            // $("#loading").show();
        } else {
        // 
        }
    }
  });
}