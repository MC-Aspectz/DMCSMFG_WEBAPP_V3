// button search
const searchapp = $("#searchapp");

// searchapp.attr('href', $('#sessionUrl').val() + '/guide/SEARCHAPP/index.php');
searchapp.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHAPP/index.php?page=APPLICATION', 'authWindow', 'width=1200,height=600');});

//input serach
const FORMTITLETYP = $("#FORMTITLETYP");


const input_serach = [FORMTITLETYP];

// action button
const insrts = $("#insert");
const updte = $("#update");
const deletes = $("#delete");
const closepage = $("#closepage");


// form
const form = document.getElementById('application');

$(document).ready(function() {
    unRequired();
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
});

for(const input of input_serach) {
    input.change(function () {
       
        $("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

searchapp.click(function() {
    keeyData();
});

FORMTITLETYP.change(function() {
    window.location.href="index.php?appcd=" + FORMTITLETYP.val();
});

FORMTITLETYP.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        window.location.href="index.php?appcd=" + FORMTITLETYP.val();
    }
})



insrts.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return commit('insert');
});

updte.click(function() {
    return commit('update');
});

deletes.click(function() {
    return commit('deletes');
});

closepage.click(function() {
    return programDelete();
});


$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');


    //FORMSEQ,FORMNO,FORMTITLETYP,APPNAME,FORMAPP,FORMPACKTYP
    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#FORMSEQ').val(item.eq(0).text());
        $('#FORMNO').val(item.eq(1).text());
        $('#FORMTITLETYP').val(item.eq(2).text());
        $('#APPNAME').val(item.eq(3).text());
        $('#FORMAPP').val(item.eq(4).text());
        $('#FORMPACKTYP').val(item.eq(5).text());
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();
        unRequired();
    }
});

async function searchs() {
    $('#loading').show(); 
    form.submit();
}

async function commit(method) {
    let data = new FormData(form);
    data.append('action', method);

    await axios.post('../APPLICATION/function/index_x.php', data)
    .then(response => {
        console.log(response.data)
        window.location.href='index.php?refresh=1';
        // clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

function unRequired() {

    let FORMTITLETYP = document.getElementById("FORMTITLETYP");
    let FORMPACKTYP = document.getElementById("FORMPACKTYP");

    FORMTITLETYP.classList[FORMTITLETYP.value !== '' ? 'remove' : 'add']('req');
    FORMPACKTYP.classList[FORMPACKTYP.value !== '' ? 'remove' : 'add']('req');

}

function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/911/APPLICATION/index.php?'+code+'=' + result;
}

function enrty() {
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    $('#FORMSEQ').val('');
    $('#FORMNO').val('');
    $('#FORMTITLETYP').val('');
    $('#APPNAME').val('');
    $('#FORMAPP').val('');
    $('#FORMPACKTYP').val('');
    unRequired();
}

async function keeyData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../APPLICATION/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../APPLICATION/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function programDelete() {
    $("#loading").show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../APPLICATION/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $("#sessionUrl").val() + "/home.php";
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
            case 'number':
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
    $('#search_table > tbody > tr').remove();
    emptyRow();
    // refresh
    // window.location.href = '../CATALOGMASTER/';
    return false;
}

function emptyRow() {
    for (var i = 0; i < 10; i++) {
        $("table tbody").append('<tr class="tr_border table-secondary">' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td>' +
                                '<td class="td-class"></td></tr>');
    }
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                unsetSession(form); 
                programDelete();
            }
        }
    });
}

// function getMachineId() {
//     let machineId = localStorage.getItem('MachineId');

//     if (!machineId) {
//         machineId = crypto.randomUUID();
//         localStorage.setItem('MachineId', machineId);
//     }  
//     return machineId.toUpperCase();
// }