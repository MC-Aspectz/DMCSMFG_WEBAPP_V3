// search
// const searchcountry = $("#searchcountry");
// const searchcurrency = $("#searchcurrency");
// const setacc = $("#setacc");



// searchcountry.attr('href', $('#sessionUrl').val() + '/guide/SEARCHCOUNTRY/index.php');
// searchcurrency.attr('href', $('#sessionUrl').val() + '/guide/SEARCHCURRENCY/index.php');

//input serach
// const COUNTRYCD = $("#COUNTRYCD");
// const CURRENCYCD = $("#CURRENCYCD");
// const input_serach = [COUNTRYCD, CURRENCYCD];

// action button
//const insert = $("#insert");
const run = $("#run");
//const del = $("#delete");

// form
const form = document.getElementById('stockupdatemonthly');

// for(const input of input_serach){
//     input.change(function () {
//     	$("#loading").show();
//     });

//     input.keyup(function (e) {
//         if (e.key === 'Enter' || e.keyCode === 13) {
//             $("#loading").show();
//         }
//     });
// };



run.click(function() {
    // check validate form
  	if (!form.reportValidity()) {
		alertValidation();
		return false;
	}
	updated();
    // form.submit();
});








async function updated() {
    const data = new FormData(form);
    data.append('action', 'run');

    await axios.post('../CLEARANCEMONTHUPDATE/function/index_x.php', data)
    .then(response => {
         console.log(response.data)
       // clearForm(form);
      // window.location.reload();
       alert("Update Success!");
    })
    .catch(e => {
        console.log(e);
    });
}



async function keeyData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../CLEARANCEMONTHUPDATE/function/index_x.php', data)
    .then(response => {
        console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../CLEARANCEMONTHUPDATE/function/index_x.php', data)
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
	if(form.id == 'stockupdatemonthly') {
		// window.location.href = "index.php";
		window.location.href = '../CLEARANCEMONTHUPDATE/';
	}
    return false;
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

async function programDelete() {
    $("#loading").show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../CLEARANCEMONTHUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch(e => {
        console.log(e);
    });
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