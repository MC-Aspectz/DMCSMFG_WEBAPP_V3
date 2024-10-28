// form
const form = document.getElementById('acc_inventoryentry');

// action button
const COMMIT = $("#COMMIT");
const OK = $("#OK");
const UPDATE = $("#UPDATE");
const DELETE = $("#DELETE");

UPDATE.click(function() {
    // check validate form
    $('#loading').show();
    return update();
});

async function update() {
    let rowno = $('#ROWNO').val();
    console.log($('#ROWNO').val());/////

    $('#ITEMCD'+rowno+'').val($('#ITEMCD').val());
    $('#ITEMCD_TD'+rowno+'').html($('#ITEMCD').val());
    $('#ITEMNAME'+rowno+'').val($('#ITEMNAME').val());
    $('#ITEMNAME_TD'+rowno+'').html($('#ITEMNAME').val());
    $('#ITEMSPEC'+rowno+'').val($('#ITEMSPEC').val())
    $('#ITEMSPEC_TD'+rowno+'').html($('#ITEMSPEC').val());
    $('#QTY'+rowno+'').val($('#QTY').val());
    $('#QTY_TD'+rowno+'').html($('#QTY').val());
    $('#ITEMUNITTYP'+rowno+'').val(document.getElementById("ITEMUNITTYP").value);//dd
    $('#ITEMUNITTYP_TD'+rowno+'').html($("#ITEMUNITTYP option:selected").text());//dd
    $('#INVTRANNO'+rowno+'').val($('#INVTRANNO').val());
    $('#INVTRANTYPE'+rowno+'').val($('#INVTRANTYPE').val());
    $('#INVTRANISSUEDT'+rowno+'').val($('#INVTRANISSUEDT').val());
    $('#LOCTYP'+rowno+'').val($('#LOCTYP').val());
    $('#LOCCD'+rowno+'').val($('#LOCCD').val());
    $('#LOCNAME'+rowno+'').val($('#LOCNAME').val());
    $('#WDPURPOSE'+rowno+'').val($('#WDPURPOSE').val());
    $('#INVTRANREM'+rowno+'').val($('#INVTRANREM').val());
    // $('#ITEMUNITTYP'+rowno+'').val(document.getElementById("ITEMUNITTYP").value);
    // $('#ITEMUNITTYP_TD'+rowno+'').html($("#ITEMUNITTYP option:selected").text());

    document.getElementById("COMMIT").disabled = false;
    document.getElementById("UPDATE").disabled = true;
    document.getElementById("DELETE").disabled = true;
    document.getElementById("OK").disabled = false;

    entry1();
    await keepAccData();/////////////

}

async function keepAccData() {
    const data = new FormData(form);
    data.append('action', 'keepAccData');
    // console.log(data);
    await axios.post('../ACC_INVENTORYENTRY/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function searchs() {
    $('#loading').show(); 
    form.submit();
    // let data = new FormData(form);
    // data.append('action', 'search');
    // await axios.post('../CATALOGMASTER/function/index_x.php', data)
    // .then(response => {
    //     console.log(response.data)
    // })
    // .catch(e => {
    //     console.log(e);
    // });
}

async function commit(method) {
    let data = new FormData(form);
    data.append('action', method);

    await axios.post('../ACC_INVENTORYENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        window.location.href='index.php?refresh=1';
        // clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../ACC_INVENTORYENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });

    
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
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
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    $('#table_result > tbody > tr').remove();

    // refresh
    // window.location.href = '../ACC_INVENTORYENTRY/';
     window.location.href = 'index.php';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        background: '#8ca3a3',
        showCancelButton: true,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                window.location.href="/DMCS_WEBAPP";          
            } else {
                printReport();
            }

        }
    });
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year].join('/');
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_INVENTORYENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

function changeRowId() {
    var elem = document.getElementsByTagName("tr");
    for (var i = 0; i < elem.length; i++) {
      // console.log(i);
      if (elem[i].id) {
        index_x = Number(elem[i].rowIndex);
        elem[i].id = "rowId" + index_x;
      }
    }
}

function selectRow() {
    $('table#search_table tr').click(function () {
        $('table#search_table tr').removeAttr('id');
    
        $(this).attr('id', 'click-row');
       
        let item = $(this).closest('tr').children('td');
      
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            document.getElementById("COMMIT").disabled = false;
            document.getElementById("UPDATE").disabled = false;
            document.getElementById("DELETE").disabled = false;
            document.getElementById("OK").disabled = true;
            // console.log(item.eq(5).text());
    
            $('#ROWNO').val(item.eq(0).text());
            $('#ITEMCD').val(item.eq(1).text());
            $('#ITEMNAME').val(item.eq(2).text());
            $('#ITEMSPEC').val(item.eq(3).text());
            $('#QTY').val(item.eq(4).text());
            // $('#ITEMUNITTYP').val(item.eq(5).text());
            document.getElementById("ITEMUNITTYP").value = item.eq(5).text();
            // document.getElementById("ITEMUNITTYP").value = 'ST';
    
        }
    });
}

