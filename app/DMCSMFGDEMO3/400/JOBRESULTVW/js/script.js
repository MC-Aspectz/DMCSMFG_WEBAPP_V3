// button search
const SEARCHWORKCENTER = $('#SEARCHWORKCENTER');

SEARCHWORKCENTER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHWORKCENTER/index.php?page=JOBRESULTVW', 'authWindow', 'width=1200,height=600');});

const CSV = $('#CSV');

//input serach
const I_WCCD = $('#I_WCCD');

// form
const form = document.getElementById('jobResultTW');

SEARCHWORKCENTER.on('click', async function() {
    await keepData();
});

I_WCCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getElement('I_WCCD', I_WCCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/400/JOBRESULTVW/index.php?'+code+'=' + value;        
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../JOBRESULTVW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
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


var isItem = false;
$('table#table tr').click(function () {
    $('table#table tr').removeAttr('id')
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        $(this).attr('id', 'selected-row');
        isItem = true;
        $('#WORK_DAY').html(item.eq(0).text());
        $('#VOUCHERNO').html(item.eq(1).text());
        $('#WC_CODE').html(item.eq(2).text());
        $('#WORK_CENTER_NAME').html(item.eq(3).text());
        $('#PRODUCTIONORDER').html(item.eq(4).text());
        $('#ROUT_NO').html(item.eq(5).text());
        $('#IM_CODE').html(item.eq(6).text());
        $('#ITEMNAME').html(item.eq(7).text());
        $('#COMPLETE_QUANTITY').html(item.eq(8).text());
        $('#WORK_TIME').html(item.eq(9).text());
        $('#MEMO').html(item.eq(10).text());
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
    // Variable to store the final csv data
      let I_DATE1 = '--/--/----';
      let I_DATE2 = '--/--/----';
      if($('#I_DATE1').val() != '') { I_DATE1 = $('#I_DATE1').val(); }
      if($('#I_DATE2').val() != '') { I_DATE2 = $('#I_DATE2').val(); }

      var csv_data = ['Work Center ,' +  $('#I_WCCD').val() + $('#D_WCNM').val()];
      csv_data.push('Operation Date ,' + I_DATE1 + ',→,' + I_DATE2 );

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
          // console.log(csvrow);
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
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../JOBRESULTVW/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData(form);
    data.append('action', 'unsetsession');
    data.append('systemName', 'JOBRESULTVW');
    await axios
    .post('../JOBRESULTVW/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
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
            case 'checkbox':
                inputs[i].checked = false; 
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i <selects.length; i++)
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

function unRequired() {
    let I_DATE1 = document.getElementById('I_DATE1');
    let I_DATE2 = document.getElementById('I_DATE2');

    I_DATE1.classList[I_DATE1.value !== '' ? 'remove' : 'add']('req');
    I_DATE2.classList[I_DATE2.value !== '' ? 'remove' : 'add']('req');
}