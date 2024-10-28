// action button
const print = $("#print");
// const csv = $("#csv");

// form
const form = document.getElementById('acc_fifolist_main');


// insrts.click(function() {
//     // check validate form
//     if (!form.reportValidity()) {
//         validationDialog();
//         return false;
//     }
//     return commit('insert');
// });



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

    await axios.post('../ACC_FIFOLIST_MAIN/function/index_x.php', data)
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

    await axios.post('../ACC_FIFOLIST_MAIN/function/index_x.php', data)
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
    window.location.href = '../ACC_FIFOLIST_MAIN/';
 
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

print.click(function() {
    return printDialog();
 });
 
async function printed() {
    const data = new FormData(form);
    data.append('action', 'print');
    await axios.post('../ACC_FIFOLIST_MAIN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        // printReport();
    })
    .catch(e => {
        console.log(e);
    });
}

function printReport() {   
    var popupWindow = window.open('../ACC_FIFOLIST_MAIN/print.php', '_blank', 'width=auto, height=auto');
    // setTimeout(function() { popupWindow.close(); }, 5000);  
    // popupWindow.document.open();
    // popupWindow.document.write('<html><body onload="window.print()">' + printReport.innerHTML + '</html>');
    // // popupWindow.document.write('<html><body>' + printReport.innerHTML + '</html>');
    // popupWindow.document.close();
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

    await axios.post('../ACC_FIFOLIST_MAIN/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}