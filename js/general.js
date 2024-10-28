const downloader = async (url, filename) => {
    // ---------------------------------------------- //
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    const event = document.createEvent('MouseEvents');
    event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    link.dispatchEvent(event);
    // ---------------------------------------------- //
    // ---------------------------------------------- //
    // const data = await fetch(url);
    // const blob = await data.blob();
    // if (window.navigator && window.navigator.msSaveOrOpenBlob) {
    //     //IE11 and the legacy version Edge support
    //     console.log('IE & Edge');
    //     window.navigator.msSaveBlob(blob, filename);
    // } else {// other browsers
    //     console.log('Other browsers');
    //     const link = document.createElement('a');
    //     link.href = URL.createObjectURL(blob);
    //     link.download = filename;
    //     link.style.display = 'none'; // link.hidden = true;
    //     document.body.appendChild(link);
    //     link.click();
    //     document.body.removeChild(link);
    // }
    // ---------------------------------------------- //
}

function numberWithComma(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function stringReplacez(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function decimalnum(num) {
    if (num == '' || num == null) { return '0'; }
    while (num.search(',') >= 0) {
        num = (num + '').replace(',', '');
    }
   return parseFloat(num).toFixed(0);
}

function dec2digit(num) {
    if (num == '' || num == null) { return '0.00'; }
    while (num.search(',') >= 0) {
        num = (num + '').replace(',', '');
    }
    return parseFloat(num).toFixed(2);
}

function dec4digit(num) {
    if (num == '' || num == null) { return '0.0000'; }
    while (num.search(',') >= 0) {
        num = (num + '').replace(',', '');
    }
    return parseFloat(num).toFixed(4);
}

function dec6digit(num) {
    if (isNaN(num) || num == '' || num == null) { return '0.00000'; }
    while (num.search(',') >= 0) {
        num = (num + '').replace(',', '');
    }
    return parseFloat(num).toFixed(6);
}
   
function num2digits(num) {
    if (num == '' || num == null) { return '0.00'; }
    return Number(num.replace(',', '')).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}
   
function num2digit(num) {
    if (isNaN(num) || num == '' || num == null) { return '0.00'; }
    return numberWithComma(parseFloat(num).toFixed(2));
}

function num4digit(num) {
    if (isNaN(num) || num == '' || num == null) { return '0.0000'; }
    return parseFloat(num).toLocaleString('en-US', { minimumFractionDigits: 4, maximumFractionDigits: 4 });
}

function num6digit(num) {
    if (isNaN(num) || num == '' || num == null) { return '0.00000'; }
    return parseFloat(num).toLocaleString('th-TH', { minimumFractionDigits: 6, maximumFractionDigits: 6 });
}

function isNumber(value) {
  return typeof value === 'number';
}

function percentLimit(num) {
	if (Number(num.value) > 100) {
		return num.value = 100
	}
}

function upperCase(input) {
  input.value = input.value.toUpperCase();
}

function lowerCase(input) {
  input.value = input.value.toLowerCase();
}

function dashFormatDate(date) {
    if (date == '') { return ''; }
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function slashFormatDate(date) {
    if (date == '') { return ''; }
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('/');
}

function dateFormat(date) {
    if (date == '') { return ''; }
    return date.replace(/(\d{4})(\d{2})(\d{2})/g, '$1-$2-$3');
}

function timeFormat(input) {
    // Remove commas
    input = input.replace(',', '');

    // Check if the input is a valid number
    if (!/^\d+$/.test(input)) {
        return "00:00";
    }
    // Parse hours and minutes
    const rawHours = Math.floor(parseInt(input, 10) / 100);
    const rawMinutes = parseInt(input, 10) % 100;

    // If the hours are greater than 23, set them to 0
    const adjustedHours = rawHours >= 24 ? 0 : rawHours;

    // If the minutes are greater than 59, set them to 0
    const adjustedMinutes = rawMinutes >= 60 ? 0 : rawMinutes;

    // Format the time as "00:00"
    const formattedTime = `${String(adjustedHours).padStart(2, '0')}:${String(adjustedMinutes).padStart(2, '0')}`;

    return formattedTime;
}

function objectArray(data) {
    return jQuery.type(data) === 'object';
}

function checkArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}

function strTobool(string) {
    switch(string.toLowerCase().trim()) {
        case 'true': case 'yes': case '1': return true;
        case 'false': case 'no': case '0': case null: return false;
        default: return Boolean(string);
    }
}

async function handleSaveAsCSV(csv_data) {
    CSVFile = new Blob(["\uFEFF" + csv_data], { type: 'text/csv;charset=utf-8;', });
    // console.log(CSVFile);
    const supportsFileSystemAccess =
    'showSaveFilePicker' in window &&
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
                    description: 'CSV file',
                    accept: { 'application/csv': ['.csv'] },
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
        if (err.name !== 'AbortError') {
            console.error(err.name, err.message);
            return;
        }
    }
  }
    // Fallback if the File System Access API is not supported…
    // Create the CSVFile URL.
    const url = URL.createObjectURL(CSVFile);
    // Create the `<a download>` element and append it invisibly.
    const temp_link = document.createElement('a');
    temp_link.href = url;
    temp_link.download = suggestedName;
    temp_link.style.display = 'none';
    document.body.append(temp_link);
    // Programmatically click the element.
    temp_link.click();
    // Revoke the CSVFile URL and remove the element.
    setTimeout(() => {
        URL.revokeObjectURL(url);
        temp_link.remove();
    }, 1000);
}

function urlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}